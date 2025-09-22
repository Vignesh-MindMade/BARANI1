<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="WRAPCODERS">
    <title>Barani || Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/backend/images/custome/logo-light.png')}}">
    <link rel="icon" type="image/x-icon" href="assets/backend/images/custome/logo-light.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/css/daterangepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/theme.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dashboard.css')}}">
    <style>
        * {
            font-family: 'Work Sans', sans-serif;
        }
        .nxl-horizontal-nav {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 0 20px;
            height: 85px;
            display: flex;
            align-items: center;

        }
        .nxl-horizontal-nav .navbar-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .nxl-horizontal-nav .b-brand {
            margin-right: 30px;
        }
        .nxl-horizontal-nav .b-brand img {
            height: 40px;
        }
        .nxl-horizontal-nav .nxl-navbar {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .nxl-horizontal-nav .nxl-item {
            position: relative;
        }
        .nxl-horizontal-nav .nxl-link {
            color: #333;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nxl-horizontal-nav .nxl-link:hover {
            color: #007bff;
        }
        .nxl-horizontal-nav .nxl-hasmenu .nxl-submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            list-style: none;
            padding: 10px 0;
            min-width: 200px;
            z-index: 1000;
        }
        .nxl-horizontal-nav .nxl-hasmenu:hover .nxl-submenu {
            display: block;
        }
        .nxl-horizontal-nav .nxl-submenu .nxl-item .nxl-link {
            padding: 8px 20px;
            font-size: 13px;
        }
        .nxl-horizontal-nav .nxl-micon {
            font-size: 16px;
        }
        .nxl-horizontal-nav .nxl-caption {
            display: none;
        }
        .nxl-content {
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .nxl-horizontal-nav .nxl-navbar {
                display: none;
            }
            .nxl-horizontal-nav .nxl-mobile-toggle {
                display: block;
                cursor: pointer;
                font-size: 24px;
                margin-left: auto;
            }
            .nxl-horizontal-nav.active .nxl-navbar {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="main-content">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/backend/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/daterangepicker.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/js/circle-progress.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/common-init.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/dashboard-init.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/theme-customizer-init.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.querySelector('.nxl-mobile-toggle');
            const nav = document.querySelector('.nxl-horizontal-nav');
            mobileToggle.addEventListener('click', function() {
                nav.classList.toggle('active');
            });
        });
    </script>
</body>
</html>