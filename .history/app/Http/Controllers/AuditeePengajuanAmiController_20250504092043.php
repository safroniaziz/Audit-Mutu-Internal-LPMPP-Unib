<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
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
        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'nip_ketua' => 'required|string|max:255',
            'jenjang' => 'required|string',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'alamat' => 'nullable|string',
        ]);

        try {
            // Update user profile
            $user = Auth::user();
            $user->name = $request->nama_lengkap;
            $user->unitKerja->fakultas = $request->fakultas;
            $user->unitKerja->nama_ketua = $request->nama_ketua;
            $user->unitKerja->nip_ketua = $request->nip_ketua;
            $user->unitKerja->jenjang = $request->jenjang;
            $user->unitKerja->website = $request->website;
            $user->email = $request->email;
            $user->unitKerja->no_hp = $request->no_hp;
            $user->unitKerja->alamat = $request->alamat;

            $user->unitKerja->save();
            $user->save();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!',
                'redirect_url' => route('auditee.dashboard')
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
