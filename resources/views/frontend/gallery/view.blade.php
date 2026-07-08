<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Chinmaya Vidhyalaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Cabin+Sketch:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/FrontEnd-Responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/FrontEnd-Style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
    <style>
        .portfolio-card {
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
        }

        .portfolio-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .portfolio-card:hover .portfolio-img {
            transform: scale(1.05);
        }

        .portfolio-card:hover .overlay {
            opacity: 1;
        }

        .card-img-wrapper {
            border-radius: 15px 15px 0 0;
        }

        .portfolio-img {
            border-radius: 15px 15px 0 0;
        }

        .btn-outline-primary {
            border-width: 2px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        @media (max-width: 768px) {
            .portfolio-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts_front.header')

    @foreach ($FacilitiesatourCampus as $item)
        <div class="banner-section" data-bg="{{ asset('images/' . $item->banner) }}">
            <div class="container">
                <div class="row">
                    <div class="title-bottom-gradient"></div>
                    <div class="title-content">
                        <span>Know Us Better</span>
                        <h1 class="chimaya-page-title">Achievements Gallery</h1>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <section class="mt-5 mb-5">
        <div class="container-fluid">
            <div class="col-lg-12">
            <div class="row g-4">
                @foreach ($galleries as $GalleryContent)
                    @if ($GalleryContent->type !== 'Events Gallery')
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card h-100 shadow-lg border-0 portfolio-card">
                                <div class="card-img-wrapper position-relative overflow-hidden">
                                    <a href="{{ asset('images/' . $GalleryContent->image_path) }}" 
                                    data-lightbox="gallery-group" 
                                    data-title="{{ htmlspecialchars($GalleryContent->caption) }}">
                                        <img src="{{ asset('images/' . $GalleryContent->image_path) }}"
                                            class="card-img-top portfolio-img"
                                            alt="{{ htmlspecialchars($GalleryContent->caption) }}"
                                            style="height: 280px; object-fit: cover; transition: transform 0.3s ease;">
                                    </a>
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
                                        <div class="text-center text-white">
                                            <i class="fas fa-search-plus fs-2 mb-2"></i>
                                            <p class="mb-0 fw-semibold">View Details</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    @endif
                @endforeach
            </div>
            </div>
        </div>
    </section>

    @include('layouts_front.footer')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Comment out Swiper if it causes conflicts; uncomment after testing -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <!-- Banner Background Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const banners = document.querySelectorAll(".banner-section");
            banners.forEach(function(el) {
                const bg = el.getAttribute("data-bg");
                if (bg) {
                    el.style.backgroundImage = `url('${bg}')`;
                }
            });
        });
    </script>

    <!-- Lightbox Initialization -->
    <script>
        jQuery(document).ready(function($) {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'alwaysShowNavOnTouchDevices': true,
                'disableScrolling': true,
                'showImageNumberLabel': true
            });
        });
    </script>
</body>

</html>