@extends('dataauditor/dashboard_template')
@section('menuUnduhDokumen')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.unduhDokumen') ? 'active' : '' }}" href="{{ route('auditor.audit.unduhDokumen', [$pengajuan->id]) }}">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection
@php
    // Group IKSS by Satuan Standar and calculate completion
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

        .wizard-step.completed,
        .wizard-step.active,
        .wizard-step.completed + .wizard-step {
            cursor: pointer;
            opacity: 1;
        }

        .wizard-step.completed:hover,
        .wizard-step.active:hover,
        .wizard-step.completed + .wizard-step:hover {
            opacity: 1;
            color: #009EF7 !important;
        }

        .wizard-step.completed:hover .step-number,
        .wizard-step.active:hover .step-number,
        .wizard-step.completed + .wizard-step:hover .step-number {
            background: #009EF7 !important;
            color: #FFFFFF !important;
            border-color: #009EF7 !important;
        }

        .wizard-step.completed:hover .step-label,
        .wizard-step.active:hover .step-label,
        .wizard-step.completed + .wizard-step:hover .step-label,
        .wizard-step.completed:hover .step-desc,
        .wizard-step.active:hover .step-desc,
        .wizard-step.completed + .wizard-step:hover .step-desc {
            color: #009EF7 !important;
        }

        .wizard-step.completed {
            color: #50CD89;
        }

        .wizard-step.active {
            color: #009EF7 !important;
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
            background: #009EF7 !important;
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
            color: #7E8299;
        }

        .wizard-step.completed .step-number {
            background: #50CD89;
            color: #FFFFFF;
            border-color: #50CD89;
        }

        .wizard-step.active .step-number {
            background: #009EF7 !important;
            color: #FFFFFF !important;
            border-color: #009EF7 !important;
        }

        .wizard-step .step-label {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
            color: inherit;
            transition: all 0.2s ease;
        }

        .wizard-step .step-desc {
            font-size: 0.9rem;
            max-width: 150px;
            margin: 0 auto;
            color: inherit;
            transition: all 0.2s ease;
        }

        .wizard-step.completed .step-label,
        .wizard-step.completed .step-desc {
            color: #50CD89;
        }

        .wizard-step.active .step-label,
        .wizard-step.active .step-desc {
            color: #009EF7 !important;
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
                                        $progressPercentage = ($totalIkss > 0) ? ($totalCompleted / $totalIkss) * 100 : 0;
                                    @endphp
                                    @if($allCompleted)
                                        {{ $totalCompleted }} dari {{ $totalIkss }} instrumen telah dievaluasi dengan lengkap.
                                        @if(!$setuju)
                                            <br>Silakan klik tombol <strong>Setujui</strong> untuk melanjutkan ke tahap <strong>Visitasi</strong>.
                                        @else
                                            <br>Silakan lanjut ke tahap <strong>Visitasi</strong>.
                                        @endif
                                    @else
                                        {{ $totalCompleted }} dari {{ $totalIkss }} instrumen telah dievaluasi.
                                        <br>Silakan lengkapi evaluasi yang tersisa.
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="ms-auto">
                        @if($allCompleted)
                            @if($setuju)
                                <a href="{{ route('auditor.audit.visitasi', $pengajuan->id) }}" class="btn btn-sm px-4 btn-success">
                                    <i class="fas fa-arrow-right me-2"></i> Lanjut ke Visitasi
                                </a>
                            @else
                                <button type="button" class="btn btn-sm px-4 btn-success" id="approve-desk-btn" data-id="{{ $pengajuan->id }}">
                                    <i class="bi bi-check-circle me-2"></i> Setujui
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-sm px-4 btn-secondary disabled" style="cursor: not-allowed; opacity: 0.65;">
                                <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex flex-column mb-10">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-4 fw-bold text-gray-800 me-2">Progress Evaluasi Desk</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-6 fw-semibold text-gray-600">
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

                <form action="{{ route('auditor.audit.submitDeskEvaluation') }}" method="POST" enctype="multipart/form-data" id="formDeskEvaluation">
                    @csrf
                    <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                    <div class="wizard-sections">
                        @foreach($groupedIkss as $ssId => $group)
                            @php
                                $isFirst = $loop->first;
                                $isLast = $loop->last;
                                $isActive = $isFirst; // Only first section is active on load
                                $status = $ssCompletionStatus[$ssId];
                                $isCompleted = $status['is_completed'];
                            @endphp
                            <div class="wizard-content {{ $isActive ? 'active' : '' }}" id="step-{{ $ssId }}">
                                <div class="alert {{ $isCompleted ? 'alert-success' : 'alert-danger' }} d-flex flex-column flex-sm-row p-5 mb-10">
                                    <span class="svg-icon svg-icon-2hx {{ $isCompleted ? 'svg-icon-success' : 'svg-icon-danger' }} me-4 mb-5 mb-sm-0">
                                        @if($isCompleted)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"/>
                                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"/>
                                        </svg>
                                        @else
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"/>
                                            <rect x="12" y="8" width="1" height="8" rx="0.5" fill="currentColor"/>
                                            <rect x="12" y="16" width="1" height="1" rx="0.5" fill="currentColor"/>
                                        </svg>
                                        @endif
                                    </span>

                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <h5 class="mb-1">Status: {{ $isCompleted ? 'Sudah Dievaluasi Lengkap' : 'Belum Lengkap' }}</h5>
                                        <div class="fs-6">
                                            <div class="fw-semibold text-gray-700">Satuan Standar: {{ $group['satuan_standar']->kode_satuan }} - {{ $group['satuan_standar']->sasaran }}</div>
                                            <div class="fw-semibold text-gray-700 mt-1">Progress: {{ $status['completed'] }}/{{ $status['total'] }} instrumen dievaluasi lengkap</div>
                                        </div>
                                    </div>
                                </div>

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
                                                              {{ ($hasEvaluation || $setuju) ? 'disabled' : '' }}
                                                              required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->deskripsi : old('deskripsi.'.$ikssAuditee->id) }}</textarea>
                                                    @error('deskripsi.'.$ikssAuditee->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <h6>Pertanyaan <span class="text-danger">*</span></h6>
                                                    <textarea rows="2" class="form-control @error('pertanyaan.'.$ikssAuditee->id) is-invalid @enderror"
                                                              name="pertanyaan[{{ $ikssAuditee->id }}]"
                                                              {{ ($hasEvaluation || $setuju) ? 'disabled' : '' }}
                                                              required>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->pertanyaan : old('pertanyaan.'.$ikssAuditee->id) }}</textarea>
                                                    @error('pertanyaan.'.$ikssAuditee->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <h6>Nilai <span class="text-danger">*</span></h6>
                                                    <textarea rows="1" class="form-control @error('nilai.'.$ikssAuditee->id) is-invalid @enderror"
                                                              name="nilai[{{ $ikssAuditee->id }}]"
                                                              {{ ($hasEvaluation || $setuju) ? 'disabled' : '' }}
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

                                    @if(!$setuju)
                                        @if(!$isLast)
                                            <button type="button" class="btn btn-primary next-step" data-next="{{ $loop->index + 1 }}">
                                                Simpan & Lanjutkan <i class="bi bi-arrow-right ms-2"></i>
                                            </button>
                                        @else
                                            @if(!$allCompleted)
                                                <button type="button" class="btn btn-success submit-final-step">
                                                    <i class="bi bi-check-circle me-2"></i> Simpan Evaluasi
                                                </button>
                                            @endif
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

        // Auto scroll to form after reload
        if ($('.wizard-content.active').length) {
            $('.wizard-nav')[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function initializeWizard() {
            // Hide all sections first
            $('.wizard-content').hide();

            // Show active section
            const activeStepId = $('.wizard-step.active').data('step');
            $(`#step-${activeStepId}`).show().addClass('active');
        }

        // Navigation between steps
        $('.wizard-step').click(function() {
            const stepElement = $(this);
            const stepId = stepElement.data('step');
            const prevStep = stepElement.prev('.wizard-step');

            // Allow navigation if:
            // 1. Step is completed
            // 2. Step is currently active
            // 3. Previous step is completed
            if (stepElement.hasClass('completed') ||
                stepElement.hasClass('active') ||
                (prevStep.length && prevStep.hasClass('completed'))) {
                showStep(stepId);
            } else {
                Swal.fire({
                    title: 'Tidak dapat melanjutkan',
                    text: 'Harap selesaikan evaluasi pada tahap sebelumnya terlebih dahulu',
                    icon: 'warning'
                });
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

        // Handle next step button
        $('.next-step').click(function() {
            const currentStep = $('.wizard-content.active');
            if (validateStep(currentStep)) {
                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    text: 'Apakah Anda yakin ingin menyimpan evaluasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        clearValidationErrors();

                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('pengajuan_id', '{{ $pengajuan->id }}');

                        currentStep.find('input[name="ikss_auditee_ids[]"]').each(function() {
                            formData.append('ikss_auditee_ids[]', $(this).val());
                        });

                        currentStep.find('textarea').each(function() {
                            const textarea = $(this);
                            const name = textarea.attr('name');
                            if (name) {
                                formData.append(name, textarea.val());
                            }
                        });

                        $.ajax({
                            url: "{{ route('auditor.audit.submitDeskEvaluation') }}",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status === 'success' || response.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message,
                                        icon: 'success',
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Add hash to trigger scroll after reload
                                            window.location.hash = 'scroll-top';
                                            window.location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    const errors = xhr.responseJSON.errors;
                                    displayValidationErrors(errors);

                                    const firstErrorField = $('.is-invalid').first();
                                    if (firstErrorField.length) {
                                        firstErrorField[0].scrollIntoView({
                                            behavior: 'smooth',
                                            block: 'center'
                                        });
                                    }

                                    Swal.fire({
                                        title: 'Validasi Gagal',
                                        text: 'Mohon periksa kembali isian Anda',
                                        icon: 'error'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                        icon: 'error'
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });

        function displayValidationErrors(errors) {
            Object.keys(errors).forEach(function(field) {
                const [fieldName, id] = field.split('.');
                if (id) {
                    const input = $(`textarea[name="${fieldName}[${id}]"]`);
                    input.addClass('is-invalid');

                    // Create or update error message
                    let errorDiv = input.next('.invalid-feedback');
                    if (!errorDiv.length) {
                        errorDiv = $('<div class="invalid-feedback"></div>');
                        input.after(errorDiv);
                    }
                    errorDiv.text(errors[field][0]);
                }
            });
        }

        function clearValidationErrors() {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }

        $('.prev-step').click(function() {
            const prevStep = $(this).data('prev');
            const prevStepId = $('.wizard-step').eq(prevStep).data('step');
            // Only allow navigation to completed steps or the active step
            const prevStepElement = $(`.wizard-step[data-step="${prevStepId}"]`);
            if (prevStepElement.hasClass('completed') || prevStepElement.hasClass('active')) {
                showStep(prevStepId);
            }
        });

        function validateStep(step) {
            clearValidationErrors();

            const requiredFields = step.find('textarea[required]:not([disabled])');
            let isValid = true;
            let firstError = null;

            requiredFields.each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('is-invalid');

                    // Add error message
                    const errorDiv = $('<div class="invalid-feedback">Field ini wajib diisi</div>');
                    $(this).after(errorDiv);

                    if (!firstError) {
                        firstError = $(this);
                    }
                }
            });

            if (!isValid && firstError) {
                firstError[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Mohon lengkapi semua field yang wajib diisi pada satuan standar ini',
                    icon: 'warning'
                });
            }

            return isValid;
        }

        // Handle textarea validation on input
        $('textarea[required]').on('input', function() {
            if ($(this).val().trim()) {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
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
                        url: `/auditor/audit/desk-evaluation/${pengajuanId}/approve`,
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
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        // Prevent form from submitting normally
        $('#formDeskEvaluation').on('submit', function(e) {
            e.preventDefault();
            return false;
        });

        // Handle final step submission
        $('.submit-final-step').on('click', function(e) {
            e.preventDefault();
            const currentStep = $('.wizard-content.active');

            if (validateStep(currentStep)) {
                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    text: 'Apakah Anda yakin ingin menyimpan evaluasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Clear any existing error messages
                        clearValidationErrors();

                        // Get all form data
                        const formData = new FormData($('#formDeskEvaluation')[0]);

                        // Submit via AJAX
                        $.ajax({
                            url: "{{ route('auditor.audit.submitDeskEvaluation') }}",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                // Disable the submit button
                                $('.submit-final-step').prop('disabled', true);
                            },
                            success: function(response) {
                                if (response.status === 'success' || response.success) {
                                    // Get next step ID before showing alert
                                    const nextStepId = $('.wizard-step.active').next('.wizard-step').data('step');

                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message,
                                        icon: 'success',
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            if (nextStepId) {
                                                // Set the URL and reload in one go
                                                window.location = `${window.location.pathname}?step=${nextStepId}`;
                                            } else {
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                // Re-enable the submit button
                                $('.submit-final-step').prop('disabled', false);

                                if (xhr.status === 422) {
                                    const errors = xhr.responseJSON.errors;
                                    displayValidationErrors(errors);

                                    const firstErrorField = $('.is-invalid').first();
                                    if (firstErrorField.length) {
                                        firstErrorField[0].scrollIntoView({
                                            behavior: 'smooth',
                                            block: 'center'
                                        });
                                    }

                                    Swal.fire({
                                        title: 'Validasi Gagal',
                                        text: 'Mohon periksa kembali isian Anda',
                                        icon: 'error'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                        icon: 'error'
                                    });
                                }
                            },
                            complete: function() {
                                // Re-enable the submit button
                                $('.submit-final-step').prop('disabled', false);
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
