<?php

namespace App\Http\Controllers;

use App\Models\SatuanStandar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanStandarController extends Controller
{
    public function index(){
        $ikss = SatuanStandar::orderBy('created_at','desc')->withTrashed()->get();
        return view('satuan_standar.index',[
            'ikss'    =>  $ikss,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_satuan' => 'required|string',
            'kode_satuan' => 'required|string',
        ], [
            'kode_satuan.required' => 'Instrumen Prodi harus diisi.',
            'kode_satuan.required' => 'Instrumen Prodi harus diisi.',
            '*.string' => ':attribute harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $satuanStandar = new SatuanStandar();
        $satuanStandar->indikator_instrumen_id = $request->indikator_instrumen_id;
        $satuanStandar->indikator_instrumen_kriteria_id = $request->indikator_instrumen_kriteria_id;
        $satuanStandar->elemen = $request->elemen;
        $satuanStandar->indikator = $request->indikator;
        $satuanStandar->sumber_data = $request->sumber_data;
        $satuanStandar->metode_perhitungan = $request->metode_perhitungan;
        $satuanStandar->target = $request->target;
        $satuanStandar->realisasi = $request->realisasi;
        $satuanStandar->standar_digunakan = $request->standar_digunakan;
        $satuanStandar->uraian = $request->uraian;
        $satuanStandar->penyebab_tidak_tercapai = $request->penyebab_tidak_tercapai;
        $satuanStandar->rencana_perbaikan = $request->rencana_perbaikan;
        $satuanStandar->indikator_penilaian = $request->indikator_penilaian;
        $satuanStandar->save();

        return response()->json([
            'message' => 'Instrumen Prodi berhasil ditambahkan!',
            'data' => $satuanStandar
        ]);
    }

    public function edit(SatuanStandar $satuanStandar)
    {
        if (!$satuanStandar) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $satuanStandar]);
    }

    public function update(Request $request, SatuanStandar $satuanStandar)
    {
        $validator = Validator::make($request->all(), [
            'indikator_instrumen_id' => 'required|exists:indikator_instrumens,id',
            'indikator_instrumen_kriteria_id' => 'required|exists:indikator_instrumen_kriterias,id',
            'elemen' => 'nullable|string',
            'indikator' => 'nullable|string',
            'sumber_data' => 'nullable|string',
            'metode_perhitungan' => 'nullable|string',
            'target' => 'nullable|string',
            'realisasi' => 'nullable|string',
            'standar_digunakan' => 'nullable|string',
            'uraian' => 'nullable|string',
            'penyebab_tidak_tercapai' => 'nullable|string',
            'rencana_perbaikan' => 'nullable|string',
            'indikator_penilaian' => 'nullable|string',
        ], [
            'indikator_instrumen_id.required' => 'Instrumen Prodi harus diisi.',
            'indikator_instrumen_id.exists' => 'Instrumen Prodi tidak ditemukan.',
            'indikator_instrumen_kriteria_id.required' => 'Kriteria Instrumen Prodi harus diisi.',
            'indikator_instrumen_kriteria_id.exists' => 'Kriteria Instrumen Prodi tidak ditemukan.',
            '*.string' => ':attribute harus berupa teks.'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $satuanStandar->indikator_instrumen_id = $request->indikator_instrumen_id;
        $satuanStandar->indikator_instrumen_kriteria_id = $request->indikator_instrumen_kriteria_id;
        $satuanStandar->elemen = $request->elemen;
        $satuanStandar->indikator = $request->indikator;
        $satuanStandar->sumber_data = $request->sumber_data;
        $satuanStandar->metode_perhitungan = $request->metode_perhitungan;
        $satuanStandar->target = $request->target;
        $satuanStandar->realisasi = $request->realisasi;
        $satuanStandar->standar_digunakan = $request->standar_digunakan;
        $satuanStandar->uraian = $request->uraian;
        $satuanStandar->penyebab_tidak_tercapai = $request->penyebab_tidak_tercapai;
        $satuanStandar->rencana_perbaikan = $request->rencana_perbaikan;
        $satuanStandar->indikator_penilaian = $request->indikator_penilaian;
        $satuanStandar->save();

        return response()->json([
            'message' => 'Instrumen Prodi berhasil diperbarui!',
            'data' => $satuanStandar
        ]);
    }

    public function nonaktifkan(SatuanStandar $satuanStandar)
    {
        try {
            $satuanStandar->delete();
            return response()->json([
                'message' => 'Instrumen Prodi berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            SatuanStandar::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Instrumen Prodi terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $satuanStandar = SatuanStandar::withTrashed()->findOrFail($id);
        $satuanStandar->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Instrumen Prodi berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $satuanStandar = SatuanStandar::withTrashed()->findOrFail($id);

            if (!$satuanStandar->trashed()) {
                return response()->json([
                    'message' => 'Instrumen Prodi belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $satuanStandar->forceDelete();

            return response()->json([
                'message' => 'Instrumen Prodi berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Instrumen Prodi permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
