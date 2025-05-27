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
            @php
                // Hitung total instrumen dan yang sudah diisi
                $totalInstrumen = 0;
                $totalDiisi = 0;

                foreach ($dataIkssProdi as $unit) {
                    foreach ($unit->indikatorKinerjas as $indikator) {
                        foreach ($indikator->instrumen as $instrumen) {
                            $totalInstrumen++;
                            if ($instrumen->is_wajib == 1) {
                                $totalDiisi++;
                            } elseif (isset($dataTerpilih['pilihan_'.$instrumen->id])) {
                                $totalDiisi++;
                            }
                        }
                    }
                }

                // Update status sudah mengisi hanya jika semua instrumen telah diisi
                $semuaInstrumenDiisi = ($totalInstrumen > 0 && $totalDiisi == $totalInstrumen);
            @endphp

            <div class="alert {{ $semuaInstrumenDiisi ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $semuaInstrumenDiisi ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $semuaInstrumenDiisi ? '✨ IKSS Telah Dipilih' : '📢 Pilih IKSS' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $semuaInstrumenDiisi ? 'Selamat!' : 'Catatan:' }}</strong>
                            <span class="fw-semibold {{ $semuaInstrumenDiisi ? 'text-success' : 'text-danger' }}">
                                @if($semuaInstrumenDiisi)
                                    IKSS telah dipilih dengan lengkap. Silakan lanjut ke tahap pengisian Instrumen Audit.
                                @else
                                    Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto">
                    @if ($semuaInstrumenDiisi)
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

            <form id="formPemilihanIkss" action="{{ route('auditee.pengajuanAmi.saveIkss') }}" method="POST" {{ $semuaInstrumenDiisi ? 'class=form-disabled' : '' }}>
                @csrf
                <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                <!-- Wizard Navigation -->
                <div class="wizard-nav">
                    @foreach ($dataIkssProdi as $unit)
                        @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                        @php
                            $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                            $totalInstruments = 0;
                            $selectedInstruments = 0; // Changed: count all selected instruments (both Ya and Tidak)
                            $selectedYesInstruments = 0; // Keep track of "Ya" selections for display
                            $radioInstruments = [];

                            // First pass: collect all instruments and their status
                            foreach ($indikators as $indikator) {
                                foreach ($indikator->instrumen as $instrumen) {
                                    $totalInstruments++;
                                    $isSelected = false;
                                    $isSelectedYes = false;

                                    // Check if instrument is selected either by being mandatory or by user choice
                                    if ($instrumen->is_wajib == 1) {
                                        $isSelected = true;
                                        $isSelectedYes = true; // Mandatory instruments are always "Ya"
                                    } elseif (isset($dataTerpilih['pilihan_'.$instrumen->id])) {
                                        $isSelected = true;
                                        if ($dataTerpilih['pilihan_'.$instrumen->id] == 1) {
                                            $isSelectedYes = true;
                                        }
                                    }

                                    if ($isSelected) {
                                        $selectedInstruments++; // Count any selection (Ya or Tidak)
                                    }
                                    if ($isSelectedYes) {
                                        $selectedYesInstruments++; // Count only "Ya" selections
                                    }

                                    $radioInstruments[$instrumen->id] = [
                                        'is_selected' => $isSelected,
                                        'is_selected_yes' => $isSelectedYes,
                                        'is_wajib' => $instrumen->is_wajib == 1
                                    ];
                                }
                            }

                            // Step is completed if ALL instruments have been selected (regardless of Ya/Tidak)
                            $isSSSubmitted = $totalInstruments > 0 && $selectedInstruments === $totalInstruments;

                            // Debug information
                            error_log("SS {$satuanStandar->kode_satuan}:");
                            error_log("Total Instruments: {$totalInstruments}");
                            error_log("Selected Instruments (Any): {$selectedInstruments}");
                            error_log("Selected Yes Instruments: {$selectedYesInstruments}");
                            error_log("Is SS Submitted: " . ($isSSSubmitted ? 'Yes' : 'No'));
                            foreach ($radioInstruments as $id => $info) {
                                error_log("Instrument {$id}: Selected=" . ($info['is_selected'] ? 'Yes' : 'No') . ", Selected Yes=" . ($info['is_selected_yes'] ? 'Yes' : 'No') . ", Mandatory=" . ($info['is_wajib'] ? 'Yes' : 'No'));
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
                                            <span class="text-muted mt-1">Progress: {{ $selectedInstruments }}/{{ $totalInstruments }} instrumen dipilih ({{ $selectedYesInstruments }} dipilih YA)</span>
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
                                                            {{ $loop->iteration }}. {!! $instrumen->indikator }}
                                                        </div>
                                                        @if ($instrumen->is_wajib == 1)
                                                            @if ($instrumen->jenjang == 'Semua' || $instrumen->jenjang == optional(Auth::user()->unitKerja)->jenjang)
                                                                <div class="text-danger fw-semibold mb-2">
                                                                    * Instrumen ini bersifat wajib dan sudah dipilih secara otomatis.
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="fs-7 text-muted">
                                                            <div><strong>Sumber:</strong> {!! $instrumen->sumber !!}</div>
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
                                                                {{ $instrumen->is_wajib == 1 ? 'disabled' : '' }}
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
                                                                {{ $instrumen->is_wajib == 1 ? 'disabled' : '' }}
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
            // Initialize data from database
            const dataTerpilih = @json($dataTerpilih);

            // Set initial radio button states based on database data
            Object.entries(dataTerpilih).forEach(([key, value]) => {
                const instrumenId = key.replace('pilihan_', '');
                const radio = document.querySelector(`input[type="radio"][name="pilihan_${instrumenId}"][value="${value}"]`);
                if (radio) {
                    radio.checked = true;
                }
            });

            const wizardSteps = document.querySelectorAll('.wizard-step');
            const wizardContents = document.querySelectorAll('.wizard-content');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const nextButtons = document.querySelectorAll('.btn-next');

            // Find first incomplete step
            let firstIncompleteStep = 1;
            let foundIncomplete = false;

            wizardContents.forEach((content, index) => {
                const stepNumber = index + 1;
                let stepTotalInstruments = 0;
                let stepSelectedInstruments = 0;

                content.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    stepTotalInstruments++;
                    const isWajib = group.querySelector('input[type="hidden"][name^="pilihan_"]') !== null;
                    const radioName = group.querySelector('input[type="radio"]')?.name;
                    const instrumenId = radioName?.replace('pilihan_', '');

                    if (isWajib) {
                        stepSelectedInstruments++;
                    } else if (instrumenId && dataTerpilih[`pilihan_${instrumenId}`] !== undefined) {
                        stepSelectedInstruments++;
                    }
                });

                // If this step is not complete and we haven't found an incomplete step yet
                if (!foundIncomplete && stepTotalInstruments > 0 && stepSelectedInstruments < stepTotalInstruments) {
                    firstIncompleteStep = stepNumber;
                    foundIncomplete = true;
                }
            });

            // Set current step to first incomplete step
            let currentStep = firstIncompleteStep;
            sessionStorage.setItem('currentWizardStep', currentStep);

            // Initialize wizard state
            updateWizardState();
            updateStepAccessibility();
            updateOverallProgress();

            // Function to check if a step is completed
            function isStepCompleted(stepNumber) {
                const content = document.querySelector(`.wizard-content[data-step="${stepNumber}"]`);
                if (!content) return false;

                let totalInstruments = 0;
                let selectedInstruments = 0;

                content.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    totalInstruments++;
                    const isWajib = group.querySelector('input[type="hidden"][name^="pilihan_"]') !== null;
                    const radioName = group.querySelector('input[type="radio"]')?.name;
                    const instrumenId = radioName?.replace('pilihan_', '');

                    // Check if instrument is selected (either wajib or has any selection)
                    if (isWajib) {
                        selectedInstruments++;
                    } else if (instrumenId) {
                        const checkedRadio = group.querySelector(`input[name="pilihan_${instrumenId}"]:checked`);
                        if (checkedRadio) {
                            selectedInstruments++;
                        }
                    }
                });

                // Debug log untuk melihat status setiap step
                console.log(`Step ${stepNumber}: ${selectedInstruments}/${totalInstruments} instruments selected`);

                return totalInstruments > 0 && selectedInstruments === totalInstruments;
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

                    // Debug log untuk melihat status accessibility setiap step
                    console.log(`Step ${stepNumber} accessibility:`, isAccessible);

                    step.style.pointerEvents = isAccessible ? 'auto' : 'none';
                    step.style.opacity = isAccessible ? '1' : '0.5';

                    if (!isAccessible) {
                        step.setAttribute('title', 'Selesaikan SS sebelumnya terlebih dahulu');
                    } else {
                        step.removeAttribute('title');
                    }

                    // Update completed status
                    if (isStepCompleted(stepNumber)) {
                        step.classList.add('completed');
                    } else {
                        step.classList.remove('completed');
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
                        updateCurrentStepProgress();
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
                        updateCurrentStepProgress();
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

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Pengisian',
                        text: "Apakah Anda yakin dengan pilihan Anda? Data yang sudah disimpan tidak dapat diubah kembali.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            button.setAttribute('data-kt-indicator', 'on');
                            button.disabled = true;

                            // Prepare form data for current SS
                            const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('input[name="_token"]').value);
                            formData.append('auditee_id', document.querySelector('input[name="auditee_id"]').value);
                            formData.append('satuan_standar_id', ssId);

                            currentContent.querySelectorAll('input[type="radio"]:checked, input[type="hidden"]').forEach(input => {
                                formData.append(input.name, input.value);
                            });

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
                                        // Show success message
                                        Swal.fire({
                                            text: "Data berhasil disimpan!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then((result) => {
                                            // Move to next step if not last
                                            if (currentStep < wizardSteps.length) {
                                                currentStep++;
                                                saveCurrentStep();
                                                updateWizardState();
                                                updateCurrentStepProgress();
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
                                        });
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
                        }
                    });
                });
            });

            // Save current step to sessionStorage
            function saveCurrentStep() {
                sessionStorage.setItem('currentWizardStep', currentStep);
            }

            // Calculate and update progress for current SS only
            function updateCurrentStepProgress() {
                const activeContent = document.querySelector('.wizard-content.active');
                if (!activeContent) return;

                let totalInstruments = 0;
                let selectedInstruments = 0; // Changed: count all selected instruments
                let selectedYesCount = 0; // Keep this for display purposes

                // Count all instruments and their status in current SS
                activeContent.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    totalInstruments++;

                    const isWajib = group.querySelector('input[type="hidden"][name^="pilihan_"]') !== null;
                    const radioName = group.querySelector('input[type="radio"]')?.name;
                    const instrumenId = radioName?.replace('pilihan_', '');

                    let isSelectedYes = false;
                    let hasSelection = false;

                    if (isWajib) {
                        isSelectedYes = true;
                        hasSelection = true;
                    } else if (instrumenId) {
                        const checkedRadio = group.querySelector(`input[name="pilihan_${instrumenId}"]:checked`);
                        if (checkedRadio) {
                            hasSelection = true;
                            if (checkedRadio.value == '1') {
                                isSelectedYes = true;
                            }
                        }
                    }

                    if (isSelectedYes) {
                        selectedYesCount++;
                    }
                    if (hasSelection) {
                        selectedInstruments++; // Count any selection (Ya or Tidak)
                    }
                });

                // Update status text for current SS - show both selected and "Ya" count
                const statusText = activeContent.querySelector('.text-muted.mt-1');
                if (statusText) {
                    statusText.textContent = `Progress: ${selectedInstruments}/${totalInstruments} instrumen dipilih (${selectedYesCount} dipilih YA)`;
                }

                // Update alert status based on whether all instruments are selected
                const alertDiv = activeContent.querySelector('.alert');
                const statusHeader = alertDiv.querySelector('h4');

                // Step is completed if all instruments have been selected (regardless of Ya/Tidak)
                if (selectedInstruments === totalInstruments && totalInstruments > 0) {
                    alertDiv.className = 'alert bg-light-success mb-5';
                    alertDiv.querySelector('i').className = 'ki-duotone ki-information-5 fs-2qx me-4 text-success';
                    statusHeader.className = 'mb-1 text-success';
                    statusHeader.textContent = 'Status: Sudah Diisi';
                } else {
                    alertDiv.className = 'alert bg-light-warning mb-5';
                    alertDiv.querySelector('i').className = 'ki-duotone ki-information-5 fs-2qx me-4 text-warning';
                    statusHeader.className = 'mb-1 text-warning';
                    statusHeader.textContent = 'Status: Belum Diisi';
                }
            }

            // Function to update overall progress bar
            function updateOverallProgress() {
                let totalInstrumentsAll = 0;
                let selectedInstrumentsAll = 0;
                let totalSteps = wizardContents.length;
                let ssProgress = 0;

                // Count all instruments and selected instruments across all steps
                wizardContents.forEach((content, index) => {
                    const stepNumber = index + 1;
                    let stepTotalInstruments = 0;
                    let stepSelectedInstruments = 0;

                    content.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                        stepTotalInstruments++;
                        totalInstrumentsAll++;

                        const isWajib = group.querySelector('input[type="hidden"][name^="pilihan_"]') !== null;
                        const radioName = group.querySelector('input[type="radio"]')?.name;
                        const instrumenId = radioName?.replace('pilihan_', '');

                        // Check if instrument is selected (either wajib or has any selection)
                        if (isWajib) {
                            stepSelectedInstruments++;
                            selectedInstrumentsAll++;
                        } else if (instrumenId) {
                            const checkedRadio = group.querySelector(`input[name="pilihan_${instrumenId}"]:checked`);
                            if (checkedRadio) {
                                stepSelectedInstruments++;
                                selectedInstrumentsAll++;
                            }
                        }
                    });
                });

                // Update overall progress bar
                const progressBar = document.querySelector('.progress-bar');
                const progressPercentage = document.querySelector('.progress-percentage');
                const progressStatus = document.querySelector('.progress-status');

                if (progressBar && progressPercentage && progressStatus) {
                    // Calculate percentage based on total instruments selected vs total instruments
                    const overallPercentage = totalInstrumentsAll > 0
                        ? Math.round((selectedInstrumentsAll / totalInstrumentsAll) * 100)
                        : 0;

                    progressBar.style.width = `${overallPercentage}%`;
                    progressBar.setAttribute('aria-valuenow', overallPercentage);
                    progressPercentage.textContent = `${overallPercentage}%`;

                    if (overallPercentage === 100) {
                        progressStatus.textContent = 'Semua instrumen telah selesai dipilih';
                    } else if (overallPercentage > 0) {
                        progressStatus.textContent = `${selectedInstrumentsAll}/${totalInstrumentsAll} instrumen telah dipilih (Progress: ${overallPercentage}%)`;
                    } else {
                        progressStatus.textContent = 'Belum ada instrumen yang dipilih';
                    }
                }
            }

            // Add event listener for radio button changes
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    updateCurrentStepProgress();
                    updateOverallProgress();
                    updateStepAccessibility(); // Update accessibility after any change
                });
            });

            // Update accessibility initially and after AJAX success
            updateStepAccessibility();

            // Initial setup when page loads
            function initializeProgress() {
                // Update progress for current SS
                updateCurrentStepProgress();
                // Update overall progress
                updateOverallProgress();
            }

            // Initialize progress when page loads
            initializeProgress();
        });
    </script>
@endpush
