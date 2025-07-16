<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ami;
use App\Models\Siklus;
use Illuminate\Support\Facades\Storage;

class LaporanAmiController extends Controller
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

    public function download($id)
    {
        $ami = Ami::findOrFail($id);

        if (!$ami) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan');
        }

        $path = storage_path('app/public/' . $ami->file_laporan);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }
}
