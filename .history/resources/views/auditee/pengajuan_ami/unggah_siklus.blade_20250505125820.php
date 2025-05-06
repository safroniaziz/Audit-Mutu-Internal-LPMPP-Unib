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
    </style>
@endpush
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                <div class="me-4">
                    <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">📢 Informasi Penting</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>Catatan:</strong>
                            <span class="text-gray-800">
                                Silakan unggah siklus AMI di bawah ini secara menyeluruh
                                untuk menyelesaikan proses pengajuan <strong>Instrumen Audit</strong>.
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="row">
                <!-- Kolom Kiri: Form Upload -->
                <div class="col-lg-6">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="upload_files_tab" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Unggah Dokumen Siklus AMI</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">Silakan unggah dokumen siklus AMI yang diperlukan</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form id="uploadFilesForm" action="{{ route('auditee.uploadFiles') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                                        <div class="mb-5">
                                            @if($siklus->is_disetujui)
                                                <div class="alert alert-info">
                                                    <strong>Informasi:</strong> Pengajuan Anda telah disetujui dan tidak dapat mengunggah dokumen lagi.
                                                </div>
                                            @else
                                                <div class="file-upload-wrapper">
                                                    <div class="custom-file-upload" id="dropzone">
                                                        <i class="bi bi-cloud-arrow-up fs-3x text-primary mb-3"></i>
                                                        <h3 class="fs-4 fw-bold mb-2">Tarik dan Lepas File di Sini</h3>
                                                        <p class="text-gray-600 mb-3">atau</p>
                                                        <button type="button" id="browseFilesBtn" class="btn btn-sm btn-primary" @if($siklus->is_desetujui) disabled @endif>
                                                            <i class="bi bi-folder2-open me-2"></i>Pilih File
                                                        </button>
                                                        <input type="file" name="files[]" id="fileInput" multiple style="display: none;" @if($siklus->is_desetujui) disabled @endif>
                                                        <p class="text-gray-500 mt-3 mb-0">
                                                            <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Maks. 10MB per file)</small>
                                                        </p>
                                                    </div>
                                                    <div class="file-list" id="fileList">
                                                        <!-- File items will be generated here -->
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" id="submitBtn" class="btn btn-primary" disabled>
                                                <span class="indicator-label">
                                                    <i class="bi bi-cloud-upload me-2"></i>Unggah Dokumen
                                                </span>
                                                <span class="indicator-progress">
                                                    Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Tabel File yang Sudah Diupload -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Daftar File yang Sudah Diupload</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Berikut adalah file yang telah Anda unggah</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siklus->siklus as $index => $file)
                                    <tr>
                                        <td>{{ $file->nama_berkas }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                Lihat
                                            </a>
                                            @if(!$siklus->is_disetujui)
                                                <form action="{{ route('auditee.file.delete', $file->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            @else
                                                <span class="text-muted ms-2">Pengajuan telah disetujui, file tidak dapat dihapus.</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::details View-->
@endsection

@push('scripts')
    <script>

    </script>
@endpush
