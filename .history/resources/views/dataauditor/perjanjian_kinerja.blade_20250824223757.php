@extends('dataauditor/dashboard_template')

@section('menuPenilaianInstrumenProdi')
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5">
            <i class="fas fa-file-alt me-2"></i> Penilaian Instrumen Prodi
        </a>
    </li>
@endsection

@section('menuUnduhDokumen')
    @foreach($auditess->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection

@section('styles')
    <style>
        .audit-table th {
            background-color: var(--kt-gray-100);
            color: var(--kt-gray-700);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border: none;
        }

        .audit-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--kt-gray-200);
            vertical-align: middle;
        }

        .audit-table tbody tr:hover {
            background-color: var(--kt-gray-50);
        }

        .level-header {
            background-color: var(--kt-gray-100);
            color: var(--kt-gray-800);
            font-weight: 600;
            border-left: 4px solid var(--kt-primary);
        }

        .level-subheader {
            background-color: var(--kt-gray-50);
            color: var(--kt-gray-800);
            font-weight: 500;
            border-left: 3px solid var(--kt-info);
        }

        .level-item {
            color: var(--kt-gray-700);
        }

        .level-item:hover {
            background-color: var(--kt-gray-25);
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-completed {
            background-color: var(--kt-success);
        }

        .status-pending {
            background-color: var(--kt-gray-400);
        }

        .pdf-container {
            border-radius: 0.475rem;
            overflow: hidden;
            box-shadow: 0 0 20px 0 rgba(76, 87, 125, 0.1);
        }
    </style>
@endsection

@section('dashboardProfile')
    <!-- Back Button -->
    <div class="mb-5">
        <a href="{{ route('auditor.audit.daftarAuditee') }}" class="btn btn-light-primary btn-sm">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Daftar Auditee
        </a>
    </div>

    <!--begin::Welcome Card-->
    <div class="card mb-5 mb-xl-8">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-50px me-5">
                    <span class="symbol-label bg-light-primary text-primary fs-1">
                        👋
                    </span>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center">
                        <span class="text-gray-800 fw-bold fs-4 me-2">Selamat Datang,</span>
                        <span class="text-primary fw-bolder fs-4">{{ Auth::user()->name }}</span>
                    </div>
                    <span class="text-muted fw-semibold">Dashboard Data Auditor</span>
                </div>
                <div class="flex-shrink-0">
                    @if(isset($auditess->audit_status))
                        @if($auditess->audit_status['status'] === 'completed')
                            <a href="{{ route('auditor.audit.deskEvaluation',[$auditess->id]) }}" class="btn btn-info btn-xs">
                                <i class="ki-duotone ki-document fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Lihat Hasil Audit
                            </a>
                        @elseif($auditess->audit_status['status'] === 'visitasi_waiting')
                            <button class="btn btn-warning btn-xs" disabled>
                                <i class="fas fa-clock fs-3 me-2"></i>
                                Menunggu Jadwal Visitasi
                            </button>
                        @elseif($auditess->audit_status['status'] === 'visitasi_expired')
                            <button class="btn btn-danger btn-xs" disabled>
                                <i class="fas fa-exclamation-triangle fs-3 me-2"></i>
                                Jadwal Visitasi Berakhir
                            </button>
                        @elseif($auditess->audit_status['status'] === 'visitasi_ready')
                            <a href="{{ route('auditor.audit.visitasi',[$auditess->id]) }}" class="btn btn-success btn-xs">
                                <i class="fas fa-clipboard-list fs-3 me-2"></i>
                                Mulai Visitasi
                            </a>
                        @elseif($auditess->audit_status['status'] !== 'new')
                            <a href="{{ route('auditor.audit.deskEvaluation',[$auditess->id]) }}" class="btn btn-warning btn-xs">
                                <i class="ki-duotone ki-document fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Lanjutkan Audit
                            </a>
                        @else
                            <a href="{{ route('auditor.audit.deskEvaluation',[$auditess->id]) }}" class="btn btn-success btn-xs">
                                <i class="ki-duotone ki-rocket fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Mulai Proses Audit
                            </a>
                        @endif
                    @else
                        <a href="{{ route('auditor.audit.deskEvaluation',[$auditess->id]) }}" class="btn btn-success btn-xs">
                            <i class="ki-duotone ki-rocket fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Mulai Proses Audit
                        </a>
                    @endif
                </div>
            </div>
        </div>
 </div>

    <!--begin::Main Content Row-->
    <div class="row g-5 g-xl-8">
        <!-- Left Column - Table Instrumen -->
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Daftar Instrumen Audit</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Instrumen audit berdasarkan indikator kinerja</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="symbol symbol-30px symbol-circle bg-light-primary">
                            <span class="symbol-label">
                                <i class="ki-duotone ki-abstract-26 fs-6 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body py-3">
                    @if($auditess && $auditess->ikssAuditee)
                        @php
                            $groupedData = $auditess->ikssAuditee
                                ->filter(function($ikss) {
                                    return $ikss->instrumen &&
                                           $ikss->instrumen->indikatorKinerja &&
                                           $ikss->instrumen->indikatorKinerja->satuanStandar;
                                })
                                @php
                                    $groupedData = $auditess->ikssAuditee
                                        ->filter(function($ikss) {
                                            return $ikss->instrumen &&
                                                   $ikss->instrumen->indikatorKinerja &&
                                                   $ikss->instrumen->indikatorKinerja->satuanStandar;
                                        })
                                        @php
                                            $groupedData = $auditess->ikssAuditee
                                                ->filter(function($ikss) {
                                                    return $ikss->instrumen &&
                                                           $ikss->instrumen->indikatorKinerja &&
                                                           $ikss->instrumen->indikatorKinerja->satuanStandar;
                                                })
                                                ->sortBy('instrumen.indikatorKinerja.satuanStandar.id') // Urutkan berdasarkan ID SS
                                                ->groupBy('instrumen.indikatorKinerja.satuanStandar.sasaran')
                                                ->map(function($satuanGroup) {
                                                    return $satuanGroup->groupBy('instrumen.indikatorKinerja.tujuan');
                                                });
                                        @endphp
                                        ->groupBy('instrumen.indikatorKinerja.satuanStandar.sasaran')
                                        ->map(function($satuanGroup) {
                                            return $satuanGroup->groupBy('instrumen.indikatorKinerja.tujuan');
                                        });
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 audit-table">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-400px">Instrumen Audit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                                        <!-- Sasaran Strategis Header -->
                                        <tr class="level-header">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-35px me-4">
                                                        <span class="symbol-label bg-primary">
                                                            <i class="ki-duotone ki-abstract-26 fs-5 text-white">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-bold fs-5 text-gray-900"> {{ $indikatorGroups->first()->first()->instrumen->indikatorKinerja->satuanStandar->kode_satuan ?? '-' }}</span>
                                                        <span class="text-muted fs-5 fw-semibold ">{{ $satuanStandardNama ?? 'Sasaran Strategis Tidak Ditemukan' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                            @php
                                                $completedCount = $ikssGroup->where('status', 1)->count();
                                                $totalCount = $ikssGroup->count();
                                                $firstIkss = $ikssGroup->first();
                                                $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                            @endphp

                                            <!-- Indikator Kinerja Subheader -->
                                            <tr class="level-subheader">
                                                <td>
                                                    <div class="d-flex align-items-center ps-8">
                                                        <div class="symbol symbol-30px me-3">
                                                            <span class="symbol-label bg-info">
                                                                <i class="ki-duotone ki-chart-line fs-6 text-white">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold fs-6 text-gray-800">{{ $indikatorKinerja->kode_ikss }}</span>
                                                            <span class="text-muted fs-7">{{ $indikatorKinerjaNama }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Instrumen Items -->
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <tr class="level-item">
                                                        <td>
                                                            <div class="d-flex align-items-center ps-16">
                                                                <div class="symbol symbol-25px me-3">
                                                                    <span class="symbol-label bg-light-secondary">
                                                                        <i class="ki-duotone ki-document fs-7 text-secondary">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i>
                                                                    </span>
                                                                </div>
                                                                <span class="fs-6 text-gray-800 fw-semibold">{{ $ikss->instrumen->indikator }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <img src="assets/media/illustrations/sketchy-1/5.png" alt="" class="h-150px">
                            <div class="pt-10 pb-5">
                                <p class="text-dark fw-semibold fs-6 mb-2">Tidak ada data instrumen</p>
                                <p class="text-muted fs-7">Instrumen audit belum tersedia untuk ditampilkan</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - PDF Viewer -->
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Dokumen Perjanjian Kinerja</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">File PDF perjanjian kinerja audit</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="symbol symbol-30px symbol-circle bg-light-danger">
                            <span class="symbol-label">
                                <i class="ki-duotone ki-document fs-6 text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="pdf-container" style="height: 700px;">
                        @if($auditess && $auditess->perjanjianKinerja && $auditess->perjanjianKinerja->file_path)
                            <iframe src="{{ asset('storage/' . $auditess->perjanjianKinerja->file_path) }}"
                                    style="width: 100%; height: 100%; border: none; border-radius: 0.475rem;"
                                    title="Perjanjian Kinerja PDF">
                            </iframe>
                        @else
                            <div class="text-center py-20">
                                <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="h-150px">
                                <div class="pt-10 pb-5">
                                    <p class="text-dark fw-semibold fs-6 mb-2">File PDF Belum Tersedia</p>
                                    <p class="text-muted fs-7 mb-5">Silakan upload dokumen Perjanjian Kinerja terlebih dahulu</p>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="ki-duotone ki-cloud-upload fs-5 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Upload Dokumen
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
