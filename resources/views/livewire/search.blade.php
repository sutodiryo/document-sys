<div class="d-flex flex-column flex-column-fluid">


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-7">
                <div class="card-body">

                    @if ($search_on == 'ocr')
                        <div>
                            <div class="row g-8 mb-8">
                                <div class="col-xxl-12">
                                    <label class="fs-6 form-label fw-bold text-gray-900">OCR Search</label>

                                    <div class="dropzone" x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <input type="file" class="form-control" id="upload_file"
                                            wire:model.live="upload_file" />

                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        @if ($search_on != 'ocr')
                            <div class="position-relative w-md-400px me-md-2">
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input wire:model.live="query" type="text"
                                    class="form-control form-control-solid ps-10" placeholder="Search" />
                            </div>
                        @endif

                        <div class="d-flex align-items-center">
                            @if ($search_on != 'ocr')
                                <button type="submit" class="btn btn-primary me-5">Search term</button>
                            @endif
                            <button wire:click="advancedSearch" class="btn btn-link">Advanced
                                Search</button>
                        </div>
                    </div>

                    @if ($advanced_search)
                        <div>
                            <div class="separator separator-dashed mt-9 mb-6"></div>
                            <div class="row g-8 mb-8">
                                <div class="col-xxl-12">
                                    <label class="fs-6 form-label fw-bold text-gray-900">Folder</label>
                                    <select wire:model.live="filter_folder" class="form-select form-select-solid"
                                        data-placeholder="Select Folder" data-hide-search="true">
                                        <option value="">Select Folder</option>
                                        @foreach ($all_folders as $fda)
                                            <option value="{{ $fda->id }}">{{ $fda->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row g-8">
                                        <div class="col-lg-6">
                                            <label class="fs-6 form-label fw-bold text-gray-900">Date start</label>
                                            <input wire:model.live="filter_date_start" type="date"
                                                class="form-control form-control-solid border-0" />
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="fs-6 form-label fw-bold text-gray-900">Date End</label>
                                            <input wire:model.live="filter_date_end" type="date"
                                                class="form-control form-control-solid border-0" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            {{-- </form> --}}

            <div class="d-flex flex-wrap flex-stack pb-7">
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1">{{ $count }} Items Found
                    </h3>
                </div>

                <div class="d-flex flex-wrap my-1">
                    {{-- <ul class="nav nav-pills me-6 mb-2 mb-sm-0">
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 active"
                                data-bs-toggle="tab" href="#kt_project_users_card_pane">
                                <i class="ki-duotone ki-element-plus fs-2"></i>
                            </a>
                        </li>
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary"
                                data-bs-toggle="tab" href="#kt_project_users_table_pane">
                                <i class="ki-duotone ki-row-horizontal fs-2"></i>
                            </a>
                        </li>
                    </ul> --}}

                    <div class="d-flex my-0">

                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="all" checked="checked">
                                <span class="form-check-label text-gray-600">All</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="file_name">
                                <span class="form-check-label text-gray-600">File name</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="folder_name">
                                <span class="form-check-label text-gray-600">Folder name</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="metadata">
                                <span class="form-check-label text-gray-600">Metadata</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="content">
                                <span class="form-check-label text-gray-600">Content</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="ocr">
                                <span class="form-check-label text-gray-600">OCR</span>
                            </label>
                        </div>
                        <div class="d-flex flex-column flex-wrap fw-semibold mt-5">
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" wire:model.live="search_on"
                                    value="notes">
                                <span class="form-check-label text-gray-600">Notes</span>
                            </label>
                        </div>

                        {{-- <select wire:model.live="sort_by_name" data-hide-search="true" data-placeholder="Filter"
                            class="form-select form-select-sm form-select-solid w-150px me-5">
                            <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>
                        </select> --}}
                        {{-- <select wire:model.live="sort_by_date" data-hide-search="true"
                            class="form-select form-select-sm form-select-solid w-150px me-5">
                            <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>
                        </select> --}}
                        {{-- <select wire:model.live="status" data-hide-search="true"
                            data-placeholder="Export" class="form-select form-select-sm form-select-solid w-100px">
                            <option value="1">Excel</option>
                            <option value="1">PDF</option>
                            <option value="2">Print</option>
                        </select> --}}
                        {{-- <select wire:model.live="filter_folder" class="form-select form-select-solid"
                            data-placeholder="Select Folder" data-hide-search="true">
                            <option value="">Select Folder</option>
                            <option value="9ce9f96b-6151-4984-9e6d-f3f45c6ddc4c">Section 1</option>
                            <option value="9ce9f999-e233-450a-aa1e-3c80ebf6bd6a">Section 2</option>
                            <option value="9cf11d1e-0d93-4e44-af9d-88533fe83134">Section 3</option>
                        </select> --}}
                        {{-- <button wire:click="sss('9ce9f96b-6151-4984-9e6d-f3f45c6ddc4c')">Cek</button> --}}
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="card card-flush">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <h1>

                                @if ($parsed_text)
                                    {{ $parsed_text }}
                                @endif
                                <br>
                                <br>
                                @if ($file_parsed_text)
                                    {{ $file_parsed_text }}
                                @endif

                            </h1>
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        {{-- <th class="w-10px pe-2">
                                            <div
                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_file_manager_list .form-check-input"
                                                    value="1" />
                                            </div>
                                        </th> --}}
                                        <th class="min-w-250px">Name<select wire:model.live="sort_by_name"
                                                data-hide-search="true" data-placeholder="Filter"
                                                class="form-select form-select-sm form-select-solid w-150px me-5">
                                                <option value="ASC">ASC</option>
                                                <option value="DESC">DESC</option>
                                            </select></th>

                                        <th class="min-w-10px"></th>
                                        <th class="min-w-125px">Date
                                            <select wire:model.live="sort_by_date" data-hide-search="true"
                                                class="form-select form-select-sm form-select-solid w-150px me-5">
                                                <option value="ASC">ASC</option>
                                                <option value="DESC">DESC</option>
                                            </select>
                                        </th>
                                        <th class="min-w-125px">Last Modified</th>
                                        {{-- <th class="w-125px"></th> --}}
                                    </tr>
                                </thead>

                                <tbody class="fw-semibold text-gray-600">

                                    @foreach ($folders as $fd)
                                        <tr>
                                            {{-- <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td> --}}
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
                                                    </a>
                                                </div>
                                                <ul
                                                    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                                    @foreach ($fd->joinAncestors()->reverse() as $ancestor)
                                                        <li class="breadcrumb-item text-muted">
                                                            <a href="{{ route('folder.index') }}?uuid={{ $ancestor->id }}""
                                                                class="text-muted text-hover-primary">{{ $ancestor->name }}</a>
                                                        </li>
                                                        @if ($ancestor->name != $fd->name)
                                                            <li class="breadcrumb-item">></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                            </td>
                                            <td>{{ formatDateID($fd->created_at) }}</td>
                                            <td>{{ formatDateID($fd->updated_at) }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($files as $fl)
                                        <tr>
                                            {{-- <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input id="check_file_{{ $fl->id }}"
                                                        class="form-check-input" type="checkbox"
                                                        name="check_file_{{ $fl->id }}"
                                                        value="{{ $fl->id }}" />
                                                </div>
                                            </td> --}}
                                            <td data-order="{{ $fl->id }}">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('file.index') }}?uuid={{ $fl->id }}">
                                                        <span class="icon-wrapper">
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
                                                    </a>
                                                </div>

                                                <ul
                                                    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                                    @foreach ($fl->folder->joinAncestors()->reverse() as $ancestor)
                                                        <li class="breadcrumb-item text-muted">
                                                            <a href="{{ route('folder.index') }}?uuid={{ $ancestor->id }}""
                                                                class="text-muted text-hover-primary">{{ $ancestor->name }}</a>
                                                        </li>
                                                        @if ($ancestor->name != $fl->folder->joinAncestors()->reverse()->last()->name)
                                                            <li class="breadcrumb-item">></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="badge badge-light-success">Document</div>
                                            </td>
                                            <td>{{ formatDateID($fl->created_at) }}</td>
                                            <td>{{ formatDateID($fl->updated_at) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{-- <table id="kt_project_users_table"
                                class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                <thead class="fs-7 text-gray-500 text-uppercase">
                                    <tr>
                                        <th class="min-w-250px">Manager</th>
                                        <th class="min-w-150px">Date</th>
                                        <th class="min-w-90px">Amount</th>
                                        <th class="min-w-90px">Status</th>
                                        <th class="min-w-50px text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6">
                                    @foreach ($folders as $index => $fd)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-5 position-relative">
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span
                                                                class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                                        </div>
                                                        <div
                                                            class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <a href=""
                                                            class="mb-1 text-gray-800 text-hover-primary">{{ $fd->name }}</a>
                                                        <div class="fw-semibold fs-6 text-gray-500">melody@altbox.com
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Feb 21, 2024</td>
                                            <td>$900.00</td>
                                            <td>
                                                <span
                                                    class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
