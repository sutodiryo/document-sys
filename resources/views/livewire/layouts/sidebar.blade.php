<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="index.html" class="d-lg-none">
                <img alt="Logo" src="{{ asset('metronic_8.2.6/media/logos/default-small.svg') }}" class="h-30px" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">

            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <span class="menu-link">
                            <span class="menu-title">Dashboards</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                    </div>
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-title">Help</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link"
                                    href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"
                                    target="_blank"
                                    title="Check out over 200 in-house components, plugins and ready for use solutions"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                    data-bs-placement="right">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-rocket fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Components</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs"
                                    target="_blank" title="Check out the complete documentation"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                    data-bs-placement="right">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-abstract-26 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Documentation</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link"
                                    href="https://preview.keenthemes.com/html/metronic/docs/getting-started/changelog"
                                    target="_blank">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-code fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Changelog v8.2.6</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                </div>
            </div>

            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item align-items-stretch ms-1 ms-md-4">

                    <!--begin::Search-->
                    <div id="kt_header_search" class="header-search d-flex align-items-stretch"
                        data-kt-search-keypress="true" data-kt-search-min-length="10" data-kt-search-enter="enter"
                        data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false"
                        data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                        <div class="d-flex align-items-center" data-kt-search-element="toggle"
                            id="kt_header_search_toggle">
                            <form action="{{ route('search') }}">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative w-md-400px me-md-2">
                                        <i
                                            class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" class="form-control form-control-solid ps-10"
                                            name="q" value="" placeholder="Search">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary me-5">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="app-navbar-item ms-1 ms-md-4">
                    <!--begin::Menu toggle-->
                    <a href="#"
                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        {{-- <img src="{{ asset('metronic_8.2.6/media/avatars/300-3.jpg') }}" class="rounded-3"
                            alt="user" /> --}}
                        <span class="profile-image">
                            <span class="text-profile">{{ generateInitialName(auth()->user()->name) }}</span>
                        </span>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    {{-- <img alt="Logo" src="{{ asset('metronic_8.2.6/media/avatars/300-3.jpg') }}" /> --}}
                                    <span class="profile-image">
                                        <span
                                            class="text-profile">{{ generateInitialName(auth()->user()->name) }}</span>
                                    </span>
                                    {{-- <img src="{{ asset(config('settings.system_logo')) }}" class="img-circle"
                                        alt="User Image" /> --}}
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{!! Auth::user()->name !!}
                                        {{-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span> --}}
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">Member
                                        since {!! Auth::user()->created_at->format('M. Y') !!}</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('profile.edit') }}" class="menu-link px-5">Profile</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="{!! url('/logout') !!}" class="menu-link px-5""
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </div>
                    </div>
                </div>
                <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                        id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-element-4 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
