@extends('layouts.dashboard2')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5 mb-5">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                    <i class="fas fa-info-circle fs-2"></i>
                </span>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">Pengisian Instrumen Program Studi</h4>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <span>Silakan isi instrumen yang telah ditetapkan untuk program studi {{ $unitKerja->nama_unit_kerja }}. Pastikan untuk mengisi semua instrumen dengan lengkap dan benar.</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->

            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Instrumen" />
                        </div>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    @if($indikatorInstrumens->isEmpty())
                        <div class="alert alert-info d-flex align-items-center p-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-info me-3">
                                <i class="fas fa-info-circle fs-2"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">Tidak Ada Instrumen</h4>
                                <span>Tidak ada instrumen yang perlu diisi untuk program studi ini.</span>
                            </div>
                        </div>
                    @else
                        <!--begin::Progress-->
                        <div class="card bg-light-primary mb-6">
                            <div class="card-body">
                                @php
                                    $totalInstrumen = $indikatorInstrumens->count();
                                    $completedInstrumen = $indikatorInstrumens->filter(function($instrumen) {
                                        return $instrumen->submission !== null;
                                    })->count();
                                    $progressPercentage = $totalInstrumen > 0 ? ($completedInstrumen / $totalInstrumen) * 100 : 0;
                                @endphp
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <span class="fs-5 fw-bold text-primary">Progress Pengisian</span>
                                    <span class="fs-5 fw-bold text-primary">{{ number_format($progressPercentage, 1) }}%</span>
                                </div>
                                <div class="h-8px w-100 bg-primary bg-opacity-50 rounded">
                                    <div class="h-8px bg-primary rounded" role="progressbar" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <span class="text-gray-600">{{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah diisi</span>
                                    @if($completedInstrumen === $totalInstrumen)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-primary">In Progress</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--end::Progress-->

                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="instrumenTable">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Indikator</th>
                                    <th class="min-w-100px">Nilai</th>
                                    <th class="min-w-200px">Deskripsi</th>
                                    <th class="min-w-150px">Dokumen Pendukung</th>
                                    <th class="min-w-100px text-end">Aksi</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                @foreach($indikatorInstrumens as $instrumen)
                                    <tr>
                                        <td>{{ $instrumen->nama_indikator }}</td>
                                        <td>
                                            @if($instrumen->submission)
                                                <span class="badge badge-light-success">{{ $instrumen->submission->nilai }}</span>
                                            @else
                                                <span class="badge badge-light-warning">Belum diisi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-{{ $instrumen->submission ? 'gray-800' : 'gray-500' }}">
                                                {{ $instrumen->submission ? $instrumen->submission->deskripsi : 'Belum diisi' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($instrumen->submission && $instrumen->submission->dokumen->count() > 0)
                                                <div class="d-flex flex-column gap-2">
                                                    @foreach($instrumen->submission->dokumen as $dokumen)
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-file-alt text-primary me-2"></i>
                                                            <a href="{{ Storage::url($dokumen->path) }}"
                                                               target="_blank"
                                                               class="text-primary text-hover-primary">
                                                                {{ $dokumen->nama_file }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="badge badge-light-warning">Belum ada dokumen</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button"
                                                    class="btn btn-sm {{ $instrumen->submission ? 'btn-light-primary' : 'btn-primary' }} btn-edit"
                                                    data-instrumen-id="{{ $instrumen->id }}"
                                                    data-nilai="{{ $instrumen->submission ? $instrumen->submission->nilai : '' }}"
                                                    data-deskripsi="{{ $instrumen->submission ? $instrumen->submission->deskripsi : '' }}">
                                                <i class="fas {{ $instrumen->submission ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                                                {{ $instrumen->submission ? 'Edit' : 'Isi' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    @endif
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->

    <!-- Modal -->
    <div class="modal fade" id="instrumenModal" tabindex="-1" aria-labelledby="instrumenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="instrumenForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="instrumenModalLabel">Pengisian Instrumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="instrumen_id" name="instrumen_id">

                        <!--begin::Alert-->
                        <div class="alert alert-primary d-flex align-items-center p-5 mb-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                                <i class="fas fa-info-circle fs-2"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <span>Silakan isi nilai dan deskripsi untuk instrumen ini. Anda juga dapat mengunggah dokumen pendukung jika diperlukan.</span>
                            </div>
                        </div>
                        <!--end::Alert-->

                        <div class="mb-5">
                            <label for="nilai" class="form-label required">Nilai</label>
                            <input type="number" class="form-control form-control-solid"
                                   id="nilai" name="nilai" min="0" max="100" required
                                   placeholder="Masukkan nilai (0-100)">
                            <div class="invalid-feedback" id="nilai-error"></div>
                        </div>
                        <div class="mb-5">
                            <label for="deskripsi" class="form-label required">Deskripsi</label>
                            <textarea class="form-control form-control-solid"
                                      id="deskripsi" name="deskripsi"
                                      rows="4" required
                                      placeholder="Masukkan deskripsi atau penjelasan"></textarea>
                            <div class="invalid-feedback" id="deskripsi-error"></div>
                        </div>
                        <div class="mb-5">
                            <label for="dokumen" class="form-label">Dokumen Pendukung</label>
                            <input type="file" class="form-control form-control-solid"
                                   id="dokumen" name="dokumen[]" multiple
                                   accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <div class="form-text text-muted">Format yang diperbolehkan: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB per file.</div>
                            <div class="invalid-feedback" id="dokumen-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable with search functionality
            const table = $('#instrumenTable').DataTable({
                "order": [[0, "asc"]],
                "pageLength": 25,
                "search": {
                    "smart": true
                },
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });

            // Connect search box to DataTable
            $('input[data-kt-filter="search"]').keyup(function() {
                table.search($(this).val()).draw();
            });

            // Handle edit button click
            $('.btn-edit').on('click', function() {
                const instrumenId = $(this).data('instrumen-id');
                const nilai = $(this).data('nilai');
                const deskripsi = $(this).data('deskripsi');

                $('#instrumen_id').val(instrumenId);
                $('#nilai').val(nilai);
                $('#deskripsi').val(deskripsi);

                // Reset form errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                $('#instrumenModal').modal('show');
            });

            // Handle form submission
            $('#instrumenForm').on('submit', function(e) {
                e.preventDefault();

                const instrumenId = $('#instrumen_id').val();
                const formData = new FormData(this);

                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...').prop('disabled', true);

                $.ajax({
                    url: `/auditee/submit-instrumen-prodi/${instrumenId}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            // Reset previous errors
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').text('');

                            // Show new errors
                            Object.keys(errors).forEach(function(key) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}-error`).text(errors[key][0]);
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
