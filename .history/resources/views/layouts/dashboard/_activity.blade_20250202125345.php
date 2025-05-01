<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
    <div class="card shadow-none border-0 rounded-0">
        <!--begin::Header-->
        <div class="card-header" id="kt_activities_header">
            <h3 class="card-title fw-bold text-gray-900">Activity Logs</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body position-relative " id="kt_activities_body">
            <!--begin::Content-->
            <div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
                <!--begin::Timeline items-->
                <div class="timeline timeline-border-dashed min-w-700px p-5">
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon me-4">
                            <i class="ki-duotone ki-flag fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-n2">
                            <!--begin::Timeline heading-->
                            <div class="overflow-auto pe-3">
                                <!--begin::Title-->
                                <div class="fs-5 fw-semibold mb-2">Invitation for crafting engaging designs that speak human workshop</div>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <!--begin::Info-->
                                    <div class="text-muted me-2 fs-7">Sent at 4:23 PM by</div>
                                    <!--end::Info-->
                                    <!--begin::User-->
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
                                        <img src="{{ asset('assets/assets/media/avatars/300-1.jpg') }}" alt="img" />
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-disconnect fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-n1">
                            <!--begin::Timeline heading-->
                            <div class="mb-5 pe-3">
                                <!--begin::Title-->
                                <a href="#" class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">3 New Incoming Project Files:</a>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <!--begin::Info-->
                                    <div class="text-muted me-2 fs-7">Sent at 10:30 PM by</div>
                                    <!--end::Info-->
                                    <!--begin::User-->
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
                                        <img src="{{ asset('assets/assets/media/avatars/300-23.jpg') }}" alt="img" />
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                </div>
                <!--end::Timeline items-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer py-5 text-center" id="kt_activities_footer">
            <a href="pages/user-profile/activity.html" class="btn btn-bg-body text-primary">View All Activities
            <i class="ki-duotone ki-arrow-right fs-3 text-primary">
                <span class="path1"></span>
                <span class="path2"></span>
            </i></a>
        </div>
        <!--end::Footer-->
    </div>
</div>
