<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAktif;
use Illuminate\Http\Request;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodeAktif::where('deleted_at','null')->first();
        return view('auditee.dashboard', compact('periodeAktif'));
    }

}
