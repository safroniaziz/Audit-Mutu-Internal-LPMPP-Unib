<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PeriodeAktif;
use App\Models\SatuanStandar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanHasilAuditController extends Controller
{
    public function index(){
        $penugasanAuditors = PengajuanAmi::with(['auditors','auditee','ikssAuditee.nilai'])
                                ->withCount(['auditors'])->orderBy('created_at','desc')->get();
        return view('laporan.index',[
            'penugasanAuditors'    =>  $penugasanAuditors,
        ]);
    }

    public function show($id)
    {
        $allSatuanStandar = SatuanStandar::orderBy('kode_satuan')->get();

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

            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        return view('laporan.detail', [
            'periodeAktif' => $periodeAktif,
            'pengajuanAmis' => $pengajuanAmis,
            'sortedGrouped' => $sortedGrouped,
        ]);
    }

    public function daftarPertanyaan($id)
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $pengajuanAmis = PengajuanAmi::with([
                            'auditee',
                            'auditors.auditor.unitKerja',
                            'ikssAuditee' => function ($query) {
                                $query->where('status_target', true);
                            },
                            'ikssAuditee.visitasi'
                        ])->where('id', $id)->first();

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

    public function evaluasiAmi($id)
    {
        $pengajuan = PengajuanAmi::with(['auditee', 'auditors.auditor', 'ikssAuditee'])->findOrFail($id);
        $pdf = Pdf::loadView('cetak.evaluasi_ami', [
            'pengajuan' => $pengajuan
        ]);
        return $pdf->stream('Evaluasi_AMI.pdf');
    }

    public function laporanAmi($id)
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $pengajuan = PengajuanAmi::with([
            'auditee',
            'auditors.auditor',
            'ikssAuditee' => function ($query) {
                $query->whereHas('nilai', function ($q) {
                    $q->whereNotNull('nilai');
                });
            },
            'ikssAuditee.nilai.auditor.penugasan' => function ($query) use ($id) {
                $query->where('pengajuan_ami_id', $id)
                    ->whereIn('role', ['ketua', 'pendamping']);
            }
        ])->findOrFail($id);

        $pdf = Pdf::loadView('cetak.laporan_ami', [
            'pengajuan' => $pengajuan,
            'periodeAktif' => $periodeAktif
        ]);
        return $pdf->stream('Laporan_AMI.pdf');
    }
}
