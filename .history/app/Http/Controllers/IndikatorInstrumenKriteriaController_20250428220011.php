<?php

namespace App\Http\Controllers;

use App\Models\IndikatorInstrumenKriteria;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class IndikatorInstrumenKriteriaKriteriaController extends Controller
{
    public function index(){
        $kriterias = IndikatorInstrumenKriteria::orderBy('created_at','desc')->withTrashed()->get();
        return view('indikator_instrumen.index',[
            'kriterias'    =>  $kriterias,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kriteria' => 'required|string',
        ], [
            'nama_kriteria.required' => 'Nama kriteria harus diisi.',
            'nama_kriteria.string' => 'Nama kriteria harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kriteria = IndikatorInstrumenKriteria::create([
            'indikator_instrumen_id' => $request->indikator_instrumen_id,
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
        ]);

        return response()->json([
            'message' => 'Kriteria Instrumen berhasil ditambahkan!',
            'data' => $kriteria
        ]);
    }

    public function edit(IndikatorInstrumenKriteria $indikator)
    {
        if (!$indikator) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $indikator]);
    }

    public function update(Request $request, IndikatorInstrumenKriteria $indikator)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string',
        ], [
            'nama_kriteria.required' => 'Nama kriteria harus diisi.',
            'nama_kriteria.string' => 'Nama kriteria harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $indikator->indikator_instrumen_id = $request->indikator_instrumen_id;
        $indikator->kode_kriteria = $request->kode_kriteria;
        $indikator->nama_kriteria = $request->nama_kriteria;
        $indikator->save();

        return response()->json([
            'message' => 'Kriteria Instrumen berhasil diperbarui!',
            'data' => $indikator
        ]);
    }

    public function nonaktifkan(IndikatorInstrumenKriteria $indikator)
    {
        try {
            $indikator->delete();
            return response()->json([
                'message' => 'Kriteria Instrumen berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kriteria Instrumen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            IndikatorInstrumenKriteria::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Kriteria Instrumen terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kriteria Instrumen terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $kriteria = IndikatorInstrumenKriteria::withTrashed()->findOrFail($id);
        $indikator->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Kriteria Instrumen berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $kriteria = IndikatorInstrumenKriteria::withTrashed()->findOrFail($id);

            if (!$kriteria->trashed()) {
                return response()->json([
                    'message' => 'Kriteria Instrumen belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $kriteria->forceDelete();

            return response()->json([
                'message' => 'Kriteria Instrumen berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kriteria Instrumen permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
