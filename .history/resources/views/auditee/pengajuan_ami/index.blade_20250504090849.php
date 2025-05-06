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

            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Foto Profil</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}')">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('assets/media/avatars/blank.svg') }}')"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                            <i class="ki-duotone ki-pencil fs-7">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--begin::Inputs-->
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                            <i class="ki-duotone ki-cross fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                            <i class="ki-duotone ki-cross fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->

                    <!-- Display current file name -->
                    @if(Auth::user()->foto)
                        <div class="form-text">File saat ini: {{ basename(Auth::user()->foto) }}</div>
                    @endif

                    <!-- Hidden input to store current file path -->
                    <input type="hidden" name="current_avatar" value="{{ Auth::user()->foto }}">
                    <!--begin::Hint-->
                    <div class="form-text">Jenis file yang diperbolehkan: png, jpg, jpeg.</div>
                    <div class="form-text">Harap pilih file foto persegi untuk tampilan yang maksimal.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="nama lengkap" value="{{ Auth::user()->nama_lengkap }}" />
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
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nomor Pokok Mahasiswa (NPM)</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="nomor pokok mahasiswa" value="{{ Auth::user()->username }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="nomor pokok mahasiswa" value="{{ Auth::user()->email }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                    <span class="required">Jenis Kelamin</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="jenis_kelamin" aria-label="pilih jenis kelamin" data-control="select2" data-placeholder="Pilih jenis kelamin..." class="form-select form-select-solid form-select-lg fw-semibold">
                        <option value="">Pilih Jenis Kelamin...</option>
                        <option {{ Auth::user()->jenis_kelamin =="L" ? 'selected' : ''  }} value="L">Laki-Laki</option>
                        <option {{ Auth::user()->jenis_kelamin =="P" ? 'selected' : ''  }} value="P">Perempuan</option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                    <span class="required">Jalur Masuk</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="jalur_ujian" aria-label="pilih jalur masuk" data-control="select2" data-placeholder="Pilih jalur masuk..." class="form-select form-select-solid form-select-lg fw-semibold">
                        <option value="">Pilih Jalur Masuk...</option>
                        <option {{ Auth::user()->jalur_masuk =="sbmptn" ? 'selected' : ''  }} value="sbmptn">SBMPTM</option>
                        <option {{ Auth::user()->jalur_masuk =="snmptn" ? 'selected' : ''  }} value="snmptn">UNDANGAN/SNMPTN</option>
                        <option {{ Auth::user()->jalur_masuk =="mandiri" ? 'selected' : ''  }} value="mandiri">MANDIRI</option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Rata-Rata Nilai Ujian</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="rata_ujian" class="form-control form-control-lg form-control-solid" placeholder="rata-rata nilai ujian" value="{{ Auth::user()->rata_ujian }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Asal Sekolah</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="asal_sekolah" class="form-control form-control-lg form-control-solid" placeholder="asal sekolah" value="{{ Auth::user()->asal_sekolah }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Asal Provinsi Sma</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="text" name="asal_provinsi_sma" class="form-control form-control-lg form-control-solid" placeholder="asal provinsi sma" value="{{ Auth::user()->asal_provinsi_sma }}" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-0">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Akun Aktif</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                        <input class="form-check-input w-45px h-30px" type="checkbox" id="allowmarketing" checked="checked" disabled/>
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
                <!--begin::Label-->
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
@endsection
