@extends('dataauditor/dashboard_template')

@section('menuPenilaianInstrumenProdi')
    @php
        $isKetua = false;
        foreach($auditess as $auditee) {
            foreach($auditee->auditors as $penugasan) {
                if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id()) {
                    $isKetua = true;
                    break 2;
                }
            }
        }
    @endphp

    @if($isKetua)
        <li class="nav-item mt-2">
            <a href="#" class="nav-link text-active-primary ms-0 me-10 py-5">
                <i class="fas fa-file-alt me-2"></i> Penilaian Instrumen Prodi
            </a>
        </li>
    @endif
@endsection

@section('menuUnduhDokumen')
    @php
        $isKetua = false;
        foreach($auditess as $auditee) {
            foreach($auditee->auditors as $penugasan) {
                if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id()) {
                    $isKetua = true;
                    break 2;
                }
            }
        }
    @endphp

    @if($isKetua)
        <li class="nav-item mt-2">
            <a href="#" class="nav-link text-active-primary ms-0 me-10 py-5">
                <i class="fas fa-download me-2"></i> Unduh Dokumen
            </a>
        </li>
    @endif
@endsection

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="fas fa-clipboard-list fs-2 text-primary me-2"></i>
                    Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <!--begin::Welcome Alert-->
                <div class="alert alert-primary d-flex align-items-center p-6 mb-8">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-light-primary">
                            <i class="fas fa-info-circle fs-2 text-primary"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1">
                        <h4 class="mb-1 text-primary fw-bold">Selamat Datang di Dashboard Auditor</h4>
                        <span class="fs-6 text-gray-700">
                            Berikut adalah daftar auditee yang telah ditugaskan kepada Anda untuk dilakukan proses audit.
                            Silakan pilih auditee yang ingin Anda audit terlebih dahulu.
                        </span>
                        @php
                            $activePeriods = $auditess->filter(function($auditee) {
                                return $auditee->is_audit_period_active;
                            });
                            $inactivePeriods = $auditess->filter(function($auditee) {
                                return !$auditee->is_audit_period_active;
                            });
                        @endphp
                        @if($inactivePeriods->count() > 0)
                            <div class="mt-3 p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded">
                                <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                <strong>Perhatian:</strong> {{ $inactivePeriods->count() }} auditee belum dapat diaudit karena jadwal audit belum aktif.
                                Tombol "Mulai Audit" dan "Lanjutkan" akan aktif setelah jadwal audit dimulai.
                            </div>
                        @endif
                    </div>
                </div>
                <!--end::Welcome Alert-->

                <!--begin::Search and Filter Section-->
                <div class="card shadow-sm border-0 mb-8">
                    <div class="card-body p-0">
                        <div class="py-5 px-10 bg-light-primary">
                            <div class="row g-3">
                                <!-- Search Input -->
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center position-relative">
                                        <i class="fas fa-search fs-3 position-absolute ms-5 text-muted"></i>
                                        <input type="text" id="searchInput" class="form-control form-control-solid ps-12"
                                               placeholder="Cari berdasarkan nama auditee, fakultas, atau jenjang..." />
                                    </div>
                                </div>

                                <!-- Status Filter -->
                                <div class="col-lg-3">
                                    <select id="statusFilter" class="form-select form-select-solid">
                                        <option value="">Semua Status</option>
                                        <option value="new">Baru</option>
                                        <option value="in_progress">Sedang Berlangsung</option>
                                        <option value="completed">Selesai</option>
                                        <option value="visitasi_waiting">Menunggu Jadwal</option>
                                        <option value="visitasi_expired">Jadwal Berakhir</option>
                                    </select>
                                </div>

                                <!-- Jenjang Filter -->
                                <div class="col-lg-3">
                                    <select id="jenjangFilter" class="form-select form-select-solid">
                                        <option value="">Semua Jenjang</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                    </select>
                                </div>

                                <!-- Clear Filters Button -->
                                <div class="col-lg-2">
                                    <button type="button" id="clearFilters" class="btn btn-danger w-100">
                                        <i class="fas fa-times me-1"></i>
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Search and Filter Section-->

                <!--begin::Statistics Cards-->
                <div class="row g-4 mb-8">
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-light-primary">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-primary text-inverse-primary">
                                            <i class="fas fa-list fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Total Auditee</span>
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-light-success">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-success text-inverse-success">
                                            <i class="fas fa-check-circle fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Selesai</span>
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('overall_audit_status', 'completed')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-light-warning">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-warning text-inverse-warning">
                                            <i class="fas fa-clock fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Sedang Berlangsung</span>
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('overall_audit_status', 'in_progress')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-light-info">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-info text-inverse-info">
                                            <i class="fas fa-plus-circle fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Baru</span>
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('overall_audit_status', 'new')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Statistics Cards-->

                <!--begin::Auditee Cards Section-->
                <div class="row g-4" id="auditeeCards">
                    @forelse($auditess as $index => $auditee)
                        <div class="col-xl-4 col-lg-6 col-md-6 audit-card"
                             data-name="{{ strtolower($auditee->auditee->nama_unit_kerja) }}"
                             data-status="{{ $auditee->overall_audit_status }}"
                             data-jenjang="{{ $auditee->auditee->jenjang }}"
                             data-role="{{ collect($auditee->auditors)->where('user_id', Auth::user()->id)->first()->role ?? '' }}">

                            <div class="card h-100 shadow-sm hover-elevate-up {{ $auditee->overall_audit_status === 'new' ? 'border-primary border-2' : '' }}">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-4 pb-2 position-relative">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-building fs-1 text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-dark fw-bold fs-5">{{ $auditee->auditee->jenjang . ' ' . $auditee->auditee->nama_unit_kerja }}</span>
                                            <span class="text-muted fw-semibold fs-7">
                                                <i class="fas fa-user-tie text-primary me-1"></i>
                                                {{ collect($auditee->auditors)->where('user_id', Auth::user()->id)->first()->role ?? 'Auditor' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Status Badge - Positioned absolutely at top-right -->
                                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                                        @if($auditee->overall_audit_status === 'new')
                                            <div class="badge badge-light-danger fs-7">
                                                <i class="fas fa-star me-1"></i>
                                                Baru
                                            </div>
                                        @elseif($auditee->overall_audit_status === 'completed')
                                            <div class="badge badge-light-success fs-7">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Selesai
                                            </div>
                                        @elseif($auditee->overall_audit_status === 'in_progress')
                                            <div class="badge badge-light-warning fs-7">
                                                <i class="fas fa-clock me-1"></i>
                                                Dalam Proses
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <!--begin::Info Row-->
                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-info">
                                                        <i class="fas fa-graduation-cap text-info fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Jenjang</span>
                                                    <span class="fw-bold fs-7">{{ $auditee->auditee->jenjang }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-danger">
                                                        <i class="fas fa-university text-danger fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Fakultas</span>
                                                    <span class="fw-bold fs-7">{{ $auditee->auditee->fakultas ?: '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Info Row-->

                                    <!--begin::Status Info Row-->
                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                @php
                                                    // Determine status based on overall_audit_status
                                                    $statusColor = 'primary';
                                                    $statusIcon = 'fas fa-clock';
                                                    $statusLabel = 'Baru Ditugaskan';

                                                    if ($auditee->overall_audit_status === 'completed') {
                                                        $statusColor = 'success';
                                                        $statusIcon = 'fas fa-check-circle';
                                                        $statusLabel = 'Selesai Diaudit';
                                                    } elseif ($auditee->overall_audit_status === 'in_progress') {
                                                        $statusColor = 'warning';
                                                        $statusIcon = 'fas fa-clock';
                                                        $statusLabel = 'Sedang Berlangsung';
                                                    }
                                                @endphp
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-{{ $statusColor }}">
                                                        <i class="{{ $statusIcon }} text-{{ $statusColor }} fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Status</span>
                                                    <span class="fw-bold fs-7">{{ $statusLabel }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-{{ $auditee->is_audit_period_active ? 'success' : 'danger' }}">
                                                        <i class="fas fa-calendar-alt text-{{ $auditee->is_audit_period_active ? 'success' : 'danger' }} fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Jadwal Audit</span>
                                                    <span class="fw-bold fs-7 {{ $auditee->is_audit_period_active ? 'text-success' : 'text-danger' }}">
                                                        {{ $auditee->is_audit_period_active ? 'Aktif' : 'Belum Aktif' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Status Info Row-->

                                    <!--begin::Auditors-->
                                    <div class="separator separator-dashed my-3"></div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-muted fw-semibold fs-8">
                                                <i class="fas fa-users me-1"></i>
                                                Tim Auditor ({{ $auditee->auditors->count() }} orang)
                                            </span>
                                        </div>

                                        @forelse ($auditee->auditors as $auditor)
                                            @php
                                                // Check auditor completion based on is_setuju fields
                                                $auditorCompleted = $auditor->is_setuju && $auditor->is_setuju_visitasi && $auditor->is_setuju_indikator_prodi;
                                                $hasStarted = $auditor->is_setuju || $auditor->is_setuju_visitasi || $auditor->is_setuju_indikator_prodi;
                                            @endphp

                                            <div class="d-flex align-items-center mb-2">
                                                <div class="symbol symbol-30px me-2">
                                                    @if($auditor->auditor->foto)
                                                        <img src="{{ Storage::url($auditor->auditor->foto) }}" alt="{{ $auditor->auditor->name }}" class="rounded-circle" />
                                                    @else
                                                        <span class="symbol-label bg-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}">
                                                            <i class="fas fa-user text-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-6"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                    <span class="text-muted fw-semibold fs-8">{{ ucfirst($auditor->role) }}</span>
                                                </div>
                                                @if ($auditorCompleted)
                                                    <span class="badge badge-light-success fs-8">
                                                        <i class="fas fa-check me-1"></i>
                                                        Selesai
                                                    </span>
                                                @elseif ($hasStarted)
                                                    <span class="badge badge-light-warning fs-8">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Proses
                                                    </span>
                                                @else
                                                    <span class="badge badge-light-secondary fs-8">
                                                        <i class="fas fa-hourglass-start me-1"></i>
                                                        Belum Mulai
                                                    </span>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="text-muted fst-italic fs-8">Belum ada auditor yang ditugaskan</div>
                                        @endforelse
                                    </div>
                                    <!--end::Auditors-->
                                </div>
                                <!--end::Body-->

                                <!--begin::Footer-->
                                <div class="card-footer pt-0">
                                    <div class="d-flex gap-2">
                                        @if($auditee->overall_audit_status === 'visitasi_waiting' || $auditee->overall_audit_status === 'visitasi_expired')
                                            <button class="btn btn-sm btn-{{ $auditee->overall_audit_status === 'visitasi_waiting' ? 'warning' : 'danger' }} flex-grow-1" disabled>
                                                <i class="fas fa-{{ $auditee->overall_audit_status === 'visitasi_waiting' ? 'clock' : 'exclamation-triangle' }} me-1"></i>
                                                {{ $auditee->overall_audit_status === 'visitasi_waiting' ? 'Menunggu Jadwal' : 'Jadwal Berakhir' }}
                                            </button>
                                        @elseif(!$auditee->is_audit_period_active)
                                            <button class="btn btn-sm btn-secondary flex-grow-1" disabled>
                                                <i class="fas fa-calendar-times me-1"></i>
                                                Jadwal Audit Belum Aktif
                                            </button>
                                        @else
                                            <a href="{{ route('auditor.audit.perjanjianKinerja', $auditee->id) }}"
                                               class="btn btn-sm btn-{{ $auditee->overall_audit_status === 'new' ? 'primary' : 'light-primary' }} flex-grow-1">
                                                <i class="fas fa-{{ $auditee->overall_audit_status === 'new' ? 'arrow-right' : 'file-alt' }} me-1"></i>
                                                @if($auditee->overall_audit_status === 'new')
                                                    Mulai Audit
                                                @elseif($auditee->overall_audit_status === 'completed')
                                                    Lihat Hasil
                                                @else
                                                    Lanjutkan
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Footer-->
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-body text-center p-10">
                                    <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                    <h4 class="text-gray-800 mb-2">Belum ada penugasan</h4>
                                    <p class="text-gray-600">Anda belum ditugaskan untuk mengaudit auditee manapun</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!--end::Auditee Cards Section-->

            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection

@push('styles')
<style>
    /* Custom styles for daftar auditee page */
    .card.shadow-sm {
        border: none;
        box-shadow: 0 0.1rem 1rem 0.25rem rgba(0, 0, 0, 0.05) !important;
        transition: all 0.3s ease;
    }

    .card.shadow-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 2rem 0.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .hover-elevate-up {
        transition: all 0.3s ease;
    }

    .hover-elevate-up:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 2rem 0.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .border-primary.border-2 {
        border-color: #009ef7 !important;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(0, 158, 247, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(0, 158, 247, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 158, 247, 0); }
    }

    .alert-primary {
        background-color: #e1f0ff;
        border-color: #b3d9ff;
        color: #0c63e4;
    }

    /* Symbol sizes */
    .symbol.symbol-60px {
        width: 60px;
        height: 60px;
    }

    .symbol.symbol-50px {
        width: 50px;
        height: 50px;
    }

    .symbol.symbol-40px {
        width: 40px;
        height: 40px;
    }

    .symbol.symbol-30px {
        width: 30px;
        height: 30px;
    }

    .symbol.symbol-80px {
        width: 80px;
        height: 80px;
    }

    /* Badge improvements */
    .badge.badge-light-primary {
        background-color: #e1f0ff;
        color: #009ef7;
    }

    .badge.badge-light-info {
        background-color: #e8f6ff;
        color: #0dcaf0;
    }

    .badge.badge-light-success {
        background-color: #e8fff3;
        color: #50cd89;
    }

    .badge.badge-light-warning {
        background-color: #fff8dd;
        color: #ffc700;
    }

    .badge.badge-light-danger {
        background-color: #ffe4e6;
        color: #f1416c;
    }

    .badge.badge-light-secondary {
        background-color: #f8f9fa;
        color: #6c757d;
    }

    .badge.badge-light-muted {
        background-color: #e9ecef;
        color: #6c757d;
    }

    /* Background colors for statistics cards */
    .bg-light-primary {
        background-color: #e1f0ff !important;
    }

    .bg-light-success {
        background-color: #e8fff3 !important;
    }

    .bg-light-warning {
        background-color: #fff8dd !important;
    }

    .bg-light-info {
        background-color: #e8f6ff !important;
    }

    /* Button improvements */
    .btn-light-primary {
        background-color: #e1f0ff;
        border-color: #e1f0ff;
        color: #009ef7;
    }

    .btn-light-primary:hover {
        background-color: #009ef7;
        border-color: #009ef7;
        color: #ffffff;
    }

    .btn-light-secondary {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        color: #6c757d;
    }

    .btn-light-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
    }

    /* Text utilities */
    .text-break {
        word-wrap: break-word;
        word-break: break-word;
    }

    .fs-8 {
        font-size: 0.75rem !important;
    }

    .fs-9 {
        font-size: 0.625rem !important;
    }

    /* Search input improvements */
    .form-control-solid {
        background-color: #f5f8fa;
        border-color: #f5f8fa;
        color: #3f4254;
    }

    .form-control-solid:focus {
        background-color: #ffffff;
        border-color: #009ef7;
        color: #3f4254;
    }

    .form-select-solid {
        background-color: #f5f8fa;
        border-color: #f5f8fa;
        color: #3f4254;
    }

    .form-select-solid:focus {
        background-color: #ffffff;
        border-color: #009ef7;
        color: #3f4254;
    }

    /* Separator */
    .separator.separator-dashed {
        border-top: 1px dashed #e1e3ea;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .card-toolbar {
            flex-direction: column;
            gap: 1rem;
        }

        .symbol.symbol-60px {
            width: 50px;
            height: 50px;
        }

        .symbol.symbol-50px {
            width: 40px;
            height: 40px;
        }

        .symbol.symbol-40px {
            width: 35px;
            height: 35px;
        }

        .symbol.symbol-30px {
            width: 25px;
            height: 25px;
        }
    }

    /* Hide cards that don't match filter */
    .audit-card.hidden {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const jenjangFilter = document.getElementById('jenjangFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const cardsContainer = document.querySelector('#auditeeCards');

    // Function to filter cards
    function filterCards() {
        const searchTerm = searchInput.value.toLowerCase();
        const status = statusFilter.value;
        const jenjang = jenjangFilter.value;

        const cards = document.querySelectorAll('.audit-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const cardStatus = card.getAttribute('data-status');
            const cardJenjang = card.getAttribute('data-jenjang');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (status && cardStatus !== status) {
                show = false;
            }

            // Jenjang filter
            if (jenjang && cardJenjang !== jenjang) {
                show = false;
            }

            if (show) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update total count if element exists
        const totalCountElement = document.getElementById('totalCount');
        if (totalCountElement) {
            totalCountElement.textContent = visibleCount;
        }
    }

    // Event listeners
    searchInput.addEventListener('input', filterCards);
    statusFilter.addEventListener('change', filterCards);
    jenjangFilter.addEventListener('change', filterCards);

    clearFiltersBtn.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        jenjangFilter.value = '';
        filterCards();
    });

    // Initialize filters
    filterCards();
});
</script>
@endpush
