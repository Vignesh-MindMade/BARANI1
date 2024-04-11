<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo.png" class="logo-icon" alt="logo icon" style="width:143px">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li><a href="{{ url('index') }}"><i class="bx bx-right-arrow-alt"></i>eCommerce</a></li>
                <li><a href="{{ url('dashboard-alternate') }}"><i class="bx bx-right-arrow-alt"></i>Analytics</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Home Page Settings</div>
            </a>
            <ul>
                <li><a href="{{ route('topbar.index') }}"><i class="bx bx-right-arrow-alt"></i>Topbar</a></li>
                <li><a href="{{ route('menus.index') }}"><i class="bx bx-right-arrow-alt"></i>MainMenu</a></li>
                <li><a href="{{ route('menus.submenu') }}"><i class="bx bx-right-arrow-alt"></i>Submenu</a></li>
                <li><a href="{{ route('banner.index') }}"><i class="bx bx-right-arrow-alt"></i>Banners</a></li>
                <li><a href="{{ route('newsevents.index') }}"><i class="bx bx-right-arrow-alt"></i>News & Events</a></li>
                <li><a href="{{ route('latestvideos.index') }}"><i class="bx bx-right-arrow-alt"></i>Our Latest Videos</a></li>
                <li><a href="{{ route('testimonial.index') }}"><i class="bx bx-right-arrow-alt"></i>Testimonials</a></li>
                <li><a href="{{ route('banner.bgbanner') }}"><i class="bx bx-right-arrow-alt"></i>BackGround Banner</a></li>
                <li><a href="{{ route('message.index') }}"><i class="bx bx-right-arrow-alt"></i>Principal Message</a></li>
            </ul>
        </li>
    </ul>
</div>
