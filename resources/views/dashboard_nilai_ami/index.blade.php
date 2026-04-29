@extends('layouts.dashboard.dashboard')
@section('menu')
    Dashboard Nilai AMI
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">Dashboard Nilai AMI</li>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Header Section -->
            <div class="card shadow-sm mb-8">
                <div class="card-body p-0">
                    <div class="px-10 pt-10 pb-5">
                        <div class="d-flex flex-stack flex-wrap gap-3">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Dashboard Visualisasi Nilai AMI</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        @if($periodeAktif)
                                            Periode {{ $periodeAktif->siklus }}/{{ $periodeAktif->tahun_ami }}
                                        @else
                                            Tidak ada periode aktif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-light-primary" id="btnRefresh">
                                    <i class="fas fa-sync-alt me-2"></i>
                                    Refresh Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card shadow-sm mb-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title fw-bold text-dark">
                        <i class="fas fa-filter me-2 text-primary"></i>
                        Filter Data
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Periode AMI</label>
                            <select class="form-select form-select-solid" id="filterPeriode">
                                <option value="">Semua Periode</option>
                                @foreach($periodes as $periode)
                                    <option value="{{ $periode->id }}" {{ $periodeAktif && $periodeAktif->id == $periode->id ? 'selected' : '' }}>
                                        Siklus {{ $periode->siklus }} - {{ $periode->tahun_ami }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Jenis</label>
                            <select class="form-select form-select-solid" id="filterJenis">
                                <option value="fakultas_prodi" selected>Per Fakultas - Prodi</option>
                                <option value="lam">Per LAM</option>
                                <option value="universitas">Universitas</option>
                            </select>
                        </div>
                        <div class="col-lg-3" id="filterFakultasContainer">
                            <label class="form-label fw-semibold">Fakultas</label>
                            <select class="form-select form-select-solid" id="filterFakultas">
                                <option value="">Semua Fakultas</option>
                                @foreach($fakultasFromProdi as $fakultas)
                                    <option value="{{ $fakultas }}" {{ $loop->first ? 'selected' : '' }}>{{ $fakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3" id="filterLamContainer">
                            <label class="form-label fw-semibold">Indikator / LAM</label>
                            <select class="form-select form-select-solid" id="filterLam">
                                <option value="">Semua LAM</option>
                                @foreach($indikators as $indikator)
                                    <option value="{{ $indikator->id }}" {{ str_contains(strtoupper($indikator->nama_indikator), 'LAMDIK') ? 'selected' : '' }}>{{ $indikator->nama_indikator }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3" id="filterProdiContainer">
                            <label class="form-label fw-semibold">Program Studi</label>
                            <select class="form-select form-select-solid" id="filterProdi" disabled>
                                <option value="">Pilih Fakultas Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>
                    <!-- Info Box -->
                    <div class="d-flex align-items-center gap-3 mt-5 p-4 rounded-3" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); border-left: 4px solid #0ea5e9;">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 45px; height: 45px; background: #0ea5e9; flex-shrink: 0;">
                            <i class="fas fa-filter text-white fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold" style="color: #0369a1;">Data yang Ditampilkan</h6>
                            <p class="mb-0 text-dark" style="font-size: 13px;">
                                Hanya menampilkan <strong>Fakultas dan Prodi</strong> yang proses auditnya sudah berjalan 
                                <span class="badge bg-primary">minimal 1 auditor selesai</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Statistics -->
            <div class="row g-5 g-xl-8 mb-8" id="summaryCards">
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label bg-light-primary">
                                    <i class="fas fa-star text-primary fs-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-muted d-block fs-7 fw-semibold">Rata-rata Keseluruhan</span>
                                <span class="fw-bold fs-2 text-dark" id="summaryAvg">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label bg-light-success">
                                    <i class="fas fa-arrow-up text-success fs-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-muted d-block fs-7 fw-semibold">Nilai Tertinggi</span>
                                <span class="fw-bold fs-2 text-dark" id="summaryMax">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label bg-light-danger">
                                    <i class="fas fa-arrow-down text-danger fs-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-muted d-block fs-7 fw-semibold">Nilai Terendah</span>
                                <span class="fw-bold fs-2 text-dark" id="summaryMin">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label bg-light-info">
                                    <i class="fas fa-clipboard-check text-info fs-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-muted d-block fs-7 fw-semibold">Total Penilaian</span>
                                <span class="fw-bold fs-2 text-dark" id="summaryTotal">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Radar Chart -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-spider me-2 text-primary"></i>
                                <span id="kriteriaRadarTitle">Visualisasi Radar Nilai Per Kriteria Program Studi</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="radarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart - Kriteria Comparison -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-chart-bar me-2 text-success"></i>
                                <span id="kriteriaBarTitle">Perbandingan Nilai Per Kriteria Program Studi</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="kriteriaBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 - Prodi -->
            <div class="row g-5 g-xl-8 mb-8" id="prodiChartsSection">
                <!-- Radar Chart - Prodi -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-spider me-2 text-info"></i>
                                <span id="prodiRadarTitle">Radar Nilai Program Studi</span>
                            </h3>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-info-light text-info" id="prodiRadarInfo">Semua Prodi</span>
                                <span class="badge bg-danger-light text-danger d-none" id="prodiFocusBadge"></span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="prodiRadarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Horizontal Bar Chart - Prodi Comparison -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-university me-2 text-info"></i>
                                <span id="prodiChartTitle">Ranking Nilai Per Program Studi</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="prodiBarChart"></canvas>
                            </div>
                            <!-- Legend for audit status -->
                            <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center border-top pt-3">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success me-2" style="width: 20px; height: 12px;"></span>
                                    <small class="text-muted">✅ Semua Auditor Selesai</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning me-2" style="width: 20px; height: 12px;"></span>
                                    <small class="text-muted">⚠️ Sebagian Auditor Selesai [n/total]</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger me-2" style="width: 20px; height: 12px;"></span>
                                    <small class="text-muted">★ Prodi yang dipilih</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 3 - Sasaran Strategis (IKSS) -->
            <div class="row g-5 g-xl-8 mb-4 d-none" id="ikssFilterAlert">
                <div class="col-12">
                    <div class="alert alert-warning d-flex align-items-start p-4 mb-0">
                        <i class="fas fa-info-circle fs-3 text-warning me-3 mt-1"></i>
                        <div>
                            <div class="fw-bold mb-1">Informasi Filter IKSS</div>
                            <div class="text-dark">
                                Filter <strong>LAM</strong> hanya berlaku untuk komponen Instrumen Prodi. Komponen
                                <strong>Sasaran Strategis (IKSS)</strong> tetap dihitung berdasarkan data audit sesuai
                                periode dan cakupan unit yang dipilih.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8 mb-8">
                <!-- Radar Chart - Sasaran Strategis -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-bullseye me-2 text-danger"></i>
                                Radar Nilai Sasaran Strategis
                            </h3>
                            <span class="badge bg-danger-light text-danger">IKSS</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="sasaranRadarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart - Sasaran Strategis -->
                <div class="col-xl-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-chart-bar me-2 text-danger"></i>
                                Visualisasi Nilai Sasaran Strategis
                            </h3>
                            <span class="badge bg-danger-light text-danger">IKSS</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                                <canvas id="sasaranBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Table Sasaran Strategis -->
            <div class="row g-5 g-xl-8 mb-8">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-table me-2 text-danger"></i>
                                Detail Nilai Per Sasaran Strategis
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-row-bordered align-middle" id="sasaranTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Kode Sasaran</th>
                                            <th>Nama Sasaran Strategis</th>
                                            <th class="text-center">Rata-rata</th>
                                            <th class="text-center">Tertinggi</th>
                                            <th class="text-center">Terendah</th>
                                            <th class="text-center">Jumlah Penilaian</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sasaranTableBody">
                                        <!-- Data will be populated via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Table Instrumen Prodi -->
            <div class="row g-5 g-xl-8">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title fw-bold text-dark">
                                <i class="fas fa-table me-2 text-primary"></i>
                                <span id="kriteriaTableTitle">Detail Nilai Per Kriteria Program Studi</span>
                            </h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" onclick="exportTable()">
                                    <i class="fas fa-download me-2"></i>Export
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle" id="kriteriaTable">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th width="5%" class="ps-4">No</th>
                                            <th width="12%">Kode Kriteria</th>
                                            <th width="35%">Nama Kriteria</th>
                                            <th width="12%" class="text-center">Rata-rata</th>
                                            <th width="12%" class="text-center">Total Nilai</th>
                                            <th width="12%" class="text-center">Jumlah Penilaian</th>
                                            <th width="12%" class="text-center">Visualisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kriteriaTableBody">
                                        <tr>
                                            <td colspan="7" class="text-center py-10">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <div class="text-muted mt-3">Memuat data...</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart instances
    let radarChart = null;
    let kriteriaBarChart = null;
    let sasaranRadarChart = null;
    let prodiBarChart = null;
    let prodiRadarChart = null;
    let sasaranBarChart = null;

    // Color palette
    const colors = {
        primary: 'rgba(0, 158, 247, 0.8)',
        primaryLight: 'rgba(0, 158, 247, 0.2)',
        success: 'rgba(80, 205, 137, 0.8)',
        successLight: 'rgba(80, 205, 137, 0.2)',
        warning: 'rgba(255, 199, 0, 0.8)',
        warningLight: 'rgba(255, 199, 0, 0.2)',
        danger: 'rgba(241, 65, 108, 0.8)',
        dangerLight: 'rgba(241, 65, 108, 0.2)',
        info: 'rgba(114, 57, 234, 0.8)',
        infoLight: 'rgba(114, 57, 234, 0.2)',
    };

    const chartColors = [
        'rgba(0, 158, 247, 0.8)',
        'rgba(80, 205, 137, 0.8)',
        'rgba(255, 199, 0, 0.8)',
        'rgba(241, 65, 108, 0.8)',
        'rgba(114, 57, 234, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(75, 192, 192, 0.8)'
    ];

    const chartColorsBg = [
        'rgba(0, 158, 247, 0.2)',
        'rgba(80, 205, 137, 0.2)',
        'rgba(255, 199, 0, 0.2)',
        'rgba(241, 65, 108, 0.2)',
        'rgba(114, 57, 234, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(75, 192, 192, 0.2)'
    ];

    function getFilterType() {
        return document.getElementById('filterJenis').value || 'fakultas_prodi';
    }

    function ensureDefaultLamSelected() {
        const lamSelect = document.getElementById('filterLam');
        if (!lamSelect.value) {
            const firstLamOption = [...lamSelect.options].find(option => option.value);
            if (firstLamOption) {
                lamSelect.value = firstLamOption.value;
            }
        }
    }

    function resetProdiSelect() {
        const prodiSelect = document.getElementById('filterProdi');
        prodiSelect.value = '';
        prodiSelect.innerHTML = '<option value="">Pilih Fakultas Terlebih Dahulu</option>';
        prodiSelect.disabled = true;
    }

    function applyFilterJenisSelection(options = { reload: true }) {
        const filterType = getFilterType();
        const fakultasContainer = document.getElementById('filterFakultasContainer');
        const prodiContainer = document.getElementById('filterProdiContainer');
        const lamContainer = document.getElementById('filterLamContainer');
        const fakultasSelect = document.getElementById('filterFakultas');
        const lamSelect = document.getElementById('filterLam');

        if (filterType === 'lam') {
            fakultasContainer.classList.add('d-none');
            prodiContainer.classList.add('d-none');
            lamContainer.classList.remove('d-none');
            fakultasSelect.value = '';
            resetProdiSelect();
        } else if (filterType === 'universitas') {
            fakultasContainer.classList.add('d-none');
            prodiContainer.classList.add('d-none');
            lamContainer.classList.remove('d-none');
            fakultasSelect.value = '';
            ensureDefaultLamSelected();
            resetProdiSelect();
        } else {
            fakultasContainer.classList.remove('d-none');
            prodiContainer.classList.remove('d-none');
            lamContainer.classList.remove('d-none');
            ensureDefaultLamSelected();
            if (fakultasSelect.value) {
                const periodeId = document.getElementById('filterPeriode').value;
                loadProdiByFakultas(fakultasSelect.value, lamSelect.value, periodeId);
            } else {
                resetProdiSelect();
            }
        }

        if (options.reload) {
            loadChartData();
        }
    }

    function updateIkssFilterAlert() {
        const alertEl = document.getElementById('ikssFilterAlert');
        if (!alertEl) {
            return;
        }

        if (['lam', 'universitas'].includes(getFilterType())) {
            alertEl.classList.remove('d-none');
        } else {
            alertEl.classList.add('d-none');
        }
    }

    function getSelectedLamLabel() {
        const lamSelect = document.getElementById('filterLam');
        const selectedOption = lamSelect?.options?.[lamSelect.selectedIndex];
        if (!selectedOption || !selectedOption.value) {
            return 'Semua LAM';
        }
        return selectedOption.textContent.trim();
    }

    function updateLamContextTitles(filterType, fakultas, prodiId) {
        const lamLabel = getSelectedLamLabel();
        const kriteriaRadarTitle = document.getElementById('kriteriaRadarTitle');
        const kriteriaBarTitle = document.getElementById('kriteriaBarTitle');
        const kriteriaTableTitle = document.getElementById('kriteriaTableTitle');
        const prodiRadarTitle = document.getElementById('prodiRadarTitle');
        const prodiChartTitle = document.getElementById('prodiChartTitle');

        if (filterType === 'lam') {
            kriteriaRadarTitle.textContent = `Visualisasi Radar Nilai Per Kriteria Program Studi (${lamLabel})`;
            kriteriaBarTitle.textContent = `Perbandingan Nilai Per Kriteria Program Studi (${lamLabel})`;
            kriteriaTableTitle.textContent = `Detail Nilai Per Kriteria Program Studi (${lamLabel})`;
            prodiRadarTitle.textContent = `Radar Nilai Program Studi (${lamLabel})`;
            prodiChartTitle.textContent = `Ranking Nilai Per Program Studi (${lamLabel})`;
            return;
        }

        kriteriaRadarTitle.textContent = 'Visualisasi Radar Nilai Per Kriteria Program Studi';
        kriteriaBarTitle.textContent = 'Perbandingan Nilai Per Kriteria Program Studi';
        kriteriaTableTitle.textContent = 'Detail Nilai Per Kriteria Program Studi';
        prodiRadarTitle.textContent = 'Radar Nilai Program Studi';

        if (filterType === 'universitas') {
            kriteriaRadarTitle.textContent = `Visualisasi Radar Nilai Per Kriteria Program Studi (${lamLabel})`;
            kriteriaBarTitle.textContent = `Perbandingan Nilai Per Kriteria Program Studi (${lamLabel})`;
            kriteriaTableTitle.textContent = `Detail Nilai Per Kriteria Program Studi (${lamLabel})`;
            prodiRadarTitle.textContent = `Radar Nilai Program Studi (${lamLabel})`;
            prodiChartTitle.textContent = `Ranking Nilai Seluruh Program Studi (${lamLabel})`;
        } else if (prodiId) {
            prodiChartTitle.textContent = 'Perbandingan Nilai Prodi Dalam Fakultas';
        } else if (fakultas) {
            prodiChartTitle.textContent = `Ranking Prodi di ${fakultas}`;
        } else {
            prodiChartTitle.textContent = 'Ranking Nilai Per Program Studi';
        }
    }

    function loadProdiByFakultas(fakultas, lamId = '', periodeId = '', selectedProdiId = '') {
        const prodiSelect = document.getElementById('filterProdi');

        if (!fakultas) {
            resetProdiSelect();
            return Promise.resolve();
        }

        if (!lamId) {
            prodiSelect.value = '';
            prodiSelect.innerHTML = '<option value="">Pilih LAM Terlebih Dahulu</option>';
            prodiSelect.disabled = true;
            return Promise.resolve();
        }

        const params = new URLSearchParams();
        params.append('fakultas', fakultas);
        params.append('lam_id', lamId);
        if (periodeId) {
            params.append('periode_id', periodeId);
        }

        return fetch(`{{ route('dashboardNilaiAmi.getProdiByFakultas') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                prodiSelect.innerHTML = '<option value="">Semua Prodi di Fakultas</option>';
                data.forEach(prodi => {
                    prodiSelect.innerHTML += `<option value="${prodi.id}">${prodi.nama_unit_kerja} (${prodi.jenjang || 'N/A'})</option>`;
                });

                if (selectedProdiId && data.some(prodi => String(prodi.id) === String(selectedProdiId))) {
                    prodiSelect.value = selectedProdiId;
                } else {
                    prodiSelect.value = '';
                }

                prodiSelect.disabled = false;
            })
            .catch(() => {
                prodiSelect.innerHTML = '<option value="">Gagal memuat data prodi</option>';
                prodiSelect.disabled = true;
            });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSelect = document.getElementById('filterJenis');
        const fakultasSelect = document.getElementById('filterFakultas');
        const lamSelect = document.getElementById('filterLam');
        const urlParams = new URLSearchParams(window.location.search);
        const queryJenis = urlParams.get('jenis');
        const queryFakultas = urlParams.get('fakultas');
        const queryProdiId = urlParams.get('prodi_id');
        const queryLamId = urlParams.get('lam_id');

        if (queryJenis && ['fakultas_prodi', 'lam', 'universitas'].includes(queryJenis)) {
            jenisSelect.value = queryJenis;
        }

        const filterType = getFilterType();
        if (filterType === 'fakultas_prodi' && queryFakultas && [...fakultasSelect.options].some(option => option.value === queryFakultas)) {
            fakultasSelect.value = queryFakultas;
        }
        if (filterType === 'lam' && queryLamId && [...lamSelect.options].some(option => option.value === queryLamId)) {
            lamSelect.value = queryLamId;
        }
        if (filterType === 'fakultas_prodi') {
            ensureDefaultLamSelected();
        }

        applyFilterJenisSelection({ reload: false });

        const initLoadPromise = getFilterType() === 'fakultas_prodi'
            ? loadProdiByFakultas(
                fakultasSelect.value,
                lamSelect.value,
                document.getElementById('filterPeriode').value,
                queryProdiId
            )
            : Promise.resolve();

        initLoadPromise.finally(() => {
            loadChartData();
        });

        // Event listeners
        document.getElementById('filterJenis').addEventListener('change', function() {
            applyFilterJenisSelection({ reload: true });
        });

        document.getElementById('filterFakultas').addEventListener('change', function() {
            if (getFilterType() !== 'fakultas_prodi') {
                return;
            }
            const fakultas = this.value;
            const lamId = document.getElementById('filterLam').value;
            const periodeId = document.getElementById('filterPeriode').value;
            loadProdiByFakultas(fakultas, lamId, periodeId).finally(() => {
                loadChartData();
            });
        });

        document.getElementById('filterProdi').addEventListener('change', function() {
            loadChartData();
        });

        document.getElementById('filterPeriode').addEventListener('change', function() {
            if (getFilterType() === 'fakultas_prodi') {
                const fakultas = document.getElementById('filterFakultas').value;
                const lamId = document.getElementById('filterLam').value;
                loadProdiByFakultas(fakultas, lamId, this.value).finally(() => {
                    loadChartData();
                });
                return;
            }

            loadChartData();
        });

        document.getElementById('filterLam').addEventListener('change', function() {
            if (getFilterType() === 'fakultas_prodi') {
                const fakultas = document.getElementById('filterFakultas').value;
                const periodeId = document.getElementById('filterPeriode').value;
                loadProdiByFakultas(fakultas, this.value, periodeId).finally(() => {
                    loadChartData();
                });
                return;
            }

            loadChartData();
        });

        document.getElementById('btnRefresh').addEventListener('click', function() {
            loadChartData();
        });
    });

    function loadChartData() {
        const filterType = getFilterType();
        const fakultas = filterType === 'fakultas_prodi' ? document.getElementById('filterFakultas').value : '';
        const prodiId = filterType === 'fakultas_prodi' ? document.getElementById('filterProdi').value : '';
        const periodeId = document.getElementById('filterPeriode').value;
        const lamId = document.getElementById('filterLam').value;

        // Update context titles based on active filters
        updateLamContextTitles(filterType, fakultas, prodiId);

        updateIkssFilterAlert();

        const params = new URLSearchParams();
        if (fakultas) {
            params.append('fakultas', fakultas);
        }
        if (prodiId) {
            params.append('prodi_id', prodiId);
        }
        if (periodeId) params.append('periode_id', periodeId);
        if (lamId) params.append('lam_id', lamId);

        fetch(`{{ route('dashboardNilaiAmi.getChartData') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                updateSummaryCards(data.summary);
                updateRadarChart(data.kriteriaScores, filterType);
                updateKriteriaBarChart(data.kriteriaScores, filterType);
                updateProdiRadarChart(data.prodiScores, prodiId, filterType);
                updateProdiBarChart(data.prodiScores, prodiId, filterType);
                updateKriteriaTable(data.kriteriaScores);
                // Sasaran Strategis (IKSS)
                updateSasaranRadarChart(data.sasaranScores);
                updateSasaranBarChart(data.sasaranScores);
                updateSasaranTable(data.sasaranScores);
            })
            .catch(error => {
                console.error('Error loading chart data:', error);
            });
    }

    function updateSummaryCards(summary) {
        document.getElementById('summaryAvg').textContent = summary.rata_rata_keseluruhan || '-';
        document.getElementById('summaryMax').textContent = summary.nilai_tertinggi || '-';
        document.getElementById('summaryMin').textContent = summary.nilai_terendah || '-';
        document.getElementById('summaryTotal').textContent = summary.total_penilaian || '-';
    }

    function updateRadarChart(kriteriaScores, filterType = '') {
        const ctx = document.getElementById('radarChart').getContext('2d');
        
        if (radarChart) {
            radarChart.destroy();
        }

        if (!kriteriaScores || kriteriaScores.length === 0) {
            ctx.font = '16px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data tersedia', ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        const displayScores = kriteriaScores;

        // Create labels with code and short name for better readability
        const labels = displayScores.map(k => {
            // Truncate long names and add code prefix
            const shortName = k.nama_kriteria.length > 20 
                ? k.nama_kriteria.substring(0, 20) + '...' 
                : k.nama_kriteria;
            return `${k.kode_kriteria}: ${shortName}`;
        });
        const values = displayScores.map(k => k.rata_rata);

        radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: colors.primaryLight,
                    borderColor: colors.primary,
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: colors.primary
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const kriteria = displayScores[context.dataIndex];
                                return [
                                    `Nilai: ${context.raw}`,
                                    `Kriteria: ${kriteria.nama_kriteria}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 4,
                        ticks: {
                            stepSize: 1
                        },
                        pointLabels: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    }

    function updateKriteriaBarChart(kriteriaScores, filterType = '') {
        const ctx = document.getElementById('kriteriaBarChart').getContext('2d');
        
        if (kriteriaBarChart) {
            kriteriaBarChart.destroy();
        }

        if (!kriteriaScores || kriteriaScores.length === 0) {
            return;
        }

        const displayScores = kriteriaScores;

        const labels = displayScores.map(k => k.kode_kriteria);
        const values = displayScores.map(k => k.rata_rata);
        const backgroundColors = values.map(v => {
            if (v >= 3.5) return colors.success;
            if (v >= 2.5) return colors.warning;
            return colors.danger;
        });

        kriteriaBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderWidth: 0,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const kriteria = displayScores[context[0].dataIndex];
                                return kriteria.nama_kriteria;
                            },
                            label: function(context) {
                                return `Rata-rata: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    }

    function updateSasaranRadarChart(sasaranScores) {
        const ctx = document.getElementById('sasaranRadarChart').getContext('2d');
        
        if (sasaranRadarChart) {
            sasaranRadarChart.destroy();
        }

        if (!sasaranScores || sasaranScores.length === 0) {
            ctx.font = '16px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data sasaran tersedia', ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        // Create labels with code and short name for better readability
        const labels = sasaranScores.map(s => {
            const shortName = s.nama_sasaran.length > 15 
                ? s.nama_sasaran.substring(0, 15) + '...' 
                : s.nama_sasaran;
            return `${s.kode_sasaran}: ${shortName}`;
        });
        const values = sasaranScores.map(s => s.rata_rata);
        
        // Dynamic max scale based on highest value + buffer
        const maxValue = Math.max(...values);
        const scaleMax = Math.ceil(maxValue) + 1;

        sasaranRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: 'rgba(241, 65, 108, 0.2)',
                    borderColor: 'rgba(241, 65, 108, 0.8)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(241, 65, 108, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(241, 65, 108, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const sasaran = sasaranScores[context[0].dataIndex];
                                return sasaran.kode_sasaran;
                            },
                            label: function(context) {
                                const sasaran = sasaranScores[context.dataIndex];
                                return [
                                    `Nilai: ${sasaran.rata_rata}`,
                                    `${sasaran.nama_sasaran}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: scaleMax,
                        ticks: {
                            stepSize: scaleMax <= 5 ? 1 : 2
                        },
                        pointLabels: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    }

    function updateProdiBarChart(prodiScores, selectedProdiId, filterType = '') {
        const ctx = document.getElementById('prodiBarChart').getContext('2d');
        
        if (prodiBarChart) {
            prodiBarChart.destroy();
        }

        if (!prodiScores || prodiScores.length === 0) {
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.font = '16px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data perbandingan tersedia', ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        const displayProdiScores = prodiScores;

        // Create labels with audit status indicator
        const labels = displayProdiScores.map(p => {
            let label = `${p.nama_prodi} (${p.jenjang || 'N/A'})`;
            if (p.audit_status) {
                if (p.audit_status.status === 'completed') {
                    label = `✅ ${label}`;
                } else if (p.audit_status.status === 'partial') {
                    label = `⚠️ ${label} [${p.audit_status.completed}/${p.audit_status.total}]`;
                }
            }
            return label;
        });
        const values = displayProdiScores.map(p => p.rata_rata);
        
        // Highlight selected prodi with different color, and use different colors for audit status
        const backgroundColors = displayProdiScores.map((p, i) => {
            if (p.is_selected) {
                return 'rgba(241, 65, 108, 0.9)'; // Red/danger color for selected
            }
            if (p.audit_status && p.audit_status.status === 'completed') {
                return 'rgba(80, 205, 137, 0.8)'; // Green for completed
            }
            return 'rgba(255, 199, 0, 0.8)'; // Yellow/warning for partial
        });
        
        const borderColors = displayProdiScores.map((p, i) => {
            if (p.is_selected) {
                return 'rgba(241, 65, 108, 1)';
            }
            return 'transparent';
        });
        
        const borderWidths = displayProdiScores.map(p => p.is_selected ? 3 : 0);

        prodiBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: borderWidths,
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            afterLabel: function(context) {
                                const prodi = displayProdiScores[context.dataIndex];
                                let info = [`Fakultas: ${prodi.fakultas || 'N/A'}`];
                                
                                // Show audit status
                                if (prodi.audit_status) {
                                    const status = prodi.audit_status;
                                    if (status.status === 'completed') {
                                        info.push(`✅ Audit Selesai (${status.total} Auditor)`);
                                    } else if (status.status === 'partial') {
                                        info.push(`⚠️ ${status.completed} dari ${status.total} Auditor selesai`);
                                        if (status.auditor_names && status.auditor_names.length > 0) {
                                            info.push(`   Sudah: ${status.auditor_names.join(', ')}`);
                                        }
                                    }
                                }
                                
                                if (prodi.is_selected) {
                                    info.push('★ Prodi yang dipilih');
                                }
                                return info;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 4,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    y: {
                        ticks: {
                            font: function(context) {
                                const prodi = displayProdiScores[context.index];
                                return {
                                    size: 10,
                                    weight: prodi && prodi.is_selected ? 'bold' : 'normal'
                                };
                            }
                        }
                    }
                }
            }
        });
    }
    function updateKriteriaTable(kriteriaScores) {
        const tbody = document.getElementById('kriteriaTableBody');
        
        if (!kriteriaScores || kriteriaScores.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-10">
                        <i class="fas fa-inbox fs-2x text-muted mb-3"></i>
                        <div class="text-muted">Tidak ada data tersedia</div>
                    </td>
                </tr>
            `;
            return;
        }

        let html = '';
        kriteriaScores.forEach((kriteria, index) => {
            const progressColor = kriteria.rata_rata >= 3.5 ? 'success' : 
                                 (kriteria.rata_rata >= 2.5 ? 'warning' : 'danger');
            const progressWidth = (kriteria.rata_rata / 4) * 100;
            
            html += `
                <tr>
                    <td class="ps-4">
                        <span class="text-dark fw-semibold">${index + 1}</span>
                    </td>
                    <td>
                        <span class="badge badge-light-primary fw-bold">${kriteria.kode_kriteria}</span>
                    </td>
                    <td>
                        <span class="text-dark fw-semibold">${kriteria.nama_kriteria}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-light-${progressColor} fw-bold">${kriteria.rata_rata}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-light-info fw-bold">${kriteria.total_nilai}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-light-secondary fw-bold">${kriteria.jumlah_penilaian}</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="progress h-8px w-80px me-2">
                                <div class="progress-bar bg-${progressColor}" style="width: ${progressWidth}%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
    }

    function exportTable() {
        // Simple CSV export
        const table = document.getElementById('kriteriaTable');
        let csv = [];
        const rows = table.querySelectorAll('tr');
        
        rows.forEach(row => {
            const cols = row.querySelectorAll('td, th');
            const rowData = [];
            cols.forEach(col => {
                let text = col.innerText.replace(/"/g, '""');
                rowData.push(`"${text}"`);
            });
            csv.push(rowData.join(','));
        });

        const csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        const link = document.createElement('a');
        link.setAttribute('href', encodeURI(csvContent));
        link.setAttribute('download', 'nilai_ami_kriteria.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // ====== SASARAN STRATEGIS (IKSS) FUNCTIONS ======
    
    function updateSasaranBarChart(sasaranScores) {
        const ctx = document.getElementById('sasaranBarChart').getContext('2d');
        
        if (sasaranBarChart) {
            sasaranBarChart.destroy();
        }

        if (!sasaranScores || sasaranScores.length === 0) {
            ctx.font = '16px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data sasaran tersedia', ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        const labels = sasaranScores.map(s => s.kode_sasaran);
        const values = sasaranScores.map(s => s.rata_rata);

        // Color gradient from red to green based on value
        const backgroundColors = values.map(v => {
            if (v >= 8) return 'rgba(80, 205, 137, 0.8)';  // Green - excellent
            if (v >= 5) return 'rgba(255, 199, 0, 0.8)';   // Yellow - good
            if (v >= 3) return 'rgba(255, 159, 64, 0.8)';  // Orange - fair
            return 'rgba(241, 65, 108, 0.8)';              // Red - needs improvement
        });

        sasaranBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(c => c.replace('0.8', '1')),
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const sasaran = sasaranScores[context[0].dataIndex];
                                return sasaran.nama_sasaran;
                            },
                            label: function(context) {
                                const sasaran = sasaranScores[context.dataIndex];
                                return [
                                    `Kode: ${sasaran.kode_sasaran}`,
                                    `Rata-rata: ${sasaran.rata_rata}`,
                                    `Tertinggi: ${sasaran.nilai_tertinggi}`,
                                    `Terendah: ${sasaran.nilai_terendah}`,
                                    `Jumlah Penilaian: ${sasaran.jumlah_penilaian}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 10,
                        title: {
                            display: true,
                            text: 'Nilai'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sasaran Strategis'
                        }
                    }
                }
            }
        });
    }

    function updateProdiRadarChart(prodiScores, selectedProdiId = '', filterType = '') {
        const ctx = document.getElementById('prodiRadarChart').getContext('2d');
        const radarInfo = document.getElementById('prodiRadarInfo');
        const focusBadge = document.getElementById('prodiFocusBadge');
        
        if (prodiRadarChart) {
            prodiRadarChart.destroy();
        }

        if (!prodiScores || prodiScores.length === 0) {
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.font = '16px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data prodi tersedia', ctx.canvas.width / 2, ctx.canvas.height / 2);
            return;
        }

        const selectedId = selectedProdiId ? String(selectedProdiId) : '';
        const rankingMap = new Map(prodiScores.map((p, index) => [String(p.prodi_id), index + 1]));

        // Show all prodi in radar
        const topProdi = prodiScores;

        if (radarInfo) {
            radarInfo.textContent = selectedId ? 'Semua Prodi di Fakultas' : 'Semua Prodi';
        }

        if (focusBadge) {
            if (selectedId) {
                const selectedProdi = prodiScores.find(p => String(p.prodi_id) === selectedId);
                if (selectedProdi) {
                    focusBadge.textContent = `Fokus: ${selectedProdi.nama_prodi}`;
                    focusBadge.classList.remove('d-none');
                } else {
                    focusBadge.classList.add('d-none');
                }
            } else {
                focusBadge.classList.add('d-none');
            }
        }

        // Radar chart needs at least 3 data points to display properly
        if (topProdi.length < 3) {
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.font = '14px Arial';
            ctx.fillStyle = '#666';
            ctx.textAlign = 'center';
            ctx.fillText(`Data terlalu sedikit (${topProdi.length} prodi)`, ctx.canvas.width / 2, ctx.canvas.height / 2 - 15);
            ctx.fillText('Radar chart butuh minimal 3 prodi', ctx.canvas.width / 2, ctx.canvas.height / 2 + 15);
            return;
        }
        
        // Create labels with short name
        const labels = topProdi.map(p => {
            const shortName = p.nama_prodi.length > 15 
                ? p.nama_prodi.substring(0, 15) + '...' 
                : p.nama_prodi;
            const isSelected = selectedId && String(p.prodi_id) === selectedId;
            return isSelected ? `★ ${shortName}` : shortName;
        });
        const values = topProdi.map(p => p.rata_rata);
        const pointColors = topProdi.map(p => {
            const isSelected = selectedId && String(p.prodi_id) === selectedId;
            return isSelected ? 'rgba(241, 65, 108, 1)' : 'rgba(0, 158, 247, 1)';
        });
        const pointRadii = topProdi.map(p => {
            const isSelected = selectedId && String(p.prodi_id) === selectedId;
            return isSelected ? 7 : 4;
        });
        const pointBorderWidths = topProdi.map(p => {
            const isSelected = selectedId && String(p.prodi_id) === selectedId;
            return isSelected ? 3 : 1;
        });
        
        // Dynamic max scale
        const maxValue = Math.max(...values);
        const scaleMax = Math.ceil(maxValue) + 1;

        prodiRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: values,
                    backgroundColor: 'rgba(0, 158, 247, 0.2)',
                    borderColor: 'rgba(0, 158, 247, 0.8)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: pointColors,
                    pointBorderColor: '#fff',
                    pointBorderWidth: pointBorderWidths,
                    pointRadius: pointRadii,
                    pointHoverRadius: pointRadii.map(r => r + 2),
                    pointHoverBackgroundColor: pointColors,
                    pointHoverBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const prodi = topProdi[context[0].dataIndex];
                                return prodi.nama_prodi;
                            },
                            label: function(context) {
                                const prodi = topProdi[context.dataIndex];
                                const rank = rankingMap.get(String(prodi.prodi_id));
                                const isSelected = selectedId && String(prodi.prodi_id) === selectedId;
                                return [
                                    `Nilai: ${prodi.rata_rata}`,
                                    `Peringkat: ${rank}/${prodiScores.length}`,
                                    `Fakultas: ${prodi.fakultas || '-'}`
                                ].concat(isSelected ? ['★ Prodi yang dipilih'] : []);
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: scaleMax,
                        ticks: {
                            stepSize: scaleMax <= 5 ? 1 : 2
                        },
                        pointLabels: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    }

    function updateSasaranTable(sasaranScores) {
        const tbody = document.getElementById('sasaranTableBody');
        
        if (!sasaranScores || sasaranScores.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-8 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        Tidak ada data sasaran strategis tersedia
                    </td>
                </tr>
            `;
            return;
        }

        let html = '';
        sasaranScores.forEach((sasaran, index) => {
            // Determine color based on score
            let scoreClass = 'badge-light-danger';
            if (sasaran.rata_rata >= 8) scoreClass = 'badge-light-success';
            else if (sasaran.rata_rata >= 5) scoreClass = 'badge-light-warning';
            else if (sasaran.rata_rata >= 3) scoreClass = 'badge-light-info';

            html += `
                <tr>
                    <td class="ps-4">
                        <span class="badge badge-light-primary fw-bold">${sasaran.kode_sasaran}</span>
                    </td>
                    <td>
                        <span class="text-dark fw-semibold">${sasaran.nama_sasaran}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge ${scoreClass} fw-bold fs-6">${sasaran.rata_rata}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-success fw-semibold">${sasaran.nilai_tertinggi}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-danger fw-semibold">${sasaran.nilai_terendah}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-light-secondary fw-bold">${sasaran.jumlah_penilaian}</span>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
    }
</script>
@endpush
