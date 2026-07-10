

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<style>
    .form-section { background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 25px; }
    .type-card {
    cursor: pointer;
    display: block;
}

.type-card .card {
    transition: all 0.3s ease;
}

.type-card:hover .card {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 123, 255, 0.15) !important;
}

.type-card input:checked + .card {
    border-color: #007bff !important;
    background: #f0f8ff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('wrapper'); ?>
<div class="page-wrapper">
    <div class="page-box">
        <div class="py-4 px-4">
            <h3><i class="fas fa-plus"></i> Create New Blog</h3>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('blogs.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <!-- Left -->
                    <div class="col-lg-8">

                        <div class="form-section">
                            <h5>Basic Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required value="<?php echo e(old('title')); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" value="<?php echo e(old('slug')); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="6"><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>

                        <!-- Type Selection -->
                        <!-- Content Type -->
<div class="form-section">
    <div class="form-header d-flex align-items-center mb-4">
        <i class="fas fa-layer-group text-primary me-2"></i>
        <h5 class="mb-0">Content Type</h5>
    </div>

    <div class="row g-3" id="contentTypeSelector">
        <!-- PDF -->
        <div class="col-md-4">
            <label class="type-card" data-type="pdf">
                <input type="radio" name="type" value="pdf" class="d-none" 
                       <?php echo e(old('type', $blog->type ?? '') == 'pdf' ? 'checked' : ''); ?> required>
                <div class="card h-100 border-2 <?php echo e(old('type', $blog->type ?? '') == 'pdf' ? 'border-primary' : ''); ?>">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-file-pdf fa-3x mb-3 text-danger"></i>
                        <h6 class="mb-1">PDF Document</h6>
                        <small class="text-muted">Upload PDF file</small>
                    </div>
                </div>
            </label>
        </div>

        <!-- Video -->
        <div class="col-md-4">
            <label class="type-card" data-type="video">
                <input type="radio" name="type" value="video" class="d-none" 
                       <?php echo e(old('type', $blog->type ?? '') == 'video' ? 'checked' : ''); ?>>
                <div class="card h-100 border-2 <?php echo e(old('type', $blog->type ?? '') == 'video' ? 'border-primary' : ''); ?>">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-video fa-3x mb-3 text-primary"></i>
                        <h6 class="mb-1">Video Content</h6>
                        <small class="text-muted">YouTube, Vimeo or Local</small>
                    </div>
                </div>
            </label>
        </div>

        <!-- Gallery -->
        <div class="col-md-4">
            <label class="type-card" data-type="gallery">
                <input type="radio" name="type" value="gallery" class="d-none" 
                       <?php echo e(old('type', $blog->type ?? '') == 'gallery' ? 'checked' : ''); ?>>
                <div class="card h-100 border-2 <?php echo e(old('type', $blog->type ?? '') == 'gallery' ? 'border-primary' : ''); ?>">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-images fa-3x mb-3 text-success"></i>
                        <h6 class="mb-1">Image Gallery</h6>
                        <small class="text-muted">Multiple images</small>
                    </div>
                </div>
            </label>
        </div>
    </div>
</div>

                        <!-- PDF -->
                        <div class="form-section pdf-fields">
                            <h5>PDF File</h5>
                            <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                        </div>

                        <!-- Video -->
                        <div class="form-section video-fields">
                            <h5>Video</h5>
                          
                            <input type="url" name="video_url" class="form-control mb-2" placeholder="YouTube/Vimeo URL">
                            <input type="file" name="video_file" class="form-control" accept="video/*">
                        </div>

                        <!-- Gallery -->
                        <div class="form-section gallery-fields">
                            <h5>Gallery Images</h5>
                            <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted">Hold Ctrl/Cmd to select multiple images</small>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="col-lg-4">
                        <div class="form-section">
                            <h5>Thumbnail</h5>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>

                        <div class="form-section">
                            <h5>Publish Settings</h5>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" <?php echo e(old('status', 1) == 1 ? 'selected' : ''); ?>>Published</option>
                                    <option value="0" <?php echo e(old('status', 1) == 0 ? 'selected' : ''); ?>>Draft</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Publish Date</label>
                                <input type="datetime-local" name="published_at" class="form-control" value="<?php echo e(old('published_at')); ?>">
                            </div>

                            <div class="mb-3">
                                <label>Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', 0)); ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Create Blog</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
document.querySelectorAll('input[name="type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.pdf-fields, .video-fields, .gallery-fields').forEach(el => el.style.display = 'none');
        if (this.value === 'pdf') document.querySelector('.pdf-fields').style.display = 'block';
        if (this.value === 'video') document.querySelector('.video-fields').style.display = 'block';
        if (this.value === 'gallery') document.querySelector('.gallery-fields').style.display = 'block';
    });
});

// Trigger initial display
document.querySelector('input[name="type"]:checked')?.dispatchEvent(new Event('change'));
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/Backend/blog/create.blade.php ENDPATH**/ ?>