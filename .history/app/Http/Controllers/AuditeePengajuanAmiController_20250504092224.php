<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Auth;

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
            // Create a new Auditee or UnitKerja data
            $unitKerja = UnitKerja::where('')->update([
                'fakultas' => $request->fakultas,
                'nama_ketua' => $request->nama_ketua,
                'nip_ketua' => $request->nip_ketua,
                'jenjang' => $request->jenjang,
                'website' => $request->website,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'logo' => $request->hasFile('logo') ? $request->file('logo')->store('public/logos') : null,
            ]);

            // Now create or link the User
            $auditee = Auditee::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'unit_kerja_id' => $unitKerja->id, // Assume there's a relation to unit_kerja
            ]);

            // Optionally, associate the user with this auditee
            $user = new User();
            $user->name = $auditee->nama_lengkap;
            $user->email = $auditee->email;
            $user->password = bcrypt('defaultpassword'); // You may want to create a default password or handle password logic
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
