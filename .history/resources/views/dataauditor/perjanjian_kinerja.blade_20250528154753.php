
@extends('dataauditor/dashboard_template')

@section('styles')
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
    </style>
@endsection
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
                                <!-- Level 1: Satuan Standar -->
                                <div class="tree-level-1">
                                    <div class="tree-node level-1">
                                        <div class="d-flex align-items-center py-3 px-4 border-bottom bg-light">
                                            <i class="fas fa-layer-group text-info me-3"></i>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-bold text-dark">{{ $satuanStandardNama ?? 'Satuan Standar Tidak Ditemukan' }}</h6>
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
                <div class="card-body p-2  ">
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


    <!--end::Main Content Row-->
@endsection
