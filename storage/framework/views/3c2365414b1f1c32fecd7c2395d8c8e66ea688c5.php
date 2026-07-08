
<?php $__env->startSection('contentFront'); ?>



<style>
    .align-flex-start{
        align-items: flex-start;
    }
    .w-100{
        width:100%;
    }
</style>

<header class="slider slider-prlx">
    <div class="swiper-container parallax-slider">
        <div class="swiper-wrapper">

            <?php $__currentLoopData = $circularsTests->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circularsTest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                           <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="bg-img valign" data-overlay-dark="4">
                    <video autoplay muted loop playsinline class="bg-video" poster="<?php echo e(asset('images/' . $circularsTest->catagory_image)); ?>">
                        <source src="<?php echo e(asset('images/' . $circularsTest->catagory_image)); ?>" type="video/mp4">
                    </video>
                    <div class="container">
                        <div class="caption text-center">
                            <h2 class="mb-30" data-swiper-parallax="-2000"><?php echo e($circularsTest->title); ?></h2>
                            <h1><span data-swiper-parallax="-1000"><?php echo e($circularsTest->span_title); ?></span></h1>
                        </div>
                    </div>
                </div>
            </div> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="pagination-prog-bar">
        <div class="swiper-pagination swiper-pagination-progressbar"></div>
    </div>
</header>

<section class="services-tab section-padding">
    <div class="container">
        <div class="row lg-marg" id="tabs">
           
            <div class="col-lg-5 d-none d-lg-block valign">
                <div class="images-grp">
                    <div class="front-images">
                        <?php $__currentLoopData = $videos->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Slider for tabs-<?php echo e($index + 1); ?> -->
                        <div class="tab-<?php echo e($index + 1); ?> <?php echo e($index == 0 ? 'current' : ''); ?> slider-container">
                            <div class="slider-images">
                                <img src="<?php echo e(asset('images/' .$video->image2)); ?>" alt="">
                            </div>
                            <!--<div class="slider-pagination">-->  <!-- remove pagination -->
                            <!--    <span class="dot active" data-index="0"></span>-->
                            <!--    <span class="dot" data-index="1"></span>-->
                            <!--    <span class="dot" data-index="2"></span>-->
                            <!--</div>-->
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7  d-block valign align-flex-start">  <!-- align-flex-start -->
                <div class="serv-tab-link tab-links full-width">
                    <div class="sec-head mb-20">
                        <h6 class="sub-title mb-15">WELCOME TO</h6>
                        <h2>BARANI GROUP</h2>
                        <div class="text mb-30 mt-20">
                            <p>Our three specialised units is hub of innovation, equipped with
                                cutting-edge technology to meet unique customer requirements.</p>
                        </div>
                    </div>
                    
                    <!-- MOBILE STACK (NO TABS) -->
<div class="mobile-services d-block d-lg-none">

    <?php $__currentLoopData = $videos->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mobile-item mb-40">
            

            <h3 class="mb-15"><?php echo e($video->title); ?></h3>
            
            <div class="img mb-20">
                <img src="<?php echo e(asset('images/' .$video->image2)); ?>" class="img-fluid rounded" alt="">
            </div>

            <p class="mb-15"><?php echo e($video->description); ?></p>

            <a href="<?php echo e($video->link); ?>">
                <span>Read More</span>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

                    
                    <!--<div class="images-grp d-block d-lg-none">-->
                    <!--    <div class="front-images">-->
                    <!--        <?php $__currentLoopData = $videos->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                            <!-- Slider for tabs-<?php echo e($index + 1); ?> -->
                    <!--        <div class="tab-<?php echo e($index + 1); ?> <?php echo e($index == 0 ? 'current' : ''); ?> slider-container">-->
                    <!--            <div class="slider-images">-->
                    <!--                <img src="<?php echo e(asset('images/' .$video->image2)); ?>" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="slider-pagination">-->
                    <!--                <span class="dot active" data-index="0"></span>-->
                    <!--                <span class="dot" data-index="1"></span>-->
                    <!--                <span class="dot" data-index="2"></span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="row justify-content-start d-none d-lg-flex">
                        <div class="col-lg-12">
                            <ul class="rest tab-units">
                                <?php $__currentLoopData = $videos->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="item-link <?php echo e($index == 0 ? 'current' : ''); ?>" data-tab="tabs-<?php echo e($index + 1); ?>">
                                    <h3><?php echo e($video->title); ?></h3>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                    <div class="serv-tab-cont md-mb80 d-none d-lg-block">
                        <?php $__currentLoopData = $videos->sortBy('sort_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-content <?php echo e($index == 0 ? 'current' : ''); ?>" id="tabs-<?php echo e($index + 1); ?>">
                            <div class="item">
                                <div class="cont">
                                    <div class="text">
                                        <p><?php echo e($video->description); ?></p>
                                    </div>
                                    <a href="<?php echo e($video->link); ?>" class="mt-30">
                                        <span>Read More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.front-images>* {
    display: none;
}

.front-images .current {
    display: block;
}

.slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.slider-images {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slider-images img {
    width: 100%;
    flex-shrink: 0;
}

.slider-pagination {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
}

.slider-pagination .dot {
    width: 10px;
    height: 10px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s;
}

.slider-pagination .dot.active {
    background: rgba(0, 0, 0, 0.9);
}

.slider-pagination .dot:hover {
    background: rgba(0, 0, 0, 0.7);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabLinks = document.querySelectorAll('.item-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const tabImages = document.querySelectorAll('.front-images > *');

    tabLinks.forEach(link => {
        link.addEventListener('click', function() {
            tabLinks.forEach(item => item.classList.remove('current'));
            tabContents.forEach(content => content.classList.remove('current'));
            tabImages.forEach(image => image.classList.remove('current'));

            this.classList.add('current');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('current');
            const activeImage = document.querySelector(
                `.front-images .tab-${tabId.split('-')[1]}`);
            if (activeImage) {
                activeImage.classList.add('current');
            }
        });
    });

    // Slider for all tabs
    const sliders = document.querySelectorAll('.slider-container');
    sliders.forEach(slider => {
        const sliderImages = slider.querySelector('.slider-images');
        const dots = slider.querySelectorAll('.dot');
        let currentIndex = 0;
        const totalImages = sliderImages.querySelectorAll('img').length;

     function updateSlider() {

    if (!sliderImages || dots.length === 0) return;

    sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;

    dots.forEach(dot => dot.classList.remove('active'));

    if (dots[currentIndex]) {
        dots[currentIndex].classList.add('active');
    }
}

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentIndex = parseInt(dot.getAttribute('data-index'));
                updateSlider();
            });
        });

        // Auto-slide every 5 seconds for the active tab
        setInterval(() => {
            if (slider.classList.contains('current')) {
                currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
                updateSlider();
            }
        }, 5000);
    });
});
</script>

<style>
    .services .item-box.home-our-products{
        clip-path: unset;
    }
    .services .item-box.home-our-products .icon img{
        height:140px;
    }
    
    .services .item-box .icon{
        width:100%;
    }
    
</style>


<section class="page-intro section-padding">
    <div class="container">
        <div class="row">
            <div class="sec-head mb-20">
                <div class="row justify-content-center">
                    <div class="col-lg-12 md-mb50">
                        <h2 class="text-center">OUR PRODUCTS</h2>
                        <h6 class="sub-title text-center mb-15">
                          A high level quality control in compliance with global standards
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <?php $__currentLoopData = $Results_fronts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $front): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $results = $Resultsdetails->where('Infrastructure_id', $front->id);
                    ?>

                    <?php if($results->isNotEmpty()): ?>
                        <div class="services mb-5 mt-20"> <!-- mt-20 -->
                            <div class="sec-head mb-20">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 text-align-left">
                                        <h2><?php echo e($front->title); ?></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $Resultsdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-6 col-md-4 col-xl-3 mb-4">
                                        <a href="<?php echo e($Resultsdetail->url ?? '#'); ?>" target="_blank" class="w-100">
                                            <div class="item-box sm-mb30 text-center p-3 border rounded home-our-products">
                                                <div class="icon mb-3">
                                                    <?php if($Resultsdetail->pdf): ?>
                                                        <img src="<?php echo e(asset('pdfs/'.$Resultsdetail->pdf)); ?>">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('images/new-images/default_image.png')); ?>" alt="Default image">  <!-- default image -->
                                                    <?php endif; ?>
                                                </div>

                                                <h6 class="mb-2">
                                                    <?php echo e($Resultsdetail->infrastructure_title); ?>

                                                </h6>

                                                <p><?php echo e($Resultsdetail->description); ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    



      
        </div>
    </div>
</section>

<!-- ==================== End intro ==================== -->


<section class="numbers section-padding ">

    <div class="container">
        <div class="sec-bottom mb-50">
            <div class="sub-bg d-flex align-items-center">
                <h6 class="fz-14 fw-400">View <span class="fw-600">our company</span> stats
                    throught the years</h6>
            </div>
        </div>
<?php $__currentLoopData = $FAQs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $FAQ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    

        <div class="row justify-content-center">
            <div class="col-lg-3 col-12 col-sm-6 ">
                <h4>Established Year</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">

                    <h2 class="fz-60 line-height-1 " data-target="<?php echo e($FAQ->established); ?>"><?php echo e($FAQ->established); ?></h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Manufacturing Units</h4>
                <div class="item d-flex align-items-center justify-content-center md-mb50">
                    <h2 class="fz-60 line-height-1 count" data-target="<?php echo e($FAQ->manufacturing_units); ?>"><?php echo e($FAQ->manufacturing_units); ?></h2>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Employees</h4>
                <div class="item d-flex align-items-center justify-content-center  md-mb50">
                    <h2 class="fz-60 line-height-1 count" data-target="<?php echo e($FAQ->employees); ?>"><?php echo e($FAQ->employees); ?></h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4>Gobal Reach</h4>
                <div class="item d-flex align-items-center justify-content-center ">
                    <h2 class="fz-60 line-height-1 count" data-target="<?php echo e($FAQ->global_reach); ?>"><?php echo e($FAQ->global_reach); ?></h2>
                    <span class="sub-title opacity-7 ">+</span>
                </div>
                <h5>Countries</h5>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</section>

<!-- ==================== Start main-feat ==================== -->

<section class="main-feat section-padding bg-main-blue side-circle-img" 
         style="position: relative;">
    <div class="container">
        <div class="sec-head col-lg-12 col-md-8 col-12 mb-20">
            <div class="row justify-content-between">

            <?php $__currentLoopData = $OurServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $OurService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-12 md-mb50">
                    <h6 class="sub-title mb-15">Our Services</h6>
                    <h2 class="" style="max-width: 458px;text-align: left;">
                        <?php echo e($OurService->title); ?>

                    </h2>
                    <p></p>
                </div>

            </div>
        </div>

        <div class="row justify-content-between">

            <div class="col-lg-6 mw-550">
                <p class="mb-10 text-white w-95per"><?php echo e($OurService->description); ?></p>
                <p class="mb-20 text-white"><?php echo e($OurService->points_title); ?></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="item mb-20">
                            <ul class="rest dot-list text-white grid-2-list">
                                <?php if($OurService->point_1): ?> <li><?php echo e($OurService->point_1); ?></li> <?php endif; ?>
                                <?php if($OurService->point_2): ?> <li><?php echo e($OurService->point_2); ?></li> <?php endif; ?>
                                <?php if($OurService->point_3): ?> <li><?php echo e($OurService->point_3); ?></li> <?php endif; ?>
                                <?php if($OurService->point_4): ?> <li><?php echo e($OurService->point_4); ?></li> <?php endif; ?>
                                <?php if($OurService->point_5): ?> <li><?php echo e($OurService->point_5); ?></li> <?php endif; ?>
                                <?php if($OurService->point_6): ?> <li><?php echo e($OurService->point_6); ?></li> <?php endif; ?>
                            </ul>
                        </div>
                    
                    </div>
                </div>
            </div>

        </div>  

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </div>
    
    <div class="col-12 ser-ext-img right-clumn">
                                <div class="img">
                                  
                                   <img src="<?php echo e(isset($OurService->image) ? asset($OurService->image) : asset('imgs/blog/2.jpg')); ?>"alt="Barani Group Facility">
                                    <!--<img src="<?php echo e(asset('assets/frontend/imgs/blog/image.jpg')); ?>" alt="Barani Service Facility">-->


                                </div>
                            </div>

    <!-- Dynamic background via inline style if you want -->
    <style>
        .side-circle-img::after {
            width: 50%;
            height: 100%;
            content: "";
            background: url('<?php echo e(isset($OurService->image) ? asset($OurService->image) : asset('imgs/blog/2.jpg')); ?>') no-repeat;
            background-size: cover;
            position: absolute;
            right: 0px;
            top: 0px;
            clip-path: ellipse(100% 100% at 100% 50%);
                background-position: bottom;
        }
    </style>
</section>


<!-- ==================== End main-feat ==================== -->


<!-- ==================== Start clients ==================== -->

<section class="clients-carso section-padding sub-bg">
    <div class="container">
        <div class="sec-bottom mb-50">
            <div class="sub-bg d-flex align-items-center">
                <h6 class="fz-14 fw-400">More than <span class="fw-600">100+ companies</span> trusted us
                    worldwide</h6>
            </div>
        </div>

<?php
    $total = $Gallerys->count();     // 35
    $perRow = ceil($total / 3);      // 12
    $chunks = $Gallerys->chunk($perRow);
?>

<?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="swiper<?php echo e(5 + $index); ?>" data-carousel="swiper" data-items="8"  data-space="40">
        <div id="content-carousel-swiper<?php echo e(5 + $index); ?>" class="swiper-container" data-swiper="container">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img icon-img-100">
                                <img src="<?php echo e(asset('images/' . $Gallery->image_path)); ?>" alt="Brand Logo">
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</section>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts_front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>