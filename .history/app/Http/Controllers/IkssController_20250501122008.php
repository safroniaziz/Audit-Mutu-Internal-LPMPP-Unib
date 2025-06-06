<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\SatuanStandar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IkssController extends Controller
{
    public function index(){
        $satuanStandars = SatuanStandar::get();
        $indikatorKinerjas = IndikatorKinerja::with(['satuanStandar'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('kriteria_instrumen.index',[
            'indikatorKinerjas'    =>  $indikatorKinerjas,
            'satuanStandars'    =>  $satuanStandars,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'satuan_standar_id' => 'required|exists:satuan_standars,id',
            'kode_ikss' => 'required|string|max:10',
            'tujuan' => 'required|string|max:255',
        ], [
            'satuan_standar_id.required' => 'Indikator instrumen harus diisi.',
            'satuan_standar_id.exists' => 'Indikator instrumen tidak ditemukan.',
            'kode_ikss.required' => 'Kode kriteria harus diisi.',
            'kode_ikss.string' => 'Kode kriteria harus berupa teks.',
            'kode_ikss.max' => 'Kode kriteria tidak boleh lebih dari 10 karakter.',
            'tujuan.required' => 'Nama kriteria harus diisi.',
            'tujuan.string' => 'Nama kriteria harus berupa teks.',
            'tujuan.max' => 'Nama kriteria tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kriteria = IndikatorKinerja::create([
            'satuan_standar_id' => $request->indikator_instrumen_id,
            'kode_ikss' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
        ]);

        return response()->json([
            'message' => 'Kriteria Instrumen berhasil ditambahkan!',
            'data' => $kriteria
        ]);
    }

    public function edit(IndikatorKinerja $kriteria)
    {
        if (!$kriteria) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $kriteria]);
    }

    public function update(Request $request, IndikatorKinerja $kriteria)
    {
        $validator = Validator::make($request->all(), [
            'indikator_instrumen_id' => 'required|exists:satuan_standars,id',
            'kode_kriteria' => 'required|string|max:10',
            'nama_kriteria' => 'required|string|max:255',
        ], [
            'indikator_instrumen_id.required' => 'Indikator instrumen harus diisi.',
            'indikator_instrumen_id.exists' => 'Indikator instrumen tidak ditemukan.',
            'kode_kriteria.required' => 'Kode kriteria harus diisi.',
            'kode_kriteria.string' => 'Kode kriteria harus berupa teks.',
            'kode_kriteria.max' => 'Kode kriteria tidak boleh lebih dari 10 karakter.',
            'nama_kriteria.required' => 'Nama kriteria harus diisi.',
            'nama_kriteria.string' => 'Nama kriteria harus berupa teks.',
            'nama_kriteria.max' => 'Nama kriteria tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kriteria->indikator_instrumen_id = $request->indikator_instrumen_id;
        $kriteria->kode_kriteria = $request->kode_kriteria;
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->save();

        return response()->json([
            'message' => 'Kriteria Instrumen berhasil diperbarui!',
            'data' => $kriteria
        ]);
    }

    public function nonaktifkan(IndikatorKinerja $kriteria)
    {
        try {
            $kriteria->delete();
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
            IndikatorKinerja::whereIn('id', $ids)->delete();

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
        $kriteria = IndikatorKinerja::withTrashed()->findOrFail($id);
        $kriteria->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Kriteria Instrumen berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $kriteria = IndikatorKinerja::withTrashed()->findOrFail($id);

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
