@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Instrumen Prodi
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Instrumen Prodi</li>
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
                                <span>Jika Anda ingin menghapus data Instrumen Prodi, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-instrumenProdi-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Instrumen Prodi" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-instrumenProdi-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Instrumen Prodi
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-instrumenProdi-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-instrumenProdi-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-instrumenProdi-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_instrumenProdi_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                            <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_instrumenProdi_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class=" ps-3">No</th>
                                    <th class="">Kriteria</th>
                                    <th class="">Indikator</th>
                                    <th class="">Elemen</th>
                                    <th class="">Standar Digunakan</th>
                                    <th class="">Status</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($instrumens as $index => $instrumen)
                                    <tr>
                                        <td class="w-10px pe-2 ps-4">
                                            <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                                <input class="form-check-input" type="checkbox" value="{{ $instrumen->id }}" />
                                            </div>
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $instrumen->kriteriaInstrumen->nama_kriteria }}</td>
                                        <td>{{ $instrumen->indikator }}</td>
                                        <td>{{ $instrumen->elemen }}</td>
                                        <td>{{ $instrumen->standar_digunakan }}</td>
                                        <td class="text-center">
                                            @if ($instrumen->deleted_at)
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle fa-sm" style="color: white;"></i>&nbsp;Tidak Aktif
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle fa-sm" style="color: white;"></i>&nbsp;Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                @if (!$instrumen->deleted_at)
                                                    <button type="button"
                                                        class="btn btn-sm btn-light-info detail-instrumenProdi"
                                                        data-id="{{ $instrumen->id }}"
                                                        data-url="{{ route('instrumenProdi.show', $instrumen->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailInstrumen">
                                                        <i class="fas fa-info-circle fa-sm"></i>&nbsp;Detail
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-light-success edit-instrumenProdi"
                                                        data-id="{{ $instrumen->id }}"
                                                        data-url="{{ route('instrumenProdi.edit', $instrumen->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                        <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                                    </button>
                                                @endif
                                                @if ($instrumen->deleted_at)
                                                    <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $instrumen->id }}">
                                                        <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $instrumen->id }}">
                                                        <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-instrumenProdi" data-id="{{ $instrumen->id }}">
                                                        <i class="fas fa-ban fa-sm"></i>&nbsp;Nonaktifkan
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
                <div class="modal fade" id="modalDetailInstrumen" tabindex="-1" aria-labelledby="modalDetailInstrumenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailInstrumenLabel">Detail Instrumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body" id="detailInstrumenContent">
                                <!-- Konten akan diisi lewat AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials._modal_instrumen_prodi')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/instrumen_prodi/list/list.js') }}"></script>

<script></script>
@endpush
