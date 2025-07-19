@extends('dataauditor.dashboard_template')

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

    // Flatten all kriterias into a single array
    $allKriterias = collect();
    foreach ($groupedData as $indikatorData) {
        foreach ($indikatorData['kriterias'] as $kriteriaId => $kriteriaData) {
            $allKriterias->push([
                'id' => $kriteriaId,
                'kriteria' => $kriteriaData['kriteria'],
                'completed' => isset($kriteriaData['completed']) && $kriteriaData['completed']
            ]);
        }
    }
    $allKriterias = $allKriterias->unique('id')->sortBy('kriteria.kode_kriteria');
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

    .wizard-step.completed {
        color: #50CD89;
    }

    .wizard-step.completed .step-label,
    .wizard-step.completed .step-desc,
    .wizard-step.completed .step-progress {
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
        font-weight: bold;
        font-size: 14px;
    }

    .wizard-step.active .step-number {
        background: #009EF7;
        border-color: #009EF7;
        color: white;
    }

    .wizard-step.completed .step-number {
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
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

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">


        <!-- Progress Card -->
        <div class="card mb-8">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="fw-bold text-gray-800">Progress Penilaian Instrumen</h4>
                </div>
            </div>
            <div class="card-body">
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
        </div>

        <!-- Form -->
        <form id="penilaianForm" action="{{ route('auditor.audit.submitPenilaianInstrumenProdi', $pengajuan->id) }}" method="POST">
            @csrf

            <!-- Kriteria Navigation Card -->
            <div class="card mb-8">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="fw-bold text-gray-800">Pilih Kriteria</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="wizard-nav">
                        @foreach($allKriterias as $kriteria)
                            @php
                                $kriteriaId = $kriteria['id'];
                                $totalKriteriaInstrumen = 0;
                                $completedKriteriaInstrumen = 0;

                                foreach ($groupedData as $indikatorData) {
                                    if (isset($indikatorData['kriterias'][$kriteriaId])) {
                                        $totalKriteriaInstrumen += count($indikatorData['kriterias'][$kriteriaId]['instrumens']);
                                        foreach ($indikatorData['kriterias'][$kriteriaId]['instrumens'] as $instrumenProdi) {
                                            if ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->count() > 0) {
                                                $completedKriteriaInstrumen++;
                                            }
                                        }
                                    }
                                }

                                $isKriteriaCompleted = $totalKriteriaInstrumen > 0 && $completedKriteriaInstrumen === $totalKriteriaInstrumen;
                                $stepClass = $isKriteriaCompleted ? 'completed' : ($loop->first ? 'active' : 'disabled');
                            @endphp
                            <div class="wizard-step {{ $stepClass }}" data-kriteria="{{ $kriteriaId }}" onclick="showKriteriaContent('{{ $kriteriaId }}')">
                                <div class="step-number">{{ $loop->iteration }}</div>
                                <div class="step-label">{{ $kriteria['kriteria']->kode_kriteria }}</div>
                                <div class="step-desc">
                                    {{ $completedKriteriaInstrumen }}/{{ $totalKriteriaInstrumen }}
                                    Instrumen
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            @foreach($allKriterias as $kriteria)
                <div class="kriteria-content {{ $loop->first ? 'active' : '' }}" id="instrumen-group-{{ $kriteria['id'] }}" style="display: {{ $loop->first ? 'block' : 'none' }}">
                    <!-- Status Alert Card -->
                    @php
                        $kriteriaId = $kriteria['id'];
                        $totalKriteriaInstrumen = 0;
                        $completedKriteriaInstrumen = 0;

                        foreach ($groupedData as $indikatorData) {
                            if (isset($indikatorData['kriterias'][$kriteriaId])) {
                                $totalKriteriaInstrumen += count($indikatorData['kriterias'][$kriteriaId]['instrumens']);
                                foreach ($indikatorData['kriterias'][$kriteriaId]['instrumens'] as $instrumenProdi) {
                                    if ($instrumenProdi->nilaiAuditor && $instrumenProdi->nilaiAuditor->count() > 0) {
                                        $completedKriteriaInstrumen++;
                                    }
                                }
                            }
                        }

                        $isKriteriaCompleted = $totalKriteriaInstrumen > 0 && $completedKriteriaInstrumen === $totalKriteriaInstrumen;
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
                </div>
            @endforeach

            <!-- Submit Button Card -->
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-8">
                        <i class="fas fa-save me-2"></i>
                        Simpan Penilaian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showKriteriaContent(kriteriaId) {
        // Hide all kriteria content
        $('.kriteria-content').hide().removeClass('active');

        // Show selected kriteria content
        $(`#instrumen-group-${kriteriaId}`).show().addClass('active');

        // Update wizard navigation
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-kriteria="${kriteriaId}"]`).addClass('active');

        // Scroll to top of content
        $('.wizard-nav')[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Form submission
    document.getElementById('penilaianForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Reload page to update progress
                    window.location.reload();
                });
            } else {
                // Show error message
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
                text: 'Terjadi kesalahan saat menyimpan penilaian.',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endpush
