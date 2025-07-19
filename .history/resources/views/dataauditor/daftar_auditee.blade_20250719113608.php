@extends('dataauditor/dashboard_template')
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
                    </div>
                </div>
                <!--end::Welcome Alert-->

                <!--begin::Search and Filter Section-->
                <div class="card shadow-sm border-0 mb-8">
                    <div class="card-body p-6">
                        <div class="row g-4">
                            <!-- Search Input -->
                            <div class="col-lg-4 col-md-6">
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" id="searchInput" class="form-control form-control-lg ps-5"
                                           placeholder="Cari auditee..." onkeyup="filterCards()">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-lg-3 col-md-6">
                                <select id="statusFilter" class="form-select form-select-lg" onchange="filterCards()">
                                    <option value="">Semua Status</option>
                                    <option value="new">Baru</option>
                                    <option value="in_progress">Sedang Berlangsung</option>
                                    <option value="completed">Selesai</option>
                                    <option value="visitasi_waiting">Menunggu Jadwal</option>
                                    <option value="visitasi_expired">Jadwal Berakhir</option>
                                </select>
                            </div>

                            <!-- Jenjang Filter -->
                            <div class="col-lg-3 col-md-6">
                                <select id="jenjangFilter" class="form-select form-select-lg" onchange="filterCards()">
                                    <option value="">Semua Jenjang</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                </select>
                            </div>

                            <!-- Role Filter -->
                            <div class="col-lg-2 col-md-6">
                                <select id="roleFilter" class="form-select form-select-lg" onchange="filterCards()">
                                    <option value="">Semua Role</option>
                                    <option value="ketua">Ketua</option>
                                    <option value="anggota">Anggota</option>
                                </select>
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
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('audit_status.status', 'completed')->count() }}</span>
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
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('audit_status.status', 'in_progress')->count() }}</span>
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
                                        <span class="fw-bold fs-4 text-dark">{{ $auditess->where('audit_status.status', 'new')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Statistics Cards-->

                <!--begin::Auditee Cards Section-->
                <div class="card shadow-sm border-0">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex flex-column">
                                <h3 class="fw-bold text-dark mb-2">
                                    <i class="fas fa-list-ul fs-2 text-primary me-3"></i>
                                    Daftar Auditee yang Ditugaskan
                                </h3>
                                <span class="text-muted fw-semibold fs-6">Pilih auditee untuk memulai proses audit</span>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-light-primary fs-7 fw-bold">
                                    <i class="fas fa-clock me-1"></i>
                                    Total: <span id="totalCount">{{ $auditess->count() }}</span> Auditee
                                </span>
                                <button type="button" class="btn btn-sm btn-light-secondary" onclick="resetFilters()">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        @if($auditess->count() > 0)
                            <div class="row g-4" id="auditeeCards">
                                @foreach($auditess as $index => $auditee)
                                    <div class="col-xl-4 col-lg-6 col-md-6 auditee-card"
                                         data-name="{{ strtolower($auditee->auditee->nama_unit_kerja) }}"
                                         data-status="{{ $auditee->audit_status['status'] }}"
                                         data-jenjang="{{ $auditee->auditee->jenjang }}"
                                         data-role="{{ collect($auditee->auditors)->where('user_id', Auth::user()->id)->first()->role ?? '' }}">

                                        <div class="card shadow-sm border-0 h-100 {{ $auditee->audit_status['status'] === 'new' ? 'border-primary border-2' : '' }}">
                                            <div class="card-body p-6">
                                                <!-- Header with Icon and Status -->
                                                <div class="d-flex justify-content-between align-items-start mb-4">
                                                    <div class="symbol symbol-60px me-3">
                                                        <div class="symbol-label bg-light-primary">
                                                            <i class="fas fa-university fs-2 text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge badge-light-{{ $auditee->audit_status['color'] }} fw-bold fs-8">
                                                            {{ $auditee->audit_status['label'] }}
                                                        </span>
                                                        @if($auditee->audit_status['status'] === 'new')
                                                            <div class="mt-1">
                                                                <span class="badge badge-light-danger fw-bold fs-8">
                                                                    <i class="fas fa-star me-1"></i>Baru
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Auditee Info -->
                                                <div class="mb-4">
                                                    <h5 class="text-dark fw-bold fs-6 mb-2 text-break">{{ $auditee->auditee->nama_unit_kerja }}</h5>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="badge badge-light-info fw-bold me-2">{{ $auditee->auditee->jenjang }}</span>
                                                        @if($auditee->auditee->fakultas)
                                                            <span class="text-muted fw-semibold fs-8">{{ $auditee->auditee->fakultas }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Tim Auditor -->
                                                <div class="mb-4">
                                                    <h6 class="fw-bold text-dark mb-3 fs-7">
                                                        <i class="fas fa-users me-2 text-primary"></i>Tim Auditor
                                                    </h6>
                                                    @forelse ($auditee->auditors as $auditor)
                                                        @php
                                                            $auditorCompleted = false;
                                                            if ($auditor->user_id == Auth::user()->id) {
                                                                $auditorCompleted = $auditee->audit_status['status'] === 'completed';
                                                            } else {
                                                                $evaluasiCount = \App\Models\EvaluasiSubmission::where('pengajuan_ami_id', $auditee->id)
                                                                    ->where('user_id', $auditor->user_id)
                                                                    ->where('jenis', 'auditor')
                                                                    ->count();
                                                                $masukanCount = \App\Models\EvaluasiMasukan::where('pengajuan_ami_id', $auditee->id)
                                                                    ->where('user_id', $auditor->user_id)
                                                                    ->count();
                                                                $auditorCompleted = $evaluasiCount > 0 && $masukanCount > 0;
                                                            }
                                                        @endphp
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="symbol symbol-32px me-2">
                                                                <div class="symbol-label bg-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}">
                                                                    <i class="fas fa-user-tie fs-8 text-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="text-dark fw-semibold fs-8">{{ $auditor->auditor->name }}</span>
                                                                    @if($auditorCompleted)
                                                                        <i class="fas fa-check-circle fs-8 text-success ms-1" title="Audit Selesai"></i>
                                                                    @endif
                                                                </div>
                                                                <span class="badge badge-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-9 fw-bold">
                                                                    {{ ucfirst($auditor->role) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-user-slash fs-8 text-warning me-2"></i>
                                                            <span class="text-muted fw-semibold fs-8">Belum ditugaskan</span>
                                                        </div>
                                                    @endforelse
                                                </div>

                                                <!-- Status Description -->
                                                <div class="mb-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="{{ $auditee->audit_status['icon'] }} fs-8 text-{{ $auditee->audit_status['color'] }} me-2"></i>
                                                        <span class="text-muted fw-semibold fs-8">{{ $auditee->audit_status['description'] }}</span>
                                                    </div>
                                                </div>

                                                <!-- Action Button -->
                                                <div class="d-grid">
                                                    @if($auditee->audit_status['status'] === 'visitasi_waiting' || $auditee->audit_status['status'] === 'visitasi_expired')
                                                        <button class="btn btn-{{ $auditee->audit_status['status'] === 'visitasi_waiting' ? 'warning' : 'danger' }}" disabled>
                                                            <i class="fas fa-{{ $auditee->audit_status['status'] === 'visitasi_waiting' ? 'clock' : 'exclamation-triangle' }} me-2"></i>
                                                            {{ $auditee->audit_status['status'] === 'visitasi_waiting' ? 'Menunggu Jadwal' : 'Jadwal Berakhir' }}
                                                        </button>
                                                    @else
                                                        <a href="{{ route('auditor.audit.perjanjianKinerja', $auditee->id) }}"
                                                           class="btn btn-{{ $auditee->audit_status['status'] === 'new' ? 'primary' : 'light-primary' }}">
                                                            <i class="fas fa-{{ $auditee->audit_status['status'] === 'new' ? 'arrow-right' : 'file-alt' }} me-2"></i>
                                                            @if($auditee->audit_status['status'] === 'new')
                                                                Mulai Audit
                                                            @elseif($auditee->audit_status['status'] === 'completed')
                                                                Lihat Hasil Audit
                                                            @else
                                                                Lanjutkan Audit
                                                            @endif
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="symbol symbol-80px mb-4">
                                        <span class="symbol-label bg-light-muted">
                                            <i class="fas fa-clipboard-list fs-3x text-muted"></i>
                                        </span>
                                    </div>
                                    <h4 class="text-muted fw-bold fs-5 mb-2">Belum Ada Penugasan</h4>
                                    <span class="text-muted fw-semibold fs-6">Anda belum ditugaskan untuk mengaudit auditee manapun</span>
                                </div>
                            </div>
                        @endif
                    </div>
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

    .symbol.symbol-32px {
        width: 32px;
        height: 32px;
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
    .form-control-lg {
        height: 3rem;
        font-size: 1rem;
    }

    .form-select-lg {
        height: 3rem;
        font-size: 1rem;
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

        .symbol.symbol-32px {
            width: 28px;
            height: 28px;
        }
    }

    /* Hide cards that don't match filter */
    .auditee-card.hidden {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
    function filterCards() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const jenjangFilter = document.getElementById('jenjangFilter').value;
        const roleFilter = document.getElementById('roleFilter').value;

        const cards = document.querySelectorAll('.auditee-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const status = card.getAttribute('data-status');
            const jenjang = card.getAttribute('data-jenjang');
            const role = card.getAttribute('data-role');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (statusFilter && status !== statusFilter) {
                show = false;
            }

            // Jenjang filter
            if (jenjangFilter && jenjang !== jenjangFilter) {
                show = false;
            }

            // Role filter
            if (roleFilter && role !== roleFilter) {
                show = false;
            }

            if (show) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update total count
        document.getElementById('totalCount').textContent = visibleCount;
    }

    function resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('jenjangFilter').value = '';
        document.getElementById('roleFilter').value = '';

        const cards = document.querySelectorAll('.auditee-card');
        cards.forEach(card => {
            card.classList.remove('hidden');
        });

        document.getElementById('totalCount').textContent = cards.length;
    }

    // Initialize filters on page load
    document.addEventListener('DOMContentLoaded', function() {
        filterCards();
    });
</script>
@endpush
