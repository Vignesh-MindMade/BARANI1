@extends('layouts_front.app')
@section('contentFront')

    <style>
        .table-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-content table td,
        .table-content table th {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        .hei-300px {
            height: 300px;
        }

        .hei-300px img {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

    </style>
    <style>
/* Only styles from your original code */
.front-images>* {
    display: none;
}

.front-images .current {
    display: block;
}

.slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.slider-images {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slider-images img {
    width: 100%;
    flex-shrink: 0;
}

.slider-pagination {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
}

.slider-pagination .dot {
    width: 10px;
    height: 10px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s;
}

.slider-pagination .dot.active {
    background: rgba(0, 0, 0, 0.9);
}

.slider-pagination .dot:hover {
    background: rgba(0, 0, 0, 0.7);
}
</style>

    @php
        $pc = $page->pressedComponent;
    @endphp

    @if ($pc)
        <div id="smooth-wrapper">
            <div id="smooth-content">
                <main class="main-bg ">
                    <!-- Banner Section -->
                  <header class="page-header-cerv section-padding"
    style="background-image: url('{{ asset('frontend/imgs/submenu/' . $pc->banner_image) }}');
           background-size: cover;
           background-position: center;"
    data-overlay-dark="4">

                        <div class="container pt-100 ontop">
                            <div class="text-center">
                                <h1 class="fz-100">{{ $pc->banner_title ?? 'Welcome' }}</h1>
                                <div class="mt-15 mb-4">
                                    <a href="#">Home</a>
                                    <span class="padding-rl-20">|</span>
                                    <span class="text-white">{{ $pc->banner_title ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="header-project2 section-padding pb-0">
                        <div class="container">
                                  {{-- <div class="col-lg-3">
                                    <div class="down-bro">
                                        @if($product->product_broucher)
                                            <a href="{{ asset('uploads/products/' . $product->product_broucher) }}" target="_blank">Download Brochure</a>
                                        @else
                                            <a href="#" class="disabled">Download Brochure</a>
                                        @endif
                                    </div>
                                </div> --}}
                            <div class="row align-items-end">
                                <div class="col-lg-12">
                                    <div class="full-width ">
                                        <p>{{ $pc->description ?? '' }}</p>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                    </div>

                    <!-- Capabilities Section -->
                    <section class="cap-unit section-padding bg-img pb-0">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $pc->capabilities_title ?? '' }}</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1">{{ $pc->capabilities_subtitle ?? '' }}</h2>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @if (is_array($pc->capabilities_cards) && !empty($pc->capabilities_cards))
                                            @foreach ($pc->capabilities_cards as $card)
                                                @if (!empty($card['title']) || !empty($card['description']))
                                                    <div class="col-md-4">
                                                        <div class="item mb-50">
                                                            <h5 class="mb-15">{{ $card['title'] ?? '' }}</h5>
                                                            <p>{{ $card['description'] ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Industries Section -->
                    <section class="services-dots section-padding sub-bg radius-30 pb-60">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $pc->industries_title ?? '' }}</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1">{{ $pc->industries_subtitle ?? '' }}</h2>
                                </div>
                            </div>

                            <div class="industries-grid ontop">
                                @if (is_array($pc->industries_icons) && !empty($pc->industries_icons))
                                    @php
                                        $industriesNames = is_string($pc->industries_name ?? '')
                                            ? json_decode($pc->industries_name, true) ?? []
                                            : $pc->industries_name ?? [];
                                    @endphp
                                    @foreach ($pc->industries_icons as $index => $icon)
                                        @if ($icon)
                                            <div class="item md-mb50">
                                                <img class="stan-img" src="{{ asset('frontend/imgs/submenu/' . $icon) }}"
                                                    alt="{{ $industriesNames[$index] ?? '' }}">
                                                <h5>{{ $industriesNames[$index] ?? '' }}</h5>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <!--Featured Product-->
                    <section class="work-carsouel section-padding pt-50 pb-50 position-re o-hidden">
                        <div class="container">
                            <div class="sec-head mb-30">
                                
                                <div class="d-flex" style="justify-content: space-between;">
                                <h6 class="sub-title main-color mb-15">Our Products</h6>
                                
     <!--Download brochure button commented-->
       {{--    @if($page->brochure)
            <div class="down-bro mb-2">
       <a href="javascript:void(0)" onclick="document.getElementById('openBrochureForm')?.click();" class="">Download Brochure</a>
            </div>
            @endif --}}
            </div> 

                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1">Featured <span class="fw-200">products</span></h2>

                                    <div class="ml-auto">
                                        <div class="swiper-arrow-control">
                                            <div class="swiper-button-prev">
                                                <span class="ti-arrow-left"></span>
                                            </div>
                                            <div class="swiper-button-next">
                                                <span class="ti-arrow-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-12 o-hidden">
                                    <div class="work-crus work-crus5 out" data-carousel="swiper" data-items="1"
                                        data-loop="false" data-space="30" data-swiper-speed="1000">

                                        <div id="content-carousel-container-unq-w" class="swiper-container"
                                            data-swiper="container">
                                            <div class="swiper-wrapper">
                                @php
                                $bannerTitle = strtolower($pc->banner_title ?? 'welcome');
                                @endphp
                                               @foreach ($Productss as $product)
                                @php
                                    if (!$product->category) continue;
                            
                                    $category = strtolower($product->category->catagory);
                                    $showProduct = false;
                            
                                    // CASE 1: Pressed components and Sub-Assembly
                                    if (str_contains($bannerTitle, 'pressed')) {
                                        $showProduct =
                                            str_contains($category, 'featured') ||
                                            str_contains($category, 'pressed') ||
                                            str_contains($category, 'sub-assembly');
                                    }
                            
                                    // CASE 2: Foundry
                                    elseif (str_contains($bannerTitle, 'foundry')) {
                                        $showProduct =
                                            str_contains($category, 'featured') ||
                                            str_contains($category, 'casting');
                                    }
                            
                                    // CASE 3: Other pages (NO Featured products)
                                    else {
                                        $showProduct =
                                            !str_contains($category, 'featured') &&
                                            str_contains($category, $bannerTitle);
                                    }
                                @endphp

                    @if ($showProduct)
                            <div class="swiper-slide">
                                <div class="item" style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px,
                                                          rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
                    
                                    <div class="img hei-300px">
                                        <img src="{{ $product->first_image
                                            ? asset('uploads/products/' . $product->first_image)
                                            : asset('assets/imgs/placeholder.webp') }}"
                                            alt="{{ $product->product_title }}">
                    
                                        <div class="cont">
                                            <span class="mb-5">{{ $product->category->catagory }}</span>
                                            <h6 class="fz-18">{{ $product->product_title }}</h6>
                                        </div>
                    
                                        <a href="{{ route('product.detail', $product->slug) }}" class="plink"></a>
                                    </div>
                    
                                </div>
                            </div>
                        @endif
                    
                    @endforeach

                                            </div><!-- swiper-wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </section>


                    <!-- Manufacturing / Infrastructure Section -->
                    <section class="skills-img section-padding position-re">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div class="col-lg-4 d-lg-block d-none valign">
                                    {{-- Previous single-image output (kept for reference) --}}
                                    {{--
                                    @if ($pc->manufacturing_capability_image && is_string($pc->manufacturing_capability_image))
                                        <div class="img md-mb50" style="height:100%">
                                            <img src="{{ asset('frontend/imgs/submenu/' . $pc->manufacturing_capability_image) }}"
                                                alt="Manufacturing" class="radius-10" style="height:100%; max-height: 420px;object-fit: fill;" >
                                        </div>
                                    @endif
                                    --}}

                                <div class="images-grp">
                                    <div class="front-images">
                                        <!-- Slider for manufacturing capability images -->

                                        @php
                                            $mcImages = $pc->manufacturing_capability_image ?? [];
                                            if (!is_array($mcImages)) {
                                                $mcImages = $mcImages ? (json_decode($mcImages, true) ?: [$mcImages]) : [];
                                            }
                                            $mcImages = array_values(array_filter($mcImages));
                                        @endphp

                                        @if (!empty($mcImages))
                                            <div class="service-tab-1 current slider-container">
                                                <div class="slider-images">
                                                    @foreach ($mcImages as $img)
                                                        <img src="{{ asset('frontend/imgs/submenu/' . $img) }}" alt="Manufacturing">
                                                    @endforeach
                                                </div>
                                                <div class="slider-pagination">
                                                    @foreach ($mcImages as $index => $img)
                                                        <span class="dot @if($loop->first) active @endif" data-index="{{ $index }}"></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>



                                </div>
                                <div class="col-lg-6 valign">
                                    <div class="content full-width">
                                        <div class="sec-head mb-30">
                                            <h6 class="sub-title main-color mb-15">
                                                {{ $pc->manufacturing_capability_title ?? 'Manufacturing Facility' }}
                                            </h6>
                                           <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                                <h2 class="fw-600 text-u ls1">
                                                    {{ $pc->manufacturing_capability_subtitle ?? '' }}
                                                </h2>
                                            </div> 
                                        </div>
                                        <div class="row justify-content-start">
                                            <div class="col-lg-12">
                                                <div class="text">
                                                    <p>{{ $pc->manufacturing_capability_description ?? '' }}</p>
                                                </div>

                                                @if (is_array($pc->infrastructure_equipments) && !empty($pc->infrastructure_equipments))
                                                    @foreach ($pc->infrastructure_equipments as $equipment)
                                                        @if (!empty($equipment['title']))
                                                            <div class="text mt-30 spec-press">
                                                                <h5>{{ $equipment['title'] ?? '' }}</h5>
                                                                <p><span></span>
                                                                    {{ $equipment['total_area'] ?? '' }}</p>
                                                                <p><span></span>
                                                                    {{ $equipment['production_floor'] ?? '' }}</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Points Section -->
                    @if (!empty($pc->point_section_title) || !empty($pc->point_title))
                        <section class="services-dots section-padding indust-used radius-30 pb-20 pt-0">
                            <div class="container">
                                <div class="sec-head mb-30">
                                    {{-- Section Title --}}
                                    @if (!empty($pc->point_section_title))
                                        <h5 class="sub-title main-color mb-15">
                                            {{ $pc->point_section_title }}
                                        </h5>
                                        <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                                            <!--<h2 class="fw-600">{{ $pc->point_section_title }}</h2>-->
                                        </div>
                                </div>
                    @endif

                    @if (is_array($pc->point_title) && is_array($pc->points))
                        <div class="row xlg-marg ontop ml-10 mr-50">

                            @foreach ($pc->point_title as $index => $title)
                                @php
                                    // Split multiline textarea into bullets
                                    $lines = isset($pc->points[$index])
                                        ? preg_split("/\r\n|\n|\r/", trim($pc->points[$index]))
                                        : [];
                                @endphp

                                @if (!empty($title) || !empty($lines))
                                    <div class="col-12 col-sm-4 col-lg-3">
                                        <div class="item md-mb50">

                                            {{-- Point Title --}}
                                            @if (!empty($title))
                                                <h6>{{ $title }}</h6>
                                            @endif

                                            {{-- Bullet Points --}}
                                            @if (!empty($lines))
                                                <div class="text mt-15">
                                                    <ul class="rest dot-list fz-18">
                                                        @foreach ($lines as $line)
                                                            @if (trim($line) !== '')
                                                                <li class="mb-10">
                                                                    {{ trim($line) }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    @endif

            </div>
            </section>
    @endif
    <!-- Core Processes Section -->
    @if ($pc->core_processes_title)
        <section class="standards-table section-padding pt-50 pb-50 position-re o-hidden">
            <div class="container">
                <div class="sec-head mb-30">
                    <h6 class="sub-title main-color mb-15">{{ $pc->core_processes_title }}</h6>
                    <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                        <h2 class="fw-600 text-u ls1">{{ $pc->core_processes_subtitle ?? '' }}</h2>
                    </div>
                </div>
                <div class="row justify-content-around">
                    @if ($pc->core_processes_table)
                        <div class="col-12">
                            {!! $pc->core_processes_table !!}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Quality Inspection Section -->
    @if ($pc->quality_inspection_title)
        <section class="standards-table section-padding pt-50 pb-50 position-re o-hidden">
            <div class="container">
                <div class="sec-head mb-30">
                    <h6 class="sub-title main-color mb-15">{{ $pc->quality_inspection_title }}</h6>
                    <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                        <h2 class="fw-600 text-u ls1">{{ $pc->quality_inspection_subtitle ?? '' }}</h2>
                    </div>
                </div>
                <div class="row col-12 col-lg-8">
                    @if ($pc->quality_inspection_table)
                        <div class="table-content">
                            {!! $pc->quality_inspection_table !!}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif



    <!-- Technology Range Section -->
    @if ($pc->technology_range_title)
        <section class="blog-list-crev section-padding sub-bg">
            <div class="container">
                <div class="sec-head mb-30">
                    <h6 class="sub-title main-color mb-15">{{ $pc->technology_range_title }}</h6>
                    <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                        <h2 class="fw-600">{{ $pc->technology_range_subtitle ?? '' }}</h2>
                    </div>
                </div>
            </div>

            <div class="tech-auto container">
                @if (is_array($pc->technology_range_cards) && !empty($pc->technology_range_cards))
                    @foreach ($pc->technology_range_cards as $index => $card)
                        @if (!empty($card['title']) || !empty($card['description']))
                            @php
                                $position = $index + 1;
                                $delay = 0.1 + $index * 0.2;

                                $subBg2 = $position % 4 == 1 || $position % 4 == 0 ? 'sub-bg2' : '';
                            @endphp
                            <div class="item {{ $subBg2 }} wow fadeInUp position-relative"
                                data-wow-delay=".{{ intval($delay * 10) }}s">
                                @if (isset($card['image']) && $card['image'])
                                    <div class="background bg-img valign text-center position-absolute w-100 h-100"
                                        style="top: 0; left: 0; z-index: 1; background-image: url('{{ asset('frontend/imgs/submenu/' . $card['image']) }}'); background-size: cover; background-position: center;"
                                        data-overlay-dark="4">
                                    </div>
                                @endif
                                <div class="row position-relative" style="z-index: 2;">
                                    <div class="col-lg-12">
                                        <div class="cont">
                                            <h5 class="mb-10 underline hover-white">{{ $card['title'] ?? '' }}</h5>
                                            <p>{{ $card['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    @endif

    <!-- Points Section -->



    </main>
    </div>
    </div>
@else
    <div class="container py-5">
        <div class="alert alert-info text-center">
            <p>No pressed component data available for this page.</p>
        </div>
    </div>
    @endif
    
    
<!-- { {--<script>-->

<!--document.addEventListener('DOMContentLoaded', function() {-->
    <!--Service Tab switching (using custom logic, not Bootstrap)-->
<!--    const serviceTabLinks = document.querySelectorAll('.item-link');-->
<!--    const serviceTabContents = document.querySelectorAll('.serv-tab-cont .tab-content');-->
<!--    const serviceTabImages = document.querySelectorAll('.front-images > *');-->

<!--    serviceTabLinks.forEach(link => {-->
<!--        link.addEventListener('click', function() {-->
<!--            serviceTabLinks.forEach(item => item.classList.remove('current'));-->
<!--            serviceTabContents.forEach(content => content.classList.remove('current'));-->
<!--            serviceTabImages.forEach(image => image.classList.remove('current'));-->

<!--            this.classList.add('current');-->
<!--            const tabId = this.getAttribute('data-service-tab');-->
<!--            document.getElementById(tabId).classList.add('current');-->
<!--            const activeImage = document.querySelector(`.front-images .${tabId}`);-->
<!--            if (activeImage) {-->
<!--                activeImage.classList.add('current');-->
<!--            }-->
<!--        });-->
<!--    });-->

    <!--// Slider for all service tabs-->
<!--    const sliders = document.querySelectorAll('.slider-container');-->
<!--    sliders.forEach(slider => {-->
<!--        const sliderImages = slider.querySelector('.slider-images');-->
<!--        const dots = slider.querySelectorAll('.dot');-->
<!--        let currentIndex = 0;-->
<!--        const totalImages = sliderImages.querySelectorAll('img').length;-->

<!--        function updateSlider() {-->
<!--            sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;-->
<!--            dots.forEach(dot => dot.classList.remove('active'));-->
<!--            dots[currentIndex].classList.add('active');-->
<!--        }-->

<!--        dots.forEach(dot => {-->
<!--            dot.addEventListener('click', () => {-->
<!--                currentIndex = parseInt(dot.getAttribute('data-index'));-->
<!--                updateSlider();-->
<!--            });-->
<!--        });-->

        <!--// Auto-slide every 5 seconds for the active tab-->
<!--        setInterval(() => {-->
<!--            if (slider.classList.contains('current')) {-->
<!--                currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;-->
<!--                updateSlider();-->
<!--            }-->
<!--        }, 5000);-->
<!--    });-->
<!--});-->

        
<!--    </script> --}}-->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.slider-container').forEach(function(slider) {
            const sliderImages = slider.querySelector('.slider-images');
            if (!sliderImages) return;
            const images = sliderImages.querySelectorAll('img');
            if (images.length === 0) return;
            const dots = Array.from(slider.querySelectorAll('.slider-pagination .dot'));
            let currentIndex = 0;

            function update() {
                sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;
                dots.forEach(d => d.classList.remove('active'));
                if (dots[currentIndex]) dots[currentIndex].classList.add('active');
            }

            dots.forEach(dot => dot.addEventListener('click', function() {
                currentIndex = parseInt(this.dataset.index) || 0;
                update();
            }));

            // Auto-slide
            setInterval(function() {
                currentIndex = (currentIndex + 1) % images.length;
                update();
            }, 4000);

            // Initial layout
            update();
        });
    });
    </script>

@endsection

