` 
<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('assets/plugins/input-tags/css/tagsinput.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
    <style>
        /* Card and Box Styling */
        .page-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .page-box:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 0.8rem;
            margin-bottom: 1.2rem;
        }

        .section-header i {
            color: #0d6efd;
            margin-right: 10px;
        }

        .section-header h2,
        .section-header h4 {
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Custom Buttons */
        .smart-btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            border: none;
        }

        .smart-btn i {
            margin-right: 6px;
        }

        .smart-btn:hover {
            transform: translateY(-2px);
        }

        .smart-btn-primary {
            background: #3a86ff;
            color: #fff;
        }

        .smart-btn-primary:hover {
            background: #2878f0;
            box-shadow: 0 4px 8px rgba(58, 134, 255, 0.25);
        }

        .smart-btn-danger {
            background: #ff3a5e;
            color: #fff;
        }

        .smart-btn-danger:hover {
            background: #e62e50;
            box-shadow: 0 4px 8px rgba(255, 58, 94, 0.25);
        }

        .smart-btn-dark {
            background: #343a40;
            color: #fff;
        }

        .smart-btn-dark:hover {
            background: #23272b;
            box-shadow: 0 4px 8px rgba(52, 58, 64, 0.25);
        }

        .smart-btn-success {
            background: #10b981;
            color: #fff;
            border: none;
        }

        .smart-btn-success:hover {
            background: #0ea271;
            transform: translateY(-2px);
        }

        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            font-weight: 500;
            border: none;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(58, 134, 255, 0.05);
        }

        /* Input Groups */
        .input-group-text {
            background-color: #f8f9fa;
        }

        /* Image Containers */
        .img-thumbnail-container {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #dee2e6;
            display: inline-block;
            padding: 3px;
            background: #fff;
        }

        /* Form Sections */
        .form-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes  fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modal Customization */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .action-btns {
                flex-direction: column;
                gap: 0.5rem;
            }

            .smart-btn {
                width: 100%;
                justify-content: center;
            }
        }

        .table img {
            width: 50px;
            height: auto;
            border-radius: 4px;
        }

        /* Specifications Fields */
        .spec-row {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: #f8f9fa;
        }

        td .me-1 {
            margin-right: 3.25rem !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('wrapper'); ?>
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="section-header">
                            <i class="bi bi-building-fill-gear"></i>
                            <h2 class="mb-0 text-uppercase">Product Management</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('testCurricular.index')); ?>" class="text-decoration-none">
                                        <i class="fas fa-home me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product Management</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Product Management Section -->
            <div class="page-box animate-fade-in">
                <div class="section-header">
                    <i class="bi bi-bookmark-star-fill fs-4"></i>
                    <h4 class="mb-0 text-uppercase">Product Management</h4>
                </div>

                <!-- Add New Button -->
                <div class="mb-3">
                    <button id="add-new-product" class="smart-btn smart-btn-success">
                        <i class="bi bi-plus-circle"></i> Add New Product
                    </button>
                </div>
                <!-- Products Table -->
                <div class="table-responsive">
                    <table id="productsTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Product Title</th>
                                <!--<th>Description</th>-->
                                <th>Banner Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($product->category->catagory ?? 'N/A'); ?></td>
                                    <td><?php echo e($product->product_title); ?></td>
                                    <!--<td><?php echo e(Str::limit($product->product_description, 100)); ?></td>-->
                                    <td>
                                        <?php if($product->banner): ?>
                                            <img src="<?php echo e(asset('uploads/products/' . $product->banner)); ?>" alt="Banner"
                                                class="img-thumbnail">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-product me-1"
                                            data-id="<?php echo e($product->id); ?>">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form id="delete-form-<?php echo e($product->id); ?>" method="POST"
                                            action="<?php echo e(route('product_view.destroy', $product->id)); ?>"
                                            style="display: none;">
                                       

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger delete-product"
                                            onclick="confirmDelete(<?php echo e($product->id); ?>)">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Product Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="productForm" method="POST" enctype="multipart/form-data" class="needs-validation"
                            novalidate> 
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="existing_product_images" id="existing_product_images">
                            <input type="hidden" name="product_video_remove" id="product_video_remove" value="0">

                            <input type="hidden" name="_method" id="method_field" value="POST">
                            <div class="modal-body">
                                <!-- Category Selection -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Category</label>
                                    <select class="form-select" name="catagory_id" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catagory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($catagory->id); ?>"><?php echo e($catagory->catagory); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Banner Image -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Banner Image</label>
                                    <input class="form-control" type="file" name="banner" accept="image/*">
                                    <div id="current-banner" class="current-preview mt-2"></div>
                                </div>

                                <!-- Product Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Product Title</label>
                                    <input class="form-control" type="text" name="product_title" required>
                                </div>

                                <!-- Product Description -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Product Description</label>
                                    <textarea class="form-control" name="product_description" rows="5" required></textarea>
                                </div>

                                <!-- Product Brochure -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Product Brochure</label>
                                    <input class="form-control" type="file" name="product_broucher"
                                        accept=".pdf,.doc,.docx">
                                    <div id="current-broucher" class="current-preview mt-2"></div>
                                </div>

                                <!-- Product Image (Gallery) -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Product Images (Gallery)</label>
                                    <div id="productImagesContainer"
                                        style="max-height: 600px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; border-radius: 4px;">
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addProductImageField()">
                                        + Add Image
                                    </button>
                                    <div id="current-product-image" class="current-preview mt-2"></div>
                                    <small class="text-muted d-block mt-1">Add multiple product images for gallery.
                                        Allowed: jpeg, jpg, png, gif, webp (Max 2MB each).</small>
                                </div>

                                <!-- Product Video -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Product Video URL</label>
                                    <input class="form-control" type="url" name="product_video_url"
                                        placeholder="Enter video URL (e.g., YouTube link)">
                                    <small class="text-muted">Or upload a file below if preferred</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Or Upload Video File</label>
                                    <input class="form-control" type="file" name="product_video_file"
                                        accept="video/*">
                                    <div id="current-video" class="current-preview mt-2"></div>
                                </div>

                                <!-- Industries Used In Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Section 2 Title</label>
                                    <input class="form-control" type="text" name="Section_2_title">
                                </div>
                                <!-- Industries Used In Description -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Industries Used In Description</label>
                                    <textarea class="form-control" name="industries_used_in_description" rows="4"></textarea>
                                </div>
                                <!-- ðŸŸ¢ Point 1 Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Point 1 Title</label>
                                    <input class="form-control" type="text" name="Point_1_title">
                                </div>
                                <!-- Industries Used In Automotive Points -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Industries Used In Automotive Points</label>
                                    <textarea class="form-control" name="industries_used_in_automotive_points" rows="3"
                                        placeholder="Enter points separated by commas (e.g., Point 1, Point 2, Point 3)"></textarea>
                                    <small class="text-muted">Stored as comma-separated string.</small>
                                </div>
                                <!-- ðŸ”´ Point 2 Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Point 2 Title</label>
                                    <input class="form-control" type="text" name="Point_2_title">
                                </div>
                                <!-- Industries Used In Consumer Goods Points -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Industries Used In Consumer Goods Points</label>
                                    <textarea class="form-control" name="industries_used_in_consumer_goods_points" rows="3"
                                        placeholder="Enter points separated by commas (e.g., Point 1, Point 2, Point 3)"></textarea>
                                    <small class="text-muted">Stored as comma-separated string.</small>
                                </div>
                                <!-- ðŸŸ£ Point 3 Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Point 3 Title</label>
                                    <input class="form-control" type="text" name="Point_3_title">
                                </div>

                                <!-- Industries Used In Industrial Machinery Points -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Industries Used In Industrial Machinery
                                        Points</label>
                                    <textarea class="form-control" name="industries_used_in_industrial_machinery_points" rows="3"
                                        placeholder="Enter points separated by commas (e.g., Point 1, Point 2, Point 3)"></textarea>
                                    <small class="text-muted">Stored as comma-separated string.</small>
                                </div>
                                <!-- ðŸŸ¡ Section 3 Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Section 3 Title</label>
                                    <input class="form-control" type="text" name="Section_3_title">
                                </div>

                                <!-- Features Points -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Features Points</label>
                                    <div id="featuresContainer"></div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addFeatureField()">
                                        + Add Feature
                                    </button>
                                    <input type="hidden" name="features_points" id="features_points">
                                    <small class="text-muted d-block mt-1">Add feature point text. Stored as JSON array in
                                        the database column.</small>
                                </div>
                                <!-- ðŸŸ  Section 4 Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Section 4 Title</label>
                                    <input class="form-control" type="text" name="Section_4_title">
                                </div>
                                <!-- Specifications Section -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Specifications Points</label>
                                    <div id="specContainer"></div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addSpecField()">
                                        + Add Specification
                                    </button>
                                    <input type="hidden" name="specifications_points" id="specifications_points">
                                    <small class="text-muted d-block mt-1">Add key-value pairs for specifications (e.g.,
                                        Main Text: Span Text). Stored as JSON in the database column.</small>
                                </div>

                                <!-- Optional Title -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Optional Title</label>
                                    <input class="form-control" type="text" name="optional_title"
                                        placeholder="Enter optional title">
                                </div>

                                <!-- Dynamic Attachments Collection -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Attachments (Achievements)</label>
                                    <div id="attachmentsContainer"
                                        style="max-height: 600px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; border-radius: 4px;">
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addAttachmentField()">
                                        + Add Attachment
                                    </button>
                                    <input type="hidden" name="attachments_collection" id="attachments_collection">
                                    <small class="text-muted d-block mt-1">Add image, category, title and description for
                                        each achievement.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/input-tags/js/tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            // Products data for population
            var productsData = <?php echo json_encode($products, 15, 512) ?>;
            var assetPath = "<?php echo e(asset('uploads/products/')); ?>";
            let specCount = 0; // Global counter for spec fields
            let productImageCount = 0; // Global counter for product image fields

            // Function to add product image field
            window.addProductImageField = function() {
                productImageCount++;
                const container = document.getElementById('productImagesContainer');
                const div = document.createElement('div');
                div.className = 'product-image-row card p-3 mb-3';
                div.innerHTML = `
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger btn-sm float-end" onclick="this.closest('.product-image-row').remove();">Remove</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Image <small>(Max 2MB, Webp)</small></label>
                                <input type="file" class="form-control product-image-input" name="product_image[]" accept="image/*">
                                <div class="product-image-preview mt-2"></div>
                            </div>
                        </div>
                    `;
                container.appendChild(div);
            };

            // Handle product image preview
            $(document).on('change', '.product-image-input', function() {
                const file = this.files[0];
                const preview = $(this).closest('.product-image-row').find('.product-image-preview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.html(
                            `<img src="${e.target.result}" width="120" class="rounded shadow-sm">`)
                    };
                    reader.readAsDataURL(file);
                }
            });

            // DataTable Initialization
            $("#productsTable").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: false,
                searching: true,
                language: {
                    search: "<i class='bi bi-search'></i> Search:",
                    lengthMenu: "<i class='bi bi-list'></i> _MENU_ records per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    paginate: {
                        first: "<i class='bi bi-chevron-double-left'></i>",
                        last: "<i class='bi bi-chevron-double-right'></i>",
                        next: "<i class='bi bi-chevron-right'></i>",
                        previous: "<i class='bi bi-chevron-left'></i>"
                    },
                    emptyTable: "No data available in table",
                    zeroRecords: "No matching records found"
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                initComplete: function() {
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                    $('.dataTables_length select').addClass('form-select form-control-sm');
                }
            });

            // Helper to normalize JSON/string fields into arrays
            window.parseJsonField = function(field) {
                if (Array.isArray(field)) {
                    return field;
                }
                if (typeof field === 'string') {
                    try {
                        const parsed = JSON.parse(field);
                        return Array.isArray(parsed) ? parsed : (parsed !== null ? [parsed] : []);
                    } catch (e) {
                        return field ? [field] : [];
                    }
                }
                return [];
            };

            // Function to add spec field
            window.addSpecField = function() {
                specCount++;
                const container = document.getElementById('specContainer');
                const div = document.createElement('div');
                div.className = 'row mb-2 spec-row';
                div.innerHTML = `
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Main Text (Label)" name="spec_main_${specCount}">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Span Text (Value)" name="spec_span_${specCount}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.spec-row').remove(); updateSpecs();">Remove</button>
                        </div>
                    `;
                container.appendChild(div);
            };

            // Function to update hidden specs field with JSON
            window.updateSpecs = function() {
                const specs = [];
                document.querySelectorAll('.spec-row').forEach(row => {
                    const mainInput = row.querySelector('input[name^="spec_main_"]');
                    const spanInput = row.querySelector('input[name^="spec_span_"]');
                    const main = mainInput ? mainInput.value.trim() : '';
                    const span = spanInput ? spanInput.value.trim() : '';
                    if (main && span) {
                        specs.push({
                            main: main,
                            span: span
                        });
                    }
                });
                document.getElementById('specifications_points').value = JSON.stringify(specs);
            };

            // Feature points counter
            let featureCount = 0;

            // Function to add feature field
            window.addFeatureField = function() {
                featureCount++;
                const container = document.getElementById('featuresContainer');
                const div = document.createElement('div');
                div.className = 'row mb-2 feature-row';
                div.innerHTML = `
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Feature Point Text" name="feature_text_${featureCount}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.feature-row').remove(); updateFeatures();">Remove</button>
                        </div>
                    `;
                container.appendChild(div);
            };

            // Function to update hidden features field with JSON (stores only text)
            window.updateFeatures = function() {
                const features = [];
                document.querySelectorAll('.feature-row').forEach(row => {
                    const textInput = row.querySelector('input[name^="feature_text_"]');
                    const text = textInput ? textInput.value.trim() : '';
                    if (text) {
                        features.push(text);
                    }
                });
                document.getElementById('features_points').value = JSON.stringify(features);
            };

            // Attachment counter
            let attachmentCount = 0;

            // Function to add attachment field
            window.addAttachmentField = function() {
                attachmentCount++;
                const container = document.getElementById('attachmentsContainer');
                const div = document.createElement('div');
                div.className = 'attachment-row card p-3 mb-3';
                div.innerHTML = `
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger btn-sm float-end" onclick="this.closest('.attachment-row').remove(); updateAttachments();">Remove</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Image <small>Allowed jpeg,jpg,webp (Max-size:5mb)</small></label>
                                <input type="file" class="form-control attachment-image-input" name="attachment_image_${attachmentCount}" accept="image/*">
                                <small class="text-muted">Leave empty to keep existing image</small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Category/Points</label>
                                <input type="text" class="form-control" placeholder="Comma-separated points (e.g., Support System, Safety)" name="attachment_category_${attachmentCount}">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Title</label>
                                <input type="text" class="form-control" placeholder="Attachment title" name="attachment_title_${attachmentCount}">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Description</label>
                                <textarea class="form-control" rows="3" placeholder="Attachment description" name="attachment_description_${attachmentCount}"></textarea>
                            </div>
                        </div>
                    `;
                container.appendChild(div);
            };

            // Function to update hidden attachments field with JSON
            window.updateAttachments = function() {
                const attachments = [];
                document.querySelectorAll('.attachment-row').forEach((row, index) => {
                    const categoryInput = row.querySelector('input[name^="attachment_category_"]');
                    const titleInput = row.querySelector('input[name^="attachment_title_"]');
                    const descInput = row.querySelector('textarea[name^="attachment_description_"]');

                    // Parse category into array (comma-separated)
                    const rawCategory = categoryInput ? categoryInput.value.trim() : '';
                    let category = [];
                    if (rawCategory) {
                        category = rawCategory.split(',').map(s => s.trim()).filter(Boolean);
                    }

                    const title = titleInput ? titleInput.value.trim() : '';
                    const description = descInput ? descInput.value.trim() : '';

                    // Only add if has at least title or description
                    if (title || description) {
                        attachments.push({
                            image: '', // Will be set by controller after file upload
                            category: category,
                            title: title,
                            description: description
                        });
                    }
                });
                document.getElementById('attachments_collection').value = JSON.stringify(attachments);
            };

            // Add New Product
            $('#add-new-product').on('click', function() {
                $('#productModalLabel').text('Add New Product');
                $('#productForm').attr('action', '<?php echo e(route('product_view.store')); ?>');
                $('#method_field').val('POST');
                $('#productForm')[0].reset();
                $('.current-preview').empty();
                $('#specContainer').empty();
                $('#featuresContainer').empty();
                $('#attachmentsContainer').empty();
                $('#productImagesContainer').empty();
                specCount = 0;
                featureCount = 0;
                attachmentCount = 0;
                productImageCount = 0;
                document.getElementById('specifications_points').value = '[]';
                document.getElementById('features_points').value = '[]';
                document.getElementById('attachments_collection').value = '[]';
                document.getElementById('product_video_remove').value = '0';
                $('#submit-btn').text('Create Product');
                $('#productModal').modal('show');
            });

            // Edit Product - Using event delegation to handle DataTable paging reliably
            $(document).on('click', '.edit-product', function() {
                var id = $(this).data('id');
                var product = productsData.find(function(p) {
                    return p.id == id;
                });
                if (!product) return;

                $('#productModalLabel').text('Edit Product');
                $('#productForm').attr('action', '<?php echo e(route('product_view.update', ':id')); ?>'.replace(':id',
                    id));
                $('#method_field').val('POST');
                // Populate fields
                $('[name="catagory_id"]').val(product.catagory_id);
                $('[name="product_title"]').val(product.product_title);
                $('[name="product_description"]').val(product.product_description);
                $('[name="Section_2_title"]').val(product.Section_2_title ?? '');
                $('[name="industries_used_in_description"]').val(product.industries_used_in_description);
                $('[name="Point_1_title"]').val(product.Point_1_title ?? '');
                $('[name="industries_used_in_automotive_points"]').val(product
                    .industries_used_in_automotive_points);
                $('[name="Point_2_title"]').val(product.Point_2_title ?? '');
                $('[name="industries_used_in_consumer_goods_points"]').val(product
                    .industries_used_in_consumer_goods_points);
                $('[name="Point_3_title"]').val(product.Point_3_title ?? '');
                $('[name="industries_used_in_industrial_machinery_points"]').val(product
                    .industries_used_in_industrial_machinery_points);
                $('[name="Section_3_title"]').val(product.Section_3_title ?? '');
                $('[name="Section_4_title"]').val(product.Section_4_title ?? '');
                $('[name="optional_title"]').val(product.optional_title);
                $('[name="attachment_1_catagory_points"]').val(product.attachment_1_catagory_points);
                $('[name="attachment_1_title"]').val(product.attachment_1_title);
                $('[name="attachment_1_description"]').val(product.attachment_1_description);
                $('[name="attachment_2_catagory_points"]').val(product.attachment_2_catagory_points);
                $('[name="attachment_2_title"]').val(product.attachment_2_title);
                $('[name="attachment_2_description"]').val(product.attachment_2_description);
               

                // Handle Video (URL or File path)
                var videoValue = product.product_video || '';
                if (videoValue.startsWith('http')) {
                    $('[name="product_video_url"]').val(videoValue);
                    $('#current-video').html(`
                            <div class="alert alert-info d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Current Video URL:</strong><br>
                                    <a href="${videoValue}" target="_blank" class="d-block mt-1">${videoValue}</a>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeVideoUrl()">Remove</button>
                            </div>
                        `);
                } else {
                    $('[name="product_video_url"]').val('');
                    if (videoValue) {
                        var fullVideoPath = assetPath.replace(/\/$/, '') + '/' + String(videoValue).replace(
                            /^\/+/, '');
                        $('#current-video').html(`
                                <div class="alert alert-info d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Current Video File:</strong><br>
                                        <a href="${fullVideoPath}" target="_blank" class="d-block mt-1">${videoValue}</a>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeVideoFile()">Remove</button>
                                </div>
                            `);
                    }
                }

                // Previews
                if (product.banner) {
                    $('#current-banner').html(
                        `<img src="${assetPath}/${product.banner}" width="120" class="mt-2 rounded shadow-sm">`
                    );
                }

                // Handle product images (array stored as JSON)
                $('#productImagesContainer').empty();
                productImageCount = 0;
                let imagesData = window.parseJsonField(product.product_image);
                $('#existing_product_images').val(JSON.stringify(imagesData));

                // Display existing images with remove buttons
                if (imagesData.length > 0) {
                    $('#current-product-image').html('<strong>Current Images:</strong><br>');
                    imagesData.forEach((image, idx) => {
                        $('#current-product-image').append(`
                                <div class="d-inline-block position-relative me-2 mb-2">
                                    <img src="${assetPath}/${image}" width="100" class="rounded shadow-sm" title="${image}">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" 
                                        onclick="removeCurrentImage('${image}')" title="Remove this image" 
                                        style="transform: translate(5px, -5px);">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            `);
                    });
                }

                if (product.product_broucher) {
                    $('#current-broucher').html(
                        `<a href="${assetPath}/${product.product_broucher}" target="_blank" class="mt-2 d-block">View Current Brochure</a>`
                    );
                }
                if (product.attachment_1_image) {
                    $('#current-attachment_1_image').html(
                        `<img src="${assetPath}/${product.attachment_1_image}" width="120" class="mt-2 rounded shadow-sm">`
                    );
                }
                if (product.attachment_2_image) {
                    $('#current-attachment_2_image').html(
                        `<img src="${assetPath}/${product.attachment_2_image}" width="120" class="mt-2 rounded shadow-sm">`
                    );
                }

                // Handle specifications (JSON parse and populate)
                $('#specContainer').empty();
                specCount = 0;
                let specsData = window.parseJsonField(product.specifications_points);
                specsData.forEach(function(spec) {
                    specCount++;
                    const div = $(`
                            <div class="row mb-2 spec-row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Main Text (Label)" name="spec_main_${specCount}" value="${spec.main || ''}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Span Text (Value)" name="spec_span_${specCount}" value="${spec.span || ''}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.spec-row').remove(); updateSpecs();">Remove</button>
                                </div>
                            </div>
                        `);
                    $('#specContainer').append(div);
                });
                updateSpecs(); // Initialize hidden field

                // Handle features (JSON parse and populate)
                $('#featuresContainer').empty();
                featureCount = 0;
                let featuresData = window.parseJsonField(product.features_points);
                featuresData.forEach(function(feature) {
                    featureCount++;
                    const div = $(`
                            <div class="row mb-2 feature-row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Feature Point Text" name="feature_text_${featureCount}" value="${feature || ''}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.feature-row').remove(); updateFeatures();">Remove</button>
                                </div>
                            </div>
                        `);
                    $('#featuresContainer').append(div);
                });
                updateFeatures(); // Initialize hidden field

                // Handle attachments (JSON parse and populate)
                $('#attachmentsContainer').empty();
                attachmentCount = 0;
                let attachmentsData = window.parseJsonField(product.attachments_collection);
                attachmentsData.forEach(function(attachment) {
                    attachmentCount++;
                    const div = $(`
                            <div class="attachment-row card p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-danger btn-sm float-end" onclick="this.closest('.attachment-row').remove(); updateAttachments();">Remove</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Image <small>Allowed jpeg,jpg,webp (Max-size:5mb)</small></label>
                                        <input type="file" class="form-control attachment-image-input" name="attachment_image_${attachmentCount}" accept="image/*">
                                        <small class="text-muted">Leave empty to keep existing image</small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Category/Points</label>
                                        <input type="text" class="form-control" placeholder="Comma-separated points (e.g., Support System, Safety)" name="attachment_category_${attachmentCount}" value="${Array.isArray(attachment.category) ? attachment.category.join(', ') : (attachment.category || '')}">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Title</label>
                                        <input type="text" class="form-control" placeholder="Attachment title" name="attachment_title_${attachmentCount}" value="${attachment.title || ''}">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Attachment description" name="attachment_description_${attachmentCount}">${attachment.description || ''}</textarea>
                                    </div>
                                </div>
                            </div>
                        `);
                    $('#attachmentsContainer').append(div);
                });
                updateAttachments(); // Initialize hidden field

                $('#product_video_remove').val('0');
                $('#submit-btn').text('Update Product');
                $('#productModal').modal('show');
            });

            // Reset video remove marker if user changes the video fields
            $(document).on('input change', '[name="product_video_url"], [name="product_video_file"]', function() {
                $('#product_video_remove').val('0');
            });

            // Enhanced Form Validation with specs update
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    updateSpecs(); // Collect specs before validation
                    updateFeatures(); // Collect features before validation
                    updateAttachments(); // Collect attachments before validation
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        const invalidFields = form.querySelectorAll(':invalid');
                        if (invalidFields.length > 0) {
                            invalidFields[0].focus();
                        }
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Please fill all required fields',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Update specs on input change in spec rows (for real-time sync)
            $(document).on('input', '.spec-row input', function() {
                updateSpecs();
            });

            // Update features on input change in feature rows (for real-time sync)
            $(document).on('input', '.feature-row input', function() {
                updateFeatures();
            });

            // Update attachments on input/file change in attachment rows (for real-time sync)
            $(document).on('input', '.attachment-row input, .attachment-row textarea', function() {
                updateAttachments();
            });
            $(document).on('change', '.attachment-image-input', function() {
                updateAttachments();
            });
        });

        // Remove current video URL
        function removeVideoUrl() {
            $('[name="product_video_url"]').val('');
            $('#product_video_remove').val('1');
            $('#current-video').html('');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Video URL removed',
                showConfirmButton: false,
                timer: 2000
            });
        }

        // Remove current video file
        function removeVideoFile() {
            $('[name="product_video_file"]').val('');
            $('#product_video_remove').val('1');
            $('#current-video').html('');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Video file removed',
                showConfirmButton: false,
                timer: 2000
            });
        }

        // Remove current product image
     function removeCurrentImage(imageName) {
    Swal.fire({
        title: 'Remove Image?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (!result.isConfirmed) return;

        // Get current list
        let images = JSON.parse(
            document.getElementById('existing_product_images').value || '[]'
        );

        // Remove clicked image
        images = images.filter(img => img !== imageName);

        // 🔥 SAVE UPDATED LIST
        document.getElementById('existing_product_images').value = JSON.stringify(images);

        // Remove from DOM
        $(`#current-product-image img[src$="${imageName}"]`).parent().remove();
    });
}


                    // Refresh the display
        //             $('#current-product-image').empty();
        //             if (imagesData.length > 0) {
        //                 $('#current-product-image').html('<strong>Current Images:</strong><br>');
        //                 const assetPath = "<?php echo e(asset('uploads/products/')); ?>";
        //                 imagesData.forEach((image) => {
        //                     $('#current-product-image').append(`
        //                             <div class="d-inline-block position-relative me-2 mb-2">
        //                                 <img src="${assetPath}/${image}" width="100" class="rounded shadow-sm" title="${image}">
        //                                 <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" 
        //                                     onclick="removeCurrentImage('${image}')" title="Remove this image" 
        //                                     style="transform: translate(5px, -5px);">
        //                                     <i class="bi bi-x"></i>
        //                                 </button>
        //                             </div>
        //                         `);
        //                 });
        //             }

        //             Swal.fire({
        //                 toast: true,
        //                 position: 'top-end',
        //                 icon: 'success',
        //                 title: 'Image removed',
        //                 showConfirmButton: false,
        //                 timer: 2000
        //             });
        //         }
        //     });
        // }

        // Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This product will be permanently deleted. This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3a5e",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "<i class='bi bi-trash'></i> Yes, delete it!",
                cancelButtonText: "<i class='bi bi-x-circle'></i> Cancel",
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary',
                    popup: 'animated fadeInDown faster'
                },
                buttonsStyling: true,
                backdrop: `rgba(0,0,0,0.4)`
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                    Swal.fire({
                        title: 'Deleting...',
                        html: 'Please wait while we process your request',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\herd\barani_live\resources\views/Backend/Product/view.blade.php ENDPATH**/ ?>