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
            @if($ikssAuditeeData->isNotEmpty())
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
                            <h4 class="text-gray-900 fw-bolder">Data Instrumen sudah diisi</h4>
                            <div class="fs-6 text-gray-700">Anda telah mengisi data Instrumen untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</div>
                        </div>
                    </div>
                </div>
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
                                    Silakan lengkapi pengisian data <strong>Instrumen</strong> di bawah ini secara menyeluruh
                                    untuk dapat melanjutkan ke tahap <strong>Unggah Siklus</strong>.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            @php
                // Group instrumen by Sasaran Strategis
                $groupedInstrumen = collect();
                foreach ($dataIkssProdi as $unit) {
                    foreach ($unit->indikatorKinerjas as $indikator) {
                        $satuanStandar = App\Models\SatuanStandar::find($indikator->satuan_standar_id);
                        if (!$groupedInstrumen->has($satuanStandar->id)) {
                            $groupedInstrumen[$satuanStandar->id] = [
                                'satuan_standar' => $satuanStandar,
                                'instrumen' => collect()
                            ];
                        }
                        foreach ($indikator->instrumen as $instrumen) {
                            $groupedInstrumen[$satuanStandar->id]['instrumen']->push([
                                'indikator' => $indikator,
                                'instrumen' => $instrumen
                            ]);
                        }
                    }
                }
            @endphp

            <!-- Wizard Navigation -->
            <div class="wizard-nav mb-10">
                @foreach($groupedInstrumen as $ssId => $group)
                    <div class="wizard-step {{ $loop->first ? 'active' : '' }}" data-step="{{ $ssId }}">
                        <div class="step-number">{{ $loop->iteration }}</div>
                        <div class="step-label">{{ $group['satuan_standar']->kode_satuan }}</div>
                        <div class="step-desc">{{ $group['satuan_standar']->sasaran }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Wizard Content -->
            <form action="{{ route('auditee.submitAllInstrumen') }}" method="POST" enctype="multipart/form-data" id="formInstrumen">
                @csrf
                <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

                @foreach($groupedInstrumen as $ssId => $group)
                    <div class="wizard-content {{ $loop->first ? 'active' : '' }}" data-step="{{ $ssId }}">
                        <div class="card mb-5">
                            <div class="card-header bg-light">
                                <h3 class="card-title">{{ $group['satuan_standar']->kode_satuan }} - {{ $group['satuan_standar']->sasaran }}</h3>
                            </div>
                            <div class="card-body">
                                @foreach($group['instrumen'] as $item)
                                    <div class="mb-10">
                                        <input type="hidden" name="instrumen_ids[]" value="{{ $item['instrumen']->id }}">

                                        <h5 class="border-bottom pb-2 mb-4">{{ $loop->iteration }}. {{ $item['instrumen']->indikator }}</h5>

                                        <div class="mb-4">
                                            <h6>Referensi</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td width="30%">Indikator Kinerja RSB</td>
                                                        <td>{{ $item['instrumen']->indikator }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sumber data/bukti</td>
                                                        <td>
                                                            {{ $item['instrumen']->sumber }}
                                                            @if(isset($ikssAuditeeData[$item['instrumen']->id]) && $ikssAuditeeData[$item['instrumen']->id]->file_sumber)
                                                                <div class="mb-2">
                                                                    <a href="{{ asset('storage/'.$ikssAuditeeData[$item['instrumen']->id]->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                        <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                    </a>
                                                                </div>
                                                            @endif

                                                            <div class="mt-2">
                                                                <input type="file" name="bukti_file[{{ $item['instrumen']->id }}]" class="form-control" id="buktiFile_{{ $item['instrumen']->id }}">
                                                                <div class="form-text">Upload file bukti disini</div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Target</td>
                                                        <td>{{ $item['instrumen']->target }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="realisasi[{{ $item['instrumen']->id }}]"
                                                                value="{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->realisasi : '' }}"
                                                                placeholder="Isi disini...">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h6>Pengukuran</h6>
                                            <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                            <textarea class="form-control" name="akar_penyebab[{{ $item['instrumen']->id }}]" rows="4">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->akar : '' }}</textarea>
                                        </div>

                                        <div class="mb-4">
                                            <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                            <textarea class="form-control" name="rencana_perbaikan[{{ $item['instrumen']->id }}]" rows="4">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->rencana : '' }}</textarea>
                                        </div>

                                        <div class="mb-4">
                                            <h6>Indikator Penilaian</h6>
                                            <div>
                                                {!! $item['instrumen']->penilaian !!}
                                            </div>
                                        </div>

                                        <hr class="my-5">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-5">
                            @if(!$loop->first)
                                <button type="button" class="btn btn-light-primary" onclick="navigateStep('prev', {{ $ssId }})">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                            @else
                                <div></div>
                            @endif

                            @if($loop->last)
                                @if(!$ikssAuditeeData->isNotEmpty())
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Semua
                                    </button>
                                @endif
                            @else
                                <button type="button" class="btn btn-primary" onclick="navigateStep('next', {{ $ssId }})">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tambahkan CSRF token ke semua request Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('#formInstrumen').on('submit', function(e) {
                e.preventDefault();

                // Tampilkan loading
                Swal.fire({
                    title: 'Menyimpan Data',
                    text: 'Mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Gunakan FormData untuk handling file upload
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                });
            });

            // Initialize wizard functionality
            $('.wizard-step').click(function() {
                const stepId = $(this).data('step');
                activateStep(stepId);
            });
        });

        function navigateStep(direction, currentStepId) {
            const steps = $('.wizard-step').map(function() {
                return $(this).data('step');
            }).get();

            const currentIndex = steps.indexOf(currentStepId);
            let nextIndex;

            if (direction === 'next') {
                nextIndex = currentIndex + 1;
            } else {
                nextIndex = currentIndex - 1;
            }

            if (nextIndex >= 0 && nextIndex < steps.length) {
                activateStep(steps[nextIndex]);
            }
        }

        function activateStep(stepId) {
            // Update wizard steps
            $('.wizard-step').removeClass('active completed');
            const currentStep = $(`.wizard-step[data-step="${stepId}"]`);
            currentStep.addClass('active');
            currentStep.prevAll('.wizard-step').addClass('completed');

            // Show corresponding content
            $('.wizard-content').removeClass('active');
            $(`.wizard-content[data-step="${stepId}"]`).addClass('active');

            // Scroll to top of the content
            $('html, body').animate({
                scrollTop: $('.wizard-content.active').offset().top - 100
            }, 500);
        }
    </script>
@endpush
