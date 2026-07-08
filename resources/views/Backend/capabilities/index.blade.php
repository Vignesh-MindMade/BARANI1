@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; margin-bottom: 30px; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { background: linear-gradient(90deg, #007bff, #0056b3); color: #fff; border-radius: 25px; padding: 8px 20px; transition: all 0.3s ease; }
    .psg-p-btn:hover { background: linear-gradient(90deg, #0056b3, #003d80); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .img-preview { border-radius: 8px; border: 1px solid #ddd; max-width: 150px; max-height: 150px; object-fit: cover; transition: transform 0.2s ease; }
    .img-preview:hover { transform: scale(1.05); }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">``
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0"><i class="fas fa-cogs text-primary me-2"></i> Capabilities Management</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('testCurricular.index') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Capabilities</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="form-section">
                <div class="form-header">
                    <h5 class="mb-0 text-primary"><i class="fas fa-pen me-2"></i> {{ $capabilities ? 'Update' : 'Create' }} Capabilities</h5>
                </div>

                <form 
                    action="{{ $capabilities ? route('capabilities.update', $capabilities->id) : route('capabilities.store') }}" 
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($capabilities)
                        @method('PUT')
                    @endif

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Main Title <span class="text-danger">*</span></label>
                            <input type="text" name="capabilities_title" class="form-control" value="{{ old('capabilities_title', $capabilities->capabilities_title ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="capabilities_desc" class="form-control" rows="3">{{ old('capabilities_desc', $capabilities->capabilities_desc ?? '') }}</textarea>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h5 class="text-primary">Workflow Sections</h5>
                        </div>

                        @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-6">
                                <label class="form-label">Workflow Section {{ $i }} Title</label>
                                <input type="text" name="capabilities_workflow_section{{ $i }}_title" class="form-control"
                                    value="{{ old("capabilities_workflow_section{$i}_title", $capabilities?->{'capabilities_workflow_section'.$i.'_title'} ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Workflow Section {{ $i }} Description</label>
                                <textarea name="capabilities_workflow_section{{ $i }}_desc" class="form-control" rows="2">{{ old("capabilities_workflow_section{$i}_desc", $capabilities?->{'capabilities_workflow_section'.$i.'_desc'} ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Workflow Section {{ $i }} Image</label>
                                <input type="file" name="capabilities_workflow_section{{ $i }}_image" class="form-control" accept="image/*"
                                       onchange="validateAndPreview(event,'section{{ $i }}Preview')">
                                @if(!empty($capabilities?->{'capabilities_workflow_section'.$i.'_image'}))
                                    <div class="image-preview-container mt-2">
                                        <img id="section{{ $i }}Preview" src="{{ asset('frontend/imgs/capabilities/'.$capabilities?->{'capabilities_workflow_section'.$i.'_image'}) }}" class="img-preview">
                                    </div>
                                @endif
                            </div>
                        @endfor

                        <div class="col-12">
                            <hr>
                            <h5 class="text-primary">Engineering Strength</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="capabilities_workflow_engineering_strength_title" class="form-control"
                                   value="{{ old('capabilities_workflow_engineering_strength_title', $capabilities->capabilities_workflow_engineering_strength_title ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="capabilities_workflow_engineering_strength_desc" class="form-control" rows="3">{{ old('capabilities_workflow_engineering_strength_desc', $capabilities->capabilities_workflow_engineering_strength_desc ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Points (comma-separated)</label>
                            <input type="text" class="form-control tagsinput" name="capabilities_workflow_engineering_strength_points" class="form-control"
                                   value="{{ old('capabilities_workflow_engineering_strength_points', $capabilities->capabilities_workflow_engineering_strength_points ?? '') }}">
                        </div>

                        <div class="col-12">
                            <hr>
                            <h5 class="text-primary">Quality & Environmental Systems</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="capabilities_quality_environmental_systems_title" class="form-control"
                                   value="{{ old('capabilities_quality_environmental_systems_title', $capabilities->capabilities_quality_environmental_systems_title ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="capabilities_quality_environmental_systems_desc" class="form-control" rows="3">{{ old('capabilities_quality_environmental_systems_desc', $capabilities->capabilities_quality_environmental_systems_desc ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Left Image</label>
                            <input type="file" name="capabilities_quality_environmental_systems_left_image" class="form-control"
                                   onchange="validateAndPreview(event,'leftPreview')" accept="image/*">
                            @if(!empty($capabilities->capabilities_quality_environmental_systems_left_image))
                                <div class="image-preview-container mt-2">
                                    <img id="leftPreview" src="{{ asset('frontend/imgs/capabilities/'.$capabilities->capabilities_quality_environmental_systems_left_image) }}" class="img-preview">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Right Image</label>
                            <input type="file" name="capabilities_quality_environmental_systems_right_image" class="form-control"
                                   onchange="validateAndPreview(event,'rightPreview')" accept="image/*">
                            @if(!empty($capabilities->capabilities_quality_environmental_systems_right_image))
                                <div class="image-preview-container mt-2">
                                    <img id="rightPreview" src="{{ asset('frontend/imgs/capabilities/'.$capabilities->capabilities_quality_environmental_systems_right_image) }}" class="img-preview">
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <hr>
                            <h5 class="text-primary">Parallax Image</h5>
                        </div>

                        <div class="col-md-6">
                            <input type="file" name="capabilities_parallax_image" class="form-control"
                                   onchange="validateAndPreview(event,'parallaxPreview')" accept="image/*">
                            @if(!empty($capabilities->capabilities_parallax_image))
                                <div class="image-preview-container mt-2">
                                    <img id="parallaxPreview" src="{{ asset('frontend/imgs/capabilities/'.$capabilities->capabilities_parallax_image) }}" class="img-preview">
                                </div>
                            @endif
                        </div>

                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary psg-p-btn">
                                <i class="fas fa-save me-2"></i>{{ $capabilities ? 'Update' : 'Create' }}
                            </button>
                            @if($capabilities)
                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $capabilities->id }})">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <button class="btn btn-link mt-3 text-primary card card-body">
                <a href="{{ route('capabilities.faq.index') }}">Go to Capabilities FAQ'S</a>
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>

<script>
    
    function validateAndPreview(event, previewId) {
        const max = 5 * 1024 * 1024; // 5 MB
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);

        if (file && file.size > max) {
            event.target.value = '';
            Swal.fire({icon:'error',title:'File Too Large',text:'Maximum 5 MB allowed.'});
            return;
        }
        if (file && preview) {
            const reader = new FileReader();
            reader.onload = () => { preview.src = reader.result; preview.style.display = 'block'; };
            reader.readAsDataURL(file);
        }
    }


    function confirmDelete(id) {
        Swal.fire({
            title: 'Delete Record?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('capabilities.destroy', '') }}/${id}`;

                const token = document.createElement('input');
                token.type = 'hidden'; token.name = '_token'; token.value = '{{ csrf_token() }}';
                form.appendChild(token);

                const method = document.createElement('input');
                method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                form.appendChild(method);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
