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

            <!-- Header Section -->
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mb-8">
                <div class="d-flex flex-column">
                    <h1 class="fw-bold text-dark fs-2 mb-2">Manajemen Periode Aktif</h1>
                    <p class="text-gray-600 fs-6">Kelola periode audit mutu internal dengan mudah dan efisien</p>
                </div>
                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#kt_modal">
                        <i class="fas fa-plus fs-5"></i>
                        <span>Tambah Periode Baru</span>
                    </button>
                </div>
            </div>

            <!-- Alert Section -->
            <div class="alert alert-warning d-flex align-items-center p-6 mb-8 border-0 shadow-sm">
                <div class="symbol symbol-40px me-4">
                    <i class="ki-duotone ki-shield-tick fs-2 text-warning">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-warning fw-bold">Perhatian Penting!</h4>
                    <span class="fs-6">Sebelum menghapus periode aktif, pastikan periode tersebut telah dinonaktifkan terlebih dahulu untuk menghindari gangguan pada proses audit yang sedang berlangsung.</span>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="card card-flush border-0 shadow-sm mb-8">
                <div class="card-body p-6">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center position-relative">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4 text-gray-500">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-periode-table-filter="search" class="form-control form-control-lg ps-12" placeholder="Cari periode aktif berdasarkan nomor surat, siklus, atau tahun..." />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-3 justify-content-lg-end">
                                <select class="form-select form-select-lg" data-kt-periode-table-filter="status">
                                    <option value="">Semua Status</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Periode Cards -->
            <div class="row g-6" id="periode-cards-container">
                @forelse ($periodeAktifs as $index => $periodeAktif)
                    <div class="col-12 periode-card" data-status="{{ $periodeAktif->deleted_at ? 'inactive' : 'active' }}">
                        <div class="card card-flush border-0 shadow-sm h-100 {{ $periodeAktif->deleted_at ? 'border-start border-4 border-danger' : 'border-start border-4 border-success' }}">
                            <div class="card-body p-8">
                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-start mb-6">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="symbol symbol-60px symbol-circle bg-light-primary">
                                            <i class="ki-duotone ki-calendar fs-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <h3 class="fw-bold text-dark fs-3 mb-1">{{ $periodeAktif->nomor_surat }}</h3>
                                            <p class="text-gray-600 fs-6 mb-0">Siklus {{ $periodeAktif->siklus }} - {{ $periodeAktif->tahun_ami }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        @if ($periodeAktif->deleted_at)
                                            <span class="badge badge-danger fs-7 fw-bold px-4 py-2 mb-2">
                                                <i class="fas fa-times-circle me-2"></i>Tidak Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-success fs-7 fw-bold px-4 py-2 mb-2">
                                                <i class="fas fa-check-circle me-2"></i>Aktif
                                            </span>
                                        @endif
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light-secondary" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if (!$periodeAktif->deleted_at)
                                                    <li>
                                                        <a class="dropdown-item edit-periodeAktif" href="#"
                                                           data-id="{{ $periodeAktif->id }}"
                                                           data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                           data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                            <i class="fas fa-edit me-2"></i>Edit Periode
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" onclick="nonaktifkanPeriode({{ $periodeAktif->id }})">
                                                            <i class="fas fa-ban me-2"></i>Nonaktifkan
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item text-success" href="#" onclick="aktifkanPeriode({{ $periodeAktif->id }})">
                                                            <i class="fas fa-sync-alt me-2"></i>Aktifkan
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" onclick="hapusPermanen({{ $periodeAktif->id }})">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus Permanen
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jadwal Section -->
                                <div class="row g-4">
                                    <!-- Login Jadwal -->
                                    <div class="col-lg-4">
                                        <div class="card card-flush border border-gray-300 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px symbol-circle bg-light-info me-3">
                                                        <i class="ki-duotone ki-user-tick fs-2 text-info">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">Login Auditee & Auditor</h6>
                                                        <p class="text-gray-600 fs-7 mb-0">Jadwal akses sistem</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $loginJadwal = $periodeAktif->jadwal->where('jenis', 'login')->first();
                                                @endphp
                                                @if($loginJadwal)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-check text-success me-2"></i>
                                                        <span class="text-success fw-semibold fs-7">
                                                            {{ \Carbon\Carbon::parse($loginJadwal->waktu_mulai)->translatedFormat('d F Y') }} -
                                                            {{ \Carbon\Carbon::parse($loginJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                        </span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="login"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-edit me-2"></i>Ubah Jadwal
                                                    </button>
                                                @else
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-times text-muted me-2"></i>
                                                        <span class="text-muted fs-7">Belum diatur</span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="login"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-plus me-2"></i>Atur Jadwal
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Audit Jadwal -->
                                    <div class="col-lg-4">
                                        <div class="card card-flush border border-gray-300 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px symbol-circle bg-light-warning me-3">
                                                        <i class="ki-duotone ki-shield-tick fs-2 text-warning">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">Audit oleh Auditor</h6>
                                                        <p class="text-gray-600 fs-7 mb-0">Jadwal pelaksanaan audit</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $auditJadwal = $periodeAktif->jadwal->where('jenis', 'audit')->first();
                                                @endphp
                                                @if($auditJadwal)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-check text-success me-2"></i>
                                                        <span class="text-success fw-semibold fs-7">
                                                            {{ \Carbon\Carbon::parse($auditJadwal->waktu_mulai)->translatedFormat('d F Y') }} -
                                                            {{ \Carbon\Carbon::parse($auditJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                        </span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="audit"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-edit me-2"></i>Ubah Jadwal
                                                    </button>
                                                @else
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-times text-muted me-2"></i>
                                                        <span class="text-muted fs-7">Belum diatur</span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="audit"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-plus me-2"></i>Atur Jadwal
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Jadwal -->
                                    <div class="col-lg-4">
                                        <div class="card card-flush border border-gray-300 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px symbol-circle bg-light-success me-3">
                                                        <i class="ki-duotone ki-document fs-2 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">Pengisian Data Auditee</h6>
                                                        <p class="text-gray-600 fs-7 mb-0">Jadwal input data</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $dataJadwal = $periodeAktif->jadwal->where('jenis', 'data')->first();
                                                @endphp
                                                @if($dataJadwal)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-check text-success me-2"></i>
                                                        <span class="text-success fw-semibold fs-7">
                                                            {{ \Carbon\Carbon::parse($dataJadwal->waktu_mulai)->translatedFormat('d F Y') }} -
                                                            {{ \Carbon\Carbon::parse($dataJadwal->waktu_selesai)->translatedFormat('d F Y') }}
                                                        </span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="data"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-edit me-2"></i>Ubah Jadwal
                                                    </button>
                                                @else
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-calendar-times text-muted me-2"></i>
                                                        <span class="text-muted fs-7">Belum diatur</span>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#aturJadwalModal"
                                                        data-jadwal="data"
                                                        data-periode-id="{{ $periodeAktif->id }}">
                                                        <i class="fas fa-plus me-2"></i>Atur Jadwal
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="d-flex justify-content-between align-items-center mt-6 pt-4 border-top">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-clock text-gray-500"></i>
                                            <span class="text-gray-600 fs-7">Dibuat: {{ $periodeAktif->created_at->translatedFormat('d F Y H:i') }}</span>
                                        </div>
                                        @if($periodeAktif->updated_at != $periodeAktif->created_at)
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-edit text-gray-500"></i>
                                                <span class="text-gray-600 fs-7">Diupdate: {{ $periodeAktif->updated_at->translatedFormat('d F Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-2">
                                        @if (!$periodeAktif->deleted_at)
                                            <button type="button" class="btn btn-sm btn-light-primary edit-periodeAktif"
                                                data-id="{{ $periodeAktif->id }}"
                                                data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-light-success" onclick="aktifkanPeriode({{ $periodeAktif->id }})">
                                                <i class="fas fa-sync-alt me-2"></i>Aktifkan
                                            </button>
                                            <button type="button" class="btn btn-sm btn-light-danger" onclick="hapusPermanen({{ $periodeAktif->id }})">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card card-flush border-0 shadow-sm">
                            <div class="card-body p-12 text-center">
                                <div class="symbol symbol-100px symbol-circle bg-light-gray-300 mb-6">
                                    <i class="ki-duotone ki-calendar fs-1 text-gray-500">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <h3 class="fw-bold text-gray-600 mb-2">Belum Ada Periode Aktif</h3>
                                <p class="text-gray-500 fs-6 mb-6">Mulai dengan menambahkan periode aktif pertama untuk mengelola audit mutu internal.</p>
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                    <i class="fas fa-plus me-2"></i>Tambah Periode Pertama
                                </button>
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
                        <div class="modal-content border-0 shadow">
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

    <!-- Custom CSS -->
    <style>
        .periode-card {
            transition: all 0.3s ease;
        }

        .periode-card:hover {
            transform: translateY(-2px);
        }

        .card-flush {
            transition: all 0.3s ease;
        }

        .card-flush:hover {
            box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075) !important;
        }

        .symbol-circle {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-outline-primary:hover,
        .btn-outline-success:hover {
            transform: translateY(-1px);
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 0.75rem;
        }

        .form-control-lg {
            height: 3.5rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    </style>

    <!-- Custom JavaScript -->
    <script>
        // Search functionality
        document.querySelector('[data-kt-periode-table-filter="search"]').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.periode-card');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Status filter
        document.querySelector('[data-kt-periode-table-filter="status"]').addEventListener('change', function(e) {
            const status = e.target.value;
            const cards = document.querySelectorAll('.periode-card');

            cards.forEach(card => {
                const cardStatus = card.dataset.status;
                if (status === '' || cardStatus === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Nonaktifkan periode
        function nonaktifkanPeriode(id) {
            if (confirm('Apakah Anda yakin ingin menonaktifkan periode ini?')) {
                // Add your nonaktifkan logic here
                console.log('Nonaktifkan periode:', id);
            }
        }

        // Aktifkan periode
        function aktifkanPeriode(id) {
            if (confirm('Apakah Anda yakin ingin mengaktifkan periode ini?')) {
                // Add your aktifkan logic here
                console.log('Aktifkan periode:', id);
            }
        }

        // Hapus permanen
        function hapusPermanen(id) {
            if (confirm('Apakah Anda yakin ingin menghapus periode ini secara permanen? Tindakan ini tidak dapat dibatalkan.')) {
                // Add your hapus permanen logic here
                console.log('Hapus permanen periode:', id);
            }
        }
    </script>
@endsection
