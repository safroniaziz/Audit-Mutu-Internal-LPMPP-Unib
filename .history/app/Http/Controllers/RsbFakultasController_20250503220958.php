<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use App\Models\SatuanStandar;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsbFakultasController extends Controller
{
    public function index(){
        $fakultas = UnitKerja::withCount(['indikatorKinerjas'])->where('jenis_unit_kerja','fakultas')->get();
        $satuanStandars = SatuanStandar::all();
        return view('instrumen_rsb_fakultas.index',[
            'fakultas'    =>  $fakultas,
            'satuanStandars'    =>  $satuanStandars,
        ]);
    }

    public function modal($unitKerjaId)
    {
        $unitKerja = UnitKerja::with('indikatorKinerjas')->where('jenis_unit_kerja','fakultas')->findOrFail($unitKerjaId);
        return response()->json([
            'fakultas' => $unitKerja,
            'indikator_terpasang' => $unitKerja->instrumenIkss,
        ]);
    }

    public function tambahIndikator(Request $request)
    {
        $request->validate([
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
        ]);

        DB::table('rsb_prodis')->updateOrInsert([
            'unit_kerja_id' => $request->unit_kerja_id,
            'indikator_kinerja_id' => $request->indikator_kinerja_id
        ]);

        return response()->json(['message' => 'Indikator Kinerja berhasil ditambahkan']);
    }

    public function hapusInstrumen(Request $request)
    {
        DB::table('rsb_prodis')
            ->where('unit_kerja_id', $request->unit_kerja_id)
            ->where('indikator_kinerja_id', $request->indikator_kinerja_id)
            ->delete();

        return response()->json(['message' => 'Indikator Kinerja berhasil dihapus']);
    }

    public function getIndikatorBySatuan($satuanId, Request $request)
    {
        $unitKerjaId = $request->input('unit_kerja_id');

        // Ambil semua indikator dengan satuan tertentu
        $indikators = IndikatorKinerja::where('satuan_standar_id', $satuanId)
            ->with('unitKerjas') // eager load biar tidak N+1
            ->get()
            ->filter(function ($indikator) use ($unitKerjaId) {
                // Cek apakah indikator ini sudah terhubung dengan unit kerja
                return !$indikator->unitKerjas->contains('id', $unitKerjaId);
            })
            ->values(); // reset index array

        return response()->json($indikators);
    }
}
