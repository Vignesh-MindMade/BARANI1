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
 
        <!-- Banner Section -->
        <section>
            @foreach ($curriculams as $item)
            <div class="banner-section" data-bg="{{ asset('images/' . $item->banner) }}">
                <div class="container">
                    <div class="row">
                        <div class="title-bottom-gradient"></div>
                        <div class="title-content">
                            <span>Know Us Better</span>
                            <h1 class="chimaya-page-title">CBSE Curriculum Standards</h1>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <!-- Breadcrumb Section -->

        <section>
            <div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><i class="fa fa-chevron-right"></i></li>
                            <li><span>CBSE Curriculum Standards</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Curriculum -->
        
        <section>
            <div class="curriculum">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="curriculum-content">
                                <h2>CBSE Curriculum Standards</h2>
                                @foreach ($curriculams as $curriculum)
                                    <p>{{ $curriculum->cbse_curriculum_standards }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="age-rules">
                                <h3>Minimum Age Rules</h3>
                                @foreach ($curriculams as $curriculum)
                                    <p>{{ $curriculum->minimum_age_rules_paragraph }}</p>
                                @endforeach
                               
                              @foreach ($curriculams as $curriculum)
                                <ul class="rules-list">
                                    @foreach (explode(',', $curriculum->minimum_age_rules_points) as $point)
                                        <li>{{ trim($point) }}</li>
                                    @endforeach
                                </ul>
                            @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

 {{-- main content section homepage end  --}}
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
