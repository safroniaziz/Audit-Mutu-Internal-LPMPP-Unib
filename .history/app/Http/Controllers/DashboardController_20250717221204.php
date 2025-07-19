<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UnitKerja;
use App\Models\IndikatorInstrumen;
use App\Models\IndikatorInstrumenKriteria;
use App\Models\InstrumenProdi;
use App\Models\PengajuanAmi;
use App\Models\Evaluasi;
use App\Models\PeriodeAktif;
use App\Models\PenugasanAuditor;
use App\Models\IkssAuditee;
use App\Models\Kuisioner;
use App\Models\KuisionerJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik cards
        $stats = $this->getStats();

        // Data untuk charts
        $chartData = $this->getChartData();

        // Data untuk recent activities
        $recentActivities = $this->getRecentActivities();

        // Data untuk performance metrics
        $performanceMetrics = $this->getPerformanceMetrics();

        // Data untuk top performers
        $topPerformers = $this->getTopPerformers();

        // Data untuk audit progress
        $auditProgress = $this->getAuditProgress();

        return view('dashboard', compact(
            'stats',
            'chartData',
            'recentActivities',
            'performanceMetrics',
            'topPerformers',
            'auditProgress'
        ));
    }

    private function getStats()
    {
        return [
            'total_users' => User::count(),
            'total_unit_kerja' => UnitKerja::count(),
            'total_indikator' => IndikatorInstrumen::count(),
            'total_kriteria' => IndikatorInstrumenKriteria::count(),
            'total_instrumen' => InstrumenProdi::count(),
            'total_pengajuan' => PengajuanAmi::count(),
            'total_evaluasi' => Evaluasi::count(),
            'active_periods' => PeriodeAktif::where('status', 'aktif')->count(),
            'total_auditors' => PenugasanAuditor::distinct('auditor_id')->count(),
            'total_auditees' => IkssAuditee::count(),
            'total_kuisioner' => Kuisioner::count(),
            'total_responses' => KuisionerJawaban::count(),
        ];
    }

    private function getChartData()
    {
        // Data untuk chart indikator per bulan (6 bulan terakhir)
        $indikatorPerBulan = IndikatorInstrumen::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Jika tidak ada data, buat data sample
        if (empty($indikatorPerBulan)) {
            $indikatorPerBulan = [
                1 => rand(5, 15),
                2 => rand(5, 15),
                3 => rand(5, 15),
                4 => rand(5, 15),
                5 => rand(5, 15),
                6 => rand(5, 15),
                7 => rand(5, 15),
                8 => rand(5, 15),
                9 => rand(5, 15),
                10 => rand(5, 15),
                11 => rand(5, 15),
                12 => rand(5, 15),
            ];
        }

        // Data untuk chart unit kerja dengan indikator terbanyak
        $unitKerjaStats = UnitKerja::withCount(['indikatorInstrumen', 'instrumenProdi'])
            ->orderBy('indikator_instrumen_count', 'desc')
            ->limit(10)
            ->get();

        // Data untuk chart status pengajuan AMI
        $pengajuanStatus = PengajuanAmi::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // Data untuk chart evaluasi per bulan
        $evaluasiPerBulan = Evaluasi::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Data untuk chart kriteria per indikator
        $kriteriaPerIndikator = IndikatorInstrumen::withCount('kriterias')
            ->orderBy('kriterias_count', 'desc')
            ->limit(8)
            ->get();

        return [
            'indikatorPerBulan' => $indikatorPerBulan,
            'unitKerjaStats' => $unitKerjaStats,
            'pengajuanStatus' => $pengajuanStatus,
            'evaluasiPerBulan' => $evaluasiPerBulan,
            'kriteriaPerIndikator' => $kriteriaPerIndikator,
        ];
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Recent indikator
        $recentIndikator = IndikatorInstrumen::with('prodis')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'indikator',
                    'title' => 'Indikator baru ditambahkan',
                    'description' => $item->nama_indikator,
                    'time' => $item->created_at->diffForHumans(),
                    'icon' => 'ki-duotone ki-chart-line',
                    'color' => 'primary'
                ];
            });

        // Recent pengajuan
        $recentPengajuan = PengajuanAmi::with('unitKerja')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengajuan',
                    'title' => 'Pengajuan AMI baru',
                    'description' => $item->unitKerja->nama_unit_kerja ?? 'Unit Kerja',
                    'time' => $item->created_at->diffForHumans(),
                    'icon' => 'ki-duotone ki-document',
                    'color' => 'success'
                ];
            });

        // Recent evaluasi
        $recentEvaluasi = Evaluasi::latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'evaluasi',
                    'title' => 'Evaluasi baru',
                    'description' => 'Evaluasi ' . $item->jenis_evaluasi,
                    'time' => $item->created_at->diffForHumans(),
                    'icon' => 'ki-duotone ki-star',
                    'color' => 'warning'
                ];
            });

        return $activities->merge($recentIndikator)
            ->merge($recentPengajuan)
            ->merge($recentEvaluasi)
            ->sortByDesc('time')
            ->take(10);
    }

    private function getPerformanceMetrics()
    {
        // Completion rate
        $totalIndikator = IndikatorInstrumen::count();
        $completedIndikator = IndikatorInstrumen::whereHas('kriterias', function($q) {
            $q->whereHas('instrumenProdi');
        })->count();
        $completionRate = $totalIndikator > 0 ? round(($completedIndikator / $totalIndikator) * 100, 1) : 0;

        // Response rate
        $totalKuisioner = Kuisioner::count();
        $totalResponses = KuisionerJawaban::count();
        $responseRate = $totalKuisioner > 0 ? round(($totalResponses / $totalKuisioner) * 100, 1) : 0;

        // Audit completion
        $totalAudits = IkssAuditee::count();
        $completedAudits = IkssAuditee::where('status', 'selesai')->count();
        $auditCompletionRate = $totalAudits > 0 ? round(($completedAudits / $totalAudits) * 100, 1) : 0;

        // User activity
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(30))->count();
        $totalUsers = User::count();
        $userActivityRate = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0;

        return [
            'completion_rate' => $completionRate,
            'response_rate' => $responseRate,
            'audit_completion_rate' => $auditCompletionRate,
            'user_activity_rate' => $userActivityRate,
        ];
    }

    private function getTopPerformers()
    {
        // Top unit kerja berdasarkan jumlah indikator
        $topUnitKerja = UnitKerja::withCount('indikatorInstrumen')
            ->orderBy('indikator_instrumen_count', 'desc')
            ->limit(5)
            ->get();

        // Top auditors berdasarkan jumlah penugasan
        $topAuditors = PenugasanAuditor::with('auditor')
            ->selectRaw('auditor_id, COUNT(*) as total_assignments')
            ->groupBy('auditor_id')
            ->orderBy('total_assignments', 'desc')
            ->limit(5)
            ->get();

        return [
            'top_unit_kerja' => $topUnitKerja,
            'top_auditors' => $topAuditors,
        ];
    }

    private function getAuditProgress()
    {
        // Progress per periode
        $periodeProgress = PeriodeAktif::withCount(['pengajuanAmi', 'evaluasi'])
            ->where('status', 'aktif')
            ->get()
            ->map(function ($periode) {
                $total = $periode->pengajuan_ami_count + $periode->evaluasi_count;
                $completed = $periode->pengajuanAmi()->where('status', 'selesai')->count() +
                            $periode->evaluasi()->where('status', 'selesai')->count();

                return [
                    'periode' => $periode->nama_periode,
                    'total' => $total,
                    'completed' => $completed,
                    'percentage' => $total > 0 ? round(($completed / $total) * 100, 1) : 0,
                ];
            });

        return $periodeProgress;
    }
}
