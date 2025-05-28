@extends('dataauditor/dashboard_template')
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
                </div>
        </div>
        <div class="card-body border-top p-4">
            <div class="split-container">
                <!-- Left Panel - List Instrumen -->
                <div class="left-panel">
                    <h4 class="section-title">
                        <i class="fas fa-list-check"></i>
                        Daftar Instrumen Audit
                    </h4>

                    @if($auditess && $auditess->ikssAuditee)
                        @php
                            // Group by SatuanStandar -> IndikatorKinerja -> Instrumen
                            $groupedData = $auditess->ikssAuditee
                                ->groupBy('indikatorKinerja.satuanStandar.nama')
                                ->map(function($satuanGroup) {
                                    return $satuanGroup->groupBy('indikatorKinerja.nama');
                                });
                        @endphp

                        @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                            <!-- Satuan Standar Header -->
                            <div class="satuan-standar-section">
                                <h5 class="satuan-standar-title">
                                    <i class="fas fa-layer-group"></i>
                                    {{ $satuanStandardNama ?? 'Satuan Standar Tidak Ditemukan' }}
                                </h5>

                                @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                    @php
                                        $completedCount = $ikssGroup->where('is_completed', true)->count();
                                        $totalCount = $ikssGroup->count();
                                        $isAllCompleted = $completedCount === $totalCount;
                                        $firstIndikator = $ikssGroup->first()->indikatorKinerja;
                                    @endphp

                                    <!-- Indikator Kinerja Card -->
                                    <div class="indikator-kinerja-item">
                                        <div class="indikator-kinerja-header">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-chart-line text-primary"></i>
                                                <div class="indikator-kinerja-title">{{ $indikatorKinerjaNama }}</div>
                                            </div>
                                            <span class="status-badge {{ $isAllCompleted ? 'status-completed' : 'status-pending' }}">
                                                <i class="fas {{ $isAllCompleted ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                                {{ $isAllCompleted ? 'Completed' : 'In Progress' }}
                                                <small class="ms-1">({{ $completedCount }}/{{ $totalCount }})</small>
                                            </span>
                                        </div>

                                        @if($firstIndikator)
                                            <div class="indikator-info">
                                                @if($firstIndikator->target)
                                                    <span class="info-badge target">
                                                        Target: {{ $firstIndikator->target }}
                                                        @if($firstIndikator->satuan) {{ $firstIndikator->satuan }} @endif
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <!-- List Instrumen -->
                                        <div class="instrumen-list">
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <div class="instrumen-item {{ $ikss->is_completed ? 'completed' : 'pending' }}">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="instrumen-info">
                                                                <div class="instrumen-name">
                                                                    <i class="fas fa-file-alt"></i>
                                                                    {{ $ikss->instrumen->nama }}
                                                                </div>
                                                                @if($ikss->capaian)
                                                                    <div class="capaian-info">
                                                                        Capaian: {{ $ikss->capaian }}
                                                                        @if($firstIndikator && $firstIndikator->satuan)
                                                                            {{ $firstIndikator->satuan }}
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="status-icon">
                                                                <i class="fas {{ $ikss->is_completed ? 'fa-check-circle text-success' : 'fa-clock text-warning' }}"></i>
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

                <!-- Right Panel - PDF Viewer -->
                <div class="right-panel">
                    <h4 class="section-title">
                        <i class="fas fa-file-pdf"></i>
                        Dokumen Perjanjian Kinerja
                    </h4>

                    <div class="pdf-container">
                        @if($auditess && $auditess->perjanjianKinerja && $auditess->perjanjianKinerja->file_path)
                            <iframe src="{{ asset('storage/' . $auditess->perjanjianKinerja->file_path) }}"
                                    class="pdf-embed"
                                    title="Perjanjian Kinerja PDF">
                            </iframe>
                        @else
                            <div class="no-pdf-message">
                                <i class="fas fa-file-pdf fa-4x mb-3" style="color: #dc3545;"></i>
                                <p>File PDF Perjanjian Kinerja belum tersedia</p>
                                <small class="text-muted">Silakan upload file PDF terlebih dahulu</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::details View-->
@endsection
