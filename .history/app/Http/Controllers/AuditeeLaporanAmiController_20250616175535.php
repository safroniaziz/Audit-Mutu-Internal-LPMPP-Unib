<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuditeeLaporanAmiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan AMI',
            'subtitle' => 'Lihat & Download Hasil Audit',
            'amis' => Ami::where('status', 'selesai')->get()
        ];

        return view('auditee.laporan_ami.index', $data);
    }

    public function unduhDokumen($pengajuan)
    {
        $ami = Ami::findOrFail($pengajuan);

        if (!$ami) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan');
        }

        $path = storage_path('app/public/' . $ami->file_laporan);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }

    public function beritaAcara($pengajuan)
    {
        $ami = Ami::findOrFail($pengajuan);
        $data = [
            'title' => 'Berita Acara',
            'ami' => $ami
        ];

        return view('auditee.laporan_ami.berita_acara', $data);
    }

    public function evaluasiAmi($pengajuan)
    {
        $ami = Ami::findOrFail($pengajuan);
        $data = [
            'title' => 'Evaluasi AMI',
            'ami' => $ami
        ];

        return view('auditee.laporan_ami.evaluasi', $data);
    }

    public function daftarPertanyaan($pengajuan)
    {
        $ami = Ami::findOrFail($pengajuan);
        $data = [
            'title' => 'Daftar Pertanyaan',
            'ami' => $ami
        ];

        return view('auditee.laporan_ami.daftar_pertanyaan', $data);
    }

    public function laporanAmi($pengajuan)
    {
        $ami = Ami::findOrFail($pengajuan);
        $data = [
            'title' => 'Laporan AMI',
            'ami' => $ami
        ];

        return view('auditee.laporan_ami.laporan', $data);
    }
}
