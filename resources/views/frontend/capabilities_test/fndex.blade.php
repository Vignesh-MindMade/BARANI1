@extends('layouts_front.app')

@section('contentFront')

@php
    $cap = $capabilities ?? null;
    $imgPath = asset('frontend/imgs/capabilities');
@endphp

<header class="page-header-cerv bg-img section-padding" 
    data-background="{{ $imgPath }}/{{ $cap->capabilities_parallax_image ?? 'default.jpg' }}" data-overlay-dark="4">
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">{{ $cap->capabilities_title ?? 'Capabilities' }}</h1>
            <div class="mt-15 mb-4">
                <a href="{{ url('/') }}">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Capabilities</span>
            </div>
        </div>
    </div>
</header>

<!-- ==================== Start Slider ==================== -->
<header class="header-project2 section-padding pb-0">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-12 text-center">
                <h3 class="mb-10">{{ $cap->capabilities_title ?? 'Capabilities Overview' }}</h3>
                <p>{{ $cap->capabilities_desc ?? '' }}</p>
            </div>
        </div>
    </div>
</header>

<section class="page-intro-cerv section-padding pt-50">
    <div class="container">
        <div class="row">
            <!-- Workflow Section 1 -->
            <div class="col-lg-8 bord-thin-right rest">
                <div class="row justify-content-end rest">
                    <div class="col-md-6 rest">
                        <div class="cont">
                            <div class="mb-40"><h2 class="fz-100 numb-font">1.</h2></div>
                            <h4>{{ $cap->capabilities_workflow_section1_title ?? 'Design & Engineering' }}</h4>
                            <div class="text mt-30">
                                <p>{{ $cap->capabilities_workflow_section1_desc ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 rest">
                        <div class="img fit-img bord-thin-left">
                            @if(!empty($cap->capabilities_workflow_section1_image))
                                <img src="{{ $imgPath }}/{{ $cap->capabilities_workflow_section1_image }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Workflow Section 2 -->
                <div class="row justify-content-end bord-thin-top rest">
                    <div class="col-md-6 rest">
                        <div class="img fit-img">
                            @if(!empty($cap->capabilities_workflow_section2_image))
                                <img src="{{ $imgPath }}/{{ $cap->capabilities_workflow_section2_image }}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 rest">
                        <div class="cont bord-thin-left">
                            <div class="mb-40"><h2 class="fz-100 numb-font">2.</h2></div>
                            <h4>{{ $cap->capabilities_workflow_section2_title ?? 'Manufacturing Excellence' }}</h4>
                            <div class="text mt-30">
                                <p>{{ $cap->capabilities_workflow_section2_desc ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workflow Section 3 -->
            <div class="col-lg-4">
                <div class="bord-thin-top mt-100 position-re">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="cont">
                                <div class="mb-40"><h2 class="fz-100 numb-font">3.</h2></div>
                                <h4>{{ $cap->capabilities_workflow_section3_title ?? 'Automation & Control' }}</h4>
                                <div class="text mt-30">
                                    <p>{{ $cap->capabilities_workflow_section3_desc ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11 rest">
                            <div class="img border-thin-top fit-img ">
                                @if(!empty($cap->capabilities_workflow_section3_image))
                                    <img src="{{ $imgPath }}/{{ $cap->capabilities_workflow_section3_image }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Engineering Strength Section -->
<section class="services-details section-padding pt-30 pb-30">
    <div class="container">
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-5 ">Our Core Capabilities</h6>
            <div class="bord pt-15 bord-thin-top pr-0 ">
                <h2>{{ $cap->capabilities_workflow_engineering_strength_title ?? 'Engineering' }} 
                    <span class="fw-200">Strength</span></h2>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-lg-4">
                <div class="text md-mb50">
                    <p>{{ $cap->capabilities_workflow_engineering_strength_desc ?? '' }}</p>
                </div>
            </div>
    
            
            <div class="col-lg-8">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @php
            $points = array_filter(array_map('trim', explode(',', $cap->capabilities_workflow_engineering_strength_points ?? '')));
        @endphp

        @foreach(collect($points)->chunk(3) as $chunk)
            <div class="col">
                <ul class="rest list-arrow mb-0">
                    @foreach($chunk as $point)
                        <li class="nowrap mt-10">
                            <span class="icon"> 
                            <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                    fill="#00225a"></path>
                                            </svg></span>
                            <h6 class="inline fw-400">{{ $point }}</h6>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
       
        </div>
    </div>
</section>

<!-- Parallax Image -->
@if(!empty($cap->capabilities_parallax_image))
<div class="head-img o-hidden mt-50 mb-50 m-400px">
    <img src="{{ $imgPath }}/{{ $cap->capabilities_parallax_image }}" alt="" data-speed="0.2" data-lag="0">
</div>
@endif

<!-- Quality & Environmental Section -->
<section class="section-padding pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4 class="mb-50 ">{{ $cap->capabilities_quality_environmental_systems_title ?? 'Quality & Environmental Systems' }}</h4>
            </div>
            <div class="col-lg-8 pl-40">
                <div class="text indust-used">
                    <p class="mb-30">{{ $cap->capabilities_quality_environmental_systems_desc ?? '' }}</p>
                </div>
            </div>
        </div>

        <div class="row serv-imgs mt-30">
            <div class="col-lg-4">
                @if(!empty($cap->capabilities_quality_environmental_systems_left_image))
                    <div class="img o-hidden radius-15 fit-img md-mb30">
                        <img src="{{ $imgPath }}/{{ $cap->capabilities_quality_environmental_systems_left_image }}" alt="">
                    </div>
                @endif
            </div>
            <div class="col-lg-8">
                @if(!empty($cap->capabilities_quality_environmental_systems_right_image))
                    <div class="img o-hidden radius-15">
                        <img src="{{ $imgPath }}/{{ $cap->capabilities_quality_environmental_systems_right_image }}" alt="" data-speed="auto" data-lag="0">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="faqs section-padding pt-30">
    <div class="container">
        <div class="row justify-content-between">

            {{-- FAQ MAIN TITLE --}}
            <div class="sec-head mb-30">
                <h6 class="sub-title main-color mb-5">
                    Frequently Asked Questions
                </h6>
                <div class="bord pt-15 bord-thin-top pr-0">
                    <h2>{{ $faqs->first()->faq_title ?? 'Frequently Asked Questions' }}</h2>
                </div>
            </div>

            <div class="col-lg-12 valign">
                <div class="full-width">
                    <div class="list-serv">
                        <div class="accordion bord">

                            @foreach($faqs as $index => $faq)
                            <div class="item mb-15 wow fadeInUp {{ $index === 0 ? 'active' : '' }}"
                                 data-wow-delay=".{{ $index + 1 }}s">

                                <div class="title">
                                    <h6>{{ $faq->faq_question }}</h6>
                                    <span class="ico ti-plus"></span>
                                </div>

                                <div class="accordion-info">
                                    <p>{{ $faq->faq_answers }}</p>
                                </div>

                            </div>
                            @endforeach

                            @if($faqs->isEmpty())
                                <p class="text-muted">No FAQs added yet.</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
