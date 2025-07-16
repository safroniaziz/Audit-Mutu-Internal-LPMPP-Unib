@extends('dataauditor/dashboard_template')

@section('styles')
    <style>
        .audit-table {
            margin: 0;
        }

        .audit-table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 12px 15px;
            font-weight: 600;
        }

        .audit-table td {
            padding: 10px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }

        .level-1 {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .level-2 {
            background-color: #fcfcfc;
            padding-left: 30px !important;
        }

        .level-3 {
            padding-left: 50px !important;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .expand-btn {
            background: none;
            border: none;
            padding: 2px 6px;
            cursor: pointer;
            color: #6c757d;
        }

        .expand-btn:hover {
            color: #495057;
        }

        .expandable-row {
            display: none;
        }

        .expandable-row.show {
            display: table-row;
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
        <!-- Left Column - Table Instrumen -->
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

                        <div class="table-responsive">
                            <table class="table table-hover audit-table">
                                <thead>
                                    <tr>
                                        <th width="50"></th>
                                        <th>Nama</th>
                                        <th width="100" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                                        <!-- Level 1: Sasaran Strategis -->
                                        <tr class="level-1">
                                            <td>
                                                <button class="expand-btn" onclick="toggleRows('satuan-{{ $loop->index }}')">
                                                    <i class="fas fa-chevron-right" id="icon-satuan-{{ $loop->index }}"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <i class="fas fa-layer-group text-primary me-2"></i>
                                                {{ $satuanStandardNama ?? 'Sasaran Strategis Tidak Ditemukan' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="text-muted small">{{ $indikatorGroups->count() }} indikator</span>
                                            </td>
                                        </tr>

                                        @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                            @php
                                                $completedCount = $ikssGroup->where('status', 1)->count();
                                                $totalCount = $ikssGroup->count();
                                                $firstIkss = $ikssGroup->first();
                                                $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                            @endphp

                                            <!-- Level 2: Indikator Kinerja -->
                                            <tr class="level-2 expandable-row satuan-{{ $loop->parent->index }}">
                                                <td>
                                                    <button class="expand-btn" onclick="toggleRows('indikator-{{ $loop->parent->index }}-{{ $loop->index }}')">
                                                        <i class="fas fa-chevron-right" id="icon-indikator-{{ $loop->parent->index }}-{{ $loop->index }}"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <i class="fas fa-chart-line text-info me-2"></i>
                                                    <strong>{{ $indikatorKinerja->kode_ikss }}</strong><br>
                                                    <small class="text-muted">{{ $indikatorKinerjaNama }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted small">{{ $completedCount }}/{{ $totalCount }}</span>
                                                </td>
                                            </tr>

                                            <!-- Level 3: Instrumen -->
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <tr class="level-3 expandable-row indikator-{{ $loop->parent->parent->index }}-{{ $loop->parent->index }}">
                                                        <td></td>
                                                        <td>
                                                            <i class="fas fa-file-alt text-secondary me-2"></i>
                                                            {{ $ikss->instrumen->indikator }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="status-badge {{ $ikss->status == 1 ? 'status-completed' : 'status-pending' }}">
                                                                {{ $ikss->status == 1 ? 'Selesai' : 'Pending' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
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
        function toggleRows(className) {
            const rows = document.querySelectorAll('.' + className);
            const icon = document.getElementById('icon-' + className);

            let isExpanded = false;
            rows.forEach(row => {
                if (row.classList.contains('show')) {
                    row.classList.remove('show');
                } else {
                    row.classList.add('show');
                    isExpanded = true;
                }
            });

            if (isExpanded) {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            } else {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        }
    </script>
@endsection
