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
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                    <div class="me-4">
                        <i class="fas fa-info-circle fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📢 Perhatian</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>Catatan:</strong>
                                <span class="fw-semibold text-primary">
                                    Silakan pilih prodi yang telah ditugaskan kepada Anda untuk dilakukan proses audit.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card mt-6 border border-gray-300">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Daftar Prodi yang Ditugaskan</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Silakan pilih untuk melanjutkan proses audit</span>
                        </h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-200px">Nama Prodi</th>
                                        <th class="min-w-150px">Tim Auditor</th>
                                        <th class="min-w-100px">Jenjang</th>
                                        <th class="min-w-150px">Status Audit</th>
                                        <th class="min-w-100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600">
                                    @forelse($auditess as $index => $auditee)
                                        <tr class="{{ $auditee->audit_status['status'] === 'new' ? 'table-primary' : '' }}">
                                            <td>
                                                <span class="badge badge-light-primary fw-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="fas fa-university fs-2 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-6">{{ $auditee->auditee->nama_unit_kerja }}</span>
                                                        <span class="text-muted fw-semibold fs-7">{{ $auditee->auditee->jenjang }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @forelse ($auditee->auditors as $auditor)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="symbol symbol-30px me-3">
                                                            <span class="symbol-label bg-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}">
                                                                <i class="fas fa-user-tie fs-2 text-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}"></i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                            <span class="badge badge-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-8 fw-bold">
                                                                {{ ucfirst(str_replace('_', ' ', $auditor->role)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <span class="text-muted fst-italic">Belum ditugaskan</span>
                                                @endforelse
                                            </td>
                                            <td>
                                                <span class="badge badge-light-info fw-bold">{{ $auditee->auditee->jenjang }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-35px me-3">
                                                        <span class="symbol-label bg-light-{{ $auditee->audit_status['color'] }}">
                                                            <i class="{{ $auditee->audit_status['icon'] }} fs-2 text-{{ $auditee->audit_status['color'] }}"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-dark fw-bold fs-7">{{ $auditee->audit_status['label'] }}</span>
                                                        <span class="text-muted fw-semibold fs-8">{{ $auditee->audit_status['description'] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('auditor.audit.perjanjianKinerja', $auditee->id) }}"
                                                   class="btn btn-sm btn-{{ $auditee->audit_status['status'] === 'new' ? 'primary' : 'light-primary' }}">
                                                    <i class="fas fa-arrow-right fs-2"></i>
                                                    Mulai Audit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-10">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fas fa-file-alt fs-3x text-muted mb-4"></i>
                                                    <span class="text-muted fw-semibold fs-6">Tidak ada prodi yang ditugaskan</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection

@push('styles')
<style>
    /* Custom styles for daftar auditee page */
    .table-primary {
        background-color: #e1f0ff !important;
    }

    .table-primary:hover {
        background-color: #d1e7ff !important;
    }

    .symbol.symbol-40px {
        width: 40px;
        height: 40px;
    }

    .symbol.symbol-35px {
        width: 35px;
        height: 35px;
    }

    .symbol.symbol-30px {
        width: 30px;
        height: 30px;
    }

    .badge.badge-light-primary {
        background-color: #e1f0ff;
        color: #009ef7;
    }

    .badge.badge-light-info {
        background-color: #e8f6ff;
        color: #0dcaf0;
    }

    .badge.badge-light-success {
        background-color: #e8fff3;
        color: #50cd89;
    }

    .badge.badge-light-warning {
        background-color: #fff8dd;
        color: #ffc700;
    }

    .badge.badge-light-danger {
        background-color: #ffe4e6;
        color: #f1416c;
    }

    .btn-light-primary {
        background-color: #e1f0ff;
        border-color: #e1f0ff;
        color: #009ef7;
    }

    .btn-light-primary:hover {
        background-color: #009ef7;
        border-color: #009ef7;
        color: #ffffff;
    }

    /* Status indicator animations */
    .symbol-label {
        transition: all 0.3s ease;
    }

    .table-primary .symbol-label {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>
@endpush
