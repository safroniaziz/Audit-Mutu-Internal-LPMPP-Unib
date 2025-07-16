<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluasiController extends Controller
{
    public function index(){
        $evaluasis = Evaluasi::where('jenis_evaluasi','auditor')->get();
        return view('evaluasi.index',[
            'evaluasis'    =>  $evaluasis,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluasi' => 'required|string|max:100|unique:evaluasis,evaluasi',
            'jenis_evaluasi' => 'required|in:auditor,auditee',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $evaluasi = Evaluasi::create([
            'evaluasi' => $request->evaluasi,
            'jenis_evaluasi' => $request->jenis_evaluasi,
        ]);

        return response()->json([
            'message' => 'Unit Kerja berhasil ditambahkan!',
            'data' => $evaluasi
        ]);
    }

    public function edit(Evaluasi $evaluasi)
    {
        if (!$evaluasi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $evaluasi]);
    }

    public function update(Request $request, Evaluasi $evaluasi)
    {
        $validator = Validator::make($request->all(), [
            'evaluasi' => 'required|string|max:100|unique:evaluasis,evaluasi,'.$evaluasi->id,
            'jenis_evaluasi' => 'required|in:auditor,auditee',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $evaluasi->evaluasi = $request->evaluasi;
        $evaluasi->jenis_evaluasi = $request->jenis_evaluasi;
        $evaluasi->save();

        return response()->json([
            'message' => 'Unit Kerja berhasil diperbarui!',
            'data' => $evaluasi
        ]);
    }

    public function nonaktifkan(Evaluasi $evaluasi)
    {
        try {
            $evaluasi->delete();
            return response()->json([
                'message' => 'Unit Kerja berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Unit Kerja!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            UnitKerja::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Unit Kerja terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Unit Kerja terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $unitkerja = UnitKerja::withTrashed()->findOrFail($id);
        $unitkerja->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Unit Kerja berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $unitKerja = UnitKerja::withTrashed()->findOrFail($id);

            if (!$unitKerja->trashed()) {
                return response()->json([
                    'message' => 'Unit Kerja belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $unitKerja->forceDelete();

            return response()->json([
                'message' => 'Unit Kerja berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Unit Kerja permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
