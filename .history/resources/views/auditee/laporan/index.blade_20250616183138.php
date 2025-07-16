@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Add these styles to your CSS file */
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        /* Style for the already submitted notice */
        .notice {
            border-left: 4px solid #FFA800 !important;
        }

        /* File upload styling */
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .custom-file-upload {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .custom-file-upload:hover {
            border-color: #009ef7;
        }

        .file-list {
            margin-top: 1rem;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 3px solid #009ef7;
        }

        .file-item .file-name {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-right: 1rem;
        }

        .file-item .file-remove {
            color: #f1416c;
            cursor: pointer;
        }

        .file-progress {
            height: 5px;
            width: 100%;
            background-color: #e9ecef;
            border-radius: 3px;
            margin-top: 0.25rem;
        }

        .file-progress-bar {
            height: 100%;
            background-color: #009ef7;
            border-radius: 3px;
            width: 0%;
            transition: width 0.3s;
        }

        .file-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #7e8299;
            margin-top: 0.25rem;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 1.5rem;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge.bg-light {
            color: #3f4254;
            background-color: #f5f8fa !important;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .btn-sm i {
            font-size: 0.85rem;
            margin-right: 0.5rem;
        }

        .text-muted.fst-italic {
            font-size: 0.85rem;
        }

        .mb-2 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .mb-2 i {
            font-size: 0.9rem;
        }

        .mb-2 .badge {
            margin-left: auto;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        .alert .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .alert .icon-circle i {
            font-size: 1.5rem;
        }

        .alert h4 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            color: #181C32;
        }

        .alert ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .alert ul li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: #5E6278;
        }

        .alert ul li:before {
            content: "•";
            color: #FFA800;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        /* Table Styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table thead th {
            background: #F5F8FA;
            color: #3F4254;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #E4E6EF;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #E4E6EF;
        }

        .table tbody tr:hover {
            background-color: #F5F8FA;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: #5E6278;
        }

        /* Badge Styling */
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        .badge.bg-light {
            color: #3F4254;
            background-color: #F5F8FA !important;
            border: 1px solid #E4E6EF;
        }

        /* Button Styling */
        .btn-sm {
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.85rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-sm i {
            font-size: 0.85rem;
            margin-right: 0.5rem;
        }

        /* Auditor List Styling */
        .auditor-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .auditor-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 6px;
            background: #F5F8FA;
            transition: all 0.2s ease;
        }

        .auditor-item:hover {
            background: #E4E6EF;
        }

        .auditor-item i {
            font-size: 0.9rem;
        }

        .auditor-item .badge {
            margin-left: auto;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #A1A5B7;
            font-style: italic;
        }
    </style>
@endpush
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer bg-light">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill me-1"></i> Selamat Datang, <span class="fw-bolder">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="alert bg-light-warning d-flex align-items-center p-5 mb-10">
                <div class="icon-circle bg-warning">
                    <i class="bi bi-file-earmark-text text-white"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bolder">Dokumen Hasil Audit</h4>
                    <div class="fs-6">
                        <p class="mb-3">
                            <span class="fw-semibold">
                                Pada halaman ini, Anda dapat mengakses dan mengelola berbagai dokumen hasil audit, termasuk:
                            </span>
                        </p>
                        <ul>
                            <li>Berita Acara Audit</li>
                            <li>Evaluasi Audit Mutu Internal</li>
                            <li>Daftar Pertanyaan Audit</li>
                            <li>Laporan Audit Mutu Internal</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6 mt-6">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="kt_penugasanAuditor_table">
                                    <thead>
                                        <tr>
                                            <th class="min-w-50px">No</th>
                                            <th class="min-w-125px">Nama Auditee</th>
                                            <th class="min-w-125px">Jenjang</th>
                                            <th class="min-w-125px">Fakultas</th>
                                            <th class="min-w-175px">Auditor</th>
                                            <th class="min-w-auto text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($penugasanAuditors as $index => $penugasanAuditor)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $penugasanAuditor->auditee->nama_unit_kerja }}</td>
                                                <td>{{ $penugasanAuditor->auditee->jenjang }}</td>
                                                <td>{{ $penugasanAuditor->auditee->fakultas ? $penugasanAuditor->auditee->fakultas : '-' }}</td>
                                                <td>
                                                    <div class="auditor-list">
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

                                                            <div class="auditor-item">
                                                                <i class="fas fa-user text-primary"></i>
                                                                <span class="fw-semibold">{{ $auditor->auditor->name }}</span>
                                                                @if ($sudahNilai)
                                                                    <i class="fas fa-check-circle text-success"></i>
                                                                @endif
                                                                <span class="badge bg-light text-capitalize">
                                                                    {{ str_replace('_', ' ', $auditor->role) }}
                                                                </span>
                                                            </div>
                                                        @empty
                                                            <span class="text-muted fst-italic">Belum ditugaskan</span>
                                                        @endforelse
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('auditee.laporan.detail', $penugasanAuditor->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="empty-state">Data tidak tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('evaluasiAmiForm');
        const submitButton = document.getElementById('submitEvaluasi');
        const evaluasiModal = document.getElementById('evaluasiAmiModal');

        function resetRadioButtonsDisplay() {
            // Remove active class from all radio button labels
            document.querySelectorAll('.btn.btn-outline').forEach(label => {
                label.classList.remove('active');
            });
        }

        // Add modal event listener for resetting form
        if (evaluasiModal) {
            evaluasiModal.addEventListener('hidden.bs.modal', function () {
                // Reset form
                form.reset();

                // Remove validation classes
                form.querySelectorAll('.border-danger').forEach(el => {
                    el.classList.remove('border-danger');
                });
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // Reset radio button display
                resetRadioButtonsDisplay();

                // Reset button state
                submitButton.removeAttribute('data-kt-indicator');
                submitButton.disabled = false;
            });

            // Add event listener for when modal is about to be shown
            evaluasiModal.addEventListener('show.bs.modal', function () {
                // Reset form and display before showing
                form.reset();
                resetRadioButtonsDisplay();
            });
        }

        // Add change event listener to radio buttons to handle display
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // First remove active class from all labels in this group
                const name = this.getAttribute('name');
                document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
                    input.closest('.btn').classList.remove('active');
                });

                // Add active class to selected radio's label
                if (this.checked) {
                    this.closest('.btn').classList.add('active');
                }
            });
        });

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi form
                let isValid = true;
                let firstInvalidElement = null;

                // Validasi radio buttons
                const radioGroups = {};
                form.querySelectorAll('input[type="radio"]').forEach(radio => {
                    const name = radio.getAttribute('name');
                    if (!radioGroups[name]) {
                        radioGroups[name] = false;
                    }
                    if (radio.checked) {
                        radioGroups[name] = true;
                    }
                });

                // Cek setiap grup radio
                for (const [name, isChecked] of Object.entries(radioGroups)) {
                    if (!isChecked) {
                        isValid = false;
                        const radioGroup = form.querySelector(`input[name="${name}"]`).closest('.card');
                        if (!firstInvalidElement) {
                            firstInvalidElement = radioGroup;
                        }
                        radioGroup.classList.add('border-danger');
                    }
                }

                // Validasi textarea
                const requiredTextareas = ['materi_instrumen', 'pelaksanaan_audit', 'saran_teraudit'];
                requiredTextareas.forEach(id => {
                    const textarea = document.getElementById(id);
                    if (!textarea.value.trim()) {
                        isValid = false;
                        textarea.classList.add('is-invalid');
                        if (!firstInvalidElement) {
                            firstInvalidElement = textarea;
                        }
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        title: 'Periksa Kembali',
                        text: 'Mohon lengkapi semua isian yang diperlukan',
                        icon: 'warning',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    });

                    if (firstInvalidElement) {
                        firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Disable button dan tampilkan loading
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                // Create form data
                const formData = new FormData(form);

                // Submit form
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Check if the response is a PDF
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/pdf')) {
                            return response.blob();
                        }
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data instanceof Blob) {
                        // Handle PDF response
                        const url = window.URL.createObjectURL(data);
                        window.open(url, '_blank');

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('evaluasiAmiModal'));
                        modal.hide();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data evaluasi berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload halaman setelah user klik Ok
                                window.location.reload();
                            }
                        });
                    } else {
                        // Handle JSON response (error case)
                        if (!data.success) {
                            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: error.message || 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    });
                })
                .finally(() => {
                    // Enable button dan hilangkan loading
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                });
            });

            // Reset validation on input
            form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const card = this.closest('.card');
                    if (card) {
                        card.classList.remove('border-danger');
                    }
                });
            });

            form.querySelectorAll('textarea').forEach(textarea => {
                textarea.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        }
    });
</script>

<style>
    .card.border-danger {
        border-color: #dc3545 !important;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }
    [data-kt-indicator='on'] {
        position: relative;
        cursor: not-allowed;
    }
    [data-kt-indicator='on'] .indicator-label {
        display: none;
    }
    [data-kt-indicator='on'] .indicator-progress {
        display: inline-block;
    }
    .indicator-progress {
        display: none;
    }
</style>
@endpush
