<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">User
                    Group
                    Lists</h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_export_users">
                                <i class="ki-duotone ki-exit-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Export</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_user">
                                <i class="ki-duotone ki-plus fs-2"></i>Add User Group</button>
                        </div>
                        <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="fw-bold">Export Users</h2>
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-users-modal-action="close">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <form id="kt_modal_export_users_form" class="form" action="#">
                                            <div class="fv-row mb-10">
                                                <label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>
                                                <select name="role" data-control="select2"
                                                    data-placeholder="Select a role" data-hide-search="true"
                                                    class="form-select form-select-solid fw-bold">
                                                    <option></option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Analyst">Analyst</option>
                                                    <option value="Developer">Developer</option>
                                                    <option value="Support">Support</option>
                                                    <option value="Trial">Trial</option>
                                                </select>
                                            </div>
                                            <div class="fv-row mb-10">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Select Export
                                                    Format:</label>
                                                <select name="format" data-control="select2"
                                                    data-placeholder="Select a format" data-hide-search="true"
                                                    class="form-select form-select-solid fw-bold">
                                                    <option></option>
                                                    <option value="excel">Excel</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="cvs">CVS</option>
                                                    <option value="zip">ZIP</option>
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bold">Add User Group</h2>
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-bs-dismiss="modal">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="modal-body px-5 my-7">

                                        <form id="kt_modal_add_user_form" class="form"
                                            wire:submit.prevent="store_user_group">
                                            <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                                data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                                data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                                data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                                                data-kt-scroll-offset="300px">
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Name</label>
                                                    <input type="text" wire:model="name"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="User group name" required />
                                                    <div>
                                                        @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Emails</label>
                                                    <input type="email" wire:model="emails"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="example@domain.com" required />
                                                </div> --}}
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
                    </div>
                </div>

                <div class="card-body py-4">

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-50px">Created</th>
                                <th class="min-w-50px"></th>
                                <th class="text-end min-w-10px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($groups as $key => $group)
                                <tr>
                                    <td>
                                        {{ $group->name }}
                                    </td>
                                    <td>{{ $group->created_at }}</td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a wire:click="edit_user_group('{{ $group->id }}')"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal_edit_user_group_{{ $group->id }}"
                                                    class="menu-link px-3">Rename</a>
                                            </div>
                                            <div wire:click="add_email_to_user_group('{{ $group->id }}')"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_add_email_to_user_group_{{ $group->id }}"
                                                class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Add User</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link text-danger px-3">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal_edit_user_group_{{ $group->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                id="modal_edit_user_group_{{ $group->id }}_header">
                                                <h2 class="fw-bold">Edit User Group ({{ $group->name }})</h2>
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="modal-body px-5 my-7">

                                                <form id="modal_edit_user_group_{{ $group->id }}_form"
                                                    class="form" wire:submit.prevent="store_edit">
                                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                        id="modal_edit_user_group_{{ $group->id }}_scroll"
                                                        data-kt-scroll="true" data-kt-scroll-activate="true"
                                                        data-kt-scroll-max-height="auto"
                                                        data-kt-scroll-dependencies="#modal_edit_user_group_{{ $group->id }}_header"
                                                        data-kt-scroll-wrappers="#modal_edit_user_group_{{ $group->id }}_scroll"
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
                                                        {{-- <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                            <input type="email" wire:model="e_email"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="example@domain.com" disabled />
                                                        </div> --}}
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

                                <div class="modal fade" id="modal_add_email_to_user_group_{{ $group->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                id="modal_edit_user_group_{{ $group->id }}_header">
                                                <h2 class="fw-bold">Add User to Group ({{ $group->name }})</h2>
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="modal-body px-5 my-7">

                                                <form id="modal_edit_user_group_{{ $group->id }}_form"
                                                    class="form" wire:submit.prevent="store_emails">
                                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                        id="modal_edit_user_group_{{ $group->id }}_scroll"
                                                        data-kt-scroll="true" data-kt-scroll-activate="true"
                                                        data-kt-scroll-max-height="auto"
                                                        data-kt-scroll-dependencies="#modal_edit_user_group_{{ $group->id }}_header"
                                                        data-kt-scroll-wrappers="#modal_edit_user_group_{{ $group->id }}_scroll"
                                                        data-kt-scroll-offset="300px">
                                                        <div class="fv-row mb-7">
                                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                            {{-- <input type="text" wire:model="e_name"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Full name" required /> --}}
                                                                <textarea wire:model="e_user_group_emails" class="form-control form-control-solid"></textarea>
                                                            <div>
                                                                @error('name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
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

{{-- @livewire('ibprandbowtie::bowtie.modal.modal-event', ['bowtie_id'=>$bowtie_id]) --}}
