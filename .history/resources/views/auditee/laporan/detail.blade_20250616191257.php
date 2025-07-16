@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Add these styles to your CSS file */
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        /* Style for the already submitted notice */
        .notice {
            border-left: 4px solid #FFA800 !important;
        }

        /* File upload styling */
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .custom-file-upload {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .custom-file-upload:hover {
            border-color: #009ef7;
        }

        .file-list {
            margin-top: 1rem;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 3px solid #009ef7;
        }

        .file-item .file-name {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-right: 1rem;
        }

        .file-item .file-remove {
            color: #f1416c;
            cursor: pointer;
        }

        .file-progress {
            height: 5px;
            width: 100%;
            background-color: #e9ecef;
            border-radius: 3px;
            margin-top: 0.25rem;
        }

        .file-progress-bar {
            height: 100%;
            background-color: #009ef7;
            border-radius: 3px;
            width: 0%;
            transition: width 0.3s;
        }

        .file-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #7e8299;
            margin-top: 0.25rem;
        }
    </style>
@endpush
@section('dashboardProfile')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                    <i class="fas fa-file-alt fs-2x text-primary"></i>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-dark">Detail Laporan Audit Mutu Internal</h4>
                    <span class="text-gray-700 fw-semibold">Berikut adalah detail hasil audit mutu internal untuk unit kerja Anda.</span>
                </div>
            </div>
            <!--end::Alert-->

            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-5">
                    <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Nilai Sasaran Strategis</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Visualisasi Radar Chart</span>
                            </h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div style="position: relative; width: 100%; max-width: 500px; aspect-ratio: 1;">
                                    <canvas id="kt_radar_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-7">
                    <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Detail Nilai Standar</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Rincian penilaian per standar</span>
                            </h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="min-w-50px">No</th>
                                            <th class="min-w-100px">Kode</th>
                                            <th class="min-w-200px">Sasaran</th>
                                            <th class="min-w-100px text-center">Nilai Ketua</th>
                                            <th class="min-w-100px text-center">Nilai Anggota</th>
                                            <th class="min-w-100px text-center">Total</th>
                                            <th class="min-w-100px text-center">Jml Penilaian</th>
                                            <th class="min-w-100px text-center">Rata-Rata</th>
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
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Card-->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-0">
                    <!--begin::Header-->
                    <div class="px-10 pt-10 pb-5">
                        <div class="d-flex flex-stack mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1">Laporan Audit Mutu Internal</h2>
                                    <div class="text-muted fw-bold">
                                        <span class="mx-1">Periode {{ $periodeAktif->siklus }}/{{ $periodeAktif->tahun_ami }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('laporan.laporanAmi', [$pengajuanAmis->id]) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-print me-2"></i>
                                Cetak Laporan
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Info-->
                    <div class="py-5 px-10 bg-light-primary">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="bullet bullet-vertical bg-primary me-5"></span>
                                        <div class="flex-grow-1">
                                            <span class="text-muted d-block">Program Studi/Unit</span>
                                            <span class="fw-bold fs-5">{{ $pengajuanAmis->auditee->nama_unit_kerja }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="bullet bullet-vertical bg-primary me-5"></span>
                                        <div class="flex-grow-1">
                                            <span class="text-muted d-block">Fakultas</span>
                                            <span class="fw-bold fs-5">{{ $pengajuanAmis->auditee->fakultas }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="bullet bullet-vertical bg-primary me-5"></span>
                                        <div class="flex-grow-1">
                                            <span class="text-muted d-block">Ketua Auditor</span>
                                            <span class="fw-bold fs-5">
                                                @foreach($pengajuanAmis->auditors as $auditor)
                                                    @if($auditor->role == 'ketua')
                                                        {{ $auditor->auditor->name }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bullet-vertical bg-primary me-5"></span>
                                        <div class="flex-grow-1">
                                            <span class="text-muted d-block">Anggota Auditor</span>
                                            <span class="fw-bold fs-5">
                                                @foreach($pengajuanAmis->auditors as $auditor)
                                                    @if($auditor->role == 'pendamping')
                                                        {{ $auditor->auditor->name }}@if(!$loop->last), @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Card-->
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

            // Process each Sasaran Strategis item to populate labels and values
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