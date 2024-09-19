
<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">Manage custom metadata fields</h2>
                            <div class="text-muted fw-bold">
                                <a>Total records</a>
                                <span class="mx-3">|</span>{{ $metadatas->count() }} items
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
                <div class="card-body">

                    <table id="kt_file_manager_list" data-kt-filemanager-table="folders"
                        class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px pe-2">Name</th>
                                <th class="min-w-300px">Description</th>
                                <th class="min-w-100px">Type</th>
                                <th class="min-w-100px">Multiple</th>
                                <th class="min-w-50px"></th>
                            </tr>
                        </thead>

                        <tbody class="fw-semibold text-gray-600">

                            @foreach ($metadatas as $meta)
                                <tr>
                                    <td>{{ $meta->name }}</td>
                                    <td>{{ $meta->description }}</td>
                                    <td>{{ $meta->data_type }}</td>
                                    <td><i class="fas fa-{{ $meta->allow_multiple_use ? 'check' : 'cross' }}"></i></td>
                                    <td class="text-center">
                                        <a href="#"><i class="fas fa-gear"></i></a>
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
