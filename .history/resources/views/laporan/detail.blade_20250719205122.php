@extends('layouts.dashboard.dashboard')
@section('menu')
    Detail Laporan AMI
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('laporan.index') }}" class="text-muted text-hover-primary">Laporan AMI</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Detail Laporan</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Header Section -->
            <div class="card shadow-sm mb-8">
                <div class="card-body p-0">
                    <div class="px-10 pt-10 pb-5">
                        <div class="d-flex flex-stack mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Laporan Audit Mutu Internal</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        Periode {{ $periodeAktif->siklus }}/{{ $periodeAktif->tahun_ami }}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('laporan.daftarPertanyaan', [$pengajuanAmis->id]) }}" target="_blank"
                                   class="btn btn-light-primary">
                                    <i class="fas fa-list me-2"></i>
                                    Daftar Pertanyaan
                                </a>
                                <a href="{{ route('laporan.beritaAcara', [$pengajuanAmis->id]) }}" target="_blank"
                                   class="btn btn-light-info">
                                    <i class="fas fa-file-contract me-2"></i>
                                    Berita Acara
                                </a>
                                <a href="{{ route('laporan.laporanAmi', [$pengajuanAmis->id]) }}" target="_blank"
                                   class="btn btn-primary">
                                    <i class="fas fa-print me-2"></i>
                                    Cetak Laporan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Consolidated Info Section -->
                    <div class="py-5 px-10 bg-light-primary">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-primary text-inverse-primary">
                                            <i class="fas fa-university fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Program Studi</span>
                                        <span class="fw-bold fs-6 text-dark">{{ $pengajuanAmis->auditee->nama_unit_kerja }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-success text-inverse-success">
                                            <i class="fas fa-graduation-cap fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Fakultas</span>
                                        <span class="fw-bold fs-6 text-dark">{{ $pengajuanAmis->auditee->fakultas }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-warning text-inverse-warning">
                                            <i class="fas fa-user-tie fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Ketua Auditor</span>
                                        <span class="fw-bold fs-6 text-dark">
                                            @foreach($pengajuanAmis->auditors as $auditor)
                                                @if($auditor->role == 'ketua')
                                                    {{ $auditor->auditor->name }}
                                                @endif
                                            @endforeach
                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <div class="symbol-label bg-info text-inverse-info">
                                            <i class="fas fa-check-circle fs-2"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-muted d-block fs-7 fw-semibold">Status</span>
                                        <span class="badge badge-light-success fs-7 fw-bold">Siap Cetak</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Section -->
            <div class="card shadow-sm border-0 mb-8">
                <div class="card-body p-6">
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-4">
                        <i class="fas fa-info-circle fs-2 text-primary me-3"></i>
                        <div class="fw-semibold">
                            <h5 class="text-dark fw-bold mb-2">Informasi Laporan</h5>
                            <div class="fs-6 text-gray-700">
                                <p class="mb-2">Laporan ini berisi hasil audit mutu internal yang mencakup penilaian sasaran strategis dan instrumen prodi. Nilai rata-rata dihitung berdasarkan penilaian dari ketua dan anggota tim audit dengan skala 1-4.</p>
                                <p class="mb-0">Klik tombol "Cetak Laporan" untuk mengunduh laporan lengkap dalam format PDF.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Consolidated Statistics -->
            @php
                $totalSasaran = $sortedGrouped->where('has_data', true)->count();
                $avgRataRata = $sortedGrouped->where('has_data', true)->avg('rata_rata');
                $maxRataRata = $sortedGrouped->where('has_data', true)->max('rata_rata');
                $minRataRata = $sortedGrouped->where('has_data', true)->min('rata_rata');

                // Instrumen Prodi Statistics
                $totalKriteria = isset($kriteriaScores) ? count($kriteriaScores) : 0;
                $avgKriteria = isset($kriteriaScores) ? collect($kriteriaScores)->avg('rata_rata') : 0;
                $maxKriteria = isset($kriteriaScores) ? collect($kriteriaScores)->max('rata_rata') : 0;
                $minKriteria = isset($kriteriaScores) ? collect($kriteriaScores)->min('rata_rata') : 0;
            @endphp

            <!-- Single Statistics Card -->
            <div class="card shadow-sm border-0 mb-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title fw-bold text-dark">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        Ringkasan Statistik
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Sasaran Strategis Stats -->
                        <div class="col-lg-6">
                            <div class="border-end border-gray-300 pe-4">
                                <h5 class="text-dark fw-bold mb-4">
                                    <i class="fas fa-target me-2 text-primary"></i>
                                    Sasaran Strategis
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
                                                <span class="text-muted d-block fs-8">Total Sasaran</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $totalSasaran }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($avgRataRata, 2) }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($maxRataRata, 2) }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($minRataRata, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instrumen Prodi Stats -->
                        @if(isset($kriteriaScores) && count($kriteriaScores) > 0)
                        <div class="col-lg-6">
                            <div class="ps-4">
                                <h5 class="text-dark fw-bold mb-4">
                                    <i class="fas fa-graduation-cap me-2 text-success"></i>
                                    Instrumen Prodi
                                </h5>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-info">
                                                    <i class="fas fa-list-check text-info"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="text-muted d-block fs-8">Total Kriteria</span>
                                                <span class="fw-bold fs-5 text-dark">{{ $totalKriteria }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($avgKriteria, 2) }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($maxKriteria, 2) }}</span>
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
                                                <span class="fw-bold fs-5 text-dark">{{ number_format($minKriteria, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content Row -->
            <div class="row g-5 g-xl-8">
                <!-- Radar Chart -->
                <div class="col-xl-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-radar-chart me-2 text-primary"></i>
                                Visualisasi Nilai Sasaran
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div style="position: relative; width: 100%; max-width: 400px; aspect-ratio: 1;">
                                    <canvas id="kt_radar_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Table -->
                <div class="col-xl-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-table me-2 text-primary"></i>
                                Detail Nilai Sasaran Strategis
                            </h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" onclick="exportTable()">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle" id="detailTable">
                                <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th width="5%" class="ps-4">No</th>
                                            <th width="12%">Kode</th>
                                            <th width="30%">Sasaran</th>
                                            <th width="10%" class="text-center">Ketua</th>
                                            <th width="10%" class="text-center">Anggota</th>
                                            <th width="10%" class="text-center">Total</th>
                                            <th width="8%" class="text-center">Jumlah</th>
                                            <th width="15%" class="text-center">Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortedGrouped as $index => $group)
                                        @if($group['has_data'])
                                                @php
                                                    $progressColor = 'success';
                                                    if ($group['rata_rata'] < 2.0) $progressColor = 'danger';
                                                    elseif ($group['rata_rata'] < 2.5) $progressColor = 'warning';
                                                @endphp
                                            <tr>
                                                    <td class="ps-4">
                                                    <span class="text-dark fw-semibold">{{ $loop->iteration }}</span>
                                                </td>
                                                <td>
                                                        <span class="badge badge-light-primary fw-bold">{{ $group['kode_satuan'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-semibold">{{ $group['sasaran'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                        <span class="badge badge-light-info fw-bold">{{ number_format($group['total_nilai_ketua'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                        <span class="badge badge-light-warning fw-bold">{{ number_format($group['total_nilai_anggota'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                        <span class="badge badge-light-primary fw-bold">{{ number_format($group['total_nilai'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                        <span class="badge badge-light-secondary fw-bold">{{ $group['jumlah_penilaian'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div class="progress h-8px w-50px me-3">
                                                                <div class="progress-bar bg-{{ $progressColor }}"
                                                                     style="width: {{ ($group['rata_rata'] / 4) * 100 }}%"></div>
                                                            </div>
                                                            <span class="badge badge-light-{{ $progressColor }} fw-bold">{{ number_format($group['rata_rata'], 2) }}</span>
                                                        </div>
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
            </div>

            <!-- Instrumen Prodi Section -->
            @if(isset($kriteriaScores) && count($kriteriaScores) > 0)
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
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div style="position: relative; width: 100%; max-width: 400px; aspect-ratio: 1;">
                                    <canvas id="kt_radar_chart_prodi"></canvas>
                                </div>
                            </div>
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
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-success" onclick="exportProdiTable()">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle" id="prodiTable">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th width="5%" class="ps-4">No</th>
                                            <th width="12%">Kode Kriteria</th>
                                            <th width="30%">Nama Kriteria</th>
                                            <th width="10%" class="text-center">Ketua</th>
                                            <th width="10%" class="text-center">Anggota</th>
                                            <th width="10%" class="text-center">Total</th>
                                            <th width="8%" class="text-center">Jumlah</th>
                                            <th width="15%" class="text-center">Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriteriaScores as $index => $kriteria)
                                            @php
                                                $progressColor = 'success';
                                                if ($kriteria['rata_rata'] < 2.0) $progressColor = 'danger';
                                                elseif ($kriteria['rata_rata'] < 2.5) $progressColor = 'warning';
                                            @endphp
                                            <tr>
                                                <td class="ps-4">
                                                    <span class="text-dark fw-semibold">{{ $index + 1 }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bold">{{ $kriteria['kode_kriteria'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-semibold">{{ $kriteria['nama_kriteria'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-light-info fw-bold">{{ number_format($kriteria['total_nilai_ketua'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-light-warning fw-bold">{{ number_format($kriteria['total_nilai_anggota'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-light-success fw-bold">{{ number_format($kriteria['total_nilai'], 2) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-light-secondary fw-bold">{{ $kriteria['jumlah_penilaian'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="progress h-8px w-50px me-3">
                                                            <div class="progress-bar bg-{{ $progressColor }}"
                                                                 style="width: {{ ($kriteria['rata_rata'] / 4) * 100 }}%"></div>
                    </div>
                                                        <span class="badge badge-light-{{ $progressColor }} fw-bold">{{ number_format($kriteria['rata_rata'], 2) }}</span>
                                </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Evaluasi dan Kuisioner Section -->
            <div class="row g-5 g-xl-8 mt-8">
                <!-- Evaluasi Auditee -->
                <div class="col-xl-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-user-graduate me-2 text-info"></i>
                                Hasil Evaluasi Auditee
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if(count($evaluasiAuditee) > 0)
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-300 align-middle">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th width="10%">No</th>
                                                <th width="70%">Evaluasi</th>
                                                <th width="20%" class="text-center">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($evaluasiAuditee as $evaluasi)
                                                @if($evaluasi->is_nilai)
                                                    <tr>
                                                        <td>
                                                            <span class="badge badge-light-primary fw-bold">{{ $evaluasi->nomor }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-dark fw-semibold">{{ $evaluasi->evaluasi }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            @if(isset($evaluasiSubmissionsAuditee[$evaluasi->id]))
                                                                <span class="badge badge-light-success fw-bold">{{ $evaluasiSubmissionsAuditee[$evaluasi->id]->nilai }}</span>
                                                            @else
                                                                <span class="badge badge-light-secondary fw-bold">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="fw-bold text-primary">{{ $evaluasi->nomor }}. {{ $evaluasi->evaluasi }}</div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if($evaluasiMasukanAuditee)
                                    <div class="mt-4">
                                        <h6 class="fw-bold text-dark mb-3">Masukan Auditee:</h6>
                                        @if($evaluasiMasukanAuditee->materi_instrumen)
                                            <div class="mb-2">
                                                <span class="fw-semibold text-muted">Materi Instrumen:</span>
                                                <p class="text-dark">{{ $evaluasiMasukanAuditee->materi_instrumen }}</p>
                                            </div>
                                        @endif
                                        @if($evaluasiMasukanAuditee->pelaksanaan_audit)
                                            <div class="mb-2">
                                                <span class="fw-semibold text-muted">Pelaksanaan Audit:</span>
                                                <p class="text-dark">{{ $evaluasiMasukanAuditee->pelaksanaan_audit }}</p>
                                            </div>
                                        @endif
                                        @if($evaluasiMasukanAuditee->saran_teraudit)
                                            <div class="mb-2">
                                                <span class="fw-semibold text-muted">Saran:</span>
                                                <p class="text-dark">{{ $evaluasiMasukanAuditee->saran_teraudit }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle fs-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data evaluasi auditee</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Evaluasi Auditor -->
                <div class="col-xl-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-user-tie me-2 text-warning"></i>
                                Hasil Evaluasi Auditor
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if(count($auditorEvaluasiData) > 0)
                                @foreach($auditorEvaluasiData as $auditorData)
                                    <div class="border-bottom border-gray-300 pb-4 mb-4">
                                        <h6 class="fw-bold text-dark mb-3">
                                            <span class="badge badge-light-{{ $auditorData['role'] == 'ketua' ? 'primary' : 'warning' }} me-2">
                                                {{ ucfirst($auditorData['role']) }}
                                            </span>
                                            {{ $auditorData['auditor']->name }}
                                        </h6>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-row-dashed table-row-gray-300 align-middle">
                                                <thead>
                                                    <tr class="fw-bold text-muted bg-light">
                                                        <th width="15%">No</th>
                                                        <th width="65%">Evaluasi</th>
                                                        <th width="20%" class="text-center">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($evaluasiAuditor as $evaluasi)
                                                        @if($evaluasi->is_nilai)
                                                            <tr>
                                                                <td>
                                                                    <span class="badge badge-light-primary fw-bold fs-8">{{ $evaluasi->nomor }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark fw-semibold fs-8">{{ $evaluasi->evaluasi }}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(isset($auditorData['evaluasi_submissions'][$evaluasi->id]))
                                                                        <span class="badge badge-light-success fw-bold">{{ $auditorData['evaluasi_submissions'][$evaluasi->id]->nilai }}</span>
                                                                    @else
                                                                        <span class="badge badge-light-secondary fw-bold">-</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div class="fw-bold text-primary fs-8">{{ $evaluasi->nomor }}. {{ $evaluasi->evaluasi }}</div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @if($auditorData['evaluasi_masukan'])
                                            <div class="mt-3">
                                                <h6 class="fw-bold text-dark mb-2 fs-8">Masukan {{ $auditorData['auditor']->name }}:</h6>
                                                @if($auditorData['evaluasi_masukan']->materi_instrumen)
                                                    <div class="mb-1">
                                                        <span class="fw-semibold text-muted fs-8">Materi Instrumen:</span>
                                                        <p class="text-dark fs-8">{{ $auditorData['evaluasi_masukan']->materi_instrumen }}</p>
                                                    </div>
                                                @endif
                                                @if($auditorData['evaluasi_masukan']->pelaksanaan_audit)
                                                    <div class="mb-1">
                                                        <span class="fw-semibold text-muted fs-8">Pelaksanaan Audit:</span>
                                                        <p class="text-dark fs-8">{{ $auditorData['evaluasi_masukan']->pelaksanaan_audit }}</p>
                                                    </div>
                                                @endif
                                                @if($auditorData['evaluasi_masukan']->saran_teraudit)
                                                    <div class="mb-1">
                                                        <span class="fw-semibold text-muted fs-8">Saran:</span>
                                                        <p class="text-dark fs-8">{{ $auditorData['evaluasi_masukan']->saran_teraudit }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle fs-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data evaluasi auditor</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kuisioner Auditor Section -->
            @if(count($auditorKuisionerData) > 0)
            <div class="row g-5 g-xl-8 mt-8">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-clipboard-list me-2 text-success"></i>
                                Hasil Kuisioner Auditor
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            @if(isset($auditorKuisionerData) && count($auditorKuisionerData) > 0)
                                @foreach($auditorKuisionerData as $auditorData)
                                    <div class="border-bottom border-gray-300 pb-4 mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-bold text-dark mb-0">
                                                <span class="badge badge-light-{{ $auditorData['role'] == 'ketua' ? 'primary' : 'warning' }} me-2">
                                                    {{ ucfirst($auditorData['role']) }}
                                                </span>
                                                {{ $auditorData['auditor_name'] }}
                                            </h6>
                                            <div class="text-muted fs-8">
                                                <i class="fas fa-clock me-1"></i>
                                                Diisi pada: {{ \Carbon\Carbon::parse($auditorData['created_at'])->format('d M Y H:i') }}
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-row-dashed table-row-gray-300 align-middle">
                                                <thead>
                                                    <tr class="fw-bold text-muted bg-light">
                                                        <th width="10%">No</th>
                                                        <th width="60%">Pertanyaan</th>
                                                        <th width="30%" class="text-center">Jawaban</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($kuisioners as $kuisioner)
                                                        <tr>
                                                            <td>
                                                                <span class="badge badge-light-primary fw-bold fs-8">{{ $loop->iteration }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-semibold fs-8">{{ $kuisioner->pertanyaan }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                @if(isset($auditorData['kuisioner_jawaban'][$kuisioner->id]))
                                                                    <span class="badge badge-light-success fw-bold">
                                                                        {{ $auditorData['kuisioner_jawaban'][$kuisioner->id]->opsi->opsi ?? '-' }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-light-secondary fw-bold">-</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle fs-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data kuisioner auditor</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row g-5 g-xl-8 mt-8">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-clipboard-list me-2 text-success"></i>
                                Hasil Kuisioner Auditor
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle fs-2x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data kuisioner auditor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Catatan Visitasi Section -->
            @if($pengajuanAmis->catatan_visitasi)
            <div class="row g-5 g-xl-8 mt-8">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-clipboard-list me-2 text-info"></i>
                                Catatan Visitasi
                            </h3>
                        </div>
                        <div class="card-body pt-0" style="text-align: left !important;">
                            <p class="text-dark mb-1" style="white-space: pre-wrap; text-align: left !important;">
                                {{ $pengajuanAmis->catatan_visitasi }}
                            </p>
                            <small class="text-muted" style="text-align: left !important;">
                                <i class="fas fa-clock me-1"></i>
                                Diperbarui: {{ \Carbon\Carbon::parse($pengajuanAmis->updated_at)->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get data from PHP/Laravel to JavaScript
            const sortedGrouped = @json($sortedGrouped);
            const kriteriaScores = @json($kriteriaScores ?? []);

            // Prepare data for the Sasaran Strategis radar chart
            const labels = [];
            const values = [];

            // Process each Sasaran Strategis item to populate labels and values
            sortedGrouped.forEach(item => {
                // Only include items that have data
                if (item.has_data) {
                    // Use the kode_satuan as label (like 'SS 1.1')
                    labels.push(item.kode_satuan);
                    // Use the rata_rata as the value
                    values.push(item.rata_rata);
                }
            });

            // Data for Sasaran Strategis Radar Chart
            const dataStandar = {
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
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            };

            const configRadar = {
                type: 'radar',
                data: dataStandar,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    elements: {
                        line: {
                            borderWidth: 3
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
                                    size: 11,
                                    weight: 'bold'
                                }
                            },
                            pointLabels: {
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#333',
                                padding: 20
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
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#333',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    // Find the original data item to get more details
                                    const standardItem = sortedGrouped.find(item => item.has_data && item.kode_satuan === context.label);
                                    return [
                                        `Standar: ${standardItem.kode_satuan}`,
                                        `Nilai: ${context.raw.toFixed(2)}`,
                                        `Jumlah Penilaian: ${standardItem.jumlah_penilaian}`,
                                        `Total Nilai: ${standardItem.total_nilai.toFixed(2)}`
                                    ];
                                }
                            }
                        }
                    }
                }
            };

            const ctxRadar = document.getElementById('kt_radar_chart');
            new Chart(ctxRadar, configRadar);

            // Prepare data for Instrumen Prodi radar chart
            if (kriteriaScores.length > 0) {
                const prodiLabels = [];
                const prodiValues = [];

                // Process each kriteria item to populate labels and values
                kriteriaScores.forEach(item => {
                    // Use the kode_kriteria as label
                    prodiLabels.push(item.kode_kriteria);
                    // Use the rata_rata as the value
                    prodiValues.push(item.rata_rata);
                });

                // Data for Instrumen Prodi Radar Chart
                const dataProdi = {
                    labels: prodiLabels,
                    datasets: [{
                        label: 'Nilai Instrumen Prodi',
                        data: prodiValues,
                        fill: true,
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(40, 167, 69, 1)',
                        pointRadius: 5,
                        pointHoverRadius: 7
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
                                borderWidth: 3
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
                                        size: 11,
                                        weight: 'bold'
                                    }
                                },
                                pointLabels: {
                                    font: {
                                        size: 11,
                                        weight: 'bold'
                                    },
                                    color: '#333',
                                    padding: 18
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
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: '#333',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        // Find the original data item to get more details
                                        const kriteriaItem = kriteriaScores.find(item => item.kode_kriteria === context.label);
                                        return [
                                            `Kriteria: ${kriteriaItem.kode_kriteria}`,
                                            `Nama: ${kriteriaItem.nama_kriteria}`,
                                            `Nilai: ${context.raw.toFixed(2)}`,
                                            `Jumlah Penilaian: ${kriteriaItem.jumlah_penilaian}`,
                                            `Total Nilai: ${kriteriaItem.total_nilai.toFixed(2)}`
                                        ];
                                    }
                                }
                            }
                        }
                    }
                };

                const ctxRadarProdi = document.getElementById('kt_radar_chart_prodi');
                new Chart(ctxRadarProdi, configRadarProdi);
            }
        });

        function exportTable() {
            // Simple table export functionality
            const table = document.getElementById('detailTable');
            const html = table.outerHTML;
            const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            const downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            downloadLink.href = url;
            downloadLink.download = 'detail_laporan_ami.xls';
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        function exportProdiTable() {
            // Simple table export functionality for prodi table
            const table = document.getElementById('prodiTable');
            const html = table.outerHTML;
            const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            const downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            downloadLink.href = url;
            downloadLink.download = 'instrumen_prodi_laporan_ami.xls';
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
@endpush

        </div>
    </div>
</div>
