@extends('layouts.dashboard.dashboard')
@section('menu')
    Indikator RTM
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Indikator RTM</li>
@endsection

@push('styles')
<style>
    .rtm-section-header {
        border-left: 4px solid #0095e8;
        padding-left: 10px;
    }

    .rtm-lam-list {
        max-height: 220px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .rtm-lam-item {
        border: 1px dashed #e4e6ef;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 10px;
        background: #fff;
    }

    .rtm-lam-item:last-child {
        margin-bottom: 0;
    }

    .rtm-card-top {
        height: 4px;
    }

    .rtm-card-top-danger {
        background: #f1416c;
    }

    .rtm-card-top-safe {
        background: #50cd89;
    }

    .rtm-card-top-empty {
        background: #a1a5b7;
    }
</style>
@endpush

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card shadow-sm mb-8">
                <div class="card-body p-0">
                    <div class="px-10 pt-10 pb-5">
                        <div class="d-flex flex-stack flex-wrap gap-4">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Indikator RTM</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        Rekap indikator per LAM berdasarkan threshold per LAM (default 3.00).
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <span class="badge badge-light-primary fs-7 px-4 py-3">{{ $totalEntitas }} Entitas</span>
                                <span class="badge badge-light-danger fs-7 px-4 py-3">{{ $totalBawahThreshold }} Di Bawah</span>
                                <span class="badge badge-light-success fs-7 px-4 py-3">{{ $totalMinimalThreshold }} Minimal</span>
                            </div>
                        </div>
                    </div>

                    <div class="py-5 px-10 bg-light-primary">
                        <form method="GET" action="{{ url('/indikator-rtm') }}">
                            <div class="row g-3 align-items-end">
                                <div class="col-lg-5">
                                    <label class="form-label fw-semibold fs-7">Cari Entitas</label>
                                    <div class="d-flex align-items-center position-relative">
                                        <i class="fas fa-search fs-3 position-absolute ms-5 text-muted"></i>
                                        <input type="text" id="searchInput" name="search" class="form-control form-control-solid ps-12"
                                            placeholder="Cari prodi atau fakultas..." value="{{ request('search') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label fw-semibold fs-7">Periode AMI</label>
                                    <select name="period" class="form-select form-select-solid" id="periodFilter">
                                        @foreach($allPeriods as $period)
                                            <option value="{{ $period->id }}"
                                                {{ (request('period') ? request('period') == $period->id : ($currentPeriod && $currentPeriod->id === $period->id)) ? 'selected' : '' }}>
                                                {{ $period->nomor_surat }} - Siklus {{ $period->siklus }}
                                                @if($period->deleted_at) (Tidak Aktif) @else (Aktif) @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i>Filter</button>
                                </div>
                                <div class="col-lg-1">
                                    <a href="{{ url('/indikator-rtm') }}" class="btn btn-danger w-100"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if($selectedPeriod)
                <div class="mb-6">
                    <span class="badge badge-light-info fs-7">
                        Periode aktif tampilan: {{ $selectedPeriod->nomor_surat }} - Siklus {{ $selectedPeriod->siklus }} / {{ $selectedPeriod->tahun_ami }}
                    </span>
                </div>
            @endif

            <div class="alert alert-warning d-flex align-items-start mb-6">
                <i class="fas fa-info-circle fs-3 text-warning me-3 mt-1"></i>
                <div class="text-gray-800 fs-7 fw-semibold">
                    Data yang ditampilkan hanya entitas yang sudah memiliki LAM, dan pada periode yang dipilih sudah ada minimal 1 auditor yang selesai melakukan penilaian.
                </div>
            </div>

            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#tab_entitas">Per Entitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" data-bs-toggle="tab" href="#tab_fakultas">Per Fakultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" data-bs-toggle="tab" href="#tab_lam">Per LAM</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_entitas" role="tabpanel">
                    <div class="row g-4" id="rtmCards">
                @forelse($rtmData as $item)
                    @php
                        $auditee = $item['auditee'];
                        $lamList = $item['lam_list'];
                        $totalBawah = $item['total_bawah_threshold'];
                        $totalMinimal = $item['total_minimal_threshold'];
                        $totalLam = $item['total_lam'];

                        if ($totalLam === 0) {
                            $topClass = 'rtm-card-top-empty';
                        } elseif ($totalBawah > 0) {
                            $topClass = 'rtm-card-top-danger';
                        } else {
                            $topClass = 'rtm-card-top-safe';
                        }
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 rtm-card-wrapper"
                        data-name="{{ strtolower($auditee->nama_unit_kerja ?? '') }}"
                        data-fakultas="{{ strtolower($auditee->fakultas ?? '') }}">
                        <div class="card h-100 shadow-sm hover-elevate-up">
                            <div class="rtm-card-top {{ $topClass }}"></div>

                            <div class="card-header border-0 pt-4 pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="fas fa-building fs-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column min-w-0">
                                        <span class="text-dark fw-bold fs-5 text-truncate">{{ ($auditee->jenjang ?? '') . ' ' . ($auditee->nama_unit_kerja ?? '-') }}</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            <i class="fas fa-university text-primary me-1"></i>{{ $auditee->fakultas ?: '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex gap-2 flex-wrap">
                                    <span class="badge badge-light-primary">{{ $totalLam }} LAM</span>
                                    <span class="badge badge-light-danger">{{ $totalBawah }} &lt; {{ $threshold }}</span>
                                    <span class="badge badge-light-success">{{ $totalMinimal }} &ge; {{ $threshold }}</span>
                                </div>
                            </div>

                            <div class="card-body py-3">
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex align-items-center mb-3 rtm-section-header">
                                    <span class="text-muted fw-semibold fs-8">
                                        <i class="fas fa-list-alt me-1"></i>
                                        Daftar LAM & Status Indikator
                                    </span>
                                </div>

                                @if(count($lamList) > 0)
                                    <div class="rtm-lam-list">
                                        @foreach($lamList as $lam)
                                            <div class="rtm-lam-item">
                                                <div class="fw-bold text-dark fs-7 mb-2" title="{{ $lam['nama'] }}">{{ $lam['nama'] }}</div>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <span class="badge badge-light-warning">threshold {{ number_format($lam['threshold'] ?? $threshold, 2) }}</span>
                                                    <span class="badge badge-light-danger">{{ $lam['bawah_threshold'] }} indikator &lt; threshold</span>
                                                    <span class="badge badge-light-success">{{ $lam['minimal_threshold'] }} indikator &ge; threshold</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted fst-italic fs-8">Belum ada data indikator pada LAM untuk periode ini.</div>
                                @endif

                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex align-items-center mb-2 rtm-section-header">
                                    <span class="text-muted fw-semibold fs-8">
                                        <i class="fas fa-users me-1"></i>
                                        Daftar Auditor & Status Penilaian
                                    </span>
                                </div>

                                @forelse($item['auditor_list'] as $auditor)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-30px me-2">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-user text-primary fs-6"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <span class="text-dark fw-bold fs-7">{{ $auditor['name'] }}</span>
                                            <span class="text-muted fw-semibold fs-8">{{ str_replace('_', ' ', $auditor['role'] ?? '-') }}</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            @if($auditor['nilai_count'] > 0)
                                                <span class="badge badge-light-info fs-8">{{ $auditor['nilai_count'] }} nilai</span>
                                            @endif
                                            <span class="badge badge-light-{{ $auditor['status']['class'] }} fs-8">
                                                <i class="{{ $auditor['status']['icon'] }} me-1"></i>{{ $auditor['status']['label'] }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-muted fst-italic fs-8">Belum ada auditor yang ditugaskan.</div>
                                @endforelse
                            </div>

                            <div class="card-footer pt-0">
                                <a href="{{ url('/indikator-rtm/' . $item['pengajuan']->id . '/detail') }}" class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-info-circle me-1"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-body text-center p-10">
                                    <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                    <h4 class="text-gray-800 mb-2">Belum ada data</h4>
                                    <p class="text-gray-600">Data indikator RTM akan tampil setelah ada nilai audit pada periode ini.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    </div>
                </div>

                <div class="tab-pane fade" id="tab_fakultas" role="tabpanel">
                    <div class="row g-4">
                        @forelse($fakultasData as $fakultas)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card h-100 shadow-sm hover-elevate-up">
                                    <div class="card-header border-0 pt-5">
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-5">{{ $fakultas['fakultas'] }}</span>
                                            <span class="text-muted fw-semibold fs-7">{{ $fakultas['total_entitas'] }} entitas</span>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="d-flex gap-2 flex-wrap mb-3">
                                            <span class="badge badge-light-danger">{{ $fakultas['total_bawah_threshold'] }} &lt; {{ $threshold }}</span>
                                            <span class="badge badge-light-success">{{ $fakultas['total_minimal_threshold'] }} &ge; {{ $threshold }}</span>
                                            <span class="badge badge-light-primary">{{ $fakultas['total_indikator'] }} indikator</span>
                                        </div>
                                        <div class="progress h-8px bg-light">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $fakultas['persentase_tercapai'] }}%"></div>
                                        </div>
                                        <div class="text-muted fs-8 mt-2">Capaian threshold: <span class="fw-bold text-success">{{ $fakultas['persentase_tercapai'] }}%</span></div>
                                    </div>
                                    <div class="card-footer pt-0">
                                        <a href="{{ url('/indikator-rtm/fakultas/detail?fakultas=' . urlencode($fakultas['fakultas']) . '&period=' . request('period', $currentPeriod?->id)) }}" class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-info-circle me-1"></i>Detail Fakultas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card card-custom">
                                    <div class="card-body text-center p-10">
                                        <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                        <h4 class="text-gray-800 mb-2">Belum ada data fakultas</h4>
                                        <p class="text-gray-600">Belum ada data yang dapat diagregasi pada periode ini.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="tab-pane fade" id="tab_lam" role="tabpanel">
                    <div class="row g-4">
                        @forelse($lamData as $lam)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card h-100 shadow-sm hover-elevate-up">
                                    <div class="card-header border-0 pt-5">
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-5">{{ $lam['lam_nama'] }}</span>
                                            <span class="text-muted fw-semibold fs-7">{{ $lam['total_entitas'] }} entitas • {{ count($lam['fakultas_list']) }} fakultas</span>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="d-flex gap-2 flex-wrap mb-3">
                                            <span class="badge badge-light-danger">{{ $lam['total_bawah_threshold'] }} &lt; {{ $threshold }}</span>
                                            <span class="badge badge-light-success">{{ $lam['total_minimal_threshold'] }} &ge; {{ $threshold }}</span>
                                            <span class="badge badge-light-primary">{{ $lam['total_indikator'] }} indikator</span>
                                        </div>
                                        <div class="progress h-8px bg-light mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $lam['persentase_tercapai'] }}%"></div>
                                        </div>
                                        <div class="text-muted fs-8">Capaian: <span class="fw-bold text-success">{{ $lam['persentase_tercapai'] }}%</span></div>
                                    </div>
                                    <div class="card-footer pt-0">
                                        <a href="{{ url('/indikator-rtm/lam/detail?lam_id=' . $lam['lam_id'] . '&lam_nama=' . urlencode($lam['lam_nama']) . '&period=' . request('period', $currentPeriod?->id)) }}" class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-info-circle me-1"></i>Detail LAM
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card card-custom">
                                    <div class="card-body text-center p-10">
                                        <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                        <h4 class="text-gray-800 mb-2">Belum ada data LAM</h4>
                                        <p class="text-gray-600">Belum ada data yang dapat diagregasi pada periode ini.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            document.querySelectorAll('.rtm-card-wrapper').forEach(function (wrapper) {
                const name = wrapper.dataset.name || '';
                const fakultas = wrapper.dataset.fakultas || '';
                wrapper.style.display = (name.includes(term) || fakultas.includes(term)) ? '' : 'none';
            });
        });
    });
</script>
@endpush
