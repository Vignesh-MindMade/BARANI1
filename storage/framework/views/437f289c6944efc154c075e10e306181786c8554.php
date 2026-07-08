
<?php $__env->startSection('contentFront'); ?>

<style>
    .hei-300px{
        height:300px;
    }
    
    .hei-300px img{
        width: 100%;
    height: 100%;
    object-fit: fill;
    }
</style>


<header class="page-header-cerv bg-img section-padding"
     data-background="<?php echo e(asset('frontend/imgs/submenu/' . ($page->banner_image ?? 'default.jpg'))); ?>"
     data-overlay-dark="4">

    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100"><?php echo e($page->banner_title ?? $submenu->submenu_name); ?></h1>

            <div class="mt-15 mb-4">
                <a href="<?php echo e(url('/')); ?>">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white"><?php echo e($submenu->submenu_name); ?></span>
            </div>
        </div>
    </div>
</header>


<section class="services-details section-padding">
    <div class="container">

        <div class="sec-head ">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h6 class="sub-title main-color mb-15"><?php echo e($page->division_title); ?></h6>

                    <p><?php echo e($page->division_desc); ?></p>

                </div>
            </div>
        </div>

    </div>
</section>





<section class="about">
    <div class="container section-padding pt-0">
        <div class="row md-marg">

            
            <div class="col-lg-6">
                <div class="cont md-mb50">

                    <h6 class="sub-title main-color mb-15">Why Choose Us</h6>

                    <?php
                        $points = $page->chooseus_points
                            ? preg_split("/\r\n|\r|\n/", trim($page->chooseus_points))
                            : [];
                    ?>

                    <ul class="rest list-arrow mt-30 pt-30 bord-thin-top">
                        <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e(!$loop->first ? 'mt-10' : ''); ?>">
                            <span class="icon">
                                
                                <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                    fill="#00225a"></path>
                                </svg>
                            </span>

                            <h6 class="inline fw-400" style="font-size:18px;">
                                <?php echo e($p); ?>

                            </h6>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                </div>
            </div>

            
                <div class="col-lg-6">
                <div class="img-vid video-auto-unit" style="border-radius: 30px 30px 30px 30px;">

                    <?php
                        $chooseusVideo = $page->chooseus_video;
                        $chooseusVideoType = null;
                        if ($chooseusVideo) {
                            if (preg_match('/\.webm($|\?)/i', $chooseusVideo)) {
                                $chooseusVideoType = 'video/webm';
                            } elseif (preg_match('/\.mp4($|\?)/i', $chooseusVideo)) {
                                $chooseusVideoType = 'video/mp4';
                            }
                        }
                    ?>

                    <video autoplay muted loop playsinline class="w-100">
                        <?php if($chooseusVideoType): ?>
                            <source src="<?php echo e($chooseusVideo); ?>" type="<?php echo e($chooseusVideoType); ?>">
                        <?php endif; ?>
                    </video>


                    <div class="curv-butn main-bg video-icon" style="display:none;">
                        <a href="<?php echo e($page->chooseus_video); ?>" target="_blank" class="vid">
                            <div class="icon"><i class="fas fa-play"></i></div>
                        </a>
                        <div class="shap-left-top">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                            </svg>
                        </div>
                        <div class="shap-right-bottom">
                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                            </svg>
                        </div>
                    </div>
                    
                     

                </div>
            </div>

<!---->
<!--            <div class="col-lg-6">-->
<!--                <div class="img-vid video-auto-unit">-->

<!--                    <video autoplay muted loop playsinline class="w-100">-->
<!--                        <source src="<?php echo e($page->chooseus_video); ?>" type="video/mp4">-->
<!--                    </video>-->

<!--                    <div class="curv-butn main-bg">-->
<!--                        <a href="<?php echo e($page->chooseus_video); ?>" target="_blank" class="vid">-->
<!--                            <div class="icon"><i class="fas fa-play"></i></div>-->
<!--                        </a>-->
<!--                        <div class="shap-left-top">-->
<!--                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">-->
<!--                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <div class="shap-right-bottom">-->
<!--                            <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">-->
<!--                                <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
                    
                     

<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>




<section class="services-boxs section-padding pb-30 pt-0">
    <div class="container">

        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">Our Process Approach</h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <h2 class="fw-600 text-u ls1">
                    <?php echo e($page->view_process_title); ?>

                </h2>
            </div>
        </div>

        <div class="row pt-30">

            <?php for($i = 1; $i <= 4; $i++): ?>
                <?php
                    $icon = "view_process_card{$i}_icon";
                    $title = "view_process_card{$i}_title";
                    $desc  = "view_process_card{$i}_desc";
                ?>

                <?php if(!empty($page->$title)): ?>
                <div class="col-lg-3 col-md-6 items">
                    <div class="item-box bg md-mb50">

                        <div class="icon mb-40 opacity-5">
                            <?php if($page->$icon): ?>
                            <img src="<?php echo e(asset('frontend/imgs/submenu/' . $page->$icon)); ?>">
                            <?php endif; ?>
                        </div>

                        <h5 class="mb-15 text-u">
                            <?php echo nl2br(e($page->$title)); ?>

                        </h5>

                        <p><?php echo e($page->$desc); ?></p>

                    </div>
                </div>
                <?php endif; ?>

            <?php endfor; ?>

        </div>
    </div>
</section>



<!-- ==================== Start Press_construction ==================== -->

<?php
    $section = $page->sections->first();
    $items   = $section?->items ?? collect();
    $points  = $section?->press_construction_points
                ? preg_split('/\r\n|\r|\n/', $section->press_construction_points)
                : [];
?>


<section class="team-tab press-con section-padding">
    <div class="container">

        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                <?php echo e($section->press_construction_title ?? 'Press Construction'); ?>

            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <!--<h2 class="fw-600 text-u ls1">-->
                <!--      <?php echo e($section->press_construction_title ?? 'Press Construction and Certification'); ?>-->
                <!--</h2>-->
            </div>
        </div>

        
        <ul class="rest list-arrow pt-0">

            <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(trim($point) !== ''): ?>

                    <?php
                        if (str_contains($point, ':')) {
                            [$bold, $normal] = explode(':', $point, 2);
                        } else {
                            $bold = $point;
                            $normal = '';
                        }
                    ?>

                    <li class="<?php echo e(!$loop->first ? 'mt-10' : ''); ?>">

                        <span class="icon">
                            <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                fill="#00225a"></path>
                            </svg>
                        </span>

                        <h6 class="inline fw-400">
                            <span class="fw-600"><?php echo e(trim($bold)); ?></span>
                            <?php echo e($normal ? ':'.trim($normal) : ''); ?>

                        </h6>

                    </li>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>


        
        <div class="row pt-30 desktop-tabs">

            <div class="col-12 col-lg-5 content">
                <h5></h5>

                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cluom <?php echo e($loop->first ? 'current' : ''); ?>" data-tab="tab-<?php echo e($loop->iteration); ?>">
                        <div class="info">
                            <h6><?php echo e($loop->iteration); ?>. <?php echo e($item->image_title); ?></h6>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="col-12 col-lg-7">
             <div class="glry-img">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div id="tab-<?php echo e($loop->iteration); ?>"
             class="bg-img tab-img <?php echo e($loop->first ? 'current' : ''); ?>"
             style="
                background-image: url('<?php echo e(asset('frontend/imgs/submenu/' . $item->image)); ?>');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
             ">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

            </div>

        </div>
        
        <div class="mobile-stack d-block d-lg-none">

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mobile-item mb-30">
            <h6 class="mb-15"><?php echo e($loop->iteration); ?>. <?php echo e($item->image_title); ?></h6>
            <img src="<?php echo e(asset('frontend/imgs/submenu/' . $item->image)); ?>" class="img-fluid rounded" alt="">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>


    </div>
</section>

<style>
    .desktop-tabs { display: flex; }
.mobile-stack { display: none; }

@media (max-width: 991px) {
    .desktop-tabs { display: none !important; }
    .mobile-stack { display: block !important; }
}
</style>



<!-- ==================== End Press_Construction ==================== -->
<!-- ==================== Start Features Products ==================== -->

<section class="work-carsouel section-padding pt-50 pb-50 position-re o-hidden">
    <div class="container">
        <div class="sec-head mb-30">
            
            <div class="d-flex" style="justify-content: space-between;">
            <h6 class="sub-title main-color">Our Products</h6>
<!--Download brochure button commented-->
       
            </div> 

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <h2 class="fw-600 text-u ls1">Featured <span class="fw-200">products</span></h2>

                <div class="ml-auto">
                    <div class="swiper-arrow-control">
                        <div class="swiper-button-prev">
                            <span class="ti-arrow-left"></span>
                        </div>
                        <div class="swiper-button-next">
                            <span class="ti-arrow-right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
use Illuminate\Support\Str;

$referenceName = $page->banner_title ?? $submenu->submenu_name;

$normalizedRef = Str::of($referenceName)
    ->lower()
    ->replace(['-', '_'], ' ')
    ->trim();
?>

    <div class="container">
        <div class="row">
            <div class="col-12 o-hidden">
                <div class="work-crus work-crus5 out" data-carousel="swiper" data-items="6" data-center="center"
                    data-loop="true" data-space="30" data-swiper-speed="1000">

                    <div id="content-carousel-container-unq-w" class="swiper-container" data-swiper="container">
                        <div class="swiper-wrapper">

                     <?php $__currentLoopData = $Productss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php
        if (!$product->category) {
            continue;
        }

        $categoryName = Str::of($product->category->catagory)
            ->lower()
            ->replace(['-', '_'], ' ')
            ->trim();

        $isRelated =
            Str::contains($categoryName, $normalizedRef) ||
            Str::contains($normalizedRef, $categoryName);
    ?>

    <?php if($isRelated): ?>
        <div class="swiper-slide">
            <div class="item" style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
                <div class="img hei-300px">
                    <img
                        src="<?php echo e($product->first_image
                            ? asset('uploads/products/' . $product->first_image)
                            : asset('assets/imgs/placeholder.webp')); ?>"
                        alt="<?php echo e($product->product_title); ?>">

                    <div class="cont">
                        <span class="mb-5">
                            <?php echo e($product->category->catagory); ?>

                        </span>

                        <h6 class="fz-18">
                            <?php echo e($product->product_title); ?>

                        </h6>
                    </div>

                    <?php if($product->slug): ?>
                        <a href="<?php echo e(route('product.detail', $product->slug)); ?>" class="plink"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        </div><!-- swiper-wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== End Features Products ==================== -->


<?php
    $mf = $page->manufacturingFacility;

    // Split title into two words (before & after first space)
    $facilityTitle = $mf->facility_title ?? 'Manufacturing Facility';

    if (str_contains($facilityTitle, ' ')) {
        [$mainTitle, $subTitle] = explode(' ', $facilityTitle, 2);
    } else {
        $mainTitle = $facilityTitle;
        $subTitle = '';
    }
?>

<!-- ==================== Start Machinery Facility ==================== -->
<section class="price-hr section-padding pt-50 pb-50 cap-machinary">

                    <!-- BACKGROUND VIDEO -->
                  <?php
                        $facilityBg = $mf->facility_bg_video ?? null;
                        $facilityBgType = null;
                        if ($facilityBg) {
                            if (preg_match('/\.webm($|\?)/i', $facilityBg)) {
                                $facilityBgType = 'video/webm';
                            } elseif (preg_match('/\.mp4($|\?)/i', $facilityBg)) {
                                $facilityBgType = 'video/mp4';
                            }
                        }
                    ?>
                    <video autoplay muted loop playsinline class="bg-video">
                        <?php if($facilityBgType): ?>
                            <source src="<?php echo e($facilityBg); ?>" type="<?php echo e($facilityBgType); ?>">
                        <?php endif; ?>
                        Your browser does not support HTML5 video.
                    </video>

                    <div class="overlay-content">
                        <div class="container">
                            <div class="row">

                                <!-- SECTION TITLE -->
                            <div class="sec-head mb-30">
                    <h6 class="sub-title mb-5">Know More about us</h6>

                    <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                        <h2>
                            <?php echo e($mainTitle); ?>

                            <?php if($subTitle): ?>
                                <span class="fw-200"><?php echo e($subTitle); ?></span>
                            <?php endif; ?>
                        </h2>
                    </div>
                </div>

                <div class="col-lg-12 valign">
                    <div class="items-box">

                        <!-- LOOP THROUGH 4 CARDS -->
                        <?php for($i = 1; $i <= 4; $i++): ?>

                            <?php
                                $title  = "card{$i}_title";
                                $points = "card{$i}_points";

                                // convert points to array line-by-line
                                $list = $mf->$points
                                    ? preg_split('/\r\n|\r|\n/', trim($mf->$points))
                                    : [];
                            ?>

                            <?php if($mf->$title): ?>
                                <div class="item radius-10 d-flex">
                                    <div class="type">
                                        <h5><?php echo e($mf->$title); ?></h5>
                                    </div>

                                    <div class="cont ml-10">
                                        <ul class="dot-list rest">

                                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(trim($p) !== ''): ?>
                                                    <li class="mb-10"><?php echo e(trim($p)); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endfor; ?>

                        <!-- TESTIMONIAL NOTE -->
                        <?php if($mf->facility_testimonial): ?>
                            <div class="col-12">
                                <h6 class="sub-text-cap">
                                    <?php echo e($mf->facility_testimonial); ?>

                                </h6>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<!-- ==================== End Machinery Facility ==================== -->

<!-- ==================== start Press Standards==================== -->
<section class="services-dots section-padding sub-bg radius-30 pb-30 ">
    <div class="container">

        
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                <?php echo e($page->pressStandards->first()->press_main_title ?? 'OUR PRESSES COMPLY WITH FOLLOWING STANDARDS'); ?>

            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                
            </div>
        </div>

        
        <div class="row xlg-marg ontop">

            <?php $__empty_1 = true; $__currentLoopData = $page->pressStandards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-6 col-lg-4">
                    <div class="item md-mb50">

                        
                        <img class="stan-img"
                             src="<?php echo e($ps->press_detail_logo 
                                    ? asset('frontend/imgs/submenu/'.$ps->press_detail_logo) 
                                    : asset('assets/imgs/default.png')); ?>"
                             alt="">

                        
                        <h5><?php echo e($ps->press_detail_title); ?></h5>

                        
                        <div class="text mt-5">
                            <p class="mb-30"><?php echo nl2br(e($ps->press_detail_desc)); ?></p>
                        </div>

                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                
                <div class="col-12 text-center">
                    <p class="text-muted">No Press Standards available.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<!-- ==================== End Press standards  ==================== -->
<!-- ==================== Start Design strength ==================== -->
<!-- ==================== Start Design strength (dynamic, safe) ==================== -->
<section class="services-dots section-padding sub-bg radius-30 ">
    <div class="container">

        
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-15">
                <?php echo e(optional($page->designStrength->first())->design_title ?? 'Design Strength'); ?>

            </h6>

            <div class="bord pt-20 bord-thin-top d-flex align-items-center">
                <!--<h2 class="fw-600 text-u ls1">-->
                <!--    DESIGN <span class="fw-200"> STRENGTH </span>-->
                <!--</h2>-->
            </div>
        </div>

        <div class="row xlg-marg ontop design-logos-all">

            
            <?php $__empty_1 = true; $__currentLoopData = $page->designStrength; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="item md-mb50">
                    <img class="design-img"
                         src="<?php echo e(($ds->design_softwares_logo && file_exists(public_path('frontend/imgs/submenu/'.$ds->design_softwares_logo)))
                                ? asset('frontend/imgs/submenu/'.$ds->design_softwares_logo)
                                : asset('assets/imgs/default.png')); ?>"
                         alt="<?php echo e($ds->design_title ?? 'Design software logo'); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">
                    No design software logos uploaded.
                </div>
            <?php endif; ?>

        </div>

        
        <div class="col-12 ">
            <p>
                <?php echo nl2br(e(optional($page->designStrength->first())->design_text ?? '')); ?>

            </p>
        </div>
    </div>
</section>


<!-- ==================== End Design strength ==================== -->

<!-- ==================== End Design strength ==================== -->





<!-- ==================== Start Services ==================== -->

<!-- HTML (place this near the end of your product page or in a global template) -->


<!-- ==================== End Services ==================== -->

<!-- ==================== Start price ==================== -->




<!-- ==================== End price ==================== -->
<!--<a href="#" class="floating-btn">Enquire Now</a>-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts_front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/frontend/groupsubmenu/index.blade.php ENDPATH**/ ?>