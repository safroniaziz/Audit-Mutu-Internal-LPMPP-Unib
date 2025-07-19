@extends('auditee/dashboard_template')
@push('styles')
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
        .btn-download:hover, #downloadAllBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Download progress overlay */
        .download-progress {
            z-index: 9999;
            min-width: 350px;
            border-radius: 8px;
            background-color: #ffffff;
        }

        /* Animation for toastr notifications */
        .toast {
            opacity: 0;
            animation: fadeInUp 0.3s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover effect for document cards */
        .document-card, .document-card-action {
            transition: all 0.3s ease;
        }

        .document-card:hover, .document-card-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endpush
@section('dashboardProfile')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-7">
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                            <i class="bi bi-person-check-fill fs-1"></i> Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <span class="badge badge-light-primary fs-7 fw-bold">Data Auditee</span>
                    </div>
                </div>
                <!--begin::Card header-->

                <form id="kt_account_profile_details_form" action="{{ route('auditee.pengajuanAmi.lengkapiProfil') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        @php
                            $user = Auth::user();
                            $completionPercentage = $user->getProfileCompletionPercentage();
                            $unitKerja = $user->unitKerja;

                            // Get the most recent update time between user and unit_kerja
                            $lastUpdateTime = $user->updated_at > $unitKerja->updated_at
                                ? $user->updated_at
                                : $unitKerja->updated_at;
                        @endphp

                        <!--begin::Profile Progress-->
                        <div class="mb-8">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h3 class="fs-4 fw-bold text-dark mb-0">Kelengkapan Profil</h3>
                                    <span class="text-gray-600">Status kelengkapan data profil Anda</span>
                                </div>
                                <span class="fs-2 fw-bolder {{ $completionPercentage == 100 ? 'text-success' : 'text-primary' }}">
                                    {{ $completionPercentage }}%
                                </span>
                            </div>

                            <div class="bg-light-{{ $completionPercentage == 100 ? 'success' : 'primary' }} rounded">
                                <div class="progress h-8px bg-{{ $completionPercentage == 100 ? 'success' : 'primary' }} bg-opacity-50 rounded">
                                    <div class="progress-bar rounded bg-{{ $completionPercentage == 100 ? 'success' : 'primary' }}"
                                         role="progressbar"
                                         style="width: {{ $completionPercentage }}%"
                                         aria-valuenow="{{ $completionPercentage }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <span class="d-flex align-items-center fs-7 fw-bold {{ $completionPercentage == 100 ? 'text-success' : 'text-primary' }}">
                                    <i class="bi {{ $completionPercentage == 100 ? 'bi-check-circle-fill' : 'bi-info-circle-fill' }} fs-7 me-2"></i>
                                    {{ $completionPercentage == 100 ? 'Profil Anda sudah lengkap' : 'Silakan lengkapi profil Anda' }}
                                </span>
                                @if($completionPercentage == 100)
                                    <span class="bullet bullet-dot bg-success mx-2"></span>
                                    <span class="fs-7 text-muted">Terakhir diperbarui: {{ \Carbon\Carbon::parse($lastUpdateTime)->translatedFormat('d F Y H:i') }}</span>
                                @endif
                            </div>
                        </div>
                        <!--end::Profile Progress-->

                        <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                            <i class="bi bi-info-circle-fill fs-2 text-primary me-4"></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Proses Selanjutnya</h4>
                                <div class="fs-6 text-gray-700">
                                    <p class="mt-4">
                                        <strong>Catatan:</strong>
                                        @if($completionPercentage < 100)
                                            <span class="fw-semibold text-danger">
                                                Mohon lengkapi data profil Anda hingga mencapai 100% sebelum dapat melanjutkan ke proses selanjutnya.
                                            </span>
                                        @else
                                            <span class="fw-semibold text-success">
                                                Profil Anda sudah lengkap. Silakan klik tombol "Proses Selanjutnya" untuk mengunggah Perjanjian Kinerja.
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="ms-auto">
                                <a href="{{ route('auditee.pengajuanAmi.perjanjianKinerja') }}"
                                   class="btn btn-sm px-4 {{ $completionPercentage < 100 ? 'btn-secondary disabled' : 'btn-primary' }}"
                                   style="{{ $completionPercentage < 100 ? 'pointer-events: none; opacity: 0.7;' : '' }}"
                                >
                                    <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                                </a>
                            </div>
                        </div>

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Auditee</label>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12 fv-row">
                                        <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control mb-3 mb-lg-0" placeholder="Nama Auditee" value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Fakultas</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="fakultas" class="form-control form-control-lg form-control" placeholder="Nama Fakultas" value="{{ Auth::user()->unitKerja->fakultas }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Ketua</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="nama_ketua" class="form-control form-control-lg form-control" placeholder="Nama Ketua" value="{{ Auth::user()->unitKerja->nama_ketua }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIP Ketua</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="nip_ketua" class="form-control form-control-lg form-control" placeholder="NIP Ketua" value="{{ Auth::user()->unitKerja->nip_ketua }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenjang</label>
                            <div class="col-lg-8 fv-row">
                                <select name="jenjang" aria-label="pilih jenjang" data-control="select2" data-placeholder="Pilih Jenjang..." class="form-select form-select form-select-lg fw-semibold">
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
                                <input type="text" name="website" class="form-control form-control-lg form-control" placeholder="Website" value="{{ Auth::user()->unitKerja->website }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">E-mail</label>
                            <div class="col-lg-8 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control" placeholder="E-mail" value="{{ Auth::user()->email }}" />
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">No HP</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="no_hp" class="form-control form-control-lg form-control" placeholder="No HP" value="{{ Auth::user()->unitKerja->no_hp }}" />
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            <!--end::details View-->
        </div>

        <div class="col-xl-5">
            <!--begin::Documents Card-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary fw-bold">
                        <i class="bi bi-cloud-download fs-2 me-2"></i> Dokumen Audit
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-icon btn-light-primary pulse pulse-primary" data-bs-toggle="tooltip" title="Refresh">
                            <i class="bi bi-arrow-clockwise"></i>
                            <span class="pulse-ring"></span>
                        </button>
                    </div>
                </div>

                <!--begin::Card Body-->
                <div class="card-body">
                    <!--begin::Documents Grid-->
                    <div class="row g-5">
                        @if ($dokumenAmis->count())
                            @php
                                $totalDokumen = count($dokumenAmis);
                                $isOdd = $totalDokumen % 2 !== 0;
                                $lastIndex = $totalDokumen - 1;
                            @endphp
                            @foreach ($dokumenAmis as $index => $dokumenAmi)
                                @php
                                    $filePath = $dokumenAmi->file_dokumen;
                                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);

                                    // Tentukan ikon sesuai tipe
                                    $iconClass = match ($extension) {
                                        'pdf' => 'bi-file-earmark-pdf text-danger',
                                        'doc', 'docx' => 'bi-file-earmark-word text-primary',
                                        'xls', 'xlsx' => 'bi-file-earmark-excel text-success',
                                        'ppt', 'pptx' => 'bi-file-earmark-ppt text-warning',
                                        default => 'bi-file-earmark text-muted',
                                    };

                                    // Tentukan lebar kolom berdasarkan kondisi
                                    $colClass = 'col-md-6';

                                    // Jika jumlah dokumen = 1, atur ke col-md-12
                                    if ($totalDokumen === 1) {
                                        $colClass = 'col-md-12';
                                    }
                                    // Jika ganjil dan ini adalah dokumen terakhir
                                    elseif ($isOdd && $index === $lastIndex) {
                                        $colClass = 'col-md-12';
                                    }
                                @endphp

                                <div class="{{ $colClass }}">
                                    <div class="card overlay overflow-hidden shadow-sm h-100 document-card position-relative">
                                        <div class="card-body p-0">
                                            <div class="overlay-wrapper bg-light d-flex align-items-center justify-content-center text-center flex-column px-3 py-4" style="height: 140px;">
                                                <i class="bi {{ $iconClass }} mb-2" style="font-size: 3.5rem;"></i>
                                                <span class="fw-bold text-dark fs-6">{{ $dokumenAmi->nama_dokumen }}</span>
                                                <small class="text-muted">{{ strtoupper($extension) }} • {{ formatSizeUnits($dokumenAmi->size_dokumen) }} • {{ \Carbon\Carbon::parse($dokumenAmi->created_at)->translatedFormat('d F Y') }}</small>
                                            </div>

                                            <div class="overlay-layer bg-dark bg-opacity-25 d-none">
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                    <a href="{{ asset('storage/' . $dokumenAmi->file_dokumen) }}" download
                                                        class="btn btn-sm btn-icon btn-light-primary btn-active-primary">
                                                        <i class="bi bi-download fs-4"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-light p-3 d-flex justify-content-between align-items-center">
                                            <span class="badge badge-light-danger">Khusus Auditee</span>
                                            <a href="{{ asset('storage/' . $dokumenAmi->file_dokumen) }}" download
                                                class="btn btn-sm btn-icon btn-light-primary btn-active-primary">
                                                <i class="bi bi-download fs-4"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!--begin::Download All Button-->
                            <div class="col-md-12">
                                <div class="card h-100 d-flex flex-column justify-content-center align-items-center shadow-sm document-card-action">
                                    <div class="text-center p-10">
                                        <i class="bi bi-file-earmark-zip text-primary fs-3x my-3"></i>
                                        <div class="fs-4 fw-bold text-dark mb-2">Unduh Semua Dokumen</div>
                                        <div class="fs-7 text-muted mb-5">Download semua file dalam format ZIP</div>
                                        <button type="button" class="btn btn-primary btn-sm px-4 py-2" id="downloadAllBtn">
                                            <i class="bi bi-cloud-download me-1"></i> Download (.zip)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alert-info text-center p-10 shadow-sm">
                                    <i class="bi bi-info-circle fs-2 text-primary mb-2"></i>
                                    <h5 class="mb-2">Tidak ada dokumen yang tersedia</h5>
                                    <p class="mb-0">Silakan kembali nanti atau hubungi admin jika ini tampak seperti kesalahan.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Documents Grid-->
                </div>
                <!--end::Card Body-->
            </div>
            <!--end::Documents Card-->

            <div class="download-progress card shadow d-none p-6">
                <div class="d-flex flex-column">
                    <h3 class="fs-5 fw-bold mb-3 download-filename">Mengunduh file...</h3>
                    <div class="progress h-25px bg-light-primary mb-2">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted fs-7 download-percentage">0%</span>
                        <span class="text-muted fs-7 download-speed">0 KB/s</span>
                    </div>
                </div>
            </div>

            <iframe id="hidden-download-frame" style="display: none;"></iframe>

            <!-- Download Progress Overlay -->
            <div class="download-progress d-none">
                <div class="bg-white p-8 rounded shadow-sm">
                    <!-- Content tetap sama -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
                        $('#kt_account_profile_details_form').submit(function(event) {
                event.preventDefault();

                // Check if user is authenticated
                if (!document.querySelector('meta[name="csrf-token"]')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Terautentikasi!',
                        text: 'Silakan login terlebih dahulu.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                    return;
                }

                var formData = new FormData(this);

                // Debug: Log form data
                console.log('Form action:', $(this).attr('action'));
                console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Response received:', response);

                        // Check if response is HTML (redirected to login/dashboard)
                        if (typeof response === 'string' && response.includes('<!DOCTYPE html>')) {
                            console.log('Response is HTML - likely redirected due to authentication');
                            Swal.fire({
                                icon: 'warning',
                                title: 'Sesi Berakhir!',
                                text: 'Sesi Anda telah berakhir. Silakan login kembali.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/login';
                            });
                            return;
                        }

                        if (response.success) {
                            // Jika berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Profil berhasil diperbarui!',
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            // Handle jika gagal
                            console.log('Error message:', response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan yang tidak diketahui',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error status:', xhr.status);
                        console.log('Error response:', xhr.responseText);

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            // Menyusun pesan error dengan pembatas halus antar pesan
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(index, message) {
                                    errorMessage += `<div style="font-size: 16px; color: #ff0000; margin-bottom: 10px;">
                                                        ${message}
                                                    </div>
                                                    <hr style="border-top: 1px solid #ff0000; margin-top: 5px; margin-bottom: 5px;">`;
                                });
                            });

                            // Menampilkan SweetAlert dengan pesan error yang lebih rapi
                            Swal.fire({
                                icon: 'error',
                                title: 'Terdapat Kesalahan!',
                                html: errorMessage, // Menggunakan HTML untuk menampilkan pesan
                                confirmButtonText: 'Perbaiki'
                            });
                        } else if (xhr.status === 401 || xhr.status === 403) {
                            // Authentication error
                            Swal.fire({
                                icon: 'error',
                                title: 'Sesi Berakhir!',
                                text: 'Sesi Anda telah berakhir. Silakan login kembali.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/login';
                            });
                        } else {
                            // Error lain (misalnya masalah koneksi)
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Ada masalah dalam pengiriman data. Silakan coba lagi.',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const documentCards = document.querySelectorAll('.document-card');

            documentCards.forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    const overlay = this.querySelector('.overlay-layer');
                    if (overlay) {
                        overlay.classList.remove('d-none');
                    }
                });

                card.addEventListener('mouseleave', function() {
                    const overlay = this.querySelector('.overlay-layer');
                    if (overlay) {
                        overlay.classList.add('d-none');
                    }
                });
            });

            // Get elements
            const downloadBtns = document.querySelectorAll('.btn-download');
            const downloadAllBtn = document.getElementById('downloadAllBtn');
            const downloadProgress = document.querySelector('.download-progress');
            const progressBar = downloadProgress?.querySelector('.progress-bar');
            const downloadFilename = downloadProgress?.querySelector('.download-filename');
            const downloadPercentage = downloadProgress?.querySelector('.download-percentage');
            const downloadSpeed = downloadProgress?.querySelector('.download-speed');

            // Function to simulate download for individual files
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
            if (downloadBtns) {
                downloadBtns.forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const filename = this.getAttribute('data-file');
                        simulateDownload(filename);
                    });
                });
            }

            // Add click event listener to download all button
            if (downloadAllBtn) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "300",
                    "hideDuration": "500",
                    "timeOut": "5000"
                };
                downloadAllBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Show info notification
                    toastr.info('Menyiapkan semua dokumen untuk diunduh...', 'Mengunduh Semua Dokumen');

                    // Gunakan route name dengan URL yang benar
                    const downloadUrl = "{{ route('auditee.downloadAllFiles') }}";

                    setTimeout(function() {
                        // Buat link tersembunyi dan klik
                        const downloadLink = document.createElement('a');
                        downloadLink.href = downloadUrl;
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);

                        // Show success notification after a delay
                        setTimeout(function() {
                            toastr.success('Semua dokumen berhasil diunduh dalam format ZIP', 'Download Selesai');
                        }, 1000);
                    }, 1000);
                });
            }
        });
    </script>
@endpush
