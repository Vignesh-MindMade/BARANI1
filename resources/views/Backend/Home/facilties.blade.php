@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
 <link rel="stylesheet"href="{{ asset('assets/css/custome_backend/dashboard.css') }}"/> 
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
              <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                    <div class="page-header">
                        
                            <h2 class="text-center"> About Page
                                Management</h2>
                    
                   
                    <div class="col-md-8    ">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('subpage.view') }}" class="text-decoration-none"> <i
                                            class="fas fa-home me-1"></i> Dashboard </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">About Page Management</li>
                            </ol>
                        </nav>
                         </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

            <!-- Heading Management Section -->
            <div class="page-box animate-fade-in">
                <div class="section-header">
                   
                    <h4 class="mb-0 text-uppercase"> <i class="bi bi-bookmark-star-fill fs-4"></i>Heading Management</h4>
                </div>

                @foreach ($heading as $head)
                    <form method="POST" action="{{ route('aboutus.update', $head->id) }}" enctype="multipart/form-data"
                        class="needs-validation mb-5 p-4 border rounded shadow-sm bg-light" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Banner Image -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Banner Image</label>
                            <input class="form-control" type="file" name="banner_image" accept="image/*">
                            @if ($head->banner_image)
                                <img src="{{ asset('images/' . $head->banner_image) }}" width="120"
                                    class="mt-2 rounded shadow-sm">
                            @endif
                        </div>

                        <!-- About Us Description -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">About Us Description</label>
                            <textarea class="form-control" name="aboutus_description" rows="3">{{ $head->aboutus_description }}</textarea>
                        </div>

                        <!-- About Us Image 1 -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">About Us Image 1</label>
                            <input class="form-control" type="file" name="aboutus_image_1" accept="image/*">
                            @if ($head->aboutus_image_1)
                                <img src="{{ asset('images/' . $head->aboutus_image_1) }}" width="120"
                                    class="mt-2 rounded shadow-sm">
                            @endif
                        </div>

                        <!-- About Us Image 2 -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">About Us Image 2</label>
                            <input class="form-control" type="file" name="aboutus_image_2" accept="image/*">
                            @if ($head->aboutus_image_2)
                                <img src="{{ asset('images/' . $head->aboutus_image_2) }}" width="120"
                                    class="mt-2 rounded shadow-sm">
                            @endif
                        </div>

                        <!-- Mission Description -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Mission Description</label>
                            <textarea class="form-control" name="mission_description" rows="3">{{ $head->mission_description }}</textarea>
                        </div>

                        <!-- Vision Description -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Vision Description</label>
                            <textarea class="form-control" name="vission_description" rows="3">{{ $head->vission_description }}</textarea>
                        </div>
                            <!-- history Description -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">History Description</label>
                            <textarea class="form-control" name="history_description" rows="3">{{ $head->history_description }}</textarea>
                        </div>
                        <!-- Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                    <hr>
                @endforeach

                <!-- Our Facilities Section -->
                <div class="section-header mt-4">
                    <i class="bi bi-building-fill-gear"></i>
                    <h2 class="mb-0 text-uppercase">Our History List</h2>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-box animate-fade-in">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="bi bi-collection-fill me-2"></i>Our History</h5>
                                <button id="toggleButton" class="smart-btn smart-btn-dark" onclick="toggleContent()">
                                    <i class="bi bi-plus-circle"></i> Add History
                                </button>
                            </div>

                            <!-- Add Facility Form (Hidden by default) -->
                            <div id="videoContent" style="display: none;" class="animate-fade-in">
                                <div class="form-section mt-3 mb-4">
                                    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i>Add New History</h5>
                                    <form action="{{ route('facilties.store') }}" method="POST"
                                        enctype="multipart/form-data" id="addFacilityForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="title" class="form-label fw-medium">Year<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-type"></i></span>
                                                    <input class="form-control" type="text" id="title"
                                                        name="title" placeholder="Enter Year" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="image2" class="form-label fw-medium">Thumbnail Image <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                    <input class="form-control" type="file" id="image2"
                                                        name="image2" accept="image/webp" required />
                                                </div>
                                                <small class="text-muted">Please upload .webp images only (max 5MB)</small>
                                                <img id="imagePreview" src="" alt="Image Preview"
                                                    class="mt-2 d-none" style="max-width: 200px; max-height: 200px;" />
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="description" class="form-label fw-medium">Description<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-justify"></i></span>
                                                    <textarea class="form-control" id="description" name="description" placeholder="Description" style="height: 120px;"
                                                        required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="sort_id" class="form-label fw-medium">Order ID</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-sort-numeric-down"></i></span>
                                                    <input class="form-control" type="number" id="sort_id"
                                                        name="sort_id" placeholder="Enter Order ID" />
                                                </div>
                                                <small class="text-muted">Set display order (lower numbers appear
                                                    first)</small>
                                            </div>

                                            <div class="col-md-12 text-center mt-2">
                                                <button type="submit" class="smart-btn smart-btn-primary px-4">
                                                    <i class="bi bi-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Facilities Table -->
                            <div class="table-responsive">
                                <table id="Latestvidesoass" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="70"><i class="bi bi-hash me-1"></i>S.No</th>
                                            <th><i class="bi bi-type me-1"></i>Title</th>
                                            <th class="text-center" width="220"><i
                                                    class="bi bi-image me-1"></i>Thumbnail</th>
                                            <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Facilties as $key => $video)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <strong>{{ $video->title }}</strong>
                                                    <div class="text-muted small mt-1">Order:
                                                        #{{ $video->sort_id ?? 'N/A' }}</div>
                                                    <div class="text-truncate small mt-1" style="max-width: 350px;">
                                                        {{ $video->description }}</div>
                                                </td>
                                                <td class="text-center">
                                                    @if ($video->image2)
                                                        <div class="img-thumbnail-container">
                                                            <img src="{{ asset('images/' . $video->image2) }}"
                                                                alt="Thumbnail" class="img-fluid"
                                                                style="max-height: 80px;" />
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
                                                            data-id="{{ $video->id }}"
                                                            data-title="{{ $video->title }}"
                                                            data-link2="{{ $video->link2 }}"
                                                            data-sort_id="{{ $video->sort_id }}"
                                                            data-image2="{{ $video->image2 }}"
                                                            data-description="{{ $video->description }}"
                                                            data-action="{{ route('facilties.update', $video->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModalDetailpageeee">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>

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

                <div class="d-flex justify-content-start gap-3 mt-4">
                    <a href="{{ route('view_awards.index') }}" class="btn btn-primary btn-lg px-4 py-2 text-white text-decoration-none shadow-sm hover-shadow-lg transition-all">
                        <i class="fas fa-trophy me-2"></i>View Awards
                    </a>
                    <a href="{{ route('curriculam.index') }}" class="btn btn-primary btn-lg px-4 py-2 text-white text-decoration-none shadow-sm hover-shadow-lg transition-all">
                        <i class="fas fa-shield-alt me-2"></i>Quality Assurance
                    </a>
                    <a href="{{ route('team.testindex') }}" class="btn btn-primary btn-lg px-4 py-2 text-white text-decoration-none shadow-sm hover-shadow-lg transition-all">
                        <i class="fas fa-users me-2"></i>Team
                    </a>
                     <a href="{{ route('view_certficate_title.index') }}" class="btn btn-primary btn-lg px-4 py-2 text-white text-decoration-none shadow-sm hover-shadow-lg transition-all">
                        <i class="fas fa-users me-2"></i>Certificate
                    </a>
                    
                </div>

                <style>
                .hover-shadow-lg {
                    transition: all 0.3s ease-in-out;
                }
                .hover-shadow-lg:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3) !important;
                }
                .transition-all {
                    transition: all 0.3s ease-in-out;
                }
                </style>

        </div>

        <div class="modal fade" id="editModalDetailpageeee" tabindex="-1" aria-labelledby="editVideoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editVideoModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit
                            History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editFormDetailsPAge" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="editTitle" class="form-label fw-medium">Year<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-type"></i></span>
                                        <input class="form-control" type="text" id="editTitle" name="title"
                                            placeholder="Enter Title" required />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editSortId" class="form-label fw-medium">Order ID</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-sort-numeric-down"></i></span>
                                        <input class="form-control" type="number" id="editSortId" name="sort_id"
                                            placeholder="Enter Order ID" />
                                    </div>
                                    <small class="text-muted">Set display order (lower numbers appear first)</small>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="editDescription" class="form-label fw-medium">Description<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-justify"></i></span>
                                        <textarea class="form-control" id="editDescription" name="description" placeholder="Description"
                                            style="height: 120px;" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="editImage2" class="form-label fw-medium">Thumbnail Image</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                        <input class="form-control" type="file" id="editImage2" name="image2"
                                            accept="image/webp" aria-label="Image" />
                                    </div>
                                    <small class="text-muted">Please upload .webp images only (max 5MB)</small>

                                    <!-- Display current image -->
                                    <div class="mt-3" id="currentImageContainer" style="display: none;">
                                        <label class="form-label"><i class="bi bi-image me-1"></i>Current Image</label>
                                        <div class="img-thumbnail-container">
                                            <img id="currentImagePreview" src="" alt="Current Image"
                                                class="img-fluid" style="max-height: 150px;" />
                                        </div>
                                    </div>

                                    <!-- New Image Preview -->
                                    <div class="mt-3" id="newImageContainer" style="display: none;">
                                        <label class="form-label"><i class="bi bi-image me-1"></i>New Image
                                            Preview</label>
                                        <div class="img-thumbnail-container">
                                            <img id="newImagePreview" src="" alt="New Image Preview"
                                                class="img-fluid" style="max-height: 150px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="button" class="smart-btn smart-btn-danger me-2" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </button>
                                <button type="submit" class="smart-btn smart-btn-primary">
                                    <i class="bi bi-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($Facilties as $video)
            <form id="delete-form-{{ $video->id }}" action="{{ route('facilties.destroy', $video->id) }}"
                method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach

        <hr>

    @endsection

    <script>
        function confirmDelete(videoId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform delete action
                    window.location.href = "/delete-video/" + videoId; // Update this URL as needed
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

        <script>
            // DataTable Initialization with Improved Configuration
            $(document).ready(function() {
                $("#Latestvidesoass").DataTable({
                    paging: true,
                    lengthMenu: [5, 10, 25, 50],
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
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
                        // Add custom styling to the DataTable
                        $('.dataTables_filter input').addClass('form-control form-control-sm');
                        $('.dataTables_length select').addClass('form-select form-select-sm');
                    }
                });
            });

            // Toggle Add Facility Form with Improved Animation
            function toggleContent() {
                let content = document.getElementById("videoContent");
                let button = document.getElementById("toggleButton");

                if (content.style.display === "none" || content.style.display === "") {
                    content.style.display = "block";
                    button.innerHTML = '<i class="bi bi-x-circle"></i> Close Form';
                    button.classList.remove('smart-btn-dark');
                    button.classList.add('smart-btn-danger');
                    // Add animation
                    content.classList.add('animate-fade-in');
                } else {
                    content.style.display = "none";
                    button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Facility';
                    button.classList.remove('smart-btn-danger');
                    button.classList.add('smart-btn-dark');
                }
            }

            // Enhanced Delete Confirmation
            function confirmDelete(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This facility will be permanently deleted. This action cannot be undone!",
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
                        document.getElementById("delete-form-" + id).submit();

                        // Show loading state
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

            // Edit Heading Button Handler
            document.addEventListener("DOMContentLoaded", function() {
                const editButtons = document.querySelectorAll(".edit-btn");

                editButtons.forEach((button) => {
                    button.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");
                        const heading = this.getAttribute("data-heading");
                        const actionUrl = this.getAttribute("data-action");

                        document.getElementById("editForm").setAttribute("action", actionUrl);
                        document.getElementById("edit_heading").value = heading;
                    });
                });
            });

            // Edit Facility Button Handler with Improved Image Handling
            document.addEventListener("DOMContentLoaded", function() {
                const editButtons = document.querySelectorAll(".edit-btn-detail");

                editButtons.forEach((button) => {
                    button.addEventListener("click", function() {
                        const title = this.getAttribute("data-title");
                        const sort_id = this.getAttribute("data-sort_id");
                        const image2 = this.getAttribute("data-image2");
                        const description = this.getAttribute("data-description");
                        const actionUrl = this.getAttribute("data-action");

                        document.getElementById("editFormDetailsPAge").setAttribute("action",
                        actionUrl);

                        // Populate form fields
                        document.getElementById("editTitle").value = title;
                        document.getElementById("editDescription").value = description;
                        document.getElementById("editSortId").value = sort_id;

                        // Reset image preview fields
                        document.getElementById("editImage2").value = "";
                        document.getElementById("newImageContainer").style.display = "none";

                        // Handle image display
                        if (image2) {
                            const imagePath = "{{ asset('images') }}/" + image2;
                            document.getElementById("currentImagePreview").src = imagePath;
                            document.getElementById("currentImageContainer").style.display = "block";
                        } else {
                            document.getElementById("currentImageContainer").style.display = "none";
                        }
                    });
                });
            });

            // Enhanced Form Validation
            document.addEventListener("DOMContentLoaded", function() {
                const forms = document.querySelectorAll('.needs-validation');

                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();

                            // Highlight the first invalid field
                            const invalidFields = form.querySelectorAll(':invalid');
                            if (invalidFields.length > 0) {
                                invalidFields[0].focus();
                            }

                            // Show toast notification
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
        </script>
