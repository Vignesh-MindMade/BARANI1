@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/dashboard.css') }}" />
@endsection

@section('wrapper')

                  <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
            
               
                            <div class="page-header">
                <h2 class="text-center"> CLIENT LOGO MANAGEMENT</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('testCurricular.index') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> CLIENT LOGO MANAGEMENT</li>
                    </ol>
                </nav>
            </div>
                    <div class="section-divider"></div>
        
            <!-- Form Section (Hidden by Default) -->
            <div class="row mt-4" id="galleryContent" style="display: none;">
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Add New Logo</h5>
                        </div>

                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Image Upload -->
                                <div class="col-md-12">
                                    <label class="form-label">Select Logo (Up to 150) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="images[]" multiple accept="image/*" required />
                                    <small class="form-text text-muted">You can select multiple Logo (max 150). Supported formats: JPG, PNG, JPEG.</small>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-outline-secondary me-2" onclick="toggleContentGallery()"><i class="fas fa-times me-1"></i> Cancel</button>
                                <button type="submit" class="btn smart-btn-primary"><i class="fas fa-save me-1"></i> Save Logo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Data Table Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i> Logo Images</h5>
                            <button class="btn smart-btn-primary" onclick="toggleContentGallery()"><i class="fas fa-plus me-1"></i> Add Logo</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="galleryTable" class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="20%">Image</th>
                        
                                            <th width="15%">Uploaded At</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                             <img src="{{ asset('images/' . $gallery->image_path) }}" alt="Gallery Image" style="max-width: 100px; height: auto;" />
                                             </td>
                                            <td>{{ \Carbon\Carbon::parse($gallery->created_at)->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $gallery->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="margin: 0px 4px;" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $gallery->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title" id="editModalLabel{{ $gallery->id }}"><i class="fas fa-edit me-2"></i> Edit Image</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-4">
                                                                <!-- Current Image -->
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Current Image</label>
                                                                    <img src="{{ asset('images/' . $gallery->image_path) }}" alt="Current Image" style="max-width:200px; height:auto; display: flex;" />
                                                                </div>

                                                                <!-- New Image Upload -->
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Upload New Image (Optional)</label>
                                                                    <input type="file" class="form-control" name="image" accept="image/*" />
                                                                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Cancel</button>
                                                            <button type="submit" class="btn smart-btn-primary"><i class="fas fa-save me-1"></i> Save Changes</button>
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
    function toggleContentGallery() {
        const contentDiv = document.getElementById('galleryContent');
        contentDiv.style.display = contentDiv.style.display === 'none' ? 'block' : 'none';
    }

    $(document).ready(function() {
        $('#galleryTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });

        // Limit file selection to 150 images
        $('input[name="images[]"]').on('change', function() {
            if (this.files.length > 150) {
                Swal.fire({
                    icon: 'error',
                    title: 'Too Many Files',
                    text: 'You can upload a maximum of 150 images at a time.'
                });
                this.value = '';
            }
        });
    });
</script>
@endsection