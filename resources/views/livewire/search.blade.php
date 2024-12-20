<div class="d-flex flex-column flex-column-fluid" x-data="{ isUploading: false, progress: 0, loading: false }">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-7">
                <div class="card-body">

                    @if ($search_on == 'ocr')
                        <div>
                            <div class="row g-8 mb-8">
                                <div class="col-xxl-12">
                                    <label class="fs-6 form-label fw-bold text-gray-900">OCR Search</label>
                                    <div class="dropzone"
                                        x-on:livewire-upload-start="[isUploading = true, loading = true]"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error  ="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <input type="file" class="form-control" id="upload_file"
                                            wire:model.live="upload_file" />

                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>

                                    <!-- Spinner -->
                                    @if ($loading)
                                        <div x-show='loading'>
                                            <div
                                                class="spinner spinner-track spinner-primary spinner-lg mt-5 spinner-right ps-20">
                                                <span>Searching . . .</span>
                                            </div>
                                        </div>
                                    @endif

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
                                <button wire:click="setTables" class="btn btn-primary me-5">Search term</button>
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

            <div class="d-flex flex-wrap flex-stack pb-7">
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1">{{ $count }} Items Found
                    </h3>
                </div>

                <div class="d-flex flex-wrap my-1">

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
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="card card-flush">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
