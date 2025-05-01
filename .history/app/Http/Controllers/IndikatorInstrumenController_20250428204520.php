<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitKerjaRequest;
use App\Models\IndikatorInstrumen;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndikatorInstrumenController extends Controller
{
    public function index(){
        $indikators = IndikatorInstrumen::orderBy('created_at','desc')->withTrashed()->get();
        return view('indikator_instrumen.index',[
            'indikators'    =>  $indikators,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $unitKerja = IndikatorInstrumen::create([
            'nama_indikator' => $request->kode_unit_kerja,
        ]);

        return response()->json([
            'message' => 'Indikator Instrumen berhasil ditambahkan!',
            'data' => $unitKerja
        ]);
    }

    public function edit(UnitKerja $indikator)
    {
        if (!$unitKerja) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $unitKerja]);
    }

    public function update(Request $request, UnitKerja $indikator)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $unitKerja->nama_indikator = $request->kode_unit_kerja;
        $unitKerja->save();

        return response()->json([
            'message' => 'Indikator Instrumen berhasil diperbarui!',
            'data' => $unitKerja
        ]);
    }

    public function nonaktifkan(UnitKerja $indikator)
    {
        try {
            $unitKerja->delete();
            return response()->json([
                'message' => 'Indikator Instrumen berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            IndikatorInstrumen::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Indikator Instrumen terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $unitkerja = IndikatorInstrumen::withTrashed()->findOrFail($id);
        $unitkerja->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Indikator Instrumen berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $unitKerja = IndikatorInstrumen::withTrashed()->findOrFail($id);

            if (!$unitKerja->trashed()) {
                return response()->json([
                    'message' => 'Indikator Instrumen belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $unitKerja->forceDelete();

            return response()->json([
                'message' => 'Indikator Instrumen berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
