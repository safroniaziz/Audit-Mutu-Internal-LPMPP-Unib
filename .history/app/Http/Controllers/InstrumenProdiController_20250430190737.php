<?php

namespace App\Http\Controllers;

use App\Models\InstrumenProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumenProdiController extends Controller
{
    public function index(){
        $indikators = InstrumenProdi::orderBy('created_at','desc')->withTrashed()->get();
        return view('indikator_instrumen.index',[
            'indikators'    =>  $indikators,
        ]);
    }

    public function store(Request $request)
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

        $indikator = InstrumenProdi::create([
            'nama_indikator' => $request->nama_indikator,
        ]);

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

        $indikator->nama_indikator = $request->nama_indikator;
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
