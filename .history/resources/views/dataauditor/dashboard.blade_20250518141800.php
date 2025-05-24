@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill fs-1"></i> Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-primary fs-7 fw-bold">Data Auditor</span>
            </div>
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <!-- Progress bar for profile completion -->
                @php
                    $user = Auth::user();
                    $completionPercentage = $user->getProfileCompletionPercentage();
                @endphp
                <div class="mb-8">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-semibold text-gray-600">Kelengkapan Profil</span>
                        <span class="fw-bold fs-6">{{ $completionPercentage }}%</span>
                    </div>
                    <div class="h-8px bg-light rounded">
                        <div class="bg-primary rounded h-8px" role="progressbar" style="width: {{ $completionPercentage }}%" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Alert with animation -->
                <div class="alert alert-info d-flex align-items-start p-5 position-relative border-0 border-start border-5 border-primary">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-primary pulse-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📢 Proses Selanjutnya</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>Catatan:</strong>
                                <span class="fw-semibold text-primary">
                                    Silakan lanjutkan dengan melaksanakan audit sesuai penugasan yang telah diberikan. Pastikan Anda telah memahami ruang lingkup dan dokumen yang harus diperiksa.
                                </span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="collapse" data-bs-target="#moreInfo">
                                <i class="bi bi-info-circle me-1"></i> Info Selengkapnya
                            </button>
                        </div>
                        <div class="collapse mt-3" id="moreInfo">
                            <div class="card card-body bg-light-info border-0">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Lengkapi profil Anda untuk memudahkan proses audit</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Unduh dokumen template yang diperlukan</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Hubungi admin jika ada kendala</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Download Files Section -->
                <div class="card shadow-sm mb-8 border-0 bg-light-primary bg-opacity-50">
                    <div class="card-header bg-primary bg-opacity-25 border-0">
                        <h3 class="card-title text-primary fw-bold">
                            <i class="bi bi-cloud-download fs-2 me-2"></i> Dokumen Audit
                        </h3>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Refresh Daftar File">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                <thead class="border-bottom border-gray-200">
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-150px">Nama Dokumen</th>
                                        <th class="min-w-100px">Tipe</th>
                                        <th class="min-w-100px">Ukuran</th>
                                        <th class="min-w-100px">Tanggal Upload</th>
                                        <th class="min-w-100px text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-pdf fs-1 text-danger me-3"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark">Panduan Audit 2024</span>
                                                    <span class="text-muted fs-7">Dokumen Wajib</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light-danger">PDF</span></td>
                                        <td>2.4 MB</td>
                                        <td>20 Apr 2024</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 download-btn" data-file="panduan-audit.pdf">
                                                <i class="bi bi-download fs-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-excel fs-1 text-success me-3"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark">Template Laporan Audit</span>
                                                    <span class="text-muted fs-7">Versi Terbaru</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light-success">XLSX</span></td>
                                        <td>1.8 MB</td>
                                        <td>15 Apr 2024</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 download-btn" data-file="template-audit.xlsx">
                                                <i class="bi bi-download fs-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-word fs-1 text-primary me-3"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark">SOP Pelaksanaan Audit</span>
                                                    <span class="text-muted fs-7">Update 2024</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light-primary">DOCX</span></td>
                                        <td>3.2 MB</td>
                                        <td>10 Apr 2024</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 download-btn" data-file="sop-audit.docx">
                                                <i class="bi bi-download fs-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Download Progress Overlay -->
                        <div class="download-progress d-none">
                            <div class="bg-white p-8 rounded shadow-sm">
                                <div class="text-center mb-5">
                                    <i class="bi bi-cloud-download fs-3x text-primary mb-5"></i>
                                    <h3 class="download-filename mb-3">Mengunduh file...</h3>
                                </div>
                                <div class="h-8px w-100 bg-light mb-3">
                                    <div class="progress-bar bg-primary rounded h-8px" role="progressbar" style="width: 0%"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted fs-7 download-percentage">0%</span>
                                    <span class="text-muted fs-7 download-speed">0 KB/s</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0 d-flex justify-content-between">
                        <span class="text-muted fs-7">Total 3 dokumen tersedia</span>
                        <button type="button" class="btn btn-sm btn-light-primary" id="downloadAllBtn">
                            <i class="bi bi-cloud-download me-1"></i> Unduh Semua
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama auditor</label>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12 fv-row">
                                        <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nama auditor" value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Fakultas</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="fakultas" class="form-control form-control-lg form-control-solid" placeholder="Nama Fakultas" value="{{ Auth::user()->unitKerja && Auth::user()->unitKerja->fakultas ? Auth::user()->unitKerja->fakultas : '-' }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Ketua</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="nama_ketua" class="form-control form-control-lg form-control-solid" placeholder="Nama Ketua" value="{{ Auth::user()->unitKerja->nama_ketua }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIP Ketua</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="nip_ketua" class="form-control form-control-lg form-control-solid" placeholder="NIP Ketua" value="{{ Auth::user()->unitKerja->nip_ketua }}" />
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="col-md-6">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenjang</label>
                            <div class="col-lg-8 fv-row">
                                <select name="jenjang" aria-label="pilih jenjang" data-control="select2" data-placeholder="Pilih Jenjang..." class="form-select form-select-solid form-select-lg fw-semibold">
                                    <option value="">Pilih Jenjang...</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="D2" ? 'selected' : '' }} value="D2">D2</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="D3" ? 'selected' : '' }} value="D3">D3</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="D4" ? 'selected' : '' }} value="D4">D4</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="S1" ? 'selected' : '' }} value="S1">S1</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="S2" ? 'selected' : '' }} value="S2">S2</option>
                                    <option {{ Auth::user()->unitKerja->jenjang =="S3" ? 'selected' : '' }} value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Website</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="website" class="form-control form-control-lg form-control-solid" placeholder="Website" value="{{ Auth::user()->unitKerja->website }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">E-mail</label>
                            <div class="col-lg-8 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="E-mail" value="{{ Auth::user()->email }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">No HP</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="no_hp" class="form-control form-control-lg form-control-solid" placeholder="No HP" value="{{ Auth::user()->unitKerja->no_hp }}" />
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-light me-3">Batal</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                        <span class="indicator-label">Simpan Perubahan</span>
                        <span class="indicator-progress">Menyimpan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

    <!-- JavaScript for download functionality -->
    <script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const downloadBtns = document.querySelectorAll('.download-btn');
        const downloadAllBtn = document.getElementById('downloadAllBtn');
        const downloadProgress = document.querySelector('.download-progress');
        const progressBar = downloadProgress.querySelector('.progress-bar');
        const downloadFilename = downloadProgress.querySelector('.download-filename');
        const downloadPercentage = downloadProgress.querySelector('.download-percentage');
        const downloadSpeed = downloadProgress.querySelector('.download-speed');

        // Function to simulate download
        function simulateDownload(filename) {
            // Show download progress overlay
            downloadProgress.classList.remove('d-none');
            downloadProgress.classList.add('position-fixed', 'top-50', 'start-50', 'translate-middle', 'z-index-3');

            // Add overlay background
            const overlay = document.createElement('div');
            overlay.classList.add('position-fixed', 'top-0', 'start-0', 'w-100', 'h-100', 'bg-dark', 'bg-opacity-50', 'z-index-2');
            document.body.appendChild(overlay);

            // Update download filename
            downloadFilename.textContent = 'Mengunduh ' + filename;

            // Reset progress
            progressBar.style.width = '0%';
            downloadPercentage.textContent = '0%';

            // Simulate download progress
            let progress = 0;
            const interval = setInterval(function() {
                // Increment progress
                progress += Math.random() * 5;
                if (progress > 100) progress = 100;

                // Update UI
                progressBar.style.width = progress + '%';
                downloadPercentage.textContent = Math.round(progress) + '%';
                downloadSpeed.textContent = Math.floor(Math.random() * 1000) + ' KB/s';

                // If download completed
                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(function() {
                        // Hide download progress overlay
                        downloadProgress.classList.add('d-none');
                        downloadProgress.classList.remove('position-fixed', 'top-50', 'start-50', 'translate-middle', 'z-index-3');

                        // Remove overlay background
                        document.body.removeChild(overlay);

                        // Show success notification
                        toastr.success('File ' + filename + ' berhasil diunduh', 'Download Selesai');

                        // Simulate browser download
                        const a = document.createElement('a');
                        a.href = '#';
                        a.download = filename;
                        a.click();
                    }, 1000);
                }
            }, 100);
        }

        // Add click event listeners to download buttons
        downloadBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const filename = this.getAttribute('data-file');
                simulateDownload(filename);
            });
        });

        // Add click event listener to download all button
        downloadAllBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Show info notification
            toastr.info('Menyiapkan file untuk diunduh...', 'Download Semua');

            // Simulate preparing files
            setTimeout(function() {
                simulateDownload('dokumen-audit.zip');
            }, 1000);
        });

        // Initialize toastr notifications
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000"
        };
    });
    </script>

    <!-- CSS for animations and effects -->
    <style>
    /* Pulse animation for info icon */
    @keyframes pulse-primary {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .pulse-primary {
        animation: pulse-primary 2s infinite;
    }

    /* Hover effect for download buttons */
    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Download progress overlay */
    .download-progress {
        z-index: 9999;
        min-width: 300px;
    }
    </style>
@endsection
