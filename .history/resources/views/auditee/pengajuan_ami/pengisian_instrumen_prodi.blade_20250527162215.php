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
                <div class="card-body border-top p-9">

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
