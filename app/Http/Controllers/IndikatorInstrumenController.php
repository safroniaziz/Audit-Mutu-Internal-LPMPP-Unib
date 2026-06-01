<?php

namespace App\Http\Controllers;

use App\Models\IndikatorInstrumen;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class IndikatorInstrumenController extends Controller
{
    public function index(Request $request)
    {
        $selectedProdiId = $request->query('prodi_id');
        $selectedFakultas = $request->query('fakultas');

        $prodis = UnitKerja::where('jenis_unit_kerja', 'prodi')->get();
        $assignedProdiIds = DB::table('indikator_instrumen_prodi as rel')
            ->join('indikator_instrumens as indikator', 'indikator.id', '=', 'rel.indikator_instrumen_id')
            ->whereNull('indikator.deleted_at')
            ->pluck('rel.unit_kerja_id')
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
        $availableIndikators = collect();
        $selectedProdi = null;
        if (!empty($selectedProdiId)) {
            $selectedProdi = $prodis->firstWhere('id', (int) $selectedProdiId);
            $availableIndikators = IndikatorInstrumen::query()
                ->withCount('kriterias')
                ->whereNull('deleted_at')
                ->whereDoesntHave('prodis', function ($query) use ($selectedProdiId) {
                    $query->where('unit_kerjas.id', $selectedProdiId);
                })
                ->orderBy('nama_indikator')
                ->get(['id', 'nama_indikator']);
        }

        $indikatorsQuery = IndikatorInstrumen::with(['prodis', 'kriterias.instrumenProdi'])
            ->orderBy('created_at', 'desc')
            ->withTrashed();

        if (!empty($selectedProdiId)) {
            $indikatorsQuery->whereHas('prodis', function ($query) use ($selectedProdiId) {
                $query->where('unit_kerjas.id', $selectedProdiId);
            });
            $indikatorsQuery->limit(1);
        } elseif (!empty($selectedFakultas)) {
            $indikatorsQuery->whereHas('prodis', function ($query) use ($selectedFakultas) {
                $query->where('unit_kerjas.fakultas', $selectedFakultas);
            });
        }

        $indikators = $indikatorsQuery->get();

        // Hitung jumlah kriteria untuk setiap indikator
        foreach ($indikators as $indikator) {
            $indikator->kriteria_count = $indikator->kriterias->count();
        }

        return view('indikator_instrumen.index',[
            'indikators'    =>  $indikators,
            'prodis'        =>  $prodis,
            'selectedProdiId' => $selectedProdiId,
            'selectedFakultas' => $selectedFakultas,
            'selectedProdi' => $selectedProdi,
            'availableIndikators' => $availableIndikators,
            'assignedProdiIds' => $assignedProdiIds,
        ]);
    }

    public function store(Request $request)
    {
        $isScopedProdiMode = $request->filled('scope_prodi_id');
        $validator = Validator::make($request->all(), [
            'nama_indikator' => $isScopedProdiMode ? 'nullable|string|max:255' : 'required|string|max:255',
            'threshold' => $isScopedProdiMode ? 'nullable|numeric|min:0|max:999.99' : 'required|numeric|min:0|max:999.99',
            'scope_prodi_id' => $isScopedProdiMode ? 'required|integer|exists:unit_kerjas,id' : 'nullable',
            'scoped_indikator_id' => $isScopedProdiMode ? 'required|integer|exists:indikator_instrumens,id' : 'nullable',
            'kategori' => $isScopedProdiMode ? 'nullable|array' : 'required|array',
            'kategori.*' => 'exists:unit_kerjas,id'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi.',
            'threshold.required' => 'Threshold wajib diisi.',
            'threshold.numeric' => 'Threshold harus berupa angka.',
            'threshold.min' => 'Threshold minimal 0.',
            'threshold.max' => 'Threshold maksimal 999.99.',
            'nama_indikator.string' => 'Nama indikator harus berupa teks.',
            'nama_indikator.max' => 'Nama indikator maksimal 255 karakter.',
            'scope_prodi_id.required' => 'Program studi wajib dipilih.',
            'scope_prodi_id.integer' => 'Program studi tidak valid.',
            'scope_prodi_id.exists' => 'Program studi yang dipilih tidak valid.',
            'scoped_indikator_id.required' => 'Indikator instrumen wajib dipilih.',
            'scoped_indikator_id.integer' => 'Indikator instrumen tidak valid.',
            'scoped_indikator_id.exists' => 'Indikator instrumen yang dipilih tidak valid.',
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
            $kategoriIds = $isScopedProdiMode
                ? [(int) $request->scope_prodi_id]
                : collect($request->kategori)
                    ->map(fn ($id) => (int) $id)
                    ->unique()
                    ->values()
                    ->all();

            if ($isScopedProdiMode) {
                $indikator = IndikatorInstrumen::whereNull('deleted_at')
                    ->findOrFail((int) $request->scoped_indikator_id);
            } else {
                // Buat indikator instrumen (mode global)
                $indikator = IndikatorInstrumen::create([
                    'nama_indikator' => $request->nama_indikator,
                    'threshold' => $request->filled('threshold') ? (float) $request->threshold : 3.00,
                ]);
            }

            // Aturan: satu prodi hanya boleh memiliki satu indikator aktif
            DB::table('indikator_instrumen_prodi')
                ->whereIn('unit_kerja_id', $kategoriIds)
                ->delete();

            // Attach prodi yang dipilih
            $indikator->prodis()->attach($kategoriIds);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $isScopedProdiMode
                    ? 'Indikator prodi berhasil diperbarui!'
                    : 'Data Indikator Instrumen berhasil ditambahkan!'
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
                    'threshold' => number_format((float) ($indikator->threshold ?? 3), 2, '.', ''),
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
        $isScopedProdiMode = $request->filled('scope_prodi_id');
        $validator = Validator::make($request->all(), [
            'nama_indikator' => $isScopedProdiMode ? 'nullable|string|max:255' : 'required|string|max:255',
            'threshold' => $isScopedProdiMode ? 'nullable|numeric|min:0|max:999.99' : 'required|numeric|min:0|max:999.99',
            'scope_prodi_id' => $isScopedProdiMode ? 'required|integer|exists:unit_kerjas,id' : 'nullable',
            'scoped_indikator_id' => $isScopedProdiMode ? 'required|integer|exists:indikator_instrumens,id' : 'nullable',
            'kategori' => $isScopedProdiMode ? 'nullable|array' : 'required|array',
            'kategori.*' => 'exists:unit_kerjas,id'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi.',
            'threshold.required' => 'Threshold wajib diisi.',
            'threshold.numeric' => 'Threshold harus berupa angka.',
            'threshold.min' => 'Threshold minimal 0.',
            'threshold.max' => 'Threshold maksimal 999.99.',
            'nama_indikator.string' => 'Nama indikator harus berupa teks.',
            'nama_indikator.max' => 'Nama indikator maksimal 255 karakter.',
            'scope_prodi_id.required' => 'Program studi wajib dipilih.',
            'scope_prodi_id.integer' => 'Program studi tidak valid.',
            'scope_prodi_id.exists' => 'Program studi yang dipilih tidak valid.',
            'scoped_indikator_id.required' => 'Indikator instrumen wajib dipilih.',
            'scoped_indikator_id.integer' => 'Indikator instrumen tidak valid.',
            'scoped_indikator_id.exists' => 'Indikator instrumen yang dipilih tidak valid.',
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
            $kategoriIds = $isScopedProdiMode
                ? [(int) $request->scope_prodi_id]
                : collect($request->kategori)
                    ->map(fn ($id) => (int) $id)
                    ->unique()
                    ->values()
                    ->all();

            $indikator = IndikatorInstrumen::findOrFail($id);
            $targetIndikator = $indikator;
            if ($isScopedProdiMode) {
                $targetIndikator = IndikatorInstrumen::whereNull('deleted_at')
                    ->findOrFail((int) $request->scoped_indikator_id);
            }

            // Update data indikator
            if (!$isScopedProdiMode) {
                $indikator->update([
                    'nama_indikator' => $request->nama_indikator,
                    'threshold' => $request->filled('threshold') ? (float) $request->threshold : 3.00,
                ]);
            }

            // Aturan: satu prodi hanya boleh memiliki satu indikator aktif
            DB::table('indikator_instrumen_prodi')
                ->whereIn('unit_kerja_id', $kategoriIds)
                ->where('indikator_instrumen_id', '!=', $targetIndikator->id)
                ->delete();

            if ($isScopedProdiMode) {
                // Mode scoped prodi hanya menambah/mengganti relasi prodi saat ini tanpa mengubah prodi lain.
                $targetIndikator->prodis()->syncWithoutDetaching($kategoriIds);
            } else {
                // Mode global tetap sinkron penuh sesuai pilihan prodi.
                $indikator->prodis()->sync($kategoriIds);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $isScopedProdiMode
                    ? 'Indikator prodi berhasil diperbarui!'
                    : 'Data Indikator Instrumen berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeProdi(Request $request, IndikatorInstrumen $indikator)
    {
        $request->validate([
            'prodi_id' => 'required|integer|exists:unit_kerjas,id'
        ]);

        $indikator->prodis()->detach($request->prodi_id);

        return response()->json([
            'message' => 'Relasi indikator ke program studi berhasil dihapus.'
        ]);
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
                $query->orderByRaw('CASE WHEN instrumen_prodis.sort_order IS NULL THEN 1 ELSE 0 END')
                    ->orderBy('instrumen_prodis.sort_order')
                    ->orderByDesc('instrumen_prodis.created_at')
                    ->orderByDesc('instrumen_prodis.id');
            }])->withTrashed()->findOrFail($id);

            return view('indikator_instrumen.kriteria', [
                'indikator' => $indikator,
                'kriterias' => $indikator->kriterias->sortByDesc('created_at')->values()
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
