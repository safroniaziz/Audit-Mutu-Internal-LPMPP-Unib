<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ZipArchive;

class AuditorProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        $dokumenAmis = DokumenAmi::where('kategori_dokumen','auditor')->orderBy('created_at','desc')->get();
        return view('dataauditor.dashboard', compact('periodeAktif', 'jadwalData','dokumenAmis'));
    }

    public function downloadAllFiles()
    {
        $dokumenAmis = DokumenAmi::where('kategori_dokumen', 'umum')->get();

        $zipFileName = 'dokumen_ami_all.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($dokumenAmis as $dokumen) {
                $filePath = storage_path('app/public/' . $dokumen->file_dokumen);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            abort(500, 'Gagal membuat file zip');
        }
    }
}
