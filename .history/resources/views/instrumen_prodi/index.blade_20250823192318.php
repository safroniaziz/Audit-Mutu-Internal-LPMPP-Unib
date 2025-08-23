@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Instrumen Prodi
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Instrumen Prodi</li>
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
                                <span>Jika Anda ingin menghapus data Instrumen Prodi, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-instrumenProdi-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Instrumen Prodi" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-instrumenProdi-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Instrumen Prodi
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
                                    <th class="">Kriteria</th>
                                    <th class="">Indikator</th>
                                    <th class="">Elemen</th>
                                    <th class="">Standar Digunakan</th>
                                    <th class="">Status</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($instrumens as $index => $instrumen)
                                    <tr>
                                        <td class="w-10px pe-2 ps-4">
                                            <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                                <input class="form-check-input" type="checkbox" value="{{ $instrumen->id }}" />
                                            </div>
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $instrumen->kriteriaInstrumen->nama_kriteria }}</td>
                                        <td>{{ $instrumen->indikator }}</td>
                                        <td>{{ $instrumen->elemen }}</td>
                                        <td>{{ $instrumen->standar_digunakan }}</td>
                                        <td class="text-center">
                                            @if ($instrumen->deleted_at)
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
                                                @if (!$instrumen->deleted_at)
                                                    <button type="button"
                                                        class="btn btn-sm btn-light-info detail-instrumenProdi"
                                                        data-id="{{ $instrumen->id }}"
                                                        data-url="{{ route('instrumenProdi.show', $instrumen->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailInstrumen">
                                                        <i class="fas fa-info-circle fa-sm"></i>&nbsp;Detail
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-light-success edit-instrumenProdi"
                                                        data-id="{{ $instrumen->id }}"
                                                        data-url="{{ route('instrumenProdi.edit', $instrumen->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                        <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                                    </button>
                                                @endif
                                                @if ($instrumen->deleted_at)
                                                    <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $instrumen->id }}">
                                                        <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $instrumen->id }}">
                                                        <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-instrumenProdi" data-id="{{ $instrumen->id }}">
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
            @include('layouts.partials._modal_instrumen_prodi')
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

        console.log
        // Variabel global
        var savedKriteriaId = null;
        var isEditMode = false;

        // Fungsi untuk initialize CKEditor dengan callback
        function initializeCKEditorWithCallback(callback) {
            console.log('🚀 Initializing CKEditor...');

            // Destroy existing editors first
            if (window.editorInstances) {
                Object.keys(window.editorInstances).forEach(editorId => {
                    try {
                        if (window.editorInstances[editorId] && window.editorInstances[editorId].destroy) {
                            window.editorInstances[editorId].destroy();
                        }
                    } catch (e) {
                        console.log(`Warning: Could not destroy ${editorId}:`, e);
                    }
                });
                window.editorInstances = {};
            }

            // Initialize editors
            setTimeout(() => {
                initializeCKEditor(); // Your existing function

                // Wait for all editors to be ready, then call callback
                let checkReady = setInterval(() => {
                    const editorCount = window.editorInstances ? Object.keys(window.editorInstances).length : 0;
                    console.log(`⏳ Checking CKEditor readiness: ${editorCount}/5 editors ready`);

                    if (editorCount >= 5) {
                        clearInterval(checkReady);
                        console.log('✅ All CKEditor instances ready!');
                        if (callback) callback();
                    }
                }, 200);

                // Timeout fallback
                setTimeout(() => {
                    clearInterval(checkReady);
                    console.log('⚠️ CKEditor initialization timeout, proceeding anyway');
                    if (callback) callback();
                }, 5000);

            }, 300);
        }

        // Fungsi untuk populate CKEditor
        function populateCKEditorData(data) {
            console.log('📝 Populating CKEditor with data:', data);

            try {
                // 1. Uraian
                if (window.editorInstances && window.editorInstances['kt_docs_ckeditor_uraian']) {
                    window.editorInstances['kt_docs_ckeditor_uraian'].setData(data.uraian || '');
                    console.log('✅ Uraian populated');
                } else {
                    console.log('❌ Uraian editor not found');
                }

                // 2. Penyebab
                if (window.editorInstances && window.editorInstances['kt_docs_ckeditor_penyebab']) {
                    window.editorInstances['kt_docs_ckeditor_penyebab'].setData(data.penyebab_tidak_tercapai || '');
                    console.log('✅ Penyebab populated');
                } else {
                    console.log('❌ Penyebab editor not found');
                }

                // 3. Rencana
                if (window.editorInstances && window.editorInstances['kt_docs_ckeditor_rencana']) {
                    window.editorInstances['kt_docs_ckeditor_rencana'].setData(data.rencana_perbaikan || '');
                    console.log('✅ Rencana populated');
                } else {
                    console.log('❌ Rencana editor not found');
                }

                // 4. Penilaian
                if (window.editorInstances && window.editorInstances['kt_docs_ckeditor_penilaian']) {
                    window.editorInstances['kt_docs_ckeditor_penilaian'].setData(data.indikator_penilaian || '');
                    console.log('✅ Penilaian populated');
                } else {
                    console.log('❌ Penilaian editor not found');
                }

                // 5. Metode
                if (window.editorInstances && window.editorInstances['kt_docs_ckeditor_metode']) {
                    window.editorInstances['kt_docs_ckeditor_metode'].setData(data.metode_perhitungan || '');
                    console.log('✅ Metode populated');
                } else {
                    console.log('❌ Metode editor not found');
                }

                console.log('✅ CKEditor population complete!');
            } catch (error) {
                console.error('❌ Error populating CKEditor:', error);
            }
        }

        // Fungsi untuk clear semua CKEditor
        function clearAllCKEditors() {
            console.log('🧹 Clearing all CKEditor instances...');
            if (window.editorInstances) {
                Object.keys(window.editorInstances).forEach(editorId => {
                    try {
                        if (window.editorInstances[editorId] && window.editorInstances[editorId].setData) {
                            window.editorInstances[editorId].setData('');
                            console.log(`✅ Cleared ${editorId}`);
                        }
                    } catch (e) {
                        console.log(`❌ Error clearing ${editorId}:`, e);
                    }
                });
            }
        }

        // Event handler untuk detail instrumen
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

        // Event handler untuk EDIT - SOLUSI TERBARU
        $(document).on('click', '.edit-instrumenProdi', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');

            console.log('=== EDIT BUTTON CLICKED - COMPLETE SOLUTION ===');
            isEditMode = true;

            // 1. Set form properties untuk edit
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.update', '') }}/" + id);
            $('#kt_modal .modal-title').text('Edit Instrumen Prodi');
            $('#kt_modal button[type=submit]').text('Update Data');

            // 2. Reset form dan variables
            $('#kt_modal form')[0].reset();
            $('select[name="indikator_instrumen_kriteria_id"]').empty().append('<option disabled selected>-- pilih kriteria instrumen --</option>');
            savedKriteriaId = null;

            // 3. Show loading indicator
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 4. Initialize CKEditor dengan callback, kemudian fetch data
            initializeCKEditorWithCallback(function() {
                // Setelah CKEditor ready, fetch data dari server
                console.log('🔄 Fetching data from server for ID:', id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        console.log('📥 Data received from server:', response);

                        if (response.success) {
                            let data = response.data;

                            // Populate form fields
                            savedKriteriaId = data.indikator_instrumen_kriteria_id;
                            $('#kt_modal select[name="indikator_instrumen_id"]').val(data.indikator_instrumen_id).trigger('change');
                            $('#kt_modal input[name="elemen"]').val(data.elemen);
                            $('#kt_modal input[name="indikator"]').val(data.indikator);
                            $('#kt_modal input[name="sumber_data"]').val(data.sumber_data);
                            $('#kt_modal input[name="target"]').val(data.target);
                            $('#kt_modal input[name="realisasi"]').val(data.realisasi);
                            $('#kt_modal input[name="standar_digunakan"]').val(data.standar_digunakan);

                            // Populate CKEditor dengan data
                            setTimeout(() => {
                                populateCKEditorData(data);

                                // Close loading dan show modal
                                Swal.close();
                                $('#kt_modal').modal('show');

                                console.log('✅ Edit modal ready with populated data!');
                            }, 200);

                        } else {
                            Swal.fire('Error', 'Gagal memuat data instrumen', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('❌ Error fetching data:', error);
                        Swal.close();

                        if (xhr.status === 404) {
                            Swal.fire("Error", "Route tidak ditemukan. Silakan refresh halaman.", "error");
                        } else if (xhr.status === 401 || xhr.status === 403) {
                            Swal.fire("Error", "Anda tidak memiliki izin untuk mengakses data ini.", "error");
                        } else {
                            Swal.fire("Error", "Gagal mengambil data Instrumen Prodi: " + error, "error");
                        }
                    }
                });
            });
        });

        // Event handler untuk TAMBAH data baru
        $(document).on('click', 'button[data-bs-target="#kt_modal"]:not(.edit-instrumenProdi)', function() {
            console.log('=== ADD BUTTON CLICKED ===');
            isEditMode = false;

            // 1. Set form properties untuk add
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.store') }}");
            $('#kt_modal .modal-title').text('Tambah Instrumen Prodi');
            $('#kt_modal button[type=submit]').text('Simpan');

            // 2. Reset form dan variables
            $('#kt_modal form')[0].reset();
            $('select[name="indikator_instrumen_kriteria_id"]').empty().append('<option disabled selected>-- pilih kriteria instrumen --</option>');
            savedKriteriaId = null;

            // 3. Initialize CKEditor dan clear data
            initializeCKEditorWithCallback(function() {
                clearAllCKEditors();
                console.log('✅ Add modal ready with fresh form!');
            });
        });

        // Event handler untuk tombol close modal
        $(document).on('click', '#cancelModal, .btn-close, [data-bs-dismiss="modal"]', function() {
            console.log('=== MODAL CLOSE BUTTON CLICKED ===');
            resetModalToDefault();
        });

        // Event handler untuk ESC key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#kt_modal').hasClass('show')) {
                console.log('=== ESC KEY PRESSED ===');
                resetModalToDefault();
            }
        });

        // Event listener ketika modal hidden
        $('#kt_modal').on('hidden.bs.modal', function () {
            console.log('=== MODAL HIDDEN EVENT ===');
            resetModalToDefault();
        });

        // Fungsi untuk reset modal ke default state
        function resetModalToDefault() {
            console.log('🔄 Resetting modal to default state...');

            // Reset form properties
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('instrumenProdi.store') }}");
            $('#kt_modal .modal-title').text('Tambah Instrumen Prodi');
            $('#kt_modal button[type=submit]').text('Simpan Data');

            // Reset variables
            savedKriteriaId = null;
            isEditMode = false;

            // Reset form
            $('#kt_modal form')[0].reset();
            $('select[name="indikator_instrumen_kriteria_id"]').empty().append('<option disabled selected>-- pilih kriteria instrumen --</option>');

            // Clear CKEditor
            clearAllCKEditors();

            console.log('✅ Modal reset complete!');
        }

        // Event handler untuk restore data
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
                                text: 'Data Instrumen Prodi berhasil dipulihkan.',
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

        // Event handler untuk nonaktifkan data
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
                                text: 'Data Instrumen Prodi berhasil dinonaktifkan.',
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

        // Event handler untuk hapus permanen
        $(document).on('click', '.delete-permanent', function () {
            var id = $(this).data('id');
            var url = "{{ route('instrumenProdi.hapus_permanen', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Hapus Permanen?',
                text: "Data Instrumen akan dihapus secara permanen dan tidak bisa dikembalikan.",
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
