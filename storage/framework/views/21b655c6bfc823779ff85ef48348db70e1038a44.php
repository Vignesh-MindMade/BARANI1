

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custome_backend/main.css')); ?>" />
    <link href="<?php echo e(asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custome_backend/dashboard.css')); ?>" />

    <style>
        .multiple-images-container {
            border: 1px dashed #ccc;
            border-radius: 8px;
            padding: 15px;
            background: #f9f9f9;
            min-height: 140px;
        }

        .image-item {
            position: relative;
            display: inline-block;
            margin: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        .image-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 14px;
            line-height: 1;
            cursor: pointer;
        }

        .add-image-btn {
            margin-top: 10px;
        }

        /* Extra images column – responsive & safe */
        .extra-images-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            max-width: 180px;
            /* hard stop so it never eats next column */
        }

        .extra-images-wrap img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        .modal-dialog-scrollable .modal-content {
    max-height: unset !important;
    overflow: hidden;
}
    </style
<?php $__env->stopSection(); ?>

<?php $__env->startSection('wrapper'); ?>
    <div class="page-wrapper">
        <div class="page-box page-content">
            <div class="banner-manager-container py-4 px-4">

                       <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                    <div class="page-header">
                        
                            <h2 class="text-center"> View Awards</h2>
                    
                   
                    <div class="col-md-7">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('subpage.view')); ?>" class="text-decoration-none"> <i
                                            class="fas fa-home me-1"></i> Dashboard </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">View Awards</li>
                            </ol>
                        </nav>
                         </div>
                        </div>
                    </div>
                </div>
<div class="section-divider"></div>
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- ─── Add New Form ─────────────────────────────────────── -->
                <div class="row mt-4" id="addFormSection" style="display: none;">
                    <div class="col-12">
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Add New Award</h5>
                            </div>

                            <form action="<?php echo e(route('view_awards.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" required />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sort ID</label>
                                        <input class="form-control" name="sort_id" type="number" min="0" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="view_awards_description" rows="4"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Main Award Image <span
                                                class="text-danger">*</span></label>
                                        <div class="image-upload-container mb-3">
                                            <input type="file" class="form-control d-none" name="award_image"
                                                id="awardMainAdd" accept="image/webp,image/jpeg,image/jpg,image/png"
                                                required onchange="previewSingleImage(this, 'awardMainPreviewAdd')" />
                                            <label for="awardMainAdd" class="btn btn-sm btn-primary">Choose Main
                                                Image</label>
                                        </div>
                                        <div class="image-preview-container">
                                            <img id="awardMainPreviewAdd" src="" class="img-preview"
                                                style="max-width:220px; display:none;" />
                                        </div>
                                    </div>

                                    <!-- Multiple Images with Add/Remove -->
                                    <div class="col-12">
                                        <label class="form-label">Additional Award Images (optional)</label>
                                        <div class="multiple-images-container" id="multipleImagesAdd">
                                            <div class="image-slot">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary add-image-btn">
                                                    <i class="fas fa-plus"></i> Add Image
                                                </button>
                                            </div>
                                        </div>
                                        <small class="text-muted">You can add multiple images. Max 5MB each.</small>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-outline-secondary me-2"
                                        onclick="toggleContentHomeFirst()">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Award
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add New Button -->
                <div class="row mt-4">
                    <div class="col-12">
                        <button class="btn smart-btn-primary mb-3"
                            onclick="document.getElementById('addFormSection').style.display='block'">
                            <i class="fas fa-plus me-1"></i> Add New Award
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i>Awards List</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="awardsTable" class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Sort ID</th>
                                                <th>Main Image</th>
                                                <th>Extra Images</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $Histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><strong><?php echo e($history->title); ?></strong></td>
                                                    <td><?php echo e(Str::limit($history->view_awards_description ?? '', 80)); ?></td>
                                                    <td><?php echo e($history->sort_id ?? '-'); ?></td>
                                                    <td>
                                                        <?php if($history->award_image): ?>
                                                            <img src="<?php echo e(asset('images/' . $history->award_image)); ?>"
                                                                class="img-thumbnail"
                                                                style="width:80px; height:80px; object-fit:cover;">
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($history->images) && is_array($history->images)): ?>
                                                            <div class="extra-images-wrap">
                                                                <?php $__currentLoopData = $history->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <img src="<?php echo e(asset('images/' . $img)); ?>"
                                                                        class="img-thumbnail me-1"
                                                                        style="width:50px; height:50px; object-fit:cover;">
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                —
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal<?php echo e($history->id); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger"
                                                            onclick="confirmDelete('<?php echo e(route('view_awards.destroy', $history->id)); ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                
                <?php $__currentLoopData = $Histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="editModal<?php echo e($history->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Award</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form action="<?php echo e(route('view_awards.update', $history->id)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <div class="modal-body">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label class="form-label">Title *</label>
                                                <input class="form-control" name="title" value="<?php echo e($history->title); ?>"
                                                    required>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="view_awards_description" rows="4"><?php echo e($history->view_awards_description); ?></textarea>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Sort ID</label>
                                                <input class="form-control" name="sort_id" type="number"
                                                    value="<?php echo e($history->sort_id); ?>">
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label">Main Award Image</label>

                                                <?php if($history->award_image): ?>
                                                    <img src="<?php echo e(asset('images/' . $history->award_image)); ?>"
                                                        id="awardMainPreviewEdit<?php echo e($history->id); ?>"
                                                        class="img-thumbnail mb-2" style="max-width:240px;">
                                                <?php endif; ?>

                                                <input type="file" name="award_image" class="form-control"
                                                    accept="image/*"
                                                    onchange="previewSingleImage(this, 'awardMainPreviewEdit<?php echo e($history->id); ?>')">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Additional Images</label>

                                                <div class="multiple-images-container"
                                                    id="multipleImagesEdit<?php echo e($history->id); ?>">

                                                    <?php if(is_array($history->images)): ?>
                                                        <?php $__currentLoopData = $history->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="image-item">
                                                                <img src="<?php echo e(asset('images/' . $img)); ?>">
                                                                <button type="button" class="remove-btn">×</button>
                                                                <input type="hidden" name="existing_images[]"
                                                                    value="<?php echo e($img); ?>">
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                    <div class="image-slot mt-3">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary add-image-btn">
                                                            <i class="fas fa-plus"></i> Add More
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">
                                            Save Changes
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#awardsTable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                order: [
                    [3, 'asc']
                ]
            });

            // Dynamic "Add More Image" button
            $(document).on('click', '.add-image-btn', function() {
                const slot = $(this).closest('.image-slot');

                const newItem = $(`
                    <div class="image-item">
                        <input type="file" name="images[]" accept="image/*" class="d-none image-input">
                        <img src="" class="preview-img" style="width:120px;height:120px;object-fit:cover;display:none;">
                        <button type="button" class="remove-btn">×</button>
                        <div class="file-name" style="font-size:11px;margin-top:5px;"></div>
                    </div>
                `);

                // Add the new item before the "Add More" button
                slot.before(newItem);

                const fileInput = newItem.find('input[type="file"]');

                fileInput.on('change', function() {
                    if (!this.files || !this.files[0]) {
                        newItem.remove();
                        return;
                    }

                    const file = this.files[0];
                    const reader = new FileReader();

                    newItem.find('.file-name').text(file.name);

                    reader.onload = function(e) {
                        newItem.find('img').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                });

                // Trigger file selection
                fileInput.trigger('click');
            });

            // Remove image item
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.image-item').remove();
            });
        });

        function previewSingleImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewMultipleImage(input, event) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const imgElement = $(input).siblings('img.preview-img')[0] || $(input).closest('.image-item').find('img')[
                0];

                reader.onload = function(e) {
                    if (imgElement) {
                        imgElement.src = e.target.result;
                        imgElement.style.display = 'block';
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDelete(url) {
            Swal.fire({
                title: 'Delete this award?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = '<?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function toggleContentHomeFirst() {
            document.getElementById('addFormSection').style.display = 'none';
        }


        // ────────────────────────────────────────────────
        // Global cleanup - remove any stray backdrops
        // ────────────────────────────────────────────────
        // Keep modals attached to body to avoid table/Datatable DOM issues
        $(document).on('show.bs.modal', '.modal', function() {
            $(this).appendTo('body');
        });

        // Cleanup stray backdrops after any modal closes
        $(document).on('hidden.bs.modal', '.modal', function() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css({
                paddingRight: '',
                overflow: ''
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/Backend/aboutus/view_awards.blade.php ENDPATH**/ ?>