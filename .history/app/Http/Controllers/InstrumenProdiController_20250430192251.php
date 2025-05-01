<?php

namespace App\Http\Controllers;

use App\Models\InstrumenProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumenProdiController extends Controller
{
    public function index(){
        $instrumens = InstrumenProdi::with(['kriteriaInstrumen'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('instrumen_prodi.index',[
            'instrumens'    =>  $instrumens,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indikator_instrumen_id' => 'nullable|integer',
            'indikator_instrumen_kriteria_id' => 'nullable|integer',
            'element' => 'nullable|string',
            'indikator' => 'nullable|string',
            'sumber_data' => 'nullable|string',
            'metode_perhitungan' => 'nullable|string',
            'target' => 'nullable|string',
            'realisasi' => 'nullable|string',
            'standar_digunakan' => 'nullable|string',
            'uraian' => 'nullable|string',
            'penyebab_tidak_tercapai' => 'nullable|string',
            'rencana_perbaikan' => 'nullable|string',
            'indikator_penilaian' => 'nullable|string',
        ], [
            '*.integer' => ':attribute harus berupa angka.',
            '*.string' => ':attribute harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $indikator = new InstrumenProdi();
        $indikator->indikator_instrumen_id = $request->indikator_instrumen_id;
        $indikator->indikator_instrumen_kriteria_id = $request->indikator_instrumen_kriteria_id;
        $indikator->element = $request->element;
        $indikator->indikator = $request->indikator;
        $indikator->sumber_data = $request->sumber_data;
        $indikator->metode_perhitungan = $request->metode_perhitungan;
        $indikator->target = $request->target;
        $indikator->realisasi = $request->realisasi;
        $indikator->standar_digunakan = $request->standar_digunakan;
        $indikator->uraian = $request->uraian;
        $indikator->penyebab_tidak_tercapai = $request->penyebab_tidak_tercapai;
        $indikator->rencana_perbaikan = $request->rencana_perbaikan;
        $indikator->indikator_penilaian = $request->indikator_penilaian;
        $indikator->save();

        return response()->json([
            'message' => 'Indikator Instrumen berhasil ditambahkan!',
            'data' => $indikator
        ]);
    }

    public function edit(InstrumenProdi $indikator)
    {
        if (!$indikator) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $indikator]);
    }

    public function update(Request $request, InstrumenProdi $indikator)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string',
        ], [
            'nama_indikator.required' => 'Nama indikator harus diisi.',
            'nama_indikator.string' => 'Nama indikator harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $indikator->indikator_instrumen_id = $request->indikator_instrumen_id;
        $indikator->save();

        return response()->json([
            'message' => 'Indikator Instrumen berhasil diperbarui!',
            'data' => $indikator
        ]);
    }

    public function nonaktifkan(InstrumenProdi $indikator)
    {
        try {
            $indikator->delete();
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
            InstrumenProdi::whereIn('id', $ids)->delete();

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
        $indikator = InstrumenProdi::withTrashed()->findOrFail($id);
        $indikator->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Indikator Instrumen berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $indikator = InstrumenProdi::withTrashed()->findOrFail($id);

            if (!$indikator->trashed()) {
                return response()->json([
                    'message' => 'Indikator Instrumen belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $indikator->forceDelete();

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
