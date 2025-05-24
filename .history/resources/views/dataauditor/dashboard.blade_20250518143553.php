@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
<div class="row g-5 g-xl-8">
    <!--begin::Col (Profile)-->
    <div class="col-xl-7">
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill fs-1"></i> Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-primary fs-7 fw-bold">Data Auditor</span>
            </div>
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <!-- Progress bar for profile completion -->
                @php
                    $user = Auth::user();
                    $completionPercentage = $user->getProfileCompletionPercentage();
                @endphp
                <div class="mb-8">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-semibold text-gray-600">Kelengkapan Profil</span>
                        <span class="fw-bold fs-6">{{ $completionPercentage }}%</span>
                    </div>
                    <div class="h-8px bg-light rounded">
                        <div class="bg-primary rounded h-8px" role="progressbar" style="width: {{ $completionPercentage }}%" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Alert with animation -->
                <div class="alert alert-info d-flex align-items-start p-5 position-relative border-0 border-start border-5 border-primary">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-primary pulse-primary"></i>
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
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="collapse" data-bs-target="#moreInfo">
                                <i class="bi bi-info-circle me-1"></i> Info Selengkapnya
                            </button>
                        </div>
                        <div class="collapse mt-3" id="moreInfo">
                            <div class="card card-body bg-light-info border-0">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Lengkapi profil Anda untuk memudahkan proses audit</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Unduh dokumen template yang diperlukan</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>Hubungi admin jika ada kendala</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="separator separator-dashed my-8"></div>

                <h3 class="fw-bold text-dark mb-7">
                    <i class="bi bi-person-vcard fs-2 me-2 text-primary"></i>Detail Profil
                </h3>

                <div class="row">
                    <div class="col-md-6">
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
                    </div>

                    <div class="col-md-6">
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
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-light me-3">Batal</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                        <span class="indicator-label">Simpan Perubahan</span>
                        <span class="indicator-progress">Menyimpan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

    <!--begin::Documents card-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-text fs-1"></i> Dokumen Audit
                </h3>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip" title="Refresh Daftar File">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Paste bagian "New Download Files Section" yang Anda hapus tadi ke sini -->
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle">
                    <thead class="border-bottom border-gray-200">
                        <tr class="fw-bold text-muted">
                            <th class="min-w-150px">Nama Dokumen</th>
                            <th class="min-w-100px">Tipe</th>
                            <th class="min-w-100px">Ukuran</th>
                            <th class="min-w-100px">Tanggal Upload</th>
                            <th class="min-w-100px text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows content (tidak diubah) -->
                        <!-- Salin konten table dari kode sebelumnya -->
                    </tbody>
                </table>
            </div>

            <!-- Download Progress Overlay -->
            <!-- Salin konten Download Progress Overlay dari kode sebelumnya -->

            <div class="d-flex justify-content-between mt-5">
                <span class="text-muted fs-7">Total 3 dokumen tersedia</span>
                <button type="button" class="btn btn-sm btn-light-primary" id="downloadAllBtn">
                    <i class="bi bi-cloud-download me-1"></i> Unduh Semua
                </button>
            </div>
        </div>
    </div>
    <!--end::Documents card-->

@endsection
@push('scripts')

@endpush
