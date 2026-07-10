
<?php $__env->startSection('contentFront'); ?>
<style>
.blog-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: 0.4s;
    height: 100%;
}

.blog-card:hover {
    transform: translateY(-8px);
}

.blog-card .img img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.blog-card .content {
    padding: 30px;
}

.blog-card .date {
    font-size: 14px;
    color: #777;
    display: block;
    margin-bottom: 15px;
}

.blog-card h4 {
    font-size: 22px;
    margin-bottom: 15px;
}

.blog-card p {
    margin-bottom: 25px;
    color: #666;
}

.main-btn {
    display: inline-block;
    padding: 12px 28px;
    border: 1px solid #002359;
    border-radius: 30px;
    text-decoration: none;
    transition: 0.3s;
}

.main-btn:hover {
    background: #002359;
    color: #fff;
}
.blog-info .date{
	display: inline-flex;
	align-items: center;
	gap: 10px;
	flex-wrap: nowrap;
}
.blog-info .date span {
	display: inline-flex !important;
	align-items: center;
}
.video-tag {
	background: #3f51b5;
	color: #fff;
	padding: 5px 12px;
	border-radius: 20px;
	font-size: 12px;
      margin-left: 10px;
	font-weight: 600;
}
.date{
    display:inline-block;
    margin:0;
    color:#777;
    font-size:14px;
}

.blog-card .img{
    position: relative;
    overflow: hidden;
}

.video-overlay{
    position: relative;
    display: block;
}

.video-overlay img{
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
}

.play-btn{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #002359;
    transition: .3s;
}

.video-overlay:hover .play-btn{
    transform: translate(-50%, -50%) scale(1.1);
}
.blog-card .img a{
    display: block;
    width: 100%;
}

.blog-card .img img{
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
}
</style>


    <?php if($blogSettings->banner_image): ?>
        <header class="page-header-cerv bg-img section-padding"
            data-background="<?php echo e(asset('storage/' . $blogSettings->banner_image)); ?>"
            data-overlay-dark="5">
    <?php else: ?>
        <header class="page-header-cerv bg-img section-padding"
            data-background="assets/imgs/blog/blog-banner.jpg"
            data-overlay-dark="5">
    <?php endif; ?>



    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100"><?php echo e($blogSettings->banner_title ?? ''); ?></h1>
            <div class="mt-15 mb-4">
                <a href="index.php">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Blog</span>
            </div>
        </div>
    </div>
</header>


<section class="blog-page section-padding">
    <div class="container">
        <div class="sec-head text-center mb-60">
            <h6 class="sub-title main-color mb-15"><?php echo e($blogSettings->section_subtitle ?? ''); ?></h6>
            <h2><?php echo e($blogSettings->section_title ?? ''); ?></h2>
            <p class="mt-20">
                <?php echo e($blogSettings->section_description ?? ''); ?>

            </p>
        </div>
<div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $blogs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6 mb-40">
                    <div class="blog-card">

                        <div class="img">
                            <?php if($blog->isVideo()): ?>
                                <!-- Video Card - Fancybox will handle popup -->
 
                                <a href="<?php echo e($blog->video_url ?? asset('storage/' . $blog->video_file)); ?>" 
                                   class=" video-trigger" 
                                   data-fancybox 
                                   data-caption="<?php echo e($blog->title); ?>">
                                    <img src="<?php echo e($blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('assets/imgs/blog/default.jpg')); ?>" 
                                         alt="<?php echo e($blog->title); ?>">
                                    <span class="play-btn">
                                        <i class="fas fa-play"></i>
                                    </span>
                                </a>

                            <?php elseif($blog->isGallery() && $blog->images->count()): ?>
                                <!-- Gallery -->
                                <a href="<?php echo e($blog->images->first()->getImageUrlAttribute()); ?>" 
                                   data-fancybox="gallery-<?php echo e($blog->id); ?>">
                                    <img src="<?php echo e($blog->thumbnail ? asset('storage/' . $blog->thumbnail) : $blog->images->first()->getImageUrlAttribute()); ?>" 
                                         alt="<?php echo e($blog->title); ?>">
                                </a>
                                <?php $__currentLoopData = $blog->images->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($image->getImageUrlAttribute()); ?>" 
                                       data-fancybox="gallery-<?php echo e($blog->id); ?>"></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                                <!-- PDF or Normal -->
                                <img src="<?php echo e($blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('assets/imgs/blog/default.jpg')); ?>" 
                                     alt="<?php echo e($blog->title); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="content">
                            <div class="blog-info">
                                <span class="date"><?php echo e($blog->published_at?->format('d F Y') ?? $blog->created_at->format('d F Y')); ?></span>
                                
                                <?php if($blog->isPdf()): ?>
                                    <a href="<?php echo e(asset('storage/' . $blog->pdf_file)); ?>" target="_blank" class="video-tag">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                <?php elseif($blog->isVideo()): ?>
                                    <span class="video-tag">
                                        <i class="fas fa-play-circle"></i> Video
                                    </span>
                                <?php elseif($blog->isGallery()): ?>
                                    <span class="video-tag">
                                        <i class="fas fa-image"></i> Gallery
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h4><?php echo e($blog->title); ?></h4>
                            <p><?php echo e(Str::limit(strip_tags($blog->description ?? ''), 120)); ?></p>

                            <!-- Buttons -->
                            <?php if($blog->isPdf()): ?>
                                <a href="<?php echo e(asset('storage/' . $blog->pdf_file)); ?>" target="_blank" class="main-btn">
                                    <span>View PDF</span>
                                </a>
                            <?php elseif($blog->isVideo()): ?>
                                <a href="<?php echo e($blog->video_url ?? asset('storage/' . $blog->video_file)); ?>" 
                                   class="main-btn video-trigger" data-fancybox>
                                    <span>Watch Video</span>
                                </a>
                            <?php elseif($blog->isGallery()): ?>
                                <a href="<?php echo e($blog->images->first()->getImageUrlAttribute()); ?>" data-fancybox="gallery-<?php echo e($blog->id); ?>" class="main-btn">
                                    <span>View Gallery</span>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(url('/blog/' . $blog->slug)); ?>" class="main-btn">
                                    <span>Read More</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <h4>No blogs found.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts_front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/frontend/blog/index.blade.php ENDPATH**/ ?>