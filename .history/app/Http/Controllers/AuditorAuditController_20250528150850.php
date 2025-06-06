<?php

namespace App\Http\Controllers;

use App\Models\IkssAuditee;
use App\Models\IkssAuditeeNilai;
use App\Models\IkssAuditeeVisitasi;
use App\Models\Kuisioner;
use App\Models\KuisionerJawaban;
use App\Models\LingkupAudit;
use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\PeriodeAktif;
use App\Models\SatuanStandar;
use App\Models\Tujuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuditorAuditController extends Controller
{
    public function daftarAuditee(){
        $auditess = PengajuanAmi::with(['auditors', 'auditee'])
                    ->whereHas('auditors', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->get();
        return view('dataauditor.daftar_auditee',[
            'auditess'  =>  $auditess
        ]);
    }

    public function perjanjianKinerja(PengajuanAmi $pengajuan){
        $auditess = PengajuanAmi::with(['auditors', 'auditee','perjanjianKinerja'])
                    ->where('id',$pengajuan->id)
                    ->first();
        return view('dataauditor.daftar_auditee',[
            'auditess'  =>  $auditess
        ]);
    }

    public function deskEvaluation(PengajuanAmi $pengajuan)
    {
        $dataIkss = IkssAuditee::with(['instrumen.indikatorKinerja'])
                        ->where('auditee_id', $pengajuan->auditee_id)
                        ->where('periode_id', $pengajuan->periode_id)
                        ->where('status_target', true)
                        ->get();

        $penugasanAuditor = PengajuanAmi::with(['auditors'])->where('id', $pengajuan->id)->first();
        $auditor = $penugasanAuditor->auditors
                    ->first(function ($auditor) {
                        return $auditor->user_id === Auth::id() && $auditor->is_setuju;
                    });
        $setuju = false;

        if ($auditor) {
            $setuju = true;
        }

        $deskEvaluation = IkssAuditeeNilai::where('pengajuan_ami_id', $pengajuan->id)
                            ->where('auditor_id', Auth::user()->id)
                            ->get()
                            ->keyBy('ikss_auditee_id');

        return view('dataauditor.desk_evaluation', [
            'pengajuan' => $pengajuan,
            'dataIkss' => $dataIkss,
            'setuju' => $setuju,
            'deskEvaluation' => $deskEvaluation ?? collect()
        ]);
    }

    public function submitDeskEvaluation(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'pengajuan_id' => 'required|exists:pengajuan_amis,id',
            'ikss_auditee_ids' => 'required|array',
            'ikss_auditee_ids.*' => 'required|exists:ikss_auditees,id',
            'pertanyaan' => 'required|array',
            'pertanyaan.*' => 'required|string',
            'deskripsi' => 'required|array',
            'deskripsi.*' => 'required|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|string'
        ], [
            'pengajuan_id.required' => 'ID Pengajuan harus diisi',
            'pengajuan_id.exists' => 'ID Pengajuan tidak valid',
            'ikss_auditee_ids.required' => 'Data IKSS harus ada',
            'ikss_auditee_ids.array' => 'Format data IKSS tidak valid',
            'ikss_auditee_ids.*.required' => 'ID IKSS tidak boleh kosong',
            'ikss_auditee_ids.*.exists' => 'ID IKSS tidak valid',
            'pertanyaan.required' => 'Deskripsi penilaian harus diisi',
            'pertanyaan.array' => 'Format deskripsi penilaian tidak valid',
            'pertanyaan.*.required' => 'Deskripsi penilaian tidak boleh kosong',
            'deskripsi.required' => 'Pertanyaan harus diisi',
            'deskripsi.array' => 'Format pertanyaan tidak valid',
            'deskripsi.*.required' => 'Pertanyaan tidak boleh kosong',
            'nilai.required' => 'Nilai harus diisi',
            'nilai.array' => 'Format nilai tidak valid',
            'nilai.*.required' => 'Nilai tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            $pengajuanId = $request->pengajuan_id;
            $auditorId = Auth::user()->id;

            foreach ($request->ikss_auditee_ids as $ikssAuditeeId) {
                // Cek apakah auditor ini sudah mengevaluasi IKSS ini
                $existingEvaluation = IkssAuditeeNilai::where('pengajuan_ami_id', $pengajuanId)
                    ->where('ikss_auditee_id', $ikssAuditeeId)
                    ->where('auditor_id', $auditorId)
                    ->first();

                if (!$existingEvaluation) {
                    // Simpan data evaluasi baru
                    IkssAuditeeNilai::create([
                        'pengajuan_ami_id' => $pengajuanId,
                        'ikss_auditee_id' => $ikssAuditeeId,
                        'auditor_id' => $auditorId,
                        'deskripsi' => $request->deskripsi[$ikssAuditeeId],
                        'pertanyaan' => $request->pertanyaan[$ikssAuditeeId],
                        'nilai' => $request->nilai[$ikssAuditeeId] ?? null
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Evaluasi berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approveDeskEvaluation(PengajuanAmi $pengajuan)
    {
        // Ambil pengajuan dengan relasi auditors
        $penugasanAuditor = PengajuanAmi::with(['auditors'])->where('id', $pengajuan->id)->first();

        // Cek apakah ada auditor yang sesuai dengan user yang sedang login
        $auditor = $penugasanAuditor->auditors->firstWhere('user_id', Auth::user()->id);

        if ($auditor) {
            // Update kolom 'is_setujui' menjadi true
            $auditor->update([
                'is_setuju' => true,
            ]);
        }

        return redirect()->back()->with('success', 'Desk Evaluation berhasil disetujui.');
    }

    public function visitasi(PengajuanAmi $pengajuan)
    {
        // Load IKSS data with all necessary relationships
        $dataIkss = IkssAuditee::with(['instrumen.indikatorKinerja.satuanStandar'])
                        ->where('auditee_id', $pengajuan->auditee_id)
                        ->where('periode_id', $pengajuan->periode_id)
                        ->where('status_target', true)
                        ->get();

        // Group by Satuan Standar first
        $groupedIkss = $dataIkss->groupBy(function($item) {
            return $item->instrumen->indikatorKinerja->satuanStandar->id;
        });

        // Get visitasi data
        $visitasi = IkssAuditeeVisitasi::where('pengajuan_ami_id', $pengajuan->id)
                        ->where('auditor_id', Auth::id())
                        ->get()
                        ->keyBy('ikss_auditee_id');

        // Check if auditor has approved
        $penugasanAuditor = PengajuanAmi::with(['auditors'])->where('id', $pengajuan->id)->first();
        $auditor = $penugasanAuditor->auditors
                    ->first(function ($auditor) {
                        return $auditor->user_id === Auth::id() && $auditor->is_setuju_visitasi;
                    });
        $setuju = false;

        if ($auditor) {
            $setuju = true;
        }

        // Debug statements

        return view('dataauditor.visitasi', [
            'pengajuan' => $pengajuan,
            'dataIkss' => $dataIkss,
            'groupedIkss' => $groupedIkss,
            'setuju' => $setuju,
            'visitasi' => $visitasi ?? collect()
        ]);
    }

    public function submitVisitasi(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'pengajuan_id' => 'required|exists:pengajuan_amis,id',
            'ikss_auditee_ids' => 'required|array',
            'ikss_auditee_ids.*' => 'required|exists:ikss_auditees,id',
            'ketidak_sesuaian' => 'required|array',
            'ketidak_sesuaian.*' => 'required|string',
            'pernyataan' => 'required|array',
            'pernyataan.*' => 'required|string',
            'kelebihan' => 'required|array',
            'kelebihan.*' => 'required|string',
            'peluang_peningkatan' => 'required|array',
            'peluang_peningkatan.*' => 'required|string'
        ], [
            'pengajuan_id.required' => 'ID Pengajuan harus diisi.',
            'pengajuan_id.exists' => 'ID Pengajuan tidak valid.',

            'ikss_auditee_ids.required' => 'Data IKSS harus diisi.',
            'ikss_auditee_ids.array' => 'Format data IKSS tidak valid.',
            'ikss_auditee_ids.*.required' => 'ID IKSS tidak boleh kosong.',
            'ikss_auditee_ids.*.exists' => 'ID IKSS tidak valid.',

            'ketidak_sesuaian.required' => 'Data ketidaksesuaian harus diisi.',
            'ketidak_sesuaian.array' => 'Format data ketidaksesuaian tidak valid.',
            'ketidak_sesuaian.*.required' => 'Setiap ketidaksesuaian harus diisi.',

            'pernyataan.required' => 'Pernyataan harus diisi.',
            'pernyataan.array' => 'Format pernyataan tidak valid.',
            'pernyataan.*.required' => 'Setiap pernyataan harus diisi.',

            'kelebihan.required' => 'Kelebihan harus diisi.',
            'kelebihan.array' => 'Format kelebihan tidak valid.',
            'kelebihan.*.required' => 'Setiap kelebihan harus diisi.',

            'peluang_peningkatan.required' => 'Peluang peningkatan harus diisi.',
            'peluang_peningkatan.array' => 'Format peluang peningkatan tidak valid.',
            'peluang_peningkatan.*.required' => 'Setiap peluang peningkatan harus diisi.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            $pengajuanId = $request->pengajuan_id;
            $auditorId = Auth::user()->id;

            foreach ($request->ikss_auditee_ids as $ikssAuditeeId) {
                // Cek apakah auditor ini sudah mengevaluasi IKSS ini
                $existingEvaluation = IkssAuditeeVisitasi::where('pengajuan_ami_id', $pengajuanId)
                    ->where('ikss_auditee_id', $ikssAuditeeId)
                    ->where('auditor_id', $auditorId)
                    ->first();

                if (!$existingEvaluation) {
                    // Simpan data evaluasi baru
                    IkssAuditeeVisitasi::create([
                        'pengajuan_ami_id' => $pengajuanId,
                        'ikss_auditee_id' => $ikssAuditeeId,
                        'auditor_id' => $auditorId,
                        'ketidak_sesuaian' => $request->ketidak_sesuaian[$ikssAuditeeId],
                        'pernyataan' => $request->pernyataan[$ikssAuditeeId],
                        'kelebihan' => $request->kelebihan[$ikssAuditeeId] ?? null,
                        'peluang_peningkatan' => $request->peluang_peningkatan[$ikssAuditeeId] ?? null
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Evaluasi berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approveVisitasi(PengajuanAmi $pengajuan)
    {
        // Ambil pengajuan dengan relasi auditors
        $penugasanAuditor = PengajuanAmi::with(['auditors'])->where('id', $pengajuan->id)->first();

        // Cek apakah ada auditor yang sesuai dengan user yang sedang login
        $auditor = $penugasanAuditor->auditors->firstWhere('user_id', Auth::user()->id);

        if ($auditor) {
            // Update kolom 'is_setujui' menjadi true
            $auditor->update([
                'is_setuju_visitasi' => true,
            ]);
        }

        return redirect()->back()->with('success', 'Desk Evaluation berhasil disetujui.');
    }

    public function unduhDokumen(PengajuanAmi $pengajuan){
        $jawabanKuisioner = KuisionerJawaban::with(['kuisioner', 'opsi'])
                        ->where('pengajuan_id', $pengajuan->id)
                        ->get();
        $kuisioners = Kuisioner::with(['opsis'])->get();
        return view('dataauditor.unduh_dokumen',[
            'pengajuan' =>  $pengajuan,
            'kuisioners' =>  $kuisioners,
            'jawabanKuisioner' =>  $jawabanKuisioner,
        ]);
    }

    public function beritaAcara(Request $request, PengajuanAmi $pengajuan)
    {
        // $data = [];
        // $pdf = PDF::loadView('pdf.berita-acara', $data);
        // return $pdf->download('Berita_Acara_Audit.pdf');
        $pdf = Pdf::loadView('dataauditor.pdf.berita_acara');
        return $pdf->stream('Berita_Acara_Audit.pdf');
    }

    public function evaluasiAmi()
    {
        $pdf = Pdf::loadView('dataauditor.pdf.evaluasi_ami');
        return $pdf->stream('Evaluasi_Ami.pdf');
    }

    public function daftarPertanyaan(PengajuanAmi $pengajuan)
    {
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
        $pdf = PDF::loadView('dataauditor.pdf.daftar_pertanyaan', $data);
        return $pdf->stream('Daftar_Pertanyaan.pdf');
    }

    public function laporanAmi(Request $request, PengajuanAmi $pengajuan)
    {
        $jawabanKuisioner = KuisionerJawaban::with(['kuisioner', 'opsi'])
                                            ->where('pengajuan_id', $pengajuan->id)
                                            ->get();

        if ($jawabanKuisioner->isEmpty()) {
            // Jika belum ada jawaban, lakukan validasi
            $request->validate([
                'jawaban' => 'required|array',
                'jawaban.*' => 'required|exists:kuisioner_opsis,id',
            ]);
        }

        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $tujuans = Tujuan::all();
        $lingkupAudits = LingkupAudit::all();

        $allSatuanStandar = SatuanStandar::orderBy('kode_satuan')->get();

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

        $ikssAuditeeCollection = collect($pengajuanAmis->ikssAuditee);
        $groupedBySatuanId = $ikssAuditeeCollection->groupBy(function ($ikssAuditee) {
            return $ikssAuditee->instrumen->indikatorKinerja->satuan_standar_id;
        });

        // Initialize results array
        $sortedGrouped = collect();

        // Process each Satuan Standar
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;

            // Check if this Satuan Standar has audit data
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
                // Add Satuan Standar with no data
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

        $penugasanAuditor = PenugasanAuditor::where('pengajuan_ami_id',$pengajuan->id)
                                            ->where('user_id',Auth::user()->id)
                                            ->first();

        if ($jawabanKuisioner->isEmpty()) {
            foreach ($request->jawaban as $kuisionerId => $opsiId) {
                KuisionerJawaban::updateOrCreate(
                    [
                        'pengajuan_id' => $pengajuan->id,
                        'kuisioner_id' => $kuisionerId,
                        'kuisioner_opsi_id' => $opsiId,
                        'penugasan_auditor_id' => $penugasanAuditor->id,
                    ],
                    [
                        'pengajuan_id' => $pengajuan->id,
                        'kuisioner_id' => $kuisionerId,
                        'kuisioner_opsi_id' => $opsiId,
                        'penugasan_auditor_id' => $penugasanAuditor->id,
                    ]
                );
            }
        }

        $data = [
            'periodeAktif'   =>  $periodeAktif,
            'tujuans'   =>  $tujuans,
            'lingkupAudits'   =>  $lingkupAudits,
            'pengajuanAmis'   =>  $pengajuanAmis,
            'sortedGrouped'   =>  $sortedGrouped,
            'jawabanKuisioner'   =>  $jawabanKuisioner,
        ];
        $pdf = PDF::loadView('dataauditor.pdf.laporan_ami', $data);
        return $pdf->stream('Laporan_AMI.pdf');
    }
}
