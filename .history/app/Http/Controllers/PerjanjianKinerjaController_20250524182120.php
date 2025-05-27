<?php

namespace App\Http\Controllers;

use App\Models\PerjanjianKinerja;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PerjanjianKinerjaController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', Auth::user()->unit_kerja_id)
            ->where('periode_id', $periodeAktif->id)
            ->first();

        return view('auditee.perjanjian-kinerja.index', [
            'perjanjianKinerja' => $perjanjianKinerja
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240'
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.file' => 'File harus berupa dokumen.',
            'file.mimes' => 'Format file harus PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 10MB.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $file = $request->file('file');
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

            // Delete existing file if any
            $existingFile = PerjanjianKinerja::where('auditee_id', Auth::user()->unit_kerja_id)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            if ($existingFile) {
                if (Storage::exists('public/' . $existingFile->file_path)) {
                    Storage::delete('public/' . $existingFile->file_path);
                }
                $existingFile->delete();
            }

            // Store new file
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('perjanjian_kinerja', 'public');
            $fileSize = $file->getSize();

            PerjanjianKinerja::create([
                'periode_id' => $periodeAktif->id,
                'auditee_id' => Auth::user()->unit_kerja_id,
                'nama_file' => $fileName,
                'file_path' => $filePath,
                'size' => $fileSize
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File berhasil diunggah.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function download(PerjanjianKinerja $perjanjianKinerja)
    {
        if ($perjanjianKinerja->auditee_id !== Auth::user()->unit_kerja_id) {
            abort(403);
        }

        if (!Storage::exists('public/' . $perjanjianKinerja->file_path)) {
            abort(404);
        }

        return response()->download(storage_path('app/public/' . $perjanjianKinerja->file_path));
    }

    public function destroy(PerjanjianKinerja $perjanjianKinerja)
    {
        if ($perjanjianKinerja->auditee_id !== Auth::user()->unit_kerja_id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus file ini.'
            ], 403);
        }

        try {
            if (Storage::exists('public/' . $perjanjianKinerja->file_path)) {
                Storage::delete('public/' . $perjanjianKinerja->file_path);
            }

            $perjanjianKinerja->delete();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
