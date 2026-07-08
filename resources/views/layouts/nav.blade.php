<style>
    .sidebar-wrapper {
        color: #ffffff;
        background-color: #1e3556;
    }
    .sidebar-wrapper a {
        color: white;
    }
    .sidebar-wrapper .menu-title {
        color: white;
    }
    .sidebar-wrapper .parent-icon i {
        color: white;
    }
    .sidebar-wrapper .metismenu ul a i {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.95rem;
        margin-right: 6px;
    }
</style>

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="ml-1r">
            <img src="{{ asset('assets/frontend/images/logo/logo-light.png') }}" class="logo-icon" alt="logo icon">
        </div>
    </div>
    <ul class="metismenu mt-15 primary-menu" id="menu">

        <li>
            <a href="{{ route('dashboard') }}">
                <div class="d-c-c-r">
                    <div class="parent-icon"><i class='bx bxs-dashboard'></i></div>
                    <div class="menu-title">Dashboard</div>
                </div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="d-c-c-r">
                    <div class="parent-icon"><i class='bx bx-layout'></i></div>
                    <div class="menu-title">Topbar Settings</div>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('topbar.index') }}"><i class='bx bx-download'></i>Download Page</a></li>
                <li><a href="{{ route('career.index') }}"><i class='bx bx-briefcase'></i>Career Page</a></li>
                <li><a href="{{ route('supplier_space.index') }}"><i class='bx bx-store'></i>Supplier Page</a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('subpage.view') }}">
                <div class="d-c-c-r">
                    <div class="parent-icon"><i class='bx bxs-file-blank'></i></div>
                    <div class="menu-title">Pages</div>
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('product_catagory.index') }}">
                <div class="d-c-c-r">
                    <div class="parent-icon"><i class='bx bxs-box'></i></div>
                    <div class="menu-title">Product</div>
                </div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="d-c-c-r">
                    <div class="parent-icon"><i class='bx bxs-wrench'></i></div>
                    <div class="menu-title">General Settings</div>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('pages.footer') }}"><i class='bx bx-layout'></i>Footer</a></li>
            </ul>
        </li>

    </ul>
</div>
