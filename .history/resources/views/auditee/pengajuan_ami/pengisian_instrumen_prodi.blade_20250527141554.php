@extends('layouts.dashboard2')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Pengisian Instrumen Program Studi</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    @if($indikatorInstrumens->isEmpty())
                        <div class="alert alert-info">
                            Tidak ada instrumen yang perlu diisi untuk program studi ini.
                        </div>
                    @else
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
                                            <span class="nilai-display {{ $instrumen->submission ? '' : 'text-muted' }}">
                                                {{ $instrumen->submission ? $instrumen->submission->nilai : 'Belum diisi' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="deskripsi-display {{ $instrumen->submission ? '' : 'text-muted' }}">
                                                {{ $instrumen->submission ? $instrumen->submission->deskripsi : 'Belum diisi' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($instrumen->submission && $instrumen->submission->dokumen->count() > 0)
                                                @foreach($instrumen->submission->dokumen as $dokumen)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-file-alt me-2"></i>
                                                        <a href="{{ Storage::url($dokumen->path) }}" target="_blank">
                                                            {{ $dokumen->nama_file }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="text-muted">Belum ada dokumen</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-primary btn-edit"
                                                    data-instrumen-id="{{ $instrumen->id }}"
                                                    data-nilai="{{ $instrumen->submission ? $instrumen->submission->nilai : '' }}"
                                                    data-deskripsi="{{ $instrumen->submission ? $instrumen->submission->deskripsi : '' }}">
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
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100" required>
                            <div class="invalid-feedback" id="nilai-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            <div class="invalid-feedback" id="deskripsi-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Dokumen Pendukung</label>
                            <input type="file" class="form-control" id="dokumen" name="dokumen[]" multiple
                                   accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <div class="form-text">Format yang diperbolehkan: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB per file.</div>
                            <div class="invalid-feedback" id="dokumen-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#instrumenTable').DataTable({
                "order": [[0, "asc"]],
                "pageLength": 25,
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
