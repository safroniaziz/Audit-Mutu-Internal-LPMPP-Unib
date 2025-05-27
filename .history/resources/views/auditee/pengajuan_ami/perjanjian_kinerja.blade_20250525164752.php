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

        /* Disabled state styling */
        .upload-disabled {
            position: relative;
        }

        .upload-disabled::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
            border-radius: 5px;
        }

        .upload-disabled-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            background: #fff8dd;
            padding: 1rem;
            border-radius: 5px;
            border: 1px solid #ffa800;
            text-align: center;
            width: 80%;
        }

        .uploaded-file-info {
            background: #E8FFF3;
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .uploaded-file-info .icon {
            font-size: 3rem;
            color: #50CD89;
            margin-bottom: 1rem;
        }

        .uploaded-file-info .btn-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .uploaded-file-info .btn-group .btn {
            min-width: 120px;
        }
    </style>
@endpush

@section('dashboardProfile')
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
            <div class="alert {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'alert-success' : 'alert-info' }} d-flex align-items-start p-5 mb-10 position-relative">
                <div class="me-4">
                    <i class="bi {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'bi-check-circle-fill fs-2 text-success' : 'bi-info-circle-fill fs-2 text-primary' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? '✨ Dokumen Telah Diunggah' : '📢 Unggah Dokumen' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'Selamat!' : 'Catatan:' }}</strong>
                            <span class="fw-semibold {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'text-success' : 'text-danger' }}">
                                @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                                    Dokumen Perjanjian Kinerja program studi Anda telah diunggah. Silakan lanjut ke proses Pemilihan IKSS.
                                @else
                                    Silakan unggah dokumen Perjanjian Kinerja program studi Anda. Dokumen ini akan menjadi dasar untuk proses audit mutu internal selanjutnya.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
                @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                <div class="ms-auto">
                    <a href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}" class="btn btn-sm btn-success px-4">
                        <i class="fas fa-arrow-right me-2"></i>Proses Selanjutnya
                    </a>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                        <div class="uploaded-file-info mb-8">
                            <i class="bi bi-file-earmark-check icon"></i>
                            <h3 class="fs-2 fw-bold mb-3">Dokumen Telah Diunggah</h3>
                            <p class="text-gray-600 mb-5">
                                Nama File: {{ $perjanjianKinerja->nama_file }}<br>
                                Ukuran: {{ number_format($perjanjianKinerja->size / 1024, 2) }} KB
                            </p>
                            <div class="btn-group">
                                <a href="{{ Storage::url($perjanjianKinerja->file_path) }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="bi bi-eye me-2"></i>Lihat Dokumen
                                </a>
                                @if($perjanjianKinerja)
                                <button type="button" class="btn btn-sm btn-danger" id="deleteFileBtn">
                                    <i class="bi bi-trash me-2"></i>Hapus Dokumen
                                </button>
                                @endif
                            </div>
                        </div>
                    @endif

                    <form id="uploadForm" class="form" action="{{ route('auditee.pengajuanAmi.uploadPerjanjianKinerja') }}" method="POST" enctype="multipart/form-data" {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'style=display:none' : '' }}>
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
        const fileList = $('#fileList');

        // Browse files button
        $('#browseFilesBtn').on('click', function() {
            if (!$(this).prop('disabled')) {
                fileInput.click();
            }
        });

        // Handle file selection change
        fileInput.on('change', function(e) {
            handleFiles(e.target.files);
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
            if (!$(this).closest('.upload-disabled').length) {
                $(this).addClass('border-primary');
            }
        });

        dropzone.on('dragleave drop', function() {
            $(this).removeClass('border-primary');
        });

        dropzone.on('drop', function(e) {
            if (!$(this).closest('.upload-disabled').length) {
                const files = e.originalEvent.dataTransfer.files;
                handleFiles(files);
            }
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
                    <div class="file-item">
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

            const file = fileInput[0].files[0];

            if (!file) {
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

            const formData = new FormData(this);

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
                            title: "Berhasil!",
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
                        title: "Gagal!",
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

        // Handle delete file
        $('#deleteFileBtn').on('click', function() {
            @if(!$perjanjianKinerja)
                Swal.fire({
                    title: 'Error',
                    text: 'Tidak ada file untuk dihapus',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                return;
            @endif

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "File yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: @if($perjanjianKinerja) "{{ route('auditee.perjanjian-kinerja.destroy', ['perjanjianKinerja' => $perjanjianKinerja->id]) }}" @else "#" @endif,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menghapus file.';
                            if (xhr.responseJSON) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: 'Gagal!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
