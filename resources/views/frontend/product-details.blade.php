@extends('layouts-front.app')
@section('content')

    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area project-bread position-relative" style="background-image: url(assets/images/banner/career-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">{{ $product->productTextile->catagory_name }}</span>
                        <h1 class="title">
                            {{ $product->product_name }}
                        </h1>
                        <div class="nav-area-navigation">
                            <a href="#">home</a>
                            <a href="#">Products</a>
                            <a href="#">Textile Machinery</a>
                            <a class="current" href="#">{{ $product->product_name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-gap1 dark-bg">
        <div class="container mt--30">
            <div class="row">
                <!-- Product Thumbnail -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="single-project-area-one">
                        <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->product_name }}" class="img-fluid">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6 col-md-12">
                    <div class="inner-content">
                        <h3 class="title">{{ $product->product_name }}</h3>
                        <p class="disc">{{ $product->product_description }}</p>
                        <h5 class="mt-4">Category: {{ $product->productTextile->catagory_name }}</h5>
                        
                        <!-- Product Points -->
                        @if (!empty($product->points) && is_array($product->points))
                            <h5 class="mt-4">Key Features:</h5>
                            <ul class="list-group">
                                @foreach ($product->points as $point)
                                    <li class="list-group-item">{{ $point }}</li>
                                @endforeach
                            </ul>
                        @elseif (!empty($product->points))
                            <h5 class="mt-4">Key Features:</h5>
                            <p>{{ $product->points }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Additional Images -->
            @if (!empty($product->images) && is_array($product->images))
                <div class="row mt-5">
                    <h5 class="mb-3">Additional Images</h5>
                    @foreach ($product->images as $image)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="single-project-area-one">
                                <img src="{{ asset($image) }}" alt="Product Image" class="img-fluid">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection