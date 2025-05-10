<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\SatuanStandar;
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
                    $subQuery->where('pengajuan_ami_id', $id->id);
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
                            $scoreValue = (float)$nilai->nilai;
                            $allScores->push($scoreValue);

                            // Cek apakah nilai ini dari ketua tim atau anggota berdasarkan penugasan
                            $isPenugasanKetua = false;
                            foreach ($nilai->auditor->penugasan as $penugasan) {
                                // Pastikan user_id di penugasan sama dengan id auditor yang memberikan nilai
                                // dan pengajuan_ami_id sama dengan id pengajuan yang sedang ditampilkan
                                if ($penugasan->pengajuan_ami_id == $id &&
                                    $penugasan->user_id == $nilai->auditor_id &&
                                    $penugasan->role == 'ketua') {
                                    $isPenugasanKetua = true;
                                    break;
                                }
                            }

                            if ($isPenugasanKetua) {
                                $ketuaScores->push($scoreValue);
                            } else {
                                $anggotaScores->push($scoreValue);
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

            $data = [
            'periodeAktif'   =>  $periodeAktif,
            'tujuans'   =>  $tujuans,
            'lingkupAudits'   =>  $lingkupAudits,
            'pengajuanAmis'   =>  $pengajuanAmis,
            'sortedGrouped'   =>  $sortedGrouped,
            'jawabanKuisioner'   =>  $jawabanKuisioner,
            ];
        return view('laporan.detail', [
            'laporan' => $laporan
        ]);
    }
}
