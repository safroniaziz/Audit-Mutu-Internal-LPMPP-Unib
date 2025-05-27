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

            <!--begin::Content-->
            <div class="flex-row-fluid py-lg-5 px-lg-15">
                <!--begin::Form-->
                <form id="formPemilihanIkss" class="form" action="{{ route('auditee.saveIkss') }}" method="POST" {{ $sudahMengisi ? 'class=form-disabled' : '' }}>
                    @csrf
                    <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                    <!--begin::Alert-->
                    @if($sudahMengisi)
                        <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-information fs-2hx text-warning me-4 mb-5 mb-sm-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-semibold">Data IKSS sudah diisi</h4>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <span>Anda telah mengisi data IKSS untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                    <!--end::Alert-->

                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step progress-->
                        <div class="card bg-light-primary shadow-sm mb-5">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fs-6 fw-bold text-gray-800">Total Progress</span>
                                    <span class="fs-6 fw-bolder text-primary progress-percentage">0%</span>
                                </div>
                                <div class="progress h-5px bg-light-primary">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fs-7 fw-semibold text-gray-600 mt-2 progress-status d-block">Instrumen yang telah dipilih: 0 dari 0 instrumen</span>
                            </div>
                        </div>
                        <!--end::Step progress-->

                        <!--begin::Wizard Content-->
                        @foreach ($dataIkssProdi as $unit)
                            @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                                @php
                                    $satuanStandar = App\Models\SatuanStandar::find($satuanId);
                                @endphp
                                <div class="flex-column" data-kt-stepper-element="content" data-step="{{ $loop->iteration }}">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <h2 class="fw-bold text-dark">{{ $satuanStandar->kode_satuan }}</h2>
                                            <div class="text-muted fw-semibold fs-6">{{ $satuanStandar->sasaran }}</div>
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Progress-->
                                            <div class="d-flex align-items-center w-100 flex-column mt-3">
                                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                    <span class="fw-semibold fs-6 text-gray-600">Progress Satuan Standar Ini</span>
                                                    <span class="fw-bold fs-6 progress-percentage-step">0%</span>
                                                </div>
                                                <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                    <div class="bg-success rounded h-5px progress-bar-step" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <!--end::Progress-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::IKSS items-->
                                        @foreach ($indikators as $indikator)
                                            <!--begin::IKSS item-->
                                            <div class="card shadow-sm mb-5">
                                                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#ikss_{{ $indikator->id }}">
                                                    <h3 class="card-title">{{ $indikator->kode_ikss }}</h3>
                                                    <div class="card-toolbar rotate-180">
                                                        <i class="ki-duotone ki-down fs-1"></i>
                                                    </div>
                                                </div>
                                                <div id="ikss_{{ $indikator->id }}" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="fw-bold fs-5 text-gray-800 mb-5">{{ $indikator->tujuan }}</div>

                                                        <!--begin::Instruments-->
                                                        @foreach ($indikator->instrumen as $instrumen)
                                                            <div class="card card-bordered mb-5 {{ $instrumen->is_wajib ? 'border-primary' : '' }}">
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-stack mb-3">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="symbol symbol-40px me-4">
                                                                                <div class="symbol-label fs-2 fw-semibold bg-light-primary text-primary">
                                                                                    {{ $loop->iteration }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex flex-column">
                                                                                <span class="fs-5 text-dark fw-bold">{{ $instrumen->indikator }}</span>
                                                                                @if ($instrumen->is_wajib == 1)
                                                                                    <span class="badge badge-light-primary">Instrumen Wajib</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex gap-4">
                                                                            <label class="form-check form-check-custom form-check-solid me-10">
                                                                                <input
                                                                                    class="form-check-input h-20px w-20px"
                                                                                    type="radio"
                                                                                    name="pilihan_{{ $instrumen->id }}"
                                                                                    value="1"
                                                                                    {{ ($instrumen->is_wajib == 1 || (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 1)) ? 'checked' : '' }}
                                                                                    {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                                                />
                                                                                <span class="fw-semibold ps-2 fs-6">Ya</span>
                                                                            </label>
                                                                            <label class="form-check form-check-custom form-check-solid">
                                                                                <input
                                                                                    class="form-check-input h-20px w-20px"
                                                                                    type="radio"
                                                                                    name="pilihan_{{ $instrumen->id }}"
                                                                                    value="0"
                                                                                    {{ (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 0) ? 'checked' : '' }}
                                                                                    {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                                                />
                                                                                <span class="fw-semibold ps-2 fs-6">Tidak</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="separator my-5"></div>
                                                                    <div class="d-flex flex-stack">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-gray-600 fw-semibold">Sumber:</span>
                                                                            <span class="text-gray-800">{{ $instrumen->sumber }}</span>
                                                                        </div>
                                                                        <div class="d-flex flex-column text-end">
                                                                            <span class="text-gray-600 fw-semibold">Target:</span>
                                                                            <span class="text-gray-800">{{ $instrumen->target }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <!--end::Instruments-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::IKSS item-->
                                        @endforeach
                                        <!--end::IKSS items-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                            @endforeach
                        @endforeach
                        <!--end::Wizard Content-->
                    </div>
                    <!--end::Group-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                                <i class="ki-duotone ki-arrow-left fs-3 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Sebelumnya
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                Selanjutnya
                                <i class="ki-duotone ki-arrow-right fs-3 ms-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>

                            @if(!$sudahMengisi)
                                <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit">
                                    <span class="indicator-label">
                                        <i class="ki-duotone ki-check fs-3 ms-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Simpan Semua Pilihan
                                    </span>
                                    <span class="indicator-progress">
                                        Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            @endif
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
    <!--end::details View-->
@endsection

@push('scripts')
    <script>
        // Initialize form validation
        var validator;

        // Initialize stepper
        var stepper = new KTStepper(document.querySelector("#kt_stepper_ikss"));

        // Stepper change event
        stepper.on("kt.stepper.changed", function (stepper) {
            if (stepper.getCurrentStepIndex() === stepper.getStepsCount()) {
                document.querySelector('[data-kt-stepper-action="next"]').classList.add("d-none");
                document.querySelector('[data-kt-stepper-action="submit"]').classList.remove("d-none");
            } else {
                document.querySelector('[data-kt-stepper-action="next"]').classList.remove("d-none");
                document.querySelector('[data-kt-stepper-action="submit"]').classList.add("d-none");
            }
        });

        // Validation before going to next page
        stepper.on("kt.stepper.next", function (stepper) {
            // Validate current step
            if (validator) {
                validator.validate().then(function (status) {
                    if (status == "Valid") {
                        stepper.goNext();
                        KTUtil.scrollTop();
                    }
                });
            } else {
                stepper.goNext();
                KTUtil.scrollTop();
            }
        });

        // Previous step
        stepper.on("kt.stepper.previous", function (stepper) {
            stepper.goPrevious();
            KTUtil.scrollTop();
        });

        // Calculate and update progress
        function updateProgress() {
            const totalInstruments = document.querySelectorAll('input[type="radio"]').length / 2;
            const checkedInstruments = document.querySelectorAll('input[type="radio"]:checked').length;
            const progress = (checkedInstruments / totalInstruments) * 100;

            // Update main progress
            const progressBar = document.querySelector('.progress-bar');
            const progressPercentage = document.querySelector('.progress-percentage');
            const progressStatus = document.querySelector('.progress-status');

            if (progressBar && progressPercentage && progressStatus) {
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
                progressPercentage.textContent = `${Math.round(progress)}%`;
                progressStatus.textContent = `Instrumen yang telah dipilih: ${checkedInstruments} dari ${totalInstruments} instrumen`;

                // Change color when complete
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
            }

            // Update step progress
            document.querySelectorAll('[data-kt-stepper-element="content"]').forEach(content => {
                const stepInstruments = content.querySelectorAll('input[type="radio"]').length / 2;
                const stepChecked = content.querySelectorAll('input[type="radio"]:checked').length;
                const stepProgress = (stepChecked / stepInstruments) * 100;

                const stepProgressBar = content.querySelector('.progress-bar-step');
                const stepProgressText = content.querySelector('.progress-percentage-step');

                if (stepProgressBar && stepProgressText) {
                    stepProgressBar.style.width = `${stepProgress}%`;
                    stepProgressBar.setAttribute('aria-valuenow', stepProgress);
                    stepProgressText.textContent = `${Math.round(stepProgress)}%`;

                    // Change color when step is complete
                    if (stepProgress === 100) {
                        stepProgressBar.classList.remove('bg-primary');
                        stepProgressBar.classList.add('bg-success');
                        stepProgressText.classList.remove('text-primary');
                        stepProgressText.classList.add('text-success');
                    } else {
                        stepProgressBar.classList.remove('bg-success');
                        stepProgressBar.classList.add('bg-primary');
                        stepProgressText.classList.remove('text-success');
                        stepProgressText.classList.add('text-primary');
                    }
                }
            });
        }

        // Form submission handling
        const form = document.getElementById('formPemilihanIkss');
        if (form) {
            // Add change event listener to all radio buttons
            form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });

            // Initial progress calculation
            updateProgress();

            // Form submit handler
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
                        text: "Mohon pilih Ya atau Tidak untuk setiap instrumen!",
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
                    text: "Apakah Anda yakin dengan pilihan IKSS Anda? Data yang disimpan tidak dapat diubah kembali.",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Ya, Simpan!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-light"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading indication
                        form.querySelector('[data-kt-stepper-action="submit"]').setAttribute("data-kt-indicator", "on");
                        form.querySelector('[data-kt-stepper-action="submit"]').disabled = true;

                        // Send form with AJAX
                        $.ajax({
                            url: form.getAttribute('action'),
                            type: 'POST',
                            data: new FormData(form),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                // Hide loading indication
                                form.querySelector('[data-kt-stepper-action="submit"]').removeAttribute("data-kt-indicator");
                                form.querySelector('[data-kt-stepper-action="submit"]').disabled = false;

                                if (response.success) {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed && response.redirect_url) {
                                            window.location.href = response.redirect_url;
                                        } else {
                                            window.location.reload();
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
                                // Hide loading indication
                                form.querySelector('[data-kt-stepper-action="submit"]').removeAttribute("data-kt-indicator");
                                form.querySelector('[data-kt-stepper-action="submit"]').disabled = false;

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
        }

        // Initialize Bootstrap tooltips
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize Bootstrap collapse for IKSS items
        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(el => {
            el.addEventListener('click', function() {
                const target = document.querySelector(this.dataset.bsTarget);
                if (target) {
                    this.querySelector('.rotate-180').classList.toggle('rotate-0');
                }
            });
        });
    </script>
@endpush

@endpush
