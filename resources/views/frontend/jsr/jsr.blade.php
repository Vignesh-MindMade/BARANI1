@extends('layouts_front.app')
@section('contentFront')

<style>
    .hero-banner {
        position: relative;
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
    }

    .hero-bg {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-bg .container {
        position: relative;
        z-index: 2;
    }

    .caption h2 span {
        display: inline-block;
    }

    .sub-title {
        font-size: 16px;
        color: #f6f6ff;
    }
</style>

@php
    // Usually we have only one main record – take first one
    $jsr = $jsrfront->first();
@endphp

@if($jsr)

    <!-- ==================== Hero / Banner ==================== -->
    <div class="full-showcase jsr-banner">
        <div class="hero-banner">
            @if(!empty($jsr->banner) && is_array($jsr->banner) && count($jsr->banner) > 0)
                @php
                    $firstBanner = $jsr->banner[0];
                    $bgPath = !empty($firstBanner['path']) ? asset('uploads/jsr/' . $firstBanner['path']) : '';
                @endphp

                <div class="hero-bg valign" style="background-image: url('{{ $bgPath }}');">
            @else
                <div class="hero-bg valign" style="background-image: url('');">
            @endif

                <div class="hero-overlay"></div>

                <div class="container ontop">
                    <div class="row">
                        <div class="col-lg-11 offset-lg-1">
                            <div class="caption">
                                <h2>
                                    <a href="#" class="text-white">
                                        <span>{{ $jsr->banner_text ?? '' }}</span><br>
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Start intro ==================== -->
    <section class="intro intro-jsr section-padding position-re">
        <div class="container">
            <div class="row justify-content-between">

                <!-- Left Column: College Overview -->
                <div class="col-lg-6">
                    <div class="cont">
                        <h4 class="d-slideup wow">
                            <span class="sideup-text">
                                <span class="up-text">
                                    {!! $jsr->about_college_description ?? 'Jai Shriram Engineering College was founded in 2009 by Shenthil Velevan Trust to provide higher education blended with communal harmony to the rural community around Textile City.' !!}
                                    <span class="underline">
                                        <a href="{{ $jsr->about_college_link ?? 'https://jayshriram.edu.in/' }}" class="main-color">
                                            {{ $jsr->about_college_link ?? 'https://jayshriram.edu.in/' }}
                                        </a>
                                    </span>
                                </span>
                            </span>
                        </h4>

                        <div class="exp mt-80 md-mb15">
                            <h2 class="fz-70 numb-font">
                                {{ $jsr->count ?? '15+' }} <span class="sub-title main-font opacity-7 ml-15 text-black">Years of Excellence</span>
                            </h2>
                        </div>
                    </div>
                </div>


                
                <!-- Right Column: College Ethos & Highlights -->
                <div class="col-lg-5">
                    <div class="text">
                        <p>{{ $jsr->jsrec_description ?? 'JSREC reinforces values like knowledge, teamwork, innovation, entrepreneurship, courage, sacrifice, and duty. We view education as a complete experience, creating a world-class, eco-friendly campus enriched with greenery for holistic development.' }}</p>
                    </div>

                    <div class="main-marq o-hidden mt-100">
                        <div class="slide-har st1">
                            <div class="box">
                                <div class="item"><h4 class="d-flex align-items-center"><span>NAAC Accredited: A Grade</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Autonomous Conferred by UGC</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Innovation & Entrepreneurship</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Eco-friendly Campus</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Holistic Education</span></h4></div>
                            </div>
                            <div class="box">
                                <div class="item"><h4 class="d-flex align-items-center"><span>Community Engagement</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Research & Innovation</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Student Empowerment</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Academic Excellence</span></h4></div>
                                <div class="item"><h4 class="d-flex align-items-center"><span>Skill Development</span></h4></div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <!-- ==================== What We Offer ==================== -->
    <section class="portfolio-tab crev section-padding pt-0">
        <div class="container">
            <div class="sec-head mb-20">
                <h6 class="sub-title main-color mb-15">Our Specialize</h6>
                <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                    <h2 class="fw-600 text-u ls1">What We <span class="fw-200">Offer</span></h2>
                </div>
            </div>

            @if(!empty($jsr->program_categories) && is_array($jsr->program_categories))
                @foreach($jsr->program_categories as $category)
                    <h5 class="fw-600 {{ $loop->first ? 'mb-30' : 'mt-60 mb-30' }}">
                        {{ $category['category_name'] ?? ($loop->first ? 'UG Programmes' : 'PG Programmes') }}
                    </h5>

                    <div class="row">
                        @if(!empty($category['programs']) && is_array($category['programs']))
                            @foreach($category['programs'] as $program)
                                <div class="col-lg-4 col-md-6 mb-2">
                                    <a class="dept-card" href="#">
                                        <div class="dept-img">
                                            @if(!empty($program['icon']))
                                                <img src="{{ asset('uploads/jsr/program_icons/' . $program['icon']) }}" alt="{{ $program['title'] }}">
                                            @else
                                                <img src="{{ asset('assets/frontend/imgs/jsr/departments/default.svg') }}" alt="Department">
                                            @endif
                                        </div>
                                        <div class="dept-content">
                                            <h6>{{ $program['title'] ?? 'Program Name' }}</h6>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            @else
                <!-- Fallback – keep your original static content if no dynamic data -->
                <h5 class="fw-600 mb-30">UG Programmes</h5>
                <!-- ... your original UG cards ... -->
            @endif
        </div>
    </section>

    <!-- ==================== Testimonials ==================== -->
    <section class="testimonials-crev jsr-testimonial section-padding bg-img" 
           style="background-image: url('{{ asset('uploads/jsr/'.$jsr->testimoniol_bg_image) }}')">
     
    
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-12">
                    <div class="sec-head mb-80">
                        <h2 class="fw-600">What People <span class="fw-200">Say?</span></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-11 position-re">
                    <div class="testim-swiper testim1" data-carousel="swiper" data-loop="true" data-space="30">
                        <div id="content-carousel-container-unq-testim" class="swiper-container" data-swiper="container">
                            <div class="swiper-wrapper">

                                @if(!empty($jsr->testimoniol) && is_array($jsr->testimoniol))
                                    @foreach($jsr->testimoniol as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="item d-flex align-items-center">
                                                <div class="content ml-100">
                                                    <div class="text">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="256.721" height="208.227"
                                                 viewBox="0 0 256.721 208.227" class="qout-svg">
                                                 <path
                                                     d="M-23.723-530.169v97.327H-121.05v-68.7q0-40.076,13.359-73.472T-62.845-639.9l36.259,28.625Q-63.8-570.244-68.57-530.169Zm158.395,0v97.327H37.345v-68.7q0-40.076,13.359-73.472T95.55-639.9l36.259,28.625Q94.6-570.244,89.825-530.169Z"
                                                     transform="translate(121.55 640.568)" fill="none" stroke="#1a1a1a"
                                                     stroke-width="1" opacity="0.322">
                                                 </path>
                                             </svg>
                                                        <h4>{!! $testimonial['description'] ?? 'No testimonial available' !!}</h4>
                                                    </div>

                                                    <div class="info d-flex align-items-center pt-40 mt-40 bord-thin-top">
                                                        <div>
                                                            <h5>{{ $testimonial['name'] ?? 'Anonymous' }}</h5>
                                                        </div>

                                                        <div class="ml-auto">
                                                            <div class="rate-stars fz-14">
                                                                @php
                                                                    $stars = (int) ($testimonial['stars'] ?? 0);
                                                                @endphp

                                                                <span class="rate main-color">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="{{ $i <= $stars ? 'fas' : 'far' }} fa-star"></i>
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                          
                                    <!-- Your original 3 static testimonials as fallback -->
                                    <!-- ... paste your 3 swiper-slide items here ... -->
                               

                            </div>
                        </div>
                    </div>

                    <div class="swiper-arrow-control control-abslout">
                        <div class="swiper-button-prev"><span class="ti-arrow-left"></span></div>
                        <div class="swiper-button-next"><span class="ti-arrow-right"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Our Highlights ==================== -->
    <section class="inter-fixed-text section-padding pt-50 pb-50">
        <div class="container">
            <div class="sec-head mb-20">
                <h6 class="sub-title main-color mb-15"> {{ $jsr->our_highlights }} </h6>
                <div class="bord pt-15 bord-thin-top d-flex">
                    <h2 class="fw-600 d-rotate wow">
                        <span class="rotate-text">
                            {{-- {{ $jsr->our_highlights ?? '' }}  --}}
                            <span class="fw-200">{{ $jsr->our_highlights_subtitle ?? 'Innovators' }}</span>
                        </span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="container position-re">
            <div class="links-img">
                <div class="row">
                    @if(!empty($jsr->our_highlights_items) && is_array($jsr->our_highlights_items))
                        @foreach($jsr->our_highlights_items as $index => $item)
                            <div class="col-lg-4 items">
                                <div class="item">
                                    <div class="img" data-tab="tab-{{ $index + 1 }}">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('uploads/jsr/' . $item['image']) }}" alt="{{ $item['title'] }}">
                                        @else
                                            <img src="{{ asset('assets/frontend/imgs/placeholder.jpg') }}" alt="Highlight">
                                        @endif
                                        <a href="#" class="link-overlay"></a>
                                    </div>
                                    <div class="cont">
                                        <span class="tag"></span>
                                        <h2>{{ $item['title'] ?? 'Item Title' }}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Your original 3 static highlights as fallback -->
                    @endif
                </div>
            </div>

            <div class="links-text">
                <ul class="rest">
                    @if(!empty($jsr->our_highlights_items) && is_array($jsr->our_highlights_items))
                        @foreach($jsr->our_highlights_items as $index => $item)
                            <li id="tab-{{ $index + 1 }}">
                                <span class="tag">{{ $item['title'] ?? 'Item' }}</span>
                                <h2>{{$item['description']??'Item'}}</h2>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>
@else
    <div class="container py-5 text-center">
        <h3>No college information available.</h3>
    </div>
@endif

@endsection