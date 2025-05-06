@extends('auditee/dashboard_template')

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
                </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                <div class="me-4">
                    <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">📢 Informasi Penting</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>Catatan:</strong>
                            <span class="text-gray-800">
                                Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh 
                                untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                            </span>
                        </p>
                    </div>
                </div>
        
        
                <div class="ms-auto">
                    <a 
                        href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}" 
                        class="btn btn-sm px-4 btn-primary"
                        style=""
                    >
                        <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                    </a>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#ikss_tab">Instrumen Kinerja Satuan/Sistem (IKSS)</a>
                </li>
            </ul>
        
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        @foreach ($dataIkssProdi as $unit)
                            @foreach ($unit->indikatorKinerjas as $indikatorIndex => $indikator)
                                <!-- Timeline item -->
                                <div class="timeline-item">
                                    <div class="timeline-line"></div>
                                    <div class="timeline-icon">
                                        <span class="fs-5 text-gray-500">{{ $indikatorIndex + 1 }}</span>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-4 fw-bold text-gray-800 mb-2">
                                                ID IKSS: {{ $indikator->id }} – {{ $indikator->tujuan }}
                                            </div>
                                            <div class="text-muted fs-6 mb-4">Berikut daftar instrumen yang terkait:</div>
                                        </div>
        
                                        @foreach ($indikator->instrumen as $instrumenIndex => $instrumen)
                                            <div class="d-flex align-items-start border border-dashed border-gray-300 rounded px-6 py-4 mb-3">
                                                <div class="flex-grow-1">
                                                    <div class="fs-6 fw-bold text-gray-900 mb-1">
                                                        {{ $instrumenIndex + 1 }}. {{ $instrumen->indikator }}
                                                    </div>
                                                    <div class="fs-7 text-muted">
                                                        <div><strong>Sumber:</strong> {{ $instrumen->sumber }}</div>
                                                        <div><strong>Target:</strong> {{ $instrumen->target }}</div>
                                                    </div>
                                                </div>
                                                <div class="ms-5">
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="radio" name="pilihan_{{ $instrumen->id }}" id="ya_{{ $instrumen->id }}" value="1">
                                                        <label class="form-check-label" for="ya_{{ $instrumen->id }}">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pilihan_{{ $instrumen->id }}" id="tidak_{{ $instrumen->id }}" value="0">
                                                        <label class="form-check-label" for="tidak_{{ $instrumen->id }}">Tidak</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!--end::details View-->
@endsection