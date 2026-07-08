@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bootstrap-tagsinput/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

<style>
.page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
.page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
.banner-manager-container { max-width: 1400px; margin: auto; }
.section-divider { border-top: 1px solid #e0e0e0; margin: 20px 0; }
.form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; }
.form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
.psg-p-btn { background: linear-gradient(90deg, #007bff, #0056b3); color: #fff; padding: 10px 20px; border-radius: 25px; transition: all 0.3s ease; }
.psg-p-btn:hover { background: linear-gradient(90deg, #0056b3, #003d80); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
.img-preview { border-radius: 8px; border: 1px solid #ddd; max-width: 120px; max-height: 120px; object-fit: cover; transition: transform 0.2s ease; }
.img-preview:hover { transform: scale(1.05); }
.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.quick-link-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    text-decoration: none;
    color: #0f172a;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: all 0.25s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.03);
}

.quick-link-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    border-color: #c7d2fe;
}

.quick-link-icon {
    font-size: 26px;
    background: #eef2ff;
    width: 46px;
    height: 46px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1e3a8a;
}

.quick-link-title {
    font-size: 18px;
    font-weight: 600;
    margin: 6px 0 0;
}

.quick-link-desc {
    font-size: 14px;
    color: #6b7280;
    margin: 0 0 12px;
}

.quick-link-btn {
    margin-top: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #0b1f66;
    color: #ffffff;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.25s ease;
}

.quick-link-card:hover .quick-link-btn {
    background: #102a8c;
}

</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            <!-- Header -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">
                        <i class="fas fa-hand-holding-heart text-primary me-2"></i> Sustainability Social
                    </h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="psg-p-btn" onclick="toggleSocialForm()">
                        <i class="fas fa-plus-circle me-2"></i> Add Social Content
                    </button>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- Create Form -->
            <div class="row mt-4" id="socialForm" style="display:none;">
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Create Social Content</h5>
                        </div>

                                <div class="col-md-3">
                                    <label class="form-label">Main Title</label>
                                    <input type="text" class="form-control" name="main_title" placeholder="Optional main title" value="{{ old('main_title') }}">
                                </div>
                        <form action="{{ route('sustainability.social.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label class="form-label">Sort ID</label>
                                    <input type="number" class="form-control" name="sort_id" placeholder="Order number" value="{{ old('sort_id') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Main Title</label>
                                    <input type="text" class="form-control" name="main_title" placeholder="Optional main title" value="{{ old('main_title') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter section title" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" onchange="validateAndPreview(event,'createPreview')">
                                    <small class="text-muted">Max 5 MB — JPG / JPEG / WEBP</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="createPreview" src="" class="img-preview w-100" style="display:none;">
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary psg-p-btn mt-3">
                                        <i class="fas fa-save me-1"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-black"><i class="fas fa-list me-2"></i> Social Content List</h5>
                            <button class="btn btn-outline-light btn-sm" onclick="toggleSocialForm()">
                                <i class="fas fa-plus me-1"></i> Add New
                            </button>
                        </div>

                        <div class="card-body">
                            @forelse($socials as $item)
                                <div class="form-section mb-4">
                                    <form action="{{ route('sustainability.social.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row g-4 align-items-start">
                                            <div class="col-md-2">
                                                <label class="form-label">Sort ID <span class="text-thin">(Lower the number appears first)</span></label>
                                                <input type="number" class="form-control" name="sort_id" value="{{ $item->sort_id }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Main Title</label>
                                                <input type="text" class="form-control" name="main_title" value="{{ $item->main_title }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $item->title }}" required>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{ $item->description }}</textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*" onchange="validateAndPreview(event,'socialPreview{{ $item->id }}')">
                                                <small class="text-muted">Leave blank to keep current</small>
                                                <div class="image-preview-container mt-2">
                                                    <img id="socialPreview{{ $item->id }}" src="{{ asset('frontend/imgs/sus/'.$item->image) }}" class="img-preview w-100">
                                                </div>
                                            </div>

                                            <div class="col-12 text-end mt-3">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="fas fa-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <p class="text-center py-3 mb-0">No social content found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


           <div class="quick-links-grid">

    <a href="{{ route('sustainability.certificates.index') }}" class="quick-link-card">
        <div class="quick-link-icon">📄</div>
        <h4 class="quick-link-title">Certificates</h4>
        <p class="quick-link-desc">Upload and manage certificates.</p>
        <span class="quick-link-btn">Go to Certificates →</span>
    </a>

    <a href="{{ route('sustainability.governance.index') }}" class="quick-link-card">
        <div class="quick-link-icon">🏛️</div>
        <h4 class="quick-link-title">Governance</h4>
        <p class="quick-link-desc">Return to governance section.</p>
        <span class="quick-link-btn">← Back to Governance</span>
    </a>

    <a href="{{ route('sustainability.backend') }}" class="quick-link-card">
        <div class="quick-link-icon">⬅️</div>
        <h4 class="quick-link-title">Back</h4>
        <p class="quick-link-desc">Return to sustainability index.</p>
        <span class="quick-link-btn">← Back to Index</span>
    </a>

</div>

    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bootstrap-tagsinput/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

<script>
function toggleSocialForm() {
    $('#socialForm').slideToggle(300);
}

// Preview uploaded image
function validateAndPreview(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    const max = 5 * 1024 * 1024;
    if (file && file.size > max) {
        Swal.fire({ icon: 'error', title: 'File too large', text: 'Maximum size: 5 MB' });
        event.target.value = '';
        return;
    }
    if (file && preview) {
        const reader = new FileReader();
        reader.onload = () => { preview.src = reader.result; preview.style.display = 'block'; };
        reader.readAsDataURL(file);
    }
}

// Delete confirmation
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This item will be deleted permanently.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then(result => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('sustainability.social.destroy', '') }}/${id}`;

            const token = document.createElement('input');
            token.type = 'hidden'; token.name = '_token'; token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            const method = document.createElement('input');
            method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection
