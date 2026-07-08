
<?php $__env->startSection('style'); ?>



<style>
.pps-product-thumb-swiper .swiper-wrapper {
    flex-direction: column;
}

    .pps-product-main-swiper {
    height: 600px;
}
.pps-media-wrap {
    height:100%;
}

.pps-product-main-swiper img,
.pps-product-main-swiper video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
}

.pps-product-thumb-swiper {
    height: 600px;

    border-radius: 10px;

}

.pps-product-thumb-swiper .swiper-slide {
    height: 120px;
    opacity: 0.4;
    cursor: pointer;
    transition: all 0.4s ease;
    position: relative;
}

.pps-product-thumb-swiper .swiper-slide-thumb-active {
    opacity: 1;
    transform: scale(.95);
}

.pps-product-thumb-swiper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.pps-video-icon {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #fff;
    background: rgba(0,0,0,0.4);
    border-radius: 10px;
}

/* Mobile */
@media (max-width: 991px) {
    .pps-product-main-swiper,
    .pps-product-thumb-swiper {
        height: auto;
    }

    .pps-product-thumb-swiper {
        margin-top: 15px;
    }

    .pps-product-thumb-swiper .swiper-slide {
        height: 90px;
    }
}


/*arrow*/

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentFront'); ?>




<div id="">
    <div id="">
        <main class="main-bg">
            <header class="page-header-cerv bg-img section-padding" data-background="<?php echo e(asset('uploads/products/' . ($product->banner ?? 'default-banner.jpg'))); ?>" data-overlay-dark="4" >
                <div class="container pt-100 ontop">
                    <div class="text-center">
                        <h1 class="fz-100"><?php echo e($product->product_title); ?></h1>
                        <div class="mt-15 mb-4">
                            <a href="<?php echo e(url('/')); ?>">Home</a>
                            <span class="padding-rl-20">|</span>
                            <span class="text-white">Product</span>
                        </div>
                    </div>
                </div>
            </header>
           

            <section class="section-padding product-section-b pb-20">
                
                <div class="container">
                        <!--<div class="mb-2">-->
                        <!--    <a href="<?php echo e(url('/')); ?>">Home</a>-->
                        <!--    <span class="padding-rl-20">|</span>-->
                        <!--    <span class="text-BLACK">Product</span>-->
                        <!--</div>-->
                    <div class="row mb-30 header-project6">
                        
                        <div class="col-12">
                            
                            <div class="info d-flex align-items-center mb-10">
                                
                                <div>
                                    
                                    <span class="category"><?php echo e($product->category->catagory ?? 'Uncategorized'); ?></span>
                                </div>
                                <div class="date">Latest version</div>
                            </div>
                            <div class="row gap-sm">
                                <div class=" col-lg-9">
                                    <h3 class="fz-40 mb-0"><?php echo e($product->product_title); ?></h3>
                                    
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!--<h5 class="mb-10">Description</h5>-->
                            <div class="text">
                                <p class="fz-16"><?php echo nl2br(e($product->product_description)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
<!---->

 <!--<section class="services-details pps-services-details section-padding pt-0 pb-20">-->
 <!--               <div class="container">-->
 <!--                   <div class="row">-->
            
                        <!-- MAIN MEDIA -->
 <!--                       <div class="col-lg-10">-->
 <!--                           <div class="swiper pps-product-main-swiper">-->
 <!--                               <div class="swiper-wrapper">-->
            
                                    <!-- VIDEO -->
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <div class="pps-media-wrap">-->
 <!--                                           <video muted playsinline loop>-->
 <!--                                               <source src="https://sigmadigitec.in/barani-new/assets/videos/1.mp4" type="video/mp4">-->
 <!--                                           </video>-->
 <!--                                       </div>-->
 <!--                                   </div>-->
            
                                    <!-- IMAGES -->
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/1.jpg" alt="">-->
 <!--                                   </div>-->
            
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/2.jpg" alt="">-->
 <!--                                   </div>-->
            
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/3.jpg" alt="">-->
 <!--                                   </div>-->
            
 <!--                               </div>-->
 <!--                           </div>-->
 <!--                       </div>-->
            
                        <!-- THUMBNAILS -->
 <!--                       <div class="col-lg-2">-->
 <!--                           <div class="swiper pps-product-thumb-swiper">-->
 <!--                               <div class="swiper-wrapper">-->
            
 <!--                                   <div class="swiper-slide pps-video-thumb">-->
 <!--                                       <span class="pps-video-icon">▶</span>-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/product/1.jpg">-->
 <!--                                   </div>-->
            
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/1.jpg">-->
 <!--                                   </div>-->
            
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/2.jpg">-->
 <!--                                   </div>-->
            
 <!--                                   <div class="swiper-slide">-->
 <!--                                       <img src="https://sigmadigitec.in/barani-new/assets/imgs/blog/3.jpg">-->
 <!--                                   </div>-->
            
 <!--                               </div>-->
 <!--                           </div>-->
 <!--                       </div>-->
            
 <!--                   </div>-->
 <!--               </div>-->
 <!--           </section>-->
                <?php
                    // Decode product images
                    $imagesData = [];
                    if ($product->product_image) {
                        $decoded = json_decode($product->product_image, true);
                        $imagesData = is_array($decoded) ? $decoded : [$product->product_image];
                    }

                    $totalSlides = ($product->product_video ? 1 : 0) + count($imagesData);
                ?>
                <?php if($totalSlides > 0): ?>
                    <section class="services-details pps-services-details section-padding pt-0 pb-20">
                        <div class="container">
                            <div class="row">

                                <!-- MAIN MEDIA -->
                                <div class="col-lg-10">
                                    <div class="swiper pps-product-main-swiper">
                                        <div class="swiper-wrapper">

                                            <!-- VIDEO -->
                                            <?php if($product->product_video): ?>
                                                <div class="swiper-slide">
                                                    <div class="pps-media-wrap">
                                                        <?php if(str_starts_with($product->product_video, 'http')): ?>
                                                            <iframe width="100%" height="600"
                                                                src="<?php echo e(str_replace('watch?v=', 'embed/', $product->product_video)); ?>"
                                                                allowfullscreen>
                                                            </iframe>
                                                        <?php else: ?>
                                                            <video muted playsinline loop autoplay>
                                                                <source
                                                                    src="<?php echo e(asset('uploads/products/' . $product->product_video)); ?>"
                                                                    type="video/mp4">
                                                            </video>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                                <!-- IMAGES -->
                                            <?php $__currentLoopData = $imagesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="swiper-slide" >
                                                        <img src="<?php echo e(asset('uploads/products/' . $image)); ?>"
                                                            alt="<?php echo e($product->product_title); ?>">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                </div>

                                <!-- THUMBNAILS -->
                                <!--<div class="col-lg-2">-->
                                <!--    <div class="swiper pps-product-thumb-swiper">-->
                                        
                                        
                                
                                <!--        <div class="swiper-wrapper">-->
                                
                                <!--            <?php if($product->product_video): ?>-->
                                <!--                <div class="swiper-slide pps-video-thumb">-->
                                <!--                    <span class="pps-video-icon">▶</span>-->
                                <!--                    <video class="pps-video-cover" muted playsinline preload="metadata"-->
                                <!--                           style="border-radius:10px;height:160px;object-fit:cover;width:100%;">-->
                                <!--                        <source src="<?php echo e(asset('uploads/products/' . $product->product_video)); ?>" type="video/mp4">-->
                                <!--                    </video>-->
                                <!--                </div>-->
                                <!--            <?php endif; ?>-->
                                
                                <!--            <?php $__currentLoopData = $imagesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                                <!--                <div class="swiper-slide">-->
                                <!--                    <img src="<?php echo e(asset('uploads/products/' . $image)); ?>"-->
                                <!--                         alt="<?php echo e($product->product_title); ?>">-->
                                <!--                </div>-->
                                <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                                
                                <!--        </div>-->
                                        
                                        <!--<div class="ml-auto">-->
                                        <!--            <div class="swiper-arrow-control justify-content-between">-->
                                        <!--                <div class="swiper-button-prev thumbs-arrow thumbs-prev">-->
                                        <!--                    <span class="ti-arrow-up"></span>-->
                                        <!--                </div>-->
                                        <!--                <div class="swiper-button-next thumbs-arrow thumbs-next">-->
                                        <!--                    <span class="ti-arrow-down"></span>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                        <!--</div>-->
                                <!--    </div>-->
                                <!--</div>-->
                               <div class="col-lg-2">
    <div class="swiper pps-product-thumb-swiper vertical-scroll overflow-auto" style="max-height:fit-content;">
        <div class="swiper-wrapper">
            <?php if($product->product_video): ?>
                <div class="swiper-slide pps-video-thumb tthum-img">
                    <span class="pps-video-icon">▶</span>
                    <video class="pps-video-cover" muted playsinline preload="metadata"
                        style="border-radius:10px;object-fit:cover;width:100%">
                        <source src="<?php echo e(asset('uploads/products/' . $product->product_video)); ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>
            <?php $__currentLoopData = $imagesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide mb-2 tthum-img">
                    <img src="<?php echo e(asset('uploads/products/' . $image)); ?>"
                        alt="<?php echo e($product->product_title); ?>" class="rounded">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!--<div class="swiper-scrollbar"></div>-->
    </div>
</div>



                            </div>
                        </div>
                    </section>
                <?php endif; ?>



            <?php if(
    $product->Section_2_title ||
    $product->industries_used_in_description ||
    $product->Point_1_title || $product->industries_used_in_automotive_points ||
    $product->Point_2_title || $product->industries_used_in_consumer_goods_points ||
    $product->Point_3_title || $product->industries_used_in_industrial_machinery_points
): ?>

                <section class="services-dots section-padding indust-used radius-30 pb-20 pt-0">
                    <div class="container">
                        <h5 class="mb-15"><?php echo e($product->Section_2_title ?? 'Industries Used In'); ?></h5>
                        <p class="mb-10 mt-10"><?php echo nl2br(e($product->industries_used_in_description)); ?></p>
                        <div class="row  ontop ml-10 mr-50">
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="item md-mb50">
                                    <h6><?php echo e($product->Point_1_title ?? ''); ?></h6>
                                    <div class="text mt-15">
                                        <?php if($product->industries_used_in_automotive_points): ?>
                                            <ul class="rest dot-list fz-18">
                                                <?php $__currentLoopData = explode(',', $product->industries_used_in_automotive_points); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="mb-10"><?php echo e(trim($point)); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4  col-lg-3">
                                <div class="item md-mb50">
                                    <h6><?php echo e($product->Point_2_title ?? ''); ?></h6>
                                    <div class="text mt-15">
                                        <?php if($product->industries_used_in_consumer_goods_points): ?>
                                            <ul class="rest dot-list fz-18">
                                                <?php $__currentLoopData = explode(',', $product->industries_used_in_consumer_goods_points); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="mb-10"><?php echo e(trim($point)); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="item">
                                    <h6><?php echo e($product->Point_3_title ?? ''); ?></h6>
                                    <div class="text mt-15">
                                        <?php if($product->industries_used_in_industrial_machinery_points): ?>
                                            <ul class="rest dot-list fz-18">
                                                <?php $__currentLoopData = explode(',', $product->industries_used_in_industrial_machinery_points); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="mb-10"><?php echo e(trim($point)); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

<?php if($product->features_points): ?>
<section class="pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-30">
                <h5 class="mb-15"><?php echo e($product->Section_3_title ?? ''); ?></h5>

                <?php
                    // Normalize JSON or comma-separated text
                    if (is_string($product->features_points) && str_starts_with(trim($product->features_points), '[')) {
                        $featuresList = json_decode($product->features_points, true) ?? [];
                    } else {
                        $featuresList = explode(',', $product->features_points);
                    }

                    // Clean bracket and quote characters
                    $featuresList = array_map(fn($f) => trim($f, " \t\n\r\0\x0B\"[]"), $featuresList);
                ?>

                <div class="row pl-30">
                    <div class="col-md-6">
                        <ul class="rest list-arrow feature-list">
                            <?php $__currentLoopData = array_slice($featuresList, 0, ceil(count($featuresList)/2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="icon">
                                        <svg width="100%" height="100%" viewbox="0 0 9 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                  fill="#002359"></path>
                                        </svg>
                                    </span>
                                    <h6 class="inline fw-400"><?php echo e($feature); ?></h6>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="rest list-arrow feature-list">
                            <?php $__currentLoopData = array_slice($featuresList, ceil(count($featuresList)/2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="icon">
                                        <svg width="100%" height="100%" viewbox="0 0 9 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                  fill="#002359"></path>
                                        </svg>
                                    </span>
                                    <h6 class="inline fw-400"><?php echo e($feature); ?></h6>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>


                <?php
                    $specs = $product->specifications_points;
                    if (is_string($specs)) {
                        $specs = json_decode($specs, true) ?? [];
                    }
                ?>

                <?php if(!empty($specs)): ?>
                    <section class="product-specs section-padding pt-0 pb-50">
                        <div class="container">
                            <h5 class="mb-25 mt-12"><?php echo e($product->Section_4_title ?? 'Specifications'); ?></h5>
                            <div class="specs-grid">
                                <?php $__currentLoopData = $specs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="spec-item">
                                        <span class="spec-label"><?php echo e($spec['main'] ?? ''); ?></span>
                                        <span class="spec-value"><?php echo e($spec['span'] ?? ''); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </section>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                <?php endif; ?>


<?php
    // Decode attachments safely
    $attachmentsData = is_array($product->attachments_collection)
        ? $product->attachments_collection
        : (json_decode($product->attachments_collection ?? '[]', true) ?? []);

    // Detect if at least one attachment has ANY actual field
    $hasValidAttachments = false;

    foreach ($attachmentsData as $a) {
        if (
            !empty($a['image']) ||
            !empty($a['title']) ||
            !empty($a['description']) ||
            (!empty($a['category']) && $a['category'] != '[]')
        ) {
            $hasValidAttachments = true;
            break;
        }
    }

    // Final condition: Section should show ONLY if optional_title OR any real attachment exists
    $shouldShowAttachments = !empty($product->optional_title) || $hasValidAttachments;
?>

           <?php if($shouldShowAttachments): ?>
<section class="blog-list-half section-padding sub-bg pt-30">
    <div class="container">
        <h5 class="mb-15"><?php echo e($product->optional_title ?? ''); ?></h5>

        <div class="row">

            <?php $__currentLoopData = $attachmentsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(
                    !empty($attachment['image']) ||
                    !empty($attachment['title']) ||
                    !empty($attachment['description']) ||
                    (!empty($attachment['category']) && $attachment['category'] != '[]')
                ): ?>
                <div class="col-12 col-lg-6" >
                    <div class="item main-bg h-100">
                        <div class="row rest">

                            <?php if(!empty($attachment['image'])): ?>
                                <div class="col-lg-6 col-md-5 img rest">
                                    <img src="<?php echo e(asset('uploads/products/' . $attachment['image'])); ?>" alt="<?php echo e($attachment['title'] ?? ''); ?>" class="img-post">
                                </div>
                            <?php endif; ?>

                            <div class="col-lg-6 col-md-7 cont valign">
                                <div class="full-width">

                                    <?php if(!empty($attachment['category'])): ?>
                                        <div class="tags mb-15">
                                            <?php if(is_array($attachment['category'])): ?>
                                                <?php $__currentLoopData = $attachment['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#"><?php echo e(trim($cat)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <a href="#"><?php echo e($attachment['category']); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($attachment['title'])): ?>
                                        <h5><a href="#"><?php echo e($attachment['title']); ?></a></h5>
                                    <?php endif; ?>

                                    <?php if(!empty($attachment['description'])): ?>
                                        <p><?php echo nl2br(e($attachment['description'])); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>

        </main>
    </div>
</div>



<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if($product->product_video): ?>
                    <?php if(str_starts_with($product->product_video, 'http')): ?>
                        <iframe width="100%" height="315" src="<?php echo e(str_replace('watch?v=', 'embed/', $product->product_video)); ?>" frameborder="0" allowfullscreen></iframe>
                    <?php else: ?>
                        <video width="100%" height="315" controls>
                            <source src="<?php echo e(asset('uploads/products/' . $product->product_video)); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No video available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>







<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts_front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/frontend/product/detatil.blade.php ENDPATH**/ ?>