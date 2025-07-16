@extends('dataauditor/dashboard_template')
@section('menuUnduhDokumen')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 disabled {{ Route::is('auditor.audit.unduhDokumen') ? 'active' : '' }}" href="{{ route('auditor.audit.unduhDokumen', [$pengajuan->id]) }}">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer bg-light">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill me-1"></i> Selamat Datang, <span class="fw-bolder">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-center p-5 position-relative border border-info border-dashed bg-light-info rounded-3">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle p-3 me-4" style="width: 40px; height: 40px;">
                        <i class="bi bi-info-circle-fill fs-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bolder text-dark mb-3"><i class="bi bi-megaphone-fill me-2"></i>Proses Selanjutnya: Unduh Dokumen Audit</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mb-2">
                                <strong class="text-dark">Catatan:</strong>
                                <span class="fw-semibold text-primary">
                                    Silakan unduh dokumen hasil audit di bawah ini. Pastikan Anda telah memeriksa isi dokumen dan memastikan kesesuaiannya.
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                        $completionPercentage = $user->getProfileCompletionPercentage();
                    @endphp
                </div>

                <!--begin::Input group-->
                <div class="row mb-6 mt-6">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-row-dashed fs-6 gy-4 mb-0">
                                        <thead>
                                            <tr class="fw-bold text-gray-800 bg-light border-bottom border-gray-300">
                                                <th class="ps-4 min-w-200px">Nama Dokumen</th>
                                                <th class="text-end pe-4">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-alt text-primary me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Berita Acara</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#beritaAcaraModal">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-clipboard-check text-success me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#evaluasiAmiModal">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-list-ul text-warning me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Daftar Pertanyaan</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('auditor.audit.daftarPertanyaan',[$pengajuan->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-signature text-danger me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Laporan Audit Mutu Internal</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#laporanAmiModal">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

    <!-- Modal Berita Acara -->
    <div class="modal fade" id="beritaAcaraModal" tabindex="-1" aria-labelledby="beritaAcaraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaAcaraModalLabel">Cetak Berita Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.beritaAcara',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catatan_visitasi" class="form-label fw-bold">Tuliskan catatan Visitasi disini</label>
                            <textarea class="form-control" id="catatan_visitasi" name="catatan_visitasi" rows="5" placeholder="Isi catatan visitasi disini..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Evaluasi AMI -->
    <div class="modal fade" id="evaluasiAmiModal" tabindex="-1" aria-labelledby="evaluasiAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluasiAmiModalLabel">Cetak Evaluasi AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.evaluasiAmi',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="card border-0 bg-light mb-4">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                        Nilai Tingkat Kesuksesan
                                    </h6>
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="d-flex align-items-center gap-2 bg-white rounded-2 p-3 shadow-sm border border-gray-200" style="min-width: 150px;">
                                            <span class="badge bg-success px-3 py-2">5</span>
                                            <span class="text-gray-700">Sangat sesuai</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 bg-white rounded-2 p-3 shadow-sm border border-gray-200" style="min-width: 150px;">
                                            <span class="badge bg-primary px-3 py-2">4</span>
                                            <span class="text-gray-700">Sesuai</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 bg-white rounded-2 p-3 shadow-sm border border-gray-200" style="min-width: 150px;">
                                            <span class="badge bg-warning px-3 py-2">3</span>
                                            <span class="text-gray-700">Kurang sesuai</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 bg-white rounded-2 p-3 shadow-sm border border-gray-200" style="min-width: 150px;">
                                            <span class="badge bg-danger px-3 py-2">2</span>
                                            <span class="text-gray-700">Tidak sesuai</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 border-0" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                                <div class="card-body">
                                    @php $questionNumber = 1; @endphp
                                    @foreach($evaluasis as $evaluasi)
                                        @if($evaluasi->is_nilai)
                                            <div class="mb-4 ms-4">
                                                <div class="position-relative">
                                                    <div class="number-circle primary">
                                                        {{ $questionNumber++ }}
                                                    </div>
                                                    <div class="content-box">
                                                        <label class="form-label fw-semibold text-dark fs-6">{{ $evaluasi->evaluasi }}</label>
                                                        <div class="d-flex gap-4 mt-3">
                                                            @for($i = 5; $i >= 2; $i--)
                                                                <div class="form-check custom-option">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai[{{ $evaluasi->nomor }}]"
                                                                        id="nilai_{{ $evaluasi->id }}_{{ $i }}"
                                                                        value="{{ $i }}"
                                                                        {{ isset($evaluasiSubmissions[$evaluasi->id]) && $evaluasiSubmissions[$evaluasi->id]->nilai == $i ? 'checked' : '' }}>
                                                                    <label class="form-check-label rounded-2 px-4 py-2" for="nilai_{{ $evaluasi->id }}_{{ $i }}"
                                                                        style="cursor: pointer; transition: all 0.3s ease;">
                                                                        <span class="fw-semibold">{{ $i }}</span>
                                                                    </label>
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="separator separator-dashed my-5"></div>
                                            <div class="d-flex align-items-center mb-4 bg-light p-3 rounded-3">
                                                <span class="bullet bullet-vertical h-40px bg-primary me-3"></span>
                                                <h5 class="fw-bold text-dark m-0">{{ $evaluasi->evaluasi }}</h5>
                                            </div>
                                            @php $questionNumber = 1; @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <style>
                            .custom-option input[type="radio"] {
                                display: none;
                            }

                            .custom-option label {
                                background-color: #f5f8fa;
                                border: 1px solid #e4e6ef;
                                color: #5e6278;
                                min-width: 45px;
                                text-align: center;
                            }

                            .custom-option input[type="radio"]:checked + label {
                                background-color: #009ef7;
                                border-color: #009ef7;
                                color: #ffffff;
                            }

                            .custom-option label:hover {
                                background-color: #eef3f7;
                            }

                            .custom-option input[type="radio"]:checked + label:hover {
                                background-color: #0095e8;
                            }

                            .badge {
                                font-size: 14px;
                                min-width: 32px;
                            }
                        </style>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-4 bg-light p-3 rounded-3">
                                <span class="bullet bullet-vertical h-40px bg-success me-3"></span>
                                <h5 class="fw-bold text-dark m-0">Masukan</h5>
                            </div>

                            <div class="card mb-4 border-0" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
                                <div class="card-body">
                                    <div class="row px-0">
                                        <div class="col-12 px-0">
                                            <div class="mb-4 ms-4 me-0">
                                                <div class="position-relative">
                                                    <div class="number-circle success">1</div>
                                                    <div class="content-box">
                                                        <label for="materi_instrumen" class="form-label fw-semibold text-dark">Materi/instrumen Audit:</label>
                                                        <textarea class="form-control" id="materi_instrumen" name="materi_instrumen" rows="3" placeholder="Isi disini..."
                                                            style="border: 1px solid #e4e6ef; background-color: #f5f8fa;"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 ms-4 me-0">
                                                <div class="position-relative">
                                                    <div class="number-circle success">2</div>
                                                    <div class="content-box">
                                                        <label for="pelaksanaan_audit" class="form-label fw-semibold text-dark">Pelaksanaan Audit:</label>
                                                        <textarea class="form-control" id="pelaksanaan_audit" name="pelaksanaan_audit" rows="3" placeholder="Isi disini..."
                                                            style="border: 1px solid #e4e6ef; background-color: #f5f8fa;"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 ms-4 me-0">
                                                <div class="position-relative">
                                                    <div class="number-circle success">3</div>
                                                    <div class="content-box">
                                                        <label for="saran_teraudit" class="form-label fw-semibold text-dark">Saran untuk teraudit:</label>
                                                        <textarea class="form-control" id="saran_teraudit" name="saran_teraudit" rows="3" placeholder="Isi disini..."
                                                            style="border: 1px solid #e4e6ef; background-color: #f5f8fa;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .row.px-0 {
                                margin-right: 0;
                                margin-left: 0;
                            }
                            .col-12.px-0 {
                                padding-right: 0;
                                padding-left: 0;
                            }
                            .content-box {
                                margin-right: 0;
                                width: 100%;
                            }
                        </style>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Laporan AMI dengan Data dari Database -->
<div class="modal fade" id="laporanAmiModal" tabindex="-1" aria-labelledby="laporanAmiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6; padding: 1rem 1.5rem;">
                <h5 class="modal-title" id="laporanAmiModalLabel" style="color: #212529; font-weight: 500;">
                    Cetak Laporan Audit Mutu Internal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('auditor.audit.laporanAmi', [$pengajuan->id]) }}" method="POST">
                @csrf
                <div class="modal-body" style="padding: 1.5rem;">
                    <!-- Judul Evaluasi dengan Style Premium -->
                    <div style="background: linear-gradient(135deg, #0062cc, #0d6efd); border-radius: 6px; margin-bottom: 20px; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.08);">
                        <h6 style="color: white; margin: 0; font-weight: 500; display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clipboard-check me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                            Evaluasi Sistem Penjaminan Mutu Internal
                        </h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table" style="border-collapse: separate; border-spacing: 0 0.5rem;">
                            <tbody>
                                @foreach ($kuisioners as $index => $kuisioner)
                                    <tr style="background-color: #ffffff; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                        <td style="color: #6c757d; vertical-align: middle; width: 35px; padding-right: 0; font-size:12px;">{{ $index + 1 }}.</td>
                                        <td style="vertical-align: middle; font-size:12px;">{{ $kuisioner->pertanyaan }}</td>
                                        <td style="width: 240px; padding-left: 20px;">
                                            <div style="display: flex; gap: 15px;">
                                                @foreach ($kuisioner->opsis as $opsi)
                                                    @php
                                                        $selected = false;
                                                        foreach ($jawabanKuisioner as $jawaban) {
                                                            if ($jawaban->kuisioner_id == $kuisioner->id && $jawaban->kuisioner_opsi_id == $opsi->id) {
                                                                $selected = true;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="form-check" style="margin: 0;">
                                                        <input class="form-check-input" type="radio" style="width: 0.9em; height: 0.9em; margin-top: 0.2em;"
                                                            name="jawaban[{{ $kuisioner->id }}]"
                                                            id="opsi_{{ $kuisioner->id }}_{{ $opsi->id }}"
                                                            value="{{ $opsi->id }}"
                                                            {{ $selected ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="opsi_{{ $kuisioner->id }}_{{ $opsi->id }}"
                                                            style="color: #212529; font-size: 0.9rem;">
                                                            {{ $opsi->opsi }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6; padding: 0.75rem 1.5rem;">
                    <button type="button" class="btn btn-light" style="border: 1px solid #ced4da; font-size: 0.875rem; padding: 10px;" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary" style="font-size: 0.875rem; padding: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                        Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk handle form submission
    document.addEventListener('DOMContentLoaded', function() {
        // Berita Acara Form
        // const beritaAcaraForm = document.querySelector('#beritaAcaraModal form');
        // if (beritaAcaraForm) {
        //     beritaAcaraForm.addEventListener('submit', function(e) {
        //         e.preventDefault();
        //         const formData = new FormData(this);

        //         fetch(this.action, {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             }
        //         })
        //         .then(response => response.blob())
        //         .then(blob => {
        //             // Tutup modal
        //             const beritaAcaraModal = bootstrap.Modal.getInstance(document.getElementById('beritaAcaraModal'));
        //             beritaAcaraModal.hide();

        //             // Download file
        //             const url = window.URL.createObjectURL(blob);
        //             const a = document.createElement('a');
        //             a.href = url;
        //             a.download = 'BeritaAcara.pdf';
        //             document.body.appendChild(a);
        //             a.click();
        //             a.remove();
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             alert('Terjadi kesalahan saat mencetak dokumen');
        //         });
        //     });
        // }

        const evaluasiAmiForm = document.querySelector('#evaluasiAmiForm');
        if (evaluasiAmiForm) {
            evaluasiAmiForm.addEventListener('submit', function(e) {
                if (!validateForm(this)) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Scroll to the first error
                    const firstError = this.querySelector('.is-invalid, .text-danger');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        }

        // Add real-time validation for textareas
        document.querySelectorAll('textarea[required]').forEach(textarea => {
            textarea.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                }
            });
        });

        // Add real-time validation for radio groups
        document.querySelectorAll('.form-check-input[required]').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.name;
                const container = this.closest('.mb-3');
                const errorMsg = container.querySelector('.text-danger');

                if (document.querySelector(`input[name="${name}"]:checked`)) {
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });
        });
    });
</script>
