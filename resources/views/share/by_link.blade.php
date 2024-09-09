<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="shortcut icon" href="{{ asset('metronic_8.2.6/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('metronic_8.2.6/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic_8.2.6/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')
</head>

<body id="kt_body" class="app-blank">

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-column-fluid">

            <div class="scroll-y flex-column-fluid px-10 py-10" data-kt-scroll="true" data-kt-scroll-activate="true"
                data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header_nav"
                data-kt-scroll-offset="5px" data-kt-scroll-save-state="true"
                style="background-color:#D5D9E2; --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc">

                <style>
                    html,
                    body {
                        padding: 0;
                        margin: 0;
                        font-family: Inter, Helvetica, "sans-serif";
                    }

                    a:hover {
                        color: #009ef7;
                    }
                </style>
                <div id="#kt_app_body_content"
                    style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
                    <div
                        style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                            height="auto" style="border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td align="center" valign="center" style="text-align:center; padding-bottom: 0px">
                                        <div style="text-align:left; margin-bottom:5px">

                                            <div
                                                style="font-size: 14px; font-weight: 500; margin:0 60px 30px 60px; font-family:Arial,Helvetica,sans-serif">
                                                <p style="color:#181C32; font-size: 40px; font-weight:700; line-height:1.4; margin-bottom:24px"
                                                    class="text-center">Hello!!</p>
                                                <p
                                                    style="color:#181C32; font-size: 20px; font-weight:500; line-height:1.4; margin-bottom:24px">
                                                    {{ $file->createdBy->email }} shared a file with you.
                                                </p>

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed fs-5 gy-0 mb-0">
                                                        <thead>
                                                            <tr
                                                                class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                                <th class="min-w-275px">File Name</th>
                                                                <th class="min-w-20px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fw-semibold text-gray-600">
                                                            @foreach ($file->attachments as $index => $attachment)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a
                                                                                href="{{ route('public.preview.files', $share->id) }}">
                                                                                <span class="icon-wrapper">
                                                                                    <i
                                                                                        class="ki-duotone ki-file fs-2x text-primary me-4">
                                                                                        <span class="path1"></span>
                                                                                        <span class="path2"></span>
                                                                                    </i>
                                                                                </span>
                                                                            </a>
                                                                            <a href="{{ route('public.preview.files', $share->id) }}"
                                                                                class="text-gray-800 text-hover-primary">
                                                                                {{ $attachment->name }}
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        @if ($share->role == 'Download' || $share->role == 'Editor')
                                                                            <a href="{{ route('public.download.files', $share->id) }}"
                                                                                title="Download"
                                                                                class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                                <i class="fas fa-download"></i>
                                                                            </a>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="center"
                                        style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                                        {{-- <p style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px">
                                            It’s all about customers!</p> --}}
                                        {{-- <p style="margin-bottom:2px">Call our customer care number: +31 6 3344 55 56
                                        </p>
                                        <p style="margin-bottom:4px">You may reach us at
                                            <a href="https://devs.docsys.com" rel="noopener" target="_blank"
                                                style="font-weight: 600">devs.docsys.com</a>.
                                        </p> --}}
                                        {{-- <p>We serve Mon-Fri, 9AM-18AM</p> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="center"
                                        style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                                        <p>&copy; Copyright {{ config('app.name', 'Laravel') }}.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('metronic_8.2.6/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('metronic_8.2.6/js/scripts.bundle.js') }}"></script>
    @yield('scripts')
</body>

</html>
