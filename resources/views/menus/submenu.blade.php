@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Sub Menus</h6>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('menus.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <select class="form-control" name="menu_id" required>
                                    <option value="">Select Menu</option>
                                    @foreach($submenus as $menu)
                                        <option value="{{ $menu->menu->id }}">{{ $menu->menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" name="submenu" placeholder="Submenu" aria-label="submenu" required>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="number" name="sort_id" placeholder="SortId" aria-label="SortId">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Sub Menu List</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Menu</th>
                                        <th>SubMenu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submenus as $key => $submenu)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $submenu->menu->name }}</td>
                                        <td>{{ $submenu->submenu }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end row-->
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
