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
                    👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
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
                                Silakan unggah dokumen Perjanjian Kinerja program studi Anda. Dokumen ini akan menjadi dasar untuk proses audit mutu internal selanjutnya.
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
                                        <span class="card-label fw-bold text-dark">Unggah Perjanjian Kinerja</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">Silakan unggah dokumen Perjanjian Kinerja yang diperlukan</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form id="uploadForm" class="form {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'd-none' : '' }}" action="{{ route('auditee.pengajuanAmi.uploadPerjanjianKinerja') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-5">
                                            <div class="file-upload-wrapper">
                                                <div class="custom-file-upload" id="dropzone">
                                                    <i class="bi bi-cloud-arrow-up fs-3x text-primary mb-3"></i>
                                                    <h3 class="fs-4 fw-bold mb-2">Tarik dan Lepas File di Sini</h3>
                                                    <p class="text-gray-600 mb-3">atau</p>
                                                    <button type="button" id="browseFilesBtn" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-folder2-open me-2"></i>Pilih File
                                                    </button>
                                                    <input type="file" name="file_perjanjian" id="fileInput" style="display: none;" accept=".pdf,.doc,.docx">
                                                    <p class="text-gray-500 mt-3 mb-0">
                                                        <small>Format yang didukung: PDF, DOC, DOCX (Maks. 10MB)</small>
                                                    </p>
                                                </div>
                                                <div class="file-list" id="fileList">
                                                    <!-- File items will be generated here -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" id="submitBtn" class="btn btn-primary btn-sm" disabled>
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

                <!-- Kolom Kanan: File yang Sudah Diupload -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Dokumen yang Sudah Diupload</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Berikut adalah dokumen yang telah Anda unggah</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama File</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ basename($perjanjianKinerja->file_path) }}</td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex">
                                                        <a href="{{ Storage::url($perjanjianKinerja->file_path) }}" target="_blank" class="btn btn-sm btn-primary me-2" title="Lihat File">
                                                            <i class="bi bi-file-earmark-text me-1"></i> Lihat
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" id="uploadNewBtn" title="Ganti File">
                                                            <i class="bi bi-arrow-repeat me-1"></i> Ganti
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-folder2-open fs-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada dokumen yang diunggah</p>
                                </div>
                            @endif
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
        $(document).ready(function() {
            // File size validation (10MB)
            const MAX_FILE_SIZE = 10 * 1024 * 1024;
            // Allowed file types
            const ALLOWED_TYPES = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

            const dropzone = $('#dropzone');
            const fileInput = $('#fileInput');
            const uploadForm = $('#uploadForm');
            const submitBtn = $('#submitBtn');
            const uploadNewBtn = $('#uploadNewBtn');
            const fileList = $('#fileList');

            // Browse files button
            $('#browseFilesBtn').on('click', function() {
                fileInput.click();
            });

            // Handle file selection change
            fileInput.on('change', function(e) {
                handleFiles(e.target.files);
                this.value = ''; // Reset input value for repeated selections
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone[0].addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Handle drag and drop events
            dropzone.on('dragenter dragover', function() {
                $(this).addClass('border-primary');
            });

            dropzone.on('dragleave drop', function() {
                $(this).removeClass('border-primary');
            });

            dropzone.on('drop', function(e) {
                const files = e.originalEvent.dataTransfer.files;
                handleFiles(files);
            });

            // Upload new button
            uploadNewBtn.on('click', function() {
                uploadForm.removeClass('d-none');
                uploadNewBtn.closest('.card').find('.table-responsive').addClass('d-none');
            });

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];

                    // Validate file type
                    if (!ALLOWED_TYPES.includes(file.type)) {
                        Swal.fire({
                            text: "Format file tidak diizinkan. Harap unggah file PDF, DOC, atau DOCX.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    // Validate file size
                    if (file.size > MAX_FILE_SIZE) {
                        Swal.fire({
                            text: "Ukuran file terlalu besar. Maksimal 10MB.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    // Clear previous file list
                    fileList.empty();

                    // Add file item
                    const fileItem = $(`
                        <div class="file-item" data-file-selected="true">
                            <div class="file-name">
                                <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                <span class="fw-bold">${file.name}</span>
                                <span class="text-muted ms-2">(${formatFileSize(file.size)})</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger file-remove">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    `);

                    fileList.append(fileItem);
                    submitBtn.prop('disabled', false);

                    // Handle remove file
                    fileItem.find('.file-remove').on('click', function() {
                        fileItem.remove();
                        fileInput.val('');
                        submitBtn.prop('disabled', true);
                    });
                }
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Handle form submission
            uploadForm.on('submit', function(e) {
                e.preventDefault();

                // Check if file is selected
                const fileSelected = fileList.find('.file-item[data-file-selected="true"]').length > 0;
                if (!fileSelected || !fileInput[0].files || !fileInput[0].files[0]) {
                    Swal.fire({
                        text: "Silakan pilih file terlebih dahulu",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    return;
                }

                const formData = new FormData();
                const file = fileInput[0].files[0];
                formData.append('file_perjanjian', file);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                submitBtn.prop('disabled', true)
                        .find('.indicator-label').hide()
                        .end()
                        .find('.indicator-progress').show();

                const fileItem = fileList.find('.file-item');
                const progressBar = $('<div class="file-progress"><div class="file-progress-bar"></div></div>');
                fileItem.append(progressBar);

                $.ajax({
                    url: uploadForm.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percent = Math.round((e.loaded / e.total) * 100);
                                progressBar.find('.file-progress-bar').css('width', percent + '%');
                            }
                        });
                        return xhr;
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            Swal.fire({
                                text: response.message || 'Terjadi kesalahan saat mengunggah file.',
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            submitBtn.prop('disabled', false)
                                    .find('.indicator-progress').hide()
                                    .end()
                                    .find('.indicator-label').show();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat mengunggah file.';
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            if (xhr.responseJSON.errors && xhr.responseJSON.errors.file_perjanjian) {
                                errorMessage = xhr.responseJSON.errors.file_perjanjian[0];
                            }
                        }
                        Swal.fire({
                            text: errorMessage,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        submitBtn.prop('disabled', false)
                                .find('.indicator-progress').hide()
                                .end()
                                .find('.indicator-label').show();
                    }
                });
            });
        });
    </script>
@endpush
