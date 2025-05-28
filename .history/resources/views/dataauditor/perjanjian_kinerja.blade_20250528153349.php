@extends('dataauditor/dashboard_template')
@push('styles')
    <style>
        .split-container {
            display: flex;
            gap: 20px;
            min-height: 600px;
        }

        .left-panel {
            flex: 1;
            overflow-y: auto;
            max-height: 80vh;
            padding-right: 15px;
        }

        .right-panel {
            flex: 1;
            min-width: 50%;
        }

        .satuan-standar-section {
            margin-bottom: 30px;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .satuan-standar-title {
            color: #3f4254;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e1e5e9;
        }

        .indikator-kinerja-item {
            background: white;
            border: 1px solid #e1e5e9;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .indikator-kinerja-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 10px;
        }

        .indikator-kinerja-title {
            font-weight: 500;
            color: #181c32;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background-color: #e8f5e8;
            color: #1e7e34;
        }

        .status-pending {
            background-color: #fef3cd;
            color: #856404;
        }

        .info-badge {
            background-color: #e7f3ff;
            color: #0056b3;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
        }

        .instrumen-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .instrumen-item {
            padding: 10px;
            border: 1px solid #e1e5e9;
            border-radius: 4px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }

        .instrumen-item.completed {
            background-color: #f8fff8;
            border-color: #28a745;
        }

        .instrumen-item.pending {
            background-color: #fffbf0;
            border-color: #ffc107;
        }

        .instrumen-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .capaian-info {
            font-size: 12px;
            color: #6c757d;
        }

        .pdf-container {
            height: 80vh;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            overflow: hidden;
        }

        .pdf-embed {
            width: 100%;
            height: 100%;
            border: none;
        }

        .no-pdf-message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
        }
    </style>
@endpush
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
                            // Group IkssAuditee by SatuanStandar -> IndikatorKinerja
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
                                        $firstIkss = $ikssGroup->first();
                                        $indikatorKinerja = $firstIkss->indikatorKinerja;
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

                                        @if($indikatorKinerja)
                                            <div class="indikator-info">
                                                @if($indikatorKinerja->target)
                                                    <span class="info-badge target">
                                                        Target: {{ $indikatorKinerja->target }}
                                                        @if($indikatorKinerja->satuan) {{ $indikatorKinerja->satuan }} @endif
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <!-- List Instrumen untuk Indikator Kinerja ini -->
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
                                                                        @if($indikatorKinerja && $indikatorKinerja->satuan)
                                                                            {{ $indikatorKinerja->satuan }}
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
