<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="{{ asset('admins/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a @class([
                    'nav-link text-white',
                    'active bg-gradient-primary' => request()->routeIs('admin.dashboard'),
                ]) href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link text-white',
                    'active bg-gradient-primary' => request()->routeIs('admin.roles.*'),
                ]) href="{{ route('admin.roles.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons opacity-10">
                            supervisor_account
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link text-white',
                    'active bg-gradient-primary' => request()->routeIs('admin.users.*'),
                ]) href="{{ route('admin.users.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons opacity-10">
                            manage_accounts
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="./pages/rtl.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons opacity-10">
                            format_list_bulleted
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="./pages/virtual-reality.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                    </div>
                    <span class="nav-link-text ms-1">Product</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
