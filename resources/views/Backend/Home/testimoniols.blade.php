@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        /* Enhanced UI Styles */
        .page-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
        }

        .section-header {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 10px;
            color: #3a86ff;
        }

        .smart-btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .smart-btn i {
            margin-right: 8px;
        }

        .smart-btn-primary {
            background: #3a86ff;
            color: white;
            border: none;
        }

        .smart-btn-primary:hover {
            background: #2878f0;
            transform: translateY(-2px);
        }

        .smart-btn-danger {
            background: #ff3a5e;
            color: white;
            border: none;
        }

        .smart-btn-danger:hover {
            background: #e62e50;
            transform: translateY(-2px);
        }

        .smart-btn-dark {
            background: #343a40;
            color: white;
            border: none;
        }

        .smart-btn-dark:hover {
            background: #23272b;
            transform: translateY(-2px);
        }

        .smart-btn-success {
            background: #10b981;
            color: white;
            border: none;
        }

        .smart-btn-success:hover {
            background: #0ea271;
            transform: translateY(-2px);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: #343a40;
            color: white;
            font-weight: 500;
            border: none;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(58, 134, 255, 0.05);
        }

        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
        }

        .form-control:focus {
            border-color: #3a86ff;
            box-shadow: 0 0 0 0.2rem rgba(58, 134, 255, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 5px;
            color: #3a86ff;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-title {
            font-weight: 600;
        }

        .w-50-p {
            width: 48%;
            display: inline-block;
            margin-right: 2%;
        }

        .action-btns {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .img-thumbnail-container {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 5px;
            text-align: center;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* New styles for modern UI */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-field {
            margin-bottom: 20px;
        }

        .form-field-title {
            display: flex;
            align-items: center;
            font-weight: 500;
            margin-bottom: 10px;
            color: #333;
        }

        .form-field-title i {
            margin-right: 8px;
            color: #3a86ff;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .required-asterisk {
            color: #ff3a5e;
            margin-left: 2px;
        }

        .upload-zone {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-zone:hover {
            border-color: #3a86ff;
            background-color: #f1f5ff;
        }

        .upload-icon {
            font-size: 2rem;
            color: #3a86ff;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
            <div class="page-box page-content">
                <!-- Header Section -->
                <div class="banner-manager-container py-4 px-4">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <h3 class="page-title mb-0">
                                    <i class="fa fa-quote-left text-primary me-2"></i>Testimonials
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-md-end mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('testCurricular.index')}}" class="text-decoration-none">
                                            <i class="fas fa-home me-1"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr>
        
                    <div class="section-divider"></div>

            <!-- Main Content Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button id="toggleButton" class="smart-btn smart-btn-primary" onclick="toggleContent()">
                                <i class="bi bi-plus-circle"></i> Testimonials
                            </button>
                        </div>

          
                        <div id="videoContent" style="display: none;">
                            <div class="form-container">
                                <form action="{{ route('Homepagetestimonial.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-type"></i>Name <span class="required-asterisk">*</span>
                                            </div>
                                            <input class="form-control" type="text" id="name" name="name"
                                                placeholder="Enter name" required />
                                        </div>
                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-type"></i>Relationship <span class="required-asterisk">*</span>
                                            </div>
                                            <input class="form-control" type="text" id="relationship" name="relationship"
                                                placeholder="Enter relationship" required />
                                        </div>

                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-sort-numeric-down"></i> Order ID
                                            </div>
                                            <input class="form-control" type="number" id="sort_id" name="sort_id"
                                                placeholder="Enter Order ID" />
                                        </div>

                                        <div class="col-md-12 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-justify"></i> Feedback <span
                                                    class="required-asterisk">*</span>
                                            </div>
                                            <textarea class="form-control" id="feedback" name="feedback" placeholder="Enter feedback"
                                                style="height: 120px;"></textarea>
                                        </div>

                                        <div class="col-md-12 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-image"></i> Image <span
                                                    class="required-asterisk">*</span>
                                            </div>
                                            <div class="upload-zone" onclick="document.getElementById('image').click()">
                                                <div class="upload-icon">
                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                </div>
                                                <p>Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                <input type="file" id="image" name="image" accept="image/webp"
                                                    required style="display: none;" />
                                            </div>
                                            <img id="imagePreview" src="" alt="Image Preview" class="mt-2 d-none"
                                                style="max-width: 200px; max-height: 200px;" />
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-actions">
                                                <button type="button" class="smart-btn smart-btn-danger"
                                                    onclick="toggleContent()">
                                                    <i class="bi bi-x-circle"></i> Cancel
                                                </button>
                                                <button type="submit" class="smart-btn smart-btn-success">
                                                    <i class="bi bi-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- List of Amenities Table -->
                        <div class="table-responsive">
                            <table id="Latestvidesoass" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="70"><i class="bi bi-hash me-1"></i>S.No</th>
                                        <th><i class="bi bi-type me-1"></i>Name</th>
                                        <th class="text-center" width="220"><i class="bi bi-image me-1"></i>Relationship</th>
                                        <th class="text-center" width="220"><i class="bi bi-image me-1"></i>Image</th>
                                        <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($HomepageTestimoniols as $key => $video)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ $video->name }}</strong>
                                              
                                            </td>
                                            <td>
                                                <strong>{{ $video->relationship }}</strong>
                                              
                                            </td>
                                            <td class="text-center">
                                                @if ($video->image)
                                                    <div class="img-thumbnail-container">
                                                        <img src="{{ asset('images/' . $video->image) }}" alt="Thumbnail"
                                                            class="img-fluid" style="max-height: 80px;" />
                                                    </div>
                                                @else
                                                    <span class="badge bg-secondary"><i
                                                            class="bi bi-exclamation-triangle me-1"></i>No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <button type="button"
                                                        class="smart-btn smart-btn-primary edit-btn-detail"
                                                        data-id="{{ $video->id }}" data-name="{{ $video->name }}"
                                                        data-sort_id="{{ $video->sort_id }}"
                                                        data-image="{{ $video->image }}"
                                                        data-relationship="{{ $video->relationship }}"
                                                        data-feedback="{{ $video->feedback }}"
                                                        data-action="{{ route('Homepagetestimonial.update', $video->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#editModalDetailpageeee">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>

                                                    <form id="delete-form-{{ $video->id }}" action="{{ route('Homepagetestimonial.destroy', $video->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" class="smart-btn smart-btn-danger"
                                                        onclick="confirmDelete({{ $video->id }})">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

    <!-- Edit Amenity Modal -->
    <div class="modal fade" id="editModalDetailpageeee" tabindex="-1" aria-labelledby="editAmenityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAmenityModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit
                        Amenity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFormDetailsPAge" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-type"></i> Name <span class="required-asterisk">*</span>
                                </div>
                                <input class="form-control" type="text" id="editname" name="name"
                                    placeholder="Enter name" required />
                            </div>

                            <div class="col-md-6 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-sort-numeric-down"></i> Order ID
                                </div>
                                <input class="form-control" type="number" id="editSortId" name="sort_id"
                                    placeholder="Enter Order ID" />
                            </div>

                            <div class="col-md-12 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-justify"></i>Relationship <span class="required-asterisk">*</span>
                                </div>
                                <textarea class="form-control" id="editrelationship" name="relationship" placeholder="relationship"
                                    style="height: 120px;" required></textarea>
                            </div>

                            <div class="col-md-12 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-justify"></i> Feedback <span class="required-asterisk">*</span>
                                </div>
                                <textarea class="form-control" id="editfeedback" name="feedback" placeholder="feedback"
                                    style="height: 120px;" required></textarea>
                            </div>

                            <div class="col-md-12 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-image"></i> Thumbnail Image
                                </div>
                                <div class="upload-zone" onclick="document.getElementById('editImage').click()">
                                    <div class="upload-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                    <p>Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                    <input type="file" id="editImage" name="image" accept="image/webp"
                                        style="display: none;" />
                                </div>

                                <!-- Display current image -->
                                <div class="mt-3" id="currentImageContainer" style="display: none;">
                                    <div class="form-field-title">
                                        <i class="bi bi-image"></i> Current Image
                                    </div>
                                    <div class="img-thumbnail-container">
                                        <img id="currentImagePreview" src="" alt="Current Image"
                                            class="img-fluid" style="max-height: 150px;" />
                                    </div>
                                </div>

                                <!-- New Image Preview -->
                                <div class="mt-3" id="newImageContainer" style="display: none;">
                                    <div class="form-field-title">
                                        <i class="bi bi-image"></i> New Image Preview
                                    </div>
                                    <div class="img-thumbnail-container">
                                        <img id="newImagePreview" src="" alt="New Image Preview"
                                            class="img-fluid" style="max-height: 150px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mt-3">
                            <button type="button" class="smart-btn smart-btn-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cancel
                            </button>
                            <button type="submit" class="smart-btn smart-btn-success">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Delete Forms (Hidden) -->
    @foreach ($HomepageTestimoniols as $video)
        <form id="delete-form-{{ $video->id }}" action="{{ route('Homepagetestimonial.destroy', $video->id) }}"
            method="POST" style="display: none;">
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
        // DataTable Initialization
        $(document).ready(function() {
            $("#Latestvidesoass").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                searching: true,
                language: {
                    search: "<i class='bi bi-search'></i> Search:",
                    lengthMenu: "<i class='bi bi-list'></i> _MENU_ records",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "<i class='bi bi-chevron-double-left'></i>",
                        last: "<i class='bi bi-chevron-double-right'></i>",
                        next: "<i class='bi bi-chevron-right'></i>",
                        previous: "<i class='bi bi-chevron-left'></i>"
                    }
                }
            });
        });

        // Toggle Add Amenities Form
        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Amenities';
                button.classList.add('smart-btn-primary');
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Amenities';
                button.classList.add('smart-btn-primary');
            }
        }

        // Show image preview when selecting a file
        document.addEventListener("DOMContentLoaded", function() {
            // For add form
            document.getElementById("image").addEventListener("change", function(event) {
                handleFileSelection(event, "imagePreview");
            });

            // For edit form
            document.getElementById("editImage").addEventListener("change", function(event) {
                handleFileSelection(event, "newImagePreview", "newImageContainer");
            });

            // Handle file upload zone visual feedback
            const uploadZones = document.querySelectorAll(".upload-zone");
            uploadZones.forEach(zone => {
                zone.addEventListener("dragover", function(e) {
                    e.preventDefault();
                    this.style.borderColor = "#3a86ff";
                    this.style.backgroundColor = "#f1f5ff";
                });

                zone.addEventListener("dragleave", function(e) {
                    e.preventDefault();
                    this.style.borderColor = "#ddd";
                    this.style.backgroundColor = "#f8f9fa";
                });

                zone.addEventListener("drop", function(e) {
                    e.preventDefault();
                    this.style.borderColor = "#ddd";
                    this.style.backgroundColor = "#f8f9fa";

                    // Trigger file input change
                    const fileInput = this.querySelector('input[type="file"]');
                    if (fileInput && e.dataTransfer.files.length > 0) {
                        fileInput.files = e.dataTransfer.files;
                        const event = new Event('change', {
                            bubbles: true
                        });
                        fileInput.dispatchEvent(event);
                    }
                });
            });
        });

        // Handle file selection and preview
        function handleFileSelection(event, previewId, containerId = null) {
            const file = event.target.files[0];
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            const allowedType = "image/webp";
            const preview = document.getElementById(previewId);

            if (file) {
                // Check file type
                if (file.type !== allowedType) {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid File Format!",
                        text: "Please upload only .webp images.",
                    });
                    event.target.value = ""; // Clear the file input
                    if (containerId) {
                        document.getElementById(containerId).style.display = "none";
                    } else {
                        preview.classList.add("d-none");
                    }
                    return;
                }

                // Check file size
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: "error",
                        title: "File too large!",
                        text: "Please upload an image smaller than 5MB.",
                    });
                    event.target.value = ""; // Clear the file input
                    if (containerId) {
                        document.getElementById(containerId).style.display = "none";
                    } else {
                        preview.classList.add("d-none");
                    }
                    return;
                }

                // Show image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    if (containerId) {
                        document.getElementById(containerId).style.display = "block";
                    } else {
                        preview.classList.remove("d-none");
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3a5e",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "<i class='bi bi-trash'></i> Yes, delete it!",
                cancelButtonText: "<i class='bi bi-x-circle'></i> Cancel",
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + id).submit();
                }
            });
        }

        // Edit Video Button Handler
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".edit-btn-detail");

            editButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const name = this.getAttribute("data-name");
                    const sort_id = this.getAttribute("data-sort_id");
                    const image = this.getAttribute("data-image");
                    const relationship = this.getAttribute("data-relationship");
                    const feedback = this.getAttribute("data-feedback");
                    const actionUrl = this.getAttribute("data-action");

                    document.getElementById("editFormDetailsPAge").setAttribute("action",
                    actionUrl);

                    // Populate form fields
                    document.getElementById("editname").value = name;
                    document.getElementById("editrelationship").value = relationship;
                    document.getElementById("editfeedback").value = feedback;
                    document.getElementById("editSortId").value = sort_id;

                    // Handle image display
                    if (image) {
                        const imagePath = "{{ asset('images/') }}/" + image;
                        document.getElementById("currentImagePreview").src = imagePath;
                        document.getElementById("currentImageContainer").style.display = "block";
                    } else {
                        document.getElementById("currentImageContainer").style.display = "none";
                    }

                    // Hide the new image preview initially
                    document.getElementById("newImageContainer").style.display = "none";
                });
            });
        });

        // Success Alert
        @if (session('success'))
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });
        @endif
    </script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
