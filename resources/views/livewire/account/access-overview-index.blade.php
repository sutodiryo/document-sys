<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Users
                    with any access to {{ config('app.name', 'Laravel') }}</h1>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h3>Users ({{ $users->count() }})</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th class="min-w-150px">Email</th>
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-50px"></th>
                                <th class="min-w-50px"></th>
                                <th class="text-end min-w-10px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        {{ $user->email }}
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->position }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a wire:click="edit_user('{{ $user->id }}')" data-bs-toggle="modal"
                                                    data-bs-target="#modal_edit_user_{{ $user->id }}"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a wire:click="remove_all_access" class="menu-link px-3">Remove all
                                                    access</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade" id="modal_edit_user_{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content">
                                            <div class="modal-header" id="modal_edit_user_{{ $user->id }}_header">
                                                <h2 class="fw-bold">Edit User ({{ $user->name }})</h2>
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="modal-body px-5 my-7">

                                                <form id="modal_edit_user_{{ $user->id }}_form" class="form"
                                                    wire:submit.prevent="store_edit">
                                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                        id="modal_edit_user_{{ $user->id }}_scroll"
                                                        data-kt-scroll="true" data-kt-scroll-activate="true"
                                                        data-kt-scroll-max-height="auto"
                                                        data-kt-scroll-dependencies="#modal_edit_user_{{ $user->id }}_header"
                                                        data-kt-scroll-wrappers="#modal_edit_user_{{ $user->id }}_scroll"
                                                        data-kt-scroll-offset="300px">
                                                        <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Name</label>
                                                            <input type="text" wire:model="e_name"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Full name" required />
                                                            <div>
                                                                @error('name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                            <input type="email" wire:model="e_email"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="example@domain.com" disabled />
                                                        </div>
                                                        <div class="fv-row mb-7">
                                                            <label
                                                                class="required fw-semibold fs-6 mb-2">Position</label>
                                                            <input type="text" wire:model="e_position"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Manager, Staff dll" />
                                                        </div>
                                                    </div>
                                                    <div class="text-center pt-10">
                                                        <button type="reset" class="btn btn-light me-3"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <span class="indicator-label">Submit</span>
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-10">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h3>Public links ({{ $public_links->count() }})</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th class="min-w-400px"></th>
                                <th class="text-end min-w-10px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($public_links as $key => $pl)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        {{ $pl->file->name }}
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a wire:click="remove_all_access" class="menu-link px-3">Remove links</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade" id="modal_edit_user_{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                id="modal_edit_user_{{ $user->id }}_header">
                                                <h2 class="fw-bold">Edit User ({{ $user->name }})</h2>
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="modal-body px-5 my-7">

                                                <form id="modal_edit_user_{{ $user->id }}_form" class="form"
                                                    wire:submit.prevent="store_edit">
                                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                        id="modal_edit_user_{{ $user->id }}_scroll"
                                                        data-kt-scroll="true" data-kt-scroll-activate="true"
                                                        data-kt-scroll-max-height="auto"
                                                        data-kt-scroll-dependencies="#modal_edit_user_{{ $user->id }}_header"
                                                        data-kt-scroll-wrappers="#modal_edit_user_{{ $user->id }}_scroll"
                                                        data-kt-scroll-offset="300px">
                                                        <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Name</label>
                                                            <input type="text" wire:model="e_name"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Full name" required />
                                                            <div>
                                                                @error('name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                            <input type="email" wire:model="e_email"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="example@domain.com" disabled />
                                                        </div>
                                                        <div class="fv-row mb-7">
                                                            <label
                                                                class="required fw-semibold fs-6 mb-2">Position</label>
                                                            <input type="text" wire:model="e_position"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Manager, Staff dll" />
                                                        </div>
                                                    </div>
                                                    <div class="text-center pt-10">
                                                        <button type="reset" class="btn btn-light me-3"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <span class="indicator-label">Submit</span>
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
