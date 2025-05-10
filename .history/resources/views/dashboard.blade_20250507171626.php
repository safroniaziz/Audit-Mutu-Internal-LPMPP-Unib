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
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">100</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Total Indikator IKSS</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-primary fs-8 fw-bold">Strategis</span>
                                        <span>
                                            <i class="fas fa-chart-line fs-3 text-primary me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-primary rounded">
                                        <div class="bg-primary rounded h-8px" role="progressbar" style="width: 78%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2">Mengukur performa standar strategis institusi saat ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Program Studi --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">50</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Program Studi Terdaftar</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-success fs-8 fw-bold">Akademik</span>
                                        <span>
                                            <i class="fas fa-graduation-cap fs-3 text-success me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                        <div class="bg-success rounded h-8px" role="progressbar" style="width: 65%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2">Jumlah prodi aktif yang tersedia dalam database saat ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Fakultas --}}
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-flush border-0 h-100 shadow-lg hover-elevate-up">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-dark me-2">10</span>
                                    <span class="text-gray-600 fw-semibold fs-6">Fakultas Terdaftar</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-gray-600 w-100 mt-auto mb-2">
                                        <span class="badge badge-light-warning fs-8 fw-bold">Struktur</span>
                                        <span>
                                            <i class="fas fa-university fs-3 text-warning me-1"></i>
                                        </span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                        <div class="bg-warning rounded h-8px" role="progressbar" style="width: 90%"></div>
                                    </div>
                                    <span class="text-gray-600 fw-semibold fs-7 mt-2" style="text-align: left !important;">Total fakultas aktif yang tercatat dalam sistem akademik</span>
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
