@extends('layouts.dashboard.dashboard')
@section('menu')
    Detail Indikator RTM
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ url('/indikator-rtm') }}" class="text-muted text-hover-primary">Indikator RTM</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Detail</li>
@endsection

@push('styles')
<style>
    .rtm-radar-wrap {
        min-height: 360px;
        background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
        border: 1px solid #eef3f7;
        border-radius: 12px;
        padding: 12px;
    }

    .rtm-lam-title {
        border-left: 4px solid #0095e8;
        padding-left: 10px;
    }
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card shadow-sm mb-6">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div>
                        <h3 class="mb-1 fw-bold">{{ ($pengajuan->auditee->jenjang ?? '') . ' ' . ($pengajuan->auditee->nama_unit_kerja ?? '-') }}</h3>
                        <div class="text-muted fs-7">{{ $pengajuan->auditee->fakultas ?? '-' }}</div>
                        <div class="text-muted fs-8 mt-1">Periode: {{ $pengajuan->periodeAktif->nomor_surat ?? '-' }} - Siklus {{ $pengajuan->periodeAktif->siklus ?? '-' }}</div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-light-danger">Merah: rata-rata &lt; {{ $threshold }}</span>
                        <span class="badge badge-light-success">Hijau: rata-rata &ge; {{ $threshold }}</span>
                    </div>
                </div>
            </div>
        </div>

        @php
            $chartLabels = [];
            $chartScores = [];
            $totalIndikator = 0;
            $totalKurang = 0;
            $lamKurangNama = [];
            $indikatorKurangRows = [];
            foreach ($lamDetails as $lam) {
                $totalIndikator += count($lam['kriteria_rows']);
                if (($lam['bawah_threshold'] ?? 0) > 0) {
                    $lamKurangNama[] = $lam['nama'];
                }
                foreach ($lam['kriteria_rows'] as $row) {
                    $chartLabels[] = (isset($row['kode']) && $row['kode'] ? $row['kode'].' - ' : '') . $row['nama'];
                    $chartScores[] = $row['rata_rata'];
                    if (($row['rata_rata'] ?? 0) < $threshold) {
                        $totalKurang++;
                        $indikatorKurangRows[] = [
                            'lam' => $lam['nama'],
                            'nama' => $row['nama'],
                            'kode' => $row['kode'] ?? null,
                            'nilai' => $row['rata_rata'],
                            'kurang' => round($threshold - $row['rata_rata'], 2),
                        ];
                    }
                }
            }
            $chartLabels = array_slice($chartLabels, 0, 12);
            $chartScores = array_slice($chartScores, 0, 12);
            usort($indikatorKurangRows, fn($a, $b) => $b['kurang'] <=> $a['kurang']);
            $topKurang = array_slice($indikatorKurangRows, 0, 5);
        @endphp

        <div class="alert alert-danger mb-6">
            <div class="fw-bold mb-1">Rapor Prodi</div>
            <div class="fs-7">
                Terdapat <strong>{{ $totalKurang }}</strong> dari <strong>{{ $totalIndikator }}</strong> indikator yang belum mencapai threshold {{ number_format($threshold,2) }}.
                @if(count($lamKurangNama) > 0)
                    Area LAM prioritas: <strong>{{ implode(', ', array_unique($lamKurangNama)) }}</strong>.
                @endif
                @if(count($topKurang) > 0)
                    <div class="mt-2">Detail kekurangan tertinggi:</div>
                    <ul class="mb-0 mt-1">
                        @foreach($topKurang as $r)
                            <li><strong>{{ $r['kode'] ? $r['kode'].' - ' : '' }}{{ $r['nama'] }}</strong> ({{ $r['lam'] }}, nilai {{ number_format($r['nilai'],2) }}, kurang {{ number_format($r['kurang'],2) }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="row g-5 mb-6">
            <div class="col-xl-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header border-0 pt-5">
                        <h4 class="card-title fw-bold">Grafik Laba-laba Nilai Indikator Prodi</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="rtm-radar-wrap">
                            <canvas id="rtmRadarChart"></canvas>
                        </div>
                        <div class="text-muted fs-8 mt-3">Menampilkan hingga 12 indikator pertama agar grafik tetap terbaca.</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header border-0 pt-5">
                        <h4 class="card-title fw-bold">Ringkasan Cepat</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex flex-column gap-3">
                            <div class="p-4 rounded bg-light-primary d-flex justify-content-between">
                                <span class="fw-semibold">Total Indikator</span>
                                <span class="fw-bold">{{ $totalIndikator }}</span>
                            </div>
                            <div class="p-4 rounded bg-light-danger d-flex justify-content-between">
                                <span class="fw-semibold">Total Di Bawah Threshold</span>
                                <span class="fw-bold">{{ collect($lamDetails)->sum('bawah_threshold') }}</span>
                            </div>
                            <div class="p-4 rounded bg-light-success d-flex justify-content-between">
                                <span class="fw-semibold">Total Mencapai Threshold</span>
                                <span class="fw-bold">{{ collect($lamDetails)->sum('minimal_threshold') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @forelse($lamDetails as $lam)
            <div class="card shadow-sm mb-5">
                <div class="card-header border-0 pt-5">
                    <div class="d-flex justify-content-between align-items-center w-100 gap-3 flex-wrap">
                        <div>
                            <h4 class="mb-0 fw-bold rtm-lam-title">{{ $lam['nama'] }}</h4>
                            <div class="text-muted fs-8 mt-1">Nama indikator/LAM</div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge badge-light-danger">{{ $lam['bawah_threshold'] }} &lt; {{ $threshold }}</span>
                            <span class="badge badge-light-success">{{ $lam['minimal_threshold'] }} &ge; {{ $threshold }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-row-bordered align-middle gs-0 gy-3">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th>Nama Indikator Prodi</th>
                                    <th class="text-center" style="width: 150px;">Rata-rata</th>
                                    <th class="text-center" style="width: 220px;">Status Threshold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lam['kriteria_rows'] as $row)
                                    <tr class="{{ $row['is_below'] ? 'table-danger' : 'table-success' }}">
                                        <td class="fw-semibold text-dark">
                                            @if(!empty($row['kode']))
                                                <span class="badge badge-light-primary me-2">{{ $row['kode'] }}</span>
                                            @endif
                                            {{ $row['nama'] }}
                                        </td>
                                        <td class="text-center fw-bold">{{ number_format($row['rata_rata'], 2) }}</td>
                                        <td class="text-center">
                                            @if($row['is_below'])
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-arrow-down me-1"></i>Di bawah threshold
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check me-1"></i>Mencapai threshold
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center p-10">
                    <i class="fas fa-folder-open fs-3x text-gray-400 mb-4"></i>
                    <h4 class="text-gray-800 mb-2">Belum ada detail LAM</h4>
                    <p class="text-gray-600">Belum ada data nilai indikator prodi pada periode ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('rtmRadarChart');
    if (!el || typeof Chart === 'undefined') {
        return;
    }

    const labels = @json($chartLabels);
    const scores = @json($chartScores);

    if (!labels.length) {
        return;
    }

    new Chart(el, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nilai Rata-rata Indikator',
                data: scores,
                backgroundColor: 'rgba(0, 149, 232, 0.20)',
                borderColor: '#0095e8',
                pointBackgroundColor: scores.map(v => v < {{ $threshold }} ? '#f1416c' : '#50cd89'),
                pointBorderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    min: 0,
                    max: 4,
                    ticks: { stepSize: 1 },
                    pointLabels: { font: { size: 10 } }
                }
            },
            plugins: {
                legend: { display: true }
            }
        }
    });
});
</script>
@endpush
