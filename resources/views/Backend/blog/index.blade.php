@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<style>
    .blog-card { transition: all 0.3s; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .type-badge { font-size: 0.75rem; }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="py-4 px-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h3><i class="fas fa-blog text-primary"></i> Blog Management</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Blog
                    </a>
                    <a href="{{ route('blog-settings') }}" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-cog"></i> Page Settings
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card blog-card h-100">
                        <img src="{{ $blog->thumbnail ? asset('storage/'.$blog->thumbnail) : asset('assets/images/default-blog.jpg') }}"
                             class="card-img-top" style="height: 180px; object-fit: cover;" alt="Thumbnail">

                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="text-muted small">{{ Str::limit(strip_tags($blog->description), 90) }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-{{ $blog->status ? 'success' : 'warning' }} type-badge">
                                    {{ $blog->status ? 'Published' : 'Draft' }}
                                </span>
                                <span class="badge bg-info type-badge">{{ ucfirst($blog->type) }}</span>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="btn-group w-100">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteBlog({{ $blog->id }}, '{{ addslashes($blog->title) }}')" 
                                        class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h4>No blogs yet</h4>
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create First Blog</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteBlog(id, title) {
    Swal.fire({
        title: 'Delete Blog?',
        text: `"${title}" will be permanently deleted.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('blogs') }}/${id}`;
            form.innerHTML = `@csrf @method('DELETE')`;
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection