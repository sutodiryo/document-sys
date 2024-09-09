<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Users
                    List</h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="m-0">
                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Filter</a>
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                        id="kt_menu_6678170faa388">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <div class="px-7 py-5">
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Status:</label>
                                <div>
                                    <select class="form-select form-select-solid" multiple="multiple"
                                        data-kt-select2="true" data-close-on-select="false"
                                        data-placeholder="Select option" data-dropdown-parent="#kt_menu_6678170faa388"
                                        data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Member Type:</label>
                                <div class="d-flex">
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Notifications:</label>
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications"
                                        checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('account.password.policy') }}" class="btn btn-sm fw-bold btn-primary">Password
                    Policy</a>
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
                                <i class="ki-duotone ki-plus fs-2"></i>Add User</button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">Delete Selected</button>
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
                                        <h2 class="fw-bold">Add User</h2>
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
                                            wire:submit.prevent="add_user">
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
                                                        placeholder="Full name" required />
                                                    <div>
                                                        @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                    <input type="email" wire:model="email"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="example@domain.com" required />
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Position</label>
                                                    <input type="text" wire:model="position"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Manager, Staff dll" />
                                                </div>
                                                <div class="mb-5">
                                                    {{-- <label class="required fw-semibold fs-6 mb-5">Role</label> --}}
                                                    @can('user manage permission')
                                                        {{-- <script id="permission-row" type="text/x-handlebars-template">
                                                        <tr>
                                                            <td>
                                                                {!! Form::select('tag_permissions[@{{index}}][tag_id]', $tags , null , ['class' => 'form-control input-sm']) !!}
                                                            </td>
                                                            @foreach (config('constants.TAG_LEVEL_PERMISSIONS')  as $perm)
                                                                <td><label>
                                                                        <input name="tag_permissions[@{{index}}][{{$perm}}]" type="checkbox" class="iCheck-helper"
                                                                            value="1">
                                                                    </label></td>
                                                            @endforeach
                                                            <td>
                                                                <button onclick="removeRow(this)" class="btn btn-danger btn-xs" title="Remove row"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    </script>
                                                    <script>
                                                        @php
                                                            $groupTagPerm = groupTagsPermissions(optional($user ?? null)->getAllPermissions());
                                                        @endphp
                                                        let rowIndex = 0;

                                                        function addRow() {
                                                            var template = Handlebars.compile($("#permission-row").html());
                                                            var html = template({
                                                                index: rowIndex
                                                            });
                                                            $(html).appendTo("#permission-body");
                                                            registerIcheck();
                                                            rowIndex++;
                                                        }

                                                        function removeRow(elem) {
                                                            $(elem).parents("tr").remove();
                                                        }
                                                        window.onload = function() {
                                                            @foreach ($groupTagPerm as $key => $value)
                                                                addRow();
                                                                $("#permission-body>tr:last-child").find("select[name^='tag_permissions']").val(
                                                                    '{{ $value['tag_id'] }}');
                                                                @foreach ($value['permissions'] as $perm)
                                                                    $("#permission-body>tr:last-child").find("input[name$='[{{ $perm }}]']").attr('checked',
                                                                        'checked');
                                                                @endforeach
                                                            @endforeach
                                                            registerIcheck();
                                                        }
                                                    </script> --}}
                                                    @endcan
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
                    </div>
                </div>

                <div class="card-body py-4">
                    {{-- @include('metronic.users.table') --}}

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th class="min-w-150px">Email</th>
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-100px">Position</th>
                                <th class="min-w-50px">Joined Date</th>
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
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a wire:click="edit_user('{{ $user->id }}')"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal_edit_user_{{ $user->id }}"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Delete</a>
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

{{-- @livewire('ibprandbowtie::bowtie.modal.modal-event', ['bowtie_id'=>$bowtie_id]) --}}
