<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsbProdiController extends Controller
{
    public function index(){
        $programStudis = UnitKerja::withCount(['instrumenIkss'])->where('jenis_unit_kerja','prodi')->get();
        $indikators = IndikatorKinerja::all();
        return view('instrumen_rsb_prodi.index',[
            'programStudis'    =>  $programStudis,
            'indikators'    =>  $indikators,
        ]);
    }

    public function modal($unitKerjaId)
    {
        $unitKerja = UnitKerja::with('instrumenIkss')->where('jenis_unit_kerja','prodi')->findOrFail($unitKerjaId);
        return response()->json([
            'prodi' => $unitKerja,
            'instrumen_terpasang' => $unitKerja->instrumenIkss,
        ]);
    }

    public function tambahInstrumen(Request $request)
    {
        $request->validate([
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'instrumen_ikss_id' => 'required|exists:instrumen_iksses,id',
        ]);

        DB::table('rsb_prodis')->updateOrInsert([
            'unit_kerja_id' => $request->unit_kerja_id,
            'instrumen_ikss_id' => $request->instrumen_ikss_id
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

    // InstrumenIkssController.php

    // Ambil indikator berdasarkan Sasaran Strategis yang dipilih
    public function getIndikatorBySatuan($id)
    {
        $indikators = IndikatorKinerja::where('satuan_standar_id', $id)->get();

        return response()->json($indikators);
    }

    // Ambil instrumen berdasarkan indikator yang dipilih
    public function getInstrumenByIndikator($id)
    {
        $instrumens = InstrumenIkss::where('indikator_ikss_id', $id)->get();

        return response()->json($instrumens);
    }

}
