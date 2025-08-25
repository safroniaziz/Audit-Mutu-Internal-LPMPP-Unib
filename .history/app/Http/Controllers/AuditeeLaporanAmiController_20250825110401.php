<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PeriodeAktif;
use App\Models\KuisionerJawaban;
use App\Models\EvaluasiSubmission;
use App\Models\EvaluasiMasukan;
use App\Models\Tujuan;
use App\Models\LingkupAudit;
use App\Models\SatuanStandar;
use App\Models\Kuisioner;
use App\Models\Evaluasi;
use App\Models\IndikatorInstrumenKriteria;
use App\Models\PenugasanAuditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeLaporanAmiController extends Controller
{
    public function index()
    {
        $penugasanAuditors = PengajuanAmi::with([
                'auditors.auditor',
                'auditee',
                'ikssAuditee.nilai',
                'periodeAktif',
                'evaluasiSubmissions' => function($query) {
                    $query->where('user_id', Auth::id());
                }
            ])
            ->withCount(['auditors'])
            ->where('auditee_id', Auth::user()->unit_kerja_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('auditee.laporan.index', [
            'penugasanAuditors' => $penugasanAuditors
        ]);
    }

    public function evaluasiForm($id)
    {
        $pengajuan = PengajuanAmi::with(['periodeAktif'])
            ->where('auditee_id', Auth::user()->unit_kerja_id)
            ->findOrFail($id);

        // Get master evaluasi data
        $evaluasis = Evaluasi::where('jenis_evaluasi', 'auditee')->get();

        // Get submitted values for this pengajuan
        $evaluasiSubmissions = EvaluasiSubmission::where('pengajuan_ami_id', $pengajuan->id)
            ->where('jenis', 'auditee')
            ->where('user_id', Auth::id())
            ->get()
            ->keyBy('evaluasi_id');

        // Get masukan data
        $evaluasiMasukan = EvaluasiMasukan::where('pengajuan_ami_id', $pengajuan->id)
            ->where('user_id', Auth::id())
            ->first();

        return view('auditee.laporan._evaluasi_form', [
            'pengajuan' => $pengajuan,
            'evaluasis' => $evaluasis,
            'evaluasiSubmissions' => $evaluasiSubmissions,
            'evaluasiMasukan' => $evaluasiMasukan
        ]);
    }

    public function evaluasi(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:4',
            'materi_instrumen' => 'nullable|string',
            'pelaksanaan_audit' => 'nullable|string',
            'saran_teraudit' => 'nullable|string'
        ]);

        $pengajuan = PengajuanAmi::where('auditee_id', Auth::user()->unit_kerja_id)
            ->findOrFail($id);

        // Save evaluasi submissions
        foreach ($request->nilai as $evaluasiId => $nilai) {
            EvaluasiSubmission::updateOrCreate(
                [
                    'pengajuan_ami_id' => $pengajuan->id,
                    'evaluasi_id' => $evaluasiId,
                    'user_id' => Auth::id(),
                    'jenis' => 'auditee',
                ],
                ['nilai' => $nilai]
            );
        }

        // Save masukan
        EvaluasiMasukan::updateOrCreate(
            [
                'pengajuan_ami_id' => $pengajuan->id,
                'user_id' => Auth::id()
            ],
            [
                'materi_instrumen' => $request->materi_instrumen,
                'pelaksanaan_audit' => $request->pelaksanaan_audit,
                'saran_teraudit' => $request->saran_teraudit
            ]
        );

        return response()->json([
            'message' => 'Evaluasi berhasil disimpan'
        ]);
    }

    public function show($id)
    {
        $pengajuan = PengajuanAmi::findOrFail($id);

        // Get ALL SatuanStandar but mark which ones have elements assigned to this prodi
        $allSatuanStandar = SatuanStandar::orderBy('kode_satuan')->get();

        // Mark which SS have elements assigned to this prodi
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandar->has_prodi_elements = $satuanStandar->indikatorKinerjas()
                ->whereHas('unitKerjas', function ($query) use ($pengajuan) {
                    $query->where('unit_kerja_id', $pengajuan->auditee->id);
                })->exists();
        }

        $pengajuanAmis = PengajuanAmi::with([
            'ikssAuditee' => function ($query) {
                $query->where('status_target', true);
            },
            'ikssAuditee.nilai.auditor' => function ($query) use ($id) {
                $query->with(['penugasan' => function ($subQuery) use ($id) {
                    $subQuery->where('pengajuan_ami_id', $id);
                }]);
            },
            'ikssAuditee.visitasi',
            'ikssAuditee.instrumen.indikatorKinerja.satuanStandar',
            'auditee',
            'auditors.auditor.unitKerja',
        ])->where('id', $id)->first();

        $ikssAuditeeCollection = collect($pengajuanAmis->ikssAuditee);
        $groupedBySatuanId = $ikssAuditeeCollection->groupBy(function ($ikssAuditee) {
        return $ikssAuditee->instrumen->indikatorKinerja->satuan_standar_id;
        });

        // Initialize results array
        $sortedGrouped = collect();

        // Process each Sasaran Strategis
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;

            // Check if this Sasaran Strategis has audit data
            if ($groupedBySatuanId->has($satuanStandarId)) {
                $ikssItems = $groupedBySatuanId[$satuanStandarId];

                // Initialize score collectors
                $allScores = collect();
                $ketuaScores = collect();
                $anggotaScores = collect();

                foreach ($ikssItems as $ikssItem) {
                    foreach ($ikssItem->nilai as $nilai) {
                        if (!is_null($nilai->nilai)) {
                            // Check if the auditor has a valid role (ketua or pendamping)
                            $validRole = false;
                            $isPenugasanKetua = false;

                            foreach ($nilai->auditor->penugasan as $penugasan) {
                                if ($penugasan->pengajuan_ami_id == $id &&
                                    $penugasan->user_id == $nilai->auditor_id) {
                                    // Only include scores from ketua and pendamping roles
                                    if ($penugasan->role == 'ketua' || $penugasan->role == 'pendamping') {
                                        $validRole = true;
                                        $isPenugasanKetua = ($penugasan->role == 'ketua');
                                        break;
                                    }
                                }
                            }

                            // Only process scores for valid roles
                            if ($validRole) {
                                $scoreValue = (float)$nilai->nilai;
                                $allScores->push($scoreValue);

                                if ($isPenugasanKetua) {
                                    $ketuaScores->push($scoreValue);
                                } else {
                                    $anggotaScores->push($scoreValue);
                                }
                            }
                        }
                    }
                }

                // Calculate statistics
                $totalNilai = $allScores->sum();
                $totalNilaiKetua = $ketuaScores->sum();
                $totalNilaiAnggota = $anggotaScores->sum();
                $avgNilai = $allScores->avg();
                $countAssessments = $allScores->count();

                                // Add to results collection
                $sortedGrouped->push([
                    'satuan_standar_id' => $satuanStandarId,
                    'kode_satuan' => $satuanStandar->kode_satuan,
                    'sasaran' => $satuanStandar->sasaran,
                    'total_nilai' => $totalNilai,
                    'total_nilai_ketua' => $totalNilaiKetua,
                    'total_nilai_anggota' => $totalNilaiAnggota,
                    'rata_rata' => $avgNilai,
                    'jumlah_penilaian' => $countAssessments,
                    'items' => $ikssItems,
                    'has_data' => true,
                    'has_prodi_elements' => $satuanStandar->has_prodi_elements
                ]);
            } else {
                // Add Sasaran Strategis with no data (but still show all SS)
                $sortedGrouped->push([
                    'satuan_standar_id' => $satuanStandarId,
                    'kode_satuan' => $satuanStandar->kode_satuan,
                    'sasaran' => $satuanStandar->sasaran,
                    'total_nilai' => 0,
                    'total_nilai_ketua' => 0,
                    'total_nilai_anggota' => 0,
                    'rata_rata' => 0,
                    'jumlah_penilaian' => 0,
                    'items' => collect(),
                    'has_data' => false,
                    'has_prodi_elements' => $satuanStandar->has_prodi_elements
                ]);
            }
            }

            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Get Instrumen Prodi data - calculate per kriteria with specified columns
        // Only get kriteria from instrumen that belong to this prodi
        $kriterias = IndikatorInstrumenKriteria::with([
            'instrumenProdi.nilaiAuditor' => function ($query) use ($pengajuan) {
                $query->where('pengajuan_ami_id', $pengajuan->id);
            }
        ])
        ->whereHas('indikatorInstrumen.prodis', function ($query) use ($pengajuan) {
            $query->where('unit_kerja_id', $pengajuan->auditee->id);
        })
        ->get();

        // Calculate scores per kriteria
        $kriteriaScores = [];
        foreach ($kriterias as $kriteria) {
            $ketuaScores = collect();
            $anggotaScores = collect();

            foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                foreach ($instrumenProdi->nilaiAuditor as $nilai) {
                    if ($nilai->nilai) {
                        // Get auditor role from penugasan
                        $penugasan = PenugasanAuditor::where('pengajuan_ami_id', $pengajuan->id)
                            ->where('user_id', $nilai->auditor_id)
                            ->first();

                        if ($penugasan) {
                            $scoreValue = (float)$nilai->nilai;
                            if ($penugasan->role == 'ketua') {
                                $ketuaScores->push($scoreValue);
                            } elseif ($penugasan->role == 'pendamping') {
                                $anggotaScores->push($scoreValue);
                            }
                        }
                    }
                }
            }

            // Calculate averages
            $avgKetua = $ketuaScores->avg();
            $avgAnggota = $anggotaScores->avg();
            $avgTotal = collect([$avgKetua, $avgAnggota])->filter()->avg();

            if ($avgTotal > 0) {
                $kriteriaScores[] = [
                    'kode_kriteria' => $kriteria->kode_kriteria,
                    'nama_kriteria' => $kriteria->nama_kriteria,
                    'rata_rata' => $avgTotal,
                    'rata_rata_ketua' => $avgKetua,
                    'rata_rata_anggota' => $avgAnggota,
                    'jumlah_penilaian' => $ketuaScores->count() + $anggotaScores->count()
                ];
            }
        }

        return view('auditee.laporan.detail', [
            'periodeAktif' => $periodeAktif,
            'pengajuanAmis' => $pengajuanAmis,
            'sortedGrouped' => $sortedGrouped,
            'kriteriaScores' => $kriteriaScores,
        ]);
    }

    public function laporanAmi($id)
    {
        $pengajuan = PengajuanAmi::with(['auditee', 'auditors.auditor', 'ikssAuditee'])->findOrFail($id);
        $jawabanKuisioner = KuisionerJawaban::with(['kuisioner', 'opsi'])
                                            ->where('pengajuan_id', $pengajuan->id)
                                            ->get();

        if ($jawabanKuisioner->isEmpty()) {
            // Jika belum ada jawaban, lakukan validasi
            return redirect()->back()->with('error', 'Jawaban belum ada');
        }

        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $tujuans = Tujuan::all();
        $lingkupAudits = LingkupAudit::all();

        // Get ALL SatuanStandar but mark which ones have elements assigned to this prodi
        $allSatuanStandar = SatuanStandar::orderBy('kode_satuan')->get();

        // Mark which SS have elements assigned to this prodi
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandar->has_prodi_elements = $satuanStandar->indikatorKinerjas()
                ->whereHas('unitKerjas', function ($query) use ($pengajuan) {
                    $query->where('unit_kerja_id', $pengajuan->auditee->id);
                })->exists();
        }

        $pengajuanAmis = PengajuanAmi::with([
                            'ikssAuditee' => function ($query) {
                                $query->where('status_target', true);
                            },
                            'ikssAuditee.nilai.auditor' => function ($query) use ($pengajuan) {
                                $query->with(['penugasan' => function ($subQuery) use ($pengajuan) {
                                    $subQuery->where('pengajuan_ami_id', $pengajuan->id);
                                }]);
                            },
                            'ikssAuditee.visitasi',
                            'ikssAuditee.instrumen.indikatorKinerja.satuanStandar',
                            'auditee',
                            'auditors.auditor.unitKerja',
                        ])->where('id', $pengajuan->id)->first();

        // Get Instrumen Prodi data - calculate per kriteria with specified columns
        // Only get kriteria from instrumen that belong to this prodi
        $kriterias = IndikatorInstrumenKriteria::with([
            'instrumenProdi.nilaiAuditor' => function ($query) use ($pengajuan) {
                $query->where('pengajuan_ami_id', $pengajuan->id);
            }
        ])
        ->whereHas('indikatorInstrumen.prodis', function ($query) use ($pengajuan) {
            $query->where('unit_kerja_id', $pengajuan->auditee->id);
        })
        ->get();

        // Calculate scores per kriteria
        $kriteriaScores = [];
        foreach ($kriterias as $kriteria) {
            $ketuaScores = collect();
            $anggotaScores = collect();

            foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                foreach ($instrumenProdi->nilaiAuditor as $nilai) {
                    if ($nilai->nilai) {
                        // Get auditor role from penugasan
                        $penugasan = PenugasanAuditor::where('pengajuan_ami_id', $pengajuan->id)
                            ->where('user_id', $nilai->auditor_id)
                            ->first();

                        if ($penugasan) {
                            if ($penugasan->role == 'ketua') {
                                $ketuaScores->push((float)$nilai->nilai);
                            } elseif ($penugasan->role == 'pendamping') {
                                $anggotaScores->push((float)$nilai->nilai);
                            }
                        }
                    }
                }
            }

            $totalNilaiKetua = $ketuaScores->sum();
            $totalNilaiAnggota = $anggotaScores->sum();
            $totalNilai = $totalNilaiKetua + $totalNilaiAnggota;
            $jumlahPenilaian = $ketuaScores->count() + $anggotaScores->count();
            $rataRata = $jumlahPenilaian > 0 ? $totalNilai / $jumlahPenilaian : 0;

            $kriteriaScores[] = [
                'kode_kriteria' => $kriteria->kode_kriteria,
                'nama_kriteria' => $kriteria->nama_kriteria,
                'total_nilai_ketua' => $totalNilaiKetua,
                'total_nilai_anggota' => $totalNilaiAnggota,
                'total_nilai' => $totalNilai,
                'jumlah_penilaian' => $jumlahPenilaian,
                'rata_rata' => $rataRata
            ];
        }

        $ikssAuditeeCollection = collect($pengajuanAmis->ikssAuditee);
        $groupedBySatuanId = $ikssAuditeeCollection->groupBy(function ($ikssAuditee) {
            return $ikssAuditee->instrumen->indikatorKinerja->satuan_standar_id;
        });

        // Initialize results array
        $sortedGrouped = collect();

        // Process each Sasaran Strategis
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;

            // Check if this Sasaran Strategis has audit data
            if ($groupedBySatuanId->has($satuanStandarId)) {
                $ikssItems = $groupedBySatuanId[$satuanStandarId];

                // Initialize score collectors
                $allScores = collect();
                $ketuaScores = collect();
                $anggotaScores = collect();

                foreach ($ikssItems as $ikssItem) {
                    foreach ($ikssItem->nilai as $nilai) {
                        if (!is_null($nilai->nilai)) {
                            // Check if the auditor has a valid role (ketua or pendamping)
                            $validRole = false;
                            $isPenugasanKetua = false;

                            foreach ($nilai->auditor->penugasan as $penugasan) {
                                if ($penugasan->pengajuan_ami_id == $pengajuan->id &&
                                    $penugasan->user_id == $nilai->auditor_id) {
                                    // Only include scores from ketua and pendamping roles
                                    if ($penugasan->role == 'ketua' || $penugasan->role == 'pendamping') {
                                        $validRole = true;
                                        $isPenugasanKetua = ($penugasan->role == 'ketua');
                                        break;
                                    }
                                }
                            }

                            // Only process scores for valid roles
                            if ($validRole) {
                                $scoreValue = (float)$nilai->nilai;
                                $allScores->push($scoreValue);

                                if ($isPenugasanKetua) {
                                    $ketuaScores->push($scoreValue);
                                } else {
                                    $anggotaScores->push($scoreValue);
                                }
                            }
                        }
                    }
                }

                // Calculate statistics
                $totalNilai = $allScores->sum();
                $totalNilaiKetua = $ketuaScores->sum();
                $totalNilaiAnggota = $anggotaScores->sum();
                $avgNilai = $allScores->avg();
                $countAssessments = $allScores->count();

                // Add to results collection
                $sortedGrouped->push([
                    'satuan_standar_id' => $satuanStandarId,
                    'kode_satuan' => $satuanStandar->kode_satuan,
                    'sasaran' => $satuanStandar->sasaran,
                    'total_nilai' => $totalNilai,
                    'total_nilai_ketua' => $totalNilaiKetua,
                    'total_nilai_anggota' => $totalNilaiAnggota,
                    'rata_rata' => $avgNilai,
                    'jumlah_penilaian' => $countAssessments,
                    'items' => $ikssItems,
                    'has_data' => true,
                    'has_prodi_elements' => $satuanStandar->has_prodi_elements
                ]);
            } else {
                // Add Sasaran Strategis with no data (but still show all SS)
                $sortedGrouped->push([
                    'satuan_standar_id' => $satuanStandarId,
                    'kode_satuan' => $satuanStandar->kode_satuan,
                    'sasaran' => $satuanStandar->sasaran,
                    'total_nilai' => 0,
                    'total_nilai_ketua' => 0,
                    'total_nilai_anggota' => 0,
                    'rata_rata' => 0,
                    'jumlah_penilaian' => 0,
                    'items' => collect(),
                    'has_data' => false,
                    'has_prodi_elements' => $satuanStandar->has_prodi_elements
                ]);
            }
        }

        $data = [
            'periodeAktif'   =>  $periodeAktif,
            'tujuans'   =>  $tujuans,
            'lingkupAudits'   =>  $lingkupAudits,
            'pengajuanAmis'   =>  $pengajuanAmis,
            'sortedGrouped'   =>  $sortedGrouped,
            'jawabanKuisioner'   =>  $jawabanKuisioner,
            'kriteriaScores' => $kriteriaScores,
        ];

        $pdf = Pdf::loadView('cetak.laporan_ami', $data);
        return $pdf->stream('Laporan_AMI.pdf');
    }
}
