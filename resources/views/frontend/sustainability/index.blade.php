@extends('layouts_front.app')
@section('contentFront')
<style>

.pdf-modal {
    display: none;                 /* 🔥 hidden on load */
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 9999;
    justify-content: center;
    align-items: end;
}

/* show only when active */
.pdf-modal.active {
    display: flex;
}

.pdf-modal-content {
    position: relative;
    width: 90%;
    max-width: 1000px;
    height: 800px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.pdf-modal iframe {
    width: 100%;
    height: 100%;
}

.pdf-close {
    position: absolute;
    top: 6px;
    right: 10px;
    font-size: 22px;
    cursor: pointer;
}

#end{
    display:none !important;
}



</style>
<header class="page-header-cerv bg-img section-padding" data-background="{{ asset('frontend/imgs/sus/' . ($sustainabilities->first()->banner ?? 'default.jpg')) }}" data-overlay-dark="4">
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">Sustainability
            </h1>
            <div class="mt-15 mb-4">
                <a href="#">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Sustainability</span>
            </div>
        </div>
    </div>
</header>

<section class="services-details section-padding pb-30">
    <div class="container">

        @forelse($sustainabilities as $item)
            <div class="sec-head text-center mb-80">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        @if(!empty($item->quote))
                            <h6 class="italic">" {{ $item->quote }} "</h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-50">
                <div class="col-lg-12">
                    <div class="text md-mb50">
                        <h5 class="fw-600 mb-20">{{ $item->title }}</h5>
                        <p>{{ $item->description }}</p>
                    </div>

                    @php
                        // Split points into equal columns
                        $points = array_map('trim', explode(',', $item->points ?? ''));
                        $chunks = array_chunk($points, ceil(count($points) / 2));
                    @endphp

                    @if(count($points))
                        <div class="text mt-10">
                            <p>This policy is applicable to our group companies and all the employees.
                                Barani team is committed to the below-mentioned concepts of social responsibility.
                            </p>
                        </div>

                        <div class="row mt-30">
                            @foreach($chunks as $column)
                                <div class="col-md-4">
                                    <ul class="rest list-arrow">
                                        @foreach($column as $point)
                                            @if(!empty($point))
                                                <li class="{{ !$loop->first ? 'mt-10' : '' }} nowrap">
                                                    <span class="icon">
                                                        <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                                fill="#002359"></path>
                                                        </svg>
                                                    </span>
                                                    <h6 class="inline fw-400">{{ $point }}</h6>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if(!empty($item->image))
                    <div class="row serv-imgs mt-50 mb-30">
                        <div class="col-lg-12">
                            <div class="img o-hidden radius-15">
                                <img src="{{ asset('frontend/imgs/sus/'.$item->image) }}" alt="Sustainability Image" data-speed="auto" data-lag="0">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-5">
                <h5>No sustainability records found.</h5>
                <p>Please add content from the admin panel.</p>
            </div>
        @endforelse

    </div>
</section>


{{-- second section --}}
 @foreach($governances as $gov)
    <section class="section-padding pt-50 pb-30 res-pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h4 class="mb-50">{{ $gov->title }}</h4>
                </div>

                <div class="col-lg-9 bord-thin-left pl-40">
                    <div class="text indust-used">
                        <p class="mb-30">{{ $gov->description }}</p>

                        @if(!empty($gov->points))
                            @php
                                // Convert comma-separated points into list
                                $points = array_filter(array_map('trim', explode(',', $gov->points)));
                            @endphp
                            <ul class="rest gover dot-list fz-18">
                                @foreach($points as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach


<section class="services-details section-padding pt-50 pb-30 res-pt-0">
    <div class="container">
        <div class="sec-head mb-0">
            <div class="bord pt-15 d-flex align-items-center justify-content-center">
                <h2 class="text-center">Social CSR</h2>
            </div>
        </div>

        @foreach($socials as $index => $item)
            <div class="container pb-30 pt-30">
                <div class="sec-head r mb-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>{{ $item->title }}</h4>
                        </div>
                    </div>
                </div>

                <div class="content-csr">
                    <div class="row align-items-center">
                        {{-- Alternate layout: image left for odd items, right for even --}}
                        @if($index % 2 == 0)
                            <div class="col-lg-6">
                                <div class="img o-hidden radius-15">
                                    @if($item->image)
                                        <img src="{{ asset('frontend/imgs/sus/'.$item->image) }}" alt="{{ $item->title }}" data-speed="auto" data-lag="0">
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div><p>
                                    {!! nl2br(e($item->description)) !!}</p>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div>
                                   <p> {!! nl2br(e($item->description)) !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="img o-hidden radius-15">
                                    @if($item->image)
                                        <img src="{{ asset('frontend/imgs/sus/'.$item->image) }}" alt="{{ $item->title }}" data-speed="auto" data-lag="0">
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


<section class="next-project reports-csr pb-50 pt-50 res-pt-0">
    <div class="container">
        <div class="sec-head mb-20">
            <div class="row justify-content-center">
                <div class="col-lg-12 md-mb50">
                    <h2 class="text-center">
                        {{ $certTitle->main_title ?? 'View our Certificates' }}
                    </h2>
                    <h6 class="sub-title text-center mt-10 mb-15">
                        {{ $certTitle->sub_title ?? 'A high level Quality Control in compliance with Global Standards.' }}
                    </h6>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($certificates as $cert)
                <div class="col-md-6 rest d-flex justify-content-center mb-4 mt-20">
    <a href="javascript:void(0)"
   class="cert-pdf-link"
   data-pdf="{{ asset('frontend/imgs/sus/'.$cert->pdf) }}#toolbar=0">


                        <div class="box bg-img" 
                             data-background="{{ asset('frontend/imgs/sus/'.$cert->image) }}">

                            <div class="cont d-flex align-items-center">
                                <p>{{ $cert->title }}</p>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="pdf-modal" id="pdfModal" style="padding:450px 0;">
    <div class="pdf-modal-content">
        <span class="pdf-close">&times;</span>

        <iframe id="pdfIframe" src="" frameborder="0"></iframe>
    </div>
</div>
</section>





<!-- ==================== End Services ==================== -->


@endsection
@section('script')


@endsection




