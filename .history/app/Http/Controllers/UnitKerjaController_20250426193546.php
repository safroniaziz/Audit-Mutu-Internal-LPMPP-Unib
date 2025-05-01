<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitKerjaRequest;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitKerjaController extends Controller
{
    public function index(){
        $unitKerjas = UnitKerja::orderBy('created_at','desc')->get();
        return view('unit_kerja.index',[
            'unitKerjas'    =>  $unitKerjas,
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

    public function destroy(UnitKerja $unitKerja)
    {
        $unitKerja->delete();

        return response()->json([
            'message' => 'Unit Kerja berhasil dihapus!'
        ]);
    }
}
