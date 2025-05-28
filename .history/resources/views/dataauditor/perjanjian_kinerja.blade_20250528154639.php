@extends('dataauditor/dashboard_template')
@push('styles')
    <style>

    </style>
@endpush
@section('dashboardProfile')
    <!--begin::Welcome Card-->
    <div class="card mb-5" id="kt_profile_welcome">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Instrumen Audit Card-->
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title m-0">
                <h4 class="fw-semibold m-0 d-flex align-items-center gap-2">
                    <i class="fas fa-list-check"></i>
                    Daftar Instrumen Audit
                </h4>
            </div>
        </div>
        <div class="card-body">
            @if($auditess && $auditess->ikssAuditee)
                @php
                    // Group by SatuanStandar -> IndikatorKinerja
                    $groupedData = $auditess->ikssAuditee
                        ->filter(function($ikss) {
                            // Filter hanya yang punya relasi lengkap
                            return $ikss->instrumen &&
                                   $ikss->instrumen->indikatorKinerja &&
                                   $ikss->instrumen->indikatorKinerja->satuanStandar;
                        })
                        ->groupBy('instrumen.indikatorKinerja.satuanStandar.sasaran')
                        ->map(function($satuanGroup) {
                            return $satuanGroup->groupBy('instrumen.indikatorKinerja.tujuan');
                        });
                @endphp

                @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                    <!-- Satuan Standar Header -->
                    <div class="satuan-standar-section mb-4">
                        <h5 class="satuan-standar-title">
                            <i class="fas fa-layer-group"></i>
                            {{ $satuanStandardNama ?? 'Satuan Standar Tidak Ditemukan' }}
                        </h5>

                        @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                            @php
                                // Status 1 = completed, 0 = pending
                                $completedCount = $ikssGroup->where('status', 1)->count();
                                $totalCount = $ikssGroup->count();
                                $isAllCompleted = $completedCount === $totalCount;
                                $firstIkss = $ikssGroup->first();
                                $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                $satuanStandar = $indikatorKinerja->satuanStandar;
                            @endphp

                            <!-- Indikator Kinerja Card -->
                            <div class="indikator-kinerja-item mb-3">
                                <div class="indikator-kinerja-header">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-chart-line text-primary"></i>
                                        <div class="indikator-kinerja-title">
                                            <strong>{{ $indikatorKinerja->kode_ikss }}</strong> - {{ $indikatorKinerjaNama }}
                                        </div>
                                    </div>
                                    <span class="status-badge {{ $isAllCompleted ? 'status-completed' : 'status-pending' }}">
                                        <i class="fas {{ $isAllCompleted ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                        {{ $isAllCompleted ? 'Completed' : 'In Progress' }}
                                        <small class="ms-1">({{ $completedCount }}/{{ $totalCount }})</small>
                                    </span>
                                </div>

                                <div class="indikator-info mb-3">
                                    <span class="info-badge satuan-standar">
                                        <i class="fas fa-layer-group"></i>
                                        {{ $satuanStandar->kode_satuan }} - {{ $satuanStandar->sasaran }}
                                    </span>
                                </div>

                                <!-- List Instrumen -->
                                <div class="instrumen-list">
                                    @foreach($ikssGroup as $ikss)
                                        @if($ikss->instrumen)
                                            <div class="instrumen-item {{ $ikss->status == 1 ? 'completed' : 'pending' }} mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="instrumen-info flex-grow-1">
                                                        <div class="instrumen-name">
                                                            <i class="fas fa-file-alt"></i>
                                                            <strong>{{ $ikss->instrumen->indikator }}</strong>
                                                        </div>
                                                        <div class="instrumen-details mt-1">
                                                            <small class="text-muted">{{ $ikss->instrumen->pertanyaan }}</small>
                                                        </div>
                                                        <div class="instrumen-target mt-1">
                                                            <span class="badge badge-light">
                                                                Target: {{ $ikss->instrumen->target }} {{ $ikss->instrumen->satuan }}
                                                            </span>
                                                        </div>
                                                        @if($ikss->realisasi)
                                                            <div class="capaian-info mt-1">
                                                                <span class="badge badge-success">
                                                                    Realisasi: {{ $ikss->realisasi }} {{ $ikss->instrumen->satuan }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="status-icon ms-3">
                                                        <i class="fas {{ $ikss->status == 1 ? 'fa-check-circle text-success' : 'fa-clock text-warning' }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Tidak ada data instrumen yang ditemukan.
                </div>
            @endif
        </div>
    </div>

    <!--begin::PDF Viewer Card-->
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title m-0">
                <h4 class="fw-semibold m-0 d-flex align-items-center gap-2">
                    <i class="fas fa-file-pdf"></i>
                    Dokumen Perjanjian Kinerja
                </h4>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="pdf-container" style="height: 600px;">
                @if($auditess && $auditess->perjanjianKinerja && $auditess->perjanjianKinerja->file_path)
                    <iframe src="{{ asset('storage/' . $auditess->perjanjianKinerja->file_path) }}"
                            style="width: 100%; height: 100%; border: none;"
                            title="Perjanjian Kinerja PDF">
                    </iframe>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                        <i class="fas fa-file-pdf fa-4x mb-3" style="color: #dc3545;"></i>
                        <p class="mb-2">File PDF Perjanjian Kinerja belum tersedia</p>
                        <small class="text-muted">Silakan upload file PDF terlebih dahulu</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--end::details View-->
@endsection
