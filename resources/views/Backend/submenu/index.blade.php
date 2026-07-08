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
}
</style>
@endsection

@section('wrapper')

<div class="page-wrapper">
    <div class="page-box p-4">

        {{-- Header --}}
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="page-title mb-0">
                    <i class="fas fa-layer-group text-primary me-2"></i> Manage Group Submenus
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
                        <li class="breadcrumb-item active">Group Submenus</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- CREATE / EDIT FORM --}}
        <div class="form-section mb-4">
            <div class="form-header">
                <h5 class="mb-0 text-primary">
                    {{ isset($edit) ? 'Edit Submenu' : 'Create New Submenu' }}
                </h5>
            </div>

            <form action="{{ isset($edit) ? route('groupsubmenu.update', $edit->id) : route('groupsubmenu.store') }}" method="POST">
                @csrf
                @if(isset($edit))
                    @method('PUT')
                @endif

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">Submenu Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               name="submenu_name"
                               value="{{ $edit->submenu_name ?? old('submenu_name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control"
                               name="sort_id"
                               value="{{ $edit->sort_id ?? old('sort_id', 0) }}">
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-primary px-4">
                            {{ isset($edit) ? 'Update' : 'Create' }}
                        </button>

                        @if(isset($edit))
                            <a href="{{ route('groupsubmenu.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        {{-- SUBMENU LIST SECTION --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i> Existing Submenus</span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Submenu Name</th>
                                <th>Sort</th>
                                <th>Linked Pages</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($submenus as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->submenu_name }}</td>
                                    <td>{{ $row->sort_id }}</td>
                                    <td>{{ $row->pages->count() }} page(s)</td>

                                    <td class="btnnn">
                                        <a href="{{ route('groupsubmenu.index', ['edit' => $row->id]) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('groupsubmenu.destroy', $row->id) }}"
                                              method="POST" style="display:contents">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this submenu?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('groupsubmenu.pages.index', $row->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
