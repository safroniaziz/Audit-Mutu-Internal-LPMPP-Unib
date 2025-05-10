<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;

class LaporanHasilAuditController extends Controller
{
    public function index(){
        $penugasanAuditors = PengajuanAmi::with(['auditors','auditee','ikssAuditee.nilai'])
                                ->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('laporan.index',[
            'penugasanAuditors'    =>  $penugasanAuditors,
        ]);
    }

    public function show($id)
    {
        $penugasanAuditor = PengajuanAmi::with(['auditors.auditor', 'auditee', 'ikssAuditee.nilai'])
                                ->withCount('auditors')
                                ->withTrashed()
                                ->findOrFail($id);

        return view('laporan.detail', [
            'penugasanAuditor' => $penugasanAuditor
        ]);
    }

}
