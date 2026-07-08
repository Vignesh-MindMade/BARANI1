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
    .banner-manager-container { max-width: 1400px; margin: auto; }
    .section-divider { border-top: 1px solid #e0e0e0; margin: 20px 0; }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { 
        background: linear-gradient(90deg, #007bff, #0056b3); 
        color: #fff; 
        padding: 10px 20px; 
        border-radius: 25px; 
        transition: all 0.3s ease; 
    }
    .psg-p-btn:hover { 
        background: linear-gradient(90deg, #0056b3, #003d80); 
        transform: translateY(-2px); 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); 
    }
    .card { border: none; border-radius: 10px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05); }
    .card-header { background: #007bff; color: #fff; border-radius: 10px 10px 0 0; }
    .table-responsive { border-radius: 10px; overflow: hidden; }
    .table th, .table td { vertical-align: middle; }
    .img-preview { 
        border-radius: 8px; 
        border: 1px solid #ddd; 
        max-width: 120px; 
        max-height: 120px; 
        object-fit: cover; 
        transition: transform 0.2s ease; 
    }
    .img-preview:hover { transform: scale(1.05); }
    .modal-content { 
        border-radius: 15px; 
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2); 
        animation: slideIn 0.3s ease; 
    }
    .modal-header { 
        background: linear-gradient(90deg, #f1f3f5, #e9ecef); 
        border-bottom: none; 
        padding: 20px; 
    }
    .modal-title { font-size: 1.5rem; font-weight: 600; color: #1a1a1a; }
    .modal-body { padding: 30px; }
    .modal-footer { 
        border-top: none; 
        padding: 20px; 
        background: #f9fafb; 
        border-radius: 0 0 15px 15px; 
    }
    .btn-outline-primary { 
        border-color: #007bff; 
        color: #007bff; 
        transition: all 0.3s ease; 
    }
    .btn-outline-primary:hover { 
        background: #007bff; 
        color: #fff; 
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3); 
    }
    .btn-outline-danger { 
        border-color: #dc3545; 
        color: #dc3545; 
        transition: all 0.3s ease; 
    }
    .btn-outline-danger:hover { 
        background: #dc3545; 
        color: #fff; 
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3); 
    }
    .btn-primary { 
        background: linear-gradient(90deg, #007bff, #0056b3); 
        border: none; 
        transition: all 0.3s ease; 
    }
    .btn-primary:hover { 
        background: linear-gradient(90deg, #0056b3, #003d80); 
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3); 
    }
    .form-control:focus { 
        border-color: #007bff; 
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3); 
    }
    .image-preview-container { 
        position: relative; 
        display: inline-block; 
        margin-top: 10px; 
        padding: 8px; 
        border: 1px solid #e0e0e0; 
        border-radius: 8px; 
        background: #fff; 
    }
    .preview-label { 
        font-size: 0.85rem; 
        color: #6c757d; 
        margin-top: 8px; 
        text-align: center; 
    }
    .tagsinput { 
        width: 100%; 
        border: 1px solid #ced4da; 
        border-radius: 5px; 
        padding: 8px; 
        background: #fff; 
    }
    .tagsinput .tag { 
        background: #007bff; 
        color: #fff; 
        border-radius: 5px; 
        padding: 4px 10px; 
        margin: 2px; 
        font-size: 0.9rem; 
    }
    .tagsinput .tag a { 
        color: #fff; 
        margin-left: 5px; 
        font-weight: bold; 
    }
    .form-label { 
        font-weight: 500; 
        color: #1a1a1a; 
        margin-bottom: 8px; 
    }
    .text-danger { font-size: 0.85rem; }
    @keyframes slideIn {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @media (max-width: 768px) {
        .breadcrumb { justify-content: start !important; }
        .psg-p-btn { width: 100%; }
        .img-preview { max-width: 100px; max-height: 100px; }
        .modal-body { padding: 20px; }
        .modal-title { font-size: 1.25rem; }
    }

    .bootstrap-tagsinput {
     background-color: #fff;
     border: 1px solid #ccc;
     box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     display: inline-block;
     padding: 4px 6px;
     color: #555;
     vertical-align: middle;
     border-radius: 4px;
     width: 100%;
     line-height: 22px;
     cursor: text;
     display: flex;
     flex-direction: row;
     flex-wrap: wrap;
     }
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
                    <h3 class="page-title mb-0"><i class="fas fa-leaf text-primary me-2"></i> Sustainability</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('testCurricular.index') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sustainability</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- Add New Button (always visible) -->
            {{-- <div class="row mb-3">
                <div class="col-12 text-end">
                    <button type="button" class="psg-p-btn" onclick="toggleContentSustainability()">
                        <i class="fas fa-plus-circle me-2"></i> Add Sustainability Content
                    </button>
                </div>
            </div> --}}

            <!-- CREATE FORM (hidden by default) -->
            <div class="row mt-4" id="SustainabilityContent" style="display:none;">
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Create Sustainability Content</h5>
                        </div>

                        <form action="{{ route('sustainability.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">

                                <!-- Banner -->
                                <div class="col-md-6">
                                    <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="banner" accept="image/*" required
                                           onchange="validateAndPreview(event,'bannerPreview')">
                                    <small class="text-muted">Max 5 MB – JPG / JPEG / WEBP</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="bannerPreview" src="" alt="Banner preview" class="img-preview w-100" style="display:none;">
                                    </div>
                                    @error('banner') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Quote -->
                                <div class="col-md-6">
                                    <label class="form-label">Quote</label>
                                    <input type="text" class="form-control" name="quote" value="{{ old('quote') }}">
                                    @error('quote') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Title -->
                                <div class="col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required value="{{ old('title') }}">
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-6">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Points (comma-separated) -->
                                <div class="col-md-6">
                                    <label class="form-label">Points</label>
                                    <input type="text" class="form-control tagsinput" name="points"
                                           value="{{ old('points') }}" placeholder="Add points (comma-separated)">
                                    @error('points') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required
                                           onchange="validateAndPreview(event,'imagePreview')">
                                    <small class="text-muted">Max 5 MB – JPG / JPEG / WEBP</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="imagePreview" src="" alt="Image preview" class="img-preview w-100" style="display:none;">
                                    </div>
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Submit -->
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary psg-p-btn">
                                        <i class="fas fa-save me-1"></i> Save Content
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- LIST SECTION -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-black"><i class="fas fa-list me-2"></i> Sustainability Content List</h5>
                            <button class="btn btn-outline-light btn-sm" onclick="toggleContentSustainability()">
                                <i class="fas fa-plus me-1"></i> Add New
                            </button>
                        </div>
<div class="card-body">
    @forelse($Sustainabilities as $item)
        <div class="form-section mb-4">
            <form action="{{ route('sustainability.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4 align-items-start">
                    <!-- Banner -->
                    <div class="col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" class="form-control" name="banner" accept="image/*"
                               onchange="validateAndPreview(event,'bannerPreview{{ $item->id }}')">
                        <small class="text-muted">Leave blank to keep current</small>
                        <div class="image-preview-container mt-2">
                            <img id="bannerPreview{{ $item->id }}" src="{{ asset('frontend/imgs/sus/'.$item->banner) }}"
                                 class="img-preview w-100">
                        </div>
                    </div>

                   
                    <!-- Quote -->
                    <div class="col-md-6">
                        <label class="form-label">Quote</label>
                        <textarea  class="form-control" name="quote">
                               {{ $item->quote }}</textarea>
                    </div>
                    <!-- Title -->
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ $item->title }}" required>
                    </div>


                    <!-- Description -->
                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" required>{{ $item->description }}</textarea>
                    </div>

                    <!-- Points -->
                    <div class="col-md-6">
                        <label class="form-label">Points</label>
                        <input type="text" class="form-control tagsinput" name="points"
                               value="{{ $item->points }}">
                    </div>
                    <!-- Image -->
                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*"
                               onchange="validateAndPreview(event,'imagePreview{{ $item->id }}')">
                        <small class="text-muted">Leave blank to keep current</small>
                        <div class="image-preview-container mt-2">
                            <img id="imagePreview{{ $item->id }}" src="{{ asset('frontend/imgs/sus/'.$item->image) }}"
                                 class="img-preview w-100">
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete({{ $item->id }})">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @empty
        <p class="text-center py-3 mb-0">No sustainability content found.</p>
    @endforelse
</div>

                    </div>
                </div>
            </div>
        <div class="quick-links-grid">

    <a href="{{ route('sustainability.governance.index') }}" class="quick-link-card">
        <div class="quick-link-icon">🏛️</div>
        <h4 class="quick-link-title">Governance</h4>
        <p class="quick-link-desc">Manage sustainability governance content.</p>
        <span class="quick-link-btn">Manage Governance →</span>
    </a>

    <a href="{{ route('sustainability.social.index') }}" class="quick-link-card">
        <div class="quick-link-icon">👥</div>
        <h4 class="quick-link-title">Social</h4>
        <p class="quick-link-desc">Manage social responsibility data.</p>
        <span class="quick-link-btn">Manage Social →</span>
    </a>

    <a href="{{ route('sustainability.certificates.index') }}" class="quick-link-card">
        <div class="quick-link-icon">📄</div>
        <h4 class="quick-link-title">Certificates</h4>
        <p class="quick-link-desc">Upload and manage certificates.</p>
        <span class="quick-link-btn">Manage Certificates →</span>
    </a>

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
    // Toggle create form
    function toggleContentSustainability() {
        const el = document.getElementById('SustainabilityContent');
        el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
    }

    $(document).ready(function () {
        // DataTable
        $('#sustainabilityTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
        });

        // TagsInput
        $('.tagsinput').tagsInput({
            width: 'auto',
            delimiter: ',',
            placeholder: 'Add points (comma-separated)'
        });
    });

    // Image preview + size check
    function validateAndPreview(event, previewId) {
        const max = 5 * 1024 * 1024; // 5 MB
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);

        if (file && file.size > max) {
            event.target.value = '';
            Swal.fire({icon:'error',title:'File Too Large',text:'Maximum 5 MB allowed.'});
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
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('sustainability.destroy', '') }}/${id}`;

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