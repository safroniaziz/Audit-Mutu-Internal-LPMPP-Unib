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
            'sasaran' => 'required|string',
        ], [
            'kode_satuan.required' => 'Satuan Standar harus diisi.',
            'sasaran.required' => 'Sasaran harus diisi.',
            '*.string' => ':attribute harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $satuanStandar = new SatuanStandar();
        $satuanStandar->kode_satuan = $request->kode_satuan;
        $satuanStandar->sasaran = $request->sasaran;
        $satuanStandar->save();

        return response()->json([
            'message' => 'Satuan Standar berhasil ditambahkan!',
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
            'kode_satuan' => 'required|string',
            'sasaran' => 'required|string',
        ], [
            'kode_satuan.required' => 'Satuan Standar harus diisi.',
            'sasaran.required' => 'Sasaran harus diisi.',
            '*.string' => ':attribute harus berupa teks.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $satuanStandar->kode_satuan = $request->kode_satuan;
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
            'message' => 'Satuan Standar berhasil diperbarui!',
            'data' => $satuanStandar
        ]);
    }

    public function nonaktifkan(SatuanStandar $satuanStandar)
    {
        try {
            $satuanStandar->delete();
            return response()->json([
                'message' => 'Satuan Standar berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Satuan Standar!',
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
                'message' => 'Satuan Standar terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Satuan Standar terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $satuanStandar = SatuanStandar::withTrashed()->findOrFail($id);
        $satuanStandar->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Satuan Standar berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $satuanStandar = SatuanStandar::withTrashed()->findOrFail($id);

            if (!$satuanStandar->trashed()) {
                return response()->json([
                    'message' => 'Satuan Standar belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $satuanStandar->forceDelete();

            return response()->json([
                'message' => 'Satuan Standar berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Satuan Standar permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
