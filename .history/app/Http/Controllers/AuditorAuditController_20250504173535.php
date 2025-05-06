<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditorAuditController extends Controller
{
    public function daftarAuditee(){
        $auditess = PengajuanAmi::with(['auditors', 'auditee'])
                    ->whereHas('auditors', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->get();
        return view('dataauditor.daftar_auditee',[
            'auditess'  =>  $auditess
        ]);
    }

    public function deskEvaluation(PengajuanAmi $pengajuan){
        $dataIkss = PengajuanAmi::with(['auditee.indikatorKinerjas.'])->where('id',$pengajuan->id)->first();
        return view('dataauditor.desk_evaluation');
    }
}
