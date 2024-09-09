<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Password Policy</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Account</a>
                    </li>
                </ul>
            </div>
            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('account.users') }}" class="btn btn-sm fw-bold btn-primary">Back</a>
            </div> --}}
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card card-flush">
                <div class="card-header pt-8">

                    <div class="d-flex flex-stack mb-8">
                        <div class="badge badge-lg badge-light-primary">
                            <div class="d-flex align-items-center flex-wrap">
                                <i class="ki-duotone ki-home fs-2 text-primary me-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <a href="{!! route('account.users') !!}">Users </a>
                                <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                Password Policy
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form wire:submit="store">

                        <div class="row mb-15">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Enable Password Policy</label>
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input wire:model="settings.enable_password_policy" class="form-check-input w-45px h-30px"
                                        type="checkbox" />
                                    <label class="form-check-label" for="enable_password_policy"></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-15">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Require 2FA?</label>
                            <div class="col-lg-9 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input wire:model="settings.require_2fa" class="form-check-input w-45px h-30px"
                                        type="checkbox" id="require_2fa" />
                                    <label class="form-check-label" for="require_2fa"></label>
                                </div>
                            </div>
                        </div>

                        <div class="fv-row row mb-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Minimum Length</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.minimum_length" />
                            </div>
                        </div>

                        <hr>
                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Lowercase Letter</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.lowercase">
                            </div>
                        </div>

                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Uppercase Letter</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.uppercase">
                            </div>
                        </div>

                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Numbers</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.numbers">
                            </div>
                        </div>

                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Special characters</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.special_characters">
                            </div>
                        </div>

                        <hr>
                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Password rotation</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.rotation">
                            </div>
                        </div>

                        <div class="fv-row row mb-15 mt-15">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">Reuse Limit</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model="settings.reuse_limit">
                            </div>
                        </div>

                        <div class="row mt-12">
                            <div class="col-md-9 offset-md-3">
                                <a href="{{ route('account.users') }}" class="btn btn-light me-3">Back</a>
                                <button type="submit" class="btn btn-primary" id="kt_file_manager_settings_submit">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
