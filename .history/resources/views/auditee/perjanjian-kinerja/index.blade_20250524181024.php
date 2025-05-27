@extends('layouts.dashboard2')

@section('dashboardProfile')
<div class="row g-5 g-xl-8">
    <div class="col-xl-12">
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0 text-primary">
                        <i class="bi bi-file-earmark-text fs-2 me-2"></i>
                        Perjanjian Kinerja
                    </h3>
                </div>
            </div>

            <div class="card-body p-9">
                <div class="alert alert-info d-flex align-items-center p-5">
                    <i class="ki-duotone ki-information-5 fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-info">Informasi Penting</h4>
                        <span>Silakan unggah dokumen Perjanjian Kinerja Anda sebelum melanjutkan ke tahap pemilihan IKSS.</span>
                    </div>
                </div>

                @if($perjanjianKinerja)
                    <!-- Display current file -->
                    <div class="mb-8">
                        <h4 class="text-gray-800 mb-4">Dokumen Perjanjian Kinerja Saat Ini</h4>
                        <div class="d-flex align-items-center p-5 bg-light-success rounded">
                            <i class="ki-duotone ki-document fs-3x me-5 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <span class="fw-bold text-gray-800 fs-6 mb-1">{{ $perjanjianKinerja->nama_file }}</span>
                                <span class="text-muted fw-semibold d-block">Diunggah pada: {{ $perjanjianKinerja->created_at->translatedFormat('d F Y H:i') }}</span>
                            </div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-sm btn-icon btn-light-primary me-2" onclick="downloadFile({{ $perjanjianKinerja->id }})">
                                    <i class="bi bi-download"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light-danger" onclick="deleteFile({{ $perjanjianKinerja->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Upload form -->
                <form id="uploadForm" class="form" action="{{ route('auditee.perjanjian-kinerja.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="d-block fw-bold fs-6 mb-5">Unggah Dokumen Perjanjian Kinerja</label>
                        <div class="fv-row">
                            <div class="dropzone" id="kt_dropzone_1">
                                <div class="dz-message needsclick">
                                    <i class="ki-duotone ki-file-up fs-3x text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Tarik & letakkan file di sini atau klik untuk memilih</h3>
                                        <span class="fs-7 fw-semibold text-gray-400">Format yang diizinkan: PDF, DOC, DOCX (Maks. 10MB)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            <span class="indicator-label">Unggah Dokumen</span>
                            <span class="indicator-progress">
                                Mengunggah... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    // Initialize dropzone
    let myDropzone = new Dropzone("#kt_dropzone_1", {
        url: "{{ route('auditee.perjanjian-kinerja.store') }}", // Set the url for your upload script location
        paramName: "file",
        maxFiles: 1,
        maxFilesize: 10, // Max filesize in MB
        addRemoveLinks: true,
        acceptedFiles: ".pdf,.doc,.docx",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        init: function() {
            this.on("success", function(file, response) {
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
                        location.reload();
                    });
                }
            });

            this.on("error", function(file, response) {
                let message = response.message || 'Terjadi kesalahan saat mengunggah file';

                Swal.fire({
                    text: message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });

                this.removeFile(file);
            });
        }
    });

    function downloadFile(id) {
        window.location.href = `{{ url('auditee/perjanjian-kinerja/download') }}/${id}`;
    }

    function deleteFile(id) {
        Swal.fire({
            text: "Apakah Anda yakin ingin menghapus file ini?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batal",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-light"
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                axios.delete(`{{ url('auditee/perjanjian-kinerja') }}/${id}`)
                    .then(response => {
                        if (response.data.success) {
                            Swal.fire({
                                text: response.data.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            text: error.response.data.message || "Terjadi kesalahan saat menghapus file",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    });
            }
        });
    }
</script>
@endpush
