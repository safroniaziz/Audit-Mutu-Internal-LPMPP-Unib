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
        <!--begin::Card header-->
        <!--begin::Card body-->
        <form id="kt_account_profile_details_form" action="{{ route('auditee.pengajuanAmi.lengkapiProfil') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📢 Proses Selanjutnya</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-4">
                                <strong>Catatan:</strong>
                                <span class="fw-semibold text-danger">
                                    Mohon lengkapi data profil Anda hingga mencapai 100% sebelum dapat melanjutkan ke proses selanjutnya.
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                        $completionPercentage = $user->getProfileCompletionPercentage();
                    @endphp

                    <div class="ms-auto">
                        <a 
                            href="{{ $completionPercentage < 100 ? '#' : route('auditee.pengajuanAmi.pemilihanIkss') }}" 
                            class="btn btn-sm px-4 {{ $completionPercentage < 100 ? 'btn-secondary disabled' : 'btn-primary' }}"
                            style="{{ $completionPercentage < 100 ? 'pointer-events: none; opacity: 0.7;' : '' }}"
                        >
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection