@extends('dataauditor/dashboard_template')

@section('styles')
    <style>
        /* Modern Card Styling */
        .audit-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            border: 1px solid #e8ecef;
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }

        .audit-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            transform: translateY(-2px);
        }

        /* Collapsible Header */
        .audit-header {
            padding: 20px;
            cursor: pointer;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            position: relative;
            overflow: hidden;
        }

        .audit-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: rgba(255,255,255,0.1);
            transform: skewX(-15deg);
            margin-right: -50px;
        }

        .audit-header:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .audit-body {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
        }

        .audit-body.show {
            max-height: 1000px;
            transition: max-height 0.4s ease-in;
        }

        /* Progress Indicators */
        .progress-ring {
            width: 50px;
            height: 50px;
            transform: rotate(-90deg);
        }

        .progress-ring circle {
            fill: transparent;
            stroke-width: 4;
            stroke-dasharray: 125.6; /* 2 * π * 20 */
            stroke-dashoffset: 125.6;
            transition: stroke-dashoffset 0.5s ease;
        }

        .progress-bg {
            stroke: rgba(255,255,255,0.3);
        }

        .progress-bar {
            stroke: #10b981;
        }

        /* Indicator Items */
        .indicator-item {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .indicator-item:hover {
            background: #f8fafc;
        }

        .indicator-item:last-child {
            border-bottom: none;
        }

        /* Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-in-progress {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Instrument Details */
        .instrument-detail {
            background: #f8fafc;
            padding: 16px;
            margin: 8px 20px 16px 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            display: none;
        }

        .instrument-detail.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(45deg);
            transition: all 0.3s ease;
        }

        .stats-card:hover::before {
            right: -40%;
        }

        /* Interactive Elements */
        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .toggle-btn.rotated {
            transform: rotate(180deg);
        }

        /* Search and Filter */
        .search-filter-bar {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .audit-header {
                padding: 16px;
            }

            .indicator-item {
                padding: 12px 16px;
            }

            .progress-ring {
                width: 40px;
                height: 40px;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .slide-up {
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('dashboardProfile')
    <!--begin::Welcome Card-->
    <div class="card mb-5 fade-in" id="kt_profile_welcome">
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
        <!-- Left Column - Modern Instrumen Audit -->
        <div class="col-xl-6">
            <!-- Stats Overview -->
            <div class="stats-card slide-up">
                <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
                    <div>
                        <h5 class="mb-1">Total Instrumen</h5>
                        <h3 class="mb-0 fw-bold">
                            @if($auditess && $auditess->ikssAuditee)
                                {{ $auditess->ikssAuditee->count() }}
                            @else
                                0
                            @endif
                        </h3>
                    </div>
                    <div class="text-end">
                        @php
                            $totalInstruments = $auditess && $auditess->ikssAuditee ? $auditess->ikssAuditee->count() : 0;
                            $completedInstruments = $auditess && $auditess->ikssAuditee ? $auditess->ikssAuditee->where('status', 1)->count() : 0;
                            $completionRate = $totalInstruments > 0 ? ($completedInstruments / $totalInstruments) * 100 : 0;
                        @endphp
                        <div class="fw-bold mb-1">{{ number_format($completionRate, 1) }}% Selesai</div>
                        <div class="small opacity-75">{{ $completedInstruments }}/{{ $totalInstruments }} Instrumen</div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="search-filter-bar slide-up" style="animation-delay: 0.1s;">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 bg-light"
                                   placeholder="Cari instrumen audit..." id="searchInstrument">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select bg-light" id="filterStatus">
                            <option value="">Semua Status</option>
                            <option value="completed">Selesai</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modern Audit Instruments -->
            <div class="audit-instruments-container">
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

                    @foreach($groupedData as $satuanStandardNama => $indikatorGroups)
                        <div class="audit-card slide-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                            <!-- Collapsible Header -->
                            <div class="audit-header" onclick="toggleAuditSection(this)">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-layer-group me-3 fs-4"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $satuanStandardNama ?? 'Satuan Standar Tidak Ditemukan' }}</h6>
                                            <small class="opacity-75">{{ $indikatorGroups->count() }} Indikator Kinerja</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        @php
                                            $totalItems = $indikatorGroups->flatten()->count();
                                            $completedItems = $indikatorGroups->flatten()->where('status', 1)->count();
                                            $progress = $totalItems > 0 ? ($completedItems / $totalItems) * 100 : 0;
                                        @endphp
                                        <!-- Progress Ring -->
                                        <svg class="progress-ring" viewBox="0 0 44 44">
                                            <circle class="progress-bg" cx="22" cy="22" r="20"></circle>
                                            <circle class="progress-bar" cx="22" cy="22" r="20"
                                                    style="stroke-dashoffset: {{ 125.6 - ($progress * 125.6 / 100) }}"></circle>
                                            <text x="22" y="26" text-anchor="middle" fill="white" font-size="10" font-weight="bold">
                                                {{ number_format($progress, 0) }}%
                                            </text>
                                        </svg>
                                        <button class="toggle-btn">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Collapsible Body -->
                            <div class="audit-body">
                                @foreach($indikatorGroups as $indikatorKinerjaNama => $ikssGroup)
                                    @php
                                        $completedCount = $ikssGroup->where('status', 1)->count();
                                        $totalCount = $ikssGroup->count();
                                        $isAllCompleted = $completedCount === $totalCount;
                                        $firstIkss = $ikssGroup->first();
                                        $indikatorKinerja = $firstIkss->instrumen->indikatorKinerja;
                                    @endphp

                                    <div class="indicator-item" onclick="toggleInstrumentDetail(this)">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    <i class="fas fa-chart-line text-primary"></i>
                                                    <div>
                                                        <span class="fw-semibold text-dark">{{ $indikatorKinerja->kode_ikss }}</span>
                                                        <div class="text-muted small">{{ $indikatorKinerjaNama }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="status-badge {{ $isAllCompleted ? 'status-completed' : 'status-pending' }}">
                                                    {{ $completedCount }}/{{ $totalCount }}
                                                </span>
                                                <i class="fas fa-chevron-right text-muted"></i>
                                            </div>
                                        </div>

                                        <!-- Instrument Details (Hidden by default) -->
                                        <div class="instrument-detail">
                                            @foreach($ikssGroup as $ikss)
                                                @if($ikss->instrumen)
                                                    <div class="mb-3 p-3 bg-white rounded border {{ $ikss->status == 1 ? 'border-success' : 'border-warning' }}">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 text-dark">{{ $ikss->instrumen->indikator }}</h6>
                                                                <p class="text-muted small mb-2">{{ $ikss->instrumen->pertanyaan }}</p>
                                                                <div class="d-flex gap-2 flex-wrap">
                                                                    <span class="badge bg-primary">
                                                                        Target: {{ $ikss->instrumen->target }} {{ $ikss->instrumen->satuan }}
                                                                    </span>
                                                                    @if($ikss->realisasi)
                                                                        <span class="badge bg-success">
                                                                            Realisasi: {{ $ikss->realisasi }} {{ $ikss->instrumen->satuan }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <i class="fas {{ $ikss->status == 1 ? 'fa-check-circle text-success' : 'fa-clock text-warning' }} fs-4"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="audit-card text-center py-5">
                        <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mb-2">Tidak Ada Data Instrumen</h5>
                        <p class="text-muted">Belum ada instrumen audit yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - PDF Viewer (Enhanced) -->
        <div class="col-xl-6">
            <div class="card slide-up" style="animation-delay: 0.3s;">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="card-title m-0">
                        <h4 class="fw-semibold m-0 d-flex align-items-center gap-2 text-white">
                            <i class="fas fa-file-pdf"></i>
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
                                <i class="fas fa-file-pdf text-primary mb-4" style="font-size: 4rem;"></i>
                                <h5 class="text-muted mb-2">File PDF Belum Tersedia</h5>
                                <p class="text-muted text-center mb-4">Silakan upload dokumen Perjanjian Kinerja terlebih dahulu</p>
                                <button class="btn btn-primary">
                                    <i class="fas fa-upload me-2"></i>Upload Dokumen
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle audit section collapse
        function toggleAuditSection(header) {
            const body = header.nextElementSibling;
            const toggleBtn = header.querySelector('.toggle-btn');

            body.classList.toggle('show');
            toggleBtn.classList.toggle('rotated');
        }

        // Toggle instrument detail view
        function toggleInstrumentDetail(item) {
            const detail = item.querySelector('.instrument-detail');
            const icon = item.querySelector('.fa-chevron-right');

            if (detail) {
                detail.classList.toggle('show');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-right');
            }
        }

        // Search functionality
        document.getElementById('searchInstrument').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const auditCards = document.querySelectorAll('.audit-card');

            auditCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.getElementById('filterStatus').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            const indicatorItems = document.querySelectorAll('.indicator-item');

            indicatorItems.forEach(item => {
                const statusBadge = item.querySelector('.status-badge');
                if (!filterValue) {
                    item.style.display = 'block';
                } else if (filterValue === 'completed' && statusBadge.classList.contains('status-completed')) {
                    item.style.display = 'block';
                } else if (filterValue === 'pending' && statusBadge.classList.contains('status-pending')) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Initialize animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.slide-up');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endsection
