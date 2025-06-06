<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="index.html" class="d-flex align-items-center">
            <img alt="Logo" src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-35px app-sidebar-logo-minimize" />
            <div class="d-flex flex-column ms-3 app-sidebar-logo-default">
                <span class="fs-3 fw-bolder text-uppercase" style="letter-spacing: 1px; font-family: 'Segoe UI', sans-serif; color: #ffffff; text-shadow: 0 0 10px rgba(255,255,255,0.3);">LPMPP UNIB</span>
                <span class="fs-8 fw-light" style="margin-top: -4px; letter-spacing: 0.5px; color: rgba(255,255,255,0.9); text-shadow: 0 0 5px rgba(255,255,255,0.2);">Sistem Informasi Audit Mutu Internal</span>
            </div>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-3 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">MENU UTAMA</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('dashboard') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="fa fa-chart-line fs-4"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('unitKerja.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('unitKerja.index') ? 'active' : '' }}" href="{{ route('unitKerja.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-briefcase fs-4"></i>
                            </span>
                            <span class="menu-title">Data Unit Kerja</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">DATA INSTRUMEN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('indikatorInstrumen.index','kriteriaInstrumen.index','instrumenProdi.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-clipboard-check fs-4"></i>
                            </span>
                            <span class="menu-title">Instrumen Prodi</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('indikatorInstrumen.index') ? 'active' : '' }}" href="{{ route('indikatorInstrumen.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Indikator Instrumen</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('kriteriaInstrumen.index') ? 'active' : '' }}" href="{{ route('kriteriaInstrumen.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kriteria Instrumen</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('instrumenProdi.index') ? 'active' : '' }}" href="{{ route('instrumenProdi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Instrumen Prodi</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('unitKerja.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('unitKerja.index') ? 'active' : '' }}" href="{{ route('unitKerja.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-briefcase fs-4"></i>
                            </span>
                            <span class="menu-title">Indikator Kinerja / IKSS</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGATURAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('administrator.index', 'auditor.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-users fs-4"></i>
                            </span>
                            <span class="menu-title">Data Pengguna</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Route::is('administrator.index') ? 'active' : '' }}" href="{{ route('administrator.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Administrator</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Route::is('auditor.index') ? 'active' : '' }}" href="{{ route('auditor.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Auditor</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
