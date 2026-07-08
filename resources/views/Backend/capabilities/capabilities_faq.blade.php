@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<style>
    .page-wrapper { background:#f5f7fa; min-height:100vh; padding:20px; }
    .page-box { background:#fff; border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.05); }
    .psg-btn { background:#007bff; color:#fff; border-radius:25px; padding:8px 22px; border:none; }
    .psg-btn:hover { background:#0056b3; }
    .table thead { background:#007bff; color:#fff; }
    .faq-title-section { background:#f8f9fa; padding:15px; border-radius:8px; margin-bottom:20px; }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box p-4">
        {{-- PAGE TITLE AND ADD BUTTON --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="fas fa-question-circle me-2 text-primary"></i>Capabilities FAQ Manager
            </h3>
          
            <button class="psg-btn" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                <i class="fas fa-plus me-1"></i> Add FAQ
            </button>
        </div>
  {{-- FAQ TITLE SECTION --}}
<div class="faq-title-section mb-4">
    <form action="{{ route('capabilities.faq.updateTitle') }}" method="POST">
        @csrf
        @php
    $currentTitle = $faqs->first()->faq_title ?? '';
@endphp
        <label class="form-label fw-bold">FAQ Section Title</label>
     <input type="text" 
       name="faq_title" 
       class="form-control"
       value="{{ $currentTitle }}"
       placeholder="Frontend Display: {{ $currentTitle ?: 'FAQ Main Title' }}"
       required>

        <div class="text-end mt-2">
            <button class="btn btn-primary psg-btn">
                <i class="fas fa-save me-1"></i>Update Title
            </button>
        </div>
    </form>
</div>
        {{-- FAQ TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        {{-- <th>Title</th> --}}
                        <th>Question</th>
                        <th>Answer</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $faq->faq_title }}</td>  --}}
                        <td>{{ $faq->faq_question }}</td>
                        <td>{{ Str::limit($faq->faq_answers, 50) }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFaq{{ $faq->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm "style="margin-left: 5px;" onclick="deleteFaq({{ $faq->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No FAQ Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ADD FAQ MODAL - MOVED OUTSIDE LOOP --}}
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('capabilities.faq.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- SEPARATE SECTION FOR FAQ TITLE --}}
                    {{-- <div class="faq-title-section">
                        <label class="form-label fw-bold">FAQ Title (Section/Category)</label>
                        <input type="text" name="faq_title" class="form-control" placeholder="e.g., General, Billing, Technical" required>
                        <small class="text-muted">This groups related FAQs together.</small>
                    </div> --}}

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <label class="form-label">FAQ Question</label>
                            <input type="text" name="faq_question" class="form-control" placeholder="Enter the question" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">FAQ Answer</label>
                            <textarea name="faq_answers" class="form-control" rows="4" placeholder="Enter the answer" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT FAQ MODALS - MOVED OUTSIDE LOOP --}}
@foreach($faqs as $faq)
<div class="modal fade" id="editFaq{{ $faq->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('capabilities.faq.update', $faq->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="faq-title-section">
                        <label class="form-label fw-bold">FAQ Title (Section/Category)</label>
                        <input type="text" name="faq_title" class="form-control" value="{{ $faq->faq_title }}" required>
                        <small class="text-muted">This groups related FAQs together.</small>
                    </div> --}}

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <label class="form-label">FAQ Question</label>
                            <input type="text" name="faq_question" class="form-control" value="{{ $faq->faq_question }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">FAQ Answer</label>
                            <textarea name="faq_answers" class="form-control" rows="4" required>{{ $faq->faq_answers }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function deleteFaq(id) {
    Swal.fire({
        title: "Delete FAQ?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/capabilities/faq/delete/${id}`;

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
@endsection