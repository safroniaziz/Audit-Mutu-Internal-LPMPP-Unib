@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Administrator
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Administrator</li>
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
                            <input type="text" data-kt-unker-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Administrator" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-unker-table-toolbar="base">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                <i class="ki-duotone ki-plus fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i> Tambah Administrator
                            </button>

                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-unker-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-unker-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-unker-table-select="delete_selected">Hapus Data Terpilih</button>
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
                                <th class="min-w-125px">Nama Lengkap</th>
                                <th class="min-w-175px">Email</th>
                                <th class="min-w-100px">Terdaftar Sejak</th>
                                <th class="min-w-125px text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($administrators as $index => $administrator)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $administrator->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $administrator->name }}</td>
                                    <td>{{ $administrator->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($administrator->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-success edit-data"
                                            data-id="{{ $administrator->id }}"
                                            data-url="{{ route('administrator.edit', $administrator->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal">
                                            <i class="ki-duotone ki-pencil fs-5"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light-danger delete-data" data-id="{{ $administrator->id }}">
                                            <i class="ki-duotone ki-trash fs-5"></i> Delete
                                        </button>
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
            @include('layouts.partials._modal_administrator')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/unker/list/list.js') }}"></script>

    <script>
        $('.edit-data').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('administrator.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Administrator');
            $('#kt_modal button[type=submit]').text('Update Data');

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
                        $('#kt_modal input[name="fakultas"]').val(data.fakultas);

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
        $('button[data-bs-target="#kt_modal"]:not(.edit-data)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('administrator.store') }}");
            $('#kt_modal .modal-title').text('Tambah Unit Kerja');
            $('#kt_modal button[type=submit]').text('Simpan');
            $('#jenjang_container').hide();
            $('#fakultas_container').hide();
        });

        // Script untuk delete
        $(document).on('click', '.delete-data', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('administrator.destroy', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data unit kerja berhasil dihapus.',
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

        // Handler untuk tombol "Hapus Data Terpilih"
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
                text: `Anda akan menghapus ${ids.length} data yang dipilih. Data yang dihapus tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('administrator.destroySelected') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: response.message,
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
