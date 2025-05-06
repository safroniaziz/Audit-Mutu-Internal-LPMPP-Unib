@extends('auditee/dashboard_template')

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
                                Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh
                                untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                            </span>
                        </p>
                    </div>
                </div>


                <div class="ms-auto">
                    <a
                        href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}"
                        class="btn btn-sm px-4 btn-primary"
                        style=""
                    >
                        <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                    </a>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5 my-2">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
                <ul class="nav nav-pills nav-line-pills border-0 fs-5 fw-semibold flex-nowrap overflow-auto">
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        <form action="{{ route('auditee.saveIkss') }}" method="POST">
                            @csrf
                            <input type="hidden" name="auditee_id" value="{{ $unit->id }}">
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
                                                                {{ $instrumen->is_wajib == 1 ? 'checked disabled' : '' }}
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
                                                                {{ $instrumen->is_wajib == 1 ? 'disabled' : '' }}
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
            if ($(this).is(':disabled')) return;

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
    });
});
    </script>
@endpush
