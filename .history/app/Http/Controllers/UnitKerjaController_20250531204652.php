<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitKerjaRequest;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitKerjaController extends Controller
{
    public function index(){
        $unitKerjas = UnitKerja::orderBy('created_at','desc')->withTrashed()->get();
        $fakultas = UnitKerja::where('jenis_unit_kerja','fakultas')->get();
        return view('unit_kerja.index',[
            'unitKerjas'    =>  $unitKerjas,
            'fakultas'    =>  $fakultas,
        ]);
    }

    public function store(UnitKerjaRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_unit_kerja' => 'required|string|max:10|unique:unit_kerjas,kode_unit_kerja',
            'nama_unit_kerja' => 'required|string|max:100',
            'jenis_unit_kerja' => 'required|in:fakultas,prodi,lembaga,upt',
            'jenjang' => 'in:D2,D3,D4,S1,S2,S3',
            'fakultas' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $unitKerja = UnitKerja::create([
            'kode_unit_kerja' => $request->kode_unit_kerja,
            'nama_unit_kerja' => $request->nama_unit_kerja,
            'jenis_unit_kerja' => $request->jenis_unit_kerja,
            'jenjang' => $request->jenjang,
            'fakultas' => $request->jenis_unit_kerja === 'fakultas' ? null : $request->fakultas
        ]);

        return response()->json([
            'message' => 'Unit Kerja berhasil ditambahkan!',
            'data' => $unitKerja
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
