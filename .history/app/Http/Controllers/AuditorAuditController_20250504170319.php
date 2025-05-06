<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;

class AuditorAuditController extends Controller
{
    public function daftarAuditee(){
        $auditess = PengajuanAmi::with(['auditors','auditee'])->get();
        return view('dataauditor.daftar_auditee');
    }

    public function deskEvaluation(){
        return view('dataauditor.desk_evaluation');
    }
}
