<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;
use ZipArchive;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        
        // Debug: lihat semua jadwal yang ada
        $allJadwal = $periodeAktif ? $periodeAktif->jadwal()->get() : collect();
        
        // Debug: lihat data jadwal yang digunakan
        if ($jadwalData) {
            \Log::info('Jadwal Data Found:', [
                'id' => $jadwalData->id,
                'jenis' => $jadwalData->jenis,
                'waktu_mulai' => $jadwalData->waktu_mulai,
                'waktu_selesai' => $jadwalData->waktu_selesai,
                'waktu_mulai_formatted' => $jadwalData->waktu_mulai ? \Carbon\Carbon::parse($jadwalData->waktu_mulai)->format('d F Y pukul H:i') : null,
                'waktu_selesai_formatted' => $jadwalData->waktu_selesai ? \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('d F Y pukul H:i') : null,
            ]);
        } else {
            \Log::info('Jadwal Data Not Found for Periode:', [
                'periode_id' => $periodeAktif ? $periodeAktif->id : null,
                'all_jadwal' => $allJadwal->toArray()
            ]);
        }
        
        $dokumenAmis = DokumenAmi::where('kategori_dokumen','auditee')->orderBy('created_at','desc')->get();
        return view('auditee.dashboard', compact('periodeAktif', 'jadwalData','dokumenAmis'));
    }

    public function downloadAllFiles()
    {
        $dokumenAmis = DokumenAmi::where('kategori_dokumen', 'auditee')->get();

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

            // Direct download - metode paling sederhana dan paling reliable
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Gagal membuat file zip'], 500);
        }
    }
}
