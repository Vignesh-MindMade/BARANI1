@extends('layouts_front.app')
@section('contentFront')

<style>
    .hei-300px{
        height:300px;
    }
    
    .hei-300px img{
        width: 100%;
    height: 100%;
    object-fit: fill;
    }
</style>
<header class="page-header-cerv bg-img section-padding"
     data-background="{{ asset('frontend/imgs/submenu/' . ($page->banner_image ?? 'default.jpg')) }}"
     data-overlay-dark="4">

    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">{{ $page->banner_title ?? $submenu->submenu_name }}</h1>

            <div class="mt-15 mb-4">
                <a href="{{ url('/') }}">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">{{ $submenu->submenu_name }}</span>
            </div>
        </div>
    </div>
</header>


<section class="services-details section-padding">
    <div class="container">

        <div class="sec-head ">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h6 class="sub-title main-color mb-15">{{ $page->division_title }}</h6>

                    <p>{{ $page->division_desc }}</p>

                </div>
            </div>
        </div>

    </div>
</section>



{{-- wy choose us --}}

<section class="about">
    <div class="container section-padding pt-0">
        <div class="row md-marg">

            {{-- LEFT: Why Choose Us --}}
            <div class="col-lg-6">
                <div class="cont md-mb50">

                    <h6 class="sub-title main-color mb-15">Why Choose Us</h6>

                    @php
                        $points = $page->chooseus_points
                            ? preg_split("/\r\n|\r|\n/", trim($page->chooseus_points))
                            : [];
                    @endphp

                    <ul class="rest list-arrow mt-30 pt-30 bord-thin-top">
                        @foreach($points as $p)
                        <li class="{{ !$loop->first ? 'mt-10' : '' }}">
                            <span class="icon">
                                {{-- same SVG --}}
                                <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                    fill="#00225a"></path>
                                </svg>
                            </span>

                            <h6 class="inline fw-400" style="font-size:18px;">
                                {{ $p }}
                            </h6>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            {{-- RIGHT: Video --}}
      <div class="col-lg-6">
                <div class="img-vid video-auto-unit" style="border-radius: 30px 30px 30px 30px;">

                    @php
                        $chooseusVideo = $page->chooseus_video;
                        $chooseusVideoType = null;
                        if ($chooseusVideo) {
                            if (preg_match('/\.webm($|\?)/i', $chooseusVideo)) {
                                $chooseusVideoType = 'video/webm';
                            } elseif (preg_match('/\.mp4($|\?)/i', $chooseusVideo)) {
                                $chooseusVideoType = 'video/mp4';
                            }
                        }
                    @endphp

                    <video autoplay muted loop playsinline class="w-100">
                        @if ($chooseusVideoType)
                            <source src="{{ $chooseusVideo }}" type="{{ $chooseusVideoType }}">
                        @endif
                    </video>

                    <div class="curv-butn main-bg video-icon" style="display:none;">
                        <a href="{{ $page->chooseus_video }}" target="_blank" class="vid">
                            <div class="icon"><i class="fas fa-play"></i></div>
                        </a>
                        <div class="shap-left-top">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                            </svg>
                        </div>
                        <div class="shap-right-bottom">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                            </svg>
                        </div>
                    </div>
                    
                     

                </div>
            </div>

<!--{{-- RIGHT: Video --}}-->
<!--            <div class="col-lg-6">-->
<!--                <div class="img-vid video-auto-unit">-->

<!--                    <video autoplay muted loop playsinline class="w-100">-->
<!--                        <source src="{{ $page->chooseus_video }}" type="video/mp4">-->
<!--                    </video>-->

<!--                    <div class="curv-butn main-bg">-->
<!--                        <a href="{{ $page->chooseus_video }}" target="_blank" class="vid">-->
<!--                            <div class="icon"><i class="fas fa-play"></i></div>-->
<!--                        </a>-->
<!--                        <div class="shap-left-top">-->
<!--                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">-->
<!--                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <div class="shap-right-bottom">-->
<!--                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">-->
<!--                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
                    
                     

<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>



{{-- View Process Section --}}
<section class="services-boxs section-padding pb-30 pt-0">
    <div class="container">

        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">Our Process Approach</h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <h2 class="fw-600 text-u ls1">
                    {{ $page->view_process_title }}
                </h2>
            </div>
        </div>

        <div class="row pt-30">

            @for($i = 1; $i <= 4; $i++)
                @php
                    $icon = "view_process_card{$i}_icon";
                    $title = "view_process_card{$i}_title";
                    $desc  = "view_process_card{$i}_desc";
                @endphp

                @if(!empty($page->$title))
                <div class="col-lg-3 col-md-6 items">
                    <div class="item-box bg md-mb50">

                        <div class="icon mb-40 opacity-5">
                            @if($page->$icon)
                            <img src="{{ asset('frontend/imgs/submenu/' . $page->$icon) }}">
                            @endif
                        </div>

                        <h5 class="mb-15 text-u">
                            {!! nl2br(e($page->$title)) !!}
                        </h5>

                        <p>{{ $page->$desc }}</p>

                    </div>
                </div>
                @endif

            @endfor

        </div>
    </div>
</section>



<!-- ==================== Start Press_construction ==================== -->

@php
    $section = $page->sections->first();
    $items   = $section?->items ?? collect();
    $points  = $section?->press_construction_points
                ? preg_split('/\r\n|\r|\n/', $section->press_construction_points)
                : [];
@endphp


<section class="team-tab press-con section-padding">
    <div class="container">

        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                {{ $section->press_construction_title ?? 'Press Construction' }}
            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <!--<h2 class="fw-600 text-u ls1">-->
                <!--       {{ $section->press_construction_title ?? 'Press Construction and Certification' }}-->
                <!--</h2>-->
            </div>
        </div>

        {{-- DYNAMIC POINTS --}}
        <ul class="rest list-arrow pt-0">

            @foreach($points as $point)
                @if(trim($point) !== '')

                    @php
                        if (str_contains($point, ':')) {
                            [$bold, $normal] = explode(':', $point, 2);
                        } else {
                            $bold = $point;
                            $normal = '';
                        }
                    @endphp

                    <li class="{{ !$loop->first ? 'mt-10' : '' }}">

                        <span class="icon">
                            <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                fill="#00225a"></path>
                            </svg>
                        </span>

                        <h6 class="inline fw-400">
                            <span class="fw-600">{{ trim($bold) }}</span>
                            {{ $normal ? ':'.trim($normal) : '' }}
                        </h6>

                    </li>

                @endif
            @endforeach

        </ul>


        {{-- LEFT LIST + GALLERY --}}
        <div class="row pt-30 desktop-tabs">

            <div class="col-12 col-lg-5 content">
                <h5></h5>

                @foreach($items as $index => $item)
                    <div class="cluom {{ $loop->first ? 'current' : '' }}" data-tab="tab-{{ $loop->iteration }}">
                        <div class="info">
                            <h6>{{ $loop->iteration }}. {{ $item->image_title }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-12 col-lg-7">
                <div class="glry-img">
                    @foreach($items as $index => $item)
                        <div id="tab-{{ $loop->iteration }}"
                             class="bg-img tab-img {{ $loop->first ? 'current' : '' }}"
                             data-background="{{ asset('frontend/imgs/submenu/'.$item->image) }}">
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        
        <div class="mobile-stack d-block d-lg-none">

    @foreach($items as $item)
        <div class="mobile-item mb-30">
            <h6 class="mb-15">{{ $loop->iteration }}. {{ $item->image_title }}</h6>
            <img src="{{ asset('frontend/imgs/submenu/' . $item->image) }}" class="img-fluid rounded" alt="">
        </div>
    @endforeach

</div>

    </div>
</section>


<style>
    .desktop-tabs { display: flex; }
.mobile-stack { display: none; }

@media (max-width: 991px) {
    .desktop-tabs { display: none !important; }
    .mobile-stack { display: block !important; }
}
</style>

<!-- ==================== End Press_Construction ==================== -->
<!-- ==================== Start Features Products ==================== -->

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
                <div class="work-crus work-crus5 out" data-carousel="swiper" data-items="6" data-center="center"
                    data-loop="true" data-space="30" data-swiper-speed="1000">

                    <div id="content-carousel-container-unq-w" class="swiper-container" data-swiper="container">
                        <div class="swiper-wrapper">

                                  @foreach ($Productss as $product)
    <div class="swiper-slide">
        <div class="item" style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">

            <div class="img hei-300px">
                <img
                    src="{{ $product->first_image
                        ? asset('uploads/products/' . $product->first_image)
                        : asset('assets/imgs/placeholder.webp') }}"
                    alt="{{ $product->product_title }}">

                <div class="cont">
                    <span class="mb-5">
                        {{ optional($product->category)->catagory ?? 'Category' }}
                    </span>

                    <h6 class="fz-18">
                        {{ $product->product_title }}
                    </h6>
                </div>
{{-- @dd($product->product_image, $product->first_image) --}}

                @if(optional($product->category)->slug)
                    <a href="{{ route('product.detail', $product->slug) }}" class="plink"></a>
                @endif
            </div>

        </div>
    </div>
@endforeach


                        </div><!-- swiper-wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== End Features Products ==================== -->


@php
    $mf = $page->manufacturingFacility;

    // Split title into two words (before & after first space)
    $facilityTitle = $mf->facility_title ?? 'Manufacturing Facility';

    if (str_contains($facilityTitle, ' ')) {
        [$mainTitle, $subTitle] = explode(' ', $facilityTitle, 2);
    } else {
        $mainTitle = $facilityTitle;
        $subTitle = '';
    }
@endphp

<!-- ==================== Start Machinery Facility ==================== -->
<section class="price-hr section-padding pt-50 pb-50 cap-machinary">

                    <!-- BACKGROUND VIDEO -->
                          @php
                        $facilityBg = $mf->facility_bg_video ?? null;
                        $facilityBgType = null;
                        if ($facilityBg) {
                            if (preg_match('/\.webm($|\?)/i', $facilityBg)) {
                                $facilityBgType = 'video/webm';
                            } elseif (preg_match('/\.mp4($|\?)/i', $facilityBg)) {
                                $facilityBgType = 'video/mp4';
                            }
                        }
                    @endphp
                    <video autoplay muted loop playsinline class="bg-video">
                        @if ($facilityBgType)
                            <source src="{{ $facilityBg }}" type="{{ $facilityBgType }}">
                        @endif
                        Your browser does not support HTML5 video.
                    </video>

                    <div class="overlay-content">
                        <div class="container">
                            <div class="row">

                                <!-- SECTION TITLE -->
                            <div class="sec-head mb-30">
                    <h6 class="sub-title mb-5">Know More about us</h6>

                    <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                        <h2>
                            {{ $mainTitle }}
                            @if($subTitle)
                                <span class="fw-200">{{ $subTitle }}</span>
                            @endif
                        </h2>
                    </div>
                </div>

                <div class="col-lg-12 valign">
                    <div class="items-box">

                        <!-- LOOP THROUGH 4 CARDS -->
                        @for($i = 1; $i <= 4; $i++)

                            @php
                                $title  = "card{$i}_title";
                                $points = "card{$i}_points";

                                // convert points to array line-by-line
                                $list = $mf->$points
                                    ? preg_split('/\r\n|\r|\n/', trim($mf->$points))
                                    : [];
                            @endphp

                            @if($mf->$title)
                                <div class="item radius-10 d-flex">
                                    <div class="type">
                                        <h5>{{ $mf->$title }}</h5>
                                    </div>

                                    <div class="cont ml-10">
                                        <ul class="dot-list rest">

                                            @foreach($list as $p)
                                                @if(trim($p) !== '')
                                                    <li class="mb-10">{{ trim($p) }}</li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            @endif

                        @endfor

                        <!-- TESTIMONIAL NOTE -->
                        @if($mf->facility_testimonial)
                            <div class="col-12">
                                <h6 class="sub-text-cap">
                                    {{ $mf->facility_testimonial }}
                                </h6>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<!-- ==================== End Machinery Facility ==================== -->

<!-- ==================== start Press Standards==================== -->
<section class="services-dots section-padding sub-bg radius-30 pb-30 ">
    <div class="container">

        {{-- MAIN TITLE BLOCK --}}
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                {{ $page->pressStandards->first()->press_main_title ?? 'OUR PRESSES COMPLY WITH FOLLOWING STANDARDS' }}
            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <h2 class="fw-600 text-u ls1">
                   {{ $page->pressStandards->first()->press_main_title ?? 'OUR PRESSES COMPLY WITH FOLLOWING STANDARDS' }}
                </h2>
            </div>
        </div>

        {{-- ITEMS --}}
        <div class="row xlg-marg ontop">

            @forelse($page->pressStandards as $ps)
                <div class="col-6 col-lg-4">
                    <div class="item md-mb50">

                        {{-- LOGO --}}
                        <img class="stan-img"
                             src="{{ $ps->press_detail_logo 
                                    ? asset('frontend/imgs/submenu/'.$ps->press_detail_logo) 
                                    : asset('assets/imgs/default.png') }}"
                             alt="">

                        {{-- TITLE --}}
                        <h5>{{ $ps->press_detail_title }}</h5>

                        {{-- DESCRIPTION --}}
                        <div class="text mt-5">
                            <p class="mb-30">{!! nl2br(e($ps->press_detail_desc)) !!}</p>
                        </div>

                    </div>
                </div>

            @empty
                {{-- OPTIONAL: if no items found --}}
                <div class="col-12 text-center">
                    <p class="text-muted">No Press Standards available.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
<!-- ==================== End Press standards  ==================== -->
<!-- ==================== Start Design strength ==================== -->
<!-- ==================== Start Design strength (dynamic, safe) ==================== -->
<section class="services-dots section-padding sub-bg radius-30 ">
    <div class="container">

        {{-- MAIN TITLES --}}
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                {{ optional($page->designStrength->first())->design_title ?? 'Softwares we Use for Designs' }}
            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <h2 class="fw-600 text-u ls1">
                    DESIGN <span class="fw-200"> STRENGTH </span>
                </h2>
            </div>
        </div>

        <div class="row xlg-marg ontop design-logos-all">

            {{-- LOOP SOFTWARE LOGOS --}}
            @forelse($page->designStrength as $ds)
                <div class="item md-mb50">
                    <img class="design-img"
                         src="{{
                            ($ds->design_softwares_logo && file_exists(public_path('frontend/imgs/submenu/'.$ds->design_softwares_logo)))
                                ? asset('frontend/imgs/submenu/'.$ds->design_softwares_logo)
                                : asset('assets/imgs/default.png')
                         }}"
                         alt="{{ $ds->design_title ?? 'Design software logo' }}">
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    No design software logos uploaded.
                </div>
            @endforelse

        </div>

        {{-- FOOTNOTE --}}
        <div class="col-12 ">
            <p>
                {!! nl2br(e(optional($page->designStrength->first())->design_text ?? '* Apart from this we are using 18 engineering software')) !!}
            </p>
        </div>
    </div>
</section>
<!-- ==================== End Design strength ==================== -->

<!-- ==================== End Design strength ==================== -->


{{-- <section class="blog-crev section-padding  pb-50">
    <div class="container">
        <div class="row">
            <h4 class="fw-600 text-u ls1 mb-4">Case <span class="fw-200">Study</span></h4>
            <div class="col-lg-4">
                <div class="item sub-bg mb-40">
                    <div class="img">
                        <img src="assets/imgs/vs-img/po4vu2lez3u16ta246edzffmgcq1z6ib (1).jpg" style="height: auto;"
                            alt="">
                        <div class="tag sub-bg">
                            <span>Hyd. Press</span>
                            <div class="shap-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="shap-left-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="cont">
                        <div class="date fz-13 text-u ls1 mb-10 opacity-7">
                            <a href="#">30 august 2021</a>
                        </div>
                        <h5>
                            <a href="#">Custom Hydraulic Press for Automotive Industry</a>
                        </h5>
                        <a href="#" class="d-flex align-items-center mt-30">
                            <span class="text mr-15">Read More</span>
                            <span class="ti-arrow-top-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item sub-bg mb-40">
                    <div class="img">
                        <img src="assets/imgs/vs-img/modern-hydraulics-six-advanced-capabilities-for-stamping-presses-3 (1).jpg"
                            style="height: auto;" alt="">
                        <div class="tag sub-bg">
                            <span>Cylinders</span>
                            <div class="shap-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="shap-left-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="cont">
                        <div class="date fz-13 text-u ls1 mb-10 opacity-7">
                            <a href="#">30 august 2021</a>
                        </div>
                        <h5>
                            <a href="#">High-Performance Hydraulic Cylinders for Construction</a>
                        </h5>
                        <a href="#" class="d-flex align-items-center mt-30">
                            <span class="text mr-15">Read More</span>
                            <span class="ti-arrow-top-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item sub-bg mb-40">
                    <div class="img">
                        <img src="assets/imgs/vs-img/hydraulic-cylinders-1536x864 (1).jpg" style="height: auto;" alt="">
                        <div class="tag sub-bg">
                            <span>Hyd. Systems</span>
                            <div class="shap-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="shap-left-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#fff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="cont">
                        <div class="date fz-13 text-u ls1 mb-10 opacity-7">
                            <a href="#">30 august 2021</a>
                        </div>
                        <h5>
                            <a href="#">Complete Hydraulic System Integration for Manufacturing</a>
                        </h5>
                        <a href="#" class="d-flex align-items-center mt-30">
                            <span class="text mr-15">Read More</span>
                            <span class="ti-arrow-top-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


<!-- ==================== Start Services ==================== -->





<!-- ==================== End Services ==================== -->

<!-- ==================== Start price ==================== -->




<!-- ==================== End price ==================== -->

@endsection