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
    </style>

    @foreach ($PressedComponents as $PressedComponent)
        <div id="smooth-wrapper">
            <div id="smooth-content">
                <main class="main-bg ">
                    <header class="page-header-cerv bg-img section-padding"
                        data-background="{{ asset('images/' . $PressedComponent->banner_image) }}" data-overlay-dark="4">
                        <div class="container pt-100 ontop">
                            <div class="text-center">
                                <h1 class="fz-100">{{ $PressedComponent->banner_title }}
                                </h1>
                                <div class="mt-15 mb-4">
                                    <a href="#">Home</a>
                                    <span class="padding-rl-20">|</span>
                                    <span class="text-white">{{ $PressedComponent->banner_title }}</span>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="header-project2 section-padding pb-0">
                        <div class="container">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
                                    <div class="full-width text-center">

                                        <p>{{ $PressedComponent->description }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                    </div>

                    <section class=" cap-unit section-padding bg-img pb-0">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $PressedComponent->capabilities_title }}</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1"> {{ $PressedComponent->capabilities_subtitle }}</h2>

                                </div>
                            </div>

                            <div class="row justify-content-between">

                                <div class="col-lg-12">
                                    <div class="row">

                                        @if (is_array($PressedComponent->capabilities_cards))
                                            @foreach ($PressedComponent->capabilities_cards as $card)
                                                <div class="col-md-4">
                                                    <div class="item mb-50">
                                                        <h5 class="mb-15">
                                                            {{ $card['title'] ?? '' }}
                                                        </h5>
                                                        <p>
                                                            {{ $card['description'] ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="services-dots section-padding sub-bg radius-30 pb-60 ">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $PressedComponent->industries_title }}</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1"> {{ $PressedComponent->industries_subtitle }}</h2>

                                </div>
                            </div>

                            <div class="industries-grid  ontop">

                                @if (is_array($PressedComponent->industries_icons))
                                    @php
                                        $industriesNames = is_string($PressedComponent->industries_name ?? '')
                                            ? json_decode($PressedComponent->industries_name, true) ?? []
                                            : [];
                                    @endphp
                                    @foreach ($PressedComponent->industries_icons as $index => $icon)
                                        <div class="item md-mb50">
                                            <img class="stan-img" src="{{ asset('images/' . $icon) }}"
                                                alt="{{ $industriesNames[$index] ?? '' }}">
                                            <h5>{{ $industriesNames[$index] ?? '' }}</h5>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </section>

                    <section class="work-carsouel section-padding  pt-50 pb-50  position-re o-hidden">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">Our Products</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1">Featured products</h2>
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
                                    <div class="work-crus work-crus5 out" data-carousel="swiper" data-items="5"
                                        data-center="center" data-loop="true" data-space="30" data-swiper-speed="1000">
                                        <div id="content-carousel-container-unq-w" class="swiper-container"
                                            data-swiper="container">
                                            <div class="swiper-wrapper">

                                                @foreach ($Productss as $product)
                                                    <div class="swiper-slide">
                                                        <div class="item">
                                                            <div class="img">
                                                                <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                    alt="{{ $product->product_title }}" alt="">
                                                                <div class="cont">
                                                                    <span
                                                                        class="mb-5">{{ $product->product_title }}</span>
                                                                    <h6 class="fz-18">
                                                                        {{ Str::limit($product->product_description, 80) }}
                                                                    </h6>
                                                                </div>
                                                                <a href="{{ route('product.detail', $product->slug) }}"
                                                                    class="plink"></a>
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

                    <!-- ==================== Start Skills ==================== -->

                    <section class="skills-img section-padding position-re">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div class="col-lg-4">
                                    <div class="img md-mb50">
                                        <img src="{{ asset('images/' . $PressedComponent->manufacturing_capability_image) }}"
                                            alt="" class="radius-30">

                                    </div>
                                </div>
                                <div class="col-lg-6 valign">
                                    <div class="content full-width">
                                        <div class="sec-head mb-30">
                                            <h6 class="sub-title main-color mb-15">
                                                {{ $PressedComponent->manufacturing_capability_title }}</h6>
                                            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                                <h2 class="fw-600 text-u ls1">
                                                    {{ $PressedComponent->manufacturing_capability_subtitle }}</h2>

                                            </div>
                                        </div>
                                        <div class="row justify-content-start">
                                            <div class="col-lg-11">
                                                <div class="text">
                                                    <p>{{ $PressedComponent->manufacturing_capability_description }}</p>
                                                </div>


                                                @if (is_array($PressedComponent->infrastructure_equipments))
                                                    @foreach ($PressedComponent->infrastructure_equipments as $equipment)
                                                        <div class="text mt-30 spec-press">
                                                            <h5>{{ $equipment['title'] ?? '' }}</h5>

                                                            <p>
                                                                <span>Total Area:</span>
                                                                {{ $equipment['total_area'] ?? '' }}
                                                            </p>

                                                            <p>
                                                                <span>Production Floor:</span>
                                                                {{ $equipment['production_floor'] ?? '' }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <!-- ==================== End Skills ==================== -->

                    <section class="standards-table section-padding  pt-50 pb-50  position-re o-hidden">
                        <div class="container">
                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $PressedComponent->core_processes_title }}</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1"> {{ $PressedComponent->core_processes_subtitle }}</h2>

                                </div>
                            </div>
                            <div class="row justify-content-around">


                                {!! $PressedComponent->core_processes_table !!}

                            </div>

                        </div>


                    </section>

                    <section class="standards-table section-padding pt-50 pb-50 position-re o-hidden">
                        <div class="container">

                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">QUALITY & INSPECTION</h6>
                                <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600 text-u ls1"> INSPECTION <span class="fw-200"> EQUIPMENTS</span></h2>
                                </div>
                            </div>

                            <div class="row col-12 col-lg-8 table-content">

                                {!! $PressedComponent->quality_inspection_table !!}


                            </div>


                        </div>
                    </section>



                    <section class="blog-list-crev section-padding sub-bg">
                        <div class="container">

                            <div class="sec-head mb-30">
                                <h6 class="sub-title main-color mb-15">{{ $PressedComponent->technology_range_title }}
                                </h6>
                                <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                                    <h2 class="fw-600">{{ $PressedComponent->technology_range_subtitle }}</h2>

                                </div>
                            </div>
    @endforeach
    <div class="tech-auto">

        @if (is_array($PressedComponent->technology_range_cards))
            @foreach ($PressedComponent->technology_range_cards as $card)
                <div class="item sub-bg2 wow fadeInUp" data-wow-delay=".1s">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cont">
                                <h5 class="mb-10 underline">
                                    {{ $card['title'] ?? '' }}
                                </h5>
                                <p>
                                    {{ $card['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Background img -->
                    <div class="background bg-img valign text-center"
                        data-background="{{ isset($card['image']) ? asset('images/' . $card['image']) : '' }}"
                        data-overlay-dark="4">
                    </div>
                </div>
            @endforeach
        @endif


    </div>

    </div>
    </section>

    <!-- ==================== Start Points Section ==================== -->
    
    <section class="services-dots section-padding indust-used radius-30 pb-20 pt-0">
        <div class="container">
            <h5 class="mb-15">{{ $PressedComponent->point_section_title }}</h5>

            @php
                $pointsArray = is_string($PressedComponent->point_title ?? '')
                    ? json_decode($PressedComponent->point_title, true) ?? []
                    : [];
            @endphp

            @if (!empty($pointsArray))
                <div class="row xlg-marg ontop ml-10 mr-50">
                    @foreach ($pointsArray as $point)
                        <div class="col-12 col-sm-4 col-lg-3">
                            <div class="item md-mb50">
                                <h6>{{ $point['title'] ?? '' }}</h6>
                                <div class="text mt-15">
                                    @if (!empty($point['description']))
                                        <ul class="rest dot-list fz-18">
                                            @foreach (explode(',', $point['description']) as $item)
                                                <li class="mb-10">{{ trim($item) }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- ==================== End Points Section ==================== -->

    </main>

@endsection
