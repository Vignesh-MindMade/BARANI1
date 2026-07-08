@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
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

    <style>
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
                            <h2 class="mb-0 text-uppercase">PRODUCT CATGORY</h2>
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
                                <li class="breadcrumb-item active" aria-current="page">PRODUCT CATGORY </li>
                            </ol>
                        </nav>
                    </div>

                </div>

            </div>

            <!-- Heading Management Section -->
            <div class="page-box animate-fade-in">
                <div class="section-header">
                    <i class="bi bi-bookmark-star-fill fs-4"></i>
                    <h4 class="mb-0 text-uppercase">Catagory Management</h4>
                </div>
                
                     <div class="row">

                 <div class = "col-md-6"> 
                <div class="section-header">
                    <i class="bi bi-bookmark-star-fill fs-4"></i>
                    <h4 class="mb-0 text-uppercase"><a href="{{ route('productarchives.index') }}" class="btn btn-primary">Product Archive</a></h4>
                </div>
               </div> 
               
               <div class = "col-md-6"> 
                <div class="section-header">
                    <i class="bi bi-bookmark-star-fill fs-4"></i>
                    <h4 class="mb-0 text-uppercase"><a href="{{ route('viewindex.index') }}" class="btn btn-primary">Product Page</a></h4>
                </div>
               </div>
               
            </div> 
                
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-box animate-fade-in">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="bi bi-collection-fill me-2"></i> catagory</h5>
                                <button id="toggleButton" class="smart-btn smart-btn-dark" onclick="toggleContent()">
                                    <i class="bi bi-plus-circle"></i> Add 
                                </button>
                            </div>

                            <!-- Add Facility Form (Hidden by default) -->
                            <div id="videoContent" style="display: none;" class="animate-fade-in">
                                <div class="form-section mt-3 mb-4">
                                    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i>Add catagory</h5>
                                    <form action="{{ route('product_catagory.store') }}" method="POST"
                                        enctype="multipart/form-data" id="addFacilityForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="Catgory" class="form-label fw-medium">catagory<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-type"></i></span>
                                                    <input class="form-control" type="text" id="catagory"
                                                        name="catagory" placeholder="Enter catagory" required />
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
                                            <th><i class="bi bi-type me-1"></i>Catagory</th>
                                      
                                            <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($catagorys as $key => $video)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <strong>{{ $video->catagory }}</strong>
                                                    <div class="text-muted small mt-1">Order:
                                                        #{{ $video->sort_id ?? 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div class="action-btns">
                                                        <button type="button"
                                                            class="smart-btn smart-btn-primary edit-btn-detail"
                                                            data-id="{{ $video->id }}"
                                                            data-catagory="{{ $video->catagory }}"
                                                            data-order_id="{{ $video->sort_id }}"
                                                            data-action="{{ route('product_catagory.update', $video->id) }}"
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
                                    <label for="editcatagory" class="form-label fw-medium">Catagory<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-type"></i></span>
                                        <input class="form-control" type="text" id="editcatagory" name="catagory"
                                            placeholder="Enter catagory" required />
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
        @foreach ($catagorys as $video)
            <form id="delete-form-{{ $video->id }}" action="{{ route('product_catagory.delete', $video->id) }}"
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
                        const catagory = this.getAttribute("data-catagory");
                        const sort_id = this.getAttribute("data-order_id");
                        const actionUrl = this.getAttribute("data-action");

                        document.getElementById("editFormDetailsPAge").setAttribute("action",
                            actionUrl);

                        // Populate form fields
                        document.getElementById("editcatagory").value = catagory;
                        document.getElementById("editSortId").value = sort_id;

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
