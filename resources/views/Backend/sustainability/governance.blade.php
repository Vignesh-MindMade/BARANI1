@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bootstrap-tagsinput/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    .bootstrap-tagsinput {
  width: 100%;
  min-height: 38px;
  padding: 6px 12px;
  line-height: 1.5;
  border: 1px solid #ced4da;
  border-radius: 0.375rem;
  background-color: #fff;
  display: flex;
  flex-wrap: wrap;
}
.bootstrap-tagsinput .tag {
  margin-right: 4px;
  color: #fff;
  background-color: #007bff;
  border-radius: 0.2rem;
  padding: 4px 8px;
}
.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.quick-link-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    text-decoration: none;
    color: #0f172a;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: all 0.25s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.03);
}

.quick-link-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    border-color: #c7d2fe;
}

.quick-link-icon {
    font-size: 26px;
    background: #eef2ff;
    width: 46px;
    height: 46px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1e3a8a;
}

.quick-link-title {
    font-size: 18px;
    font-weight: 600;
    margin: 6px 0 0;
}

.quick-link-desc {
    font-size: 14px;
    color: #6b7280;
    margin: 0 0 12px;
}

.quick-link-btn {
    margin-top: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #0b1f66;
    color: #ffffff;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.25s ease;
}

.quick-link-card:hover .quick-link-btn {
    background: #102a8c;
}

</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">
                        <i class="fas fa-leaf text-primary me-2"></i> Sustainability Governance
                    </h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="psg-p-btn" onclick="toggleGovernanceForm()">
                        <i class="fas fa-plus-circle me-2"></i> Add Governance Content
                    </button>
                </div>
            </div>

            <div id="governanceForm" style="display: none;">
                <div class="form-section mb-4">
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-plus"></i> Add Governance Item
                    </h6>
                    <form action="{{ route('sustainability.governance.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Points</label>
                                    <input type="text" class="form-control tagsinput" name="points"
                                           value="{{ old('points') }}" placeholder="Add points (comma-separated)">
                                    @error('points') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i> Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-black">
                                <i class="fas fa-list me-2"></i> Governance Content List
                            </h5>
                        </div>
                        <div class="card-body">
                            @forelse($governances as $gov)
                                <div class="form-section mb-4">
                                    <form action="{{ route('sustainability.governance.update', $gov->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $gov->title }}" required>
                                            </div>

                                            <div class="col-md-5">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3" required>{{ $gov->description }}</textarea>
                                            </div>

                                            <div class="col-md-6">
                        <label class="form-label">Points</label>
                        <input type="text" class="form-control tagsinput" name="points"
                               value="{{ $gov->points }}">
                    </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="fas fa-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteGovernance({{ $gov->id }})">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <p class="text-center py-3 mb-0">No governance content found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="quick-links-grid">

    <a href="{{ route('sustainability.social.index') }}" class="quick-link-card">
        <div class="quick-link-icon">👥</div>
        <h4 class="quick-link-title">Social CSR</h4>
        <p class="quick-link-desc">Manage social responsibility content.</p>
        <span class="quick-link-btn">Go to Social CSR →</span>
    </a>

    <a href="{{ route('sustainability.certificates.index') }}" class="quick-link-card">
        <div class="quick-link-icon">📄</div>
        <h4 class="quick-link-title">Certificates</h4>
        <p class="quick-link-desc">Upload and manage certificates.</p>
        <span class="quick-link-btn">Go to Certificates →</span>
    </a>

    <a href="{{ route('sustainability.backend') }}" class="quick-link-card">
        <div class="quick-link-icon">⬅️</div>
        <h4 class="quick-link-title">Back</h4>
        <p class="quick-link-desc">Return to sustainability index.</p>
        <span class="quick-link-btn">Back to Index</span>
    </a>

</div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bootstrap-tagsinput/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


<script>
$(document).ready(function() {
    $('.tagsinput').each(function() {
        const hidden = $($(this).data('hidden'));
        const input = $(this);

        input.tagsinput({
            trimValue: true,
            confirmKeys: [13, 44], // Enter and comma
        });

        // Sync whenever tags change
        input.on('itemAdded itemRemoved', function() {
            hidden.val(input.tagsinput('items').join(','));
        });

        // Initial sync
        hidden.val(input.tagsinput('items').join(','));
    });
});

// Toggle form
function toggleGovernanceForm() {
    $('#governanceForm').slideToggle(300);
}

// Delete with confirmation
function deleteGovernance(id) {
    Swal.fire({
        title: 'Delete this item?',
        text: "This cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/sustainability/governance/${id}`;

            const token = document.createElement('input');
            token.type = 'hidden';
            token.name = '_token';
            token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
<script>
$(document).ready(function() {
    $('.tagsinput').each(function() {
        const $input = $(this);
        const hiddenId = $input.data('hidden');
        const $hidden = $(hiddenId);

        // Initialize Bootstrap TagsInput
        $input.tagsinput({
            trimValue: true,
            confirmKeys: [13, 44] // Enter and comma
        });

        // Update hidden input on change
        $input.on('itemAdded itemRemoved change', function() {
            const items = $input.tagsinput('items');
            $hidden.val(items.join(','));
        });

        // Sync existing value
        const current = $hidden.val();
        if (current) {
            current.split(',').forEach(v => {
                if (v.trim()) $input.tagsinput('add', v.trim());
            });
        }
    });
});
</script>
@endsection
