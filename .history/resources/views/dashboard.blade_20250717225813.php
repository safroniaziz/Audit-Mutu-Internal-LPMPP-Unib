@extends('layouts.app')

@section('title', 'Dashboard - SIAMI')

@push('styles')
<style>
.card-custom {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.card-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-spacer {
    padding: 2rem;
}

.symbol-label {
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.symbol-label:hover {
    transform: scale(1.05);
}

.bg-light-primary {
    background: linear-gradient(135deg, #e1f0ff 0%, #b3d9ff 100%);
}

.bg-light-success {
    background: linear-gradient(135deg, #e8f5e8 0%, #b3e6b3 100%);
}

.bg-light-info {
    background: linear-gradient(135deg, #e6f3ff 0%, #b3d9ff 100%);
}

.bg-light-warning {
    background: linear-gradient(135deg, #fff3e6 0%, #ffd9b3 100%);
}

.text-primary {
    color: #3699FF !important;
}

.text-success {
    color: #50CD89 !important;
}

.text-info {
    color: #17a2b8 !important;
}

.text-warning {
    color: #FFC700 !important;
}

.fs-2x {
    font-size: 2.5rem !important;
    font-weight: 700;
    line-height: 1.2;
}

.fs-6 {
    font-size: 1.1rem !important;
    font-weight: 600;
}

.fs-7 {
    font-size: 0.9rem !important;
    font-weight: 500;
}

.fs-8 {
    font-size: 0.8rem !important;
    font-weight: 600;
}

.badge {
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    font-weight: 600;
}

.badge-light-success {
    background: rgba(80, 205, 137, 0.1);
    color: #50CD89;
}

.badge-light-danger {
    background: rgba(241, 65, 108, 0.1);
    color: #F1416C;
}

.progress {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.05);
}

.progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.page-title {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}

.page-heading {
    color: white !important;
    margin-bottom: 0.5rem;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8) !important;
}

.breadcrumb-item a:hover {
    color: white !important;
}

.breadcrumb-item.text-muted {
    color: rgba(255, 255, 255, 0.6) !important;
}

.bullet {
    background: rgba(255, 255, 255, 0.6) !important;
}

/* Animation for stats cards */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.col-xl-3 {
    animation: fadeInUp 0.6s ease forwards;
}

.col-xl-3:nth-child(1) { animation-delay: 0.1s; }
.col-xl-3:nth-child(2) { animation-delay: 0.2s; }
.col-xl-3:nth-child(3) { animation-delay: 0.3s; }
.col-xl-3:nth-child(4) { animation-delay: 0.4s; }

/* Chart container styling */
.card-body canvas {
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
}

/* Performance metrics styling */
.d-flex.align-items-center.justify-content-between {
    padding: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.d-flex.align-items-center.justify-content-between:hover {
    background: rgba(0, 0, 0, 0.02);
}

/* Table styling */
.table {
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: none;
    font-weight: 600;
    color: #495057;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(54, 153, 255, 0.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-spacer {
        padding: 1.5rem;
    }

    .fs-2x {
        font-size: 2rem !important;
    }

    .symbol {
        width: 40px !important;
        height: 40px !important;
    }
}
</style>
@endpush

@section('content')
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('layouts.partials.header')

        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('layouts.partials.sidebar')

            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    @include('layouts.partials.toolbar')

                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            <!-- Page Header -->
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
                                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    Dashboard SIAMI
                                </h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted">Dashboard</li>
                                </ul>
                            </div>

                            <!-- Stats Cards Row -->
                            <div class="row g-5 g-xl-8 mb-5">
                                <div class="col-xl-3">
                                    @include('components.dashboard-stats-card', [
                                        'title' => 'Total Pengajuan AMI',
                                        'value' => $stats['total_pengajuan'],
                                        'description' => 'Jumlah pengajuan audit mutu internal yang telah diajukan',
                                        'icon' => 'ki-duotone ki-document',
                                        'color' => 'primary',
                                        'subtitle' => 'Dari semua unit kerja',
                                        'details' => [
                                            ['label' => 'Disetujui', 'value' => $stats['pengajuan_disetujui']],
                                            ['label' => 'Menunggu', 'value' => $stats['pengajuan_menunggu']],
                                            ['label' => 'Ditolak', 'value' => $stats['pengajuan_ditolak']]
                                        ]
                                    ])
                                </div>

                                <div class="col-xl-3">
                                    @include('components.dashboard-stats-card', [
                                        'title' => 'Audit Aktif',
                                        'value' => $stats['audit_aktif'],
                                        'description' => 'Audit yang sedang berlangsung saat ini',
                                        'icon' => 'ki-duotone ki-chart-line',
                                        'color' => 'success',
                                        'subtitle' => 'Dalam periode aktif',
                                        'details' => [
                                            ['label' => 'Periode Aktif', 'value' => $stats['periode_aktif'] ?? 'Tidak ada'],
                                            ['label' => 'Target Selesai', 'value' => $stats['target_selesai'] ?? '-'],
                                            ['label' => 'Progress', 'value' => $stats['progress_audit'] . '%']
                                        ]
                                    ])
                                </div>

                                <div class="col-xl-3">
                                    @include('components.dashboard-stats-card', [
                                        'title' => 'Evaluasi Selesai',
                                        'value' => $stats['evaluasi_selesai'],
                                        'description' => 'Jumlah evaluasi yang telah diselesaikan',
                                        'icon' => 'ki-duotone ki-check-circle',
                                        'color' => 'info',
                                        'subtitle' => 'Dari total evaluasi',
                                        'details' => [
                                            ['label' => 'Total Evaluasi', 'value' => $stats['total_evaluasi']],
                                            ['label' => 'Rata-rata Skor', 'value' => number_format($stats['rata_rata_skor'], 1)],
                                            ['label' => 'Tingkat Kepatuhan', 'value' => $stats['tingkat_kepatuhan'] . '%']
                                        ]
                                    ])
                                </div>

                                <div class="col-xl-3">
                                    @include('components.dashboard-stats-card', [
                                        'title' => 'Aktivitas Pengguna',
                                        'value' => $stats['user_activity'] . '%',
                                        'description' => 'Persentase auditor dan auditee yang aktif login 30 hari terakhir',
                                        'icon' => 'ki-duotone ki-profile-user',
                                        'color' => 'warning',
                                        'subtitle' => 'Dari total pengguna aktif',
                                        'details' => [
                                            ['label' => 'Total Pengguna', 'value' => $stats['total_users']],
                                            ['label' => 'Pengguna Aktif', 'value' => $stats['active_users']],
                                            ['label' => 'Login Hari Ini', 'value' => $stats['login_today']]
                                        ]
                                    ])
                                </div>
                            </div>

                            <!-- Charts Row -->
                            <div class="row g-5 g-xl-8 mb-5">
                                <div class="col-xl-6">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Status Pengajuan AMI</h3>
                                                <div class="card-toolbar">
                                                    <span class="badge badge-light-primary fs-8">Bulan Ini</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="pengajuanChart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Distribusi Indikator per Unit Kerja</h3>
                                                <div class="card-toolbar">
                                                    <span class="badge badge-light-success fs-8">Aktif</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="indikatorChart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Metrics Row -->
                            <div class="row g-5 g-xl-8 mb-5">
                                <div class="col-xl-4">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Metrik Kinerja</h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-6">Tingkat Kepatuhan</span>
                                                        <span class="text-muted fs-7">Standar mutu yang dipenuhi</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-dark fw-bold fs-2x me-2">{{ $performanceMetrics['kepatuhan'] }}%</span>
                                                        <div class="progress h-8px w-50px">
                                                            <div class="progress-bar bg-success" style="width: {{ $performanceMetrics['kepatuhan'] }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-6">Efisiensi Audit</span>
                                                        <span class="text-muted fs-7">Waktu penyelesaian audit</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-dark fw-bold fs-2x me-2">{{ $performanceMetrics['efisiensi'] }}%</span>
                                                        <div class="progress h-8px w-50px">
                                                            <div class="progress-bar bg-info" style="width: {{ $performanceMetrics['efisiensi'] }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-6">Kualitas Laporan</span>
                                                        <span class="text-muted fs-7">Kelengkapan dan akurasi laporan</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-dark fw-bold fs-2x me-2">{{ $performanceMetrics['kualitas'] }}%</span>
                                                        <div class="progress h-8px w-50px">
                                                            <div class="progress-bar bg-warning" style="width: {{ $performanceMetrics['kualitas'] }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-6">Kepuasan Stakeholder</span>
                                                        <span class="text-muted fs-7">Tingkat kepuasan pengguna sistem</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-dark fw-bold fs-2x me-2">{{ $performanceMetrics['kepuasan'] }}%</span>
                                                        <div class="progress h-8px w-50px">
                                                            <div class="progress-bar bg-primary" style="width: {{ $performanceMetrics['kepuasan'] }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-8">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Aktivitas Terbaru</h3>
                                                <div class="card-toolbar">
                                                    <a href="#" class="btn btn-sm btn-light-primary">Lihat Semua</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                                    <thead>
                                                        <tr class="fw-bold text-muted">
                                                            <th class="w-25px">
                                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
                                                                </div>
                                                            </th>
                                                            <th class="min-w-150px">Aktivitas</th>
                                                            <th class="min-w-140px">Pengguna</th>
                                                            <th class="min-w-120px">Waktu</th>
                                                            <th class="min-w-100px text-end">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($recentActivities as $activity)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input widget-9-check" type="checkbox" value="1" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="symbol symbol-45px me-5">
                                                                        <span class="symbol-label bg-light-primary">
                                                                            <i class="ki-duotone ki-document fs-2x text-primary"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-start flex-column">
                                                                        <span class="text-dark fw-bold text-hover-primary fs-6">{{ $activity->description }}</span>
                                                                        <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $activity->subject_type }}</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $activity->causer->name ?? 'System' }}</span>
                                                                <span class="text-muted fw-semibold d-block fs-7">{{ $activity->causer->email ?? '-' }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $activity->created_at->format('d M Y') }}</span>
                                                                <span class="text-muted fw-semibold d-block fs-7">{{ $activity->created_at->format('H:i') }}</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-success">Selesai</span>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center py-8">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <i class="ki-duotone ki-document fs-3x text-muted mb-3"></i>
                                                                    <span class="text-muted fs-6">Belum ada aktivitas terbaru</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Performers Row -->
                            <div class="row g-5 g-xl-8 mb-5">
                                <div class="col-xl-6">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Top Auditor</h3>
                                                <div class="card-toolbar">
                                                    <span class="badge badge-light-primary fs-8">Berdasarkan Jumlah Audit</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @forelse($topPerformers['auditors'] as $index => $auditor)
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label bg-light-primary">
                                                        <span class="fs-2x fw-bold text-primary">{{ $index + 1 }}</span>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">{{ $auditor->name }}</span>
                                                    <span class="text-muted fw-semibold d-block fs-7">{{ $auditor->email }}</span>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <span class="text-dark fw-bold fs-6">{{ $auditor->audit_count }} Audit</span>
                                                    <span class="text-muted fs-7">Rata-rata skor: {{ number_format($auditor->avg_score, 1) }}</span>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="text-center py-8">
                                                <i class="ki-duotone ki-profile-user fs-3x text-muted mb-3"></i>
                                                <span class="text-muted fs-6">Belum ada data auditor</span>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Unit Kerja Terbaik</h3>
                                                <div class="card-toolbar">
                                                    <span class="badge badge-light-success fs-8">Berdasarkan Skor Evaluasi</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @forelse($topPerformers['units'] as $index => $unit)
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="symbol symbol-50px me-4">
                                                    <span class="symbol-label bg-light-success">
                                                        <span class="fs-2x fw-bold text-success">{{ $index + 1 }}</span>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">{{ $unit->nama_unit }}</span>
                                                    <span class="text-muted fw-semibold d-block fs-7">{{ $unit->kode_unit }}</span>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <span class="text-dark fw-bold fs-6">{{ number_format($unit->avg_score, 1) }}</span>
                                                    <span class="text-muted fs-7">{{ $unit->evaluasi_count }} Evaluasi</span>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="text-center py-8">
                                                <i class="ki-duotone ki-building fs-3x text-muted mb-3"></i>
                                                <span class="text-muted fs-6">Belum ada data unit kerja</span>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts.partials.footer')
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pengajuan AMI Chart
    const pengajuanCtx = document.getElementById('pengajuanChart').getContext('2d');
    const pengajuanChart = new Chart(pengajuanCtx, {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Menunggu', 'Ditolak'],
            datasets: [{
                data: [
                    {{ $chartData['pengajuan']['disetujui'] ?? 0 }},
                    {{ $chartData['pengajuan']['menunggu'] ?? 0 }},
                    {{ $chartData['pengajuan']['ditolak'] ?? 0 }}
                ],
                backgroundColor: [
                    '#50CD89',
                    '#F1416C',
                    '#FFC700'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            }
        }
    });

    // Indikator Chart
    const indikatorCtx = document.getElementById('indikatorChart').getContext('2d');
    const indikatorChart = new Chart(indikatorCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['indikator']['labels'] ?? []) !!},
            datasets: [{
                label: 'Jumlah Indikator',
                data: {!! json_encode($chartData['indikator']['data'] ?? []) !!},
                backgroundColor: '#3699FF',
                borderColor: '#3699FF',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush
@endsection
