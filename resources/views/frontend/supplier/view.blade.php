@extends('layouts_front.app')
@section('contentFront')
    <style>
        .supplier-registration .bg-image-sf {
            background: url(/assets/frontend/imgs/background/1.jpg);
            background-size: cover;
            width: 100%;
            height: 100%;
        }
    </style>

    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main class="main-bg ">

                @foreach ($Suppliers as $Supplier)

                    <header class="page-header-cerv bg-img section-padding"
                        data-background="{{ asset('images/' . $Supplier->banner_image) }}" data-overlay-dark="4">
                        <div class="container pt-100 ontop">
                            <div class="text-center">
                                <h1 class="fz-100">Supplier Space</h1>
                                <div class="mt-15 mb-4">
                                    <a href="#">Home</a>
                                    <span class="padding-rl-20">|</span>
                                    <span class="text-white">Supplier Space</span>
                                </div>
                            </div>
                        </div>
                    </header>

                @endforeach
                <!-- ==================== Start about ==================== -->

                @foreach ($Suppliers as $Supply)

                    <section class="about-crev section-padding position-re pb-0">
                        <div class="container">
                            <div class="row lg-marg">
                                <div class="col-lg-6">
                                    <div class="left-block mt-100 md-mb50">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="info">
                                                    <h6>Lets Join <br> Together</h6>
                                                    <p class="nowrap">Build Great</p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="img fit-img radius-30">
                                                    <img src="{{ asset('images/' . $Supply->image) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mz-shap">
                                            <svg height="100%" viewbox="0 0 610 547" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M116.134 529.548C116.134 538.642 123.506 546.015 132.6 546.015H211.63C211.635 546.015 211.638 546.011 211.638 546.007V546.007C211.638 546.003 211.642 545.999 211.646 545.999H592.691C601.786 545.999 609.158 538.627 609.158 529.533L609.157 251.366C609.157 242.272 601.785 234.899 592.691 234.899H401.097C392.003 234.899 384.631 227.527 384.631 218.433V112.465C384.631 103.371 377.259 95.999 368.164 95.999H214.466C205.372 95.999 198 88.6268 198 79.5327V16.4662C198 7.37219 190.628 0 181.534 0H88.4662C79.3722 0 72 7.37219 72 16.4662V104.534C72 113.628 79.3722 121 88.4662 121H166.917C176.011 121 183.383 128.372 183.383 137.466V273.565C183.383 282.659 176.011 290.031 166.917 290.031H116.134H116.134H16.5634C7.46936 290.031 0.0971666 297.403 0.0971666 306.497V445.923C0.0971666 455.017 7.46935 462.39 16.5634 462.39H99.6677C108.762 462.39 116.134 469.762 116.134 478.856V529.548Z"
                                                    fill="#f5f7f9"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6 valign">
                                    <div class="content full-width">
                                        <div class="sec-head mb-30">
                                            <h6 class="sub-title mb-15 main-color">Our Expertise</h6>
                                            <h2>Building Partnerships Through Manufacturing Excellence</h2>
                                        </div>
                                        <div class="row ">
                                            <div class="col-lg-11">
                                                <div class="text ">
                                                    <p class='preserve-text'>{{ $Supply->description }}</p>
                                                </div>
                                                <!--<div class="mt-50">-->
                                                <!--    <div class="skills-box">-->
                                                <!--        <div class="skill-item mb-40">-->
                                                <!--            <h5 class="sub-title mb-15">Hydraulic Press Manufacturing</h5>-->
                                                <!--            <div class="skill-progress">-->
                                                <!--                <div class="progres" data-value="{{ $Supply->hydraulic_press_manufacturing }}%"></div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--        <div class="skill-item">-->
                                                <!--            <h5 class="sub-title mb-15">Custom Automation Solutions</h5>-->
                                                <!--            <div class="skill-progress">-->
                                                <!--                <div class="progres" data-value="{{ $Supply->custom_automation_solutions }}%"></div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="line-overlay opacity-7">
                            <svg viewbox="0 0 1728 1101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-43 773.821C160.86 662.526 451.312 637.01 610.111 733.104C768.91 829.197 932.595 1062.9 602.782 1098.75C272.969 1134.6 676.888 25.4306 1852 1"
                                    style="stroke-dasharray: 3246.53, 0;"></path>
                            </svg>
                        </div>
                    </section>
                    <!-- ==================== End about ==================== -->
                    <section class="crev-portfolio-header section-padding pt-30 pb-40">
    <div class="line-overlay">
        <svg viewbox="0 0 1728 1101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M-43 773.821C160.86 662.526 451.312 637.01 610.111 733.104C768.91 829.197 932.595 1062.9 602.782 1098.75C272.969 1134.6 676.888 25.4306 1852 1"
                style="stroke-dasharray: 3246.53, 0;"></path>
        </svg>
    </div>
    <div class="container pt-50 ontop">
        <div class="row">
            <div class="col-lg-10">
                <div class="caption">
                    <h2>Partner with Us – Building strong supplier partnerships. </span></h2>
                    <div class="row mt-10">
                        <div class="col-lg-4">
                            <div class="circle-button md-hide">
                                <div class="rotate-circle fz-30 text-u">
                                    <svg class="textcircle opacity-7" viewbox="0 0 500 500">
                                        <defs>
                                            <path id="textcircle"
                                                d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z"></path>
                                        </defs>
                                        <text>
                                            <textpath xlink:href="#textcircle" textlength="900"> Become a Supplier -
                                                Become a Supplier - Become a Supplier - </textpath>
                                        </text>
                                    </svg>
                                </div>
                                <div class="icon">
                                    <span class="ti-arrow-down fz-40"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 valign">
                            <div class="text preserve-text">
                                <p class="fz-18">At Barani Group, we believe strong partnerships are the foundation of operational excellence. We work closely with reliable and quality-driven suppliers who share our commitment to precision, innovation, and continuous improvement.
 
If you are a supplier of raw materials, components, tooling, machinery, or services and are interested in partnering with a growing industrial manufacturing organization, we invite you to connect with us.</p>
                            </div>
                        </div>
                            @endforeach  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-pattern bg-img opacity-4" data-background="assets/imgs/patterns/pattern2.png"></div>
</section>
                <!--supplier form reg-->
                <section class="supplier-registration section-padding pt-0">
                    <div class="container">
                        <div class="row rest form-img-box justify-content-center">
                            <div class="col-lg-8 col-12 rest">
                                <div class="form-box">
                                    <h4 class="text-center mb-10">Supplier Registration</h4>
                                    <p class="text-center mb-30">Become a trusted supplier for Barani Group. Complete the
                                        form
                                        below to join our network.</p>


                                    <form id="supplier-form" method="post"
                                        action="{{ route('supplier_registrations.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-section mb-4">
                                            <div class="col-md-12 mb-3">
                                                <label>Select Unit</label>
                                                <select name="unit" class="form-control" required>
                                                    <option value="">Select Unit</option>
                                                    <option value="Press Manufacturing Division">Press Manufacturing
                                                        Division</option>
                                                    <option value="Pressed Components and Sub-Assembly">Pressed Components
                                                        and Assembly</option>
                                                    <option value="Foundry Division">Foundry Division</option>
                                                </select>

                                            </div>
                                            <h6 class="mb-3">1. Company Information</h6>
                                            <div class="row">
                                                <!--<div class="col-md-12 mb-3">-->
                                                <!--    <label>Select Unit</label>-->
                                                <!--    <select name="business_type" class="form-control">-->
                                                <!--        <option value="">Select Unit</option>-->
                                                <!--        <option value="Unit1">Unit 1</option>-->
                                                <!--        <option value="Unit2">Unit 2</option>-->
                                                <!--        <option value="Unit3">Unit 3</option>-->
                                                <!--    </select>-->
                                                <!--</div>-->
                                                <div class="col-md-6 mb-3">
                                                    <label>Company Name *</label>
                                                    <input type="text" name="company_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Company Website</label>
                                                    <input type="url" name="company_website" class="form-control"
                                                        placeholder="https://example.com">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label>Full Address *</label>
                                                    <textarea name="company_address" class="form-control" rows="2"
                                                        required></textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Year Established</label>
                                                    <input type="number" name="year_established" class="form-control"
                                                        min="1800" max="2025">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Type of Business</label>
                                                    <select name="business_type" class="form-control">
                                                        <option value="">Select Type</option>
                                                        <option value="Manufacturer">Manufacturer</option>
                                                        <option value="Distributor">Distributor</option>
                                                        <option value="Wholesaler">Wholesaler</option>
                                                        <option value="Service Provider">Service Provider</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 2. Primary Contact -->
                                        <div class="form-section mb-4">
                                            <h6>2. Primary Contact</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Full Name *</label>
                                                    <input type="text" name="contact_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Job Title</label>
                                                    <input type="text" name="job_title" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Email Address *</label>
                                                    <input type="email" name="contact_email" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Phone Number *</label>
                                                    <input type="tel" name="contact_phone" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 3. Products / Services -->
                                        <div class="form-section mb-4">
                                            <h6>3. Products / Services</h6>
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label>Primary Product/Service Category *</label>
                                                    <select name="product_category" class="form-control" required>
                                                        <option value="">-- Please select a category --</option>
                                                        <option>Hydraulic Components</option>
                                                        <option>Raw Materials</option>
                                                        <option>Machinery Parts</option>
                                                        <option>Automation Systems</option>
                                                        <option>Engineering Services</option>
                                                        <option>Machined Components</option>
                                                        <option>Others</option>

                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label>Detailed Description *</label>
                                                    <textarea name="product_description" class="form-control" rows="3"
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 4. Documentation -->
                                        <div class="form-section mb-4">
                                            <h6>4. Documentation</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Company Brochure / Catalog</label>
                                                    <input type="file" name="brochure" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Quality Certifications (e.g., ISO 9001)</label>
                                                    <input type="file" name="certifications" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Agreement -->
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="agreement" required>
                                            <label class="form-check-label" for="agreement"> By checking this box, you
                                                certify that all
                                                information provided is accurate and agree to Barani Group supplier 
                                               <a href="{{ asset('assets/pdf/Terms&Condition.pdf') }}#toolbar=0" target="_blank" class="link-text-blue">
                                                   <u> terms and conditions </u> </a>. </label>
                                        </div>
                                        <div class="mb-4">
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="butn butn-full butn-bord radius-30 max-300">
                                                <span class="text">Submit Registration</span>
                                            </button>
                                        </div>
                                        <!-- Submit -->
                                    </form>


                                </div>
                            </div>
                            <!--<div class="col-lg-5 d-lg-block d-none rest">-->
                            <!--    <div class="bg-image-sf"></div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </section>
                <!-- ==================== Start Testimonials ==================== -->
                <!--<section class="testim-crev" data-scroll-index="4">-->
                <!--    <div class="container">-->
                <!--        <div class="sec-head mb-20">-->
                <!--            <h6 class="sub-title main-color mb-15">Testimonials</h6>-->
                <!--            <div class="bord pt-10 bord-thin-top d-flex align-items-center">-->
                <!--                <h2>What our <span class="fw-200">clients say?</span></h2>-->
                <!--                <div class="ml-auto">-->
                <!--                    <div class="swiper-arrow-control">-->
                <!--                        <div class="swiper-button-prev">-->
                <!--                            <span class="ti-arrow-left"></span>-->
                <!--                        </div>-->
                <!--                        <div class="swiper-button-next">-->
                <!--                            <span class="ti-arrow-right"></span>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="testim-swiper2 testim2" data-carousel="swiper" data-loop="true" data-space="30">-->
                <!--            <div id="content-carousel-container-unq-testim" class="swiper-container" data-swiper="container">-->
                <!--                <div class="swiper-wrapper">-->

                <!--                    @foreach ($HomepageTestimoniols as $Testimoniols )-->


                <!--                    <div class="swiper-slide">-->
                <!--                        <div class="item bord-box radius-15">-->
                <!--                            <div class="content">-->
                <!--                                <div class="text">-->
                <!--                                    <p>{{ $Testimoniols->feedback }}</p>-->
                <!--                                </div>-->
                <!--                                <div class="info mt-10">-->
                <!--                                    <div class="img-curv">-->
                <!--                                        <div class="img">-->
                <!--                                            <img src="{{ asset('images/'.$Testimoniols->image) }}" alt="">-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="ml-20">-->
                <!--                                        <h6>{{ $Testimoniols->name }}</h6>-->
                <!--                                        <span class="sub-title opacity-7">{{ $Testimoniols->relationship }}</span>-->
                <!--                                    </div>-->
                <!--                                    <div class="ml-auto">-->
                <!--                                        <svg xmlns="http://www.w3.org/2000/svg" width="256.721" height="208.227"-->
                <!--                                            viewbox="0 0 256.721 208.227" class="qout-svg">-->
                <!--                                            <path data-name="Path"-->
                <!--                                                d="M-23.723-530.169v97.327H-121.05v-68.7q0-40.076,13.359-73.472T-62.845-639.9l36.259,28.625Q-63.8-570.244-68.57-530.169Zm158.395,0v97.327H37.345v-68.7q0-40.076,13.359-73.472T95.55-639.9l36.259,28.625Q94.6-570.244,89.825-530.169Z"-->
                <!--                                                transform="translate(121.55 640.568)" fill="none" stroke="#1a1a1a"-->
                <!--                                                stroke-width="1" opacity="0.322"></path>-->
                <!--                                        </svg>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                @endforeach-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</section>-->
                <!-- ==================== End Testimonials ==================== -->
                <!--<section class="faqs section-padding position-re">-->
                <!--    <div class="container">-->
                <!--        <div class="row justify-content-between">-->
                <!--            <div class="col-lg-4">-->
                <!--                <div class="sec-head md-mb80">-->
                <!--                    <h6 class="sub-title main-color mb-15">FAQS</h6>-->
                <!--                    <h2 class="pt-20 bord-thin-top">Frequently <br> asked questions</h2>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-lg-6">-->
                <!--                <div class="list-serv">-->
                <!--                    <div class="accordion bord">-->

                <!--                        @foreach ($FAQNews as $faq )-->


                <!--                        <div class="item mb-15 wow fadeInUp" data-wow-delay=".1s">-->
                <!--                            <div class="title">-->
                <!--                                <h6>{{ $faq->question }}</h6>-->
                <!--                                <span class="ico ti-plus"></span>-->
                <!--                            </div>-->
                <!--                            <div class="accordion-info">-->
                <!--                                <p>{{ $faq->answer }}</p>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    @endforeach-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->

                <!--</section>-->
                <!-- ==================== End FAQS ==================== -->



            </main>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection