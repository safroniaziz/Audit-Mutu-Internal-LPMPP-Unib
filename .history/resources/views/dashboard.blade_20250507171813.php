@extends('layouts.dashboard.dashboard')
@section('menu')
    Halaman Dashboard
@endsection

@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="row g-4">
                    {{-- Indikator IKSS --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">100</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Total Indikator IKSS</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-primary fs-8 fw-bold">Strategis</span>
                                        <span>
                                            <i class="fas fa-chart-line fs-3 text-primary me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-primary rounded">
                                        <div class="bg-primary rounded h-8px" role="progressbar" style="width: 78%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2">Mengukur performa standar strategis institusi saat ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Program Studi --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">50</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Program Studi Terdaftar</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-success fs-8 fw-bold">Akademik</span>
                                        <span>
                                            <i class="fas fa-graduation-cap fs-3 text-success me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                        <div class="bg-success rounded h-8px" role="progressbar" style="width: 65%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2">Jumlah prodi aktif yang tersedia dalam database saat ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Fakultas --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">10</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Fakultas Terdaftar</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-warning fs-8 fw-bold">Struktur</span>
                                        <span>
                                            <i class="fas fa-university fs-3 text-warning me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                        <div class="bg-warning rounded h-8px" role="progressbar" style="width: 90%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2">Total fakultas aktif yang tercatat dalam sistem akademik</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-6 g-xl-9 mt-5">
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 shadow-lg">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Nilai Sasaran Strategis</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <div id="kt_radar_chart" style="height: 350px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 shadow-lg">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Detail Nilai Standar</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-120px">Standar</th>
                                        <th class="min-w-100px">Nilai</th>
                                        <th class="min-w-100px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.1</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.2</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.2</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.3</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.3</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">2.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Baik</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.1</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">0.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-danger">Kurang</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.2</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">2.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Baik</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.3</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Data untuk Radar Chart
    const dataStandar = {
        labels: ['SS 1.1', 'SS 1.2', 'SS 1.3', 'SS 2.1', 'SS 2.2', 'SS 2.3'],
        datasets: [{
            label: 'Nilai Standar',
            data: [1.2, 1.3, 2.0, 0.0, 2.0, 1.0],
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
        }]
    };

    // Konfigurasi Radar Chart
    const configRadar = {
        type: 'radar',
        data: dataStandar,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
                line: {
                    borderWidth: 3
                }
            },
            scales: {
                r: {
                    angleLines: {
                        display: true,
                        color: 'rgba(210, 210, 210, 0.5)'
                    },
                    grid: {
                        color: 'rgba(210, 210, 210, 0.5)'
                    },
                    ticks: {
                        beginAtZero: true,
                        max: 3,
                        stepSize: 1,
                        color: '#666',
                        backdropColor: 'transparent'
                    },
                    pointLabels: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Nilai: ${context.raw}`;
                        }
                    }
                }
            }
        }
    };

    // Inisialisasi Chart
    const ctx = document.getElementById('kt_radar_chart');
    new Chart(ctx, configRadar);
});
</script>
@endpush
