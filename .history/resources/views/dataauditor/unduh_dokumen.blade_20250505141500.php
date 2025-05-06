@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
                </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2"  class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📢 Proses Selanjutnya: Unduh Dokumen Audit</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>Catatan:</strong>
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
                <div class="row mb-6">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header border-0 pb-0">
                                <h5 class="text-primary fw-bold">📄 Dokumen Unduhan Auditor</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                                        <thead>
                                            <tr class="fw-bold text-gray-700 border-bottom">
                                                <th>Nama File</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Berita Acara</td>
                                                <td class="text-end">
                                                    <a href="{{ route('auditor.audit.beritaAcara') }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print me-1"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</td>
                                                <td class="text-end">
                                                    <a href="{{ route('auditor.audit.evaluasiAmi') }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print me-1"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Daftar Pertanyaan</td>
                                                <td class="text-end">
                                                    <a href="{{ route('auditor.audit.daftarPertanyaan') }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print me-1"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Laporan Audit Mutu Internal</td>
                                                <td class="text-end">
                                                    <a href="{{ route('auditor.audit.laporanAmi') }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print me-1"></i> Cetak
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
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
