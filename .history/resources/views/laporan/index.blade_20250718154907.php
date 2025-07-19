@extends('layouts.dashboard.dashboard')
@section('menu')
    Laporan AMI
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Laporan AMI</li>
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
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1 text-dark fw-bold">Laporan Audit Mutu Internal</h2>
                                    <div class="text-muted fw-semibold fs-6">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Daftar hasil audit mutu internal yang telah selesai dilakukan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Section -->
                    <div class="py-5 px-10 bg-light-primary">
                        <div class="d-flex align-items-center position-relative">
                            <i class="fas fa-search fs-3 position-absolute ms-5 text-muted"></i>
                            <input type="text" id="searchInput" class="form-control form-control-solid w-300px ps-12"
                                   placeholder="Cari berdasarkan nama auditee, fakultas, atau auditor..." />
                        </div>
                    </div>
                </div>
            </div>

                        <!-- Cards Section -->
            <div class="row g-4">
                @forelse ($penugasanAuditors as $penugasanAuditor)
                    <div class="col-xl-4 col-lg-6 col-md-6 audit-card"
                         data-auditee="{{ strtolower($penugasanAuditor->auditee->nama_unit_kerja) }}"
                         data-fakultas="{{ strtolower($penugasanAuditor->auditee->fakultas ?? '') }}"
                         data-auditor="{{ strtolower(implode(' ', $penugasanAuditor->auditors->pluck('auditor.name')->toArray())) }}">

                        <div class="card h-100 shadow-sm hover-elevate-up">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-4 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-building fs-1 text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-5">{{ $penugasanAuditor->auditee->jenjang . ' ' . $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                            <span class="text-muted fw-semibold fs-7">
                                                <i class="fas fa-file-signature text-primary me-1"></i>
                                                {{ $penugasanAuditor->periodeAktif->nomor_surat ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                        $totalAuditor = $penugasanAuditor->auditors->count();
                                        $auditorSelesai = 0;
                                        foreach ($penugasanAuditor->auditors as $auditor) {
                                            foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                    $auditorSelesai++;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp

                                    @if($totalAuditor > 0)
                                        @if($auditorSelesai == $totalAuditor)
                                            <div class="text-end">
                                                <div class="badge badge-light-success fs-7 mb-1">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Audit Selesai
                                                </div>
                                                <div class="text-success fw-bold fs-8">{{ $auditorSelesai }}/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @elseif($auditorSelesai > 0)
                                            <div class="text-end">
                                                <div class="badge badge-light-warning fs-7 mb-1">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Dalam Proses
                                                </div>
                                                <div class="text-warning fw-bold fs-8">{{ $auditorSelesai }}/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @else
                                            <div class="text-end">
                                                <div class="badge badge-light-info fs-7 mb-1">
                                                    <i class="fas fa-hourglass-start me-1"></i>
                                                    Belum Dimulai
                                                </div>
                                                <div class="text-info fw-bold fs-8">0/{{ $totalAuditor }} Auditor</div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-end">
                                            <div class="badge badge-light-secondary fs-7 mb-1">
                                                <i class="fas fa-user-slash me-1"></i>
                                                Belum Ada Auditor
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Info Row-->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-info">
                                                    <i class="fas fa-calendar-alt text-info fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Tahun AMI</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->periodeAktif->tahun_ami ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-success">
                                                    <i class="fas fa-sync-alt text-success fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Siklus</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->periodeAktif->siklus ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info Row-->

                                <!--begin::Unit Info Row-->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-warning">
                                                    <i class="fas fa-graduation-cap text-warning fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Jenjang</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30px me-2">
                                                <span class="symbol-label bg-light-danger">
                                                    <i class="fas fa-university text-danger fs-6"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-muted fw-semibold fs-8">Fakultas</span>
                                                <span class="fw-bold fs-7">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Unit Info Row-->

                                                                <!--begin::Auditors-->
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted fw-semibold fs-8">
                                            <i class="fas fa-users me-1"></i>
                                            Daftar Auditor & Status Penilaian
                                        </span>
                                    </div>

                                    @forelse ($penugasanAuditor->auditors as $auditor)
                                        @php
                                            $sudahNilai = false;
                                            foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                    $sudahNilai = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="symbol symbol-30px me-2">
                                                @if($auditor->auditor->foto)
                                                    <img src="{{ Storage::url($auditor->auditor->foto) }}" alt="{{ $auditor->auditor->name }}" class="rounded-circle" />
                                                @else
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="fas fa-user text-primary fs-6"></i>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <span class="text-dark fw-bold fs-7">{{ $auditor->auditor->name }}</span>
                                                <span class="text-muted fw-semibold fs-8">{{ str_replace('_', ' ', $auditor->role) }}</span>
                                            </div>
                                            @if ($sudahNilai)
                                                <span class="badge badge-light-success fs-8">
                                                    <i class="fas fa-check me-1"></i>
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="badge badge-light-warning fs-8">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Proses
                                                </span>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-muted fst-italic fs-8">Belum ada auditor yang ditugaskan</div>
                                    @endforelse
                                </div>
                                <!--end::Auditors-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer pt-0">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('laporan.detail', $penugasanAuditor->id) }}" class="btn btn-sm btn-primary flex-grow-1">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Detail
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-download me-1"></i>
                                            Export
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.daftarPertanyaan', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-list me-2"></i>
                                                    Daftar Pertanyaan
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.beritaAcara', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-file-contract me-2"></i>
                                                    Berita Acara
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.evaluasiAmi', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-clipboard-check me-2"></i>
                                                    Evaluasi AMI
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('laporan.laporanAmi', $penugasanAuditor->id) }}" target="_blank">
                                                    <i class="fas fa-print me-2"></i>
                                                    Laporan AMI
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card card-custom">
                            <div class="card-body text-center p-10">
                                <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                <h4 class="text-gray-800 mb-2">Belum ada data</h4>
                                <p class="text-gray-600">Data audit akan muncul di sini setelah audit selesai dilakukan</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const auditCards = document.querySelectorAll('.audit-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        auditCards.forEach(card => {
            const auditee = card.getAttribute('data-auditee');
            const fakultas = card.getAttribute('data-fakultas');
            const auditor = card.getAttribute('data-auditor');

            const isMatch = auditee.includes(searchTerm) ||
                           fakultas.includes(searchTerm) ||
                           auditor.includes(searchTerm);

            if (isMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
