
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="WRAPCODERS">
    <title>Vetal || Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/backend/images/favicon.icon')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/css/daterangepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/theme.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>

<body>  
    <style>
        *{
            font-family: 'Work Sans', sans-serif;
        }
     </style>

    @include('layouts.sidebar')
    @include('layouts.topbar')
  


    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                      
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="row">

                @yield('content')
            </div>
            
      
        </div>
   
  
    <script src="{{ asset('assets/backend/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/daterangepicker.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/circle-progress.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/common-init.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/dashboard-init.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/theme-customizer-init.min.js')}}"></script>
</body>

</html>