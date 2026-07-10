

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/custome_backend/main.css')); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<style>
    .blog-card { transition: all 0.3s; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .type-badge { font-size: 0.75rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('wrapper'); ?>
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="py-4 px-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3><i class="fas fa-blog text-primary"></i> Blog Management</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?php echo e(route('blogs.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Blog
                    </a>
                    <a href="<?php echo e(route('blog-settings')); ?>" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-cog"></i> Page Settings
                    </a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card blog-card h-100">
                        <img src="<?php echo e($blog->thumbnail ? asset('storage/'.$blog->thumbnail) : asset('assets/images/default-blog.jpg')); ?>"
                             class="card-img-top" style="height: 180px; object-fit: cover;" alt="Thumbnail">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($blog->title); ?></h5>
                            <p class="text-muted small"><?php echo e(Str::limit(strip_tags($blog->description), 90)); ?></p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-<?php echo e($blog->status ? 'success' : 'warning'); ?> type-badge">
                                    <?php echo e($blog->status ? 'Published' : 'Draft'); ?>

                                </span>
                                <span class="badge bg-info type-badge"><?php echo e(ucfirst($blog->type)); ?></span>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="btn-group w-100">
                                <a href="<?php echo e(route('blogs.edit', $blog->id)); ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteBlog(<?php echo e($blog->id); ?>, '<?php echo e(addslashes($blog->title)); ?>')" 
                                        class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <h4>No blogs yet</h4>
                    <a href="<?php echo e(route('blogs.create')); ?>" class="btn btn-primary">Create First Blog</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteBlog(id, title) {
    Swal.fire({
        title: 'Delete Blog?',
        text: `"${title}" will be permanently deleted.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?php echo e(url('blogs')); ?>/${id}`;
            form.innerHTML = `<?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>`;
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/Backend/blog/index.blade.php ENDPATH**/ ?>