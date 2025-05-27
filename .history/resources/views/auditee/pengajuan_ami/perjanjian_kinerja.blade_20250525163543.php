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
            <div class="card-toolbar">
                <span class="badge badge-light-primary fs-7 fw-bold">Perjanjian Kinerja</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <!-- Status Alert -->
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
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <!-- Existing Document Info -->
                    @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                        <div class="text-center mb-10">
                            <div class="file-info p-8 bg-light-success rounded">
                                <i class="bi bi-file-earmark-check text-success fs-2hx mb-5"></i>
                                <h3 class="fs-2 fw-bold mb-3">Dokumen Telah Diunggah</h3>
                                <p class="text-gray-600 mb-5">
                                    Nama File: {{ $perjanjianKinerja->nama_file }}<br>
                                    Ukuran: {{ number_format($perjanjianKinerja->size / 1024, 2) }} KB
                                </p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ Storage::url($perjanjianKinerja->file_path) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="bi bi-eye me-2"></i>Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Upload Form - Always visible but conditionally disabled -->
                    <form id="uploadForm" class="form" action="{{ route('auditee.pengajuanAmi.uploadPerjanjianKinerja') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                            <div class="mt-5">
                                <div class="text-center mb-5">
                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x mb-3"></i>
                                    <h3 class="fs-4 fw-bold mb-2">Form Unggah Dokumen</h3>
                                    <p class="text-gray-400 mb-0">Format yang diperbolehkan: PDF, DOC, DOCX (Maks. 10MB)</p>
                                    @if($perjanjianKinerja && $perjanjianKinerja->file_path)
                                        <div class="alert alert-warning mt-4">
                                            <i class="bi bi-exclamation-circle me-2"></i>
                                            Form unggah dinonaktifkan karena Anda telah mengunggah dokumen sebelumnya.
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="file"
                                           class="form-control form-control-solid"
                                           name="file_perjanjian"
                                           accept=".pdf,.doc,.docx"
                                           {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'disabled' : '' }}>
                                </div>

                                <div class="mt-5">
                                    <button type="submit"
                                            class="btn btn-primary me-3"
                                            {{ $perjanjianKinerja && $perjanjianKinerja->file_path ? 'disabled' : '' }}>
                                        <i class="bi bi-cloud-upload me-2"></i>Unggah Dokumen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::details View-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url;
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });

                        Swal.fire({
                            title: 'Gagal!',
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endpush
