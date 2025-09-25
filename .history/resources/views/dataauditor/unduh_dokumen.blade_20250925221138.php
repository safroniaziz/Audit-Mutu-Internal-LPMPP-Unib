@extends('dataauditor/dashboard_template')

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

    <!-- Main Card -->
    <div class="card shadow-sm border-0">
        <!-- Card Header -->
        <div class="card-header cursor-pointer pt-5 pb-3">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body pt-0">


            <!-- Information Alert -->
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-4 mb-8 mt-5">
                <i class="fas fa-info-circle fs-2 text-primary me-3"></i>
                <div class="fw-semibold">
                    <h5 class="text-dark fw-bold mb-2">Dokumen Hasil Audit</h5>
                    <div class="fs-6 text-gray-700">
                        <p class="mb-2">Pada halaman ini, Anda dapat mengakses dan mengelola berbagai dokumen hasil audit, termasuk:</p>
                        <ul class="mb-0">
                            <li class="mb-1">Berita Acara Audit</li>
                            <li class="mb-1">Evaluasi Audit Mutu Internal</li>
                            <li class="mb-1">Daftar Pertanyaan Audit</li>
                            <li>Laporan Audit Mutu Internal</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Documents List -->
            <div class="row g-6">
                <!-- Berita Acara -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-bordered shadow-sm h-100 hover-elevate-up">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-file-alt text-primary fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-1">Berita Acara</h5>
                                    <span class="text-muted fs-7">Dokumen resmi hasil audit</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                @if($pengajuan->catatan_visitasi)
                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#beritaAcaraModal">
                                        <i class="fas fa-edit me-2"></i> Update Catatan
                                    </button>
                                    <a href="{{ route('auditor.audit.viewBeritaAcara', [$pengajuan->id]) }}" target="_blank" class="btn btn-sm btn-info px-4">
                                        <i class="fas fa-file-pdf me-2"></i> Lihat PDF
                                    </a>
                                @else
                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#beritaAcaraModal">
                                        <i class="fas fa-edit me-2"></i> Isi Catatan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evaluasi AMI -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-bordered shadow-sm h-100 hover-elevate-up">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-clipboard-check text-success fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-1">Evaluasi AMI</h5>
                                    <span class="text-muted fs-7">Evaluasi Audit Mutu Internal</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#evaluasiAmiModal">
                                    <i class="fas fa-edit me-2"></i> {{ $evaluasiSubmissions->count() > 0 ? 'Update Evaluasi' : 'Isi Evaluasi' }}
                                </button>
                                @if($evaluasiSubmissions->count() > 0)
                                    <a href="{{ route('auditor.audit.viewEvaluasiAmi', [$pengajuan->id]) }}" target="_blank" class="btn btn-sm btn-info px-4">
                                        <i class="fas fa-file-pdf me-2"></i> Lihat PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Pertanyaan -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-bordered shadow-sm h-100 hover-elevate-up">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-light-warning">
                                        <i class="fas fa-list-ul text-warning fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-1">Daftar Pertanyaan</h5>
                                    <span class="text-muted fs-7">Pertanyaan audit yang digunakan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('auditor.audit.daftarPertanyaan',[$pengajuan->id]) }}" target="_blank" class="btn btn-sm btn-primary px-4">
                                    <i class="fas fa-print me-2"></i> Cetak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laporan AMI -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-bordered shadow-sm h-100 hover-elevate-up">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-light-danger">
                                        <i class="fas fa-file-signature text-danger fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-1">Laporan AMI</h5>
                                    <span class="text-muted fs-7">Laporan Audit Mutu Internal</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
    <div class="col-12">
        <!-- Ringkasan Statistik -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Ringkasan Statistik</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Sasaran Strategis Statistics -->
                    <div class="col-md-6">
                        <h6 class="text-primary">Sasaran Strategis</h6>
                        @php
                            $totalSasaran = $sortedGrouped->where('has_data', true)->count();
                            $avgSasaran = $sortedGrouped->where('has_data', true)->avg('rata_rata');
                            $maxSasaran = $sortedGrouped->where('has_data', true)->max('rata_rata');
                            $minSasaran = $sortedGrouped->where('has_data', true)->min('rata_rata');
                        @endphp
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-primary">{{ $totalSasaran }}</div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-success">{{ number_format($avgSasaran ?? 0, 2) }}</div>
                                    <small class="text-muted">Rata-rata</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-info">{{ number_format($maxSasaran ?? 0, 2) }}</div>
                                    <small class="text-muted">Tertinggi</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-warning">{{ number_format($minSasaran ?? 0, 2) }}</div>
                                    <small class="text-muted">Terendah</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instrumen Prodi Statistics -->
                    <div class="col-md-6">
                        <h6 class="text-success">Instrumen Prodi</h6>
                        @php
                            $totalKriteria = count($kriteriaScores);
                            $avgKriteria = collect($kriteriaScores)->avg('rata_rata');
                            $maxKriteria = collect($kriteriaScores)->max('rata_rata');
                            $minKriteria = collect($kriteriaScores)->min('rata_rata');
                        @endphp
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-primary">{{ $totalKriteria }}</div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-success">{{ number_format($avgKriteria ?? 0, 2) }}</div>
                                    <small class="text-muted">Rata-rata</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-info">{{ number_format($maxKriteria ?? 0, 2) }}</div>
                                    <small class="text-muted">Tertinggi</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-warning">{{ number_format($minKriteria ?? 0, 2) }}</div>
                                    <small class="text-muted">Terendah</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visualisasi Nilai Sasaran -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Visualisasi Nilai Sasaran</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="kt_radar_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualisasi Nilai Instrumen Prodi -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Visualisasi Nilai Instrumen Prodi</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="kt_radar_chart_prodi"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Tables -->
    <div class="row mt-4">
        <!-- Detail Nilai Sasaran Strategis -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Nilai Sasaran Strategis</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Sasaran</th>
                                    <th>Rata-Rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sortedGrouped as $index => $group)
                                    @if($group['has_data'])
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><span class="badge bg-primary">{{ $group['kode_satuan'] }}</span></td>
                                            <td>{{ $group['sasaran'] }}</td>
                                            <td>
                                                <span class="badge bg-success">{{ number_format($group['rata_rata'], 2) }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Nilai Instrumen Prodi -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Nilai Instrumen Prodi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>Kode</th>
                                    <th>Kriteria</th>
                                    <th>Rata-Rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                                    @if($ikssAuditee->visitasi->isNotEmpty())
                                        @foreach($ikssAuditee->visitasi as $visitasi)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        IKSS
                                                        @if($ikssAuditee->instrumen && $ikssAuditee->instrumen->indikatorKinerja && $ikssAuditee->instrumen->indikatorKinerja->satuanStandar)
                                                            {{ $ikssAuditee->instrumen->indikatorKinerja->satuanStandar->kode_satuan }}.{{ $loop->index + 1 }}
                                                        @else
                                                            {{ $index + 1 }}.{{ $loop->index + 1 }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{ $ikssAuditee->instrumen->indikator ?? 'N/A' }}</td>
                                                <td>{{ $visitasi->pernyataan ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Berita Acara -->
    <div class="modal fade" id="beritaAcaraModal" tabindex="-1" aria-labelledby="beritaAcaraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaAcaraModalLabel">
                        {{ $pengajuan->catatan_visitasi ? 'Update Catatan Visitasi' : 'Isi Catatan Visitasi' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="beritaAcaraForm" action="{{ route('auditor.audit.beritaAcara',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catatan_visitasi" class="form-label fw-bold">Tuliskan catatan Visitasi disini (minimal 10 karakter)</label>
                            <textarea class="form-control" id="catatan_visitasi" name="catatan_visitasi" rows="5" placeholder="Isi catatan visitasi disini...">{{ $pengajuan->catatan_visitasi ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitBeritaAcara">
                            <span class="indicator-label">
                                <i class="fas fa-save me-2"></i> {{ $pengajuan->catatan_visitasi ? 'Update' : 'Simpan' }}
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
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
                <form action="{{ route('auditor.audit.saveKuisioner', [$pengajuan->id]) }}" method="POST">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if we have data for charts
            const sortedGrouped = @json($sortedGrouped->where('has_data', true)->values());
            const kriteriaScores = @json($kriteriaScores);

            // Only create charts if we have data
            if (sortedGrouped.length > 0) {
                // Prepare data for Sasaran Strategis Radar Chart
                const labels = sortedGrouped.map(item => item.kode_satuan);
                const values = sortedGrouped.map(item => parseFloat(item.rata_rata) || 0);

                // Data for Sasaran Strategis Radar Chart
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Nilai Sasaran Strategis',
                        data: values,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                    }]
                };

                const configRadar = {
                    type: 'radar',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        elements: {
                            line: {
                                borderWidth: 2
                            }
                        },
                        scales: {
                            r: {
                                angleLines: {
                                    display: true,
                                    color: 'rgba(210, 210, 210, 0.5)',
                                    lineWidth: 1
                                },
                                grid: {
                                    color: 'rgba(210, 210, 210, 0.5)',
                                    circular: true
                                },
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    max: 4,
                                    backdropColor: 'transparent',
                                    color: '#666',
                                    font: {
                                        size: 10
                                    }
                                },
                                pointLabels: {
                                    font: {
                                        size: 10,
                                        weight: 'bold'
                                    },
                                    color: '#333',
                                    padding: 15
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 15,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        // Find the original data item to get more details
                                        const groupItem = sortedGrouped.find(item => item.kode_satuan === context.label);
                                        return [
                                            `Kode: ${groupItem.kode_satuan}`,
                                            `Nilai: ${context.raw.toFixed(2)}`,
                                            `Sasaran: ${groupItem.sasaran}`
                                        ];
                                    }
                                }
                            }
                        }
                    }
                };

                // Create Sasaran Strategis chart
                const ctxRadar = document.getElementById('kt_radar_chart');
                if (ctxRadar) {
                    new Chart(ctxRadar, configRadar);
                }
            }

            // Only create Instrumen Prodi chart if we have data
            if (kriteriaScores.length > 0) {
                // Prepare data for Instrumen Prodi Radar Chart
                const labelsProdi = kriteriaScores.map(item => item.kode_kriteria);
                const valuesProdi = kriteriaScores.map(item => parseFloat(item.rata_rata) || 0);

                // Data for Instrumen Prodi Radar Chart
                const dataProdi = {
                    labels: labelsProdi,
                    datasets: [{
                        label: 'Nilai Instrumen Prodi',
                        data: valuesProdi,
                        fill: true,
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(40, 167, 69, 1)'
                    }]
                };

                const configRadarProdi = {
                    type: 'radar',
                    data: dataProdi,
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        elements: {
                            line: {
                                borderWidth: 2
                            }
                        },
                        scales: {
                            r: {
                                angleLines: {
                                    display: true,
                                    color: 'rgba(210, 210, 210, 0.5)',
                                    lineWidth: 1
                                },
                                grid: {
                                    color: 'rgba(210, 210, 210, 0.5)',
                                    circular: true
                                },
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    max: 4,
                                    backdropColor: 'transparent',
                                    color: '#666',
                                    font: {
                                        size: 10
                                    }
                                },
                                pointLabels: {
                                    font: {
                                        size: 10,
                                        weight: 'bold'
                                    },
                                    color: '#333',
                                    padding: 15
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 15,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        // Find the original data item to get more details
                                        const kriteriaItem = kriteriaScores.find(item => item.kode_kriteria === context.label);
                                        return [
                                            `Kriteria: ${kriteriaItem.kode_kriteria}`,
                                            `Nilai: ${context.raw.toFixed(2)}`,
                                            `Nama: ${kriteriaItem.nama_kriteria}`
                                        ];
                                    }
                                }
                            }
                        }
                    }
                };

                // Create Instrumen Prodi chart
                const ctxRadarProdi = document.getElementById('kt_radar_chart_prodi');
                if (ctxRadarProdi) {
                    new Chart(ctxRadarProdi, configRadarProdi);
                }
            }
        });

        // Handle form submission for kuisioner with AJAX
        document.getElementById('submitLaporan').addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const submitBtn = this;
            const formData = new FormData(form);

            // Show loading state
            submitBtn.setAttribute('data-kt-indicator', 'on');

            // Validate if all questions are answered
            const radioButtons = form.querySelectorAll('input[type="radio"]:checked');
            const totalQuestions = form.querySelectorAll('input[type="radio"]').length / 4; // Assuming 4 options per question

            if (radioButtons.length < totalQuestions) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Pastikan semua pertanyaan telah dijawab sebelum menyimpan',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107',
                    confirmButtonText: 'OK'
                });
                submitBtn.removeAttribute('data-kt-indicator');
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Apakah Anda yakin ingin menyimpan evaluasi kuisioner ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message || 'Evaluasi kuisioner berhasil disimpan',
                                icon: 'success',
                                confirmButtonColor: '#28a745',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Close modal and refresh page
                                const modal = bootstrap.Modal.getInstance(document.getElementById('laporanAmiModal'));
                                if (modal) {
                                    modal.hide();
                                }
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                                icon: 'error',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    })
                    .finally(() => {
                        // Hide loading state
                        submitBtn.removeAttribute('data-kt-indicator');
                    });
                } else {
                    // Hide loading state if cancelled
                    submitBtn.removeAttribute('data-kt-indicator');
                }
            });
        });

        // Handle form submission for berita acara with AJAX
        document.getElementById('submitBeritaAcara').addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const submitBtn = this;
            const formData = new FormData(form);

            // Show loading state
            submitBtn.setAttribute('data-kt-indicator', 'on');

            // Validate if catatan visitasi is filled
            const catatanVisitasi = form.querySelector('#catatan_visitasi').value.trim();

            if (!catatanVisitasi) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Catatan visitasi harus diisi sebelum disimpan',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107',
                    confirmButtonText: 'OK'
                });
                submitBtn.removeAttribute('data-kt-indicator');
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Apakah Anda yakin ingin menyimpan catatan visitasi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message || 'Catatan visitasi berhasil disimpan',
                                icon: 'success',
                                confirmButtonColor: '#28a745',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Close modal and refresh page
                                const modal = bootstrap.Modal.getInstance(document.getElementById('beritaAcaraModal'));
                                if (modal) {
                                    modal.hide();
                                }
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                                icon: 'error',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    })
                    .finally(() => {
                        // Hide loading state
                        submitBtn.removeAttribute('data-kt-indicator');
                    });
                } else {
                    // Hide loading state if cancelled
                    submitBtn.removeAttribute('data-kt-indicator');
                }
            });
        });
    </script>
@endpush
