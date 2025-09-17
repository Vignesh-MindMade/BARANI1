<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard')}}" class="b-brand">
                <img src="https://p2h.in/vetal/assets/frontend/images/logo/vita.png" style="    width: 70%;
    margin: 1px 18px;" alt="" class="logo logo-lg">
                <img src="https://p2h.in/vetal/assets/frontend/images/logo/vita.png" alt="" class="logo logo-sm">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>

                <!-- Homepage -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Homepage</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('banner')}}">Banner Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('about-us-company')}}">About Company Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('home-product')}}">Home Product Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('home-counts')}}">Counts Section</a></li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('profile')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user"></i></span>
                        <span class="nxl-mtext">Profile Section</span>
                    </a>
                </li>

                <!-- Gallery -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('gallery') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-image"></i></span>
                        <span class="nxl-mtext">Gallery Section</span>
                    </a>
                </li>

                <!-- Footer -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.footer')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layout"></i></span>
                        <span class="nxl-mtext">Footer Section</span>
                    </a>
                </li>

                <!-- Product Pages -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-box"></i></span>
                        <span class="nxl-mtext">Product Pages</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productstextile')}}"><i class="feather-scissors"></i> Textile Page</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productsfood')}}"><i class="feather-shopping-bag"></i> Food Page</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productsoem')}}"><i class="feather-cpu"></i> OEM Page</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
