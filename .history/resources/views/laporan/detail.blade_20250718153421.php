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

                    <!-- Info Cards -->
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

                        <!-- Statistics Cards -->
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

            <!-- Sasaran Strategis Statistics -->
            <div class="row g-5 g-xl-8 mb-8">
                <div class="col-12">
                    <h4 class="text-dark fw-bold mb-4">
                        <i class="fas fa-chart-line me-2 text-primary"></i>
                        Statistik Sasaran Strategis
                    </h4>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card shadow-sm border-0 bg-gradient-primary bg-opacity-10">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-4">
                                    <div class="symbol-label bg-primary text-inverse-primary">
                                        <i class="fas fa-target fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold mb-1">Total Sasaran</span>
                                    <span class="fw-bold fs-2 text-dark">{{ $totalSasaran }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card shadow-sm border-0 bg-gradient-success bg-opacity-10">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-4">
                                    <div class="symbol-label bg-success text-inverse-success">
                                        <i class="fas fa-chart-line fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold mb-1">Rata-rata Nilai</span>
                                    <span class="fw-bold fs-2 text-dark">{{ number_format($avgRataRata, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card shadow-sm border-0 bg-gradient-warning bg-opacity-10">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-4">
                                    <div class="symbol-label bg-warning text-inverse-warning">
                                        <i class="fas fa-arrow-up fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold mb-1">Nilai Tertinggi</span>
                                    <span class="fw-bold fs-2 text-dark">{{ number_format($maxRataRata, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card shadow-sm border-0 bg-gradient-danger bg-opacity-10">
                        <div class="card-body p-6">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-4">
                                    <div class="symbol-label bg-danger text-inverse-danger">
                                        <i class="fas fa-arrow-down fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold mb-1">Nilai Terendah</span>
                                    <span class="fw-bold fs-2 text-dark">{{ number_format($minRataRata, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instrumen Prodi Statistics Cards -->
            @if(isset($kriteriaScores) && count($kriteriaScores) > 0)
            <div class="row g-5 g-xl-8 mb-8">
                <div class="col-12">
                    <h4 class="text-dark fw-bold mb-4">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                        Statistik Instrumen Prodi
                    </h4>
                </div>
                <div class="col-xl-3">
                    <div class="card bg-info bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-info text-inverse-info">
                                        <i class="fas fa-list-check fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold">Total Kriteria</span>
                                    <span class="fw-bold fs-3 text-dark">{{ $totalKriteria }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card bg-success bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-success text-inverse-success">
                                        <i class="fas fa-chart-line fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold">Rata-rata Nilai</span>
                                    <span class="fw-bold fs-3 text-dark">{{ number_format($avgKriteria, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card bg-warning bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-warning text-inverse-warning">
                                        <i class="fas fa-arrow-up fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold">Nilai Tertinggi</span>
                                    <span class="fw-bold fs-3 text-dark">{{ number_format($maxKriteria, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card bg-danger bg-opacity-10 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-danger text-inverse-danger">
                                        <i class="fas fa-arrow-down fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted d-block fs-7 fw-semibold">Nilai Terendah</span>
                                    <span class="fw-bold fs-3 text-dark">{{ number_format($minKriteria, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

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
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" onclick="location.reload()">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
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
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-success" onclick="location.reload()">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
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

            <!-- Additional Info -->
            <div class="row g-5 g-xl-8 mt-8">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-8">
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold mb-2">Informasi Penting</h4>
                                        <div class="fs-6 text-gray-700">
                                            <ul class="mb-0">
                                                <li>Laporan ini berisi hasil audit mutu internal yang mencakup penilaian, temuan, dan rekomendasi untuk perbaikan kualitas program studi/unit kerja.</li>
                                                <li>Nilai rata-rata dihitung berdasarkan penilaian dari ketua dan anggota tim audit.</li>
                                                <li>Progress bar menunjukkan tingkat pencapaian berdasarkan skala 1-4.</li>
                                                <li>Klik tombol "Cetak Laporan" untuk mengunduh laporan lengkap dalam format PDF.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
