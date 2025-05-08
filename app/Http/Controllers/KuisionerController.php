<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KuisionerController extends Controller
{
    public function index()
    {
        $kuisioners = Kuisioner::orderBy('created_at', 'desc')->withTrashed()->get();
        return view('kuisioner.index', [
            'kuisioners'    =>  $kuisioners,
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kuisioner = Kuisioner::create([
            'pertanyaan' => $request->pertanyaan,
        ]);

        return response()->json([
            'message' => 'Kuisioner berhasil ditambahkan!',
            'data' => $kuisioner
        ]);
    }

    public function edit(Kuisioner $kuisioner)
    {
        if (!$kuisioner) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $kuisioner]);
    }

    public function update(Request $request, Kuisioner $kuisioner)
    {
        $messages = [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kuisioner->pertanyaan = $request->pertanyaan;
        $kuisioner->save();

        return response()->json([
            'message' => 'Kuisioner berhasil diperbarui!',
            'data' => $kuisioner
        ]);
    }

    public function nonaktifkan(Kuisioner $kuisioner)
    {
        try {
            $kuisioner->delete();
            return response()->json([
                'message' => 'Kuisioner berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kuisioner!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            Kuisioner::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Kuisioner terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kuisioner terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $kuisioner = Kuisioner::withTrashed()->findOrFail($id);
        $kuisioner->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Kuisioner berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $kuisioner = Kuisioner::withTrashed()->findOrFail($id);

            if (!$kuisioner->trashed()) {
                return response()->json([
                    'message' => 'Kuisioner belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $kuisioner->forceDelete();

            return response()->json([
                'message' => 'Kuisioner berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Kuisioner permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
