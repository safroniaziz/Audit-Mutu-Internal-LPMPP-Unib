<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokumenAmiController extends Controller
{
    public function index(){
        $dokumenAuditor = DokumenAmi::where('kategori_dokumen','auditor')
                                    ->first();
        $dokumenAuditee = DokumenAmi::where('kategori_dokumen','auditee')
                                    ->first();
        $dokumenUmum = DokumenAmi::where('kategori_dokumen','umum')
                                    ->first();

        return view('dokumen_ami.index',[
            'dokumenAuditor'  =>  $dokumenAuditor,
            'dokumenAuditee'  =>  $dokumenAuditee,
            'dokumenUmum'  =>  $dokumenUmum,
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'kategori_dokumen.required' => 'Kategori dokumen wajib diisi.',
            'kategori_dokumen.in' => 'Kategori dokumen harus salah satu dari: auditor, auditee, atau umum.',
            'deskripsi_dokumen.required' => 'Deskripsi dokumen wajib diisi.',
            'file_dokumen.required' => 'File dokumen wajib diunggah.',
            'file_dokumen.file' => 'File dokumen harus berupa file.',
            'file_dokumen.mimes' => 'File harus berformat: pdf, doc, docx, xls, xlsx.',
            'tanggal_berlaku.required' => 'Tanggal berlaku wajib diisi.',
            'tanggal_berlaku.date' => 'Tanggal berlaku harus berupa tanggal yang valid.',
        ];

        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required',
            'kategori_dokumen' => 'required|in:auditor,auditee,umum',
            'deskripsi_dokumen' => 'required',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
            'tanggal_berlaku' => 'required|date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = $request->kategori_dokumen;
        $folder = "dokumen_ami/{$kategori}";

        $file = $request->file('file_dokumen');
        $filePath = $file->store($folder, 'public');

        $size = $file->getSize();

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $dokumenAmi = DokumenAmi::create([
            'nama_dokumen' => $request->nama_dokumen,
            'kategori_dokumen' => $kategori,
            'deskripsi_dokumen' => $request->deskripsi_dokumen,
            'file_dokumen' => $filePath,
            'size_dokumen' => $size,
            'tanggal_berlaku' => $request->tanggal_berlaku,
        ]);

        return response()->json([
            'message' => 'Dokumen Ami berhasil ditambahkan!',
            'data' => $dokumenAmi
        ]);
    }

    public function edit(DokumenAmi $dokumenAmi)
    {
        if (!$dokumenAmi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $dokumenAmi]);
    }

    public function update(Request $request, DokumenAmi $dokumenAmi)
    {
        $messages = [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'kategori_dokumen.required' => 'Kategori dokumen wajib diisi.',
            'kategori_dokumen.in' => 'Kategori dokumen harus salah satu dari: auditor, auditee, atau umum.',
            'deskripsi_dokumen.required' => 'Deskripsi dokumen wajib diisi.',
            'tanggal_berlaku.required' => 'Tanggal berlaku wajib diisi.',
            'tanggal_berlaku.date' => 'Tanggal berlaku harus berupa tanggal yang valid.',
            'file_dokumen.file' => 'File dokumen harus berupa file.',
            'file_dokumen.mimes' => 'File harus berformat: pdf, doc, docx, xls, xlsx.',
        ];

        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required',
            'kategori_dokumen' => 'required|in:auditor,auditee,umum',
            'deskripsi_dokumen' => 'required',
            'tanggal_berlaku' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $dokumenAmi->nama_dokumen = $request->nama_dokumen;
        $dokumenAmi->kategori_dokumen = $request->kategori_dokumen;
        $dokumenAmi->deskripsi_dokumen = $request->deskripsi_dokumen;
        $dokumenAmi->tanggal_berlaku = $request->tanggal_berlaku;

        if ($request->hasFile('file_dokumen')) {
            if ($dokumenAmi->file_dokumen && Storage::exists('public/' . $dokumenAmi->file_dokumen)) {
                Storage::delete('public/' . $dokumenAmi->file_dokumen);
            }

            $folder = 'dokumen_ami/' . $request->kategori_dokumen;
            $file = $request->file('file_dokumen');
            $filePath = $file->store($folder, 'public');
            $size = $file->getSize();

            $dokumenAmi->file_dokumen = $filePath;
            $dokumenAmi->size_dokumen = $size;
        }

        $dokumenAmi->save();

        return response()->json([
            'message' => 'Dokumen AMI berhasil diperbarui!',
            'data' => $dokumenAmi
        ]);
    }


    public function nonaktifkan(DokumenAmi $dokumenAmi)
    {
        try {
            $dokumenAmi->delete();
            return response()->json([
                'message' => 'Dokumen Ami berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Dokumen Ami!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            DokumenAmi::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Dokumen Ami terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Dokumen Ami terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $dokumenAmi = DokumenAmi::withTrashed()->findOrFail($id);
        $dokumenAmi->restore();

        return response()->json(['message' => 'Dokumen Ami berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $dokumenAmi = DokumenAmi::withTrashed()->findOrFail($id);

            if (!$dokumenAmi->trashed()) {
                return response()->json([
                    'message' => 'Dokumen Ami belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $dokumenAmi->forceDelete();

            return response()->json([
                'message' => 'Dokumen Ami berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Dokumen Ami permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
