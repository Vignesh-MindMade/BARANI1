@extends('layouts-front.app')
@section('content')

<header class="slider slider-prlx">
    <div class="swiper-container parallax-slider">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="bg-img valign" data-overlay-dark="4">
                    <video autoplay muted loop playsinline class="bg-video" poster="{{ asset('assets/frontend/imgs/header/full/1.jpg')}}">
                        <source src="{{ asset('assets/frontend/videos/video-trim-1.mp4')}}" type="video/mp4">
                    </video>
                    <div class="container">
                        <div class="caption text-center">
                            <h2 class="mb-30" data-swiper-parallax="-2000">Powering Progress With</h2>
                            <h1><span data-swiper-parallax="-1000">Power and Innovation</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="bg-img valign" data-overlay-dark="4">
                    <video autoplay muted loop playsinline class="bg-video" poster="{{ asset('assets/frontend/imgs/header/full/3.jpg')}}">
                        <source src="{{ asset('assets/frontend/videos/2.mp4')}}" type="video/mp4">
                    </video>
                    <div class="container">
                        <div class="caption text-center">
                            <h2 class="mb-30" data-swiper-parallax="-2000">Precision Meets</h2>
                            <h1><span data-swiper-parallax="-1000">Industrial Innovation</span></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="bg-img valign" data-overlay-dark="4">
                    <video autoplay muted loop playsinline class="bg-video" poster="{{ asset('assets/frontend/imgs/header/full/4.jpg')}}">
                        <source src="{{ asset('assets/frontend/videos/1.mp4')}}" type="video/mp4">
                    </video>
                    <div class="container">
                        <div class="caption text-center">
                            <h2 class="mb-30" data-swiper-parallax="-2000">Powering Progress With</h2>
                            <h1><span data-swiper-parallax="-1000"> Hydraulic Systems</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="slider-contro main-bg">
                        <div class="swiper-button-prev swiper-nav-ctrl cursor-pointer">
                            <div><span>Prev</span></div>
                        </div>
                        <div class="ml-30 mr-30"><span>/</span></div>
                        <div class="swiper-button-next swiper-nav-ctrl cursor-pointer">
                            <div><span>Next</span></div>
                        </div>
                        <div class="shap-left-bottom">
                            <svg viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.5e-06L0 0L0 11C0 4.92 4.92 0 11 1.5e-06Z" fill="#fff" />
                            </svg>
                        </div>
                        <div class="shap-right-top">
                            <svg viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.5e-06L0 0L0 11C0 4.92 4.92 0 11 1.5e-06Z" fill="#fff" />
                            </svg>
                        </div>
                    </div> -->
    <div class="pagination-prog-bar">
        <div class="swiper-pagination swiper-pagination-progressbar"></div>
    </div>
</header>

<section class="services-tab section-padding">
    <div class="container">
        <div class="row lg-marg" id="tabs">
            <div class="col-lg-6 valign">
                <div class="images-grp">
                    <div class="front-images">
                        <!-- Slider for tabs-1 -->
                        <div class="tab-1 current slider-container">
                            <div class="slider-images">
                                <img src="{{ asset('assets/frontend/imgs/works/3/4.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/3.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/2.jpg')}}" alt="">
                            </div>
                            <div class="slider-pagination">
                                <span class="dot active" data-index="0"></span>
                                <span class="dot" data-index="1"></span>
                                <span class="dot" data-index="2"></span>
                            </div>
                        </div>
                        <!-- Slider for tabs-2 -->
                        <div class="tab-2 slider-container">
                            <div class="slider-images">
                                <img src="{{ asset('assets/frontend/imgs/works/3/4.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/2.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/3.jpg')}}" alt="">
                            </div>
                            <div class="slider-pagination">
                                <span class="dot active" data-index="0"></span>
                                <span class="dot" data-index="1"></span>
                                <span class="dot" data-index="2"></span>
                            </div>
                        </div>
                        <!-- Slider for tabs-3 -->
                        <div class="tab-3 slider-container">
                            <div class="slider-images">
                                <img src="{{ asset('assets/frontend/imgs/works/3/3.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/2.jpg')}}" alt="">
                                <img src="{{ asset('assets/frontend/imgs/works/3/4.jpg')}}" alt="">
                            </div>
                            <div class="slider-pagination">
                                <span class="dot active" data-index="0"></span>
                                <span class="dot" data-index="1"></span>
                                <span class="dot" data-index="2"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 valign">
                <div class="serv-tab-link tab-links full-width pt-40">
                    <div class="sec-head mb-20">
                        <h6 class="sub-title mb-15">WELCOME TO</h6>
                        <h2>BARANI HYDRAULICS <br> PRIVATE LIMITED</h2>
                        <div class="text mb-30 mt-20">
                            <p>Our three specialised units is hub of innovation, equipped with
                                cutting-edge technology to meet unique customer requirements.</p>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-lg-12">
                            <ul class="rest tab-units">
                                <li class="item-link current" data-tab="tabs-1">
                                    <h3>Machinery Manufacturing Division</h3>
                                </li>
                                <li class="item-link" data-tab="tabs-2">
                                    <h3>Pressed Components & Assembly Division</h3>
                                </li>
                                <li class="item-link" data-tab="tabs-3">
                                    <h3>Foundry Division</h3>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="serv-tab-cont md-mb80">
                        <div class="tab-content current" id="tabs-1">
                            <div class="item">
                                <div class="cont">
                                    <div class="text">
                                        <p>We are a leading innovator in the design and manufacturing of
                                            high-performance Servo presses. For more than 35 years, we
                                            have empowered industries worldwide with robust, reliable,
                                            and precision-engineered press solutions that drive
                                            productivity and excellence. Whether you need a standard
                                            model or a complex custom system, our commitment to quality
                                            and cutting-edge technology ensures you get the perfect
                                            press for your application.</p>
                                    </div>
                                    <a href="machinery_division.html" class="mt-30">
                                        <span>Read More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="tabs-2">
                            <div class="item">
                                <div class="cont">
                                    <div class="text">
                                        <p>We produce a wide range of sheetmetal/precision parts for
                                            Industries like Valves, Automotive, Aerospace etc. We also
                                            offer Full assembly solution integrating our components with
                                            other parts to create finished sub-assemblies or final
                                            products.</p>
                                    </div>
                                    <a href="machinery_division.html" class="mt-30">
                                        <span>Read More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="tabs-3">
                            <div class="item">
                                <div class="cont">
                                    <div class="text">
                                        <p>With more than a decade of experience, we are a leading
                                            foundry specializing in high-quality gray iron and ductile
                                            iron castings for a variety of industries.</p>
                                    </div>
                                    <a href="machinery_division.html" class="mt-30">
                                        <span>Read More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
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
            sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[currentIndex].classList.add('active');
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


<section class="page-intro section-padding">
    <div class="container">
        <div class="row">
            <div class="sec-head mb-20">
                <div class="row justify-content-center">
                    <div class="col-lg-12 md-mb50">
                        <h2 class="text-center">OUR PRODUCTS
                        </h2>
                        <h6 class="sub-title text-center  mb-15">A high level Quality Control in
                            compliance with National.</h6>

                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="services">

                    <div class="sec-head mb-20">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 ">
                                <h2 class="">Sector Wise
                                </h2>


                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    01
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    02
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    03
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    04
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-50">
                <div class="services">

                    <div class="sec-head mb-20">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 ">
                                <h2 class="">Application Wise
                                </h2>


                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    01
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    01
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    01
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-box  sm-mb30">
                                <div class="icon mb-50 ">
                                    <span class="ph--pipe-thin"></span>
                                </div>
                                <h6 class="mb-15">Digital Design</h6>
                                <p>A high level Quality Control
                                    in compliance with National.</p>
                                <div class="float-number">
                                    01
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                <h4>Established</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">

                    <h2 class="fz-60 line-height-1 count" data-target="1988">1000</h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Manufacturing Units</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">
                    <h2 class="fz-60 line-height-1 count" data-target="3">0</h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Employees</h4>
                <div class="item d-flex align-items-center justify-content-center">
                    <h2 class="fz-60 line-height-1 count" data-target="550">400</h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Gobal Reach</h4>
                <div class="item d-flex align-items-center justify-content-center">
                    <h2 class="fz-60 line-height-1 count" data-target="30">0</h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
                <h5>Contries</h5>
            </div>
        </div>
    </div>
</section>

<!-- ==================== Start main-feat ==================== -->

<section class="main-feat section-padding bg-main-blue side-circle-img">
    <div class="container">
        <div class="sec-head mb-20">
            <div class="row justify-content-between">
                <div class="col-lg-12 md-mb50">
                    <h6 class="sub-title  mb-15">Our Services</h6>
                    <h2 class=" ">WE PROVIDE ESSENTIAL SERVICES <br>
                        FOR ANY INDUSTRY
                    </h2>
                    <p>

                    </p>
                </div>

            </div>
        </div>
        <div class="row justify-content-between">

            <div class="col-lg-6  mw-550">
                <p class="mb-10 text-white">We provide a one stop solution for all Hydraulic Press
                    requirements
                    including cell/line concept. Also, we support our customers by providing
                    parts manufactured by us with our own tooling's.
                </p>
                <p class="mb-20 text-white">We supply Special purpose</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="item mb-20">

                            <ul class="rest dot-list text-white grid-2-list">
                                <li>Hydraulic Presses</li>

                                <li>Pressed Components</li>
                                <li>Actuator Assembly & <br>
                                    Cast-iron parts</li>
                                <li>Standard Electric
                                    Presses</li>
                            </ul>
                        </div>
                        <a href="#" class="white-btn mt-10">
                            <span class="">Know More</span>

                        </a>

                    </div>


                </div>
            </div>

            <div class="col-lg-6 ">
                <img src="" alt="">
            </div>
        </div>
    </div>
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

        <!-- Slider 1: swiper5 (LTR - Left to Right) -->
        <div class="swiper5" data-carousel="swiper" data-items="8" data-loop="true" data-space="40">
            <div id="content-carousel-swiper5" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Rane.png" alt="Brand Logo 1">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Saint Gobain.png" alt="Brand Logo 2">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Mahindra Aerospace.png" alt="Brand Logo 3">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Brakes India Pvt ltd.png" alt="Brand Logo 4">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Wheels India lts.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Faurecia.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Valeo.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Ashok Leyland.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Guardian.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/GRI.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider 2: swiper6 (RTL - Right to Left) -->
        <div class="swiper6" data-carousel="swiper" data-items="8" data-loop="true" data-space="40">
            <div id="content-carousel-swiper6" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Michelin and Camsi.png" alt="Brand Logo 1">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/TATA.png" alt="Brand Logo 2">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Schaeffler.png" alt="Brand Logo 3">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/WEG.png" alt="Brand Logo 4">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Baker Hughes.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Flowserve.png" alt="Brand Logo 1">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Axles India ltd.png" alt="Brand Logo 2">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/IMI Critical Engineering.png" alt="Brand Logo 3">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Twin Disc.png" alt="Brand Logo 4">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/HORA.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider 3: swiper7 (LTR - Left to Right) -->
        <div class="swiper7" data-carousel="swiper" data-items="8" data-loop="true" data-space="40">
            <div id="content-carousel-swiper7" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/KOSO.png" alt="Brand Logo 1">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Velan.png" alt="Brand Logo 2">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Bonfiglioli.png" alt="Brand Logo 3">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Tafe.png" alt="Brand Logo 4">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Bridgestone.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Avtec.png" alt="Brand Logo 1">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/AVR.png" alt="Brand Logo 2">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Ekki.png" alt="Brand Logo 3">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/Circor.png" alt="Brand Logo 4">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="assets/frontend/imgs/brands/KSB.png" alt="Brand Logo 5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== End clients ==================== -->
@endsection