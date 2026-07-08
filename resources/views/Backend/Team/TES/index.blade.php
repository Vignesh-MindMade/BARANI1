@extends('layouts.app')

@section('style')
<style>
    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }
    
    .org-level {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin: 1.5rem 0;
        flex-wrap: wrap;
    }
    
    .team-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 1.5rem;
        text-align: center;
        min-width: 200px;
        max-width: 250px;
        transition: transform 0.2s;
    }
    
    .team-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .team-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem;
        border: 3px solid #e5e7eb;
    }
    
    .team-name {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .team-designation {
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    .level-connector {
        width: 2px;
        height: 30px;
        background: #d1d5db;
        margin: 0 auto;
    }
    
    .form-section {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #3b82f6;
    }
    
    .form-section h5 {
        color: #1f2937;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .preview-image {
        max-width: 100px;
        max-height: 100px;
        border-radius: 8px;
        margin-top: 0.5rem;
    }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Our Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Team</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTeamModal">
                    <i class="bx bx-edit"></i> Edit Team Structure
                </button>
            </div>
        </div>

        <!-- Team Organization Chart -->
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Meet Our Team</h4>
                
                <div class="org-chart">
                    <!-- Level 1: Managing Director -->
                    <div class="org-level">
                        <div class="team-card">
                            <img src="{{ $teamtests?->manging_director_image ? asset($teamtests->manging_director_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="MD" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->manging_director_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->manging_director_designation ?? 'Managing Director' }}</div>
                        </div>
                    </div>

                    <div class="level-connector"></div>

                    <!-- Level 2: Directors Row -->
                    <div class="org-level">
                        <div class="team-card">
                            <img src="{{ $teamtests?->works_director_image ? asset($teamtests->works_director_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="Works Director" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->works_director_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->works_director_designation ?? 'Works Director' }}</div>
                        </div>

                        <div class="team-card">
                            <img src="{{ $teamtests?->works_director_and_technical_director_image ? asset($teamtests->works_director_and_technical_director_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="Works & Technical Director" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->works_director_and_technical_director_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->works_director_and_technical_director_designation ?? 'Works & Technical Director' }}</div>
                        </div>

                        <div class="team-card">
                            <img src="{{ $teamtests?->technical_director_image ? asset($teamtests->technical_director_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="Technical Director" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->technical_director_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->technical_director_designation ?? 'Technical Director' }}</div>
                        </div>

                        <div class="team-card">
                            <img src="{{ $teamtests?->director_image ? asset($teamtests->director_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="Director" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->director_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->director_designation ?? 'Director' }}</div>
                        </div>
                    </div>

                    <div class="level-connector"></div>

                    <!-- Level 3: GM Operations -->
                    <div class="org-level">
                        <div class="team-card">
                            <img src="{{ $teamtests?->gm_operations_one_image ? asset($teamtests->gm_operations_one_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="GM Operations 1" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->gm_operations_one_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->gm_operations_one_designation ?? 'GM Operations' }}</div>
                        </div>

                        <div class="team-card">
                            <img src="{{ $teamtests?->gm_operations_two_image ? asset($teamtests->gm_operations_two_image) : asset('assets/images/avatars/default-avatar.png') }}" 
                                 alt="GM Operations 2" class="team-avatar">
                            <div class="team-name">{{ $teamtests?->gm_operations_two_name ?? '—' }}</div>
                            <div class="team-designation">{{ $teamtests?->gm_operations_two_designation ?? 'GM Operations' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('team_test.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modal-header">
                    <h5 class="modal-title">Edit Team Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    
                    <!-- Managing Director -->
                    <div class="form-section">
                        <h5>Managing Director</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="manging_director_name" 
                                       value="{{ old('manging_director_name', $teamtests->manging_director_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="manging_director_designation" 
                                       value="{{ old('manging_director_designation', $teamtests->manging_director_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="manging_director_image" accept="image/*">
                                @if($teamtests->manging_director_image && file_exists(public_path($teamtests->manging_director_image)))
                                    <img src="{{ asset($teamtests->manging_director_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Works Director -->
                    <div class="form-section">
                        <h5>Works Director</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="works_director_name" 
                                       value="{{ old('works_director_name', $teamtests->works_director_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="works_director_designation" 
                                       value="{{ old('works_director_designation', $teamtests->works_director_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="works_director_image" accept="image/*">
                                @if($teamtests->works_director_image && file_exists(public_path($teamtests->works_director_image)))
                                    <img src="{{ asset($teamtests->works_director_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Works & Technical Director -->
                    <div class="form-section">
                        <h5>Works & Technical Director</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="works_director_and_technical_director_name" 
                                       value="{{ old('works_director_and_technical_director_name', $teamtests->works_director_and_technical_director_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="works_director_and_technical_director_designation" 
                                       value="{{ old('works_director_and_technical_director_designation', $teamtests->works_director_and_technical_director_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="works_director_and_technical_director_image" accept="image/*">
                                @if($teamtests->works_director_and_technical_director_image && file_exists(public_path($teamtests->works_director_and_technical_director_image)))
                                    <img src="{{ asset($teamtests->works_director_and_technical_director_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Technical Director -->
                    <div class="form-section">
                        <h5>Technical Director</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="technical_director_name" 
                                       value="{{ old('technical_director_name', $teamtests->technical_director_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="technical_director_designation" 
                                       value="{{ old('technical_director_designation', $teamtests->technical_director_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="technical_director_image" accept="image/*">
                                @if($teamtests->technical_director_image && file_exists(public_path($teamtests->technical_director_image)))
                                    <img src="{{ asset($teamtests->technical_director_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Director -->
                    <div class="form-section">
                        <h5>Director</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="director_name" 
                                       value="{{ old('director_name', $teamtests->director_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="director_designation" 
                                       value="{{ old('director_designation', $teamtests->director_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="director_image" accept="image/*">
                                @if($teamtests->director_image && file_exists(public_path($teamtests->director_image)))
                                    <img src="{{ asset($teamtests->director_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- GM Operations 1 -->
                    <div class="form-section">
                        <h5>GM Operations 1</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="gm_operations_one_name" 
                                       value="{{ old('gm_operations_one_name', $teamtests->gm_operations_one_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="gm_operations_one_designation" 
                                       value="{{ old('gm_operations_one_designation', $teamtests->gm_operations_one_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="gm_operations_one_image" accept="image/*">
                                @if($teamtests->gm_operations_one_image && file_exists(public_path($teamtests->gm_operations_one_image)))
                                    <img src="{{ asset($teamtests->gm_operations_one_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- GM Operations 2 -->
                    <div class="form-section">
                        <h5>GM Operations 2</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="gm_operations_two_name" 
                                       value="{{ old('gm_operations_two_name', $teamtests->gm_operations_two_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="gm_operations_two_designation" 
                                       value="{{ old('gm_operations_two_designation', $teamtests->gm_operations_two_designation) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="gm_operations_two_image" accept="image/*">
                                @if($teamtests->gm_operations_two_image && file_exists(public_path($teamtests->gm_operations_two_image)))
                                    <img src="{{ asset($teamtests->gm_operations_two_image) }}" class="preview-image" alt="Current">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Team</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Show success message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Show validation errors
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: '<ul style="text-align: left;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
        });
    @endif
</script>
@endsection