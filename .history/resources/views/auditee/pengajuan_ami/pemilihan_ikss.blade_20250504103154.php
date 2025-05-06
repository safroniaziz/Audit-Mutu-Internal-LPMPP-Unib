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
                                untuk dapat melanjutkan ke tahap <strong>pengisian instrumen audit</strong>.
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
    </div>
    <!--end::details View-->
@endsection