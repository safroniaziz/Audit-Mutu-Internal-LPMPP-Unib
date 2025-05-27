@extends('auditee/dashboard_template')

@section('content')
    <div class="page-heading">
        <h3>Pengisian Instrumen Program Studi</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Instrumen Program Studi {{ $unitKerja->nama_unit_kerja }}</h4>
                        <p class="text-subtitle text-muted">Silakan isi instrumen yang telah ditetapkan untuk program studi Anda.</p>
                    </div>

                    <div class="card-body">
                        @if($indikatorInstrumens->isEmpty())
                            <div class="alert alert-light-warning color-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                Tidak ada instrumen yang perlu diisi untuk program studi ini.
                            </div>
                        @else
                            <!--begin::Progress-->
                            <div class="alert alert-light-primary color-primary mb-4">
                                @php
                                    $totalInstrumen = $indikatorInstrumens->count();
                                    $completedInstrumen = $indikatorInstrumens->filter(function($instrumen) {
                                        return $instrumen->submission !== null;
                                    })->count();
                                    $progressPercentage = $totalInstrumen > 0 ? ($completedInstrumen / $totalInstrumen) * 100 : 0;
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Progress Pengisian</span>
                                    <span>{{ number_format($progressPercentage, 1) }}%</span>
                                </div>
                                <div class="progress progress-primary">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small>{{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah diisi</small>
                                    @if($completedInstrumen === $totalInstrumen)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-primary">In Progress</span>
                                    @endif
                                </div>
                            </div>
                            <!--end::Progress-->

                            <div class="table-responsive">
                                <table class="table table-hover" id="instrumenTable">
                                    <thead>
                                        <tr>
                                            <th>Indikator</th>
                                            <th>Nilai</th>
                                            <th>Deskripsi</th>
                                            <th>Dokumen Pendukung</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indikatorInstrumens as $instrumen)
                                            <tr>
                                                <td>{{ $instrumen->nama_indikator }}</td>
                                                <td>
                                                    @if($instrumen->submission)
                                                        <span class="badge bg-success">{{ $instrumen->submission->nilai }}</span>
                                                    @else
                                                        <span class="badge bg-warning">Belum diisi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="{{ $instrumen->submission ? '' : 'text-muted' }}">
                                                        {{ $instrumen->submission ? $instrumen->submission->deskripsi : 'Belum diisi' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($instrumen->submission && $instrumen->submission->dokumen->count() > 0)
                                                        <div class="d-flex flex-column gap-2">
                                                            @foreach($instrumen->submission->dokumen as $dokumen)
                                                                <div class="d-flex align-items-center">
                                                                    <i class="bi bi-file-earmark-text me-2"></i>
                                                                    <a href="{{ Storage::url($dokumen->path) }}"
                                                                       target="_blank"
                                                                       class="text-primary">
                                                                        {{ $dokumen->nama_file }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="badge bg-light-warning">Belum ada dokumen</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                            class="btn btn-sm {{ $instrumen->submission ? 'btn-outline-primary' : 'btn-primary' }} btn-edit"
                                                            data-instrumen-id="{{ $instrumen->id }}"
                                                            data-nilai="{{ $instrumen->submission ? $instrumen->submission->nilai : '' }}"
                                                            data-deskripsi="{{ $instrumen->submission ? $instrumen->submission->deskripsi : '' }}">
                                                        <i class="bi {{ $instrumen->submission ? 'bi-pencil' : 'bi-plus' }}"></i>
                                                        {{ $instrumen->submission ? 'Edit' : 'Isi' }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="instrumenModal" tabindex="-1" aria-labelledby="instrumenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="instrumenModalLabel">Pengisian Instrumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="instrumenForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="instrumen_id" name="instrumen_id">

                        <div class="alert alert-light-primary color-primary mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Silakan isi nilai dan deskripsi untuk instrumen ini. Anda juga dapat mengunggah dokumen pendukung jika diperlukan.
                        </div>

                        <div class="form-group mb-4">
                            <label for="nilai" class="form-label">Nilai <span class="text-danger">*</span></label>
                            <input type="number" class="form-control"
                                   id="nilai" name="nilai" min="0" max="100" required
                                   placeholder="Masukkan nilai (0-100)">
                            <div class="invalid-feedback" id="nilai-error"></div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control"
                                      id="deskripsi" name="deskripsi"
                                      rows="4" required
                                      placeholder="Masukkan deskripsi atau penjelasan"></textarea>
                            <div class="invalid-feedback" id="deskripsi-error"></div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="dokumen" class="form-label">Dokumen Pendukung</label>
                            <input type="file" class="form-control"
                                   id="dokumen" name="dokumen[]" multiple
                                   accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <div class="text-muted small">Format yang diperbolehkan: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB per file.</div>
                            <div class="invalid-feedback" id="dokumen-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
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
            // Initialize DataTable
            const table = $('#instrumenTable').DataTable({
                "order": [[0, "asc"]],
                "pageLength": 25,
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
                submitBtn.html('<i class="bi bi-arrow-repeat spinner"></i> Menyimpan...').prop('disabled', true);

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
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
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
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data',
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
