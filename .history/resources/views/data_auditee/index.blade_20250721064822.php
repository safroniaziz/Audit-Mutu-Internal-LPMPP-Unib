@extends('layouts.dashboard.dashboard')
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
<!--begin::Content container-->
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
                            <span>Jika Anda ingin menghapus data Auditor, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
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
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_auditee_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_auditee_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Nama Auditee</th>
                                <th class="min-w-125px">Gambar TTD</th>
                                <th class="min-w-125px">Kategori Auditee</th>
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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-35px overflow-hidden me-3">
                                                <div class="symbol-label">
                                                    @if ($auditee->foto)
                                                        <img src="{{ Storage::url($auditee->foto) }}" alt="{{ $auditee->name }}" class="w-100" />
                                                    @else
                                                        <img src="{{ asset('assets/src/images/profile.png') }}" alt="{{ $auditee->name }}" class="w-100" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <span class="text-gray-800 text-hover-primary">{{ $auditee->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-35px overflow-hidden me-3">
                                                <div class="symbol-label">
                                                    @if ($auditee->unitKerja && $auditee->unitKerja->ttd != null)
                                                        <img src="{{ Storage::url($auditee->unitKerja->ttd) }}" alt="{{ $auditee->name }}" class="w-100" />
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <td>{{ optional($auditee->unitKerja)->nama_unit_kerja }}</td>
                                    <td>{{ $auditee->username }}</td>
                                    <td>{{ $auditee->email }}</td>
                                    <td>
                                        @if ($auditee->trashed())
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
                                            @if ($auditee->trashed())
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
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    </div>
</div>

@include('layouts.partials._modal_auditee')
@endsection

@push('scripts')
<script src="{{ asset('assets/src/js/custom/apps/auditee/list/list.js') }}"></script>

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
                    url: "{{ route('auditee.restore', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Dipulihkan!',
                            text: 'Data auditee berhasil dipulihkan.',
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

    $('#addAuditeeButton').click(function() {
        $('#kt_modal_form')[0].reset();
        $('#methodField').val('POST').trigger('change');
        $('#kt_modal').modal('show');
        $('#kt_modal_form').attr('action', "{{ route('auditee.store') }}");
        initImageInput();
    });

    $('.editAuditeeButton').click(function() {
        let id = $(this).data('id');
        $('#kt_modal_form')[0].reset();
        $('#methodField').val('PUT').trigger('change');
        $('#kt_modal_form').attr('action', `/auditee/${id}`);
        $.ajax({
            url: `/auditee/${id}/edit`,
            type: 'GET',
            success: function(response) {
                if (response.data.unit_kerja_id) {
                    $('[name="unit_kerja_id"]').val(response.data.unit_kerja_id);
                }
                if (response.data.name) {
                    $('[name="name"]').val(response.data.name);
                }
                if (response.data.email) {
                    $('[name="email"]').val(response.data.email);
                }
                if (response.data.username) {
                    $('[name="username"]').val(response.data.username);
                }

                if (response.data.id) {
                    $('[name="auditee_id"]').val(response.data.id);
                }

                if (response.data.foto_url) {
                    const dropZone = document.getElementById('dragDropZone');
                    dropZone.innerHTML = `
                        <img src="${response.data.foto_url}" class="preview-img">
                        <div class="position-absolute top-0 end-0 m-2">
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="resetUpload()">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>`;
                    dropZone.classList.add('success-upload');
                }

                $('#kt_modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log('Error AJAX: ', error);
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal mengambil data auditee.',
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
                    url: "{{ route('auditee.destroy', '') }}/" + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Dinonaktifkan!',
                            text: 'Data auditee berhasil dinonaktifkan.',
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
    $(document).on('click', '[data-kt-auditee-table-select="delete_selected"]', function() {
        const checkboxes = document.querySelectorAll('#kt_auditee_table tbody input[type="checkbox"]:checked');

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
                    url: "{{ route('auditee.destroySelected') }}",
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
        var url = "{{ route('auditee.hapus_permanen', ':id') }}";
        url = url.replace(':id', id);

        Swal.fire({
            title: 'Hapus Permanen?',
            text: "Data Auditee akan dihapus secara permanen dan tidak bisa dikembalikan.",
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

    $(document).on('click', '.ubah-password-btn', function () {
        const id = $(this).data('id');
        $('#passwordAuditeeId').val(id);
        $('#newPassword').val('');
        $('#confirmPassword').val('');
        $('#ubahPasswordModal').modal('show');
    });

    $('#ubahPasswordForm').submit(function (e) {
        e.preventDefault();

        const button = $('#buttonsubmit');
        const originalButtonText = button.text();

        button.prop('disabled', true);
        button.text('Sedang Memproses...');

        const id = $('#passwordAuditeeId').val();
        const formData = {
            password: $('#newPassword').val(),
            password_confirmation: $('#confirmPassword').val(),
            _method: 'PUT',
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: `/auditee/${id}/ubah-password`,
            method: 'POST',
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message
                });

                $('#ubahPasswordModal').modal('hide');
            },
            error: function (xhr) {
                let errorMessage = 'Terjadi kesalahan.';
                if (xhr.responseJSON?.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: errorMessage
                });
            },
            complete: function () {
                button.prop('disabled', false);
                button.text(originalButtonText);
            }
        });
    });
</script>
@endpush
