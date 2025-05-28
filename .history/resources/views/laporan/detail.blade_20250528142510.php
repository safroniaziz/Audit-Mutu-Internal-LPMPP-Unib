@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Penugasan Auditor
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Penugasan Auditor</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-5 mt-5">
                <div class="w-100 mb-2">
                    <div class="alert alert-danger d-flex align-items-center p-5">
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            <i class="ki-duotone ki-shield-tick fs-2 text-danger">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">Informasi</h4>
                            <span>Daftar berikut menampilkan auditee yang telah diaudit oleh auditor. Klik "Detail" untuk melihat informasi lebih lanjut.</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Nilai Satuan Standar</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div style="position: relative; width: 100%; max-width: 500px; aspect-ratio: 1;">
                                    <canvas id="kt_radar_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
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
                                        <th width="5%">No</th>
                                        <th width="10%">Kode</th>
                                        <th width="25%">Sasaran</th>
                                        <th width="12%" class="text-center">Nilai Ketua</th>
                                        <th width="12%" class="text-center">Nilai Anggota</th>
                                        <th width="12%" class="text-center">Total</th>
                                        <th width="12%" class="text-center">Jml Penilaian</th>
                                        <th width="12%" class="text-center">Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortedGrouped as $index => $group)
                                        @if($group['has_data'])
                                            <tr>
                                                <td>
                                                    <span class="text-dark fw-semibold">{{ $loop->iteration }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-semibold text-hover-primary">{{ $group['kode_satuan'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-semibold">{{ $group['sasaran'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai_ketua'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai_anggota'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark fw-bold">{{ $group['jumlah_penilaian'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-dark fw-bold">{{ number_format($group['rata_rata'], 2) }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <div class="card">
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="row mb-6 mt-6">
                        <div class="col-lg-12">
                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>Nama Dokumen</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom border-gray-200 hover-bg-light">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-primary me-3 fs-4"></i>
                                                <span class="fw-semibold text-gray-800">Berita Acara</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('laporan.beritaAcara', [$pengajuanAmis->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                                <i class="fas fa-print me-2"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-gray-200 hover-bg-light">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-signature text-success me-3 fs-4"></i>
                                                <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('laporan.evaluasiAmi', [$pengajuanAmis->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                                <i class="fas fa-print me-2"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-gray-200 hover-bg-light">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt text-warning me-3 fs-4"></i>
                                                <span class="fw-semibold text-gray-800">Daftar Pertanyaan</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('laporan.daftarPertanyaan', [$pengajuanAmis->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                                <i class="fas fa-print me-2"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="hover-bg-light">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-signature text-danger me-3 fs-4"></i>
                                                <span class="fw-semibold text-gray-800">Laporan Audit Mutu Internal</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('laporan.laporanAmi', [$pengajuanAmis->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                                <i class="fas fa-print me-2"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get data from PHP/Laravel to JavaScript
            const sortedGrouped = @json($sortedGrouped);

            // Prepare data for the radar chart
            const labels = [];
            const values = [];

            // Process each Satuan Standar item to populate labels and values
            sortedGrouped.forEach(item => {
                // Only include items that have data
                if (item.has_data) {
                    // Use the kode_satuan as label (like 'SS 1.1')
                    labels.push(item.kode_satuan);
                    // Use the rata_rata as the value
                    values.push(item.rata_rata);
                }
            });

            // Data for Radar Chart
            const dataStandar = {
                labels: labels,
                datasets: [{
                    label: 'Nilai Standar',
                    data: values,
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                }]
            };

            const configRadar = {
                type: 'radar',
                data: dataStandar,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    elements: {
                        line: {
                            borderWidth: 2
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true,
                                color: 'rgba(210, 210, 210, 0.5)',
                                lineWidth: 1
                            },
                            grid: {
                                color: 'rgba(210, 210, 210, 0.5)',
                                circular: true
                            },
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                max: 3,
                                backdropColor: 'transparent',
                                color: '#666',
                                font: {
                                    size: 10
                                }
                            },
                            pointLabels: {
                                font: {
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#333',
                                padding: 20
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // Find the original data item to get more details
                                    const standardItem = sortedGrouped.find(item => item.has_data && item.kode_satuan === context.label);
                                    return [
                                        `Standar: ${standardItem.kode_satuan}`,
                                        `Nilai: ${context.raw.toFixed(2)}`,
                                        `Jumlah Penilaian: ${standardItem.jumlah_penilaian}`
                                    ];
                                }
                            }
                        }
                    }
                }
            };

            const ctxRadar = document.getElementById('kt_radar_chart');
            new Chart(ctxRadar, configRadar);
        });
    </script>
@endpush
