<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditeePengajuanAmiController extends Controller
{
    public function index(){
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        return view('auditee/pengajuan_ami/index',[
            'periodeAktif'  =>  $periodeAktif,
            'jadwalData'  =>  $jadwalData,
        ]);
    }

    public function lengkapiProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'nip_ketua' => 'required|string|max:255',
            'jenjang' => 'required|string',
            'website' => 'required|url',
            'email' => 'required|email',
            'no_hp' => 'required|string',
        ], [
            'nama_ketua.required' => 'Nama Ketua wajib diisi.',
            'nip_ketua.required' => 'NIP Ketua wajib diisi.',
            'jenjang.required' => 'Jenjang wajib dipilih.',
            'website.required' => 'Website wajib dipilih.',
            'website.url' => 'Website harus berupa URL yang valid.',
            'email.required' => 'E-mail wajib diisi.',
            'email.email' => 'E-mail harus berupa alamat email yang valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        try {
            $unitKerja = UnitKerja::where('id', Auth::user()->unit_kerja_id)->update([
                'nama_ketua' => $request->nama_ketua,
                'nip_ketua' => $request->nip_ketua,
                'jenjang' => $request->jenjang,
                'website' => $request->website,
                'no_hp' => $request->no_hp,
            ]);

            // Now create or link the User
            $auditee = User::where('id', Auth::user()->id)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'unit_kerja_id' => Auth::user()->unit_kerja_id, // Fix: Directly use unit_kerja_id from auth user
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!',
                'redirect_url' => route('auditee.pengajuanAmi')
            ]);
            
        } catch (\Exception $e) {
            // Handle exception and return error response
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
