@extends('layouts.dashboard.dashboard')
@section('menu')
    Laporan AMI
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Laporan AMI</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Header Section -->
            <div class="card shadow-sm mb-8">
                <div class="card-body p-0">
                    <div class="px-10 pt-10 pb-5">
                        <div class="d-flex flex-stack mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Laporan Audit Mutu Internal</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Daftar lengkap hasil audit mutu internal yang telah selesai dilakukan. Klik tombol "Detail" untuk melihat laporan lengkap dan download dokumen terkait.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="py-5 px-10 bg-light-primary">
                        <div class="row g-3">
                            <!-- Search Input -->
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center position-relative">
                                    <i class="fas fa-search fs-3 position-absolute ms-5 text-muted"></i>
                                    <input type="text" id="searchInput" class="form-control form-control-solid ps-12"
                                           placeholder="Cari berdasarkan nama auditee, fakultas, atau auditor..." />
                                </div>
                            </div>

                            <!-- Period Filter -->
                            <div class="col-lg-3">
                                <select id="periodFilter" class="form-select form-select-solid">
                                    @foreach($allPeriods as $period)
                                        <option value="{{ $period->id }}"
                                                {{ $currentPeriod && $currentPeriod->id === $period->id ? 'selected' : '' }}>
                                            {{ $period->nomor_surat }} - Siklus {{ $period->siklus }}
                                            @if($period->deleted_at)
                                                (Tidak Aktif)
                                            @else
                                                (Aktif)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-lg-3">
                                <select id="statusFilter" class="form-select form-select-solid">
                                    <option value="">Semua Status</option>
                                    <option value="selesai">Audit Selesai</option>
                                    <option value="proses">Dalam Proses</option>
                                </select>
                            </div>

                            <!-- Clear Filters Button -->
                            <div class="col-lg-2">
                                <button type="button" id="clearFilters" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-1"></i>
                                    Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="row g-4">
                @forelse ($penugasanAuditors as $penugasanAuditor)
                    <div class="col-xl-4 col-lg-6 col-md-6 audit-card">

                        <div class="card h-100 shadow-sm hover-elevate-up">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-4 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-building fs-1 text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-5">{{ $penugasanAuditor->auditee->jenjang . ' ' . $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                            <span class="text-muted fw-semibold fs-7">
                                                <i class="fas fa-file-signature text-primary me-1"></i>
                                                {{ $penugasanAuditor->periodeAktif->nomor_surat ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                        $totalAuditor = $penugasanAuditor->auditors->count();
                                        $auditorSelesai = 0;
                                        $auditorIdsYangSudahNilai = new Set();
                                        foreach ($penugasanAuditor->auditors as $auditor) {
                                            foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                    $auditorIdsYangSudahNilai.add($auditor->user_id);
                                                }
                                            }
                                        }
                                        $auditorSelesai = $auditorIdsYangSudahNilai.size;
                                    @endphp

                                    @if($totalAuditor > 0)
                                        @if($auditorSelesai == $totalAuditor)
                                            <div class="text-end">
                                                <div class="badge badge-light-success fs-7 mb-1">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Audit Selesai
                                                </div>
                                                <div class="text-success fw-bold fs-8">{{ $auditorSelesai }}/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @elseif($auditorSelesai > 0)
                                            <div class="text-end">
                                                <div class="badge badge-light-warning fs-7 mb-1">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Dalam Proses
                                                </div>
                                                <div class="text-warning fw-bold fs-8">{{ $auditorSelesai }}/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @else
                                            <div class="text-end">
                                                <div class="badge badge-light-info fs-7 mb-1">
                                                    <i class="fas fa-hourglass-start me-1"></i>
                                                    Belum Dimulai
                                                </div>
                                                <div class="text-info fw-bold fs-8">0/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-end">
                                            <div class="badge badge-light-secondary fs-7 mb-1">
                                                <i class="fas fa-user-slash me-1"></i>
                                                Belum Ada Auditor
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Info Row-->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-info">
                                                    <i class="fas fa-calendar-alt text-info fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Tahun AMI</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->periodeAktif->tahun_ami ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-success">
                                                    <i class="fas fa-sync-alt text-success fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Siklus</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->periodeAktif->siklus ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info Row-->

                                <!--begin::Unit Info Row-->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-warning">
                                                    <i class="fas fa-graduation-cap text-warning fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Jenjang</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-danger">
                                                    <i class="fas fa-university text-danger fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Fakultas</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Unit Info Row-->

                                <!--begin::Auditors-->
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted fw-semibold fs-8">
                                            <i class="fas fa-users me-1"></i>
                                            Daftar Auditor & Status Penilaian
                                        </span>
                                    </div>

                                    @forelse ($penugasanAuditor->auditors as $auditor)
                                        @php
                                            $sudahNilai = false;
                                            foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                    $sudahNilai = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="symbol symbol-30px me-2">
                                                @if($auditor->auditor->foto)
                                                    <img src="{{ Storage::url($auditor->auditor->foto) }}" alt="{{ $auditor->auditor->name }}" class="rounded-circle" />
                                                @else
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="fas fa-user text-primary fs-6"></i>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                <span class="text-muted fw-semibold fs-8">{{ str_replace('_', ' ', $auditor->role) }}</span>
                                            </div>
                                            @if ($sudahNilai)
                                                <span class="badge badge-light-success fs-8">
                                                    <i class="fas fa-check me-1"></i>
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="badge badge-light-warning fs-8">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Proses
                                                </span>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-muted fst-italic fs-8">Belum ada auditor yang ditugaskan</div>
                                    @endforelse
                                </div>
                                <!--end::Auditors-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer pt-0">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('laporan.detail', $penugasanAuditor->id) }}" class="btn btn-sm btn-primary flex-grow-1">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Detail
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-download me-1"></i>
                                            Export
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.daftarPertanyaan', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-list me-2"></i>
                                                    Daftar Pertanyaan
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.beritaAcara', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-file-contract me-2"></i>
                                                    Berita Acara
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.evaluasiAmi', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-clipboard-check me-2"></i>
                                                    Evaluasi AMI
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.laporanAmi', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-print me-2"></i>
                                                    Laporan AMI
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card card-custom">
                            <div class="card-body text-center p-10">
                                <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                <h4 class="text-gray-800 mb-2">Belum ada data</h4>
                                <p class="text-gray-600">Data audit akan muncul di sini setelah audit selesai dilakukan</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const periodFilter = document.getElementById('periodFilter');
    const statusFilter = document.getElementById('statusFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const cardsContainer = document.querySelector('.row.g-4');

    let currentPeriodId = '{{ $currentPeriod ? $currentPeriod->id : "" }}';

    // Function to fetch filtered data
    function fetchFilteredData() {
        const searchTerm = searchInput.value;
        const periodId = periodFilter.value;
        const status = statusFilter.value;

        // Show loading state
        cardsContainer.innerHTML = `
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data...</p>
            </div>
        `;

        // Build query parameters (only for server-side filters)
        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (periodId) params.append('period', periodId);

        // Make AJAX request
        fetch(`{{ route('laporan.getFilteredData') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Apply client-side status filtering
                    let filteredData = data.data;
                    if (status) {
                        filteredData = data.data.filter(penugasanAuditor => {
                            const totalAuditor = penugasanAuditor.auditors_count || 0;
                            let auditorSelesai = 0;
                            let auditorIdsYangSudahNilai = new Set();

                            if (penugasanAuditor.ikss_auditee) {
                                penugasanAuditor.ikss_auditee.forEach(ikss => {
                                    if (ikss.nilai) {
                                        ikss.nilai.forEach(nilai => {
                                            if (nilai.auditor_id && penugasanAuditor.auditors.some(auditor =>
                                                auditor.user_id === nilai.auditor_id)) {
                                                auditorIdsYangSudahNilai.add(nilai.auditor_id);
                                            }
                                        });
                                    }
                                });
                            }

                            auditorSelesai = auditorIdsYangSudahNilai.size;

                            if (status === 'selesai') {
                                return totalAuditor > 0 && auditorSelesai === totalAuditor;
                            } else if (status === 'proses') {
                                return totalAuditor > 0 && auditorSelesai > 0 && auditorSelesai < totalAuditor;
                            }
                            return true;
                        });
                    }
                    renderCards(filteredData);
                } else {
                    console.error('Error fetching data:', data);
                    cardsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Terjadi kesalahan saat memuat data
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cardsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Terjadi kesalahan saat memuat data
                        </div>
                    </div>
                `;
            });
    }

    // Function to render cards
    function renderCards(penugasanAuditors) {
        if (penugasanAuditors.length === 0) {
            cardsContainer.innerHTML = `
                <div class="col-12">
                    <div class="card card-custom">
                        <div class="card-body text-center p-10">
                            <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                            <h4 class="text-gray-800 mb-2">Tidak ada data</h4>
                            <p class="text-gray-600">Tidak ada data yang sesuai dengan filter yang dipilih</p>
                        </div>
                    </div>
                </div>
            `;
            return;
        }

        let cardsHTML = '';

        penugasanAuditors.forEach(penugasanAuditor => {
            // Calculate auditor completion status
            const totalAuditor = penugasanAuditor.auditors_count || 0;
            let auditorSelesai = 0;
            let auditorIdsYangSudahNilai = new Set();

            if (penugasanAuditor.ikss_auditee) {
                penugasanAuditor.ikss_auditee.forEach(ikss => {
                    if (ikss.nilai) {
                        ikss.nilai.forEach(nilai => {
                            if (nilai.auditor_id && penugasanAuditor.auditors.some(auditor =>
                                auditor.user_id === nilai.auditor_id)) {
                                auditorIdsYangSudahNilai.add(nilai.auditor_id);
                            }
                        });
                    }
                });
            }

            auditorSelesai = auditorIdsYangSudahNilai.size;

            // Determine status badge
            let statusBadge = '';
            let statusText = '';
            let statusClass = '';

            if (totalAuditor > 0) {
                if (auditorSelesai === totalAuditor) {
                    statusBadge = '<div class="badge badge-light-success fs-7 mb-1"><i class="fas fa-check-circle me-1"></i>Audit Selesai</div>';
                    statusText = `${auditorSelesai}/${totalAuditor} Auditor`;
                    statusClass = 'text-success';
                } else if (auditorSelesai > 0) {
                    statusBadge = '<div class="badge badge-light-warning fs-7 mb-1"><i class="fas fa-clock me-1"></i>Dalam Proses</div>';
                    statusText = `${auditorSelesai}/${totalAuditor} Auditor`;
                    statusClass = 'text-warning';
                } else {
                    statusBadge = '<div class="badge badge-light-info fs-7 mb-1"><i class="fas fa-hourglass-start me-1"></i>Belum Dimulai</div>';
                    statusText = `0/${totalAuditor} Auditor`;
                    statusClass = 'text-info';
                }
            } else {
                statusBadge = '<div class="badge badge-light-secondary fs-7 mb-1"><i class="fas fa-user-slash me-1"></i>Belum Ada Auditor</div>';
            }

            // Build auditors list
            let auditorsHTML = '';
            if (penugasanAuditor.auditors && penugasanAuditor.auditors.length > 0) {
                penugasanAuditor.auditors.forEach(auditor => {
                    const sudahNilai = penugasanAuditor.ikss_auditee &&
                        penugasanAuditor.ikss_auditee.some(ikss =>
                            ikss.nilai && ikss.nilai.some(nilai => nilai.auditor_id === auditor.user_id)
                        );

                    const auditorStatus = sudahNilai
                        ? '<span class="badge badge-light-success fs-8"><i class="fas fa-check me-1"></i>Selesai</span>'
                        : '<span class="badge badge-light-warning fs-8"><i class="fas fa-clock me-1"></i>Proses</span>';

                    const auditorPhoto = auditor.auditor && auditor.auditor.foto
                        ? `<img src="/storage/${auditor.auditor.foto}" alt="${auditor.auditor.name}" class="rounded-circle" />`
                        : '<span class="symbol-label bg-light-primary"><i class="fas fa-user text-primary fs-6"></i></span>';

                    auditorsHTML += `
                        <div class="d-flex align-items-center mb-2">
                            <div class="symbol symbol-30px me-2">
                                ${auditorPhoto}
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <span class="text-dark fw-bold fs-7">${auditor.auditor ? auditor.auditor.name : 'N/A'}</span>
                                <span class="text-muted fw-semibold fs-8">${auditor.role ? auditor.role.replace('_', ' ') : 'N/A'}</span>
                            </div>
                            ${auditorStatus}
                        </div>
                    `;
                });
            } else {
                auditorsHTML = '<div class="text-muted fst-italic fs-8">Belum ada auditor yang ditugaskan</div>';
            }

            cardsHTML += `
                <div class="col-xl-4 col-lg-6 col-md-6 audit-card">
                    <div class="card h-100 shadow-sm hover-elevate-up">
                        <div class="card-header border-0 pt-4 pb-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="fas fa-building fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark fw-bold fs-5">${penugasanAuditor.auditee ? (penugasanAuditor.auditee.jenjang + ' ' + penugasanAuditor.auditee.nama_unit_kerja) : 'N/A'}</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            <i class="fas fa-file-signature text-primary me-1"></i>
                                            ${penugasanAuditor.periode_aktif ? penugasanAuditor.periode_aktif.nomor_surat : 'N/A'}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    ${statusBadge}
                                    ${statusText ? `<div class="${statusClass} fw-bold fs-8">${statusText}</div>` : ''}
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-info">
                                                <i class="fas fa-calendar-alt text-info fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-8">Tahun AMI</span>
                                            <span class="fw-bold fs-7">${penugasanAuditor.periode_aktif ? penugasanAuditor.periode_aktif.tahun_ami : 'N/A'}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-success">
                                                <i class="fas fa-sync-alt text-success fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-8">Siklus</span>
                                            <span class="fw-bold fs-7">${penugasanAuditor.periode_aktif ? penugasanAuditor.periode_aktif.siklus : 'N/A'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="fas fa-graduation-cap text-warning fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-8">Jenjang</span>
                                            <span class="fw-bold fs-7">${penugasanAuditor.auditee ? penugasanAuditor.auditee.jenjang : 'N/A'}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="fas fa-university text-danger fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-8">Fakultas</span>
                                            <span class="fw-bold fs-7">${penugasanAuditor.auditee && penugasanAuditor.auditee.fakultas ? penugasanAuditor.auditee.fakultas : '-'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted fw-semibold fs-8">
                                        <i class="fas fa-users me-1"></i>
                                        Daftar Auditor & Status Penilaian
                                    </span>
                                </div>
                                ${auditorsHTML}
                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <div class="d-flex gap-2">
                                <a href="/laporan/${penugasanAuditor.id}/detail" class="btn btn-sm btn-primary flex-grow-1">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Detail
                                </a>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-download me-1"></i>
                                        Export
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="/laporan/${penugasanAuditor.id}/daftar_pertanyaan" target="_blank">
                                                <i class="fas fa-list me-2"></i>
                                                Daftar Pertanyaan
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/laporan/${penugasanAuditor.id}/berita-acara" target="_blank">
                                                <i class="fas fa-file-contract me-2"></i>
                                                Berita Acara
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/laporan/${penugasanAuditor.id}/evaluasi-ami" target="_blank">
                                                <i class="fas fa-clipboard-check me-2"></i>
                                                Evaluasi AMI
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="/laporan/${penugasanAuditor.id}/laporan-ami" target="_blank">
                                                <i class="fas fa-print me-2"></i>
                                                Laporan AMI
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        cardsContainer.innerHTML = cardsHTML;
    }

    // Event listeners
    searchInput.addEventListener('input', debounce(fetchFilteredData, 500));
    periodFilter.addEventListener('change', fetchFilteredData);

    // Status filter is client-side only
    statusFilter.addEventListener('change', function() {
        const status = this.value;
        const searchTerm = searchInput.value;
        const periodId = periodFilter.value;

        // Show loading state
        cardsContainer.innerHTML = `
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data...</p>
            </div>
        `;

        // Build query parameters (only for server-side filters)
        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (periodId) params.append('period', periodId);

        // Make AJAX request
        fetch(`{{ route('laporan.getFilteredData') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Apply client-side status filtering
                    let filteredData = data.data;
                    if (status) {
                        filteredData = data.data.filter(penugasanAuditor => {
                            const totalAuditor = penugasanAuditor.auditors_count || 0;
                            let auditorSelesai = 0;
                            let auditorIdsYangSudahNilai = new Set();

                            if (penugasanAuditor.ikss_auditee) {
                                penugasanAuditor.ikss_auditee.forEach(ikss => {
                                    if (ikss.nilai) {
                                        ikss.nilai.forEach(nilai => {
                                            if (nilai.auditor_id && penugasanAuditor.auditors.some(auditor =>
                                                auditor.user_id === nilai.auditor_id)) {
                                                auditorIdsYangSudahNilai.add(nilai.auditor_id);
                                            }
                                        });
                                    }
                                });
                            }

                            auditorSelesai = auditorIdsYangSudahNilai.size;

                            if (status === 'selesai') {
                                return totalAuditor > 0 && auditorSelesai === totalAuditor;
                            } else if (status === 'proses') {
                                return totalAuditor > 0 && auditorSelesai > 0 && auditorSelesai < totalAuditor;
                            }
                            return true;
                        });
                    }
                    renderCards(filteredData);
                } else {
                    console.error('Error fetching data:', data);
                    cardsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Terjadi kesalahan saat memuat data
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cardsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Terjadi kesalahan saat memuat data
                        </div>
                    </div>
                `;
            });
    });

    clearFiltersBtn.addEventListener('click', function() {
        searchInput.value = '';
        periodFilter.value = currentPeriodId;
        statusFilter.value = '';
        fetchFilteredData();
    });

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
</script>
@endpush
