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
use App\Services\UserActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Stats
        $stats = [
            'total_pengajuan' => PengajuanAmi::count(),
            'pengajuan_disetujui' => PengajuanAmi::where('status', 'disetujui')->count(),
            'pengajuan_menunggu' => PengajuanAmi::where('status', 'menunggu')->count(),
            'pengajuan_ditolak' => PengajuanAmi::where('status', 'ditolak')->count(),

            'audit_aktif' => PenugasanAuditor::whereHas('periodeAktif', function($query) {
                $query->where('status', 'aktif');
            })->count(),

            'evaluasi_selesai' => Evaluasi::where('status', 'selesai')->count(),
            'total_evaluasi' => Evaluasi::count(),
            'rata_rata_skor' => Evaluasi::where('status', 'selesai')->avg('skor') ?? 0,
            'tingkat_kepatuhan' => $this->calculateComplianceRate(),

            'total_users' => User::whereIn('role', ['auditor', 'auditee'])->count(),
            'active_users' => User::whereIn('role', ['auditor', 'auditee'])
                ->where('last_login_at', '>=', now()->subDays(30))
                ->count(),
            'user_activity' => $this->calculateUserActivity(),
            'login_today' => User::whereIn('role', ['auditor', 'auditee'])
                ->whereDate('last_login_at', today())
                ->count(),
        ];

        // Periode aktif info
        $periodeAktif = PeriodeAktif::where('status', 'aktif')->first();
        if ($periodeAktif) {
            $stats['periode_aktif'] = $periodeAktif->nama_periode;
            $stats['target_selesai'] = $periodeAktif->tanggal_selesai ? $periodeAktif->tanggal_selesai->format('d M Y') : '-';
            $stats['progress_audit'] = $this->calculateAuditProgress($periodeAktif);
        }

        // Chart Data
        $chartData = [
            'pengajuan' => [
                'disetujui' => $stats['pengajuan_disetujui'],
                'menunggu' => $stats['pengajuan_menunggu'],
                'ditolak' => $stats['pengajuan_ditolak']
            ],
            'indikator' => $this->getIndikatorChartData()
        ];

        // Performance Metrics
        $performanceMetrics = [
            'kepatuhan' => $stats['tingkat_kepatuhan'],
            'efisiensi' => $this->calculateEfficiency(),
            'kualitas' => $this->calculateQuality(),
            'kepuasan' => $this->calculateSatisfaction()
        ];

        // Recent Activities
        $recentActivities = Activity::with('causer')
            ->latest()
            ->take(10)
            ->get();

        // Top Performers
        $topPerformers = [
            'auditors' => $this->getTopAuditors(),
            'units' => $this->getTopUnits()
        ];

        return view('dashboard', compact(
            'stats',
            'chartData',
            'performanceMetrics',
            'recentActivities',
            'topPerformers'
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
            'active_periods' => PeriodeAktif::count(),
            'total_auditors' => PenugasanAuditor::distinct('user_id')->count(),
            'total_auditees' => IkssAuditee::count(),
            'total_kuisioner' => Kuisioner::count(),
            'total_responses' => KuisionerJawaban::count(),
        ];
    }

    private function getChartData()
    {
        // Data untuk chart distribusi indikator per unit kerja
        $unitKerjaStats = UnitKerja::withCount(['indikatorInstrumens'])
            ->having('indikator_instrumens_count', '>', 0)
            ->orderBy('indikator_instrumens_count', 'desc')
            ->limit(8)
            ->get();

        // Data untuk chart status pengajuan AMI berdasarkan is_disetujui
        $pengajuanStatus = PengajuanAmi::selectRaw('is_disetujui, COUNT(*) as total')
            ->groupBy('is_disetujui')
            ->get()
            ->pluck('total', 'is_disetujui')
            ->toArray();

        // Pastikan ada data untuk kedua status (0 dan 1)
        if (!isset($pengajuanStatus[0])) {
            $pengajuanStatus[0] = 0; // Belum disetujui
        }
        if (!isset($pengajuanStatus[1])) {
            $pengajuanStatus[1] = 0; // Sudah disetujui
        }

        // Data untuk chart kriteria per indikator
        $kriteriaPerIndikator = IndikatorInstrumen::withCount('kriterias')
            ->orderBy('kriterias_count', 'desc')
            ->limit(8)
            ->get();

        // Data untuk chart jenis unit kerja
        $jenisUnitKerja = UnitKerja::selectRaw('jenis_unit_kerja, COUNT(*) as total')
            ->groupBy('jenis_unit_kerja')
            ->get()
            ->pluck('total', 'jenis_unit_kerja')
            ->toArray();

        // Data untuk chart evaluasi per jenis
        $evaluasiPerJenis = Evaluasi::selectRaw('jenis_evaluasi, COUNT(*) as total')
            ->groupBy('jenis_evaluasi')
            ->get()
            ->pluck('total', 'jenis_evaluasi')
            ->toArray();

        return [
            'unitKerjaStats' => $unitKerjaStats,
            'pengajuanStatus' => $pengajuanStatus,
            'kriteriaPerIndikator' => $kriteriaPerIndikator,
            'jenisUnitKerja' => $jenisUnitKerja,
            'evaluasiPerJenis' => $evaluasiPerJenis,
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
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                    'icon' => 'ki-duotone ki-chart-line',
                    'color' => 'primary'
                ];
            });

        // Recent pengajuan
        $recentPengajuan = PengajuanAmi::with('auditee')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengajuan',
                    'title' => 'Pengajuan AMI baru',
                    'description' => $item->auditee->nama_unit_kerja ?? 'Unit Kerja',
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
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
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                    'icon' => 'ki-duotone ki-star',
                    'color' => 'warning'
                ];
            });

        // Recent user activities (login/logout)
        $recentUserActivities = UserActivityService::getRecentActivities(5)
            ->map(function ($activity) {
                $action = $activity->log_name === 'user_login' ? 'Login' : 'Logout';
                return [
                    'type' => 'user_activity',
                    'title' => 'User ' . $action,
                    'description' => $activity->causer->name ?? 'User',
                    'time' => $activity->created_at ? $activity->created_at->diffForHumans() : '-',
                    'icon' => $activity->log_name === 'user_login' ? 'ki-duotone ki-profile-user' : 'ki-duotone ki-exit',
                    'color' => $activity->log_name === 'user_login' ? 'success' : 'warning'
                ];
            });

        return $activities->merge($recentIndikator)
            ->merge($recentPengajuan)
            ->merge($recentEvaluasi)
            ->merge($recentUserActivities)
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

        // User activity - menggunakan service
        $activeUsers = UserActivityService::getActiveUsersCount(30);
        $totalUsers = UserActivityService::getTotalUsersCount();
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
        $topUnitKerja = UnitKerja::withCount('indikatorInstrumens')
            ->orderBy('indikator_instrumens_count', 'desc')
            ->limit(5)
            ->get();

        // Top auditors berdasarkan jumlah penugasan
        $topAuditors = PenugasanAuditor::with('auditor')
            ->selectRaw('user_id, COUNT(*) as total_assignments')
            ->groupBy('user_id')
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
        $periodeProgress = PeriodeAktif::withCount(['pengajuanAmi'])
            ->get()
            ->map(function ($periode) {
                $total = $periode->pengajuan_ami_count;
                $completed = $periode->pengajuanAmi()->where('is_disetujui', 1)->count();
                return [
                    'periode' => $periode->siklus . ' - ' . $periode->tahun_ami,
                    'total' => $total,
                    'completed' => $completed,
                    'percentage' => $total > 0 ? round(($completed / $total) * 100, 1) : 0,
                ];
            });

        return $periodeProgress;
    }

    private function calculateUserActivity()
    {
        $totalUsers = User::whereIn('role', ['auditor', 'auditee'])->count();
        if ($totalUsers == 0) return 0;

        $activeUsers = User::whereIn('role', ['auditor', 'auditee'])
            ->where('last_login_at', '>=', now()->subDays(30))
            ->count();

        return round(($activeUsers / $totalUsers) * 100, 1);
    }

    private function calculateComplianceRate()
    {
        $totalEvaluasi = Evaluasi::where('status', 'selesai')->count();
        if ($totalEvaluasi == 0) return 0;

        $compliantEvaluasi = Evaluasi::where('status', 'selesai')
            ->where('skor', '>=', 80)
            ->count();

        return round(($compliantEvaluasi / $totalEvaluasi) * 100, 1);
    }

    private function calculateEfficiency()
    {
        // Hitung efisiensi berdasarkan waktu penyelesaian audit
        $completedAudits = PenugasanAuditor::whereHas('evaluasi', function($query) {
            $query->where('status', 'selesai');
        })->get();

        if ($completedAudits->isEmpty()) return 75; // Default value

        $totalEfficiency = 0;
        foreach ($completedAudits as $audit) {
            if ($audit->tanggal_mulai && $audit->tanggal_selesai) {
                $plannedDays = $audit->tanggal_selesai->diffInDays($audit->tanggal_mulai);
                $actualDays = $audit->evaluasi->where('status', 'selesai')->first()->created_at->diffInDays($audit->tanggal_mulai);

                if ($plannedDays > 0) {
                    $efficiency = min(100, ($plannedDays / $actualDays) * 100);
                    $totalEfficiency += $efficiency;
                }
            }
        }

        return round($totalEfficiency / $completedAudits->count(), 1);
    }

    private function calculateQuality()
    {
        $evaluasiSelesai = Evaluasi::where('status', 'selesai')->count();
        if ($evaluasiSelesai == 0) return 80; // Default value

        $highQualityEvaluasi = Evaluasi::where('status', 'selesai')
            ->where('skor', '>=', 85)
            ->count();

        return round(($highQualityEvaluasi / $evaluasiSelesai) * 100, 1);
    }

    private function calculateSatisfaction()
    {
        // Simulasi tingkat kepuasan berdasarkan aktivitas pengguna
        $totalUsers = User::whereIn('role', ['auditor', 'auditee'])->count();
        if ($totalUsers == 0) return 85; // Default value

        $activeUsers = User::whereIn('role', ['auditor', 'auditee'])
            ->where('last_login_at', '>=', now()->subDays(7))
            ->count();

        $satisfactionRate = ($activeUsers / $totalUsers) * 100;
        return min(100, round($satisfactionRate + 70, 1)); // Base 70% + activity bonus
    }

    private function calculateAuditProgress($periodeAktif)
    {
        $totalAssignments = PenugasanAuditor::where('periode_id', $periodeAktif->id)->count();
        if ($totalAssignments == 0) return 0;

        $completedAssignments = PenugasanAuditor::where('periode_id', $periodeAktif->id)
            ->whereHas('evaluasi', function($query) {
                $query->where('status', 'selesai');
            })->count();

        return round(($completedAssignments / $totalAssignments) * 100, 1);
    }

    private function getIndikatorChartData()
    {
        $units = UnitKerja::withCount(['indikatorInstrumenProdi as indikator_count' => function($query) {
            $query->whereHas('indikatorInstrumen');
        }])->get();

        return [
            'labels' => $units->pluck('nama_unit')->toArray(),
            'data' => $units->pluck('indikator_count')->toArray()
        ];
    }

    private function getTopAuditors()
    {
        return User::where('role', 'auditor')
            ->withCount(['penugasanAuditor as audit_count' => function($query) {
                $query->whereHas('evaluasi', function($q) {
                    $q->where('status', 'selesai');
                });
            }])
            ->withAvg(['penugasanAuditor.evaluasi as avg_score' => function($query) {
                $query->where('status', 'selesai');
            }], 'skor')
            ->orderBy('audit_count', 'desc')
            ->take(5)
            ->get();
    }

    private function getTopUnits()
    {
        return UnitKerja::withAvg(['evaluasi as avg_score' => function($query) {
            $query->where('status', 'selesai');
        }], 'skor')
        ->withCount(['evaluasi as evaluasi_count' => function($query) {
            $query->where('status', 'selesai');
        }])
        ->orderBy('avg_score', 'desc')
        ->take(5)
        ->get();
    }
}
