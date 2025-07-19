@extends('dataauditor/dashboard_template')

@section('menuPenilaianInstrumenProdi')
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.penilaianInstrumenProdi') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i> Penilaian Instrumen Prodi
        </a>
    </li>
@endsection

@section('menuUnduhDokumen')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection

@php
    // Group by IndikatorInstrumen -> IndikatorInstrumenKriteria -> InstrumenProdi
    $groupedData = [];
    foreach ($indikatorInstrumens as $instrumen) {
        $indikatorId = $instrumen->id;
        if (!isset($groupedData[$indikatorId])) {
            $groupedData[$indikatorId] = [
                'indikator' => $instrumen,
                'kriterias' => []
            ];
        }

        // Skip if instrumen doesn't have kriterias relation
        if (!$instrumen->kriterias) {
            continue;
        }

        foreach ($instrumen->kriterias as $kriteria) {
            if (!$kriteria) continue;

            $kriteriaId = $kriteria->id;
            if (!isset($groupedData[$indikatorId]['kriterias'][$kriteriaId])) {
                $groupedData[$indikatorId]['kriterias'][$kriteriaId] = [
                    'kriteria' => $kriteria,
                    'instrumens' => []
                ];
            }

            // Skip if kriteria doesn't have instrumenProdi relation
            if (!$kriteria->instrumenProdi) {
                continue;
            }

            foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                if (!$instrumenProdi) continue;
                $groupedData[$indikatorId]['kriterias'][$kriteriaId]['instrumens'][] = $instrumenProdi;
            }
        }
    }

    // Calculate completion status for all instrumen prodi across all kriterias
    $totalInstrumen = 0;
    $completedInstrumen = 0;

    foreach ($groupedData as $indikatorId => $indikatorData) {
        foreach ($indikatorData['kriterias'] as $kriteriaId => $kriteriaData) {
            foreach ($kriteriaData['instrumens'] as $instrumenProdi) {
                $totalInstrumen++;
                // Check if auditor has given nilai for this instrumen
                if ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->count() > 0) {
                    $completedInstrumen++;
                }
            }
        }
    }

    $progressPercentage = $totalInstrumen > 0 ? ($completedInstrumen / $totalInstrumen) * 100 : 0;
    $isAllCompleted = $completedInstrumen === $totalInstrumen && $totalInstrumen > 0;

        // Flatten all kriterias into a single array with completion status
    $allKriterias = collect();
    $previousCompleted = true;
    $activeKriteriaId = null;

    // First, collect all kriterias with their completion status
    $kriteriaStatus = [];
    foreach ($groupedData as $indikatorData) {
        foreach ($indikatorData['kriterias'] as $kriteriaId => $kriteriaData) {
            if (!isset($kriteriaStatus[$kriteriaId])) {
                // Calculate completion status for this kriteria
                $totalKriteriaInstrumen = 0;
                $completedKriteriaInstrumen = 0;

                foreach ($groupedData as $indikatorData2) {
                    if (isset($indikatorData2['kriterias'][$kriteriaId])) {
                        $totalKriteriaInstrumen += count($indikatorData2['kriterias'][$kriteriaId]['instrumens']);
                        foreach ($indikatorData2['kriterias'][$kriteriaId]['instrumens'] as $instrumenProdi) {
                            if ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->count() > 0) {
                                $completedKriteriaInstrumen++;
                            }
                        }
                    }
                }

                $isKriteriaCompleted = $totalKriteriaInstrumen > 0 && $completedKriteriaInstrumen === $totalKriteriaInstrumen;

                $kriteriaStatus[$kriteriaId] = [
                    'kriteria' => $kriteriaData['kriteria'],
                    'completed' => $isKriteriaCompleted,
                    'total_instrumen' => $totalKriteriaInstrumen,
                    'completed_instrumen' => $completedKriteriaInstrumen
                ];
            }
        }
    }

    // Sort kriterias by kode_kriteria
    $sortedKriteriaIds = collect($kriteriaStatus)->sortBy('kriteria.kode_kriteria')->keys();

    // Now determine accessibility and active kriteria
    foreach ($sortedKriteriaIds as $kriteriaId) {
        $isKriteriaCompleted = $kriteriaStatus[$kriteriaId]['completed'];
        $isAccessible = $previousCompleted;

        $allKriterias->push([
            'id' => $kriteriaId,
            'kriteria' => $kriteriaStatus[$kriteriaId]['kriteria'],
            'completed' => $isKriteriaCompleted,
            'accessible' => $isAccessible,
            'total_instrumen' => $kriteriaStatus[$kriteriaId]['total_instrumen'],
            'completed_instrumen' => $kriteriaStatus[$kriteriaId]['completed_instrumen']
        ]);

        // Update previous completed status for next iteration
        $previousCompleted = $isKriteriaCompleted;
    }

    // Determine active kriteria with priority:
    // 1. From URL parameter (if user manually navigated)
    // 2. From session (if user was working on a specific kriteria)
    // 3. First incomplete kriteria
    // 4. First kriteria if all completed
    $activeKriteriaId = null;

    // Check URL parameter first
    if (request()->has('kriteria')) {
        $urlKriteriaId = request()->get('kriteria');
        if ($allKriterias->where('id', $urlKriteriaId)->count() > 0) {
            $activeKriteriaId = $urlKriteriaId;
        }
    }

    // If no URL parameter, check session
    if ($activeKriteriaId === null && session()->has('active_kriteria_' . $pengajuan->id)) {
        $sessionKriteriaId = session()->get('active_kriteria_' . $pengajuan->id);
        if ($allKriterias->where('id', $sessionKriteriaId)->count() > 0) {
            $activeKriteriaId = $sessionKriteriaId;
        }
    }

    // If still no active kriteria, find first incomplete or first kriteria
    if ($activeKriteriaId === null) {
        foreach ($allKriterias as $kriteria) {
            if (!$kriteria['completed'] || $activeKriteriaId === null) {
                $activeKriteriaId = $kriteria['id'];
                if (!$kriteria['completed']) {
                    break; // Stop at first incomplete kriteria
                }
            }
        }
    }

    // Debug: Log kriteria status for troubleshooting
    // Uncomment line below to see kriteria status in browser console
    // dd($allKriterias->toArray());

    // Get current auditor's penugasan to check approval status
    $currentAuditorPenugasan = $pengajuan->auditors->where('user_id', Auth::id())->first();
    $isPenilaianProdiApproved = $currentAuditorPenugasan ? $currentAuditorPenugasan->is_setuju_indikator_prodi : false;
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

    .wizard-step.active .step-label,
    .wizard-step.active .step-desc,
    .wizard-step.active .step-progress {
        color: #009EF7;
    }

    .wizard-step.completed:not(.active) {
        color: #50CD89;
    }

    .wizard-step.completed:not(.active) .step-label,
    .wizard-step.completed:not(.active) .step-desc,
    .wizard-step.completed:not(.active) .step-progress {
        color: #50CD89;
    }

    .wizard-step.completed:not(.active):not(:last-child):after {
        background: #50CD89;
    }

    .wizard-step.completed:not(.active):not(:last-child):before {
        border-color: #50CD89;
    }

    .wizard-step.active:not(:last-child):after {
        background: #009EF7;
    }

    .wizard-step.active:not(:last-child):before {
        border-color: #009EF7;
    }

    .wizard-step.accessible {
        color: #6C757D;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .wizard-step.accessible:hover {
        color: #009EF7;
    }

    .wizard-step.accessible:hover .step-number {
        background: #009EF7;
        border-color: #009EF7;
        color: white;
    }

    .wizard-step.accessible .step-number {
        background: #F5F8FA;
        border-color: #6C757D;
        color: #6C757D;
    }

    .wizard-step.disabled {
        color: #B5B5C3;
        cursor: pointer;
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .wizard-step.disabled:hover {
        opacity: 1;
    }

    .wizard-step.disabled .step-number {
        background: #F5F8FA;
        border-color: #B5B5C3;
        color: #B5B5C3;
    }

    .wizard-step.disabled .step-label,
    .wizard-step.disabled .step-desc {
        color: #B5B5C3;
    }

    /* Hover effects for all states */
    .wizard-step:hover {
        transform: translateY(-2px);
    }

    .wizard-step.completed:hover .step-number {
        background: #50CD89;
        border-color: #50CD89;
        color: white;
        transform: scale(1.05);
    }

    .wizard-step.active:hover .step-number {
        background: #009EF7;
        border-color: #009EF7;
        color: white;
        transform: scale(1.05);
    }

    .wizard-step .step-status {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .wizard-step .step-status i {
        font-size: 12px;
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
        font-weight: bold;
        font-size: 14px;
    }

    .wizard-step.active .step-number {
        background: #009EF7;
        border-color: #009EF7;
        color: white;
    }

    .wizard-step.completed:not(.active) .step-number {
        background: #50CD89;
        border-color: #50CD89;
        color: white;
    }

    .wizard-step .step-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 0.25rem;
    }

    .wizard-step .step-desc {
        font-size: 12px;
        color: #6C757D;
    }

    .wizard-content {
        display: none;
    }

    .wizard-content.active {
        display: block;
    }

    /* Simple Rating System Styles */
    .rating-container {
        position: relative;
    }

    .rating-input {
        display: none;
    }

    .rating-card {
        display: block;
        background: #ffffff;
        border: 2px solid #E4E6EF;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .rating-card:hover {
        border-color: #009EF7;
        box-shadow: 0 4px 12px rgba(0, 158, 247, 0.15);
        transform: translateY(-1px);
    }

    .rating-input:checked + .rating-card {
        background: #F0F8FF;
        border-color: #009EF7;
        box-shadow: 0 4px 12px rgba(0, 158, 247, 0.2);
    }

    .rating-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #181C32;
        margin-bottom: 0.5rem;
    }

    .rating-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #181C32;
        margin-bottom: 0.25rem;
    }

    .rating-desc {
        font-size: 0.75rem;
        color: #6C757D;
        line-height: 1.3;
    }

    /* Notes Section Styles */
    .notes-section {
        position: relative;
    }

    .notes-textarea {
        background: #ffffff;
        border: 1px solid #E4E6EF;
        border-radius: 8px;
        color: #181C32;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .notes-textarea:focus {
        border-color: #009EF7;
        box-shadow: 0 0 0 0.2rem rgba(0, 158, 247, 0.25);
    }

    .notes-textarea::placeholder {
        color: #A1A5B7;
    }

    .notes-footer {
        margin-top: 0.75rem;
        padding: 0.75rem;
        background: #F8F9FA;
        border-radius: 6px;
        border-left: 3px solid #009EF7;
    }

    /* Alert button positioning - hanya untuk tombol approval */
    .alert .ms-auto {
        margin-left: auto !important;
        flex-shrink: 0;
    }

    .alert .btn {
        white-space: nowrap;
    }

    /* Responsive adjustments untuk alert button */
    @media (max-width: 768px) {
        .alert {
            flex-direction: column;
        }

        .alert .ms-auto {
            margin-left: 0 !important;
            margin-top: 1rem;
        }

        .rating-card {
            padding: 0.75rem 0.5rem;
        }

        .rating-number {
            font-size: 1.25rem;
        }

        .rating-label {
            font-size: 0.8rem;
        }

        .rating-desc {
            font-size: 0.7rem;
        }
    }
</style>
@endpush

@section('dashboardProfile')
    <!-- Back Button -->
    <div class="mb-5">
        <a href="{{ route('auditor.audit.visitasi', $pengajuan->id) }}" class="btn btn-light-primary btn-sm">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Visitasi
        </a>
    </div>

    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                        👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </h3>
                </div>
            </div>
                    <div class="card-body">
            <!-- Alert Section -->
            <div class="alert {{ $isAllCompleted ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $isAllCompleted ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $isAllCompleted ? '✨ Penilaian Instrumen Prodi Selesai' : '📊 Penilaian Instrumen Prodi' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $isAllCompleted ? 'Selamat!' : 'Status:' }}</strong>
                            <span class="fw-semibold {{ $isAllCompleted ? 'text-success' : 'text-danger' }}">
                                @if($isAllCompleted)
                                    {{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah dinilai dengan lengkap.
                                    @if(!$isPenilaianProdiApproved)
                                        <br>Silakan klik tombol <strong>Setujui</strong> untuk melanjutkan ke tahap selanjutnya.
                                    @else
                                        <br>Silakan lanjut ke tahap selanjutnya.
                                    @endif
                                @else
                                    {{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah dinilai.
                                    <br>Silakan lengkapi penilaian yang tersisa.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto d-flex align-items-center">
                    @php
                        $currentAuditor = $pengajuan->auditors->where('user_id', Auth::id())->first();
                    @endphp
                    @if($currentAuditor)
                        @if($isAllCompleted)
                            @if($isPenilaianProdiApproved)
                                @if($currentAuditor->role == 'ketua')
                                    <a href="{{ route('auditor.audit.unduhDokumen', $pengajuan->id) }}" class="btn btn-sm px-4 btn-success">
                                        <i class="fas fa-arrow-right me-2"></i> Lanjut ke Unduh Dokumen
                                    </a>
                                @else
                                    <a href="{{ route('auditor.audit.daftarAuditee') }}" class="btn btn-sm px-4 btn-primary">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Daftar Auditee
                                    </a>
                                @endif
                            @else
                                <button type="button" class="btn btn-sm px-4 btn-success" id="approve-penilaian-btn" data-id="{{ $pengajuan->id }}">
                                    <i class="bi bi-check-circle me-2"></i> Setujui
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-sm px-4 btn-secondary disabled" style="cursor: not-allowed; opacity: 0.65;">
                                <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                            </button>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Progress Section -->
            <div class="mb-8">
                    <h4 class="fw-bold text-gray-800 mb-4">Progress Penilaian Instrumen</h4>
                    <div class="d-flex align-items-center mb-3">
                        <span class="fw-semibold text-gray-600 me-2">
                            @if($isAllCompleted)
                                Semua instrumen telah selesai dinilai
                            @else
                                {{ $completedInstrumen }} instrumen selesai dinilai
                            @endif
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 bg-light-primary rounded h-8px me-3">
                            <div class="bg-primary rounded h-8px" role="progressbar"
                                style="width: {{ $progressPercentage }}%"
                                aria-valuenow="{{ $progressPercentage }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <span class="fw-bold text-gray-800 fs-6">{{ number_format($progressPercentage, 1) }}%</span>
                    </div>
                </div>

                <!-- Form Container -->
                <div id="penilaianForm">

                    <!-- Kriteria Navigation -->
                    <div class="mb-8">
                        <h4 class="fw-bold text-gray-800 mb-4">Pilih Kriteria</h4>
                        <div class="wizard-nav">
                            @foreach($allKriterias as $kriteria)
                                @php
                                    $kriteriaId = $kriteria['id'];
                                    $isKriteriaCompleted = $kriteria['completed'];
                                    $isAccessible = $kriteria['accessible'];
                                    $isActive = $kriteriaId == $activeKriteriaId;

                                    // Determine step class - allow multiple classes
                                    $stepClasses = [];
                                    if ($isKriteriaCompleted) {
                                        $stepClasses[] = 'completed';
                                    }
                                    if ($isActive) {
                                        $stepClasses[] = 'active';
                                    } elseif ($isAccessible) {
                                        $stepClasses[] = 'accessible';
                                    } else {
                                        $stepClasses[] = 'disabled';
                                    }
                                    $stepClass = implode(' ', $stepClasses);
                                @endphp
                                <div class="wizard-step {{ $stepClass }}"
                                     data-kriteria="{{ $kriteriaId }}"
                                     data-accessible="{{ $isAccessible ? 'true' : 'false' }}"
                                     onclick="showKriteriaContent('{{ $kriteriaId }}', {{ $isAccessible ? 'true' : 'false' }})"
                                     title="{{ $isKriteriaCompleted ? 'Kriteria selesai' : ($isAccessible ? 'Kriteria dapat diakses' : 'Selesaikan kriteria sebelumnya terlebih dahulu') }}">
                                    <div class="step-number">{{ $loop->iteration }}</div>
                                    <div class="step-label">{{ $kriteria['kriteria']->kode_kriteria }}</div>
                                    <div class="step-desc">
                                        {{ $kriteria['completed_instrumen'] }}/{{ $kriteria['total_instrumen'] }}
                                        Instrumen
                                    </div>
                                    @if($isKriteriaCompleted)
                                        <div class="step-status">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                    @elseif(!$isAccessible)
                                        <div class="step-status">
                                            <i class="fas fa-lock text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Content Area -->
                    @foreach($allKriterias as $kriteria)
                        <div class="kriteria-content {{ $kriteria['id'] == $activeKriteriaId ? 'active' : '' }}" id="instrumen-group-{{ $kriteria['id'] }}" style="display: {{ $kriteria['id'] == $activeKriteriaId ? 'block' : 'none' }}">
                            <!-- Status Alert -->
                            @php
                                $kriteriaId = $kriteria['id'];
                                $totalKriteriaInstrumen = $kriteria['total_instrumen'];
                                $completedKriteriaInstrumen = $kriteria['completed_instrumen'];
                                $isKriteriaCompleted = $kriteria['completed'];
                            @endphp

                            <div class="alert {{ $isKriteriaCompleted ? 'alert-success' : 'alert-info' }} d-flex flex-column flex-sm-row p-5 mb-8">
                                <span class="svg-icon svg-icon-2hx {{ $isKriteriaCompleted ? 'svg-icon-success' : 'svg-icon-info' }} me-4 mb-5 mb-sm-0">
                                    @if($isKriteriaCompleted)
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
                                    <h5 class="mb-1">Status: {{ $isKriteriaCompleted ? 'Sudah Dinilai Lengkap' : 'Belum Lengkap' }}</h5>
                                    <div class="fs-6">
                                        <div class="fw-semibold text-gray-700">Kriteria: {{ $kriteria['kriteria']->kode_kriteria }} - {{ $kriteria['kriteria']->nama_kriteria }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1">Progress: {{ $completedKriteriaInstrumen }}/{{ $totalKriteriaInstrumen }} instrumen dinilai lengkap</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Instrumen Cards -->
                            @foreach($groupedData as $indikatorData)
                                @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                                    @if($kriteriaId == $kriteria['id'])
                                        @foreach($kriteriaData['instrumens'] as $instrumenProdi)
                                            <div class="card card-bordered shadow-sm mb-8">
                                                <div class="card-header bg-light">
                                                    <div class="card-title">
                                                        <h3 class="card-label text-gray-800 fw-bold">
                                                            {{ $loop->iteration }}. {{ $instrumenProdi->elemen }}
                                                            <span class="d-block text-muted pt-2 fs-7">{{ $instrumenProdi->indikator }}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-8">
                                                        <h6 class="fw-bold mb-3">{{ $instrumenProdi->indikator }}</h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered border-gray-300">
                                                                <tr>
                                                                    <td class="fw-semibold bg-light" width="30%">Sumber Data/Bukti</td>
                                                                    <td>
                                                                        @if($instrumenProdi->submission && $instrumenProdi->submission->file_sumber)
                                                                            <div class="mb-2">
                                                                                <a href="{{ Storage::url($instrumenProdi->submission->file_sumber) }}" target="_blank" class="btn btn-sm btn-light-primary">
                                                                                    <i class="fas fa-file-download me-2"></i>
                                                                                    Lihat Dokumen
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                        @if($instrumenProdi->submission && $instrumenProdi->submission->url_sumber)
                                                                            <div class="mb-2">
                                                                                <a href="{{ $instrumenProdi->submission->url_sumber }}" target="_blank" class="btn btn-sm btn-light-info">
                                                                                    <i class="fas fa-link me-2"></i>
                                                                                    Lihat URL Sumber
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                        <span class="text-muted">Dokumen bukti dari auditee</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-semibold bg-light">Target</td>
                                                                    <td>{{ $instrumenProdi->target }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-semibold bg-light">Realisasi</td>
                                                                    <td>{{ $instrumenProdi->submission ? $instrumenProdi->submission->realisasi : '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-semibold bg-light">Uraian/Isian</td>
                                                                    <td>{{ $instrumenProdi->uraian }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-semibold bg-light">Akar Penyebab</td>
                                                                    <td>{{ $instrumenProdi->submission ? $instrumenProdi->submission->akar_penyebab : '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-semibold bg-light">Rencana Perbaikan</td>
                                                                    <td>{{ $instrumenProdi->submission ? $instrumenProdi->submission->rencana_perbaikan : '-' }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="mb-8">
                                                        <h6 class="fw-bold mb-3">Indikator Penilaian</h6>
                                                        <div class="bg-light-warning rounded p-4">
                                                            <div class="text-dark">
                                                                {!! $instrumenProdi->indikator_penilaian !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Penilaian Auditor -->
                                                    <div class="card border">
                                                        <div class="card-header bg-light">
                                                            <div class="d-flex align-items-center">
                                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                    <i class="fas fa-star text-primary fs-4"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1 text-gray-800 fw-bold">Penilaian Auditor</h5>
                                                                    <p class="mb-0 text-muted">Berikan penilaian berdasarkan indikator yang telah ditetapkan</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <!-- Status Indicator -->
                                                            <div class="text-center mb-4">
                                                                @if($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->count() > 0)
                                                                    <div class="d-inline-flex align-items-center bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill">
                                                                        <div class="bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                                                        <span class="fw-semibold">Sudah Dinilai</span>
                                                                    </div>
                                                                @else
                                                                    <div class="d-inline-flex align-items-center bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill">
                                                                        <div class="bg-warning rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                                                        <span class="fw-semibold">Belum Dinilai</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- Rating System -->
                                                            <div class="mb-4">
                                                                <label class="form-label fw-bold text-gray-800 mb-3">Pilih Nilai Penilaian</label>
                                                                <div class="rating-container">
                                                                    <div class="row g-3">
                                                                        <div class="col-6 col-md-3">
                                                                            <input type="radio" name="nilai[{{ $instrumenProdi->id }}]" value="4" id="nilai4_{{ $instrumenProdi->id }}" class="rating-input" {{ ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->first() && $instrumenProdi->nilaiAuditor->first()->nilai == 4) ? 'checked' : '' }} required>
                                                                            <label for="nilai4_{{ $instrumenProdi->id }}" class="rating-card">
                                                                                <div class="rating-number">4</div>
                                                                                <div class="rating-label">Sangat Baik</div>
                                                                                <div class="rating-desc">Melampaui standar</div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-6 col-md-3">
                                                                            <input type="radio" name="nilai[{{ $instrumenProdi->id }}]" value="3" id="nilai3_{{ $instrumenProdi->id }}" class="rating-input" {{ ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->first() && $instrumenProdi->nilaiAuditor->first()->nilai == 3) ? 'checked' : '' }} required>
                                                                            <label for="nilai3_{{ $instrumenProdi->id }}" class="rating-card">
                                                                                <div class="rating-number">3</div>
                                                                                <div class="rating-label">Baik</div>
                                                                                <div class="rating-desc">Memenuhi standar</div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-6 col-md-3">
                                                                            <input type="radio" name="nilai[{{ $instrumenProdi->id }}]" value="2" id="nilai2_{{ $instrumenProdi->id }}" class="rating-input" {{ ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->first() && $instrumenProdi->nilaiAuditor->first()->nilai == 2) ? 'checked' : '' }} required>
                                                                            <label for="nilai2_{{ $instrumenProdi->id }}" class="rating-card">
                                                                                <div class="rating-number">2</div>
                                                                                <div class="rating-label">Kurang</div>
                                                                                <div class="rating-desc">Perlu perbaikan</div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-6 col-md-3">
                                                                            <input type="radio" name="nilai[{{ $instrumenProdi->id }}]" value="1" id="nilai1_{{ $instrumenProdi->id }}" class="rating-input" {{ ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->first() && $instrumenProdi->nilaiAuditor->first()->nilai == 1) ? 'checked' : '' }} required>
                                                                            <label for="nilai1_{{ $instrumenProdi->id }}" class="rating-card">
                                                                                <div class="rating-number">1</div>
                                                                                <div class="rating-label">Sangat Kurang</div>
                                                                                <div class="rating-desc">Tidak memenuhi standar</div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Notes Section -->
                                                            <div class="notes-section">
                                                                <label class="form-label fw-bold text-gray-800 mb-3">
                                                                    <i class="fas fa-comment-alt me-2"></i>Catatan Penilaian
                                                                </label>
                                                                <div class="position-relative">
                                                                    <textarea name="catatan[{{ $instrumenProdi->id }}]"
                                                                              class="form-control notes-textarea"
                                                                              rows="4"
                                                                              placeholder="Tambahkan catatan, saran, atau observasi khusus untuk instrumen ini...">{{ $instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->first() ? $instrumenProdi->nilaiAuditor->first()->catatan : '' }}</textarea>
                                                                    <div class="notes-footer">
                                                                        <small class="text-muted">
                                                                            <i class="fas fa-info-circle me-1"></i>
                                                                            Catatan bersifat opsional namun sangat membantu untuk evaluasi yang lebih komprehensif
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach

                            <!-- Navigation Buttons - Show for all kriterias but only display active one -->
                            <div class="d-flex justify-content-between align-items-center mt-8" style="display: {{ $kriteria['id'] == $activeKriteriaId ? 'flex' : 'none' }};">
                                @php
                                    $currentIndex = $allKriterias->search(function($item) use ($kriteria) { return $item['id'] == $kriteria['id']; });
                                    $prevKriteria = $currentIndex > 0 ? $allKriterias[$currentIndex - 1] : null;
                                    $nextKriteria = $currentIndex < $allKriterias->count() - 1 ? $allKriterias[$currentIndex + 1] : null;
                                    $isLastKriteria = $currentIndex == $allKriterias->count() - 1;
                                @endphp

                                <!-- Previous Button -->
                                @if($prevKriteria)
                                    <button type="button" class="btn btn-secondary" onclick="showKriteriaContent('{{ $prevKriteria['id'] }}', true)">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kriteria Sebelumnya
                                    </button>
                                @else
                                    <div></div>
                                @endif

                                <!-- Save & Continue/Selesai Button -->
                                @if($isLastKriteria)
                                    <button type="button" class="btn btn-success" id="save-finish-btn" onclick="validateAndSaveFinish()">
                                        <i class="fas fa-check me-2"></i>
                                        Simpan & Selesai
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" id="save-continue-btn" onclick="validateAndSaveContinue('{{ $nextKriteria['id'] }}', {{ $nextKriteria['accessible'] ? 'true' : 'false' }})">
                                        <i class="fas fa-save me-2"></i>
                                        Simpan & Lanjutkan
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
    // Debug: Log kriteria status to console
    console.log('Kriteria Status:', @json($allKriterias->toArray()));

    // Debug: Show current active kriteria
    console.log('Active Kriteria ID:', '{{ $activeKriteriaId }}');

    // Initialize save button status on page load
    $(document).ready(function() {
        const activeKriteriaId = '{{ $activeKriteriaId }}';
        if (activeKriteriaId) {
            updateSaveButtonStatus(activeKriteriaId);
        }
    });
    function showKriteriaContent(kriteriaId, isAccessible) {
        // Check if kriteria is accessible
        if (!isAccessible) {
            Swal.fire({
                icon: 'warning',
                title: '⚠️ Kriteria Belum Dapat Diakses',
                text: 'Anda harus menyelesaikan kriteria sebelumnya terlebih dahulu sebelum dapat mengakses kriteria ini.',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#6C757D'
            });
            return;
        }

        // Hide all kriteria content
        $('.kriteria-content').hide().removeClass('active');

        // Show selected kriteria content
        $(`#instrumen-group-${kriteriaId}`).show().addClass('active');

        // Update wizard navigation
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-kriteria="${kriteriaId}"]`).addClass('active');

        // Show navigation buttons for the new active kriteria
        showNavigationButtons(kriteriaId);

        // Save active kriteria to session
        saveActiveKriteriaToSession(kriteriaId);

        // Scroll to top of content
        setTimeout(() => {
            console.log('Scrolling to top...');
            document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
        }, 100);
    }



    // Approve penilaian button
    $(document).on('click', '#approve-penilaian-btn', function() {
        const pengajuanId = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Penilaian Instrumen Prodi akan disetujui dan tidak dapat diubah lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('auditor.audit.approvePenilaianProdi', ':id') }}".replace(':id', pengajuanId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Disetujui!',
                                text: 'Penilaian Instrumen Prodi berhasil disetujui.',
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan saat menyetujui penilaian.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyetujui penilaian.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });

            // Save current kriteria
    function saveCurrentKriteria() {
        const currentKriteriaId = $('.kriteria-content.active').attr('id').replace('instrumen-group-', '');
        const formData = new FormData();

        // Get all form data for current kriteria
        $(`#instrumen-group-${currentKriteriaId} input, #instrumen-group-${currentKriteriaId} textarea`).each(function() {
            if ($(this).attr('name')) {
                const value = $(this).val();
                console.log('Form field:', $(this).attr('name'), 'Value:', value, 'Type:', typeof value);
                // For radio buttons, only add if checked
                if ($(this).attr('type') === 'radio') {
                    if ($(this).is(':checked')) {
                        formData.append($(this).attr('name'), value);
                    }
                } else {
                    // For other inputs, add if not empty
                    if (value !== undefined && value !== '') {
                        formData.append($(this).attr('name'), value);
                    }
                }
            }
        });

        // Add CSRF token
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("auditor.audit.submitPenilaianInstrumenProdi", $pengajuan->id) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Kriteria berhasil disimpan.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Update the current kriteria step to completed
                    updateKriteriaStepStatus(currentKriteriaId, true);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Terjadi kesalahan saat menyimpan kriteria.',
                confirmButtonText: 'OK'
            });
        });
    }

    // Update kriteria step status visually
    function updateKriteriaStepStatus(kriteriaId, isCompleted) {
        const stepElement = $(`.wizard-step[data-kriteria="${kriteriaId}"]`);

        if (isCompleted) {
            // Remove all classes and add completed
            stepElement.removeClass('active accessible disabled').addClass('completed');

            // Update step number styling
            stepElement.find('.step-number').css({
                'background': '#50CD89',
                'border-color': '#50CD89',
                'color': 'white'
            });

            // Update text colors
            stepElement.find('.step-label, .step-desc').css('color', '#50CD89');

            // Update connector lines
            stepElement.find(':after').css('background', '#50CD89');
            stepElement.find(':before').css('border-color', '#50CD89');

            // Add check icon if not exists
            if (stepElement.find('.step-status').length === 0) {
                stepElement.append('<div class="step-status"><i class="fas fa-check-circle text-success"></i></div>');
            } else {
                // Update existing status icon
                stepElement.find('.step-status i').removeClass().addClass('fas fa-check-circle text-success');
            }

            console.log('Updated kriteria', kriteriaId, 'to completed status');
        }
    }

            // Validate current kriteria before saving
    function validateCurrentKriteria() {
        const currentKriteriaId = $('.kriteria-content.active').attr('id').replace('instrumen-group-', '');
        const requiredFields = [];

        // Check all radio buttons (nilai) in current kriteria
        $(`#instrumen-group-${currentKriteriaId} input[type="radio"]`).each(function() {
            const name = $(this).attr('name');
            if (name && name.startsWith('nilai[') && !requiredFields.includes(name)) {
                requiredFields.push(name);
            }
        });

        // Check if all required fields are filled
        const filledFields = [];
        requiredFields.forEach(fieldName => {
            const checkedRadio = $(`#instrumen-group-${currentKriteriaId} input[name="${fieldName}"]:checked`);
            if (checkedRadio.length > 0) {
                filledFields.push(fieldName);
            }
        });

        // If not all fields are filled, show error
        if (filledFields.length < requiredFields.length) {
            const missingCount = requiredFields.length - filledFields.length;
            Swal.fire({
                icon: 'warning',
                title: '⚠️ Data Belum Lengkap',
                text: `Masih ada ${missingCount} instrumen yang belum dinilai. Silakan lengkapi semua penilaian terlebih dahulu.`,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#6C757D'
            });
            return false;
        }

        return true;
    }

    // Validate and save continue
    function validateAndSaveContinue(nextKriteriaId, isAccessible) {
        if (!validateCurrentKriteria()) {
            return;
        }
        saveAndContinue(nextKriteriaId, isAccessible);
    }

    // Validate and save finish
    function validateAndSaveFinish() {
        if (!validateCurrentKriteria()) {
            return;
        }
        saveAndFinish();
    }

    // Save and continue to next kriteria
    function saveAndContinue(nextKriteriaId, isAccessible) {
        const currentKriteriaId = $('.kriteria-content.active').attr('id').replace('instrumen-group-', '');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Kriteria ini akan disimpan dan Anda akan melanjutkan ke kriteria berikutnya.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan & Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                // Get all form data for current kriteria
                $(`#instrumen-group-${currentKriteriaId} input, #instrumen-group-${currentKriteriaId} textarea`).each(function() {
                    if ($(this).attr('name')) {
                        const value = $(this).val();
                        // For radio buttons, only add if checked
                        if ($(this).attr('type') === 'radio') {
                            if ($(this).is(':checked')) {
                                formData.append($(this).attr('name'), value);
                            }
                        } else {
                            if (value !== undefined && value !== '') {
                                formData.append($(this).attr('name'), value);
                            }
                        }
                    }
                });
                // Add CSRF token
                formData.append('_token', '{{ csrf_token() }}');
                fetch('{{ route("auditor.audit.submitPenilaianInstrumenProdi", $pengajuan->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Kriteria berhasil disimpan.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Update kriteria step status without reload
                            updateKriteriaStepStatus(currentKriteriaId, true);

                            // Navigate to next kriteria immediately
                            forceNavigateToKriteria(nextKriteriaId);

                            // Scroll to top
                            setTimeout(() => {
                                document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
                            }, 200);
                        });
                    } else {
                        // Handle validation errors
                        let errorMessage = data.message || 'Terjadi kesalahan';

                        if (data.errors) {
                            // Format validation errors
                            const errorDetails = Object.values(data.errors).flat().join('\n');
                            errorMessage = `Validasi gagal:\n${errorDetails}`;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Terjadi kesalahan saat menyimpan kriteria.',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    }

    // Force navigate to kriteria without accessibility check
    function forceNavigateToKriteria(kriteriaId) {
        // Hide all kriteria content
        $('.kriteria-content').hide().removeClass('active');

        // Show selected kriteria content
        $(`#instrumen-group-${kriteriaId}`).show().addClass('active');

        // Update wizard navigation - preserve completed status
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-kriteria="${kriteriaId}"]`).addClass('active');

        // Show navigation buttons for the new active kriteria
        showNavigationButtons(kriteriaId);

        // Save active kriteria to session
        saveActiveKriteriaToSession(kriteriaId);

        // Scroll to top of content
        setTimeout(() => {
            console.log('Scrolling to top...');
            document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
        }, 100);

        console.log('Navigated to kriteria', kriteriaId);
    }

    // Save active kriteria to session
    function saveActiveKriteriaToSession(kriteriaId) {
        fetch('{{ route("auditor.audit.saveActiveKriteria", $pengajuan->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                kriteria_id: kriteriaId
            })
        });
    }

    // Show navigation buttons for specific kriteria
    function showNavigationButtons(kriteriaId) {
        // Hide all navigation button containers
        $('.kriteria-content .d-flex.justify-content-between').hide();

        // Show navigation buttons for the active kriteria
        $(`#instrumen-group-${kriteriaId} .d-flex.justify-content-between`).show();

        // Update button status based on completion
        updateSaveButtonStatus(kriteriaId);
    }

    // Update save button status based on completion
    function updateSaveButtonStatus(kriteriaId) {
        const requiredFields = [];

        // Get all required radio buttons
        $(`#instrumen-group-${kriteriaId} input[type="radio"]`).each(function() {
            const name = $(this).attr('name');
            if (name && name.startsWith('nilai[') && !requiredFields.includes(name)) {
                requiredFields.push(name);
            }
        });

        // Check if all required fields are filled
        const filledFields = [];
        requiredFields.forEach(fieldName => {
            const checkedRadio = $(`#instrumen-group-${kriteriaId} input[name="${fieldName}"]:checked`);
            if (checkedRadio.length > 0) {
                filledFields.push(fieldName);
            }
        });

        const isComplete = filledFields.length === requiredFields.length;
        const saveFinishBtn = $('#save-finish-btn');
        const saveContinueBtn = $('#save-continue-btn');

        if (saveFinishBtn.length > 0) {
            // Last kriteria - update finish button
            if (isComplete) {
                saveFinishBtn.removeClass('btn-secondary disabled').addClass('btn-success').prop('disabled', false);
                saveFinishBtn.html('<i class="fas fa-check me-2"></i>Simpan & Selesai');
            } else {
                saveFinishBtn.removeClass('btn-success').addClass('btn-secondary disabled').prop('disabled', true);
                saveFinishBtn.html('<i class="fas fa-clock me-2"></i>Lengkapi Semua Penilaian');
            }
        } else if (saveContinueBtn.length > 0) {
            // Other kriteria - update continue button
            if (isComplete) {
                saveContinueBtn.removeClass('btn-secondary disabled').addClass('btn-primary').prop('disabled', false);
                saveContinueBtn.html('<i class="fas fa-save me-2"></i>Simpan & Lanjutkan');
            } else {
                saveContinueBtn.removeClass('btn-primary').addClass('btn-secondary disabled').prop('disabled', true);
                saveContinueBtn.html('<i class="fas fa-clock me-2"></i>Lengkapi Semua Penilaian');
            }
        }
    }

    // Add event listeners for radio button changes
    $(document).on('change', 'input[type="radio"]', function() {
        const currentKriteriaId = $('.kriteria-content.active').attr('id').replace('instrumen-group-', '');
        updateSaveButtonStatus(currentKriteriaId);
    });

        // Save and finish (for last kriteria)
    function saveAndFinish() {
        const currentKriteriaId = $('.kriteria-content.active').attr('id').replace('instrumen-group-', '');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Semua data kriteria akan disimpan dan proses penilaian akan selesai.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan & Selesai',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                $(`#instrumen-group-${currentKriteriaId} input, #instrumen-group-${currentKriteriaId} textarea`).each(function() {
                    if ($(this).attr('name')) {
                        const value = $(this).val();
                        if ($(this).attr('type') === 'radio') {
                            if ($(this).is(':checked')) {
                                formData.append($(this).attr('name'), value);
                            }
                        } else {
                            if (value !== undefined && value !== '') {
                                formData.append($(this).attr('name'), value);
                            }
                        }
                    }
                });
                formData.append('_token', '{{ csrf_token() }}');
                fetch('{{ route("auditor.audit.submitPenilaianInstrumenProdi", $pengajuan->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '🎉 Penilaian Selesai!',
                            text: 'Semua kriteria telah berhasil disimpan.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            updateKriteriaStepStatus(currentKriteriaId, true);
                            // Navigate to first kriteria and scroll to its content
                            const firstKriteriaId = $('.wizard-step').first().data('kriteria');
                            forceNavigateToKriteria(firstKriteriaId);
                            // Additional scroll to ensure we reach the top
                            setTimeout(() => {
                                document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
                            }, 300);
                        });
                    } else {
                        // Handle validation errors
                        let errorMessage = data.message || 'Terjadi kesalahan';

                        if (data.errors) {
                            // Format validation errors
                            const errorDetails = Object.values(data.errors).flat().join('\n');
                            errorMessage = `Validasi gagal:\n${errorDetails}`;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Terjadi kesalahan saat menyimpan kriteria.',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    }
</script>
@endpush
