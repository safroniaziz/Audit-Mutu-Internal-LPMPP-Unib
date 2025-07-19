@extends('layouts.dashboard.dashboard')
@section('menu')
    Dashboard Analytics
@endsection

@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

                        <!-- Welcome Section -->
            <div class="row mb-8">
                <div class="col-12">
                    <div class="card card-flush border-0 position-relative overflow-hidden shadow-lg">
                        <!-- Animated Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-5">
                            <i class="ki-duotone ki-shield-tick fs-20x text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>

                        <!-- Modern Gradient Background -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%); opacity: 0.9;"></div>

                        <!-- Glass Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);"></div>

                        <div class="card-body p-8 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <!-- Main Title with Modern Design -->
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-white bg-opacity-25 rounded-circle p-4 me-4 shadow-lg" style="backdrop-filter: blur(10px);">
                                            <i class="ki-duotone ki-shield-tick fs-2x text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <h1 class="text-white fw-bold fs-2hx mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Selamat Datang di SIAMI</h1>
                                            <div class="d-flex align-items-center">
                                                <span class="badge fs-8 fw-bold me-2 px-3 py-2" style="background: linear-gradient(45deg, #ff6b6b, #ee5a24); color: white; border: none;">v2.0</span>
                                                <span class="text-white fs-7 fw-semibold" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2);">Sistem Terintegrasi</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subtitle with Enhanced Styling -->
                                    <h2 class="text-white fs-4 fw-semibold mb-4" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">Sistem Audit Mutu Internal Universitas Bengkulu</h2>

                                    <!-- Description with Better Typography -->
                                    <p class="text-white fs-6 mb-5 lh-base fw-medium" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2); opacity: 0.95;">
                                        Dashboard Analytics & Performance Monitoring yang menyediakan insight komprehensif
                                        untuk monitoring audit mutu internal, evaluasi kinerja, dan pengembangan berkelanjutan
                                        dalam rangka peningkatan kualitas pendidikan tinggi.
                                    </p>

                                    <!-- Enhanced Quick Stats -->
                                    <div class="row g-4">
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">PERIODE AKTIF</div>
                                                <div class="text-white fs-5 fw-bold">{{ $periodeAktif ? $periodeAktif->nomor_surat : 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">AUDITOR</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_auditors'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">AUDITEE</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_auditees'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="text-end">
                                        <!-- Enhanced Date and Time -->
                                        <div class="rounded-4 p-5 mb-4 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                            <div class="text-white fs-8 fw-bold mb-2" style="opacity: 0.9;">TANGGAL & WAKTU</div>
                                            <div class="text-white fs-1 fw-bold mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ now()->format('d') }}</div>
                                            <div class="text-white fs-5 fw-semibold mb-2" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2);">{{ now()->translatedFormat('F Y') }}</div>
                                            <div class="text-white fs-7 fw-medium" style="opacity: 0.9;">{{ now()->translatedFormat('l, H:i') }}</div>
                                        </div>

                                        <!-- Enhanced System Status -->
                                        <div class="rounded-4 p-4 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                            <div class="d-flex align-items-center justify-content-end mb-2">
                                                <div class="rounded-circle w-10px h-10px me-2" style="background: linear-gradient(45deg, #00b894, #00cec9); box-shadow: 0 0 10px rgba(0, 184, 148, 0.5);"></div>
                                                <span class="text-white fs-8 fw-bold">SISTEM AKTIF</span>
                                            </div>
                                            <div class="text-white fs-7 fw-medium" style="opacity: 0.9;">Real-time monitoring</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics Cards -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Total Users -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Pengguna"
                        :value="$stats['total_users']"
                        icon="ki-duotone ki-profile-user"
                        color="primary"
                        :percentage="$performanceMetrics['user_activity_rate']"
                        description="Pengguna terdaftar dalam sistem"
                    />
                </div>

                <!-- Total Unit Kerja -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Unit Kerja"
                        :value="$stats['total_unit_kerja']"
                        icon="ki-duotone ki-bank"
                        color="success"
                        percentage="85"
                        description="Fakultas, Prodi & Unit Kerja"
                    />
                </div>

                <!-- Total Indikator -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Indikator"
                        :value="$stats['total_indikator']"
                        icon="ki-duotone ki-chart-line"
                        color="warning"
                        :percentage="$performanceMetrics['completion_rate']"
                        description="Indikator kinerja & instrumen"
                    />
                </div>

                <!-- Total Pengajuan -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Pengajuan AMI"
                        :value="$stats['total_pengajuan']"
                        icon="ki-duotone ki-document"
                        color="info"
                        :percentage="$performanceMetrics['audit_completion_rate']"
                        description="Pengajuan audit mutu internal"
                    />
                </div>
            </div>

            <!-- Additional Stats Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Total Kriteria -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Kriteria"
                        :value="$stats['total_kriteria']"
                        icon="ki-duotone ki-star"
                        color="danger"
                        percentage="92"
                        description="Kriteria penilaian indikator"
                    />
                </div>

                <!-- Total Instrumen -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Instrumen"
                        :value="$stats['total_instrumen']"
                        icon="ki-duotone ki-clipboard"
                        color="dark"
                        percentage="78"
                        description="Instrumen penilaian prodi"
                    />
                </div>

                <!-- Total Evaluasi -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Evaluasi"
                        :value="$stats['total_evaluasi']"
                        icon="ki-duotone ki-shield-tick"
                        color="success"
                        percentage="65"
                        description="Evaluasi audit yang dilakukan"
                    />
                </div>

                <!-- Total Kuisioner -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Kuisioner"
                        :value="$stats['total_kuisioner']"
                        icon="ki-duotone ki-message-text-2"
                        color="primary"
                        :percentage="$performanceMetrics['response_rate']"
                        description="Kuisioner & respons"
                    />
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Unit Kerja Distribution Chart -->
                <div class="col-xl-8">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <h3 class="fw-bold text-dark">Distribusi Indikator per Unit Kerja</h3>
                                <span class="text-gray-600 fw-semibold fs-6">Top 8 unit kerja dengan indikator terbanyak</span>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="dropdown">
                                    <i class="ki-duotone ki-gear fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="unitKerjaChart" style="height: 350px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Status Pengajuan AMI Chart -->
                <div class="col-xl-4">
                    <div class="card card-flush border-0 bg-white shadow-sm h-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Status Pengajuan AMI</h3>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="pengajuanStatusChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Charts Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Performance Metrics -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Indikator Kinerja</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-4">
                                <!-- Completion Rate -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-check-circle fs-2x text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Tingkat Penyelesaian</span>
                                            <span class="fw-bold text-primary">{{ $performanceMetrics['completion_rate'] }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Indikator dengan instrumen lengkap</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" style="width: {{ $performanceMetrics['completion_rate'] }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Response Rate -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-message-text-2 fs-2x text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Tingkat Respons</span>
                                            <span class="fw-bold text-success">{{ $performanceMetrics['response_rate'] }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Jawaban kuisioner yang diterima</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-success" style="width: {{ $performanceMetrics['response_rate'] }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Audit Completion -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-warning">
                                            <i class="ki-duotone ki-shield-tick fs-2x text-warning">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Penyelesaian Audit</span>
                                            <span class="fw-bold text-warning">{{ $performanceMetrics['audit_completion_rate'] }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Audit yang sudah selesai</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-warning" style="width: {{ $performanceMetrics['audit_completion_rate'] }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Activity -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-profile-user fs-2x text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Aktivitas Pengguna</span>
                                            <span class="fw-bold text-info">{{ $performanceMetrics['user_activity_rate'] }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Auditor & Auditee login dalam 7 hari terakhir</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-info" style="width: {{ $performanceMetrics['user_activity_rate'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Unit Kerja Chart -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Distribusi Jenis Unit Kerja</h3>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="jenisUnitKerjaChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="row g-5 g-xl-8">
                <!-- Recent Activities -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Recent Activities</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">View All</button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="timeline">
                                @forelse($recentActivities as $activity)
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-light-{{ $activity['color'] }}">
                                        <i class="{{ $activity['icon'] }} fs-2 text-{{ $activity['color'] }}">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="fw-bold text-gray-800">{{ $activity['title'] }}</div>
                                        <div class="text-gray-600 fs-7">{{ $activity['description'] }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">{{ $activity['time'] }}</div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-8">
                                    <i class="ki-duotone ki-information-5 fs-3x text-gray-400 mb-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="text-gray-600">Belum ada aktivitas terbaru</div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Performers -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Top Performers</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-4">
                                <!-- Top Unit Kerja -->
                                <div>
                                    <h6 class="fw-bold text-gray-800 mb-3">Top Unit Kerja</h6>
                                    @forelse($topPerformers['top_unit_kerja'] as $unit)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-bank fs-2 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-gray-800">{{ $unit['nama'] }}</div>
                                            <div class="text-gray-600 fs-7">{{ $unit['jumlah_indikator'] }} indikator • {{ $unit['jenis'] }}</div>
                                        </div>
                                        <span class="badge badge-light-primary fs-8 fw-bold">{{ $loop->iteration }}</span>
                                    </div>
                                    @empty
                                    <div class="text-center py-4">
                                        <div class="text-gray-600">Belum ada data unit kerja</div>
                                    </div>
                                    @endforelse
                                </div>

                                <!-- Audit Progress -->
                                <div>
                                    <h6 class="fw-bold text-gray-800 mb-3">Audit Progress</h6>
                                    @forelse($auditProgress as $progress)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-shield-tick fs-2 text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-gray-800">{{ $progress['nomor_surat'] }}</div>
                                            <div class="text-gray-600 fs-7">{{ $progress['disetujui'] }}/{{ $progress['total_pengajuan'] }} disetujui • {{ $progress['status'] }}</div>
                                        </div>
                                        <span class="badge badge-light-success fs-8 fw-bold">{{ $progress['persentase'] }}%</span>
                                    </div>
                                    @empty
                                    <div class="text-center py-4">
                                        <div class="text-gray-600">Belum ada progress audit</div>
                                    </div>
                                    @endforelse

                                    <!-- Auditee Participation -->
                                    @if($auditProgress->isNotEmpty())
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-info">
                                                <i class="ki-duotone ki-profile-user fs-2 text-info">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-gray-800">Partisipasi Auditee</div>
                                            <div class="text-gray-600 fs-7">
                                                @php
                                                    $totalPengajuan = $auditProgress->sum('total_pengajuan');
                                                    $totalAuditee = $auditProgress->first()['total_auditee'] ?? 0;
                                                    $persentasePartisipasi = $totalAuditee > 0 ? round(($totalPengajuan / $totalAuditee) * 100, 1) : 0;
                                                @endphp
                                                {{ $totalPengajuan }}/{{ $totalAuditee }} auditee sudah mengajukan AMI
                                            </div>
                                        </div>
                                        <span class="badge badge-light-info fs-8 fw-bold">{{ $persentasePartisipasi }}%</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e1e3ea;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-badge {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-left: 10px;
}

.progress {
    background-color: #e1e3ea;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.symbol-label {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #3699FF 0%, #1BC5BD 100%);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
        // Unit Kerja Distribution Chart
    const unitKerjaCtx = document.getElementById('unitKerjaChart').getContext('2d');

    const unitKerjaData = @json($chartData['unitKerjaStats']);
    console.log('Unit Kerja Data:', unitKerjaData); // Debug log

    const chartLabels = unitKerjaData.map(item => item.nama_unit_kerja);
    const chartData = unitKerjaData.map(item => item.indikator_instrumens_count);

    console.log('Chart Labels:', chartLabels); // Debug log
    console.log('Chart Data:', chartData); // Debug log

        // Check if we have data
    if (chartData.length === 0 || chartData.every(val => val === 0)) {
        document.getElementById('unitKerjaChart').parentElement.innerHTML =
            '<div class="text-center py-8"><i class="ki-duotone ki-chart-line fs-2hx text-muted mb-4"></i><p class="text-muted">Belum ada unit kerja dengan indikator instrumen</p></div>';
    } else {

    new Chart(unitKerjaCtx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Indikator',
                data: chartData,
                backgroundColor: [
                    'rgba(54, 153, 255, 0.8)',
                    'rgba(28, 197, 189, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(108, 117, 125, 0.8)',
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 123, 0, 0.8)',
                    'rgba(111, 66, 193, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 153, 255, 1)',
                    'rgba(28, 197, 189, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)',
                    'rgba(108, 117, 125, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 123, 0, 1)',
                    'rgba(111, 66, 193, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#6c757d',
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d',
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
        });
    }

        // Status Pengajuan AMI Chart
    const pengajuanCtx = document.getElementById('pengajuanStatusChart').getContext('2d');
    const pengajuanData = @json($chartData['pengajuanStatus']);

    // Mapping untuk label yang lebih deskriptif
    const labelMapping = {
        'belum_disetujui': 'Belum Disetujui',
        'sudah_selesai_diaudit': 'Selesai Diaudit',
        'masih_proses_audit': 'Masih Proses Audit'
    };

    const pengajuanLabels = Object.keys(pengajuanData).map(key => labelMapping[key] || key);
    const pengajuanValues = Object.values(pengajuanData);

    // Check if we have data and if all values are not zero
    if (pengajuanValues.length === 0 || pengajuanValues.every(val => val === 0)) {
        document.getElementById('pengajuanStatusChart').parentElement.innerHTML =
            '<div class="text-center py-8"><i class="ki-duotone ki-chart-pie fs-2hx text-muted mb-4"></i><p class="text-muted">Belum ada data pengajuan AMI</p></div>';
    } else {

    new Chart(pengajuanCtx, {
        type: 'doughnut',
        data: {
            labels: pengajuanLabels,
            datasets: [{
                data: pengajuanValues,
                backgroundColor: [
                    'rgba(255, 193, 7, 0.8)',    // Kuning - Belum Disetujui
                    'rgba(40, 167, 69, 0.8)',    // Hijau - Selesai Diaudit
                    'rgba(54, 153, 255, 0.8)'    // Biru - Masih Proses Audit
                ],
                borderColor: [
                    'rgba(255, 193, 7, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(54, 153, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
    }

    // Jenis Unit Kerja Chart
    const jenisUnitCtx = document.getElementById('jenisUnitKerjaChart').getContext('2d');
    const jenisUnitData = @json($chartData['jenisUnitKerja']);
    const jenisUnitLabels = Object.keys(jenisUnitData).map(key => key.charAt(0).toUpperCase() + key.slice(1));
    const jenisUnitValues = Object.values(jenisUnitData);

    new Chart(jenisUnitCtx, {
        type: 'pie',
        data: {
            labels: jenisUnitLabels,
            datasets: [{
                data: jenisUnitValues,
                backgroundColor: [
                    'rgba(54, 153, 255, 0.8)',
                    'rgba(28, 197, 189, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 153, 255, 1)',
                    'rgba(28, 197, 189, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
