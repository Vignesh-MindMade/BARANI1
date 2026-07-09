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
    .img-preview:hover { transform: scale(1.02); }
    
    .type-card-box { border: 2px solid #e0e0e0; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white; }
    .type-card-box:hover { border-color: #007bff; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,123,255,0.15); }
    .type-card-box.selected { border-color: #007bff; background: #f0f7ff; box-shadow: 0 8px 20px rgba(0,123,255,0.2); }
    .type-card-box i { font-size: 32px; margin-bottom: 10px; }
    
    .type-section { display: none; }
    .type-section.active { display: block; animation: fadeIn 0.3s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    .gallery-preview { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
    .gallery-preview-item { position: relative; width: 120px; height: 90px; border-radius: 8px; overflow: hidden; border: 2px solid #dee2e6; }
    .gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; }
    .gallery-preview-item .remove-btn { position: absolute; top: 4px; right: 4px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 2; }
    
    .video-toggle-btn { border-radius: 25px; padding: 6px 20px; border: 2px solid #dee2e6; background: white; color: #666; transition: all 0.3s; }
    .video-toggle-btn.active { background: #007bff; color: white; border-color: #007bff; }
    
    .file-hint { font-size: 11px; color: #888; margin-top: 4px; }
    .section-label { font-weight: 600; color: #1a3a5c; margin-bottom: 12px; display: block; }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            {{-- Header --}}
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0"><i class="fas fa-plus-circle text-primary me-2"></i> Create New Blog</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}" class="text-decoration-none">Blogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form action="{{ route('blogs-admin.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf

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
                                    <div class="file-hint">Recommended: 1920×400px</div>
                                    @error('banner_image')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                    <div id="bannerPreviewContainer" class="mt-2" style="display: none;">
                                        <img id="bannerPreview" src="" class="img-preview" style="width: 100%; height: 120px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Banner Title</label>
                                    <input type="text" name="banner_title" class="form-control" placeholder="Our Blogs" value="{{ old('banner_title') }}">
                                    @error('banner_title')<span class="text-danger" style="font-size: 12px;">{{ $message }}</span>@enderror
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
                                    <input type="text" name="section1_subtitle" class="form-control" placeholder="LATEST UPDATES" value="{{ old('section1_subtitle') }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="section1_title" class="form-control" placeholder="Industrial Knowledge & Insights" value="{{ old('section1_title') }}">
                                    @error('section1_title')<span class="text-danger" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="section1_description" class="form-control" rows="2" placeholder="Explore our latest blogs...">{{ old('section1_description') }}</textarea>
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
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                                    @error('title')<span class="text-danger" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Card Thumbnail</label>
                                    <input type="file" name="card_thumbnail" class="form-control" id="cardThumbnail" accept="image/*" onchange="previewImage(this, 'cardPreview')">
                                    <div class="file-hint">Recommended: 600×400px</div>
                                    @error('card_thumbnail')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-12">
                                    <div id="cardPreviewContainer" class="mb-2" style="display: none;">
                                        <img id="cardPreview" src="" class="img-preview" style="width: 200px; height: 130px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Card Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Short description shown on the card...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Content Type --}}
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-layer-group me-2"></i> Content Type</h5>
                            </div>

                            {{-- Type Selector Cards --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="type-card-box {{ old('type') == 'pdf' ? 'selected' : '' }}" onclick="selectType('pdf')" id="typeCard-pdf">
                                        <i class="fas fa-file-pdf text-danger"></i>
                                        <h6 class="mb-1">PDF Document</h6>
                                        <small class="text-muted">Upload a PDF file</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="type-card-box {{ old('type') == 'video' ? 'selected' : '' }}" onclick="selectType('video')" id="typeCard-video">
                                        <i class="fas fa-video text-primary"></i>
                                        <h6 class="mb-1">Video</h6>
                                        <small class="text-muted">Upload or embed</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="type-card-box {{ old('type') == 'image' ? 'selected' : '' }}" onclick="selectType('image')" id="typeCard-image">
                                        <i class="fas fa-images text-success"></i>
                                        <h6 class="mb-1">Image Gallery</h6>
                                        <small class="text-muted">Multiple images with slider</small>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="type" id="selectedType" value="{{ old('type', 'pdf') }}">
                            @error('type')<span class="text-danger d-block mb-3" style="font-size: 12px;">{{ $message }}</span>@enderror

                            {{-- PDF Section --}}
                            <div id="pdfSection" class="type-section {{ old('type', 'pdf') == 'pdf' ? 'active' : '' }}">
                                <label class="section-label"><i class="fas fa-file-pdf me-2 text-danger"></i>PDF File <span class="text-danger">*</span></label>
                                <input type="file" name="pdf_file" class="form-control" id="pdfFile" accept=".pdf">
                                <div class="file-hint">Max file size: 10MB</div>
                                @error('pdf_file')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                            </div>

                            {{-- Video Section --}}
                            <div id="videoSection" class="type-section {{ old('type') == 'video' ? 'active' : '' }}">
                                <label class="section-label"><i class="fas fa-video me-2 text-primary"></i>Video Settings</label>
                                
                                <div class="mb-3">
                                    <div class="btn-group">
                                        <button type="button" class="video-toggle-btn {{ old('video_source', 'upload') == 'upload' ? 'active' : '' }}" onclick="selectVideoSource('upload')">
                                            <i class="fas fa-upload me-1"></i> Upload File
                                        </button>
                                        <button type="button" class="video-toggle-btn {{ old('video_source') == 'link' ? 'active' : '' }}" onclick="selectVideoSource('link')">
                                            <i class="fas fa-link me-1"></i> External Link
                                        </button>
                                    </div>
                                    <input type="hidden" name="video_source" id="videoSource" value="{{ old('video_source', 'upload') }}">
                                </div>

                                <div id="videoUploadSection" class="{{ old('video_source', 'upload') != 'link' ? '' : 'd-none' }}">
                                    <label class="form-label">Video File <span class="text-danger">*</span></label>
                                    <input type="file" name="video_file" class="form-control" id="videoFile" accept="video/*">
                                    <div class="file-hint">Supported: MP4, WebM, OGG, MOV. Max: 100MB</div>
                                    @error('video_file')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>

                                <div id="videoLinkSection" class="{{ old('video_source') == 'link' ? '' : 'd-none' }}">
                                    <label class="form-label">Video URL <span class="text-danger">*</span></label>
                                    <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}">
                                    <div class="file-hint">YouTube, Vimeo, or direct video URL</div>
                                    @error('video_url')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Video Thumbnail (Optional)</label>
                                    <input type="file" name="video_thumbnail" class="form-control" accept="image/*">
                                    <div class="file-hint">Shown before video plays. Defaults to card thumbnail.</div>
                                </div>
                            </div>

                            {{-- Image Gallery Section --}}
                            <div id="imageSection" class="type-section {{ old('type') == 'image' ? 'active' : '' }}">
                                <label class="section-label"><i class="fas fa-images me-2 text-success"></i>Gallery Images <span class="text-danger">*</span></label>
                                <input type="file" name="gallery_images[]" class="form-control" id="galleryImages" multiple accept="image/*" onchange="previewGallery(this)">
                                <div class="file-hint">Select multiple images. Max 5MB each.</div>
                                @error('gallery_images')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                @error('gallery_images.*')<span class="text-danger d-block" style="font-size: 12px;">{{ $message }}</span>@enderror
                                <div id="galleryPreview" class="gallery-preview"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Settings --}}
                    <div class="col-lg-4">
                        <div class="form-section" style="position: sticky; top: 20px;">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-cog me-2"></i> Settings</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" name="published_date" class="form-control" value="{{ old('published_date', now()->format('Y-m-d')) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                                    <div class="file-hint">Lower numbers appear first</div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">Active</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn psg-p-btn w-100">
                                        <i class="fas fa-save me-2"></i> Create Blog
                                    </button>
                                    <a href="{{ route('blogs-admin.index') }}" class="btn psg-s-btn w-100 mt-2">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                </div>
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
    // Type selection
    function selectType(type) {
        document.querySelectorAll('.type-card-box').forEach(card => card.classList.remove('selected'));
        document.getElementById('typeCard-' + type).classList.add('selected');
        document.getElementById('selectedType').value = type;
        
        document.querySelectorAll('.type-section').forEach(s => s.classList.remove('active'));
        document.getElementById(type + 'Section').classList.add('active');
    }

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

    // Gallery preview
    function previewGallery(input) {
        const container = document.getElementById('galleryPreview');
        container.innerHTML = '';
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

    // Form validation
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        const type = document.getElementById('selectedType').value;
        
        if (type === 'pdf') {
            const pdfFile = document.getElementById('pdfFile');
            if (!pdfFile.files.length) {
                e.preventDefault();
                Swal.fire({icon: 'error', title: 'Required', text: 'Please select a PDF file.'});
                return false;
            }
        }
        
        if (type === 'video') {
            const source = document.getElementById('videoSource').value;
            if (source === 'upload') {
                const videoFile = document.getElementById('videoFile');
                if (!videoFile.files.length) {
                    e.preventDefault();
                    Swal.fire({icon: 'error', title: 'Required', text: 'Please select a video file.'});
                    return false;
                }
            } else {
                const videoUrl = document.querySelector('input[name="video_url"]');
                if (!videoUrl.value.trim()) {
                    e.preventDefault();
                    Swal.fire({icon: 'error', title: 'Required', text: 'Please enter a video URL.'});
                    return false;
                }
            }
        }
        
        if (type === 'image') {
            const galleryImages = document.getElementById('galleryImages');
            if (!galleryImages.files.length) {
                e.preventDefault();
                Swal.fire({icon: 'error', title: 'Required', text: 'Please select at least one gallery image.'});
                return false;
            }
        }
    });

    // Initialize
    selectType('{{ old('type', 'pdf') }}');
</script>
@endsection