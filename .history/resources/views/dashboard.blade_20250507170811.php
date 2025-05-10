@extends('layouts.dashboard.dashboard')
@section('menu')
    Halaman Dashboard
@endsection

@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="row g-4">
                    <!-- Card: Indikator IKSS -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100 bg-light">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="fw-semibold text-primary mb-1">Indikator IKSS</h5>
                                        <div class="text-muted small mb-3">
                                            Jumlah total indikator kualitas standar strategis saat ini.
                                        </div>
                                        <h2 class="fw-bold text-primary">100</h2>
                                        <div class="text-muted small mt-1">
                                            10 indikator baru ditambahkan minggu ini
                                        </div>
                                    </div>
                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-bullseye fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Program Studi -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100 bg-light">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="fw-semibold text-success mb-1">Program Studi Terdaftar</h5>
                                        <div class="text-muted small mb-3">
                                            Total prodi aktif di bawah fakultas yang terdaftar.
                                        </div>
                                        <h2 class="fw-bold text-success">50</h2>
                                        <div class="text-muted small mt-1">
                                            2 prodi baru disetujui bulan ini
                                        </div>
                                    </div>
                                    <div class="bg-success-subtle text-success rounded-circle p-3">
                                        <i class="fas fa-book-reader fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Fakultas -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100 bg-light">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="fw-semibold text-danger mb-1">Fakultas Terdaftar</h5>
                                        <div class="text-muted small mb-3">
                                            Jumlah total fakultas resmi yang tercatat di sistem.
                                        </div>
                                        <h2 class="fw-bold text-danger">10</h2>
                                        <div class="text-muted small mt-1">
                                            Terakhir diperbarui: 2 hari lalu
                                        </div>
                                    </div>
                                    <div class="bg-danger-subtle text-danger rounded-circle p-3">
                                        <i class="fas fa-building-columns fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Row-->
            <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
@endsection
