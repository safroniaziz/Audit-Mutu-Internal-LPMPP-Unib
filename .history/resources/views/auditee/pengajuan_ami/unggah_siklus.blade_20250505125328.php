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

        /* Tambahkan style berikut ke bagian <style> yang sudah ada */
.btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    padding: 0;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-icon i {
    font-size: 1rem;
}

.btn-primary {
    background-color: #009ef7;
    border-color: #009ef7;
}

.btn-primary:hover {
    background-color: #0095e8;
    border-color: #0095e8;
}

.btn-danger {
    background-color: #f1416c;
    border-color: #f1416c;
}

.btn-danger:hover {
    background-color: #ea1153;
    border-color: #ea1153;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 158, 247, 0.05);
}

/* Animasi untuk baris tabel baru */
@keyframes highlightRow {
    0% {
        background-color: rgba(0, 158, 247, 0.2);
    }
    100% {
        background-color: transparent;
    }
}

.new-row {
    animation: highlightRow 2s ease;
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
                    <!-- Ganti bagian tabel di kolom kanan dengan ini -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Daftar File yang Sudah Diupload</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Berikut adalah file yang telah Anda unggah</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama File</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="fileTableBody">
                                    @foreach($siklus->siklus as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $file->nama_berkas }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="btn btn-sm btn-icon btn-primary me-2" title="Lihat File">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            @if(!$siklus->is_disetujui)
                                                <form action="{{ route('auditee.file.delete', $file->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus File">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($siklus->siklus) == 0)
                                <div class="text-center py-5">
                                    <i class="bi bi-folder2-open fs-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada file yang diunggah</p>
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
        const ALLOWED_TYPES = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'image/jpeg', 'image/png'];

        // File list array
        const fileList = [];

        // Browse files button
        $('#browseFilesBtn').on('click', function() {
            $('#fileInput').click();
        });

        // Handle file selection change
        $('#fileInput').on('change', function(e) {
            handleFiles(e.target.files);
            this.value = ''; // Reset input value for repeated selections
        });

        // Drag and drop functionality
        const dropzone = document.getElementById('dropzone');

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
        }

        function unhighlight() {
            dropzone.classList.remove('border-primary');
        }

        // Handle dropped files
        dropzone.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }, false);

        // Handle files function
        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Validate file type
                if (!ALLOWED_TYPES.includes(file.type)) {
                    toastr.error(`File "${file.name}" tidak didukung. Hanya file PDF, DOC, DOCX, XLS, XLSX, JPG, dan PNG yang diizinkan.`);
                    continue;
                }

                // Validate file size
                if (file.size > MAX_FILE_SIZE) {
                    toastr.error(`File "${file.name}" terlalu besar. Ukuran maksimum adalah 10MB.`);
                    continue;
                }

                // Add file to array
                fileList.push(file);

                // Create file item element
                addFileItem(file);
            }

            // Enable submit button if there are files
            updateSubmitButton();
        }

        // Add file item to the list
        function addFileItem(file) {
            const fileId = 'file-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
            const fileSize = formatFileSize(file.size);

            const fileItem = `
                <div class="file-item" id="${fileId}">
                    <div class="d-flex flex-column flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="file-name">
                                <i class="${getFileIcon(file.type)} me-2"></i>${file.name}
                            </div>
                            <div class="file-remove" data-id="${fileId}">
                                <i class="bi bi-x-circle"></i>
                            </div>
                        </div>
                        <div class="file-progress">
                            <div class="file-progress-bar" style="width: 0%"></div>
                        </div>
                        <div class="file-info">
                            <span>${fileSize}</span>
                            <span>Menunggu</span>
                        </div>
                    </div>
                </div>
            `;

            $('#fileList').append(fileItem);

            // Add file to the fileList array with ID
            file.id = fileId;

            // Simulate progress bar for better UX
            simulateProgress(fileId);
        }

        // Get file icon based on mime type
        function getFileIcon(mimeType) {
            if (mimeType.includes('pdf')) {
                return 'bi bi-file-earmark-pdf text-danger';
            } else if (mimeType.includes('word')) {
                return 'bi bi-file-earmark-word text-primary';
            } else if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) {
                return 'bi bi-file-earmark-excel text-success';
            } else if (mimeType.includes('image')) {
                return 'bi bi-file-earmark-image text-warning';
            } else {
                return 'bi bi-file-earmark text-muted';
            }
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Simulate file upload progress
        function simulateProgress(fileId) {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 5;
                $(`#${fileId} .file-progress-bar`).css('width', `${progress}%`);

                if (progress >= 100) {
                    clearInterval(interval);
                    $(`#${fileId} .file-info span:last-child`).text('Siap');
                }
            }, 50);
        }

        // Remove file from list
        $(document).on('click', '.file-remove', function() {
            const fileId = $(this).data('id');

            // Remove from DOM
            $(`#${fileId}`).remove();

            // Remove from array
            const index = fileList.findIndex(file => file.id === fileId);
            if (index !== -1) {
                fileList.splice(index, 1);
            }

            // Update submit button state
            updateSubmitButton();
        });

        // Update submit button state
        function updateSubmitButton() {
            $('#submitBtn').prop('disabled', fileList.length === 0);
        }

        // Function to add file to table after successful upload
        function addFileToTable(file, id) {
            const fileCount = $('#fileTableBody tr').length + 1;
            const row = `
                <tr>
                    <td>${fileCount}</td>
                    <td>${file.name}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-icon btn-primary me-2" title="Lihat File">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-icon btn-danger delete-file" data-id="${id}" title="Hapus File">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#fileTableBody').append(row);
        }

        // Form submission
        $('#uploadFilesForm').on('submit', function(e) {
            e.preventDefault();

            // Create FormData
            const formData = new FormData(this);

            // Remove existing files from formData
            if (formData.has('files[]')) {
                formData.delete('files[]');
            }

            // Add files from our array
            fileList.forEach(file => {
                formData.append('files[]', file);
            });

            // Show loading state
            $('#submitBtn').attr('data-kt-indicator', 'on');
            $('#submitBtn').prop('disabled', true);

            // AJAX submission
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show success message
                    toastr.success('Dokumen siklus AMI berhasil diunggah!');

                    // Add uploaded files to the table
                    if (response.files && response.files.length) {
                        response.files.forEach(file => {
                            addFileToTable(file, file.id);
                        });
                    } else {
                        // Fallback - if response doesn't include files, refresh the page
                        window.location.reload();
                    }

                    // Reset form
                    $('#uploadFilesForm')[0].reset();
                    $('#fileList').empty();
                    fileList.length = 0; // Clear array
                    updateSubmitButton();
                },
                error: function(xhr) {
                    // Show error message
                    let errorMessage = 'Terjadi kesalahan saat mengunggah dokumen.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    toastr.error(errorMessage);
                },
                complete: function() {
                    // Hide loading state
                    $('#submitBtn').attr('data-kt-indicator', 'off');
                    $('#submitBtn').prop('disabled', fileList.length === 0);
                }
            });
        });

        // Handle delete button on the file table
        $(document).on('click', '.delete-file', function() {
            const fileId = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                // Here you would make an AJAX call to delete the file
                // After success, remove the row from the table
                $(this).closest('tr').remove();

                // Refresh the numbering
                $('#fileTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
        });

        // Initialize toastr if not already
        if (typeof toastr !== 'undefined') {
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
        }
    });
    </script>
@endpush
