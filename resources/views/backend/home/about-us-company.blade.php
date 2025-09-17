@extends('layouts.app')

@section('content')
<style>
    .about-card { transition: transform 0.3s, box-shadow 0.3s; }
    .about-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus, .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #0f4075ff; border-color: #007bff; }
    .btn-primary:hover { background-color: #012144ff; border-color: #0056b3; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
</style>

<div class="container py-5">
    <div class="card about-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Update Company Information</h3>
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

            <form action="{{ route('about-us-company-update', $aboutCompany->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="years_working_experience" class="form-label">Years of Working Experience <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('years_working_experience') is-invalid @enderror" 
                           id="years_working_experience" name="years_working_experience" 
                           value="{{ old('years_working_experience', $aboutCompany->years_working_experience) }}" required>
                    @error('years_working_experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="5" required>{{ old('content', $aboutCompany->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="textile_industry" class="form-label">Textile Industry Description</label>
                    <textarea class="form-control @error('textile_industry') is-invalid @enderror" 
                              id="textile_industry" name="textile_industry" rows="4">{{ old('textile_industry', $aboutCompany->textile_industry) }}</textarea>
                    @error('textile_industry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="textile_industry_image" class="form-label">Textile Industry Image</label>
                    @if($aboutCompany->textile_industry_image)
                        <div class="mb-2">
                            <img src="{{ asset($aboutCompany->textile_industry_image) }}" alt="Textile Industry" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('textile_industry_image') is-invalid @enderror" 
                           id="textile_industry_image" name="textile_industry_image" accept="image/*">
                    @error('textile_industry_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="food_processing_industry" class="form-label">Food Processing Industry Description</label>
                    <textarea class="form-control @error('food_processing_industry') is-invalid @enderror" 
                              id="food_processing_industry" name="food_processing_industry" rows="4">{{ old('food_processing_industry', $aboutCompany->food_processing_industry) }}</textarea>
                    @error('food_processing_industry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="food_processing_industry_image" class="form-label">Food Processing Industry Image</label>
                    @if($aboutCompany->food_processing_industry_image)
                        <div class="mb-2">
                            <img src="{{ asset($aboutCompany->food_processing_industry_image) }}" alt="Food Processing Industry" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('food_processing_industry_image') is-invalid @enderror" 
                           id="food_processing_industry_image" name="food_processing_industry_image" accept="image/*">
                    @error('food_processing_industry_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                  <div class="mb-4">
                    <label for="oem_processing_industry" class="form-label">Genral Processing Industry Description</label>
                    <textarea class="form-control @error('oem_processing_industry') is-invalid @enderror" 
                              id="oem_processing_industry" name="oem_processing_industry" rows="4">{{ old('oem_processing_industry', $aboutCompany->oem_processing_industry) }}</textarea>
                    @error('oem_processing_industry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="oem_processing_industry_image" class="form-label">Food Processing Industry Image</label>
                    @if($aboutCompany->oem_processing_industry_image)
                        <div class="mb-2">
                            <img src="{{ asset($aboutCompany->oem_processing_industry_image) }}" alt="Food Processing Industry" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('oem_processing_industry_image') is-invalid @enderror" 
                           id="oem_processing_industry_image" name="oem_processing_industry_image" accept="image/*">
                    @error('oem_processing_industry_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('about-us-company') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection