<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('metronic_8.2.6/media/logos/favicon.ico') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    {{-- @stack('plugin-alpine')
    <script defer src="{{ asset('assets/libs/alpinejs/dist/cdn.min.js') }}"></script> --}}

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('metronic_8.2.6/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('metronic_8.2.6/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic_8.2.6/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @yield('css')
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>


    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('livewire.layouts.sidebar')

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('livewire.layouts.menu')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    {{ $slot }}
                    @include('livewire.layouts.footer')
                </div>
            </div>

        </div>
    </div>

    {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}


    <script>
        var hostUrl = "{{ asset('metronic_8.2.6') }}/";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('metronic_8.2.6/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('metronic_8.2.6/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    {{-- <script src="{{ asset('metronic_8.2.6/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script> --}}

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('metronic_8.2.6/js/custom/apps/file-manager/list.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/custom/utilities/modals/users-search.js') }}"></script>

    {{-- <script src="{{ asset('metronic_8.2.6/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script> --}}

    <!--end::Custom Javascript-->

    {{-- <script src="{{ asset('assets/pspdfkit.js') }}"></script>
    <script>
        PSPDFKit.load({
                licenseKey: '5ZHXLjgAXLL-jM0DZTa6_YlP6mqhAKwLVipsCZQKbUaCcryFBVi6NdOacjjEGUjm74vS35iiggInU1LBtpsdBHrKZhIsQlXSh3gYqM90VMExL2gowowoc3dLF4VnHONWpLRRdWlZ8khIvDc10gdlDQe-81PVHoVcEohOnyZY9cW0ZFOdGUoyhJoIHCfblA1NNWHX8cf4826wowtE',
                container: "#pspdfkit",
                document: "/Users/user/Herd/document-sys/storage/app/public/uploads/9ceee42c-7129-40b6-b321-70ee380ca34e/Contoh.pdf" // Add the path to your document here.
            })
            .then(function(instance) {
                console.log("PSPDFKit loaded", instance);
            })
            .catch(function(error) {
                console.error(error.message);
            });
    </script> --}}

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    @yield('scripts')
    <!--end::Javascript-->
</body>

</html>