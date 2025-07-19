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
use App\Models\EvaluasiSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

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
            'active_periods' => PeriodeAktif::whereNull('deleted_at')->count(),
            'total_auditors' => User::whereHas('roles', function($q) {
                $q->where('name', 'Auditor');
            })->count(),
            'total_auditees' => UnitKerja::count(),
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

        // Jika tidak ada unit kerja dengan indikator, buat data sample
        if ($unitKerjaStats->isEmpty()) {
            $unitKerjaStats = UnitKerja::inRandomOrder()->limit(8)->get()->map(function($uk) {
                $uk->indikator_instrumens_count = rand(1, 10);
                return $uk;
            });
        }

        // Data untuk chart status pengajuan AMI berdasarkan is_disetujui
        $pengajuanStatus = PengajuanAmi::selectRaw('is_disetujui, COUNT(*) as total')
            ->groupBy('is_disetujui')
            ->get()
            ->pluck('total', 'is_disetujui')
            ->toArray();

        // Pastikan kedua status selalu ada, meskipun nilainya 0
        $pengajuanStatus = [
            0 => $pengajuanStatus[0] ?? 0, // Belum disetujui
            1 => $pengajuanStatus[1] ?? 0  // Sudah disetujui
        ];

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

        // Jika tidak ada data jenis unit kerja, buat data sample
        if (empty($jenisUnitKerja)) {
            $jenisUnitKerja = [
                'fakultas' => rand(5, 15),
                'prodi' => rand(20, 40),
                'unit' => rand(3, 10)
            ];
        }

        // Data untuk chart evaluasi per jenis
        $evaluasiPerJenis = Evaluasi::selectRaw('jenis_evaluasi, COUNT(*) as total')
            ->groupBy('jenis_evaluasi')
            ->get()
            ->pluck('total', 'jenis_evaluasi')
            ->toArray();

        // Jika tidak ada data evaluasi, buat data sample
        if (empty($evaluasiPerJenis)) {
            $evaluasiPerJenis = [
                'internal' => rand(5, 15),
                'eksternal' => rand(3, 10)
            ];
        }

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
                    'title' => 'Indikator Kinerja Baru',
                    'description' => 'Indikator "' . $item->nama_indikator . '" ditambahkan ke sistem',
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
                $status = $item->is_disetujui ? 'Disetujui' : 'Menunggu Persetujuan';
                $statusColor = $item->is_disetujui ? 'success' : 'warning';
                $unitKerja = $item->auditee && $item->auditee->nama_unit_kerja ? $item->auditee->nama_unit_kerja : 'Tidak diketahui';

                return [
                    'type' => 'pengajuan',
                    'title' => 'Pengajuan AMI - ' . $status,
                    'description' => 'Unit Kerja: ' . $unitKerja,
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                    'icon' => 'ki-duotone ki-document',
                    'color' => $statusColor
                ];
            });

        // Recent evaluasi submissions (evaluasi yang sudah diisi)
        $recentEvaluasi = EvaluasiSubmission::with(['evaluasi', 'pengajuanAmi.auditee', 'user'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $jenisText = ucfirst($item->jenis ?? 'Tidak diketahui');
                $unitKerja = $item->pengajuanAmi && $item->pengajuanAmi->auditee && $item->pengajuanAmi->auditee->nama_unit_kerja
                    ? $item->pengajuanAmi->auditee->nama_unit_kerja
                    : 'Unit Kerja';
                $userName = $item->user && $item->user->name ? $item->user->name : 'User';
                $nilai = $item->nilai ?? 'N/A';

                return [
                    'type' => 'evaluasi',
                    'title' => 'Evaluasi ' . $jenisText . ' - Nilai: ' . $nilai,
                    'description' => $userName . ' mengevaluasi ' . $unitKerja . ' dengan nilai ' . $nilai,
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                    'icon' => 'ki-duotone ki-star',
                    'color' => 'warning'
                ];
            });

        // Recent user activities (login)
        $recentUsers = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Auditor', 'Auditee']);
        })
        ->whereNotNull('last_login_at')
        ->orderBy('last_login_at', 'desc')
        ->limit(5)
        ->get()
        ->map(function ($item) {
            $role = $item->roles->first()->name ?? 'User';
            return [
                'type' => 'user',
                'title' => $role . ' Login',
                'description' => $item->name . ' (' . $item->email . ') melakukan login ke sistem',
                'time' => $item->last_login_at ? $item->last_login_at->diffForHumans() : '-',
                'icon' => 'ki-duotone ki-profile-user',
                'color' => 'info'
            ];
        });

        return $activities->merge($recentIndikator)
            ->merge($recentPengajuan)
            ->merge($recentEvaluasi)
            ->merge($recentUsers)
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

        // Audit completion - berdasarkan pengajuan AMI yang disetujui
        $totalPengajuan = PengajuanAmi::count();
        $completedPengajuan = PengajuanAmi::where('is_disetujui', 1)->count();
        $auditCompletionRate = $totalPengajuan > 0 ? round(($completedPengajuan / $totalPengajuan) * 100, 1) : 0;

        // User activity - hanya Auditor dan Auditee (7 hari terakhir)
        $activeUsers = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Auditor', 'Auditee']);
        })->where('last_login_at', '>=', Carbon::now()->subDays(7))->count();

        $totalUsers = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Auditor', 'Auditee']);
        })->count();

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
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->nama_unit_kerja,
                    'jenis' => ucfirst($item->jenis_unit_kerja),
                    'jumlah_indikator' => $item->indikator_instrumens_count,
                    'fakultas' => $item->fakultas ?? '-',
                    'jenjang' => $item->jenjang ?? '-'
                ];
            });

        // Top auditors berdasarkan jumlah penugasan
        $topAuditors = PenugasanAuditor::with('auditor')
            ->selectRaw('user_id, COUNT(*) as total_assignments')
            ->groupBy('user_id')
            ->orderBy('total_assignments', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->auditor->name ?? 'Tidak diketahui',
                    'email' => $item->auditor->email ?? '-',
                    'total_penugasan' => $item->total_assignments,
                    'role' => $item->auditor->roles->first()->name ?? 'Auditor'
                ];
            });

        return [
            'top_unit_kerja' => $topUnitKerja,
            'top_auditors' => $topAuditors,
        ];
    }

        private function getAuditProgress()
    {
        // Progress per periode - hanya periode yang aktif
        $periodeProgress = PeriodeAktif::whereNull('deleted_at')
            ->withCount(['pengajuanAmi'])
            ->get()
            ->map(function ($periode) {
                $total = $periode->pengajuan_ami_count;
                $completed = $periode->pengajuanAmi()->where('is_disetujui', 1)->count();
                $pending = $periode->pengajuanAmi()->where('is_disetujui', 0)->count();

                // Hitung total auditee (unit kerja yang bisa diaudit)
                $totalAuditee = UnitKerja::whereIn('jenis_unit_kerja', ['prodi', 'fakultas'])->count();

                // Hitung persentase auditee yang sudah mengajukan
                $persentasePengajuan = $totalAuditee > 0 ? round(($total / $totalAuditee) * 100, 1) : 0;

                return [
                    'periode_nama' => 'Siklus ' . $periode->siklus . ' - ' . $periode->tahun_ami,
                    'nomor_surat' => $periode->nomor_surat,
                    'total_pengajuan' => $total,
                    'disetujui' => $completed,
                    'menunggu' => $pending,
                    'total_auditee' => $totalAuditee,
                    'persentase_pengajuan' => $persentasePengajuan,
                    'persentase' => $total > 0 ? round(($completed / $total) * 100, 1) : 0,
                    'status' => $total > 0 ? ($completed == $total ? 'Selesai' : 'Dalam Proses') : 'Belum Ada Data'
                ];
            });

        return $periodeProgress;
    }
}
