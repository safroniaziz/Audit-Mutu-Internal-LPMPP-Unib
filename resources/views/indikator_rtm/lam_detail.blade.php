@extends('layouts.dashboard.dashboard')
@section('menu') Detail LAM RTM @endsection
@section('link')
<li class="breadcrumb-item text-muted"><a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a></li>
<li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
<li class="breadcrumb-item text-muted"><a href="{{ url('/indikator-rtm') }}" class="text-muted text-hover-primary">Indikator RTM</a></li>
<li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
<li class="breadcrumb-item text-muted">Detail LAM</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid"><div id="kt_app_content_container" class="app-container container-xxl">
    <div class="card shadow-sm mb-6">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="fw-bold mb-1">{{ $lamNama }}</h3>
                <div class="text-muted fs-7">Analisis LAM dipisah per prodi</div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge badge-light-primary">{{ $rows->pluck('prodi')->unique()->count() }} prodi</span>
                <span class="badge badge-light-danger">{{ $rows->where('status','below')->count() }} di bawah</span>
                <span class="badge badge-light-success">{{ $rows->where('status','ok')->count() }} mencapai</span>
            </div>
        </div>
    </div>

    @php
        $grouped = $rows->groupBy('prodi');
        $indikatorAgg = $rows->groupBy(function($r){
            return ($r['indikator_kode'] ?? '-') . '||' . ($r['indikator_nama'] ?? '-');
        })->map(function($items){
            $first = $items->first();
            $avgNilai = round($items->avg('nilai'), 2);
            $threshold = (float) ($first['threshold'] ?? 3);
            $prodiList = $items->pluck('prodi')->unique()->values()->all();
            return [
                'indikator_kode' => $first['indikator_kode'] ?? null,
                'indikator_nama' => $first['indikator_nama'] ?? '-',
                'nilai' => $avgNilai,
                'threshold' => $threshold,
                'kurang' => $avgNilai < $threshold ? round($threshold - $avgNilai, 2) : 0,
                'status' => $avgNilai < $threshold ? 'below' : 'ok',
                'jumlah_prodi' => count($prodiList),
                'prodi_list' => $prodiList,
            ];
        })->sortBy('nilai')->values();
        $chartGrouped = $grouped->map(function($items, $prodi){
            return [
                'id' => 'radar_' . md5($prodi),
                'labels' => $items->map(function($r){
                    return (($r['indikator_kode'] ? $r['indikator_kode'] . ' - ' : '') . $r['indikator_nama']);
                })->values()->all(),
                'values' => $items->pluck('nilai')->values()->all(),
            ];
        })->values()->all();
        $chartLam = [
            'labels' => $indikatorAgg->map(function($r){
                return (($r['indikator_kode'] ? $r['indikator_kode'] . ' - ' : '') . $r['indikator_nama']);
            })->values()->all(),
            'values' => $indikatorAgg->pluck('nilai')->values()->all(),
        ];
        $lamTotal = $indikatorAgg->count();
        $lamOk = $indikatorAgg->where('status', 'ok')->count();
        $lamPct = $lamTotal > 0 ? round(($lamOk / $lamTotal) * 100, 1) : 0;
    @endphp

    <div class="alert alert-danger mb-6">
        <div class="fw-bold mb-1">Rapor LAM</div>
        <div class="fs-7">
            Pada {{ $lamNama }} terdapat <strong>{{ $indikatorAgg->where('status','below')->count() }}</strong> indikator yang belum mencapai threshold {{ number_format($threshold,2) }}
            dari total {{ $lamTotal }} indikator lintas {{ $rows->pluck('prodi')->unique()->count() }} prodi.
            @php
                $prodiTerdampak = $rows->where('status','below')->pluck('prodi')->unique()->values();
                $topLamKurang = $indikatorAgg->where('status','below')->sortByDesc('kurang')->take(5)->values();
            @endphp
            @if($prodiTerdampak->count() > 0)
                Prodi yang terdampak: <strong>{{ $prodiTerdampak->implode(', ') }}</strong>.
            @endif
            @if($topLamKurang->count() > 0)
                <div class="mt-2">Indikator prioritas:</div>
                <ul class="mb-0 mt-1">
                    @foreach($topLamKurang as $r)
                        <li><strong>{{ $r['indikator_kode'] ? $r['indikator_kode'].' - ' : '' }}{{ $r['indikator_nama'] }}</strong>
                            (nilai {{ number_format($r['nilai'],2) }}, kurang {{ number_format($r['kurang'],2) }}, prodi: {{ implode(', ', $r['prodi_list']) }})</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card shadow-sm mb-6">
        <div class="card-header border-0 pt-5 pb-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h4 class="fw-bold mb-0">Ringkasan LAM (Lintas Prodi)</h4>
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge badge-light-primary">{{ $lamTotal }} indikator LAM</span>
                <span class="badge badge-light-danger">{{ $indikatorAgg->where('status','below')->count() }} di bawah</span>
                <span class="badge badge-light-success">{{ $lamOk }} mencapai</span>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted fs-8">Progress capaian LAM</span>
                    <span class="fw-bold fs-8 text-success">{{ $lamPct }}%</span>
                </div>
                <div class="progress h-8px bg-light">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $lamPct }}%"></div>
                </div>
            </div>
            <div class="mb-5">
                <div style="height: 420px;"><canvas id="lamSummaryRadar"></canvas></div>
            </div>
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle gs-0 gy-2">
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th>Indikator LAM</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Threshold</th>
                            <th class="text-center">Kurang</th>
                            <th class="text-center">Status</th>
                            <th>Prodi yang Mendapatkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($indikatorAgg as $row)
                            <tr class="{{ $row['status'] === 'below' ? 'table-danger' : 'table-success' }}">
                                <td>@if($row['indikator_kode'])<span class="badge badge-light-primary me-1">{{ $row['indikator_kode'] }}</span>@endif {{ $row['indikator_nama'] }}</td>
                                <td class="text-center fw-bold">{{ number_format($row['nilai'],2) }}</td>
                                <td class="text-center fw-bold">{{ number_format($row['threshold'],2) }}</td>
                                <td class="text-center fw-bold {{ $row['status'] === 'below' ? 'text-danger' : 'text-success' }}">{{ number_format($row['kurang'],2) }}</td>
                                <td class="text-center">@if($row['status'] === 'below')<span class="badge badge-danger">Di bawah</span>@else<span class="badge badge-success">Mencapai</span>@endif</td>
                                <td>{{ implode(', ', $row['prodi_list']) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-6">Belum ada data indikator LAM.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h4 class="fw-bold">Breakdown Per Prodi</h4>
        <div class="text-muted fs-8">Prodi yang terlibat: {{ $rows->pluck('prodi')->unique()->implode(', ') }}</div>
    </div>

    <div class="row g-5">
        @forelse($grouped as $prodi => $items)
            @php
                $total = $items->count();
                $ok = $items->where('status', 'ok')->count();
                $below = $items->where('status', 'below')->count();
                $pct = $total > 0 ? round(($ok / $total) * 100, 1) : 0;
                $chartId = 'radar_' . md5($prodi);
            @endphp
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header border-0 pt-5 pb-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h4 class="fw-bold mb-1">{{ $prodi }}</h4>
                            <div class="text-muted fs-8">{{ $items->first()['fakultas'] ?? '-' }}</div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge badge-light-primary">{{ $total }} indikator</span>
                            <span class="badge badge-light-danger">{{ $below }} di bawah</span>
                            <span class="badge badge-light-success">{{ $ok }} mencapai</span>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted fs-8">Progress capaian threshold</span>
                                <span class="fw-bold fs-8 text-success">{{ $pct }}%</span>
                            </div>
                            <div class="progress h-8px bg-light">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-xl-4">
                                <div style="min-height: 280px;"><canvas id="{{ $chartId }}"></canvas></div>
                            </div>
                            <div class="col-xl-8">
                                <div class="table-responsive">
                                    <table class="table table-row-bordered align-middle gs-0 gy-2">
                                        <thead>
                                            <tr class="fw-bold text-muted">
                                                <th>Indikator</th>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Threshold</th>
                                                <th class="text-center">Kurang</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $row)
                                                <tr class="{{ $row['status'] === 'below' ? 'table-danger' : 'table-success' }}">
                                                    <td>@if($row['indikator_kode'])<span class="badge badge-light-primary me-1">{{ $row['indikator_kode'] }}</span>@endif {{ $row['indikator_nama'] }}</td>
                                                    <td class="text-center fw-bold">{{ number_format($row['nilai'],2) }}</td>
                                                    <td class="text-center fw-bold">{{ number_format($row['threshold'],2) }}</td>
                                                    <td class="text-center fw-bold {{ $row['status'] === 'below' ? 'text-danger' : 'text-success' }}">{{ number_format($row['kurang'],2) }}</td>
                                                    <td class="text-center">@if($row['status'] === 'below')<span class="badge badge-danger">Di bawah</span>@else<span class="badge badge-success">Mencapai</span>@endif</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="card"><div class="card-body text-center py-10 text-muted">Belum ada data detail untuk LAM ini.</div></div></div>
        @endforelse
    </div>
</div></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;
    const grouped = @json($chartGrouped);
    const lamSummary = @json($chartLam);

    const lamEl = document.getElementById('lamSummaryRadar');
    if (lamEl && lamSummary.labels && lamSummary.labels.length) {
        new Chart(lamEl, {
            type: 'radar',
            data: {
                labels: lamSummary.labels,
                datasets: [{
                    label: 'Rata-rata LAM',
                    data: lamSummary.values,
                    backgroundColor: 'rgba(0, 149, 232, 0.20)',
                    borderColor: '#0095e8',
                    pointBackgroundColor: lamSummary.values.map(v => v < {{ $threshold }} ? '#f1416c' : '#50cd89'),
                    pointBorderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { r: { min: 0, max: 4, ticks: { stepSize: 1 }, pointLabels: { font: { size: 10 } } } },
                plugins: { legend: { display: false } }
            }
        });
    }

    grouped.forEach(function(g){
        const el = document.getElementById(g.id);
        if (!el) return;
        new Chart(el, {
            type: 'radar',
            data: {
                labels: g.labels,
                datasets: [{
                    label: 'Nilai Indikator',
                    data: g.values,
                    backgroundColor: 'rgba(0, 149, 232, 0.20)',
                    borderColor: '#0095e8',
                    pointBackgroundColor: g.values.map(v => v < {{ $threshold }} ? '#f1416c' : '#50cd89'),
                    pointBorderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { r: { min: 0, max: 4, ticks: { stepSize: 1 }, pointLabels: { font: { size: 10 } } } },
                plugins: { legend: { display: false } }
            }
        });
    });
});
</script>
@endpush
