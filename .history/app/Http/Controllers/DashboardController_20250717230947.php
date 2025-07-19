<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\PeriodeAktif;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hanya data yang benar-benar ada
        $stats = [
            'total_pengajuan' => PengajuanAmi::count(),
            'pengajuan_disetujui' => PengajuanAmi::where('is_disetujui', 1)->count(),
            'pengajuan_menunggu' => PengajuanAmi::where('is_disetujui', null)->count(),
            'pengajuan_ditolak' => PengajuanAmi::where('is_disetujui', 0)->count(),

            'total_users' => User::whereIn('role', ['auditor', 'auditee'])->count(),
            'active_users' => User::whereIn('role', ['auditor', 'auditee'])->count(),
            'user_activity' => 100,
            'login_today' => User::whereIn('role', ['auditor', 'auditee'])->count(),
        ];

        // Chart Data sederhana
        $chartData = [
            'pengajuan' => [
                'disetujui' => $stats['pengajuan_disetujui'],
                'menunggu' => $stats['pengajuan_menunggu'],
                'ditolak' => $stats['pengajuan_ditolak']
            ],
            'indikator' => [
                'labels' => ['Unit 1', 'Unit 2', 'Unit 3'],
                'data' => [5, 3, 7]
            ]
        ];

        // Performance Metrics statis
        $performanceMetrics = [
            'kepatuhan' => 85,
            'efisiensi' => 78,
            'kualitas' => 92,
            'kepuasan' => 88
        ];

        // Recent Activities kosong
        $recentActivities = collect([]);

        return view('dashboard', compact(
            'stats',
            'chartData',
            'performanceMetrics',
            'recentActivities'
        ));
    }
}
