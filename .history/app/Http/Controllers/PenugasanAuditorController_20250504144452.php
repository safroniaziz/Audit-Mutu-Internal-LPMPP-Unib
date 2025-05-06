<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;

class PenugasanAuditorController extends Controller
{
    public function index(){
        $datas = PengajuanAmi::with(['auditors','auditee'])->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('penugasan_auditor.index',[
            'datas'    =>  $datas,
        ]);
    }
}
