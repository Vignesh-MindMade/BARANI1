   
   <style>
   
   .search-icon {
    position: absolute;
    right: 10px;
    top: 8px;
    cursor: pointer;
    font-size: 20px;
    z-index: 9999;
}

.search-icon span {
    display: none; /* initially hide */
}

.search-icon .open-search {
    display: inline-block;
}

.search-form.active .open-search {
    display: none;
}

.search-form.active .close-search {
    display: inline-block;
}
</style>
   <div class="cursor1"></div> <!--if need cursor pointr remove 1 and in script.js uncomment line 745 -->
   <div class="progress-wrap cursor-pointer">
    </div>
    
    <div class="loader-wrap">
        <div class="loader-wrap-heading">
            <div class="load-text">
                <a class="logo icon-img-200" href="index.php">
                    <img src="{{ asset('assets/frontend/imgs/logo-light.png') }}" alt="logo">

                </a>
            </div>
        </div>
    </div>
    <section class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-12 col-lg-8 d-none d-lg-block">
                    <ul class="topbar-menu">
                        <!--<li class="navlink"><a href="{{ route('download_page.index') }}">Downloads Page</a></li>-->
                        <li class="navlink"><a href="{{ route('carrers.index') }}">Careers</a></li>
                        <li class="navlink"><a href="{{ route('supplier.index') }}">Supplier</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <nav class="navbar navbar-expand-lg  change blur">
        <div class="container">
            <a class="logo icon-img-100" href="{{ url('/') }}">
                <img src="{{ asset('assets/frontend/imgs/logo-light.png') }}" alt="logo">
            </a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('/') }}" role="button" aria-haspopup="true"
                            aria-expanded="false"><span class="rolling-text">Home</span></a>

                    </li>
                     <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false"><span class="rolling-text">Barani
                               Group</span></a>
                       <div class="dropdown-menu flex-column">
                           <a class="dropdown-item" href="{{ route('aboutus.index') }}">About Us</a>
                           @foreach ($BaraniSubmenus as $submenu)
                               @php $firstPage = $submenu->pages->first(); @endphp
                               @if ($firstPage && ($firstPage->template ?? '') === 'template2')
                                   <a class="dropdown-item"
                                       href="{{ route('frontend.groupsubmenu.page.view', $firstPage->id) }}">
                                       {{ $submenu->submenu_name }}
                                   </a>
                               @else
                                   <a class="dropdown-item"
                                       href="{{ route('frontend.groupsubmenu.view', $submenu->id) }}">
                                       {{ $submenu->submenu_name }}
                                   </a>
                               @endif
                           @endforeach
                         
                            <a class="dropdown-item" href="{{ url('/jsr') }}">{{ $JSRMenu->menu_name ?? 'Jaishriram Engineering College' }}</a>
                       </div>
                   </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="rolling-text">Products</span>
                        </a>

                        <ul class="dropdown-menu flex-column">

                            @foreach ($ProductCatagorys as $category)
                                <li class="dropdown-item">
                                    <a
                                        href="{{ $category->slug ? route('archive.page', $category->slug) : 'javascript:void(0)' }}">
                                        {{ $category->catagory }}
                                        <i class="fas fa-angle-right icon-arrow"></i>
                                    </a>

                                    <ul class="dropdown-side">
                                        @forelse ($category->products as $product)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('product.detail', $product->slug) }}">
                                                    {{ $product->product_title }}
                                                </a>
                                            </li>
                                        @empty
                                            <li>
                                                <span class="dropdown-item text-muted">No products available</span>
                                            </li>
                                        @endforelse
                                    </ul>
                                </li>
                            @endforeach



                        </ul>
                    </li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="capabilitiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="rolling-text">Capabilities</span>
    </a>

    <ul class="dropdown-menu flex-column"  aria-labelledby="capabilitiesDropdown">
        @foreach ($CapabilitiesSubmenus as $submenu)
            @php $firstPage = $submenu->pages->first(); @endphp

            @if ($firstPage)
                <li>
                    <a class="dropdown-item"
                       href="{{ route('capabilities.page', $firstPage->slug) }}">
                        {{ $submenu->menu_name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</li>
                    <li class="nav-item">
                        <a class="nav-link"href="{{route('sustainability.index')}}"><span class="rolling-text">Sustainability
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactus.index') }}"><span class="rolling-text">Contact Us
                            </span></a>
                    </li>

                </ul>
            </div>
<form action="{{ route('product.search') }}" method="GET">
    <div class="search-form" style="position: relative;">

        <div class="form-group">
            <input type="text" id="searchInput" name="search" placeholder="Search" autocomplete="off" required>
            <button type="submit"><span class="pe-7s-search"></span></button>
        </div>

        <!-- Suggestion Box -->
        <div id="suggestion-box" 
            style="position:absolute; top:40px; left:0; width:100%; background:#fff; border:1px solid #ccc; z-index:999; display:none;">
        </div>

        <!-- FIX: Search Icons must be inside -->
        <div class="search-icon">
            <span class="pe-7s-search open-search"></span>
            <span class="pe-7s-close close-search"></span>
        </div>

    </div>
</form>

 <div class="topnav d-flex d-lg-none">
                    
                    
                    <form action="{{ route('product.search') }}" method="GET">
                        <div class="search-form" style="position: relative;">
                    
                            <div class="form-group">
                                <input type="text" id="searchInput" name="search" placeholder="Search" autocomplete="off" required>
                                <button type="submit"><span class="pe-7s-search"></span></button>
                            </div>
                    
                            <!-- Suggestion Box -->
                            <div id="suggestion-box" 
                                style="position:absolute; top:40px; left:0; width:100%; background:#fff; border:1px solid #ccc; z-index:999; display:none;">
                            </div>
                    
                            <!-- FIX: Search Icons must be inside -->
                            <div class="search-icon">
                                <span class="pe-7s-search open-search"></span>
                                <span class="pe-7s-close close-search"></span>
                            </div>
                    
                        </div>
                    </form>
                    <div class="menu-icon cursor-pointer">
                        <span class="icon ti-align-right"></span>
                    </div>
                </div>

            </div>
            
            

      

        </div>
    </nav>
    {{--Mobile Menu nav --}}
    <div class="hamenu">
            <div class="logo icon-img-100">
               
            </div>
            <div class="close-menu cursor-pointer ti-close"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="menu-text">
                            <div class="text">
                                <h2>Menu</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="menu-links">
                            <ul class="main-menu rest">
                                <li>
                                    <div class="o-hidden">
                                        <a href="{{ url('/') }}" class="link"><span class="fill-text" data-text="Home">Home</span></a>
                                    </div>
                                </li>
                                
                                <!-- Barani Group -->
                                <li>
                                    <div class="o-hidden">
                                        <div class="link cursor-pointer dmenu">
                                            <span class="fill-text" data-text="Barani Group">Barani Group</span> <i></i>
                                        </div>
                                    </div>
                                
                                    <div class="sub-menu">
                                        <ul>
                                            <li>
                                                <a href="{{ route('aboutus.index') }}" class="sub-link">About Us</a>
                                            </li>
                                <li>
                                              @foreach ($BaraniSubmenus as $submenu)
                               @php $firstPage = $submenu->pages->first(); @endphp
                               @if ($firstPage && ($firstPage->template ?? '') === 'template2')
                                   <a class="sub-link"
                                       href="{{ route('frontend.groupsubmenu.page.view', $firstPage->id) }}">
                                       {{ $submenu->submenu_name }}
                                   </a>
                               @else
                                   <a class="sub-link"
                                       href="{{ route('frontend.groupsubmenu.view', $submenu->id) }}">
                                       {{ $submenu->submenu_name }}
                                   </a>
                               @endif
                           @endforeach
                        </li>
                                
                                            <li>
                                                <a href="{{ url('/jsr') }}" class="sub-link">{{ $JSRMenu->menu_name ?? 'Jaishriram Engineering College' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                                <!-- Products -->
                                <li>
                                    <div class="o-hidden">
                                        <div class="link cursor-pointer dmenu">
                                            <span class="fill-text" data-text="Products">Products</span> <i></i>
                                        </div>
                                    </div>
                                
                                    <div class="sub-menu no-bord">
                                        <ul>
                                            @foreach ($ProductCatagorys as $category)
                                            <li>
                                                <div class="o-hidden">
                                                    <div class="link cursor-pointer sub-dmenu">
                                                {{--this is comment add this in href: {{ $category->slug ? route('archive.page', $category->slug) : 'javascript:void(0)' }} --}}
                                                         
                                            <span data-text="{{ $category->catagory }}"><a href="{{ $category->slug ? route('archive.page', $category->slug) : 'javascript:void(0)' }}" class="link blink">{{ $category->catagory }}</a></span>
                                        
                                                        <i></i>
                                                    </div>
                                                </div>
                                
                                                <div class="sub-menu2">
                                                    <ul>
                                                        @forelse ($category->products as $product)
                                                        <li>
                                                            <a href="{{ route('product.detail', $product->slug) }}" class="sub-link">
                                                                {{ $product->product_title }}
                                                            </a>
                                                        </li>
                                                        @empty
                                                        <li>
                                                            <span class="sub-link text-muted">No products available</span>
                                                        </li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                
                                
                                
                                
                                
                                <!-- Capabilities -->
                          
<li>
    <div class="o-hidden">
        <div class="link cursor-pointer dmenu">
            <span class="fill-text" data-text="Capabilities">Capabilities</span>
            <i></i>
        </div>
    </div>

    <div class="sub-menu">
        <ul>
            @forelse ($CapabilitiesSubmenus as $submenu)
                @php
                    $firstPage = $submenu->pages->first();
                @endphp

                <li>
                    @if ($firstPage)
                        <a class="sub-link"
                           href="{{ route('capabilities.page', $firstPage->slug) }}">
                            {{ $submenu->menu_name }}
                        </a>
                    @else
                        <!-- Fallback when no pages exist -->
                        <a class="sub-link disabled" href="#">
                            {{ $submenu->submenu_name }} 
                            <small>(no pages yet)</small>
                        </a>
                    @endif
                </li>
            @empty
                <!-- Optional: show message when no submenus at all -->
                <li><span class="sub-link disabled">No capabilities available</span></li>
            @endforelse
        </ul>
    </div>
</li>
                                <!-- Sustainability -->
                                <li>
                                    <div class="o-hidden">
                                        <a href="{{ route('sustainability.index') }}" class="link">
                                            <span class="fill-text" data-text="Sustainability">Sustainability</span>
                                        </a>
                                    </div>
                                </li>
                                
                                <!-- Contact Us -->
                                <li>
                                    <div class="o-hidden">
                                        <a href="{{ route('contactus.index') }}" class="link">
                                            <span class="fill-text" data-text="Contact Us">Contact Us</span>
                                        </a>
                                    </div>
                                </li>
                                <!--<li>-->
                                <!--    <div class="o-hidden">-->
                                <!--        <a href="{{ route('download_page.index') }}" class="link">-->
                                <!--            <span class="fill-text" data-text="Downloads Page">Downloads Page</span>-->
                                <!--        </a>-->
                                        
                                        
                                <!--    </div>-->
                                <!--</li>-->
                                <li>
                                    <div class="o-hidden">
                                        <a href="{{ route('carrers.index') }}" class="link">
                                            <span class="fill-text" data-text="Careers">Careers</span>
                                        </a>
                                    </div>
                                    
                                    
                                </li>
                                <li>
                                    <div class="o-hidden">
                                        <a href="{{ route('supplier.index') }}" class="link">
                                            <span class="fill-text" data-text="Supplier">Supplier</span>
                                        </a>
                                    </div>
                                    
                                    
                                </li>

                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let query = this.value;

    if (query.length < 2) {
        document.getElementById('suggestion-box').style.display = 'none';
        return;
    }

    fetch(`{{ route('product.suggestions') }}?query=` + query)
        .then(response => response.json())
        .then(data => {
            let suggestionBox = document.getElementById('suggestion-box');
            suggestionBox.innerHTML = '';

            if (data.length === 0) {
                suggestionBox.style.display = 'none';
                return;
            }

            // Build suggestion list
            data.forEach(item => {
                let div = document.createElement('div');
                div.style.padding = '8px';
                div.style.cursor = 'pointer';
                div.style.borderBottom = "1px solid #eee";

                div.innerHTML = item.product_title;

                // On click -> redirect to product
                div.onclick = function () {
                    window.location.href = "product/detail/" + item.slug;
                };

                suggestionBox.appendChild(div);
            });

            suggestionBox.style.display = 'block';
        });
});

// Hide suggestion box on click outside
document.addEventListener('click', function (e) {
    if (!document.querySelector('.search-form').contains(e.target)) {
        document.getElementById('suggestion-box').style.display = 'none';
    }
});
</script>
<script>
document.querySelector('.open-search').addEventListener('click', function() {
    document.querySelector('.search-form').classList.add('active');
    document.getElementById('searchInput').focus();
});

document.querySelector('.close-search').addEventListener('click', function() {
    document.querySelector('.search-form').classList.remove('active');
});
</script>

<script>
document.addEventListener('keydown', function (e) {
    if (e.ctrlKey && (
        e.key === '+' ||
        e.key === '-' ||
        e.key === '=' ||
        e.key === '0'
    )) {
        e.preventDefault();
    }
});
 
document.addEventListener('wheel', function (e) {
    if (e.ctrlKey) {
        e.preventDefault();
    }
}, { passive: false });
</script>
