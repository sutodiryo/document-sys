<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Users
                    List</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Authentication</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('users.index') }}" class="btn btn-sm fw-bold btn-primary">Back</a>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            {{-- <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{ asset('metronic_8.2.6/media/illustrations/sketchy-1/4.png') }}')">
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">File Manager</h2>
                            <div class="text-muted fw-bold">
                                <a href="#">docsys</a>
                                <span class="mx-3">|</span>
                                <a href="#">File Manager</a>
                                <span class="mx-3">|</span>2.6 GB
                                <span class="mx-3">|</span>758 items
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pb-0">
                    <div class="d-flex overflow-auto h-20px">
                    </div>
                </div>
            </div> --}}

            <div class="card card-flush">
                <div class="card-header pt-8">

                    <div class="d-flex flex-stack mb-8">
                        <div class="badge badge-lg badge-light-primary">
                            <div class="d-flex align-items-center flex-wrap">
                                <i class="ki-duotone ki-home fs-2 text-primary me-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <a href="{!! route('users.index') !!}">Users </a>
                                <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                Password Policy
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($data, ['route' => ['usr.password_policy.store'], 'method' => 'post']) !!}

                    <div class="row mb-15">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Enable Password Policy</label>
                        <div class="col-lg-9 d-flex align-items-center">
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input class="form-check-input w-45px h-30px" type="checkbox"
                                    id="enable_password_policy"
                                    {{ isset($data['enable_password_policy']) ? ($data['enable_password_policy'] == 'on' ? 'checked' : '') : '' }}
                                    name="enable_password_policy" />
                                <label class="form-check-label" for="enable_password_policy"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-15">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Require 2FA?</label>
                        <div class="col-lg-9 d-flex align-items-center">
                            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                <input class="form-check-input w-45px h-30px" type="checkbox" id="require_2fa"
                                    {{ isset($data['require_2fa']) ? ($data['require_2fa'] == 'on' ? 'checked' : '') : '' }}
                                    name="require_2fa" />
                                <label class="form-check-label" for="require_2fa"></label>
                            </div>
                        </div>
                    </div>

                    <div class="fv-row row mb-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Minimum Length</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="minimum_length"
                                value="{{ isset($data['minimum_length']) ? $data['minimum_length'] : 0 }}">
                        </div>
                    </div>

                    <hr>
                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Lowercase Letter</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="lowercase"
                                value="{{ isset($data['lowercase']) ? $data['lowercase'] : 0 }}">
                        </div>
                    </div>

                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Uppercase Letter</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="uppercase"
                                value="{{ isset($data['uppercase']) ? $data['uppercase'] : 0 }}">
                        </div>
                    </div>

                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Numbers</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="numbers"
                                value="{{ isset($data['numbers']) ? $data['numbers'] : 0 }}">
                        </div>
                    </div>

                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Special characters</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="special_characters"
                                value="{{ isset($data['special_characters']) ? $data['special_characters'] : 0 }}">
                        </div>
                    </div>

                    <hr>
                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Password rotation</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="rotation"
                                value="{{ isset($data['rotation']) ? $data['rotation'] : 0 }}">
                        </div>
                    </div>

                    <div class="fv-row row mb-15 mt-15">
                        <div class="col-md-3 d-flex align-items-center">
                            <label class="fs-6 fw-semibold">Reuse Limit</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="reuse_limit"
                                value="{{ isset($data['reuse_limit']) ? $data['reuse_limit'] : 0 }}">
                        </div>
                    </div>

                    <div class="row mt-12">
                        <div class="col-md-9 offset-md-3">
                            <button type="button" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="kt_file_manager_settings_submit">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
