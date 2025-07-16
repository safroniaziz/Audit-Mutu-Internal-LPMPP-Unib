@extends('auditee/dashboard_template')
@section('dashboardProfile')
    <div class="card mb-5 mb-xl-10">
        <div class="card-body p-9">
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                    <i class="fas fa-info-circle fs-2x text-primary"></i>
                </span>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">Dokumen Hasil Audit</h4>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <span class="text-gray-700 fw-semibold">Kelola dan akses dokumen hasil audit dengan mudah</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->

            <div class="row g-5 g-xl-8">
                @forelse ($penugasanAuditors as $penugasanAuditor)
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">{{ $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                    <span class="text-muted mt-1 fw-semibold fs-7">
                                        Periode {{ $penugasanAuditor->periodeAktif->tahun }} - Siklus {{ $penugasanAuditor->periodeAktif->siklus }}
                                    </span>
                                </h3>
                            </div>

                            <div class="card-body py-3">
                                <div class="d-flex flex-column mb-7">
                                    <div class="d-flex flex-stack">
                                        <span class="text-muted fw-semibold">Jenjang</span>
                                        <span class="fw-bold">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                    </div>
                                    <div class="d-flex flex-stack mt-3">
                                        <span class="text-muted fw-semibold">Fakultas</span>
                                        <span class="fw-bold">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                    </div>
                                </div>

                                <div class="d-flex flex-column">
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

                                        <div class="d-flex align-items-center mb-5">
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="fas fa-user text-primary"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <span class="text-dark fw-bold">{{ $auditor->auditor->name }}</span>
                                                <span class="text-muted fw-semibold">{{ str_replace('_', ' ', $auditor->role) }}</span>
                                            </div>
                                            @if ($sudahNilai)
                                                <span class="badge badge-light-success">Selesai</span>
                                            @else
                                                <span class="badge badge-light-warning">Dalam Proses</span>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-muted fst-italic">Belum ada auditor yang ditugaskan</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('auditee.laporan.detail', $penugasanAuditor->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Lihat Detail
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
                                <p class="text-gray-600">Data audit akan muncul di sini</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
