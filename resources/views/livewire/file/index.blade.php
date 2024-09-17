<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">{{ $file->name }}</h2>
                            <div class="text-muted fw-bold">
                                <a>File Manager</a>
                                <span class="mx-3">|</span>2.6 GB
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pb-0">
                    <div class="d-flex overflow-auto h-20px">
                    </div>
                </div>
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
                                <a href="{{ route('doc.unlock', ['id' => $file->id]) }}"
                                    class="btn btn-sm btn-primary me-3">
                                    <i class="fas fa-unlock fs-2"></i>Unlock File
                                </a>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <button type="button" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_reminder">
                                <i class="fas fa-bell fs-2">
                                </i>Reminder</button>
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <button type="button" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_upload_new_version">
                                <i class="ki-solid ki-file fs-2">
                                </i>Upload new version</button>
                        </div>
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <a {{-- href="{{ route('files.downloadZip', ['dir' => 'original', 'id' => $file->id]) }}" --}} type="button" class="btn btn-sm btn-primary me-3">
                                <i class="ki-solid ki-archive fs-2">
                                </i>Download Zip
                            </a>
                        </div>

                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <a {{-- href="{{ route('documents.edit', $file->id) }}" --}} type="button" class="btn btn-sm btn-primary me-3">
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

                    {{-- Breadcumbs --}}
                    <div class="d-flex flex-stack mb-8">
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
                                            <h2><i class="fas fa-document"></i> {{ $file->name }}
                                                {{-- {{ $file->attachments->first()->file }} <br> <br> {{ storage_path('app/public/uploads/' . $file->id . '/') . "" . $file->name . "" }} --}}
                                            </h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7">
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
                                    <div class="col-sm-5">
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

                                                                    <span data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_reminder"><i
                                                                            class="fas fa-bell"></i> Add new
                                                                        reminder</span>
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
                                                                    <a {{-- href="{{ route('files.downloadZip', ['dir' => 'original', 'id' => $file->id]) }}" --}} type="button"
                                                                        class="btn btn-sm btn-primary me-3">
                                                                        </i>Click to edit
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
                                                                <a href="#" title="Restore"
                                                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                    <i class="fas fa-refresh"></i>
                                                                </a>

                                                                <a {{-- href="{{ route('doc.files.get', $attachment->id) }}" --}} title="Download"
                                                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                                <a href="#" title="Delete"
                                                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
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
                    <div id="pspdfkit" style="height: 100vh"></div>
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
    </script>
@endpush
