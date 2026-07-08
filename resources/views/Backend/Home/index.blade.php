
@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
        h5#editModalLabel44 {
    color: white;
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
                <h2 class="text-center">Home Page Management</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('testCurricular.index') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home Page Management</li>
                    </ol>
                </nav>
            </div>
            <div class="page-box">
                <!-- Main Button for Add Slide Banner -->
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="toggleButtonHomeFirst" class="toggle-btn"
                            onclick="toggleContentHomeFirst()">
                            <i class="fas fa-plus-circle me-2"></i> Add Slide Banner
                        </button>
                    </div>
                </div>
                <!-- Form Section (Hidden by Default) -->
                <div class="row mt-4" id="videoContentHomeFirst" style="display: none;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-primary"><i class="fas fa-image me-2"></i> Add Banner Slide</h5>
                                <button type="button" class="btn-close" onclick="toggleContentHomeFirst()"></button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('circulars.main.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="form-label">
                                                    <i class="fas fa-heading me-1 text-primary"></i> Heading
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="title" name="title"
                                                    placeholder="Enter heading" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="span_title" class="form-label">
                                                    <i class="fas fa-strikethrough me-1 text-primary"></i> Span Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="span_title" name="span_title"
                                                    placeholder="Enter span title" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="catagory_image" class="form-label">
                                                    <i class="fas fa-image me-1 text-primary"></i> Background Image / Video
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="image-upload-container">
                                                    <div class="upload-icon">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                    </div>
                                                    <p class="upload-text">Drag & drop or click to upload (Image Max: 5MB,
                                                        Video Max: 15MB)</p>
                                                    <input class="form-control" type="file" id="catagory_image"
                                                        accept="image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/webm"
                                                        name="catagory_image" required onchange="previewFile(this)" />
                                                </div>
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Preview"
                                                        style="max-width: 100%; display: none;" class="img-preview">
                                                    <video id="videoPreview" controls
                                                        style="max-width:100%; display:none;"></video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sort_id" class="form-label">
                                                    <i class="fas fa-font me-1 text-primary"></i>Sort id
                                                </label>
                                                <input class="form-control" id="sort_id" name="sort_id"
                                                    placeholder="sort id" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-end">
                                        <button type="button" class="btn btn-secondary me-2"
                                            onclick="toggleContentHomeFirst()">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </button>
                                        <button type="submit" class="save-btn">
                                            <i class="fas fa-save me-1"></i> Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Table Section -->
                 <!-- Data Table Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered""> 
                                <thead>
                                    <tr>
                                        <th width="70"><i class="bi bi-hash me-1"></i> S.No</th>
                                        <th><i class="bi bi-type me-1"></i> Heading</th>
                                        <th class="text-center" width="220"><i class="bi bi-image me-1"></i> Background Image</th>
                                        <th class="text-center" width="200"><i class="bi bi-gear me-1"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($circularsTest as $circular)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $circular->title }}</strong>
                                                @if ($circular->span_title)
                                                    <br><small class="text-muted">{{ $circular->span_title }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $ext = pathinfo($circular->catagory_image, PATHINFO_EXTENSION);
                                                @endphp
                                                @if(in_array(strtolower($ext), ['jpeg','jpg','png','webp']))
                                                    <img src="{{ asset('images/' . $circular->catagory_image) }}"
                                                        alt="Category Image"
                                                        class="img-fluid img-preview"
                                                        style="width: 150px; height: 80px; object-fit: cover;" />
                                                @elseif(strtolower($ext) === 'mp4')
                                                    <span class="badge bg-info text-white p-2">Video added</span>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td class="action-buttons">
                                                <button class="smart-btn smart-btn-primary edit-btn-detail"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $circular->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button"
                                                    class="smart-btn smart-btn-danger"
                                                    onclick="confirmDelete({{ $circular->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                                <form id="deleteForm{{ $circular->id }}"
                                                    action="{{ route('circulars.main.destroy', $circular->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
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
                <!-- Quick Links Section -->
                <div class=" page-box row mt-5">
                    <div class="col-12">
                        <h5 class="mb-4 text-primary"><i class="fas fa-sitemap me-2"></i> Quick Links</h5>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <h3 class="feature-title">Our Specialised Units</h3>
                            <p class="feature-description">
                                Manage Specialised Units.
                            </p>
                            <a href="{{ route('latestvideos.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Specialised Units
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h3 class="feature-title">Prodcuts</h3>
                            <p class="feature-description">
                                Prodcuts.
                            </p>
                            <a href="{{ route('results.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Prodcuts
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                            <h3 class="feature-title">Our Company stats throught the Years</h3>
                            <p class="feature-description">
                                Learn more about our company stats throught the years.
                            </p>
                            <a href="{{ route('faq.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Years
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                            <h3 class="feature-title">Our Service</h3>
                            <p class="feature-description">
                                Learn more about Our company Service .
                            </p>
                            <a href="{{ route('ourservice.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Service
                            </a>
                        </div>
                    </div>
 
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <h3 class="feature-title">Client Logo</h3>
                            <p class="feature-description">
                                Add logo and manage client Logo.
                            </p>
                            <a href="{{ route('viewgallery.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Client Logo
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <h3 class="feature-title">Testimoniol</h3>
                            <p class="feature-description">
                                Add Testimoniol.
                            </p>
                            <a href="{{ route('Homepagetestimonial.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Testimoniol
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <h3 class="feature-title">Blogs</h3>
                            <p class="feature-description">
                                Showcase the school's academic achievements and Blogs.
                            </p>
                            <a href="{{ route('Cocurriculart.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Blogs
                            </a>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h3 class="feature-title">About Us</h3>
                            <p class="feature-description">
                                Learn more about our school's mission, vision, and values.
                            </p>
                            <a href="{{ route('abouts.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage About Us
                            </a>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <h3 class="feature-title">Organization</h3>
                            <p class="feature-description">
                                Learn more about our school's Organization.
                            </p>
                            <a href="{{ route('organization.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Organization Us
                            </a>
                        </div>
                    </div> --}}
                  {{-- <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="feature-title">Facilities</h3>
                            <p class="feature-description">
                                Add or update school facilities and infrastructure details.
                            </p>
                            <a href="{{ route('facilties.index') }}" class="btn psg-p-btn mt-2 w-100">
                                <i class="fas fa-arrow-right me-1"></i> Manage Facilities
                            </a>
                        </div>
                    </div> --}}
                </div>
               
            </div>
        </div>

        {{-- Moved all edit modals outside the table to fix z-index/backdrop issues --}}
        @foreach ($circularsTest as $circular)
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $circular->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $circular->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="editModalLabel{{ $circular->id }}">
                                <i class="fas fa-edit me-2"></i> Edit Banner
                            </h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"
                                style="background-color: transparent; color: white; opacity: 1;"></button>
                        </div>
                        <form
                            action="{{ route('circulars.main.update', $circular->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body" style="padding: 20px;">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title"
                                                class="form-label d-flex align-items-center mb-2">
                                                <span
                                                    class="text-primary me-2">H</span>
                                                Title
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                name="title"
                                                value="{{ $circular->title }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="span_title"
                                                class="form-label d-flex align-items-center mb-2">
                                                <span
                                                    class="text-primary me-2">S</span>
                                                Span Title
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                name="span_title"
                                                value="{{ $circular->span_title }}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="catagory_image"
                                                class="form-label d-flex align-items-center mb-2">
                                                <span
                                                    class="text-primary me-2">🖼️</span>
                                                Banner Image
                                            </label>
                                    <input type="file" class="form-control"
                                        name="catagory_image"
                                        accept="image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/webm"
                                        id="catagory_image{{ $circular->id }}"
                                        onchange="validateAndPreview(event, {{ $circular->id }})" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Current
                                                Image</label>
                                           <div class="border rounded p-1 mt-2">
                                                <img id="imagePreview{{ $circular->id }}"
                                                    src="{{ asset('images/' . $circular->catagory_image) }}"
                                                    alt="Preview"
                                                    class="img-fluid img-preview"
                                                    style="width:100%; height:120px; object-fit:cover; display: {{ in_array(strtolower(pathinfo($circular->catagory_image, PATHINFO_EXTENSION)), ['jpeg','jpg','png','webp']) ? 'block' : 'none' }};" />
                                                <video id="videoPreview{{ $circular->id }}"
                                                    src="{{ strtolower(pathinfo($circular->catagory_image, PATHINFO_EXTENSION)) === 'mp4' ? asset('images/' . $circular->catagory_image) : '' }}"
                                                    controls
                                                    style="width:100%; max-height:120px; display: {{ strtolower(pathinfo($circular->catagory_image, PATHINFO_EXTENSION)) === 'mp4' ? 'block' : 'none' }};">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Linktxt1"
                                                class="form-label d-flex align-items-center mb-2">
                                                <span
                                                    class="text-primary me-2">A</span>
                                                Sort Id
                                            </label>
                                            <input class="form-control" id="sort_id"
                                                value="{{ $circular->sort_id }}"
                                                name="sort_id"
                                                placeholder="sort Id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer"
                                style="border-top: 1px solid #e9ecef; padding: 15px 20px;">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                    style="background-color: #6c757d; color: white; padding: 8px 16px; border: none; border-radius: 4px;">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn"
                                    style="background-color: #20B2AA; color: white; padding: 8px 16px; border: none; border-radius: 4px;">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        // Toggle Banner Form Section
        function toggleContentHomeFirst() {
            let content = document.getElementById("videoContentHomeFirst");
            let button = document.getElementById("toggleButtonHomeFirst");
            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.innerHTML = '<i class="fas fa-times me-2"></i> Close Banner Form';
                button.classList.add("red-bg");
                button.classList.remove("green-bg");
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="fas fa-plus-circle me-2"></i> Add Slide Banner';
                button.classList.remove("red-bg");
            }
        }
        // Image Preview Function
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const modalId = input.closest(".modal").id;
                const previewElement = document.getElementById("imagePreview" + modalId.replace("editModal", ""));
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                    previewElement.style.display = "block";
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Initialize DataTable
        $(document).ready(function() {
            $("#cirrcularsHomePage").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                searching: true,
                responsive: true,
                language: {
                    search: '<i class="fas fa-search"></i>',
                    searchPlaceholder: "Search records...",
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                    },
                },
            });
        });
        // SweetAlert Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, delete it!',
                cancelButtonText: '<i class="fas fa-times me-1"></i> Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm" + id).submit();
                }
            });
        }
    </script>
    <script>
        document.getElementById("category_image").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (file) {
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: "error",
                        title: "File Too Large!",
                        text: "Please upload an image less than 5MB.",
                    });
                    event.target.value = ""; // Reset the file input
                    document.getElementById("imagePreview").style.display = "none";
                    return;
                }
                // Show image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById("imagePreview");
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const url = this.getAttribute('data-url');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = url;
                            form.style.display = 'none';
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        function validateFileSize(input) {
            const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
            const file = input.files[0];
            if (file && file.size > maxSizeInBytes) {
                // Clear the file input
                input.value = '';
                // Show SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The selected file exceeds the maximum size of 5MB. Please choose a smaller file.',
                    confirmButtonColor: '#3085d6'
                });
            }
        }
    </script>
    <script>
        function validateAndPreview(event, id) {
            const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
            const file = event.target.files[0];
            if (file && file.size > maxSizeInBytes) {
                // Clear the file input
                event.target.value = '';
                // Show SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The selected file exceeds the maximum size of 5MB. Please choose a smaller file.',
                    confirmButtonColor: '#3085d6'
                });
            } else if (file) {
                // If file size is valid, proceed with the preview
                previewEditImage(event, id);
            }
        }
        function previewEditImage(event, id) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview' + id);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function previewFile(input) {
            const file = input.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const videoPreview = document.getElementById('videoPreview');
            if (!file) return;
            const fileType = file.type;
            if (fileType.startsWith('image/')) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                videoPreview.style.display = 'none';
            } else if (fileType === 'video/mp4') {
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.style.display = 'block';
                imagePreview.style.display = 'none';
            }
        }
    </script>
    <script>
    function validateAndPreview(event, id) {
        const file = event.target.files[0];
        if (!file) return;
        const imagePreview = document.getElementById(`imagePreview${id}`);
        const videoPreview = document.getElementById(`videoPreview${id}`);
        const extension = file.name.split('.').pop().toLowerCase();
        // Reset previews
        imagePreview.style.display = 'none';
        videoPreview.style.display = 'none';
        if (['jpeg','jpg','png','webp'].includes(extension)) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        } else if (extension === 'mp4') {
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.style.display = 'block';
        }
    }
    </script>
@endsection
