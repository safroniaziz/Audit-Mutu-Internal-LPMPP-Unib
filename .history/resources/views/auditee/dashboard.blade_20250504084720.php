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
        <div class="card-body p-9">
            <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                <div class="me-4">
                    <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">📢 Informasi Periode Aktif</h4>
                    <div class="fs-6 text-gray-700">
                        Saat ini, periode yang sedang aktif adalah
                        <span class="fw-semibold text-primary">
                            Nomor Surat: {{ $periodeAktif ? $periodeAktif->nomor_surat : 'Data tidak tersedia' }}
                        </span>
                        <br>
                        Tahun AMI: <span class="fw-semibold text-primary">
                            {{ $periodeAktif ? $periodeAktif->tahun_ami : 'Data tidak tersedia' }}
                        </span>
                        <br>
                        Jadwal input data oleh auditee akan berakhir pada
                        <span class="fw-semibold text-danger">
                            {{ $periodeAktif ? \Carbon\Carbon::parse($periodeAktif->tanggal_akhir)->format('d F Y \p\u{k}ul H:i') : 'Data tidak tersedia' }}
                        </span>
                        WIB.
                    </div>
                </div>
                <div class="ms-auto">
                    <a href="#" class="btn btn-sm btn-success px-4">Ajukan Permohonan</a>
                </div>
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
