@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Periode Aktif
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Periode Aktif</li>
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
                                <span>Jika Anda ingin menghapus data Periode Aktif, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-unker-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Periode Aktif" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-unker-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Periode Aktif
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_unker_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-125px">Nomor Surat</th>
                                <th class="min-w-175px">Siklus</th>
                                <th class="min-w-125px">Tahun Ami</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($periodeAktifs as $index => $periodeAktif)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">{{ $index + 1 }}</td>
                                    <td>{{ $periodeAktif->nomor_surat }}</td>
                                    <td>{{ $periodeAktif->siklus }}</td>
                                    <td>{{ $periodeAktif->tahun_ami }}</td>
                                    <td class="text-center">
                                        @if ($periodeAktif->deleted_at)
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
                                            @if (!$periodeAktif->deleted_at)
                                                <button type="button" class="btn btn-sm btn-light-success edit-periodeAktif"
                                                    data-id="{{ $periodeAktif->id }}"
                                                    data-url="{{ route('periodeAktif.edit', $periodeAktif->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                    <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                                </button>
                                            @endif
                                            @if ($periodeAktif->deleted_at)
                                                <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $periodeAktif->id }}">
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-light-danger" disabled>
                                                    <i class="fas fa-ban fa-sm"></i>&nbsp;Nonaktifkan
                                                </button>
                                                <button type="button" class="btn btn-sm btn-light-danger" disabled>
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding: 0;">
                                        <div style="background-color: #ffecec; border-top: 2px dashed #dee2e6; padding: 1rem 1.25rem;">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <div class="fw-bold">↳ Jadwal Login Auditee & Auditor:</div>
                                                    @php
                                                        $loginJadwal = $periodeAktif->jadwal->where('jenis', 'login')->first();
                                                    @endphp
                                                    @if($loginJadwal)
                                                        <div class="text-success">
                                                            {{ \Carbon\Carbon::parse($loginJadwal->waktu_mulai)->format('d M Y') }} -
                                                            {{ \Carbon\Carbon::parse($loginJadwal->waktu_selesai)->format('d M Y') }}
                                                        </div>
                                                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-2 py-1 mt-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal"
                                                            data-jadwal="login"
                                                            data-periode-id="{{ $periodeAktif->id }}">
                                                            <i class="bi bi-pencil-square me-1"></i> Ubah Jadwal
                                                        </button>
                                                    @else
                                                        <div class="text-muted">Belum diatur</div>
                                                        <button type="button" class="btn btn-success btn-sm rounded-pill px-2 py-1 mt-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal"
                                                            data-jadwal="login"
                                                            data-periode-id="{{ $periodeAktif->id }}">
                                                            <i class="bi bi-calendar-plus me-1"></i> Atur Jadwal
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <div class="fw-bold">↳ Jadwal Audit Oleh Auditor:</div>
                                                    @php
                                                        $auditJadwal = $periodeAktif->jadwal->where('jenis', 'audit')->first();
                                                    @endphp
                                                    @if($auditJadwal)
                                                        <div class="text-success">
                                                            {{ \Carbon\Carbon::parse($auditJadwal->waktu_mulai)->format('d M Y') }} -
                                                            {{ \Carbon\Carbon::parse($auditJadwal->waktu_selesai)->format('d M Y') }}
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal" data-jadwal="audit" data-periode-id="{{ $periodeAktif->id }}">
                                                            Ubah
                                                        </button>
                                                    @else
                                                        <div class="text-muted">Belum diatur</div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal" data-jadwal="audit" data-periode-id="{{ $periodeAktif->id }}">
                                                            Atur
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <div class="fw-bold">↳ Jadwal Pengisian Data Oleh Auditee:</div>
                                                    @php
                                                        $dataJadwal = $periodeAktif->jadwal->where('jenis', 'data')->first();
                                                    @endphp
                                                    @if($dataJadwal)
                                                        <div class="text-success">
                                                            {{ \Carbon\Carbon::parse($dataJadwal->waktu_mulai)->format('d M Y') }} -
                                                            {{ \Carbon\Carbon::parse($dataJadwal->waktu_selesai)->format('d M Y') }}
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal" data-jadwal="data" data-periode-id="{{ $periodeAktif->id }}">
                                                            Ubah
                                                        </button>
                                                    @else
                                                        <div class="text-muted">Belum diatur</div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#aturJadwalModal" data-jadwal="data" data-periode-id="{{ $periodeAktif->id }}">
                                                            Atur
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
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
                <!-- Modal -->
                <div class="modal fade" id="aturJadwalModal" tabindex="-1" aria-labelledby="aturJadwalModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="jadwalForm" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="aturJadwalModalLabel">
                                        Atur Jadwal <span id="jadwalTitle"></span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Alert untuk menampilkan error -->
                                    <div class="alert alert-danger error-message" style="display: none;"></div>

                                    <input type="hidden" id="periodeId" name="periode_id" value="">
                                    <input type="hidden" id="jadwalType" name="jadwal" value="">

                                    <!-- Input Tanggal dengan Date Range -->
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Jadwal</label>
                                        <input type="text" class="form-control" id="dateRange" name="tanggal" placeholder="Pilih tanggal" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- Tombol Batal dengan warna merah -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <!-- Tombol Simpan -->
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.partials._modal_periode_aktif')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/periode_aktif/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#aturJadwalModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // tombol yang memicu modal
                var jadwalType = button.data('jadwal'); // Ambil data jadwal yang dikirim
                var periodeId = button.data('periode-id'); // Ambil periode id yang dikirim

                // Set nilai periode id dan jadwal type
                $('#periodeId').val(periodeId);
                $('#jadwalType').val(jadwalType);

                // Reset error message
                $('.error-message').hide().empty();

                // Menentukan teks untuk judul berdasarkan jenis jadwal
                var jadwalTitle;
                if (jadwalType === 'login') {
                    jadwalTitle = 'Login Auditee & Auditor';
                } else if (jadwalType === 'audit') {
                    jadwalTitle = 'Audit Oleh Auditor';
                } else if (jadwalType === 'data') {
                    jadwalTitle = 'Pengisian Data Oleh Auditee';
                }

                // Menampilkan teks pada modal
                $('#jadwalTitle').text(jadwalTitle);

                // Menginisialisasi date range picker jika belum
                $('#dateRange').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    opens: 'left',
                    autoUpdateInput: false // Tidak otomatis mengisi dengan tanggal hari ini
                });

                // Ketika user memilih tanggal, update input
                $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                });

                // Ketika user membatalkan pemilihan, kosongkan input
                $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

            // Handle form submission with AJAX
            $('#jadwalForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('periodeAktif.aturJadwal') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Tutup modal dan refresh halaman atau tampilkan pesan sukses
                            $('#aturJadwalModal').modal('hide');
                            // Bisa menambahkan toastr atau alert sukses di sini
                            alert(response.message);
                            location.reload(); // Refresh halaman untuk melihat perubahan
                        } else {
                            // Tampilkan pesan error jika ada
                            $('.error-message').html(response.message).show();
                        }
                    },
                    error: function(xhr) {
                        // Handle error validation atau server error
                        if (xhr.status === 422) {
                            // Validation errors
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '<ul>';

                            $.each(errors, function(key, value) {
                                errorMessage += '<li>' + value + '</li>';
                            });

                            errorMessage += '</ul>';
                            $('.error-message').html(errorMessage).show();
                        } else {
                            // Server error
                            $('.error-message').html('Terjadi kesalahan pada server. Silakan coba lagi.').show();
                        }
                    }
                });
            });
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
                        url: "{{ route('periodeAktif.restore', ':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data Periode Aktif berhasil dipulihkan.',
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

        $('.edit-periodeAktif').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('periodeAktif.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Periode Aktif');
            $('#kt_modal button[type=submit]').text('Update Data');

            // Ambil data Periode Aktif berdasarkan ID
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let data = response.data;

                        // Isi form dalam modal dengan data dari server
                        $('#kt_modal input[name="kode_periode_aktif"]').val(data.kode_periode_aktif);
                        $('#kt_modal input[name="nama_periode_aktif"]').val(data.nama_periode_aktif);
                        $('#kt_modal select[name="jenis_periode_aktif"]').val(data.jenis_periode_aktif);
                        $('#kt_modal select[name="jenjang"]').val(data.jenjang);

                        if (data.fakultas) {
                            $('#kt_modal select[name="fakultas"]').val(data.fakultas);
                        }

                        // Trigger change event pada jenis_periode_aktif untuk menampilkan/sembunyikan field tambahan
                        $('select[name="jenis_periode_aktif"]').trigger('change');

                        // Tampilkan field jenjang dan fakultas jika diperlukan (untuk mode edit)
                        if (data.jenis_periode_aktif === 'prodi') {
                            $('#jenjang_container').show();
                            $('#fakultas_container').show();
                        }
                    }
                },
                error: function() {
                    Swal.fire("Error", "Gagal mengambil data Periode Aktif", "error");
                }
            });
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-periodeAktif)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('periodeAktif.store') }}");
            $('#kt_modal .modal-title').text('Tambah Periode Aktif');
            $('#kt_modal button[type=submit]').text('Simpan');
            $('#jenjang_container').hide();
            $('#fakultas_container').hide();
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-periodeAktif', function() {
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
                        url: "{{ route('periodeAktif.nonaktifkan', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data Periode Aktif berhasil dinonaktifkan.',
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
                        url: "{{ route('periodeAktif.nonaktifkanSelected') }}",
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
            var url = "{{ route('periodeAktif.hapus_permanen', ':id') }}";
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
