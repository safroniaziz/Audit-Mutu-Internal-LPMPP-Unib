@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Instrumen Rsb Prodi
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Instrumen Rsb Prodi</li>
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
                                <span>Jika Anda ingin menghapus data Instrumen Rsb Prodi, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-rsbProdi-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Instrumen Rsb Prodi" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-rsbProdi-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Instrumen Rsb Prodi
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-rsbProdi-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-rsbProdi-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-rsbProdi-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_rsbProdi_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                            <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_rsbProdi_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class=" ps-3">No</th>
                                    <th class="">Kode Prodi</th>
                                    <th class="">Nama Prodi</th>
                                    <th class="">Jenjang</th>
                                    <th class="">Fakultas</th>
                                    <th class="">Jumlah Instrumen Rsb</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($programStudis as $index => $prodi)
                                    <tr>
                                        <td class="w-10px pe-2 ps-4">
                                            <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                                <input class="form-check-input" type="checkbox" value="{{ $prodi->id }}" />
                                            </div>
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $prodi->kode_unit_kerja }}</td>
                                        <td>{{ $prodi->nama_unit_kerja }}</td>
                                        <td>{{ $prodi->jenjang }}</td>
                                        <td>{{ $prodi->fakultas }}</td>
                                        <td>{{ $prodi->instrumen_ikss_count }} Data</td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary detail-rsbProdi"
                                                    data-id="{{ $prodi->id }}"
                                                    data-url="{{ route('rsbProdi.modal', $prodi->id) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modelTambahInstrumenRsb">
                                                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah Instrumen Prodi
                                                </button>
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
                <!-- Modal -->
                <div class="modal fade" id="modelTambahInstrumenRsb" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Kelola Instrumen Prodi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="isiModalInstrumenRsb">
                                <!-- Data akan diisi melalui AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/rsb_prodi/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
@endpush
