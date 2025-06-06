@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Indikator Instrumen
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Indikator Instrumen</li>
@endsection

@push('styles')
    {{-- Add Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        /* Custom Select2 Styles */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #e4e6ef;
            border-radius: 6px;
            padding: 0.775rem 1rem;
            min-height: 45px;
            background-color: #f5f8fa;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple {
            padding: 4px 8px;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: #009ef7;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 4px 8px;
            margin: 4px 4px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
            margin-right: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            order: 1;
            margin-left: 6px;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #e4e6ef;
            border-radius: 6px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }

        .select2-container--bootstrap-5 .select2-dropdown .select2-results__option {
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            border-bottom: 1px solid #f5f8fa;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .select2-container--bootstrap-5 .select2-dropdown .select2-results__option--highlighted {
            background-color: #f5f8fa;
            color: #009ef7;
        }

        .select2-container--bootstrap-5 .select2-dropdown .select2-results__option--selected,
        .select2-container--bootstrap-5 .select2-dropdown .select2-results__option[aria-selected=true] {
            background-color: #009ef7;
            color: #ffffff;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #009ef7;
            box-shadow: 0 0 0 0.25rem rgba(0, 158, 247, 0.25);
        }

        .select2-container--bootstrap-5 .select2-search__field:focus {
            border-color: #009ef7;
            box-shadow: none;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-search__field {
            margin-top: 4px;
            margin-bottom: 4px;
        }

        /* Placeholder styling */
        .select2-container--bootstrap-5 .select2-selection__placeholder {
            color: #a1a5b7;
            font-size: 0.95rem;
        }
    </style>
@endpush

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
                                <span>Jika Anda ingin menghapus data Indikator Instrumen, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-indikatorInstrumen-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Indikator Instrumen" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-indikatorInstrumen-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Indikator Instrumen
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-indikatorInstrumen-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-indikatorInstrumen-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-indikatorInstrumen-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_indikatorInstrumen_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_indikatorInstrumen_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-125px">Nama Indikator</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($indikators as $index => $indikator)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $indikator->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $indikator->nama_indikator }}</td>
                                    <td class="text-center">
                                        @if ($indikator->deleted_at)
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
                                            <button type="button" class="btn btn-sm btn-light-success edit-indikatorInstrumen"
                                                data-id="{{ $indikator->id }}"
                                                data-url="{{ route('indikatorInstrumen.edit', $indikator->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                            </button>
                                            @if ($indikator->deleted_at)
                                                <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $indikator->id }}">
                                                    <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $indikator->id }}">
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-indikatorInstrumen" data-id="{{ $indikator->id }}">
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
            @include('layouts.partials._modal_indikator_instrumen')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/indikator_instrumen/list/list.js') }}"></script>
    {{-- Add Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.restore-data', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dipulihkan dan bisa digunakan kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.restore', ':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data Indikator Instrumen berhasil dipulihkan.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat memulihkan data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        $('.edit-indikatorInstrumen').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('indikatorInstrumen.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Indikator Instrumen');
            $('#kt_modal button[type=submit]').text('Update Data');

            // Ambil data Indikator Instrumen berdasarkan ID
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let data = response.data;
                        // Isi form dalam modal dengan data dari server
                        $('#kt_modal input[name="nama_indikator"]').val(data.nama_indikator);
                    }
                },
                error: function() {
                    Swal.fire("Error", "Gagal mengambil data Indikator Instrumen", "error");
                }
            });
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-indikatorInstrumen)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('indikatorInstrumen.store') }}");
            $('#kt_modal .modal-title').text('Tambah Indikator Instrumen');
            $('#kt_modal button[type=submit]').text('Simpan');
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-indikatorInstrumen', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dinonaktifkan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.nonaktifkan', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data Indikator Instrumen berhasil dinonaktifkan.',
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

        // Handler untuk tombol "Nonaktifkan Data Terpilih"
        $(document).on('click', '[data-kt-indikatorInstrumen-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_indikatorInstrumen_table tbody input[type="checkbox"]:checked');
            console.log(checkboxes);
            if (checkboxes.length <= 0) {
                Swal.fire({
                    text: "Tidak ada data yang dipilih!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                });
                return;
            }

            const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menonaktifkan ${ids.length} data yang dipilih. Data yang dinonaktifkan tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.nonaktifkanSelected') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
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

        $(document).on('click', '.delete-permanent', function () {
            var id = $(this).data('id');
            var url = "{{ route('indikatorInstrumen.hapus_permanen', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Hapus Permanen?',
                text: "Data Auditor akan dihapus secara permanen dan tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON.message,
                            });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            // Initialize Select2
            $('#kategori_select').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Pilih kategori...',
                allowClear: true,
                dropdownParent: $('#kt_modal'),
                templateResult: formatOption,
                templateSelection: formatOption,
                escapeMarkup: function(m) { return m; }
            });

            // Reset select2 when modal is hidden
            $('#kt_modal').on('hidden.bs.modal', function () {
                $('#kategori_select').val(null).trigger('change');
            });
        });

        // Custom template for options
        function formatOption(option) {
            if (!option.id) return option.text; // For placeholder

            return '<div class="select2-option">' +
                   '<span class="select2-option-text">' + option.text + '</span>' +
                   '</div>';
        }
    </script>
@endpush
