<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!--  background: url("{{ asset('/assets/backend/images/custome/backgroun-image.jpg') }}") no-repeat center center; -->
    <style>
        body {
            font-family: "Work Sans", sans-serif;
            /* background: url("{{ asset('/assets/frontend/imgs/works/3/0.jpg') }}") no-repeat center center; */
            background-size: cover;
            min-height: 100vh;
            display: flex;
            /* align-items: center; */
            
            justify-content: end; 
        }
        /* Video Background Styling */
        #background-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: fill;
        z-index: -1;
        }

        .login-card {
            background: #ffffffff;
            /* border-radius: 15px; */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            max-width: 436px;
            width: 100%;
            align-content: center;
        }

        .login-card .logo img {
            max-width: 100px;
        
        }

        .form-title {
            font-weight: bolder;
            color: #0a58ca;
            font-family: 'Work Sans';
            margin: 25px 15px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .login-btn {
            border-radius: 10px;
            background: linear-gradient(135deg, #092136ff, #274fe7);
            color: white;
            font-weight: 500;
            padding: 10px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #234674ff, #0d6efd);
        }

        .account-link {
            margin-top: 1rem;
            text-align: center;
        }

        .account-link a {
            text-decoration: none;
            color: #0d6efd;
            font-weight: 500;
        }

        .account-link a:hover {
            text-decoration: underline;
        }
        /* Vignesh 20/9/25 chenged logo card logo and added p tag text */
        #company_name{
            margin: 10px;
            color: #274de3;
        }
    </style>
</head>

<body>
<!-- Video Background -->
 <div>
    <video autoplay muted loop id="background-video">
        <source src="{{ asset('assets/frontend/videos/1.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
    <div class="login-card">
        
        <div class="text-center mb-3 logo">
            <img src="{{ asset('assets/backend/images/custome/logo-light.png') }}" alt="Logo">
            <p class="form-title text-center"id="company_name">Barani Hydraulics India Private Limited</p>
        </div>
        <h3 class="form-title text-center mb-4">Log in</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-lock me-2"></i>Password</label>
                <input type="password" name="password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="login-btn btn w-100">Login</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>