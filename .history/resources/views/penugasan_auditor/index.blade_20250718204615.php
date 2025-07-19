@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Penugasan Auditor
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Penugasan Auditor</li>
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
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Penugasan Auditor</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Kelola penugasan auditor untuk setiap pengajuan AMI
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
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
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
                @forelse ($penugasanAuditors as $index => $penugasanAuditor)
                    <div class="col-xl-4 col-lg-6 col-md-6 penugasan-card">
                        <div class="card h-100 shadow-sm hover-elevate-up">
                                                                                    <!--begin::Header-->
                            <div class="card-header border-0 pt-4 pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="fas fa-university fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark fw-bold fs-5">{{ $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            <i class="fas fa-university text-primary me-1"></i>
                                            {{ $penugasanAuditor->auditee->fakultas ?: '-' }}
                                        </span>
                                    </div>
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
                                                    <i class="fas fa-graduation-cap text-info fs-6"></i>
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
                                                <span class="symbol-label bg-light-warning">
                                                    <i class="fas fa-file-signature text-warning fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Nomor Surat</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->periodeAktif->nomor_surat ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info Row-->

                                <!--begin::Auditors-->
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted fw-semibold fs-8">
                                            <i class="fas fa-users me-1"></i>
                                            Tim Auditor
                                        </span>
                                        @if($penugasanAuditor->auditors->count() > 0)
                                            <span class="badge badge-light-primary fs-8 ms-auto">{{ $penugasanAuditor->auditors->count() }} Auditor</span>
                                        @endif
                                    </div>

                                    @if($penugasanAuditor->auditors->count() > 0)
                                        @foreach ($penugasanAuditor->auditors as $auditor)
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-success">
                                                        <i class="fas fa-user-tie text-success fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                    <span class="text-muted fw-semibold fs-8">{{ ucfirst(str_replace('_', ' ', $auditor->role)) }}</span>
                                                </div>
                                                <span class="badge badge-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-8">
                                                    {{ $auditor->role === 'ketua' ? 'Ketua' : 'Anggota' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-warning">
                                                    <i class="fas fa-user fs-2 text-warning"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Belum ada auditor</span>
                                                <span class="badge badge-light-warning fs-8">Perlu ditugaskan</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Auditors-->
                            </div>
                            <!--end::Body-->

                                                        <!--begin::Footer-->
                            <div class="card-footer pt-0">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    @if (!$penugasanAuditor->is_disetujui)
                                        <span class="badge badge-light-warning fs-8">
                                            <i class="fas fa-clock me-1"></i>
                                            Pending
                                        </span>
                                    @else
                                        <span class="badge badge-light-success fs-8">
                                            <i class="fas fa-check me-1"></i>
                                            Approved
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary flex-grow-1"
                                            data-bs-toggle="modal" data-bs-target="#modalPenugasanAuditor"
                                            onclick="setPenugasanId('{{ $penugasanAuditor->id }}')">
                                        <i class="fas fa-user-plus me-1"></i>
                                        {{ $penugasanAuditor->auditors->count() > 0 ? 'Edit' : 'Assign' }}
                                    </button>
                                    @if($penugasanAuditor->auditors->count() > 0)
                                        <button type="button" class="btn btn-sm btn-light-info"
                                                onclick="viewDetails('{{ $penugasanAuditor->id }}')">
                                            <i class="fas fa-eye me-1"></i>
                                            Detail
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card card-custom">
                            <div class="card-body text-center p-10">
                                <i class="fas fa-file-alt fs-3x text-muted mb-5"></i>
                                <h4 class="text-gray-800 mb-2">Data tidak tersedia</h4>
                                <p class="text-gray-600">Data penugasan auditor akan muncul di sini</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @include('layouts.partials.modal_penugasan_auditor')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/src/js/custom/apps/penugasan_auditor/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let currentPenugasanId = null;

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const periodFilter = document.getElementById('periodFilter');
            const clearFiltersBtn = document.getElementById('clearFilters');
            const cardsContainer = document.querySelector('.row.g-4');

            let filterTimeout;

            // Function to apply all filters with debouncing
            function applyFilters() {
                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(() => {
                    const searchTerm = searchInput.value;
                    const selectedStatus = statusFilter.value;
                    const selectedPeriod = periodFilter.value;

                    // Show loading state
                    cardsContainer.innerHTML = `
                        <div class="col-12 text-center">
                            <div class="d-flex justify-content-center align-items-center py-10">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="ms-3 text-muted">Memuat data...</span>
                            </div>
                        </div>
                    `;

                    // Prepare query parameters
                    const params = new URLSearchParams();
                    if (searchTerm) params.append('search', searchTerm);
                    if (selectedStatus) params.append('status', selectedStatus);
                    if (selectedPeriod) params.append('period', selectedPeriod);

                    // Fetch filtered data
                    fetch(`/penugasan-auditor/get-filtered-data?${params.toString()}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                renderCards(data.data);
                            } else {
                                cardsContainer.innerHTML = `
                                    <div class="col-12">
                                        <div class="card card-custom">
                                            <div class="card-body text-center p-10">
                                                <i class="fas fa-exclamation-triangle fs-3x text-warning mb-5"></i>
                                                <h4 class="text-gray-800 mb-2">Terjadi kesalahan</h4>
                                                <p class="text-gray-600">Gagal memuat data</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching filtered data:', error);
                            cardsContainer.innerHTML = `
                                <div class="col-12">
                                    <div class="card card-custom">
                                        <div class="card-body text-center p-10">
                                            <i class="fas fa-exclamation-triangle fs-3x text-danger mb-5"></i>
                                            <h4 class="text-gray-800 mb-2">Terjadi kesalahan</h4>
                                            <p class="text-gray-600">Gagal memuat data</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                }, 300); // 300ms debounce
            }

                        // Function to render cards
            function renderCards(penugasanAuditors) {
                if (!penugasanAuditors || penugasanAuditors.length === 0) {
                    cardsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-body text-center p-10">
                                    <i class="fas fa-file-alt fs-3x text-muted mb-5"></i>
                                    <h4 class="text-gray-800 mb-2">Data tidak tersedia</h4>
                                    <p class="text-gray-600">Tidak ada data yang sesuai dengan filter yang dipilih</p>
                                </div>
                            </div>
                        </div>
                    `;
                    return;
                }

                                let cardsHTML = '';
                penugasanAuditors.forEach((penugasanAuditor, index) => {
                    // Add null checks for all properties
                    const auditee = penugasanAuditor.auditee || {};
                    const periodeAktif = penugasanAuditor.periode_aktif || {};
                    const auditors = Array.isArray(penugasanAuditor.auditors) ? penugasanAuditor.auditors : [];
                penugasanAuditors.forEach((penugasanAuditor, index) => {
                    // Add null checks for all properties
                    const auditee = penugasanAuditor.auditee || {};
                    const periodeAktif = penugasanAuditor.periode_aktif || {};
                    const auditors = Array.isArray(penugasanAuditor.auditors) ? penugasanAuditor.auditors : [];

                    cardsHTML += `
                        <div class="col-xl-4 col-lg-6 col-md-6 penugasan-card">
                            <div class="card h-100 shadow-sm hover-elevate-up">
                                <div class="card-header border-0 pt-4 pb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-university fs-1 text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-5">${auditee.nama_unit_kerja || 'N/A'}</span>
                                            <span class="text-muted fw-semibold fs-7">
                                                <i class="fas fa-university text-primary me-1"></i>
                                                ${auditee.fakultas || '-'}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body py-3">
                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-info">
                                                        <i class="fas fa-graduation-cap text-info fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Jenjang</span>
                                                    <span class="fw-bold fs-7">${auditee.jenjang || 'N/A'}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-warning">
                                                        <i class="fas fa-file-signature text-warning fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Nomor Surat</span>
                                                    <span class="fw-bold fs-7">${penugasanAuditor.nomor_surat || 'N/A'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-success">
                                                        <i class="fas fa-calendar text-success fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Periode</span>
                                                    <span class="fw-bold fs-7">${periodeAktif.nama_periode || 'N/A'}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px me-2">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="fas fa-users text-primary fs-6"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-8">Jumlah Auditor</span>
                                                    <span class="fw-bold fs-7">${auditors.length} orang</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                                        <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-info">
                                                <i class="fas fa-user-tie text-info fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-muted fw-semibold fs-8">Ketua Auditor</span>
                                            <span class="fw-bold fs-7">${auditors.length > 0 ? auditors[0].auditor?.name || 'N/A' : 'Belum ditugaskan'}</span>
                                        </div>
                                    </div>
                                </div>

                                <!--begin::Footer-->
                                <div class="card-footer border-0 pt-0 pb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            ${penugasanAuditor.is_disetujui ? `
                                                <span class="badge badge-light-success fs-8">
                                                    <i class="fas fa-check me-1"></i>
                                                    Approved
                                                </span>
                                            ` : `
                                                <span class="badge badge-light-warning fs-8">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Pending
                                                </span>
                                            `}
                                        </div>
                                                                                                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-primary flex-grow-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalPenugasanAuditor"
                                                    onclick="setPenugasanId('${penugasanAuditor.id}')"
                                                    id="edit-btn-${penugasanAuditor.id}">
                                                <i class="fas fa-user-plus me-1"></i>
                                                ${auditors.length > 0 ? 'Edit' : 'Assign'}
                                            </button>
                                            ${auditors.length > 0 ? `
                                                <button type="button" class="btn btn-sm btn-light-info"
                                                        onclick="viewDetails('${penugasanAuditor.id}')">
                                                    <i class="fas fa-eye me-1"></i>
                                                    Detail
                                                </button>
                                            ` : ''}
                                        </div>
                                    </div>
                                </div>
                                <!--end::Footer-->
                            </div>
                        </div>
                    `;
                });

                cardsContainer.innerHTML = cardsHTML;
            }

            // Event listeners for filters
            if (searchInput) {
                searchInput.addEventListener('input', applyFilters);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', applyFilters);
            }

            if (periodFilter) {
                periodFilter.addEventListener('change', applyFilters);
            }

            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    statusFilter.value = '';
                    // Set period to current active period (first option which should be selected by default)
                    periodFilter.value = periodFilter.options[0].value;
                    applyFilters();
                });
            }
        });

                // Function to set the pengajuan_ami_id when opening the modal
        function setPenugasanId(id) {
            currentPenugasanId = id;
            document.getElementById('pengajuan_ami_id').value = id;

            // Load auditor options when modal opens, then load existing assignments
            Promise.all([
                loadAuditors('auditor1'),
                loadAuditors('auditor2'),
                loadAuditors('auditor3')
            ]).then(() => {
                // Load existing assignments after auditors are loaded
                loadExistingAssignments(id);
            });
        }

        // Function to load auditors using AJAX
        function loadAuditors(selectId) {
            return new Promise((resolve, reject) => {
                const selectElement = document.getElementById(selectId);

                // Clear previous options except the first one
                selectElement.innerHTML = '<option value="">Loading...</option>';
                selectElement.classList.add('loading');

                // Fetch auditors via AJAX
                fetch('/penugasan-auditor/get-auditors')
                    .then(response => response.json())
                    .then(data => {
                        // Reset select
                        selectElement.innerHTML = '<option value="">Pilih Auditor</option>';
                        selectElement.classList.remove('loading');

                        // Check if data is an array (success) or has success property (error)
                        if (Array.isArray(data)) {
                            // Add the auditors to the select
                            data.forEach(auditor => {
                                const option = document.createElement('option');
                                option.value = auditor.id;
                                option.textContent = auditor.name;
                                selectElement.appendChild(option);
                            });
                            resolve();
                        } else if (data.message) {
                            // Show error in select
                            selectElement.innerHTML = `<option value="">${data.message}</option>`;

                            // Notify user about the error
                            Swal.fire({
                                title: 'Perhatian!',
                                text: data.message,
                                icon: 'warning',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'swal2-custom-popup'
                                }
                            });
                            reject(new Error(data.message));
                        }
                    })
                    .catch(error => {
                        console.error('Error loading auditors:', error);
                        selectElement.innerHTML = '<option value="">Gagal memuat data auditor</option>';
                        selectElement.classList.remove('loading');
                        reject(error);
                    });
            });
        }

        // Function to load existing assignments
        function loadExistingAssignments(penugasanId) {
            fetch(`/penugasan-auditor/get-existing-assignments/${penugasanId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.assignments) {
                        // Clear previous selections
                        document.getElementById('auditor1').value = '';
                        document.getElementById('auditor2').value = '';
                        document.getElementById('auditor3').value = '';

                        // Check if assignments is an array
                        if (Array.isArray(data.assignments)) {
                            // Set existing assignments
                            data.assignments.forEach((assignment, index) => {
                                const selectId = `auditor${index + 1}`;
                                const selectElement = document.getElementById(selectId);
                                if (selectElement) {
                                    selectElement.value = assignment.auditor_id;
                                }
                            });
                        } else if (typeof data.assignments === 'object') {
                            // Handle object format (ketua, anggota, anggota_kedua)
                            if (data.assignments.ketua) {
                                const auditor1Select = document.getElementById('auditor1');
                                if (auditor1Select) {
                                    auditor1Select.value = data.assignments.ketua.auditor_id;
                                }
                            }
                            if (data.assignments.anggota) {
                                const auditor2Select = document.getElementById('auditor2');
                                if (auditor2Select) {
                                    auditor2Select.value = data.assignments.anggota.auditor_id;
                                }
                            }
                            if (data.assignments.anggota_kedua) {
                                const auditor3Select = document.getElementById('auditor3');
                                if (auditor3Select) {
                                    auditor3Select.value = data.assignments.anggota_kedua.auditor_id;
                                }
                            }

                            // Set waktu visitasi if available
                            if (data.assignments.waktu_visitasi) {
                                const waktuVisitasiInput = document.getElementById('waktu_visitasi');
                                if (waktuVisitasiInput) {
                                    // Convert to datetime-local format (YYYY-MM-DDTHH:MM) preserving local timezone
                                    const visitasiDate = new Date(data.assignments.waktu_visitasi);
                                    const year = visitasiDate.getFullYear();
                                    const month = String(visitasiDate.getMonth() + 1).padStart(2, '0');
                                    const day = String(visitasiDate.getDate()).padStart(2, '0');
                                    const hours = String(visitasiDate.getHours()).padStart(2, '0');
                                    const minutes = String(visitasiDate.getMinutes()).padStart(2, '0');
                                    const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;
                                    waktuVisitasiInput.value = formattedDate;
                                }
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error loading existing assignments:', error);
                });
        }

        // Function to view details (placeholder)
        function viewDetails(id) {
            // You can implement this to show detailed view of the assignment
            console.log('View details for penugasan ID:', id);
        }

        // Event listener for the save button
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('btnSimpanPenugasan');
            if (submitBtn) {
                submitBtn.addEventListener('click', function() {
                    const form = document.getElementById('formPenugasanAuditor');
                    const submitBtn = this;

                    // Validate required fields
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    // Show loading state
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin fs-2 me-2"></i>Menyimpan...';
                    submitBtn.disabled = true;
                    submitBtn.classList.add('loading');

                    // Get form data
                    const formData = {
                        pengajuan_ami_id: document.getElementById('pengajuan_ami_id').value,
                        auditor1: document.getElementById('auditor1').value,
                        auditor2: document.getElementById('auditor2').value,
                        auditor3: document.getElementById('auditor3').value || null, // Handle optional field
                        waktu_visitasi: document.getElementById('waktu_visitasi').value
                    };

                    // Determine if this is an update or create operation
                    const isUpdate = originalText.includes('Update');
                    const url = isUpdate ? '/penugasan-auditor/update-penugasan-auditor' : '/penugasan-auditor/save-penugasan-auditor';

                    // Send data via AJAX
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('loading');

                        if (data.success) {
                            // Close modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('modalPenugasanAuditor'));
                            modal.hide();

                            // Show success message
                            const actionText = isUpdate ? 'diperbarui' : 'disimpan';
                            Swal.fire({
                                title: 'Berhasil!',
                                text: `Data penugasan auditor berhasil ${actionText}`,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'swal2-custom-popup'
                                }
                            }).then(() => {
                                // Reload the page to see changes
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'swal2-custom-popup'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error saving data:', error);

                        // Reset button state
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('loading');

                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'swal2-custom-popup'
                            }
                        });
                    });
                });
            }
        });
    </script>
@endpush

@push('styles')
<style>
    /* Custom styles for penugasan auditor page */
    .card.shadow-sm {
        border: none;
        box-shadow: 0 0.1rem 1rem 0.25rem rgba(0, 0, 0, 0.05) !important;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .symbol.symbol-40px {
        width: 40px;
        height: 40px;
    }

    .symbol.symbol-35px {
        width: 35px;
        height: 35px;
    }

    .badge.badge-light-primary {
        background-color: #e1f0ff;
        color: #009ef7;
    }

    .badge.badge-light-info {
        background-color: #e8f6ff;
        color: #0dcaf0;
    }

    .badge.badge-light-success {
        background-color: #e8fff3;
        color: #50cd89;
    }

    .badge.badge-light-warning {
        background-color: #fff8dd;
        color: #ffc700;
    }

    .badge.badge-light-danger {
        background-color: #ffe4e6;
        color: #f1416c;
    }

    .btn-light-primary {
        background-color: #e1f0ff;
        border-color: #e1f0ff;
        color: #009ef7;
    }

    .btn-light-primary:hover {
        background-color: #009ef7;
        border-color: #009ef7;
        color: #ffffff;
    }

    .alert-info {
        background-color: #e8f6ff;
        border-color: #b3d9ff;
        color: #0c63e4;
    }

    .modal-lg {
        max-width: 600px;
    }

    .form-select-solid {
        background-color: #f5f8fa;
        border-color: #e1e3ea;
    }

    .form-select-solid:focus {
        background-color: #ffffff;
        border-color: #009ef7;
        box-shadow: 0 0 0 0.2rem rgba(0, 158, 247, 0.25);
    }

    .form-control-solid {
        background-color: #f5f8fa;
        border-color: #e1e3ea;
    }

    .form-control-solid:focus {
        background-color: #ffffff;
        border-color: #009ef7;
        box-shadow: 0 0 0 0.2rem rgba(0, 158, 247, 0.25);
    }

    /* Animation for loading states */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .card-toolbar {
            flex-direction: column;
            gap: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .symbol.symbol-40px,
        .symbol.symbol-35px {
            width: 30px;
            height: 30px;
        }
    }

    /* Custom SweetAlert styling */
    .swal2-custom-popup {
        border-radius: 0.75rem;
        font-family: 'Inter', sans-serif;
    }

    .swal2-custom-popup .swal2-title {
        font-weight: 600;
        color: #181c32;
    }

    .swal2-custom-popup .swal2-content {
        color: #5e6278;
    }

    .swal2-custom-popup .swal2-confirm {
        background-color: #009ef7;
        border-color: #009ef7;
        border-radius: 0.475rem;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
    }

    .swal2-custom-popup .swal2-confirm:hover {
        background-color: #0095e8;
        border-color: #0095e8;
    }

    /* Loading animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fa-spinner {
        animation: spin 1s linear infinite;
    }


</style>
@endpush
