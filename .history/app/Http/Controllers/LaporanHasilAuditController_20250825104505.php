<?php

namespace App\Http\Controllers;

use App\Models\KuisionerJawaban;
use App\Models\LingkupAudit;
use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\PeriodeAktif;
use App\Models\SatuanStandar;
use App\Models\Tujuan;
use App\Models\IndikatorInstrumenKriteria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LaporanHasilAuditController extends Controller
{
    public function index(){
        // Get current active period
        $currentPeriod = PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periods for filter dropdown
        $allPeriods = PeriodeAktif::withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC')
            ->orderBy('tahun_ami', 'desc')
            ->get();

        // Get penugasan auditors filtered by current active period
        $query = PengajuanAmi::with(['auditors.auditor','auditee','ikssAuditee.nilai','periodeAktif'])
            ->withCount(['auditors'])
            ->orderBy('created_at','desc');

        // Filter by current active period if exists
        if ($currentPeriod) {
            $query->where('periode_id', $currentPeriod->id);
        }

        $penugasanAuditors = $query->get();

                // Add audit status to each pengajuan
        $penugasanAuditors->each(function ($pengajuan) {
            $pengajuan->audit_status = $this->getAuditStatus($pengajuan);
        });

        return view('laporan.index',[
            'penugasanAuditors' => $penugasanAuditors,
            'currentPeriod' => $currentPeriod,
            'allPeriods' => $allPeriods,
        ]);
    }

        private function getAuditStatus($pengajuan)
    {
        // Check if pengajuan is approved
        if (!$pengajuan->is_disetujui) {
            return [
                'status' => 'not_approved',
                'label' => 'Belum Disetujui',
                'color' => 'secondary',
                'icon' => 'fas fa-clock'
            ];
        }

        // Check all approval fields for all auditors
        $allAuditorsCompleted = true;
        $anyAuditorInProgress = false;
        $anyAuditorStarted = false;

        foreach ($pengajuan->auditors as $auditor) {
            // Check if auditor has completed all stages - handle null values
            $isSetuju = (bool)$auditor->is_setuju;
            $isSetujuVisitasi = (bool)$auditor->is_setuju_visitasi;
            $isSetujuIndikatorProdi = (bool)$auditor->is_setuju_indikator_prodi;

            $auditorCompleted = $isSetuju && $isSetujuVisitasi && $isSetujuIndikatorProdi;
            $auditorInProgress = ($isSetuju || $isSetujuVisitasi || $isSetujuIndikatorProdi) && !$auditorCompleted; // Minimal satu field true tapi belum selesai
            $auditorStarted = $isSetuju || $isSetujuVisitasi || $isSetujuIndikatorProdi; // Minimal satu field true



            if ($auditorInProgress) {
                $anyAuditorInProgress = true;
            }

            if ($auditorStarted) {
                $anyAuditorStarted = true;
            }

            if (!$auditorCompleted) {
                $allAuditorsCompleted = false;
            }
        }



        if ($allAuditorsCompleted) {
            return [
                'status' => 'completed',
                'label' => 'Selesai',
                'color' => 'success',
                'icon' => 'fas fa-check-circle'
            ];
        } elseif ($anyAuditorStarted) {
            return [
                'status' => 'in_progress',
                'label' => 'Dalam Proses',
                'color' => 'warning',
                'icon' => 'fas fa-clock'
            ];
        } else {
            // If pengajuan is approved but no auditor has started (all is_setuju = false)
            return [
                'status' => 'not_started',
                'label' => 'Belum Mulai',
                'color' => 'secondary',
                'icon' => 'fas fa-hourglass-start'
            ];
        }
    }

    public function getFilteredData(Request $request)
    {
        $query = PengajuanAmi::with([
            'auditors.auditor',
            'auditee',
            'periodeAktif',
            'ikssAuditee.nilai'
        ])
        ->withCount(['auditors'])
        ->orderBy('created_at', 'desc');

        // Filter by period if specified, otherwise use current active period
        if ($request->filled('period')) {
            $periodeId = $request->period;
            $query->where('periode_id', $periodeId);
        } else {
            // Use current active period as default
            $currentPeriod = PeriodeAktif::whereNull('deleted_at')->first();
            if ($currentPeriod) {
                $query->where('periode_id', $currentPeriod->id);
            }
        }

        // Filter by search term if specified
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('auditee', function($subQ) use ($searchTerm) {
                    $subQ->where('nama_unit_kerja', 'like', '%' . $searchTerm . '%')
                         ->orWhere('fakultas', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('auditors.auditor', function($subQ) use ($searchTerm) {
                    $subQ->where('name', 'like', '%' . $searchTerm . '%');
                });
            });
        }

        $penugasanAuditors = $query->get();

        // Add audit status to each pengajuan
        $penugasanAuditors->each(function ($pengajuan) {
            $pengajuan->audit_status = $this->getAuditStatus($pengajuan);
        });

        return response()->json([
            'success' => true,
            'data' => $penugasanAuditors
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

        // Process each Sasaran Strategis - show all SS but data only for those with prodi elements
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;
            $hasProdiElements = $satuanStandar->has_prodi_elements;

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
                    'has_prodi_elements' => $hasProdiElements
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
                    'has_prodi_elements' => $hasProdiElements
                ]);
            }
        }

            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Get Evaluasi data for Auditee
        $evaluasiAuditee = \App\Models\Evaluasi::where('jenis_evaluasi', 'auditee')->get();
        $evaluasiSubmissionsAuditee = \App\Models\EvaluasiSubmission::where('pengajuan_ami_id', $id)
            ->where('jenis', 'auditee')
            ->get()
            ->keyBy('evaluasi_id');
        $evaluasiMasukanAuditee = \App\Models\EvaluasiMasukan::where('pengajuan_ami_id', $id)
            ->where('user_id', $pengajuan->auditee->user_id ?? null)
            ->first();

        // Get Evaluasi data for each Auditor (hanya ketua)
        $evaluasiAuditor = \App\Models\Evaluasi::where('jenis_evaluasi', 'auditor')->get();
        $auditorEvaluasiData = [];

        foreach ($pengajuanAmis->auditors as $auditor) {
            // Hanya ambil data evaluasi untuk ketua auditor
            if ($auditor->role == 'ketua') {
                $evaluasiSubmissions = \App\Models\EvaluasiSubmission::where('pengajuan_ami_id', $id)
                    ->where('jenis', 'auditor')
                    ->where('user_id', $auditor->user_id)
                    ->get()
                    ->keyBy('evaluasi_id');

                $evaluasiMasukan = \App\Models\EvaluasiMasukan::where('pengajuan_ami_id', $id)
                    ->where('user_id', $auditor->user_id)
                    ->first();

                $auditorEvaluasiData[] = [
                    'auditor' => $auditor->auditor,
                    'role' => $auditor->role,
                    'evaluasi_submissions' => $evaluasiSubmissions,
                    'evaluasi_masukan' => $evaluasiMasukan
                ];
            }
        }

        // Get Kuisioner data for ketua auditor yang bertugas mengaudit pengajuan_ami ini
        $kuisioners = \App\Models\Kuisioner::with(['opsis'])->get();
        $auditorKuisionerData = [];

        // Ambil penugasan auditor ketua yang bertugas mengaudit pengajuan_ami ini
        $activePenugasan = \App\Models\PenugasanAuditor::where('pengajuan_ami_id', $id)
            ->where('role', 'ketua')
            ->whereNull('deleted_at')
            ->first();

        if ($activePenugasan) {
            // Ambil jawaban kuisioner hanya dari ketua auditor yang bertugas mengaudit pengajuan_ami ini
            $allKuisionerJawaban = \App\Models\KuisionerJawaban::with(['kuisioner', 'opsi'])
                ->where('pengajuan_id', $id)
                ->where('penugasan_auditor_id', $activePenugasan->id)
                ->get();

            if ($allKuisionerJawaban->count() > 0) {
                $auditorKuisionerData[] = [
                    'auditor_id' => $activePenugasan->user_id,
                    'auditor_name' => $activePenugasan->auditor->name,
                    'role' => $activePenugasan->role,
                    'created_at' => $allKuisionerJawaban->first()->created_at,
                    'kuisioner_jawaban' => $allKuisionerJawaban->keyBy('kuisioner_id')
                ];
            }
        }

        return view('laporan.detail', [
            'periodeAktif' => $periodeAktif,
            'pengajuanAmis' => $pengajuanAmis,
            'sortedGrouped' => $sortedGrouped,
            'kriteriaScores' => $kriteriaScores,
            'evaluasiAuditee' => $evaluasiAuditee,
            'evaluasiSubmissionsAuditee' => $evaluasiSubmissionsAuditee,
            'evaluasiMasukanAuditee' => $evaluasiMasukanAuditee,
            'evaluasiAuditor' => $evaluasiAuditor,
            'auditorEvaluasiData' => $auditorEvaluasiData,
            'kuisioners' => $kuisioners,
            'auditorKuisionerData' => $auditorKuisionerData,
        ]);
    }

    public function daftarPertanyaan($id)
    {
        $pengajuan = PengajuanAmi::findOrFail($id);
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $pengajuanAmis = PengajuanAmi::with([
                            'auditee',
                            'auditors' => function ($query) {
                                $query->where('user_id', Auth::id());
                            },
                            'auditors.auditor.unitKerja',
                            'ikssAuditee' => function ($query) {
                                $query->where('status_target', true);
                            },
                            'ikssAuditee.visitasi'
                        ])->where('id', $pengajuan->id)->first();

        $data = [
            'periodeAktif' =>  $periodeAktif,
            'pengajuanAmis' =>  $pengajuanAmis
        ];
        $pdf = Pdf::loadView('cetak.daftar_pertanyaan', $data);
        return $pdf->stream('Daftar_Pertanyaan.pdf');
    }

    public function beritaAcara($id)
    {
        $pengajuan = PengajuanAmi::with(['auditee', 'auditors.auditor'])->findOrFail($id);
        $pdf = Pdf::loadView('cetak.berita_acara', [
            'pengajuan' => $pengajuan
        ]);
        return $pdf->stream('Berita_Acara_Audit.pdf');
    }

    public function evaluaSINTAMU($id)
    {
        $pengajuan = PengajuanAmi::with(['auditee', 'auditors.auditor', 'ikssAuditee'])->findOrFail($id);
        $pdf = Pdf::loadView('cetak.evaluasi_ami', [
            'pengajuan' => $pengajuan
        ]);
        return $pdf->stream('Evaluasi_AMI.pdf');
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

        // Process each Sasaran Strategis - only show those with prodi elements
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;
            $hasProdiElements = $satuanStandar->has_prodi_elements;

            // Skip SS that don't have prodi elements
            if (!$hasProdiElements) {
                continue;
            }

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
                    'has_data' => true
                ]);
            } else {
                // Add Sasaran Strategis with no data (but has prodi elements)
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
                    'has_data' => false
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
