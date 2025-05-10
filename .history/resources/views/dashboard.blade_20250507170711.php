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
                    <!-- Card 1 -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h6 class="text-muted mb-1">Jumlah Indikator IKSS</h6>
                                        <h3 class="fw-bold mb-0 text-primary">100</h3>
                                    </div>
                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-chart-line fa-lg"></i>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h6 class="text-muted mb-1">Jumlah Program Studi Terdaftar</h6>
                                        <h3 class="fw-bold mb-0 text-success">50</h3>
                                    </div>
                                    <div class="bg-success-subtle text-success rounded-circle p-3">
                                        <i class="fas fa-graduation-cap fa-lg"></i>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-sm-6 col-xl-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h6 class="text-muted mb-1">Jumlah Fakultas Terdaftar</h6>
                                        <h3 class="fw-bold mb-0 text-danger">10</h3>
                                    </div>
                                    <div class="bg-danger-subtle text-danger rounded-circle p-3">
                                        <i class="fas fa-university fa-lg"></i>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-danger">Lihat Detail</a>
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
