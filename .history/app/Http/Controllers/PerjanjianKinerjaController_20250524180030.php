<?php

namespace App\Http\Controllers;

use App\Models\PerjanjianKinerja;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerjanjianKinerjaController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', Auth::user()->unit_kerja_id)
            ->where('periode_id', $periodeAktif->id)
            ->first();

        return view('auditee.perjanjian-kinerja.index', [
            'periodeAktif' => $periodeAktif,
            'perjanjianKinerja' => $perjanjianKinerja
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:10240', // Max 10MB
        ], [
            'file.required' => 'File Perjanjian Kinerja wajib diunggah',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX',
            'file.max' => 'Ukuran file maksimal 10MB'
        ]);

        try {
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

            // Store the file
            $file = $request->file('file');
            $fileName = 'perjanjian_kinerja_' . Auth::user()->unit_kerja_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('perjanjian_kinerja', $fileName, 'public');

            // Create or update record
            PerjanjianKinerja::updateOrCreate(
                [
                    'auditee_id' => Auth::user()->unit_kerja_id,
                    'periode_id' => $periodeAktif->id,
                ],
                [
                    'file_path' => $path,
                    'nama_file' => $file->getClientOriginalName(),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Perjanjian Kinerja berhasil diunggah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $perjanjianKinerja = PerjanjianKinerja::findOrFail($id);

            // Check if user is authorized
            if ($perjanjianKinerja->auditee_id !== Auth::user()->unit_kerja_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menghapus file ini'
                ], 403);
            }

            // Delete file from storage
            if (Storage::disk('public')->exists($perjanjianKinerja->file_path)) {
                Storage::disk('public')->delete($perjanjianKinerja->file_path);
            }

            // Delete record
            $perjanjianKinerja->delete();

            return response()->json([
                'success' => true,
                'message' => 'Perjanjian Kinerja berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $perjanjianKinerja = PerjanjianKinerja::findOrFail($id);

            // Check if user is authorized
            if ($perjanjianKinerja->auditee_id !== Auth::user()->unit_kerja_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengunduh file ini'
                ], 403);
            }

            // Check if file exists
            if (!Storage::disk('public')->exists($perjanjianKinerja->file_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan'
                ], 404);
            }

            return Storage::disk('public')->download(
                $perjanjianKinerja->file_path,
                $perjanjianKinerja->nama_file
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
