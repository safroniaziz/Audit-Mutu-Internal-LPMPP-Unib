<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use Illuminate\Http\Request;

class PenugasanAuditorController extends Controller
{
    public function index(){
        $instrumens = PengajuanAmi::with(['auditors'])->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('instrumen_prodi.index',[
            'instrumens'    =>  $instrumens,
        ]);
    }
}
