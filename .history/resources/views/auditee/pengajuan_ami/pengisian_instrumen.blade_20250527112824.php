@extends('auditee/dashboard_template')

@php
    // Group instrumen by Satuan Standar and calculate completion
    $groupedInstrumen = [];
    $ssCompletionStatus = [];
    $allCompleted = true;
    $lastCompletedStep = null;

    foreach ($dataIkssProdi as $unit) {
        foreach ($unit->indikatorKinerjas as $indikator) {
            $satuanStandar = App\Models\SatuanStandar::find($indikator->satuan_standar_id);
            if (!isset($groupedInstrumen[$satuanStandar->id])) {
                $groupedInstrumen[$satuanStandar->id] = [
                    'satuan_standar' => $satuanStandar,
                    'instrumen' => [],
                    'total_instrumen' => 0,
                    'completed_instrumen' => 0
                ];
            }

            foreach ($indikator->instrumen as $instrumen) {
                $groupedInstrumen[$satuanStandar->id]['instrumen'][] = [
                    'indikator' => $indikator,
                    'instrumen' => $instrumen
                ];

                $groupedInstrumen[$satuanStandar->id]['total_instrumen']++;

                // Check if this instrumen is completed
                if (isset($ikssAuditeeData[$instrumen->id]) &&
                    !empty($ikssAuditeeData[$instrumen->id]->realisasi) &&
                    !empty($ikssAuditeeData[$instrumen->id]->akar) &&
                    !empty($ikssAuditeeData[$instrumen->id]->rencana)) {
                    $groupedInstrumen[$satuanStandar->id]['completed_instrumen']++;
                }
            }

            // Calculate completion status for this SS
            $totalInstrumen = $groupedInstrumen[$satuanStandar->id]['total_instrumen'];
            $completedInstrumen = $groupedInstrumen[$satuanStandar->id]['completed_instrumen'];
            $isCompleted = $totalInstrumen > 0 && $completedInstrumen === $totalInstrumen;
            $ssCompletionStatus[$satuanStandar->id] = [
                'total' => $totalInstrumen,
                'completed' => $completedInstrumen,
                'is_completed' => $isCompleted
            ];

            if ($isCompleted) {
                $lastCompletedStep = $satuanStandar->id;
            } else {
                $allCompleted = false;
            }
        }
    }

    // Convert to collection after all processing is done
    $groupedInstrumen = collect($groupedInstrumen);
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

        .wizard-step.disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .wizard-step.disabled:hover {
            color: inherit;
        }

        .wizard-step.disabled .step-number {
            background: #F5F8FA !important;
            color: #B5B5C3 !important;
            border-color: #E4E6EF !important;
            box-shadow: none !important;
        }

        .step-progress {
            font-size: 0.8rem;
            color: #B5B5C3;
            margin-top: 0.25rem;
        }

        /* Modify the existing wizard-step styles */
        .wizard-step {
            position: relative;
        }

        .wizard-step.disabled:after,
        .wizard-step.disabled:before {
            background: #E4E6EF !important;
            border-color: #E4E6EF !important;
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
            <!-- Progress Overview -->
            @php
                $totalInstrumen = array_sum(array_column($ssCompletionStatus, 'total'));
                $totalCompleted = array_sum(array_column($ssCompletionStatus, 'completed'));
                $progressPercentage = $totalInstrumen > 0 ? ($totalCompleted / $totalInstrumen) * 100 : 0;
                $isAllCompleted = $totalCompleted === $totalInstrumen && $totalInstrumen > 0;
            @endphp

            <!-- Alert Message -->
            <div class="alert {{ $isAllCompleted ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $isAllCompleted ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $isAllCompleted ? '✨ Pengisian Instrumen Selesai' : '📝 Pengisian Instrumen' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $isAllCompleted ? 'Selamat!' : 'Status:' }}</strong>
                            <span class="fw-semibold {{ $isAllCompleted ? 'text-success' : 'text-danger' }}">
                                @if($isAllCompleted)
                                    Semua instrumen telah diisi dengan lengkap. Silakan lanjut ke tahap Unggah Siklus.
                                @else
                                    {{ $totalCompleted }} dari {{ $totalInstrumen }} instrumen telah diisi. Silakan lengkapi pengisian instrumen yang tersisa.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto">
                    @if ($isAllCompleted)
                        <a href="{{ route('auditee.pengajuanAmi.unggahSiklus') }}" class="btn btn-sm px-4 btn-success">
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @else
                        <a href="#" class="btn btn-sm px-4 btn-secondary disabled" style="cursor: not-allowed; opacity: 0.65;">
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @endif
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="d-flex flex-column mb-10">
                <div class="d-flex align-items-center mb-2">
                    <span class="fs-4 fw-bold text-gray-800 me-2">Progress Pengisian Instrumen</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="fs-6 fw-semibold text-gray-600">
                        @if($isAllCompleted)
                            Semua instrumen telah selesai diisi
                        @else
                            {{ $totalCompleted }} instrumen selesai diisi
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
            <div class="wizard-nav mb-5">
                @foreach($groupedInstrumen as $ssId => $group)
                    @php
                        $isStepAccessible = false;
                        $prevCompleted = true;

                        // Check if all previous steps are completed
                        foreach ($groupedInstrumen as $prevSsId => $prevGroup) {
                            if ($prevSsId == $ssId) {
                                break;
                            }
                            if (!$ssCompletionStatus[$prevSsId]['is_completed']) {
                                $prevCompleted = false;
                                break;
                            }
                        }

                        // Step is accessible if it's the first step, or all previous steps are completed,
                        // or this step is already partially/fully completed
                        $isStepAccessible = $loop->first ||
                                           $prevCompleted ||
                                           $ssCompletionStatus[$ssId]['completed'] > 0;

                        $stepClass = $loop->first ? 'active' : '';
                        $stepClass .= $ssCompletionStatus[$ssId]['is_completed'] ? ' completed' : '';
                        $stepClass .= !$isStepAccessible ? ' disabled' : '';
                    @endphp
                    <div class="wizard-step {{ $stepClass }}"
                         data-step="{{ $ssId }}"
                         data-completed="{{ $ssCompletionStatus[$ssId]['is_completed'] ? 'true' : 'false' }}"
                         data-accessible="{{ $isStepAccessible ? 'true' : 'false' }}">
                        <div class="step-number">{{ $loop->iteration }}</div>
                        <div class="step-label">{{ $group['satuan_standar']->kode_satuan }}</div>
                        <div class="step-desc">{{ $group['satuan_standar']->sasaran }}</div>
                        <div class="step-progress">
                            {{ $ssCompletionStatus[$ssId]['completed'] }}/{{ $ssCompletionStatus[$ssId]['total'] }} instrumen
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Wizard Content -->
            @foreach($groupedInstrumen as $ssId => $group)
                <div class="wizard-content {{ $loop->first ? 'active' : '' }}" data-step="{{ $ssId }}">
                    <!-- Status Alert -->
                    @php
                        $isCompleted = $ssCompletionStatus[$ssId]['is_completed'];
                        $totalInstrumen = $ssCompletionStatus[$ssId]['total'];
                        $completedInstrumen = $ssCompletionStatus[$ssId]['completed'];
                    @endphp

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
                            <h5 class="mb-1">Status: {{ $isCompleted ? 'Sudah Diisi Lengkap' : 'Belum Lengkap' }}</h5>
                            <div class="fs-6">
                                <div class="fw-semibold text-gray-700">Satuan Standar: {{ $group['satuan_standar']->kode_satuan }} - {{ $group['satuan_standar']->sasaran }}</div>
                                <div class="fw-semibold text-gray-700 mt-1">Progress: {{ $completedInstrumen }}/{{ $totalInstrumen }} instrumen diisi lengkap</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('auditee.pengajuanAmi.submitInstrumenSS', ['ss_id' => $ssId]) }}" method="POST" enctype="multipart/form-data" class="form-ss" id="formInstrumen_{{ $ssId }}">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">
                        <input type="hidden" name="ss_id" value="{{ $ssId }}">

                        @foreach($group['instrumen'] as $item)
                            <div class="card card-bordered mb-10">
                                <div class="card-header bg-light">
                                    <h3 class="card-title text-gray-800 fw-bold">{{ $loop->iteration }}. {{ $item['instrumen']->indikator !!}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Referensi</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td width="30%" class="fw-semibold bg-light">Indikator Kinerja RSB</td>
                                                    <td>{!! $item['instrumen']->indikator !!}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold bg-light">Sumber data/bukti</td>
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
                                                    <td class="fw-semibold bg-light">Target</td>
                                                    <td>{{ $item['instrumen']->target }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold bg-light">Realisasi</td>
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
                                        <h6 class="fw-bold mb-3">Pengukuran</h6>
                                        <h6 class="text-muted fs-7 mb-3">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                        <textarea class="form-control" name="akar_penyebab[{{ $item['instrumen']->id }}]" rows="4">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->akar : '' }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Rencana Perbaikan dan Tindak lanjut</h6>
                                        <textarea class="form-control" name="rencana_perbaikan[{{ $item['instrumen']->id }}]" rows="4">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->rencana : '' }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Indikator Penilaian</h6>
                                        <div class="bg-light-primary rounded p-4">
                                            {!! $item['instrumen']->penilaian !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-5">
                            @if(!$loop->first)
                                <button type="button" class="btn btn-light-primary" onclick="navigateStep('prev', {{ $ssId }})">
                                    <i class="fas fa-arrow-left"></i> Sebelumnya
                                </button>
                            @else
                                <div></div>
                            @endif

                            <div class="d-flex gap-2">
                                @if(!$loop->last)
                                    <button type="button" class="btn btn-primary" onclick="saveAndNext({{ $ssId }})">
                                        Simpan & Lanjutkan <i class="fas fa-arrow-right"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Selesai
                                    </button>
                                    @if($allCompleted)
                                        <a href="{{ route('auditee.pengajuanAmi.unggahSiklus') }}" class="btn btn-success">
                                            <i class="fas fa-arrow-right"></i> Proses Selanjutnya
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
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

            // Handle form submission untuk setiap SS
            $('.form-ss').on('submit', function(e) {
                e.preventDefault();
                submitForm($(this));
            });

            // Check for next_step parameter and navigate if present
            const urlParams = new URLSearchParams(window.location.search);
            const nextStep = urlParams.get('next_step');
            if (nextStep) {
                // Remove the parameter from URL without refreshing
                window.history.replaceState({}, document.title, window.location.pathname);
                // Navigate to the next step
                activateStep(nextStep);
            } else {
                // Jika tidak ada next_step parameter, cari step yang belum lengkap
                let firstIncompleteStep = null;
                $('.wizard-step').each(function() {
                    const $step = $(this);
                    const isCompleted = $step.hasClass('completed');
                    const isAccessible = $step.data('accessible');

                    if (isAccessible && !isCompleted) {
                        firstIncompleteStep = $step.data('step');
                        return false; // break the loop
                    }
                });

                // Jika ada step yang belum lengkap, navigasi ke step tersebut
                if (firstIncompleteStep) {
                    activateStep(firstIncompleteStep);
                }
            }

            // Modified wizard step click handler
            $('.wizard-step').click(function() {
                const $step = $(this);
                const isAccessible = $step.data('accessible');
                const stepId = $step.data('step');

                if (!isAccessible) {
                    // Get the first incomplete previous step
                    let firstIncompletePrevStep = null;
                    $('.wizard-step').each(function() {
                        const $currentStep = $(this);
                        if ($currentStep.data('step') === stepId) {
                            return false; // break the loop
                        }
                        if (!$currentStep.hasClass('completed')) {
                            firstIncompletePrevStep = $currentStep;
                            return false; // break the loop
                        }
                    });

                    let message = 'Anda harus menyelesaikan ';
                    if (firstIncompletePrevStep) {
                        message += firstIncompletePrevStep.find('.step-label').text() + ' terlebih dahulu.';
                    } else {
                        message += 'tahap sebelumnya terlebih dahulu.';
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak dapat melanjutkan',
                        text: message
                    });
                    return;
                }

                activateStep(stepId);
            });
        });

        function submitForm($form) {
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
            var formData = new FormData($form[0]);

            $.ajax({
                url: $form.attr('action'),
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
        }

        function submitFormAndNext($form, currentStepId) {
            // Log form data for debugging
            console.log('Submitting form for SS:', currentStepId);
            console.log('Form action:', $form.attr('action'));

            Swal.fire({
                title: 'Menyimpan Data',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData($form[0]);

            // Log form data entries
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Success response:', response);
                    if (response.success) {
                        // Update the completion status of current step
                        $(`.wizard-step[data-step="${currentStepId}"]`).addClass('completed');

                        // Enable next step
                        const nextStep = $(`.wizard-step[data-step="${currentStepId}"]`).next('.wizard-step');
                        if (nextStep.length) {
                            nextStep.data('accessible', true).removeClass('disabled');
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Reload halaman dan kemudian navigasi ke step berikutnya
                            if (response.redirect) {
                                window.location.href = response.redirect + '?next_step=' + nextStep.data('step');
                            } else {
                                navigateStep('next', currentStepId);
                            }
                        });
                    } else {
                        console.error('Error in response:', response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', {xhr, status, error});
                    console.error('Response:', xhr.responseText);

                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        footer: `Status: ${status}, Error: ${error}`
                    });
                }
            });
        }

        function saveAndNext(currentStepId) {
            const $form = $(`#formInstrumen_${currentStepId}`);

            // Check if all required fields in current step are filled
            let isComplete = true;
            let firstEmptyField = null;
            let emptyFields = [];

            $form.find('input[type="text"], textarea').each(function() {
                const $field = $(this);
                const fieldName = $field.attr('name') || 'Unknown field';

                if (!$field.val()) {
                    isComplete = false;
                    emptyFields.push(fieldName);
                    if (!firstEmptyField) {
                        firstEmptyField = $field;
                    }
                }
            });

            if (!isComplete) {
                console.log('Empty fields:', emptyFields);
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Belum Lengkap',
                    text: 'Harap lengkapi semua field sebelum melanjutkan ke tahap berikutnya.',
                    footer: `Field yang belum diisi: ${emptyFields.join(', ')}`
                });
                if (firstEmptyField) {
                    firstEmptyField.focus();
                }
                return;
            }

            // Konfirmasi sebelum submit
            Swal.fire({
                title: 'Konfirmasi Pengisian',
                text: 'Apakah Anda yakin ingin menyimpan data ini? Data yang sudah disimpan tidak dapat diubah kembali.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    submitFormAndNext($form, currentStepId);
                }
            });
        }

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
