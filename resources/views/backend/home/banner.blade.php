@extends('layouts.app')

@section('content')
<style>
    .banner-card { transition: transform 0.3s, box-shadow 0.3s; }
    .banner-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .table img { object-fit: cover; }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
</style>

<div class="container py-5">
    <!-- Create Banner Form -->
    <div class="card banner-card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Create New Banner</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*" required>
                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ old('banner_title') }}" required>
                    @error('banner_title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_description" class="form-label">Banner Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="banner_description" name="banner_description" rows="4" required>{{ old('banner_description') }}</textarea>
                    @error('banner_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="readmore_link" class="form-label">Readmore Link <span class="text-danger">*</span></label>
                    <input type="url" class="form-control" id="readmore_link" name="readmore_link" value="{{ old('readmore_link') }}" required>
                    @error('readmore_link') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                  <div class="mb-3">
                    <label for="sort_id" class="form-label">Sort Id<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sort_id" name="sort_id" value="{{ old('sort_id') }}" required>
                    @error('sort_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Banner List -->
    <div class="card banner-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Banner List</h3>
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>{{ $banner->banner_title }}</td>
                                <td><img src="{{ asset($banner->banner_image) }}" alt="{{ $banner->banner_title }}" width="100" height="50"></td>
                                <td>{{ Str::limit($banner->banner_description, 50) }}</td>
                                <td><a href="{{ $banner->readmore_link }}" target="_blank" class="text-primary">Link</a></td>
                         <td>
    <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
    <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" style="display:inline;" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
    </form>
</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No banners found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- {{ $banners->links('pagination::bootstrap-5') }} --}}
        </div>
    </div>
</div>
@endsection