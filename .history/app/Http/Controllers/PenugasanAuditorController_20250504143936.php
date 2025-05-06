<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenugasanAuditorController extends Controller
{
    public function index(){
        $instrumens = InstrumenProdi::with(['kriteriaInstrumen'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('instrumen_prodi.index',[
            'instrumens'    =>  $instrumens,
            'indikators'    =>  $indikators,
        ]);
    }
}
