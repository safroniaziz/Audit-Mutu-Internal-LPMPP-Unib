@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Add these styles to your CSS file */
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        /* Style for the already submitted notice */
        .notice {
            border-left: 4px solid #FFA800 !important;
        }

        /* File upload styling */
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .custom-file-upload {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .custom-file-upload:hover {
            border-color: #009ef7;
        }

        .file-list {
            margin-top: 1rem;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 3px solid #009ef7;
        }

        .file-item .file-name {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-right: 1rem;
        }

        .file-item .file-remove {
            color: #f1416c;
            cursor: pointer;
        }

        .file-progress {
            height: 5px;
            width: 100%;
            background-color: #e9ecef;
            border-radius: 3px;
            margin-top: 0.25rem;
        }

        .file-progress-bar {
            height: 100%;
            background-color: #009ef7;
            border-radius: 3px;
            width: 0%;
            transition: width 0.3s;
        }

        .file-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #7e8299;
            margin-top: 0.25rem;
        }
    </style>
@endpush
@section('dashboardProfile')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
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
                            @forelse ($penugasanAuditors as $index => $penugasanAuditor)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">{{ $index + 1 }}</td>
                                    <td>{{ $penugasanAuditor->auditee->nama_unit_kerja }}</td>
                                    <td>{{ $penugasanAuditor->auditee->jenjang }}</td>
                                    <td>{{ $penugasanAuditor->auditee->fakultas ? $penugasanAuditor->auditee->fakultas : '-' }}</td>
                                    <td>
                                        @forelse ($penugasanAuditor->auditors as $auditor)
                                            @php
                                                $sudahNilai = false;

                                                foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                    if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                        $sudahNilai = true;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            <div class="mb-2">
                                                <i class="fas fa-user text-primary me-1"></i>
                                                <span class="fw-semibold">{{ $auditor->auditor->name }}</span>

                                                @if ($sudahNilai)
                                                    <i class="fas fa-check-circle text-success ms-2"></i>
                                                @endif

                                                <span class="badge bg-light text-dark ms-2 text-capitalize">
                                                    {{ str_replace('_', ' ', $auditor->role) }}
                                                </span>
                                            </div>
                                        @empty
                                            <span class="text-muted fst-italic">Belum ditugaskan</span>
                                        @endforelse

                                    </td>
                                    <td class="text-center">
                                        <div class="button-container">
                                            <div class="button-container">
                                                <a href="{{ route('laporan.detail', $penugasanAuditor->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
