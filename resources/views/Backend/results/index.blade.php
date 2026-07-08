@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

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
            padding: 8px 26px;
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
               background: #0b3781 !important;
            color: white !important;
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
 h5#editModalLabel {
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
                            <!-- Header Section -->
               
                            <div class="page-header">
                <h2 class="text-center">Our Products</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('testCurricular.index') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Our Products</li>
                    </ol>
                </nav>
            </div>
        
                    

            <div class=" page-box grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Create Department Form -->
                <div class="lg:col-span-4">
                    <div class="box-style">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Prodcut Title</h2>
                        <form action="{{ route('results.main.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label for="title" class="form-label">Prodcut Name <span
                                        class="text-red-500">*</span></label>
                                <input class="form-control" id="title" name="title"
                                    placeholder="Enter department name" required />
                            </div>
                            <button type="submit" class="btn smart-btn-primary w-full">Create Prodcut</button>
                        </form>
                    </div>
                </div>

                <!-- Existing Departments List -->
                <div class="lg:col-span-8">
                    <div class="box-style relative group">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Existing Prodcut Catagory</h2>
                        <div class="table-container">
                            <table id="example" class="table table-striped table-bordered">
                                <thead class="bg-dark text-white text-center">
                                    <tr>
                                        <th class="w-16">S.No</th>
                                        <th>Department</th>
                                          <th>Sort_ID</th>
                                        <th class="w-48">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
    @foreach ($Infrastructure_fronts->sortBy('sort_id') as $Infrastructure_front)  
        <tr class="relative group">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Infrastructure_front->title }}</td>
            <td>{{ $Infrastructure_front->sort_id }}</td>
            <td>
                <div class="overlay-icons">
                    <button class="btn smart-btn-primary" style="margin-right: 26px;"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $Infrastructure_front->id }}">
                        Edit
                    </button>
                    <form action="{{ route('results.main.destroy', $Infrastructure_front->id) }}"
                        method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this record?')">
                            Delete
                        </button>
                    </form>
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

<!-- MOVE ALL EDIT MODALS HERE - OUTSIDE THE TABLE -->
@foreach ($Infrastructure_fronts->sortBy('sort_id') as $Infrastructure_front)
    <div class="modal fade" id="editModal{{ $Infrastructure_front->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $Infrastructure_front->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('results.main.update', $Infrastructure_front->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title text-xl font-bold text-white"
                            id="editModalLabel{{ $Infrastructure_front->id }}">
                            Edit Category
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-8">
                        <div class="mb-6">
                            <label for="title-{{ $Infrastructure_front->id }}" class="form-label">
                                Category Name
                            </label>
                            <input type="text" class="form-control"
                                name="title"
                                id="title-{{ $Infrastructure_front->id }}"
                                value="{{ $Infrastructure_front->title }}" required />
                        </div>
                        <div class="mb-6">
                            <label for="sort_id-{{ $Infrastructure_front->id }}" class="form-label">
                                Sort ID
                            </label>
                            <input type="text" class="form-control"
                                name="sort_id"
                                id="sort_id-{{ $Infrastructure_front->id }}"
                                value="{{ $Infrastructure_front->sort_id }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn smart-btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

            <hr class="my-12 border-gray-200" />

            <!-- Add Images Form -->
            <div class="page-box box-style">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New</h2>
                <form action="{{ route('results.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="Infrastructure_id" class="form-label">Select Catagory <span
                                    class="text-red-500">*</span></label>
                            <select class="form-control" id="Infrastructure_id" name="Infrastructure_id" required>
                                <option value="">Select Catagory </option>
                               @foreach ($Infrastructure_fronts->sortBy('sort_id') as $Infrastructure_front)   
                                    <option value="{{ $Infrastructure_front->id }}">{{ $Infrastructure_front->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="infrastructure_title" class="form-label">Title <span
                                    class="text-red-500">*</span></label>
                            <input class="form-control" type="text" id="infrastructure_title"
                                name="infrastructure_title" required />
                        </div>
                        <!--<div>-->
                        <!--    <label for="pdf" class="form-label">Add icon <span class="text-red-500">*</span></label>-->
                        <!--    <input class="form-control " type="file" accept="images/*" id="pdf" name="pdf"-->
                        <!--        required />-->
                        <!--</div>-->
                        <div>
                            <label for="pdf_add" class="form-label">Add Icon <span class="text-red-500">*</span></label>
                            <input 
                                type="file" 
                                accept="image/*" 
                                id="pdf_add" 
                                name="pdf" 
                                class="form-control current-preview" 
                                onchange="previewImageLive(this)">
                            <div class="current-preview mt-3" id="preview_add"></div>
                        </div>
                        <div>
                            <label for="description" class="form-label">Description <span
                                    class="text-red-500">*</span></label>
                         <textarea  name="description" id="description" class="form-control"></textarea>
                        </div>
                              <div>
                            <label for="sort_id" class="form-label">Sort_id </label>
                            <input class="form-control" type="text" id="sort_id"
                                name="sort_id" />
                        </div>
                          <div>
                                <label for="url" class="form-label">URL <span
                                        class="text-red-500">*</span></label>
                                <input class="form-control" type="text" name="url" id="url"></input>
                            </div>
                    </div>
                    <button type="submit" class="btn smart-btn-primary">Save</button>
                </form>
            </div>

            <hr class="my-12 border-gray-200" />

            <!-- Faculty Management -->
            <div class="page-box box-style">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Prodcuts Management</h2>
                <div class="table-container">
                    <table class="table table-striped table-bordered" id="infrastrcture">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>Results </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                              @foreach ($Infrastructure_fronts as $front)
                                <tr class="relative group">
                                    <td>{{ $front->title }}</td>
                                    <td>
                                          @foreach ($Infrastructure_Details->where('Infrastructure_id', $front->id)->sortBy('sort_id') as $detail)
                                            <div class="action-container">
                                                <strong class="text-gray-800">{{ $detail->infrastructure_title }}</strong>
                                                <div class="mt-3 overlay-icons">
                                                    <button class="btn smart-btn-primary" style="margin-right: 31px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDetailModal{{ $detail->id }}">Edit
                                                        Detail</button>
                                                    <form action="{{ route('results.destroy', $detail->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Detail Modals -->
            @foreach ($Infrastructure_Details as $detail)
                <div class="modal fade" id="editDetailModal{{ $detail->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('results.update', $detail->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title text-xl font-bold text-white">Edit Department Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-8">
                                   <!-- Inside each modal's <div class="modal-body p-8"> -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="edit-infra-id-{{ $detail->id }}" class="form-label">Select Infrastructure</label>  <!-- Unique ID -->
        <select class="form-control" id="edit-infra-id-{{ $detail->id }}" name="Infrastructure_id" required>
            @foreach ($Infrastructure_fronts as $front)
                <option value="{{ $front->id }}" {{ $detail->Infrastructure_id == $front->id ? 'selected' : '' }}>
                    {{ $front->title }}
                </option>
            @endforeach
        </select>
        @error('Infrastructure_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="edit-title-{{ $detail->id }}" class="form-label">Title</label>  <!-- Unique ID -->
        <input type="text" class="form-control" id="edit-title-{{ $detail->id }}" name="infrastructure_title" 
               value="{{ $detail->infrastructure_title }}" required />
        @error('infrastructure_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="edit-desc-{{ $detail->id }}" class="form-label">Description</label>  <!-- Unique ID -->
        <textarea class="form-control" id="edit-desc-{{ $detail->id }}" name="description" rows="5" 
                  placeholder="Enter description..." >{{ old('description', $detail->description) }}</textarea>
        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
     <div>

         <label for="sort_id" class="form-label">Sort_id </label>
        <input class="form-control"  id="sort_id" value="{{ $detail->sort_id }}" name="sort_id"  />
     </div>
    <div>
        <label for="edit-url-{{ $detail->id }}" class="form-label">URL</label>  <!-- Unique ID -->
        <input type="text" class="form-control" name="url" id="edit-url-{{ $detail->id }}" value="{{ $detail->url }}"  />
        @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
     <!--Image section unchanged -->
    <!--<div class="col-span-1 md:col-span-2">-->
    <!--    <label class="form-label">Image</label>-->
    <!--    @if($detail->pdf)-->
    <!--        <div class="current-preview mt-3 mb-4">-->
    <!--            <img src="{{ asset('storage/' . $detail->pdf) }}" alt="Current icon"-->
    <!--                 class="rounded-lg shadow-md max-w-xs max-h-64 object-cover border border-gray-300">-->
    <!--            <p class="text-sm text-gray-600 mt-2">Current Image</p>-->
    <!--        </div>-->
    <!--    @endif-->
    <!--    <input type="file" accept="image/*" name="pdf" class="form-control current-preview"-->
    <!--           id="pdf_{{ $detail->id }}" onchange="previewImageLive(this, 'preview_edit_{{ $detail->id }}')">-->
    <!--    <div class="current-preview mt-3" id="preview_edit_{{ $detail->id }}"></div>-->
    <!--    @error('pdf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror-->
    <!--</div>-->
</div>
        
        <div class="col-span-1 md:col-span-2">
    <label class="form-label">Image</label>
    
    <!-- Show current image if exists -->
    @if($detail->pdf)
        <div class="current-preview mt-3 mb-4">
            <img src="{{ asset('pdfs/' . $detail->pdf) }}" 
                 alt="Current icon" 
                 class="rounded-lg shadow-md max-w-xs max-h-64 object-cover border border-gray-300">
            <p class="text-sm text-gray-600 mt-2">Current Image</p>
        </div>
    @endif

    <!-- File input with live preview -->
    <input 
        type="file" 
        accept="image/*" 
        name="pdf" 
        class="form-control current-preview" 
        id="pdf_{{ $detail->id }}"
        onchange="previewImageLive(this, 'preview_edit_{{ $detail->id }}')">
    
    <div class="current-preview mt-3" id="preview_edit_{{ $detail->id }}"></div>
</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn smart-btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <!-- Cleaned: Single loads (use assets for offline support) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> <!-- Includes Popper -->
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.js"></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <!-- Removed CDN duplicates -->

    @verbatim
    <script>
        $(document).ready(function() {
            $("#example").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                searching: true,
                pageLength: 10,
                language: {
                    searchPlaceholder: "Search departments...",
                    search: ""
                }
            });
            $("#infrastrcture").DataTable({
                paging: true,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                info: true,
                autoWidth: false,
                searching: true,
                pageLength: 10,
                language: {
                    searchPlaceholder: "Search faculty...",
                    search: ""
                }
            });
        });

        // Global previewImageLive function (rewritten without backticks for PHP compatibility)
        function previewImageLive(input, previewId = null) {
            let preview;
            if (previewId) {
                preview = document.getElementById(previewId);
            } else {
                // Auto-find for frontend form
                preview = input.closest('div').querySelector('.current-preview:last-of-type');
                if (!preview) preview = input.parentNode.querySelector('.current-preview');
            }
            if (!preview) return;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Use string concatenation instead of template literal
                    preview.innerHTML = '<img src="' + e.target.result + '"' +
                        ' class="rounded-lg shadow-md max-w-xs max-h-64 object-cover border border-indigo-300 mt-2"' +
                        ' alt="New preview">' +
                        '<p class="text-sm text-indigo-600 mt-2 font-medium">New image selected</p>';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                // Clear if no file (preserve existing image)
                if (!previewId || !preview.querySelector('img[src*="storage"]')) {
                    preview.innerHTML = '';
                }
            }
        }

        // Global modal clear event (always runs)
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function () {
                    this.querySelectorAll('.current-preview').forEach(el => {
                        if (!el.querySelector('img[src*="storage"]')) {
                            el.innerHTML = '';
                        }
                    });
                });
            });
        });

        // Other functions (unchanged)
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#2563eb",
                cancelButtonColor: "#dc2626",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm" + id).submit();
                }
            });
        }
        function previewImage(input, previewId) { /* Legacy - remove if unused */ }
        function showImageModal(imageSrc, title) { /* Legacy - remove if unused */ }
    </script>
    @endverbatim

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
    @endif
@endsection
