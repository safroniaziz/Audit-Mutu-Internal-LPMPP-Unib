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

        $unitKerja = PeriodeAktif::create([
            'nomor_surat' => $request->nomor_surat,
            'siklus' => $request->siklus,
            'tahun_ami' => $request->tahun_ami,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Periode Aktif berhasil ditambahkan!',
            'data' => $unitKerja
        ]);
    }

    public function edit(PeriodeAktif $unitKerja)
    {
        if (!$unitKerja) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $unitKerja]);
    }

    public function update(Request $request, PeriodeAktif $unitKerja)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string',
            'nomor_surat' => 'required|string|unique:surat_ami,nomor_surat,' . $id,
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

        $unitKerja->kode_unit_kerja = $request->kode_unit_kerja;
        $unitKerja->nama_unit_kerja = $request->nama_unit_kerja;
        $unitKerja->jenis_unit_kerja = $request->jenis_unit_kerja;
        $unitKerja->jenjang = $request->jenjang;
        $unitKerja->fakultas = $request->jenis_unit_kerja === 'fakultas' ? null : $request->fakultas;
        $unitKerja->save();

        return response()->json([
            'message' => 'Periode Aktif berhasil diperbarui!',
            'data' => $unitKerja
        ]);
    }

    public function nonaktifkan(PeriodeAktif $unitKerja)
    {
        try {
            $unitKerja->delete();
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
        $unitkerja = PeriodeAktif::withTrashed()->findOrFail($id);
        $unitkerja->restore();  // Mengembalikan data yang terhapus

        return response()->json(['message' => 'Periode Aktif berhasil dipulihkan!']);
    }

    public function destroyPermanent($id)
    {
        try {
            $unitKerja = PeriodeAktif::withTrashed()->findOrFail($id);

            if (!$unitKerja->trashed()) {
                return response()->json([
                    'message' => 'Periode Aktif belum dinonaktifkan, tidak bisa dihapus permanen!'
                ], 400);
            }

            $unitKerja->forceDelete();

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
