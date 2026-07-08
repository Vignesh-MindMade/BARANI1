@extends('layouts_front.app')
@section('contentFront')
    <style>
        .tick.dot-list li:before {
            background-image: url(data:image/svg+xml;charset=utf-8;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9JzAgMCAxNiAxNic+PGcgZmlsbD0nbm9uZScgc3Ryb2tlPScjMWYxZjFmJyBzdHJva2UtbGluZWNhcD0ncm91bmQnIHN0cm9rZS1saW5lam9pbj0ncm91bmQnIHN0cm9rZS13aWR0aD0nMC44Jz48cGF0aCBkPSdtMTQuMjUgOC43NWMtLjUgMi41LTIuMzg0OSA0Ljg1MzYzLTUuMDMwNjkgNS4zNzk5MS0yLjY0NTc4LjUyNjMtNS4zNzk5MS0uNzA0NC02LjY1OTAzLTMuMDUyMy0xLjMyODM3LTIuMzQ3ODQtMS4wMDA0My01LjI4MzA3LjgxMzM2LTcuMjc5ODkgMS44MTM3OS0xLjk5NjgzIDQuODc2MzYtMi41NDc3MSA3LjM3NjM2LTEuNTQ3NzEnLz48cG9seWxpbmUgcG9pbnRzPSc1Ljc1IDcuNzUgOC4yNSAxMC4yNSAxNC4yNSAzLjc1Jy8+PC9nPjwvc3ZnPg==);
        }
    </style>
    <header class="page-header-cerv bg-img section-padding"
        data-background="{{ $page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/frontend/images/banner/Toolisng.webp') }}"
        data-overlay-dark="4">
        <div class="container pt-100 ontop">
            <div class="text-center">
                <h1 class="fz-100">{{ $page->banner_title ?? 'Tooling' }}
                </h1>
                <div class="mt-15 mb-4">
                    <a href="#">Home</a>
                    <span class="padding-rl-20">|</span>
                    <span class="text-white">{{ $page->banner_title ?? 'Tooling' }}</span>
                </div>
            </div>
        </div>
    </header>



    <section class="services-dots cap-list section-padding  radius-30 ">
        <div class="container">

            <div class="sec-head mb-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <h6 class="sub-title main-color mb-15">{{ $page->intro_title ?? 'Tooling' }}</h6>
                            <p>{{ $page->intro_description }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row  ontop">

                @if(is_array($page->feature_list))
                    @foreach($page->feature_list as $feature)
                        <!-- Feature List Item -->
                        <div class="col-lg-6">
                            <div class="item  ">
                                @if(!empty($feature['image']))
                                    <img src="{{ asset('storage/' . $feature['image']) }}" alt="{{ $feature['title'] ?? 'Feature' }}"
                                        class="mb-20" />
                                @endif
                                <h5>{{ $feature['title'] ?? '' }}</h5>
                                <div class="text mt-15">
                                    <ul class="rest tick dot-list fz-18 ">
                                        @if(isset($feature['items']) && is_array($feature['items']))
                                            @foreach($feature['items'] as $item)
                                                <li class="mb-10">{{ $item }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

   <section class="main-feat cap-sect section-padding bg-img bg-blue">
    <div class="container alternate-rows">

        @if(is_array($page->feature_rows) && count($page->feature_rows) > 0)
            @foreach($page->feature_rows as $index => $row)
                <!-- Row {{ $index + 1 }} -->
                <div class="row justify-content-between align-items-center mb-50">

                    @if($index % 2 == 0)
                        <!-- Image Left ─ Text Right -->
                        <div class="col-lg-6">
                            <div class="img md-mb50">
                                @if(!empty($row['image']))
                                    <img src="{{ asset('storage/' . $row['image']) }}" 
                                         alt="{{ $row['title'] ?? 'Feature image' }}"
                                         class="radius-15">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="text">
                                @if(!empty($row['title']))
                                    <h4>{{ $row['title'] }}</h4>
                                @endif

                                @if(!empty($row['points']) && is_array($row['points']))
                                    <ul class="rest dot-list text-white">
                                        @foreach($row['points'] as $point)
                                            <li>
                                                @if(!empty($point['point_title']))
                                                    <strong>{{ $point['point_title'] }}</strong> 
                                                @endif
                                                {{ $point['description'] ?? '' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                    @else
                        <!-- Text Left ─ Image Right -->
                        <div class="col-lg-5">
                            <div class="text">
                                @if(!empty($row['title']))
                                    <h4>{{ $row['title'] }}</h4>
                                @endif

                                @if(!empty($row['points']) && is_array($row['points']))
                                    <ul class="rest dot-list text-white">
                                        @foreach($row['points'] as $point)
                                            <li>
                                                @if(!empty($point['point_title']))
                                                    <strong>{{ $point['point_title'] }}</strong> 
                                                @endif
                                                {{ $point['description'] ?? '' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="img md-mb50">
                                @if(!empty($row['image']))
                                    <img src="{{ asset('storage/' . $row['image']) }}" 
                                         alt="{{ $row['title'] ?? 'Feature image' }}"
                                         class="radius-15">
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach
        @endif

    </div>
</section>


    <section class="process section-padding">
        <div class="container">
            <div class="sec-head pb-30">
                <div class="bord pt-15  d-flex align-items-center">
                    <h2><span class="fw-200">{{ $page->process_title ?? '' }}</span></h2>

                </div>
            </div>
            <div class="tool-process tool-grid3">
                @if(is_array($page->process_steps))
                    @foreach($page->process_steps as $step)
                        <div class="item md-mb50 pad-25px">
                            <h5 class="mb-15">{{ $step['title'] ?? '' }}</h5>

                            <ul class="rest  tick dot-list fz-17">
                                @if(isset($step['items']) && is_array($step['items']))
                                    @foreach($step['items'] as $item)
                                        <li class="mb-10">{{ $item }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>


    <section class="blog-list-crev section-padding sub-bg">
        <div class="container">

            <div class="sec-head mb-30">
                <div class="bord pt-15  d-flex align-items-center">
                    <h2 class="fw-600"> <span class="fw-200">
                            {{ $page->strength_materials_title ?? 'Materials, Press Range & Standards' }} </span> </h2>
                </div>
            </div>
            <div class="capabalities capabalities-new-boxes  row justify-content-center flex-nowrap gap-3 g-0 mw-100">

                @if(is_array($page->strength_materials_grid))
                    @foreach($page->strength_materials_grid as $gridItem)
                        <div class="all-items-box col-lg-4 col-md-12">

                            <h5>{{ $gridItem['title'] ?? '' }}</h5>
                            <div class="item-box radius-15">

                                <p>
                                    {{ $gridItem['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </section>
@endsection