@extends('layouts.app')

@section('content')
<style>
    .counts-card { transition: transform 0.3s, box-shadow 0.3s; }
    .counts-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
</style>

<div class="container py-5">
    <div class="card counts-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">{{ isset($homeCounts) ? 'Update Home Counts' : 'Create Home Counts' }}</h3>
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

            <form action="{{ isset($homeCounts) ? route('home-counts-update', $homeCounts->id) : route('home-counts-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($homeCounts))
                    @method('PUT')
                @endif

                <!-- Counts Section -->
                <h5 class="section-header">Counts</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="product_count" class="form-label">Product Count <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('product_count') is-invalid @enderror" id="product_count" name="product_count" 
                               value="{{ old('product_count', isset($homeCounts) ? $homeCounts->product_count : '') }}" required>
                        @error('product_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="client_count" class="form-label">Client Count <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('client_count') is-invalid @enderror" id="client_count" name="client_count" 
                               value="{{ old('client_count', isset($homeCounts) ? $homeCounts->client_count : '') }}" required>
                        @error('client_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="Satisfaction_percentage" class="form-label">Satisfaction Percentage <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('Satisfaction_percentage') is-invalid @enderror" id="Satisfaction_percentage" name="Satisfaction_percentage" 
                               value="{{ old('Satisfaction_percentage', isset($homeCounts) ? $homeCounts->Satisfaction_percentage : '') }}" required>
                        @error('Satisfaction_percentage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="years_of_experience_count" class="form-label">Years of Experience <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('years_of_experience_count') is-invalid @enderror" id="years_of_experience_count" name="years_of_experience_count" 
                               value="{{ old('years_of_experience_count', isset($homeCounts) ? $homeCounts->years_of_experience_count : '') }}" required>
                        @error('years_of_experience_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Brand Images Section -->
                <h5 class="section-header">Brand Images</h5>
                <div class="row">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="col-md-6 mb-4">
                            <label for="brand_image_{{ $i }}" class="form-label">Brand Image {{ $i }}</label>
                            @if(isset($homeCounts) && $homeCounts->{'brand_image_' . $i})
                                <div class="mb-2">
                                    <img src="{{ asset($homeCounts->{'brand_image_' . $i}) }}" alt="Brand Image {{ $i }}" class="img-preview" width="150" height="100">
                                    <p class="text-muted small">Current image</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('brand_image_' . $i) is-invalid @enderror" id="brand_image_{{ $i }}" name="brand_image_{{ $i }}" accept="image/*">
                            @error('brand_image_' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor
                </div>

                <!-- Thumbnail and YouTube Link Section -->
                <h5 class="section-header">Thumbnail & YouTube Link</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        @if(isset($homeCounts) && $homeCounts->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset($homeCounts->thumbnail) }}" alt="Thumbnail" class="img-preview" width="150" height="100">
                                <p class="text-muted small">Current image</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="youtube_link" class="form-label">YouTube Link</label>
                        <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" name="youtube_link" 
                               value="{{ old('youtube_link', isset($homeCounts) ? $homeCounts->youtube_link : '') }}">
                        @error('youtube_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($homeCounts) ? 'Update' : 'Submit' }}</button>
                    <a href="{{ route('home-counts') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection