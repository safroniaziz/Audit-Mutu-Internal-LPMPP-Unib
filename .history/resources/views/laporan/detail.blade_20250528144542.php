@extends('layouts.dashboard.dashboard')
@section('menu')
    Detail Laporan Audit
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('laporan.index') }}" class="text-muted text-hover-primary">Laporan</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Detail Laporan</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-0">
                    <!-- Begin::Hero section -->
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
                            <a href="{{ route('laporan.laporanAmi', [$pengajuanAmis->id]) }}" target="_blank"
                               class="btn btn-primary">
                                <i class="fas fa-print me-2"></i>
                                Cetak Laporan
                            </a>
                        </div>
                    </div>
                    <!-- End::Hero section -->

                    <!-- Begin::Info section -->
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
                                            <span class="text-muted d-block">Status</span>
                                            <span class="badge badge-light-success fs-7 fw-bold">Siap Cetak</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End::Info section -->

                    <!-- Begin::Notice -->
                    <div class="px-10 py-5">
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                            <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Informasi Penting</h4>
                                    <div class="fs-6 text-gray-700">Laporan ini berisi hasil audit mutu internal yang mencakup penilaian, temuan, dan rekomendasi untuk perbaikan kualitas program studi/unit kerja.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End::Notice -->
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
