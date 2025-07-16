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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeLaporanAmiController extends Controller
{
    public function index()
    {
        $pengajuanAmis = PengajuanAmi::with(['auditee', 'auditors.auditor.unitKerja'])
            ->where('auditee_id', Auth::user()->unit_kerja_id)
            ->where('is_disetujui', true)
            ->get();

        return view('auditee.laporan_ami.index', [
            'title' => 'Laporan AMI',
            'subtitle' => 'Lihat & Download Hasil Audit',
            'pengajuanAmis' => $pengajuanAmis
        ]);
    }

    public function unduhDokumen(PengajuanAmi $pengajuan)
    {
        $jawabanKuisioner = KuisionerJawaban::with(['kuisioner', 'opsi'])
            ->where('pengajuan_id', $pengajuan->id)
            ->get();

        $evaluasis = EvaluasiSubmission::where('pengajuan_ami_id', $pengajuan->id)
            ->get()
            ->keyBy('evaluasi_id');

        $evaluasiMasukan = EvaluasiMasukan::where('pengajuan_ami_id', $pengajuan->id)
            ->first();

        return view('auditee.laporan_ami.unduh_dokumen', [
            'pengajuan' => $pengajuan,
            'jawabanKuisioner' => $jawabanKuisioner,
            'evaluasis' => $evaluasis,
            'evaluasiMasukan' => $evaluasiMasukan
        ]);
    }

    public function beritaAcara(PengajuanAmi $pengajuan)
    {
        $data = [
            'pengajuan' => $pengajuan->load(['auditee', 'auditors.auditor.unitKerja'])
        ];

        $pdf = Pdf::loadView('auditee.laporan_ami.berita_acara', $data);
        return $pdf->stream('Berita_Acara_Audit.pdf');
    }

    public function evaluasiAmi(PengajuanAmi $pengajuan)
    {
        $evaluasis = EvaluasiSubmission::where('pengajuan_ami_id', $pengajuan->id)
            ->get()
            ->keyBy('evaluasi_id');

        $evaluasiMasukan = EvaluasiMasukan::where('pengajuan_ami_id', $pengajuan->id)
            ->first();

        $data = [
            'pengajuan' => $pengajuan->load(['auditee', 'auditors.auditor.unitKerja']),
            'evaluasis' => $evaluasis,
            'evaluasiMasukan' => $evaluasiMasukan
        ];

        $pdf = Pdf::loadView('auditee.laporan_ami.evaluasi', $data);
        return $pdf->stream('Evaluasi_AMI.pdf');
    }

    public function daftarPertanyaan(PengajuanAmi $pengajuan)
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        $pengajuanAmis = PengajuanAmi::with([
            'auditee',
            'auditors.auditor.unitKerja',
            'ikssAuditee' => function ($query) {
                $query->where('status_target', true);
            },
            'ikssAuditee.visitasi'
        ])->where('id', $pengajuan->id)->first();

        $data = [
            'periodeAktif' => $periodeAktif,
            'pengajuanAmis' => $pengajuanAmis
        ];

        $pdf = Pdf::loadView('auditee.laporan_ami.daftar_pertanyaan', $data);
        return $pdf->stream('Daftar_Pertanyaan.pdf');
    }

    public function laporanAmi(PengajuanAmi $pengajuan)
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $tujuans = Tujuan::all();
        $lingkupAudits = LingkupAudit::all();
        $allSatuanStandar = SatuanStandar::orderBy('kode_satuan')->get();

        $pengajuanAmis = PengajuanAmi::with([
            'ikssAuditee' => function ($query) {
                $query->where('status_target', true);
            },
            'ikssAuditee.nilai.auditor',
            'ikssAuditee.visitasi',
            'ikssAuditee.instrumen.indikatorKinerja.satuanStandar',
            'auditee',
            'auditors.auditor.unitKerja',
        ])->where('id', $pengajuan->id)->first();

        $ikssAuditeeCollection = collect($pengajuanAmis->ikssAuditee);
        $groupedBySatuanId = $ikssAuditeeCollection->groupBy(function ($ikssAuditee) {
            return $ikssAuditee->instrumen->indikatorKinerja->satuan_standar_id;
        });

        $sortedGrouped = collect();
        foreach ($allSatuanStandar as $satuanStandar) {
            $satuanStandarId = $satuanStandar->id;
            if ($groupedBySatuanId->has($satuanStandarId)) {
                $items = $groupedBySatuanId->get($satuanStandarId);
                $totalNilai = $items->sum(function ($item) {
                    return $item->nilai->sum('nilai');
                });
                $totalNilaiKetua = $items->sum(function ($item) {
                    return $item->nilai->where('is_ketua', true)->sum('nilai');
                });
                $totalNilaiAnggota = $items->sum(function ($item) {
                    return $item->nilai->where('is_ketua', false)->sum('nilai');
                });
                $jumlahPenilaian = $items->count();

                $sortedGrouped->push([
                    'satuan_standar_id' => $satuanStandarId,
                    'kode_satuan' => $satuanStandar->kode_satuan,
                    'sasaran' => $satuanStandar->sasaran,
                    'total_nilai' => $totalNilai,
                    'total_nilai_ketua' => $totalNilaiKetua,
                    'total_nilai_anggota' => $totalNilaiAnggota,
                    'rata_rata' => $jumlahPenilaian > 0 ? $totalNilai / $jumlahPenilaian : 0,
                    'jumlah_penilaian' => $jumlahPenilaian,
                    'items' => $items,
                    'has_data' => true
                ]);
            } else {
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
            'periodeAktif' => $periodeAktif,
            'tujuans' => $tujuans,
            'lingkupAudits' => $lingkupAudits,
            'pengajuanAmis' => $pengajuanAmis,
            'sortedGrouped' => $sortedGrouped
        ];

        $pdf = Pdf::loadView('auditee.laporan_ami.laporan', $data);
        return $pdf->stream('Laporan_AMI.pdf');
    }
}
