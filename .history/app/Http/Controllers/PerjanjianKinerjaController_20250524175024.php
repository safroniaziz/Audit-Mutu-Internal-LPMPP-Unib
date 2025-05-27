<?php

namespace App\Http\Controllers;

use App\Models\PerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PerjanjianKinerjaController extends Controller
{
    public function index()
    {
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', Auth::id())
            ->latest()
            ->first();

        return view('auditee.perjanjian-kinerja.index', compact('perjanjianKinerja'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
            'periode_id' => 'required|exists:periode_aktifs,id'
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('perjanjian-kinerja', $fileName, 'public');

        // Delete old file if exists
        $oldFile = PerjanjianKinerja::where('auditee_id', Auth::id())
            ->where('periode_id', $request->periode_id)
            ->first();

        if ($oldFile) {
            Storage::disk('public')->delete($oldFile->path);
            $oldFile->delete();
        }

        PerjanjianKinerja::create([
            'periode_id' => $request->periode_id,
            'auditee_id' => Auth::id(),
            'nama_file' => $fileName,
            'path' => $path,
            'size' => $file->getSize()
        ]);

        return redirect()->back()->with('success', 'Perjanjian Kinerja berhasil diunggah');
    }

    public function destroy($id)
    {
        $perjanjianKinerja = PerjanjianKinerja::findOrFail($id);

        if ($perjanjianKinerja->auditee_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus file ini');
        }

        Storage::disk('public')->delete($perjanjianKinerja->path);
        $perjanjianKinerja->delete();

        return redirect()->back()->with('success', 'Perjanjian Kinerja berhasil dihapus');
    }

    public function download($id)
    {
        $perjanjianKinerja = PerjanjianKinerja::findOrFail($id);

        if ($perjanjianKinerja->auditee_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengunduh file ini');
        }

        return Storage::disk('public')->download($perjanjianKinerja->path, $perjanjianKinerja->nama_file);
    }
}
