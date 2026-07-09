@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
    /* Existing styles */
    .page-wrapper { background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%); min-height: 100vh; padding: 20px; }
    .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; margin-bottom: 30px; }
    .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
    .psg-p-btn { background: linear-gradient(90deg, #007bff, #0056b3); color: #fff; border-radius: 25px; padding: 8px 20px; transition: all 0.3s ease; border: none; }
    .psg-p-btn:hover { background: linear-gradient(90deg, #0056b3, #003d80); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .blog-table th { background: #1a3a5c; color: white; font-weight: 500; font-size: 13px; }
    .blog-table td { vertical-align: middle; font-size: 13px; }
    .type-badge-custom { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 500; color: white; display: inline-flex; align-items: center; gap: 4px; }
    .thumb-img { width: 60px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
    .action-btn { width: 32px; height: 32px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.2s; }
    .action-btn:hover { transform: translateY(-2px); }
    .btn-edit { background: #17a2b8; color: white; }
    .btn-delete { background: #dc3545; color: white; }
    .btn-view { background: #28a745; color: white; }
    .status-active { background: #28a745; color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; }
    .status-inactive { background: #6c757d; color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; }

    /* New styles for banner */
    .page-banner {
        background: url('{{ $blog->banner_image_url ?? asset('images/default-banner.jpg') }}') no-repeat center center;
        background-size: cover;
        color: white;
        padding: 60px 20px;
        text-align: center;
        border-radius: 12px;
        margin-bottom: 30px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden; /* Ensures banner content stays within bounds */
    }
    .page-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); /* Dark overlay */
        z-index: 1;
    }
    .page-banner h1 {
        position: relative;
        z-index: 2;
        font-size: 2.5rem;
        margin: 0;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    }
    .section-header {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .section-header h2 {
        color: #1a3a5c;
        font-size: 1.8rem;
        margin-bottom: 0;
    }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="banner-manager-container py-4 px-4">

            {{-- Page Banner --}}
            @if($blog->banner_image || $blog->banner_title)
                <div class="page-banner" style="background-image: url('{{ $blog->banner_image_url }}');">
                    <h1>{{ $blog->banner_title ?: 'Blog Posts' }}</h1>
                </div>
            @endif

            {{-- Section Header --}}
            <div class="section-header">
                <h2>{{ $blog->section1_title ?: 'Our Blog Feed' }}</h2>
                @if($blog->section1_subtitle)<p class="text-muted mb-0">{{ $blog->section1_subtitle }}</p>@endif
                @if($blog->section1_description)<div class="mt-2 text-muted">{!! Str::markdown($blog->section1_description) !!}</div>@endif
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Blog List --}}
            <div class="form-section">
                <div class="form-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i> All Blogs</h5>
                    <a href="{{ route('blogs-admin.create') }}" class="btn psg-p-btn">
                        <i class="fas fa-plus me-2"></i> Add New Blog
                    </a>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table blog-table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="80">Banner</th>
                                <th>Title & Description</th>
                                <th width="80">Type</th>
                                <th width="100">Date</th>
                                <th width="60">Order</th>
                                <th width="70">Status</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>
                                        <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->banner_title ?: $blog->title }}" class="thumb-img">
                                    </td>
                                    <td>
                                        <strong style="color: #1a3a5c; font-size: 14px;">{{ Str::limit($blog->title, 45) }}</strong>
                                        <div class="text-muted" style="font-size: 12px; margin-top: 2px;">{{ Str::limit($blog->description, 70) }}</div>
                                    </td>
                                    <td>
                                        <span class="type-badge-custom" style="background: {{ $blog->type_badge_color }};">
                                            @if($blog->type === 'pdf')
                                                <i class="fas fa-file-pdf"></i>
                                            @elseif($blog->type === 'video')
                                                <i class="fas fa-video"></i>
                                            @elseif($blog->type === 'image')
                                                <i class="fas fa-images"></i>
                                            @endif
                                            {{ $blog->type_label }}
                                        </span>
                                    </td>
                                    <td>{{ $blog->published_date?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $blog->sort_order }}</td>
                                    <td>
                                        @if($blog->is_active)
                                            <span class="status-active">Active</span>
                                        @else
                                            <span class="status-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('blogs-admin.edit', $blog) }}" class="action-btn btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('blogs.show', $blog) }}" target="_blank" class="action-btn btn-view" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="action-btn btn-delete" title="Delete" onclick="confirmDelete({{ $blog->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        No blogs found. <a href="{{ route('blogs-admin.create') }}">Create one</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($blogs->hasPages())
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Hidden delete forms --}}
@foreach($blogs as $blog)
    <form id="delete-form-{{ $blog->id }}" action="{{ route('blogs-admin.destroy', $blog) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endforeach
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Delete Blog?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection