<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                {{-- <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">{{ $file->name }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body pb-0">
                    <div class="d-flex overflow-auto h-20px">
                    </div>
                </div> --}}
            </div>

            <div class="card card-flush">
                <div class="card-header pt-8">

                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            @if (empty($file->lock_status) || $file->lock_status == 0)
                                <button data-bs-toggle="modal" data-bs-target="#kt_modal_lock" type="button"
                                    class="btn btn-sm btn-primary me-3">
                                    <i class="fas fa-lock fs-2"></i>Lock File
                                </button>
                            @else
                                <button wire:click="unlock_file" {{-- href="{{ route('doc.unlock', ['id' => $file->id]) }}" --}}
                                    class="btn btn-sm btn-primary me-3">
                                    <i class="fas fa-unlock fs-2"></i>Unlock File
                                </button>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <button type="button" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_reminder">
                                <i class="fas fa-bell fs-2">
                                </i>Reminder</button>
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <button type="button" class="btn btn-sm btn-primary me-3"
                                wire:click="updateUploadFiles('Yes')" {{-- data-bs-toggle="modal"
                                data-bs-target="#kt_modal_upload_new_version" --}}>
                                <i class="ki-solid ki-file fs-2">
                                </i>Upload new version</button>
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <a wire:click="downloadZip" type="button" class="btn btn-sm btn-primary me-3">
                                <i class="ki-solid ki-archive fs-2">
                                </i>Download Zip
                            </a>
                        </div>

                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <a href="{{ route('file.edit', ['uuid' => $file->id]) }}" type="button"
                                class="btn btn-sm btn-primary me-3">
                                <i class="ki-solid ki-gear fs-2">
                                </i>Modify
                            </a>
                        </div>

                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-filemanager-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-filemanager-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-filemanager-table-select="delete_selected">Delete
                                Selected</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if ($open_form_upload == 'Yes')

                        <div class="dropzone" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <input type="file" class="form-control" id="upload_file" wire:model.live="upload_file" />

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>

                        @if ($upload_file)
                            <div class="list-files mt-3">
                                <div class="module-attachment-items d-flex flex-column gap-2">

                                    {{-- @foreach ($upload_file as $upload_file) --}}
                                    @php
                                        $base = log($upload_file->getSize(), 1024);
                                        $suffixes = ['', 'Kb', 'Mb', 'Gb', 'Tb'];
                                        $upload_file_size =
                                            round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
                                    @endphp
                                    <div>
                                        <div
                                            class="image position-relative d-flex gap-3 align-items-center bg-white rounded p-2 border border-1 w-100">
                                            <div class="img-name">{{ $upload_file->getClientOriginalName() }}
                                            </div>
                                            <div class="img-size opacity-50">{{ $upload_file_size }}</div>
                                            <a class="btn ms-auto" href="#">
                                                <i class="fas fa-gear"></i>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}

                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Breadcumbs --}}
                    <div class="d-flex flex-stack mt-8 mb-8">
                        <div class="badge badge-lg badge-light-primary">
                            <div class="d-flex align-items-center flex-wrap">
                                <i class="ki-duotone ki-home fs-2 text-primary me-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>

                                @foreach ($ancestors as $ancestor)
                                    <a
                                        href="{{ route('folder.index') }}?uuid={{ $ancestor->id }}">{{ $ancestor->name }}</a>
                                    @if ($ancestor->name != $folder->name)
                                        <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                    @endif
                                @endforeach

                                <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                {{ $file->name }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                            <div class="card card-flush py-4 flex-row-fluid">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_view_pdf">
                                            <h2><i class="fas fa-document"></i> {{ $file->name }}</h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                    <tbody class="fw-semibold text-gray-600">
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ki-solid ki-calendar fs-2 me-2">
                                                                    </i>Created
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                {{ formatDateTime($file->created_at) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ki-solid ki-wallet fs-2 me-2">
                                                                    </i>Document ID
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">{{ $file->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ki-solid ki-calendar fs-2 me-2">
                                                                    </i>Last Updated
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                {{ formatDateTime($file->updated_at) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                    <tbody class="fw-semibold text-gray-600">

                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center mb-3">
                                                                    Reminders :
                                                                </div>
                                                                {{-- @foreach ($file->reminders as $reminder)
                                                                    <span>{{ $reminder->remind_at }} <i
                                                                            class="fas fa-trash"></i></span>
                                                                    <br>
                                                                @endforeach --}}
                                                                <div class="mt-3">

                                                                    {{-- <span data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_reminder"><i
                                                                            class="fas fa-bell"></i> Add new
                                                                        reminder</span> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="mt-5">
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    Share to
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <div class="d-flex justify-content-end"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_share_file"
                                                                        type="button"
                                                                        class="btn btn-sm btn-primary me-3">
                                                                        Click to share</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    Approval
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <div class="d-flex justify-content-end"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_approval"
                                                                        type="button"
                                                                        class="btn btn-sm btn-primary me-3">
                                                                        Start approval</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    E-Sign
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <div class="d-flex justify-content-end"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <a wire:click="eSignPDFCo" type="button"
                                                                        class="btn btn-sm btn-primary me-3">
                                                                        Click to edit
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-muted">
                                                                <div class="d-flex align-items-center">
                                                                    {{-- E-Sign --}}
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold text-end">
                                                                <div class="d-flex justify-content-end mb-3"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <a href="{{ route('file.view', ['uuid' => $file->id]) }}"
                                                                        target="_blank" type="button"
                                                                        class="btn btn-block btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold me-3">
                                                                        <i class="fas fa-eye"></i>View Document
                                                                    </a>
                                                                </div>

                                                                <div class="d-flex justify-content-end mb-3"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal_view_onedrive"
                                                                        class="btn btn-block btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold me-3">
                                                                        <i class="fas fa-eye"></i>View Document
                                                                        onedrive
                                                                    </button>
                                                                </div>

                                                                <div class="d-flex justify-content-end"
                                                                    data-kt-filemanager-table-toolbar="base">
                                                                    <a href="#" type="button"
                                                                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold me-3">
                                                                        <i class="fas fa-pencil"></i>Edit Document
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($file->attachments()->count() > 1)

                            <div class="tab-content">
                                <div class="card card-flush py-4 flex-row-fluid">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Other versions</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-5 gy-0 mb-0">
                                                <thead>
                                                    <tr
                                                        class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-100px">Uploaded</th>
                                                        <th class="min-w-175px">File Name</th>
                                                        <th class="min-w-70px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($file->attachments as $index => $attachment)
                                                        <tr>
                                                            <td>{{ formatDateTime($attachment->created_at) }}</td>
                                                            <td>
                                                                {{-- <a href="{{ route('doc.files.get', $attachment->id) }}"> --}}
                                                                {{ $attachment->name }}
                                                                {{-- </a> --}}
                                                            </td>
                                                            <td>

                                                                <a wire:click="downloadAttachment('{{ $attachment->id }}')"
                                                                    title="Download"
                                                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                                @if ($index > 0)
                                                                    <a wire:click="restoreVersion('{{ $attachment->id }}')"
                                                                        title="Restore"
                                                                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                        <i class="fas fa-refresh"></i>
                                                                    </a>

                                                                    <a wire:click="deleteAttachment('{{ $attachment->id }}')"
                                                                        title="Delete"
                                                                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="tab-content">
                            <div class="card card-flush py-4 flex-row-fluid">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Audit Log</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-5 gy-0 mb-0">
                                            <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-70px">Time</th>
                                                    <th class="min-w-70px">User</th>
                                                    <th class="min-w-175px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($file->activities as $activity)
                                                    <tr>
                                                        <td>{{ formatDateTime($activity->created_at) }}</td>
                                                        <td>{{ $activity->createdBy->email }}</td>
                                                        <td>{!! $activity->activity !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Lock --}}
    <div class="modal fade" id="kt_modal_lock" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form class="form" action="none" id="kt_modal_lock_form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Lock files</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body pt-10 pb-15 px-lg-17">
                        <div class="form-group">
                            <div class="d-flex flex-stack">
                                <div class="d-flex">
                                    <div class="d-flex flex-column">
                                        <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Are
                                            you
                                            sure you want to lock the file?</a>
                                        <div class="fs-6 fw-semibold text-gray-500">Other editors will not be able to
                                            change the metadata or add new versions until the file is unlocked. The file
                                            unlocks automatically after 6 hours if you don't unlock it first.</div>
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-end">
                                    <div class="form-check form-check-solid form-check-custom form-switch">
                                        <input class="form-check-input w-45px h-30px" type="checkbox" id="lockswitch">
                                        <label class="form-check-label" for="lockswitch"></label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                        <button wire:click="lock_file" {{-- href="{{ route('doc.lock', ['id' => $document->id]) }}" --}} type="button"
                            class="btn btn-primary">Lock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Reminder --}}
    <div wire:ignore.self class="modal fade" id="kt_modal_reminder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_reminder_header">
                    <h2>Set reminder to: {{ $file->name }}</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                {{-- {!! Form::open(['route' => ['doc.reminder.store'], 'method' => 'post', 'files' => true]) !!} --}}
                <div class="modal-body py-10 px-lg-17">
                    {{-- {!! Form::hidden('id', $document->id) !!}
                    {!! Form::hidden('curent_link', Request::url()) !!} --}}

                    <div class="scroll-y me-n7 pe-7" id="kt_modal_reminder_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_reminder_header"
                        data-kt-scroll-wrappers="#kt_modal_reminder_scroll" data-kt-scroll-offset="300px">

                        <div class="d-flex flex-column mb-5 fv-row">
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <input type="datetime-local" name="remind_at" class="form-control"
                                        placeholder="Date & Time" />
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email" />
                                </div>
                            </div>
                            <textarea class="form-control form-control" rows="3" name="message" placeholder="Message"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer flex-center">
                        <button type="submit" id="kt_modal_reminder_submit" class="btn btn-primary">
                            <span class="indicator-label">Remind</span>
                        </button>
                    </div>
                    {{-- {!! Form::close() !!} --}}

                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_view_pdf" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-800px">

            <div class="modal-content">

                {{-- <form wire:submit="share_by_email"> --}}
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body pt-10 pb-15 px-lg-17">
                    <iframe style="width: 100%; height: 500px;"
                        src="https://docs.google.com/gview?url={{ $link_file }}&embedded=true"></iframe>

                    {{-- <div id="pspdfkit" style="height: 100vh"></div> --}}
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" id="modal_view_pdf_cancel" data-bs-dismiss="modal"
                        class="btn btn-light me-3">Cancel</button>

                    <button type="submit" id="modal_view_pdf_submit" class="btn btn-primary">
                        <span class="indicator-label">Share</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                {{-- </form> --}}

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_view_onedrive" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-800px">

            <div class="modal-content">

                {{-- <form wire:submit="share_by_email"> --}}
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body pt-10 pb-15 px-lg-17">
                    <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ $link_file }}' width='px'
                        height='px' frameborder='0'>
                    </iframe>
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" id="modal_view_pdf_cancel" data-bs-dismiss="modal"
                        class="btn btn-light me-3">Cancel</button>

                    <button type="submit" id="modal_view_pdf_submit" class="btn btn-primary">
                        <span class="indicator-label">Share</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                {{-- </form> --}}

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="kt_modal_share_file" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-800px">

            <div class="modal-content">

                <form wire:submit="share_by_email">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body pt-10 pb-15 px-lg-17">

                        <div class="mw-lg-600px mx-auto">
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Share file "{{ $file->name }}"</h1>
                            </div>

                            <div class="mb-10">
                                <h4 class="fs-5 fw-semibold text-gray-800">Share by email</h4>
                                <div class="d-flex flex-column mb-10 fv-row">
                                    <div class="row">
                                        <div class="col-md-12">

                                            {{-- <select wire:model="share_email" name="email" id="share_to_email"
                                                class="form-select form-select-solid" required>
                                                <option></option>
                                                <option value="hubungi.yogi@gmail.com">hubungi.yogi@gmail.com</option>
                                                <option value="noreply.dev.std@gmail.com">noreply.dev.std@gmail.com
                                                </option>
                                                <option value="yanuar@mediatechindo.com">yanuar@mediatechindo.com
                                                </option>
                                            </select> --}}

                                            {{-- <textarea list="browsers" wire:model="invited_emails" list="browsers" type="text"
                                                class="form-control form-control-solid"></textarea> --}}

                                            <input type="text" wire:model="invited_emails" list="browsers"
                                                class="form-control form-control-solid"
                                                {{ $share_by_email_group ? 'disabled' : '' }} />

                                            <datalist id="browsers">
                                                <option value="Internet Explorer">
                                                <option value="Firefox">
                                                <option value="Google Chrome">
                                                <option value="Opera">
                                                <option value="Safari">
                                            </datalist>
                                        </div>

                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <select wire:model="share_by_email_role" id="share_by_email_role"
                                                class="form-select form-select-solid" required>
                                                <option>Role</option>
                                                <option value="Preview">Preview</option>
                                                <option value="Viewer">Viewer</option>
                                                <option value="Editor">Editor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select wire:model.live="share_by_email_group" name="user_group"
                                                id="share_to_user_group" class="form-select form-select-solid">
                                                <option value="">User group</option>
                                                @foreach ($user_groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    wire:model.live="share_by_email_expiration" />
                                                <span class="form-check-label">Expiration</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($share_by_email_expiration)
                                                <input wire:model="share_by_email_expires_at" type="datetime-local"
                                                    id="share_by_email_expires_at" class="form-control" required />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_share_file_cancel" data-bs-dismiss="modal"
                            class="btn btn-light me-3">Cancel</button>
                        {{-- <button type="submit" wire:click="share_by_email" class="btn btn-primary">
                        Share
                    </button> --}}
                        <button type="submit" id="kt_modal_share_file_submit" class="btn btn-primary">
                            <span class="indicator-label">Share</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>

                <hr>

                <div class="modal-body pt-10 pb-15 px-lg-17">
                    <div class="mw-lg-600px mx-auto">
                        <div class="mb-10">
                            <h4 class="fs-5 fw-semibold text-gray-800">Share by link</h4>

                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input wire:model.live="share_by_link" class="form-check-input"
                                            type="checkbox" />
                                        <span class="form-check-label">Public link</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input wire:model.live="share_by_link_expiration" class="form-check-input"
                                            type="checkbox" />
                                        <span class="form-check-label">Expiration</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @if ($share_by_link_expiration)
                                        <input wire:model.live="share_by_link_expires_at" type="datetime-local"
                                            class="form-control" />
                                    @endif
                                </div>
                            </div>
                            @if ($share_by_link)
                                <div class="d-flex mt-5">
                                    <div class="col-md-8">
                                        <input id="kt_share_earn_link_input" type="text"
                                            class="form-control form-control-solid me-3 flex-grow-1" name="search"
                                            value="{{ route('public.share.files', $share_by_link_id) }}" />
                                        <button id="kt_share_earn_link_copy_button"
                                            class="btn btn-light fw-bold flex-shrink-0"
                                            data-clipboard-target="#kt_share_earn_link_input">Copy Link</button>
                                    </div>
                                    <div class="col-md-4">
                                        <select wire:model.live="share_by_link_role" id="share_by_link_role"
                                            class="form-select form-select-solid" required>
                                            <option value="Download">Download</option>
                                            <option value="Preview">Preview</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_approval" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_approval_header">
                    <h2>Approval workflow for "{{ $file->name }}"</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <form wire:submit.prevent="start_approval">

                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_approval_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_approval_header"
                            data-kt-scroll-wrappers="#kt_modal_approval_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-5 fv-row">
                                <label class="fs-5 fw-semibold mb-2">Resolution</label>
                                <textarea class="form-control form-control-solid" rows="3" wire:model="approval_resolution" placeholder=""></textarea>
                            </div>

                            <div class="d-flex flex-column mb-10 fv-row">
                                <h4 class="fs-5 fw-semibold text-gray-800">Email</h4>
                                <div class="d-flex flex-column mb-10 fv-row">

                                    <input type="email" class="form-control form-control-solid"
                                        wire:model="approval_invited_emails" required />

                                    {{-- <select name="email" id="share_to_email" data-control="select2"
                                        data-hide-search="true" data-placeholder="Select a email..."
                                        class="form-select form-select-solid">
                                        <option value="">Select a Email...</option>
                                        <option value="hubungi.yogi@gmail.com">hubungi.yogi@gmail.com</option>
                                        <option value="noreply.dev.std@gmail.com">noreply.dev.std@gmail.com</option>
                                        <option value="1">a@company.com</option>
                                        <option value="2">b@company.com</option>
                                        <option value="3">c@company.com</option>
                                        <option value="4">d@company.com</option>
                                    </select> --}}
                                </div>
                            </div>
                            <div class="mb-10">
                                <div class="mb-3">
                                    <label class="d-flex align-items-center fs-5 fw-semibold">
                                        <span class="required">After successfull workflow</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Your billing numbers will be calculated based on your API method">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check
                                        workflow
                                        documentation</div>
                                </div>
                                <div class="fv-row">
                                    <div class="btn-group w-100" data-kt-buttons="true"
                                        data-kt-buttons-target="[data-kt-button]">
                                        <label class="btn btn-outline btn-active-success btn-color-muted"
                                            data-kt-button="true">
                                            <input class="btn-check" type="radio" name="method" value="1" />
                                            Move</label>
                                        <label class="btn btn-outline btn-active-success btn-color-muted active"
                                            data-kt-button="true">
                                            <input class="btn-check" type="radio" name="method" value="2" />
                                            Do nothing</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_approval_cancel"
                            class="btn btn-light me-3">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Start</span>
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_automate_approval" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Approval workflow for "{{ $file->name }}/h3>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                </div>

                {{-- {!! Form::open(['route' => ['mail.approval-folder'], 'method' => 'post']) !!}
                {!! Form::hidden('curent_link', Request::url()) !!} --}}

                <div class="modal-body">

                    <div class="mb-10">
                        <div class="mb-3">
                            <div class="fs-7 fw-semibold text-muted">Automatically sends any file uploaded to
                                this folder to a predefined approval or e-signing workflow.</div>
                        </div>
                        <div class="fv-row">
                            <input type="hidden" name="id" class="form-control" id="modal_folder_id" />
                            <div class="btn-group w-100" data-kt-buttons="true"
                                data-kt-buttons-target="[data-kt-button]">
                                <label class="btn btn-outline btn-active-success btn-color-muted active"
                                    data-kt-button="true">
                                    <input class="btn-check resolution_status_radio" type="radio"
                                        name="resolution_status" checked="checked" value="Auto" />Auto
                                    (inherit)
                                </label>
                                <label class="btn btn-outline btn-active-success btn-color-muted"
                                    data-kt-button="true">
                                    <input class="btn-check resolution_status_radio" type="radio"
                                        name="resolution_status" onclick="resolutionStatusRadio()"
                                        value="Active" />Active
                                </label>
                                <label class="btn btn-outline btn-active-success btn-color-muted"
                                    data-kt-button="true">
                                    <input class="btn-check resolution_status_radio" type="radio"
                                        name="resolution_status" value="Inactive" />Inactive
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="fade" id="modal_form_resolution">
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Resolution</label>
                            <textarea class="form-control" rows="3" name="resolution" placeholder=""></textarea>
                        </div>

                        <div class="d-flex flex-column fv-row">
                            <h4 class="fs-5 fw-semibold text-gray-800">Email</h4>
                            <div class="d-flex flex-column mb-10 fv-row">
                                <select name="email" id="share_to_email" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a email..." class="form-select">
                                    <option value="">Select a Email...</option>
                                    <option value="hubungi.yogi@gmail.com">hubungi.yogi@gmail.com</option>
                                    <option value="noreply.dev.std@gmail.com">noreply.dev.std@gmail.com
                                    </option>
                                    <option value="1">a@company.com</option>
                                    <option value="2">b@company.com</option>
                                    <option value="3">c@company.com</option>
                                    <option value="4">d@company.com</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

                {{-- {!! Form::close() !!} --}}

            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script>
        Livewire.on('clearEmailInput', () => {
            $('input#invited_emails').val('').focus()
        })

        document.getElementById("myLocalDate").min = "2006-05-05T16:15:23";


        PSPDFKit.load({
                container: "#pspdfkit",
                document: "document.pdf" // Add the path to your document here.
            })
            .then(function(instance) {
                console.log("PSPDFKit loaded", instance);
            })
            .catch(function(error) {
                console.error(error.message);
            });
    </script>
@endpush
