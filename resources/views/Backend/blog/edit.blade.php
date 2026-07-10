@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

<style>
    .form-section { background: #f8f9fa; padding: 25px; border-radius: 12px; margin-bottom: 25px; }
    .current-file { background: #e9f7ef; padding: 12px; border-radius: 8px; }
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 15px; }
    .gallery-item { position: relative; border-radius: 8px; overflow: hidden; }
    .gallery-item img { width: 100%; height: 120px; object-fit: cover; }
    .remove-gallery-btn { 
        position: absolute; top: 8px; right: 8px; 
        background: #dc3545; color: white; border: none; 
        width: 28px; height: 28px; border-radius: 50%; 
        cursor: pointer;
    }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="py-4 px-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3><i class="fas fa-edit text-primary"></i> Edit Blog Post</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="editBlogForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">

                        <!-- Basic Information -->
                        <div class="form-section">
                            <h5>Basic Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" 
                                       value="{{ old('title', $blog->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" 
                                       value="{{ old('slug', $blog->slug) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="6">{{ old('description', $blog->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Content Type -->
                        <div class="form-section">
                            <h5>Content Type</h5>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input type="radio" name="type" value="pdf" class="form-check-input" 
                                               {{ old('type', $blog->type) == 'pdf' ? 'checked' : '' }} required>
                                        <span>PDF</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input type="radio" name="type" value="video" class="form-check-input" 
                                               {{ old('type', $blog->type) == 'video' ? 'checked' : '' }}>
                                        <span>Video</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input type="radio" name="type" value="gallery" class="form-check-input" 
                                               {{ old('type', $blog->type) == 'gallery' ? 'checked' : '' }}>
                                        <span>Gallery</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- PDF Section -->
                        <div class="form-section pdf-fields">
                            <h5>PDF File</h5>
                            @if($blog->pdf_file)
                                <div class="current-file mb-3">
                                    <strong>Current PDF:</strong> 
                                    <a href="{{ asset('storage/' . $blog->pdf_file) }}" target="_blank">
                                        {{ basename($blog->pdf_file) }}
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                            <small class="text-muted">Leave empty to keep current file</small>
                        </div>

                        <!-- Video Section -->
                        <div class="form-section video-fields">
                            <h5>Video</h5>
                        

                            <div class="mb-3">
                                <label>Video URL</label>
                                <input type="url" name="video_url" class="form-control" 
                                       value="{{ old('video_url', $blog->video_url) }}">
                            </div>

                            @if($blog->video_file)
                                <div class="current-file mb-3">
                                    <strong>Current Video:</strong> {{ basename($blog->video_file) }}
                                </div>
                            @endif
                            <input type="file" name="video_file" class="form-control" accept="video/*">
                            <small class="text-muted">Leave empty to keep current file</small>
                        </div>

                        <!-- Gallery Section -->
                        <div class="form-section gallery-fields">
                            <h5>Gallery Images</h5>
                            
                            @if($blog->images->count())
                                <div class="gallery-grid mb-4">
                                    @foreach($blog->images as $image)
                                        <div class="gallery-item">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="">
                                            <button type="button" class="remove-gallery-btn" 
                                                    onclick="deleteGalleryImage({{ $image->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted">Add more images (optional)</small>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="col-lg-4">

                        <!-- Thumbnail -->
                        <div class="form-section">
                            <h5>Thumbnail</h5>
                            @if($blog->thumbnail)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" 
                                         class="img-fluid rounded" style="max-height: 200px;" alt="Thumbnail">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <small class="text-muted">Leave empty to keep current thumbnail</small>
                        </div>

                        <!-- Publish Settings -->
                        <div class="form-section">
                            <h5>Publish Settings</h5>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $blog->status) ? 'selected' : '' }}>Published</option>
                                    <option value="0" {{ !old('status', $blog->status) ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Published At</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                       value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                            </div>

                            <div class="mb-3">
                                <label>Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" 
                                       value="{{ old('sort_order', $blog->sort_order) }}">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> Update Blog
                            </button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="button" onclick="deleteBlog()" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Blog
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Toggle fields based on type
document.querySelectorAll('input[name="type"]').forEach(radio => {
    radio.addEventListener('change', toggleFields);
});

function toggleFields() {
    const type = document.querySelector('input[name="type"]:checked').value;
    
    document.querySelectorAll('.pdf-fields, .video-fields, .gallery-fields').forEach(section => {
        section.style.display = 'none';
    });

    if (type === 'pdf') document.querySelector('.pdf-fields').style.display = 'block';
    if (type === 'video') document.querySelector('.video-fields').style.display = 'block';
    if (type === 'gallery') document.querySelector('.gallery-fields').style.display = 'block';
}

// Initial toggle
toggleFields();

// Delete single gallery image
function deleteGalleryImage(id) {
    Swal.fire({
        title: 'Delete Image?',
        icon: 'warning',
        showCancelButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            // You can create a separate route for deleting gallery image or handle via update
            window.location.href = `{{ url('/blogs/gallery-image') }}/${id}/delete`; // Optional route
        }
    });
}

// Delete entire blog
function deleteBlog() {
    Swal.fire({
        title: 'Delete this blog?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('blogs.destroy', $blog->id) }}`;
            form.innerHTML = `@csrf @method('DELETE')`;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Form loading state
document.getElementById('editBlogForm').addEventListener('submit', function() {
    const btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
});
</script>
@endsection