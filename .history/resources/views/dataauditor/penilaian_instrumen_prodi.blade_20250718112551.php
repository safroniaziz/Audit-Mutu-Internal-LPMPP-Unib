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

    $completionPercentage = $totalInstrumen > 0 ? round(($completedInstrumen / $totalInstrumen) * 100) : 0;
@endphp

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-2">Penilaian Instrumen Prodi</h2>
            <p class="text-muted mb-0">Auditee: {{ $pengajuan->auditee->nama ?? '-' }}</p>
            <p class="text-muted mb-0">Periode: {{ $pengajuan->periodeAktif->nama ?? '-' }}</p>
        </div>
        <div class="text-end">
            <div class="d-flex align-items-center">
                <span class="text-muted me-3">Progress Penilaian:</span>
                <div class="progress" style="width: 200px;">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{ $completionPercentage }}%"
                         aria-valuenow="{{ $completionPercentage }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        {{ $completionPercentage }}%
                    </div>
                </div>
            </div>
            <small class="text-muted">{{ $completedInstrumen }} dari {{ $totalInstrumen }} instrumen sudah dinilai</small>
        </div>
    </div>

    <!-- Progress Alert -->
    @if($completionPercentage == 100)
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>
                <strong>Selamat!</strong> Semua instrumen prodi telah dinilai.
            </div>
        </div>
    @elseif($completionPercentage > 0)
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Progress:</strong> {{ $completionPercentage }}% instrumen telah dinilai. Lanjutkan untuk menyelesaikan penilaian.
            </div>
        </div>
    @else
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <div>
                <strong>Belum ada penilaian:</strong> Mulai berikan nilai untuk setiap instrumen prodi.
            </div>
        </div>
    @endif

    <!-- Form -->
    <form id="penilaianForm" action="{{ route('auditor.audit.submitPenilaianInstrumenProdi', $pengajuan->id) }}" method="POST">
        @csrf

        <!-- Wizard Navigation -->
        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    @php $tabIndex = 0; @endphp
                    @foreach($groupedData as $indikatorId => $indikatorData)
                        @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                            @php $tabIndex++; @endphp
                            <button type="button" class="btn btn-outline-primary btn-sm tab-button" data-tab="{{ $tabIndex }}">
                                <i class="fas fa-file-alt me-1"></i>
                                {{ $kriteriaData['kriteria']->nama ?? 'Kriteria ' . $tabIndex }}
                            </button>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Content Tabs -->
        @php $tabIndex = 0; @endphp
        @foreach($groupedData as $indikatorId => $indikatorData)
            @foreach($indikatorData['kriterias'] as $kriteriaId => $kriteriaData)
                @php $tabIndex++; @endphp
                <div class="tab-content" id="tab-{{ $tabIndex }}" style="display: {{ $tabIndex == 1 ? 'block' : 'none' }};">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i>
                                {{ $kriteriaData['kriteria']->nama ?? 'Kriteria ' . $tabIndex }}
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(count($kriteriaData['instrumens']) > 0)
                                @foreach($kriteriaData['instrumens'] as $instrumenProdi)
                                    <div class="card mb-4 border">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6 class="fw-bold mb-3">{{ $instrumenProdi->indikator }}</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered border-gray-300">
                                                            <tr>
                                                                <td class="fw-semibold bg-light" style="width: 200px;">Sumber Data/Bukti</td>
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
                                                                                <i class="fas fa-external-link-alt me-2"></i>
                                                                                Lihat URL Sumber
                                                                            </a>
                                                                        </div>
                                                                    @endif
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
                                                <div class="col-md-4">
                                                    <div class="card bg-light">
                                                        <div class="card-header">
                                                            <h6 class="mb-0">Penilaian Auditor</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Nilai (1-4)</label>
                                                                                                                                 <select name="nilai[{{ $instrumenProdi->id }}]" class="form-select" required>
                                                                     <option value="">Pilih nilai</option>
                                                                     <option value="1" {{ ($instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->first() && $instrumenProdi->nilaiAuditorCurrent->first()->nilai == 1) ? 'selected' : '' }}>1 - Sangat Kurang</option>
                                                                     <option value="2" {{ ($instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->first() && $instrumenProdi->nilaiAuditorCurrent->first()->nilai == 2) ? 'selected' : '' }}>2 - Kurang</option>
                                                                     <option value="3" {{ ($instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->first() && $instrumenProdi->nilaiAuditorCurrent->first()->nilai == 3) ? 'selected' : '' }}>3 - Baik</option>
                                                                     <option value="4" {{ ($instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->first() && $instrumenProdi->nilaiAuditorCurrent->first()->nilai == 4) ? 'selected' : '' }}>4 - Sangat Baik</option>
                                                                 </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Catatan (Opsional)</label>
                                                                                                                                 <textarea name="catatan[{{ $instrumenProdi->id }}]" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ $instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->first() ? $instrumenProdi->nilaiAuditorCurrent->first()->catatan : '' }}</textarea>
                                                            </div>
                                                                                                                         <div class="text-center">
                                                                 @if($instrumenProdi->nilaiAuditorCurrent && $instrumenProdi->nilaiAuditorCurrent->count() > 0)
                                                                     <span class="badge bg-success">
                                                                         <i class="fas fa-check me-1"></i> Sudah Dinilai
                                                                     </span>
                                                                 @else
                                                                     <span class="badge bg-warning">
                                                                         <i class="fas fa-clock me-1"></i> Belum Dinilai
                                                                     </span>
                                                                 @endif
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada instrumen prodi untuk kriteria ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

        <!-- Submit Button -->
        <div class="card mt-5">
            <div class="card-body text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>
                    Simpan Penilaian
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab navigation
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabIndex = this.getAttribute('data-tab');

            // Hide all tab contents
            tabContents.forEach(content => {
                content.style.display = 'none';
            });

            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });

            // Show selected tab content
            document.getElementById('tab-' + tabIndex).style.display = 'block';

            // Add active class to clicked button
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
        });
    });

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
});
</script>
@endsection
