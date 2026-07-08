@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <style>
        .page-wrapper { background: #f5f7fa; min-height: 100vh; padding: 20px; }
        .page-box { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .form-section { background: #f9fafb; border-radius: 10px; padding: 20px; border: 1px solid #e0e0e0; }
        .form-header { border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
        .btn-primary { background: linear-gradient(90deg,#007bff,#0056b3); border:none; }
        .btn-primary:hover { background: linear-gradient(90deg,#0056b3,#003d80); }
        .card { border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { background:#007bff; color:#fff; font-weight:600; border-radius:12px 12px 0 0; }
        .table th { font-weight:600; color: #000000 }
        .table th, .table td { vertical-align: middle; }
        td.btnnn {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 8px;
        }
    </style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-box p-4">
        <!-- Header -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="page-title mb-0">
                    <i class="fas fa-bars text-primary me-2"></i> Manage Capabilities Menus
                </h3>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Capabilities Menus</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Success / Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- CREATE / EDIT FORM -->
        <div class="form-section mb-5">
            <div class="form-header">
                <h5 class="mb-0 text-primary">
                    {{ isset($edit) ? 'Edit Capabilities Menu' : 'Create New Capabilities Menu' }}
                </h5>
            </div>

            <form action="{{ isset($edit) ? route('capsubmenu.update', $edit->id) : route('capsubmenu.store') }}" method="POST">
                @csrf
                @if(isset($edit))
                    @method('PUT')
                @endif

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Menu Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                               name="menu_name"
                               value="{{ $edit->menu_name ?? old('menu_name') }}"
                               required autofocus>
                        @error('menu_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_id') is-invalid @enderror"
                               name="sort_id"
                               value="{{ $edit->sort_id ?? old('sort_id', 0) }}"
                               min="0">
                        @error('sort_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            {{ isset($edit) ? 'Update Menu' : 'Create Menu' }}
                        </button>
                        @if(isset($edit))
                            <a href="{{ route('capsubmenu.index') }}" class="btn btn-secondary px-4 ms-2">Cancel</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- MENU LIST -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i> Existing Capabilities Menus</span>
                <small>Total: {{ $menus->count() }}</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Menu Name</th>
                                <th class="text-center">Sort</th>
                                <th class="text-center">Submenus</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $row->menu_name }}</td>
                                    <td class="text-center">{{ $row->sort_id }}</td>
                                    <td class="text-center">
                                        {{-- {{ $row->submenus_count ?? $row->submenus->count() }} --}}
                                    </td>
                                <td class="btnnn">
    <!-- Edit Menu -->
    <a href="{{ route('capsubmenu.index', ['edit' => $row->id]) }}"
       class="btn btn-sm btn-warning" title="Edit Menu">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Menu -->
    <form action="{{ route('capsubmenu.destroy', $row->id) }}"
          method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this capabilities menu?\nPages will NOT be deleted automatically.')"
                title="Delete Menu">
            <i class="fas fa-trash"></i>
        </button>
    </form>

    <!-- Manage / Create Page for this Menu -->
    @if ($row->page)  <!-- assuming you added hasOne('page') relation -->
        <a href="{{ route('capsubmenu.pages.index', ['menu' => $row->id, 'edit' => $row->page->id]) }}"
           class="btn btn-sm btn-primary" title="Edit Page">
            <i class="fas fa-file-alt"></i> Edit Page
        </a>
    @else
        <a href="{{ route('capsubmenu.pages.index', ['menu' => $row->id]) }}"
           class="btn btn-sm btn-success" title="Create Page">
            <i class="fas fa-plus"></i> Create Page
        </a>
    @endif
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                        No capabilities menus created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection