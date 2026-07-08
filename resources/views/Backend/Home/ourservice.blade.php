@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet"href="{{ asset('assets/css/custome_backend/dashboard.css') }}"/>  
<style>
    /* Add any additional styling as needed */
</style>
@endsection

@section("wrapper")

                  <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
            
               
                            <div class="page-header">
                <h2 class="text-center">Our Services</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('testCurricular.index') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">our Services</li>
                    </ol>
                </nav>
            </div>  
            <div class="section-divider"></div>
        
        <div class="section-header mt-4">
   
        
        
        <div class="row">
            <div class="col-md-12">
                <div class="page-box animate-fade-in">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Our Services</h5>
                        {{-- <button id="toggleButton" class="smart-btn smart-btn-dark btn btn-primary" onclick="toggleContent()" >
                             Add Service
                        </button> --}}
                    </div>

                    <!-- Service Form -->
                    <div id="videoContent"  class="animate-fade-in">
                        <div class="form-section mt-3 mb-4">
                            <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i>{{ $OurService ? 'Update Service' : 'Add New Service' }}</h5>

                            <form action="{{ $OurService ? route('ourservice.update', $OurService->id) : route('ourservice.store') }}" 
                                  method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @if($OurService)
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" 
                                           value="{{ old('title', $OurService->title ?? '') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Service Image</label>
                                    <input type="file" name="image" class="form-control" {{ $OurService ? '' : 'required' }}>
                                    @if(isset($OurService->image))
                                        <div class="mt-2">
                                            <img src="{{ asset($OurService->image) }}" alt="Service Image" width="100">
                                        </div>
                                    @endif
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $OurService->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="points_title" class="form-label">Points Title</label>
                                    <input type="text" name="points_title" class="form-control" 
                                           value="{{ old('points_title', $OurService->points_title ?? '') }}">
                                </div>

                                @for($i = 1; $i <= 6; $i++)
                                    <div class="mb-3">
                                        <label for="point_{{ $i }}" class="form-label">Point {{ $i }}</label>
                                        <input type="text" name="point_{{ $i }}" class="form-control"
                                               value="{{ old('point_'.$i, $OurService->{'point_'.$i} ?? '') }}">
                                    </div>
                                @endfor

                                <div class="mb-3">
                                    <label for="readmore_link" class="form-label">Read More Link</label>
                                    <input type="url" name="readmore_link" class="form-control"
                                           value="{{ old('readmore_link', $OurService->readmore_link ?? '') }}">
                                </div>

                                <button type="submit" class="btn smart-btn-primary">{{ $OurService ? 'Update' : 'Create' }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
    </div>
</div>
@endsection

@section("script")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script>
  

    // Form Validation
    document.addEventListener("DOMContentLoaded", function() {
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();

                    const invalidFields = form.querySelectorAll(':invalid');
                    if (invalidFields.length > 0) {
                        invalidFields[0].focus();
                    }

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Please fill all required fields',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endsection
