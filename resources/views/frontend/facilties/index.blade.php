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
                        <h1 class="chimaya-page-title">Facilities at our Campus</h1>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


        <!-- Breadcrumb Section -->
        <section>
            <div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><i class="fa fa-chevron-right"></i></li>
                            <li><span>Facilities at our Campus</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Facilities -->
        <section>
            <div class="facilities-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="facility">
                                <h2>Facilities at our Campus</h2>
                                <div class="heading-bottom-line"></div>
                                @foreach ($FacilitiesatourCampus as $item)
                                        <p>{{ $item->facilities_at_our_campus_paragraph }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Facilities-section -->
        <section>
            <div class="facilities-sections">
                <div class="container-fluid">
                    <div class="row">
                        

                        @foreach ($FacilitiesatourCampus as $item)   
                        <!-- Left-image -->
                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                                <img src="{{ asset('images/' . $item->events1_image) }}" alt="image">
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-content">
                                   <h3>{{ $item->events1_title }}</h3>
                                   <p>{{ $item->events2_text }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                               <img src="{{ asset('images/' . $item->events2_image) }}" alt="image">
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-content">
                                <h3>{{ $item->events2_title }}</h3>
                                <p>{{ $item->events2_text }}</p>
                            </div>
                        </div>
                        <!-- Right-image -->
                        <div class="col-md-3 py-0">
                            <div class="facility-content-right">
                                <h3>{{ $item->events3_title }}</h3>
                                <p>{{ $item->events3_text }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                               <img src="{{ asset('images/' . $item->events3_image) }}" alt="image">
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-content-right">
                               <h3>{{ $item->events4_title }}</h3>
                                <p>{{ $item->events4_text }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                                <img src="{{ asset('images/' . $item->events4_image) }}" alt="image">
                            </div>
                        </div>
                        <!-- Left-image -->
                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                               <img src="{{ asset('images/' . $item->events5_image) }}" alt="image">
                            </div>
                        </div>

                        <div class="col-md-3 py-0">
                            <div class="facility-content">
                                <h3>{{ $item->events5_title }}</h3>
                                <p>{{ $item->events5_text }}</p>
                            </div>
                        </div>

                        <div class="col-md-3 py-0">
                            <div class="facility-image">
                                <img src="{{ asset('images/' . $item->events6_image) }}" alt="image">
                            </div>
                        </div>

                        <div class="col-md-3 py-0">
                            <div class="facility-content">
                                <h3>{{ $item->events6_title }}</h3>
                                <p>{{ $item->events6_text }}</p>
                            </div>
                        </div>

                    @endforeach
                    </div>
                </div>
            </div>
        </section>



@include('layouts_front.footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="assets/js/script.js"></script>

</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const banners = document.querySelectorAll(".banner-section");
        banners.forEach(function (el) {
            const bg = el.getAttribute("data-bg");
            if (bg) {
                el.style.backgroundImage = `url('${bg}')`;
            }
        });
    });
</script>
