@extends('auditee.dashboard2')

@push('style')
    <style>
        .upload-area {
            border: 2px dashed #009ef7;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: #f1faff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            background: #e1f0ff;
        }

        .upload-icon {
            font-size: 48px;
            color: #009ef7;
            margin-bottom: 15px;
        }

        .file-info {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        .progress-wrapper {
            margin-top: 20px;
            display: none;
        }

        .progress {
            height: 8px;
            margin-bottom: 10px;
        }

        .custom-file-upload {
            border: 2px dashed #009ef7;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            background: #f1faff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            background: #e1f0ff;
        }

        .file-list {
            margin-top: 20px;
        }

        .file-item {
            background: #ffffff;
            border: 1px solid #e4e6ef;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .file-progress {
            height: 6px;
            background-color: #e4e6ef;
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }

        .file-progress-bar {
            height: 100%;
            background-color: #009ef7;
            border-radius: 3px;
            width: 0%;
            transition: width 0.3s;
        }
    </style>
@endpush

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-primary fs-7 fw-bold">Perjanjian Kinerja</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="alert alert-{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'success' : 'danger' }} d-flex align-items-center p-5 mb-10">
                <i class="bi {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger' }} fs-2hx me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'success' : 'danger' }}">{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? '✨ Dokumen Telah Diunggah' : '📢 Unggah Dokumen' }}</h4>
                    <span class="text-{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'success' : 'danger' }}">
                        @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                            Selamat! Dokumen Perjanjian Kinerja program studi Anda telah diunggah. Silakan lanjut ke proses Pemilihan IKSS.
                        @else
                            Silakan unggah dokumen Perjanjian Kinerja program studi Anda. Dokumen ini akan menjadi dasar untuk proses audit mutu internal selanjutnya.
                        @endif
                    </span>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}"
                       class="btn btn-sm btn-success {{ !$perjanjianKinerja || !$perjanjianKinerja->file_path ? 'disabled' : '' }}"
                       @if(!$perjanjianKinerja || !$perjanjianKinerja->file_path)
                       onclick="return false;"
                       style="opacity: 0.5; cursor: not-allowed;"
                       data-bs-toggle="tooltip"
                       data-bs-placement="top"
                       title="Harap unggah Perjanjian Kinerja terlebih dahulu"
                       @endif
                    >
                        <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8">
                    @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                        <div class="text-center mb-10">
                            <div class="file-info p-8">
                                <i class="bi bi-file-earmark-check text-success fs-2hx mb-5"></i>
                                <h3 class="fs-2 fw-bold mb-3">Dokumen Telah Diunggah</h3>
                                <p class="text-gray-600 mb-5">Dokumen terakhir diunggah pada: {{ $perjanjianKinerja->uploaded_at->format('d F Y H:i') }}</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ Storage::url($perjanjianKinerja->file_path) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="bi bi-eye me-2"></i>Lihat Dokumen
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light" id="uploadNewBtn">
                                        <i class="bi bi-arrow-repeat me-2"></i>Unggah Ulang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="uploadForm" class="form {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'd-none' : '' }}" action="{{ route('auditee.pengajuanAmi.uploadPerjanjianKinerja') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file-upload" id="dropZone">
                            <input type="file" name="file_perjanjian" id="fileInput" class="d-none" accept=".pdf,.doc,.docx">
                            <i class="bi bi-cloud-arrow-up fs-3x text-primary mb-3"></i>
                            <h3 class="fs-4 fw-bold mb-2">Tarik dan Lepas File di Sini</h3>
                            <p class="text-gray-600 mb-3">atau</p>
                            <button type="button" id="browseFilesBtn" class="btn btn-sm btn-primary">
                                <i class="bi bi-folder2-open me-2"></i>Pilih File
                            </button>
                            <p class="text-gray-500 mt-3 mb-0">
                                <small>Format yang didukung: PDF, DOC, DOCX (Maks. 10MB)</small>
                            </p>
                        </div>

                        <div class="file-list" id="fileList">
                            <!-- File items will be generated here -->
                        </div>

                        <div class="text-end mt-4">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const dropZone = $('#dropZone');
        const fileInput = $('#fileInput');
        const uploadForm = $('#uploadForm');
        const submitBtn = $('#submitBtn');
        const uploadNewBtn = $('#uploadNewBtn');
        const fileList = $('#fileList');

        // Handle drag and drop
        dropZone.on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('border-primary');
        });

        dropZone.on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('border-primary');
        });

        dropZone.on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('border-primary');
            const files = e.originalEvent.dataTransfer.files;
            handleFiles(files);
        });

        // Handle click upload
        $('#browseFilesBtn').on('click', function() {
            fileInput.click();
        });

        fileInput.on('change', function() {
            handleFiles(this.files);
        });

        uploadNewBtn.on('click', function() {
            uploadForm.removeClass('d-none');
            uploadNewBtn.closest('.file-info').parent().addClass('d-none');
        });

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const maxSize = 10 * 1024 * 1024; // 10MB

                if (!allowedTypes.includes(file.type)) {
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

                if (file.size > maxSize) {
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
                    <div class="file-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                <span class="fw-bold">${file.name}</span>
                                <span class="text-muted ms-2">(${formatFileSize(file.size)})</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger remove-file">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="file-progress">
                            <div class="file-progress-bar"></div>
                        </div>
                    </div>
                `);

                fileList.append(fileItem);
                submitBtn.prop('disabled', false);

                // Handle remove file
                fileItem.find('.remove-file').on('click', function() {
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
            const formData = new FormData(this);

            submitBtn.prop('disabled', true)
                    .find('.indicator-label').hide()
                    .end()
                    .find('.indicator-progress').show();

            const fileItem = fileList.find('.file-item');
            const progressBar = fileItem.find('.file-progress-bar');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            progressBar.css('width', percent + '%');
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
                            text: response.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat mengunggah file.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
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
                },
                complete: function() {
                    submitBtn.find('.indicator-progress').hide()
                            .end()
                            .find('.indicator-label').show();
                }
            });
        });
    });
</script>
@endpush
