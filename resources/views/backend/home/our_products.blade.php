@extends('layouts.app')

@section('content')
<style>
    .product-card { transition: transform 0.3s, box-shadow 0.3s; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus, .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
</style>

<div class="container py-5">
    <div class="card product-card shadow-sm">
        <div class="card-header bg-primary ">
            <h3 class="mb-0 text-white">Update Home Product</h3>
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

            <form action="{{ route('home-product.update', $homeProduct->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Our Description -->
                <div class="mb-4">
                    <label for="our_description" class="form-label">Our Description <span class="text-danger">*</span></label>
                    <textarea name="our_description" id="our_description" class="form-control @error('our_description') is-invalid @enderror" rows="5">{{ old('our_description', $homeProduct->our_description) }}</textarea>
                    @error('our_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Textile Section -->
                <h5 class="section-header">Textile</h5>
                <div class="mb-4">
                    <label for="textile_heading" class="form-label">Textile Heading <span class="text-danger">*</span></label>
                    <input type="text" name="textile_heading" id="textile_heading" class="form-control @error('textile_heading') is-invalid @enderror" value="{{ old('textile_heading', $homeProduct->textile_heading) }}">
                    @error('textile_heading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="textile_description" class="form-label">Textile Description <span class="text-danger">*</span></label>
                    <textarea name="textile_description" id="textile_description" class="form-control @error('textile_description') is-invalid @enderror" rows="4">{{ old('textile_description', $homeProduct->textile_description) }}</textarea>
                    @error('textile_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="textile_image" class="form-label">Textile Image</label>
                    @if($homeProduct->textile_image)
                        <div class="mb-2">
                            <img src="{{ asset($homeProduct->textile_image) }}" alt="Textile Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="textile_image" id="textile_image" class="form-control @error('textile_image') is-invalid @enderror" accept="image/*">
                    @error('textile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Food Section -->
                <h5 class="section-header">Food</h5>
                <div class="mb-4">
                    <label for="food_heading" class="form-label">Food Heading <span class="text-danger">*</span></label>
                    <input type="text" name="food_heading" id="food_heading" class="form-control @error('food_heading') is-invalid @enderror" value="{{ old('food_heading', $homeProduct->food_heading) }}">
                    @error('food_heading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="food_description" class="form-label">Food Description <span class="text-danger">*</span></label>
                    <textarea name="food_description" id="food_description" class="form-control @error('food_description') is-invalid @enderror" rows="4">{{ old('food_description', $homeProduct->food_description) }}</textarea>
                    @error('food_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="food_image" class="form-label">Food Image</label>
                    @if($homeProduct->food_image)
                        <div class="mb-2">
                            <img src="{{ asset($homeProduct->food_image) }}" alt="Food Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="food_image" id="food_image" class="form-control @error('food_image') is-invalid @enderror" accept="image/*">
                    @error('food_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- OEM Section -->
                <h5 class="section-header">OEM</h5>
                <div class="mb-4">
                    <label for="oem_heading" class="form-label">OEM Heading <span class="text-danger">*</span></label>
                    <input type="text" name="oem_heading" id="oem_heading" class="form-control @error('oem_heading') is-invalid @enderror" value="{{ old('oem_heading', $homeProduct->oem_heading) }}">
                    @error('oem_heading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="oem_description" class="form-label">OEM Description <span class="text-danger">*</span></label>
                    <textarea name="oem_description" id="oem_description" class="form-control @error('oem_description') is-invalid @enderror" rows="4">{{ old('oem_description', $homeProduct->oem_description) }}</textarea>
                    @error('oem_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="oem_image" class="form-label">OEM Image</label>
                    @if($homeProduct->oem_image)
                        <div class="mb-2">
                            <img src="{{ asset($homeProduct->oem_image) }}" alt="OEM Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="oem_image" id="oem_image" class="form-control @error('oem_image') is-invalid @enderror" accept="image/*">
                    @error('oem_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('home-product') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection