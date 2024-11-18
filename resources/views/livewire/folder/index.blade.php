<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">{{ $folder->name }}</h2>
                            <div class="text-muted fw-bold">
                                <a>File Manager</a>
                                <span class="mx-3">|</span>{{ $countSize }}
                                {{-- ,04 MB --}}
                                <span class="mx-3">|</span>{{ $countData }} items
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

                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-filemanager-table-filter="search"
                                class="form-control form-control-solid w-250px ps-15"
                                placeholder="Search Files & Folders" />

                        </div>
                    </div>

                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <button type="button" class="btn btn-sm btn-light-primary me-3" {{-- id="kt_file_manager_new_folder" --}}
                                data-bs-toggle="modal" data-bs-target="#kt_file_manager_new_folder">
                                <i class="ki-solid ki-add-folder fs-2"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                                </i>New Folder</button>

                            <button type="button" class="btn btn-sm btn-primary me-3"
                                wire:click="updateUploadFiles('Yes')">
                                <i class="ki-solid ki-folder-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Upload Files
                            </button>
                            {{-- <button type="button" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_upload">
                                <i class="ki-solid ki-folder-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Upload Files</button> --}}

                            <div>
                                <button class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-solid ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter</button>

                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_6678170cdb832">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>


                                    {{-- {!! Form::model(request()->all(), [
                                        'method' => 'get',
                                        'class' => 'form-inline visible hidden-xs',
                                        'id' => 'filterForm',
                                    ]) !!} --}}

                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Status:</label>

                                            <div class="form-group">
                                                <label for="status"
                                                    class="sr-only">{{ config('settings.tags_label_singular') }}:</label>
                                                {{-- {!! Form::select(
                                                    'status',
                                                    [
                                                        '0' => 'ALL',
                                                        config('constants.STATUS.PENDING') => config('constants.STATUS.PENDING'),
                                                        config('constants.STATUS.APPROVED') => config('constants.STATUS.APPROVED'),
                                                        config('constants.STATUS.REJECT') => config('constants.STATUS.REJECT'),
                                                    ],
                                                    null,
                                                    ['class' => 'form-control input-sm', 'id' => 'status'],
                                                ) !!} --}}
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Tags:</label>

                                            <div class="form-group">
                                                <label for="tags"
                                                    class="sr-only">{{ config('settings.tags_label_singular') }}:</label>
                                                <select class="form-control select2 input-sm" name="tags[]"
                                                    id="tags"
                                                    data-placeholder="Choose {{ config('settings.tags_label_singular') }}"
                                                    multiple>
                                                    @foreach ($tags as $tag)
                                                        @canany(['read files', 'read files in tag ' . $tag->id])
                                                            <option value="{{ $tag->id }}"
                                                                {{ in_array($tag->id, request('tags', [])) ? 'selected' : '' }}>
                                                                {{ $tag->name }}</option>
                                                        @endcanany
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>

                                        {{-- {!! Form::close() !!} --}}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-filemanager-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-filemanager-table-select="selected_count"></span>Selected
                            </div>

                            <button type="button" class="btn btn-sm btn-secondary me-3"
                                data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_move_to_folder">Move</button>

                            <button type="button" class="btn btn-sm btn-secondary me-3">Download</button>

                            <button type="button" class="btn btn-sm btn-secondary me-3"
                                data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_duplicate_file_to_folder">Duplicate</button>

                            <button type="button" class="btn btn-sm btn-danger"
                                data-kt-filemanager-table-select="delete_selected">Delete</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- <livewire:components.upload-files id="upload_files" :error="'upload_files'"> --}}
                    @if ($open_form_upload == 'Yes')

                        <div class="dropzone" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <input type="file" class="form-control" id="upload_files"
                                wire:model.live="upload_files" multiple />

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>

                        @if ($upload_files)
                            <div class="list-files mt-3">
                                <div class="module-attachment-items d-flex flex-column gap-2">

                                    @foreach ($uploaded_files as $upload_file)
                                        @php
                                            // $base = log($upload_file->getSize(), 1024);
                                            // $suffixes = ['', 'Kb', 'Mb', 'Gb', 'Tb'];
                                            // $upload_file_size =
                                            //     round(pow(1024, $base - floor($base)), 2) .
                                            //     ' ' .
                                            //     $suffixes[floor($base)];
                                            $upload_file_size = 12;
                                        @endphp
                                        <div>
                                            <div
                                                class="image position-relative d-flex gap-3 align-items-center bg-white rounded p-2 border border-1 w-100">

                                                <div class="img-name">
                                                    <a class="btn ms-auto" target="_blank"
                                                        href="{{ route('file.index') . '?uuid=' . $upload_file->id }}">{{ $upload_file->name }}
                                                        {{-- <div class="img-name">{{ $upload_file->getClientOriginalName() }} --}}
                                                    </a>
                                                </div>
                                                <div class="img-size opacity-50">{{ $upload_file_size }}Kb</div>
                                                <a class="btn ms-auto" target="_blank"
                                                    href="{{ route('file.index') . '?uuid=' . $upload_file->id }}">
                                                    <i class="fas fa-gear"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

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

                            </div>
                        </div>
                        <div class="badge badge-lg badge-primary">
                            <span id="kt_file_manager_items_counter">2 items</span>
                        </div>
                    </div>

                    <table id="kt_file_manager_list" data-kt-filemanager-table="folders"
                        class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_file_manager_list .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-250px">Name</th>
                                <th class="min-w-10px">Tags</th>
                                <th class="min-w-125px">Last Modified</th>
                                <th class="w-125px"></th>
                            </tr>
                        </thead>

                        <tbody class="fw-semibold text-gray-600">

                            @foreach ($folders as $fd)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-order="{{ $fd->id }}">
                                        <div class="d-flex align-items-center">

                                            <a href="{{ route('folder.index') }}?uuid={{ $fd->id }}"
                                                class="text-gray-800 text-hover-primary">
                                                <span class="icon-wrapper">
                                                    @if (empty($fd->approval_status))
                                                        <i class="fas fa-folder fs-2x text-grey me-4"
                                                            title=""></i>
                                                    @elseif ($fd->approval_status == 'Approved')
                                                        <i class="fas fa-folder fs-2x text-success me-4"
                                                            title="Approved"></i>
                                                    @elseif ($fd->approval_status == 'Rejected')
                                                        <i class="fas fa-folder fs-2x text-danger me-4"
                                                            title="Rejected"></i>
                                                    @else
                                                        <i class="fas fa-folder fs-2x text-warning me-4"
                                                            title="Waiting Approval"></i>
                                                    @endif
                                                </span>
                                            </a>
                                            <a href="{{ route('folder.index') }}?uuid={{ $fd->id }}"
                                                class="text-gray-800 text-hover-primary">
                                                {{ $fd->name }}
                                                {{-- @if ($fd->approval_status == 'Waiting Approval')
                                                    <i class="fas fa-check-circle text-warning"></i>
                                                @elseif ($fd->approval_status == 'Approved')
                                                    <i class="fas fa-check-circle text-primary"></i>
                                                @elseif ($fd->approval_status == 'Rejected')
                                                    <i class="fas fa-check-circle text-danger"></i>
                                                @endif --}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <div class="badge badge-light-success">Completed</div> --}}
                                    </td>
                                    <td>{{ formatDateID($fd->updated_at) }}</td>
                                    <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                        <div class="d-flex justify-content-end">
                                            <div class="ms-2" data-kt-filemanger-table="copy_link">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                    <i class="fas fa-share fs-5 m-0"></i>
                                                </button>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="fas fa-gear fs-5 m-0"></i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Modify</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a wire:click="setModalFolderId('{{ $fd->id }}')"
                                                            href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_retention"
                                                            class="menu-link px-3">Retention</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a wire:click="setModalFolderId('{{ $fd->id }}')"
                                                            href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_automate_approval"
                                                            {{-- onclick="setFolderId('{{ $folder->id }}')" --}} class="menu-link px-3">Workflow</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Share</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Duplicate</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link text-danger px-3"
                                                            data-kt-filemanager-table-filter="delete_row">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2" data-kt-filemanger-table="copy_link">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                    <i class="fas fa-download fs-5 m-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($files as $fl)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input id="check_file_{{ $fl->id }}" class="form-check-input"
                                                type="checkbox" name="check_file_{{ $fl->id }}"
                                                value="{{ $fl->id }}" />
                                        </div>
                                    </td>
                                    <td data-order="{{ $fl->id }}">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('file.index') }}?uuid={{ $fl->id }}">
                                                <span class="icon-wrapper">
                                                    {{-- <i class="fas fa-file fs-2x text-grey me-4"></i> --}}
                                                    @if (empty($fl->approval_status))
                                                        <i class="fas fa-file fs-2x text-grey me-4"
                                                            title=""></i>
                                                    @elseif ($fl->approval_status == 'Approved')
                                                        <i class="fas fa-file fs-2x text-success me-4"
                                                            title="Approved"></i>
                                                    @elseif ($fl->approval_status == 'Rejected')
                                                        <i class="fas fa-file fs-2x text-danger me-4"
                                                            title="Rejected"></i>
                                                    @else
                                                        <i class="fas fa-file fs-2x text-warning me-4"
                                                            title="Waiting Approval"></i>
                                                    @endif
                                                </span>
                                            </a>
                                            <a href="{{ route('file.index') }}?uuid={{ $fl->id }}"
                                                class="text-gray-800 text-hover-primary">
                                                {{ $fl->name }}
                                                {{-- .{{ $fl->attachment->file_type }} --}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-light-success">Document</div>
                                    </td>
                                    <td>{{ formatDateID($fl->updated_at) }}</td>
                                    <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                        <div class="d-flex justify-content-end">
                                            <div class="ms-2" data-kt-filemanger-table="copy_link">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                    <i class="fas fa-share fs-5 m-0"></i>
                                                </button>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="fas fa-gear fs-5 m-0"></i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Edit Metadata</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Edit in ..</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a wire:click="setModalFileId('{{ $fl->id }}')"
                                                            href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_retention"
                                                            class="menu-link px-3">Retention</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Share</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a wire:click="setModalFileId('{{ $fl->id }}')"
                                                            href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_duplicate_file_to_folder"
                                                            {{-- wire:click="duplicateFile" --}} class="menu-link px-3">Duplicate</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a wire:click="del_file('{{ $fl->id }}')"
                                                            class="menu-link text-danger px-3">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2" data-kt-filemanger-table="copy_link">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                    <i class="fas fa-download fs-5 m-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Automated Workflow --}}
            <div wire:ignore.self class="modal fade" id="kt_modal_automate_approval" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Automate Approval Workflow</h3>

                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>

                        <form wire:submit="automated_workflow_store">

                            <div class="modal-body">

                                <div class="mb-10">
                                    <div class="mb-3">
                                        <div class="fs-7 fw-semibold text-muted">Automatically sends any file uploaded
                                            to
                                            this folder to a predefined approval or e-signing workflow.</div>
                                    </div>
                                    <div class="fv-row">
                                        <div class="btn-group w-100" data-kt-buttons="true"
                                            data-kt-buttons-target="[data-kt-button]">
                                            <label class="btn btn-outline btn-active-success btn-color-muted active"
                                                data-kt-button="true">
                                                <input class="btn-check resolution_status_radio" type="radio"
                                                    wire:model.live="resolution_status" checked="checked"
                                                    value="Auto" />Auto
                                                (inherit)
                                            </label>
                                            <label class="btn btn-outline btn-active-success btn-color-muted"
                                                data-kt-button="true">
                                                <input class="btn-check resolution_status_radio" type="radio"
                                                    wire:model.live="resolution_status" value="Active" />Active
                                            </label>
                                            <label class="btn btn-outline btn-active-success btn-color-muted"
                                                data-kt-button="true">
                                                <input class="btn-check resolution_status_radio" type="radio"
                                                    wire:model.live="resolution_status" value="Inactive" />Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @if ($resolution_status == 'Active')
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="fs-5 fw-semibold mb-2">Resolution</label>
                                        <textarea class="form-control" rows="3" wire:model="approval_resolution" placeholder=""></textarea>
                                    </div>

                                    <div class="d-flex flex-column fv-row">
                                        <h4 class="fs-5 fw-semibold text-gray-800">By emails</h4>
                                        <div class="d-flex flex-column mb-10 fv-row">

                                            <input type="text" class="form-control"
                                                wire:model="approval_invited_emails" required
                                                {{ $approval_group ? 'disabled' : '' }} />
                                            {{-- <select wire:model="email" id="share_to_email" data-control="select2"
                                                data-hide-search="true" data-placeholder="Select a email..."
                                                class="form-select">
                                                <option value="">Select a Email...</option>
                                                <option value="hubungi.yogi@gmail.com">hubungi.yogi@gmail.com</option>
                                                <option value="noreply.dev.std@gmail.com">noreply.dev.std@gmail.com
                                                </option>
                                                <option value="1">a@company.com</option>
                                                <option value="2">b@company.com</option>
                                                <option value="3">c@company.com</option>
                                                <option value="4">d@company.com</option>
                                            </select> --}}
                                        </div>
                                    </div>


                                    <div class="d-flex flex-column fv-row">
                                        <h4 class="fs-5 fw-semibold text-gray-800">By user group</h4>
                                        <div class="d-flex flex-column mb-10 fv-row">
                                            <select wire:model.live="approval_group" name="user_group"
                                                id="approval_group" class="form-select form-select-solid">
                                                <option value="">User group</option>
                                                @foreach ($user_groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- Retention --}}
            <div wire:ignore.self class="modal fade" id="modal_retention" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit retention</h3>

                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>

                        <form wire:submit="retention_store">

                            <div class="modal-body">

                                <div class="mb-10">
                                    <div class="mb-3">
                                        <div class="fs-7 fw-semibold text-muted">You can choose date for this
                                            {{ $obj }} to be automatically deleted after certain time.</div>
                                    </div>
                                    <div class="fv-row">
                                        <div class="btn-group w-100" data-kt-buttons="true"
                                            data-kt-buttons-target="[data-kt-button]">
                                            <label
                                                class="btn btn-outline btn-active-success btn-color-muted {{ $retention_status == 'Auto' ? 'active' : '' }}"
                                                data-kt-button="true">
                                                <input class="btn-check retention_status_radio" type="radio"
                                                    wire:model.live="retention_status" value="Auto" />Auto
                                                (inherit)
                                            </label>
                                            <label
                                                class="btn btn-outline btn-active-success btn-color-muted {{ $retention_status == 'Active' ? 'active' : '' }}"
                                                data-kt-button="true">
                                                <input class="btn-check retention_status_radio" type="radio"
                                                    wire:model.live="retention_status" value="Active" />Active
                                            </label>
                                            <label
                                                class="btn btn-outline btn-active-success btn-color-muted {{ $retention_status == 'Inactive' ? 'active' : '' }}"
                                                data-kt-button="true">
                                                <input class="btn-check retention_status_radio" type="radio"
                                                    wire:model.live="retention_status" value="Inactive" />Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @if ($retention_status == 'Active')
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="fs-5 fw-semibold mb-2">After</label>
                                        <input wire:model="retention_date_end" type="datetime-local"
                                            id="retention_date_end" class="form-control" required />
                                    </div>

                                    <div class="d-flex flex-column fv-row">
                                        <h4 class="fs-5 fw-semibold text-gray-800">Take the following action</h4>
                                        <div class="d-flex flex-column mb-10 fv-row">
                                            <select wire:model.live="retention_action" name="user_group"
                                                id="retention_action" class="form-select form-select-solid">
                                                <option value="Move to Recycle Bin">Move to Recycle Bin</option>
                                                <option value="Delete">Delete permanently</option>
                                                <option value="Archive">Archive to folder</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div wire:ignore.self class="modal fade" id="kt_file_manager_new_folder" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">New Folder</h3>

                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                        </div>

                        <form class="py-4 d-flex flex-column gap-5" wire:submit.prevent='store'>

                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="folder_name"
                                        id="folder_name" placeholder="Folder Name" autocomplete="Folder">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="d-none" data-kt-filemanager-template="rename">
                <div class="fv-row">
                    <div class="d-flex align-items-center">
                        <span id="kt_file_manager_rename_folder_icon"></span>
                        <input type="text" id="kt_file_manager_rename_input" name="rename_folder_name"
                            placeholder="Enter the new folder name" class="form-control mw-250px me-3"
                            value="" />
                        <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_rename_folder">
                            <i class="ki-duotone ki-check fs-1"></i>
                        </button>
                        <button class="btn btn-icon btn-light-danger" id="kt_file_manager_rename_folder_cancel">
                            <span class="indicator-label">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-none" data-kt-filemanager-template="action">
                <div class="d-flex justify-content-end">
                    <div class="ms-2" data-kt-filemanger-table="copy_link">
                        <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-fasten fs-5 m-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px"
                            data-kt-menu="true">
                            <div class="card card-flush">
                                <div class="card-body p-5">
                                    <div class="d-flex" data-kt-filemanger-table="copy_link_generator">
                                        <div class="me-5" data-kt-indicator="on">
                                            <span class="indicator-progress">
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </div>
                                        <div class="fs-6 text-gray-900">Generating Share Link...
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column text-start d-none"
                                        data-kt-filemanger-table="copy_link_result">
                                        <div class="d-flex mb-3">
                                            <i class="ki-duotone ki-check fs-2 text-success me-3"></i>
                                            <div class="fs-6 text-gray-900">Share Link Generated
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm"
                                            value="https://path/to/file/or/folder/" />
                                        <div class="text-muted fw-normal mt-2 fs-8 px-3">Read
                                            only.
                                            <a href="apps/file-manager/settings/.html" class="ms-2">Change
                                                permissions</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-2">
                        <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-dots-square fs-5 m-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Download File</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-filemanager-table="rename">Rename</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">Move to
                                    folder</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link text-danger px-3"
                                    data-kt-filemanager-table-filter="delete_row">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none" data-kt-filemanager-template="checkbox">
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" />
                </div>
            </div>

            <div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <form class="form" action="none" id="kt_modal_upload_form">
                            <div class="modal-header">
                                <h2 class="fw-bold">Upload files</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body pt-10 pb-15 px-lg-17">
                                <div class="form-group">

                                    {{-- <div class="dropzone-select">
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up text-primary fs-3x">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="dropzone dropzone-queue mb-2" id="kt_modal_upload_dropzone">
                                        <div class="dropzone-panel mb-4">
                                            {{-- <a class="dropzone-select btn btn-sm btn-primary me-2">Click, or drag file here</a> --}}

                                            <a class="dropzone-select btn btn-lg btn-flex btn-primary px-6 me-2">
                                                <i class="ki-duotone ki-graph-3 fs-2x"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <span class="d-flex flex-column align-items-start ms-2">
                                                    <span class="fs-3 fw-bold">Upload</span>
                                                    <span class="fs-7">Click, or drag file here</span>
                                                </span>
                                            </a>

                                            <a class="dropzone-upload btn btn-lg btn-light-primary me-2">Upload
                                                All</a>
                                            <a class="dropzone-remove-all btn btn-lg btn-light-danger">Remove
                                                All</a>
                                        </div>
                                        <div class="dropzone-items wm-200px">
                                            <div class="dropzone-item p-5" style="display:none">
                                                <div class="dropzone-file">
                                                    <div class="dropzone-filename text-gray-900"
                                                        title="some_image_file_name.jpg">
                                                        <span data-dz-name="">some_image_file_name.jpg</span>
                                                        <strong>(
                                                            <span data-dz-size="">340kb</span>)</strong>
                                                    </div>
                                                    <div class="dropzone-error mt-0" data-dz-errormessage="">
                                                    </div>
                                                </div>
                                                <div class="dropzone-progress">
                                                    <div class="progress bg-gray-300">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                                                            data-dz-uploadprogress=""></div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-toolbar">
                                                    <span class="dropzone-start">
                                                        <i class="ki-duotone ki-to-right fs-1"></i>
                                                    </span>
                                                    <span class="dropzone-cancel" data-dz-remove=""
                                                        style="display: none;">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="dropzone-delete" data-dz-remove="">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <span class="form-text pt-35 fs-6 text-muted">Max file size is 1MB per file.</span> --}}

                                </div>
                            </div>

                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="kt_modal_move_to_folder" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <form class="form" action="#" id="kt_modal_move_to_folder_form">
                            <div class="modal-header">
                                <h2 class="fw-bold">Move to folder</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body pt-10 pb-15 px-lg-17">
                                <div class="form-group fv-row">
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="0" id="kt_modal_move_to_folder_0" />
                                            <label class="form-check-label" for="kt_modal_move_to_folder_0">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>account
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="1" id="kt_modal_move_to_folder_1" />
                                            <label class="form-check-label" for="kt_modal_move_to_folder_1">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>apps
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="2" id="kt_modal_move_to_folder_2" />
                                            <label class="form-check-label" for="kt_modal_move_to_folder_2">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>widgets
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="3" id="kt_modal_move_to_folder_3" />
                                            <label class="form-check-label" for="kt_modal_move_to_folder_3">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>assets
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="4" id="kt_modal_move_to_folder_4" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_4">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>fileation
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Item-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="5" id="kt_modal_move_to_folder_5" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_5">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>layouts
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Item-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="6" id="kt_modal_move_to_folder_6" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_6">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>modals
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Item-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="7" id="kt_modal_move_to_folder_7" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_7">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>authentication
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Item-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="8" id="kt_modal_move_to_folder_8" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_8">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>dashboards
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Item-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="move_to_folder" type="radio"
                                                value="9" id="kt_modal_move_to_folder_9" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_move_to_folder_9">
                                                <div class="fw-bold">
                                                    <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>pages
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Action buttons-->
                                <div class="d-flex flex-center mt-12">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-primary"
                                        id="kt_modal_move_to_folder_submit">
                                        <span class="indicator-label">Move</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--begin::Action buttons-->
                            </div>
                            <!--end::Modal body-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>

            <div class="modal fade" id="kt_modal_duplicate_file_to_folder" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h2 class="fw-bold">Duplicate file </h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body pt-10 pb-15 px-lg-17">
                                <div class="form-group fv-row">

                                    @foreach ($folders as $folder)
                                        <div class="d-flex">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" wire:model="selected_folder_id"
                                                    type="radio" value="{{ $folder->id }}"
                                                    id="kt_modal_duplicate_file_to_folder_{{ $folder->id }}" />
                                                <label class="form-check-label"
                                                    for="kt_modal_duplicate_file_to_folder_{{ $folder->id }}">
                                                    <div class="fw-bold">
                                                        <i class="ki-duotone ki-folder fs-2 text-primary me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{ $folder->name }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class='separator separator-dashed my-5'></div>
                                    @endforeach
                                </div>
                                <div class="d-flex flex-center mt-12">
                                    <button wire:click="duplicateFile" class="btn btn-primary">
                                        <span class="indicator-label">Duplicate</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
