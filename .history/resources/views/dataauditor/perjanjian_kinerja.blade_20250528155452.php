@extends('dataauditor/dashboard_template')

@section('styles')
    <style>
        .tree-container {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        /* Level 1 - Sasaran Strategis */
        .tree-node-1 {
            padding: 16px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .tree-node-1:hover {
            background: #f1f5f9;
        }

        .tree-node-1:last-child {
            border-bottom: none;
        }

        /* Level 2 - Indikator Kinerja */
        .tree-node-2 {
            padding: 12px 20px 12px 40px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .tree-node-2:hover {
            background: #f8fafc;
        }

        /* Level 3 - Instrumen */
        .tree-node-3 {
            padding: 10px 20px 10px 60px;
            border-bottom: 1px solid #f8fafc;
            font-size: 14px;
        }

        .tree-node-3:last-child {
            border-bottom: none;
        }

        /* Collapsible content */
        .tree-children {
            display: none;
        }

        .tree-children.show {
            display: block;
        }

        /* Icons */
        .tree-icon {
            width: 16px;
            text-align: center;
            margin-right: 8px;
        }

        .expand-icon {
            transition: transform 0.2s;
        }

        .expand-icon.rotated {
            transform: rotate(90deg);
        }

        /* Status indicators */
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .status-completed {
            background-color: #10b981;
        }

        .status-pending {
            background-color: #f59e0b;
        }

        /* Progress text */
        .progress-text {
            font-size: 12px;
            color: #6b7280;
            margin-left: auto;
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
        <!-- Left Column - Tree List Instrumen -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h4 class="fw-semibold m-0 d-flex align-items-center gap-2">
                            <i class="fas fa-list text-primary"></i>
                            Daftar Instrumen Audit
                        </h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($auditess && $auditess->ikssAuditee)
                        @php
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
                                <div class="tree-node-1" onclick="toggleNode(this)">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-chevron-right expand-icon tree-icon"></i>
                                        <i class="fas fa-layer-group text-primary tree-icon"></i>
                                        <span class="fw-semibold">{{ $satuanStandardNama ?? 'Sasaran Strategis Tidak Ditemukan' }}</span>
                                        <span class="progress-text">({{ $indikatorGroups->count() }} indikator)</span>
                                    </div>
                                </div>

                                <!-- Level 2: Indikator Kinerja -->
                                <div class="tree-children">
                                    @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                        @php
                                            $completedCount = $ikssGroup->where('status', 1)->count();
                                            $totalCount = $ikssGroup->count();
                                            $firstIkss = $ikssGroup->first();
                                            $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                        @endphp

                                        <div class="tree-node-2" onclick="toggleNode(this)">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-chevron-right expand-icon tree-icon"></i>
                                                <i class="fas fa-chart-line text-info tree-icon"></i>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium">{{ $indikatorKinerja->kode_ikss }}</span>
                                                    <div class="text-muted small">{{ $indikatorKinerjaNama }}</div>
                                                </div>
                                                <span class="progress-text">{{ $completedCount }}/{{ $totalCount }}</span>
                                            </div>
                                        </div>

                                        <!-- Level 3: Instrumen -->
                                        <div class="tree-children">
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <div class="tree-node-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="status-dot {{ $ikss->status == 1 ? 'status-completed' : 'status-pending' }}"></span>
                                                            <i class="fas fa-file-alt text-secondary tree-icon"></i>
                                                            <span>{{ $ikss->instrumen->indikator }}</span>
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
                        <div class="p-4 text-center">
                            <div class="text-muted">
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

    <script>
        function toggleNode(element) {
            const children = element.nextElementSibling;
            const icon = element.querySelector('.expand-icon');

            if (children && children.classList.contains('tree-children')) {
                children.classList.toggle('show');
                icon.classList.toggle('rotated');
            }
        }
    </script>
@endsection
