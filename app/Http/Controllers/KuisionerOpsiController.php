<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use App\Models\KuisionerOpsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KuisionerOpsiController extends Controller
{
    public function index()
    {
        $kuisioners = Kuisioner::all();
        $opsiKuisioner = KuisionerOpsi::with(['kuisioner'])->orderBy('created_at', 'desc')->withTrashed()->get();
        return view('kuisioner_opsi.index', [
            'opsikuisioners'    =>  $opsiKuisioner,
            'kuisioners'    =>  $kuisioners,
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'kuisioner_id.required' => 'Kuisioner wajib dipilih.',
            'kuisioner_id.exists'   => 'Kuisioner yang dipilih tidak valid.',
            'opsi.required'         => 'Opsi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'kuisioner_id' => 'required|exists:kuisioners,id',
            'opsi'         => 'required|string|max:255',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $opsiKuisioner = KuisionerOpsi::create([
            'kuisioner_id' => $request->kuisioner_id,
            'opsi' => $request->opsi,
        ]);

        return response()->json([
            'message' => 'Opsi Kuisioner berhasil ditambahkan!',
            'data' => $opsiKuisioner
        ]);
    }

    public function edit(KuisionerOpsi $opsiKuisioner)
    {
        if (!$opsiKuisioner) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $opsiKuisioner]);
    }

    public function update(Request $request, KuisionerOpsi $opsiKuisioner)
    {
        $messages = [
            'kuisioner_id.required' => 'Kuisioner wajib dipilih.',
            'kuisioner_id.exists'   => 'Kuisioner yang dipilih tidak valid.',
            'opsi.required'         => 'Opsi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'kuisioner_id' => 'required|exists:kuisioners,id',
            'opsi'         => 'required|string|max:255',
        ], $messages);

        $opsiKuisioner->kuisioner_id = $request->kuisioner_id;
        $opsiKuisioner->opsi = $request->opsi;
        $opsiKuisioner->save();

        return response()->json([
            'message' => 'Opsi Kuisioner berhasil diperbarui!',
            'data' => $opsiKuisioner
        ]);
    }

    public function nonaktifkan(KuisionerOpsi $opsiKuisioner)
    {
        try {
            $opsiKuisioner->delete();
            return response()->json([
                'message' => 'Opsi Kuisioner berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Opsi Kuisioner!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            KuisionerOpsi::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Opsi Kuisioner terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Opsi Kuisioner terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $opsiKuisioner = KuisionerOpsi::withTrashed()->findOrFail($id);
        $opsiKuisioner->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Opsi Kuisioner berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $opsiKuisioner = KuisionerOpsi::withTrashed()->findOrFail($id);

            if (!$opsiKuisioner->trashed()) {
                return response()->json([
                    'message' => 'Opsi Kuisioner belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $opsiKuisioner->forceDelete();

            return response()->json([
                'message' => 'Opsi Kuisioner berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Opsi Kuisioner permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
