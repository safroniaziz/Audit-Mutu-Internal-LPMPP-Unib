@extends('auditee/dashboard_template')

@php
    // Group instrumen by Sasaran Strategis and calculate completion
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

                // Completion hanya dihitung dari data periode aktif (yang sudah tersimpan).
                if (in_array((int) $instrumen->id, $completedInstrumenIdsActive ?? [], true)) {
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

    // Convert to collection after all processing is done and sort by SS ID numerically
    $groupedInstrumen = collect($groupedInstrumen)->sortKeysUsing(function ($a, $b) {
        return (int)$a <=> (int)$b;
    });
@endphp

@push('styles')
    <style>
        /* Wizard navigation styles */
        .wizard-nav {
            display: flex;
            overflow-x: scroll !important;
            overflow-y: hidden !important;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            position: relative;
            background: #ffffff;
            border-radius: 0.475rem;
            box-shadow: 0 0 50px 0 rgb(82 63 105 / 10%);
            /* Force scrollbar to be visible */
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            flex-wrap: nowrap !important;
            cursor: grab;
        }

        .wizard-nav:active {
            cursor: grabbing;
        }

        .wizard-nav::-webkit-scrollbar {
            height: 8px;
        }

        .wizard-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .wizard-nav::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .wizard-nav::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .wizard-step {
            flex: 0 0 auto; /* Changed from flex: 1 to prevent equal distribution */
            min-width: 250px; /* Increased min-width */
            max-width: 300px;
            text-align: center;
            padding: 0.5rem 2rem;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap; /* Prevent text wrapping */
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

        .wizard-step.active.completed .step-number {
            background: #009EF7;
            color: white;
            border-color: #009EF7;
            box-shadow: 0 0 20px 0 rgb(0 158 247 / 30%);
        }

        .wizard-step .step-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #7E8299;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .wizard-step .step-desc {
            color: #B5B5C3;
            font-size: 0.8rem;
            margin: 0 auto;
            transition: all 0.3s ease;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1.2;
        }        .wizard-step.active .step-desc,
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

        .wizard-step.active .step-label,
        .wizard-step.active .step-desc,
        .wizard-step.active .step-progress {
            color: #009EF7;
        }

        .wizard-step.active.completed .step-label,
        .wizard-step.active.completed .step-desc,
        .wizard-step.active.completed .step-progress {
            color: #009EF7;
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

        /* Field validation styles */
        .required-field.is-invalid {
            border: 2px solid #f64e60 !important;
            background-color: #fff5f8;
        }

        .required-field.is-invalid:focus {
            border-color: #f64e60 !important;
            box-shadow: 0 0 0 0.25rem rgba(246, 78, 96, 0.25) !important;
        }

        .field-error-badge {
            display: inline-block;
            background-color: #f64e60;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 4px;
        }

        .instrumen-card {
            transition: all 0.3s ease;
        }

        .instrumen-card.has-error {
            border-left: 4px solid #f64e60;
            background-color: #fff5f8;
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
            .wizard-step .step-progress {
                color: #B5B5C3;
                font-size: 0.8rem;
                margin-top: 0.25rem;
                font-weight: 500;
            }

            .wizard-step.active .step-progress,
            .wizard-step.completed .step-progress {
                color: inherit;
            }
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
                        @if(!$pengajuanAmiExists)
                <div class="alert alert-info d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-info"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📝 Mode Editing Aktif</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-2">
                                <strong>Informasi:</strong>
                                <span class="fw-semibold text-info">
                                    Anda masih dapat mengubah dan memperbarui data pada tahap sebelumnya (Perjanjian Kinerja dan Pemilihan IKSS) selama belum ada penugasan auditor untuk periode ini. Gunakan tombol navigasi untuk kembali ke tahap sebelumnya jika diperlukan.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi bi-lock-fill fs-2 text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">🔒 Data Sudah Dikunci</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-2">
                                <strong>Informasi:</strong>
                                <span class="fw-semibold text-warning">
                                    Data pengisian instrumen tidak dapat diubah karena penugasan auditor untuk periode ini sudah dibuat. Jika ada perubahan yang diperlukan, silakan hubungi administrator.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($defaultDariPeriodeSebelumnya))
                <div class="alert alert-info d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi bi-arrow-repeat fs-2 text-info"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">Default Dari Periode Sebelumnya</h4>
                        <div class="fs-6 text-gray-700">
                            <strong>{{ $defaultFallbackCount ?? 0 }} instrumen</strong> menampilkan nilai default dari
                            <strong>{{ $previousPeriodeLabel ?? 'periode sebelumnya' }}</strong> (prefill).
                            Nilai ini <strong>belum tersimpan</strong> ke periode aktif sampai Anda klik
                            <strong>Simpan &amp; Lanjutkan</strong>.
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($hasPreviousPeriode) && !$pengajuanAmiExists)
                @if($canCopyFromPrevious)
                    <div class="alert alert-success d-flex align-items-start p-5 mb-10">
                        <div class="me-4">
                            <i class="bi bi-clipboard-check fs-2 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-1">Salin Semua dari Periode Sebelumnya</h4>
                            <div class="fs-6 text-gray-700 mb-3">
                                Pilihan IKSS Anda <strong>sama persis</strong> dengan
                                <strong>{{ $previousPeriodeLabel ?? 'periode sebelumnya' }}</strong>.
                                Klik tombol di bawah untuk mengisi <em>semua</em> form (Realisasi, Akar Penyebab,
                                Rencana Perbaikan, URL Sumber) menggunakan data dari periode tersebut sekaligus.
                                Data baru ini <strong>belum tersimpan</strong> sampai Anda klik
                                <strong>Simpan &amp; Lanjutkan</strong> di setiap step.
                            </div>
                            <button type="button" class="btn btn-success btn-sm px-5" onclick="copyAllFromPrevious()">
                                <i class="bi bi-clipboard-check me-2"></i>Salin Semua dari Periode Sebelumnya
                            </button>
                        </div>
                    </div>
                @else
                    <div class="alert alert-light border border-warning d-flex align-items-start p-5 mb-10">
                        <div class="me-4">
                            <i class="bi bi-info-circle fs-2 text-warning"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-1">Tombol Salin dari Periode Sebelumnya Tidak Tersedia</h4>
                            <div class="fs-6 text-gray-600 mb-2">
                                Pilihan IKSS periode aktif <strong>berbeda</strong> dengan
                                <strong>{{ $previousPeriodeLabel ?? 'periode sebelumnya' }}</strong>,
                                sehingga tidak bisa disalin secara otomatis. Pengisian harus dilakukan manual.
                            </div>
                            @if(!empty($ikssAddedInCurrent))
                                <div class="fs-7 text-gray-600 mb-1">
                                    <i class="bi bi-plus-circle text-primary me-1"></i>
                                    <strong>{{ count($ikssAddedInCurrent) }} instrumen baru</strong>
                                    ditambahkan ke periode aktif yang sebelumnya tidak dipilih.
                                </div>
                            @endif
                            @if(!empty($ikssRemovedInCurrent))
                                <div class="fs-7 text-gray-600">
                                    <i class="bi bi-dash-circle text-danger me-1"></i>
                                    <strong>{{ count($ikssRemovedInCurrent) }} instrumen</strong>
                                    yang ada di periode sebelumnya sekarang tidak dipilih lagi.
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif

            <div class="alert {{ $isAllCompleted ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10 position-relative">
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
                                    <strong>{{ $totalCompleted }} dari {{ $totalInstrumen }}</strong> instrumen sudah tersimpan di periode aktif.
                                    Nilai default dari periode sebelumnya tidak dihitung sebagai tersimpan sebelum Anda menekan
                                    <strong>Simpan &amp; Lanjutkan</strong>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto d-flex gap-2">
                    @if (!$pengajuanAmiExists)
                        <a href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}" class="btn btn-sm btn-light-primary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Pemilihan IKSS
                        </a>
                    @endif
                    @if ($isAllCompleted)
                        <a href="{{ route('auditee.pengajuanAmi.pengisianInstrumenProdi') }}" class="btn btn-sm px-4 btn-success">
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @else
                        <a href="#" class="btn btn-sm px-4 btn-secondary disabled" style="cursor: not-allowed; opacity: 0.65;">
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @endif
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

                        // Don't set any step as active initially - let JavaScript determine the correct step
                        $stepClass = '';
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
                                <div class="fw-semibold text-gray-700">Sasaran Strategis: {{ $group['satuan_standar']->kode_satuan }} - {{ $group['satuan_standar']->sasaran }}</div>
                                <div class="fw-semibold text-gray-700 mt-1">Progress: {{ $completedInstrumen }}/{{ $totalInstrumen }} instrumen diisi lengkap</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('auditee.pengajuanAmi.submitInstrumenSS', ['ss_id' => $ssId]) }}" method="POST" enctype="multipart/form-data" class="form-ss{{ $pengajuanAmiExists ? ' form-disabled' : '' }}" id="formInstrumen_{{ $ssId }}">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">
                        <input type="hidden" name="ss_id" value="{{ $ssId }}">

                        @foreach($group['instrumen'] as $item)
                            @php
                                $instrumenId = (int) $item['instrumen']->id;
                                $comparison = $comparisonByInstrumen[$instrumenId] ?? null;
                                $indikatorText = strip_tags($item['instrumen']->indikator);
                                // Ambil max 50 karakter dari indikator untuk identifier
                                $indikatorShort = strlen($indikatorText) > 50 ? substr($indikatorText, 0, 50) . '...' : $indikatorText;
                            @endphp
                            <div class="card card-bordered mb-10 instrumen-card" data-instrumen-id="{{ $item['instrumen']->id }}" data-instrumen-num="{{ $loop->iteration }}" data-instrumen-short="{{ $indikatorShort }}">
                                <div class="card-header bg-light">
                                    <h3 class="card-title text-gray-800 fw-bold instrumen-title">{{ $loop->iteration }}. {!! str_replace(['<p>', '</p>'], '', $item['instrumen']->indikator) !!}
                                    </h3>
                                    <span class="badge badge-light-info fs-7">{{ $item['indikator']->kode_ikss }}</span>
                                    @if(!empty($comparison['has_previous']))
                                        <span class="badge fs-8 {{ !empty($comparison['is_changed']) ? 'badge-light-warning' : 'badge-light-success' }}">
                                            {{ !empty($comparison['is_changed']) ? 'Berubah dari periode sebelumnya' : 'Sama dengan periode sebelumnya' }}
                                        </span>
                                    @endif
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
                                                        {!! $item['instrumen']->sumber !!}
                                                        @if(isset($ikssAuditeeData[$item['instrumen']->id]) && $ikssAuditeeData[$item['instrumen']->id]->file_sumber)
                                                            <div class="mb-2">
                                                                <a href="{{ asset('storage/'.$ikssAuditeeData[$item['instrumen']->id]->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                    <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                </a>
                                                            </div>
                                                        @endif



                                                        <div class="mt-3">
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-link"></i>
                                                                </span>
                                                                <input type="url"
                                                                    class="form-control"
                                                                    name="url_sumber[{{ $item['instrumen']->id }}]"
                                                                    value="{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->url_sumber : '' }}"
                                                                    placeholder="Masukkan URL sumber (opsional)">
                                                            </div>
                                                            <div class="form-text text-muted">Tambahkan URL sumber jika ada (contoh: https://example.com)</div>
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
                                                        @php
                                                            $rawRealisasi = isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->realisasi : '';
                                                            // Strip karakter non-numerik (kecuali titik desimal) agar kompatibel dengan input type=number
                                                            // Contoh: "86%" → "86", "75.5%" → "75.5", "a" → ""
                                                            $realisasiDisplay = preg_replace('/[^0-9.]/', '', (string) $rawRealisasi);
                                                        @endphp
                                                        <input type="number" class="form-control required-field" name="realisasi[{{ $item['instrumen']->id }}]"
                                                            value="{{ $realisasiDisplay }}"
                                                            min="0"
                                                            step="0.01"
                                                            placeholder="Isi disini..."
                                                            data-instrumen-id="{{ $item['instrumen']->id }}"
                                                            data-field-name="Realisasi"
                                                            data-indikator="{{ $item['indikator']->kode_ikss }}">
                                                        <div class="form-text text-muted italic text-xs">Masukkan realisasi dalam bentuk angka</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Pengukuran</h6>
                                        <h6 class="text-muted fs-7 mb-3">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                        <textarea class="form-control required-field" name="akar_penyebab[{{ $item['instrumen']->id }}]" rows="4" data-instrumen-id="{{ $item['instrumen']->id }}" data-field-name="Akar Penyebab" data-indikator="{{ $item['indikator']->kode_ikss }}">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->akar : '' }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Rencana Perbaikan dan Tindak lanjut</h6>
                                        <textarea class="form-control required-field" name="rencana_perbaikan[{{ $item['instrumen']->id }}]" rows="4" data-instrumen-id="{{ $item['instrumen']->id }}" data-field-name="Rencana Perbaikan" data-indikator="{{ $item['indikator']->kode_ikss }}">{{ isset($ikssAuditeeData[$item['instrumen']->id]) ? $ikssAuditeeData[$item['instrumen']->id]->rencana : '' }}</textarea>
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
                                <button type="button" class="btn btn-primary" onclick="saveAndNext({{ $ssId }})">
                                    <i class="fas fa-save"></i> Simpan & {{ $loop->last ? 'Selesai' : 'Lanjutkan' }}
                                </button>
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

            // Function to refresh CSRF token
            function refreshCSRFToken() {
                $.get('/csrf-token', function(data) {
                    $('meta[name="csrf-token"]').attr('content', data.token);
                    $('input[name="_token"]').val(data.token);

                    // Update AJAX setup with new token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': data.token
                        }
                    });
                }).fail(function() {
                    console.log('Failed to refresh CSRF token');
                });
            }

            // Refresh CSRF token every 30 minutes
            setInterval(refreshCSRFToken, 30 * 60 * 1000);

            // Handle form submission untuk setiap SS
            $('.form-ss').on('submit', function(e) {
                e.preventDefault();
                submitForm($(this));
            });

            // Check for next_step parameter and navigate if present
            const urlParams = new URLSearchParams(window.location.search);
            const nextStep = urlParams.get('next_step');

            // Initialize completed state based on server-side data
            $('.wizard-step').each(function() {
                const $step = $(this);
                if ($step.data('completed') === true || $step.data('completed') === 'true') {
                    $step.addClass('completed');
                }
            });

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
                    const stepId = $step.data('step');

                    console.log(`Step ${stepId}: completed=${isCompleted}, accessible=${isAccessible}`);

                    if (isAccessible && !isCompleted) {
                        firstIncompleteStep = stepId;
                        return false; // break the loop
                    }
                });

                console.log('First incomplete step:', firstIncompleteStep);

                // Jika ada step yang belum lengkap, navigasi ke step tersebut
                if (firstIncompleteStep) {
                    activateStep(firstIncompleteStep);
                } else {
                    // Jika semua step sudah lengkap atau tidak ada step yang belum lengkap,
                    // aktifkan step terakhir yang accessible
                    let lastAccessibleStep = null;
                    $('.wizard-step').each(function() {
                        const $step = $(this);
                        const isAccessible = $step.data('accessible');
                        if (isAccessible) {
                            lastAccessibleStep = $step.data('step');
                        }
                    });

                    console.log('Last accessible step:', lastAccessibleStep);

                    if (lastAccessibleStep) {
                        activateStep(lastAccessibleStep);
                    } else {
                        // Fallback: aktifkan step pertama
                        const firstStep = $('.wizard-step').first().data('step');
                        console.log('Fallback to first step:', firstStep);
                        if (firstStep) {
                            activateStep(firstStep);
                        }
                    }
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
                        text: message,
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                activateStep(stepId);
            });

            const wizardNav = $('.wizard-nav');
            let isDraggingNav = false;
            let navStartX = 0;
            let navStartScrollLeft = 0;
            let navMoved = false;

            // Unified wheel/trackpad scrolling handler
            wizardNav.on('wheel', function(e) {
                const nav = this;
                if (nav.scrollWidth <= nav.clientWidth) {
                    return;
                }

                const deltaX = e.originalEvent.deltaX;
                const deltaY = e.originalEvent.deltaY;

                // Use deltaX if available (trackpad horizontal scroll), otherwise use deltaY (mouse wheel)
                if (deltaX !== 0) {
                    e.preventDefault();
                    nav.scrollLeft += deltaX;
                } else if (deltaY !== 0) {
                    e.preventDefault();
                    nav.scrollLeft += deltaY;
                }
            }, { passive: false });

            // Add trackpad swipe support using pointer events
            let pointerStartX = 0;
            let pointerStartY = 0;
            let isPointerDown = false;

            wizardNav.on('pointerdown', function(e) {
                isPointerDown = true;
                pointerStartX = e.pageX;
                pointerStartY = e.pageY;
                wizardNav.css('cursor', 'grabbing');
            });

            wizardNav.on('pointerup pointerleave', function(e) {
                isPointerDown = false;
                wizardNav.css('cursor', 'grab');
            });

            wizardNav.on('pointermove', function(e) {
                if (!isPointerDown) return;

                const deltaX = e.pageX - pointerStartX;
                const deltaY = e.pageY - pointerStartY;

                // Only scroll if horizontal movement is greater than vertical
                if (Math.abs(deltaX) > Math.abs(deltaY)) {
                    e.preventDefault();
                    wizardNav.scrollLeft(wizardNav.scrollLeft() - deltaX);
                    pointerStartX = e.pageX;
                }
            });

            // Keep original drag functionality as backup
            wizardNav.on('mousedown', function(e) {
                isDraggingNav = true;
                navMoved = false;
                navStartX = e.pageX;
                navStartScrollLeft = this.scrollLeft;
                wizardNav.css('cursor', 'grabbing');
            });

            $(document).on('mousemove', function(e) {
                if (!isDraggingNav) return;
                const delta = e.pageX - navStartX;
                if (Math.abs(delta) > 5) {
                    navMoved = true;
                }
                wizardNav[0].scrollLeft = navStartScrollLeft - delta;
            });

            $(document).on('mouseup', function() {
                isDraggingNav = false;
                wizardNav.css('cursor', 'grab');
            });

            wizardNav.find('.wizard-step').on('click', function(e) {
                if (navMoved) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    navMoved = false;
                }
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
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload halaman
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function submitFormAndNext($form, currentStepId) {
            // Log form data for debugging
            console.log('Submitting form for SS:', currentStepId);
            console.log('Form action:', $form.attr('action'));

            var formData = new FormData($form[0]);

            // Check data size before sending
            let totalSize = 0;
            for (let pair of formData.entries()) {
                if (pair[1] instanceof File) {
                    totalSize += pair[1].size;
                } else if (typeof pair[1] === 'string') {
                    totalSize += new Blob([pair[1]]).size;
                }
            }

            // Convert to KB
            let sizeInKB = totalSize / 1024;
            console.log('Total data size:', sizeInKB.toFixed(2), 'KB');

            // Check if data exceeds 450KB limit
            if (sizeInKB > 450) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Terlalu Besar',
                    text: `Ukuran data saat ini: ${sizeInKB.toFixed(2)} KB. Maksimal yang diizinkan: 450 KB. Silakan kurangi jumlah data atau file yang diupload.`,
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Menyimpan Data',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

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
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload halaman
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        console.error('Error in response:', response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat menyimpan data.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', {xhr, status, error});
                    console.error('Response:', xhr.responseText);

                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                    let errorTitle = 'Gagal!';

                    // Handle CSRF token mismatch
                    if (xhr.status === 419) {
                        errorTitle = 'Session Expired';
                        errorMessage = 'Session Anda telah berakhir. Halaman akan di-refresh untuk memperbarui token keamanan.';

                        Swal.fire({
                            icon: 'warning',
                            title: errorTitle,
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Refresh halaman untuk mendapatkan CSRF token baru
                            window.location.reload();
                        });
                        return;
                    }
                    // Handle specific HTTP status codes
                    else if (xhr.status === 413) {
                        errorTitle = 'Data Terlalu Besar';
                        errorMessage = 'Ukuran data yang dikirim terlalu besar. Maksimal 450KB. Silakan kurangi jumlah data atau file yang diupload.';
                    } else if (xhr.status === 422) {
                        errorTitle = 'Validasi Gagal';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        }
                    } else if (xhr.status === 500) {
                        errorTitle = 'Server Error';
                        errorMessage = 'Terjadi kesalahan pada server. Silakan coba lagi.';
                    } else if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: errorTitle,
                        text: errorMessage,
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function saveAndNext(currentStepId) {
            const $form = $(`#formInstrumen_${currentStepId}`);

            // Clear previous error styles
            $('.required-field').removeClass('is-invalid');
            $('.instrumen-card').removeClass('has-error');
            $('.field-error-badge').remove();

            // Check if all required fields in current step are filled
            let isComplete = true;
            let firstEmptyField = null;
            let emptyFieldsInfo = [];

            // Check each instrumen card
            $form.find('.instrumen-card').each(function() {
                const $card = $(this);
                const instrumenNum = $card.data('instrumen-num');
                const instrumenShort = $card.data('instrumen-short') || 'Unknown';
                const indikatorKode = $card.find('.required-field').first().data('indikator') || '';
                let hasEmpty = false;

                // Check each required field in this card
                $card.find('.required-field').each(function() {
                    const $field = $(this);
                    const fieldName = $field.data('field-name') || 'Field';

                    if (!$field.val() || (typeof $field.val() === 'string' && $field.val().trim() === '')) {
                        isComplete = false;
                        hasEmpty = true;

                        // Mark field as invalid
                        $field.addClass('is-invalid');

                        // Add error badge
                        if (!$field.next('.field-error-badge').length) {
                            $field.after('<span class="field-error-badge">Wajib diisi</span>');
                        }

                        if (!firstEmptyField) {
                            firstEmptyField = $field;
                        }

                        // Format: Instrumen #1 - IKSS 1.2.1 - Realisasi
                        const fieldLabel = `Instrumen #${instrumenNum} ${indikatorKode ? '(' + indikatorKode + ')' : ''}`;
                        emptyFieldsInfo.push(`${fieldLabel} - ${fieldName}`);
                    }
                });

                if (hasEmpty) {
                    $card.addClass('has-error');
                }
            });

            if (!isComplete) {
                // Scroll to first empty field
                if (firstEmptyField) {
                    $('html, body').animate({
                        scrollTop: firstEmptyField.offset().top - 150
                    }, 500);
                    firstEmptyField.focus();
                }

                // Show detailed error message
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Belum Lengkap',
                    html: `
                        <div class="text-start">
                            <p class="mb-3">Terdapat <strong class="text-danger">${emptyFieldsInfo.length} field</strong> yang belum diisi:</p>
                            <div style="max-height: 250px; overflow-y: auto;" class="mb-3 p-2 bg-light rounded">
                                <ul class="mb-0" style="font-size: 13px;">
                                    ${emptyFieldsInfo.map(f => `<li class="text-danger mb-1">• ${f}</li>`).join('')}
                                </ul>
                            </div>
                            <p class="text-muted small">Mohon lengkapi semua field yang ditandai dengan <span class="badge bg-danger">border merah</span> sebelum menyimpan.</p>
                        </div>
                    `,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f64e60',
                    didOpen: () => {
                        // Scroll modal to top
                        const swalContainer = document.querySelector('.swal2-container');
                        if (swalContainer) {
                            swalContainer.scrollTop = 0;
                        }
                    }
                });
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
            // Update wizard steps - only remove active class, preserve completed status
            $('.wizard-step').removeClass('active');
            const currentStep = $(`.wizard-step[data-step="${stepId}"]`);
            currentStep.addClass('active');

            // Show corresponding content
            $('.wizard-content').removeClass('active');
            $(`.wizard-content[data-step="${stepId}"]`).addClass('active');

            // Scroll to top of the content
            $('html, body').animate({
                scrollTop: $('.wizard-content.active').offset().top - 100
            }, 500);
        }
    </script>

    <script>
        // Data periode sebelumnya dari PHP (untuk tombol salin semua)
        const previousDataForJs = @json($previousDataForJs ?? []);

        // Instrumen yang sudah tersimpan di DB periode aktif (minimal 1 field non-empty).
        // Dipakai untuk membedakan "hanya prefill default belum disimpan" vs "sudah diisi & tersimpan".
        const instrumenIdsWithCurrentData = new Set(@json($instrumenIdsWithCurrentData ?? []));

        /**
         * Cek apakah sebuah instrumen sudah diisi dan TERSIMPAN di DB periode aktif.
         * Prefill default dari periode sebelumnya yang belum disimpan dianggap belum diisi.
         */
        function instrumenSudahDiisi(instrumenId) {
            return instrumenIdsWithCurrentData.has(parseInt(instrumenId));
        }

        /**
         * Isi satu instrumen dengan data dari periode sebelumnya.
         * overwrite=true → timpa semua field.
         * overwrite=false → hanya isi field yang masih kosong.
         */
        function fillInstrumen(instrumenId, data, overwrite) {
            const realisasiInput = document.querySelector(`input[name="realisasi[${instrumenId}]"]`);
            const akarInput      = document.querySelector(`textarea[name="akar_penyebab[${instrumenId}]"]`);
            const rencanaInput   = document.querySelector(`textarea[name="rencana_perbaikan[${instrumenId}]"]`);
            const urlInput       = document.querySelector(`input[name="url_sumber[${instrumenId}]"]`);

            if (realisasiInput && (overwrite || realisasiInput.value.trim() === '')) {
                realisasiInput.value = data.realisasi ?? '';
                realisasiInput.dispatchEvent(new Event('input',  { bubbles: true }));
                realisasiInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
            if (akarInput && (overwrite || akarInput.value.trim() === '')) {
                akarInput.value = data.akar ?? '';
                akarInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            if (rencanaInput && (overwrite || rencanaInput.value.trim() === '')) {
                rencanaInput.value = data.rencana ?? '';
                rencanaInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            if (urlInput && (overwrite || urlInput.value.trim() === '')) {
                urlInput.value = data.url_sumber ?? '';
                urlInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }

        function doFill(overwrite) {
            // Tampilkan loading
            Swal.fire({
                title: 'Menyalin data...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                url: '{{ route("auditee.pengajuanAmi.copyInstrumenFromPrevious") }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    overwrite: overwrite ? 1 : 0,
                },
                success: function (response) {
                    const skippedNote = response.skipped_count > 0
                        ? `<br><span class="text-muted small">${response.skipped_count} instrumen yang sudah diisi <strong>dilewati</strong>.</span>`
                        : '';

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Disalin!',
                        html: `<strong>${response.saved_count} instrumen</strong> berhasil disalin dari periode sebelumnya.${skippedNote}`,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#198754',
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menyalin data.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545',
                    });
                }
            });
        }

        function copyAllFromPrevious() {
            const totalInstrumen = Object.keys(previousDataForJs).length;

            if (totalInstrumen === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Tersedia',
                    text: 'Tidak ada data dari periode sebelumnya yang bisa disalin.',
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
                return;
            }

            // Hitung berapa instrumen yang sudah punya isian di form saat ini
            let sudahDiisiCount = 0;
            let belumDiisiCount = 0;
            for (const instrumenId of Object.keys(previousDataForJs)) {
                if (instrumenSudahDiisi(instrumenId)) {
                    sudahDiisiCount++;
                } else {
                    belumDiisiCount++;
                }
            }

            // Tidak ada yang sudah diisi → konfirmasi simpel, langsung timpa semua
            if (sudahDiisiCount === 0) {
                Swal.fire({
                    icon: 'question',
                    title: 'Salin Semua dari Periode Sebelumnya?',
                    html: `<div class="text-start">
                        <p class="mb-2">Semua field berikut akan diisi dengan data periode sebelumnya:</p>
                        <ul class="mb-2 small">
                            <li>Realisasi</li>
                            <li>Akar Penyebab</li>
                            <li>Rencana Perbaikan &amp; Tindak Lanjut</li>
                            <li>URL Sumber</li>
                        </ul>
                        <p class="text-muted small mb-0">Total: <strong>${totalInstrumen} instrumen</strong>.
                        Perubahan tersimpan setelah klik <strong>Simpan &amp; Lanjutkan</strong>.</p>
                    </div>`,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Salin Semua',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) doFill(true);
                });
                return;
            }

            // Ada sebagian yang sudah diisi → tawarkan 3 pilihan
            Swal.fire({
                icon: 'warning',
                title: 'Sebagian Instrumen Sudah Diisi',
                html: `<div class="text-start">
                    <p class="mb-3">Ditemukan instrumen yang sudah memiliki isian:</p>
                    <div class="d-flex gap-3 mb-3 justify-content-center">
                        <div class="text-center p-3 rounded border border-success bg-light">
                            <div class="fs-3 fw-bold text-success">${belumDiisiCount}</div>
                            <div class="small text-muted">Belum diisi</div>
                        </div>
                        <div class="text-center p-3 rounded border border-warning bg-light">
                            <div class="fs-3 fw-bold text-warning">${sudahDiisiCount}</div>
                            <div class="small text-muted">Sudah diisi</div>
                        </div>
                    </div>
                    <p class="text-muted small mb-0">Pilih tindakan yang ingin dilakukan:</p>
                </div>`,
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: `<i class="bi bi-eraser me-1"></i> Salin Hanya yang Kosong (${belumDiisiCount})`,
                denyButtonText: `<i class="bi bi-arrow-repeat me-1"></i> Timpa Semua (${totalInstrumen})`,
                cancelButtonText: 'Batal',
                confirmButtonColor: '#198754',
                denyButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Salin hanya yang kosong
                    doFill(false);
                } else if (result.isDenied) {
                    // Timpa semua — minta konfirmasi sekali lagi
                    Swal.fire({
                        icon: 'warning',
                        title: 'Timpa Semua?',
                        html: `<span class="text-danger fw-bold">${sudahDiisiCount} instrumen yang sudah diisi manual akan ditimpa.</span><br>
                               <span class="text-muted small">Tindakan ini tidak bisa dibatalkan setelah disimpan.</span>`,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Timpa Semua',
                        cancelButtonText: 'Tidak, Batal',
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                    }).then((r) => {
                        if (r.isConfirmed) doFill(true);
                    });
                }
            });
        }
    </script>
@endpush
