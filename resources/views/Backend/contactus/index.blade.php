@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .page-wrapper {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .page-box {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .banner-manager-container {
            max-width: 1400px;
            margin: auto;
        }

        .section-divider {
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .form-section {
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #e0e0e0;
        }

        .form-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .psg-p-btn {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .psg-p-btn:hover {
            background: linear-gradient(90deg, #0056b3, #003d80);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .img-preview {
            border-radius: 8px;
            border: 1px solid #ddd;
            max-width: 120px;
            max-height: 120px;
            object-fit: cover;
            transition: transform 0.2s ease;
        }

        .img-preview:hover {
            transform: scale(1.05);
        }

        .modal-content {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            background: linear-gradient(90deg, #f1f3f5, #e9ecef);
            border-bottom: none;
            padding: 20px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-footer {
            border-top: none;
            padding: 20px;
            background: #f9fafb;
            border-radius: 0 0 15px 15px;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #007bff;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: #fff;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #003d80);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .image-preview-container {
            position: relative;
            display: inline-block;
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #fff;
        }

        .preview-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 8px;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .text-danger {
            font-size: 0.85rem;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .breadcrumb {
                justify-content: start !important;
            }

            .psg-p-btn {
                width: 100%;
            }

            .img-preview {
                max-width: 100px;
                max-height: 100px;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-box page-content">
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <h3 class="page-title mb-0"><i class="fas fa-address-book text-primary me-2"></i> CONTACT US MANAGEMENT</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('testCurricular.index') }}" class="text-decoration-none"><i
                                            class="fas fa-home me-1"></i> Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="row mt-4" id="contactusContent" style="display: none;">
                    <div class="col-12">
                        <div class="form-section">
                            <div class="form-header">
                                <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Add Contact Us Content
                                </h5>
                            </div>

                            <form action="{{ route('contactus.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Banner Image (WebP, Max 5MB) <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="banner" accept="image/webp"
                                                required data-preview-id="bannerPreview">
                                            <img id="bannerPreview" class="img-preview mt-2" src="#"
                                                alt="Banner Preview" style="display: none;" />
                                            @error('banner')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Get In Touch <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" name="pre_kg_timing" required>{{ old('pre_kg_timing', $item->pre_kg_timing ?? '') }}</textarea>

                                            @error('pre_kg_timing')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-outline-secondary me-2"
                                            onclick="toggleContentContactus()">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Save Content
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-list me-2"></i> Contact Us Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="25%">Content Type</th>
                                                <th width="40%">Preview</th>
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactus as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <strong>Contact Us</strong>
                                                        <div class="text-muted small mt-1">
                                                            Last updated: {{ $item->updated_at->format('M d, Y') }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('images/' . ($item->banner ?? 'default.jpg')) }}"
                                                                alt="Banner Image" class="img-preview me-3"
                                                                style="width: 80px; height: 50px; object-fit: cover;" />
                                                            <div class="text-truncate small" style="max-width: 200px;">
                                                                {{ Str::limit($item->pre_kg_timing ?? 'No timing available', 100) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary me-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        {{-- <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button> --}}
                                                    </td>
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $item->id }}">
                                                                    <i class="fas fa-edit me-2"></i> Edit Contact Us
                                                                    Content
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('contactus.update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row g-4">
                                                                        <!-- Banner Section -->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-4">
                                                                                <label class="form-label"><i
                                                                                        class="fas fa-image me-2"></i>Banner
                                                                                    Image (WebP, Max 5MB)</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="banner" accept="image/webp"
                                                                                    data-preview-id="editBannerPreview{{ $item->id }}">
                                                                                <div class="image-preview-container mt-2">
                                                                                    <img id="editBannerPreview{{ $item->id }}"
                                                                                        class="img-preview"
                                                                                        src="{{ asset('images/' . ($item->banner ?? 'default.jpg')) }}"
                                                                                        alt="Banner Preview" />
                                                                                    <div class="preview-label">Current
                                                                                        Banner Image</div>
                                                                                </div>
                                                                                @error('banner')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="mb-4">
                                                                                <label class="form-label"><i
                                                                                        class="fas fa-clock me-2"></i>Get
                                                                                    In Touch <span
                                                                                        class="text-danger">*</span></label>
                                                                                <textarea class="form-control" name="pre_kg_timing" required>{{ old('pre_kg_timing', $item->pre_kg_timing ?? '') }}</textarea>

                                                                                @error('pre_kg_timing')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="fas fa-times me-1"></i> Cancel
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save me-1"></i> Save Changes
                                                                    </button>
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

              <a href="{{ route('contactus_department.index') }}" class="btn-custom">
    <i class="fas fa-building me-2"></i> Departments
</a>

<style>
.btn-custom {
    display: inline-block;
    background: linear-gradient(90deg, #007bff);
    color: #fff !important;
    font-weight: 600;
    padding: 10px 22px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(97, 144, 195, 0.3);
}

.btn-custom:hover {
    background: linear-gradient(90deg, #0056b3, #520dc2);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.5);
}
</style>
            </div>
        </div>
    </div>

   
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}" defer></script>

    <script>
        function toggleContentContactus() {
            const content = document.getElementById('contactusContent');
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }

        $(document).ready(function() {
            $('#contactusTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
            });
        });

        function validateAndPreview(event, previewId) {
            const maxSizeInBytes = 5 * 1024 * 1024;
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);

            if (file && file.size > maxSizeInBytes) {
                event.target.value = '';
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The selected file exceeds the maximum size of 5MB. Please choose a smaller file.',
                    confirmButtonColor: '#007bff',
                });
            } else if (file && preview) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(event) {
                validateAndPreview(event, this.getAttribute('data-preview-id'));
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('homepage-contactus/delete') }}/${id}`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
