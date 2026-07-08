@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bootstrap-tagsinput/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .banner-manager-container { max-width: 1200px; margin: auto; }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .img-preview { border-radius: 8px; border: 1px solid #ddd; max-width: 120px; max-height: 120px; object-fit: cover; }
    .btn-primary { background: linear-gradient(90deg, #007bff, #0056b3); border: none; }
    .btn-primary:hover { background: linear-gradient(90deg, #0056b3, #003d80); }
    .table th, .table td { vertical-align: middle; }
      .table th {color: #171717;}
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
                    <h3 class="page-title mb-0"><i class="fas fa-certificate text-primary me-2"></i> Sustainability Certificates</h3>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('testCurricular.index') }}"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Certificates</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- CERTIFICATE TITLE FORM -->
            <div class="form-section mb-5">
                <div class="form-header">
                    <h5 class="mb-0 text-primary"><i class="fas fa-heading me-2"></i> Certificate Section Title</h5>
                </div>
                <form action="{{ route('sustainability.certtitle.storeOrUpdate') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Main Title</label>
                            <input type="text" class="form-control" name="main_title" 
                                   value="{{ $certTitle->main_title ?? '' }}" placeholder="Enter main heading">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sub Title</label>
                            <input type="text" class="form-control" name="sub_title" 
                                   value="{{ $certTitle->sub_title ?? '' }}" placeholder="Enter subtitle">
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Title</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ADD NEW CERTIFICATE -->
            <div class="form-section mb-5">
                <div class="form-header">
                    <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Add New Certificate</h5>
                </div>
                <form action="{{ route('sustainability.certificates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Sort ID</label>
                            <input type="number" class="form-control" name="sort_id" placeholder="1" />
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="Certificate name">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Upload PDF</label>
                            <input type="file" class="form-control" name="pdf" accept="application/pdf">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Certificate Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" 
                                   onchange="validateAndPreview(event,'newImagePreview')">
                            <div class="mt-2"><img id="newImagePreview" class="img-preview" style="display:none;"></div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Certificate</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- CERTIFICATES LIST -->
            <div class="card">
                <div class="card-header bg-primary text-black">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i> Certificate List</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Sort ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>PDF</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($certificates as $cert)
                                <tr>
                                    <td>{{ $cert->sort_id }}</td>
                                    <td>{{ $cert->title }}</td>
                                    <td>
                                        @if($cert->image)
                                            <img src="{{ asset('frontend/imgs/sus/'.$cert->image) }}" class="img-preview">
                                        @endif
                                    </td>
                                    <td>
                                        @if($cert->pdf)
                                            <a href="{{ asset('frontend/imgs/sus/'.$cert->pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-file-pdf"></i> View PDF
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('sustainability.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $cert->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $cert->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $cert->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('sustainability.certificates.update', $cert->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Certificate</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Sort ID</label>
                                                            <input type="number" class="form-control" name="sort_id" value="{{ $cert->sort_id }}">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" class="form-control" name="title" value="{{ $cert->title }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Replace Image</label>
                                                            <input type="file" class="form-control" name="image" accept="image/*">
                                                            @if($cert->image)
                                                                <div class="mt-2"><img src="{{ asset('frontend/imgs/sus/'.$cert->image) }}" class="img-preview"></div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Replace PDF</label>
                                                            <input type="file" class="form-control" name="pdf" accept="application/pdf">
                                                            @if($cert->pdf)
                                                                <div class="mt-2">
                                                                    <a href="{{ asset('frontend/imgs/sus/'.$cert->pdf) }}" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fas fa-file-pdf"></i> Current PDF</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr><td colspan="5" class="text-center py-3">No certificates found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
           <div class="quick-links-grid">

    <a href="{{ route('sustainability.governance.index') }}" class="quick-link-card">
        <div class="quick-link-icon">🏛️</div>
        <h4 class="quick-link-title">Governance</h4>
        <p class="quick-link-desc">Go back to governance section.</p>
        <span class="quick-link-btn">← Back to Governance</span>
    </a>

    <a href="{{ route('sustainability.social.index') }}" class="quick-link-card">
        <div class="quick-link-icon">👥</div>
        <h4 class="quick-link-title">Social</h4>
        <p class="quick-link-desc">Go back to social section.</p>
        <span class="quick-link-btn">← Back to Socials</span>
    </a>

    <a href="{{ route('sustainability.backend') }}" class="quick-link-card">
        <div class="quick-link-icon">⬅️</div>
        <h4 class="quick-link-title">Index</h4>
        <p class="quick-link-desc">Return to sustainability index.</p>
        <span class="quick-link-btn">← Back to Index</span>
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
function validateAndPreview(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    if (file) {
        const reader = new FileReader();
        reader.onload = () => { preview.src = reader.result; preview.style.display = 'block'; };
        reader.readAsDataURL(file);
    }
}

function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;
    Swal.fire({
        title: 'Delete this certificate?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then(result => {
        if (result.isConfirmed) form.submit();
    });
}
</script>
@endsection
