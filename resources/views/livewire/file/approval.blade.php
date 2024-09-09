<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $data['title'] }}</title>
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

                        {!! Form::open(['route' => 'resolution.folder.store']) !!}
                        {!! Form::hidden('curent_link', Request::getRequestUri()) !!}
                        <input type="hidden" name="id" value="{{ $data['folder']['id'] }}" />
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                            height="auto" style="border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td align="center" valign="center" style="text-align:center; padding-bottom: 0px">
                                        <div style="text-align:left; margin-bottom:0px">
                                            <div
                                                style="font-size: 14px; font-weight: 500; margin:0 60px 30px 60px; font-family:Arial,Helvetica,sans-serif">
                                                <p
                                                    style="color:#181C32; font-size: 25px; font-weight:700; line-height:1.4; margin-bottom:24px">
                                                    Hello, here is a document waiting your approval:
                                                </p>
                                                <p
                                                    style="margin-bottom:2px; color:#3F4254; line-height:1.4; font-size: 18px; font-weight:700;">
                                                    Location : {{ $data['folder']['name'] }}</p>
                                                <p
                                                    style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 18px; font-weight:700;">
                                                    Resolution :</p>
                                                <p
                                                    style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 14px;">
                                                    {{ $data['resolution'] }}</p>
                                            </div>
                                            <hr>
                                            <div
                                                style="font-size: 14px; font-weight: 500; margin:0 60px 30px 60px; font-family:Arial,Helvetica,sans-serif">
                                                <p
                                                    style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 18px; font-weight:700;">
                                                    Users in this approval workflow
                                                </p>
                                                @foreach ($data['folder']['approval'] as $approval)
                                                    <input type="hidden" name="email"
                                                        value="{{ $approval->email }}" />

                                                    <p style="margin-bottom:2px; color:#3F4254; line-height:1.6">
                                                        {{ $approval->email }} <i
                                                            class="fas fa-{{ $approval->status == 'Approved' ? 'check' : ($approval->status == 'Waiting Approval' ? 'refresh' : 'close') }}"></i>
                                                    </p>

                                                    {{-- Harusnya tidak ikut loop --}}
                                                    <p style="margin-bottom:2px; color:#3F4254; line-height:1.6">
                                                        {{ $data['created'] }}</p>

                                                    <p class="mt-5">Comment</p>
                                                    <textarea name="comment" class="form-control" placeholder="Type here" rows="4">{{ $approval->comment }}</textarea>
                                                    <p class="mt-5">Add file (optional)</p>
                                                    <input name="file" type="file" class="form-control" />
                                                @endforeach
                                            </div>

                                        </div>


                                        <button type="submit" value="Approved" name="submit_btn"
                                            style="background-color:#50cd89; margin-bottom: 0px; border-radius:6px;display:inline-block; margin-left:0px; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                            Approve
                                        </button>

                                        <button type="submit" value="Rejected" name="submit_btn"
                                            style="background-color:#fe0000; margin-bottom: 0px; border-radius:6px;display:inline-block; margin-left:0px; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                            Reject
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {!! Form::close() !!}

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
