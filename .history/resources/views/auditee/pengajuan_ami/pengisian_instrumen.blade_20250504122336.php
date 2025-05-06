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
            @if($ikssAuditeeData)
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
                            <h4 class="text-gray-900 fw-bolder">Data Instrumen sudah diisi</h4>
                            <div class="fs-6 text-gray-700">Anda telah mengisi data Instrumen untuk periode ini. Form telah dinonaktifkan dan tidak dapat diubah lagi.</div>
                        </div>
                    </div>
                </div>
            @else
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
                            @if ($ikssAuditeeData)
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
            @endif
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5 my-2">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
                <ul class="nav nav-pills nav-line-pills border-0 fs-5 fw-semibold flex-nowrap overflow-auto">
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        <form id="formPemilihanIkss" action="{{ route('auditee.saveIkss') }}" method="POST" {{ $ikssAuditeeData ? 'class=form-disabled' : '' }}>
                            @csrf
                            <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                            @if($dataIkssProdi->isNotEmpty())
                                <form action="{{ route('auditee.submitAllInstrumen') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

                                    @foreach ($dataIkssProdi as $unit)
                                        @foreach ($unit->indikatorKinerjas as $indikatorIndex => $indikator)
                                            @if($indikator->instrumen->isNotEmpty())
                                                <div class="card mb-4">
                                                    <!-- Collapsible header -->
                                                    <div class="card-header bg-light pt-4 pb-3 d-flex justify-content-between align-items-center cursor-pointer"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $indikatorIndex }}"
                                                        aria-expanded="false">
                                                        <h4 class="mb-0">ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}</h4>
                                                        <i class="fas fa-chevron-down"></i>
                                                    </div>

                                                    <!-- Collapsible content -->
                                                    <div class="collapse" id="collapse-{{ $indikatorIndex }}">
                                                        <div class="card-body">
                                                            @foreach ($indikator->instrumen as $instrumen)
                                                                <div class="mb-5">
                                                                    <input type="hidden" name="instrumen_ids[]" value="{{ $instrumen->id }}">

                                                                    <h5 class="border-bottom pb-2 mb-4">{{ $loop->iteration }}. {{ $instrumen->indikator }}</h5>

                                                                    <div class="mb-4">
                                                                        <h6>Referensi</h6>
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
                                                                                        @if(isset($ikssAuditeeData[$instrumen->id]) && $ikssAuditeeData[$instrumen->id]->bukti_file)
                                                                                            <div>
                                                                                                <a href="{{ asset('storage/'.$ikssAuditeeData[$instrumen->id]->bukti_file) }}" target="_blank">(Buku SOP Akademik)</a>
                                                                                            </div>
                                                                                        @endif

                                                                                        <div class="mt-2">
                                                                                            <input type="file" name="bukti_file[{{ $instrumen->id }}]" class="form-control" id="buktiFile_{{ $instrumen->id }}">
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
                                                                                        <input type="text" class="form-control" name="realisasi[{{ $instrumen->id }}]"
                                                                                            value="{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->realisasi : '' }}"
                                                                                            placeholder="Isi disini...">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <h6>Uraian/Isian</h6>
                                                                        <div class="form-text mb-2">Standar akademik yang ada di Prodi sudah memiliki SOP</div>
                                                                        <textarea class="form-control" name="uraian[{{ $instrumen->id }}]" rows="3">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->uraian : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <h6>Pengukuran</h6>
                                                                        <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                                        <textarea class="form-control" name="akar_penyebab[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->akar_penyebab : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                                        <textarea class="form-control" name="rencana_perbaikan[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->rencana_perbaikan : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <h6>Indikator Penilaian</h6>
                                                                        <div>4 (100% standar akademik terdapat SOP)</div>
                                                                        <div>3 (75% standar akademik terdapat SOP)</div>
                                                                        <div>2 (50% standar akademik terdapat SOP)</div>
                                                                        <div>1 (25% standar akademik terdapat SOP)</div>
                                                                        <div>0 (tidak terdapat SOP pada standar akademik)</div>
                                                                    </div>

                                                                    @if(!$loop->last)
                                                                        <hr class="my-5">
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach

                                    <div class="text-end mb-5">
                                        <button type="submit" class="btn btn-primary btn-lg">Simpan Semua</button>
                                    </div>
                                </form>
                            @else
                            <div class="alert alert-info">
                                Tidak ada instrumen yang perlu diisi saat ini.
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
