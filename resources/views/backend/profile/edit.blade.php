@extends('layouts.app')

@section('content')
<style>
    .profile-card { transition: transform 0.3s, box-shadow 0.3s; }
    .profile-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
</style>

<div class="container py-5">
    <div class="card profile-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Edit Profile</h3>
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

            <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Banner Image -->
                <h5 class="section-header">Banner</h5>
                <div class="mb-4">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    @if($profile->banner_image)
                        <div class="mb-2">
                            <img src="{{ asset($profile->banner_image) }}" alt="Banner Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image" accept="image/*">
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- About Us Description -->
                <h5 class="section-header">About Us</h5>
                <div class="mb-4">
                    <label for="about_us_description" class="form-label">About Us Description</label>
                    <textarea class="form-control @error('about_us_description') is-invalid @enderror" id="about_us_description" name="about_us_description" rows="5">{{ old('about_us_description', $profile->about_us_description) }}</textarea>
                    @error('about_us_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Textile Section -->
                <h5 class="section-header">Textile</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="textile_name" class="form-label">Textile Name</label>
                        <input type="text" class="form-control @error('textile_name') is-invalid @enderror" id="textile_name" name="textile_name" value="{{ old('textile_name', $profile->textile_name) }}">
                        @error('textile_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="textile_work" class="form-label">Textile Work</label>
                        <input type="text" class="form-control @error('textile_work') is-invalid @enderror" id="textile_work" name="textile_work" value="{{ old('textile_work', $profile->textile_work) }}">
                        @error('textile_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="textile_description" class="form-label">Textile Description</label>
                    <textarea class="form-control @error('textile_description') is-invalid @enderror" id="textile_description" name="textile_description" rows="4">{{ old('textile_description', $profile->textile_description) }}</textarea>
                    @error('textile_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Food Processing Section -->
                <h5 class="section-header">Food Processing</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="food_processing_name" class="form-label">Food Processing Name</label>
                        <input type="text" class="form-control @error('food_processing_name') is-invalid @enderror" id="food_processing_name" name="food_processing_name" value="{{ old('food_processing_name', $profile->food_processing_name) }}">
                        @error('food_processing_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="food_processing_work" class="form-label">Food Processing Work</label>
                        <input type="text" class="form-control @error('food_processing_work') is-invalid @enderror" id="food_processing_work" name="food_processing_work" value="{{ old('food_processing_work', $profile->food_processing_work) }}">
                        @error('food_processing_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="food_processing_description" class="form-label">Food Processing Description</label>
                    <textarea class="form-control @error('food_processing_description') is-invalid @enderror" id="food_processing_description" name="food_processing_description" rows="4">{{ old('food_processing_description', $profile->food_processing_description) }}</textarea>
                    @error('food_processing_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- History Section -->
                <h5 class="section-header">History</h5>
                <div class="mb-4">
                    <label for="history_image" class="form-label">History Image</label>
                    @if($profile->history_image)
                        <div class="mb-2">
                            <img src="{{ asset($profile->history_image) }}" alt="History Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('history_image') is-invalid @enderror" id="history_image" name="history_image" accept="image/*">
                    @error('history_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="history_description" class="form-label">History Description</label>
                    <textarea class="form-control @error('history_description') is-invalid @enderror" id="history_description" name="history_description" rows="4">{{ old('history_description', $profile->history_description) }}</textarea>
                    @error('history_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Management Section -->
                <h5 class="section-header">Management</h5>
                <div class="mb-4">
                    <label for="management_image" class="form-label">Management Image</label>
                    @if($profile->management_image)
                        <div class="mb-2">
                            <img src="{{ asset($profile->management_image) }}" alt="Management Image" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('management_image') is-invalid @enderror" id="management_image" name="management_image" accept="image/*">
                    @error('management_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mission Section -->
                <h5 class="section-header">Mission</h5>
                <div class="mb-4">
                    <label for="mission_description" class="form-label">Mission Description</label>
                    <textarea class="form-control @error('mission_description') is-invalid @enderror" id="mission_description" name="mission_description" rows="4">{{ old('mission_description', $profile->mission_description) }}</textarea>
                    @error('mission_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Team Section -->
                <h5 class="section-header">Team</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="team_name" class="form-label">Team Name</label>
                        <input type="text" class="form-control @error('team_name') is-invalid @enderror" id="team_name" name="team_name" value="{{ old('team_name', $profile->team_name) }}">
                        @error('team_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="team_description" class="form-label">Team Description</label>
                        <input type="text" class="form-control @error('team_description') is-invalid @enderror" id="team_description" name="team_description" value="{{ old('team_description', $profile->team_description) }}">
                        @error('team_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="team_thumbnail" class="form-label">Team Thumbnail</label>
                    @if($profile->team_thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset($profile->team_thumbnail) }}" alt="Team Thumbnail" class="img-preview" width="150" height="100">
                            <p class="text-muted small">Current image</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('team_thumbnail') is-invalid @enderror" id="team_thumbnail" name="team_thumbnail" accept="image/*">
                    @error('team_thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="team_video_link" class="form-label">Team Video Link</label>
                    <input type="url" class="form-control @error('team_video_link') is-invalid @enderror" id="team_video_link" name="team_video_link" value="{{ old('team_video_link', $profile->team_video_link) }}">
                    @error('team_video_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection