<?php

namespace App\Http\Controllers;

use App\Models\Instr;
use App\Models\InstrumenIkss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumenIkssController extends Controller
{
    public function index(){
        $Instrs = Instr::get();
        $instrumenIkss = InstrumenIkss::with(['Instr'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('instrumen_ikss.index',[
            'instrumenIkss'    =>  $instrumenIkss,
            'Instrs'    =>  $Instrs,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
            'indikator' => 'nullable|string',
            'satuan' => 'nullable|string',
            'pertanyaan' => 'nullable|string',
            'target' => 'nullable|numeric', // target harus angka
            'sumber' => 'nullable|string',
            'uraian' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'jenis_auditee' => 'nullable|string',
            'is_wajib' => 'nullable|boolean',
        ], [
            'indikator_kinerja_id.required' => 'Instrumen IKSS harus dipilih.',
            'indikator_kinerja_id.exists' => 'Instrumen IKSS tidak ditemukan.',
            'indikator.string' => 'Indikator harus berupa teks.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'pertanyaan.string' => 'Pertanyaan harus berupa teks.',
            'target.numeric' => 'Target harus berupa angka.', // pesan validasi khusus
            'sumber.string' => 'Sumber harus berupa teks.',
            'uraian.string' => 'Uraian harus berupa teks.',
            'penilaian.string' => 'Penilaian harus berupa teks.',
            'jenis_auditee.string' => 'Jenis auditee harus berupa teks.',
            'is_wajib.boolean' => 'Status wajib harus berupa nilai true atau false.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $instrumenIkss = Instr::create([
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
            'data' => $instrumenIkss
        ]);
    }

    public function edit(Instr $instrumenIkss)
    {
        if (!$instrumenIkss) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $instrumenIkss]);
    }

    public function update(Request $request, Instr $instrumenIkss)
    {
        $validator = Validator::make($request->all(), [
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
            'indikator' => 'nullable|string',
            'satuan' => 'nullable|string',
            'pertanyaan' => 'nullable|string',
            'target' => 'nullable|numeric',
            'sumber' => 'nullable|string',
            'uraian' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'jenis_auditee' => 'nullable|string',
            'is_wajib' => 'nullable|boolean',
        ], [
            'indikator_kinerja_id.required' => 'Instrumen IKSS harus dipilih.',
            'indikator_kinerja_id.exists' => 'Instrumen IKSS tidak ditemukan.',
            'indikator.string' => 'Indikator harus berupa teks.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'pertanyaan.string' => 'Pertanyaan harus berupa teks.',
            'target.numeric' => 'Target harus berupa angka.',
            'sumber.string' => 'Sumber harus berupa teks.',
            'uraian.string' => 'Uraian harus berupa teks.',
            'penilaian.string' => 'Penilaian harus berupa teks.',
            'jenis_auditee.string' => 'Jenis auditee harus berupa teks.',
            'is_wajib.boolean' => 'Status wajib harus berupa nilai true atau false.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $instrumenIkss->indikator_kinerja_id = $request->indikator_kinerja_id;
        $instrumenIkss->kode_ikss = $request->kode_ikss;
        $instrumenIkss->tujuan = $request->tujuan;
        $instrumenIkss->indikator = $request->indikator;
        $instrumenIkss->satuan = $request->satuan;
        $instrumenIkss->pertanyaan = $request->pertanyaan;
        $instrumenIkss->target = $request->target;
        $instrumenIkss->sumber = $request->sumber;
        $instrumenIkss->uraian = $request->uraian;
        $instrumenIkss->penilaian = $request->penilaian;
        $instrumenIkss->jenis_auditee = $request->jenis_auditee;
        $instrumenIkss->is_wajib = $request->is_wajib;
        $instrumenIkss->save();

        return response()->json([
            'message' => 'Instrumen IKSS berhasil diperbarui!',
            'data' => $instrumenIkss
        ]);
    }

    public function nonaktifkan(Instr $instrumenIkss)
    {
        try {
            $instrumenIkss->delete();
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
            Instr::whereIn('id', $ids)->delete();

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
        $instrumenIkss = Instr::withTrashed()->findOrFail($id);
        $instrumenIkss->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Instrumen IKSS berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $instrumenIkss = Instr::withTrashed()->findOrFail($id);

            if (!$instrumenIkss->trashed()) {
                return response()->json([
                    'message' => 'Instrumen IKSS belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $instrumenIkss->forceDelete();

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
