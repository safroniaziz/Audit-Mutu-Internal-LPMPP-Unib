@extends('layouts.dashboard.dashboard')
@section('menu')
    Detail Fakultas RTM
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
    <li class="breadcrumb-item text-muted">{{ $fakultas }}</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card shadow-sm mb-6">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h3 class="fw-bold mb-1">{{ $fakultas }}</h3>
                    <div class="text-muted fs-7">Ringkasan indikator RTM per entitas di fakultas ini</div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge badge-light-primary">{{ $totalEntitas }} entitas</span>
                    <span class="badge badge-light-danger">{{ $totalBawahThreshold }} &lt; {{ $threshold }}</span>
                    <span class="badge badge-light-success">{{ $totalMinimalThreshold }} &ge; {{ $threshold }}</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @php
                $indikatorKurangCount = collect($indikatorFakultas)->where('total_bawah', '>', 0)->count();
                $indikatorMerahPerLam = collect($indikatorFakultas)
                    ->where('total_bawah', '>', 0)
                    ->groupBy('lam_nama')
                    ->map(function ($rows) {
                        return $rows->sortByDesc('nilai_kurang')->values();
                    })
                    ->filter()
                    ->values();
                $semuaProdiFakultas = collect($indikatorFakultas)
                    ->flatMap(fn($r) => $r['prodi_mendapatkan'] ?? [])
                    ->unique()
                    ->values();
            @endphp
            <div class="col-12">
                <div class="alert alert-danger mb-2">
                    <div class="fw-bold mb-1">Rapor Fakultas</div>
                    <div class="fs-7">
                        Prodi yang tercakup dalam analisis: <strong>{{ $semuaProdiFakultas->implode(', ') ?: '-' }}</strong>.
                        Di {{ $fakultas }} terdapat <strong>{{ $indikatorKurangCount }}</strong> indikator yang belum mencapai threshold {{ number_format($threshold,2) }}.
                        @if($indikatorMerahPerLam->count() > 0)
                            <div class="mt-2">Semua indikator merah per LAM:</div>
                            @foreach($indikatorMerahPerLam as $rowsLam)
                                @php $lamName = optional($rowsLam->first())['lam_nama'] ?? 'LAM'; @endphp
                                <div class="mt-2"><strong>{{ $lamName }}</strong></div>
                                <ul class="mb-1 mt-1">
                                    @foreach($rowsLam as $r)
                                        <li><strong>{{ $r['indikator_kode'] ? $r['indikator_kode'].' - ' : '' }}{{ $r['indikator_nama'] }}</strong>
                                            (nilai {{ number_format($r['nilai_rata_rata'],2) }}, kurang {{ number_format($r['nilai_kurang'],2) }},
                                            mendapatkan: {{ implode(', ', $r['prodi_mendapatkan']) ?: '-' }},
                                            belum mencapai: {{ implode(', ', $r['prodi_bawah']) ?: '-' }})</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        @else
                            <ul class="mb-0 mt-1">
                                <li>Tidak ada indikator merah pada fakultas ini.</li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card shadow-sm mb-2 border border-danger border-opacity-25" style="overflow: visible;">
                    <div class="card-header border-0 pt-5">
                        <h4 class="card-title fw-bold text-danger">Peta Indikator Merah (Semua)</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 380px; width:100%;">
                            <canvas id="indikatorFakultasChartMerah"></canvas>
                        </div>
                        <div class="text-muted fs-8 mt-2">Semua indikator yang belum mencapai threshold pada fakultas ini.</div>
                        <div id="nilaiMerahList" class="fs-8 mt-3 text-gray-700"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="card shadow-sm mb-2 border border-success border-opacity-25" style="overflow: visible;">
                    <div class="card-header border-0 pt-5">
                        <h4 class="card-title fw-bold text-success">Peta Indikator Hijau (Semua)</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 380px; width:100%;">
                            <canvas id="indikatorFakultasChartHijau"></canvas>
                        </div>
                        <div class="text-muted fs-8 mt-2">Semua indikator yang sudah mencapai threshold pada fakultas ini.</div>
                        <div id="nilaiHijauList" class="fs-8 mt-3 text-gray-700"></div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-0 pt-5">
                        <h4 class="card-title fw-bold">Detail Indikator Belum Mencapai Threshold</h4>
                    </div>
                    <div class="card-body pt-2">
                        @php
                            $indikatorBelumMencapai = collect($indikatorFakultas)->filter(fn($r) => ($r['total_bawah'] ?? 0) > 0)->values();
                            $indikatorMencapai = collect($indikatorFakultas)->filter(fn($r) => ($r['total_bawah'] ?? 0) == 0)->values();
                        @endphp

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge badge-light-danger me-2">{{ $indikatorBelumMencapai->count() }} indikator</span>
                            <h5 class="mb-0 fw-bold text-danger">Indikator Belum Mencapai Threshold</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-row-bordered align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>LAM</th>
                                        <th>Indikator</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Threshold</th>
                                        <th class="text-center">Kurang</th>
                                        <th class="text-center">Status</th>
                                        <th>Prodi yang Mendapatkan</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($indikatorBelumMencapai as $row)
                                        <tr class="table-danger">
                                            <td class="fw-semibold text-dark">{{ $row['lam_nama'] }}</td>
                                            <td class="fw-semibold text-dark">
                                                @if(!empty($row['indikator_kode']))
                                                    <span class="badge badge-light-primary me-1">{{ $row['indikator_kode'] }}</span>
                                                @endif
                                                {{ $row['indikator_nama'] }}
                                            </td>
                                            <td class="text-center fw-bold">{{ number_format($row['nilai_rata_rata'], 2) }}</td>
                                            <td class="text-center fw-bold">{{ number_format($threshold, 2) }}</td>
                                            <td class="text-center fw-bold text-danger">{{ number_format($row['nilai_kurang'], 2) }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-danger">Di bawah threshold</span>
                                            </td>
                                            <td>
                                                @if(count($row['prodi_mendapatkan']) > 0)
                                                    {{ implode(', ', $row['prodi_mendapatkan']) }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-icon btn-light-danger toggle-monitoring" data-target="#monitoring-{{ $loop->index }}" title="Isi Monitoring & RTL">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr id="monitoring-{{ $loop->index }}" class="collapse-row d-none bg-light-danger bg-opacity-10">
                                            <td colspan="8" class="p-5">
                                                <form class="monitoring-form" data-kriteria-id="{{ $row['kriteria_id'] }}">
                                                    <div class="row g-4">
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold fs-7 text-gray-800">Monitoring 1</label>
                                                            <textarea name="monitoring_1" class="form-control form-control-solid" rows="3" placeholder="Isi monitoring 1...">{{ $row['monitoring_1'] }}</textarea>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold fs-7 text-gray-800">Monitoring 2</label>
                                                            <textarea name="monitoring_2" class="form-control form-control-solid" rows="3" placeholder="Isi monitoring 2...">{{ $row['monitoring_2'] }}</textarea>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold fs-7 text-gray-800">Monitoring 3</label>
                                                            <textarea name="monitoring_3" class="form-control form-control-solid" rows="3" placeholder="Isi monitoring 3...">{{ $row['monitoring_3'] }}</textarea>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold fs-7 text-gray-800">Hasil RTL</label>
                                                            <textarea name="hasil_rtl" class="form-control form-control-solid" rows="3" placeholder="Isi hasil RTL...">{{ $row['hasil_rtl'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="button" class="btn btn-sm btn-light-danger btn-delete-monitoring me-2">
                                                            <i class="fas fa-trash me-1"></i> Hapus
                                                        </button>
                                                        <button type="submit" class="btn btn-sm btn-primary btn-save-monitoring">
                                                            <i class="fas fa-save me-1"></i> Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-success py-6">Tidak ada indikator yang berada di bawah threshold.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="separator separator-dashed my-6"></div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge badge-light-success me-2">{{ $indikatorMencapai->count() }} indikator</span>
                            <h5 class="mb-0 fw-bold text-success">Indikator Sudah Mencapai Threshold</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-row-bordered align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>LAM</th>
                                        <th>Indikator</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Threshold</th>
                                        <th class="text-center">Kurang</th>
                                        <th class="text-center">Status</th>
                                        <th>Prodi yang Mendapatkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($indikatorMencapai as $row)
                                        <tr class="table-success">
                                            <td class="fw-semibold text-dark">{{ $row['lam_nama'] }}</td>
                                            <td class="fw-semibold text-dark">
                                                @if(!empty($row['indikator_kode']))
                                                    <span class="badge badge-light-primary me-1">{{ $row['indikator_kode'] }}</span>
                                                @endif
                                                {{ $row['indikator_nama'] }}
                                            </td>
                                            <td class="text-center fw-bold">{{ number_format($row['nilai_rata_rata'], 2) }}</td>
                                            <td class="text-center fw-bold">{{ number_format($threshold, 2) }}</td>
                                            <td class="text-center fw-bold text-success">{{ number_format($row['nilai_kurang'], 2) }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">Mencapai threshold</span>
                                            </td>
                                            <td>
                                                @if(count($row['prodi_mendapatkan']) > 0)
                                                    {{ implode(', ', $row['prodi_mendapatkan']) }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-6">Belum ada indikator di kelompok ini.</td>
                                        </tr>
                                    @endforelse
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartElMerah = document.getElementById('indikatorFakultasChartMerah');
    const chartElHijau = document.getElementById('indikatorFakultasChartHijau');
    if ((!chartElMerah && !chartElHijau) || typeof Chart === 'undefined') {
        return;
    }

    const chartData = @json($chartIndikator);
    if (!chartData.length) {
        return;
    }

    const merahItems = chartData.filter(item => (item.bawah || 0) > 0);
    const hijauItems = chartData.filter(item => (item.mencapai || 0) > 0);

    const labelsMerah = merahItems.map(item => `${item.label} (${item.bawah})`);
    const valuesMerah = merahItems.map(item => item.bawah);
    const labelsHijau = hijauItems.map(item => `${item.label} (${item.mencapai})`);
    const valuesHijau = hijauItems.map(item => item.mencapai);

    const nilaiMerahList = document.getElementById('nilaiMerahList');
    const nilaiHijauList = document.getElementById('nilaiHijauList');
    if (nilaiMerahList) {
        nilaiMerahList.innerHTML = labelsMerah.length
            ? '<strong>Nilai (jumlah kasus merah):</strong><br>' + merahItems.map(i => `- ${i.label}: ${i.bawah}`).join('<br>')
            : '<strong>Nilai:</strong> Tidak ada indikator merah.';
    }
    if (nilaiHijauList) {
        nilaiHijauList.innerHTML = labelsHijau.length
            ? '<strong>Nilai (jumlah kasus hijau):</strong><br>' + hijauItems.map(i => `- ${i.label}: ${i.mencapai}`).join('<br>')
            : '<strong>Nilai:</strong> Tidak ada indikator hijau.';
    }

    if (chartElMerah && labelsMerah.length) {
        new Chart(chartElMerah, {
            type: 'radar',
            data: {
                labels: labelsMerah,
                datasets: [{
                    label: 'Di Bawah Threshold',
                    data: valuesMerah,
                    backgroundColor: 'rgba(241, 65, 108, 0.22)',
                    borderColor: '#f1416c',
                    pointBackgroundColor: '#f1416c',
                    pointBorderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { r: { beginAtZero: true, ticks: { precision: 0, stepSize: 1 }, pointLabels: { font: { size: 9 } } } }
            }
        });
    }

    if (chartElHijau && labelsHijau.length) {
        new Chart(chartElHijau, {
            type: 'radar',
            data: {
                labels: labelsHijau,
                datasets: [{
                    label: 'Mencapai Threshold',
                    data: valuesHijau,
                    backgroundColor: 'rgba(80, 205, 137, 0.22)',
                    borderColor: '#50cd89',
                    pointBackgroundColor: '#50cd89',
                    pointBorderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { r: { beginAtZero: true, ticks: { precision: 0, stepSize: 1 }, pointLabels: { font: { size: 9 } } } }
            }
        });
    }

    // Toggle monitoring form
    $('.toggle-monitoring').on('click', function() {
        const target = $(this).data('target');
        $(target).toggleClass('d-none');
        $(this).toggleClass('btn-light-danger btn-danger');
        $(this).find('i').toggleClass('fa-edit fa-chevron-up');
    });

    // Save monitoring data via AJAX
    $('.monitoring-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('.btn-save-monitoring');
        const kriteriaId = form.data('kriteria-id');

        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Menyimpan...');

        $.ajax({
            url: "{{ route('indikatorRtm.saveMonitoring') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                fakultas: "{{ $fakultas }}",
                period_id: "{{ $periodId }}",
                kriteria_id: kriteriaId,
                monitoring_1: form.find('textarea[name="monitoring_1"]').val(),
                monitoring_2: form.find('textarea[name="monitoring_2"]').val(),
                monitoring_3: form.find('textarea[name="monitoring_3"]').val(),
                hasil_rtl: form.find('textarea[name="hasil_rtl"]').val()
            },
            success: function(response) {
                submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan');
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message || 'Terjadi kesalahan.',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan');
                Swal.fire({
                    title: 'Gagal!',
                    text: xhr.responseJSON?.message || 'Gagal menyimpan data monitoring.',
                    icon: 'error'
                });
            }
        });
    }

    // Delete monitoring data via AJAX
    $('.btn-delete-monitoring').on('click', function() {
        const deleteBtn = $(this);
        const form = deleteBtn.closest('form');
        const kriteriaId = form.data('kriteria-id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data monitoring dan RTL untuk indikator ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Menghapus...');
                $.ajax({
                    url: "{{ route('indikatorRtm.deleteMonitoring') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        fakultas: "{{ $fakultas }}",
                        period_id: "{{ $periodId }}",
                        kriteria_id: kriteriaId
                    },
                    success: function(response) {
                        deleteBtn.prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Hapus');
                        if (response.success) {
                            form.find('textarea').val(''); // Clear all textareas
                            Swal.fire({
                                title: 'Terhapus!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        deleteBtn.prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Hapus');
                        Swal.fire({
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Gagal menghapus data monitoring.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
