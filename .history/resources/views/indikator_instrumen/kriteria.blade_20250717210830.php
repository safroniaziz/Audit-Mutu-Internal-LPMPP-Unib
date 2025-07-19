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

    <!-- Modal Tambah Kriteria -->
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1" data-bs-backdrop="static" data-bs-focus="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header px-10">
                    <h2 class="fw-bold">Tambah Kriteria Instrumen</h2>
                </div>
                <div class="modal-body d-flex flex-column scroll-y px-10" style="flex-grow: 1;">
                    <form id="formTambahKriteria" class="form d-flex flex-column" style="flex-grow: 1;">
                        @csrf
                        <input type="hidden" name="indikator_instrumen_id" value="{{ $indikator->id }}">

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Indikator Instrumen:</label>
                            <input type="text" class="form-control" value="{{ $indikator->nama_indikator }}" readonly />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Kode Kriteria Instrumen:</label>
                            <input type="text" name="kode_kriteria" class="form-control" required />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Nama Kriteria Instrumen:</label>
                            <input type="text" name="nama_kriteria" class="form-control" required />
                        </div>

                        <div class="modal-footer border-top mt-auto" style="padding:10px 0px 10px 0px">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fa fa-close fs-8"></i> Batalkan
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="ki-duotone ki-check fs-5"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Elemen -->
    <div class="modal fade" id="modalTambahElemen" tabindex="-1" aria-labelledby="modalTambahElemenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
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
                            <label for="elemen" class="form-label">Elemen</label>
                            <input type="text" class="form-control" id="elemen" name="elemen" required>
                        </div>
                        <div class="mb-3">
                            <label for="indikator" class="form-label">Indikator</label>
                            <input type="text" class="form-control" id="indikator" name="indikator" required>
                        </div>
                        <div class="mb-3">
                            <label for="sumber_data" class="form-label">Sumber Data</label>
                            <input type="text" class="form-control" id="sumber_data" name="sumber_data" required>
                        </div>
                        <div class="mb-3">
                            <label for="metode_perhitungan" class="form-label">Metode Perhitungan</label>
                            <input type="text" class="form-control" id="metode_perhitungan" name="metode_perhitungan" required>
                        </div>
                        <div class="mb-3">
                            <label for="target" class="form-label">Target</label>
                            <input type="text" class="form-control" id="target" name="target" required>
                        </div>
                        <div class="mb-3">
                            <label for="realisasi" class="form-label">Realisasi</label>
                            <input type="text" class="form-control" id="realisasi" name="realisasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="standar_digunakan" class="form-label">Standar Digunakan</label>
                            <input type="text" class="form-control" id="standar_digunakan" name="standar_digunakan" required>
                        </div>
                        <div class="mb-3">
                            <label for="uraian" class="form-label">Uraian</label>
                            <textarea class="form-control" id="uraian" name="uraian"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="penyebab_tidak_tercapai" class="form-label">Penyebab Tidak Tercapai</label>
                            <textarea class="form-control" id="penyebab_tidak_tercapai" name="penyebab_tidak_tercapai"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rencana_perbaikan" class="form-label">Rencana Perbaikan</label>
                            <textarea class="form-control" id="rencana_perbaikan" name="rencana_perbaikan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="indikator_penilaian" class="form-label">Indikator Penilaian</label>
                            <textarea class="form-control" id="indikator_penilaian" name="indikator_penilaian"></textarea>
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

    <!-- Modal Edit Kriteria -->
    <div class="modal fade" id="modalEditKriteria" tabindex="-1" data-bs-backdrop="static" data-bs-focus="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header px-10">
                    <h2 class="fw-bold">Edit Kriteria Instrumen</h2>
                </div>
                <div class="modal-body d-flex flex-column scroll-y px-10" style="flex-grow: 1;">
                    <form id="formEditKriteria" class="form d-flex flex-column" style="flex-grow: 1;">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="edit_kriteria_id" name="kriteria_id">
                        <input type="hidden" name="indikator_instrumen_id" value="{{ $indikator->id }}">

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Indikator Instrumen:</label>
                            <input type="text" class="form-control" value="{{ $indikator->nama_indikator }}" readonly />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Kode Kriteria Instrumen:</label>
                            <input type="text" name="kode_kriteria" id="edit_kode_kriteria" class="form-control" required />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="fs-5 fw-semibold form-label mb-2">Nama Kriteria Instrumen:</label>
                            <input type="text" name="nama_kriteria" id="edit_nama_kriteria" class="form-control" required />
                        </div>

                        <div class="modal-footer border-top mt-auto" style="padding:10px 0px 10px 0px">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fa fa-close fs-8"></i> Batalkan
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="ki-duotone ki-check fs-5"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Elemen -->
    <div class="modal fade" id="modalEditElemen" tabindex="-1" aria-labelledby="modalEditElemenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
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
                            <label for="edit_elemen" class="form-label">Elemen</label>
                            <input type="text" class="form-control" id="edit_elemen" name="elemen" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_indikator" class="form-label">Indikator</label>
                            <input type="text" class="form-control" id="edit_indikator" name="indikator" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_sumber_data" class="form-label">Sumber Data</label>
                            <input type="text" class="form-control" id="edit_sumber_data" name="sumber_data" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_metode_perhitungan" class="form-label">Metode Perhitungan</label>
                            <input type="text" class="form-control" id="edit_metode_perhitungan" name="metode_perhitungan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_target" class="form-label">Target</label>
                            <input type="text" class="form-control" id="edit_target" name="target" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_realisasi" class="form-label">Realisasi</label>
                            <input type="text" class="form-control" id="edit_realisasi" name="realisasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_standar_digunakan" class="form-label">Standar Digunakan</label>
                            <input type="text" class="form-control" id="edit_standar_digunakan" name="standar_digunakan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_uraian" class="form-label">Uraian</label>
                            <textarea class="form-control" id="edit_uraian" name="uraian"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_penyebab_tidak_tercapai" class="form-label">Penyebab Tidak Tercapai</label>
                            <textarea class="form-control" id="edit_penyebab_tidak_tercapai" name="penyebab_tidak_tercapai"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_rencana_perbaikan" class="form-label">Rencana Perbaikan</label>
                            <textarea class="form-control" id="edit_rencana_perbaikan" name="rencana_perbaikan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_indikator_penilaian" class="form-label">Indikator Penilaian</label>
                            <textarea class="form-control" id="edit_indikator_penilaian" name="indikator_penilaian"></textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTable
        $(document).ready(function() {
            var table = $('#kt_kriteria_table').DataTable({
                "pageLength": 25,
                "order": [[1, "asc"]],
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Data tidak tersedia",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered":   "(difilter dari _MAX_ total data)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Tampilkan _MENU_ data",
                    "loadingRecords": "Memuat...",
                    "processing":     "Memproses...",
                    "search":         "Cari:",
                    "zeroRecords":    "Tidak ada data yang cocok",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Selanjutnya",
                        "previous":   "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending":  ": aktifkan untuk mengurutkan kolom naik",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom turun"
                    }
                },
                "info": false,
                "lengthChange": false,
                'columnDefs': [
                    { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                    { orderable: false, targets: 4 }, // Disable ordering on column 4 (actions)
                ]
            });

            // Handle search
            $('[data-kt-kriteria-table-filter="search"]').on('keyup', function (e) {
                table.search(e.target.value).draw();
            });

            // Handle toolbar toggle
            var toolbarBase = $('[data-kt-kriteria-table-toolbar="base"]');
            var toolbarSelected = $('[data-kt-kriteria-table-toolbar="selected"]');
            var selectedCount = $('[data-kt-kriteria-table-select="selected_count"]');

            // Handle checkbox selection
            $('#kt_kriteria_table tbody').on('change', 'input[type="checkbox"]', function() {
                var checkedCount = $('#kt_kriteria_table tbody input[type="checkbox"]:checked').length;

                if (checkedCount > 0) {
                    selectedCount.text(checkedCount);
                    toolbarBase.addClass('d-none');
                    toolbarSelected.removeClass('d-none');
                } else {
                    toolbarBase.removeClass('d-none');
                    toolbarSelected.addClass('d-none');
                }
            });

            // Handle select all checkbox
            $('#kt_kriteria_table thead input[type="checkbox"]').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('#kt_kriteria_table tbody input[type="checkbox"]').prop('checked', isChecked).trigger('change');
            });

            // Handle delete selected
            $('[data-kt-kriteria-table-select="delete_selected"]').on('click', function() {
                var checkedBoxes = $('#kt_kriteria_table tbody input[type="checkbox"]:checked');
                var checkedIds = [];

                checkedBoxes.each(function() {
                    checkedIds.push($(this).val());
                });

                if (checkedIds.length === 0) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Pilih kriteria yang akan dinonaktifkan.',
                        icon: 'warning'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `${checkedIds.length} kriteria akan dinonaktifkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, nonaktifkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('kriteriaInstrumen.nonaktifkanSelected') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: checkedIds
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menonaktifkan data.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });

        // Handle tambah kriteria
        $('#formTambahKriteria').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kriteriaInstrumen.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#modalTambahKriteria').modal('hide');
                    Swal.fire({
                        title: '✅ Berhasil!',
                        html: `<div style="font-size: 1.2rem; font-weight: 500;">${response.message}</div>`,
                        icon: 'success',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2500,
                        timerProgressBar: true,
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        let errorMessages = Object.values(errors).map(errorArray =>
                            errorArray.map(error => `
                                <div style="margin: 4px auto; padding-bottom: 4px; color: red; font-weight: 500; text-align: center; border-bottom: 1px solid #ccc; width: 80%;">${error}</div>`
                            ).join('')
                        ).join('');

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            html: `<div style="font-size: 1rem;">${errorMessages}</div>`,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan, silakan coba lagi.'
                        });
                    }
                }
            });
        });

        // Handle tambah elemen
        $(document).on('click', '.tambah-elemen', function() {
            let kriteriaId = $(this).data('kriteria-id');
            let kriteriaNama = $(this).data('kriteria-nama');

            $('#indikator_instrumen_kriteria_id').val(kriteriaId);
            $('#modalTambahElemenLabel').text('Tambah Elemen - ' + kriteriaNama);
        });

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

            // Fetch data kriteria untuk diisi ke form
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#edit_kriteria_id').val(response.data.id);
                    $('#edit_kode_kriteria').val(response.data.kode_kriteria);
                    $('#edit_nama_kriteria').val(response.data.nama_kriteria);
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat mengambil data kriteria.',
                        icon: 'error'
                    });
                }
            });
        });

        // Handle submit edit kriteria
        $('#formEditKriteria').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let kriteriaId = $('#edit_kriteria_id').val();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kriteriaInstrumen.update', ':id') }}".replace(':id', kriteriaId),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#modalEditKriteria').modal('hide');
                    Swal.fire({
                        title: '✅ Berhasil!',
                        html: `<div style="font-size: 1.2rem; font-weight: 500;">${response.message}</div>`,
                        icon: 'success',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2500,
                        timerProgressBar: true,
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        let errorMessages = Object.values(errors).map(errorArray =>
                            errorArray.map(error => `
                                <div style="margin: 4px auto; padding-bottom: 4px; color: red; font-weight: 500; text-align: center; border-bottom: 1px solid #ccc; width: 80%;">${error}</div>`
                            ).join('')
                        ).join('');

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            html: `<div style="font-size: 1rem;">${errorMessages}</div>`,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan, silakan coba lagi.'
                        });
                    }
                }
            });
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

        // Inisialisasi CKEditor untuk textarea pada tambah/edit elemen
        const elemenEditorFields = [
            'uraian',
            'penyebab_tidak_tercapai',
            'rencana_perbaikan',
            'indikator_penilaian',
            'edit_uraian',
            'edit_penyebab_tidak_tercapai',
            'edit_rencana_perbaikan',
            'edit_indikator_penilaian'
        ];
        const elemenEditorInstances = {};
        elemenEditorFields.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                ClassicEditor.create(element, {
                    toolbar: ['bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
                    autoParagraph: false
                }).then(editor => {
                    elemenEditorInstances[id] = editor;
                }).catch(error => {
                    console.error(`Error initializing CKEditor for #${id}:`, error);
                });
            }
        });
    </script>
@endpush
