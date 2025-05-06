<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
