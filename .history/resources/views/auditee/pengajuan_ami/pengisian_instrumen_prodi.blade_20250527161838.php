@extends('auditee/dashboard_template')

@php
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
            @php
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

            @if($allKriterias->count() > 0)
                <!-- Progress Status -->
                <div class="card bg-light mb-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <span class="fw-bold text-gray-800 fs-3 flex-grow-1">Progress Pengisian</span>
                            <span class="fw-bold fs-3 text-{{ $isAllCompleted ? 'success' : 'primary' }}">{{ number_format($progressPercentage, 1) }}%</span>
                        </div>
                        <div class="progress h-8px bg-light-{{ $isAllCompleted ? 'success' : 'primary' }}">
                            <div class="progress-bar bg-{{ $isAllCompleted ? 'success' : 'primary' }}" role="progressbar"
                                style="width: {{ $progressPercentage }}%"
                                aria-valuenow="{{ $progressPercentage }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="text-gray-600">{{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen telah diisi</span>
                            @if($isAllCompleted)
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-primary">Dalam Proses</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Wizard Navigation -->
                <div class="wizard-nav mb-5">
                    @foreach($allKriterias as $kriteria)
                        <div class="wizard-step {{ $loop->first ? 'active' : '' }} {{ $kriteria['completed'] ? 'completed' : '' }}"
                             data-kriteria-id="{{ $kriteria['id'] }}">
                            <div class="step-number">{{ $kriteria['kriteria']->kode_kriteria }}</div>
                            <div class="step-label">Kriteria {{ $kriteria['kriteria']->kode_kriteria }}</div>
                            <div class="step-desc">{{ Str::limit($kriteria['kriteria']->nama_kriteria, 50) }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Instrumen Groups -->
                @foreach($allKriterias as $kriteria)
                    <div class="instrumen-group" id="instrumen-group-{{ $kriteria['id'] }}" style="display: none;">
                        <!-- Status Alert -->
                        <div class="alert bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"/>
                                    <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h4 class="mb-1">Kriteria {{ $kriteria['kriteria']->kode_kriteria }}</h4>
                                <span>{{ $kriteria['kriteria']->nama_kriteria }}</span>
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
