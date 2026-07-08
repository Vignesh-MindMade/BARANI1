@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
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
    .modal-title {
    font-size: 24px;
    color: white;
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
    #careerTable {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        width: 100%;
    }
    #careerTable thead th {
        background: #1e3556;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 15px;
        border: none;
        font-size: 0.9rem;
    }
    #careerTable tbody tr {
        transition: all 0.3s ease;
        background: white;
    }
    #careerTable tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }
    #careerTable tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
        color: #333;
    }
    #careerTable tbody tr:last-child td {
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
    .career-name {
        font-weight: 600;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .career-icon {
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
    .cancel-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 30px;
        background: #6c757d;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        font-size: 1rem;
        border: none;
        cursor: pointer;
        margin-right: 10px;
    }
    .cancel-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.5);
        color: white;
    }
    .offer-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 30px;
        background: #007bff;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        font-size: 1rem;
        border: none;
        cursor: pointer;
        margin: 20px 0;
    }
    .offer-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.5);
        color: white;
        text-decoration: none;
    }
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
        background: white;
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
        background: white;
        color: #333;
    }
    .modal-footer {
        background: transparent;
        border-top: none;
        padding: 20px 30px 30px;
        background: white;
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
        .career-icon {
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
    
    .toggle-btn, .offer-btn {
    width: 100%;
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
                                <li class="breadcrumb-item"><a href="{{ route('career.index') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Careers Page Management</li>
                            </ol>
                        </nav>
                        <h2>
                            <i class="fas fa-briefcase" style="font-size: 80%;"></i> Careers Page Management
                        </h2>
                    </div>
                </div>
            </div>
            

<div class="row text-center">
    <div class="col-md-3 col-2">
        <button class="toggle-btn" onclick="toggleContentCareer()">
            <i class="fas fa-plus"></i> Add Career
        </button>
    </div>

    <div class="col-md-3 col-2">
        <button class="offer-btn" data-bs-toggle="modal" data-bs-target="#bannerModal">
            <i class="fas fa-image"></i> Upload Banner
        </button>
    </div>

    <div class="col-md-3 col-2">
        <a href="{{ route('organization.detail') }}" class="offer-btn">
            <i class="fas fa-gift"></i> What We Offer
        </a>
    </div>
</div>

            <!-- Add New Career Section -->
            <div class="row" id="careerContent" style="display: none;">
                <div class="col-12">
                    <div class="page-box">
                        <form action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Job Title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="job_title" required />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Categories <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="categories" required />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Location <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="location" required />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Posted At <span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" name="posted_at" required />
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="form-label">Description <span style="color: red;">*</span></label>
                                    <textarea class="form-control" name="description" rows="5" required></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="form-label">Minimum Age Rules Points (comma-separated) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control tagsinput" name="minimum_age_rules_points" data-role="tagsinput" required value="{{ old('minimum_age_rules_points') }}">
                                    @error('minimum_age_rules_points')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" class="cancel-btn" onclick="toggleContentCareer()"><i class="fas fa-times"></i> Cancel</button>
                                    <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Career</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-box">
                        <div class="table-responsive">
                            <table id="careerTable" class="table table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th>Job Title</th>
                                        <th style="width: 150px;">Categories</th>
                                        <th style="width: 120px;">Location</th>
                                        <th style="width: 120px;">Posted At</th>
                                        <th class="text-center" style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careers as $career)
                                        <tr>
                                            <td class="text-center">
                                                <span class="serial-number">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <div class="career-name">
                                                    <span class="career-icon">
                                                        <i class="fas fa-briefcase"></i>
                                                    </span>
                                                    <span>{{ $career->job_title }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $career->categories }}
                                            </td>
                                            <td class="text-center">
                                                {{ $career->location }}
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($career->posted_at)->format('M d, Y') }}
                                            </td>
                                            <td class="text-center">
                                               
                                                  <button class="btn btn-sm btn-outline-primary me-2" style="display: inline-flex;
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
        cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editModal{{ $career->id }}">
                                                        <i class="fas fa-edit"></i>Edit
                                                    </button>
                                                <form action="{{ route('career.delete', $career->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="margin: 0px 4px;" class="delete-btn" onclick="return confirm('Are you sure you want to delete this career?')">
                                                        <i class="fas fa-trash"></i> Delete
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
            
            
            
            <!-- Edit Modals (Moved outside the table for proper rendering) -->
            @foreach ($careers as $career)
                                                       <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $career->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $career->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title" id="editModalLabel{{ $career->id }}">
                                                            <i class="fas fa-edit me-2"></i> Edit Career
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form action="{{ route('career.update', $career->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-4">
                                                                <!-- Job Title -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Job Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="job_title" value="{{ $career->job_title }}" required />
                                                                </div>

                                                                <!-- Categories -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Categories <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="categories" value="{{ $career->categories }}" required />
                                                                </div>

                                                                <!-- Location -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Location <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="location" value="{{ $career->location }}" required />
                                                                </div>

                                                                <!-- Posted At -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Posted At <span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control" name="posted_at" value="{{ \Carbon\Carbon::parse($career->posted_at)->format('Y-m-d') }}" required />
                                                                </div>

                                                                <!-- Banner Image -->
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Banner Image</label>
                                                                    <input type="file" class="form-control" name="banner_image" accept="image/*" />
                                                                    @if(!empty($career->banner_image))
                                                                        <small class="text-muted">Current: <a href="{{ asset($career->banner_image) }}" target="_blank">View</a></small>
                                                                    @endif
                                                                </div>

                                                                <!-- Description -->
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="description" rows="5" required>{{ $career->description }}</textarea>
                                                                </div>

                                                                <!-- Minimum Age Rules Points -->
                                                                <div class="col-md-12">
                                                                     <label class="form-label">
                                                                            <i class="fas fa-list-ul me-2"></i>Minimum Skill Requirement (comma-separated)
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        <br>
                                                                        <input type="text" class="form-control tagsinput"
                                                                            name="minimum_age_rules_points"
                                                                            data-role="tagsinput"
                                                                            value="{{ old('minimum_age_rules_points', $career->minimum_age_rules_points ?? '') }}"
                                                                            required>
                                                                        @error('minimum_age_rules_points')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i> Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save me-1"></i> Save Changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

            @endforeach
            
            
            

        </div>
    </div>
</div>

<!-- Banner Upload Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bannerModalLabel">Upload Careers Page Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('career.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Current Banner Image</label>
                        @if(!empty($banner?->banner_image))
                            <div class="mb-3">
                                <img src="{{ asset($banner->banner_image) }}" alt="Current Careers Banner" class="img-fluid" style="max-height: 200px; object-fit: contain; border: 1px solid #e2e8f0; border-radius: 8px;" />
                            </div>
                        @else
                            <div class="mb-3 text-muted">No active banner yet.</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload New Banner Image</label>
                        <input type="file" class="form-control" name="banner_image" accept="image/*" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
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
    $(document).ready(function () {
        $("#careerTable").DataTable({
            "pageLength": 5,
            "language": {
                "search": "Search careers:",
                "lengthMenu": "Show _MENU_ careers",
                "info": "Showing _START_ to _END_ of _TOTAL_ careers",
                "paginate": {
                    "previous": "← Previous",
                    "next": "Next →"
                }
            }
        });
    });
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
    $(document).on('shown.bs.modal', function (e) {
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
@endsection