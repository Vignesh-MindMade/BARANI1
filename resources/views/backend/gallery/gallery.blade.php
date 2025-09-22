@extends('layouts.app')

@section('content')
<style>
    .gallery-card, .table-card { transition: transform 0.3s, box-shadow 0.3s; }
    .gallery-card:hover, .table-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus, .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .btn-success { background-color: #28a745; border-color: #28a745; }
    .btn-success:hover { background-color: #218838; border-color: #218838; }
    .btn-danger { background-color: #dc3545; border-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; border-color: #c82333; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
    .gallery-item { border: 1px solid #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
    .table img { object-fit: cover; }
</style>

<div class="container py-5">
    <!-- Create Gallery Form -->
    <div class="card gallery-card shadow-sm mb-5 d-none" >
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Create Gallery</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Banner Image -->
                <h5 class="section-header">Banner Image</h5>
                <div class="mb-4">
                    <label for="banner_image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image" accept="image/*" required>
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Multiple Images + Descriptions -->
                <h5 class="section-header">Gallery Items</h5>
                <div id="gallery-items">
                    <div class="gallery-item">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('images.*') is-invalid @enderror" name="images[]" accept="image/*" required>
                                @error('images.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('descriptions.*') is-invalid @enderror" name="descriptions[]" rows="3" placeholder="Enter description"></textarea>
                                @error('descriptions.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeItem(this)">Remove</button>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="button" class="btn btn-success" onclick="addItem()">+ Add More</button>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Gallery</button>
                    <a href="{{ route('gallery') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Management Table -->
    <div class="card table-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Gallery Management</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Banner Image</th>
                            <th>Images Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->id }}</td>
                                <td>
                                    @if($gallery->banner_image)
                                        <img src="{{ asset($gallery->banner_image) }}" alt="Banner" class="img-preview" width="100" height="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ count(json_decode($gallery->image, true) ?? []) }}</td>
                                <td>
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No galleries found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>
</div>

<script>
function addItem() {
    let div = document.createElement('div');
    div.classList.add('gallery-item');
    div.innerHTML = `
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="images[]" accept="image/*" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="descriptions[]" rows="3" placeholder="Enter description"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeItem(this)">Remove</button>
    `;
    document.getElementById('gallery-items').appendChild(div);
}

function removeItem(button) {
    let items = document.querySelectorAll('.gallery-item');
    if (items.length > 1) {
        button.parentElement.remove();
    } else {
        alert('At least one gallery item is required.');
    }
}
</script>
@endsection