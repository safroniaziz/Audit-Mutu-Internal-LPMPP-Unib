@extends('auditee/dashboard_template')
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

        .wizard-step:hover:not(.active):not(.completed) {
            color: #009EF7;
        }

        .wizard-step:hover:not(.active):not(.completed) .step-number {
            border-color: #009EF7;
            background: #EEF6FF;
        }

        .wizard-content {
            display: none;
        }

        .wizard-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Original styles */
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
            @if($sudahMengisi)
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                        </svg>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Data IKSS sudah diisi</h4>
                            <div class="fs-6 text-gray-700">Anda telah mengisi data IKSS untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="alert {{ $sudahMengisi ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $sudahMengisi ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $sudahMengisi ? '✨ IKSS Telah Dipilih' : '📢 Pilih IKSS' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $sudahMengisi ? 'Selamat!' : 'Catatan:' }}</strong>
                            <span class="fw-semibold {{ $sudahMengisi ? 'text-success' : 'text-danger' }}">
                                @if($sudahMengisi)
                                    IKSS telah dipilih dengan lengkap. Silakan lanjut ke tahap pengisian Instrumen Audit.
                                @else
                                    Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto">
                    @if ($sudahMengisi)
                        <a
                            href="{{ route('auditee.pengajuanAmi.pengisianInstrumen') }}"
                            class="btn btn-sm px-4 btn-primary"
                        >
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @else
                        <a
                            href="#"
                            class="btn btn-sm px-4 btn-secondary disabled"
                            style="cursor: not-allowed; opacity: 0.65;"
                        >
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @endif
                </div>
            </div>

            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
            </div>

            <form id="formPemilihanIkss" action="{{ route('auditee.pengajuanAmi.saveIkss') }}" method="POST" {{ $sudahMengisi ? 'class=form-disabled' : '' }}>
                @csrf
                <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                <!-- Wizard Navigation -->
                <div class="wizard-nav">
                    @foreach ($dataIkssProdi as $unit)
                        @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                            @php
                                $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                                $totalInstruments = 0;
                                $selectedInstruments = 0;
                                $radioInstruments = [];

                                // First pass: collect all instruments and their status
                                foreach ($indikators as $indikator) {
                                    foreach ($indikator->instrumen as $instrumen) {
                                        $totalInstruments++;
                                        $isSelected = false;

                                        // Check if instrument is selected either by being mandatory or by user choice
                                        if ($instrumen->is_wajib == 1) {
                                            $isSelected = true;
                                        } elseif (isset($dataTerpilih['pilihan_'.$instrumen->id])) {
                                            $isSelected = true;
                                        }

                                        if ($isSelected) {
                                            $selectedInstruments++;
                                        }

                                        $radioInstruments[$instrumen->id] = [
                                            'is_selected' => $isSelected,
                                            'is_wajib' => $instrumen->is_wajib == 1
                                        ];
                                    }
                                }

                                $isSSSubmitted = $totalInstruments > 0 && $selectedInstruments === $totalInstruments;

                                // Debug information
                                error_log("SS {$satuanStandar->kode_satuan}:");
                                error_log("Total Instruments: {$totalInstruments}");
                                error_log("Selected Instruments: {$selectedInstruments}");
                                error_log("Is SS Submitted: " . ($isSSSubmitted ? 'Yes' : 'No'));
                                foreach ($radioInstruments as $id => $info) {
                                    error_log("Instrument {$id}: Selected=" . ($info['is_selected'] ? 'Yes' : 'No') . ", Mandatory=" . ($info['is_wajib'] ? 'Yes' : 'No'));
                                }
                            @endphp
                            <div class="wizard-step" data-step="{{ $loop->iteration }}">
                                <div class="step-number">{{ $loop->iteration }}</div>
                                <div class="step-label">{{ $satuanStandar->kode_satuan }}</div>
                                <div class="step-desc">{{ Str::limit($satuanStandar->sasaran, 50) }}</div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- Progress Bar Section -->
                <div class="mb-8">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h3 class="fs-4 fw-bold text-dark mb-0">Progress Pemilihan IKSS</h3>
                            <span class="text-gray-600 progress-status">Menghitung progress...</span>
                        </div>
                        <span class="fs-2 fw-bolder text-primary progress-percentage">0%</span>
                    </div>

                    <div class="h-8px bg-light rounded">
                        <div class="bg-primary rounded h-8px progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Wizard Content -->
                @foreach ($dataIkssProdi as $unit)
                    @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                        @php
                            $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                        @endphp
                        <div class="wizard-content" data-step="{{ $loop->iteration }}" data-ss-id="{{ $satuanId }}">
                            <div class="timeline timeline-border-dashed">
                                <div class="alert bg-light-{{ $isSSSubmitted ? 'success' : 'warning' }} mb-5">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-information-5 fs-2qx me-4 text-{{ $isSSSubmitted ? 'success' : 'warning' }}">
                                            <i class="path1"></i>
                                            <i class="path2"></i>
                                            <i class="path3"></i>
                                        </i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-{{ $isSSSubmitted ? 'success' : 'warning' }}">Status: {{ $isSSSubmitted ? 'Sudah Diisi' : 'Belum Diisi' }}</h4>
                                            <span>Satuan Standar: {{ $satuanStandar->kode_satuan }} - {{ $satuanStandar->sasaran }}</span>
                                            <span class="text-muted mt-1">Progress: {{ $selectedInstruments }}/{{ $totalInstruments }} instrumen</span>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($indikators as $indikator)
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-icon">
                                            <span class="fs-5 text-gray-500">{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="timeline-content mb-10 mt-n1">
                                            <div class="pe-3 mb-5">
                                                <div class="fs-4 fw-bold text-gray-800 mb-2">
                                                    ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}
                                                </div>
                                                <div class="text-muted fs-6 mb-4">Berikut daftar instrumen yang terkait:</div>
                                            </div>

                                            @foreach ($indikator->instrumen as $instrumen)
                                                <div class="d-flex align-items-start border border-dashed border-gray-300 rounded px-6 py-4 mb-3">
                                                    <div class="flex-grow-1">
                                                        <div class="fs-6 fw-bold text-gray-900 mb-1">
                                                            {{ $loop->iteration }}. {{ $instrumen->indikator }}
                                                        </div>

                                                        @if ($instrumen->is_wajib == 1)
                                                            <div class="text-danger fw-semibold mb-2">
                                                                * Instrumen ini bersifat wajib dan sudah dipilih secara otomatis.
                                                            </div>
                                                        @endif
                                                        <div class="fs-7 text-muted">
                                                            <div><strong>Sumber:</strong> {{ $instrumen->sumber }}</div>
                                                            <div><strong>Target:</strong> {{ $instrumen->target }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 flex-wrap mt-3" style="max-width: 400px;">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="ya_{{ $instrumen->id }}"
                                                                value="1"
                                                                {{ ($instrumen->is_wajib == 1 || (isset($dataTerpilih) && isset($dataTerpilih['pilihan_'.$instrumen->id]) && $dataTerpilih['pilihan_'.$instrumen->id] == 1)) ? 'checked' : '' }}
                                                                {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                            >
                                                            <label class="form-check-label" for="ya_{{ $instrumen->id }}">Ya</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="tidak_{{ $instrumen->id }}"
                                                                value="0"
                                                                {{ (isset($dataTerpilih) && isset($dataTerpilih['pilihan_'.$instrumen->id]) && $dataTerpilih['pilihan_'.$instrumen->id] == 0) ? 'checked' : '' }}
                                                                {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                            >
                                                            <label class="form-check-label" for="tidak_{{ $instrumen->id }}">Tidak</label>
                                                        </div>

                                                        @if($instrumen->is_wajib == 1)
                                                            <input type="hidden" name="pilihan_{{ $instrumen->id }}" value="1">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation and Submit Buttons -->
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light-primary btn-prev" {{ $loop->first ? 'disabled' : '' }}>
                                    <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn btn-primary btn-next" data-ss-id="{{ $satuanStandar->id }}">
                                    {{ $loop->last ? 'Selesai' : 'Selanjutnya' }} <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wizardSteps = document.querySelectorAll('.wizard-step');
            const wizardContents = document.querySelectorAll('.wizard-content');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const nextButtons = document.querySelectorAll('.btn-next');

            // Get currentStep from sessionStorage or default to 1
            let currentStep = parseInt(sessionStorage.getItem('currentWizardStep')) || 1;
            let completedSteps = JSON.parse(sessionStorage.getItem('completedSteps')) || [];

            // Initialize first step
            updateWizardState();
            updateStepAccessibility();

            // Function to check if a step is completed
            function isStepCompleted(stepNumber) {
                return completedSteps.includes(stepNumber);
            }

            // Function to validate current step
            function validateCurrentStep() {
                const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                const radios = currentContent.querySelectorAll('input[type="radio"]');
                const radioGroups = {};

                // Group radios by name
                radios.forEach(radio => {
                    if (!radio.disabled) {
                        const name = radio.getAttribute('name');
                        if (!radioGroups[name]) {
                            radioGroups[name] = false;
                        }
                        if (radio.checked) {
                            radioGroups[name] = true;
                        }
                    }
                });

                // Check if all radio groups have a selection
                return Object.values(radioGroups).every(isChecked => isChecked);
            }

            // Function to update step accessibility
            function updateStepAccessibility() {
                wizardSteps.forEach((step, index) => {
                    const stepNumber = index + 1;
                    const isAccessible = stepNumber === 1 || isStepCompleted(stepNumber - 1);

                    step.style.pointerEvents = isAccessible ? 'auto' : 'none';
                    step.style.opacity = isAccessible ? '1' : '0.5';

                    if (!isAccessible) {
                        step.setAttribute('title', 'Selesaikan SS sebelumnya terlebih dahulu');
                    } else {
                        step.removeAttribute('title');
                    }
                });
            }

            // Add click event to wizard steps
            wizardSteps.forEach(step => {
                step.addEventListener('click', () => {
                    const stepNumber = parseInt(step.dataset.step);
                    if (stepNumber === 1 || isStepCompleted(stepNumber - 1)) {
                        currentStep = stepNumber;
                        saveCurrentStep();
                        updateWizardState();
                        updateProgress();
                    }
                });
            });

            // Add click event to navigation buttons
            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 1) {
                        currentStep--;
                        saveCurrentStep();
                        updateWizardState();
                        updateProgress();
                    }
                });
            });

            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ssId = this.dataset.ssId;

                    if (!validateCurrentStep()) {
                        Swal.fire({
                            text: "Mohon pilih Ya atau Tidak untuk setiap instrumen di Satuan Standar ini!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    // Prepare form data for current SS
                    const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('input[name="_token"]').value);
                    formData.append('auditee_id', document.querySelector('input[name="auditee_id"]').value);
                    formData.append('satuan_standar_id', ssId);

                    currentContent.querySelectorAll('input[type="radio"]:checked, input[type="hidden"]').forEach(input => {
                        formData.append(input.name, input.value);
                    });

                    // Show loading state
                    button.setAttribute('data-kt-indicator', 'on');
                    button.disabled = true;

                    // Send AJAX request
                    $.ajax({
                        url: '{{ route("auditee.pengajuanAmi.saveIkssSS") }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Reset button state
                            button.removeAttribute('data-kt-indicator');
                            button.disabled = false;

                            if (response.success) {
                                // Mark current step as completed
                                if (!completedSteps.includes(currentStep)) {
                                    completedSteps.push(currentStep);
                                    sessionStorage.setItem('completedSteps', JSON.stringify(completedSteps));
                                }

                                // Update UI to show SS is submitted
                                const alertDiv = currentContent.querySelector('.alert');
                                alertDiv.className = 'alert bg-light-success mb-5';
                                alertDiv.querySelector('i').className = 'ki-duotone ki-information-5 fs-2qx me-4 text-success';
                                alertDiv.querySelector('h4').className = 'mb-1 text-success';
                                alertDiv.querySelector('h4').textContent = 'Status: Sudah Diisi';

                                // Move to next step if not last
                                if (currentStep < wizardSteps.length) {
                                    currentStep++;
                                    saveCurrentStep();
                                    updateWizardState();
                                    updateProgress();
                                    updateStepAccessibility();
                                } else {
                                    // If it's the last step, show completion message
                                    Swal.fire({
                                        text: "Semua Satuan Standar telah berhasil diisi!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            // Reset button state
                            button.removeAttribute('data-kt-indicator');
                            button.disabled = false;

                            let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });
            });

            // Save current step to sessionStorage
            function saveCurrentStep() {
                sessionStorage.setItem('currentWizardStep', currentStep);
            }

            // Update wizard state
            function updateWizardState() {
                wizardSteps.forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                    } else if (isStepCompleted(stepNumber)) {
                        step.classList.add('completed');
                    }
                });

                wizardContents.forEach(content => {
                    content.classList.remove('active');
                    if (parseInt(content.dataset.step) === currentStep) {
                        content.classList.add('active');
                    }
                });

                // Update button states
                document.querySelectorAll('.btn-prev').forEach(btn => {
                    btn.disabled = currentStep === 1;
                });

                // Scroll to active content
                const activeContent = document.querySelector('.wizard-content.active');
                if (activeContent) {
                    activeContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            // Calculate and update progress
            function updateProgress() {
                const activeContent = document.querySelector('.wizard-content.active');
                if (!activeContent) return;

                // Calculate current SS progress
                const currentStepInstruments = activeContent.querySelectorAll('input[type="radio"]').length / 2;
                const currentStepChecked = activeContent.querySelectorAll('input[type="radio"]:checked').length;
                const currentStepProgress = (currentStepChecked / currentStepInstruments) * 100;

                // Get current SS info
                const currentSS = activeContent.querySelector('.alert span').textContent.split(':')[1].trim();

                // Update progress bar for current SS
                document.querySelector('.progress-bar').style.width = `${currentStepProgress}%`;
                document.querySelector('.progress-percentage').textContent = `${Math.round(currentStepProgress)}%`;

                // Update status text to show current SS progress
                document.querySelector('.progress-status').textContent =
                    `Progress ${currentSS}: ${currentStepChecked} dari ${currentStepInstruments} instrumen`;

                // Update step completion status
                if (currentStepChecked === currentStepInstruments) {
                    wizardSteps[currentStep - 1].classList.add('completed');
                } else {
                    wizardSteps[currentStep - 1].classList.remove('completed');
                }
            }

            // Add change event listener to all radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });

            // Initial progress calculation
            updateProgress();
            updateStepAccessibility();
        });
    </script>
@endpush
