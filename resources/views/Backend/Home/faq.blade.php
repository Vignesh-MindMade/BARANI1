@extends("layouts.app") 

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet"href="{{ asset('assets/css/custome_backend/dashboard.css') }}"/>
    
@endsection 

@section("wrapper")

                  <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
                            <!-- Header Section -->
               
                            <div class="page-header">
                <h2 class="text-center">Stats Throught the Years</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('testCurricular.index') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Stats Throught the Years</li>
                    </ol>
                </nav>
            </div>
        
                    <div class="section-divider"></div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="page-box animate-fade-in">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="bi bi-collection-fill me-2"></i>Stats</h5>
                        {{-- <button id="toggleButton" class="btn smart-btn-primary" onclick="toggleContent()">
                            <i class="bi bi-plus-circle"></i> Update Stats
                        </button> --}}
                    </div>
                    
                    <!-- FAQ Form -->
                    <div id="videoContent"  class="animate-fade-in">
                        <div class="form-section mt-3 mb-4">
                            <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i>{{ $faq ? 'Update Stats' : 'Update Stats' }}</h5>
                            
                            <form action="{{ $faq ? route('faq.update', $faq->id) : route('faq.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                @if($faq)
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label for="established" class="form-label">Established Year</label>
                                    <input type="text" name="established" value="{{ old('established', $faq->established ?? '') }}" class="form-control" required>
                                    @error('established')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="manufacturing_units" class="form-label">Manufacturing Units</label>
                                    <input type="text" name="manufacturing_units" value="{{ old('manufacturing_units', $faq->manufacturing_units ?? '') }}" class="form-control" required>
                                    @error('manufacturing_units')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="employees" class="form-label">Employees</label>
                                    <input type="text" name="employees" value="{{ old('employees', $faq->employees ?? '') }}" class="form-control" required>
                                    @error('employees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="global_reach" class="form-label">Global Reach</label>
                                    <input type="text" name="global_reach" value="{{ old('global_reach', $faq->global_reach ?? '') }}" class="form-control">
                                    @error('global_reach')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn smart-btn-primary">{{ $faq ? 'Update' : 'Create' }}</button>
                            </form>
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