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


                        <!-- Debug Info -->
            <div class="alert alert-info mb-4">
                <h6 class="fw-bold">Debug Info:</h6>
                <p><strong>Total Jawaban Kuisioner:</strong> {{ $jawabanKuisioner->count() }}</p>
                <p><strong>Total Instrumen Prodi Nilai:</strong> {{ $instrumenProdiNilai->count() }}</p>
                <p><strong>Total Evaluasi Submissions:</strong> {{ $evaluasiSubmissions->count() }}</p>
                <p><strong>Pengajuan ID:</strong> {{ $pengajuan->id }}</p>
                <p><strong>Total Kuisioners:</strong> {{ $kuisioners->count() }}</p>
 
                @if($jawabanKuisioner->count() > 0)
                    <p><strong>Sample Jawaban Kuisioner:</strong></p>
                    <ul>
                        @foreach($jawabanKuisioner->take(3) as $jawaban)
                            <li>
                                ID: {{ $jawaban->id }},
                                Pengajuan ID: {{ $jawaban->pengajuan_id }},
                                Kuisioner ID: {{ $jawaban->kuisioner_id }},
                                Opsi ID: {{ $jawaban->kuisioner_opsi_id }},
                                Opsi Text: {{ $jawaban->opsi->opsi ?? 'NULL' }},
                                Penugasan Auditor ID: {{ $jawaban->penugasan_auditor_id }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p><strong>No Kuisioner Data Found!</strong></p>
                    <p>Checking if data exists in database...</p>
                    <p>Query: SELECT * FROM kuisioner_jawabans WHERE pengajuan_id = {{ $pengajuan->id }}</p>
                @endif

                @if($instrumenProdiNilai->count() > 0)
                    <p><strong>Sample Instrumen Prodi Nilai:</strong></p>
                    <ul>
                        @foreach($instrumenProdiNilai->take(3) as $nilai)
                            <li>
                                ID: {{ $nilai->id }},
                                Instrumen Prodi ID: {{ $nilai->instrumen_prodi_id }},
                                Auditor ID: {{ $nilai->auditor_id }},
                                Nilai: {{ $nilai->nilai }},
                                Kriteria: {{ $nilai->instrumenProdi->indikatorInstrumenKriteria->nama_kriteria ?? 'NULL' }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p><strong>No Instrumen Prodi Nilai Found!</strong></p>
                    <p>Query: SELECT * FROM instrumen_prodi_nilais WHERE pengajuan_ami_id = {{ $pengajuan->id }}</p>
                @endif
 
                @if($kuisioners->count() > 0)
                    <p><strong>Sample Kuisioners:</strong></p>
                    <ul>
                        @foreach($kuisioners->take(3) as $kuisioner)
                            <li>
                                ID: {{ $kuisioner->id }},
                                Pertanyaan: {{ Str::limit($kuisioner->pertanyaan, 50) }},
                                Total Opsi: {{ $kuisioner->opsis->count() }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Ringkasan Statistik -->
            @php
                $totalEvaluasiRSB = $evaluasiSubmissions->count();
                $avgRSB = $evaluasiSubmissions->count() > 0 ? round($evaluasiSubmissions->avg('nilai'), 2) : 0;
                $maxRSB = $evaluasiSubmissions->count() > 0 ? $evaluasiSubmissions->max('nilai') : 0;
                $minRSB = $evaluasiSubmissions->count() > 0 ? $evaluasiSubmissions->min('nilai') : 0;

                $totalKuisionerProdi = $jawabanKuisioner->count();
                $totalNilaiProdi = 0;
                foreach($jawabanKuisioner as $jawaban) {
                    if($jawaban->opsi) {
                        $opsiText = strtolower($jawaban->opsi->opsi);
                        if(strpos($opsiText, 'sangat sesuai') !== false || strpos($opsiText, 'sangat baik') !== false) $totalNilaiProdi += 4;
                        elseif(strpos($opsiText, 'sesuai') !== false || strpos($opsiText, 'baik') !== false) $totalNilaiProdi += 3;
                        elseif(strpos($opsiText, 'kurang sesuai') !== false || strpos($opsiText, 'kurang baik') !== false) $totalNilaiProdi += 2;
                        elseif(strpos($opsiText, 'tidak sesuai') !== false || strpos($opsiText, 'tidak baik') !== false) $totalNilaiProdi += 1;
                    }
                }
                $avgProdi = $totalKuisionerProdi > 0 ? round($totalNilaiProdi / $totalKuisionerProdi, 2) : 0;
            @endphp

            <div class="card shadow-sm border-0 mb-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title fw-bold text-dark">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        Ringkasan Statistik
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Instrumen RSB Stats -->
                        <div class="col-lg-6">
                            <div class="border-end border-gray-300 pe-4">
                                <h5 class="text-dark fw-bold mb-4">
                                    <i class="fas fa-chart-line me-2 text-primary"></i>
                                    Instrumen RSB (Evaluasi)
                                </h5>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-primary">
                                                    <i class="fas fa-list text-primary"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="text-muted d-block fs-8">Total Evaluasi</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $totalEvaluasiRSB }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-success">
                                                    <i class="fas fa-chart-line text-success"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="text-muted d-block fs-8">Rata-rata</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $avgRSB }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-warning">
                                                    <i class="fas fa-arrow-up text-warning"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="text-muted d-block fs-8">Tertinggi</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $maxRSB }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-danger">
                                                    <i class="fas fa-arrow-down text-danger"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="text-muted d-block fs-8">Terendah</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $minRSB }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instrumen Prodi Stats -->
                        <div class="col-lg-6">
                            <h5 class="text-dark fw-bold mb-4">
                                <i class="fas fa-chart-line me-2 text-success"></i>
                                Instrumen Prodi (Kuisioner)
                            </h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-light-success">
                                                <i class="fas fa-list text-success"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-muted d-block fs-8">Total Kuisioner</span>
                                            <span class="fw-bold fs-5 text-dark">{{ $totalKuisionerProdi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-light-info">
                                                <i class="fas fa-chart-line text-info"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-muted d-block fs-8">Rata-rata</span>
                                            <span class="fw-bold fs-5 text-dark">{{ $avgProdi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-light-warning">
                                                <i class="fas fa-calculator text-warning"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-muted d-block fs-8">Total Nilai</span>
                                            <span class="fw-bold fs-5 text-dark">{{ $totalNilaiProdi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-light-primary">
                                                <i class="fas fa-percentage text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-muted d-block fs-8">Progress</span>
                                            <span class="fw-bold fs-5 text-dark">{{ $totalKuisionerProdi > 0 ? round(($totalKuisionerProdi / max($totalEvaluasiRSB, 1)) * 100) : 0 }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-5 g-xl-8">
                <!-- Radar Chart RSB -->
                <div class="col-xl-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-radar-chart me-2 text-primary"></i>
                                Visualisasi Nilai Instrumen RSB
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if($evaluasiSubmissions->count() > 0)
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div style="position: relative; width: 100%; max-width: 400px; aspect-ratio: 1;">
                                        <canvas id="spiderChartRSB"></canvas>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info text-center py-8">
                                    <i class="fas fa-chart-line fs-1 text-info mb-3"></i>
                                    <h5 class="text-dark mb-2">Belum Ada Data Evaluasi RSB</h5>
                                    <p class="text-muted mb-0">Lakukan evaluasi RSB terlebih dahulu untuk melihat visualisasi nilai.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Table RSB -->
                <div class="col-xl-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-table me-2 text-primary"></i>
                                Detail Nilai Instrumen RSB
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if($evaluasiSubmissions->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-300 align-middle">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th width="5%" class="ps-4">No</th>
                                                <th width="70%">Pertanyaan Evaluasi</th>
                                                <th width="15%" class="text-center">Nilai</th>
                                                <th width="10%" class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($evaluasiSubmissions as $index => $submission)
                                                @php
                                                    $evaluasi = $evaluasis->firstWhere('id', $submission->evaluasi_id);
                                                    $nilaiLabel = '';
                                                    $nilaiClass = '';
                                                    switch($submission->nilai) {
                                                        case 4: $nilaiLabel = 'Sangat Sesuai'; $nilaiClass = 'badge-success'; break;
                                                        case 3: $nilaiLabel = 'Sesuai'; $nilaiClass = 'badge-primary'; break;
                                                        case 2: $nilaiLabel = 'Kurang Sesuai'; $nilaiClass = 'badge-warning'; break;
                                                        case 1: $nilaiLabel = 'Tidak Sesuai'; $nilaiClass = 'badge-danger'; break;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="ps-4">
                                                        <span class="text-dark fw-semibold">{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark fw-semibold">{{ $evaluasi->evaluasi ?? 'Pertanyaan tidak ditemukan' }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-lg fw-bold {{ $nilaiClass }}">{{ $submission->nilai }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-lg badge-light-success">Selesai</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info text-center py-8">
                                    <i class="fas fa-table fs-1 text-info mb-3"></i>
                                    <h5 class="text-dark mb-2">Belum Ada Data Evaluasi</h5>
                                    <p class="text-muted mb-0">Lakukan evaluasi RSB terlebih dahulu untuk melihat detail nilai.</p>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instrumen Prodi Section -->
            <div class="row g-5 g-xl-8 mt-8">
                <!-- Radar Chart for Instrumen Prodi -->
                <div class="col-xl-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-radar-chart me-2 text-success"></i>
                                Visualisasi Nilai Instrumen Prodi
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if($instrumenProdiNilai->count() > 0)
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div style="position: relative; width: 100%; max-width: 400px; aspect-ratio: 1;">
                                        <canvas id="spiderChartProdi"></canvas>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning text-center py-8">
                                    <i class="fas fa-exclamation-triangle fs-1 text-warning mb-3"></i>
                                    <h5 class="text-dark mb-2">Belum Ada Data Instrumen Prodi</h5>
                                    <p class="text-muted mb-3">Data penilaian instrumen prodi belum diisi oleh auditor.</p>
                                    <div class="d-flex flex-column gap-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Total Instrumen Prodi Nilai: {{ $instrumenProdiNilai->count() }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Total Kuisioner Jawaban: {{ $jawabanKuisioner->count() }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Pengajuan ID: {{ $pengajuan->id }}
                                        </small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Table for Instrumen Prodi -->
                <div class="col-xl-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-table me-2 text-success"></i>
                                Detail Nilai Instrumen Prodi
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if($instrumenProdiNilai->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-300 align-middle">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th width="5%" class="ps-4">No</th>
                                                <th width="60%">Kriteria Instrumen Prodi</th>
                                                <th width="15%" class="text-center">Nilai</th>
                                                <th width="20%" class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($instrumenProdiNilai as $index => $nilai)
                                                @php
                                                    $kriteria = $nilai->instrumenProdi->indikatorInstrumenKriteria ?? null;
                                                    $nilaiLabel = '';
                                                    $nilaiClass = '';
                                                    switch($nilai->nilai) {
                                                        case 4: $nilaiLabel = 'Sangat Sesuai'; $nilaiClass = 'badge-success'; break;
                                                        case 3: $nilaiLabel = 'Sesuai'; $nilaiClass = 'badge-primary'; break;
                                                        case 2: $nilaiLabel = 'Kurang Sesuai'; $nilaiClass = 'badge-warning'; break;
                                                        case 1: $nilaiLabel = 'Tidak Sesuai'; $nilaiClass = 'badge-danger'; break;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="ps-4">
                                                        <span class="text-dark fw-semibold">{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark fw-semibold">{{ $kriteria->nama_kriteria ?? 'Kriteria tidak ditemukan' }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-lg fw-bold {{ $nilaiClass }}">{{ $nilai->nilai }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-lg badge-light-success">{{ $nilaiLabel }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info text-center py-8">
                                    <i class="fas fa-table fs-1 text-info mb-3"></i>
                                    <h5 class="text-dark mb-2">Belum Ada Data Instrumen Prodi</h5>
                                    <p class="text-muted mb-0">Lakukan penilaian instrumen prodi terlebih dahulu untuk melihat detail nilai.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

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
                            <label for="catatan_visitasi" class="form-label fw-bold">Tuliskan catatan Visitasi disini</label>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('evaluasiAmiForm');
        const submitButton = document.getElementById('submitEvaluasi');
        const evaluasiModal = document.getElementById('evaluasiAmiModal');

        // Form kuisioner (laporan AMI)
        const laporanForm = document.querySelector('#laporanAmiModal form');
        const submitLaporanButton = document.getElementById('submitLaporan');

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

        // Handler untuk form kuisioner (laporan AMI)
        if (laporanForm) {
            laporanForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi form
                let isValid = true;
                let firstInvalidElement = null;

                // Validasi radio buttons untuk kuisioner
                const radioGroups = {};
                laporanForm.querySelectorAll('input[type="radio"]').forEach(radio => {
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
                        const radioGroup = laporanForm.querySelector(`input[name="${name}"]`).closest('.card');
                        if (!firstInvalidElement) {
                            firstInvalidElement = radioGroup;
                        }
                        radioGroup.classList.add('border-danger');
                    }
                }

                if (!isValid) {
                    Swal.fire({
                        title: 'Periksa Kembali',
                        text: 'Mohon lengkapi semua pertanyaan kuisioner',
                        icon: 'warning',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    });

                    if (firstInvalidElement) {
                        firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Disable button dan tampilkan loading
                submitLaporanButton.setAttribute('data-kt-indicator', 'on');
                submitLaporanButton.disabled = true;

                // Create form data
                const formData = new FormData(laporanForm);

                // Submit form
                fetch(laporanForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data.success) {
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('laporanAmiModal'));
                        modal.hide();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data kuisioner berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload halaman setelah user klik Ok
                                window.location.reload();
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
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
                    submitLaporanButton.removeAttribute('data-kt-indicator');
                    submitLaporanButton.disabled = false;
                });
            });

            // Reset validation on input untuk form kuisioner
            laporanForm.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const card = this.closest('.card');
                    if (card) {
                        card.classList.remove('border-danger');
                    }
                });
            });
        }

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

    // Handle Berita Acara form submission
    const beritaAcaraForm = document.querySelector('#beritaAcaraForm');
    const submitBeritaAcaraButton = document.querySelector('#submitBeritaAcara');

    if (beritaAcaraForm) {
        beritaAcaraForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi client-side
            const catatanVisitasi = document.getElementById('catatan_visitasi').value.trim();
            if (catatanVisitasi.length < 10) {
                Swal.fire({
                    title: 'Validasi Gagal',
                    text: 'Catatan visitasi minimal 10 karakter',
                    icon: 'warning',
                    confirmButtonText: 'Baik, Saya Mengerti'
                });
                return;
            }

            // Disable button dan tampilkan loading
            submitBeritaAcaraButton.setAttribute('data-kt-indicator', 'on');
            submitBeritaAcaraButton.disabled = true;

            // Create form data
            const formData = new FormData(beritaAcaraForm);

            // Submit form via AJAX
            fetch(beritaAcaraForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Terjadi kesalahan pada server');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('beritaAcaraModal'));
                    modal.hide();

                    // Show success message
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || 'Catatan visitasi berhasil disimpan!',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Reload halaman untuk update UI
                            window.location.reload();
                        }
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
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
                submitBeritaAcaraButton.removeAttribute('data-kt-indicator');
                submitBeritaAcaraButton.disabled = false;
            });
        });
    }

            // Spider Chart untuk Jaring Laba-laba Instrumen RSB
    @if($evaluasiSubmissions->count() > 0)
        const spiderChartRSBCtx = document.getElementById('spiderChartRSB');
        if (spiderChartRSBCtx) {
            // Data untuk chart RSB
            const evaluasiData = @json($evaluasis->where('is_nilai', true)->values());
            const submissionData = @json($evaluasiSubmissions->values());

            // Siapkan data untuk chart RSB
            const labelsRSB = evaluasiData.map(e => e.evaluasi.length > 30 ? e.evaluasi.substring(0, 30) + '...' : e.evaluasi);
            const dataRSB = evaluasiData.map(evaluasi => {
                const submission = submissionData.find(s => s.evaluasi_id == evaluasi.id);
                return submission ? submission.nilai : 0;
            });

            // Buat spider chart untuk RSB
            new Chart(spiderChartRSBCtx, {
                type: 'radar',
                data: {
                    labels: labelsRSB,
                    datasets: [{
                        label: 'Instrumen RSB (Evaluasi)',
                        data: dataRSB,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 4,
                            min: 0,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    const labels = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                    return labels[value - 1] || value;
                                }
                            },
                            pointLabels: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const labels = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                    const nilai = context.parsed.r;
                                    const label = labels[nilai - 1] || 'Tidak ada';
                                    return `Nilai: ${nilai} (${label})`;
                                }
                            }
                        }
                    }
                }
            });
        }
    @endif

    // Spider Chart untuk Jaring Laba-laba Instrumen Prodi
    @if($jawabanKuisioner->count() > 0)
        const spiderChartProdiCtx = document.getElementById('spiderChartProdi');
        if (spiderChartProdiCtx) {
            // Data untuk chart Prodi
            const kuisionerData = @json($kuisioners->values());
            const jawabanData = @json($jawabanKuisioner->values());

            // Siapkan data untuk chart Prodi
            const labelsProdi = kuisionerData.map(k => k.pertanyaan.length > 30 ? k.pertanyaan.substring(0, 30) + '...' : k.pertanyaan);
            const dataProdi = kuisionerData.map(kuisioner => {
                const jawaban = jawabanData.find(j => j.kuisioner_id == kuisioner.id);
                if (jawaban && jawaban.opsi) {
                    // Konversi opsi ke nilai (sesuaikan dengan skala 1-4)
                    const opsiText = jawaban.opsi.opsi.toLowerCase();
                    if (opsiText.includes('sangat sesuai') || opsiText.includes('sangat baik')) return 4;
                    if (opsiText.includes('sesuai') || opsiText.includes('baik')) return 3;
                    if (opsiText.includes('kurang sesuai') || opsiText.includes('kurang baik')) return 2;
                    if (opsiText.includes('tidak sesuai') || opsiText.includes('tidak baik')) return 1;
                }
                return 0;
            });

            // Buat spider chart untuk Prodi
            new Chart(spiderChartProdiCtx, {
                type: 'radar',
                data: {
                    labels: labelsProdi,
                    datasets: [{
                        label: 'Instrumen Prodi (Kuisioner)',
                        data: dataProdi,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 4,
                            min: 0,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    const labels = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                    return labels[value - 1] || value;
                                }
                            },
                            pointLabels: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const labels = ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'];
                                    const nilai = context.parsed.r;
                                    const label = labels[nilai - 1] || 'Tidak ada';
                                    return `Nilai: ${nilai} (${label})`;
                                }
                            }
                        }
                    }
                }
            });
        }
    @endif
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
