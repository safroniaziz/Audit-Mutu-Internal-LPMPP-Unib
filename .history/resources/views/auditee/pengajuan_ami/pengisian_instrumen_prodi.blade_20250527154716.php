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

                                    <!-- Status Alert -->
                                    <div class="alert alert-info d-flex flex-column flex-sm-row p-5 mb-10">
                                        <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"/>
                                                <path d="M12 10C13.1046 10 14 9.10457 14 8C14 6.89543 13.1046 6 12 6C10.8954 6 10 6.89543 10 8C10 9.10457 10.8954 10 12 10Z" fill="currentColor"/>
                                                <path d="M12 13C9.23858 13 7 15.2386 7 18C7 20.7614 9.23858 23 12 23C14.7614 23 17 20.7614 17 18C17 15.2386 14.7614 13 12 13Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <h4 class="mb-1">{{ $kriteriaData['kriteria']->nama_kriteria }}</h4>
                                            <span>Silakan isi form instrumen di bawah ini</span>
                                        </div>
                                    </div>

                                    @if(count($kriteriaData['instrumens']) > 0)
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
