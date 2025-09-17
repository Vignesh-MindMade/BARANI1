@extends('layouts.app')
@section('content')
<style>
    .banner-card { transition: transform 0.3s, box-shadow 0.3s; }
    .banner-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
</style>
<div class="container py-5">
    <div class="card banner-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Edit Banner</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                    <img src="{{ asset($banner->banner_image) }}" alt="{{ $banner->banner_title }}" class="mt-2" width="100" height="50">
                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ old('banner_title', $banner->banner_title) }}" required>
                    @error('banner_title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_description" class="form-label">Banner Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="banner_description" name="banner_description" rows="4" required>{{ old('banner_description', $banner->banner_description) }}</textarea>
                    @error('banner_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="readmore_link" class="form-label">Readmore Link <span class="text-danger">*</span></label>
                    <input type="url" class="form-control" id="readmore_link" name="readmore_link" value="{{ old('readmore_link', $banner->readmore_link) }}" required>
                    @error('readmore_link') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="sort_id" class="form-label">Sort Id <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sort_id" name="sort_id" value="{{ old('sort_id', $banner->sort_id) }}" required>
                    @error('sort_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('banner') }}" class="btn btn-secondary" style=" width: 6%;
    display: flex;
    margin: 26px 0px;
}">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection 