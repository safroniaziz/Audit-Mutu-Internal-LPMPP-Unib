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
                        <div class="elegant-card {{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                            <!-- Card Background Pattern -->
                            <div class="card-pattern"></div>

                            <!-- Card Content -->
                            <div class="card-content">
                                <!-- Header Section -->
                                <div class="card-header-elegant">
                                    <div class="header-main">
                                        <div class="status-indicator">
                                            <div class="status-dot {{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}"></div>
                                            <span class="status-text">{{ $periodeAktif->deleted_at ? 'Tidak Aktif' : 'Aktif' }}</span>
                                        </div>
                                        <div class="header-icon">
                                            <div class="icon-circle {{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                                                <i class="ki-duotone ki-calendar">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-info">
                                        <h3 class="periode-number">{{ $periodeAktif->nomor_surat }}</h3>
                                        <p class="periode-cycle">Siklus {{ $periodeAktif->siklus }} • {{ $periodeAktif->tahun_ami }}</p>
                                    </div>
                                </div>

                                <!-- Stats Section -->
                                <div class="stats-section">
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-label">Tahun AMI</span>
                                            <span class="stat-value">{{ $periodeAktif->tahun_ami }}</span>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="fas fa-sync-alt"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-label">Siklus</span>
                                            <span class="stat-value">{{ $periodeAktif->siklus }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule Overview -->
                                <div class="schedule-overview">
                                    <div class="schedule-header">
                                        <h4>Jadwal Teratur</h4>
                                        <div class="schedule-progress">
                                            @php
                                                $totalJadwal = 3;
                                                $jadwalTeratur = 0;
                                                $loginJadwal = $periodeAktif->jadwal->where('jenis', 'login')->first();
                                                $auditJadwal = $periodeAktif->jadwal->where('jenis', 'audit')->first();
                                                $dataJadwal = $periodeAktif->jadwal->where('jenis', 'data')->first();
                                                if($loginJadwal) $jadwalTeratur++;
                                                if($auditJadwal) $jadwalTeratur++;
                                                if($dataJadwal) $jadwalTeratur++;
                                            @endphp
                                            <span class="progress-text">{{ $jadwalTeratur }}/{{ $totalJadwal }}</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ ($jadwalTeratur/$totalJadwal)*100 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="schedule-items">
                                        <div class="schedule-item {{ $loginJadwal ? 'completed' : 'pending' }}">
                                            <div class="schedule-icon">
                                                <i class="fas fa-user-tick"></i>
                                            </div>
                                            <div class="schedule-info">
                                                <span class="schedule-name">Login</span>
                                                <span class="schedule-status">{{ $loginJadwal ? 'Teratur' : 'Belum Diatur' }}</span>
                                            </div>
                                            <div class="schedule-check">
                                                <i class="fas {{ $loginJadwal ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                            </div>
                                        </div>
                                        <div class="schedule-item {{ $auditJadwal ? 'completed' : 'pending' }}">
                                            <div class="schedule-icon">
                                                <i class="fas fa-shield-tick"></i>
                                            </div>
                                            <div class="schedule-info">
                                                <span class="schedule-name">Audit</span>
                                                <span class="schedule-status">{{ $auditJadwal ? 'Teratur' : 'Belum Diatur' }}</span>
                                            </div>
                                            <div class="schedule-check">
                                                <i class="fas {{ $auditJadwal ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                            </div>
                                        </div>
                                        <div class="schedule-item {{ $dataJadwal ? 'completed' : 'pending' }}">
                                            <div class="schedule-icon">
                                                <i class="fas fa-document"></i>
                                            </div>
                                            <div class="schedule-info">
                                                <span class="schedule-name">Data</span>
                                                <span class="schedule-status">{{ $dataJadwal ? 'Teratur' : 'Belum Diatur' }}</span>
                                            </div>
                                            <div class="schedule-check">
                                                <i class="fas {{ $dataJadwal ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Section -->
                                <div class="action-section">
                                    <div class="action-buttons">
                                        @if (!$periodeAktif->deleted_at)
                                            <button type="button" class="btn-elegant primary edit-periodeAktif"
                                                data-id="{{ $periodeAktif->id }}"
                                                data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </button>
                                        @else
                                            <button type="button" class="btn-elegant success" onclick="aktifkanPeriode({{ $periodeAktif->id }})">
                                                <i class="fas fa-sync-alt"></i>
                                                <span>Aktifkan</span>
                                            </button>
                                        @endif
                                        <div class="action-dropdown">
                                            <button class="btn-elegant secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu elegant-dropdown">
                                                @if (!$periodeAktif->deleted_at)
                                                    <li>
                                                        <a class="dropdown-item" href="#" onclick="nonaktifkanPeriode({{ $periodeAktif->id }})">
                                                            <i class="fas fa-ban"></i>
                                                            <span>Nonaktifkan</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" onclick="hapusPermanen({{ $periodeAktif->id }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Hapus Permanen</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aturJadwalModal" data-jadwal="login" data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-clock"></i>
                                                        <span>Atur Jadwal</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="meta-info">
                                        <span class="meta-item">
                                            <i class="fas fa-calendar-plus"></i>
                                            {{ $periodeAktif->created_at ? $periodeAktif->created_at->translatedFormat('d M Y') : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state-elegant">
                            <div class="empty-icon">
                                <i class="ki-duotone ki-calendar">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <h3>Belum Ada Periode Aktif</h3>
                            <p>Mulai dengan menambahkan periode aktif pertama untuk mengelola audit mutu internal.</p>
                            <button type="button" class="btn-elegant primary" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Periode Pertama</span>
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
