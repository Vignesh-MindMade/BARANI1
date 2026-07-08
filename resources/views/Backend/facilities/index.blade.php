@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">

        <!-- Header Section -->
        <div class="banner-manager-container py-4 px-4">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <h3 class="page-title mb-0"><i class="fas fa-info-circle text-primary me-2"></i> Facilities Page Management</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('testCurricular.index') }}" class="text-decoration-none"> <i class="fas fa-home me-1"></i> Dashboard </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Facilities Page Management</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- Form Section (Hidden by Default) -->
            <div class="row mt-4" id="facilitiesContent" style="display: none;">
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-header">
                            <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Facilities Page Content</h5>
                        </div>

                        <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Banner Image -->
                                <div class="col-md-6">
                                    <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="banner" accept="image/webp" required onchange="validateAndPreview(event, 'bannerPreview')" id="bannerUpload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="bannerPreview" src="" alt="Banner Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>

                                <!-- Facilities Paragraph -->
                                <div class="col-md-6">
                                    <label class="form-label">Facilities Paragraph <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="facilities_at_our_campus_paragraph" rows="5" required></textarea>
                                </div>

                                <!-- Event 1 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 1 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events1_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 1 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events1_image" accept="image/webp" required onchange="validateAndPreview(event, 'event1Preview')" id="event1Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event1Preview" src="" alt="Event 1 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 1 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events1_text" rows="3" required></textarea>
                                </div>

                                <!-- Event 2 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 2 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events2_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 2 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events2_image" accept="image/webp" required onchange="validateAndPreview(event, 'event2Preview')" id="event2Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event2Preview" src="" alt="Event 2 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 2 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events2_text" rows="3" required></textarea>
                                </div>

                                <!-- Event 3 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 3 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events3_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 3 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events3_image" accept="image/webp" required onchange="validateAndPreview(event, 'event3Preview')" id="event3Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event3Preview" src="" alt="Event 3 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 3 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events3_text" rows="3" required></textarea>
                                </div>

                                <!-- Event 4 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 4 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events4_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 4 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events4_image" accept="image/webp" required onchange="validateAndPreview(event, 'event4Preview')" id="event4Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event4Preview" src="" alt="Event 4 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 4 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events4_text" rows="3" required></textarea>
                                </div>

                                <!-- Event 5 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 5 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events5_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 5 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events5_image" accept="image/webp" required onchange="validateAndPreview(event, 'event5Preview')" id="event5Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event5Preview" src="" alt="Event 5 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 5 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events5_text" rows="3" required></textarea>
                                </div>

                                <!-- Event 6 -->
                                <div class="col-md-6">
                                    <label class="form-label">Event 6 Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="events6_title" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Event 6 Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="events6_image" accept="image/webp" required onchange="validateAndPreview(event, 'event6Preview')" id="event6Upload" />
                                    <small class="text-muted">Max: 5MB, WebP format</small>
                                    <div class="image-preview-container mt-2">
                                        <img id="event6Preview" src="" alt="Event 6 Preview" class="img-preview w-100" style="display: none;" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Event 6 Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="events6_text" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-outline-secondary me-2" onclick="toggleContentFacilities()"><i class="fas fa-times me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Content</button>
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
                            <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i> Facilities Page Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="25%">Content Type</th>
                                            <th width="40%">Preview</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facilities as $facility)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>Facilities Content</strong>
                                                <div class="text-muted small mt-1">
                                                    Last updated: {{ $facility->updated_at->format('M d, Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/' . $facility->banner) }}" alt="Banner Image" class="img-preview me-3" style="width: 80px; height: 50px; object-fit: cover;" />
                                                    <div class="text-truncate small" style="max-width: 200px;">
                                                        {{ Str::limit($facility->facilities_at_our_campus_paragraph, 100) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $facility->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    {{-- <form action="{{ route('facilities.delete', $facility->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $facility->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $facility->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title" id="editModalLabel{{ $facility->id }}"><i class="fas fa-edit me-2"></i> Edit Facilities Content</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-4">
                                                                <!-- Banner Image -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Banner Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="banner"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'bannerEdit{{ $facility->id }}')"
                                                                            id="bannerEditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="bannerEditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->banner) }}" id="bannerEdit{{ $facility->id }}" class="img-preview w-100" alt="Current Banner" />
                                                                    </div>
                                                                </div>

                                                                <!-- Facilities Paragraph -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Facilities Paragraph <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="facilities_at_our_campus_paragraph" rows="5" required>{{ $facility->facilities_at_our_campus_paragraph }}</textarea>
                                                                </div>

                                                                <!-- Event 1 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 1 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events1_title" value="{{ $facility->events1_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 1 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events1_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event1Edit{{ $facility->id }}')"
                                                                            id="event1EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event1EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events1_image) }}" id="event1Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 1 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 1 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events1_text" rows="3" required>{{ $facility->events1_text }}</textarea>
                                                                </div>

                                                                <!-- Event 2 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 2 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events2_title" value="{{ $facility->events2_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 2 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events2_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event2Edit{{ $facility->id }}')"
                                                                            id="event2EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event2EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events2_image) }}" id="event2Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 2 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 2 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events2_text" rows="3" required>{{ $facility->events2_text }}</textarea>
                                                                </div>

                                                                <!-- Event 3 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 3 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events3_title" value="{{ $facility->events3_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 3 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events3_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event3Edit{{ $facility->id }}')"
                                                                            id="event3EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event3EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events3_image) }}" id="event3Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 3 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 3 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events3_text" rows="3" required>{{ $facility->events3_text }}</textarea>
                                                                </div>

                                                                <!-- Event 4 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 4 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events4_title" value="{{ $facility->events4_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 4 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events4_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event4Edit{{ $facility->id }}')"
                                                                            id="event4EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event4EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events4_image) }}" id="event4Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 4 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 4 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events4_text" rows="3" required>{{ $facility->events4_text }}</textarea>
                                                                </div>

                                                                <!-- Event 5 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 5 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events5_title" value="{{ $facility->events5_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 5 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events5_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event5Edit{{ $facility->id }}')"
                                                                            id="event5EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event5EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events5_image) }}" id="event5Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 5 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 5 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events5_text" rows="3" required>{{ $facility->events5_text }}</textarea>
                                                                </div>

                                                                <!-- Event 6 -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 6 Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="events6_title" value="{{ $facility->events6_title }}" required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Event 6 Image</label>
                                                                    <div class="image-upload-container mb-3">
                                                                        <div class="upload-icon">
                                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                                        </div>
                                                                        <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)</p>
                                                                        <input
                                                                            type="file"
                                                                            class="form-control d-none"
                                                                            name="events6_image"
                                                                            accept="image/webp"
                                                                            onchange="validateAndPreview(event, 'event6Edit{{ $facility->id }}')"
                                                                            id="event6EditUpload{{ $facility->id }}"
                                                                        />
                                                                        <label for="event6EditUpload{{ $facility->id }}" class="btn btn-sm btn-primary mt-2">Change Image</label>
                                                                    </div>
                                                                    <div class="current-image">
                                                                        <p class="small text-muted mb-2">Current Image:</p>
                                                                        <img src="{{ asset('images/' . $facility->events6_image) }}" id="event6Edit{{ $facility->id }}" class="img-preview w-100" alt="Current Event 6 Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Event 6 Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" name="events6_text" rows="3" required>{{ $facility->events6_text }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Cancel</button>
                                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Changes</button>
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
    function toggleContentFacilities() {
        const contentDiv = document.getElementById('facilitiesContent');
        contentDiv.style.display = contentDiv.style.display === 'none' ? 'block' : 'none';
    }

    function validateFileSize(input) {
        const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
        if (input.files[0] && input.files[0].size > maxSizeInBytes) {
            Swal.fire({
                icon: "error",
                title: "File Too Large",
                text: "The selected file exceeds the maximum size of 5MB. Please choose a smaller file.",
                confirmButtonColor: "#3085d6",
            });
            input.value = '';
        }
    }

    function validateAndPreview(event, previewId) {
        const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);

        if (file && file.size > maxSizeInBytes) {
            event.target.value = "";
            Swal.fire({
                icon: "error",
                title: "File Too Large",
                text: "The selected file exceeds the maximum size of 5MB. Please choose a smaller file.",
                confirmButtonColor: "#3085d6",
            });
        } else if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    $(document).ready(function() {
        $('#facilitiesTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>
@endsection