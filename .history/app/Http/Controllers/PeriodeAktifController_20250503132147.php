<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodeAktifController extends Controller
{
    public function index(){
        $periodeAktif = PeriodeAktif::all();
        return view('periode_aktif.index',[
            'periodeAktif'    =>  $periodeAktif,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string',
            'siklus' => 'required|string',
            'tahun_ami' => 'required|string',
            'status' => 'required|string',
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'siklus.required' => 'Siklus wajib diisi.',
            'tahun_ami.required' => 'Tahun AMI wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $periodeAktif = PeriodeAktif::create([
            'nomor_surat' => $request->nomor_surat,
            'siklus' => $request->siklus,
            'tahun_ami' => $request->tahun_ami,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Periode Aktif berhasil ditambahkan!',
            'data' => $periodeAktif
        ]);
    }

    public function edit(PeriodeAktif $periodeAktif)
    {
        if (!$periodeAktif) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $periodeAktif]);
    }

    public function update(Request $request, PeriodeAktif $periodeAktif)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string|unique:surat_ami,nomor_surat,' . $periodeAktif->id,
            'siklus' => 'required|string',
            'tahun_ami' => 'required|string',
            'status' => 'required|string',
        ], [
            'nomor_surat.required' => 'Nomor surat harus diisi saat mengedit data.',
            'siklus.required' => 'Siklus harus diisi saat mengedit data.',
            'tahun_ami.required' => 'Tahun AMI harus diisi saat mengedit data.',
            'status.required' => 'Status harus diisi saat mengedit data.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $periodeAktif->nomor_surat = $request->nomor_surat;
        $periodeAktif->nama_unit_kerja = $request->nama_unit_kerja;
        $periodeAktif->jenis_unit_kerja = $request->jenis_unit_kerja;
        $periodeAktif->jenjang = $request->jenjang;
        $periodeAktif->fakultas = $request->jenis_unit_kerja === 'fakultas' ? null : $request->fakultas;
        $periodeAktif->save();

        return response()->json([
            'message' => 'Periode Aktif berhasil diperbarui!',
            'data' => $periodeAktif
        ]);
    }

    public function nonaktifkan(PeriodeAktif $periodeAktif)
    {
        try {
            $periodeAktif->delete();
            return response()->json([
                'message' => 'Periode Aktif berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Periode Aktif!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nonaktifkanSelected(Request $request)
    {
        try {
            $ids = $request->ids;
            PeriodeAktif::whereIn('id', $ids)->delete();

            return response()->json([
                'message' => 'Periode Aktif terpilih berhasil dinonaktifkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Periode Aktif terpilih!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        $periodeAktif = PeriodeAktif::withTrashed()->findOrFail($id);
        $periodeAktif->restore();

        return response()->json(['message' => 'Periode Aktif berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $periodeAktif = PeriodeAktif::withTrashed()->findOrFail($id);

            if (!$periodeAktif->trashed()) {
                return response()->json([
                    'message' => 'Periode Aktif belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $periodeAktif->forceDelete();

            return response()->json([
                'message' => 'Periode Aktif berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Periode Aktif permanen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
