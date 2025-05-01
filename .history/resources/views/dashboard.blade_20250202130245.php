@extends('layouts.dashboard.dashboard')
@section('menu')
    Halaman Dashboard
@endsection
@section('link1')
    Halaman Dashboard
@endsection
@section('menu')
    Halaman Dashboard
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 16-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #080655">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">69</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Active Projects</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span>43 Pending</span>
                                    <span>72%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: 72%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 16-->
                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">357</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Professionals</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s Heroes</span>
                            <!--end::Title-->
                            <!--begin::Users group-->
                            <div class="symbol-group symbol-hover flex-nowrap">
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                                    <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                                    <img alt="Pic" src="{{ asset('assets/assets/media/avatars/300-11.jpg') }}" />
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                                    <img alt="Pic" src="{{ asset('assets/assets/media/avatars/300-2.jpg') }}" />
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                                    <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                                    <img alt="Pic" src="{{ asset('assets/assets/media/avatars/300-12.jpg') }}" />
                                </div>
                                <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                    <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                                </a>
                            </div>
                            <!--end::Users group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">$</span>
                                    <!--end::Currency-->
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">69,700</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-success fs-base">
                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>2.2%</span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Projects Earnings in April</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center me-5 pt-2">
                                <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                    <!--begin::List widget 25-->
                    <div class="card card-flush h-lg-50">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title text-gray-800">Highlights</h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar d-none">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">Loading date range...</div>
                                    <!--end::Display range-->
                                    <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Client Rating</div>
                                <!--end::Section-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-senter">
                                    <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Number-->
                                    <span class="text-gray-900 fw-bolder fs-6">7.8</span>
                                    <!--end::Number-->
                                    <span class="text-gray-500 fw-bold fs-6">/10</span>
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Quotes</div>
                                <!--end::Section-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-senter">
                                    <i class="ki-duotone ki-arrow-down-right fs-2 text-danger me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Number-->
                                    <span class="text-gray-900 fw-bolder fs-6">730</span>
                                    <!--end::Number-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Agent Earnings</div>
                                <!--end::Section-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-senter">
                                    <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Number-->
                                    <span class="text-gray-900 fw-bolder fs-6">$2,309</span>
                                    <!--end::Number-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::LIst widget 25-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <!--begin::Card widget 18-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Body-->
                        <div class="card-body py-9">
                            <!--begin::Row-->
                            <div class="row gx-9 h-100">
                                <!--begin::Col-->
                                <div class="col-sm-6 mb-10 mb-sm-0">
                                    <!--begin::Image-->
                                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-400px min-h-sm-100 h-100" style="background-size: 100% 100%;background-image:url('{{ asset('assets/assets/media/stock/600x600/img-33.jpg') }}')"></div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column h-100">
                                        <!--begin::Header-->
                                        <div class="mb-7">
                                            <!--begin::Headin-->
                                            <div class="d-flex flex-stack mb-6">
                                                <!--begin::Title-->
                                                <div class="flex-shrink-0 me-5">
                                                    <span class="text-gray-500 fs-7 fw-bold me-2 d-block lh-1 pb-1">Featured</span>
                                                    <span class="text-gray-800 fs-1 fw-bold">9 Degree</span>
                                                </div>
                                                <!--end::Title-->
                                                <span class="badge badge-light-primary flex-shrink-0 align-self-center py-3 px-4 fs-7">In Process</span>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Items-->
                                            <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center me-5 me-xl-13">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px symbol-circle me-3">
                                                        <img src="{{ asset('assets/assets/media/avatars/300-3.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <span class="fw-semibold text-gray-500 d-block fs-8">Manager</span>
                                                        <a href="pages/user-profile/overview.html" class="fw-bold text-gray-800 text-hover-primary fs-7">Robert Fox</a>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px symbol-circle me-3">
                                                        <span class="symbol-label bg-success">
                                                            <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <span class="fw-semibold text-gray-500 d-block fs-8">Budget</span>
                                                        <span class="fw-bold text-gray-800 fs-7">$64.800</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="mb-6">
                                            <!--begin::Text-->
                                            <span class="fw-semibold text-gray-600 fs-6 mb-8 d-block">Flat cartoony illustrations with vivid unblended colors and asymmetrical beautiful purple hair lady</span>
                                            <!--end::Text-->
                                            <!--begin::Stats-->
                                            <div class="d-flex">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <!--begin::Date-->
                                                    <span class="fs-6 text-gray-700 fw-bold">Feb 6, 2021</span>
                                                    <!--end::Date-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold text-gray-500">Due Date</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                    <!--begin::Number-->
                                                    <span class="fs-6 text-gray-700 fw-bold">$
                                                    <span class="ms-n1" data-kt-countup="true" data-kt-countup-value="284,900.00">0</span></span>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold text-gray-500">Budget</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Body-->
                                        <!--begin::Footer-->
                                        <div class="d-flex flex-stack mt-auto bd-highlight">
                                            <!--begin::Users group-->
                                            <div class="symbol-group symbol-hover flex-nowrap">
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                                                    <img alt="Pic" src="{{ asset('assets/assets/media/avatars/300-2.jpg') }}" />
                                                </div>
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                                                    <img alt="Pic" src="{{ asset('assets/assets/media/avatars/300-3.jpg') }}" />
                                                </div>
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                                </div>
                                            </div>
                                            <!--end::Users group-->
                                            <!--begin::Actions-->
                                            <a href="apps/projects/project.html" class="d-flex align-items-center text-primary opacity-75-hover fs-6 fw-semibold">View Project
                                            <i class="ki-duotone ki-exit-right-corner fs-4 ms-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i></a>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 18-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
                <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Engage widget 1-->
                    <div class="card h-md-100" dir="ltr">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column flex-center">
                            <!--begin::Heading-->
                            <div class="mb-2">
                                <!--begin::Title-->
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">Have your tried
                                <br />new
                                <span class="fw-bolder">Invoice Manager?</span></h1>
                                <!--end::Title-->
                                <!--begin::Illustration-->
                                <div class="py-10 text-center">
                                    <img src="{{ asset('assets/assets/media/svg/illustrations/easy/2.svg') }}" class="theme-light-show w-200px" alt="" />
                                    <img src="{{ asset('assets/assets/media/svg/illustrations/easy/2-dark.svg') }}" class="theme-dark-show w-200px" alt="" />
                                </div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Links-->
                            <div class="text-center mb-1">
                                <!--begin::Link-->
                                <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_address" data-bs-toggle="modal">Try Now</a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a class="btn btn-sm btn-light" href="apps/user-management/users/view.html">Learn More</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table widget 14-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Projects Stats</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">History</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                            <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
                                            <th class="p-0 pb-3 min-w-100px text-end">BUDGET</th>
                                            <th class="p-0 pb-3 min-w-100px text-end">PROGRESS</th>
                                            <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                            <th class="p-0 pb-3 w-125px text-end pe-7">CHART</th>
                                            <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="{{ asset('assets/assets/media/stock/600x600/img-49.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mivy App</a>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Jane Cooper</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$32,400</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-12">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_14_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="{{ asset('assets/assets/media/stock/600x600/img-40.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Avionica</a>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Esther Howard</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$256,910</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>0.4%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-12">
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">On Hold</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_14_chart_2" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="{{ asset('assets/assets/media/stock/600x600/img-39.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Charto CRM</a>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Jenny Wilson</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$8,220</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-12">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_14_chart_3" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="{{ asset('assets/assets/media/stock/600x600/img-47.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tower Hill</a>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Cody Fisher</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$74,000</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-12">
                                                <span class="badge py-3 px-4 fs-7 badge-light-success">Complated</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_14_chart_4" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="{{ asset('assets/assets/media/stock/600x600/img-48.jpg') }}" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">9 Degree</a>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Savannah Nguyen</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$183,300</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>0.4%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-12">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_14_chart_5" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Table widget 14-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
@endsection
