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
                            <input type="text" data-kt-rsbProdi-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Instrumen Rsb Prodi" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-rsbProdi-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Instrumen Rsb Prodi
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-rsbProdi-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-rsbProdi-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-rsbProdi-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_rsbProdi_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                            <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_rsbProdi_table .form-check-input" value="1" />
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
                                        <td>{{ $prodi->instrumen_ikss_count }} Data</td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary detail-rsbProdi"
                                                    data-id="{{ $prodi->id }}"
                                                    data-url="{{ route('rsbProdi.modal', $prodi->id) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modelTambahInstrumenRsb">
                                                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah Instrumen Prodi
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
                <!-- Modal -->
                <div class="modal fade" id="modelTambahInstrumenRsb" tabindex="-1" aria-labelledby="modelTambahInstrumenRsbLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelTambahInstrumenRsbLabel">Instrumen Program Studi: <span id="prodi-name"></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form untuk menambah instrumen -->
                                <form id="form-tambah-instrumen" class="mb-4">
                                    <input type="hidden" id="unit_kerja_id" name="unit_kerja_id">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-select" id="instrumen_ikss_id" name="instrumen_ikss_id" required>
                                                <option value="">Pilih Instrumen IKS</option>
                                                <!-- Options will be populated by JavaScript -->
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary w-100">Tambah Instrumen</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Tabel instrumen yang dimiliki -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Indikator</th>
                                                <th>Pertanyaan</th>
                                                <th>Target</th>
                                                <th>Satuan</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="instrumen-list">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Message for empty instrumen -->
                                <div id="empty-instrumen-message" class="alert alert-info d-none">
                                    Program studi ini belum memiliki instrumen IKS.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/rsb_prodi/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Event listener untuk tombol detail
            $(document).on('click', '.detail-rsbProdi', function() {
                const url = $(this).data('url');
                const unitKerjaId = $(this).data('id');

                // Reset form
                $('#form-tambah-instrumen')[0].reset();
                $('#unit_kerja_id').val(unitKerjaId);

                // Ambil data dari server
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Set nama prodi
                        $('#prodi-name').text(response.prodi.nama_unit_kerja);

                        // Populate instrumen dropdown (hanya tampilkan yang belum dimiliki)
                        const instrumenTerpasang = response.instrumen_terpasang;
                        const semuaInstrumen = response.semua_instrumen;

                        // Buat array ID instrumen yang sudah terpasang
                        const terpasangIds = instrumenTerpasang.map(item => item.id);

                        // Reset dan populate dropdown dengan instrumen yang belum terpasang
                        $('#instrumen_ikss_id').empty().append('<option value="">Pilih Instrumen IKS</option>');

                        semuaInstrumen.forEach(instrumen => {
                            if (!terpasangIds.includes(instrumen.id)) {
                                $('#instrumen_ikss_id').append(
                                    `<option value="${instrumen.id}">${instrumen.kode} - ${instrumen.nama}</option>`
                                );
                            }
                        });

                        // Populate tabel instrumen terpasang
                        $('#instrumen-list').empty();

                        if (instrumenTerpasang.length > 0) {
                            $('#empty-instrumen-message').addClass('d-none');
                            let counter = 0;

                            instrumenTerpasang.forEach((instrumen, index) => {
                                $('#instrumen-list').append(`
                                    <tr>
                                        <td class="text-center">${index + 1}</td>
                                        <td>${instrumen.indikator}</td>
                                        <td>${instrumen.pertanyaan}</td>
                                        <td class="text-center">${instrumen.target}</td>
                                        <td>${instrumen.satuan}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger hapus-instrumen"
                                                    data-unit-kerja-id="${unitKerjaId}"
                                                    data-instrumen-id="${instrumen.id}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#empty-instrumen-message').removeClass('d-none');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat memuat data');
                    }
                });
            });

            // Event listener untuk form tambah instrumen
            $('#form-tambah-instrumen').on('submit', function(e) {
                e.preventDefault();

                const unitKerjaId = $('#unit_kerja_id').val();
                const instrumenId = $('#instrumen_ikss_id').val();

                if (!instrumenId) {
                    alert('Silakan pilih instrumen terlebih dahulu');
                    return;
                }

                $.ajax({
                    url: "{{ route('rsbProdi.tambahInstrumen') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit_kerja_id: unitKerjaId,
                        instrumen_ikss_id: instrumenId
                    },
                    success: function(response) {
                        // Reload modal data to refresh the list
                        $('.detail-rsbProdi[data-id="' + unitKerjaId + '"]').click();
                        alert(response.message);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat menambah instrumen');
                    }
                });
            });

            // Event listener untuk hapus instrumen
            $(document).on('click', '.hapus-instrumen', function() {
                if (!confirm('Apakah Anda yakin ingin menghapus instrumen ini?')) {
                    return;
                }

                const unitKerjaId = $(this).data('unit-kerja-id');
                const instrumenId = $(this).data('instrumen-id');

                $.ajax({
                    url: "{{ route('rsbProdi.hapusInstrumen') }}",
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit_kerja_id: unitKerjaId,
                        instrumen_ikss_id: instrumenId
                    },
                    success: function(response) {
                        // Reload modal data to refresh the list
                        $('.detail-rsbProdi[data-id="' + unitKerjaId + '"]').click();
                        alert(response.message);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat menghapus instrumen');
                    }
                });
            });
        });

    </script>
@endpush
