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

    <style>
        body {
            font-family: "Work Sans", sans-serif;
            background: url('https://p2h.in/vetal/assets/frontend/images/logo/backgroun-image.jpg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .login-card .logo img {
        
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
            background: linear-gradient(135deg, #ef6e19, #034fbd);
            color: white;
            font-weight: 500;
            padding: 10px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
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
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center mb-3 logo">
            <img src="{{ asset('/assets/frontend/images/logo/vita.png') }}" alt="Logo">
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
