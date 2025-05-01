@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Unit Kerja
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Unit Kerja</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-unker-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Unit Kerja" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-unker-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Unit Kerja
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-unker-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-unker-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-unker-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_unker_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_unker_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-125px">Kode Unker</th>
                                <th class="min-w-175px">Nama Unker</th>
                                <th class="min-w-125px">Jenis Unker</th>
                                <th class="min-w-100px">Jenjang</th>
                                <th class="min-w-150px">Fakultas</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($unitKerjas as $index => $unitKerja)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $unitKerja->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $unitKerja->kode_unit_kerja }}</td>
                                    <td>{{ $unitKerja->nama_unit_kerja }}</td>
                                    <td>
                                        @if ($unitKerja->jenis_unit_kerja == "prodi")
                                            <div class="badge badge-light-success">Program Studi</div>
                                        @elseif ($unitKerja->jenis_unit_kerja == "fakultas")
                                            <div class="badge badge-light-primary">Fakultas</div>
                                        @elseif ($unitKerja->jenis_unit_kerja == "upt")
                                            <div class="badge badge-light-warning">Unit Pelayanan Terpadu (UPT)</div>
                                        @elseif ($unitKerja->jenis_unit_kerja == "lembaga")
                                            <div class="badge badge-light-warning">Lembaga</div>
                                        @endif
                                    </td>
                                    <td>{{ $unitKerja->jenjang ?? '-' }}</td>
                                    <td>{{ $unitKerja->fakultas ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($unitKerja->deleted_at)
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
                                            <button type="button" class="btn btn-sm btn-light-success edit-unitkerja"
                                                data-id="{{ $unitKerja->id }}"
                                                data-url="{{ route('unitKerja.edit', $unitKerja->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                            </button>
                                            @if ($unitKerja->deleted_at)
                                                <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $unitKerja->id }}">
                                                    <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $unitKerja->id }}">
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-unitKerja" data-id="{{ $unitKerja->id }}">
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
            @include('layouts.partials._modal_unit_kerja')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/unker/list/list.js') }}"></script>

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
                        url: "{{ route('unitKerja.restore', ':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data unit kerja berhasil dipulihkan.',
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

        $('.edit-unitkerja').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('unitKerja.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Unit Kerja');
            $('#kt_modal button[type=submit]').text('Update Data');

            // Ambil data unit kerja berdasarkan ID
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let data = response.data;

                        // Isi form dalam modal dengan data dari server
                        $('#kt_modal input[name="kode_unit_kerja"]').val(data.kode_unit_kerja);
                        $('#kt_modal input[name="nama_unit_kerja"]').val(data.nama_unit_kerja);
                        $('#kt_modal select[name="jenis_unit_kerja"]').val(data.jenis_unit_kerja);
                        $('#kt_modal select[name="jenjang"]').val(data.jenjang);
                        $('#kt_modal se[name="fakultas"]').val(data.fakultas);
                        alert(data.fakultas);

                        // Trigger change event pada jenis_unit_kerja untuk menampilkan/sembunyikan field tambahan
                        $('select[name="jenis_unit_kerja"]').trigger('change');

                        // Tampilkan field jenjang dan fakultas jika diperlukan (untuk mode edit)
                        if (data.jenis_unit_kerja === 'prodi') {
                            $('#jenjang_container').show();
                            $('#fakultas_container').show();
                        }
                    }
                },
                error: function() {
                    Swal.fire("Error", "Gagal mengambil data unit kerja", "error");
                }
            });
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-unitkerja)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('unitKerja.store') }}");
            $('#kt_modal .modal-title').text('Tambah Unit Kerja');
            $('#kt_modal button[type=submit]').text('Simpan');
            $('#jenjang_container').hide();
            $('#fakultas_container').hide();
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-unitKerja', function() {
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
                        url: "{{ route('unitKerja.nonaktifkan', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data unit kerja berhasil dinonaktifkan.',
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
        $(document).on('click', '[data-kt-unker-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_unker_table tbody input[type="checkbox"]:checked');

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
                        url: "{{ route('unitKerja.nonaktifkanSelected') }}",
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
            var url = "{{ route('unitKerja.hapus_permanen', ':id') }}";
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
    </script>
@endpush
