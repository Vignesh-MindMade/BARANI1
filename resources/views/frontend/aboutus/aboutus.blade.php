@extends('layouts_front.app')
@section('contentFront')
    <style>
        .slick-track {
            will-change: transform;
        }
        
        
.person.manager-card {
    width: 200px;
    height: 210px;
}
    </style>
    @foreach ($FaciltiesHeadings as $FaciltiesHeading)
        {{-- Page Header --}}
        <header class="page-header-cerv bg-img section-padding"
            data-background="{{ asset('images/' . $FaciltiesHeading->banner_image) }}" data-overlay-dark="4">
            <div class="container pt-100 ontop">
                <div class="text-center">
                    <h1 class="fz-100">About Us</h1>
                    <div class="mt-15 mb-4">
                        <a href="#">Home</a>
                        <span class="padding-rl-20">|</span>
                        <span class="text-white">About Us</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Introduction Section --}}
        <section class="crev-agency-header" style="padding:35px 0px;"> <!-- add style -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 valign center-clumn">
                        <div>
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-5">Know More about us</h6>
                                <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                                    <h2>About <span class="fw-200">Us</span></h2>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-10 col-md-10"> <!--  offset-1 -->
                                    <p class="preserve-text" style="text-align:left">{{ $FaciltiesHeading->aboutus_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 right-clumn">
                        <div class="img">
                            <img src="{{ asset('images/' . $FaciltiesHeading->aboutus_image_1) }}"
                                alt="Barani Group Facility">
                        </div>
                    </div>
                    <div class="d-none d-sm-block col-sm-5 col-lg-3 left-clumn">
                        <div class="img">
                            <img src="{{ asset('images/' . $FaciltiesHeading->aboutus_image_2) }}" alt="Barani Group Team">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Values Section --}}
        <section class="testim-crev section-padding pt-50 pb-50 sub-bg" data-scroll-index="4">
            <div class="container">
                <div class="sec-head mb-30">
                    <h6 class="sub-title main-color mb-5">What we Work For</h6>
                    <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                        <h2>Our <span class="fw-200">Values</span></h2>
                    </div>
                </div>
                <div class="d-grid mi-vi-grid">

                    <div class="item bord-box radius-15">
                        <div class="content">
                            <div class="text">
                                <span class="tag sub-title mb-30">Mission</span>
                                <p>{{ $FaciltiesHeading->mission_description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="item bord-box radius-15">
                        <div class="content">
                            <div class="text">
                                <span class="tag sub-title mb-30">Vision</span>
                                <p>{{ $FaciltiesHeading->vission_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    {{-- Quality Policy Section --}}

    @foreach ($curriculams as $curriculam)
        <section class="team-single quality-policy section-padding pb-50 pt-50">
            <div class="container">
                <div class="row xlg-marg">
                    <div class="col-lg-6 d-c-c">
                        <div class="img radius-10">
                            <img src="{{ asset('images/' . $curriculam->banner) }}" alt="Quality Assurance">
                        </div>
                    </div>
                    <div class="col-lg-6 valign">
                        <div class="cont">
                            <div class="text box-sh-con main-bg mt-30">
                                <h4 class="mb-20 main-color">{{ $curriculam->cbse_curriculum_standards }}</h4>
                                <p>{{ $curriculam->minimum_age_rules_paragraph }}</p>
                                <h6 class="sub-title mt-30">Towards this commitment we shall:</h6>

                                <ul class="rest list-arrow feature-list">
                                    @foreach (preg_split("/\r\n|\n|\r|,|;/", $curriculam->minimum_age_rules_points) as $point)
                                        @if (!empty(trim($point)))
                                            <li>
                                                <span class="icon">
                                                    <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                            fill="#002359" />
                                                    </svg>
                                                </span>
                                                <h6 class="inline fw-400">{{ trim($point) }}</h6>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    {{-- History Timeline Section --}}
    <section class="timeline-carousel bg-main-blue main-feat ">
        <div class="container sec-head">
            <div class="row">
                <div class="col-lg-10">
                    <div class="sec-head mb-30">
                        <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                            <h2 class="text-white">Our <span class="fw-200">History</span></h2>
                        </div>
                    </div>
                    <div class="text text-white mb-40">
                        <p class="text-white">{{ $FaciltiesHeadings->first()->history_description ?? '' }} </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="timeline-carousel__item-wrapper container" data-js="timeline-carousel">

                        @foreach ($Facilties as $Faciltie)
                            <div class="timeline-carousel__item color">
                                <div class="timeline-carousel__image">
                                    <div class="media-wrapper media-wrapper--overlay"
                                        style="background: url('{{ asset('images/' . $Faciltie->image2) }}') center center; background-size:cover;">
                                    </div>
                                </div>
                                <div class="timeline-carousel__item-inner">
                                    <span class="year">{{ $Faciltie->title }}</span>
                                    <p>{{ $Faciltie->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
{{---Awards---}}
 {{--   <section class="about-crev awards-section radius-30">
        <div class="brands-crev revers-bg simple">
            <div class="container container-md-95">
                <div class="row ">
                    <div class="col-lg-4 ">
                        <div class="sec-head pb-0">
                            <h6 class="sub-title main-color mb-5">View Our Achievements</h6>
                            <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                                <h2>View <span class="fw-200">Awards</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 order-md-1">
                        <div class="row justify-content-end">
                            <div class="col-xxl-2 col-lg-3 col-md-4 col-6"></div>
                            <div class="col-xxl-2 col-lg-3"></div>

                            @foreach ($Viewawards as $Viewaward)
                                <div class="col-xxl-2 col-lg-3 col-md-4 col-6 item">
                                    <div class="img">
                                        <img src="{{ asset('images/' . $Viewaward->award_image) }}"
                                            alt="Entrepreneurship Appreciation Award 2008">
                                        <p class="awards-description">{{ $Viewaward->title }}</p>
                                    </div>
                                    <span class="top-left">
                                        <svg viewbox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-23 2xl:w-[3.2rem] h-auto">
                                            <rect y="11" width="23" height="0.671958" fill="#222"></rect>
                                            <rect x="12" width="23" height="0.671957" transform="rotate(90 12 0)"
                                                fill="#222"></rect>
                                        </svg>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
        
    <!--award model popup-->
    <section class="about-crev awards-section radius-30">
    <div class="brands-crev revers-bg simple">
        <div class="container container-md-95">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sec-head pb-0">
                        <h6 class="sub-title main-color mb-5">View Our Achievements</h6>
                        <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                            <h2>View <span class="fw-200">Awards</span></h2>
                        </div>
                    </div>
                </div>

                <div class="col-12 order-md-1">
                    <div class="row justify-content-start">
                         <div class="col-xxl-2 col-lg-3 col-md-4 col-6"></div>
                            <div class="col-xxl-2 col-lg-3 col-md-4 col-6"></div>

                        <!-- AWARD ITEM -->
                    @foreach($Viewawards as $Viewaward)
                        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 item award-item"
                             data-images='@json(collect($Viewaward->images ?? [])->map(fn($img) => asset('images/' . $img))->values())' data-title="{{ $Viewaward->title }}"
                             data-title="{{$Viewaward->title}}"
                             data-description="{{$Viewaward->view_awards_description}}">

                            <div class="img">
                                <img src="{{ asset('images/' . $Viewaward->award_image) }}" alt="{{$Viewaward->title}}">
                                <p class="awards-description">{{ $Viewaward->title }}</p>
                            </div>
                            <span class="top-left">
                                        <svg viewbox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-23 2xl:w-[3.2rem] h-auto">
                                            <rect y="11" width="23" height="0.671958" fill="#222"></rect>
                                            <rect x="12" width="23" height="0.671957" transform="rotate(90 12 0)"
                                                fill="#222"></rect>
                                        </svg>
                                    </span>
                        </div>
                    @endforeach
               
                        

                    </div>
                </div>

            </div>
        </div>
    </div>
</section> 

   

{{---Certificates---}}
    <section class="certificate-section section-padding">
        <div class="container">
            <div class="col-lg-4 md-hide">
                <div class="sec-head pb-0">
                    <h6 class="sub-title main-color mb-5">View Our Certificates</h6>
                    <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                        <h2>View <span class="fw-200">Certificates</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="filtering col-12 mb-30 mt-20">
                    <div class="filter">
                        <!-- All Certificates -->
                        {{-- <span data-filter="*" class="active">All Certificates</span> --}}

                        <!-- Dynamic Certificate Categories -->
                        @foreach ($ViewCertficates->groupBy('view_certficate_title') as $titleId => $certGroup)
                            @php
                                $title = \App\Models\ViewCertficateTitle::find($titleId);
                            @endphp
                            @if ($title)
                                <span data-filter=".title-{{ $title->id }}"
                                    class="{{ $loop->first ? 'active' : '' }}">{{ $title->title }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="gallery row cert-gal">
                @foreach ($ViewCertficates as $cert)
                    @if ($cert->title)
                        <div class="items title-{{ $cert->title->id }}">
                            <div class="cert-item">
                                <img src="{{ asset('images/' . $cert->image) }}" alt="{{ $cert->title->title }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    
    

    {{-- Team Section --}}

    <!-- Team Member -->


   <!-- Team Member -->
    <section class="work-stand section-padding mt-80 sub-bg">
                    <div class="container">
                        <div class="sec-head mb-30">
                            <h6 class="sub-title main-color mb-5 text-center">Meet Our Team</h6>
                            <div class="bord pt-15 bord-thin-top pr-0 d-flex align-items-center justify-content-center">
                                <h2>Our <span class="fw-200">Team</span></h2>
                            </div>
                        </div>
                        <div class="team-tree">
                            <div class="tree">
                              <ul>
                                    @if($teamtests)
                                        <li>
                                            <div class="person">
                                                <img src="{{ $teamtests->manging_director_image ? asset($teamtests->manging_director_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->manging_director_name }}">
                                                <h5>{{ $teamtests->manging_director_name ?? 'Managing Director' }}</h5>
                                                <p>
                                                    {!! implode('<br>', explode(',', $teamtests->manging_director_designation ?? 'Managing Director')) !!}
                                                </p>
                                            </div>
                                            <ul class="team-branch-join">
                                                <li class="joined-list-team">
                                                    <div class="combine-tree">
                                                        @if($teamtests->works_director_name)
                                                            <div class="person">
                                                                <img src="{{ $teamtests->works_director_image ? asset($teamtests->works_director_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->works_director_name }}">
                                                                <h5>{{ $teamtests->works_director_name }}</h5>
                                                                <p>
                                                                    {!! implode('<br>', explode(',', $teamtests->works_director_designation ?? 'Works Director')) !!}
                                                                </p>
                                                            </div>
                                                        @endif

                                                        @if($teamtests->technical_director_name)
                                                            <div class="person top-line">
                                                                <img src="{{ $teamtests->technical_director_image ? asset($teamtests->technical_director_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->technical_director_name }}">
                                                                <h5>{{ $teamtests->technical_director_name }}</h5>
                                                                <p>{!! implode('<br>', explode(',', $teamtests->technical_director_designation ?? 'Technical Director')) !!}</p>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if($teamtests->works_director_and_technical_director_name)
                                                        <div class="double-parent">
                                                            <div class="pt-20">
                                                                <div class="person">
                                                                    <img src="{{ $teamtests->works_director_and_technical_director_image ? asset($teamtests->works_director_and_technical_director_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->works_director_and_technical_director_name }}">
                                                                    <h5>{{ $teamtests->works_director_and_technical_director_name }}</h5>
                                                                    <p>{!! implode('<br>', explode(',', $teamtests->works_director_and_technical_director_designation ?? 'Technical Director')) !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </li>
                                                
                                                @if($teamtests->director_name)
                                                    <li class="last-child-team-2nd" >
                                                        <div class="person">
                                                            <img src="{{ $teamtests->director_image ? asset($teamtests->director_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->director_name }}">
                                                            <h5>{{ $teamtests->director_name }}</h5>
                                                            <p>{!! implode('<br>', explode(',', $teamtests->director_designation ?? 'Director')) !!}</p>
                                                        </div>

                                                        @if($teamtests->gm_operations_one_name || $teamtests->gm_operations_two_name)
                                                            <ul>
                                                                @if($teamtests->gm_operations_one_name)
                                                                    <li>
                                                                        <div class="person">
                                                                            <img src="{{ $teamtests->gm_operations_one_image ? asset($teamtests->gm_operations_one_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->gm_operations_one_name }}">
                                                                            <h5>{{ $teamtests->gm_operations_one_name }}</h5>
                                                                            <p>{!! implode('<br>', explode(',', $teamtests->gm_operations_one_designation ?? 'GM Operations')) !!}</p>
                                                                        </div>
                                                                    </li>
                                                                @endif

                                                                @if($teamtests->gm_operations_two_name)
                                                                    <li>
                                                                        <div class="person">
                                                                            <img src="{{ $teamtests->gm_operations_two_image ? asset($teamtests->gm_operations_two_image) : asset('uploads/team/default.png') }}" alt="{{ $teamtests->gm_operations_two_name }}">
                                                                            <h5>{{ $teamtests->gm_operations_two_name }}</h5>
                                                                            <p>{!! implode('<br>', explode(',', $teamtests->gm_operations_two_designation ?? 'GM Operations')) !!}</p>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>  ..



                    </div>
                </section>





    <!-- Optional: Add AOS library for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js'></script>
    <script>
        $.js = function(el) {
            return $("[data-js=" + el + "]");
        };

        function carousel() {
            $.js("timeline-carousel").slick({
                infinite: true,
                arrows: false,
                dots: false,
                autoplay: true,
                autoplaySpeed: 0,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 8000,
                cssEase: 'linear',
                swipe: true,
                touchMove: true,
                slidesToShow: 3.6,
                slidesToScroll: 1,

                responsive: [{
                        breakpoint: 1440, // Large desktop
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 1200, // Regular desktop
                        settings: {
                            slidesToShow: 2.5,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 1024, // Tablet landscape
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768, // Tablet portrait
                        settings: {
                            slidesToShow: 1.3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480, // Mobile
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '20px'
                        }
                    }
                ],
            });
        }

        carousel();
        // Certificate Filter JavaScript
        $(document).ready(function() {
            // Initially, hide all certificate items and show only the first one
            $('.gallery .items').hide();
            // $('.gallery .items').first().show();
            var activeFilter = $('.filter span.active').data('filter');
            $(activeFilter).show();

            // Filter click handler
            $('.filter span').on('click', function() {
                // Remove active class from all filters and add to clicked
                $(this).addClass('active').siblings().removeClass('active');

                // Get the filter value
                var filterValue = $(this).data('filter');

                // Hide all items
                $('.gallery .items').hide();

                // Show all items matching the filter (full group for the selected category)
                $(filterValue).show();
            });
        });
    </script>
    
    
    <!--awards modelpoup-->
    



@endsection
