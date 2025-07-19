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
            <div class="row g-6" id="periode-cards-container">
                @forelse ($periodeAktifs as $index => $periodeAktif)
                    <div class="col-12 periode-card" data-status="{{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                        <div class="premium-card {{ $periodeAktif->deleted_at ? 'inactive-card' : 'active-card' }}">
                            <!-- Card Header -->
                            <div class="card-header-section">
                                <div class="header-content">
                                    <div class="periode-info">
                                        <div class="periode-icon">
                                            <div class="icon-wrapper {{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                                                <i class="ki-duotone ki-calendar fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="periode-details">
                                            <h3 class="periode-title">{{ $periodeAktif->nomor_surat }}</h3>
                                            <p class="periode-subtitle">Siklus {{ $periodeAktif->siklus }} - {{ $periodeAktif->tahun_ami }}</p>
                                            <div class="periode-meta">
                                                <span class="meta-item">
                                                    <i class="fas fa-calendar-plus"></i>
                                                    Dibuat: {{ $periodeAktif->created_at ? $periodeAktif->created_at->translatedFormat('d F Y') : 'N/A' }}
                                                </span>
                                                @if($periodeAktif->updated_at != $periodeAktif->created_at)
                                                    <span class="meta-item">
                                                        <i class="fas fa-edit"></i>
                                                        Diupdate: {{ $periodeAktif->updated_at ? $periodeAktif->updated_at->translatedFormat('d F Y') : 'N/A' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-actions">
                                        <div class="status-badge {{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                                            @if ($periodeAktif->deleted_at)
                                                <i class="fas fa-times-circle"></i>
                                                <span>Tidak Aktif</span>
                                            @else
                                                <i class="fas fa-check-circle"></i>
                                                <span>Aktif</span>
                                            @endif
                                        </div>
                                        <div class="action-dropdown">
                                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if (!$periodeAktif->deleted_at)
                                                    <li>
                                                        <a class="dropdown-item edit-periodeAktif" href="#"
                                                           data-id="{{ $periodeAktif->id }}"
                                                           data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                           data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                            <i class="fas fa-edit"></i>
                                                            <span>Edit Periode</span>
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" onclick="nonaktifkanPeriode({{ $periodeAktif->id }})">
                                                            <i class="fas fa-ban"></i>
                                                            <span>Nonaktifkan</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item text-success" href="#" onclick="aktifkanPeriode({{ $periodeAktif->id }})">
                                                            <i class="fas fa-sync-alt"></i>
                                                            <span>Aktifkan</span>
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" onclick="hapusPermanen({{ $periodeAktif->id }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Hapus Permanen</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Jadwal Section -->
                            <div class="jadwal-section">
                                <div class="jadwal-grid">
                                    <!-- Login Jadwal -->
                                    <div class="jadwal-card login-jadwal">
                                        <div class="jadwal-header">
                                            <div class="jadwal-icon">
                                                <i class="ki-duotone ki-user-tick"></i>
                                            </div>
                                            <div class="jadwal-info">
                                                <h6>Login Auditee & Auditor</h6>
                                                <p>Jadwal akses sistem</p>
                                            </div>
                                        </div>
                                        @php
                                            $loginJadwal = $periodeAktif->jadwal->where('jenis', 'login')->first();
                                        @endphp
                                        @if($loginJadwal)
                                            <div class="jadwal-status active">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-check"></i>
                                                    <span>{{ $loginJadwal->waktu_mulai ? \Carbon\Carbon::parse($loginJadwal->waktu_mulai)->translatedFormat('d F Y') : 'N/A' }} - {{ $loginJadwal->waktu_selesai ? \Carbon\Carbon::parse($loginJadwal->waktu_selesai)->translatedFormat('d F Y') : 'N/A' }}</span>
                                                </div>
                                                <button type="button" class="jadwal-btn edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="login"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Ubah Jadwal</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="jadwal-status inactive">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-times"></i>
                                                    <span>Belum diatur</span>
                                                </div>
                                                <button type="button" class="jadwal-btn add"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="login"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Atur Jadwal</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Audit Jadwal -->
                                    <div class="jadwal-card audit-jadwal">
                                        <div class="jadwal-header">
                                            <div class="jadwal-icon">
                                                <i class="ki-duotone ki-shield-tick"></i>
                                            </div>
                                            <div class="jadwal-info">
                                                <h6>Audit oleh Auditor</h6>
                                                <p>Jadwal pelaksanaan audit</p>
                                            </div>
                                        </div>
                                        @php
                                            $auditJadwal = $periodeAktif->jadwal->where('jenis', 'audit')->first();
                                        @endphp
                                        @if($auditJadwal)
                                            <div class="jadwal-status active">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-check"></i>
                                                    <span>{{ $auditJadwal->waktu_mulai ? \Carbon\Carbon::parse($auditJadwal->waktu_mulai)->translatedFormat('d F Y') : 'N/A' }} - {{ $auditJadwal->waktu_selesai ? \Carbon\Carbon::parse($auditJadwal->waktu_selesai)->translatedFormat('d F Y') : 'N/A' }}</span>
                                                </div>
                                                <button type="button" class="jadwal-btn edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="audit"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Ubah Jadwal</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="jadwal-status inactive">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-times"></i>
                                                    <span>Belum diatur</span>
                                                </div>
                                                <button type="button" class="jadwal-btn add"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="audit"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Atur Jadwal</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Data Jadwal -->
                                    <div class="jadwal-card data-jadwal">
                                        <div class="jadwal-header">
                                            <div class="jadwal-icon">
                                                <i class="ki-duotone ki-document"></i>
                                            </div>
                                            <div class="jadwal-info">
                                                <h6>Pengisian Data Auditee</h6>
                                                <p>Jadwal input data</p>
                                            </div>
                                        </div>
                                        @php
                                            $dataJadwal = $periodeAktif->jadwal->where('jenis', 'data')->first();
                                        @endphp
                                        @if($dataJadwal)
                                            <div class="jadwal-status active">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-check"></i>
                                                    <span>{{ $dataJadwal->waktu_mulai ? \Carbon\Carbon::parse($dataJadwal->waktu_mulai)->translatedFormat('d F Y') : 'N/A' }} - {{ $dataJadwal->waktu_selesai ? \Carbon\Carbon::parse($dataJadwal->waktu_selesai)->translatedFormat('d F Y') : 'N/A' }}</span>
                                                </div>
                                                <button type="button" class="jadwal-btn edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="data"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Ubah Jadwal</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="jadwal-status inactive">
                                                <div class="status-indicator">
                                                    <i class="fas fa-calendar-times"></i>
                                                    <span>Belum diatur</span>
                                                </div>
                                                <button type="button" class="jadwal-btn add"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#aturJadwalModal"
                                                    data-jadwal="data"
                                                    data-periode-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Atur Jadwal</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="ki-duotone ki-calendar fs-1 display-1 text-muted">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <h3 class="empty-title">Belum Ada Periode Aktif</h3>
                            <p class="empty-description">Mulai dengan menambahkan periode aktif pertama untuk mengelola audit mutu internal.</p>
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                <i class="fas fa-plus me-2"></i>Tambah Periode Pertama
                            </button>
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

    <!-- Premium CSS -->
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

        /* Premium Cards */
        .premium-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .premium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .premium-card:hover::before {
            opacity: 1;
        }

        .active-card {
            border-left: 4px solid #28a745;
        }

        .inactive-card {
            border-left: 4px solid #dc3545;
            opacity: 0.8;
        }

        /* Card Header */
        .card-header-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f4fd 100%);
            padding: 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
        }

        .periode-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .periode-icon {
            flex-shrink: 0;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .icon-wrapper.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .icon-wrapper.inactive {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
        }

        .icon-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .icon-wrapper:hover::before {
            transform: translateX(100%);
        }

        .periode-details {
            flex: 1;
        }

        .periode-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 0.5rem 0;
            line-height: 1.2;
        }

        .periode-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin: 0 0 1rem 0;
            font-weight: 500;
        }

        .periode-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
            background: rgba(255, 255, 255, 0.7);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1rem;
        }

        .status-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .status-badge.inactive {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .action-dropdown {
            position: relative;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .dropdown-toggle:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #495057;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        /* Jadwal Section */
        .jadwal-section {
            padding: 2rem;
        }

        .jadwal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .jadwal-card {
            background: #ffffff;
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .jadwal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .jadwal-card:hover::before {
            transform: scaleX(1);
        }

        .jadwal-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .jadwal-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .jadwal-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .login-jadwal .jadwal-icon {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .audit-jadwal .jadwal-icon {
            background: linear-gradient(135deg, #fa709a, #fee140);
        }

        .data-jadwal .jadwal-icon {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .jadwal-info h6 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 0.25rem 0;
        }

        .jadwal-info p {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
        }

        .jadwal-status {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 500;
        }

        .jadwal-status.active .status-indicator {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .jadwal-status.inactive .status-indicator {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .jadwal-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .jadwal-btn.edit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .jadwal-btn.add {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .jadwal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            margin-bottom: 2rem;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .empty-description {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .periode-info {
                flex-direction: column;
                align-items: flex-start;
                text-align: center;
            }

            .jadwal-grid {
                grid-template-columns: 1fr;
            }

            .periode-meta {
                flex-direction: column;
            }
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

        /* Button Enhancements */
        .btn-icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form Enhancements */
        .form-control-lg {
            height: 3.5rem;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control-lg:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-select-lg {
            height: 3.5rem;
            border-radius: 12px;
            border: 2px solid #e9ecef;
        }
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
                text: 'Periode akan diaktifkan kembali dan dapat digunakan untuk audit.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Aktifkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your aktifkan logic here
                    console.log('Aktifkan periode:', id);
                    Swal.fire('Berhasil!', 'Periode telah diaktifkan.', 'success');
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
