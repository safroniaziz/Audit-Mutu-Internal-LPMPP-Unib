@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10 shadow-sm" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer bg-light">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill me-1"></i> Selamat Datang, <span class="fw-bolder">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-center p-5 position-relative border border-info border-dashed bg-light-info rounded-3">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle p-3 me-4" style="width: 40px; height: 40px;">
                        <i class="bi bi-info-circle-fill fs-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bolder text-dark mb-3"><i class="bi bi-megaphone-fill me-2"></i>Proses Selanjutnya: Unduh Dokumen Audit</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mb-2">
                                <strong class="text-dark">Catatan:</strong>
                                <span class="fw-semibold text-primary">
                                    Silakan unduh dokumen hasil audit di bawah ini. Pastikan Anda telah memeriksa isi dokumen dan memastikan kesesuaiannya.
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                        $completionPercentage = $user->getProfileCompletionPercentage();
                    @endphp
                </div>

                <!--begin::Input group-->
                <div class="row mb-6 mt-6">
                    <div class="col-12">
                        <div class="card shadow border-0">
                            <div class="card-header bg-light border-0 pt-6 pb-4">
                                <h5 class="text-primary fw-bolder m-0">
                                    <i class="fas fa-file-download me-2"></i> Dokumen Unduhan Auditor
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-row-dashed fs-6 gy-4 mb-0">
                                        <thead>
                                            <tr class="fw-bold text-gray-800 bg-light border-bottom border-gray-300">
                                                <th class="ps-7 min-w-250px rounded-start">Nama Dokumen</th>
                                                <th class="text-end pe-7 min-w-125px rounded-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-7">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-alt text-primary me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Berita Acara</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-7">
                                                    <a href="{{ route('auditor.audit.beritaAcara') }}" class="btn btn-sm btn-primary btn-shadow px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-7">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-clipboard-check text-success me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-7">
                                                    <a href="{{ route('auditor.audit.evaluasiAmi') }}" class="btn btn-sm btn-primary btn-shadow px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-7">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-list-ul text-warning me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Daftar Pertanyaan</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-7">
                                                    <a href="{{ route('auditor.audit.daftarPertanyaan') }}" class="btn btn-sm btn-primary btn-shadow px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover-bg-light">
                                                <td class="ps-7">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-signature text-danger me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Laporan Audit Mutu Internal</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-7">
                                                    <a href="{{ route('auditor.audit.laporanAmi') }}" class="btn btn-sm btn-primary btn-shadow px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
