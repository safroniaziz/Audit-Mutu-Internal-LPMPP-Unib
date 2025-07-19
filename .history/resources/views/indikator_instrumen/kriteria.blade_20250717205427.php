@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Kriteria Penilaian
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('indikatorInstrumen.index') }}" class="text-muted text-hover-primary">Indikator Instrumen</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Kriteria Penilaian</li>
@endsection

@push('styles')
    <style>
        .select2-container--bootstrap5 .select2-selection {
            box-shadow: none !important;
        }
        .select2-container--bootstrap5 .select2-selection--multiple {
            min-height: calc(1.5em + 1.5rem + 2px) !important;
        }
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
        }
        .tooltip-inner {
            max-width: 300px;
            text-align: left;
        }
        .tooltip-inner br {
            margin-bottom: 3px;
        }
        .btn-xs {
            padding: 0;
            font-size: 0.5rem;
            line-height: 1;
            border: none;
            background: none;
            min-width: 20px;
            height: 20px;
        }
        .btn-xs i {
            font-size: 0.7rem;
        }
        .btn-xs:hover {
            background: none;
            opacity: 0.7;
        }
        .elemen-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .elemen-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="w-100 mb-2">
                        <div class="alert alert-info d-flex align-items-center p-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-info me-4">
                                <i class="ki-duotone ki-information-5 fs-2 text-info">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>

                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">Informasi Indikator</h4>
                                <span>Menampilkan kriteria penilaian untuk indikator: <strong>{{ $indikator->nama_indikator }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-kriteria-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kriteria Penilaian" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-kriteria-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalTambahKriteria">
                                <i class="fas fa-plus fa-sm"></i> Tambah Kriteria
                            </button>
                            <a href="{{ route('indikatorInstrumen.index') }}" class="btn btn-secondary btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Indikator
                            </a>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-kriteria-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-kriteria-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-kriteria-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_kriteria_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_kriteria_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-200px">Nama Kriteria</th>
                                <th class="min-w-300px">Elemen</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($kriterias as $index => $kriteria)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $kriteria->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td>
                                        @if($kriteria->instrumenProdi->isNotEmpty())
                                            <div class="d-flex flex-column gap-1">
                                                @foreach($kriteria->instrumenProdi as $index => $instrumen)
                                                    <div class="elemen-item">
                                                        <span class="badge badge-light-secondary elemen-badge" style="min-width: 25px; text-align: center;">{{ $index + 1 }}</span>
                                                        <span class="badge badge-light-primary elemen-badge">{{ $instrumen->elemen }}</span>
                                                        <button type="button" class="btn btn-xs btn-link p-0 edit-elemen"
                                                                data-id="{{ $instrumen->id }}"
                                                                data-elemen="{{ $instrumen->elemen }}"
                                                                data-kriteria-id="{{ $instrumen->indikator_instrumen_kriteria_id }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEditElemen"
                                                                title="Edit Elemen">
                                                            <i class="fas fa-edit text-warning"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-xs btn-link p-0 delete-elemen"
                                                                data-id="{{ $instrumen->id }}"
                                                                data-elemen="{{ $instrumen->elemen }}"
                                                                title="Hapus Elemen">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-danger fst-italic">Tidak ada elemen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="button-container">
                                            <button type="button" class="btn btn-sm btn-light-primary tambah-elemen me-1"
                                                data-kriteria-id="{{ $kriteria->id }}"
                                                data-kriteria-nama="{{ $kriteria->nama_kriteria }}"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahElemen">
                                                <i class="fas fa-plus fa-sm"></i>&nbsp;Tambah Elemen
                                            </button>
                                            <button type="button" class="btn btn-sm btn-light-success edit-kriteria"
                                                data-id="{{ $kriteria->id }}"
                                                data-url="{{ route('kriteriaInstrumen.edit', $kriteria->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#modalEditKriteria">
                                                <i class="fas fa-edit fa-sm"></i>&nbsp;Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-light-danger delete-kriteria" data-id="{{ $kriteria->id }}">
                                                <i class="fas fa-trash fa-sm"></i>&nbsp;Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Elemen -->
    <div class="modal fade" id="modalTambahElemen" tabindex="-1" aria-labelledby="modalTambahElemenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahElemenLabel">Tambah Elemen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambahElemen">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="indikator_instrumen_kriteria_id" class="form-label">Kriteria</label>
                            <select class="form-select" id="indikator_instrumen_kriteria_id" name="indikator_instrumen_kriteria_id" required>
                                <option value="">Pilih Kriteria</option>
                                @foreach($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="indikator_instrumen_id" value="{{ $indikator->id }}">
                        <div class="mb-3">
                            <label for="elemen" class="form-label">Nama Elemen</label>
                            <input type="text" class="form-control" id="elemen" name="elemen" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Elemen -->
    <div class="modal fade" id="modalEditElemen" tabindex="-1" aria-labelledby="modalEditElemenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditElemenLabel">Edit Elemen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditElemen">
                    <div class="modal-body">
                        <input type="hidden" id="edit_elemen_id" name="elemen_id">
                        <div class="mb-3">
                            <label for="edit_kriteria_id" class="form-label">Kriteria</label>
                            <select class="form-select" id="edit_kriteria_id" name="indikator_instrumen_kriteria_id" required>
                                <option value="">Pilih Kriteria</option>
                                @foreach($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="indikator_instrumen_id" value="{{ $indikator->id }}">
                        <div class="mb-3">
                            <label for="edit_elemen" class="form-label">Nama Elemen</label>
                            <input type="text" class="form-control" id="edit_elemen" name="elemen" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/indikator_instrumen/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#kt_kriteria_table').DataTable({
                "pageLength": 25,
                "order": [[1, "asc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });

        // Handle tambah elemen
        $('#formTambahElemen').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('instrumenProdi.store') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalTambahElemen').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Elemen berhasil ditambahkan.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menambahkan elemen.',
                        icon: 'error'
                    });
                }
            });
        });

        // Handle edit elemen
        $(document).on('click', '.edit-elemen', function() {
            let id = $(this).data('id');
            let elemen = $(this).data('elemen');
            let kriteriaId = $(this).data('kriteria-id');

            $('#edit_elemen_id').val(id);
            $('#edit_elemen').val(elemen);
            $('#edit_kriteria_id').val(kriteriaId);
        });

        // Handle submit edit elemen
        $('#formEditElemen').on('submit', function(e) {
            e.preventDefault();

            let elemenId = $('#edit_elemen_id').val();

            $.ajax({
                url: "{{ route('instrumenProdi.update', ':id') }}".replace(':id', elemenId),
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalEditElemen').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Elemen berhasil diupdate.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat mengupdate elemen.',
                        icon: 'error'
                    });
                }
            });
        });

        // Handle edit kriteria
        $(document).on('click', '.edit-kriteria', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            // Implementasi edit kriteria
            console.log('Edit kriteria ID:', id);
            // Bisa ditambahkan modal atau redirect ke halaman edit
        });

        // Handle delete kriteria
        $(document).on('click', '.delete-kriteria', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kriteria akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('kriteriaInstrumen.nonaktifkan', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data kriteria berhasil dihapus.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        // Handle delete elemen
        $(document).on('click', '.delete-elemen', function() {
            let id = $(this).data('id');
            let elemen = $(this).data('elemen');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Elemen "${elemen}" akan dihapus!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('instrumenProdi.nonaktifkan', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data elemen berhasil dihapus.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
