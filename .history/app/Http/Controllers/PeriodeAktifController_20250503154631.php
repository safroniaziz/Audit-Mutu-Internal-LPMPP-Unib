<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use App\Models\PeriodeAktifJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class PeriodeAktifController extends Controller
{
    public function index(){
        $periodeAktifs = PeriodeAktif::withTrashed()
                        ->with(['jadwal'])
                        ->orderByRaw('deleted_at IS NULL DESC')  // Mengurutkan deleted_at yang null di atas
                        ->orderBy('tahun_ami', 'desc')           // Mengurutkan tahun_ami secara descending
                        ->get();
                        return $periodeAktifs;
        return view('periode_aktif.index',[
            'periodeAktifs'    =>  $periodeAktifs,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string',
            'siklus' => 'required|string',
            'tahun_ami' => 'required|string',
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'siklus.required' => 'Siklus wajib diisi.',
            'tahun_ami.required' => 'Tahun AMI wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        PeriodeAktif::whereNull('deleted_at')->update(['deleted_at' => Carbon::now()]);

        $periodeAktif = PeriodeAktif::create([
            'nomor_surat' => $request->nomor_surat,
            'siklus' => $request->siklus,
            'tahun_ami' => $request->tahun_ami,
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
        ], [
            'nomor_surat.required' => 'Nomor surat harus diisi saat mengedit data.',
            'siklus.required' => 'Siklus harus diisi saat mengedit data.',
            'tahun_ami.required' => 'Tahun AMI harus diisi saat mengedit data.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $periodeAktif->nomor_surat = $request->nomor_surat;
        $periodeAktif->siklus = $request->siklus;
        $periodeAktif->tahun_ami = $request->tahun_ami;
        $periodeAktif->status = $request->status;
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

        if (is_null($periodeAktif->deleted_at)) {
            return response()->json([
                'message' => 'Data ini belum dihapus, tidak perlu dipulihkan.',
            ], 400);
        }

        PeriodeAktif::where('id', '!=', $id)->whereNull('deleted_at')->update([
            'deleted_at' => now()
        ]);

        $periodeAktif->restore();

        return response()->json(['message' => 'Periode Aktif berhasil dipulihkan dan lainnya dinonaktifkan.']);
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

    public function aturJadwal(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'periode_id' => 'required|exists:periode_aktifs,id',
                'jadwal' => 'required|string',
                'tanggal' => 'required|string',
            ]);

            // Cek apakah jadwal untuk periode ini sudah ada
            $existingJadwal = PeriodeAktifJadwal::where('periode_aktif_id', $validated['periode_id'])
                                    ->where('jenis', $validated['jadwal'])
                                    ->first();

            $range = explode(' - ', $validated['tanggal']);
            $waktuMulai = isset($range[0]) ? date('Y-m-d H:i:s', strtotime(trim($range[0]))) : null;
            $waktuSelesai = isset($range[1]) ? date('Y-m-d H:i:s', strtotime(trim($range[1]))) : null;

            if ($existingJadwal) {
                $existingJadwal->waktu_mulai = $waktuMulai;
                $existingJadwal->waktu_selesai = $waktuSelesai;
                $existingJadwal->save();
            } else {
                $jadwal = new PeriodeAktifJadwal();
                $jadwal->periode_aktif_id = $validated['periode_id'];
                $jadwal->jenis = $validated['jadwal'];
                $jadwal->waktu_mulai = $waktuMulai;
                $jadwal->waktu_selesai = $waktuSelesai;
                $jadwal->save();
            }

            return response()->json(['status' => 'success', 'message' => 'Jadwal berhasil diatur.']);
        } catch (ValidationException $e) {
            // Menangkap error validasi
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Menangkap error lainnya
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

}
