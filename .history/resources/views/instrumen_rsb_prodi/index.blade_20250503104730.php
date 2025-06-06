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
                            <input type="text" data-kt-instrumenProdi-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Instrumen Rsb Prodi" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-instrumenProdi-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Instrumen Rsb Prodi
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-instrumenProdi-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-instrumenProdi-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-instrumenProdi-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_instrumenProdi_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                            <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_instrumenProdi_table .form-check-input" value="1" />
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
                                        <td>{{ $prodi->do }}</td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-info detail-instrumenProdi"
                                                    data-id="{{ $prodi->id }}"
                                                    data-url="{{ route('instrumenProdi.show', $prodi->id) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailInstrumen">
                                                    <i class="fas fa-info-circle fa-sm"></i>&nbsp;Detail
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
                <div class="modal fade" id="modalDetailInstrumen" tabindex="-1" aria-labelledby="modalDetailInstrumenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailInstrumenLabel">Detail Instrumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body" id="detailInstrumenContent">
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
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/instrumen_prodi/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.detail-instrumenProdi', function () {
            const url = $(this).data('url');

            $('#detailInstrumenContent').html('<div class="text-center">Memuat data...</div>');

            $.ajax({
                url: url,
                type: 'GET',
                success: function (res) {
                    let html = `
                        <table class="table table-borderless">
                            <tr><td style="width: 200px;"><strong>Kriteria</strong></td><td style="width: 10px;">:</td><td>${res.kriteria}</td></tr>
                            <tr><td><strong>Indikator</strong></td><td>:</td><td>${res.indikator}</td></tr>
                            <tr><td><strong>Elemen</strong></td><td>:</td><td>${res.elemen}</td></tr>
                            <tr><td><strong>Uraian</strong></td><td>:</td><td>${res.uraian}</td></tr>
                            <tr><td><strong>Sumber Data</strong></td><td>:</td><td>${res.sumber_data}</td></tr>
                            <tr><td><strong>Standar Digunakan</strong></td><td>:</td><td>${res.standar_digunakan}</td></tr>
                            <tr><td><strong>Metode Perhitungan</strong></td><td>:</td><td>${res.metode_perhitungan}</td></tr>
                            <tr><td><strong>Target</strong></td><td>:</td><td>${res.target}</td></tr>
                            <tr><td><strong>Indikator Penilaian</strong></td><td>:</td><td>${res.indikator_penilaian}</td></tr>
                        </table>
                    `;
                    $('#detailInstrumenContent').html(html);
                    $('#modalDetailInstrumen').modal('show');
                },
                error: function () {
                    $('#detailInstrumenContent').html('<div class="text-danger text-center">Gagal memuat data.</div>');
                }
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
                        url: "{{ route('instrumenProdi.restore', ':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data Instrumen Rsb Prodi berhasil dipulihkan.',
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

        $('.edit-instrumenProdi').click(function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Instrumen Rsb Prodi');
            $('#kt_modal button[type=submit]').text('Update Data');

            // Ambil data Instrumen Rsb Prodi berdasarkan ID
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let data = response.data;
                        console.log("Data dari server:", data);

                        // Simpan ID kriteria ke variabel global
                        savedKriteriaId = data.indikator_instrumen_kriteria_id;
                        console.log("Saved kriteria ID:", savedKriteriaId);

                        // Isi form dalam modal dengan data dari server
                        $('#kt_modal select[name="indikator_instrumen_id"]').val(data.indikator_instrumen_id).trigger('change');
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
                    Swal.fire("Error", "Gagal mengambil data Instrumen Rsb Prodi", "error");
                }
            });
        });

        // Tombol untuk menambah data baru (reset form)
        $('.add-instrumenProdi').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.store') }}");
            $('#kt_modal .modal-title').text('Tambah Instrumen Rsb Prodi');
            $('#kt_modal button[type=submit]').text('Simpan Data');

            // Reset savedKriteriaId ketika membuka form tambah
            savedKriteriaId = null;

            // Reset semua dropdown
            $('select[name="indikator_instrumen_kriteria_id"]').empty().append('<option disabled selected>-- pilih kriteria instrumen --</option>');
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-instrumenProdi)').click(function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.store') }}");
            $('#kt_modal .modal-title').text('Tambah Instrumen Rsb Prodi');
            $('#kt_modal button[type=submit]').text('Simpan');
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-instrumenProdi', function() {
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
                        url: "{{ route('instrumenProdi.nonaktifkan', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data Instrumen Rsb Prodi berhasil dinonaktifkan.',
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
        $(document).on('click', '[data-kt-instrumenProdi-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_instrumenProdi_table tbody input[type="checkbox"]:checked');
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
                        url: "{{ route('instrumenProdi.nonaktifkanSelected') }}",
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
            var url = "{{ route('instrumenProdi.hapus_permanen', ':id') }}";
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
