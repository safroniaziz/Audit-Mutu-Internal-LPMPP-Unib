<?php

namespace App\Http\Controllers;

use App\Models\IndikatorInstrumen;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class IndikatorInstrumenController extends Controller
{
    public function index(){
        $prodis = UnitKerja::where('jenis_unit_kerja', 'prodi')->get();
        $indikators = IndikatorInstrumen::orderBy('created_at','desc')->withTrashed()->get();
        return view('indikator_instrumen.index',[
            'indikators'    =>  $indikators,
            'prodis'        =>  $prodis,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string|max:255',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:unit_kerjas,id'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi.',
            'nama_indikator.string' => 'Nama indikator harus berupa teks.',
            'nama_indikator.max' => 'Nama indikator maksimal 255 karakter.',
            'kategori.required' => 'Program studi wajib dipilih.',
            'kategori.array' => 'Format program studi tidak valid.',
            'kategori.*.exists' => 'Program studi yang dipilih tidak valid.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Buat indikator instrumen
            $indikator = IndikatorInstrumen::create([
                'nama_indikator' => $request->nama_indikator
            ]);

            // Attach prodi yang dipilih
            $indikator->prodis()->attach($request->kategori);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Indikator Instrumen berhasil ditambahkan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $indikator = IndikatorInstrumen::with('prodis')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'nama_indikator' => $indikator->nama_indikator,
                    'kategori' => $indikator->prodis->pluck('id')->toArray()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_indikator' => 'required|string|max:255',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:unit_kerjas,id'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi.',
            'nama_indikator.string' => 'Nama indikator harus berupa teks.',
            'nama_indikator.max' => 'Nama indikator maksimal 255 karakter.',
            'kategori.required' => 'Program studi wajib dipilih.',
            'kategori.array' => 'Format program studi tidak valid.',
            'kategori.*.exists' => 'Program studi yang dipilih tidak valid.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $indikator = IndikatorInstrumen::findOrFail($id);

            // Update data indikator
            $indikator->update([
                'nama_indikator' => $request->nama_indikator
            ]);

            // Sync prodi yang dipilih (ini akan menghapus yang tidak dipilih dan menambah yang baru)
            $indikator->prodis()->sync($request->kategori);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Indikator Instrumen berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkan(IndikatorInstrumen $indikator)
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
        $indikator = IndikatorInstrumen::withTrashed()->findOrFail($id);
        $indikator->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Indikator Instrumen berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $indikator = IndikatorInstrumen::withTrashed()->findOrFail($id);

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
