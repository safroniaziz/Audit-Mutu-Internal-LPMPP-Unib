<div id="kt_activities" class="bg-body activity-log-drawer" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'350px', 'lg': '400px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activity_log_toggle" data-kt-drawer-close="#kt_activities_close">
    <div class="card shadow-none border-0 rounded-0 h-100">
        <!--begin::Header-->
        <div class="card-header activity-log-header" id="kt_activities_header">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px me-3">
                    <div class="symbol-label bg-light-primary">
                        <i class="fas fa-history fs-2 text-primary"></i>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <h3 class="card-title fw-bold text-dark mb-0">Activity Log</h3>
                    <span class="text-muted fs-7">Riwayat Aktivitas SIAMI</span>
                </div>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
                    <i class="fas fa-times fs-2 text-dark"></i>
                </button>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body position-relative p-0" id="kt_activities_body">
            <!--begin::Content-->
            <div id="kt_activities_scroll" class="position-relative scroll-y" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">

                <!--begin::Activity Stats-->
                <div class="p-6 border-bottom border-light">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 rounded bg-light-primary">
                                <div class="fs-2 fw-bold text-primary" id="total-activities">0</div>
                                <div class="fs-7 text-muted">Total Aktivitas</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded bg-light-success">
                                <div class="fs-2 fw-bold text-success" id="unread-activities">0</div>
                                <div class="fs-7 text-muted">Belum Dibaca</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Activity Stats-->

                <!--begin::Activity List-->
                <div class="p-6" id="activity-list">
                    <!--begin::Loading State-->
                    <div class="text-center py-8" id="activity-loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="text-muted mt-3">Memuat aktivitas...</div>
                    </div>
                    <!--end::Loading State-->

                    <!--begin::Empty State-->
                    <div class="text-center py-8" id="activity-empty" style="display: none;">
                        <div class="symbol symbol-60px mx-auto mb-4">
                            <div class="symbol-label bg-light-muted">
                                <i class="fas fa-inbox fs-2 text-muted"></i>
                            </div>
                        </div>
                        <h4 class="text-dark mb-2">Belum Ada Aktivitas</h4>
                        <p class="text-muted">Aktivitas akan muncul di sini saat Anda menggunakan sistem</p>
                    </div>
                    <!--end::Empty State-->

                    <!--begin::Activity Items Container-->
                    <div id="activity-items-container">
                        <!-- Sample Activity Items -->
                        <div class="activity-item d-flex align-items-start p-3 rounded mb-3 unread">
                            <div class="activity-icon me-3">
                                <i class="fas fa-user-plus text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="text-dark fw-semibold mb-0">Penugasan Auditor Baru</h6>
                                    <span class="badge bg-success fs-8">Baru</span>
                                </div>
                                <p class="text-muted fs-7 mb-1">Auditor John Doe ditugaskan untuk audit Fakultas Teknik</p>
                                <div class="activity-time">
                                    <i class="fas fa-clock me-1"></i>
                                    2 menit yang lalu
                                </div>
                            </div>
                        </div>

                        <div class="activity-item d-flex align-items-start p-3 rounded mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-file-alt text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="text-dark fw-semibold mb-0">Dokumen Audit Diunggah</h6>
                                </div>
                                <p class="text-muted fs-7 mb-1">Laporan audit periode 2024 telah diunggah</p>
                                <div class="activity-time">
                                    <i class="fas fa-clock me-1"></i>
                                    1 jam yang lalu
                                </div>
                            </div>
                        </div>

                        <div class="activity-item d-flex align-items-start p-3 rounded mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-check-circle text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="text-dark fw-semibold mb-0">Status Audit Diperbarui</h6>
                                </div>
                                <p class="text-muted fs-7 mb-1">Status audit Fakultas Ekonomi berubah menjadi "Selesai"</p>
                                <div class="activity-time">
                                    <i class="fas fa-clock me-1"></i>
                                    3 jam yang lalu
                                </div>
                            </div>
                        </div>

                        <div class="activity-item d-flex align-items-start p-3 rounded mb-3">
                            <div class="activity-icon me-3">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="text-dark fw-semibold mb-0">Tim Auditor Dibentuk</h6>
                                </div>
                                <p class="text-muted fs-7 mb-1">Tim auditor untuk audit Fakultas Hukum telah dibentuk</p>
                                <div class="activity-time">
                                    <i class="fas fa-clock me-1"></i>
                                    1 hari yang lalu
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Activity Items Container-->
                </div>
                <!--end::Activity List-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->

        <!--begin::Footer-->
        <div class="card-footer activity-log-header py-4 text-center" id="kt_activities_footer">
            <button type="button" class="btn btn-light btn-sm me-2" id="mark-all-read">
                <i class="fas fa-check-double me-1"></i>
                Tandai Semua Dibaca
            </button>
            <button type="button" class="btn btn-outline-light btn-sm" id="refresh-activities">
                <i class="fas fa-sync-alt me-1"></i>
                Refresh
            </button>
        </div>
        <!--end::Footer-->
    </div>
</div>
