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
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Data Dokumen AMI</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Kelola dokumen Audit Mutu Internal</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddDokumen">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Dokumen
                    </button>
                </div>
            </div>

            <div class="card-body pt-0">
                <!-- Document Tabs -->
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 dokumen-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab_auditor">
                            <i class="bi bi-person-check fs-4 me-1"></i>
                            Dokumen Auditor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab_auditee">
                            <i class="bi bi-people fs-4 me-1"></i>
                            Dokumen Auditee
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab_umum">
                            <i class="bi bi-file-earmark-text fs-4 me-1"></i>
                            Dokumen Umum
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content" id="myTabContent">
                    <!-- Dokumen Auditor -->
                    <div class="tab-pane fade show active" id="tab_auditor" role="tabpanel">
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
                                    @if($dokumenAuditor && count([$dokumenAuditor]) > 0)
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
                                                <a href="#" class="btn btn-sm btn-icon btn-warning me-2 btn-edit-dokumen"
                                                   data-id="{{ $dokumenAuditor->id }}"
                                                   data-nama="{{ $dokumenAuditor->nama_dokumen }}"
                                                   data-kategori="{{ $dokumenAuditor->kategori_dokumen }}"
                                                   data-deskripsi="{{ $dokumenAuditor->deskripsi_dokumen }}"
                                                   data-tanggal="{{ $dokumenAuditor->tanggal_berlaku }}"
                                                   title="Edit">
                                                    <i class="bi bi-pencil-fill fs-4"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-icon btn-danger btn-delete-dokumen" data-id="{{ $dokumenAuditor->id }}" title="Hapus">
                                                    <i class="bi bi-trash-fill fs-4"></i>
                                                </a>
                                            </td>
                                        </tr>
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
                                    @if($dokumenAuditee && count([$dokumenAuditee]) > 0)
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

                    <!-- Dokumen Umum -->
                    <div class="tab-pane fade" id="tab_umum" role="tabpanel">
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
                                    @if($dokumenUmum && count([$dokumenUmum]) > 0)
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Dokumen -->
<div class="modal fade" id="modalAddDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formAddDokumen" action="{{ route('dokumen-ami.store') }}" method="POST" enctype="multipart/form-data">
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
                            <option value="">Pilih Kategori</option>
                            <option value="auditor">Dokumen Auditor</option>
                            <option value="auditee">Dokumen Auditee</option>
                            <option value="umum">Dokumen Umum</option>
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
                                <input type="file" name="file_dokumen" id="fileInput" style="display: none;" required>
                                <p class="text-gray-500 mt-3 mb-0">
                                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Maks. 10MB)</small>
                                </p>
                            </div>
                            <div id="filePreview" class="mt-3" style="display: none;">
                                <div class="file-item p-3 bg-light-primary rounded d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark fs-2 text-primary me-3"></i>
                                        <div>
                                            <span id="fileName" class="d-block fw-bold"></span>
                                            <span id="fileSize" class="text-muted fs-7"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="removeFile" class="btn btn-sm btn-icon btn-light-danger">
                                        <i class="bi bi-x-circle fs-4"></i>
                                    </button>
                                </div>
                            </div>
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
            <form id="formEditDokumen" action="" method="POST" enctype="multipart/form-data">
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
                                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Maks. 10MB)</small>
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
