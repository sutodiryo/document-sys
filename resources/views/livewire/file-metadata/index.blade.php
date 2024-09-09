
<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">Custom Metadata Fields</h2>
                            <div class="text-muted fw-bold">
                                <a>Total records</a>
                                <span class="mx-3">|</span>758 items
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
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search Logs" />

                            {{-- {!! Form::text('search', null, [
                                'class' => 'form-control form-control-solid w-250px ps-15',
                                'placeholder' => 'Search...',
                            ]) !!} --}}

                        </div>
                    </div>

                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                            <div>
                                <button class="btn btn-sm btn-light-primary me-3" data-kt-menu-trigger="click"
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

                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_upload">
                                <i class="ki-solid ki-folder-down fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Download Logs
                            </button>
                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <table id="kt_file_manager_list" data-kt-filemanager-table="folders"
                        class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px pe-2">Time</th>
                                <th class="min-w-100px">User</th>
                                <th class="min-w-250px">Action</th>
                            </tr>
                        </thead>

                        <tbody class="fw-semibold text-gray-600">

                            @foreach ($metadatas as $meta)
                                <tr>
                                    <td>
                                        {{ formatDateTime($meta->created_at) }}
                                    </td>
                                    <td>
                                        {{ $meta->createdBy->email }}
                                    </td>
                                    <td class="text-end text-sm">
                                        {!! $meta->activity !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
