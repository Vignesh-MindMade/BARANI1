@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; margin-bottom: 30px; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { background: linear-gradient(90deg, #007bff, #0056b3); color: #fff; border-radius: 25px; padding: 8px 20px; transition: all 0.3s ease; border: none; }
    .psg-p-btn:hover { background: linear-gradient(90deg, #0056b3, #003d80); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .img-preview { border-radius: 8px; border: 1px solid #ddd; max-width: 150px; max-height: 150px; object-fit: cover; transition: transform 0.2s ease; }
    .img-preview:hover { transform: scale(1.05); }
    .banner-preview-container { position: relative; display: inline-block; }
    .delete-banner-btn { position: absolute; top: -10px; right: -10px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; transition: all 0.3s ease; }
    .delete-banner-btn:hover { background: #c82333; transform: scale(1.1); }
    .form-label { font-weight: 600; color: #495057; }
    .required::after { content: ' *'; color: #dc3545; }
    .char-counter { font-size: 0.75rem; color: #6c757d; float: right; }
    .file-input-wrapper { position: relative; overflow: hidden; display: inline-block; }
    .file-input-wrapper input[type=file] { position: absolute; left: -9999px; }
    .file-input-label { background: #e9ecef; border: 2px dashed #adb5bd; border-radius: 8px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.3s ease; width: 100%; }
    .file-input-label:hover { background: #dee2e6; border-color: #007bff; }
    .file-input-label i { font-size: 2rem; color: #6c757d; margin-bottom: 10px; }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            <!-- Header -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0"><i class="fas fa-cogs text-primary me-2"></i> Blog Page Settings</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('testCurricular.index') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Blogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Page Settings</li>
                        </ol>
                    </nav>

                    
                
                 
                </div>
                
            </div>
                   <div class="col-md-6 text-end d-flex">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-2"></i> Create New Blog Post
                    </a>
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-list me-2"></i> Manage All Blogs
                    </a>
                </div>

            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Settings Form -->
            <form action="{{ route('blog.settings.update') }}" method="POST" enctype="multipart/form-data" id="blogSettingsForm">
                @csrf
                @method('PUT')

                <!-- Banner Section -->
                <div class="form-section">
                    <div class="form-header d-flex align-items-center">
                        <i class="fas fa-image text-primary me-2"></i>
                        <h5 class="mb-0">Banner Configuration</h5>
                    </div>

                    <div class="row">
                        <!-- Banner Image -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Banner Image</label>
                            
                            <!-- Current Image Preview -->
                            @if($settings && $settings->banner_image)
                            <div class="mb-3 banner-preview-container">
                                <img src="{{ asset('storage/' . $settings->banner_image) }}" alt="Current Banner" class="img-preview" id="currentBannerPreview">
                                <button type="button" class="delete-banner-btn" onclick="deleteBannerImage()" title="Remove Banner Image">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @else
                            <div class="mb-3 text-muted" id="noImageText">
                                <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                <small>No banner image uploaded</small>
                            </div>
                            @endif

                            <!-- New Image Preview -->
                            <div class="mb-3 d-none" id="newImagePreviewContainer">
                                <img src="" alt="New Banner Preview" class="img-preview" id="newBannerPreview">
                            </div>

                            <!-- File Input -->
                            <div class="file-input-wrapper">
                                <label for="banner_image" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt d-block"></i>
                                    <span>Click to upload new banner image</span>
                                    <small class="d-block text-muted mt-1">JPEG, PNG, JPG, GIF, SVG (Max: 2MB)</small>
                                </label>
                                <input type="file" name="banner_image" id="banner_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml" onchange="previewImage(this)">
                            </div>
                        </div>

                        <!-- Banner Title -->
                        <div class="col-md-6 mb-3">
                            <label for="banner_title" class="form-label required">Banner Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                <input type="text" 
                                       name="banner_title" 
                                       id="banner_title" 
                                       class="form-control @error('banner_title') is-invalid @enderror" 
                                       value="{{ old('banner_title', $settings->banner_title ?? '') }}" 
                                       placeholder="Enter banner title"
                                       maxlength="255"
                                       required>
                            </div>
                            @error('banner_title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="char-counter"><span id="bannerTitleCount">0</span>/255</small>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="form-section">
                    <div class="form-header d-flex align-items-center">
                        <i class="fas fa-align-left text-primary me-2"></i>
                        <h5 class="mb-0">Section Content</h5>
                    </div>

                    <div class="row">
                        <!-- Section Subtitle -->
                        <div class="col-md-6 mb-3">
                            <label for="section_subtitle" class="form-label">Section Subtitle</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                <input type="text" 
                                       name="section_subtitle" 
                                       id="section_subtitle" 
                                       class="form-control @error('section_subtitle') is-invalid @enderror" 
                                       value="{{ old('section_subtitle', $settings->section_subtitle ?? '') }}" 
                                       placeholder="Enter section subtitle"
                                       maxlength="255">
                            </div>
                            @error('section_subtitle')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="char-counter"><span id="subtitleCount">0</span>/255</small>
                        </div>

                        <!-- Section Title -->
                        <div class="col-md-6 mb-3">
                            <label for="section_title" class="form-label required">Section Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                <input type="text" 
                                       name="section_title" 
                                       id="section_title" 
                                       class="form-control @error('section_title') is-invalid @enderror" 
                                       value="{{ old('section_title', $settings->section_title ?? '') }}" 
                                       placeholder="Enter section title"
                                       maxlength="255"
                                       required>
                            </div>
                            @error('section_title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="char-counter"><span id="sectionTitleCount">0</span>/255</small>
                        </div>

                        <!-- Section Description -->
                        <div class="col-12 mb-3">
                            <label for="section_description" class="form-label">Section Description</label>
                            <textarea name="section_description" 
                                      id="section_description" 
                                      class="form-control @error('section_description') is-invalid @enderror" 
                                      rows="5" 
                                      placeholder="Enter section description...">{{ old('section_description', $settings->section_description ?? '') }}</textarea>
                            @error('section_description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-3">
                    <a href="{{ route('testCurricular.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                    <button type="submit" class="psg-p-btn">
                        <i class="fas fa-save me-2"></i>Update Settings
                    </button>
                </div>
            </form>

            <!-- Hidden Delete Form -->
            <form id="deleteBannerForm" action="{{ route('blog.settings.banner.destroy') }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Character counters
    function updateCharCount(inputId, counterId) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        if (input && counter) {
            counter.textContent = input.value.length;
            input.addEventListener('input', function() {
                counter.textContent = this.value.length;
            });
        }
    }

    updateCharCount('banner_title', 'bannerTitleCount');
    updateCharCount('section_subtitle', 'subtitleCount');
    updateCharCount('section_title', 'sectionTitleCount');

    // Image preview on file select
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const newPreview = document.getElementById('newBannerPreview');
                const newContainer = document.getElementById('newImagePreviewContainer');
                const currentPreview = document.getElementById('currentBannerPreview');
                const noImageText = document.getElementById('noImageText');
                
                newPreview.src = e.target.result;
                newContainer.classList.remove('d-none');
                
                // Hide current preview if exists
                if (currentPreview) {
                    currentPreview.parentElement.classList.add('d-none');
                }
                if (noImageText) {
                    noImageText.classList.add('d-none');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Delete banner image with SweetAlert confirmation
    function deleteBannerImage() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the banner image!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteBannerForm').submit();
            }
        });
    }

    // Form submission loading state
    document.getElementById('blogSettingsForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
    });
</script>
@endsection