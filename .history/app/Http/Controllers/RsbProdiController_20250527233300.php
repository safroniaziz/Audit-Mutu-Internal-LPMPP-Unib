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
        $programStudis = UnitKerja::withCount(['indikatorKinerjas'])->where('jenis_unit_kerja','prodi')->get();
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

    public function tambahIndikator(Request $request)
    {
        $request->validate([
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'indikator_kinerja_id' => 'required|exists:indikator_kinerjas,id',
        ]);

        // Validasi apakah indikator memiliki instrumen
        $indikator = IndikatorKinerja::with('instrumen')->find($request->indikator_kinerja_id);

        if (!$indikator || $indikator->instrumen->count() === 0) {
            return response()->json([
                'message' => 'Indikator Kinerja ini tidak memiliki instrumen!',
                'errors' => ['indikator_kinerja_id' => ['Indikator Kinerja harus memiliki instrumen']]
            ], 422);
        }

        DB::table('rsb_prodis')->updateOrInsert([
            'unit_kerja_id' => $request->unit_kerja_id,
            'indikator_kinerja_id' => $request->indikator_kinerja_id
        ]);

        return response()->json(['message' => 'Indikator Kinerja berhasil ditambahkan']);
    }

    public function hapusIndikator(Request $request)
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
            ->with(['unitKerjas', 'instrumen']) // menggunakan nama relasi yang benar
            ->get()
            ->filter(function ($indikator) use ($unitKerjaId) {
                // Hanya filter yang sudah terpasang di unit kerja ini
                return !$indikator->unitKerjas->contains('id', $unitKerjaId);
            })
            ->map(function ($indikator) {
                // Tambahkan informasi apakah memiliki instrumen
                $indikator->has_instruments = $indikator->instrumen->count() > 0;

                // Tambahkan informasi tambahan untuk frontend
                $indikator->instrumen_count = $indikator->instrumen->count();
                $indikator->disabled_reason = !$indikator->has_instruments ?
                    'Indikator ini belum memiliki instrumen' : null;

                return $indikator;
            })
            ->values(); // reset index array

        return response()->json($indikators);
    }
}
