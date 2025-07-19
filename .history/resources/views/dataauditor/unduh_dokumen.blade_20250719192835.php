@extends('dataauditor/dashboard_template')

@section('menuDaftarAuditee')
    <li class="nav-item mt-2">
        <a href="{{ route('auditor.daftarAuditee') }}" class="nav-link text-active-primary ms-0 me-10 py-5">
            <i class="fas fa-list me-2"></i> Daftar Auditee
        </a>
    </li>
@endsection

@section('menuPenilaianInstrumenProdi')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.penilaianInstrumenProdi') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i> Penilaian Instrumen Prodi
                </a>
            </li>
        @endif
    @endforeach
@endsection

@section('menuUnduhDokumen')
    @foreach($pengajuan->auditors as $penugasan)
        @if($penugasan->role == 'ketua' && $penugasan->user_id == Auth::id())
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('auditor.audit.unduhDokumen') ? 'active' : '' }}">
                    <i class="fas fa-download me-2"></i> Unduh Dokumen
                </a>
            </li>
        @endif
    @endforeach
@endsection
@section('dashboardProfile')
    <!-- Back Button -->
    <div class="mb-5">
        <a href="{{ route('auditor.audit.penilaianInstrumenProdi', $pengajuan->id) }}" class="btn btn-light-primary btn-sm">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Penilaian Instrumen Prodi
        </a>
    </div>

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
        <div class="card-body border-top p-9">
            <div class="alert bg-light-warning d-flex align-items-center p-5 mb-10 border border-warning border-dashed rounded-3">
                <div class="d-flex align-items-center justify-content-center bg-warning text-white rounded-circle p-3 me-4" style="width: 40px; height: 40px;">
                    <i class="bi bi-file-earmark-text fs-2"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bolder text-dark mb-3">Dokumen Hasil Audit</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mb-2">
                            <span class="fw-semibold text-gray-800">
                                Pada halaman ini, Anda dapat mengakses dan mengelola berbagai dokumen hasil audit, termasuk:
                            </span>
                        </p>
                        <ul class="mb-0">
                            <li class="mb-1">Berita Acara Audit</li>
                            <li class="mb-1">Evaluasi Audit Mutu Internal</li>
                            <li class="mb-1">Daftar Pertanyaan Audit</li>
                            <li>Laporan Audit Mutu Internal</li>
                        </ul>
                    </div>
                </div>
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
                                                    <i class="fas fa-edit me-2"></i> {{ $evaluasiSubmissions->count() > 0 ? 'Update Evaluasi' : 'Isi Evaluasi' }}
                                                </button>
                                                @if($evaluasiSubmissions->count() > 0)
                                                    <a href="{{ route('auditor.audit.viewEvaluasiAmi', [$pengajuan->id]) }}" target="_blank" class="btn btn-sm btn-info px-4">
                                                        <i class="fas fa-file-pdf me-2"></i> Lihat PDF
                                                    </a>
                                                @endif
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
                                                    <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                                </div>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#laporanAmiModal">
                                                    <i class="fas fa-edit me-2"></i> {{ $jawabanKuisioner->count() > 0 ? 'Update Kuisioner' : 'Isi Kuisioner' }}
                                                </button>
                                                @if($jawabanKuisioner->count() > 0)
                                                    <form action="{{ route('auditor.audit.laporanAmi', [$pengajuan->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-info px-4" formtarget="_blank">
                                                            <i class="fas fa-file-pdf me-2"></i> Lihat PDF
                                                        </button>
                                                    </form>
                                                @endif
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
                <form id="evaluasiAmiForm" action="{{ route('auditor.audit.evaluasiAmi',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert bg-light-primary border border-primary border-dashed rounded-3 p-5 mb-10">
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Petunjuk Pengisian:</h4>
                                    <ul class="list-unstyled text-gray-600 fs-6 mb-0">
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Bacalah setiap pertanyaan dengan teliti</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pilih salah satu jawaban yang paling sesuai untuk setiap pertanyaan</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pastikan semua pertanyaan telah dijawab sebelum menyimpan</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Klik tombol "Simpan" setelah selesai mengisi semua pertanyaan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="card bg-light-info border-0 mb-10">
                                <div class="card-header min-h-65px py-5 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label bg-primary">
                                                <i class="fas fa-info-circle text-white fs-1"></i>
                                            </span>
                                        </div>
                                        <h3 class="card-title align-items-start flex-column m-0">
                                            <span class="fw-bold fs-2x mb-1 text-dark">Nilai Tingkat Kesuksesan</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-3">
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-success fs-2 d-block mb-1 fw-bold">4</span>
                                                <span class="fw-semibold fs-7">Sangat sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-primary fs-2 d-block mb-1 fw-bold">3</span>
                                                <span class="fw-semibold fs-7">Sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-warning fs-2 d-block mb-1 fw-bold">2</span>
                                                <span class="fw-semibold fs-7">Kurang sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-danger fs-2 d-block mb-1 fw-bold">1</span>
                                                <span class="fw-semibold fs-7">Tidak sesuai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php $questionNumber = 1; @endphp
                            @foreach($evaluasis as $evaluasi)
                                @if($evaluasi->is_nilai)
                                    <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-5">
                                                <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-2 min-w-45px min-h-45px me-3">
                                                    <span class="text-primary fw-bolder fs-3">{{ $questionNumber++ }}</span>
                                                </div>
                                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ $evaluasi->evaluasi }}</label>
                                            </div>
                                            <div class="ms-12">
                                                <div class="row g-2">
                                                    @for($i = 4; $i >= 1; $i--)
                                                        <div class="col-xl-3 col-sm-6">
                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-4 h-100 {{ isset($evaluasiSubmissions[$evaluasi->id]) && $evaluasiSubmissions[$evaluasi->id]->nilai == $i ? 'active' : '' }}" for="nilai_{{ $evaluasi->id }}_{{ $i }}">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai[{{ $evaluasi->nomor }}]"
                                                                        id="nilai_{{ $evaluasi->id }}_{{ $i }}"
                                                                        value="{{ $i }}"
                                                                        {{ isset($evaluasiSubmissions[$evaluasi->id]) && $evaluasiSubmissions[$evaluasi->id]->nilai == $i ? 'checked' : '' }}>
                                                                </span>
                                                                <span class="ms-4">
                                                                    <span class="fs-4 fw-bolder text-dark d-block">{{ $i }}</span>
                                                                    <span class="fw-semibold fs-7 text-gray-600">
                                                                        @if($i == 4) Sangat sesuai
                                                                        @elseif($i == 3) Sesuai
                                                                        @elseif($i == 2) Kurang sesuai
                                                                        @else Tidak sesuai
                                                                        @endif
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="separator my-10"></div>
                                    <div class="card bg-light border-0 mb-8">
                                        <div class="card-body py-4">
                                            <div class="d-flex align-items-center">
                                                <span class="bullet bullet-vertical h-40px bg-primary me-5"></span>
                                                <h3 class="card-title fw-bolder text-dark fs-2 mb-0">{{ $evaluasi->evaluasi }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    @php $questionNumber = 1; @endphp
                                @endif
                            @endforeach

                            <div class="separator my-10"></div>
                            <div class="card bg-light border-0 mb-8">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bullet-vertical h-40px bg-success me-5"></span>
                                        <h3 class="card-title fw-bolder text-dark fs-2 mb-0">Masukan</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">1</span>
                                        </div>
                                        <label for="materi_instrumen" class="form-label fw-bolder text-dark fs-6 mb-0">Materi/instrumen Audit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="materi_instrumen" name="materi_instrumen" rows="3" placeholder="Tuliskan materi/instrumen audit disini...">{{ $evaluasiMasukan->materi_instrumen ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">2</span>
                                        </div>
                                        <label for="pelaksanaan_audit" class="form-label fw-bolder text-dark fs-6 mb-0">Pelaksanaan Audit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="pelaksanaan_audit" name="pelaksanaan_audit" rows="3" placeholder="Tuliskan pelaksanaan audit disini...">{{ $evaluasiMasukan->pelaksanaan_audit ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">3</span>
                                        </div>
                                        <label for="saran_teraudit" class="form-label fw-bolder text-dark fs-6 mb-0">Saran untuk teraudit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="saran_teraudit" name="saran_teraudit" rows="3" placeholder="Tuliskan saran untuk teraudit disini...">{{ $evaluasiMasukan->saran_teraudit ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitEvaluasi">
                            <span class="indicator-label">
                                <i class="fas fa-print me-2"></i> Simpan
                            </span>
                            <span class="indicator-progress">
                                Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Laporan AMI -->
    <div class="modal fade" id="laporanAmiModal" tabindex="-1" aria-labelledby="laporanAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporanAmiModalLabel">Evaluasi Sistem Penjaminan Mutu Internal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.laporanAmi', [$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert bg-light-primary border border-primary border-dashed rounded-3 p-5 mb-10">
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Petunjuk Pengisian:</h4>
                                    <ul class="list-unstyled text-gray-600 fs-6 mb-0">
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Bacalah setiap pertanyaan dengan teliti</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pilih salah satu jawaban yang paling sesuai untuk setiap pertanyaan</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pastikan semua pertanyaan telah dijawab sebelum menyimpan</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Klik tombol "Simpan" setelah selesai mengisi semua pertanyaan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach ($kuisioners as $index => $kuisioner)
                                        <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-5">
                                                    <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-2 min-w-45px min-h-45px me-3">
                                                        <span class="text-primary fw-bolder fs-3">{{ $index + 1 }}</span>
                                                    </div>
                                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ $kuisioner->pertanyaan }}</label>
                                                </div>
                                                <div class="ms-12">
                                                    <div class="row g-2">
                                                        @foreach ($kuisioner->opsis as $opsi)
                                                            @php
                                                                $selected = false;
                                                                foreach ($jawabanKuisioner as $jawaban) {
                                                                    if ($jawaban->kuisioner_id == $kuisioner->id && $jawaban->kuisioner_opsi_id == $opsi->id) {
                                                                        $selected = true;
                                                                    }
                                                                }
                                                            @endphp
                                                            <div class="col-xl-3 col-sm-6">
                                                                <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-4 h-100 {{ $selected ? 'active' : '' }}" for="opsi_{{ $kuisioner->id }}_{{ $opsi->id }}">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="jawaban[{{ $kuisioner->id }}]"
                                                                            id="opsi_{{ $kuisioner->id }}_{{ $opsi->id }}"
                                                                            value="{{ $opsi->id }}"
                                                                            {{ $selected ? 'checked' : '' }}>
                                                                    </span>
                                                                    <span class="ms-4">
                                                                        <span class="fs-4 fw-bolder text-dark d-block">{{ $opsi->opsi }}</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitLaporan">
                            <span class="indicator-label">
                                <i class="fas fa-save me-2"></i> Simpan
                            </span>
                            <span class="indicator-progress">
                                Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('evaluasiAmiForm');
        const submitButton = document.getElementById('submitEvaluasi');
        const evaluasiModal = document.getElementById('evaluasiAmiModal');

        function resetRadioButtonsDisplay() {
            // Remove active class from all radio button labels
            document.querySelectorAll('.btn.btn-outline').forEach(label => {
                label.classList.remove('active');
            });
        }

        // Add modal event listener for resetting form
        if (evaluasiModal) {
            evaluasiModal.addEventListener('hidden.bs.modal', function () {
                // Reset form
                form.reset();

                // Remove validation classes
                form.querySelectorAll('.border-danger').forEach(el => {
                    el.classList.remove('border-danger');
                });
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // Reset radio button display
                resetRadioButtonsDisplay();

                // Reset button state
                submitButton.removeAttribute('data-kt-indicator');
                submitButton.disabled = false;
            });

            // Add event listener for when modal is about to be shown
            evaluasiModal.addEventListener('show.bs.modal', function () {
                // Reset form and display before showing
                form.reset();
                resetRadioButtonsDisplay();
            });
        }

        // Add change event listener to radio buttons to handle display
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // First remove active class from all labels in this group
                const name = this.getAttribute('name');
                document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
                    input.closest('.btn').classList.remove('active');
                });

                // Add active class to selected radio's label
                if (this.checked) {
                    this.closest('.btn').classList.add('active');
                }
            });
        });

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi form
                let isValid = true;
                let firstInvalidElement = null;

                // Validasi radio buttons
                const radioGroups = {};
                form.querySelectorAll('input[type="radio"]').forEach(radio => {
                    const name = radio.getAttribute('name');
                    if (!radioGroups[name]) {
                        radioGroups[name] = false;
                    }
                    if (radio.checked) {
                        radioGroups[name] = true;
                    }
                });

                // Cek setiap grup radio
                for (const [name, isChecked] of Object.entries(radioGroups)) {
                    if (!isChecked) {
                        isValid = false;
                        const radioGroup = form.querySelector(`input[name="${name}"]`).closest('.card');
                        if (!firstInvalidElement) {
                            firstInvalidElement = radioGroup;
                        }
                        radioGroup.classList.add('border-danger');
                    }
                }

                // Validasi textarea
                const requiredTextareas = ['materi_instrumen', 'pelaksanaan_audit', 'saran_teraudit'];
                requiredTextareas.forEach(id => {
                    const textarea = document.getElementById(id);
                    if (!textarea.value.trim()) {
                        isValid = false;
                        textarea.classList.add('is-invalid');
                        if (!firstInvalidElement) {
                            firstInvalidElement = textarea;
                        }
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        title: 'Periksa Kembali',
                        text: 'Mohon lengkapi semua isian yang diperlukan',
                        icon: 'warning',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    });

                    if (firstInvalidElement) {
                        firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Disable button dan tampilkan loading
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                // Create form data
                const formData = new FormData(form);

                // Submit form
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Check if the response is a PDF
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/pdf')) {
                            return response.blob();
                        }
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data instanceof Blob) {
                        // Handle PDF response
                        const url = window.URL.createObjectURL(data);
                        window.open(url, '_blank');

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('evaluasiAmiModal'));
                        modal.hide();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data evaluasi berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload halaman setelah user klik Ok
                                window.location.reload();
                            }
                        });
                    } else {
                        // Handle JSON response (error case)
                        if (!data.success) {
                            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: error.message || 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    });
                })
                .finally(() => {
                    // Enable button dan hilangkan loading
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                });
            });

            // Reset validation on input
            form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const card = this.closest('.card');
                    if (card) {
                        card.classList.remove('border-danger');
                    }
                });
            });

            form.querySelectorAll('textarea').forEach(textarea => {
                textarea.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        }
    });
</script>

<style>
    .card.border-danger {
        border-color: #dc3545 !important;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }
    [data-kt-indicator='on'] {
        position: relative;
        cursor: not-allowed;
    }
    [data-kt-indicator='on'] .indicator-label {
        display: none;
    }
    [data-kt-indicator='on'] .indicator-progress {
        display: inline-block;
    }
    .indicator-progress {
        display: none;
    }
</style>
@endpush
