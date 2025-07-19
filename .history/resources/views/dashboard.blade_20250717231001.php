@extends('layouts.dashboard.dashboard')

@section('title', 'Dashboard - SIAMI')

@section('content')
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
                    'color' => 'primary'
                ])
            </div>

            <div class="col-xl-3">
                @include('components.dashboard-stats-card', [
                    'title' => 'Pengajuan Disetujui',
                    'value' => $stats['pengajuan_disetujui'],
                    'description' => 'Pengajuan yang telah disetujui',
                    'icon' => 'ki-duotone ki-check-circle',
                    'color' => 'success'
                ])
            </div>

            <div class="col-xl-3">
                @include('components.dashboard-stats-card', [
                    'title' => 'Pengajuan Menunggu',
                    'value' => $stats['pengajuan_menunggu'],
                    'description' => 'Pengajuan yang sedang menunggu persetujuan',
                    'icon' => 'ki-duotone ki-clock',
                    'color' => 'warning'
                ])
            </div>

            <div class="col-xl-3">
                @include('components.dashboard-stats-card', [
                    'title' => 'Aktivitas Pengguna',
                    'value' => $stats['user_activity'] . '%',
                    'description' => 'Persentase pengguna aktif',
                    'icon' => 'ki-duotone ki-profile-user',
                    'color' => 'info'
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
                    <div class="card-body">
                        @if($recentActivities->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="fw-bold text-muted">
                                            <th class="min-w-150px">Aktivitas</th>
                                            <th class="min-w-140px">Pengguna</th>
                                            <th class="min-w-120px">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentActivities as $activity)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-45px me-5">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="ki-duotone ki-document fs-2x text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span class="text-dark fw-bold text-hover-primary fs-6">{{ $activity->description ?? 'Aktivitas' }}</span>
                                                        <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $activity->subject_type ?? 'Sistem' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $activity->causer->name ?? 'System' }}</span>
                                                <span class="text-muted fw-semibold d-block fs-7">{{ $activity->causer->email ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $activity->created_at ? $activity->created_at->format('d M Y') : '-' }}</span>
                                                <span class="text-muted fw-semibold d-block fs-7">{{ $activity->created_at ? $activity->created_at->format('H:i') : '-' }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="ki-duotone ki-document fs-3x text-muted mb-3"></i>
                                <span class="text-muted fs-6">Belum ada aktivitas terbaru</span>
                            </div>
                        @endif
                    </div>
                </div>
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
