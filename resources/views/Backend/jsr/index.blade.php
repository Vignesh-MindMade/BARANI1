@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
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
            background: #0d6efd;
            color: #fff;
        }

        .smart-btn-primary:hover {
            background: #0a58ca;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.25);
        }

        .smart-btn-danger {
            background: #ff3a5e;
            color: #fff;
        }

        .smart-btn-danger:hover {
            background: #e52d50;
            box-shadow: 0 4px 8px rgba(255, 58, 94, 0.25);
        }

        .smart-btn-dark {
            background: #212529;
            color: #fff;
        }

        .smart-btn-dark:hover {
            background: #343a40;
            box-shadow: 0 4px 8px rgba(33, 37, 41, 0.25);
        }

        .smart-btn-success {
            background: #10b981;
            color: #fff;
        }

        .smart-btn-success:hover {
            background: #0ea271;
            transform: translateY(-2px);
        }

        .smart-btn-warning {
            background: #ffc107;
            color: #000;
        }

        .smart-btn-warning:hover {
            background: #e0a800;
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
            background-color: #212529;
            color: #fff;
            font-weight: 500;
            border: none;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
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

        @keyframes fadeIn {
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

        /* Dynamic Item Styling */
        .dynamic-item {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .remove-item-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Program Category Styling */
        .program-category-block {
            background: #f8f9fa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .program-category-block .programs-section {
            background: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .program-item {
            background: #f8f9fa;
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
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="section-header">
                            <i class="bi bi-building-fill-gear"></i>
                            <h2 class="mb-0 text-uppercase">JSR Management</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('testCurricular.index') }}" class="text-decoration-none">
                                        <i class="fas fa-home me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">JSR</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Add New JSR Button -->
            @if($jsr->isEmpty())
                <div class="page-box animate-fade-in">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Create JSR Content</h5>
                        <button id="toggleCreateButton" class="smart-btn smart-btn-dark" onclick="toggleCreateForm()">
                            <i class="bi bi-plus-circle"></i> Add New JSR
                        </button>
                    </div>

                    <!-- Create Form (Hidden by default) -->
                    <div id="createFormContent" style="display: none;" class="animate-fade-in">
                        @include('Backend.jsr.partials.form', ['action' => route('jsr.store'), 'method' => 'POST', 'item' => null])
                    </div>
                </div>
            @endif

            <!-- Existing JSR List -->
            @if($jsr->isNotEmpty())


                <!-- Edit Forms -->
                @foreach ($jsr as $item)
                    <div id="edit-{{ $item->id }}" class="page-box animate-fade-in">
                        <div class="section-header">
                            <i class="bi bi-pencil-square fs-4"></i>
                            <h4 class="mb-0 text-uppercase">Edit JSR Content #{{ $item->id }}</h4>
                        </div>
                        @include('Backend.jsr.partials.form', ['action' => route('jsr.update', $item->id), 'method' => 'PUT', 'item' => $item])
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Delete Forms -->
    @foreach ($jsr as $item)
        <form id="delete-form-{{ $item->id }}" action="{{ route('jsr.destroy', $item->id) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        // Toggle Create Form
        function toggleCreateForm() {
            let content = document.getElementById("createFormContent");
            let button = document.getElementById("toggleCreateButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.innerHTML = '<i class="bi bi-x-circle"></i> Close Form';
                button.classList.remove('smart-btn-dark');
                button.classList.add('smart-btn-danger');
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add New JSR';
                button.classList.remove('smart-btn-danger');
                button.classList.add('smart-btn-dark');
            }
        }

        // DataTable Initialization
        $(document).ready(function() {
            $("#jsrTable").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                searching: true
            });
        });

        // Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This JSR record will be permanently deleted. This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3a5e",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "<i class='bi bi-trash'></i> Yes, delete it!",
                cancelButtonText: "<i class='bi bi-x-circle'></i> Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + id).submit();
                }
            });
        }

        // Program Categories Management
        let categoryCount = {{ isset($item) && $item->program_categories ? count($item->program_categories) : 0 }};
        let programCounts = {};
document.querySelectorAll('.program-category-block').forEach((block, catIndex) => {
    const existingPrograms = block.querySelectorAll('.program-item').length;
    programCounts[catIndex] = existingPrograms;
});
        // Add Program Category
        function addProgramCategory() {
            const container = document.getElementById('program-categories-container');
            const newCategory = `
                <div class="program-category-block mb-4 p-4 border rounded bg-white position-relative">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" 
                            onclick="removeItem(this)" style="z-index: 10;">
                        <i class="bi bi-x"></i> Remove Category
                    </button>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Category Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-bookmark"></i></span>
                            <input type="text" class="form-control category-name" 
                                   name="program_categories[${categoryCount}][category_name]" 
                                   placeholder="Enter category name (e.g., Engineering Programs)">
                        </div>
                    </div>

                    <div class="programs-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label fw-medium mb-0">Programs</label>
                            <button type="button" class="btn btn-sm btn-info" 
                                    onclick="addProgram(this, ${categoryCount})">
                                <i class="bi bi-plus"></i> Add Program
                            </button>
                        </div>
                        <div class="programs-container"></div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newCategory);
            programCounts[categoryCount] = 0;
            categoryCount++;
        }

        // Add Program to Category
        function addProgram(button, catIndex) {
            const categoryBlock = button.closest('.program-category-block');
            const programsContainer = categoryBlock.querySelector('.programs-container');
            
            if (!programCounts[catIndex]) {
                programCounts[catIndex] = 0;
            }
            
            const progIndex = programCounts[catIndex];
            
            const newProgram = `
                <div class="program-item dynamic-item mb-3 p-3 border rounded">
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" 
                            onclick="removeItem(this)">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Program Title</label>
                            <input type="text" class="form-control" 
                                   name="program_categories[${catIndex}][programs][${progIndex}][title]" 
                                   placeholder="Enter program title">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Program Icon</label>
                            <input type="file" class="form-control" 
                                   name="program_categories[${catIndex}][programs][${progIndex}][icon]" 
                                   accept="image/*">
                        </div>
                    </div>
                </div>
            `;
            
            programsContainer.insertAdjacentHTML('beforeend', newProgram);
            programCounts[catIndex]++;
        }

        // Add Dark Text Item
        function addDarkTextItem() {
            const container = document.getElementById('dark-text-container');
            const newItem = `
                <div class="dynamic-item mb-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-type"></i></span>
                        <input type="text" class="form-control" name="dark_text[]" placeholder="Enter dark text">
                        <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Add Light Text Item
        function addLightTextItem() {
            const container = document.getElementById('light-text-container');
            const newItem = `
                <div class="dynamic-item mb-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-type"></i></span>
                        <input type="text" class="form-control" name="light_text[]" placeholder="Enter light text">
                        <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Add Testimonial Item
        function addTestimonialItem() {
            const container = document.getElementById('testimonial-container');
            const testimonialCount = container.querySelectorAll('.testimonial-item').length;
            
            const newItem = `
                <div class="dynamic-item testimonial-item mb-3 p-3 border rounded bg-white">
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" 
                            onclick="removeItem(this)">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" 
                                       name="testimoniol[${testimonialCount}][name]" 
                                       placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Stars Rating (1-5)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star-fill"></i></span>
                                <select class="form-select" name="testimoniol[${testimonialCount}][stars]">
                                    <option value="1">⭐ 1 Star</option>
                                    <option value="2">⭐⭐ 2 Stars</option>
                                    <option value="3">⭐⭐⭐ 3 Stars</option>
                                    <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                                    <option value="5" selected>⭐⭐⭐⭐⭐ 5 Stars</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-medium">Message / Message</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                              <textarea class="form-control"
    name="testimoniol[${testimonialCount}][description]"
    rows="3"
    placeholder="Enter testimonial description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Add Banner Item
        let bannerCount = {{ isset($item) && $item->banner ? count($item->banner) : 0 }};
        function addBannerItem() {
            bannerCount++;
            const container = document.getElementById('banner-container');
            const newItem = `
                <div class="dynamic-item banner-item mb-3">
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" onclick="removeItem(this)">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-medium">Banner Type</label>
                            <select class="form-select" name="banner[${bannerCount}][type]">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-medium">Banner File</label>
                            <input class="form-control" type="file" name="banner[${bannerCount}][file]" accept="image/*,video/*">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Add Highlight Item
        let highlightCount = {{ isset($item) && $item->our_highlights_items ? count($item->our_highlights_items) : 0 }};
        function addHighlightItem() {
            highlightCount++;
            const container = document.getElementById('highlights-container');
            const newItem = `
                <div class="dynamic-item highlight-item mb-3">
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" onclick="removeItem(this)">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" name="our_highlights_items[${highlightCount}][image]" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="our_highlights_items[${highlightCount}][title]" placeholder="Enter title">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="our_highlights_items[${highlightCount}][description]" rows="2" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Remove Dynamic Item
        function removeItem(button) {
            button.closest('.dynamic-item').remove();
        }

        // Form Validation
        document.addEventListener("DOMContentLoaded", function() {
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

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
        });

        // Success Message
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection 