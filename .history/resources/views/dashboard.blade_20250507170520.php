@extends('layouts.dashboard.dashboard')
@section('menu')
    Halaman Dashboard
@endsection

@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-4">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card header-->
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <!--begin::Icon-->
                                <div class="symbol symbol-45px w-45px bg-light me-5">
                                    <img src="assets/media/svg/brand-logos/twitch.svg" alt="image" class="p-3" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">Jumlah Indikator IKSS</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                            <!--begin::Heading-->
                            <div class="fs-2tx fw-bold mb-3">$500.00</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>

                <div class="col-sm-6 col-xl-4">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card header-->
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <!--begin::Icon-->
                                <div class="symbol symbol-45px w-45px bg-light me-5">
                                    <img src="assets/media/svg/brand-logos/twitch.svg" alt="image" class="p-3" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">Jumlah Indikator IKSS</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                            <!--begin::Heading-->
                            <div class="fs-2tx fw-bold mb-3">$500.00</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-sm-6 col-xl-4">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card header-->
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <!--begin::Icon-->
                                <div class="symbol symbol-45px w-45px bg-light me-5">
                                    <img src="assets/media/svg/brand-logos/twitch.svg" alt="image" class="p-3" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">Jumlah Indikator IKSS</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                            <!--begin::Heading-->
                            <div class="fs-2tx fw-bold mb-3">$500.00</div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
            <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
@endsection
