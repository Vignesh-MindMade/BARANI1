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

            <!-- Main Button for Add Content -->
            {{-- <div class="row">
                <div class="col-12">
                    <button type="button" id="toggleButtonHomeFirst" class="psg-p-btn mt-3" onclick="toggleContentHomeFirst()">
                        <i class="fas fa-plus-circle me-2"></i> Add About Page Content
                    </button>
                </div>
            </div> --}}

            <!-- Form Section (Hidden by Default) -->
            <div class="row mt-4" id="videoContentHomeFirst" style="display: none;">
                <div class="col-12">
                    <div class="date-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>About Page Content</h5>
                        </div>

                        <form action="{{ route('management.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image (WebP, Max 5MB) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="banner" accept="image/webp" required data-preview-id="bannerPreview">
                                        <img id="bannerPreview" class="img-preview mt-2" src="#" alt="Banner Preview" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gurudev Image (WebP, Max 5MB) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="gurudev_image" accept="image/webp" required data-preview-id="gurudevPreview">
                                        <img id="gurudevPreview" class="img-preview mt-2" src="#" alt="Gurudev Preview" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Gurudev Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="gurudev_message" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Principal Image (WebP, Max 5MB) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="principal_image" accept="image/webp" required data-preview-id="principalPreview">
                                        <img id="principalPreview" class="img-preview mt-2" src="#" alt="Principal Preview" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Principal Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="principal_name" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Principal Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="principal_message" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Principal Quote <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="principal_quote" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Content</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i> About Page Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            
                                            <th width="40%">Preview</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($managements as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                          
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/' . ($item->banner ?? 'default.jpg')) }}" alt="Banner Image" class="img-preview me-3" style="width: 80px; height: 50px; object-fit: cover;" />
                                                    <div class="text-truncate small" style="max-width: 200px;">
                                                        {{ Str::limit($item->gurudev_message ?? 'No message available', 100) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-edit"></i>Edit
                                                </button>
                                                
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                            <i class="fas fa-edit me-2"></i> Edit About Page Content
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('management.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-4">
                                                                <!-- Banner Section -->
                                                                <div class="col-12">
                                                                    <h6 class="text-primary mb-3"><i class="fas fa-image me-2"></i>Banner Section</h6>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Banner Image (WebP, Max 5MB)</label>
                                                                        <input type="file" class="form-control" name="banner" accept="image/webp" data-preview-id="editBannerPreview{{ $item->id }}">
                                                                        <div class="image-preview-container mt-2">
                                                                            <img id="editBannerPreview{{ $item->id }}" class="img-preview" src="{{ asset('images/' . ($item->banner ?? 'default.jpg')) }}" alt="Banner Preview" />
                                                                            <div class="preview-label">Current Banner</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Gurudev Section -->
                                                                <div class="col-12">
                                                                    <h6 class="text-primary mb-3"><i class="fas fa-user-tie me-2"></i>Gurudev Section</h6>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Gurudev Image (WebP, Max 5MB)</label>
                                                                        <input type="file" class="form-control" name="gurudev_image" accept="image/webp" data-preview-id="editGurudevPreview{{ $item->id }}">
                                                                        <div class="image-preview-container mt-2">
                                                                            <img id="editGurudevPreview{{ $item->id }}" class="img-preview" src="{{ asset('images/' . ($item->gurudev_image ?? 'default.jpg')) }}" alt="Gurudev Preview" />
                                                                            <div class="preview-label">Current Gurudev Image</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6"></div> <!-- Empty column for spacing -->
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Gurudev Message <span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" name="gurudev_message" rows="4" required>{{ old('gurudev_message', $item->gurudev_message ?? '') }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <!-- Principal Section -->
                                                                <div class="col-12">
                                                                    <h6 class="text-primary mb-3"><i class="fas fa-graduation-cap me-2"></i>Principal Section</h6>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Principal Image (WebP, Max 5MB)</label>
                                                                        <input type="file" class="form-control" name="principal_image" accept="image/webp" data-preview-id="editPrincipalPreview{{ $item->id }}">
                                                                        <div class="image-preview-container mt-2">
                                                                            <img id="editPrincipalPreview{{ $item->id }}" class="img-preview" src="{{ asset('images/' . ($item->principal_image ?? 'default.jpg')) }}" alt="Principal Preview" />
                                                                            <div class="preview-label">Current Principal Image</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Principal Name <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" name="principal_name" value="{{ old('principal_name', $item->principal_name ?? '') }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Principal Message <span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" name="principal_message" rows="4" required>{{ old('principal_message', $item->principal_message ?? '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Principal Quote <span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" name="principal_quote" rows="3" required>{{ old('principal_quote', $item->principal_quote ?? '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          
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
                                    </tbody>
                                </table>
                            </div>
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
    // Toggle form visibility
    function toggleContentHomeFirst() {
        const content = document.getElementById('videoContentHomeFirst');
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
    }

    // Initialize DataTable
    $(document).ready(function() {
        $('#aboutPageTable').DataTable({
            responsive: true,
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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('homepage-management/delete') }}/${id}`;
                
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