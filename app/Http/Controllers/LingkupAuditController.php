<?php

namespace App\Http\Controllers;

use App\Models\LingkupAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LingkupAuditController extends Controller
{
    public function index()
    {
        $lingkupAudits = LingkupAudit::orderBy('created_at', 'desc')->withTrashed()->get();
        return view('lingkup_audit.index', [
            'lingkupAudits'    =>  $lingkupAudits,
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'lingkup_audit.required' => 'Lingkup Audit wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'lingkup_audit' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $lingkupAudit = LingkupAudit::create([
            'lingkup_audit' => $request->lingkup_audit,
        ]);

        return response()->json([
            'message' => 'Lingkup Audit berhasil ditambahkan!',
            'data' => $lingkupAudit
        ]);
    }

    public function edit(LingkupAudit $lingkupAudit)
    {
        if (!$lingkupAudit) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $lingkupAudit]);
    }

    public function update(Request $request, LingkupAudit $lingkupAudit)
    {
        $messages = [
            'lingkup_audit.required' => 'Lingkup Audit wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'lingkup_audit' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $lingkupAudit->lingkup_audit = $request->lingkup_audit;
        $lingkupAudit->save();

        return response()->json([
            'message' => 'Lingkup Audit berhasil diperbarui!',
            'data' => $lingkupAudit
        ]);
    }

    public function nonaktifkan(LingkupAudit $lingkupAudit)
    {
        try {
            $lingkupAudit->delete();
            return response()->json([
                'message' => 'Lingkup Audit berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus lingkup audit!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            LingkupAudit::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Lingkup Audit terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Lingkup Audit terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $lingkupAudit = LingkupAudit::withTrashed()->findOrFail($id);
        $lingkupAudit->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Lingkup Audit berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $lingkupAudit = LingkupAudit::withTrashed()->findOrFail($id);

            if (!$lingkupAudit->trashed()) {
                return response()->json([
                    'message' => 'Lingkup Audit belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $lingkupAudit->forceDelete();

            return response()->json([
                'message' => 'Lingkup Audit berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Lingkup Audit permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
