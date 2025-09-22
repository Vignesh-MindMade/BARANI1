<nav class="nxl-horizontal-nav">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard')}}" class="b-brand">
                <img src="https://p2h.in/barani-home/assets/imgs/logo-light.png" alt="" class="logo logo-lg">
            </a>
        </div>
        <div class="navbar-content">
            <i class="feather-menu nxl-mobile-toggle d-lg-none"></i>
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <!-- Homepage -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Pages</span>
                        {{-- <span class="nxl-arrow"><i class="feather-chevron-down"></i></span> --}}
                    </a>
                    {{-- <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('banner')}}">Banner Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('about-us-company')}}">About Company Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('home-product')}}">Home Product Section</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('home-counts')}}">Counts Section</a></li>
                    </ul> --}}
                </li>
                  <!-- Product Pages -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-box"></i></span>
                        <span class="nxl-mtext">Products</span>
                        {{-- <span class="nxl-arrow"><i class="feather-chevron-down"></i></span> --}}
                    </a>
                    {{-- <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productstextile')}}"><i class="feather-scissors"></i> Textile Page</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productsfood')}}"><i class="feather-shopping-bag"></i> Food Page</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('productsoem')}}"><i class="feather-cpu"></i> OEM Page</a></li>
                    </ul> --}}
                </li>


                <!-- Gallery -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-image"></i></span>
                        <span class="nxl-mtext"> Gallery Section</span>
                    </a>
                </li>
                <!-- Footer -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layout"></i></span>
                        <span class="nxl-mtext">Genral Section</span>
                    </a>
                </li>
                              <!-- Profile -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user"></i></span>
                        <span class="nxl-mtext">Profile Section</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>