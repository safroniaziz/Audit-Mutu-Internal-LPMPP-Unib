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
                        @if ($sudahMengisi)
                            href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}"
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

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5 my-2">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
                <ul class="nav nav-pills nav-line-pills border-0 fs-5 fw-semibold flex-nowrap overflow-auto">
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        <form id="formPemilihanIkss" action="{{ route('auditee.saveIkss') }}" method="POST" {{ $sudahMengisi ? 'class=form-disabled' : '' }}>
                            @csrf
                            <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">


                            @if($instrumen && $dataIkss)
                            <div class="container">
                                <h2>Pengisian Instrumen</h2>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3>ID IKSS: {{ $dataIkss->kode_ikss }} – {{ $dataIkss->tujuan }}</h3>
                                        <h4>{{ $instrumen->indikator }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('auditee.submit.instrumen') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="instrumen_id" value="{{ $instrumen->id }}">
                                            <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

                                            <div class="mb-4">
                                                <h5>Referensi</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td width="30%">Indikator Kinerja RSB</td>
                                                            <td>{{ $instrumen->indikator }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sumber data/bukti</td>
                                                            <td>
                                                                {{ $instrumen->sumber }}
                                                                @if(isset($ikssAuditeeData) && $ikssAuditeeData->bukti_file)
                                                                    <div>
                                                                        <a href="{{ asset('storage/'.$ikssAuditeeData->bukti_file) }}" target="_blank">(Buku SOP Akademik)</a>
                                                                    </div>
                                                                @endif

                                                                <div class="mt-2">
                                                                    <input type="file" name="bukti_file" class="form-control" id="buktiFile">
                                                                    <div class="form-text">Upload file bukti disini</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Target</td>
                                                            <td>{{ $instrumen->target }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="realisasi"
                                                                    value="{{ $ikssAuditeeData->realisasi ?? '' }}" placeholder="Isi disini...">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <h5>Uraian/Isian</h5>
                                                <div class="form-text mb-2">Standar akademik yang ada di Prodi sudah memiliki SOP</div>
                                                <textarea class="form-control" name="uraian" rows="3">{{ $ikssAuditeeData->uraian ?? '' }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <h5>Pengukuran</h5>
                                                <h6>Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                <textarea class="form-control" name="akar_penyebab" rows="5">{{ $ikssAuditeeData->akar_penyebab ?? '' }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <h5>Rencana Perbaikan dan Tindak lanjut</h5>
                                                <textarea class="form-control" name="rencana_perbaikan" rows="5">{{ $ikssAuditeeData->rencana_perbaikan ?? '' }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <h5>Indikator Penilaian</h5>
                                                <div>4 (100% standar akademik terdapat SOP)</div>
                                                <div>3 (75% standar akademik terdapat SOP)</div>
                                                <div>2 (50% standar akademik terdapat SOP)</div>
                                                <div>1 (25% standar akademik terdapat SOP)</div>
                                                <div>0 (tidak terdapat SOP pada standar akademik)</div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info">
                                Tidak ada instrumen yang perlu diisi saat ini.
                            </div>
                            @endif

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
            });
        });
    </script>
@endpush
