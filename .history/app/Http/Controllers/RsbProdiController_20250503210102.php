<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use App\Models\SatuanStandar;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsbProdiController extends Controller
{
    public function index(){
        $programStudis = UnitKerja::withCount(['instrumenIkss'])->where('jenis_unit_kerja','prodi')->get();
        $satuanStandars = SatuanStandar::all();
        return view('instrumen_rsb_prodi.index',[
            'programStudis'    =>  $programStudis,
            'satuanStandars'    =>  $satuanStandars,
        ]);
    }

    public function modal($unitKerjaId)
    {
        $unitKerja = UnitKerja::with('indikatorKinerjas')->where('jenis_unit_kerja','prodi')->findOrFail($unitKerjaId);
        return response()->json([
            'prodi' => $unitKerja,
            'indikator_terpasang' => $unitKerja->indikatorKinerjas,
        ]);
    }

    public function tambahIndikatorKinerja(Request $request)
    {
        $request->validate([
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
        ]);

        DB::table('rsb_prodis')->updateOrInsert([
            'unit_kerja_id' => $request->unit_kerja_id,
            'indikator_ikss_id' => $request->instrumen_ikss_id
        ]);

        return response()->json(['message' => 'Instrumen berhasil ditambahkan']);
    }

    public function hapusInstrumen(Request $request)
    {
        DB::table('rsb_prodis')
            ->where('unit_kerja_id', $request->unit_kerja_id)
            ->where('instrumen_ikss_id', $request->instrumen_ikss_id)
            ->delete();

        return response()->json(['message' => 'Instrumen berhasil dihapus']);
    }

    public function getIndikatorBySatuan($id)
    {
        $indikators = IndikatorKinerja::where('satuan_standar_id', $id)->get();

        return response()->json($indikators);
    }

    public function getInstrumenByIndikator($id)
    {
        $instrumens = InstrumenIkss::where('indikator_kinerja_id', $id)
            ->whereDoesntHave('unitKerjas', function ($query) {
                $query->where('jenis_unit_kerja', 'prodi');
            })
            ->get();

        return response()->json($instrumens);
    }

}
