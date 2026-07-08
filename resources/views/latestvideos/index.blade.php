@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
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
        .banner-manager-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        .section-divider {
            height: 1px;
            background: linear-gradient(to right, #e0e0e0, #b3b3b3, #e0e0e0);
            margin: 25px 0;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
        }
        .psg-p-btn {
            background: linear-gradient(135deg, #071f63 0%, #071f63 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 0rem;
        }
        .psg-p-btn:hover {
            background: linear-gradient(135deg, #3a54c4 0%, #2a3f9d 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .psg-p-btn.green-bg {
            background: linear-gradient(135deg, #1abc9c 0%, #148f77 100%);
        }
        .psg-p-btn.green-bg:hover {
            background: linear-gradient(135deg, #148f77 0%, #0e6655 100%);
        }
        .psg-p-btn.red-bg {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }
        .psg-p-btn.red-bg:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
        }
        .nav-names {
            font-size: 18px;
            font-weight: 500;
        }
        .nav-names-active {
            color: #3a54c4;
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }
        .nav-names-active:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, #4e73df 0%, #3a54c4 100%);
            border-radius: 5px;
        }
        .form-label {
            font-weight: 500;
            color: #2c3e50;
        }
        .feature-card {
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background-color: #fff;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            font-size: 24px;
            color: #4e73df;
            margin-bottom: 10px;
        }
        .feature-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        .feature-description {
            color: #7f8c8d;
            font-size: 14px;
        }
        .img-preview {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 5px;
            background-color: #f8f9fa;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        .action-buttons .btn {
            margin-right: 35px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .quicklinks {
            margin-top: 30px;
        }
        .quicklinks .psg-p-btn {
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .quicklinks .psg-p-btn a {
            color: white;
            text-decoration: none;
        }
        .image-upload-container {
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .image-upload-container:hover {
            border-color: #4e73df;
        }
        .upload-icon {
            font-size: 30px;
            color: #4e73df;
            margin-bottom: 10px;
        }
        .upload-text {
            color: #7f8c8d;
            font-size: 14px;
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
               background: #0b3781;
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
        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }
 h5#editAmenityModalLabel {
    color: white;
}
.upload-icon.btn.btn-primary {
    padding: 0.375rem 1.75rem;
}
        /* .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background: ;
            font-weight: 500;
            border: none;
        }
        .table th {#343a40;
            color: white
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
            color: white;
            font-weight: 500;
            padding: 12px 15px;
        }
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .table tr:hover {
            background-color: #f1f3f9;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(58, 134, 255, 0.05);
        } */
        .modal-footer {
            border-top: 1px solid #eaeaea;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
                
                                <div class="page-header">
                    <h2 class="text-center">Our Specialised Units</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('testCurricular.index') }}">
                                    <i class="fas fa-home me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Our Specialised Units</li>
                        </ol>
                    </nav>
                </div>
                        
                    <div class="section-divider"></div>

            <!-- Main Content Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button id="toggleButton" class="smart-btn smart-btn-primary" onclick="toggleContent()">
                                <i class="bi bi-plus-circle"></i> Add Specialised Units
                            </button>
                        </div>

                        <!-- Add Amenities Form (Hidden by default) -->
                        <div id="videoContent" style="display: none;">
                            <div class="form-container">
                                <form action="{{ route('latestvideos.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-type"></i> Title <span class="required-asterisk">*</span>
                                            </div>
                                            <input class="form-control" type="text" id="title" name="title"
                                                placeholder="Enter title" required />
                                        </div>

                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-sort-numeric-down"></i> Order ID
                                            </div>
                                            <input class="form-control" type="number" id="sort_id" name="sort_id"
                                                placeholder="Enter Order ID" />
                                        </div>
                                        <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-sort-numeric-down"></i> Link
                                            </div>
                                            <input class="form-control" type="url" id="link" name="link"
                                                placeholder="Enter link" />
                                        </div>

                                        <div class="col-md-12 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-justify"></i> Description <span
                                                    class="required-asterisk">*</span>
                                            </div>
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter description"
                                                style="height: 120px;"></textarea>
                                        </div>

                                        <div class="col-md-12 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-image"></i> Thumbnail Image <span
                                                    class="required-asterisk">*</span>
                                            </div>
                                            <div class="upload-zone " onclick="document.getElementById('image2').click()">
                                                <div class="upload-icon btn btn-primary">
                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                </div>
                                                <p>Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                <input type="file" id="image2" name="image2" accept="image/webp"
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
                            <table id="example" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="70"><i class="bi bi-hash me-1"></i>S.No</th>
                                        <th><i class="bi bi-type me-1"></i>Title</th>
                                        <th class="text-center" width="220"><i class="bi bi-image me-1"></i>Thumbnail
                                        </th>
                                        <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $key => $video)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ $video->title }}</strong>
                                                <div class="text-muted small mt-1">Order: #{{ $video->sort_id ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($video->image2)
                                                    <div class="img-thumbnail-container">
                                                        <img src="{{ asset('images/' . $video->image2) }}" alt="Thumbnail"
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
                                                        data-id="{{ $video->id }}" data-title="{{ $video->title }}"
                                                        data-sort_id="{{ $video->sort_id }}"
                                                        data-image2="{{ $video->image2 }}"
                                                        data-description="{{ $video->description }}"
                                                        data-link="{{ $video->link }}"
                                                        data-action="{{ route('latestvideos.update', $video->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#editModalDetailpageeee">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>

                                                    <form id="delete-form-{{ $video->id }}" action="{{ route('latestvideos.destroy', $video->id) }}" method="POST" style="display: none;">
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
                        Our Specialised Units</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFormDetailsPAge" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-type"></i> Title <span class="required-asterisk">*</span>
                                </div>
                                <input class="form-control" type="text" id="editTitle" name="title"
                                    placeholder="Enter Title" required />
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
                                    <i class="bi bi-justify"></i> Description <span class="required-asterisk">*</span>
                                </div>
                                <textarea class="form-control" id="editDescription" name="description" placeholder="Description"
                                    style="height: 120px;" required></textarea>
                            </div>
                                 <div class="col-md-6 form-field">
                                            <div class="form-field-title">
                                                <i class="bi bi-sort-numeric-down"></i> Link
                                            </div>
                                            <input class="form-control"id="editLink" type="url" id="link" name="link"
                                                placeholder="Enter link" />
                                        </div>


                            <div class="col-md-12 form-field">
                                <div class="form-field-title">
                                    <i class="bi bi-image"></i> Thumbnail Image
                                </div>
                                <div class="upload-zone" onclick="document.getElementById('editImage2').click()">
                                    <div class="upload-icon btn btn-primary">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                    <p>Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                    <input type="file" id="editImage2" name="image2" accept="image/webp"
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
    @foreach ($videos as $video)
        <form id="delete-form-{{ $video->id }}" action="{{ route('latestvideos.destroy', $video->id) }}"
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
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Specialised Units';
                button.classList.add('smart-btn-primary');
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Specialised Units';
                button.classList.add('smart-btn-primary');
            }
        }

        // Show image preview when selecting a file
        document.addEventListener("DOMContentLoaded", function() {
            // For add form
            document.getElementById("image2").addEventListener("change", function(event) {
                handleFileSelection(event, "imagePreview");
            });

            // For edit form
            document.getElementById("editImage2").addEventListener("change", function(event) {
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
                    const title = this.getAttribute("data-title");
                    const sort_id = this.getAttribute("data-sort_id");
                    const image2 = this.getAttribute("data-image2");
                    const description = this.getAttribute("data-description");
                    const link = this.getAttribute("data-link");
                    const actionUrl = this.getAttribute("data-action");

                    document.getElementById("editFormDetailsPAge").setAttribute("action",
                    actionUrl);

                    // Populate form fields
                    document.getElementById("editTitle").value = title;
                    document.getElementById("editDescription").value = description;
                    document.getElementById("editSortId").value = sort_id;
                    document.getElementById("editLink").value = link;

                    // Handle image display
                    if (image2) {
                        const imagePath = "{{ asset('images/') }}/" + image2;
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
