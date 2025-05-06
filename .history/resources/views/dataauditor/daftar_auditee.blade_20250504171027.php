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
                    <div class="card mt-6 shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Daftar Auditee yang Ditugaskan</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Silakan pilih untuk melanjutkan proses audit</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th>No</th>
                                            <th>Nama Auditee</th>
                                            <th>Auditor</th>
                                            <th>Jadwal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600">
                                        @forelse($auditess as $index => $auditee)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $auditee->auditee->name }}</td>
                                                <td>{{ $auditee->fakultas }}</td>
                                                <td>{{ $auditee->jenjang }}</td>
                                                <td>
                                                    <a href="{{ route('auditor.audit.detail', $auditee->id) }}" class="btn btn-sm btn-primary">
                                                        Audit Sekarang
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada auditee yang ditugaskan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
