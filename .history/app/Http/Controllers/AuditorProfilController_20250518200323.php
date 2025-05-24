<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
        $dokumenAmis = DokumenAmi::where('kategori_dokumen', 'auditor')->get();

        if ($dokumenAmis->isEmpty()) {
            return response()->json(['error' => 'Tidak ada dokumen yang tersedia'], 404);
        }

        $zipFileName = 'dokumen_ami_' . date('Y-m-d-His') . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $totalFiles = 0;

            foreach ($dokumenAmis as $dokumen) {
                $filePath = storage_path('app/public/' . $dokumen->file_dokumen);
                if (file_exists($filePath)) {
                    // Pastikan nama file di dalam ZIP tidak duplikat dengan menambahkan prefix
                    $fileNameInZip = $dokumen->id . '_' . basename($filePath);
                    $zip->addFile($filePath, $fileNameInZip);
                    $totalFiles++;
                }
            }

            $zip->close();

            if ($totalFiles === 0) {
                // Hapus file ZIP kosong jika tidak ada file yang dimasukkan
                @unlink($zipFilePath);
                return response()->json(['error' => 'Tidak ada file yang dapat diunduh'], 404);
            }

            // Streaming download untuk file besar
            return new StreamedResponse(function() use ($zipFilePath) {
                $stream = fopen($zipFilePath, 'rb');
                fpassthru($stream);
                fclose($stream);
                @unlink($zipFilePath); // Hapus file setelah diunduh
            }, 200, [
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="' . basename($zipFilePath) . '"',
                'Content-Length' => filesize($zipFilePath),
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        } else {
            return response()->json(['error' => 'Gagal membuat file zip'], 500);
        }
    }
}
