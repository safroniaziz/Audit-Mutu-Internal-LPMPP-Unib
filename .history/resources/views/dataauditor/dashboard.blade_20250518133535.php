@extends('dataauditor/dashboard_template')
@push('styles')
    <style>
        :root {
            --primary: #009ef7;
            --primary-active: #0095e8;
            --light-primary: #f1faff;
            --secondary: #e1e3ea;
            --success: #50cd89;
            --info: #7239ea;
            --warning: #ffc700;
            --danger: #f1416c;
            --light: #f5f8fa;
            --dark: #181c32;
            --gray-100: #f9f9f9;
            --gray-200: #f1f1f2;
            --gray-300: #e1e3ea;
            --gray-400: #b5b5c3;
            --gray-500: #a1a5b7;
            --gray-600: #7e8299;
            --gray-700: #5e6278;
            --gray-800: #3f4254;
            --gray-900: #181c32;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f8fa;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .container {
            width: 100%;
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1.5rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .card {
            background-color: #fff;
            border-radius: 0.65rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.75rem;
            border: 0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .card-title {
            margin: 0;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--dark);
        }

        .card-toolbar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.75rem;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0.75rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--gray-700);
        }

        .form-label.required::after {
            content: "*";
            color: var(--danger);
            margin-left: 0.25rem;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background-color: #fff;
            border: 1px solid var(--gray-300);
            border-radius: 0.475rem;
            color: var(--gray-700);
            transition: border-color 0.15s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
        }

        .form-control-solid {
            background-color: var(--gray-100);
            border-color: var(--gray-200);
            color: var(--gray-700);
        }

        .select {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background-color: #fff;
            border: 1px solid var(--gray-300);
            border-radius: 0.475rem;
            color: var(--gray-700);
            transition: border-color 0.15s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M12.72 15.78a.75.75 0 01-1.04 0l-6-6A.75.75 0 016.72 8.7L12 14.09l5.28-5.3a.75.75 0 111.04 1.08l-6 6z' fill='%235e6278'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
            padding-right: 2.5rem;
        }

        .btn {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 0.475rem;
            border: 0;
            background-color: transparent;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: var(--primary-active);
        }

        .btn-secondary {
            background-color: var(--gray-300);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background-color: var(--gray-400);
        }

        .btn-light-primary {
            background-color: var(--light-primary);
            color: var(--primary);
        }

        .btn-light-primary:hover {
            background-color: var(--primary);
            color: #fff;
        }

        .btn-icon {
            padding: 0.65rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .btn-icon i {
            margin-right: 0;
        }

        .alert {
            position: relative;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.475rem;
            border: 1px solid transparent;
        }

        .alert-info {
            background-color: var(--light-primary);
            border-color: var(--primary);
        }

        .alert-icon {
            font-size: 1.5rem;
            color: var(--primary);
            margin-right: 1rem;
        }

        .alert-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .alert-text {
            color: var(--gray-700);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.65rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 0.475rem;
        }

        .badge-primary {
            background-color: var(--light-primary);
            color: var(--primary);
        }

        .badge-light {
            background-color: var(--light);
            color: var(--gray-700);
        }

        .fw-bold {
            font-weight: 600;
        }

        .text-primary {
            color: var(--primary);
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .separator {
            height: 1px;
            background-color: var(--gray-200);
            margin: 2rem 0;
        }

        .grid-docs {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .doc-card {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 0.65rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .doc-card:hover {
            border-color: var(--primary);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 158, 247, 0.15);
            transform: translateY(-3px);
        }

        .doc-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background-color: var(--light-primary);
            color: var(--primary);
            font-size: 2rem;
        }

        .doc-body {
            padding: 1.5rem;
            flex: 1;
        }

        .doc-title {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .doc-info {
            font-size: 0.85rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .doc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background-color: var(--gray-100);
        }

        .doc-badge {
            font-size: 0.75rem;
        }

        .scroll-y {
            overflow-y: auto;
            max-height: 100%;
        }
    </style>
@endpush
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
        <form id="kt_account_profile_details_form_2"  class="form" method="POST" enctype="multipart/form-data">
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
                                <span class="fw-semibold text-primary">
                                    Silakan lanjutkan dengan melaksanakan audit sesuai penugasan yang telah diberikan. Pastikan Anda telah memahami ruang lingkup dan dokumen yang harus diperiksa.
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                        $completionPercentage = $user->getProfileCompletionPercentage();
                    @endphp

                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama auditor</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 fv-row">
                                <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nama auditor" value="{{ Auth::user()->name }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Fakultas</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="fakultas" class="form-control form-control-lg form-control-solid" placeholder="Nama Fakultas" value="{{ Auth::user()->unitKerja && Auth::user()->unitKerja->fakultas ? Auth::user()->unitKerja->fakultas : '-' }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Ketua</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_ketua" class="form-control form-control-lg form-control-solid" placeholder="Nama Ketua" value="{{ Auth::user()->unitKerja->nama_ketua }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIP Ketua</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nip_ketua" class="form-control form-control-lg form-control-solid" placeholder="NIP Ketua" value="{{ Auth::user()->unitKerja->nip_ketua }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenjang</label>
                    <div class="col-lg-8 fv-row">
                        <select name="jenjang" aria-label="pilih jenjang" data-control="select2" data-placeholder="Pilih Jenjang..." class="form-select form-select-solid form-select-lg fw-semibold">
                            <option value="">Pilih Jenjang...</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="D2" ? 'selected' : '' }} value="D2">D2</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="D3" ? 'selected' : '' }} value="D3">D3</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="D4" ? 'selected' : '' }} value="D4">D4</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="S1" ? 'selected' : '' }} value="S1">S1</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="S2" ? 'selected' : '' }} value="S2">S2</option>
                            <option {{ Auth::user()->unitKerja->jenjang =="S3" ? 'selected' : '' }} value="S3">S3</option>
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Website</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="website" class="form-control form-control-lg form-control-solid" placeholder="Website" value="{{ Auth::user()->unitKerja->website }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">E-mail</label>
                    <div class="col-lg-8 fv-row">
                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="E-mail" value="{{ Auth::user()->email }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">No HP</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="no_hp" class="form-control form-control-lg form-control-solid" placeholder="No HP" value="{{ Auth::user()->unitKerja->no_hp }}" />
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
