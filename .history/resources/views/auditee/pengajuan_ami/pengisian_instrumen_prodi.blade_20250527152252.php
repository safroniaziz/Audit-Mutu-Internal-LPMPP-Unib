@extends('auditee/dashboard_template')

@php
    // Calculate completion status
    $totalInstrumen = 0;
    $completedInstrumen = 0;

    // Group by IndikatorKinerja -> InstrumenIkss
    $groupedData = [];
    foreach ($dataIkssProdi as $unitKerja) {
        foreach ($unitKerja->indikatorKinerjas as $indikator) {
            foreach ($indikator->instrumen as $instrumen) {
                $indikatorId = $indikator->id;
                $instrumenId = $instrumen->id;

                if (!isset($groupedData[$indikatorId])) {
                    $groupedData[$indikatorId] = [
                        'indikator' => $indikator,
                        'instrumen' => []
                    ];
                }

                $groupedData[$indikatorId]['instrumen'][] = [
                    'data' => $instrumen,
                    'submission' => isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id] : null
                ];

                $totalInstrumen++;
                if (isset($ikssAuditeeData[$instrumen->id])) {
                    $completedInstrumen++;
                }
            }
        }
    }

    $progressPercentage = $totalInstrumen > 0 ? ($completedInstrumen / $totalInstrumen) * 100 : 0;
    $isAllCompleted = $completedInstrumen === $totalInstrumen && $totalInstrumen > 0;
@endphp

@push('styles')
    <style>
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        .notice {
            border-left: 4px solid #FFA800 !important;
        }

        .wizard-nav, .sub-wizard-nav {
            display: flex;
            overflow-x: auto;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            background: #ffffff;
            border-radius: 0.475rem;
            box-shadow: 0 0 50px 0 rgb(82 63 105 / 10%);
        }

        .sub-wizard-nav {
            display: none;
        }

        .sub-wizard-nav.active {
            display: flex;
        }

        .wizard-content {
            display: none;
        }

        .wizard-content.active {
            display: block;
        }
    </style>
@endpush

@section('dashboardProfile')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <!-- Alert Message -->
            <div class="alert {{ $isAllCompleted ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $isAllCompleted ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $isAllCompleted ? '✨ Pengisian Instrumen Selesai' : '📝 Pengisian Instrumen' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $isAllCompleted ? 'Selamat!' : 'Status:' }}</strong>
                            <span class="fw-semibold {{ $isAllCompleted ? 'text-success' : 'text-danger' }}">
                                @if($isAllCompleted)
                                    Semua instrumen telah diisi dengan lengkap.
                                @else
                                    {{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah diisi. Silakan lengkapi pengisian instrumen yang tersisa.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="d-flex flex-column mb-10">
                <div class="d-flex align-items-center mb-2">
                    <span class="fs-4 fw-bold text-gray-800 me-2">Progress Pengisian Instrumen</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="fs-6 fw-semibold text-gray-600">
                        @if($isAllCompleted)
                            Semua instrumen telah selesai diisi
                        @else
                            {{ $completedInstrumen }} instrumen selesai diisi
                        @endif
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 bg-light-primary rounded h-6px me-3">
                        <div class="bg-primary rounded h-6px" role="progressbar"
                            style="width: {{ $progressPercentage }}%"
                            aria-valuenow="{{ $progressPercentage }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                    <span class="fs-6 fw-bold text-gray-800">{{ number_format($progressPercentage, 1) }}%</span>
                </div>
            </div>

            <!-- Wizard Navigation -->
            <div class="wizard-nav mb-5">
                @foreach($groupedData as $indikatorId => $indikatorGroup)
                    <div class="wizard-step {{ $loop->first ? 'active' : '' }}" data-indikator="{{ $indikatorId }}">
                        <div class="step-number">{{ $loop->iteration }}</div>
                        <div class="step-label">{{ $indikatorGroup['indikator']->nama }}</div>
                        <div class="step-desc">
                            {{ count($indikatorGroup['instrumen']) }} Instrumen
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Sub Wizard Navigation -->
            @foreach($groupedData as $indikatorId => $indikatorGroup)
                <div class="sub-wizard-nav {{ $loop->first ? 'active' : '' }}" data-indikator="{{ $indikatorId }}">
                    @foreach($indikatorGroup['instrumen'] as $instrumen)
                        <div class="wizard-step {{ $loop->first ? 'active' : '' }}" data-instrumen="{{ $instrumen['data']->id }}">
                            <div class="step-number">{{ $loop->iteration }}</div>
                            <div class="step-label">{{ $instrumen['data']->nama }}</div>
                            <div class="step-desc">
                                {{ $instrumen['submission'] ? 'Sudah diisi' : 'Belum diisi' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <!-- Content Sections -->
            @foreach($groupedData as $indikatorId => $indikatorGroup)
                @foreach($indikatorGroup['instrumen'] as $instrumen)
                    <div class="wizard-content {{ ($loop->parent->first && $loop->first) ? 'active' : '' }}"
                         data-indikator="{{ $indikatorId }}"
                         data-instrumen="{{ $instrumen['data']->id }}">
                        <div class="card card-bordered mb-5">
                            <div class="card-header">
                                <h3 class="card-title">{{ $indikatorGroup['indikator']->nama }} - {{ $instrumen['data']->nama }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="min-w-50px">No</th>
                                                <th class="min-w-400px">Instrumen</th>
                                                <th class="min-w-100px">Nilai</th>
                                                <th class="min-w-200px">Deskripsi</th>
                                                <th class="min-w-150px">Dokumen</th>
                                                <th class="min-w-100px text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $instrumen['data']->nama }}</td>
                                                <td>
                                                    @if($instrumen['submission'])
                                                        <span class="badge badge-light-success">{{ $instrumen['submission']->nilai }}</span>
                                                    @else
                                                        <span class="badge badge-light-warning">Belum diisi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="{{ $instrumen['submission'] ? '' : 'text-muted' }}">
                                                        {{ $instrumen['submission'] ? Str::limit($instrumen['submission']->deskripsi, 50) : 'Belum diisi' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($instrumen['submission'] && $instrumen['submission']->dokumen->count() > 0)
                                                        <div class="d-flex flex-column gap-2">
                                                            @foreach($instrumen['submission']->dokumen as $dokumen)
                                                                <a href="{{ Storage::url($dokumen->path) }}"
                                                                   target="_blank"
                                                                   class="d-flex align-items-center text-primary">
                                                                    <i class="bi bi-file-earmark-text me-2"></i>
                                                                    {{ Str::limit($dokumen->nama_file, 30) }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="badge badge-light-warning">Belum ada dokumen</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                            class="btn btn-sm {{ $instrumen['submission'] ? 'btn-light-primary' : 'btn-primary' }} btn-edit"
                                                            data-instrumen-id="{{ $instrumen['data']->id }}"
                                                            data-nilai="{{ $instrumen['submission'] ? $instrumen['submission']->nilai : '' }}"
                                                            data-deskripsi="{{ $instrumen['submission'] ? $instrumen['submission']->deskripsi : '' }}">
                                                        <i class="bi {{ $instrumen['submission'] ? 'bi-pencil' : 'bi-plus' }}"></i>
                                                        {{ $instrumen['submission'] ? 'Edit' : 'Isi' }}
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
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

                        <div class="notice bg-light-primary p-4 mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                                <span class="fw-bold text-gray-800">Petunjuk Pengisian</span>
                            </div>
                            <p class="text-gray-700 mb-0">
                                Silakan isi nilai dan deskripsi untuk instrumen ini. Anda juga dapat mengunggah dokumen pendukung jika diperlukan.
                            </p>
                        </div>

                        <div class="mb-4">
                            <label for="nilai" class="form-label required">Nilai</label>
                            <input type="number" class="form-control form-control-solid"
                                   id="nilai" name="nilai" min="0" max="100" required
                                   placeholder="Masukkan nilai (0-100)">
                            <div class="invalid-feedback" id="nilai-error"></div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label required">Deskripsi</label>
                            <textarea class="form-control form-control-solid"
                                      id="deskripsi" name="deskripsi"
                                      rows="4" required
                                      placeholder="Masukkan deskripsi atau penjelasan"></textarea>
                            <div class="invalid-feedback" id="deskripsi-error"></div>
                        </div>

                        <div class="mb-4">
                            <label for="dokumen" class="form-label">Dokumen Pendukung</label>
                            <input type="file" class="form-control form-control-solid"
                                   id="dokumen" name="dokumen[]" multiple
                                   accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <div class="text-muted fs-7 mt-1">Format yang diperbolehkan: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB per file.</div>
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
                    url: `/auditee/submit-ikss-auditee/${instrumenId}`,
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

            // Handle wizard navigation
            $('.wizard-nav .wizard-step').on('click', function() {
                const indikatorId = $(this).data('indikator');

                // Update active states
                $('.wizard-nav .wizard-step').removeClass('active');
                $(this).addClass('active');

                // Show corresponding sub-wizard
                $('.sub-wizard-nav').removeClass('active');
                $(`.sub-wizard-nav[data-indikator="${indikatorId}"]`).addClass('active');

                // Show first content of this indikator
                const firstInstrumen = $(`.sub-wizard-nav[data-indikator="${indikatorId}"] .wizard-step:first`).data('instrumen');
                showContent(indikatorId, firstInstrumen);
            });

            // Handle sub-wizard navigation
            $('.sub-wizard-nav .wizard-step').on('click', function() {
                const indikatorId = $(this).closest('.sub-wizard-nav').data('indikator');
                const instrumenId = $(this).data('instrumen');

                // Update active states
                $(this).closest('.sub-wizard-nav').find('.wizard-step').removeClass('active');
                $(this).addClass('active');

                showContent(indikatorId, instrumenId);
            });

            function showContent(indikatorId, instrumenId) {
                $('.wizard-content').removeClass('active');
                $(`.wizard-content[data-indikator="${indikatorId}"][data-instrumen="${instrumenId}"]`).addClass('active');
            }

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
        });
    </script>
@endpush
