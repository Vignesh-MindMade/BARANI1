@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<style>
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .banner-manager-container { max-width: 1400px; margin: auto; }
    .section-divider { border-top: 1px solid #e0e0e0; margin: 20px 0; }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { background: #007bff; color: #fff; padding: 10px 20px; border-radius: 25px; transition: all 0.3s ease; }
    .psg-p-btn:hover { background: #0056b3; transform: translateY(-2px); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); }
    .card { border: none; border-radius: 10px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05); }
    .card-header { background: #007bff; color: #fff; border-radius: 10px 10px 0 0; }
    .table-responsive { border-radius: 10px; overflow: hidden; }
    .table th, .table td { vertical-align: middle; }
    .img-preview { border-radius: 5px; border: 1px solid #ddd; max-width: 100px; max-height: 100px; object-fit: cover; }
    .modal-content { border-radius: 15px; }
    .modal-header { background: #f1f3f5; }
    .btn-outline-primary { border-color: #007bff; color: #007bff; }
    .btn-outline-primary:hover { background: #007bff; color: #fff; }
    .btn-outline-danger { border-color: #dc3545; color: #dc3545; }
    .btn-outline-danger:hover { background: #dc3545; color: #fff; }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0, 123, 255, 0.3); }
    .image-preview-container { position: relative; display: inline-block; }
    .preview-label { font-size: 0.9rem; color: #6c757d; margin-top: 5px; }
    @media (max-width: 768px) {
        .breadcrumb { justify-content: start !important; }
        .psg-p-btn { width: 100%; }
        .img-preview { max-width: 80px; max-height: 80px; }
    }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">
            <!-- Header Section -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0"><i class="fas fa-info-circle text-primary me-2"></i> Management Page</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('testCurricular.index') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Management Page</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="section-divider"></div>


            <div class="row">
                <div class="col-12">
                    <button type="button" id="toggleButtonHomeFirst1" class="psg-p-btn mt-3" onclick="toggleContentHomeFirst()">
                        <i class="fas fa-plus-circle me-2"></i> Add Title
                    </button>
                </div>
            </div>

           <!-- Form Section (Hidden by Default) -->
            <div class="row mt-4" id="videoContentHomeFirstsss" style="display: none;">
                <div class="col-12">
                    <div class="date-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary">
                                <i class="fas fa-plus-circle me-2"></i> Add Certificate Title
                            </h5>
                        </div>

                        <form action="{{ route('view_certficate_title.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter title" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Sort ID <span class="text-muted">(numeric)</span></label>
                                        <input type="number" class="form-control" name="sort_id" placeholder="e.g. 10" value="0" required>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Title
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Certificate Titles Table Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i> Certificate Titles</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive" style="overflow-x: scroll !important; display: block; width: 100%;">
                                <table class="table table-striped table-bordered table-hover mb-0" id="titlesTable" style="min-width: 800px; width: max-content;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%" style="min-width: 50px;">#</th>
                                            <th width="10%" style="min-width: 80px;">Sort</th>
                                            <th width="60%" style="min-width: 300px;">Title</th>
                                            <th width="25%" style="min-width: 200px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($titles as $index => $title)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $title->sort_id ?? 0 }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $title->title }}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editTitleModal{{ $title->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" 
                                                        onclick="confirmDeleteTitle({{ $title->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Title Modal -->
                                        <div class="modal fade" id="editTitleModal{{ $title->id }}" tabindex="-1" aria-labelledby="editTitleModalLabel{{ $title->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTitleModalLabel{{ $title->id }}">
                                                            <i class="fas fa-edit me-2"></i> Edit Certificate Title
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('view_certficate_title.update', $title->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="title" value="{{ $title->title }}" placeholder="Enter title" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Sort ID <span class="text-muted">(numeric)</span></label>
                                                                <input type="number" class="form-control" name="sort_id" value="{{ $title->sort_id ?? 0 }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i> Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save me-1"></i> Update Title
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">No certificate titles available. Please add some titles.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main Button for Add Content -->
          <div class="row">
                <div class="col-12">
                    <button type="button" id="toggleButtonHomeFirst" class="psg-p-btn mt-3" onclick="toggleContentHomeFir()">
                        <i class="fas fa-plus-circle me-2"></i> Add About Page Content
                    </button>
                </div>
            </div> 

            <!-- Form Section (Hidden by Default) -->
            <div class="row mt-4" id="videoContentHomeFirst" style="display: none;">
                <div class="col-12">
                    <div class="date-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary">
                                <i class="fas fa-plus-circle me-2"></i> About Page Content
                            </h5>
                        </div>

                        <form action="{{ route('view_certficate.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">

                                <!-- Title Dropdown -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select Title <span class="text-danger">*</span></label>
                                        <select class="form-select" name="view_certficate_title" required>
                                            <option value="">-- Select Title --</option>
                                            @foreach ($titles as $title)
                                                <option value="{{ $title->id }}">{{ $title->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">View Certificate Image (WebP, Max 5MB) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="banner" accept="image/webp" required onchange="previewImage(event, 'bannerPreview')">
                                        <img id="bannerPreview" class="img-preview mt-2" src="#" alt="Banner Preview" style="display:none; max-width:150px;" />
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Content
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Table Section -->
     <!-- Table Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> About Page Content</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="overflow-x: scroll !important; display: block; width: 100%;">
                    <table class="table table-striped table-bordered table-hover mb-0" id="aboutPageTable" style="min-width: 1000px; width: max-content;">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" style="min-width: 50px;">#</th>
                                <th width="20%" style="min-width: 150px;">Title</th>
                                <th width="40%" style="min-width: 300px;">Image Preview</th>
                                <th width="15%" style="min-width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ViewCertficates as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $item->title->title ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/' . $item->image) }}" 
                                             alt="Certificate Image" 
                                             class="img-preview me-3" 
                                             style="width: 120px; height: 80px; object-fit: cover; cursor: pointer;"
                                             onclick="showImageModal('{{ asset('images/' . $item->image) }}')" />
                                        <div class="text-truncate small" style="max-width: 200px;">
                                            <i class="fas fa-image text-muted"></i> {{ $item->image }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal for Each Item -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                <i class="fas fa-edit me-2"></i> Edit Certificate Content
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('view_certficate.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-4">
                                                    <!-- Title Dropdown -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Title <span class="text-danger">*</span></label>
                                                            <select class="form-select" name="view_certficate_title" required>
                                                                <option value="">-- Select Title --</option>
                                                                @foreach ($titles as $title)
                                                                    <option value="{{ $title->id }}" 
                                                                            {{ $item->view_certficate_title == $title->id ? 'selected' : '' }}>
                                                                        {{ $title->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Image Upload -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Certificate Image (WebP, Max 5MB)</label>
                                                            <input type="file" 
                                                                   class="form-control" 
                                                                   name="image" 
                                                                   accept="image/webp"
                                                                   onchange="previewEditImage(event, 'editPreview{{ $item->id }}')">
                                                            <div class="image-preview-container mt-3">
                                                                <img id="editPreview{{ $item->id }}" 
                                                                     class="img-preview" 
                                                                     src="{{ asset('images/' . $item->image) }}" 
                                                                     alt="Current Image"
                                                                     style="max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 8px; border: 2px solid #ddd;" />
                                                                <div class="preview-label mt-2">
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-info-circle"></i> Current Image
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Update Content
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No certificate content available. Please add some content.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">
                    <i class="fas fa-image me-2"></i> Image Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPreviewImage" src="" alt="Preview" style="max-width: 100%; height: auto; border-radius: 8px;" />
            </div>
        </div>
    </div>
</div>

<script>
// Preview image in edit modal
function previewEditImage(event, previewId) {
    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);

    if (file && file.size > maxSizeInBytes) {
        event.target.value = '';
        Swal.fire({
            icon: 'error',
            title: 'File Too Large',
            text: 'The selected file exceeds the maximum size of 5MB. Please choose a smaller file.',
            confirmButtonColor: '#007bff',
        });
    } else if (file && preview) {
        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
        };
        reader.readAsDataURL(file);
    }
}

// Show image in modal
function showImageModal(imageSrc) {
    document.getElementById('modalPreviewImage').src = imageSrc;
    const imageModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    imageModal.show();
}

// Confirm delete function
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url('view_certficate') }}/' + id + '/delete';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
// Confirm delete title function
function confirmDeleteTitle(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form to submit the delete request to the title destroy URL
            const form = document.createElement('form');
            form.method = 'POST';
            // Use the base URL for titles and append the id, then send as DELETE
            form.action = `{{ url('view_certficate_title') }}/${id}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    // Toggle form visibility
    function toggleContentHomeFir() {
        const content = document.getElementById('videoContentHomeFirst');
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
    }

    function toggleContentHomeFirst() {
        const content = document.getElementById('videoContentHomeFirstsss');
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
    }



    // Initialize DataTable
    $(document).ready(function() {
        $('#aboutPageTable').DataTable({
            responsive: false,
            pageLength: 10,
            order: [[0, 'asc']],
        });
    });

    // File validation and preview
    function validateAndPreview(event, previewId) {
        const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);

        if (file && file.size > maxSizeInBytes) {
            event.target.value = '';
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'The selected file exceeds the maximum size of 5MB. Please choose a smaller file.',
                confirmButtonColor: '#007bff',
            });
        } else if (file && preview) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Attach validation to file inputs
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(event) {
            validateAndPreview(event, this.getAttribute('data-preview-id'));
        });
    });

    // Confirm deletion with SweetAlert
    
</script>
@endsection