<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/fav.png">
    <title>Home - Vital </title>
    <!-- fontawesome css -->
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/fontawesome.css') }}">
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/aos.css') }}">
    <!-- swiper css-->
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/odometer.css') }}">
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/swiper.css') }}">
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/metismenu.css') }}">
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/plugins/magnifying-popup.css') }}">

    <!-- bootstrap css -->
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/vendor/bootstrap.min.css') }}">
    <!-- custom css here -->
    <link rel="stylesheet" preload href="{{ asset('assets/frontend/css/style.css') }}">
</head>

<body>

    <header class="header-four header--sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-bottom">
                        <div class="logo-area">
                            <a href="index.html"><img
                                    src="{{ asset('assets/frontend/images/logo/vital-logo.svg" alt="logo') }}"></a>
                        </div>
                        <div class="nav-area">
                            <ul class="">
                                <li class="main-nav"><a href="indx.html">Home</a></li>
                                <li class="main-nav"><a href="profile.html">Profile</a></li>
                                <li class="main-nav has-dropdown project-a-after">
                                    <a href="#">Products</a>
                                    <ul class="submenu parent-nav">
                                        <li><a href="product.html">Textile Machinery</a></li>
                                        <li><a href="product.html">Food Machinery</a></li>
                                        <li><a href="product.html">OEM</a></li>
                                    </ul>
                                </li>
                                <li class="main-nav"><a href="#">News & Gallery</a></li>
                                <li class="main-nav"><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                        <div class="header-end">
                            <div class="button-wrapper">
                                <div class="action-btn">
                                    <div class="call-wrap">
                                        <a href="tel:+91-422-4030500">+91-422-4030500</a>
                                    </div>
                                    <div class="login-wrap">
                                        <a href="login.html">User Login</a>
                                    </div>
                                </div>
                            </div>
                            <a href="contact.html" class="rts-btn btn-primary">Get in touch <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                            <div class="nav-btn menu-btn">
                                <img src="{{ asset('assets/frontend/images/logo/bar.svg') }}" alt="nav-iamge">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="banner-two-swiper-main-wrapper industry-banner">
        <div class="swiper mySwiper-banner2" dir="ltr">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="banner-area-start bg_banner-bg-area rts-section-gap bg_image"
                        style="background-image: url(assets/frontend/images/banner/banner-1.png);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-9">
                                    <div class="banner-two-inner">
                                        <h2 class="title">Welcome to <b>VETAL</b></h2>
                                        <p class="disc"><b>VETAL</b> was established because of a small Import
                                            substitution order for a photocell unit for carding <b>42 years ago.</b>
                                        </p>
                                        <div class="button-wrapper">
                                            <a href="#" class="btn-secondary"> <i
                                                    class="fa-regular fa-arrow-right-long"></i> Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="banner-area-start bg_banner-bg-area rts-section-gap bg_image"
                        style="background-image: url(assets/frontend/images/banner/banner-1.png);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-9">
                                    <div class="banner-two-inner">
                                        <h2 class="title">Welcome to <b>VETAL</b></h2>
                                        <p class="disc"><b>VETAL</b> was established because of a small Import
                                            substitution order for a photocell unit for carding <b>42 years ago.</b>
                                        </p>
                                        <div class="button-wrapper">
                                            <a href="#" class="btn-secondary"> <i
                                                    class="fa-regular fa-arrow-right-long"></i> Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>


    <div class="home-about-wrap section-gap1 dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="his">
                        <h2>42</h2>
                        <p>Years working <br>Experience</p>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6">
                    <h3>INSPECTION . DETECTION . SORTING</h3>
                    <p>Vetal is a 30 years old ISO 9001 : 2000 certified electronics group company manufacturing
                        products in Coimbatore, South India. Vetal Designs offers quality products and cost – effective
                        solutions for wide range of industrial applications world wide in simplified forms.</p>
                    <div class="button-wrapper">
                        <a href="profile.html" class="btn-secondary"> <i class="fa-regular fa-arrow-right-long"></i>
                            Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="h-abt-list">
                        <ul>
                            <li><img src="assets/frontend/images/icons/textiles.svg"> Textile Industry</li>
                            <li><img src="assets/frontend/images/icons/food.svg"> Food Processing <br>Industry</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="home-product-wrap section-gap dark-bg">
        <div class="container">
            <div class="home-title-wrap">
                <h3>Our Products</h3>
                <a href="product.html" class="rts-btn btn-primary">View all <i
                        class="fa-regular fa-arrow-right-long"></i></a>
            </div>
            <p class="home-title-after">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <div class="h-product-wrap">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <a href="product.html" class="product-card">
                            <div class="hiding"><img src="assets/frontend/images/product/textile-bg.jpg"></div>
                            <img class="pro-icon" src="assets/frontend/images/icons/textiles.svg">
                            <div class="pro-title">
                                <h3>Textile <br>Machinery</h3>
                                <p>Cotton Sorting, Foreign Particle Detector</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="product.html" class="product-card">
                            <div class="hiding"><img src="assets/frontend/images/product/food-bg.jpg"></div>
                            <img class="pro-icon" src="assets/frontend/images/icons/food.svg">
                            <div class="pro-title">
                                <h3>Food <br>Machinery</h3>
                                <p>Sorting Machines for Rice, Dal, Wheat, Dehydrated onion, Tea, Pulses, etc.,</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="product.html" class="product-card">
                            <div class="hiding"><img src="assets/frontend/images/product/textile-bg.jpg"></div>
                            <img class="pro-icon" src="assets/frontend/images/icons/ocm.svg">
                            <div class="pro-title">
                                <h3>OEM</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-mile-wrap section-gap dark-bg">
        <div class="container">
            <div class="mile-list">
                <div class="row">
                    <div class="col-md-6 col-lg-8">
                        <div class=" counter-wrap">
                            <ul>
                                <li>
                                    <h3 class="counter title"><span class="odometer" data-count="20">00</span>
                                        <p>+</p>
                                    </h3>
                                    <p>Products</p>
                                </li>
                                <li>
                                    <h3 class="counter title"><span class="odometer" data-count="1500">00</span></h3>
                                    <p>Clients</p>
                                </li>
                                <li>
                                    <h3 class="counter title"><span class="odometer" data-count="100">00</span>
                                        <p>%</p>
                                    </h3>
                                    <p>Satisfaction</p>
                                </li>
                                <li>
                                    <h3 class="counter title"><span class="odometer" data-count="45">00</span>
                                        <p>+</p>
                                    </h3>
                                    <p>Years of experience</p>
                                </li>
                            </ul>
                        </div>
                        <div class="cerfication">
                            <ul>
                                <li><img src="assets/frontend/images/brand/08.svg" alt="brand"></li>
                                <li><img src="assets/frontend/images/brand/08.svg" alt="brand"></li>
                                <li><img src="assets/frontend/images/brand/08.svg" alt="brand"></li>
                                <li><img src="assets/frontend/images/brand/08.svg" alt="brand"></li>
                                <li><img src="assets/frontend/images/brand/08.svg" alt="brand"></li>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 video-wrap">
                        <div class="reveal-item overflow-hidden aos-init">
                            <div class="reveal-animation reveal-end reveal-primary aos aos-init"
                                data-aos="reveal-end">
                            </div>
                            <img src="assets/frontend/images/product/video-bg.jpg" alt="journey-area">
                            <div class="vedio-icone">
                                <a class="video-play-button play-video" href="#">
                                    <span> <b></b> </span>
                                </a>
                                <div class="video-overlay">
                                    <a class="video-overlay-close">×</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="rts-footer-area three bg_footer-1 bg_image pt--70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-wrapper-left-one text-center">
                        <a href="index.html" class="logo">
                            <img src="assets/frontend/images/logo/footer-logo.svg" alt="logo">
                        </a>
                        <div class="social-area-wrapper-one text-center">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="foot-contact">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="footer-quick-list">
                                    <div class="single-nav-area-footer use-link">
                                        <h4 class="title">QUICK LINKS</h4>
                                        <ul>
                                            <li><a href="profile.html">Profile</a></li>
                                            <li><a href="careers.html">Career</a></li>
                                            <li><a href="product.html">Products</a></li>
                                            <li><a href="#">News & Events</a></li>
                                            <li><a href="contact.html">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="contact-list">
                                    <div class="single-nav-area-footer use-link">
                                        <h4 class="title">CONTACT US </h4>
                                        <p class="address-wrap foot-icon"><i
                                                class="fa-sharp fa-solid fa-location-dot"></i> Plot No:21-24,
                                            Industrial Estate for Electrical & Electronics, <br>Civil Aerodrome Post,
                                            Coimbatore - 641 014. Tamil Nadu, India.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="foot-icon">
                                                    <li><i class="fa-solid fa-envelope"></i><a
                                                            href="#">info@vetal.com</a>
                                                    <li><a href="#">customergrievances@vetal.com</a>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="foot-icon">
                                                    <li><i class="fas fa-phone-alt"></i><a href="#"
                                                            class="med-call">+91-422-4030500</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>ALL MOBILE NUMBERS AVAILABLE FROM 08.30 AM TO 05:00 PM ,YOU CAN SEND YOUR REQUIREMENTS BY EMAIL
                        OR WHATSAPP OR SMS, WE WILL GET BACK TO YOU ASAP.</p>
                </div>
            </div>
        </div>
        <div class="container-full copyright-area-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright-wrapper">
                                    <p class="mb-0">© 2025 ALL RIGHTS RESERVED VITAL</p>
                                    <div class="right-nav">
                                        <ul>
                                            <li><a href="#">Design : Mindmade Technologies </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="side-bar" class="side-bar header-two dark-bg">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- mobile menu area start -->
        <div class="mobile-menu d-block d-xl-none">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu metismenu" id="mobile-menu-active">
                    <li><a href="profile.html" class="main">Profile</a></li>
                    <li><a href="careers.html" class="main">Career</a></li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Products</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="product.html">Textile Machinery</a></li>
                            <li><a class="mobile-menu-link" href="product.html">Food Machinery</a></li>
                            <li><a class="mobile-menu-link" href="product.html">OEM</a></li>

                        </ul>
                    </li>
                    <li><a href="#" class="main">News & Gallery</a></li>
                    <li><a href="contact.html" class="main">Contact Us</a></li>
                    <li><a href="#" class="main">User Login</a></li>
                    <li><a href="tel:+91-422-4030500" class="main">+91-422-4030500</a></li>
                </ul>
            </nav>

            <div class="social-wrapper-one">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>




    <!-- scripts -->
    <script src="{{ asset('assets/frontend/js/plugins/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/plugins/odometer.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/jquery-appear.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/plugins/metismenu.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/swiper.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/nice-select.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/waw.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSiPhoDaOJ7aqtJVtQhYhLzwwJ7rQlmA"></script>
    <script src="{{ asset('assets/frontend/js/vendor/marker.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/map-content.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/info-box.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/magnific-popup.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/plugins/contact.form.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    <script>
        let lastScrollY = window.scrollY;
        let marquee = document.querySelector('.marquee');
        let position = 0;
        let scrollTimeout;

        function updateMarqueeOnScroll() {
            const currentScrollY = window.scrollY;
            if (currentScrollY > lastScrollY) {
                position -= 4;
            } else if (currentScrollY < lastScrollY) {
                position += 4;
            }
            marquee.style.transform = `translateX(${position}px)`;
            lastScrollY = currentScrollY;
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => marquee.style.transform = `translateX(${position}px)`, 50);
        }
        window.addEventListener('scroll', updateMarqueeOnScroll);
    </script>

</body>


</html>
