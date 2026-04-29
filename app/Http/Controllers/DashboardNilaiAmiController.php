<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use App\Models\PengajuanAmi;
use App\Models\PeriodeAktif;
use App\Models\InstrumenProdi;
use App\Models\InstrumenProdiNilai;
use App\Models\IndikatorInstrumenKriteria;
use App\Models\IndikatorInstrumen;
use App\Models\PenugasanAuditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardNilaiAmiController extends Controller
{
    /**
     * Check if an auditor has completed all stages
     */
    private function isAuditorCompleted($auditor)
    {
        $isSetuju = (bool)$auditor->is_setuju;
        $isSetujuVisitasi = (bool)$auditor->is_setuju_visitasi;
        $isSetujuIndikatorProdi = (bool)$auditor->is_setuju_indikator_prodi;
        
        return $isSetuju && $isSetujuVisitasi && $isSetujuIndikatorProdi;
    }

    /**
     * Get audit status for a pengajuan (how many auditors completed)
     */
    private function getAuditStatus($pengajuan)
    {
        $totalAuditors = $pengajuan->auditors->count();
        $completedAuditors = 0;
        $completedAuditorNames = [];
        
        foreach ($pengajuan->auditors as $auditor) {
            if ($this->isAuditorCompleted($auditor)) {
                $completedAuditors++;
                $completedAuditorNames[] = $auditor->auditor->name ?? 'Unknown';
            }
        }
        
        if ($completedAuditors == $totalAuditors && $totalAuditors > 0) {
            return [
                'status' => 'completed',
                'label' => 'Selesai',
                'color' => 'success',
                'icon' => 'fas fa-check-circle',
                'completed' => $completedAuditors,
                'total' => $totalAuditors,
                'auditor_names' => $completedAuditorNames
            ];
        } elseif ($completedAuditors > 0) {
            return [
                'status' => 'partial',
                'label' => $completedAuditors . ' dari ' . $totalAuditors . ' Auditor',
                'color' => 'warning',
                'icon' => 'fas fa-user-check',
                'completed' => $completedAuditors,
                'total' => $totalAuditors,
                'auditor_names' => $completedAuditorNames
            ];
        } else {
            return [
                'status' => 'not_started',
                'label' => 'Belum Ada Auditor Selesai',
                'color' => 'secondary',
                'icon' => 'fas fa-clock',
                'completed' => 0,
                'total' => $totalAuditors,
                'auditor_names' => []
            ];
        }
    }

    /**
     * Get pengajuan AMI IDs that have at least 1 auditor completed
     */
    private function getAuditedPengajuanIds($periodeId = null)
    {
        $query = PengajuanAmi::with('auditors')
            ->where('is_disetujui', 1);
        
        if ($periodeId) {
            $query->where('periode_id', $periodeId);
        }
        
        $pengajuans = $query->get();
        
        $auditedIds = [];
        
        foreach ($pengajuans as $pengajuan) {
            // Must have at least one auditor
            if ($pengajuan->auditors->isEmpty()) {
                continue;
            }
            
            // Check if at least one auditor has completed all stages
            $hasCompletedAuditor = false;
            
            foreach ($pengajuan->auditors as $auditor) {
                if ($this->isAuditorCompleted($auditor)) {
                    $hasCompletedAuditor = true;
                    break;
                }
            }
            
            if ($hasCompletedAuditor) {
                $auditedIds[] = $pengajuan->id;
            }
        }
        
        return collect($auditedIds);
    }

    public function index(Request $request)
    {
        // Get all fakultas
        $fakultasList = UnitKerja::where('jenis_unit_kerja', 'fakultas')
            ->orderBy('nama_unit_kerja')
            ->get();

        // Get audited pengajuan IDs (at least 1 auditor finished all stages)
        $auditedPengajuanIds = $this->getAuditedPengajuanIds();

        // Get unique fakultas from prodi that have at least 1 completed audit
        $fakultasFromProdi = DB::table('pengajuan_amis as pa')
            ->join('unit_kerjas as uk', 'pa.auditee_id', '=', 'uk.id')
            ->whereIn('pa.id', $auditedPengajuanIds)
            ->whereNotNull('uk.fakultas')
            ->select('uk.fakultas')
            ->distinct()
            ->orderBy('uk.fakultas')
            ->pluck('uk.fakultas');

        // Periode aktif
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periodes for filter
        $periodes = PeriodeAktif::orderBy('tahun_ami', 'desc')
            ->orderBy('siklus', 'desc')
            ->get();

        // Get all indikators (LAM) for filter
        $indikators = DB::table('indikator_instrumens')
            ->whereNull('deleted_at')
            ->orderBy('nama_indikator')
            ->get(['id', 'nama_indikator']);

        return view('dashboard_nilai_ami.index', compact(
            'fakultasList',
            'fakultasFromProdi',
            'periodeAktif',
            'periodes',
            'indikators'
        ));
    }

    /**
     * Get prodi by fakultas (only those with at least 1 auditor completed)
     */
    public function getProdiByFakultas(Request $request)
    {
        $fakultas = $request->input('fakultas');
        $lamId = $request->input('lam_id');
        $periodeId = $request->input('periode_id');
        
        // Get audited pengajuan IDs (at least 1 auditor completed)
        $auditedPengajuanIds = $this->getAuditedPengajuanIds($periodeId);

        $pengajuanQuery = PengajuanAmi::whereIn('id', $auditedPengajuanIds);

        // Optional filter by selected LAM
        if ($lamId) {
            $assignedProdiIds = DB::table('indikator_instrumen_prodi as rel')
                ->join('indikator_instrumens as indikator', 'indikator.id', '=', 'rel.indikator_instrumen_id')
                ->where('rel.indikator_instrumen_id', $lamId)
                ->whereNull('rel.deleted_at')
                ->whereNull('indikator.deleted_at')
                ->pluck('rel.unit_kerja_id');

            $pengajuanQuery->whereIn('auditee_id', $assignedProdiIds);

            $pengajuanQuery->whereExists(function ($query) use ($lamId) {
                $query->select(DB::raw(1))
                    ->from('instrumen_prodi_nilai as ipn')
                    ->join('instrumen_prodis as ip', 'ipn.instrumen_prodi_id', '=', 'ip.id')
                    ->join('indikator_instrumen_kriterias as iik', 'ip.indikator_instrumen_kriteria_id', '=', 'iik.id')
                    ->whereColumn('ipn.pengajuan_ami_id', 'pengajuan_amis.id')
                    ->where('iik.indikator_instrumen_id', $lamId)
                    ->whereNull('ip.deleted_at')
                    ->whereNull('iik.deleted_at');
            });
        }
        
        // Get prodi IDs that have at least 1 completed auditor
        $prodiIdsWithAudit = $pengajuanQuery
            ->pluck('auditee_id');
        
        $prodiQuery = UnitKerja::where('jenis_unit_kerja', 'prodi')
            ->where('fakultas', $fakultas)
            ->whereIn('id', $prodiIdsWithAudit)
            ->orderBy('nama_unit_kerja');

        if ($lamId) {
            $prodiQuery->whereExists(function ($query) use ($lamId) {
                $query->select(DB::raw(1))
                    ->from('indikator_instrumen_prodi as rel')
                    ->join('indikator_instrumens as indikator', 'indikator.id', '=', 'rel.indikator_instrumen_id')
                    ->whereColumn('rel.unit_kerja_id', 'unit_kerjas.id')
                    ->where('rel.indikator_instrumen_id', $lamId)
                    ->whereNull('rel.deleted_at')
                    ->whereNull('indikator.deleted_at');
            });
        }

        $prodi = $prodiQuery->get(['id', 'nama_unit_kerja', 'jenjang']);

        return response()->json($prodi);
    }

    /**
     * Get chart data with filters
     */
    public function getChartData(Request $request)
    {
        $fakultas = $request->input('fakultas');
        $prodiId = $request->input('prodi_id');
        $periodeId = $request->input('periode_id');
        $lamId = $request->input('lam_id'); // Indikator/LAM filter

        // Get audited pengajuan IDs (at least 1 auditor finished all stages)
        $auditedPengajuanIds = $this->getAuditedPengajuanIds($periodeId);

        // Filter by unit kerja
        if ($prodiId) {
            // Specific prodi selected
            $pengajuanIds = PengajuanAmi::whereIn('id', $auditedPengajuanIds)
                ->where('auditee_id', $prodiId)
                ->pluck('id');
        } elseif ($fakultas) {
            // Faculty selected, get all prodi in this faculty
            $prodiIds = UnitKerja::where('jenis_unit_kerja', 'prodi')
                ->where('fakultas', $fakultas)
                ->pluck('id');
            $pengajuanIds = PengajuanAmi::whereIn('id', $auditedPengajuanIds)
                ->whereIn('auditee_id', $prodiIds)
                ->pluck('id');
        } else {
            // All audited data
            $pengajuanIds = $auditedPengajuanIds;
        }

        // Get nilai per kriteria (filtered by LAM if selected)
        $kriteriaScores = $this->getKriteriaScores($pengajuanIds, $lamId);
        
        // Get nilai per indikator
        $indikatorScores = $this->getIndikatorScores($pengajuanIds, $lamId);
        
        // Get nilai per sasaran strategis (IKSS)
        $sasaranScores = $this->getSasaranStrategisScores($pengajuanIds);
        
        // Get nilai per prodi (for comparison) with audit status
        $prodiScores = $this->getProdiScoresWithStatus($pengajuanIds, $fakultas, $prodiId, $lamId);
        
        // Summary statistics
        $summary = $this->getSummaryStats($kriteriaScores);

        return response()->json([
            'kriteriaScores' => $kriteriaScores,
            'indikatorScores' => $indikatorScores,
            'sasaranScores' => $sasaranScores,
            'prodiScores' => $prodiScores,
            'summary' => $summary
        ]);
    }

    /**
     * Get scores grouped by Sasaran Strategis (IKSS)
     */
    private function getSasaranStrategisScores($pengajuanIds)
    {
        if ($pengajuanIds->isEmpty()) {
            return [];
        }

        $scores = DB::table('ikss_auditee_nilais as ian')
            ->join('ikss_auditees as ia', 'ian.ikss_auditee_id', '=', 'ia.id')
            ->join('instrumen_iksses as ii', 'ia.instrumen_id', '=', 'ii.id')
            ->join('indikator_kinerjas as ik', 'ii.indikator_kinerja_id', '=', 'ik.id')
            ->join('satuan_standars as ss', 'ik.satuan_standar_id', '=', 'ss.id')
            ->whereIn('ian.pengajuan_ami_id', $pengajuanIds)
            ->whereNull('ia.deleted_at')
            ->whereNull('ii.deleted_at')
            ->whereNull('ik.deleted_at')
            ->whereNull('ss.deleted_at')
            ->select(
                'ss.id as sasaran_id',
                'ss.kode_satuan',
                'ss.sasaran as nama_sasaran',
                DB::raw('AVG(CAST(ian.nilai AS DECIMAL(10,2))) as rata_rata'),
                DB::raw('SUM(CAST(ian.nilai AS DECIMAL(10,2))) as total_nilai'),
                DB::raw('COUNT(ian.id) as jumlah_penilaian'),
                DB::raw('MAX(CAST(ian.nilai AS DECIMAL(10,2))) as nilai_tertinggi'),
                DB::raw('MIN(CAST(ian.nilai AS DECIMAL(10,2))) as nilai_terendah')
            )
            ->groupBy('ss.id', 'ss.kode_satuan', 'ss.sasaran')
            ->orderBy('ss.kode_satuan')
            ->get();

        return $scores->map(function ($item) {
            return [
                'sasaran_id' => $item->sasaran_id,
                'kode_sasaran' => $item->kode_satuan,
                'nama_sasaran' => $item->nama_sasaran,
                'rata_rata' => round($item->rata_rata, 2),
                'total_nilai' => round($item->total_nilai, 2),
                'jumlah_penilaian' => $item->jumlah_penilaian,
                'nilai_tertinggi' => round($item->nilai_tertinggi, 2),
                'nilai_terendah' => round($item->nilai_terendah, 2)
            ];
        })->toArray();
    }

    /**
     * Get scores grouped by kriteria (filtered by LAM if specified)
     */
    private function getKriteriaScores($pengajuanIds, $lamId = null)
    {
        if ($pengajuanIds->isEmpty()) {
            return [];
        }

        $query = DB::table('instrumen_prodi_nilai as ipn')
            ->join('instrumen_prodis as ip', 'ipn.instrumen_prodi_id', '=', 'ip.id')
            ->join('indikator_instrumen_kriterias as iik', 'ip.indikator_instrumen_kriteria_id', '=', 'iik.id')
            ->whereIn('ipn.pengajuan_ami_id', $pengajuanIds)
            ->whereNull('ip.deleted_at')
            ->whereNull('iik.deleted_at');

        // Filter by LAM/Indikator if specified
        if ($lamId) {
            $query->where('iik.indikator_instrumen_id', $lamId);
        }

        $scores = $query->select(
                'iik.id as kriteria_id',
                'iik.kode_kriteria',
                'iik.nama_kriteria',
                DB::raw('AVG(ipn.nilai) as rata_rata'),
                DB::raw('SUM(ipn.nilai) as total_nilai'),
                DB::raw('COUNT(ipn.id) as jumlah_penilaian'),
                DB::raw('MAX(ipn.nilai) as nilai_tertinggi'),
                DB::raw('MIN(ipn.nilai) as nilai_terendah')
            )
            ->groupBy('iik.id', 'iik.kode_kriteria', 'iik.nama_kriteria')
            ->orderBy('iik.kode_kriteria')
            ->get();

        return $scores->map(function ($item) {
            return [
                'kriteria_id' => $item->kriteria_id,
                'kode_kriteria' => $item->kode_kriteria,
                'nama_kriteria' => $item->nama_kriteria,
                'rata_rata' => round($item->rata_rata, 2),
                'total_nilai' => round($item->total_nilai, 2),
                'jumlah_penilaian' => $item->jumlah_penilaian,
                'nilai_tertinggi' => round($item->nilai_tertinggi, 2),
                'nilai_terendah' => round($item->nilai_terendah, 2)
            ];
        })->toArray();
    }

    /**
     * Get scores grouped by indikator
     */
    private function getIndikatorScores($pengajuanIds, $lamId = null)
    {
        if ($pengajuanIds->isEmpty()) {
            return [];
        }

        $query = DB::table('instrumen_prodi_nilai as ipn')
            ->join('instrumen_prodis as ip', 'ipn.instrumen_prodi_id', '=', 'ip.id')
            ->join('indikator_instrumen_kriterias as iik', 'ip.indikator_instrumen_kriteria_id', '=', 'iik.id')
            ->join('indikator_instrumens as ii', 'iik.indikator_instrumen_id', '=', 'ii.id')
            ->whereIn('ipn.pengajuan_ami_id', $pengajuanIds)
            ->whereNull('ip.deleted_at')
            ->whereNull('iik.deleted_at')
            ->whereNull('ii.deleted_at');

        if ($lamId) {
            $query->where('iik.indikator_instrumen_id', $lamId);
        }

        $scores = $query
            ->select(
                'ii.id as indikator_id',
                'ii.nama_indikator',
                DB::raw('AVG(ipn.nilai) as rata_rata'),
                DB::raw('SUM(ipn.nilai) as total_nilai'),
                DB::raw('COUNT(ipn.id) as jumlah_penilaian')
            )
            ->groupBy('ii.id', 'ii.nama_indikator')
            ->orderBy('ii.nama_indikator')
            ->get();

        return $scores->map(function ($item) {
            return [
                'indikator_id' => $item->indikator_id,
                'kode_indikator' => 'IND-' . $item->indikator_id,
                'nama_indikator' => $item->nama_indikator,
                'rata_rata' => round($item->rata_rata, 2),
                'total_nilai' => round($item->total_nilai, 2),
                'jumlah_penilaian' => $item->jumlah_penilaian
            ];
        })->toArray();
    }

    /**
     * Get scores per prodi for comparison chart with audit status
     * When a specific prodi is selected, show all prodi in the same fakultas for comparison
     */
    private function getProdiScoresWithStatus($pengajuanIds, $fakultas = null, $prodiId = null, $lamId = null)
    {
        // If specific prodi selected, get all prodi in same fakultas for comparison
        if ($prodiId) {
            $selectedProdi = UnitKerja::find($prodiId);
            if ($selectedProdi && $selectedProdi->fakultas) {
                $fakultas = $selectedProdi->fakultas;
            }
        }

        // Get periode from original pengajuan if available
        $periodeId = null;
        if (!$pengajuanIds->isEmpty()) {
            $firstPengajuan = PengajuanAmi::whereIn('id', $pengajuanIds)->first();
            if ($firstPengajuan) {
                $periodeId = $firstPengajuan->periode_id;
            }
        }

        // Get audited pengajuan IDs for the same periode (at least 1 auditor completed)
        $auditedPengajuanIds = $this->getAuditedPengajuanIds($periodeId);
        
        // Filter by fakultas if specified
        if ($fakultas) {
            $fakultasProdiIds = UnitKerja::where('jenis_unit_kerja', 'prodi')
                ->where('fakultas', $fakultas)
                ->pluck('id');
            $comparisonPengajuanIds = PengajuanAmi::whereIn('id', $auditedPengajuanIds)
                ->whereIn('auditee_id', $fakultasProdiIds)
                ->pluck('id');
        } else {
            $comparisonPengajuanIds = $auditedPengajuanIds;
        }

        if ($comparisonPengajuanIds->isEmpty()) {
            return [];
        }

        // Get pengajuan data for audit status
        $pengajuanData = PengajuanAmi::with(['auditors.auditor', 'auditee'])
            ->whereIn('id', $comparisonPengajuanIds)
            ->get()
            ->keyBy('auditee_id');

        $scoresQuery = DB::table('instrumen_prodi_nilai as ipn')
            ->join('pengajuan_amis as pa', 'ipn.pengajuan_ami_id', '=', 'pa.id')
            ->join('unit_kerjas as uk', 'pa.auditee_id', '=', 'uk.id')
            ->join('instrumen_prodis as ip', 'ipn.instrumen_prodi_id', '=', 'ip.id')
            ->join('indikator_instrumen_kriterias as iik', 'ip.indikator_instrumen_kriteria_id', '=', 'iik.id')
            ->whereIn('ipn.pengajuan_ami_id', $comparisonPengajuanIds)
            ->whereNull('uk.deleted_at')
            ->whereNull('ip.deleted_at')
            ->whereNull('iik.deleted_at')
            ->select(
                'uk.id as prodi_id',
                'uk.nama_unit_kerja',
                'uk.jenjang',
                'uk.fakultas',
                DB::raw('AVG(ipn.nilai) as rata_rata'),
                DB::raw('SUM(ipn.nilai) as total_nilai'),
                DB::raw('COUNT(ipn.id) as jumlah_penilaian')
            )
            ->groupBy('uk.id', 'uk.nama_unit_kerja', 'uk.jenjang', 'uk.fakultas');

        if ($lamId) {
            $scoresQuery->where('iik.indikator_instrumen_id', $lamId);
        }

        $scores = $scoresQuery
            ->orderBy('rata_rata', 'desc')
            ->get();

        return $scores->map(function ($item) use ($prodiId, $pengajuanData) {
            // Get audit status for this prodi
            $pengajuan = $pengajuanData->get($item->prodi_id);
            $auditStatus = $pengajuan ? $this->getAuditStatus($pengajuan) : null;
            
            return [
                'prodi_id' => $item->prodi_id,
                'nama_prodi' => $item->nama_unit_kerja,
                'jenjang' => $item->jenjang,
                'fakultas' => $item->fakultas,
                'rata_rata' => round($item->rata_rata, 2),
                'total_nilai' => round($item->total_nilai, 2),
                'jumlah_penilaian' => $item->jumlah_penilaian,
                'is_selected' => ($item->prodi_id == $prodiId),
                'audit_status' => $auditStatus
            ];
        })->toArray();
    }

    /**
     * Get summary statistics
     */
    private function getSummaryStats($kriteriaScores)
    {
        if (empty($kriteriaScores)) {
            return [
                'rata_rata_keseluruhan' => 0,
                'total_kriteria' => 0,
                'total_penilaian' => 0,
                'nilai_tertinggi' => 0,
                'nilai_terendah' => 0,
                'kriteria_tertinggi' => null,
                'kriteria_terendah' => null
            ];
        }

        $collection = collect($kriteriaScores);
        $totalPenilaian = $collection->sum('jumlah_penilaian');
        $weightedSum = $collection->sum(function ($item) {
            return $item['rata_rata'] * $item['jumlah_penilaian'];
        });

        $rataRataKeseluruhan = $totalPenilaian > 0 ? $weightedSum / $totalPenilaian : 0;

        $kriteriaTertinggi = $collection->sortByDesc('rata_rata')->first();
        $kriteriaTerendah = $collection->sortBy('rata_rata')->first();

        return [
            'rata_rata_keseluruhan' => round($rataRataKeseluruhan, 2),
            'total_kriteria' => count($kriteriaScores),
            'total_penilaian' => $totalPenilaian,
            'nilai_tertinggi' => $collection->max('rata_rata'),
            'nilai_terendah' => $collection->min('rata_rata'),
            'kriteria_tertinggi' => $kriteriaTertinggi,
            'kriteria_terendah' => $kriteriaTerendah
        ];
    }

    /**
     * Get fakultas summary for faculty comparison
     */
    public function getFakultasSummary(Request $request)
    {
        $periodeId = $request->input('periode_id');

        $pengajuanQuery = PengajuanAmi::where('is_disetujui', 1);
        
        if ($periodeId) {
            $pengajuanQuery->where('periode_id', $periodeId);
        }

        $pengajuanIds = $pengajuanQuery->pluck('id');

        if ($pengajuanIds->isEmpty()) {
            return response()->json([]);
        }

        $scores = DB::table('instrumen_prodi_nilai as ipn')
            ->join('pengajuan_amis as pa', 'ipn.pengajuan_ami_id', '=', 'pa.id')
            ->join('unit_kerjas as uk', 'pa.auditee_id', '=', 'uk.id')
            ->whereIn('ipn.pengajuan_ami_id', $pengajuanIds)
            ->whereNull('uk.deleted_at')
            ->whereNotNull('uk.fakultas')
            ->select(
                'uk.fakultas',
                DB::raw('AVG(ipn.nilai) as rata_rata'),
                DB::raw('SUM(ipn.nilai) as total_nilai'),
                DB::raw('COUNT(DISTINCT uk.id) as jumlah_prodi'),
                DB::raw('COUNT(ipn.id) as jumlah_penilaian')
            )
            ->groupBy('uk.fakultas')
            ->orderBy('rata_rata', 'desc')
            ->get();

        return response()->json($scores);
    }
}
