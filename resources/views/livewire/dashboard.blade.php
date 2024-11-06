<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid mt-10">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-4">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #F1416C;background-image:url('{{ asset('metronic_8.2.6/media/svg/shapes/wave-bg-dark.svg') }}')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                                <i class="fas fa-copy text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $duplicate }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Duplicate</span>
                                    {{-- <span class="">Calls</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">{{ $duplicate }}</span>
                                <span class="opacity-50">Duplicate found</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #7239EA;background-image:url('{{ asset('metronic_8.2.6/media/svg/shapes/wave-bg-dark.svg') }}')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <i class="fas fa-handshake text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $workflow }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Workflow</span>
                                    {{-- <span class="">Calls</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">{{ $workflow }}</span>
                                <span class="opacity-50">Awaiting decision</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-4">
                    <a href="#">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #F1416C;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                            <div class="card-header pt-5 mb-3">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                                    <i class="fas fa-copy text-white fs-2qx lh-0"></i>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">Duplicate</span>
                                </div>
                            </div>
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: #dedcdc26;">
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $duplicate }}</span>
                                    <span class="opacity-50">Duplicate found</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4">
                    <a href="#">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #7239EA;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                            <div class="card-header pt-5 mb-3">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                    <i class="fas fa-handshake text-white fs-2qx lh-0"></i>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">Workflow</span>
                                </div>
                            </div>
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: #dedcdc26;">
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $workflow }}</span>
                                    <span class="opacity-50">Awaiting decision</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}

                <div class="col-xl-4">
                    <a href="#">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #00cb1e;background-image:url('{{ asset('metronic_8.2.6/media/svg/shapes/wave-bg-dark.svg') }}')">
                            <div class="card-header pt-5 mb-3">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #00cb1e">
                                    <i class="fas fa-clock text-white fs-2qx lh-0"></i>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">{{ $retention }}</span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">Retention</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $retention }}</span>
                                    <span class="opacity-50">documents with retention end in the next 30 days</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>


            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-4">
                    <a href="#">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #e39c04;background-image:url('{{ asset('metronic_8.2.6/media/svg/shapes/wave-bg-dark.svg') }}')">
                            <div class="card-header pt-5 mb-3">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #e39c04">
                                    <i class="fas fa-warning text-white fs-2qx lh-0"></i>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">{{ $due_date }}</span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">Due date</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: #dedcdc26;">
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $due_date }}</span>
                                    <span class="opacity-50">due or soon to be due documents</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4">
                    <a href="#">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #ee0000;background-image:url('{{ asset('metronic_8.2.6/media/svg/shapes/wave-bg-dark.svg') }}')">
                            <div class="card-header pt-5 mb-3">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #ee0000">
                                    <i class="fas fa-file text-white fs-2qx lh-0"></i>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">{{ $all_files }}</span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">All files</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: #dedcdc26;">
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $all_files }}</span>
                                    <span class="opacity-50">counted files</span>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
