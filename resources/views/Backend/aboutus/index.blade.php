@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet"href="{{ asset('assets/css/custome_backend/dashboard.css') }}"/> 
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-box page-content">
            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="page-header">
                        <div class="col-md-6">
                            <h2 class="text-center"> About Page
                                Management</h2>
                        </div>
                    
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('testCurricular.index') }}" class="text-decoration-none"> <i
                                            class="fas fa-home me-1"></i> Dashboard </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">About Page Management</li>
                            </ol>
                        </nav>
                </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                {{--
                <!-- Main Button for Add Content -->
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="toggleButtonHomeFirst" class="psg-p-btn mt-3" onclick="toggleContentHomeFirst()"><i class="fas fa-plus-circle me-2"></i> Add About Page Content</button>
                    </div>
                </div>
                --}}

                <!-- Form Section (Hidden by Default) -->
                <div class="row mt-4" id="videoContentHomeFirst" style="display: none;">
                    <div class="col-12">
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>About Page Content</h5>
                            </div>

                            <form action="{{ route('whychinmaya.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <!-- Banner Image -->
                                    <div class="col-md-6">
                                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                                        <div class="image-upload-container mb-3">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)
                                            </p>
                                            <input type="file" class="form-control d-none" name="banner"
                                                accept="image/webp" required onchange="validateFileSize(this)"
                                                id="bannerUpload" />
                                            <label for="bannerUpload" class="btn btn-sm btn-primary mt-2">Choose
                                                File</label>
                                        </div>
                                        <div class="image-preview-container">
                                            <img id="bannerPreview" src="" alt="Banner Preview"
                                                class="img-preview w-100" style="display: none;" />
                                        </div>
                                    </div>

                                    <!-- Chinmaya History -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya History Paragraph <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="chinmaya_history_paragraph" rows="5" required></textarea>
                                    </div>

                                    <!-- Chinmaya History -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya History Paragraph 2<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="chinmaya_history_paragraph1" rows="5" required></textarea>
                                    </div>

                                    <!-- Chinmaya Vision -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Vision Paragraph <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="chinmaya_vision_paragraph" rows="5" required></textarea>
                                    </div>

                                    <!-- Vision Image -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Vision Image <span
                                                class="text-danger">*</span></label>
                                        <div class="image-upload-container mb-3">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)
                                            </p>
                                            <input type="file" class="form-control d-none" name="chinmaya_vision_image"
                                                accept="image/webp" required onchange="validateFileSize(this)"
                                                id="visionUpload" />
                                            <label for="visionUpload" class="btn btn-sm btn-primary mt-2">Choose
                                                File</label>
                                        </div>
                                        <div class="image-preview-container">
                                            <img id="visionPreview" src="" alt="Vision Preview"
                                                class="img-preview w-100" style="display: none;" />
                                        </div>
                                    </div>

                                    <!-- Our Values -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Our Values Paragraph <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="chinmaya_ourvalues_paragraph" rows="5" required></textarea>
                                    </div>

                                    <!-- Our Values Image -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Our Values Image <span
                                                class="text-danger">*</span></label>
                                        <div class="image-upload-container mb-3">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)
                                            </p>
                                            <input type="file" class="form-control d-none"
                                                name="chinmaya_ourvalues_image" accept="image/webp" required
                                                onchange="validateFileSize(this)" id="valuesUpload" />
                                            <label for="valuesUpload" class="btn btn-sm btn-primary mt-2">Choose
                                                File</label>
                                        </div>
                                        <div class="image-preview-container">
                                            <img id="valuesPreview" src="" alt="Our Values Preview"
                                                class="img-preview w-100" style="display: none;" />
                                        </div>
                                    </div>

                                    <!-- Stakeholders Image -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Stakeholders Image <span
                                                class="text-danger">*</span></label>
                                        <div class="image-upload-container mb-3">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <p class="upload-text">Drag & drop or click to upload (Max: 5MB, WebP format)
                                            </p>
                                            <input type="file" class="form-control d-none"
                                                name="chinmaya_stakeholders_image" accept="image/webp" required
                                                onchange="validateFileSize(this)" id="stakeholdersUpload" />
                                            <label for="stakeholdersUpload" class="btn btn-sm btn-primary mt-2">Choose
                                                File</label>
                                        </div>
                                        <div class="image-preview-container">
                                            <img id="stakeholdersPreview" src="" alt="Stakeholders Preview"
                                                class="img-preview w-100" style="display: none;" />
                                        </div>
                                    </div>

                                    <!-- Stakeholders Paragraph -->
                                    <div class="col-md-6">
                                        <label class="form-label">Chinmaya Stakeholders Paragraph <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="chinmaya_stakeholders_paragraph" rows="5" required></textarea>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-outline-secondary me-2"
                                        onclick="toggleContentHomeFirst()"><i class="fas fa-times me-1"></i>
                                        Cancel</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save
                                        Content</button>
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
                                <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i> About Page Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="aboutPageTable" class="table table-striped table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="25%">Content Type</th>
                                                <th width="40%">Preview</th>
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($aboutUsItems as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <strong>About Page Content</strong>
                                                        <div class="text-muted small mt-1">
                                                            Last updated: {{ $item->updated_at->format('M d, Y') }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('images/' . $item->chinmaya_vision_image) }}"
                                                                alt="Vision Image" class="img-preview me-3"
                                                                style="width: 80px; height: 50px; object-fit: cover;" />
                                                            <div class="text-truncate small" style="max-width: 200px;">
                                                                {{ Str::limit($item->chinmaya_history_paragraph, 100) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <button class="btn btn-sm btn-outline-primary me-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $item->id }}"><i
                                                                        class="fas fa-edit me-2"></i> Edit About Page
                                                                    Content</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('whychinmaya.update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row g-4">
                                                                        <!-- Banner Image -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Banner Image</label>
                                                                            <div class="image-upload-container mb-3">
                                                                                <div class="upload-icon">
                                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <p class="upload-text">Drag & drop or click
                                                                                    to upload (Max: 5MB, WebP format)</p>
                                                                                <input type="file"
                                                                                    class="form-control d-none"
                                                                                    name="banner" accept="image/webp"
                                                                                    onchange="validateAndPreview(event, 'bannerEdit{{ $item->id }}')"
                                                                                    id="bannerEditUpload{{ $item->id }}" />
                                                                                <label
                                                                                    for="bannerEditUpload{{ $item->id }}"
                                                                                    class="btn btn-sm btn-primary mt-2">Change
                                                                                    Image</label>
                                                                            </div>
                                                                            <div class="current-image">
                                                                                <p class="small text-muted mb-2">Current
                                                                                    Image:</p>
                                                                                <img src="{{ asset('images/' . $item->banner) }}"
                                                                                    id="bannerEdit{{ $item->id }}"
                                                                                    class="img-preview w-100"
                                                                                    alt="Current Banner" />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Chinmaya History -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya History
                                                                                Paragraph <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="chinmaya_history_paragraph" rows="5" required>{{ $item->chinmaya_history_paragraph }}</textarea>
                                                                        </div>

                                                                        <!-- Chinmaya History -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya History
                                                                                Paragraph 2 <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="chinmaya_history_paragraph1" rows="5" required>{{ $item->chinmaya_history_paragraph1 }}</textarea>
                                                                        </div>

                                                                        <!-- Chinmaya Vision -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Vision
                                                                                Paragraph <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="chinmaya_vision_paragraph" rows="5" required>{{ $item->chinmaya_vision_paragraph }}</textarea>
                                                                        </div>

                                                                        <!-- Vision Image -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Vision
                                                                                Image</label>
                                                                            <div class="image-upload-container mb-3">
                                                                                <div class="upload-icon">
                                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <p class="upload-text">Drag & drop or click
                                                                                    to upload (Max: 5MB, WebP format)</p>
                                                                                <input type="file"
                                                                                    class="form-control d-none"
                                                                                    name="chinmaya_vision_image"
                                                                                    accept="image/webp"
                                                                                    onchange="validateAndPreview(event, 'visionEdit{{ $item->id }}')"
                                                                                    id="visionEditUpload{{ $item->id }}" />
                                                                                <label
                                                                                    for="visionEditUpload{{ $item->id }}"
                                                                                    class="btn btn-sm btn-primary mt-2">Change
                                                                                    Image</label>
                                                                            </div>
                                                                            <div class="current-image">
                                                                                <p class="small text-muted mb-2">Current
                                                                                    Image:</p>
                                                                                <img src="{{ asset('images/' . $item->chinmaya_vision_image) }}"
                                                                                    id="visionEdit{{ $item->id }}"
                                                                                    class="img-preview w-100"
                                                                                    alt="Current Vision Image" />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Our Values -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Our Values
                                                                                Paragraph <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="chinmaya_ourvalues_paragraph" rows="5" required>{{ $item->chinmaya_ourvalues_paragraph }}</textarea>
                                                                        </div>

                                                                        <!-- Our Values Image -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Our Values
                                                                                Image</label>
                                                                            <div class="image-upload-container mb-3">
                                                                                <div class="upload-icon">
                                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <p class="upload-text">Drag & drop or click
                                                                                    to upload (Max: 5MB, WebP format)</p>
                                                                                <input type="file"
                                                                                    class="form-control d-none"
                                                                                    name="chinmaya_ourvalues_image"
                                                                                    accept="image/webp"
                                                                                    onchange="validateAndPreview(event, 'valuesEdit{{ $item->id }}')"
                                                                                    id="valuesEditUpload{{ $item->id }}" />
                                                                                <label
                                                                                    for="valuesEditUpload{{ $item->id }}"
                                                                                    class="btn btn-sm btn-primary mt-2">Change
                                                                                    Image</label>
                                                                            </div>
                                                                            <div class="current-image">
                                                                                <p class="small text-muted mb-2">Current
                                                                                    Image:</p>
                                                                                <img src="{{ asset('images/' . $item->chinmaya_ourvalues_image) }}"
                                                                                    id="valuesEdit{{ $item->id }}"
                                                                                    class="img-preview w-100"
                                                                                    alt="Current Values Image" />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Stakeholders Image -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Stakeholders
                                                                                Image</label>
                                                                            <div class="image-upload-container mb-3">
                                                                                <div class="upload-icon">
                                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <p class="upload-text">Drag & drop or click
                                                                                    to upload (Max: 5MB, WebP format)</p>
                                                                                <input type="file"
                                                                                    class="form-control d-none"
                                                                                    name="chinmaya_stakeholders_image"
                                                                                    accept="image/webp"
                                                                                    onchange="validateAndPreview(event, 'stakeholdersEdit{{ $item->id }}')"
                                                                                    id="stakeholdersEditUpload{{ $item->id }}" />
                                                                                <label
                                                                                    for="stakeholdersEditUpload{{ $item->id }}"
                                                                                    class="btn btn-sm btn-primary mt-2">Change
                                                                                    Image</label>
                                                                            </div>
                                                                            <div class="current-image">
                                                                                <p class="small text-muted mb-2">Current
                                                                                    Image:</p>
                                                                                <img src="{{ asset('images/' . $item->chinmaya_stakeholders_image) }}"
                                                                                    id="stakeholdersEdit{{ $item->id }}"
                                                                                    class="img-preview w-100"
                                                                                    alt="Current Stakeholders Image" />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Stakeholders Paragraph -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Chinmaya Stakeholders
                                                                                Paragraph <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="chinmaya_stakeholders_paragraph" rows="5" required>{{ $item->chinmaya_stakeholders_paragraph }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal"><i
                                                                            class="fas fa-times me-1"></i> Cancel</button>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fas fa-save me-1"></i> Save
                                                                        Changes</button>
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


                {{-- cards section --}}

                <!-- Create Form -->
                <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (WEBP only, max 5MB)</label>
                        <input type="file" class="form-control" id="image" name="image" accept=".webp"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <!-- Table View -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered ">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <td>{{ $card->id }}</td>
                                    <td>{{ $card->title }}</td>

                                    <td>
                                        @if ($card->image)
                                            <img src="{{ asset('images/' . $card->image) }}" width="50"
                                                alt="Card Image">
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-warning edit-btn"  data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $card->id }}"
                                                data-title="{{ $card->title }}"
                                                data-description="{{ $card->description }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form action="{{ route('cards.delete', $card->id) }}" method="POST"
                                                style="display:inline;margin: 0px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" style="margin: 0px;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Card</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="editForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="edit_id">
                                    <div class="mb-3">
                                        <label for="edit_title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="edit_title" name="title"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image" class="form-label">Image (WEBP only, max 5MB)</label>
                                        <input type="file" class="form-control" id="edit_image" name="image"
                                            accept=".webp">
                                        <small class="text-muted">Leave empty to keep current image</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {

                        document.querySelectorAll('.edit-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                const title = this.getAttribute('data-title');
                                const description = this.getAttribute('data-description');

                                document.getElementById('edit_id').value = id;
                                document.getElementById('edit_title').value = title;
                                document.getElementById('edit_description').value = description;

                                document.getElementById('editForm').action = `/whychinmaya-cards/update/${id}`;
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>
    @endsection @section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
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
                reader.onload = function() {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
