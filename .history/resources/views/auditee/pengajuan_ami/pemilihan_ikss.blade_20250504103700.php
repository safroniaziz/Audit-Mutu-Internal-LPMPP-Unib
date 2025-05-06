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

        
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="row row-cols-1 mb-6">
                        @foreach ($dataIkssProdi as $unit)
                            @foreach ($unit->indikatorKinerjas as $indikator)
                                <div class="col mb-4">
                                    <div class="card pt-4">
                                        <div class="card-header border-0">
                                            <div class="card-title">
                                                <h4 class="fw-bold mb-0">
                                                    ID IKSS: {{ $indikator->id }} - {{ $indikator->tujuan }}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            @foreach ($indikator->instrumen as $instrumen)
                                                <div class="d-flex flex-column border border-dashed border-gray-300 rounded px-6 py-4 mb-4">
                                                    <div class="fs-6 text-gray-800 mb-2"><strong>Indikator:</strong> {{ $instrumen->indikator }}</div>
                                                    <div class="fs-6 text-gray-700 mb-2"><strong>Sumber:</strong> {{ $instrumen->sumber }}</div>
                                                    <div class="fs-6 text-gray-700 mb-2"><strong>Target:</strong> {{ $instrumen->target }}</div>
                                                    <div class="fs-6 text-gray-700"><strong>Pilihan:</strong> 
                                                        <div class="form-check mt-1">
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