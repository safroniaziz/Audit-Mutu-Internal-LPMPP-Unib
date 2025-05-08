<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TujuanController extends Controller
{
    public function index()
    {
        $tujuans = Tujuan::orderBy('created_at', 'desc')->withTrashed()->get();
        return view('tujuan.index', [
            'tujuans'    =>  $tujuans,
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'tujuan.required' => 'Tujuan wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'tujuan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $tujuan = Tujuan::create([
            'tujuan' => $request->tujuan,
        ]);

        return response()->json([
            'message' => 'Tujuan berhasil ditambahkan!',
            'data' => $tujuan
        ]);
    }

    public function edit(Tujuan $tujuan)
    {
        if (!$tujuan) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $tujuan]);
    }

    public function update(Request $request, Tujuan $tujuan)
    {
        $messages = [
            'tujuan.required' => 'Tujuan wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'tujuan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $tujuan->tujuan = $request->tujuan;
        $tujuan->save();

        return response()->json([
            'message' => 'Tujuan berhasil diperbarui!',
            'data' => $tujuan
        ]);
    }

    public function nonaktifkan(Tujuan $tujuan)
    {
        try {
            $tujuan->delete();
            return response()->json([
                'message' => 'Tujuan berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus tujuan!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            Tujuan::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Tujuan terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Tujuan terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $tujuan = Tujuan::withTrashed()->findOrFail($id);
        $tujuan->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Tujuan berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $tujuan = Tujuan::withTrashed()->findOrFail($id);

            if (!$tujuan->trashed()) {
                return response()->json([
                    'message' => 'Tujuan belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $tujuan->forceDelete();

            return response()->json([
                'message' => 'Tujuan berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Tujuan permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
