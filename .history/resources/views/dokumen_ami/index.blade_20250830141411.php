@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Dokumen AMI
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Dokumen AMI</li>
@endsection
@push('styles')
    <style>
        /* Custom styles */
        .dokumen-card {
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .dokumen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-label {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .dokumen-tabs .nav-link {
            border-radius: 0;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .dokumen-tabs .nav-link.active {
            border-bottom: 3px solid #009ef7;
            background-color: #f1faff;
        }

        .table-dokumen th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .form-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

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

        .empty-state {
            padding: 3rem 0;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #e4e6ef;
            margin-bottom: 1rem;
        }

        .empty-state p {
            font-size: 1rem;
            color: #7e8299;
        }

        .dokumen-item {
            transition: all 0.2s;
        }

        .dokumen-item:hover {
            background-color: #f8f9fa;
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .icon-wrapper.pdf {
            background-color: #fff5f8;
        }

        .icon-wrapper.doc {
            background-color: #f1faff;
        }

        .icon-wrapper.xls {
            background-color: #e8fff3;
        }

        .icon-wrapper.other {
            background-color: #fff8dd;
        }
    </style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!-- Main Content -->
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center">
                        <span class="svg-icon svg-icon-primary svg-icon-2x me-3">
                            <i class="bi bi-file-earmark-text fs-1 text-primary"></i>
                        </span>
                        <div class="d-flex flex-column">
                            <span class="card-label fw-bolder fs-2 mb-1">Repositori Dokumen AMI</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Sistem Pengelolaan Dokumen Audit Mutu Internal</span>
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary btn-sm btn-icon-white px-4" data-bs-toggle="modal" data-bs-target="#modalAddDokumen">
                        <i class="bi bi-file-earmark-plus me-1"></i>
                        Tambah Dokumen
                    </button>
                </div>
            </div>

            <div class="card-body pt-0">
                <!-- Document Tabs -->
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 dokumen-tabs border-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link active px-5 py-3" data-bs-toggle="tab" href="#tab_umum">
                            <span class="svg-icon svg-icon-4 me-1">
                                <i class="bi bi-folder2-open fs-4 me-2"></i>
                            </span>
                            <span class="fw-bold">Dokumen Umum</span>
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link px-5 py-3" data-bs-toggle="tab" href="#tab_auditor">
                            <span class="svg-icon svg-icon-4 me-1">
                                <i class="bi bi-person-badge-fill fs-4 me-2"></i>
                            </span>
                            <span class="fw-bold">Dokumen Auditor</span>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link px-5 py-3" data-bs-toggle="tab" href="#tab_auditee">
                            <span class="svg-icon svg-icon-4 me-1">
                                <i class="bi bi-people-fill fs-4 me-2"></i>
                            </span>
                            <span class="fw-bold">Dokumen Auditee</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content" id="myTabContent">
                    <!-- Dokumen Umum -->
                    <div class="tab-pane show active fade" id="tab_umum" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-4 table-dokumen">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-50px rounded-start">No</th>
                                        <th class="min-w-200px">Nama Dokumen</th>
                                        <th class="min-w-150px">Deskripsi</th>
                                        <th class="min-w-125px">Tanggal Berlaku</th>
                                        <th class="min-w-125px">Ukuran</th>
                                        <th class="min-w-150px text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dokumenUmums && count($dokumenUmums) > 0)
                                        @foreach ($dokumenUmums as $dokumenUmum)
                                            <tr class="dokumen-item">
                                                <td class="ps-4">1</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper other me-3">
                                                            <i class="bi bi-file-earmark-text text-warning fs-2"></i>
                                                        </div>
                                                        <div>
                                                            <span class="fw-bold d-block fs-6">{{ $dokumenUmum->nama_dokumen }}</span>
                                                            <span class="badge badge-light-warning">Umum</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $dokumenUmum->deskripsi_dokumen }}</td>
                                                <td>{{ \Carbon\Carbon::parse($dokumenUmum->tanggal_berlaku)->format('d M Y') }}</td>
                                                <td>{{ formatSizeUnits($dokumenUmum->size_dokumen) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $dokumenUmum->file_dokumen) }}" target="_blank" class="btn btn-sm btn-icon btn-primary me-2" title="Lihat">
                                                        <i class="bi bi-eye-fill fs-4"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-icon btn-warning me-2 btn-edit-dokumen"
                                                    data-id="{{ $dokumenUmum->id }}"
                                                    data-nama="{{ $dokumenUmum->nama_dokumen }}"
                                                    data-kategori="{{ $dokumenUmum->kategori_dokumen }}"
                                                    data-deskripsi="{{ $dokumenUmum->deskripsi_dokumen }}"
                                                    data-tanggal="{{ $dokumenUmum->tanggal_berlaku }}"
                                                    title="Edit">
                                                        <i class="bi bi-pencil-fill fs-4"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-icon btn-danger btn-delete-dokumen" data-id="{{ $dokumenUmum->id }}" title="Hapus">
                                                        <i class="bi bi-trash-fill fs-4"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty-state">
                                                    <i class="bi bi-folder2-open"></i>
                                                    <p>Belum ada dokumen umum tersedia</p>
                                                    <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modalAddDokumen" data-kategori="umum">
                                                        <i class="bi bi-plus-circle me-1"></i>
                                                        Tambah Dokumen Umum
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Dokumen Auditor -->
                    <div class="tab-pane fade " id="tab_auditor" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-4 table-dokumen">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-50px rounded-start">No</th>
                                        <th class="min-w-200px">Nama Dokumen</th>
                                        <th class="min-w-150px">Deskripsi</th>
                                        <th class="min-w-125px">Tanggal Berlaku</th>
                                        <th class="min-w-125px">Ukuran</th>
                                        <th class="min-w-150px text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dokumenAuditors && count($dokumenAuditors) > 0)
                                        @foreach ($dokumenAuditors as $dokumenAuditor)
                                            <tr class="dokumen-item">
                                                <td class="ps-4">1</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper pdf me-3">
                                                            <i class="bi bi-file-earmark-pdf text-danger fs-2"></i>
                                                        </div>
                                                        <div>
                                                            <span class="fw-bold d-block fs-6">{{ $dokumenAuditor->nama_dokumen }}</span>
                                                            <span class="badge badge-light-primary">Auditor</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $dokumenAuditor->deskripsi_dokumen }}</td>
                                                <td>{{ \Carbon\Carbon::parse($dokumenAuditor->tanggal_berlaku)->format('d M Y') }}</td>
                                                <td>{{ formatSizeUnits($dokumenAuditor->size_dokumen) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $dokumenAuditor->file_dokumen) }}" target="_blank" class="btn btn-sm btn-icon btn-primary me-2" title="Lihat">
                                                        <i class="bi bi-eye-fill fs-4"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-icon btn-warning me-2 btn-edit-dokumen"
                                                    data-id="{{ $dokumenAuditor->id }}"
                                                    data-nama="{{ $dokumenAuditor->nama_dokumen }}"
                                                    data-kategori="{{ $dokumenAuditor->kategori_dokumen }}"
                                                    data-deskripsi="{{ $dokumenAuditor->deskripsi_dokumen }}"
                                                    data-tanggal="{{ $dokumenAuditor->tanggal_berlaku }}"
                                                    title="Edit">
                                                        <i class="bi bi-pencil-fill fs-4"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-icon btn-danger btn-delete-dokumen" data-id="{{ $dokumenAuditor->id }}" title="Hapus">
                                                        <i class="bi bi-trash-fill fs-4"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty-state">
                                                    <i class="bi bi-folder2-open"></i>
                                                    <p>Belum ada dokumen auditor tersedia</p>
                                                    <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modalAddDokumen" data-kategori="auditor">
                                                        <i class="bi bi-plus-circle me-1"></i>
                                                        Tambah Dokumen Auditor
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Dokumen Auditee -->
                    <div class="tab-pane fade" id="tab_auditee" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-4 table-dokumen">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-50px rounded-start">No</th>
                                        <th class="min-w-200px">Nama Dokumen</th>
                                        <th class="min-w-150px">Deskripsi</th>
                                        <th class="min-w-125px">Tanggal Berlaku</th>
                                        <th class="min-w-125px">Ukuran</th>
                                        <th class="min-w-150px text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dokumenAuditees && count($dokumenAuditees) > 0)
                                        @foreach ($dokumenAuditees as $dokumenAuditee)
                                            <tr class="dokumen-item">
                                                <td class="ps-4">1</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper doc me-3">
                                                            <i class="bi bi-file-earmark-word text-primary fs-2"></i>
                                                        </div>
                                                        <div>
                                                            <span class="fw-bold d-block fs-6">{{ $dokumenAuditee->nama_dokumen }}</span>
                                                            <span class="badge badge-light-info">Auditee</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $dokumenAuditee->deskripsi_dokumen }}</td>
                                                <td>{{ \Carbon\Carbon::parse($dokumenAuditee->tanggal_berlaku)->format('d M Y') }}</td>
                                                <td>{{ formatSizeUnits($dokumenAuditee->size_dokumen) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $dokumenAuditee->file_dokumen) }}" target="_blank" class="btn btn-sm btn-icon btn-primary me-2" title="Lihat">
                                                        <i class="bi bi-eye-fill fs-4"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-icon btn-warning me-2 btn-edit-dokumen"
                                                    data-id="{{ $dokumenAuditee->id }}"
                                                    data-nama="{{ $dokumenAuditee->nama_dokumen }}"
                                                    data-kategori="{{ $dokumenAuditee->kategori_dokumen }}"
                                                    data-deskripsi="{{ $dokumenAuditee->deskripsi_dokumen }}"
                                                    data-tanggal="{{ $dokumenAuditee->tanggal_berlaku }}"
                                                    title="Edit">
                                                        <i class="bi bi-pencil-fill fs-4"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-icon btn-danger btn-delete-dokumen" data-id="{{ $dokumenAuditee->id }}" title="Hapus">
                                                        <i class="bi bi-trash-fill fs-4"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty-state">
                                                    <i class="bi bi-folder2-open"></i>
                                                    <p>Belum ada dokumen auditee tersedia</p>
                                                    <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modalAddDokumen" data-kategori="auditee">
                                                        <i class="bi bi-plus-circle me-1"></i>
                                                        Tambah Dokumen Auditee
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Dokumen -->
<div class="modal fade" id="modalAddDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formAddDokumen" action="{{ route('dokumenAmi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_dokumen" class="form-label required">Nama Dokumen</label>
                        <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="Masukkan nama dokumen" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="kategori_dokumen" class="form-label required">Kategori Dokumen</label>
                        <select class="form-select" id="kategori_dokumen" name="kategori_dokumen" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="auditor">Dokumen Khusus Auditor</option>
                            <option value="auditee">Dokumen Khusus Auditee</option>
                            <option value="umum">Dokumen Untuk Umum</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="deskripsi_dokumen" class="form-label">Deskripsi Dokumen</label>
                        <textarea class="form-control" id="deskripsi_dokumen" name="deskripsi_dokumen" rows="3" placeholder="Masukkan deskripsi dokumen"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="tanggal_berlaku" class="form-label required">Tanggal Berlaku</label>
                        <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label required">File Dokumen</label>
                        <div class="file-upload-wrapper">
                            <div class="custom-file-upload" id="dropzone">
                                <i class="bi bi-cloud-arrow-up fs-3x text-primary mb-3"></i>
                                <h3 class="fs-4 fw-bold mb-2">Tarik dan Lepas File di Sini</h3>
                                <p class="text-gray-600 mb-3">atau</p>
                                <button type="button" id="browseFilesBtn" class="btn btn-sm btn-primary">
                                    <i class="bi bi-folder2-open me-2"></i>Pilih File
                                </button>
                                <input type="file" name="file_dokumen[]" id="fileInput" style="display: none;" required multiple>
                                <p class="text-gray-500 mt-3 mb-0">
                                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Maks. 1MB)</small>
                                </p>
                            </div>
                            <div id="filePreviewContainer" class="mb-3">
                                <!-- File previews akan ditampilkan di sini -->
                            </div>

                            <!-- Dan tambahkan tombol untuk menghapus semua file jika diperlukan -->
                            <button type="button" id="removeAllFiles" class="btn btn-sm btn-light-danger d-none">
                                <i class="bi bi-trash me-1"></i> Hapus Semua File
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <span class="indicator-label">
                            <i class="bi bi-save me-2"></i>Simpan
                        </span>
                        <span class="indicator-progress">
                            Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Dokumen -->
<div class="modal fade" id="modalEditDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formEditDokumen" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Dokumen AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="edit_nama_dokumen" class="form-label required">Nama Dokumen</label>
                        <input type="text" class="form-control" id="edit_nama_dokumen" name="nama_dokumen" placeholder="Masukkan nama dokumen" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="edit_kategori_dokumen" class="form-label required">Kategori Dokumen</label>
                        <select class="form-select" id="edit_kategori_dokumen" name="kategori_dokumen" required>
                            <option value="auditor">Dokumen Auditor</option>
                            <option value="auditee">Dokumen Auditee</option>
                            <option value="umum">Dokumen Umum</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="edit_deskripsi_dokumen" class="form-label">Deskripsi Dokumen</label>
                        <textarea class="form-control" id="edit_deskripsi_dokumen" name="deskripsi_dokumen" rows="3" placeholder="Masukkan deskripsi dokumen"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="edit_tanggal_berlaku" class="form-label required">Tanggal Berlaku</label>
                        <input type="date" class="form-control" id="edit_tanggal_berlaku" name="tanggal_berlaku" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">File Dokumen (Opsional)</label>
                        <p class="text-muted fs-7 mb-2">Biarkan kosong jika tidak ingin mengubah file</p>
                        <div class="file-upload-wrapper">
                            <div class="custom-file-upload" id="edit_dropzone">
                                <i class="bi bi-cloud-arrow-up fs-3x text-primary mb-3"></i>
                                <h3 class="fs-4 fw-bold mb-2">Tarik dan Lepas File di Sini</h3>
                                <p class="text-gray-600 mb-3">atau</p>
                                <button type="button" id="edit_browseFilesBtn" class="btn btn-sm btn-primary">
                                    <i class="bi bi-folder2-open me-2"></i>Pilih File
                                </button>
                                <input type="file" name="file_dokumen" id="edit_fileInput" style="display: none;">
                                <p class="text-gray-500 mt-3 mb-0">
                                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Maks. 1MB)</small>
                                </p>
                            </div>
                            <div id="edit_filePreview" class="mt-3" style="display: none;">
                                <div class="file-item p-3 bg-light-primary rounded d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark fs-2 text-primary me-3"></i>
                                        <div>
                                            <span id="edit_fileName" class="d-block fw-bold"></span>
                                            <span id="edit_fileSize" class="text-muted fs-7"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="edit_removeFile" class="btn btn-sm btn-icon btn-light-danger">
                                        <i class="bi bi-x-circle fs-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnEditSubmit">
                        <span class="indicator-label">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </span>
                        <span class="indicator-progress">
                            Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Initialize dropzone and file handling
            const dropzone = document.getElementById('dropzone');

            // Clean up any existing event listeners
            const newDropzone = dropzone.cloneNode(true);
            dropzone.parentNode.replaceChild(newDropzone, dropzone);
            const cleanDropzone = document.getElementById('dropzone');

            // Flag to prevent duplicate event listeners
            let dropEventHandled = false;
            let filePickerTimeout;

            // File size validation (1MB - 1KB = 1023KB)
            const MAX_FILE_SIZE = 1023 * 1024;
            // Allowed file types
            const ALLOWED_TYPES = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'image/jpeg',
                'image/png'
            ];

            // Toastr configuration
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Tab switching animation
            function activateTabFromHash() {
                let hash = window.location.hash;
                if (hash) {
                    // Mencari tab yang sesuai dengan hash dan menampilkannya
                    $('.dokumen-tabs .nav-link[href="' + hash + '"]').tab('show');

                    // Menambahkan class untuk menampilkan tab
                    $('.tab-pane').removeClass('show active');
                    $(hash).addClass('show active');
                }
            }

            // Menangani klik pada tab
            $('.dokumen-tabs .nav-link').on('click', function() {
                const target = $(this).attr('href');

                // Animasi fade pada tab
                $('.tab-pane').removeClass('show active');
                setTimeout(function() {
                    $(target).addClass('show active');
                }, 150);

                // Memperbarui URL dengan hash - perubahan penting di sini
                window.history.pushState(null, null, window.location.pathname + target);
            });

            // Mengaktifkan tab yang benar saat halaman pertama kali dimuat
            activateTabFromHash();

            // Menangani navigasi tombol kembali/maju pada browser
            window.addEventListener('popstate', function() {
                activateTabFromHash();
            });

            // Add Document Modal Functionality
            $('#modalAddDokumen').on('shown.bs.modal', function(e) {
                // Check if the button has a category data attribute
                const button = $(e.relatedTarget);
                if (button.data('kategori')) {
                    $('#kategori_dokumen').val(button.data('kategori'));
                }

                // Set today's date as default
                const today = new Date().toISOString().split('T')[0];
                $('#tanggal_berlaku').val(today);
            });

            // Browse files button
            $('#browseFilesBtn').on('click', function() {
                if (dropEventHandled) return;
                dropEventHandled = true;

                // Reset flag after 1 second
                clearTimeout(filePickerTimeout);
                filePickerTimeout = setTimeout(() => {
                    dropEventHandled = false;
                }, 1000);

                $('#fileInput').click();
            });

            // Handle file selection change
            $('#fileInput').on('change', function() {
                const files = this.files;

                if (files.length > 0) {
                    // Reset preview area
                    $('#filePreviewContainer').empty();
                    $('#removeAllFiles').removeClass('d-none');

                    // Loop melalui semua file yang dipilih
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        // Validasi file type
                        if (!ALLOWED_TYPES.includes(file.type)) {
                            toastr.error(`File "${file.name}" tidak didukung. Hanya file PDF, DOC, DOCX, XLS, XLSX, JPG, dan PNG yang diizinkan.`);
                            continue;
                        }

                        // Validasi file size
                        if (file.size > MAX_FILE_SIZE) {
                            toastr.error(`File "${file.name}" terlalu besar. Ukuran maksimum adalah 1MB.`);
                            continue;
                        }

                        // Tambahkan file ke preview
                        addFilePreview(file, i);
                    }
                } else {
                    $('#filePreviewContainer').empty();
                    $('#removeAllFiles').addClass('d-none');
                }
            });

            // Fungsi untuk menambahkan preview file
            function addFilePreview(file, index) {
                // Get file extension
                const extension = file.name.split('.').pop().toLowerCase();
                let iconClass = 'bi-file-earmark-text';

                // Set icon based on file type
                if (file.type.includes('pdf')) {
                    iconClass = 'bi-file-earmark-pdf text-danger';
                } else if (file.type.includes('word')) {
                    iconClass = 'bi-file-earmark-word text-primary';
                } else if (file.type.includes('excel')) {
                    iconClass = 'bi-file-earmark-excel text-success';
                } else if (file.type.includes('image')) {
                    iconClass = 'bi-file-earmark-image text-warning';
                }

                // Create file preview element
                const previewElement = `
                <div class="file-preview-item mb-3" data-index="${index}">
                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-3">
                        <div class="me-3">
                            <i class="bi ${iconClass} fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="fw-bold d-block fs-6">${file.name}</span>
                            <span class="text-muted fs-7">${formatFileSize(file.size)}</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger remove-file" data-index="${index}">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>`;

                // Append to preview container
                $('#filePreviewContainer').append(previewElement);
            }

            $(document).on('click', '.remove-file', function() {
                const index = parseInt($(this).data('index'));

                // Hapus dari UI
                $(`.file-preview-item[data-index="${index}"]`).remove();

                // Hapus dari FileList
                const dt = new DataTransfer();
                const input = document.getElementById('fileInput');
                const { files } = input;

                for (let i = 0; i < files.length; i++) {
                    // Tambahkan semua file kecuali yang dihapus
                    if (i !== index) {
                        dt.items.add(files[i]);
                    }
                }

                // Tetapkan kembali file yang tersisa ke input
                input.files = dt.files;

                // Update data-index pada item yang tersisa
                updateFileIndexes();

                // Jika tidak ada file yang tersisa, sembunyikan tombol hapus semua
                if (dt.files.length === 0) {
                    $('#removeAllFiles').addClass('d-none');
                }
            });

            // Fungsi untuk memperbarui indeks file setelah penghapusan
            function updateFileIndexes() {
                $('.file-preview-item').each(function(newIndex) {
                    $(this).attr('data-index', newIndex);
                    $(this).find('.remove-file').attr('data-index', newIndex);
                });
            }

            // Tombol Hapus Semua File
            $('#removeAllFiles').on('click', function() {
                $('#fileInput').val('');
                $('#filePreviewContainer').empty();
                $(this).addClass('d-none');
            });

            // Ubah handler untuk drag and drop
            dropzone.addEventListener('drop', function(e) {
                if (dropEventHandled) return;
                dropEventHandled = true;

                // Reset flag after 1 second
                clearTimeout(filePickerTimeout);
                filePickerTimeout = setTimeout(() => {
                    dropEventHandled = false;
                }, 1000);

                const files = e.dataTransfer.files;

                if (files.length > 0) {
                    // Reset preview area for clarity
                    $('#filePreviewContainer').empty();
                    $('#removeAllFiles').removeClass('d-none');

                    // Create a DataTransfer object to store valid files
                    const dt = new DataTransfer();
                    let validFilesCount = 0;

                    // Loop through dropped files
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        // Validate file
                        if (!ALLOWED_TYPES.includes(file.type)) {
                            toastr.error(`File "${file.name}" tidak didukung. Hanya file PDF, DOC, DOCX, XLS, XLSX, JPG, dan PNG yang diizinkan.`);
                            continue;
                        }

                        if (file.size > MAX_FILE_SIZE) {
                            toastr.error(`File "${file.name}" terlalu besar. Ukuran maksimum adalah 1MB.`);
                            continue;
                        }

                        // Add valid file to DataTransfer object
                        dt.items.add(file);

                        // Add to preview with the correct index
                        addFilePreview(file, validFilesCount);
                        validFilesCount++;
                    }

                    // Set files to input if there are valid files
                    if (validFilesCount > 0) {
                        document.querySelector('#fileInput').files = dt.files;
                    } else {
                        $('#removeAllFiles').addClass('d-none');
                    }
                }
            }, false);

            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Prevent defaults for drag events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight dropzone on drag
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzone.classList.add('border-primary');
                dropzone.classList.add('bg-light-primary');
            }

            function unhighlight() {
                dropzone.classList.remove('border-primary');
                dropzone.classList.remove('bg-light-primary');
            }

            // Handle dropped files
            dropzone.addEventListener('drop', function(e) {
                if (dropEventHandled) return;
                dropEventHandled = true;

                // Reset flag after 1 second
                clearTimeout(filePickerTimeout);
                filePickerTimeout = setTimeout(() => {
                    dropEventHandled = false;
                }, 1000);

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0]; // Accept only the first file

                    // Validate file
                    if (!ALLOWED_TYPES.includes(file.type)) {
                        toastr.error(`File "${file.name}" tidak didukung. Hanya file PDF, DOC, DOCX, XLS, XLSX, JPG, dan PNG yang diizinkan.`);
                        return;
                    }

                    if (file.size > MAX_FILE_SIZE) {
                        toastr.error(`File "${file.name}" terlalu besar. Ukuran maksimum adalah 1MB.`);
                        return;
                    }

                    // Set file to input
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.querySelector('#fileInput').files = dataTransfer.files;

                    // Show preview
                    showFilePreview(file);
                }
            }, false);

            // Form add document validation and submission
            $('#formAddDokumen').on('submit', function(e) {
                e.preventDefault();

                // Button loading state
                const submitBtn = $(this).find('#btnSubmit');
                submitBtn.attr('data-kt-indicator', 'on');
                submitBtn.prop('disabled', true);

                // FormData for AJAX
                const formData = new FormData(this);

                // AJAX submission
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Dokumen AMI berhasil ditambahkan.',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        }).then(function() {
                            // Reload page after successful addition
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Show error message
                        let errorMessage = 'Terjadi kesalahan saat menambahkan dokumen.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    },
                    complete: function() {
                        // Reset loading state
                        submitBtn.attr('data-kt-indicator', 'off');
                        submitBtn.prop('disabled', false);
                    }
                });
            });

            // Edit document functionality
            $(document).on('click', '.btn-edit-dokumen', function (e) {
                e.preventDefault(); // <<== Tambahkan ini!
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const kategori = $(this).data('kategori');
                const deskripsi = $(this).data('deskripsi');
                const tanggal = $(this).data('tanggal');

                // Set values in form
                $('#edit_id').val(id);
                $('#edit_nama_dokumen').val(nama);
                $('#edit_kategori_dokumen').val(kategori);
                $('#edit_deskripsi_dokumen').val(deskripsi);
                $('#edit_tanggal_berlaku').val(tanggal_berlaku);

                // Reset file input and preview
                $('#edit_fileInput').val('');
                $('#edit_filePreview').hide();

                // Show modal
                $('#modalEditDokumen').modal('show');
            });

            // Edit document file functionality
            $('#edit_browseFilesBtn').on('click', function() {
                $('#edit_fileInput').click();
            });

            $('#edit_fileInput').on('change', function() {
                const file = this.files[0];

                if (file) {
                    // Validate file
                    if (!ALLOWED_TYPES.includes(file.type)) {
                        toastr.error(`File "${file.name}" tidak didukung. Hanya file PDF, DOC, DOCX, XLS, XLSX, JPG, dan PNG yang diizinkan.`);
                        this.value = '';
                        return;
                    }

                    if (file.size > MAX_FILE_SIZE) {
                        toastr.error(`File "${file.name}" terlalu besar. Ukuran maksimum adalah 1MB.`);
                        this.value = '';
                        return;
                    }

                    // Show file preview
                    $('#edit_fileName').text(file.name);
                    $('#edit_fileSize').text(formatFileSize(file.size));
                    $('#edit_filePreview').show();
                }
            });

            $('#edit_removeFile').on('click', function() {
                $('#edit_fileInput').val('');
                $('#edit_filePreview').hide();
            });

            // Edit form submission
            $('#formEditDokumen').on('submit', function(e) {
                e.preventDefault();

                // Button loading state
                const submitBtn = $(this).find('#btnEditSubmit');
                submitBtn.attr('data-kt-indicator', 'on');
                submitBtn.prop('disabled', true);

                // FormData for AJAX
                const formData = new FormData(this);

                // AJAX submission
                $.ajax({
                    url: '/dokumen-ami/' + $('#edit_id').val()+'/update',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Dokumen AMI berhasil diperbarui.',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        }).then(function() {
                            // Reload page after successful update
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Show error message
                        let errorMessage = 'Terjadi kesalahan saat memperbarui dokumen.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    },
                    complete: function() {
                        // Reset loading state
                        submitBtn.attr('data-kt-indicator', 'off');
                        submitBtn.prop('disabled', false);
                    }
                });
            });

            // Delete document functionality
            $('.btn-delete-dokumen').on('click', function() {
                const id = $(this).data('id');
                console.log('Delete button clicked for ID:', id);

                // Check if CSRF token is available
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                if (!csrfToken) {
                    console.error('CSRF token not found');
                    Swal.fire({
                        title: 'Error!',
                        text: 'CSRF token tidak ditemukan. Silakan refresh halaman.',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus dokumen ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary me-3'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Delete confirmed, sending AJAX request to:', '/dokumen-ami/' + id);

                        // AJAX delete request
                        $.ajax({
                            url: '/dokumen-ami/' + id,
                            method: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Delete successful:', response);
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Dokumen AMI berhasil dihapus.',
                                    icon: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    }
                                }).then(function() {
                                    // Reload page after successful deletion
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Delete failed:', xhr, status, error);
                                // Show error message
                                let errorMessage = 'Terjadi kesalahan saat menghapus dokumen.';

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    title: 'Error!',
                                    text: errorMessage,
                                    icon: 'error',
                                    buttonsStyling: false,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    }
                                });
                            }
                        });
                    }
                });
            });

            // Add hover effects to document items
            $('.dokumen-item').hover(
                function() {
                    $(this).addClass('bg-light-primary');
                    $(this).find('.btn').addClass('btn-active');
                },
                function() {
                    $(this).removeClass('bg-light-primary');
                    $(this).find('.btn').removeClass('btn-active');
                }
            );

            // Add tooltips to action buttons
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    {{-- Include File Viewer Modal --}}

@endpush
