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

<body id="kt_body" class="app-blank">

    {{ $slot }}

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

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    @yield('scripts')
    <!--end::Javascript-->
</body>

</html>
