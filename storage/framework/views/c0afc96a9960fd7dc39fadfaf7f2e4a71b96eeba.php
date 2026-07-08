<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<!--favicon-->
	
	<link rel="icon" href="<?php echo e(asset ('assets/frontend/images/logo/logo-light.png')); ?>" type="image/png" />
	<!--plugins-->
	<?php echo $__env->yieldContent("style"); ?>
	
        <link href="<?php echo e(asset('assets/plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('assets/plugins/metismenu/css/metisMenu.min.css')); ?>" rel="stylesheet" />
        <!-- loader-->
        <link href="<?php echo e(asset('assets/css/pace.min.css')); ?>" rel="stylesheet" />
        <script src="<?php echo e(asset('assets/js/pace.min.js')); ?>"></script>
        <!-- Bootstrap CSS -->
        <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/css/app.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet">
        
        <!-- Theme Style CSS -->
        <link href="<?php echo e(asset('assets/css/dark-theme.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('assets/css/semi-dark.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('assets/css/header-colors.css')); ?>" rel="stylesheet" />
        
         <!-- Custom UI- Page Style CSS -->
        <link href="<?php echo e(asset('assets/css/custome.css')); ?>" rel="stylesheet" />
            <!-- Include Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Barani Admin</title>
     
        <style>

		*{
			  font-family: "Work Sans", sans-serif;
			  font-size: 14px
		}
            .mindmade{
                  font-style: oblique;
                  font-size: 13px;
                  font-family: math;
                  font-weight: bolder;
                  margin: 5px 2px;
                  color: #2f81b3;
                
            }
        </style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<?php echo $__env->make("layouts.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!--end header -->
		<!--navigation-->
		<?php echo $__env->make("layouts.nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<?php echo $__env->yieldContent("wrapper"); ?>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
		<footer class="page-footer">
			
		 
			<a href="https://www.mindmade.in/" target="_blank"><p class="mb-0 mindmade" > Made by MindMade Technologies</p></a>
		</footer>
		
	</div>
	
	

	
<!-- jQuery FIRST -->
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>

<!-- Plugins -->
<script src="<?php echo e(asset('assets/plugins/metismenu/js/metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/simplebar/js/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')); ?>"></script>

<!-- Bootstrap -->
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- App JS LAST -->
<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
	<?php echo $__env->yieldContent("script"); ?>
    <?php echo $__env->make("layouts.theme-control", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH D:\herd\barani_live\resources\views/layouts/app.blade.php ENDPATH**/ ?>