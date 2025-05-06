@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Indikator Kinerja Fakultas
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Indikator Kinerja Fakultas</li>
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
                                <h4 class="mb-1 text-danger">Pemberitahuan Penting</h4>
                                <span>Harap segera tambahkan data Indikator Kinerja pada setiap Fakultas yang tersedia.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-rsbFakultas-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Indikator Kinerja Fakultas" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-rsbFakultas-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Indikator Kinerja Fakultas
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_rsbFakultas_table">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                    <th class=" ps-4">No</th>
                                    <th class="">Kode Fakultas</th>
                                    <th class="">Nama Fakultas</th>
                                    <th class="">Jumlah Indikator Kinerja</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($fakultas as $index => $fakultas)
                                    <tr style="background-color: {{ $fakultas->indikator_kinerjas_count == 0 ? '#FFEEF3' : 'transparent' }};">
                                        <td class="w-10px pe-2 ps-4">{{ $index + 1 }}</td>
                                        <td>{{ $fakultas->kode_unit_kerja }}</td>
                                        <td>{{ $fakultas->nama_unit_kerja }}</td>
                                        <td>{{ $fakultas->indikator_kinerjas_count }} Data</td>
                                        <td class="text-center">
                                            <div class="button-container">
                                                <button type="button"
                                                        class="btn btn-sm btn-light-primary detail-rsbFakultas"
                                                        data-id="{{ $fakultas->id }}"
                                                        data-url="{{ route('rsbFakultas.modal', $fakultas->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modelTambahIndikatorKinerja">
                                                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah Indikator Fakultas
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
                <div class="modal fade" id="modelTambahIndikatorKinerja" tabindex="-1" aria-labelledby="modelTambahIndikatorRsbLabel" aria-hidden="true" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelTambahIndikatorRsbLabel">Indikator Fakultas: <span id="fakultas-name"></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form untuk menambah indikator -->
                                <form id="form-tambah-indikator" class="mb-4">
                                    <input type="hidden" id="unit_kerja_id" name="unit_kerja_id">

                                    <!-- Dropdown untuk Satuan Standar -->
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-select" id="satuan_standar_id" name="satuan_standar_id" required>
                                                <option value="">Pilih Satuan Standar</option>
                                                @foreach ($satuanStandars as $satuan)
                                                    <option value="{{ $satuan->id }}">{{ $satuan->kode_satuan }} - {{ $satuan->sasaran }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dropdown untuk Indikator Kinerja -->
                                    <div class="row mb-3">
                                        <div class="col-md-9">
                                            <select class="form-select" id="indikator_ikss_id" name="indikator_ikss_id" required>
                                                <option value="">Pilih Indikator Kinerja</option>
                                                <!-- Options akan diisi lewat JavaScript -->
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary w-100">Tambah Indikator</button>
                                        </div>
                                    </div>

                                </form>

                                <!-- Tabel indikatoe yang dimiliki -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Kode Indikator</th>
                                                <th>Tujuan</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="indikator-list">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Message for empty indikator -->
                                <div id="empty-indikator-message" class="alert alert-info d-none">
                                    Fakultaas ini belum memiliki Indikator Kinerja.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/rsb_fakultas/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Deteksi ketika modal ditutup (baik klik tombol "Tutup" atau klik luar)
        $('#modelTambahIndikatorKinerja').on('hidden.bs.modal', function () {
            window.location.reload();
        });

        // Ketika Satuan Standar dipilih
        $('#satuan_standar_id').on('change', function () {
            let satuanId = $(this).val();
            let $indikatorSelect = $('#indikator_ikss_id');

            $indikatorSelect.empty().append('<option value="">Pilih Indikator Kinerja</option>');

            if (satuanId) {
                $.ajax({
                    url: `/rsb-fakultas/get-indikator-by-satuan/${satuanId}`,
                    type: 'GET',
                    success: function (data) {
                        data.forEach(function (item) {
                            $indikatorSelect.append(`<option value="${item.id}">${item.kode_ikss} - ${item.tujuan}</option>`);
                        });
                    },
                    error: function () {
                        alert('Gagal mengambil data indikator.');
                    }
                });
            }
        });

        // Ketika Indikator Kinerja dipilih
        $('#indikator_ikss_id').on('change', function () {
            let indikatorId = $(this).val();


            if (indikatorId) {
                $.ajax({
                    url: `/rsb-fakultas/get-indikator-by-indikator/${indikatorId}`,
                    type: 'GET',
                    success: function (data) {
                        data.forEach(function (item) {
                        });
                    },
                    error: function () {
                        alert('Gagal mengambil data indikator.');
                    }
                });
            }
        });

        // Fungsi untuk memperbarui tabel utama di halaman (di luar modal)
        function updateMainTable(unitKerjaId) {
                // Cari tabel utama yang perlu diupdate
                // Bisa disesuaikan dengan struktur HTML Anda

                // Opsi 1: Jika halaman perlu di-refresh seluruhnya
                // window.location.reload();

                // Opsi 2: Jika ada AJAX endpoint untuk mendapatkan baris tabel baru
                /*
                $.ajax({
                    url: '/get-updated-row/' + unitKerjaId,  // Sesuaikan dengan route Anda
                    type: 'GET',
                    success: function(response) {
                        // Update baris tabel dengan ID tertentu
                        $('#row-unit-kerja-' + unitKerjaId).replaceWith(response.html);
                    }
                });
                */
            }$(document).ready(function() {
            // Event listener untuk tombol detail
            $(document).on('click', '.detail-rsbFakultas', function() {
                const url = $(this).data('url');
                const unitKerjaId = $(this).data('id');

                // Reset form
                $('#form-tambah-indikator')[0].reset();
                $('#unit_kerja_id').val(unitKerjaId);

                // Tampilkan loading
                $('#indikator-list').html('<tr><td colspan="6" class="text-center">Memuat data...</td></tr>');
                $('#indikator_ikss_id').html('<option value="">Memuat data...</option>');

                // Ambil data dari server
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log("Response data:", response);

                        $('#fakultas-name').text(response.fakultas.nama_unit_kerja);

                        // Buat array ID indikator yang sudah terpasang
                        const indikatorTerpasang = response.indikator_terpasang || [];
                        const semuaIndikator = response.semua_indikator || [];

                        console.log("Indikator terpasang:", instrumenTerpasang);
                        console.log("Semua indikator:", semuaInstrumen);

                        const terpasangIds = instrumenTerpasang.map(item => item.id);

                        // Reset dan populate dropdown dengan Indikator yang belum terpasang
                        $('#indikator_kinerja_id').empty().append('<option value="">-- pilih Indikator Rsb --</option>');

                        let countAvailable = 0;

                        // Menambahkan Indikator yang belum terpasang ke dropdown
                        semuaInstrumen.forEach(Indikator => {
                            if (!terpasangIds.includes(indikator.id)) {
                                countAvailable++;
                                $('#indikator_kinerja_id').append(
                                    `<option value="${indikator.id}">${indikator.indikator}</option>`
                                );
                            }
                        });

                        console.log("Jumlah Indikator tersedia:", countAvailable);

                        // Jika tidak ada Indikator yang tersedia
                        if (countAvailable === 0) {
                            $('#indikator_kinerja_id').append('<option value="" disabled>Semua indikator sudah terpasang</option>');
                        }

                        // Populate tabel indikator terpasang
                        $('#indikator-list').empty();

                        if (indikatorTerpasang.length > 0) {
                            $('#empty-indikator-message').addClass('d-none');

                            indikatorTerpasang.forEach((indikator, index) => {
                                $('#indikator-list').append(`
                                    <tr>
                                        <td class="text-center">${index + 1}</td>
                                        <td>${indikator.kode_ikss}</td>
                                        <td>${indikator.tujuan}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger hapus-indikator"
                                                    data-unit-kerja-id="${unitKerjaId}"
                                                    data-indikator-id="${indikator.id}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#empty-indikator-message').removeClass('d-none');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        $('#indikator-list').html('<tr><td colspan="6" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
                        $('#indikator_kinerja_id').html('<option value="">Error memuat data</option>');
                        alert('Terjadi kesalahan saat memuat data');
                    }
                });
            });

            // Event listener untuk form tambah indikator
            $('#form-tambah-indikator').on('submit', function(e) {
                e.preventDefault();

                const unitKerjaId = $('#unit_kerja_id').val();
                const indikatorId = $('#indikator_kinerja_id').val();

                // Ambil URL dari button yang memicu modal
                const modalUrl = $('.detail-rsbFakultas[data-id="' + unitKerjaId + '"]').data('url');

                if (!indikatorId) {
                    alert('Silakan pilih indikator terlebih dahulu');
                    return;
                }

                // Tampilkan loading
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Proses...');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('rsbFakultas.tambahIndikator') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit_kerja_id: unitKerjaId,
                        indikator_kinerja_id: instrumenId
                    },
                    success: function(response) {
                        console.log("Tambah indikator response:", response);

                        // Tampilkan pesan sukses
                        alert(response.message);

                        // Reset form
                        $('#form-tambah-indikator')[0].reset();

                        // Ambil data baru dari server untuk update tabel dan dropdown
                        $.ajax({
                            url: modalUrl,
                            type: 'GET',
                            dataType: 'json',
                            success: function(modalResponse) {
                                // Update modal content
                                updateModalContent(modalResponse, unitKerjaId);

                                // Update tabel utama (di luar modal) jika ada
                                updateMainTable(unitKerjaId);
                            },
                            error: function(xhr) {
                                console.error('Error refreshing data:', xhr);
                                alert('Berhasil menambahkan indikator, tetapi gagal memperbarui tampilan');
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat menambah indikator');
                    },
                    complete: function() {
                        // Kembalikan tombol ke kondisi semula
                        submitBtn.html(originalText);
                        submitBtn.prop('disabled', false);
                    }
                });
            });

            // Event listener untuk hapus indikator
            $(document).on('click', '.hapus-indikator', function() {
                if (!confirm('Apakah Anda yakin ingin menghapus indikator ini?')) {
                    return;
                }

                const unitKerjaId = $(this).data('unit-kerja-id');
                const indikatorId = $(this).data('indikator-id');

                // Simpan URL untuk refresh
                const modalUrl = $('.detail-rsbFakultas[data-id="' + unitKerjaId + '"]').data('url');

                // Disable tombol dan tambahkan loading spinner
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('rsbFakultas.hapusIndikator') }}",
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit_kerja_id: unitKerjaId,
                        indikator_kinerja_id: instrumenId
                    },
                    success: function(response) {
                        console.log("Hapus indikator response:", response);

                        // Tampilkan pesan sukses
                        alert(response.message);

                        // Ambil data baru dari server untuk update tabel dan dropdown
                        $.ajax({
                            url: modalUrl,
                            type: 'GET',
                            dataType: 'json',
                            success: function(modalResponse) {
                                // Update modal content
                                updateModalContent(modalResponse, unitKerjaId);

                                // Update tabel utama (di luar modal) jika ada
                                updateMainTable(unitKerjaId);
                            },
                            error: function(xhr) {
                                console.error('Error refreshing data:', xhr);
                                alert('Berhasil menghapus indikator, tetapi gagal memperbarui tampilan');
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat menghapus indikator');
                    },
                    complete: function() {
                        // Kembalikan tombol ke kondisi semula
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }
                });
            });

            // Fungsi untuk memperbarui konten modal tanpa menutup modal
            function updateModalContent(response, unitKerjaId) {
                console.log("Memperbarui konten modal dengan data:", response);

                $('#fakultas-name').text(response.fakultas.nama_unit_kerja);

                // Buat array ID indikator yang sudah terpasang
                const indikatorTerpasang = response.indikator_terpasang || [];
                const semuaIndikator = response.semua_indikator || [];

                const terpasangIds = indikatorTerpasang.map(item => item.id);

                // Reset dan populate dropdown dengan indikator yang belum terpasang
                $('#indikator_kinerja_id').empty().append('<option value="">-- pilih indikator Rsb --</option>');

                let countAvailable = 0;

                // Menambahkan indikator yang belum terpasang ke dropdown
                semuaIndikator.forEach(indikator => {
                    if (!terpasangIds.includes(indikator.id)) {
                        countAvailable++;
                        $('#indikator_kinerja_id').append(
                            `<option value="${indikator.id}">${indikator.indikator}</option>`
                        );
                    }
                });

                // Jika tidak ada indikator yang tersedia
                if (countAvailable === 0) {
                    $('#indikator_kinerja_id').append('<option value="" disabled>Semua indikator sudah terpasang</option>');
                }

                // Populate tabel indikator terpasang
                $('#indikator-list').empty();

                if (indikatorTerpasang.length > 0) {
                    $('#empty-indikator-message').addClass('d-none');

                    indikatorTerpasang.forEach((indikator, index) => {
                        $('#indikator-list').append(`
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${indikator.kode_ikss}</td>
                                <td>${indikator.tujuan}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger hapus-indikator"
                                            data-unit-kerja-id="${unitKerjaId}"
                                            data-indikator-id="${indikator.id}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#empty-indikator-message').removeClass('d-none');
                }
            }
        });
    </script>
@endpush
