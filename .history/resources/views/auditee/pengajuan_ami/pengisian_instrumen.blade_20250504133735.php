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
            @if($ikssAuditeeData->isNotEmpty())
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
                            @if ($ikssAuditeeData->isNotEmpty())
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
                        @if($dataIkssProdi->isNotEmpty())
                            <form action="{{ route('auditee.submitAllInstrumen') }}" method="POST" enctype="multipart/form-data" id="formInstrumen">
                                @csrf
                                <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

                                @foreach ($dataIkssProdi as $unit)
                                    @foreach ($unit->indikatorKinerjas as $indikator)
                                        @if($indikator->instrumen->isNotEmpty())
                                            <div class="card mb-5">
                                                <div class="card-header bg-light pt-8">
                                                    <h4>ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}</h4>
                                                </div>
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
                                                                                @if(isset($ikssAuditeeData[$instrumen->id]) && $ikssAuditeeData[$instrumen->id]->file_sumber)
                                                                                    <div class="mb-2">
                                                                                        <a href="{{ asset('storage/'.$ikssAuditeeData[$instrumen->id]->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                                            <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                                        </a>
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
                                                                <h6>Pengukuran</h6>
                                                                <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                                <textarea class="form-control" name="akar_penyebab[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->akar : '' }}</textarea>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                                <textarea class="form-control" name="rencana_perbaikan[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->rencana : '' }}</textarea>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6>Indikator Penilaian</h6>
                                                                <div>
                                                                    {!! $instrumen->penilaian !!}
                                                                </div>
                                                            </div>

                                                            <hr class="my-5">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach

                            @if ($ikssAuditeeData->isEm())

                                <div class="text-end mb-5 p-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Simpan Semua</button>
                                </div>
                            @endif
                            </form>
                        @else
                            <div class="alert alert-info">
                                Tidak ada instrumen yang perlu diisi saat ini.
                            </div>
                        @endif
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
            // Tambahkan CSRF token ke semua request Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('#formInstrumen').on('submit', function(e) {
                e.preventDefault();

                // Tampilkan loading
                Swal.fire({
                    title: 'Menyimpan Data',
                    text: 'Mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Gunakan FormData untuk handling file upload
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan pada sistem';

                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                // Format error validasi
                                errorMessage = '<div style="text-align: left; color: #f27474; font-size: 0.9em;">';
                                let i = 0;
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    if (i > 0) {
                                        errorMessage += '<div style="margin-top: 5px;border-top: 1px solid #f2747450; padding-top: 5px;"></div>';
                                    }
                                    errorMessage += value;
                                    i++;
                                });
                                errorMessage += '</div>';
                            } else if (xhr.responseJSON.message) {
                                errorMessage = '<div style="color: #f27474;">' + xhr.responseJSON.message + '</div>';
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: errorMessage,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            });

            // Preview file yang diupload
            $('input[type="file"]').on('change', function() {
                const fileInput = $(this);
                const fileName = fileInput.val().split('\\').pop();

                if (fileName) {
                    const fileTypeMessage = `File dipilih: ${fileName}`;
                    fileInput.next('.form-text').html(fileTypeMessage);
                } else {
                    fileInput.next('.form-text').html('Upload file bukti disini');
                }
            });
        });
    </script>
@endpush
