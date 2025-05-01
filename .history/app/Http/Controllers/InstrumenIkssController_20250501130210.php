<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumenIkssController extends Controller
{
    public function index(){
        $indikatorKinerjas = IndikatorKinerja::get();
        $instrumenIkss = InstrumenIkss::with(['indikatorKinerja'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('indikator_kinerja.index',[
            'instrumenIkss'    =>  $instrumenIkss,
            'indikatorKinerjas'    =>  $indikatorKinerjas,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
            'indikator' => 'nullable|string|max:10',
            'satuan' => 'nullable|string|max:255',
            'pertanyaan' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'uraian' => 'nullable|string|max:255',
            'penilaian' => 'nullable|string|max:255',
            'jenis_auditee' => 'nullable|string|max:255',
            'is_wajib' => 'nullable|boolean',
        ], [
            'indikator_kinerja_id.required' => 'Instrumen IKSS harus dipilih.',
            'indikator_kinerja_id.exists' => 'Instrumen IKSS tidak ditemukan.',
            'indikator.string' => 'Indikator harus berupa teks.',
            'indikator.max' => 'Indikator tidak boleh lebih dari 10 karakter.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.',
            'pertanyaan.string' => 'Pertanyaan harus berupa teks.',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 255 karakter.',
            'target.string' => 'Target harus berupa teks.',
            'target.max' => 'Target tidak boleh lebih dari 255 karakter.',
            'sumber.string' => 'Sumber harus berupa teks.',
            'sumber.max' => 'Sumber tidak boleh lebih dari 255 karakter.',
            'uraian.string' => 'Uraian harus berupa teks.',
            'uraian.max' => 'Uraian tidak boleh lebih dari 255 karakter.',
            'penilaian.string' => 'Penilaian harus berupa teks.',
            'penilaian.max' => 'Penilaian tidak boleh lebih dari 255 karakter.',
            'jenis_auditee.string' => 'Jenis auditee harus berupa teks.',
            'jenis_auditee.max' => 'Jenis auditee tidak boleh lebih dari 255 karakter.',
            'is_wajib.boolean' => 'Status wajib harus berupa nilai true atau false.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $indikatorKinerja = IndikatorKinerja::create([
            'indikator_kinerja_id' => $request->indikator_kinerja_id,
            'kode_ikss' => $request->kode_ikss,
            'tujuan' => $request->tujuan,
            'indikator' => $request->indikator,
            'satuan' => $request->satuan,
            'pertanyaan' => $request->pertanyaan,
            'target' => $request->target,
            'sumber' => $request->sumber,
            'uraian' => $request->uraian,
            'penilaian' => $request->penilaian,
            'jenis_auditee' => $request->jenis_auditee,
            'is_wajib' => $request->is_wajib,
        ]);

        return response()->json([
            'message' => 'Instrumen IKSS berhasil ditambahkan!',
            'data' => $indikatorKinerja
        ]);
    }

    public function edit(IndikatorKinerja $indikatorKinerja)
    {
        if (!$indikatorKinerja) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $indikatorKinerja]);
    }

    public function update(Request $request, IndikatorKinerja $indikatorKinerja)
    {
        $validator = Validator::make($request->all(), [
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
            'indikator' => 'nullable|string|max:10',
            'satuan' => 'nullable|string|max:255',
            'pertanyaan' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'uraian' => 'nullable|string|max:255',
            'penilaian' => 'nullable|string|max:255',
            'jenis_auditee' => 'nullable|string|max:255',
            'is_wajib' => 'nullable|boolean',
        ], [
            'indikator_kinerja_id.required' => 'Instrumen IKSS harus dipilih.',
            'indikator_kinerja_id.exists' => 'Instrumen IKSS tidak ditemukan.',
            'indikator.string' => 'Indikator harus berupa teks.',
            'indikator.max' => 'Indikator tidak boleh lebih dari 10 karakter.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.',
            'pertanyaan.string' => 'Pertanyaan harus berupa teks.',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 255 karakter.',
            'target.string' => 'Target harus berupa teks.',
            'target.max' => 'Target tidak boleh lebih dari 255 karakter.',
            'sumber.string' => 'Sumber harus berupa teks.',
            'sumber.max' => 'Sumber tidak boleh lebih dari 255 karakter.',
            'uraian.string' => 'Uraian harus berupa teks.',
            'uraian.max' => 'Uraian tidak boleh lebih dari 255 karakter.',
            'penilaian.string' => 'Penilaian harus berupa teks.',
            'penilaian.max' => 'Penilaian tidak boleh lebih dari 255 karakter.',
            'jenis_auditee.string' => 'Jenis auditee harus berupa teks.',
            'jenis_auditee.max' => 'Jenis auditee tidak boleh lebih dari 255 karakter.',
            'is_wajib.boolean' => 'Status wajib harus berupa nilai true atau false.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $indikatorKinerja->indikator_kinerja_id = $request->indikator_kinerja_id;
        $indikatorKinerja->kode_ikss = $request->kode_ikss;
        $indikatorKinerja->tujuan = $request->tujuan;
        $indikatorKinerja->indikator = $request->indikator;
        $indikatorKinerja->satuan = $request->satuan;
        $indikatorKinerja->pertanyaan = $request->pertanyaan;
        $indikatorKinerja->target = $request->target;
        $indikatorKinerja->sumber = $request->sumber;
        $indikatorKinerja->uraian = $request->uraian;
        $indikatorKinerja->penilaian = $request->penilaian;
        $indikatorKinerja->jenis_auditee = $request->jenis_auditee;
        $indikatorKinerja->is_wajib = $request->is_wajib;
        $indikatorKinerja->save();

        return response()->json([
            'message' => 'Instrumen IKSS berhasil diperbarui!',
            'data' => $indikatorKinerja
        ]);
    }

    public function nonaktifkan(IndikatorKinerja $indikatorKinerja)
    {
        try {
            $indikatorKinerja->delete();
            return response()->json([
                'message' => 'Instrumen IKSS berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen IKSS!',
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
                'message' => 'Instrumen IKSS terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen IKSS terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $indikatorKinerja = IndikatorKinerja::withTrashed()->findOrFail($id);
        $indikatorKinerja->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Instrumen IKSS berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $indikatorKinerja = IndikatorKinerja::withTrashed()->findOrFail($id);

            if (!$indikatorKinerja->trashed()) {
                return response()->json([
                    'message' => 'Instrumen IKSS belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $indikatorKinerja->forceDelete();

            return response()->json([
                'message' => 'Instrumen IKSS berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen IKSS permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
