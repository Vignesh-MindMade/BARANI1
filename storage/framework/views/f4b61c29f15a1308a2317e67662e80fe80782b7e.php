
<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

        :root {
            --primary-blue: #1e40af;
            --accent-gold: #E58F43;
            --dark-overlay: rgba(0, 0, 0, 0.6);
            --card-bg: rgba(255, 255, 255, 0.05);
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            background: #000;
        }

        /* Video Background */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(0.5);
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(270deg, rgba(30, 64, 175, 0.4) 0%, rgb(47 36 36 / 70%) 50%, rgb(255 255 255 / 30%) 100%);
            z-index: 1;
        }

        /* Animated particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 15s infinite;
        }

        @keyframes  float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(50px);
                opacity: 0;
            }
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Login Card */
        .login-wrapper {
            display: flex
        ;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            gap: 250px;
        }
.login-card {
    background: var(--card-bg);
    backdrop-filter: blur(30px);
    border-radius: 24px;
    padding: 24px 55px; /* increased padding */
    width: 96%; /* slightly wider */
    max-width: 451px;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1);
    animation: slideInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

        @keyframes  slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Logo and Branding */
        .brand-section {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out;
        }

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-container {
            margin-bottom: 20px;
            display: inline-block;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            font-size: 48px;
            font-weight: 700;
            color: var(--primary-blue);
            text-shadow: 0 0 20px rgba(30, 64, 175, 0.5);
            letter-spacing: 2px;
        }

        .company-name {
            font-size: 14px;
            color: var(--text-gray);
            font-weight: 400;
            margin-top: 8px;
            letter-spacing: 1px;
        }

        .login-title {
            font-size: 32px;
            font-weight: 600;
            color: var(--text-white);
            margin-bottom: 10px;
            text-align: center;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--text-gray);
            text-align: center;
            margin-bottom: 35px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-gray);
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: var(--text-white);
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        /* Remember Me Checkbox */
        .remember-section {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-checkbox:checked {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--text-gray);
            cursor: pointer;
        }

        /* Login Button */
        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, #1e3a8a 100%);
            border: none;
            border-radius: 12px;
            color: var(--text-white);
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(30, 64, 175, 0.5);
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .alert-info {
            background: rgba(229, 143, 67, 0.15);
            border: 1px solid var(--accent-gold);
            color: var(--text-white);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
        }

        .text-danger {
            color: #ef4444 !important;
            font-size: 13px;
            margin-top: 8px;
            display: block;
        }

        /* Icons */
        .icon {
            width: 18px;
            height: 18px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 40px 30px;
            }

            .login-title {
                font-size: 28px;
            }
        }

        /* Side Content (Optional) */
        .side-content {
            flex: 1;
            max-width: 500px;
            animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes  slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .side-content h1 {
            font-size: 56px;
            font-weight: 700;
            color: var(--text-white);
            line-height: 1.2;
            margin-bottom: 20px;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.5);
        }

        .side-content p {
            font-size: 18px;
            color: var(--text-gray);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .highlight {
            color: var(--accent-gold);
            font-weight: 600;
        }

        @media (max-width: 1024px) {
            .side-content {
                display: none;
            }
        }
    </style>
</head>
<body>

<body>
    <!-- Video Background -->
    <div class="video-background">
        <!-- Using a placeholder video URL - replace with your actual industrial video -->
        <video autoplay muted loop playsinline>
            <source src="assets/videos/55691-503971736.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        
        <!-- Animated Particles -->
        <div class="particles" id="particles"></div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="login-wrapper">
            <!-- Side Content -->
            <div class="side-content">
                <h1>Welcome to <span class="highlight">Barani Hydraulics</span></h1>
                
            </div>

            <!-- Login Card -->
            <div class="login-card">
                <div class="brand-section">
                    <div class="logo-container">
                        <!-- Replace with your actual logo -->
                        <img src="assets/frontend/images/logo/logo-light.png" alt="Logo" style="max-width: 120px; height: auto;">
                    </div>
                    <div class="company-name">BARANI HYDRAULICS INDIA PVT LTD</div>
                </div>

                <h2 class="login-title">Log in</h2>
                

                <?php if(\Session::has('message')): ?>
                    <div class="alert-info">
                        <?php echo e(\Session::get('message')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('postlogin')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            Email
                        </label>
                        <input 
                            type="email" 
                            class="form-input" 
                            placeholder="Enter your email address"
                            id="email"
                            name="email"
                            required
                            autofocus
                        >
                        <?php if($errors->has('email')): ?>
                            <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Password
                        </label>
                        <input 
                            type="password" 
                            class="form-input" 
                            placeholder="Enter your password"
                            id="password"
                            name="password"
                            required
                        >
                        <?php if($errors->has('password')): ?>
                            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="remember-section">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                            <span class="checkbox-label">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="login-button">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create floating particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 30; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);
        }

        // Add input animation
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Auth.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/Auth/login.blade.php ENDPATH**/ ?>