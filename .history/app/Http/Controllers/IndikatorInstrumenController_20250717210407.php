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
        $indikators = IndikatorInstrumen::with(['prodis', 'kriterias'])->orderBy('created_at','desc')->withTrashed()->get();

        // Hitung jumlah kriteria untuk setiap indikator
        foreach ($indikators as $indikator) {
            $indikator->kriteria_count = $indikator->kriterias->count();
        }

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
            DB::beginTransaction();

            // Soft delete semua relasi prodi
            $indikator->prodis()->syncWithoutDetaching([]);
            $indikator->prodis()->detach();

            // Soft delete indikator
            $indikator->delete();

            DB::commit();

            return response()->json([
                'message' => 'Indikator Instrumen berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = $request->ids;
            $indikators = IndikatorInstrumen::whereIn('id', $ids)->get();

            foreach($indikators as $indikator) {
                // Soft delete semua relasi prodi
                $indikator->prodis()->syncWithoutDetaching([]);
                $indikator->prodis()->detach();

                // Soft delete indikator
                $indikator->delete();
            }

            DB::commit();

            return response()->json([
                'message' => 'Indikator Instrumen terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $indikator = IndikatorInstrumen::withTrashed()->findOrFail($id);

            // Restore indikator
            $indikator->restore();

            // Restore relasi prodi jika ada
            $indikator->prodis()->restore();

            DB::commit();

            return response()->json(['message' => 'Indikator Instrumen berhasil dipulihkan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal memulihkan Indikator Instrumen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyPermanent($id)
    {
        try {
            DB::beginTransaction();

            $indikator = IndikatorInstrumen::withTrashed()->findOrFail($id);

            if (!$indikator->trashed()) {
                return response()->json([
                    'message' => 'Indikator Instrumen belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            // Hapus permanen relasi di tabel pivot
            DB::table('indikator_instrumen_prodi')
                ->where('indikator_instrumen_id', $indikator->id)
                ->delete();

            // Hapus permanen indikator
            $indikator->forceDelete();

            DB::commit();

            return response()->json([
                'message' => 'Indikator Instrumen berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menghapus Indikator Instrumen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getKriteria($id)
    {
        try {
            $indikator = IndikatorInstrumen::with(['kriterias.instrumenProdi' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])->findOrFail($id);

            return view('indikator_instrumen.kriteria', [
                'indikator' => $indikator,
                'kriterias' => $indikator->kriterias
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
