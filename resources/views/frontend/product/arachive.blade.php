@extends('layouts_front.app')
@section('contentFront')

<style>

/*.work-minimal .item .img img {*/
/*    width: 100%;*/
/*    height: 310px;*/
/*}*/
.work-minimal .item .img img {
    width: 100%;
    height: 100%;
    max-height: 325px;
    object-fit:cover;
}

.w-100per{
    width:100%;
}

</style>


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main class="main-bg ">

                <header class="page-header-cerv bg-img section-padding"
                    data-background="{{ $bannerProduct ? asset('uploads/products/' . $bannerProduct->banner) : '' }}"
                    data-overlay-dark="4">

                    <div class="container pt-100 ontop">
                        <div class="text-center">
                            <h1 class="fz-100">{{ $category->catagory }}</h1>
                            <div class="mt-15 mb-4">
                                <a href="#">Home</a>
                                <span class="padding-rl-20">|</span>

                                <span class="text-white">{{ $category->catagory }}</span>

                            </div>
                        </div>
                    </div>
                </header>
                {{-- DESCRIPTION BLOCK --}}
                <section class="services-details section-padding pb-30 pt-30">
                    <div class="container">
                        <div class="row mt-50">
                            <div class="col-lg-12">
                                <div class="text md-mb50">
                                       <h5 class="fw-600 ">{{ $archiveContent ? $archiveContent->title : 'Our Products' }}</h5>
                                    <p class="mt-10">
                                        {{ $archiveContent && $archiveContent->description ? $archiveContent->description : 'Barani Hydraulics is a market leader in the design and manufacture of custom-built hydraulic presses that cater to a wide spectrum of industrial applications. With over three decades of engineering expertise, our presses are known for their precision, reliability, and superior performance. Each machine is designed to deliver exceptional accuracy, automation, and productivity — empowering our clients to achieve consistent, high-quality output. We continually innovate to integrate advanced control systems, energy-efficient designs, and user-friendly interfaces that enhance operational efficiency. To learn more about detailed specifications, explore automation options, or request a custom quotation, please get in touch with our sales team.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- PRODUCTS LIST --}}
                <section class="work-minimal products-archive pt-30 section-padding">
                    <div class="container-xxl">
                        <div class="row">

                            <!-- FILTER -->
                            <div class="filtering col-12">
                                <div class="filter">
                                    <span class="text">Filter By :</span>
                                    <span data-filter='*' class='active'>Show All</span>

                                    @foreach ($categories as $cat)
                                        <span data-filter=".{{ $cat->slug }}">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="gallery row stand-marg">

                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 items {{ $product->category->slug }}">
                                    <div class="item mt-40">
                                        <a href="{{ route('product.detail', $product->slug) }}" class="project-link w-100per">
                                           {{-- <!--<div class="img">-->
                                            <!--   <img src="{{ asset('uploads/products/' . $product->product_image) }}"-->
                                            <!--        alt="{{ $product->product_title }}">-->--}}
                                                @php
                                                    $images = [];
                                                
                                                    if ($product->product_image) {
                                                        $decoded = json_decode($product->product_image, true);
                                                        $images = is_array($decoded) ? $decoded : [$product->product_image];
                                                    }
                                                
                                                    $firstImage = $images[0] ?? null;
                                                @endphp
                                                <div class="img">
                                                <img
                                                src="{{ $firstImage
                                                        ? asset('uploads/products/' . $firstImage)
                                                        : asset('assets/imgs/placeholder.webp') }}"
                                                    alt="{{ $product->product_title }}">

                                                <div class="cont d-flex align-items-center">
                                                    <div>
                                                        <h5 class="fz-22">{{ $product->product_title }}</h5>
                                                        <p>{{ Str::limit($product->product_description, 80) }}</p>
                                                    </div>

                                                    <div class="ml-auto">
                                                        <span class="ti-arrow-top-right"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </section>

            </main>
        </div>
    </div>
@endsection
