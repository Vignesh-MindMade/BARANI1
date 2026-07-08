@extends('layouts_front.app')
@section('contentFront')

{{-- HOME SECTION PAGE --}}

<style>
    .align-flex-start{
        align-items: flex-start;
    }
    .w-100{
        width:100%;
    }
</style>

<header class="slider slider-prlx">
    <div class="swiper-container parallax-slider">
        <div class="swiper-wrapper">

            @foreach($circularsTests->sortBy('sort_id') as $circularsTest) 
                           <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="bg-img valign" data-overlay-dark="4">
                    <video autoplay muted loop playsinline class="bg-video" poster="{{ asset('images/' . $circularsTest->catagory_image) }}">
                        <source src="{{ asset('images/' . $circularsTest->catagory_image) }}" type="video/mp4">
                    </video>
                    <div class="container">
                        <div class="caption text-center">
                            <h2 class="mb-30" data-swiper-parallax="-2000">{{ $circularsTest->title }}</h2>
                            <h1><span data-swiper-parallax="-1000">{{ $circularsTest->span_title }}</span></h1>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
    </div>

    <div class="pagination-prog-bar">
        <div class="swiper-pagination swiper-pagination-progressbar"></div>
    </div>
</header>

<section class="services-tab section-padding">
    <div class="container">
        <div class="row lg-marg" id="tabs">
           
            <div class="col-lg-5 d-none d-lg-block valign">
                <div class="images-grp">
                    <div class="front-images">
                        @foreach($videos->sortBy('sort_id') as $index => $video)
                        <!-- Slider for tabs-{{ $index + 1 }} -->
                        <div class="tab-{{ $index + 1 }} {{ $index == 0 ? 'current' : '' }} slider-container">
                            <div class="slider-images">
                                <img src="{{ asset('images/' .$video->image2)}}" alt="">
                            </div>
                            <!--<div class="slider-pagination">-->  <!-- remove pagination -->
                            <!--    <span class="dot active" data-index="0"></span>-->
                            <!--    <span class="dot" data-index="1"></span>-->
                            <!--    <span class="dot" data-index="2"></span>-->
                            <!--</div>-->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-7  d-block valign align-flex-start">  <!-- align-flex-start -->
                <div class="serv-tab-link tab-links full-width">
                    <div class="sec-head mb-20">
                        <h6 class="sub-title mb-15">WELCOME TO</h6>
                        <h2>BARANI GROUP</h2>
                        <div class="text mb-30 mt-20">
                            <p>Our three specialised units is hub of innovation, equipped with
                                cutting-edge technology to meet unique customer requirements.</p>
                        </div>
                    </div>
                    
                    <!-- MOBILE STACK (NO TABS) -->
<div class="mobile-services d-block d-lg-none">

    @foreach($videos->sortBy('sort_id') as $video)
        <div class="mobile-item mb-40">
            

            <h3 class="mb-15">{{ $video->title }}</h3>
            
            <div class="img mb-20">
                <img src="{{ asset('images/' .$video->image2)}}" class="img-fluid rounded" alt="">
            </div>

            <p class="mb-15">{{ $video->description }}</p>

            <a href="{{ $video->link }}">
                <span>Read More</span>
            </a>
        </div>
    @endforeach

</div>

                    
                    <!--<div class="images-grp d-block d-lg-none">-->
                    <!--    <div class="front-images">-->
                    <!--        @foreach($videos->sortBy('sort_id') as $index => $video)-->
                            <!-- Slider for tabs-{{ $index + 1 }} -->
                    <!--        <div class="tab-{{ $index + 1 }} {{ $index == 0 ? 'current' : '' }} slider-container">-->
                    <!--            <div class="slider-images">-->
                    <!--                <img src="{{ asset('images/' .$video->image2)}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="slider-pagination">-->
                    <!--                <span class="dot active" data-index="0"></span>-->
                    <!--                <span class="dot" data-index="1"></span>-->
                    <!--                <span class="dot" data-index="2"></span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        @endforeach-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="row justify-content-start d-none d-lg-flex">
                        <div class="col-lg-12">
                            <ul class="rest tab-units">
                                @foreach($videos->sortBy('sort_id') as $index => $video)
                                <li class="item-link {{ $index == 0 ? 'current' : '' }}" data-tab="tabs-{{ $index + 1 }}">
                                    <h3>{{ $video->title }}</h3>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="serv-tab-cont md-mb80 d-none d-lg-block">
                        @foreach($videos->sortBy('sort_id') as $index => $video)
                        <div class="tab-content {{ $index == 0 ? 'current' : '' }}" id="tabs-{{ $index + 1 }}">
                            <div class="item">
                                <div class="cont">
                                    <div class="text">
                                        <p>{{ $video->description }}</p>
                                    </div>
                                    <a href="{{ $video->link }}" class="mt-30">
                                        <span>Read More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabLinks = document.querySelectorAll('.item-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const tabImages = document.querySelectorAll('.front-images > *');

    tabLinks.forEach(link => {
        link.addEventListener('click', function() {
            tabLinks.forEach(item => item.classList.remove('current'));
            tabContents.forEach(content => content.classList.remove('current'));
            tabImages.forEach(image => image.classList.remove('current'));

            this.classList.add('current');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('current');
            const activeImage = document.querySelector(
                `.front-images .tab-${tabId.split('-')[1]}`);
            if (activeImage) {
                activeImage.classList.add('current');
            }
        });
    });

    // Slider for all tabs
    const sliders = document.querySelectorAll('.slider-container');
    sliders.forEach(slider => {
        const sliderImages = slider.querySelector('.slider-images');
        const dots = slider.querySelectorAll('.dot');
        let currentIndex = 0;
        const totalImages = sliderImages.querySelectorAll('img').length;

     function updateSlider() {

    if (!sliderImages || dots.length === 0) return;

    sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;

    dots.forEach(dot => dot.classList.remove('active'));

    if (dots[currentIndex]) {
        dots[currentIndex].classList.add('active');
    }
}

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentIndex = parseInt(dot.getAttribute('data-index'));
                updateSlider();
            });
        });

        // Auto-slide every 5 seconds for the active tab
        setInterval(() => {
            if (slider.classList.contains('current')) {
                currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
                updateSlider();
            }
        }, 5000);
    });
});
</script>

<style>
    .services .item-box.home-our-products{
        clip-path: unset;
    }
    .services .item-box.home-our-products .icon img{
        height:140px;
    }
    
    .services .item-box .icon{
        width:100%;
    }
    
</style>


<section class="page-intro section-padding">
    <div class="container">
        <div class="row">
            <div class="sec-head mb-20">
                <div class="row justify-content-center">
                    <div class="col-lg-12 md-mb50">
                        <h2 class="text-center">OUR PRODUCTS</h2>
                        <h6 class="sub-title text-center mb-15">
                          A high level quality control in compliance with global standards
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                @foreach($Results_fronts as $front)
                    @php
                        $results = $Resultsdetails->where('Infrastructure_id', $front->id);
                    @endphp

                    @if($results->isNotEmpty())
                        <div class="services mb-5 mt-20"> <!-- mt-20 -->
                            <div class="sec-head mb-20">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 text-align-left">
                                        <h2>{{ $front->title }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($results as $index => $Resultsdetail)
                                    <div class="col-6 col-md-4 col-xl-3 mb-4">
                                        <a href="{{ $Resultsdetail->url ?? '#' }}" target="_blank" class="w-100">
                                            <div class="item-box sm-mb30 text-center p-3 border rounded home-our-products">
                                                <div class="icon mb-3">
                                                    @if($Resultsdetail->pdf)
                                                        <img src="{{ asset('pdfs/'.$Resultsdetail->pdf) }}">
                                                    @else
                                                        <img src="{{ asset('images/new-images/default_image.png') }}" alt="Default image">  <!-- default image -->
                                                    @endif
                                                </div>

                                                <h6 class="mb-2">
                                                    {{ $Resultsdetail->infrastructure_title }}
                                                </h6>

                                                <p>{{ $Resultsdetail->description }}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
    



      
        </div>
    </div>
</section>

<!-- ==================== End intro ==================== -->


<section class="numbers section-padding ">

    <div class="container">
        <div class="sec-bottom mb-50">
            <div class="sub-bg d-flex align-items-center">
                <h6 class="fz-14 fw-400">View <span class="fw-600">our company</span> stats
                    throught the years</h6>
            </div>
        </div>
@foreach ($FAQs as $FAQ )
    

        <div class="row justify-content-center">
            <div class="col-lg-3 col-12 col-sm-6 ">
                <h4>Established Year</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">

                    <h2 class="fz-60 line-height-1 " data-target="{{ $FAQ->established }}">{{ $FAQ->established }}</h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Manufacturing Units</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">
                    <h2 class="fz-60 line-height-1 count" data-target="{{ $FAQ->manufacturing_units }}">{{ $FAQ->manufacturing_units }}</h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Employees</h4>
                <div class="item d-flex align-items-center justify-content-center  md-mb50">
                    <h2 class="fz-60 line-height-1 count" data-target="{{ $FAQ->employees }}">{{ $FAQ->employees }}</h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Gobal Reach</h4>
                <div class="item d-flex align-items-center justify-content-center ">
                    <h2 class="fz-60 line-height-1 count" data-target="{{ $FAQ->global_reach }}">{{ $FAQ->global_reach }}</h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
                <h5>Countries</h5>
            </div>
        </div>
@endforeach

    </div>
</section>

<!-- ==================== Start main-feat ==================== -->

<section class="main-feat section-padding bg-main-blue side-circle-img" 
         style="position: relative;">
    <div class="container">
        <div class="sec-head col-lg-12 col-md-8 col-12 mb-20">
            <div class="row justify-content-between">

            @foreach ($OurServices as $OurService )

                <div class="col-lg-12 md-mb50">
                    <h6 class="sub-title mb-15">Our Services</h6>
                    <h2 class="" style="max-width: 458px;text-align: left;">
                        {{ $OurService->title }}
                    </h2>
                    <p></p>
                </div>

            </div>
        </div>

        <div class="row justify-content-between">

            <div class="col-lg-6 mw-550">
                <p class="mb-10 text-white w-95per">{{ $OurService->description }}</p>
                <p class="mb-20 text-white">{{ $OurService->points_title }}</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="item mb-20">
                            <ul class="rest dot-list text-white grid-2-list">
                                @if($OurService->point_1) <li>{{ $OurService->point_1 }}</li> @endif
                                @if($OurService->point_2) <li>{{ $OurService->point_2 }}</li> @endif
                                @if($OurService->point_3) <li>{{ $OurService->point_3 }}</li> @endif
                                @if($OurService->point_4) <li>{{ $OurService->point_4 }}</li> @endif
                                @if($OurService->point_5) <li>{{ $OurService->point_5 }}</li> @endif
                                @if($OurService->point_6) <li>{{ $OurService->point_6 }}</li> @endif
                            </ul>
                        </div>
                    {{--    @if($OurService->readmore_link)
                            <a href="{{ $OurService->readmore_link }}" class="white-btn mt-10">
                                <span>Know More</span>
                            </a>
                        @endif--}}
                    </div>
                </div>
            </div>

        </div>  

        @endforeach  
    </div>
    
    <div class="col-12 ser-ext-img right-clumn">
                                <div class="img">
                                  {{--  <img src="{{ isset($OurService->image) ? asset($OurService->image) : asset('imgs/blog/2.jpg') }}"alt="Barani Group Facility"> --}}
                                   <img src="{{ isset($OurService->image) ? asset($OurService->image) : asset('imgs/blog/2.jpg') }}"alt="Barani Group Facility">
                                    <!--<img src="{{ asset('assets/frontend/imgs/blog/image.jpg') }}" alt="Barani Service Facility">-->


                                </div>
                            </div>

    <!-- Dynamic background via inline style if you want -->
    <style>
        .side-circle-img::after {
            width: 50%;
            height: 100%;
            content: "";
            background: url('{{ isset($OurService->image) ? asset($OurService->image) : asset('imgs/blog/2.jpg') }}') no-repeat;
            background-size: cover;
            position: absolute;
            right: 0px;
            top: 0px;
            clip-path: ellipse(100% 100% at 100% 50%);
                background-position: bottom;
        }
    </style>
</section>


<!-- ==================== End main-feat ==================== -->


<!-- ==================== Start clients ==================== -->

<section class="clients-carso section-padding sub-bg">
    <div class="container">
        <div class="sec-bottom mb-50">
            <div class="sub-bg d-flex align-items-center">
                <h6 class="fz-14 fw-400">More than <span class="fw-600">100+ companies</span> trusted us
                    worldwide</h6>
            </div>
        </div>

@php
    $total = $Gallerys->count();     // 35
    $perRow = ceil($total / 3);      // 12
    $chunks = $Gallerys->chunk($perRow);
@endphp

@foreach ($chunks as $index => $chunk)
    <div class="swiper{{ 5 + $index }}" data-carousel="swiper" data-items="8"  data-space="40">
        <div id="content-carousel-swiper{{ 5 + $index }}" class="swiper-container" data-swiper="container">
            <div class="swiper-wrapper">
                @foreach ($chunk as $Gallery)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="{{ asset('images/' . $Gallery->image_path) }}" alt="Brand Logo">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

    </div>
</section>

{{-- HOME SECTION PAGE END --}}


@endsection