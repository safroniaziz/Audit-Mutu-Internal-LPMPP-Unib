@extends('auditee/dashboard_template')

@php
    // Calculate completion status
    $totalInstrumen = $indikatorInstrumens->count();
    $completedInstrumen = $indikatorInstrumens->filter(function($instrumen) {
        return $instrumen->submission !== null;
    })->count();
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

            // Skip if kriteria doesn't have indstrumenProdi relation
            if (!$kriteria->indstrumenProdi) {
                continue;
            }

            foreach ($kriteria->indstrumenProdi as $instrumenProdi) {
                if (!$instrumenProdi) continue;
                $groupedData[$indikatorId]['kriterias'][$kriteriaId]['instrumens'][] = $instrumenProdi;
            }
        }
    }
@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengisian Instrumen Prodi</h3>
                </div>
                <div class="card-body">
                    <!-- Progress Bar -->
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                            aria-valuenow="{{ $progressPercentage }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ number_format($progressPercentage, 1) }}%
                        </div>
                    </div>

                    @if(count($groupedData) > 0)
                        <!-- Wizard Navigation -->
                        <div class="row mb-3">
                            <div class="col">
                                <div class="btn-group w-100" role="group">
                                    @foreach($groupedData as $indikatorId => $indikatorData)
                                        <button type="button"
                                                class="btn btn-outline-primary indikator-btn"
                                                data-indikator-id="{{ $indikatorId }}">
                                            {{ $indikatorData['indikator']->nama_indikator }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Kriteria Navigation -->
                        @foreach($groupedData as $indikatorId => $indikatorData)
                            <div class="row mb-3 kriteria-group" id="kriteria-group-{{ $indikatorId }}" style="display: none;">
                                <div class="col">
                                    <div class="btn-group w-100" role="group">
                                        @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                                            <button type="button"
                                                    class="btn btn-outline-secondary kriteria-btn"
                                                    data-indikator-id="{{ $indikatorId }}"
                                                    data-kriteria-id="{{ $kriteriaId }}">
                                                {{ $kriteriaData['kriteria']->kode_kriteria }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Instrumen Forms -->
                            @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                                <div class="instrumen-group"
                                     id="instrumen-group-{{ $indikatorId }}-{{ $kriteriaId }}"
                                     style="display: none;">
                                    <h4>{{ $kriteriaData['kriteria']->nama_kriteria }}</h4>

                                    @if(count($kriteriaData['instrumens']) > 0)
                                        @foreach($kriteriaData['instrumens'] as $instrumenProdi)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <form class="instrumen-form" data-instrumen-id="{{ $instrumenProdi->id }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Elemen:</label>
                                                            <p>{{ $instrumenProdi->elemen }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Indikator:</label>
                                                            <p>{{ $instrumenProdi->indikator }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai">Nilai:</label>
                                                            <input type="number" class="form-control" name="nilai" min="0" max="100" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="deskripsi">Deskripsi:</label>
                                                            <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="dokumen">Dokumen Pendukung:</label>
                                                            <input type="file" class="form-control" name="dokumen[]" multiple>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">
                                            Tidak ada instrumen untuk kriteria ini.
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Tidak ada instrumen yang tersedia.
                        </div>
                    @endif

                    @if($isAllCompleted)
                        <div class="alert alert-success">
                            Semua instrumen telah diisi!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Show first indikator's content by default
    const firstIndikatorId = $('.indikator-btn').first().data('indikator-id');
    if (firstIndikatorId) {
        showIndikatorContent(firstIndikatorId);
    }

    // Indikator button click handler
    $('.indikator-btn').click(function() {
        const indikatorId = $(this).data('indikator-id');
        showIndikatorContent(indikatorId);
    });

    // Kriteria button click handler
    $('.kriteria-btn').click(function() {
        const indikatorId = $(this).data('indikator-id');
        const kriteriaId = $(this).data('kriteria-id');
        showKriteriaContent(indikatorId, kriteriaId);
    });

    // Form submission handler
    $('.instrumen-form').on('submit', function(e) {
        e.preventDefault();

        const instrumenId = $(this).data('instrumen-id');
        const formData = new FormData(this);

        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="bi bi-arrow-repeat spinner"></i> Menyimpan...').prop('disabled', true);

        $.ajax({
            url: `/auditee/submit-instrumen-prodi/${instrumenId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success('Data berhasil disimpan');
                    // You might want to update the progress bar here
                } else {
                    toastr.error('Gagal menyimpan data');
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(key => {
                    toastr.error(errors[key][0]);
                });
            },
            complete: function() {
                // Restore button state
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });

    function showIndikatorContent(indikatorId) {
        // Hide all kriteria groups and instrumen groups
        $('.kriteria-group, .instrumen-group').hide();

        // Show the selected indikator's kriteria group
        $(`#kriteria-group-${indikatorId}`).show();

        // Highlight the selected indikator button
        $('.indikator-btn').removeClass('active');
        $(`.indikator-btn[data-indikator-id="${indikatorId}"]`).addClass('active');

        // Show the first kriteria's content
        const firstKriteriaBtn = $(`#kriteria-group-${indikatorId} .kriteria-btn`).first();
        if (firstKriteriaBtn.length) {
            const kriteriaId = firstKriteriaBtn.data('kriteria-id');
            showKriteriaContent(indikatorId, kriteriaId);
        }
    }

    function showKriteriaContent(indikatorId, kriteriaId) {
        // Hide all instrumen groups
        $('.instrumen-group').hide();

        // Show the selected kriteria's instrumen group
        $(`#instrumen-group-${indikatorId}-${kriteriaId}`).show();

        // Highlight the selected kriteria button
        $('.kriteria-btn').removeClass('active');
        $(`.kriteria-btn[data-indikator-id="${indikatorId}"][data-kriteria-id="${kriteriaId}"]`).addClass('active');
    }
});
</script>
@endpush
