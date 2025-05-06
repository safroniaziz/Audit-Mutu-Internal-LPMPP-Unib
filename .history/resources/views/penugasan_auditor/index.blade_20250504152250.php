@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Penugasan Auditor
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Penugasan Auditor</li>
@endsection
@push('styles')
    <style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </style>
@endpush
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="w-100 mb-2">
                        <div class="alert alert-danger d-flex align-items-center p-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <i class="ki-duotone ki-shield-tick fs-2 text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>

                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Perhatian!</h4>
                                <span>Jika Anda ingin menghapus data Penugasan Auditor, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-penugasanAuditor-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Penugasan Auditor" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-penugasanAuditor-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Penugasan Auditor
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-penugasanAuditor-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-penugasanAuditor-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-penugasanAuditor-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_penugasanAuditor_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="min-w-50px ps-4">No</th>
                                <th class="min-w-125px">Nama Auditee</th>
                                <th class="min-w-125px">Jenjang</th>
                                <th class="min-w-125px">Fakultas</th>
                                <th class="min-w-175px">Auditor</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($penugasanAuditors as $index => $penugasanAuditor)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">{{ $index + 1 }}</td>
                                    <td>{{ $penugasanAuditor->auditee->nama_unit_kerja }}</td>
                                    <td>{{ $penugasanAuditor->auditee->jenjang }}</td>
                                    <td>{{ $penugasanAuditor->auditee->fakultas ? $penugasanAuditor->auditee->fakultas : '-' }}</td>
                                    <td></td>
                                    <td class="text-center">
                                        @if (!$penugasanAuditor->is_disetujui)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle fa-sm" style="color: white;"></i>&nbsp;Belum disetujui
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle fa-sm" style="color: white;"></i>&nbsp;Disetujui
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="button-container">
                                            <div class="button-container">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPenugasanAuditor" onclick="setPenugasanId('{{ $penugasanAuditor->id }}')">
                                                    <i class="fas fa-user-plus"></i> Assign Auditor
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layouts.partials._modal_penugasan_auditor')
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

        $(document).ready(function() {
            // Initialize Select2 for searchable dropdowns
            $('.select2').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalPenugasanAuditor'),
                width: '100%',
                placeholder: 'Cari auditor...',
                allowClear: true
            });

            // Make sure select2 is refreshed when modal opens
            $('#modalPenugasanAuditor').on('shown.bs.modal', function () {
                $('.select2').select2('destroy').select2({
                    theme: 'bootstrap-5',
                    dropdownParent: $('#modalPenugasanAuditor'),
                    width: '100%',
                    placeholder: 'Cari auditor...',
                    allowClear: true
                });
            });
        });

        // Function to set the pengajuan_ami_id when opening the modal
        function setPenugasanId(id) {
            currentPenugasanId = id;
            document.getElementById('pengajuan_ami_id').value = id;

            // Load auditor options when modal opens
            loadAuditors('auditor1');
            loadAuditors('auditor2');
            loadAuditors('auditor3');
        }

        // Function to load auditors using AJAX
        function loadAuditors(selectId) {
            const selectElement = document.getElementById(selectId);

            // Clear previous options except the first one
            selectElement.innerHTML = '<option value="">Loading...</option>';

            // Fetch auditors via AJAX
            fetch('/penugasan-auditor/get-auditors')
                .then(response => response.json())
                .then(data => {
                    // Reset select
                    selectElement.innerHTML = '<option value="">Pilih Auditor</option>';

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
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading auditors:', error);
                    selectElement.innerHTML = '<option value="">Gagal memuat data auditor</option>';

                    // Notify user about the error
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal memuat data auditor. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        // Event listener for the save button
        document.getElementById('btnSimpanPenugasan').addEventListener('click', function() {
            const form = document.getElementById('formPenugasanAuditor');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Get form data
            const formData = {
                pengajuan_ami_id: document.getElementById('pengajuan_ami_id').value,
                auditor1: document.getElementById('auditor1').value,
                auditor2: document.getElementById('auditor2').value,
                auditor3: document.getElementById('auditor3').value || null, // Handle optional field
                waktu_visitasi: document.getElementById('waktu_visitasi').value
            };

            // Send data via AJAX
            fetch('/penugasan-auditor/save-penugasan-auditor', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalPenugasanAuditor'));
                    modal.hide();

                    // Show success message
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data penugasan auditor berhasil disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload the page to see changes
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error saving data:', error);
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush
