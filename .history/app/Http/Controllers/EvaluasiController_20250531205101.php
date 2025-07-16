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

    public function edit(UnitKerja $unitKerja)
    {
        if (!$unitKerja) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $unitKerja]);
    }

    public function update(Request $request, UnitKerja $unitKerja)
    {
        $validator = Validator::make($request->all(), [
            'kode_unit_kerja' => 'required|string|max:10|unique:unit_kerjas,kode_unit_kerja,'.$unitKerja->id,
            'nama_unit_kerja' => 'required|string|max:100',
            'jenis_unit_kerja' => 'required|in:fakultas,prodi,lembaga,upt',
            'jenjang' => 'nullable|in:D2,D3,D4,S1,S2,S3',
            'fakultas' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $unitKerja->kode_unit_kerja = $request->kode_unit_kerja;
        $unitKerja->nama_unit_kerja = $request->nama_unit_kerja;
        $unitKerja->jenis_unit_kerja = $request->jenis_unit_kerja;
        $unitKerja->jenjang = $request->jenjang;
        $unitKerja->fakultas = $request->jenis_unit_kerja === 'fakultas' ? null : $request->fakultas;
        $unitKerja->save();

        return response()->json([
            'message' => 'Unit Kerja berhasil diperbarui!',
            'data' => $unitKerja
        ]);
    }

    public function nonaktifkan(UnitKerja $unitKerja)
    {
        try {
            $unitKerja->delete();
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
