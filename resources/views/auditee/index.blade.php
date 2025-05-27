@extends('layouts.dashboard2')
@section('menu')
    Data Auditee
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Auditee</li>
@endsection
@section('content')
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
                                <h4 class="mb-1 text-danger">Perhatian!</h4>
                                <span>Jika Anda ingin menghapus data Auditee, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-auditee-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Auditee" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-auditee-table-toolbar="base">
                            <button type="button" id="addAuditeeButton" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Auditee
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-auditee-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-auditee-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-auditee-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_auditee_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_auditee_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-125px">Nama Auditee</th>
                                    <th class="min-w-125px">Unit Kerja</th>
                                    <th class="min-w-125px">Username</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-100px text-center">Ubah Password</th>
                                    <th class="min-w-auto text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($auditees as $auditee)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="{{ $auditee->id }}" />
                                            </div>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        @if ($auditee->foto)
                                                            <img src="{{ Storage::url($auditee->foto) }}" alt="{{ $auditee->name }}" class="w-100" />
                                                        @else
                                                            <img src="{{ asset('assets/src/images/profile.png') }}" alt="{{ $auditee->name }}" class="w-100" />
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $auditee->name }}</a>
                                            </div>
                                            <!--end::User details-->
                                        </td>
                                        <td>{{ optional($auditee->unitKerja)->nama_unit_kerja }}</td>
                                        <td>{{ $auditee->username }}</td>
                                        <td>{{ $auditee->email }}</td>
                                        <td>
                                            @if ($auditee->deleted_at)
                                                <span class="badge badge-light-danger">Tidak Aktif</span>
                                            @else
                                                <span class="badge badge-light-success">Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary ubah-password-btn" data-id="{{ $auditee->id }}">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                <button type="button" class="btn btn-sm btn-light-success editAuditeeButton"
                                                        data-id="{{ $auditee->id }}"
                                                        data-url="{{ route('auditee.edit', $auditee->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                    <i class="fas fa-edit fa-sm"></i>&nbsp;Edit
                                                </button>
                                                @if ($auditee->deleted_at)
                                                    <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $auditee->id }}">
                                                        <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $auditee->id }}">
                                                        <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-light-danger delete-data" data-id="{{ $auditee->id }}">
                                                        <i class="fas fa-user-slash fa-sm"></i>&nbsp;Nonaktifkan
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-light-danger" disabled>
                                                        <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                    </button>
                                                @endif
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
                <div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Password Auditee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <form id="ubahPasswordForm">
                                    <input type="hidden" name="auditee_id" id="passwordAuditeeId">
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" name="password" id="newPassword" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" required>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" id="buttonsubmit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials._modal_auditee')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/auditee/list/list.js') }}"></script>
    <script>
        // ... existing scripts ...
    </script>
@endpush
