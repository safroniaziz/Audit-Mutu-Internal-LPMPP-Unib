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
            <div class="row g-5 g-xl-5">
                {{-- Indikator IKSS --}}
                <div class="col-xl-3">
                    <div class="card card-flush border-0 h-100 bg-light-primary bg-opacity-75">
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
                                <div class="h-8px mx-3 w-100 bg-white rounded">
                                    <div class="bg-primary rounded h-8px" role="progressbar" style="width: 78%"></div>
                                </div>
                                <span class="text-gray-600 fw-semibold fs-7 mt-2">Mengukur performa standar strategis institusi</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Program Studi --}}
                <div class="col-xl-3">
                    <div class="card card-flush border-0 h-100 bg-light-success bg-opacity-75">
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
                                <div class="h-8px mx-3 w-100 bg-white rounded">
                                    <div class="bg-success rounded h-8px" role="progressbar" style="width: 65%"></div>
                                </div>
                                <span class="text-gray-600 fw-semibold fs-7 mt-2">Jumlah prodi aktif dalam database</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Fakultas --}}
                <div class="col-xl-3">
                    <div class="card card-flush border-0 h-100 bg-light-warning bg-opacity-75">
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
                                <div class="h-8px mx-3 w-100 bg-white rounded">
                                    <div class="bg-warning rounded h-8px" role="progressbar" style="width: 90%"></div>
                                </div>
                                <span class="text-gray-600 fw-semibold fs-7 mt-2">Total fakultas dalam sistem akademik</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Indikator Prodi --}}
                <div class="col-xl-3">
                    <div class="card card-flush border-0 h-100 bg-light-info bg-opacity-75">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-dark me-2">10</span>
                                <span class="text-gray-600 fw-semibold fs-6">Jumlah Indikator Prodi</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                    <span class="badge badge-light-info fs-8 fw-bold">Kinerja</span>
                                    <span>
                                        <i class="fas fa-tasks fs-3 text-info me-1"></i>
                                    </span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-white rounded">
                                    <div class="bg-info rounded h-8px" role="progressbar" style="width: 45%"></div>
                                </div>
                                <span class="text-gray-600 fw-semibold fs-7 mt-2">Indikator kinerja program studi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-5 g-xl-5 mt-5">
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Instrumen per IKSS</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <canvas id="kt_ikss_chart" style="height: 350px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">IKSS per Unit Kerja</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <canvas id="kt_unitkerja_chart" style="height: 350px; width: 100%;"></canvas>
                            </div>
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
window.addEventListener("load", function() {
    // Data untuk IKSS Chart (Data contoh, ganti dengan data sebenarnya dari model)
    const dataIkss = {
        labels: ['IKSS 1', 'IKSS 2', 'IKSS 3', 'IKSS 4', 'IKSS 5'],
        datasets: [{
            label: 'Jumlah Instrumen',
            data: [12, 19, 8, 15, 10],
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 99, 132, 0.7)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Konfigurasi IKSS Chart
    const configIkss = {
        type: 'bar',
        data: dataIkss,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Instrumen'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'IKSS'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Jumlah Instrumen per IKSS',
                    font: {
                        size: 16
                    }
                }
            }
        }
    };

    // Data untuk Unit Kerja Chart (Data contoh, ganti dengan data sebenarnya dari model)
    const dataUnitKerja = {
        labels: ['Fakultas A', 'Fakultas B', 'Fakultas C', 'Fakultas D'],
        datasets: [{
            label: 'Jumlah IKSS',
            data: [25, 15, 20, 18],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            hoverOffset: 4
        }]
    };

    // Konfigurasi Unit Kerja Chart
    const configUnitKerja = {
        type: 'pie',
        data: dataUnitKerja,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Distribusi IKSS per Unit Kerja',
                    font: {
                        size: 16
                    }
                }
            }
        }
    };

    // Inisialisasi Chart
    const ctxRadar = document.getElementById('kt_radar_chart');
    new Chart(ctxRadar, configRadar);

    const ctxIkss = document.getElementById('kt_ikss_chart');
    new Chart(ctxIkss, configIkss);

    const ctxUnitKerja = document.getElementById('kt_unitkerja_chart');
    new Chart(ctxUnitKerja, configUnitKerja);
});
</script>
@endpush
