<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <meta name="keywords"
        content="Barani Group, hydraulic systems, hydraulic cylinders, hydraulic presses, hydraulic power packs, custom hydraulic solutions, industrial hydraulics, hydraulic service and repair, Coimbatore hydraulics">
    <meta name="description"
        content="Barani Group is a leading manufacturer and service provider of high-performance hydraulic systems including cylinders, presses, and power packs. Trusted by industries for quality and reliability.">
    <meta name="author" content="Barani Group">

    <!-- Title -->
    <title>Barani Group</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/frontned/imgs/favicon.png')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap" rel="stylesheet">

    <!-- Fonts / Icons / CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/satoshi.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css')}}">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/timeline.css')}}">
</head>
<body>



    @include('layouts-front.header')

        <div id="smooth-wrapper">
        <div id="smooth-content">
            <main class="main-bg o-hidden">

            @yield('content')
<!-- ==================== End clients ==================== -->
               @include('layouts-front.footer')
            </div>
            
       
        </div>
  
</body>
</html>
