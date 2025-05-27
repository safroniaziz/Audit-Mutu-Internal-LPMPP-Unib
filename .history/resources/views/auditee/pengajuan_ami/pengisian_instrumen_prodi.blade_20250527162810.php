@extends('auditee/dashboard_template')

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

    foreach ($groupedData as $indikatorData) {
        foreach ($indikatorData['kriterias'] as $kriteriaData) {
            // Count instrumen prodi in this kriteria
            $totalInstrumen += count($kriteriaData['instrumens']);

            // Count completed submissions
            foreach ($kriteriaData['instrumens'] as $instrumenProdi) {
                if ($instrumenProdi->submission !== null) {
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
</style>
@endpush

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            @if($allKriterias->count() > 0)
                <!-- Progress Status -->
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
                                            {{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah diisi. Silakan lengkapi pengisian instrumen yang tersisa.
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

                    <!-- Wizard Navigation -->
                    <div class="wizard-nav mb-5">
                        @foreach($allKriterias as $kriteria)
                            @php
                                $isStepAccessible = false;
                                $prevCompleted = true;
                                $kriteriaId = $kriteria['id'];

                                // Count total and completed instrumens for this kriteria
                                $totalKriteriaInstrumen = 0;
                                $completedKriteriaInstrumen = 0;

                                foreach ($groupedData as $indikatorData) {
                                    if (isset($indikatorData['kriterias'][$kriteriaId])) {
                                        $totalKriteriaInstrumen += count($indikatorData['kriterias'][$kriteriaId]['instrumens']);
                                        foreach ($indikatorData['kriterias'][$kriteriaId]['instrumens'] as $instrumenProdi) {
                                            if ($instrumenProdi->submission !== null) {
                                                $completedKriteriaInstrumen++;
                                            }
                                        }
                                    }
                                }

                                $isKriteriaCompleted = $totalKriteriaInstrumen > 0 && $completedKriteriaInstrumen === $totalKriteriaInstrumen;

                                // Check if all previous steps are completed
                                foreach ($allKriterias as $prevKriteria) {
                                    if ($prevKriteria['id'] == $kriteriaId) {
                                        break;
                                    }

                                    $prevTotalInstrumen = 0;
                                    $prevCompletedInstrumen = 0;
                                    foreach ($groupedData as $indikatorData) {
                                        if (isset($indikatorData['kriterias'][$prevKriteria['id']])) {
                                            $prevTotalInstrumen += count($indikatorData['kriterias'][$prevKriteria['id']]['instrumens']);
                                            foreach ($indikatorData['kriterias'][$prevKriteria['id']]['instrumens'] as $instrumenProdi) {
                                                if ($instrumenProdi->submission !== null) {
                                                    $prevCompletedInstrumen++;
                                                }
                                            }
                                        }
                                    }

                                    if ($prevTotalInstrumen > 0 && $prevCompletedInstrumen < $prevTotalInstrumen) {
                                        $prevCompleted = false;
                                        break;
                                    }
                                }

                                // Step is accessible if it's the first step, or all previous steps are completed,
                                // or this step is already partially/fully completed
                                $isStepAccessible = $loop->first ||
                                                 $prevCompleted ||
                                                 $completedKriteriaInstrumen > 0;

                                $stepClass = $loop->first ? 'active' : '';
                                $stepClass .= $isKriteriaCompleted ? ' completed' : '';
                                $stepClass .= !$isStepAccessible ? ' disabled' : '';
                            @endphp
                            <div class="wizard-step {{ $stepClass }}"
                                 data-kriteria-id="{{ $kriteriaId }}"
                                 data-completed="{{ $isKriteriaCompleted ? 'true' : 'false' }}"
                                 data-accessible="{{ $isStepAccessible ? 'true' : 'false' }}">
                                <div class="step-number">{{ $kriteria['kriteria']->kode_kriteria }}</div>
                                <div class="step-label">Kriteria {{ $kriteria['kriteria']->kode_kriteria }}</div>
                                <div class="step-desc">{{ Str::limit($kriteria['kriteria']->nama_kriteria, 50) }}</div>
                                <div class="step-progress">
                                    {{ $completedKriteriaInstrumen }}/{{ $totalKriteriaInstrumen }} instrumen
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
                                    {{ $completedInstrumen }} instrumen selesai diisi
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
                    @foreach($allKriterias as $kriteria)
                        <div class="wizard-content {{ $loop->first ? 'active' : '' }}" id="instrumen-group-{{ $kriteria['id'] }}" style="display: {{ $loop->first ? 'block' : 'none' }}">
                            <!-- Status Alert -->
                            @php
                                $kriteriaId = $kriteria['id'];
                                $totalKriteriaInstrumen = 0;
                                $completedKriteriaInstrumen = 0;

                                foreach ($groupedData as $indikatorData) {
                                    if (isset($indikatorData['kriterias'][$kriteriaId])) {
                                        $totalKriteriaInstrumen += count($indikatorData['kriterias'][$kriteriaId]['instrumens']);
                                        foreach ($indikatorData['kriterias'][$kriteriaId]['instrumens'] as $instrumenProdi) {
                                            if ($instrumenProdi->submission !== null) {
                                                $completedKriteriaInstrumen++;
                                            }
                                        }
                                    }
                                }

                                $isKriteriaCompleted = $totalKriteriaInstrumen > 0 && $completedKriteriaInstrumen === $totalKriteriaInstrumen;
                            @endphp

                            <div class="alert {{ $isKriteriaCompleted ? 'alert-success' : 'alert-danger' }} d-flex flex-column flex-sm-row p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx {{ $isKriteriaCompleted ? 'svg-icon-success' : 'svg-icon-danger' }} me-4 mb-5 mb-sm-0">
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
                                    <h5 class="mb-1">Status: {{ $isKriteriaCompleted ? 'Sudah Diisi Lengkap' : 'Belum Lengkap' }}</h5>
                                    <div class="fs-6">
                                        <div class="fw-semibold text-gray-700">Kriteria: {{ $kriteria['kriteria']->kode_kriteria }} - {{ $kriteria['kriteria']->nama_kriteria }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1">Progress: {{ $completedKriteriaInstrumen }}/{{ $totalKriteriaInstrumen }} instrumen diisi lengkap</div>
                                    </div>
                                </div>
                            </div>

                            @foreach($groupedData as $indikatorData)
                                @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                                    @if($kriteriaId == $kriteria['id'])
                                        @foreach($kriteriaData['instrumens'] as $instrumenProdi)
                                            <div class="card card-bordered shadow-sm mb-10">
                                                <div class="card-header bg-light">
                                                    <div class="card-title">
                                                        <h3 class="card-label text-gray-800 fw-bold">
                                                            {{ $loop->iteration }}. {{ $instrumenProdi->elemen }}
                                                            <span class="d-block text-muted pt-2 font-size-sm">{{ $instrumenProdi->indikator }}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form class="instrumen-form" data-instrumen-id="{{ $instrumenProdi->id }}">
                                                        @csrf
                                                        <div class="mb-8">
                                                            <h6 class="fw-bold mb-3">Referensi</h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered border-gray-300">
                                                                    <tr>
                                                                        <td width="30%" class="fw-semibold bg-light">Elemen</td>
                                                                        <td>{{ $instrumenProdi->elemen }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-semibold bg-light">Indikator</td>
                                                                        <td>{{ $instrumenProdi->indikator }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-semibold bg-light">Dokumen Pendukung</td>
                                                                        <td>
                                                                            @if($instrumenProdi->submission && $instrumenProdi->submission->dokumen->count() > 0)
                                                                                <div class="mb-2">
                                                                                    @foreach($instrumenProdi->submission->dokumen as $dokumen)
                                                                                        <a href="{{ asset('storage/'.$dokumen->path) }}" target="_blank" class="btn btn-sm btn-outline-info me-2 mb-2">
                                                                                            <i class="fas fa-file-alt"></i> {{ $dokumen->nama_file }}
                                                                                        </a>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                            <div class="mt-2">
                                                                                <input type="file" name="dokumen[]" class="form-control" multiple>
                                                                                <div class="form-text">Upload file bukti disini (PDF, DOC, DOCX, XLS, XLSX)</div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-semibold bg-light">Nilai</td>
                                                                        <td>
                                                                            <input type="number" class="form-control" name="nilai" min="0" max="100"
                                                                                value="{{ $instrumenProdi->submission ? $instrumenProdi->submission->nilai : '' }}"
                                                                                required>
                                                                            <div class="form-text">Masukkan nilai antara 0-100</div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="mb-8">
                                                            <h6 class="fw-bold mb-3">Deskripsi</h6>
                                                            <textarea class="form-control" name="deskripsi" rows="4" required>{{ $instrumenProdi->submission ? $instrumenProdi->submission->deskripsi : '' }}</textarea>
                                                            <div class="form-text">Berikan deskripsi yang jelas dan detail</div>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">
                                                                <span class="indicator-label">
                                                                    <i class="fas fa-save me-2"></i>Simpan
                                                                </span>
                                                                <span class="indicator-progress">
                                                                    Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-5">
                                @if(!$loop->first)
                                    <button type="button" class="btn btn-light-primary" onclick="navigateStep('prev', {{ $kriteria['id'] }})">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                @else
                                    <div></div>
                                @endif

                                @if(!$loop->last)
                                    <button type="button" class="btn btn-primary" onclick="navigateStep('next', {{ $kriteria['id'] }})">
                                        Selanjutnya <i class="fas fa-arrow-right"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada instrumen yang tersedia.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Show first kriteria's content by default
    const firstKriteriaId = $('.wizard-step').first().data('kriteria-id');
    if (firstKriteriaId) {
        showKriteriaContent(firstKriteriaId);
    }

    // Wizard step click handler
    $('.wizard-step').click(function() {
        const kriteriaId = $(this).data('kriteria-id');
        showKriteriaContent(kriteriaId);
    });

    // Form submission handler
    $('.instrumen-form').on('submit', function(e) {
        e.preventDefault();

        const instrumenId = $(this).data('instrumen-id');
        const formData = new FormData(this);
        const form = $(this);

        // Show loading state
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.attr('data-kt-indicator', 'on');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: `/auditee/submit-instrumen-prodi/${instrumenId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success('Data berhasil disimpan');
                    location.reload();
                } else {
                    toastr.error('Gagal menyimpan data');
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                if (errors) {
                    Object.keys(errors).forEach(key => {
                        toastr.error(errors[key][0]);
                    });
                } else {
                    toastr.error('Terjadi kesalahan saat menyimpan data');
                }
            },
            complete: function() {
                // Restore button state
                submitBtn.attr('data-kt-indicator', 'off');
                submitBtn.prop('disabled', false);
            }
        });
    });

    function showKriteriaContent(kriteriaId) {
        // Hide all instrumen groups
        $('.instrumen-group').hide();

        // Show the selected kriteria's instrumen group
        $(`#instrumen-group-${kriteriaId}`).show();

        // Update wizard steps
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-kriteria-id="${kriteriaId}"]`).addClass('active');
    }
});
</script>
@endpush
