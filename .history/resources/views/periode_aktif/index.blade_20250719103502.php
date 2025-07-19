@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Periode Aktif
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Periode Aktif</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Hero Header Section -->
            <div class="hero-header mb-10">
                <div class="position-relative overflow-hidden rounded-4 bg-gradient-primary p-8 text-white">
                    <div class="position-absolute top-0 end-0 opacity-10">
                        <i class="ki-duotone ki-calendar fs-1 display-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-6 fw-bold mb-3 text-white">🎯 Manajemen Periode Aktif</h1>
                            <p class="fs-5 opacity-90 mb-4">Kelola periode audit mutu internal dengan interface yang modern dan intuitif. Semua informasi penting dalam satu tempat yang mudah diakses.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-2 bg-white bg-opacity-20 rounded-pill px-4 py-2">
                                    <i class="fas fa-shield-check text-warning"></i>
                                    <span class="fw-semibold">Keamanan Data</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 bg-white bg-opacity-20 rounded-pill px-4 py-2">
                                    <i class="fas fa-clock text-info"></i>
                                    <span class="fw-semibold">Real-time Updates</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 bg-white bg-opacity-20 rounded-pill px-4 py-2">
                                    <i class="fas fa-mobile-alt text-success"></i>
                                    <span class="fw-semibold">Responsive Design</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <button type="button" class="btn btn-light btn-lg d-flex align-items-center gap-3 mx-auto shadow-lg" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                <div class="btn-icon-wrapper">
                                    <i class="fas fa-plus fs-4"></i>
                                </div>
                                <div class="text-start">
                                    <div class="fw-bold">Tambah Periode</div>
                                    <small class="opacity-75">Buat periode baru</small>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-6 mb-8">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card bg-gradient-success text-white rounded-4 p-6 position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-check-circle display-4"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fs-6 opacity-75 mb-1">Periode Aktif</div>
                                <div class="display-6 fw-bold">{{ $periodeAktifs->where('deleted_at', null)->count() }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card bg-gradient-warning text-white rounded-4 p-6 position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-clock display-4"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fs-6 opacity-75 mb-1">Total Jadwal</div>
                                <div class="display-6 fw-bold">{{ $periodeAktifs->sum(function($periode) { return $periode->jadwal->count(); }) }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clock fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card bg-gradient-info text-white rounded-4 p-6 position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-users display-4"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fs-6 opacity-75 mb-1">Total Periode</div>
                                <div class="display-6 fw-bold">{{ $periodeAktifs->count() }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card bg-gradient-danger text-white rounded-4 p-6 position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-archive display-4"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fs-6 opacity-75 mb-1">Diarsipkan</div>
                                <div class="display-6 fw-bold">{{ $periodeAktifs->where('deleted_at', '!=', null)->count() }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-archive fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-filter-section mb-8">
                <div class="card card-flush border-0 shadow-lg rounded-4">
                    <div class="card-body p-6">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="search-wrapper position-relative">
                                    <div class="search-icon">
                                        <i class="ki-duotone ki-magnifier fs-2 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <input type="text" data-kt-periode-table-filter="search" class="form-control form-control-lg ps-12 border-0 bg-light-primary" placeholder="🔍 Cari periode aktif berdasarkan nomor surat, siklus, atau tahun..." />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex gap-3 justify-content-lg-end">
                                    <select class="form-select form-select-lg border-0 bg-light-primary" data-kt-periode-table-filter="status">
                                        <option value="">📊 Semua Status</option>
                                        <option value="active">✅ Aktif</option>
                                        <option value="inactive">❌ Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Periode Cards -->
            <div class="row g-4" id="periode-cards-container">
                @forelse ($periodeAktifs as $index => $periodeAktif)
                    <div class="col-xl-4 col-lg-6 col-md-6 periode-card" data-status="{{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                        <div class="card h-100 shadow-sm hover-elevate-up">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-4 pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-calendar fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark fw-bold fs-5">{{ $periodeAktif->nomor_surat }}</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            <i class="fas fa-sync-alt text-primary me-1"></i>
                                            Siklus {{ $periodeAktif->siklus }} - {{ $periodeAktif->tahun_ami }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Status Badge-->
                                <div class="mb-3">
                                    @if ($periodeAktif->deleted_at)
                                        <div class="badge badge-danger fs-7 px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i>
                                            Tidak Aktif
                                        </div>
                                    @else
                                        <div class="badge badge-success fs-7 px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Aktif
                                        </div>
                                    @endif
                                </div>
                                <!--end::Status Badge-->

                                <!--begin::Info Row-->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-info">
                                                    <i class="fas fa-calendar-alt text-info fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Tahun AMI</span>
                                                <span class="fw-bold fs-7">{{ $periodeAktif->tahun_ami }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-warning">
                                                    <i class="fas fa-sync-alt text-warning fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Siklus</span>
                                                <span class="fw-bold fs-7">{{ $periodeAktif->siklus }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info Row-->

                                <!--begin::Jadwal Overview-->
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted fw-semibold fs-8">
                                            <i class="fas fa-clock me-1"></i>
                                            Status Jadwal Teratur
                                        </span>
                                    </div>
                                    @php
                                        $loginJadwal = $periodeAktif->jadwal->where('jenis', 'login')->first();
                                        $auditJadwal = $periodeAktif->jadwal->where('jenis', 'audit')->first();
                                        $dataJadwal = $periodeAktif->jadwal->where('jenis', 'data')->first();
                                    @endphp

                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-user-tick text-primary fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-dark fw-bold fs-7">Login</span>
                                            <span class="text-muted fw-semibold fs-8">Auditee & Auditor</span>
                                            @if ($loginJadwal && $loginJadwal->waktu_mulai && $loginJadwal->waktu_selesai)
                                                <span class="text-success fs-8 mt-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    {{ \Carbon\Carbon::parse($loginJadwal->waktu_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($loginJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if ($loginJadwal)
                                            <span class="badge badge-light-success fs-8">
                                                <i class="fas fa-check me-1"></i>
                                                Teratur
                                            </span>
                                        @else
                                            <span class="badge badge-light-warning fs-8">
                                                <i class="fas fa-clock me-1"></i>
                                                Belum Diatur
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="fas fa-shield-tick text-warning fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-dark fw-bold fs-7">Audit</span>
                                            <span class="text-muted fw-semibold fs-8">oleh Auditor</span>
                                            @if ($auditJadwal && $auditJadwal->waktu_mulai && $auditJadwal->waktu_selesai)
                                                <span class="text-success fs-8 mt-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    {{ \Carbon\Carbon::parse($auditJadwal->waktu_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($auditJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if ($auditJadwal)
                                            <span class="badge badge-light-success fs-8">
                                                <i class="fas fa-check me-1"></i>
                                                Teratur
                                            </span>
                                        @else
                                            <span class="badge badge-light-warning fs-8">
                                                <i class="fas fa-clock me-1"></i>
                                                Belum Diatur
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-success">
                                                <i class="fas fa-document text-success fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-dark fw-bold fs-7">Data</span>
                                            <span class="text-muted fw-semibold fs-8">Pengisian Auditee</span>
                                            @if ($dataJadwal && $dataJadwal->waktu_mulai && $dataJadwal->waktu_selesai)
                                                <span class="text-success fs-8 mt-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    {{ \Carbon\Carbon::parse($dataJadwal->waktu_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($dataJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if ($dataJadwal)
                                            <span class="badge badge-light-success fs-8">
                                                <i class="fas fa-check me-1"></i>
                                                Teratur
                                            </span>
                                        @else
                                            <span class="badge badge-light-warning fs-8">
                                                <i class="fas fa-clock me-1"></i>
                                                Belum Diatur
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Jadwal Overview-->

                                <!--begin::Meta Info-->
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-calendar-plus text-muted fs-8 me-2"></i>
                                        <span class="text-muted fs-8">Dibuat: {{ $periodeAktif->created_at ? \Carbon\Carbon::parse($periodeAktif->created_at)->translatedFormat('d F Y') : 'Tidak diketahui' }}</span>
                                    </div>
                                    @if($periodeAktif->updated_at && $periodeAktif->updated_at != $periodeAktif->created_at)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-edit text-muted fs-8 me-2"></i>
                                            <span class="text-muted fs-8">Diupdate: {{ \Carbon\Carbon::parse($periodeAktif->updated_at)->translatedFormat('d F Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Meta Info-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer pt-0">
                                <div class="d-flex flex-column gap-2">
                                    <!-- Primary Actions -->
                                    <div class="d-flex gap-2">
                                        @if (!$periodeAktif->deleted_at)
                                            <button type="button" class="btn btn-sm btn-primary flex-grow-1 edit-periodeAktif"
                                                data-id="{{ $periodeAktif->id }}"
                                                data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit me-1"></i>
                                                Edit Periode
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success flex-grow-1" onclick="aktifkanPeriode({{ $periodeAktif->id }})">
                                                <i class="fas fa-sync-alt me-1"></i>
                                                Aktifkan Periode
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Secondary Actions -->
                                    <div class="d-flex gap-2">
                                        @if (!$periodeAktif->deleted_at)
                                            <!-- Tombol Nonaktifkan dihapus karena logika bisnisnya hanya satu periode aktif -->
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger flex-grow-1" onclick="hapusPermanen({{ $periodeAktif->id }})">
                                                <i class="fas fa-trash-alt me-1"></i>
                                                Hapus Permanen
                                            </button>
                                        @endif

                                        <button type="button" class="btn btn-sm btn-info flex-grow-1" data-bs-toggle="modal" data-bs-target="#aturJadwalModal" data-jadwal="login" data-periode-id="{{ $periodeAktif->id }}">
                                            <i class="fas fa-clock me-1"></i>
                                            Atur Jadwal
                                        </button>
                                    </div>
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
                                <h4 class="text-gray-800 mb-2">Belum ada data</h4>
                                <p class="text-gray-600">Data periode aktif akan muncul di sini setelah ditambahkan</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Modal Atur Jadwal -->
            <div class="modal fade" id="aturJadwalModal" tabindex="-1" aria-labelledby="aturJadwalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="jadwalForm" method="POST">
                        @csrf
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold" id="aturJadwalModalLabel">
                                    Atur Jadwal <span id="jadwalTitle" class="text-primary"></span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-0">
                                <div class="alert alert-danger error-message" style="display: none;"></div>

                                <input type="hidden" id="periodeId" name="periode_id" value="">
                                <input type="hidden" id="jadwalType" name="jadwal" value="">

                                <div class="mb-4">
                                    <label for="dateRange" class="form-label fw-semibold">Pilih Rentang Tanggal</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-lg" id="dateRange" name="tanggal" placeholder="Pilih tanggal mulai - tanggal selesai" readonly>
                                    </div>
                                    <div class="form-text">Pilih rentang tanggal untuk jadwal yang akan diatur</div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Jadwal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('layouts.partials._modal_periode_aktif')
        </div>
    </div>

        <!-- Clean CSS -->
    <style>
        /* Hero Header */
        .hero-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%) !important;
        }

        /* Stats Cards */
        .stat-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-icon {
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Search Section */
        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .bg-light-primary {
            background-color: #f8f9ff !important;
        }

        /* Card Enhancements */
        .hover-elevate-up {
            transition: all 0.3s ease;
        }

        .hover-elevate-up:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .periode-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .periode-card:nth-child(1) { animation-delay: 0.1s; }
        .periode-card:nth-child(2) { animation-delay: 0.2s; }
        .periode-card:nth-child(3) { animation-delay: 0.3s; }
        .periode-card:nth-child(4) { animation-delay: 0.4s; }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // Search functionality with debounce
        let searchTimeout;
        document.querySelector('[data-kt-periode-table-filter="search"]').addEventListener('keyup', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.periode-card');

                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.6s ease forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 300);
        });

        // Status filter with smooth transitions
        document.querySelector('[data-kt-periode-table-filter="status"]').addEventListener('change', function(e) {
            const status = e.target.value;
            const cards = document.querySelectorAll('.periode-card');

            cards.forEach((card, index) => {
                const cardStatus = card.dataset.status;
                if (status === '' || cardStatus === status) {
                    card.style.display = 'block';
                    card.style.animation = `fadeInUp 0.6s ease forwards ${index * 0.1}s`;
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Enhanced confirmation dialogs
        function nonaktifkanPeriode(id) {
            Swal.fire({
                title: 'Nonaktifkan Periode?',
                text: 'Periode akan dinonaktifkan dan tidak dapat digunakan untuk audit baru.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Nonaktifkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your nonaktifkan logic here
                    console.log('Nonaktifkan periode:', id);
                    Swal.fire('Berhasil!', 'Periode telah dinonaktifkan.', 'success');
                }
            });
        }

        function aktifkanPeriode(id) {
            Swal.fire({
                title: 'Aktifkan Periode?',
                text: 'Periode akan diaktifkan kembali dan periode aktif lainnya akan dinonaktifkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Aktifkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request ke backend
                    $.ajax({
                        url: `/periode-aktif/periodeAktif/${id}/restore`,
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: '✅ Berhasil!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let message = 'Terjadi kesalahan saat mengaktifkan periode.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: '❌ Gagal!',
                                text: message,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        function hapusPermanen(id) {
            Swal.fire({
                title: 'Hapus Permanen?',
                text: 'Tindakan ini tidak dapat dibatalkan. Semua data periode akan hilang selamanya.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your hapus permanen logic here
                    console.log('Hapus permanen periode:', id);
                    Swal.fire('Berhasil!', 'Periode telah dihapus permanen.', 'success');
                }
            });
        }

        // Add loading states to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.jadwal-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.opacity = '0.7';
                    this.style.pointerEvents = 'none';
                    setTimeout(() => {
                        this.style.opacity = '1';
                        this.style.pointerEvents = 'auto';
                    }, 1000);
                });
            });
        });
    </script>
@endsection
