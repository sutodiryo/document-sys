<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-column-fluid">

        <div class="scroll-y flex-column-fluid px-10 py-10" data-kt-scroll="true" data-kt-scroll-activate="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header_nav" data-kt-scroll-offset="5px"
            data-kt-scroll-save-state="true"
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

                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                        style="border-collapse:collapse">
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
                                                Location : {{ $approval->folder->name }}</p>

                                            <hr>
                                            <p
                                                style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 14px;">
                                                @foreach ($approval->folder->files as $index => $folder_file)
                                                    {{ $index + 1 }}. <a
                                                        href="{{ route('public.download.files', $folder_file->id) }}">{{ $folder_file->name }}</a><br>
                                                @endforeach
                                                {{-- {{ $approval->folder->approval_resolution }} --}}
                                            </p>
                                            <hr>
                                            <p
                                                style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 18px; font-weight:700;">
                                                Resolution :</p>
                                            <p
                                                style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 14px;">
                                                {{ $approval->folder->approval_resolution }}</p>
                                        </div>

                                        <hr>
                                        <div
                                            style="font-size: 14px; font-weight: 500; margin:0 60px 30px 60px; font-family:Arial,Helvetica,sans-serif">

                                            @if (!($approval->status == 'Waiting Approval'))
                                                <p
                                                    style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 18px; font-weight:700;">
                                                    Your decision :</p>
                                                <p style="margin-bottom:2px; color:#3F4254; line-height:1.6">
                                                    {{ $approval->created_at }}</p>
                                            @endif

                                            <p class="mt-5">
                                                {{ $approval->status == 'Waiting Approval' ? 'C' : 'Your c' }}omment
                                            </p>
                                            <textarea wire:model="approval_comment" class="form-control" placeholder="Type here" rows="4"
                                                {{ $approval->status == 'Waiting Approval' ? '' : 'disabled' }}>{{ $approval->comment }}</textarea>
                                            <p class="mt-5">
                                                {{ $approval->status == 'Waiting Approval' ? 'Add file (optional)' : 'Uploaded file' }}
                                            </p>
                                            @if ($approval->status == 'Waiting Approval')
                                                <input wire:model="approval_file" type="file" class="form-control" />
                                            @else
                                                <a href="#">{{ $approval->file ? $approval->file : '-' }}</a>
                                            @endif
                                        </div>
                                        <hr>
                                        <div
                                            style="font-size: 14px; font-weight: 500; margin:0 60px 30px 60px; font-family:Arial,Helvetica,sans-serif">
                                            <p
                                                style="margin-bottom:2px; color:#3F4254; line-height:1.6; font-size: 18px; font-weight:700;">
                                                Users in this approval workflow
                                            </p>
                                            @foreach ($approvals as $app)
                                                <p style="margin-bottom:2px; color:#3F4254; line-height:1.6">
                                                    {{ $app->email }} <i
                                                        class="fas fa-{{ $app->status == 'Approved' ? 'check' : ($app->status == 'Waiting Approval' ? 'refresh' : 'close') }}"></i>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if ($approval->status == 'Waiting Approval')
                                        <button wire:click="store('Approved')"
                                            style="background-color:#50cd89; margin-bottom: 0px; border-radius:6px;display:inline-block; margin-left:0px; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                            Approve
                                        </button>

                                        <button wire:click="store('Rejected')"
                                            style="background-color:#fe0000; margin-bottom: 0px; border-radius:6px;display:inline-block; margin-left:0px; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                            Reject
                                        </button>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
