@extends('dataauditor/dashboard_template')
@push('styles')
    <style>
        .tree-container {
        background: #fff;
    }

    .tree-level-1 {
        border-left: 3px solid #3f51b5;
    }

    .tree-level-2 {
        border-left: 2px solid #e0e0e0;
        margin-left: 15px;
    }

    .tree-level-3 {
        border-left: 1px solid #f0f0f0;
        margin-left: 30px;
    }

    .tree-connector {
        width: 20px;
        text-align: center;
    }

    .tree-connector-child {
        width: 16px;
        text-align: center;
    }

    .tree-node.level-3.completed {
        background-color: #f8fdf8;
    }

    .tree-node.level-3.pending {
        background-color: #fffef8;
    }

    .tree-node:hover {
        background-color: #f8f9fa;
    }

    .badge-light-info {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .badge-light-success {
        background-color: #e8f5e8;
        color: #2e7d32;
    }

    .badge-light-warning {
        background-color: #fff3e0;
        color: #f57c00;
    }

    .badge-light-primary {
        background-color: #e3f2fd;
        color: #1976d2;
    }

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
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    display: inline-block;
    margin-bottom: 5px;
}

.info-badge.satuan-standar {
    background-color: #f0f9ff;
    color: #1e40af;
    border: 1px solid #93c5fd;
}

.instrumen-details {
    color: #6c757d;
    font-size: 13px;
    line-height: 1.4;
}

.instrumen-target {
    margin-top: 8px;
}

.badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.badge-light {
    background-color: #f8f9fa;
    color: #495057;
    border: 1px solid #dee2e6;
}

.badge-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
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

    <!--begin::Main Content Row-->
    <div class="row g-5">
        <!-- Left Column - Instrumen Audit -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h4 class="fw-semibold m-0 d-flex align-items-center gap-2">
                            <i class="fas fa-list-check text-primary"></i>
                            Daftar Instrumen Audit
                        </h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($auditess && $auditess->ikssAuditee)
                        @php
                            // Group by SatuanStandar -> IndikatorKinerja
                            $groupedData = $auditess->ikssAuditee
                                ->filter(function($ikss) {
                                    return $ikss->instrumen &&
                                           $ikss->instrumen->indikatorKinerja &&
                                           $ikss->instrumen->indikatorKinerja->satuanStandar;
                                })
                                ->groupBy('instrumen.indikatorKinerja.satuanStandar.sasaran')
                                ->map(function($satuanGroup) {
                                    return $satuanGroup->groupBy('instrumen.indikatorKinerja.tujuan');
                                });
                        @endphp

                        <div class="tree-container">
                            @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                                <!-- Level 1: Sasaran Strategis -->
                                <div class="tree-level-1">
                                    <div class="tree-node level-1">
                                        <div class="d-flex align-items-center py-3 px-4 border-bottom bg-light">
                                            <i class="fas fa-layer-group text-info me-3"></i>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-bold text-dark">{{ $satuanStandardNama ?? 'Sasaran Strategis Tidak Ditemukan' }}</h6>
                                            </div>
                                            <span class="badge badge-light-info">{{ $indikatorGroups->count() }} Indikator</span>
                                        </div>
                                    </div>

                                    @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                        @php
                                            $completedCount = $ikssGroup->where('status', 1)->count();
                                            $totalCount = $ikssGroup->count();
                                            $isAllCompleted = $completedCount === $totalCount;
                                            $firstIkss = $ikssGroup->first();
                                            $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                            $satuanStandar = $indikatorKinerja->satuanStandar;
                                        @endphp

                                        <!-- Level 2: Indikator Kinerja -->
                                        <div class="tree-level-2">
                                            <div class="tree-node level-2">
                                                <div class="d-flex align-items-center py-2 px-4 border-bottom">
                                                    <div class="tree-connector me-3">
                                                        <i class="fas fa-chart-line text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <span class="fw-semibold text-dark">{{ $indikatorKinerja->kode_ikss }}</span>
                                                                <span class="text-muted ms-2">{{ $indikatorKinerjaNama }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <span class="badge {{ $isAllCompleted ? 'badge-light-success' : 'badge-light-warning' }}">
                                                                    {{ $completedCount }}/{{ $totalCount }}
                                                                </span>
                                                                <i class="fas {{ $isAllCompleted ? 'fa-check-circle text-success' : 'fa-clock text-warning' }} fs-6"></i>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted d-block mt-1">
                                                            <i class="fas fa-tag me-1"></i>{{ $satuanStandar->kode_satuan }} - {{ $satuanStandar->sasaran }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Level 3: Instrumen Items -->
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <div class="tree-level-3">
                                                        <div class="tree-node level-3 {{ $ikss->status == 1 ? 'completed' : 'pending' }}">
                                                            <div class="d-flex align-items-start py-2 px-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                                <div class="tree-connector-child me-3 mt-1">
                                                                    <i class="fas fa-file-alt text-secondary fs-7"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex justify-content-between align-items-start">
                                                                        <div class="flex-grow-1 me-3">
                                                                            <div class="fw-semibold text-dark mb-1">{{ $ikss->instrumen->indikator }}</div>
                                                                            <div class="text-muted small mb-2">{{ $ikss->instrumen->pertanyaan }}</div>
                                                                            <div class="d-flex gap-2 flex-wrap">
                                                                                <span class="badge badge-light-primary">
                                                                                    Target: {{ $ikss->instrumen->target }} {{ $ikss->instrumen->satuan }}
                                                                                </span>
                                                                                @if($ikss->realisasi)
                                                                                    <span class="badge badge-light-success">
                                                                                        Realisasi: {{ $ikss->realisasi }} {{ $ikss->instrumen->satuan }}
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <i class="fas {{ $ikss->status == 1 ? 'fa-check-circle text-success' : 'fa-clock text-warning' }} fs-5"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4">
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Tidak ada data instrumen yang ditemukan.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - PDF Viewer -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h4 class="fw-semibold m-0 d-flex align-items-center gap-2">
                            <i class="fas fa-file-pdf text-danger"></i>
                            Dokumen Perjanjian Kinerja
                        </h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="pdf-container" style="height: 700px; min-height: 700px;">
                        @if($auditess && $auditess->perjanjianKinerja && $auditess->perjanjianKinerja->file_path)
                            <iframe src="{{ asset('storage/' . $auditess->perjanjianKinerja->file_path) }}"
                                    style="width: 100%; height: 100%; border: none; display: block;"
                                    title="Perjanjian Kinerja PDF">
                            </iframe>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                <i class="fas fa-file-pdf text-danger mb-4" style="font-size: 4rem;"></i>
                                <h5 class="text-muted mb-2">File PDF Belum Tersedia</h5>
                                <p class="text-muted text-center mb-0">Silakan upload dokumen Perjanjian Kinerja terlebih dahulu</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
