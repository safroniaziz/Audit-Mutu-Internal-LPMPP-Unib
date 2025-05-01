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
                            <input type="text" data-kt-administrator-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Administrator" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-administrator-table-toolbar="base">
                            <button type="button" id="addAdministratorButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal">
                                <i class="ki-duotone ki-plus fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i> Tambah Administrator
                            </button>

                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-administrator-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-administrator-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-administrator-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_administrator_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_administrator_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-125px">Nama Lengkap</th>
                                <th class="min-w-175px">Email</th>
                                <th class="min-w-100px">Terdaftar Sejak</th>
                                <th class="min-w-100px text-center">Status</th>
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
                                    <td class="text-center">
                                        @if ($administrator->deleted_at)
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
                                        <button type="button" class="btn btn-sm btn-light-warning editAdministratorButton"
                                            data-id="{{ $administrator->id }}"
                                            data-url="{{ route('administrator.edit', $administrator->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal">
                                            <i class="fas fa-edit fa-sm"></i> Edit
                                        </button>
                                        @if ($administrator->deleted_at)
                                            <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $administrator->id }}">
                                                <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-light-danger delete-data" data-id="{{ $administrator->id }}">
                                                <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Nonaktifkan
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
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
    <script src="{{ asset('assets/src/js/custom/apps/administrator/list/list.js') }}"></script>

    <script>
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
                        url = "{{ route('administrator.restore', ['id' => 'uuid-here']) }}";
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data administrator berhasil dipulihkan.',
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

        $('#addAdministratorButton').click(function() {
            $('#kt_modal_form')[0].reset();
            $('#methodField').val('POST').trigger('change');
            $('#kt_modal').modal('show');
            $('#kt_modal_form').attr('action', "{{ route('administrator.store') }}");
        });

        $('.editAdministratorButton').click(function() {
            let id = $(this).data('id');
            $('#kt_modal_form')[0].reset();
            $('#methodField').val('PUT').trigger('change');
            $('#kt_modal_form').attr('action', `/administrator/${id}`);

            console.log('ID yang dipilih: ' + id);

            $.ajax({
                url: `/administrator/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    if (response.data.name) {
                        $('[name="name"]').val(response.data.name);
                    }
                    if (response.data.email) {
                        $('[name="email"]').val(response.data.email);
                    }

                    $('#kt_modal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('Error AJAX: ', error);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal mengambil data administrator.',
                        icon: 'error'
                    });
                }
            });
        });

        // Script untuk delete
        $(document).on('click', '.delete-data', function() {
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
                        url: "{{ route('administrator.destroy', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data administrator berhasil dinonaktifkan.',
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
        $(document).on('click', '[data-kt-administrator-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_administrator_table tbody input[type="checkbox"]:checked');

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
                        url: "{{ route('administrator.destroySelected') }}",
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
    </script>
@endpush
