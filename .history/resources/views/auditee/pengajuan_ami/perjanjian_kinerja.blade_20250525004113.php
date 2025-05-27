@extends('layouts.dashboard2')

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
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Perjanjian Kinerja</h3>
            </div>
        </div>
        <div class="card-body">
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
                        <div class="upload-area" id="dropZone">
                            <input type="file" name="file_perjanjian" id="fileInput" class="d-none" accept=".pdf,.doc,.docx">
                            <i class="bi bi-cloud-arrow-up upload-icon"></i>
                            <h3 class="fs-2 fw-bold mb-3">Unggah Dokumen</h3>
                            <p class="text-gray-600 mb-5">Klik atau seret file ke area ini untuk mengunggah</p>
                            <p class="text-muted fs-7">Format yang diizinkan: PDF, DOC, DOCX (Maks. 10MB)</p>
                        </div>

                        <div class="progress-wrapper">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted fs-7">Sedang mengunggah...</span>
                                <span class="text-muted fs-7" id="progressText">0%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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
        const progressWrapper = $('.progress-wrapper');
        const progressBar = $('.progress-bar');
        const progressText = $('#progressText');
        const uploadNewBtn = $('#uploadNewBtn');

        // Handle drag and drop
        dropZone.on('dragover', function(e) {
            e.preventDefault();
            dropZone.addClass('border-primary');
        });

        dropZone.on('dragleave', function(e) {
            e.preventDefault();
            dropZone.removeClass('border-primary');
        });

        dropZone.on('drop', function(e) {
            e.preventDefault();
            dropZone.removeClass('border-primary');
            const files = e.originalEvent.dataTransfer.files;
            handleFiles(files);
        });

        // Handle click upload
        dropZone.on('click', function() {
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

                uploadFile(file);
            }
        }

        function uploadFile(file) {
            const formData = new FormData();
            formData.append('file_perjanjian', file);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            progressWrapper.show();
            progressBar.css('width', '0%');
            progressText.text('0%');

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
                            progressBar.css('width', percent + '%');
                            progressText.text(percent + '%');
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
                    progressWrapper.hide();
                }
            });
        }
    });
</script>
@endpush
