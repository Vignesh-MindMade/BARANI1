@extends('layouts_front.app')
@section('contentFront')

    <style>
        .mar-top-30px {
            margin-top: 30px;
        }

        .tool-process.grid-3fr {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
    </style>
    <header class="page-header-cerv bg-img section-padding"
        data-background="{{ $page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/frontend/images/banner/Automation.webp') }}"
        data-overlay-dark="4">
        <div class="container pt-100 ontop">
            <div class="text-center">
                <h1 class="fz-100">{{ $page->banner_title ?? '' }}
                </h1>
                <div class="mt-15 mb-4">
                    <a href="#">Home</a>
                    <span class="padding-rl-20">|</span>
                    <span class="text-white">{{ $page->banner_title ?? '' }}</span>
                </div>
            </div>
        </div>
    </header>

    <section class="process section-padding">
        <div class="container">
            <div>
                <h6 class="sub-title main-color mb-15">{{ $page->intro_title ?? '' }}</h6>
                <p>{{ $page->intro_description }}</p>
            </div>

            <div class="tool-process grid-3fr mar-top-30px">
                @if(is_array($page->process_steps))
                    @foreach($page->process_steps as $step)
                        <div class="  item md-mb50 pad-25px">
                            <h5 class="mb-15">{{ $step['title'] ?? '' }}</h5>
                            @if(isset($step['items']) && is_array($step['items']))
                                <!-- Automation template uses text paragraph usually -->
                                @foreach($step['items'] as $item)
                                    <p>{{ $item }}</p>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

{{-- <section class="main-feat cap-sect section-padding bg-img bg-blue">
        <div class="container alternate-rows">

            @if(is_array($page->feature_rows))
                @foreach($page->feature_rows as $index => $row)
                    <!-- Row {{ $index + 1 }} -->
                    <div class="row justify-content-between align-items-center mb-50">
                        @if($index % 2 == 0)
                            <!-- Image Left, Text Right -->
                            <div class="col-lg-6">
                                <div class="img md-mb50">
                                    @if(!empty($row['image']))
                                        <img src="{{ asset('storage/' . $row['image']) }}" alt="{{ $row['title'] ?? '' }}"
                                            class="radius-15">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="text">
                                    <h4>{{ $row['title'] ?? '' }}</h4>
                                    <ul class="rest dot-list text-white">
                                        @if(isset($row['items']) && is_array($row['items']))
                                            @foreach($row['items'] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @else
                            <!-- Text Left, Image Right -->
                            <div class="col-lg-5">
                                <div class="text">
                                    <h4>{{ $row['title'] ?? '' }}</h4>
                                    <ul class="rest dot-list text-white">
                                        @if(isset($row['items']) && is_array($row['items']))
                                            @foreach($row['items'] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="img md-mb50">
                                    @if(!empty($row['image']))
                                        <img src="{{ asset('storage/' . $row['image']) }}" alt="{{ $row['title'] ?? '' }}"
                                            class="radius-15">
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </section> --}}
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
    <section class="blog-list-crev section-padding sub-bg">
        <div class="container">

            <div class="sec-head mb-30">
                <div class="bord pt-15  d-flex align-items-center">
                    <h2 class="fw-600"><span class="fw-200"> Our Strength </span> </h2>
                </div>
            </div>
            <div class="capabalities capabalities-new-boxes  row gap-3 g-0 mw-100" style="justify-content: space-evenly;">

                @if(is_array($page->strength_materials_grid))
                    @foreach($page->strength_materials_grid as $gridItem)
                        <div class="all-items-box col-lg-5 col-sm-12">

                            <h5>{{ $gridItem['title'] ?? '' }}</h5>
                            <!-- Item -->
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