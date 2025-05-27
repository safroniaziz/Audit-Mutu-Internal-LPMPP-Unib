@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Wizard navigation styles */
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
                wizardSteps.forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                    } else if (stepNumber < currentStep) {
                        step.classList.add('completed');
                    }
                });

                wizardContents.forEach(content => {
                    content.classList.remove('active');
                    if (parseInt(content.dataset.step) === currentStep) {
                        content.classList.add('active');
                    }
                });

                // Scroll to active content
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

                // Update wizard steps completion
                wizardContents.forEach((content, index) => {
                    const stepInstruments = content.querySelectorAll('input[type="radio"]').length / 2;
                    const stepChecked = content.querySelectorAll('input[type="radio"]:checked').length;

                    if (stepChecked === stepInstruments) {
                        wizardSteps[index].classList.add('completed');
                    } else {
                        wizardSteps[index].classList.remove('completed');
                    }
                });
            }

            // Add change event listener to all radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });

            // Initial progress calculation
            updateProgress();

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
        });
    </script>
@endpush