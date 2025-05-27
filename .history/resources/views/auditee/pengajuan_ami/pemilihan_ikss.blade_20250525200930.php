@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Wizard navigation styles */
        .wizard-nav {
            display: flex;
            overflow-x: auto;
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--kt-border-dashed-color);
            gap: 1rem;
        }

        .wizard-step {
            min-width: 200px;
            padding: 1rem;
            border-radius: 0.475rem;
            background: var(--kt-card-bg);
            border: 1px solid var(--kt-border-color);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .wizard-step:hover {
            border-color: var(--kt-primary);
            box-shadow: 0 0 20px 0 rgba(var(--kt-primary-rgb), 0.1);
        }

        .wizard-step.active {
            border-color: var(--kt-primary);
            background: var(--kt-primary-light);
        }

        .wizard-step.completed {
            border-color: var(--kt-success);
            background: var(--kt-success-light);
        }

        .wizard-step .step-number {
            width: 35px;
            height: 35px;
            margin: 0 auto 0.5rem;
            border-radius: 50%;
            background: var(--kt-body-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border: 2px solid var(--kt-border-color);
            transition: all 0.3s ease;
        }

        .wizard-step.active .step-number {
            background: var(--kt-primary);
            color: var(--kt-primary-inverse);
            border-color: var(--kt-primary);
        }

        .wizard-step.completed .step-number {
            background: var(--kt-success);
            color: var(--kt-success-inverse);
            border-color: var(--kt-success);
        }

        .wizard-step .step-label {
            font-weight: 600;
            text-align: center;
            color: var(--kt-text-gray-800);
            margin-bottom: 0.25rem;
        }

        .wizard-step .step-desc {
            font-size: 0.85rem;
            color: var(--kt-text-gray-600);
            text-align: center;
        }

        .wizard-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .wizard-content.active {
            display: block;
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
                    <a
                        @if ($sudahMengisi)
                            href="{{ route('auditee.pengajuanAmi.instrumenAudit') }}"
                            class="btn btn-sm px-4 btn-primary"
                        @else
                            href="#"
                            class="btn btn-sm px-4 btn-secondary disabled"
                            style="cursor: not-allowed; opacity: 0.65;"
                        @endif
                    >
                        <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                    </a>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
            </div>

            <form id="formPemilihanIkss" action="{{ route('auditee.saveIkss') }}" method="POST" {{ $sudahMengisi ? 'class=form-disabled' : '' }}>
                @csrf
                <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                <!-- Wizard Navigation -->
                <div class="wizard-nav">
                    @foreach ($dataIkssProdi as $unit)
                        @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                            @php
                                $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                            @endphp
                            <div class="wizard-step" data-step="{{ $loop->iteration }}">
                                <div class="step-number">{{ $loop->iteration }}</div>
                                <div class="step-label">{{ $satuanStandar->kode_satuan }}</div>
                                <div class="step-desc">{{ Str::limit($satuanStandar->sasaran, 50) }}</div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- Wizard Content -->
                @foreach ($dataIkssProdi as $unit)
                    @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                        @php
                            $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                        @endphp
                        <div class="wizard-content" data-step="{{ $loop->iteration }}">
                            <div class="mb-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div>
                                        <h3 class="fs-4 fw-bold text-dark mb-0">Progress Pemilihan IKSS - {{ $satuanStandar->kode_satuan }}</h3>
                                        <span class="text-gray-600 progress-status-ss-{{ $loop->iteration }}">Instrumen yang telah dipilih: 0 dari 0 instrumen</span>
                                    </div>
                                    <span class="fs-2 fw-bolder text-primary progress-percentage-ss-{{ $loop->iteration }}">0%</span>
                                </div>

                                <div class="h-8px bg-light rounded">
                                    <div class="bg-primary rounded h-8px progress-bar-ss-{{ $loop->iteration }}" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="timeline timeline-border-dashed">
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
                                                                {{ ($instrumen->is_wajib == 1 || (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 1)) ? 'checked' : '' }}
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
                                                                {{ (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 0) ? 'checked' : '' }}
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

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light-primary btn-prev" {{ $loop->first ? 'disabled' : '' }}>
                                    <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                </button>
                                @if($loop->last)
                                    @if(!$sudahMengisi)
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i> Simpan Semua Pilihan
                                        </button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-primary btn-next">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @endif
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
            let currentStep = 1;

            // Initialize first step
            updateWizardState();

            // Add click event to wizard steps
            wizardSteps.forEach(step => {
                step.addEventListener('click', () => {
                    if (!step.classList.contains('active')) {
                        currentStep = parseInt(step.dataset.step);
                        updateWizardState();
                    }
                });
            });

            // Add click event to navigation buttons
            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 1) {
                        currentStep--;
                        updateWizardState();
                    }
                });
            });

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep < wizardSteps.length) {
                        currentStep++;
                        updateWizardState();
                    }
                });
            });

            // Update wizard state
            function updateWizardState() {
                // Update steps
                wizardSteps.forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                    } else if (stepNumber < currentStep) {
                        step.classList.add('completed');
                    }
                });

                // Update content visibility
                wizardContents.forEach(content => {
                    content.classList.remove('active');
                    if (parseInt(content.dataset.step) === currentStep) {
                        content.classList.add('active');
                    }
                });

                // Update button states
                prevButtons.forEach(button => {
                    button.disabled = currentStep === 1;
                });

                nextButtons.forEach(button => {
                    button.disabled = currentStep === wizardSteps.length;
                });

                // Scroll to top of the active content
                const activeContent = document.querySelector('.wizard-content.active');
                if (activeContent) {
                    activeContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            // Calculate and update progress for specific Satuan Standar
            function updateProgressSS(stepNumber) {
                const content = document.querySelector(`.wizard-content[data-step="${stepNumber}"]`);
                if (!content) return;

                const totalInstruments = content.querySelectorAll('input[type="radio"]').length / 2;
                const checkedInstruments = content.querySelectorAll('input[type="radio"]:checked').length;
                const progress = (checkedInstruments / totalInstruments) * 100;

                // Update progress bar for this SS
                const progressBar = content.querySelector(`.progress-bar-ss-${stepNumber}`);
                const progressPercentage = content.querySelector(`.progress-percentage-ss-${stepNumber}`);
                const progressStatus = content.querySelector(`.progress-status-ss-${stepNumber}`);

                if (progressBar && progressPercentage && progressStatus) {
                    progressBar.style.width = `${progress}%`;
                    progressBar.setAttribute('aria-valuenow', progress);
                    progressPercentage.textContent = `${Math.round(progress)}%`;
                    progressStatus.textContent = `Instrumen yang telah dipilih: ${checkedInstruments} dari ${totalInstruments} instrumen`;

                    // Update progress bar color based on completion
                    if (progress === 100) {
                        progressBar.classList.remove('bg-primary');
                        progressBar.classList.add('bg-success');
                        progressPercentage.classList.remove('text-primary');
                        progressPercentage.classList.add('text-success');
                    } else {
                        progressBar.classList.remove('bg-success');
                        progressBar.classList.add('bg-primary');
                        progressPercentage.classList.remove('text-success');
                        progressPercentage.classList.add('text-primary');
                    }

                    // Update wizard step status
                    const wizardStep = document.querySelector(`.wizard-step[data-step="${stepNumber}"]`);
                    if (wizardStep) {
                        if (progress === 100) {
                            wizardStep.classList.add('completed');
                        } else {
                            wizardStep.classList.remove('completed');
                        }
                    }
                }
            }

            // Add change event listener to all radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    // Get the step number from the closest wizard-content
                    const wizardContent = radio.closest('.wizard-content');
                    if (wizardContent) {
                        const stepNumber = wizardContent.dataset.step;
                        updateProgressSS(stepNumber);
                    }
                });
            });

            // Initial progress calculation for all steps
            document.querySelectorAll('.wizard-content').forEach(content => {
                const stepNumber = content.dataset.step;
                updateProgressSS(stepNumber);
            });

            // Form submission handling
            const form = document.getElementById('formPemilihanIkss');
            if (form && !form.classList.contains('form-disabled')) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Validate form
                    let formValid = true;
                    let radiosWithName = {};

                    // Check each radio button group
                    this.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                        const name = radio.getAttribute('name');
                        if (!name.includes('_')) return;

                        // Skip disabled radio buttons (mandatory instruments)
                        if (radio.disabled && !radio.classList.contains('required-selection')) return;

                        radiosWithName[name] = true;
                    });

                    // Check if each radio group has a selection
                    for (let name in radiosWithName) {
                        if (form.querySelector(`input[name="${name}"]:checked`) === null) {
                            formValid = false;
                            break;
                        }
                    }

                    if (!formValid) {
                        Swal.fire({
                            title: 'Validasi Gagal',
                            text: 'Mohon pilih Ya atau Tidak untuk setiap instrumen!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Simpan',
                        text: 'Apakah Anda yakin dengan pilihan IKSS Anda? Data yang disimpan tidak dapat diubah kembali.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Menyimpan Data',
                                text: 'Mohon tunggu...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Submit form
                            $.ajax({
                                url: this.action,
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: response.message,
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed && response.redirect_url) {
                                                window.location.href = response.redirect_url;
                                            } else {
                                                window.location.reload();
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: response.message,
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                    Swal.fire({
                                        title: 'Error!',
                                        text: errorMessage,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            }
        });
    </script>
@endpush
