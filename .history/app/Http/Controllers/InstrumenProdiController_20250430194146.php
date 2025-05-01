<?php

namespace App\Http\Controllers;

use App\Models\IndikatorInstrumen;
use App\Models\InstrumenProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumenProdiController extends Controller
{
    public function index(){
        $indikators = IndikatorInstrumen::all();
        $instrumens = InstrumenProdi::with(['kriteriaInstrumen'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('instrumen_prodi.index',[
            'instrumens'    =>  $instrumens,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indikator_instrumen_id' => 'required|exists:indikator_instrumens,id',
            'indikator_instrumen_kriteria_id' => 'required|exists:indikator_instrumen_kriterias,id',
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
            'indikator_instrumen_id.required' => 'Instrumen Prodi harus diisi.',
            'indikator_instrumen_id.exists' => 'Instrumen Prodi tidak ditemukan.',
            'indikator_instrumen_kriteria_id.required' => 'Kriteria Instrumen Prodi harus diisi.',
            'indikator_instrumen_kriteria_id.exists' => 'Kriteria Instrumen Prodi tidak ditemukan.',
            '*.string' => ':attribute harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $instrumen = new InstrumenProdi();
        $instrumen->indikator_instrumen_id = $request->indikator_instrumen_id;
        $instrumen->indikator_instrumen_kriteria_id = $request->indikator_instrumen_kriteria_id;
        $instrumen->element = $request->element;
        $instrumen->indikator = $request->indikator;
        $instrumen->sumber_data = $request->sumber_data;
        $instrumen->metode_perhitungan = $request->metode_perhitungan;
        $instrumen->target = $request->target;
        $instrumen->realisasi = $request->realisasi;
        $instrumen->standar_digunakan = $request->standar_digunakan;
        $instrumen->uraian = $request->uraian;
        $instrumen->penyebab_tidak_tercapai = $request->penyebab_tidak_tercapai;
        $instrumen->rencana_perbaikan = $request->rencana_perbaikan;
        $instrumen->indikator_penilaian = $request->indikator_penilaian;
        $instrumen->save();

        return response()->json([
            'message' => 'Instrumen Prodi berhasil ditambahkan!',
            'data' => $instrumen
        ]);
    }

    public function edit(InstrumenProdi $instrumen)
    {
        if (!$instrumen) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $instrumen]);
    }

    public function update(Request $request, InstrumenProdi $instrumen)
    {
        $validator = Validator::make($request->all(), [
            'indikator_instrumen_id' => 'required|exists:indikator_instrumens,id',
            'indikator_instrumen_kriteria_id' => 'required|exists:indikator_instrumen_kriterias,id',
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
            'indikator_instrumen_id.required' => 'Instrumen Prodi harus diisi.',
            'indikator_instrumen_id.exists' => 'Instrumen Prodi tidak ditemukan.',
            'indikator_instrumen_kriteria_id.required' => 'Kriteria Instrumen Prodi harus diisi.',
            'indikator_instrumen_kriteria_id.exists' => 'Kriteria Instrumen Prodi tidak ditemukan.',
            '*.string' => ':attribute harus berupa teks.'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $instrumen->indikator_instrumen_id = $request->indikator_instrumen_id;
        $instrumen->indikator_instrumen_kriteria_id = $request->indikator_instrumen_kriteria_id;
        $instrumen->element = $request->element;
        $instrumen->indikator = $request->indikator;
        $instrumen->sumber_data = $request->sumber_data;
        $instrumen->metode_perhitungan = $request->metode_perhitungan;
        $instrumen->target = $request->target;
        $instrumen->realisasi = $request->realisasi;
        $instrumen->standar_digunakan = $request->standar_digunakan;
        $instrumen->uraian = $request->uraian;
        $instrumen->penyebab_tidak_tercapai = $request->penyebab_tidak_tercapai;
        $instrumen->rencana_perbaikan = $request->rencana_perbaikan;
        $instrumen->indikator_penilaian = $request->indikator_penilaian;
        $instrumen->save();

        return response()->json([
            'message' => 'Instrumen Prodi berhasil diperbarui!',
            'data' => $instrumen
        ]);
    }

    public function nonaktifkan(InstrumenProdi $instrumen)
    {
        try {
            $instrumen->delete();
            return response()->json([
                'message' => 'Instrumen Prodi berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi!',
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
                'message' => 'Instrumen Prodi terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $instrumen = InstrumenProdi::withTrashed()->findOrFail($id);
        $instrumen->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Instrumen Prodi berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $instrumen = InstrumenProdi::withTrashed()->findOrFail($id);

            if (!$instrumen->trashed()) {
                return response()->json([
                    'message' => 'Instrumen Prodi belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $instrumen->forceDelete();

            return response()->json([
                'message' => 'Instrumen Prodi berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
