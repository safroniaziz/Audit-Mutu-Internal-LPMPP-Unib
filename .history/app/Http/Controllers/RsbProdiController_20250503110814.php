<?php

namespace App\Http\Controllers;

use App\Models\InstrumenIkss;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsbProdiController extends Controller
{
    public function index(){
        $programStudis = UnitKerja::withCount(['instrumenIkss'])->where('jenis_unit_kerja','prodi')->get();
        return view('instrumen_rsb_prodi.index',[
            'programStudis'    =>  $programStudis,
        ]);
    }

    public function modal($unitKerjaId)
    {
        $unitKerja = UnitKerja::with('instrumenIkss')->where('jenis_unit_kerja','prodi')->findOrFail($unitKerjaId);
        $semuaInstrumen = InstrumenIkss::all();

        return response()->json([
            'prodi' => $unitKerja,
            'instrumen_terpasang' => $unitKerja->instrumenIkss,
            'semua_instrumen' => $semuaInstrumen,
        ]);
    }

    public function tambahInstrumen(Request $request)
    {
        $request->validate([
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'instrumen_ikss_id' => 'required|exists:instrumen_ikss,id',
        ]);

        DB::table('rsb_prodi')->updateOrInsert([
            'unit_kerja_id' => $request->unit_kerja_id,
            'instrumen_ikss_id' => $request->instrumen_ikss_id
        ]);

        return response()->json(['message' => 'Instrumen berhasil ditambahkan']);
    }

    public function hapusInstrumen(Request $request)
    {
        DB::table('rsb_prodi')
            ->where('unit_kerja_id', $request->unit_kerja_id)
            ->where('instrumen_ikss_id', $request->instrumen_ikss_id)
            ->delete();

        return response()->json(['message' => 'Instrumen berhasil dihapus']);
    }
}
