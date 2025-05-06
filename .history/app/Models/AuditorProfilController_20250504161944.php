<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditorProfilController extends Model
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        return view('auditor.dashboard', compact('periodeAktif', 'jadwalData'));
    }
}
