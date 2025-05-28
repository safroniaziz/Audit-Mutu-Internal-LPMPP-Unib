@extends('dataauditor/dashboard_template')

@php
    // Group IKSS by Satuan Standar and calculate completion
    $groupedIkss = [];
    $ssCompletionStatus = [];
    $allCompleted = true;
    $lastCompletedStep = null;

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
        }
    }

    // Convert to collection after processing
    $groupedIkss = collect($groupedIkss);
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

        .wizard-nav::-webkit-scrollbar {
            height: 5px;
        }

        .wizard-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .wizard-nav::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .wizard-step {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 0.5rem 2rem;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
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

        .wizard-step:not(:last-child):before {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            transform: translate(50%, -50%) rotate(45deg);
            width: 10px;
            height: 10px;
            border-top: 2px solid #E4E6EF;
            border-right: 2px solid #E4E6EF;
            background: white;
            z-index: 2;
        }

        .wizard-step.active {
            color: #009EF7;
        }

        .wizard-step.completed {
            color: #50CD89;
        }

        .wizard-step.completed:not(:last-child):after {
            background: #50CD89;
        }

        .wizard-step.completed:not(:last-child):before {
            border-color: #50CD89;
        }

        .wizard-step.active:not(:last-child):after {
            background: #009EF7;
        }

        .wizard-step.active:not(:last-child):before {
            border-color: #009EF7;
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
            transition: all 0.3s ease;
            border: 2px solid #E4E6EF;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .wizard-step.active .step-number {
            background: #009EF7;
            color: white;
            border-color: #009EF7;
            box-shadow: 0 0 20px 0 rgb(0 158 247 / 30%);
        }

        .wizard-step.completed .step-number {
            background: #50CD89;
            color: white;
            border-color: #50CD89;
            box-shadow: 0 0 20px 0 rgb(80 205 137 / 30%);
        }

        .wizard-step .step-label {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .wizard-step .step-desc {
            color: #B5B5C3;
            font-size: 0.9rem;
            max-width: 150px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .wizard-step.active .step-desc,
        .wizard-step.completed .step-desc {
            color: inherit;
        }

        .wizard-content {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            position: absolute;
            left: -9999px;
        }

        .wizard-content.active {
            display: block;
            opacity: 1;
            position: relative;
            left: 0;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Progress indicator styles */
        .progress-wrapper {
            margin-bottom: 2rem;
        }

        .progress {
            height: 0.5rem;
            border-radius: 0.475rem;
            background-color: #E4E6EF;
        }

        .progress-bar {
            background-color: #009EF7;
            border-radius: 0.475rem;
            transition: width 0.3s ease;
        }

        .progress-status {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            color: #7E8299;
            font-size: 0.9rem;
        }

        .wizard-sections {
            position: relative;
        }

        .wizard-content {
            display: none;
            opacity: 0;
            transition: all 0.3s ease;
            position: absolute;
            left: -9999px;
            width: 100%;
        }

        .wizard-content.active {
            display: block;
            opacity: 1;
            position: relative;
            left: 0;
            animation: fadeIn 0.3s ease;
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
            @else
                <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📢 Informasi Penting</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>Catatan:</strong>
                                <span class="text-gray-800">
                                    Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh
                                    untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($dataIkss->isNotEmpty())
                <!-- Wizard Navigation -->
                <div class="wizard-nav mb-5">
                    @foreach($groupedIkss as $ssId => $group)
                        @php
                            $isCompleted = $ssCompletionStatus[$ssId]['is_completed'];
                            $isActive = !$isCompleted && (!$lastCompletedStep || $lastCompletedStep == $ssId);
                            $progress = $ssCompletionStatus[$ssId]['completed'] / $ssCompletionStatus[$ssId]['total'] * 100;
                        @endphp
                        <div class="wizard-step {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}"
                             data-step="{{ $ssId }}">
                            <div class="step-number">{{ $loop->iteration }}</div>
                            <div class="step-label">{{ $group['satuan_standar']->kode_satuan }}</div>
                            <div class="step-desc">
                                {{ $ssCompletionStatus[$ssId]['completed'] }}/{{ $ssCompletionStatus[$ssId]['total'] }}
                                Instrumen
                            </div>
                        </div>
                    @endforeach
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
                                <div class="card mb-5 {{ $ssCompletionStatus[$ssId]['is_completed'] ? 'border-success' : '' }}">
                                    <div class="card-header {{ $ssCompletionStatus[$ssId]['is_completed'] ? 'bg-success-subtle' : 'bg-light' }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="mb-0">
                                                {{ $group['satuan_standar']->kode_satuan }} - {{ $group['satuan_standar']->sasaran }}
                                            </h4>
                                            @if($ssCompletionStatus[$ssId]['is_completed'])
                                                <span class="badge bg-success-subtle text-success border border-success">
                                                    ✅ Semua Instrumen Sudah Dievaluasi
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        @foreach($group['ikss'] as $ikssAuditee)
                                            @php
                                                $hasEvaluation = isset($deskEvaluation[$ikssAuditee->id]);
                                            @endphp
                                            <div class="instrument-container mb-4 {{ !$loop->first ? 'mt-5 pt-4 border-top' : '' }}">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h5 class="mb-0">
                                                        {{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }} -
                                                        {{ $ikssAuditee->instrumen->indikator }}
                                                    </h5>
                                                    @if($hasEvaluation)
                                                        <span class="badge bg-success-subtle text-success border border-success ms-3">
                                                            ✅ Sudah Dievaluasi
                                                        </span>
                                                    @endif
                                                </div>

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
                                                        <textarea rows="2" class="form-control" name="deskripsi[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }} required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->deskripsi : '' }}</textarea>
                                                    </div>
                                                    <div class="mt-3">
                                                        <h6>Pertanyaan <span class="text-danger">*</span></h6>
                                                        <textarea rows="2" class="form-control" name="pertanyaan[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }} required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->pertanyaan : '' }}</textarea>
                                                    </div>
                                                    <div class="mt-3">
                                                        <h6>Nilai <span class="text-danger">*</span></h6>
                                                        <textarea rows="1" class="form-control" name="nilai[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }} required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->nilai : '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

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
                                            Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
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
            $('.wizard-content').hide().css('opacity', 0);

            // Show only the first section
            $('.wizard-content:first').show().css('opacity', 1).addClass('active');

            // Update progress bar
            updateProgress();
        }

        // Navigation between steps
        $('.wizard-step').click(function() {
            const stepId = $(this).data('step');
            if (!$(this).hasClass('completed') && !$(this).hasClass('active')) {
                return;
            }
            showStep(stepId);
        });

        $('.next-step').click(function() {
            const nextStep = $(this).data('next');
            const nextStepId = $('.wizard-step').eq(nextStep).data('step');
            showStep(nextStepId);
        });

        $('.prev-step').click(function() {
            const prevStep = $(this).data('prev');
            const prevStepId = $('.wizard-step').eq(prevStep).data('step');
            showStep(prevStepId);
        });

        function showStep(stepId) {
            // Hide current active section with animation
            $('.wizard-content.active').fadeOut(300, function() {
                $(this).removeClass('active');

                // Show selected section with animation
                $(`#step-${stepId}`).fadeIn(300, function() {
                    $(this).addClass('active').css('opacity', 1);
                });
            });

            // Update wizard navigation
            $('.wizard-step').removeClass('active');
            $(`.wizard-step[data-step="${stepId}"]`).addClass('active');

            // Scroll to top of the content
            $('html, body').animate({
                scrollTop: $('.wizard-nav').offset().top - 50
            }, 300);

            // Update progress
            updateProgress();
        }

        function updateProgress() {
            const totalSteps = $('.wizard-step').length;
            const completedSteps = $('.wizard-step.completed').length;
            const currentStep = $('.wizard-step.active').index() + 1;
            const progressPercentage = (completedSteps / totalSteps) * 100;

            // Update progress bar if it exists
            if ($('.progress-bar').length) {
                $('.progress-bar').css('width', `${progressPercentage}%`);
                $('.progress-status .completed').text(`${completedSteps} dari ${totalSteps} Satuan Standar selesai`);
                $('.progress-status .current').text(`Langkah ${currentStep} dari ${totalSteps}`);
            }
        }

        // Form validation
        $('#formDeskEvaluation').submit(function(e) {
            const currentStep = $('.wizard-content.active');
            const requiredFields = currentStep.find('textarea[required]');
            let hasEmptyFields = false;

            requiredFields.each(function() {
                if (!$(this).val().trim()) {
                    hasEmptyFields = true;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (hasEmptyFields) {
                e.preventDefault();
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Mohon lengkapi semua field yang wajib diisi pada satuan standar ini',
                    icon: 'warning'
                });
                return;
            }

            // If all fields in current step are filled, proceed with form submission
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyimpan evaluasi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit();
                }
            });

            e.preventDefault();
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

        // Handle textarea validation on input
        $('textarea[required]').on('input', function() {
            if ($(this).val().trim()) {
                $(this).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
