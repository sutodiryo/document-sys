    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" src="{{ asset('metronic_8.2.6/media/logos/default-dark.svg') }}"
                    class="h-25px app-sidebar-logo-default" />
                <img alt="Logo" src="{{ asset('metronic_8.2.6/media/logos/default-small.svg') }}"
                    class="h-20px app-sidebar-logo-minimize" />
            </a>
            <div id="kt_app_sidebar_toggle"
                class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>

        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                    data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                    data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                    data-kt-scroll-save-state="true">
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                        id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        <?php
                        $parent_folders = App\Models\Folder::whereNull('parent_id')->orderBy('created_at')->get();

                        if (Request::is('admin/folder*')) {
                            $first_ancestor = App\Models\Folder::find(request()->uuid)
                                ->joinAncestors()
                                ->last()->id;
                        } elseif (Request::is('admin/file*')) {
                            $q = App\Models\File::find(request()->uuid)
                                ->first();
                            $first_ancestor = App\Models\Folder::find($q->folder_id)
                                ->joinAncestors()
                                ->last()->id;
                        } else {
                            $first_ancestor = null;
                        }
                        ?>

                        @if ($parent_folders)
                            @foreach ($parent_folders as $p)
                                <div class="menu-item">
                                    <a class="menu-link {{ (Request::is('admin/folder*') || Request::is('admin/file*')) && $p->id == $first_ancestor ? 'active' : '' }}"
                                        href="{!! route('folder.index') !!}?uuid={{ $p->id }}">
                                        <span class="menu-title">{{ $p->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        @endif

                        <div class="menu-item">
                            <a class="menu-link" data-bs-toggle="modal" data-bs-target="#add_new_section">
                                <span class="menu-icon">
                                    <i class="fas fa-plus-circle fs-2">
                                    </i>
                                </span>
                                <span class="menu-title">Create new section</span>
                            </a>
                        </div>

                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Admin tools</span>
                            </div>
                        </div>
                        {{-- <hr> --}}

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                                href="{!! route('dashboard') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-flag fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboards</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/account/users*') ? 'active' : '' }}"
                                href="{!! route('account.users') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-user fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Manage Users</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/account/user-groups*') ? 'active' : '' }}"
                                href="{!! route('account.user.group') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-users fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Manage User Groups</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/account/access-overview*') ? 'active' : '' }}"
                                href="{!! route('account.access.overview') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-link fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Access Overview</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/meta*') ? 'active' : '' }}"
                                href="{!! route('meta.index') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-tag fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Metadata</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/audit*') ? 'active' : '' }}"
                                href="{!! route('audit-log') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-file fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Audit Log</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/recycle-bin*') ? 'active' : '' }}"
                                href="{!! route('recycle-bin') !!}">
                                <span class="menu-icon">
                                    <i class="fas fa-trash fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Recycle Bin</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="add_new_section" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">New Section</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                </div>

                <form class="py-4 d-flex flex-column gap-5" action="{{ route('menu.section.store') }}"
                    method="POST" data-remote="true">
                    @csrf {{ csrf_field() }}
                    <input type="hidden" name="curent_link"
                        value="{{ Request::url() . '?uuid=' . request()->uuid }}" />

                    <div class="modal-body">
                        <div class="form-group">
                            <input onkeyup="CheckName()" type="text" class="form-control" name="section_name"
                                id="section_name" placeholder="Section Name" autocomplete="Folder"
                                value="{{ old('section_name') }}" required>
                            <div class="error text-danger" id="error_section_name"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit_section_name" class="btn btn-primary"
                            disabled>Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function CheckName() {
            var name = document.getElementById('section_name').value;

            fetch("{{ route('menu.section.check_name') }}?section_name=" + name, {
                method: 'GET',

            }).then((response) => {
                var status = response.status;

                if (status == 200) {
                    document.getElementById('submit_section_name').disabled = false;
                    document.getElementById('error_section_name').innerHTML = "";
                } else {
                    document.getElementById('error_section_name').innerHTML = "This name is already taken";
                }
            });
        }
    </script>
