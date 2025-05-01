@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Indikator Kinerja
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Indikator Kinerja</li>
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
                                <span>Jika Anda ingin menghapus data Indikator Kinerja, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-indikatorKinerja-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Indikator Kinerja" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-indikatorKinerja-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Indikator Kinerja
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-indikatorKinerja-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-indikatorKinerja-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-indikatorKinerja-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_indikatorKinerja_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                            <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_indikatorKinerja_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class=" ps-3">No</th>
                                    <th class="">Kriteria</th>
                                    <th class="">Indikator</th>
                                    <th class="">Elemen</th>
                                    <th class="">Standar Digunakan</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($indikatorKinerjas as $index => $indikatorKinerja)
                                    <tr>
                                        <td class="w-10px pe-2 ps-4">
                                            <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                                <input class="form-check-input" type="checkbox" value="{{ $indikatorKinerja->id }}" />
                                            </div>
                                        </td>
                                        <td>{{ $indikatorKinerja->kriteriaindikatorKinerja->nama_kriteria }}</td>
                                        <td>{{ $indikatorKinerja->indikator }}</td>
                                        <td>{{ $indikatorKinerja->elemen }}</td>
                                        <td>{{ $indikatorKinerja->standar_digunakan }}</td>
                                        <td class="text-center">
                                            @if ($indikatorKinerja->deleted_at)
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
                                                <button type="button"
                                                    class="btn btn-sm btn-light-info detail-indikatorKinerja"
                                                    data-id="{{ $indikatorKinerja->id }}"
                                                    data-url="{{ route('indikatorKinerja.show', $indikatorKinerja->id) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailindikatorKinerja">
                                                    <i class="fas fa-info-circle fa-sm"></i>&nbsp;Detail
                                                </button>
                                                <button type="button" class="btn btn-sm btn-light-success edit-indikatorKinerja"
                                                    data-id="{{ $indikatorKinerja->id }}"
                                                    data-url="{{ route('indikatorKinerja.edit', $indikatorKinerja->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                    <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                                </button>
                                                @if ($indikatorKinerja->deleted_at)
                                                    <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $indikatorKinerja->id }}">
                                                        <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $indikatorKinerja->id }}">
                                                        <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-indikatorKinerja" data-id="{{ $indikatorKinerja->id }}">
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
                <div class="modal fade" id="modalDetailindikatorKinerja" tabindex="-1" aria-labelledby="modalDetailindikatorKinerjaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailindikatorKinerjaLabel">Detail indikatorKinerja</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body" id="detailindikatorKinerjaContent">
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
            @include('layouts.partials._modal_indikator_kinerja_prodi')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/indikator_kinerja/list/list.js') }}"></script>

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
                        url: "{{ route('indikatorKinerja.restore', ':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data Indikator Kinerja berhasil dipulihkan.',
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

        var savedKriteriaId = null;

        $('.edit-indikatorKinerja').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('indikatorKinerja.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Indikator Kinerja');
            $('#kt_modal button[type=submit]').text('Update Data');

            // Ambil data Indikator Kinerja berdasarkan ID
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let data = response.data;
                        console.log("Data dari server:", data);

                        // Simpan ID kriteria ke variabel global
                        savedKriteriaId = data.indikator_indikatorKinerja_kriteria_id;
                        console.log("Saved kriteria ID:", savedKriteriaId);

                        // Isi form dalam modal dengan data dari server
                        $('#kt_modal select[name="indikator_indikatorKinerja_id"]').val(data.indikator_indikatorKinerja_id).trigger('change');
                        $('#kt_modal input[name="elemen"]').val(data.elemen);
                        $('#kt_modal input[name="indikator"]').val(data.indikator);
                        $('#kt_modal input[name="sumber_data"]').val(data.sumber_data);
                        $('#kt_modal input[name="metode_perhitungan"]').val(data.metode_perhitungan);
                        $('#kt_modal input[name="target"]').val(data.target);
                        $('#kt_modal input[name="realisasi"]').val(data.realisasi);
                        $('#kt_modal input[name="standar_digunakan"]').val(data.standar_digunakan);
                        $('#kt_modal textarea[name="uraian"]').val(data.uraian);
                        $('#kt_modal textarea[name="penyebab_tidak_tercapai"]').val(data.penyebab_tidak_tercapai);
                        $('#kt_modal textarea[name="rencana_perbaikan"]').val(data.rencana_perbaikan);
                        $('#kt_modal textarea[name="indikator_penilaian"]').val(data.indikator_penilaian);
                    }
                },
                error: function() {
                    Swal.fire("Error", "Gagal mengambil data Indikator Kinerja", "error");
                }
            });
        });

        // Tombol untuk menambah data baru (reset form)
        $('.add-indikatorKinerja').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('indikatorKinerja.store') }}");
            $('#kt_modal .modal-title').text('Tambah Indikator Kinerja');
            $('#kt_modal button[type=submit]').text('Simpan Data');

            // Reset savedKriteriaId ketika membuka form tambah
            savedKriteriaId = null;

            // Reset semua dropdown
            $('select[name="indikator_indikatorKinerja_kriteria_id"]').empty().append('<option disabled selected>-- pilih kriteria indikatorKinerja --</option>');
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-indikatorKinerja)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('indikatorKinerja.store') }}");
            $('#kt_modal .modal-title').text('Tambah Indikator Kinerja');
            $('#kt_modal button[type=submit]').text('Simpan');
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-indikatorKinerja', function() {
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
                        url: "{{ route('indikatorKinerja.nonaktifkan', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data Indikator Kinerja berhasil dinonaktifkan.',
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
        $(document).on('click', '[data-kt-indikatorKinerja-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_indikatorKinerja_table tbody input[type="checkbox"]:checked');
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
                        url: "{{ route('indikatorKinerja.nonaktifkanSelected') }}",
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
            var url = "{{ route('indikatorKinerja.hapus_permanen', ':id') }}";
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
