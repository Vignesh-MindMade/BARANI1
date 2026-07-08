@extends('layouts_front.app')
@section('contentFront')
    <header class="page-header-cerv bg-img section-padding"
        data-background="{{ $page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/frontend/images/banner/Design&development.webp') }}"
        data-overlay-dark="4">
        <div class="container pt-100 ontop">
            <div class="text-center">
                <h1 class="fz-100">{{ $page->banner_title ?? 'Capabilities' }}
                </h1>
                <div class="mt-15 mb-4">
                    <a href="#">Home</a>
                    <span class="padding-rl-20">|</span>
                    <span class="text-white">{{ $page->banner_title ?? 'Capabilities' }}</span>
                </div>
            </div>
        </div>
    </header>

    <!-- ==================== Start Slider ==================== -->
    <div class="header-project2 section-padding pb-0">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="full-width ">
                        <h3 class="mb-10">{{ $page->intro_title ?? '' }}</h3>
                        <p>{{ $page->intro_description }}</p>
                    </div>
                </div>

                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>



    <div class="head-img o-hidden mt-50 mb-50 m-400px boost gsap-parallax">
        @if($page->parallax_image)
            <img src="{{ asset('storage/' . $page->parallax_image) }}" alt="parllax-image" data-speed="0.2" data-lag="0">
        @else
            <img src="https://sigmadigitec.in/barani/assets/frontend/imgs/cap/Picture3.jpeg" alt="parllax-image-of-factory"
                data-speed="0.2" data-lag="0">
        @endif
    </div>

    <div class="page-header-cerv bg-img mt-50 mb-50 m-400px waste section-padding"
        data-background="{{ $page->parallax_image ? asset('storage/' . $page->parallax_image) : asset('assets/frontend/imgs/cap/Picture3.jpeg') }}">
    </div>

    <!-- ==================== Start Services ==================== -->

    <section class=" section-padding pt-0">
        <div class="container">
            <div class="sec-head mb-80">
                
                <!-- Optional Subtitle could go here if added to backend -->
                <h6 class="sub-title main-color text-center mb-25">{{ $page->services_subtitle ?? 'Our presses are built on cutting-edge technologies that redefine performance and control' }}</h6>

            </div>
            <div class="capabalities row justify-content-center flex-nowrap gap-5">

                @if(is_array($page->press_sections))
                    @foreach($page->press_sections ?? [] as $section)
                        <div class="all-items-box col-lg-5 col-md-12">
                            <h5>{{ $section['title'] ?? '' }}</h5>

                    @foreach($section['features'] ?? [] as $feature)
                        <div class="item-box radius-15">
                            <h6 class="mb-10">
                                {{ $feature['point_title'] ?? '' }}
                            </h6>
                            <p>{{ $feature['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </section>

{{-- Main features --}}
   <section class="main-feat section-padding bg-img bg-blue">
    <div class="container alternate-rows">

        @foreach($page->main_features ?? [] as $index => $feature)
            <div class="row justify-content-between  align-items-center">

                @if($index % 2 === 0)
                    <!-- Image Left -->
                    <div class="col-lg-6">
                        <div class="img md-mb50">
                        @if(!empty($feature['image']))
                            <img src="{{ asset('storage/'.$feature['image']) }}"
                                 class="radius-15 w-100"
                                alt="{{ $feature['title'] ?? '' }}">
                        @endif
                        </div>
                    </div>
                @endif

                <!-- Text -->
                <div class="col-lg-5">
                      <div class="text  ">
                  <h4>{{ $feature['title'] ?? '' }}</h4>


                    @foreach($feature['points'] ?? [] as $point)
                        <p>
                            <span>{{ $point['point_title'] }}:</span>
                            {{ $point['description'] }}
                        </p>
                    @endforeach
                    </div>
                </div>

                @if($index % 2 !== 0)
                    <!-- Image Right -->
                    <div class="col-lg-6">
                         <div class="img md-mb50">
                        @if(!empty($feature['image']))
                            <img src="{{ asset('storage/'.$feature['image']) }}"
                                 class="radius-15 w-100"
                                 alt="{{ $feature['title'] }}">
                        @endif
                        </div>
                    </div>
                @endif

            </div>
        @endforeach

    </div>
</section>


    <section class="page-intro-cerv  cap-3-box-sec section-padding pt-50">
        <div class="container">
            <div class="row">
                @php
                    $bottomItems = is_array($page->bottom_section_items) ? $page->bottom_section_items : [];
                @endphp

                @if(count($bottomItems) >= 3)
                    <div class="col-lg-8 bord-thin-right rest">
                        <div class="row justify-content-end rest">

                            <!-- Item 1 (Top Left in Grid) -->
                            <div class="col-md-6 rest">
                                <div class="cont">
                                    <h4>{{ $bottomItems[0]['title'] ?? '' }}</h4>
                                    <div class="text mt-30">
                                        <p>{{ $bottomItems[0]['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 rest">
                                <div class="img fit-img bord-thin-left">
                                    @if(!empty($bottomItems[0]['image']))
                                        <img src="{{ asset('storage/' . $bottomItems[0]['image']) }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end  rest">
                            <!-- Item 2 (Bottom Left in Grid) -->
                            <div class="col-md-6 rest">
                                <div class="img fit-img">
                                    @if(!empty($bottomItems[1]['image']))
                                        <img src="{{ asset('storage/' . $bottomItems[1]['image']) }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 rest">
                                <div class="cont bord-thin-left">
                                    <h4>{{ $bottomItems[1]['title'] ?? '' }}</h4>
                                    <div class="text mt-30">
                                        <p>{{ $bottomItems[1]['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 (Right Column) -->
                    <div class="col-lg-4 rest">
                        <div class=" position-re">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="cont">
                                        <h4>{{ $bottomItems[2]['title'] ?? '' }}</h4>
                                        <div class="text mt-30">
                                            <p>{{ $bottomItems[2]['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="img border-thin-top fit-img ">
                                        @if(!empty($bottomItems[2]['image']))
                                            <img src="{{ asset('storage/' . $bottomItems[2]['image']) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>



@endsection