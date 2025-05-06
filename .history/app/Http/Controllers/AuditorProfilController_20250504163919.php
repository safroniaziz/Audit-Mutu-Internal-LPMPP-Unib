<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditorProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        return view('dataauditor.dashboard', compact('periodeAktif', 'jadwalData'));
    }


}
