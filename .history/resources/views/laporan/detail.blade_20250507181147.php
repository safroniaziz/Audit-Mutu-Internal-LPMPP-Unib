@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Penugasan Auditor
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Penugasan Auditor</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-5 mt-5">
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Nilai Satuan Standar</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <canvas id="kt_radar_chart" style="height: 350px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100 border-0 bg-white">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Detail Nilai Standar</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-120px">Standar</th>
                                        <th class="min-w-100px">Nilai</th>
                                        <th class="min-w-100px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.1</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.2</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.2</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.3</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 1.3</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">2.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Baik</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.1</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">0.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-danger">Kurang</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.2</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">2.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Baik</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark fw-semibold text-hover-primary">SS 2.3</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold">1.0</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Cukup</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="w-100 mb-2">
                        <div class="alert alert-danger d-flex align-items-center p-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <i class="ki-duotone ki-shield-tick fs-2 text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Informasi</h4>
                                <span>Daftar berikut menampilkan auditee yang telah diaudit oleh auditor. Klik "Detail" untuk melihat informasi lebih lanjut.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-penugasanAuditor-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Penugasan Auditor" />
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_penugasanAuditor_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="min-w-50px ps-4">No</th>
                                <th class="min-w-125px">Nama Auditee</th>
                                <th class="min-w-125px">Jenjang</th>
                                <th class="min-w-125px">Fakultas</th>
                                <th class="min-w-175px">Auditor</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @push('name')

    @endpush
@endpush
