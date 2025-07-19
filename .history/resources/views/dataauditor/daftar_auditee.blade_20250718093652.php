@extends('dataauditor/dashboard_template')
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="fas fa-clipboard-list fs-2 text-primary me-2"></i>
                    Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <!--begin::Welcome Alert-->
                <div class="alert alert-primary d-flex align-items-center p-6 mb-8">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-light-primary">
                            <i class="fas fa-info-circle fs-2 text-primary"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1">
                        <h4 class="mb-1 text-primary fw-bold">Selamat Datang di Dashboard Auditor</h4>
                        <span class="fs-6 text-gray-700">
                            Berikut adalah daftar auditee yang telah ditugaskan kepada Anda untuk dilakukan proses audit.
                            Silakan pilih auditee yang ingin Anda audit terlebih dahulu.
                        </span>
                    </div>
                </div>
                <!--end::Welcome Alert-->

                <!--begin::Auditee List Card-->
                <div class="card shadow-sm border-0">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex flex-column">
                                <h3 class="fw-bold text-dark mb-2">
                                    <i class="fas fa-list-ul fs-2 text-primary me-3"></i>
                                    Daftar Auditee yang Ditugaskan
                                </h3>
                                <span class="text-muted fw-semibold fs-6">Pilih auditee untuk memulai proses audit</span>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-primary fs-7 fw-bold me-2">
                                    <i class="fas fa-clock me-1"></i>
                                    Total: {{ $auditess->count() }} Auditee
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-300px">Nama Auditee</th>
                                        <th class="min-w-250px">Tim Auditor</th>
                                        <th class="min-w-100px">Jenjang</th>
                                        <th class="min-w-200px">Status Audit</th>
                                        <th class="min-w-120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600">
                                    @forelse($auditess as $index => $auditee)
                                        <tr class="{{ $auditee->audit_status['status'] === 'new' ? 'table-primary' : '' }}">
                                            <td>
                                                <span class="badge badge-light-primary fw-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="symbol symbol-20px me-2 flex-shrink-0">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="fas fa-university fs-1 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column flex-grow-1 min-w-0">
                                                        <span class="text-dark fw-bold fs-6 text-break">{{ $auditee->auditee->nama_unit_kerja }}</span>
                                                        <span class="text-muted fw-semibold fs-7">{{ $auditee->auditee->jenjang }}</span>
                                                        @if($auditee->auditee->fakultas)
                                                            <span class="text-muted fw-semibold fs-8">{{ $auditee->auditee->fakultas }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @forelse ($auditee->auditors as $auditor)
                                                    <div class="d-flex align-items-start mb-2">
                                                        <div class="symbol symbol-16px me-2 flex-shrink-0">
                                                            <span class="symbol-label bg-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}">
                                                                <i class="fas fa-user-tie fs-0 text-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }}"></i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column flex-grow-1 min-w-0">
                                                            <span class="text-dark fw-bold fs-7 text-break">{{ $auditor->auditor->name }}</span>
                                                            <span class="badge badge-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-8 fw-bold">
                                                                {{ ucfirst(str_replace('_', ' ', $auditor->role)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-16px me-2 flex-shrink-0">
                                                            <span class="symbol-label bg-light-warning">
                                                                <i class="fas fa-user-slash fs-0 text-warning"></i>
                                                            </span>
                                                        </div>
                                                        <span class="text-muted fw-semibold fs-7">Belum ditugaskan</span>
                                                    </div>
                                                @endforelse
                                            </td>
                                            <td>
                                                <span class="badge badge-light-info fw-bold">{{ $auditee->auditee->jenjang }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="symbol symbol-20px me-2 flex-shrink-0">
                                                        <span class="symbol-label bg-light-{{ $auditee->audit_status['color'] }}">
                                                            <i class="{{ $auditee->audit_status['icon'] }} fs-0 text-{{ $auditee->audit_status['color'] }}"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column flex-grow-1 min-w-0">
                                                        <span class="text-dark fw-bold fs-7 text-break">{{ $auditee->audit_status['label'] }}</span>
                                                        <span class="text-muted fw-semibold fs-8">{{ $auditee->audit_status['description'] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('auditor.audit.perjanjianKinerja', $auditee->id) }}"
                                                   class="btn btn-sm btn-{{ $auditee->audit_status['status'] === 'new' ? 'primary' : 'light-primary' }} px-4">
                                                    <i class="fas fa-arrow-right fs-2 me-1"></i>
                                                    {{ $auditee->audit_status['status'] === 'new' ? 'Mulai Audit' : 'Lanjutkan' }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-12">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="symbol symbol-80px mb-4">
                                                        <span class="symbol-label bg-light-muted">
                                                            <i class="fas fa-clipboard-list fs-3x text-muted"></i>
                                                        </span>
                                                    </div>
                                                    <h4 class="text-muted fw-bold fs-5 mb-2">Belum Ada Penugasan</h4>
                                                    <span class="text-muted fw-semibold fs-6">Anda belum ditugaskan untuk mengaudit auditee manapun</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Auditee List Card-->

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

    .symbol.symbol-45px {
        width: 45px;
        height: 45px;
    }

    .symbol.symbol-40px {
        width: 40px;
        height: 40px;
    }

    .symbol.symbol-38px {
        width: 38px;
        height: 38px;
    }

    .symbol.symbol-32px {
        width: 32px;
        height: 32px;
    }

    .symbol.symbol-28px {
        width: 28px;
        height: 28px;
    }

    .symbol.symbol-24px {
        width: 24px;
        height: 24px;
    }

    .symbol.symbol-20px {
        width: 20px;
        height: 20px;
    }

    .symbol.symbol-16px {
        width: 16px;
        height: 16px;
    }

    .symbol.symbol-80px {
        width: 80px;
        height: 80px;
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

    /* Card improvements */
    .card.shadow-sm {
        border: none;
        box-shadow: 0 0.1rem 1rem 0.25rem rgba(0, 0, 0, 0.05) !important;
    }

    .alert-primary {
        background-color: #e1f0ff;
        border-color: #b3d9ff;
        color: #0c63e4;
    }

    /* Table improvements */
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    /* Table cell improvements */
    .table td {
        vertical-align: top;
        padding: 1rem 0.75rem;
        word-wrap: break-word;
    }

    .table th {
        padding: 1rem 0.75rem;
    }

    /* Ensure table doesn't break layout */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        table-layout: auto;
        width: 100%;
    }

    /* Text wrapping and overflow handling */
    .text-break {
        word-wrap: break-word;
        word-break: break-word;
    }

    .min-w-0 {
        min-width: 0;
    }

    .flex-shrink-0 {
        flex-shrink: 0;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .card-toolbar {
            flex-direction: column;
            gap: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .symbol.symbol-45px,
        .symbol.symbol-40px,
        .symbol.symbol-38px,
        .symbol.symbol-32px,
        .symbol.symbol-28px,
        .symbol.symbol-24px {
            width: 20px;
            height: 20px;
        }

        .table td,
        .table th {
            padding: 0.5rem 0.25rem;
        }
    }
</style>
@endpush
