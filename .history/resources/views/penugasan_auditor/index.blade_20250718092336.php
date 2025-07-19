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
            <!--begin::Card-->
            <div class="card shadow-sm">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-penugasanAuditor-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-12"
                                   placeholder="Cari Penugasan Auditor..." />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-penugasanAuditor-table-toolbar="base">
                            <!-- Tombol tambah penugasan dihapus karena assign dilakukan per row -->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Info Alert-->
                    <div class="alert alert-info d-flex align-items-center p-5 mb-8">
                        <i class="ki-duotone ki-information-5 fs-2hx text-info me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-info">Informasi Penugasan Auditor</h4>
                            <span>Silakan lakukan penugasan auditor untuk data yang belum memiliki auditor. Pastikan setiap pengajuan AMI memiliki ketua auditor dan minimal satu anggota auditor.</span>
                        </div>
                    </div>
                    <!--end::Info Alert-->

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_penugasanAuditor_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px ps-4 rounded-start">No</th>
                                <th class="min-w-200px">Nama Auditee</th>
                                <th class="min-w-100px">Jenjang</th>
                                <th class="min-w-150px">Fakultas</th>
                                <th class="min-w-250px">Tim Auditor</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-100px text-center rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($penugasanAuditors as $index => $penugasanAuditor)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge badge-light-primary fw-bold">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="fas fa-university fs-2 text-primary"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-bold fs-6">{{ $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                                <span class="text-muted fw-semibold fs-7">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info fw-bold">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-semibold">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                    </td>
                                    <td>
                                        @if($penugasanAuditor->auditors->count() > 0)
                                            <div class="d-flex flex-column gap-3">
                                                @foreach ($penugasanAuditor->auditors as $auditor)
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-35px me-3">
                                                            <span class="symbol-label bg-light-success">
                                                                <i class="fas fa-user-tie fs-2 text-success"></i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column flex-grow-1">
                                                            <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                            <span class="badge badge-light-{{ $auditor->role === 'ketua' ? 'danger' : 'info' }} fs-8 fw-bold">
                                                                {{ ucfirst(str_replace('_', ' ', $auditor->role)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-35px me-3">
                                                    <span class="symbol-label bg-light-warning">
                                                        <i class="fas fa-user fs-2 text-warning"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-muted fw-semibold fs-7">Belum ada auditor</span>
                                                    <span class="badge badge-light-warning fs-8 fw-bold">Perlu ditugaskan</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (!$penugasanAuditor->is_disetujui)
                                            <span class="badge badge-light-danger fw-bold">
                                                <i class="fas fa-times-circle fs-2 text-danger me-1"></i>
                                                Belum Disetujui
                                            </span>
                                        @else
                                            <span class="badge badge-light-success fw-bold">
                                                <i class="fas fa-check-circle fs-2 text-success me-1"></i>
                                                Disetujui
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                                data-bs-toggle="modal" data-bs-target="#modalPenugasanAuditor"
                                                onclick="setPenugasanId('{{ $penugasanAuditor->id }}')">
                                            <i class="fas fa-user-plus fs-2"></i>
                                            Assign
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-file-alt fs-3x text-muted mb-4"></i>
                                            <span class="text-muted fw-semibold fs-6">Data penugasan auditor tidak tersedia</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

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

        // Function to set the pengajuan_ami_id when opening the modal
        function setPenugasanId(id) {
            currentPenugasanId = id;
            document.getElementById('pengajuan_ami_id').value = id;

            // Load auditor options when modal opens
            loadAuditors('auditor1');
            loadAuditors('auditor2');
            loadAuditors('auditor3');

            // Load existing assignments for this penugasan
            loadExistingAssignments(id);
        }

        // Function to load auditors using AJAX
        function loadAuditors(selectId) {
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
                    }
                })
                .catch(error => {
                    console.error('Error loading auditors:', error);
                    selectElement.innerHTML = '<option value="">Gagal memuat data auditor</option>';
                    selectElement.classList.remove('loading');

                    // Notify user about the error
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal memuat data auditor. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'swal2-custom-popup'
                        }
                    });
                });
        }

        // Function to load existing auditor assignments
        function loadExistingAssignments(penugasanId) {
            // Wait for auditor options to be loaded first
            setTimeout(() => {
                // Fetch existing assignments via AJAX
                fetch(`/penugasan-auditor/get-existing-assignments/${penugasanId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.assignments) {
                            // Set default values for existing assignments
                            const assignments = data.assignments;

                            // Set ketua auditor (auditor1)
                            if (assignments.ketua) {
                                const auditor1Select = document.getElementById('auditor1');
                                if (auditor1Select) {
                                    auditor1Select.value = assignments.ketua.auditor_id;
                                }
                            }

                            // Set anggota auditor (auditor2)
                            if (assignments.anggota) {
                                const auditor2Select = document.getElementById('auditor2');
                                if (auditor2Select) {
                                    auditor2Select.value = assignments.anggota.auditor_id;
                                }
                            }

                            // Set anggota kedua (auditor3) if exists
                            if (assignments.anggota_kedua) {
                                const auditor3Select = document.getElementById('auditor3');
                                if (auditor3Select) {
                                    auditor3Select.value = assignments.anggota_kedua.auditor_id;
                                }
                            }

                            // Set waktu visitasi if exists
                            if (assignments.waktu_visitasi) {
                                const waktuInput = document.getElementById('waktu_visitasi');
                                if (waktuInput) {
                                    // Format datetime for input
                                    const date = new Date(assignments.waktu_visitasi);
                                    const formattedDate = date.toISOString().slice(0, 16);
                                    waktuInput.value = formattedDate;
                                }
                            }

                            // Update button text to indicate update mode
                            const submitBtn = document.getElementById('btnSimpanPenugasan');
                            if (submitBtn) {
                                submitBtn.innerHTML = '<i class="fas fa-check fs-2 me-1"></i>Update Penugasan';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading existing assignments:', error);
                        // Keep button as "Simpan Penugasan" if error
                        const submitBtn = document.getElementById('btnSimpanPenugasan');
                        if (submitBtn) {
                            submitBtn.innerHTML = '<i class="fas fa-check fs-2 me-1"></i>Simpan Penugasan';
                        }
                    });
            }, 1000); // Wait 1 second for auditor options to load
        }

        // Event listener for the save button
        document.getElementById('btnSimpanPenugasan').addEventListener('click', function() {
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
