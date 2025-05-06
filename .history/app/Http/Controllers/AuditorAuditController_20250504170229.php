<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditorAuditController extends Controller
{
    public function daftarAuditee(){
        return view('dataauditor.daftar_auditee');
    }

    public function deskEvaluation(){
        return view('dataauditor.desk_evaluation');
    }
}
