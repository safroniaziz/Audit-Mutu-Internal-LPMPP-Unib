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
                    {{-- Indikator IKSS --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                                        <i class="fas fa-chart-line fa-xl"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Indikator IKSS</h6>
                                        <h3 class="mb-0 fw-bold">100</h3>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">Mengukur performa standar strategis institusi saat ini.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Program Studi --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                                        <i class="fas fa-graduation-cap fa-xl"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Program Studi Terdaftar</h6>
                                        <h3 class="mb-0 fw-bold">50</h3>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">Jumlah prodi aktif yang tersedia dalam database saat ini.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Fakultas --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-3">
                                        <i class="fas fa-university fa-xl"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Fakultas Terdaftar</h6>
                                        <h3 class="mb-0 fw-bold">10</h3>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">Total fakultas aktif yang tercatat dalam sistem akademik.</p>
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
