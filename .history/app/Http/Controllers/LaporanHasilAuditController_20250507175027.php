<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;

class LaporanHasilAuditController extends Controller
{
    public function index(){
        $penugasanAuditors = PengajuanAmi::with(['auditors','auditee','ikssAuditee.nilai.auditor'])
                                ->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('laporan.index',[
            'penugasanAuditors'    =>  $penugasanAuditors,
        ]);
    }
}
