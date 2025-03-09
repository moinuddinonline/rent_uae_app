<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('assets/images/side_logo.png') }}" class="logo-img" alt="side_logo">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Finigenie</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
        <ul class="metismenu" id="sidenav">
            <li class="{{ Route::is('dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon">
                        <i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            @permission('access')
                <li class="menu-label">Access Controls</li>
                @permission('permission_*')
                    <li class="{{ Route::is('permission.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('permission.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">check_box</i>
                            </div>
                            <div class="menu-title">Permissions</div>
                        </a>
                    </li>
                @endpermission
                @permission('role_*')
                    <li class="{{ Route::is('role.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('role.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">settings_accessibility</i>
                            </div>
                            <div class="menu-title">Roles</div>
                        </a>
                    </li>
                @endpermission
                @permission('user_*')
                    <li class="{{ Route::is('user.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('user.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="menu-title">Users</div>
                        </a>
                    </li>
                @endpermission
            @endpermission
            @permission('rent_module')
                <li class="menu-label">Rent</li>
                {{-- Rent Type Actions --}}
                @permission('rent_type_*')
                    <li class="{{ Route::is('rent_types.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('rent_types.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">list</i>
                            </div>
                            <div class="menu-title">Rent Types</div>
                        </a>
                    </li>
                @endpermission
                {{-- Rent Vendor Actions --}}

                @permission('rent_*')
                    <li class="{{ Route::is('rents.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('rents.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">receipt_long</i>
                            </div>
                            <div class="menu-title">Rents</div>
                        </a>
                    </li>
                @endpermission
                @permission('rent_vendor_*')
                    <li class="{{ Route::is('rent_vendors.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('rent_vendors.list') }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">hvac</i>
                            </div>
                            <div class="menu-title">Rent Vendors</div>
                        </a>
                    </li>
                @endpermission
            @endpermission
        </ul>
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
            <a href="javascript:;" class="footer-icon dark-mode-icon">
                <i class="material-icons-outlined">dark_mode</i>
            </a>
        </div>
    </div>
</aside>
