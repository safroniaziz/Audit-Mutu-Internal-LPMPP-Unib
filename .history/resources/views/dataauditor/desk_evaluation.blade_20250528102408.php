@extends('dataauditor/dashboard_template')

@php
    // Group IKSS by Sasaran Strategis and calculate completion
    $groupedIkss = [];
    $ssCompletionStatus = [];
    $allCompleted = true;
    $lastCompletedStep = null;
    $firstIncompleteStep = null;

    foreach ($dataIkss as $ikssAuditee) {
        $satuanStandar = $ikssAuditee->instrumen->indikatorKinerja->satuanStandar;

        if (!isset($groupedIkss[$satuanStandar->id])) {
            $groupedIkss[$satuanStandar->id] = [
                'satuan_standar' => $satuanStandar,
                'ikss' => [],
                'total_ikss' => 0,
                'completed_ikss' => 0
            ];
        }

        $groupedIkss[$satuanStandar->id]['ikss'][] = $ikssAuditee;
        $groupedIkss[$satuanStandar->id]['total_ikss']++;

        // Check if this IKSS has been evaluated
        if (isset($deskEvaluation[$ikssAuditee->id]) &&
            !empty($deskEvaluation[$ikssAuditee->id]->deskripsi) &&
            !empty($deskEvaluation[$ikssAuditee->id]->pertanyaan) &&
            !empty($deskEvaluation[$ikssAuditee->id]->nilai)) {
            $groupedIkss[$satuanStandar->id]['completed_ikss']++;
        }

        // Calculate completion status for this SS
        $totalIkss = $groupedIkss[$satuanStandar->id]['total_ikss'];
        $completedIkss = $groupedIkss[$satuanStandar->id]['completed_ikss'];
        $isCompleted = $totalIkss > 0 && $completedIkss === $totalIkss;

        $ssCompletionStatus[$satuanStandar->id] = [
            'total' => $totalIkss,
            'completed' => $completedIkss,
            'is_completed' => $isCompleted
        ];

        if ($isCompleted) {
            $lastCompletedStep = $satuanStandar->id;
        } else {
            $allCompleted = false;
            if (!$firstIncompleteStep) {
                $firstIncompleteStep = $satuanStandar->id;
            }
        }
    }

    // Convert to collection after processing
    $groupedIkss = collect($groupedIkss);

    // Determine active step - should be first incomplete step or first step if none completed
    $activeStep = $firstIncompleteStep ?? array_key_first($ssCompletionStatus);
@endphp

@push('styles')
    <style>
        /* Wizard navigation styles */
        .wizard-nav {
            display: flex;
            overflow-x: auto;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            position: relative;
            background: #ffffff;
            border-radius: 0.475rem;
            box-shadow: 0 0 50px 0 rgb(82 63 105 / 10%);
        }

        .wizard-step {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 0.5rem 2rem;
            position: relative;
            cursor: not-allowed;
            transition: all 0.2s ease;
            opacity: 0.5;
        }

        .wizard-step.completed {
            cursor: pointer;
            opacity: 1;
            color: #50CD89;
        }

        .wizard-step.active {
            cursor: pointer;
            opacity: 1;
            color: #009EF7;
        }

        .wizard-step.disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .wizard-step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            width: calc(100% - 80px);
            height: 2px;
            background: #E4E6EF;
            transform: translate(50%, -50%);
            z-index: 1;
        }

        .wizard-step.completed:not(:last-child):after {
            background: #50CD89;
        }

        .wizard-step.active:not(:last-child):after {
            background: #009EF7;
        }

        .wizard-step .step-number {
            width: 40px;
            height: 40px;
            margin: 0 auto 0.75rem;
            border-radius: 50%;
            background: #F5F8FA;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.2s ease;
            border: 2px solid #E4E6EF;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .wizard-step.active .step-number {
            background: #009EF7;
            color: white;
            border-color: #009EF7;
        }

        .wizard-step.completed .step-number {
            background: #50CD89;
            color: white;
            border-color: #50CD89;
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
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>

        <div class="card-body">
            @if($deskEvaluation->isNotEmpty())
                @if($setuju)
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="d-flex justify-content-between align-items-center py-4 mb-6 border rounded px-4" id="approve-desk-container">
                            <div class="me-10">
                                <h4 class="text-dark fw-bold mb-1">
                                    ✅ Desk Evaluation Telah Disetujui
                                </h4>
                                <p class="text-gray-700 fs-6 mb-0">
                                    Terima kasih, Anda telah menyetujui Desk Evaluation. Silakan lanjutkan ke tahap <strong>Visitasi</strong> untuk melanjutkan proses lebih lanjut.
                                </p>
                            </div>
                            <a href="{{ route('auditor.audit.visitasi', $pengajuan->id) }}" class="btn btn-primary px-5">
                                <i class="bi bi-arrow-right-circle me-2"></i> Lanjut ke Visitasi
                            </a>
                        </div>
                    </div>
                @else
                    <div class="notice d-flex bg-light-success rounded border-success border border-dashed mb-9 p-6">
                        <span class="svg-icon svg-icon-2tx svg-icon-success me-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="d-flex justify-content-between align-items-center py-4 mb-6 border rounded px-4" id="approve-desk-container">
                            <div class="me-10">
                                <h4 class="text-dark fw-bold mb-1">
                                    ✅ Desk Evaluation Telah Diselesaikan
                                </h4>
                                <p class="text-gray-700 fs-6 mb-0">
                                    Silakan klik tombol <strong>Setujui</strong> untuk melanjutkan ke tahap <strong>Visitasi</strong>.
                                </p>
                                <button type="button" class="btn btn-success px-5" id="approve-desk-btn" data-id="{{ $pengajuan->id }}">
                                    <i class="bi bi-check-circle me-2"></i> Setujui
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if($dataIkss->isNotEmpty())
                <div class="alert {{ $allCompleted ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi {{ $allCompleted ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">{{ $allCompleted ? '✨ Desk Evaluation Selesai' : '📝 Desk Evaluation' }}</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>{{ $allCompleted ? 'Selamat!' : 'Status:' }}</strong>
                                <span class="fw-semibold {{ $allCompleted ? 'text-success' : 'text-danger' }}">
                                    @php
                                        $totalIkss = 0;
                                        $totalCompleted = 0;
                                        foreach ($ssCompletionStatus as $status) {
                                            $totalIkss += $status['total'];
                                            $totalCompleted += $status['completed'];
                                        }
                                    @endphp
                                    @if($allCompleted)
                                        Semua instrumen telah dievaluasi dengan lengkap. Silakan lanjut ke tahap Visitasi.
                                    @else
                                        {{ $totalCompleted }} dari {{ $totalIkss }} instrumen telah dievaluasi. Silakan lengkapi evaluasi yang tersisa.
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="ms-auto">
                        @if ($allCompleted)
                            <a href="{{ route('auditor.audit.visitasi', $pengajuan->id) }}" class="btn btn-sm px-4 btn-success">
                                <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                            </a>
                        @else
                            <a href="#" class="btn btn-sm px-4 btn-secondary disabled" style="cursor: not-allowed; opacity: 0.65;">
                                <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Wizard Navigation -->
                <div class="wizard-nav">
                    @foreach($groupedIkss as $ssId => $group)
                        @php
                            $isCompleted = $ssCompletionStatus[$ssId]['is_completed'];
                            $isActive = $ssId == $activeStep;
                            $stepClass = $isCompleted ? 'completed' : ($isActive ? 'active' : 'disabled');
                        @endphp
                        <div class="wizard-step {{ $stepClass }}" data-step="{{ $ssId }}">
                            <div class="step-number">{{ $loop->iteration }}</div>
                            <div class="step-label">{{ $group['satuan_standar']->kode_satuan }}</div>
                            <div class="step-desc">
                                {{ $ssCompletionStatus[$ssId]['completed'] }}/{{ $ssCompletionStatus[$ssId]['total'] }}
                                Instrumen
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Progress Bar -->
                <div class="d-flex flex-column mb-10">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-4 fw-bold text-gray-800 me-2">Progress Evaluasi Desk</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-6 fw-semibold text-gray-600">
                            @php
                                $totalIkss = 0;
                                $totalCompleted = 0;
                                foreach ($ssCompletionStatus as $status) {
                                    $totalIkss += $status['total'];
                                    $totalCompleted += $status['completed'];
                                }
                                $progressPercentage = ($totalIkss > 0) ? ($totalCompleted / $totalIkss) * 100 : 0;
                            @endphp
                            @if($allCompleted)
                                Semua instrumen telah selesai dievaluasi
                            @else
                                {{ $totalCompleted }} instrumen selesai dievaluasi
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

                <form action="{{ route('auditor.audit.submitDeskEvaluation') }}" method="POST" enctype="multipart/form-data" id="formDeskEvaluation">
                    @csrf
                    <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                    <div class="wizard-sections">
                        @foreach($groupedIkss as $ssId => $group)
                            @php
                                $isFirst = $loop->first;
                                $isLast = $loop->last;
                                $isActive = $isFirst; // Only first section is active on load
                            @endphp
                            <div class="wizard-content {{ $isActive ? 'active' : '' }}" id="step-{{ $ssId }}">
                                @foreach($group['ikss'] as $ikssAuditee)
                                    @php
                                        $hasEvaluation = isset($deskEvaluation[$ikssAuditee->id]) &&
                                            !empty($deskEvaluation[$ikssAuditee->id]->deskripsi) &&
                                            !empty($deskEvaluation[$ikssAuditee->id]->pertanyaan) &&
                                            !empty($deskEvaluation[$ikssAuditee->id]->nilai);
                                    @endphp
                                    <div class="card mb-5 {{ $hasEvaluation ? 'border-success' : '' }}">
                                        <div class="card-header {{ $hasEvaluation ? 'bg-success-subtle' : 'bg-light' }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="text-muted mb-1">{{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }}</h6>
                                                    <h4 class="mb-0">
                                                        {{ $ikssAuditee->instrumen->indikator }}
                                                    </h4>
                                                </div>
                                                @if($hasEvaluation)
                                                    <span class="badge bg-success-subtle text-success border border-success">
                                                        ✅ Sudah Dievaluasi
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <input type="hidden" name="ikss_auditee_ids[]" value="{{ $ikssAuditee->id }}">

                                            <div class="mb-4">
                                                <h6>Referensi</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td width="30%">Indikator Kinerja RSB</td>
                                                            <td>{{ $ikssAuditee->instrumen->indikator }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sumber data/bukti</td>
                                                            <td>
                                                                {{ $ikssAuditee->instrumen->sumber }}
                                                                @if($ikssAuditee->file_sumber)
                                                                    <div class="mb-2">
                                                                        <a href="{{ asset('storage/'.$ikssAuditee->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                            <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Target</td>
                                                            <td>{{ $ikssAuditee->instrumen->target }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi</td>
                                                            <td>{{ $ikssAuditee->realisasi }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <h6>Pengukuran</h6>
                                                <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                <div class="p-3 bg-light mb-3 rounded">
                                                    <p>{{ $ikssAuditee->akar }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                <div class="p-3 bg-light mb-3 rounded">
                                                    <p>{{ $ikssAuditee->rencana }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <h6>Indikator Penilaian</h6>
                                                <div class="p-3 bg-light rounded">
                                                    {!! $ikssAuditee->instrumen->penilaian !!}
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="mt-3">
                                                    <h6>Deskripsi Penilaian Auditor <span class="text-danger">*</span></h6>
                                                    <textarea rows="2" class="form-control @error('deskripsi.'.$ikssAuditee->id) is-invalid @enderror"
                                                              name="deskripsi[{{ $ikssAuditee->id }}]"
                                                              {{ $hasEvaluation ? 'disabled' : '' }}
                                                              required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->deskripsi : old('deskripsi.'.$ikssAuditee->id) }}</textarea>
                                                    @error('deskripsi.'.$ikssAuditee->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <h6>Pertanyaan <span class="text-danger">*</span></h6>
                                                    <textarea rows="2" class="form-control @error('pertanyaan.'.$ikssAuditee->id) is-invalid @enderror"
                                                              name="pertanyaan[{{ $ikssAuditee->id }}]"
                                                              {{ $hasEvaluation ? 'disabled' : '' }}
                                                              required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->pertanyaan : old('pertanyaan.'.$ikssAuditee->id) }}</textarea>
                                                    @error('pertanyaan.'.$ikssAuditee->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <h6>Nilai <span class="text-danger">*</span></h6>
                                                    <textarea rows="1" class="form-control @error('nilai.'.$ikssAuditee->id) is-invalid @enderror"
                                                              name="nilai[{{ $ikssAuditee->id }}]"
                                                              {{ $hasEvaluation ? 'disabled' : '' }}
                                                              required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->nilai : old('nilai.'.$ikssAuditee->id) }}</textarea>
                                                    @error('nilai.'.$ikssAuditee->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-between mt-5">
                                    @if(!$isFirst)
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="{{ $loop->index - 1 }}">
                                            <i class="bi bi-arrow-left me-2"></i> Sebelumnya
                                        </button>
                                    @else
                                        <div></div>
                                    @endif

                                    @if(!$isLast)
                                        <button type="button" class="btn btn-primary next-step" data-next="{{ $loop->index + 1 }}">
                                            Simpan & Lanjutkan <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    @else
                                        @if(!$allCompleted)
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-circle me-2"></i> Simpan Evaluasi
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            @else
                <div class="alert alert-info">
                    Tidak ada data IKSS untuk dievaluasi saat ini.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initial setup - ensure only first section is visible
        initializeWizard();

        function initializeWizard() {
            // Hide all sections first
            $('.wizard-content').hide();

            // Show only the active section
            const activeStepId = $('.wizard-step.active').data('step');
            $(`#step-${activeStepId}`).show().addClass('active');
        }

        // Navigation between steps
        $('.wizard-step').click(function() {
            // Prevent navigation if step is disabled
            if ($(this).hasClass('disabled')) {
                Swal.fire({
                    title: 'Tidak dapat melanjutkan',
                    text: 'Harap selesaikan evaluasi pada tahap sebelumnya terlebih dahulu',
                    icon: 'warning'
                });
                return;
            }

            const stepId = $(this).data('step');
            // Only allow navigation to completed steps or the active step
            if ($(this).hasClass('completed') || $(this).hasClass('active')) {
                showStep(stepId);
            }
        });

        // Handle form submission per section
        $('.next-step').click(function() {
            const currentStep = $('.wizard-content.active');
            if (validateStep(currentStep)) {
                // Submit the form data for current section via AJAX
                const formData = new FormData($('#formDeskEvaluation')[0]);
                const currentStepId = currentStep.attr('id').replace('step-', '');

                $.ajax({
                    url: "{{ route('auditor.audit.submitDeskEvaluation') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Mark current step as completed
                            $(`.wizard-step[data-step="${currentStepId}"]`).addClass('completed').removeClass('active');

                            // Get next step
                            const nextStep = $('.next-step').data('next');
                            const nextStepId = $('.wizard-step').eq(nextStep).data('step');

                            // Enable and activate next step
                            $(`.wizard-step[data-step="${nextStepId}"]`)
                                .removeClass('disabled')
                                .addClass('active');

                            // Show next step
                            showStep(nextStepId);

                            // Show success message
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                            icon: 'error'
                        });
                    }
                });
            }
        });

        $('.prev-step').click(function() {
            const prevStep = $(this).data('prev');
            const prevStepId = $('.wizard-step').eq(prevStep).data('step');
            // Only allow navigation to completed steps or the active step
            const prevStepElement = $(`.wizard-step[data-step="${prevStepId}"]`);
            if (prevStepElement.hasClass('completed') || prevStepElement.hasClass('active')) {
                showStep(prevStepId);
            }
        });

        function showStep(stepId) {
            // Hide current active section
            $('.wizard-content.active').hide().removeClass('active');

            // Show selected section
            $(`#step-${stepId}`).show().addClass('active');

            // Update wizard navigation
            $('.wizard-step').removeClass('active');
            $(`.wizard-step[data-step="${stepId}"]`).addClass('active');

            // Scroll to top of the content
            $('.wizard-nav')[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function validateStep(step) {
            const requiredFields = step.find('textarea[required]:not([disabled])');
            let isValid = true;
            let firstError = null;

            requiredFields.each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    if (!firstError) {
                        firstError = $(this);
                    }
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid && firstError) {
                firstError[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Mohon lengkapi semua field yang wajib diisi pada Sasaran Strategis ini',
                    icon: 'warning'
                });
            }

            return isValid;
        }

        // Handle textarea validation on input
        $('textarea[required]').on('input', function() {
            if ($(this).val().trim()) {
                $(this).removeClass('is-invalid');
            }
        });

        // Approve desk evaluation
        $('#approve-desk-btn').click(function() {
            const pengajuanId = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyetujui Desk Evaluation ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('auditor.audit.approveDeskEvaluation', '') }}/${pengajuanId}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'Terjadi kesalahan',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
