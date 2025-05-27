@extends('auditee/dashboard_template')
@push('styles')
    <style>
        .wizard-nav {
            display: flex;
            overflow-x: auto;
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #E4E6EF;
        }

        .wizard-step {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 1rem;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .wizard-step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            width: 100%;
            height: 2px;
            background: #E4E6EF;
            transform: translateY(-50%);
            z-index: 1;
        }

        .wizard-step.active {
            color: #009EF7;
        }

        .wizard-step.completed {
            color: #50CD89;
        }

        .wizard-step .step-number {
            width: 35px;
            height: 35px;
            margin: 0 auto 0.5rem;
            border-radius: 50%;
            background: #F5F8FA;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            border: 2px solid #E4E6EF;
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
            animation: fadeIn 0.5s ease;
        }

        .wizard-nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding: 1rem 0;
            border-top: 1px solid #E4E6EF;
        }

        .satuan-standar-info {
            background: #F5F8FA;
            border-radius: 0.475rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .satuan-standar-progress {
            background: #ffffff;
            border: 1px solid #E4E6EF;
            border-radius: 0.475rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Add these styles to your CSS file */
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        /* Style for the already submitted notice */
        .notice {
            border-left: 4px solid #FFA800 !important;
        }
    </style>
@endpush
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
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
                            <diva class="fs-6 text-gray-700">Anda telah mengisi data IKSS untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</diva>
                        </div>
                    </div>
                </div>
            @endif

            <div class="alert {{ $sudahMengisi ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10 position-relative">
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
                            style=""
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

            <div class="mb-8">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fs-4 fw-bold text-dark mb-0">Progress Pemilihan IKSS</h3>
                        <span class="text-gray-600 progress-status">Instrumen yang telah dipilih: 0 dari 0 instrumen</span>
                    </div>
                    <span class="fs-2 fw-bolder text-primary progress-percentage">0%</span>
                </div>

                <div class="h-8px bg-light rounded">
                    <div class="bg-primary rounded h-8px progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <div class="step-title fs-7">{{ Str::limit($satuanStandar->sasaran, 30) }}</div>
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
                            <div class="satuan-standar-info">
                                <h3 class="fs-4 fw-bold mb-4">{{ $satuanStandar->kode_satuan }} - {{ $satuanStandar->sasaran }}</h3>
                                <div class="d-flex flex-column gap-2">
                                    <div><strong>Kode:</strong> {{ $satuanStandar->kode_satuan }}</div>
                                    <div><strong>Sasaran:</strong> {{ $satuanStandar->sasaran }}</div>
                                                        </div>
                                                        </div>

                            <div class="satuan-standar-progress mb-8">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-gray-600">Progress Satuan Standar Ini</span>
                                    <span class="fs-6 fw-bolder text-primary progress-percentage-step">0%</span>
                                                </div>
                                <div class="h-4px bg-light rounded">
                                    <div class="bg-primary rounded h-4px progress-bar-step" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <div class="wizard-nav-buttons">
                                <button type="button" class="btn btn-light btn-prev" {{ $loop->first ? 'disabled' : '' }}>
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
    <!--end::details View-->
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

            // Calculate and update progress
            function updateProgress() {
                const totalInstruments = document.querySelectorAll('input[type="radio"]').length / 2;
                const checkedInstruments = document.querySelectorAll('input[type="radio"]:checked').length;
                const progress = (checkedInstruments / totalInstruments) * 100;

                // Update main progress
                document.querySelector('.progress-bar').style.width = `${progress}%`;
                document.querySelector('.progress-percentage').textContent = `${Math.round(progress)}%`;
                document.querySelector('.progress-status').textContent =
                    `Instrumen yang telah dipilih: ${checkedInstruments} dari ${totalInstruments} instrumen`;

                // Update step progress
                wizardContents.forEach(content => {
                    const stepInstruments = content.querySelectorAll('input[type="radio"]').length / 2;
                    const stepChecked = content.querySelectorAll('input[type="radio"]:checked').length;
                    const stepProgress = (stepChecked / stepInstruments) * 100;

                    const progressBar = content.querySelector('.progress-bar-step');
                    const progressText = content.querySelector('.progress-percentage-step');

                    if (progressBar && progressText) {
                        progressBar.style.width = `${stepProgress}%`;
                        progressText.textContent = `${Math.round(stepProgress)}%`;
                    }
                });
            }

            // Add change event listener to all radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });

            // Initial progress calculation
            updateProgress();
        });
    </script>
@endpush
