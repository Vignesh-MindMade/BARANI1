@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
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

        .img-thumbnail-container {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 5px;
            text-align: center;
        }

        .nav-names {
            font-size: 19px;
            font-family: 'boxicons';
            color: #000000;
            font-weight: bolder;
        }

        .nav-names-active {
            font-size: 19px;
            font-family: 'boxicons';
            color: red;
            font-weight: bolder;
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
    <div class="page-wrapper co-curricular-container">
        <div class="page-box page-content">
            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <h3 class="page-title mb-0">
                                <i class="bi bi-journal-text me-2"></i>Co-curricular Activities
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('testCurricular.index') }}" class="text-decoration-none">
                                        <i class="bi bi-house-door me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Co-curricular Activities</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <hr>
                <div class="section-divider"></div>

                <!-- Add Blog Form -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-box">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button id="toggleButton" class="smart-btn smart-btn-primary" onclick="toggleContent()">
                                    <i class="bi bi-plus-circle"></i> Add Blogs
                                </button>
                            </div>

                            <div id="videoContent" style="display: none;">
                                <div class="form-container">
                                    <form action="{{ route('cocurricular.main.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-field">
                                                <div class="form-field-title">
                                                    <i class="bi bi-type"></i> Heading <span
                                                        class="required-asterisk">*</span>
                                                </div>
                                                <input class="form-control" id="heading" name="heading"
                                                    placeholder="Enter heading" required aria-label="Heading" />
                                            </div>
                                            <div class="col-md-6 form-field">
                                                <div class="form-field-title">
                                                    <i class="bi bi-calendar"></i> Date <span
                                                        class="required-asterisk">*</span>
                                                </div>
                                                <input class="form-control" type="date" id="date" name="date"
                                                    required aria-label="Date" />
                                            </div>
                                            <div class="col-md-6 form-field">
                                                <div class="form-field-title">
                                                    <i class="bi bi-geo-alt"></i> Location <span
                                                        class="required-asterisk">*</span>
                                                </div>
                                                <input class="form-control" id="location" name="location"
                                                    placeholder="Enter location" required aria-label="Location" />
                                            </div>
                                            <div class="col-md-6 form-field">
                                                <div class="form-field-title">
                                                    <i class="bi bi-sort-numeric-down"></i> Order ID <span
                                                        class="required-asterisk">*</span>
                                                </div>
                                                <input class="form-control" type="number" id="order_id" name="order_id"
                                                    placeholder="Enter Order ID" required aria-label="Order ID" />
                                            </div>
                                            <div class="col-md-12 form-field">
                                                <div class="form-field-title">
                                                    <i class="bi bi-justify"></i> Message <span
                                                        class="required-asterisk">*</span>
                                                </div>
                                                <textarea class="form-control" id="title" name="title" placeholder="Enter message" style="height: 120px;" required
                                                    aria-label="Message"></textarea>
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
                                                        required style="display: none;" aria-label="Image Upload" />
                                                </div>
                                                <img id="imagePreview" src="" alt="Image Preview"
                                                    class="mt-2 d-none" style="max-width: 200px; max-height: 200px;" />
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

                            <!-- Blogs Table -->
                            <div class="section-header">
                                <i class="bi bi-journal-text"></i> Our Blogs
                            </div>
                            <div class="table-responsive">
                                <table id="cocurricularHome" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="70"><i class="bi bi-hash me-1"></i>S.No</th>
                                           
                                            <th><i class="bi bi-type me-1"></i>Heading</th>
                                            <th><i class="bi bi-calendar me-1"></i>Date</th>
                                            <th class="text-center" width="220"><i class="bi bi-image me-1"></i>Image
                                            </th>
                                            
                                            <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($CocurricularFront as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                
                                                <td><strong>{{ $item->heading }}</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                                <td class="text-center">
                                                    @if ($item->image)
                                                        <div class="img-thumbnail-container">
                                                            <img src="{{ asset('images/' . $item->image) }}"
                                                                alt="{{ $item->title }}" class="img-fluid"
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
                                                            class="smart-btn smart-btn-primary edit-btn-blog"
                                                            data-id="{{ $item->id }}"
                                                            data-heading="{{ $item->heading }}"
                                                            data-date="{{ $item->date }}"
                                                            data-location="{{ $item->location }}"
                                                            data-title="{{ $item->title }}"
                                                            data-order_id="{{ $item->order_id }}"
                                                            data-image="{{ $item->image }}"
                                                            data-action="{{ route('cocurricular.update', $item->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModalBlog{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        <form action="{{ route('cocurricular.delete', $item->id) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="smart-btn smart-btn-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Edit Blog Modal -->
                                            <div class="modal fade" id="editModalBlog{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editBlogModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editBlogModalLabel{{ $item->id }}">
                                                                <i class="bi bi-pencil-square me-2"></i>Edit Co-curricular
                                                                Activity
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editFormBlog{{ $item->id }}"
                                                                action="{{ route('cocurricular.update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-md-6 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-type"></i> Heading <span
                                                                                class="required-asterisk">*</span>
                                                                        </div>
                                                                        <input class="form-control"
                                                                            id="editHeading{{ $item->id }}"
                                                                            name="heading"
                                                                            value="{{ old('heading', $item->heading) }}"
                                                                            placeholder="Enter heading" required
                                                                            aria-label="Heading" />
                                                                    </div>
                                                                    <div class="col-md-6 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-calendar"></i> Date <span
                                                                                class="required-asterisk">*</span>
                                                                        </div>
                                                                        <input class="form-control" type="date"
                                                                            id="editDate{{ $item->id }}"
                                                                            name="date"
                                                                            value="{{ old('date', $item->date) }}"
                                                                            required aria-label="Date" />
                                                                    </div>
                                                                    <div class="col-md-6 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-geo-alt"></i> Location <span
                                                                                class="required-asterisk">*</span>
                                                                        </div>
                                                                        <input class="form-control"
                                                                            id="editLocation{{ $item->id }}"
                                                                            name="location"
                                                                            value="{{ old('location', $item->location) }}"
                                                                            placeholder="Enter location" required
                                                                            aria-label="Location" />
                                                                    </div>
                                                                    <div class="col-md-6 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-sort-numeric-down"></i> Order
                                                                            ID <span class="required-asterisk">*</span>
                                                                        </div>
                                                                        <input class="form-control" type="number"
                                                                            id="editOrderId{{ $item->id }}"
                                                                            name="order_id"
                                                                            value="{{ old('order_id', $item->order_id) }}"
                                                                            placeholder="Enter Order ID" required
                                                                            aria-label="Order ID" />
                                                                    </div>
                                                                    <div class="col-md-12 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-justify"></i> Message <span
                                                                                class="required-asterisk">*</span>
                                                                        </div>
                                                                        <textarea class="form-control" id="editTitle{{ $item->id }}" name="title" placeholder="Enter message"
                                                                            style="height: 120px;" required aria-label="Message">{{ old('title', $item->title) }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-12 form-field">
                                                                        <div class="form-field-title">
                                                                            <i class="bi bi-image"></i> Image
                                                                        </div>
                                                                        <div class="upload-zone"
                                                                            onclick="document.getElementById('editImage{{ $item->id }}').click()">
                                                                            <div class="upload-icon">
                                                                                <i class="bi bi-cloud-arrow-up"></i>
                                                                            </div>
                                                                            <p>Drag & drop or click to upload (Max: 5MB,
                                                                                WebP format)</p>
                                                                            <input type="file"
                                                                                id="editImage{{ $item->id }}"
                                                                                name="image" accept="image/webp"
                                                                                style="display: none;"
                                                                                aria-label="Image Upload" />
                                                                        </div>
                                                                        <!-- Current Image -->
                                                                        <div class="mt-3"
                                                                            id="currentImageContainer{{ $item->id }}"
                                                                            style="{{ $item->image ? 'display: block;' : 'display: none;' }}">
                                                                            <div class="form-field-title">
                                                                                <i class="bi bi-image"></i> Current Image
                                                                            </div>
                                                                            <div class="img-thumbnail-container">
                                                                                <img id="currentImagePreview{{ $item->id }}"
                                                                                    src="{{ $item->image ? asset('images/' . $item->image) : '' }}"
                                                                                    alt="Current Image" class="img-fluid"
                                                                                    style="max-height: 150px;" />
                                                                            </div>
                                                                        </div>
                                                                        <!-- New Image Preview -->
                                                                        <div class="mt-3"
                                                                            id="newImageContainer{{ $item->id }}"
                                                                            style="display: none;">
                                                                            <div class="form-field-title">
                                                                                <i class="bi bi-image"></i> New Image
                                                                                Preview
                                                                            </div>
                                                                            <div class="img-thumbnail-container">
                                                                                <img id="newImagePreview{{ $item->id }}"
                                                                                    src="" alt="New Image Preview"
                                                                                    class="img-fluid"
                                                                                    style="max-height: 150px;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions mt-3">
                                                                    <button type="button"
                                                                        class="smart-btn smart-btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bi bi-x-circle"></i> Cancel
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="smart-btn smart-btn-success">
                                                                        <i class="bi bi-save"></i> Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No records found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
<br>
<br>
<br>
                            <!-- Enroll Now Table -->
                            <div class="section-header mt">
                                <h4><i class="bi bi-person-plus"></i> Enroll Now</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="70"><i class="bi bi-hash me-1"></i>S.No</th>
                                            <th><i class="bi bi-justify me-1"></i>Link</th>
                                            <th class="text-center" width="200"><i class="bi bi-gear me-1"></i>Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CocurricularDetail as $key => $detail)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><strong>{{ $detail->description }}</strong></td>
                                                <td>
                                                    <div class="action-btns">
                                                        <button type="button"
                                                            class="smart-btn smart-btn-primary edit-btn-detail"
                                                            data-id="{{ $detail->id }}"
                                                            data-description="{{ $detail->description }}"
                                                            data-action="{{ route('cocurricular.detail.update', $detail->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModalDetail{{ $detail->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Edit Enroll Now Modal -->
                                            <div class="modal fade" id="editModalDetail{{ $detail->id }}"
                                                tabindex="-1" aria-labelledby="editDetailModalLabel{{ $detail->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editDetailModalLabel{{ $detail->id }}">
                                                                <i class="bi bi-pencil-square me-2"></i>Edit Enroll Now
                                                                Link
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editFormDetail{{ $detail->id }}"
                                                                action="{{ route('cocurricular.detail.update', $detail->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-field">
                                                                    <div class="form-field-title">
                                                                        <i class="bi bi-justify"></i> Link <span
                                                                            class="required-asterisk">*</span>
                                                                    </div>
                                                                    <input class="form-control" id="editDescription{{ $detail->id }}" name="description"
                                                                        placeholder="Enter Link" style="height: 120px;" required aria-label="Description" value="{{ $detail->description }}">
                                                                </div>
                                                                <div class="form-actions mt-3">
                                                                    <button type="button"
                                                                        class="smart-btn smart-btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bi bi-x-circle"></i> Cancel
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="smart-btn smart-btn-success">
                                                                        <i class="bi bi-save"></i> Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        // DataTable Initialization
        $(document).ready(function() {
            $("#cocurricularHome").DataTable({
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

            $("#cocurricularDetail").DataTable({
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

        // Toggle Add Blogs Form
        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.innerHTML = '<i class="bi bi-x-circle"></i> Hide Form';
                button.classList.remove('smart-btn-primary');
                button.classList.add('smart-btn-danger');
            } else {
                content.style.display = "none";
                button.innerHTML = '<i class="bi bi-plus-circle"></i> Add Blogs';
                button.classList.remove('smart-btn-danger');
                button.classList.add('smart-btn-primary');
            }
        }

        // Image Upload Handling
        document.addEventListener("DOMContentLoaded", function() {
            // Add form image upload
            document.getElementById("image").addEventListener("change", function(event) {
                handleFileSelection(event, "imagePreview");
            });

            // Edit form image uploads
            document.querySelectorAll("input[id^='editImage']").forEach(input => {
                input.addEventListener("change", function(event) {
                    const id = this.id.replace("editImage", "");
                    handleFileSelection(event, "newImagePreview" + id, "newImageContainer" + id);
                });
            });

            // Handle drag-and-drop for upload zones
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

            // Populate edit blog modals
            document.querySelectorAll(".edit-btn-blog").forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    document.getElementById("editHeading" + id).value = this.getAttribute(
                        "data-heading");
                    document.getElementById("editDate" + id).value = this.getAttribute("data-date");
                    document.getElementById("editLocation" + id).value = this.getAttribute(
                        "data-location");
                    document.getElementById("editTitle" + id).value = this.getAttribute(
                        "data-title");
                    document.getElementById("editOrderId" + id).value = this.getAttribute(
                        "data-order_id");
                    const image = this.getAttribute("data-image");
                    if (image) {
                        document.getElementById("currentImagePreview" + id).src =
                            "{{ asset('images/') }}/" + image;
                        document.getElementById("currentImageContainer" + id).style.display =
                            "block";
                    } else {
                        document.getElementById("currentImageContainer" + id).style.display =
                        "none";
                    }
                    document.getElementById("newImageContainer" + id).style.display = "none";
                    document.getElementById("editFormBlog" + id).setAttribute("action", this
                        .getAttribute("data-action"));
                });
            });

            // Populate edit detail modals
            document.querySelectorAll(".edit-btn-detail").forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    document.getElementById("editDescription" + id).value = this.getAttribute(
                        "data-description");
                    document.getElementById("editFormDetail" + id).setAttribute("action", this
                        .getAttribute("data-action"));
                });
            });
        });

        // Handle file selection and preview
        function handleFileSelection(event, previewId, containerId = null) {
            const file = event.target.files[0];
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedType = "image/webp";
            const preview = document.getElementById(previewId);

            if (file) {
                if (file.type !== allowedType) {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid File Format!",
                        text: "Please upload only .webp images.",
                    });
                    event.target.value = "";
                    if (containerId) {
                        document.getElementById(containerId).style.display = "none";
                    } else {
                        preview.classList.add("d-none");
                    }
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: "error",
                        title: "File too large!",
                        text: "Please upload an image smaller than 5MB.",
                    });
                    event.target.value = "";
                    if (containerId) {
                        document.getElementById(containerId).style.display = "none";
                    } else {
                        preview.classList.add("d-none");
                    }
                    return;
                }

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
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm" + id).submit();
                }
            });
        }
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
@endsection
