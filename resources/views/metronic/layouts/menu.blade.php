    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            {{-- <a href="{{route('admin.dashboard')}}" class="hidden-xs logo">
            <span class="logo-mini"><b>{{config('settings.system_title')[0]}}</b></span>
            <span class="logo-lg"><b>{{config('settings.system_title')}}</b></span>
        </a> --}}
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" src="{{ asset('metronic_8.2.6/media/logos/default-dark.svg') }}"
                    class="h-25px app-sidebar-logo-default" />
                <img alt="Logo" src="{{ asset('metronic_8.2.6/media/logos/default-small.svg') }}"
                    class="h-20px app-sidebar-logo-minimize" />
            </a>
            <div id="kt_app_sidebar_toggle"
                class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->

        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <!--begin::Scroll wrapper-->
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                    data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                    data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                    data-kt-scroll-save-state="true">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                        id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                                href="{!! route('dashboard') !!}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/folder*') ? 'active' : '' }}"
                                href="{!! route('folder.index') !!}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-folder fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Document</span>
                            </a>
                        </div>

                        {{-- @can('read users') --}}
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                                    href="{!! route('users.index') !!}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-user fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Users</span>
                                </a>
                            </div>
                        {{-- @endcan --}}

                        @can('read tags')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/tags*') ? 'active' : '' }}"
                                    href="{!! route('tags.index') !!}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-tag fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">{{ ucfirst(config('settings.tags_label_plural')) }}</span>
                                </a>
                            </div>
                        @endcan

                        @if (auth()->user()->is_super_admin)
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion {{ Request::is('admin/advanced*') ? 'show' : '' }}">
                                <span class="menu-link {{ Request::is('admin/advanced*') ? 'active' : '' }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-gear fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Advanced Settings</span>
                                    <span class="menu-arrow"></span>
                                </span>

                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::is('admin/advanced/settings*') ? 'active' : '' }}"
                                            href="{!! route('settings.index') !!}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Settings</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::is('admin/advanced/custom-fields*') ? 'active' : '' }}"
                                            href="{!! route('customFields.index') !!}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Fields</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::is('admin/advanced/file-types*') ? 'active' : '' }}"
                                            href="{!! route('fileTypes.index') !!}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span
                                                class="menu-title">{{ ucfirst(config('settings.file_label_singular')) }}
                                                Types</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Scroll wrapper-->
            </div>
            <!--end::Menu wrapper-->
        </div>
    </div>