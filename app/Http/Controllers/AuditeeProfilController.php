<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
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

    public function updateTtd(Request $request)
    {
        $request->validate([
            'ttd' => 'required|image|mimes:jpeg,jpg,png|max:350',
        ], [
            'ttd.required' => 'File tanda tangan wajib dipilih.',
            'ttd.image' => 'File harus berupa gambar.',
            'ttd.mimes' => 'Format tanda tangan harus JPG, JPEG, atau PNG.',
            'ttd.max' => 'Ukuran tanda tangan maksimal 350KB.',
        ]);

        $user = Auth::user();

        if ($request->hasFile('ttd')) {
            if ($user->ttd && Storage::disk('public')->exists($user->ttd)) {
                Storage::disk('public')->delete($user->ttd);
            }

            $ttdPath = $request->file('ttd')->store('ttd/auditee', 'public');
            $user->update(['ttd' => $ttdPath]);
        }

        return redirect()->route('auditee.dashboard')->with('success', 'Tanda tangan berhasil diunggah.');
    }

    public function deleteTtd()
    {
        $user = Auth::user();

        if ($user->ttd && Storage::disk('public')->exists($user->ttd)) {
            Storage::disk('public')->delete($user->ttd);
        }

        $user->update(['ttd' => null]);

        return redirect()->route('auditee.dashboard')->with('success', 'Tanda tangan berhasil dihapus.');
    }
}
