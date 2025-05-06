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
                <div class="ms-auto">
                    <a href="{{ route('auditee.dashboard') }}" class="btn btn-sm btn-primary px-4">Proses Selanjutnya</a>
                </div>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Auditee</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nama Auditee" value="{{ Auth::user()->name }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Fakultas</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="fakultas" class="form-control form-control-lg form-control-solid" placeholder="Nama Fakultas" value="{{ Auth::user()->unitKerja->fakultas }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Ketua</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="nama_ketua" class="form-control form-control-lg form-control-solid" placeholder="Nama Ketua" value="{{ Auth::user()->unitKerja->nama_ketua }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIP Ketua</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="nip_ketua" class="form-control form-control-lg form-control-solid" placeholder="NIP Ketua" value="{{ Auth::user()->unitKerja->nip_ketua }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                    <span class="required">Jenjang</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="jalur_ujian" aria-label="pilih jenjang" data-control="select2" data-placeholder="pilih jenjang..." class="form-select form-select-solid form-select-lg fw-semibold">
                        <option value="">Pilih Jalur Masuk...</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="D2" ? 'selected' : ''  }} value="sbmptn">D2</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="D3" ? 'selected' : ''  }} value="snmptn">D3</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="D4" ? 'selected' : ''  }} value="mandiri">D4</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="S1" ? 'selected' : ''  }} value="S1">S1</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="S2" ? 'selected' : ''  }} value="S2">S2</option>
                        <option {{ Auth::user()->unitKerja->jenjang =="S3" ? 'selected' : ''  }} value="S3">S3</option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Website</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="website" class="form-control form-control-lg form-control-solid" placeholder="website" value="{{ Auth::user()->unitkerja->website }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">E-mail</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="E-mail" value="{{ Auth::user()->email }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">No HP</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="numeric" name="no_hp" class="form-control form-control-lg form-control-solid" placeholder="no hp" value="{{ Auth::user()->unitKerja->no_hp }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
