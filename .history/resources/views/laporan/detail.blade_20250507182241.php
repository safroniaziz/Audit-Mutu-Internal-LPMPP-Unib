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
                            <h3 class="card-title fw-bold text-dark">Nilai Sasaran Strategis</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <canvas id="kt_radar_chart" style="height: 350px; width: 100%;"></canvas>
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
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-120px">Kode Satuan</th>
                                        <th class="min-w-200px">Sasaran</th>
                                        <th class="min-w-120px text-center">Nilai Ketua</th>
                                        <th class="min-w-120px text-center">Nilai Anggota</th>
                                        <th class="min-w-120px text-center">Total</th>
                                        <th class="min-w-120px text-center">Jumlah Penilaian</th>
                                        <th class="min-w-120px text-center">Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortedGrouped as $index => $group)
                                        <tr>
                                            <td>
                                                <span class="text-dark fw-semibold">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold text-hover-primary">{{ $group['kode_satuan'] }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold">{{ $group['sasaran'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($group['has_data'])
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai_ketua'], 2) }}</span>
                                                @else
                                                    <span class="badge badge-light-danger">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($group['has_data'])
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai_anggota'], 2) }}</span>
                                                @else
                                                    <span class="badge badge-light-danger">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($group['has_data'])
                                                    <span class="text-dark fw-bold">{{ number_format($group['total_nilai'], 2) }}</span>
                                                @else
                                                    <span class="badge badge-light-danger">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($group['has_data'])
                                                    <span class="text-dark fw-bold">{{ $group['jumlah_penilaian'] }}</span>
                                                @else
                                                    <span class="badge badge-light-danger">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($group['has_data'])
                                                    <span class="text-dark fw-bold">{{ number_format($group['rata_rata'], 2) }}</span>
                                                @else
                                                    <span class="badge badge-light-danger">-</span>
                                                @endif
                                            </td>
                                        </tr>
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
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle table-row-dashed fs-6 gy-4 mb-0">
                                            <thead>
                                                <tr class="fw-bold text-gray-800 bg-light border-bottom border-gray-300">
                                                    <th class="ps-4 min-w-200px">Nama Dokumen</th>
                                                    <th class="text-end pe-4">Aksi</th>
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
                                                        <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#beritaAcaraModal">
                                                            <i class="fas fa-print me-2"></i> Cetak
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="border-bottom border-gray-200 hover-bg-light">
                                                    <td class="ps-4">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-clipboard-check text-success me-3 fs-4"></i>
                                                            <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-4">
                                                        <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#evaluasiAmiModal">
                                                            <i class="fas fa-print me-2"></i> Cetak
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="border-bottom border-gray-200 hover-bg-light">
                                                    <td class="ps-4">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-list-ul text-warning me-3 fs-4"></i>
                                                            <span class="fw-semibold text-gray-800">Daftar Pertanyaan</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-4">
                                                        <a href="{{ route('auditor.audit.daftarPertanyaan',[$pengajuanAmis->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
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
                                                        <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#laporanAmiModal">
                                                            <i class="fas fa-print me-2"></i> Cetak
                                                        </button>
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get data from PHP/Laravel to JavaScript
            const sortedGrouped = @json($sortedGrouped);

            // Prepare data for the radar chart
            const labels = [];
            const values = [];

            // Process each Sasaran Strategis item to populate labels and values
            sortedGrouped.forEach(item => {
                // Use the kode_satuan as label (like 'SS 1.1')
                labels.push(item.kode_satuan);

                // Use the rata_rata as the value (default to 0 if no data)
                values.push(item.rata_rata || 0);
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
                                    // Find the original data item to get more details
                                    const standardItem = sortedGrouped[context.dataIndex];
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
@endpush
