@extends('dataauditor/dashboard_template')

@section('menuPenilaianInstrumenProdi')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.penilaianInstrumenProdi') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i> Penilaian Instrumen Prodi
                </a>
            </li>
        @endif
    @endforeach
@endsection

@section('menuUnduhDokumen')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.unduhDokumen') ? 'active' : '' }}">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection

@section('dashboardProfile')
    <!--begin::Error Card-->
    <div class="card mb-5 mb-xl-8">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-50px me-5">
                    <span class="symbol-label bg-light-warning text-warning fs-1">
                        <i class="fas fa-clock"></i>
                    </span>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center">
                        <span class="text-gray-800 fw-bold fs-4 me-2">Jadwal Visitasi</span>
                    </div>
                    <span class="text-muted fw-semibold">Validasi Waktu Visitasi</span>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Error Alert-->
    <div class="alert alert-warning d-flex align-items-center p-6 mb-8">
        <div class="symbol symbol-40px me-4">
            <span class="symbol-label bg-light-warning">
                <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
            </span>
        </div>
        <div class="d-flex flex-column flex-grow-1">
            <h4 class="mb-1 text-warning fw-bold">Tidak Dapat Mengakses Visitasi</h4>
            <span class="fs-6 text-gray-700">{{ $error['message'] }}</span>
        </div>
    </div>

    <!--begin::Schedule Information Card-->
    <div class="card shadow-sm border-0">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex flex-column">
                    <h3 class="fw-bold text-dark mb-2">
                        <i class="fas fa-calendar-alt fs-2 text-primary me-3"></i>
                        Informasi Jadwal Visitasi
                    </h3>
                    <span class="text-muted fw-semibold fs-6">Detail waktu yang dijadwalkan untuk visitasi</span>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-4 bg-light-primary rounded">
                        <div class="symbol symbol-40px me-4">
                            <span class="symbol-label bg-primary">
                                <i class="fas fa-calendar-check fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-muted fw-semibold fs-7">Jadwal Utama</span>
                            <span class="text-dark fw-bold fs-6">{{ $error['scheduled_time'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-4 bg-light-info rounded">
                        <div class="symbol symbol-40px me-4">
                            <span class="symbol-label bg-info">
                                <i class="fas fa-clock fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-muted fw-semibold fs-7">Rentang Waktu (±2 jam)</span>
                            <span class="text-dark fw-bold fs-6">{{ $error['start_time'] }} - {{ $error['end_time'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($error['type'] === 'too_late')
                <div class="mt-6 p-4 bg-light-danger rounded">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40px me-4">
                            <span class="symbol-label bg-danger">
                                <i class="fas fa-phone fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="text-danger fw-bold mb-2">Hubungi Admin</h5>
                            <p class="text-gray-700 mb-3">
                                Waktu visitasi telah berakhir. Silakan hubungi administrator untuk memperpanjang jadwal visitasi atau mengatur ulang waktu yang sesuai.
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('auditor.dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali ke Dashboard
                                </a>
                                <a href="mailto:admin@example.com" class="btn btn-danger">
                                    <i class="fas fa-envelope me-2"></i>
                                    Email Admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($error['type'] === 'too_early')
                <div class="mt-6 p-4 bg-light-info rounded">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40px me-4">
                            <span class="symbol-label bg-info">
                                <i class="fas fa-info-circle fs-2 text-white"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="text-info fw-bold mb-2">Menunggu Jadwal</h5>
                            <p class="text-gray-700 mb-3">
                                Visitasi belum dapat dilakukan karena belum masuk dalam rentang waktu yang dijadwalkan. Silakan kembali pada waktu yang telah ditentukan.
                            </p>
                            <a href="{{ route('auditor.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
