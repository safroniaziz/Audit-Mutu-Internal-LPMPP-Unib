@extends('auditee/dashboard_template')
@section('dashboardProfile')
    <div class="card mb-5 mb-xl-10">
        <div class="card-body p-9">
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                    <i class="fas fa-file-alt fs-2x text-primary"></i>
                </span>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">Dokumen Hasil Audit Mutu Internal</h4>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <span class="text-gray-700 fw-semibold">Berikut adalah daftar dokumen hasil audit mutu internal yang telah selesai dilakukan. Anda dapat melihat detail hasil audit untuk setiap unit kerja.</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->

            <div class="row g-5 g-xl-8">
                @forelse ($penugasanAuditors as $penugasanAuditor)
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 shadow-sm hover-elevate-up">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-building fs-2x text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-4">{{ $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                            <span class="text-muted fw-semibold mt-1">
                                                <i class="fas fa-file-signature text-primary me-2"></i>
                                                {{ $penugasanAuditor->periodeAktif->nomor_surat }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Info-->
                                <div class="d-flex flex-column mb-7">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-info">
                                                <i class="fas fa-calendar-alt text-info"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Tahun AMI</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->periodeAktif->tahun_ami }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-success">
                                                <i class="fas fa-sync-alt text-success"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Siklus</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->periodeAktif->siklus }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info-->

                                <!--begin::Unit Info-->
                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-column mb-7">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="fas fa-graduation-cap text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Jenjang</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="fas fa-university text-danger"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Fakultas</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Unit Info-->

                                <!--begin::Auditors-->
                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-column">
                                    <span class="text-muted fw-semibold fs-7 mb-3">Tim Auditor</span>
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
                                <!--end::Auditors-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <a href="{{ route('auditee.laporan.detail', $penugasanAuditor->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Lihat Detail
                                </a>
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
                                <p class="text-gray-600">Data audit akan muncul di sini</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
