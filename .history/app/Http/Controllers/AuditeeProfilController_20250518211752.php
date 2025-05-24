<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        $dokumenAmis = DokumenAmi::where('kategori_dokumen','auditee')->orderBy('created_at','desc')->get();
        return view('auditee.dashboard', compact('periodeAktif', 'jadwalData','dokumenAmis'));
    }

}
