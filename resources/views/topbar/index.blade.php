@extends('layouts.app')

@section('style')
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

    <style>
        .page-content {
            min-height: 100vh;
            padding: 40px 20px;
        }
        .page-header {
            background: #1e3556;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        .page-header h2 {
           background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0 0 20px 0;
            justify-content: center;
        }
        .breadcrumb-item {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .breadcrumb-item a:hover {
            color: white;
        }
        .breadcrumb-item.active {
            color: white;
            font-weight: 500;
        }
        .page-box {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }
        #example {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        #example thead th {
            background: #1e3556;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 15px;
            border: none;
            font-size: 0.9rem;
        }
        #example tbody tr {
            transition: all 0.3s ease;
            background: white;
        }
        #example tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }
        #example tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.95rem;
            color: #333;
        }
        #example tbody tr:last-child td {
            border-bottom: none;
        }
        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 25px;
             background: #1e3556;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }
        .view-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            color: white;
            text-decoration: none;
        }
        .view-btn i {
            font-size: 0.85rem;
        }
        .delete-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 25px;
            background: #dc3545;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        .delete-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.5);
            color: white;
            text-decoration: none;
        }
        .serial-number {
            width: 60px;
            height: 60px;
           background: #1e3556;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .page-name {
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #5670e3;
            font-size: 1.2rem;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 15px;
            transition: all 0.3s ease;
        }
        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-color: transparent !important;
            color: white !important;
            border-radius: 8px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important;
            border-color: transparent !important;
            color: #667eea !important;
        }
        .dataTables_wrapper .dataTables_info {
            color: #64748b;
            font-weight: 500;
        }
        .toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 30px;
            background: #28a745;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            font-size: 1rem;
            border: none;
            cursor: pointer;
            margin: 20px 0;
        }
        .toggle-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
            color: white;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .save-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 30px;
            background: #28a745;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            font-size: 1rem;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .save-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
            color: white;
        }
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }
        .modal-header {
            background: #1e3556;
            color: white;
            border-radius: 20px 20px 0 0;
            border-bottom: none;
        }
        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .modal-body {
            padding: 30px;
        }
        @media (max-width: 768px) {
            .page-header h2 {
                font-size: 1.8rem;
            }
            .page-box {
                padding: 20px;
            }
            .serial-number {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
            .page-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            .breadcrumb {
                font-size: 0.9rem;
            }
            .form-control {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header text-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Download Page</li>
                                </ol>
                            </nav>
                            <h2>
                                <i class="fas fa-download" style="font-size: 80%;"></i> Download Page
                            </h2>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-12">
                        <div class="page-box">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">No.</th>
                                            <th>Title</th>
                                            <th style="width: 120px;">Order ID</th>
                                            <th class="text-center" style="width: 250px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topbars as $key => $topbar)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="serial-number">{{ $key + 1 }}</span>
                                                </td>
                                                <td>
                                                    <div class="page-name">
                                                        <span class="page-icon">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </span>
                                                        <span>{{ $topbar->title }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $topbar->sort_id ?? '--' }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="view-btn edit-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $topbar->id }}" data-title="{{ $topbar->title }}"
                                                        data-description="{{ $topbar->description }}"
                                                        data-catagory="{{ $topbar->catagory }}"
                                                        data-updated_on="{{ $topbar->updated_on }}"
                                                        data-pdf="{{ $topbar->pdf }}"
                                                        data-sort-id="{{ $topbar->sort_id }}"
                                                        data-action="{{ route('topbar.update', ['id' => $topbar->id]) }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form id="deleteForm-{{ $topbar->id }}"
                                                        action="{{ route('topbar.delete', $topbar->id) }}"
                                                        method="POST" class="d-inline m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="delete-btn"
                                                            onclick="confirmDeleteTopBar('{{ $topbar->id }}')">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Toggle Button -->
                <div class="row">
                    <div class="col-12 text-center">
                        <button id="toggleButton" class="toggle-btn" onclick="toggleContent()"><i class="fas fa-plus"></i>
                            Add Broucher </button>
                    </div>
                </div>

                <!-- Add New Topbar Section -->
                <div class="row" id="videoContent" style="display: none;">
                    <div class="col-12">
                        <div class="page-box">
                            <form action="{{ route('topbar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Title<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="title" required />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Catagory<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="catagory" required />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Description<span style="color: red;">*</span></label>
                                        <textarea class="form-control" name="description" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Sort ID</label>
                                        <input class="form-control" type="number" name="sort_id" placeholder="Order ID" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Updated On<span style="color: red;">*</span></label>
                                        <input class="form-control" type="date" name="updated_on" required />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Add PDF<span style="color: red;">*</span></label>
                                        <input class="form-control" type="file" name="pdf" required />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Add Catagory (comma-separated) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control tagsinput" name="minimum_age_rules_points"
                                            data-role="tagsinput" required value="{{ old('minimum_age_rules_points') }}">
                                        @error('minimum_age_rules_points')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel" style="color: white;"><i class="fas fa-edit" style="font-size: 21px;"></i> Edit Download</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Edit Form -->
                                <form id="editForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="topbar_id" name="id">

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label class="form-label">Title</label>
                                            <input type="text" id="title" name="title" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="form-label">Catagory</label>
                                            <input type="text" id="catagory" name="catagory" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="form-label">Description</label>
                                            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-label">Updated On</label>
                                            <input type="text" id="updated_on" name="updated_on" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-label">Sort ID</label>
                                            <input type="text" id="sort_id" name="sort_id" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="form-label">Current PDF:</label>
                                            <p id="pdf_old" class="text-muted"></p>
                                            <input type="file" name="pdf" class="form-control">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="save-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $("#example").DataTable({
                "pageLength": 5,
                "language": {
                    "search": "Search downloads:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "previous": "← Previous",
                        "next": "Next →"
                    }
                }
            });
        });
    </script>

    <script>
        function displayImage(event) {
            var image = document.getElementById("previewImage");
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = "block";
        }
    </script>

    <script>
        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.innerHTML = '<i class="fas fa-times"></i> Close';
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="fas fa-plus"></i> Add Broucher';
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".edit-btn");

            editButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const title = this.getAttribute("data-title");
                    const description = this.getAttribute("data-description");
                    const catagory = this.getAttribute("data-catagory");
                    const updatedOn = this.getAttribute("data-updated_on");
                    const pdf = this.getAttribute("data-pdf");
                    const sortId = this.getAttribute("data-sort-id");
                    const actionUrl = this.getAttribute("data-action");

                    // Populate modal form fields
                    document.getElementById("topbar_id").value = id;
                    document.getElementById("title").value = title;
                    document.getElementById("description").value = description;
                    document.getElementById("catagory").value = catagory;
                    document.getElementById("updated_on").value = updatedOn;
                    document.getElementById("pdf_old").textContent = pdf ? pdf : "No file uploaded";
                    document.getElementById("sort_id").value = sortId;

                    // Set the form action dynamically
                    document.getElementById("editForm").action = actionUrl;
                });
            });
        });
    </script>


    <script>
        function confirmDeleteTopBar(topbarId) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm-${topbarId}`).submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>

        <script>
            function toggleContentCareer() {
                const contentDiv = document.getElementById('careerContent');
                contentDiv.style.display = contentDiv.style.display === 'none' ? 'block' : 'none';
            }

            $('.tagsinput').tagsInput({
                width: 'auto',
                delimiter: ',',
                placeholder: 'Add points (comma-separated)',
            });

            // Reinitialize tagsinput every time modal is shown
            $(document).on('shown.bs.modal', function(e) {
                const modal = $(e.target);
                modal.find('.tagsinput').each(function() {
                    if (!$(this).data('tagsinput')) {
                        $(this).tagsInput({
                            width: 'auto',
                            delimiter: ',',
                            placeholder: 'Add points (comma-separated)',
                        });
                    }
                });
            });
        </script>
    @endif
@endsection