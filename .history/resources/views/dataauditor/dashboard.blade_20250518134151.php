@extends('dataauditor/dashboard_template')

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

    <!--begin::AMI Documents-->
    <div class="card mb-5 mb-xl-10" id="kt_ami_documents_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-text fs-2"></i> Dokumen AMI
                </h3>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-light-primary">
                    <i class="bi bi-arrow-clockwise fs-3"></i> Refresh
                </button>
            </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <div class="alert alert-primary d-flex align-items-start p-5 position-relative">
                <div class="me-4">
                    <i class="bi bi-lightbulb-fill fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">📄 Dokumen Penting Audit</h4>
                    <div class="fs-6 text-gray-700">
                        <p>Silahkan unduh dokumen-dokumen yang diperlukan untuk proses audit mutu internal.</p>
                    </div>
                </div>
            </div>

            <!--begin::Dokumen Standar-->
            <div class="mb-10">
                <h4 class="fw-bold d-flex align-items-center mb-6">
                    <span class="bullet bullet-vertical bg-primary me-3"></span>Dokumen Standar
                </h4>

                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-primary text-primary">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Panduan Audit</h3>
                                        <div class="text-gray-600 fw-semibold">Pedoman audit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Panduan lengkap proses audit mutu internal beserta standar pengukuran</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-primary">PDF</span>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-success text-success">
                                            <i class="bi bi-file-earmark-excel"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Formulir Audit</h3>
                                        <div class="text-gray-600 fw-semibold">Form checklist</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Formulir checklist untuk melakukan audit sesuai dengan standar yang ditentukan</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-success">Excel</span>
                                    <a href="#" class="btn btn-sm btn-success">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-info text-info">
                                            <i class="bi bi-file-earmark-word"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Template Laporan</h3>
                                        <div class="text-gray-600 fw-semibold">Format laporan audit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Template laporan hasil audit yang harus dilengkapi oleh auditor</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-info">Word</span>
                                    <a href="#" class="btn btn-sm btn-info">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Dokumen Standar-->

            <!--begin::Panduan & Referensi-->
            <div class="mb-10">
                <h4 class="fw-bold d-flex align-items-center mb-6">
                    <span class="bullet bullet-vertical bg-primary me-3"></span>Panduan & Referensi
                </h4>

                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-primary text-primary">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Standar SPMI</h3>
                                        <div class="text-gray-600 fw-semibold">Sistem penjaminan mutu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Dokumen standar sistem penjaminan mutu internal untuk perguruan tinggi</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-primary">PDF</span>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-primary text-primary">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Pedoman Evaluasi</h3>
                                        <div class="text-gray-600 fw-semibold">Evaluasi program studi</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Pedoman evaluasi mutu program studi berdasarkan standar nasional</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-primary">PDF</span>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-danger text-danger">
                                            <i class="bi bi-file-earmark-slides"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Presentasi AMI</h3>
                                        <div class="text-gray-600 fw-semibold">Materi sosialisasi</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Materi presentasi untuk sosialisasi AMI kepada pihak yang diaudit</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-danger">PPT</span>
                                    <a href="#" class="btn btn-sm btn-danger">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Panduan & Referensi-->

            <!--begin::Dokumentasi Terbaru-->
            <div class="mb-0">
                <h4 class="fw-bold d-flex align-items-center mb-6">
                    <span class="bullet bullet-vertical bg-primary me-3"></span>Dokumentasi Terbaru
                </h4>

                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-primary text-primary">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Surat Tugas</h3>
                                        <div class="text-gray-600 fw-semibold">Penugasan audit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Surat tugas resmi untuk pelaksanaan audit mutu internal</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-primary">PDF</span>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-warning text-warning">
                                            <i class="bi bi-file-earmark-zip"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Dokumen Pendukung</h3>
                                        <div class="text-gray-600 fw-semibold">Kumpulan dokumen</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Kumpulan dokumen pendukung proses audit mutu internal</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-warning">ZIP</span>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 h-100">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label fs-1 bg-light-info text-info">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0 fs-4">Jadwal Audit</h3>
                                        <div class="text-gray-600 fw-semibold">Timeline pelaksanaan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-6">
                                <p class="text-gray-600 fs-6 fw-semibold mb-5">Jadwal lengkap pelaksanaan audit mutu internal tahun ini</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge badge-light-info">PDF</span>
                                    <a href="#" class="btn btn-sm btn-info">
                                        <i class="bi bi-download fs-4 me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Dokumentasi Terbaru-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::AMI Documents-->
@endsection
