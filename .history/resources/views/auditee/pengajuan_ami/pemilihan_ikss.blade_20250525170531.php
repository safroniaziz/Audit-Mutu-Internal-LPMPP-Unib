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
            @if($sudahMengisi)
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                        </svg>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Data IKSS sudah diisi</h4>
                            <diva class="fs-6 text-gray-700">Anda telah mengisi data IKSS untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</diva>
                        </div>
                    </div>
                </div>
            @endif

            <div class="alert {{ $sudahMengisi ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10 position-relative">
                <div class="me-4">
                    <i class="bi {{ $sudahMengisi ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $sudahMengisi ? '✨ IKSS Telah Dipilih' : '📢 Pilih IKSS' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $sudahMengisi ? 'Selamat!' : 'Catatan:' }}</strong>
                            <span class="fw-semibold {{ $sudahMengisi ? 'text-success' : 'text-danger' }}">
                                @if($sudahMengisi)
                                    IKSS telah dipilih dengan lengkap. Silakan lanjut ke tahap pengisian Instrumen Audit.
                                @else
                                    Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto">
                    <a
                        @if ($sudahMengisi)
                            href="{{ route('auditee.pengajuanAmi.instrumenAudit') }}"
                            class="btn btn-sm px-4 btn-primary"
                            style=""
                        @else
                            href="#"
                            class="btn btn-sm px-4 btn-secondary disabled"
                            style="cursor: not-allowed; opacity: 0.65;"
                        @endif
                    >
                        <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5 my-2">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
            </div>

            <div class="mb-8">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fs-4 fw-bold text-dark mb-0">Progress Pemilihan IKSS</h3>
                        <span class="text-gray-600">Status pemilihan instrumen IKSS</span>
                    </div>
                    <span class="fs-2 fw-bolder text-primary progress-percentage">0%</span>
                </div>

                <div class="bg-light-primary rounded">
                    <div class="progress h-8px bg-primary bg-opacity-50 rounded">
                        <div class="progress-bar rounded bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        <form id="formPemilihanIkss" action="{{ route('auditee.saveIkss') }}" method="POST" {{ $sudahMengisi ? 'class=form-disabled' : '' }}>
                            @csrf
                            <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">
                            @foreach ($dataIkssProdi as $unit)
                                @foreach ($unit->indikatorKinerjas as $indikatorIndex => $indikator)
                                    <!-- Timeline item -->
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-icon">
                                            <span class="fs-5 text-gray-500">{{ $indikatorIndex + 1 }}</span>
                                        </div>
                                        <div class="timeline-content mb-10 mt-n1">
                                            <div class="pe-3 mb-5">
                                                <div class="fs-4 fw-bold text-gray-800 mb-2">
                                                    ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}
                                                </div>
                                                <div class="text-muted fs-6 mb-4">Berikut daftar instrumen yang terkait:</div>
                                            </div>

                                            @foreach ($indikator->instrumen as $instrumenIndex => $instrumen)
                                                <div class="d-flex align-items-start border border-dashed border-gray-300 rounded px-6 py-4 mb-3">
                                                    <div class="flex-grow-1">
                                                        <div class="fs-6 fw-bold text-gray-900 mb-1">
                                                            {{ $instrumenIndex + 1 }}. {{ $instrumen->indikator }}
                                                        </div>

                                                        @if ($instrumen->is_wajib == 1)
                                                            <div class="text-danger fw-semibold mb-2">
                                                                * Instrumen ini bersifat wajib dan sudah dipilih secara otomatis.
                                                            </div>
                                                        @endif
                                                        <div class="fs-7 text-muted">
                                                            <div><strong>Sumber:</strong> {{ $instrumen->sumber }}</div>
                                                            <div><strong>Target:</strong> {{ $instrumen->target }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 flex-wrap mt-3" style="max-width: 400px;">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="ya_{{ $instrumen->id }}"
                                                                value="1"
                                                                {{ ($instrumen->is_wajib == 1 || (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 1)) ? 'checked' : '' }}
                                                                {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                            >
                                                            <label class="form-check-label" for="ya_{{ $instrumen->id }}">Ya</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="tidak_{{ $instrumen->id }}"
                                                                value="0"
                                                                {{ (isset($dataTerpilih[$instrumen->id]) && $dataTerpilih[$instrumen->id] == 0) ? 'checked' : '' }}
                                                                {{ $sudahMengisi || $instrumen->is_wajib == 1 ? 'disabled' : '' }}
                                                            >
                                                            <label class="form-check-label" for="tidak_{{ $instrumen->id }}">Tidak</label>
                                                        </div>

                                                        {{-- Jika perlu agar nilai tetap terkirim meski radio disabled --}}
                                                        @if($instrumen->is_wajib == 1)
                                                            <input type="hidden" name="pilihan_{{ $instrumen->id }}" value="1">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach

                            @if(!$sudahMengisi)
                            <div class="d-flex justify-content-end p-5">
                                <button type="submit" class="btn btn-primary">Simpan Pilihan</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::details View-->
@endsection

@push('scripts')
    <script>
         // Letakkan script ini di bagian bawah halaman atau dalam section scripts
         $(document).ready(function() {
            // Check if the form is disabled
            if ($('#formPemilihanIkss').hasClass('form-disabled')) {
                // Form is disabled, no need to attach event handlers
                return;
            }

            // Function to update progress
            function updateProgress() {
                // Hitung total instrumen yang perlu dipilih (tidak termasuk yang wajib)
                const totalInstruments = $('input[type="radio"][name^="pilihan_"]:not(:disabled)').length / 2;

                // Hitung instrumen yang sudah dipilih
                const selectedInstruments = $('input[type="radio"][name^="pilihan_"]:checked:not(:disabled)').length;

                // Hitung persentase
                const progressPercentage = Math.min(Math.round((selectedInstruments / totalInstruments) * 100), 100);

                // Update UI
                $('.progress-bar').css('width', progressPercentage + '%');
                $('.progress-bar').attr('aria-valuenow', progressPercentage);
                $('.progress-percentage').text(progressPercentage + '%');

                // Update warna berdasarkan progress
                if (progressPercentage === 100) {
                    $('.progress-percentage').removeClass('text-primary').addClass('text-success');
                    $('.progress-bar').removeClass('bg-primary').addClass('bg-success');
                    $('.bg-light-primary').removeClass('bg-light-primary').addClass('bg-light-success');
                } else {
                    $('.progress-percentage').removeClass('text-success').addClass('text-primary');
                    $('.progress-bar').removeClass('bg-success').addClass('bg-primary');
                    $('.bg-light-success').removeClass('bg-light-success').addClass('bg-light-primary');
                }
            }

            // Update progress when radio buttons change
            $('input[type="radio"]').on('change', function() {
                updateProgress();
            });

            // Initial progress update
            updateProgress();

            $("#formPemilihanIkss").on("submit", function(e) {
                e.preventDefault();

                // Validasi form client-side (minimal satu instrumen non-wajib dipilih)
                let formValid = true;
                let radiosWithName = {};

                // Cek setiap grup radio button
                $(this).find('input[type="radio"]').each(function() {
                    const name = $(this).attr('name');
                    if (!name.includes('_')) return;

                    // Abaikan radio button yang sudah di-disable (instrumen wajib)
                    if ($(this).is(':disabled') && !$(this).hasClass('required-selection')) return;

                    radiosWithName[name] = true;
                });

                // Periksa apakah setiap grup radio button memiliki pilihan yang dipilih
                for (let name in radiosWithName) {
                    if ($(`input[name="${name}"]:checked`).length === 0) {
                        formValid = false;
                        break;
                    }
                }

                if (!formValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        text: 'Mohon pilih Ya atau Tidak untuk setiap instrumen!',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Konfirmasi sebelum menyimpan
                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    text: 'Apakah Anda yakin dengan pilihan IKSS Anda? Data yang disimpan tidak dapat diubah kembali.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menyimpan Data',
                            text: 'Mohon tunggu...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Kirim form dengan AJAX
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: $(this).serialize(),
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed && response.redirect_url) {
                                            window.location.href = response.redirect_url;
                                        } else {
                                            // Refresh page to show the disabled form
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                let errorMessage = 'Terjadi kesalahan saat menyimpan data.';

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: errorMessage,
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
