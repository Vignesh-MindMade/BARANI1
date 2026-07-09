@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; margin-bottom: 30px; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { background: linear-gradient(90deg, #007bff, #0056b3); color: #fff; border-radius: 25px; padding: 8px 20px; transition: all 0.3s ease; border: none; }
    .psg-p-btn:hover { background: linear-gradient(90deg, #0056b3, #003d80); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .psg-s-btn { background: #6c757d; color: #fff; border-radius: 25px; padding: 8px 20px; transition: all 0.3s ease; border: none; }
    .psg-s-btn:hover { background: #5a6268; transform: translateY(-2px); }
    .img-preview { border-radius: 8px; border: 1px solid #ddd; max-width: 100%; object-fit: cover; transition: transform 0.2s ease; }
    
    .type-section { display: none; }
    .type-section.active { display: block; }
    
    .gallery-preview { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
    .gallery-preview-item { position: relative; width: 120px; height: 90px; border-radius: 8px; overflow: hidden; border: 2px solid #dee2e6; }
    .gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; }
    .gallery-preview-item .remove-btn { position: absolute; top: 4px; right: 4px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 2; transition: all 0.2s; }
    .gallery-preview-item.existing { border-color: #28a745; }
    .gallery-preview-item.removed { opacity: 0.3; border-color: #dc3545; }
    .gallery-preview-item.removed .remove-btn { background: #28a745; }
    
    .video-toggle-btn { border-radius: 25px; padding: 6px 20px; border: 2px solid #dee2e6; background: white; color: #666; transition: all 0.3s; }
    .video-toggle-btn.active { background: #007bff; color: white; border-color: #007bff; }
    
    .file-info-box { background: #e8f4fd; border-left: 3px solid #007bff; padding: 8px 12px; border-radius: 4px; margin-top: 8px; font-size: 12px; }
    .file-info-box a { color: #007bff; text-decoration: none; font-weight: 500; }
    .file-info-box a:hover { text-decoration: underline; }
    
    .preview-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
    .preview-card .preview-img { position: relative; height: 160px; overflow: hidden; }
    .preview-card .preview-img img { width: 100%; height: 100%; object-fit: cover; }
    .preview-card .preview-badge { position: absolute; bottom: 8px; left: 8px; color: white; padding: 3px 12px; border-radius: 20px; font-size: 11px; font-weight: 500; }
    .preview-card .preview-body { padding: 14px; }
    .section-label { font-weight: 600; color: #1a3a5c; margin-bottom: 12px; display: block; }
    .file-hint { font-size: 11px; color: #888; margin-top: 4px; }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            {{-- Header --}}
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0"><i class="fas fa-edit text-primary me-2"></i> Edit Blog #{{ $blog->id }}</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blogs-admin.index') }}" class="text-decoration-none">Blogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form action="{{ route('blogs-admin.update', $blog) }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="deleted_image_ids" id="deletedImageIds" value="">

                <div class="row">
                    {{-- Left Column --}}
                    <div class="col-lg-8">

                        {{-- Page Banner --}}
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-image me-2"></i> Page Banner</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control" id="bannerImage" accept="image/*" onchange="previewImage(this, 'bannerPreview')">
                                    @if($blog->banner_image)
                                        <div class="file-info-box">
                                            <i class="fas fa-check-circle text-success me-1"></i>
                                            Current: <a href="{{ asset('storage/' . $blog->banner_image) }}" target="_blank">View Image</a>
                                        </div>
                                    @endif
                                    @error('banner_image')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                    <div id="bannerPreviewContainer" class="mt-2" style="{{ $blog->banner_image ? '' : 'display: none;' }}">
                                        <img id="bannerPreview" src="{{ $blog->banner_image ? asset('storage/' . $blog->banner_image) : '' }}" class="img-preview" style="width: 100%; height: 120px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Banner Title</label>
                                    <input type="text" name="banner_title" class="form-control" value="{{ old('banner_title', $blog->banner_title) }}">
                                </div>
                            </div>
                        </div>

                        {{-- Section Header --}}
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-heading me-2"></i> Section Header</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="section1_subtitle" class="form-control" value="{{ old('section1_subtitle', $blog->section1_subtitle) }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="section1_title" class="form-control" value="{{ old('section1_title', $blog->section1_title) }}">
                                    @error('section1_title')<span class="text-danger" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="section1_description" class="form-control" rows="2">{{ old('section1_description', $blog->section1_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-newspaper me-2"></i> Card Content</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Card Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                                    @error('title')<span class="text-danger" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Card Thumbnail</label>
                                    <input type="file" name="card_thumbnail" class="form-control" id="cardThumbnail" accept="image/*" onchange="previewImage(this, 'cardPreview')">
                                    @error('card_thumbnail')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-12">
                                    <div id="cardPreviewContainer" class="mb-2">
                                        <img id="cardPreview" src="{{ $blog->thumbnail_url }}" class="img-preview" style="width: 200px; height: 130px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Card Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $blog->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Content Type (Locked) --}}
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-layer-group me-2"></i> Content Type</h5>
                            </div>

                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-lock me-2"></i>
                                <div>
                                    Content type is <strong class="text-uppercase">{{ $blog->type }}</strong>. Type cannot be changed after creation.
                                </div>
                                <input type="hidden" name="type" value="{{ $blog->type }}">
                            </div>

                            {{-- PDF Section --}}
                            @if($blog->type === 'pdf')
                                <div class="type-section active">
                                    <label class="section-label"><i class="fas fa-file-pdf me-2 text-danger"></i>PDF File</label>
                                    <input type="file" name="pdf_file" class="form-control" id="pdfFile" accept=".pdf">
                                    @if($blog->pdf_file)
                                        <div class="file-info-box">
                                            <i class="fas fa-file-pdf text-danger me-1"></i>
                                            Current: <a href="{{ route('blogs.pdf.view', $blog) }}" target="_blank">{{ basename($blog->pdf_file) }}</a>
                                            @php
                                                $pdfPath = storage_path('app/public/' . $blog->pdf_file);
                                                $pdfSize = file_exists($pdfPath) ? round(filesize($pdfPath) / 1024) : 0;
                                            @endphp
                                            ({{ $pdfSize }} KB)
                                        </div>
                                    @endif
                                    @error('pdf_file')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                            @endif

                            {{-- Video Section --}}
                            @if($blog->type === 'video')
                                <div class="type-section active">
                                    <label class="section-label"><i class="fas fa-video me-2 text-primary"></i>Video Settings</label>
                                    
                                    <div class="mb-3">
                                        <div class="btn-group">
                                            <button type="button" class="video-toggle-btn {{ $blog->video_source == 'upload' ? 'active' : '' }}" onclick="selectVideoSource('upload')">
                                                <i class="fas fa-upload me-1"></i> Upload File
                                            </button>
                                            <button type="button" class="video-toggle-btn {{ $blog->video_source == 'link' ? 'active' : '' }}" onclick="selectVideoSource('link')">
                                                <i class="fas fa-link me-1"></i> External Link
                                            </button>
                                        </div>
                                        <input type="hidden" name="video_source" id="videoSource" value="{{ old('video_source', $blog->video_source) }}">
                                    </div>

                                    <div id="videoUploadSection" class="{{ $blog->video_source != 'link' ? '' : 'd-none' }}">
                                        <label class="form-label">Video File</label>
                                        <input type="file" name="video_file" class="form-control" id="videoFile" accept="video/*">
                                        @if($blog->video_file)
                                            <div class="file-info-box">
                                                <i class="fas fa-video text-primary me-1"></i>
                                                Current: <a href="{{ asset('storage/' . $blog->video_file) }}" target="_blank">{{ basename($blog->video_file) }}</a>
                                            </div>
                                        @endif
                                        @error('video_file')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                    </div>

                                    <div id="videoLinkSection" class="{{ $blog->video_source == 'link' ? '' : 'd-none' }}">
                                        <label class="form-label">Video URL</label>
                                        <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $blog->video_url) }}">
                                        @error('video_url')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Video Thumbnail (Optional)</label>
                                        <input type="file" name="video_thumbnail" class="form-control" accept="image/*">
                                        @if($blog->video_thumbnail)
                                            <div class="file-info-box">
                                                <i class="fas fa-image text-success me-1"></i> Custom thumbnail is set
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Image Gallery Section --}}
                            @if($blog->type === 'image')
                                <div class="type-section active">
                                    <label class="section-label"><i class="fas fa-images me-2 text-success"></i>Image Gallery</label>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Add New Images</label>
                                        <input type="file" name="gallery_images[]" class="form-control" id="galleryImages" multiple accept="image/*" onchange="previewNewGallery(this)">
                                        @error('gallery_images.*')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Current Gallery <span class="badge bg-info">{{ $blog->images->count() }}</span></label>
                                        <div id="galleryPreview" class="gallery-preview">
                                            @foreach($blog->images as $image)
                                                <div class="gallery-preview-item existing" data-id="{{ $image->id }}">
                                                    <img src="{{ $image->image_url }}" alt="{{ $image->caption }}">
                                                    <button type="button" class="remove-btn" onclick="toggleImageDelete({{ $image->id }}, this)" title="Remove">×</button>
                                                    @if($image->caption)
                                                        <small style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; font-size: 10px; padding: 2px 4px; text-align: center;">{{ Str::limit($image->caption, 15) }}</small>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="file-hint mt-2"><i class="fas fa-info-circle me-1"></i> Click × to mark for removal. Save to confirm.</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="col-lg-4">
                        <div class="form-section" style="position: sticky; top: 20px;">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-cog me-2"></i> Settings</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" name="published_date" class="form-control" value="{{ old('published_date', $blog->published_date?->format('Y-m-d')) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $blog->sort_order) }}" min="0">
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">Active</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn psg-p-btn w-100">
                                        <i class="fas fa-save me-2"></i> Update Blog
                                    </button>
                                    <a href="{{ route('blogs-admin.index') }}" class="btn psg-s-btn w-100 mt-2">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Live Preview Card --}}
                        <div class="form-section" style="background: white;">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-eye me-2"></i> Live Preview</h5>
                            </div>
                            <div class="preview-card">
                                <div class="preview-img">
                                    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}">
                                    <span class="preview-badge" style="background: {{ $blog->type_badge_color }};">
                                        {{ $blog->type_label }}
                                    </span>
                                </div>
                                <div class="preview-body">
                                    <div style="font-size: 11px; color: #888; margin-bottom: 4px;">
                                        {{ $blog->published_date?->format('d F Y') ?? 'No Date' }}
                                    </div>
                                    <h6 style="font-size: 13px; color: #1a3a5c; margin-bottom: 6px; font-weight: 600;">
                                        {{ Str::limit($blog->title, 40) }}
                                    </h6>
                                    <p style="font-size: 11px; color: #666; line-height: 1.4; margin: 0;">
                                        {{ Str::limit($blog->description, 80) }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('blogs-admin.index') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i> View on Site
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>

<script>
    // Video source toggle
    function selectVideoSource(source) {
        document.querySelectorAll('.video-toggle-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        document.getElementById('videoSource').value = source;
        
        document.getElementById('videoUploadSection').classList.toggle('d-none', source !== 'upload');
        document.getElementById('videoLinkSection').classList.toggle('d-none', source !== 'link');
    }

    // Image preview
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const container = document.getElementById(previewId + 'Container');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Toggle image delete (with undo)
    let deletedIds = [];
    function toggleImageDelete(id, btn) {
        const item = btn.parentElement;
        if (item.classList.contains('removed')) {
            // Undo
            deletedIds = deletedIds.filter(i => i != id);
            item.classList.remove('removed');
            btn.innerHTML = '×';
            btn.title = 'Remove';
        } else {
            // Mark for deletion
            deletedIds.push(id);
            item.classList.add('removed');
            btn.innerHTML = '↺';
            btn.title = 'Undo';
        }
        document.getElementById('deletedImageIds').value = deletedIds.join(',');
    }

    // Preview new gallery images
    function previewNewGallery(input) {
        const container = document.getElementById('galleryPreview');
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'gallery-preview-item';
                div.innerHTML = `<img src="${e.target.result}"><button type="button" class="remove-btn" onclick="this.parentElement.remove()">×</button>`;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection