@extends('layouts-front.app')
@section('content')

<style>
.ratio-1x1 {
    position: relative;
    width: 100%;
    padding-top: 100%; /* 1:1 ratio */
    overflow: hidden;
}

.ratio-1x1 img.img-square {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* crop but keep proportions */
}
</style>

@foreach ($gallerys as $gallery)
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area project-bread position-relative" style="background-image: url({{ asset($gallery->banner_image) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span style="
                           position: absolute;
                           top: 100px;
                           left: 590px;
                           font-size: 80px;
                           font-weight: bold;
                           color: transparent;
                           -webkit-text-stroke: 2px rgba(255,255,255,0.3);
                           z-index: 2;
                           pointer-events: none;">
                            NEWS &amp; GALLERY
                        </span>                            
                        <h1 class="title" style="color: aliceblue;">News & Gallery</h1>
                        <div class="nav-area-navigation">
                            <a href="#" style="text-decoration: none;">home</a>
                            <a class="current" href="#" style="text-decoration: none;">News &amp; Gallery</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-gap dark-bg profile-wrap">
        <div class="marque-wrapper one" dir="ltr">
            <div class="marquee">
                <span> News &Gallery News&Gallery News &Gallery</span>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <section class="card-section bg-gradient-to-br from-gray-900 to-blue-900 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $images = json_decode($gallery->image, true) ?? [];
                    $descriptions = json_decode($gallery->description, true) ?? [];
                @endphp

                @foreach($images as $index => $img)
                    <div class="relative group">
                        <div class="card bg-white rounded-2xl shadow-xl overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" 
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal{{ $gallery->id }}_{{ $index }}"
                             aria-label="Open image modal">
                            <div class="w-full h-64">
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover" alt="Image {{ $index + 1 }}">
                            </div>
                            <div class="card-body p-5 bg-gradient-to-t from-gray-50 to-white">
                                <p class="text-gray-900 text-base font-semibold text-center tracking-tight">
                                    {{ $descriptions[$index] ?? '' }}
                                </p>
                            </div>
                            <!-- Overlay for hover effect -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-500 flex items-center justify-center">
                                <span class="text-white text-xl font-bold opacity-0 group-hover:opacity-100 transform group-hover:scale-110 transition duration-300">View Image</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal for each image -->
    @foreach($images as $index => $img)
        <div class="modal fade" id="imageModal{{ $gallery->id }}_{{ $index }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $gallery->id }}_{{ $index }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-white rounded-2xl shadow-lg">
                    <div class="modal-body p-4">
                        <img src="{{ asset($img) }}" class="w-full h-auto rounded-lg mb-4" alt="Image {{ $index + 1 }}">
                        <p class="text-gray-800 text-lg font-medium text-center">
                            {{ $descriptions[$index] ?? 'No description available' }}
                        </p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-light rounded-lg px-4 py-2" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

<!-- Include Tailwind CSS via CDN for styling -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Include Bootstrap CSS and JS for modal functionality -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection