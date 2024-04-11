@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add TopBar</h6>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('topbar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="topbar">TopBar:</label>
                                <input class="form-control" type="text" id="topbar" name="topbar" placeholder="TopBar" required>
                            </div>
                            <div class="mb-3">
                                <label for="link_text">Link Text:</label>
                                <input class="form-control" type="text" id="link_text" name="link_text" placeholder="Link Text" required>
                            </div>
                            <div class="mb-3">
                                <label for="link">Link:</label>
                                <input class="form-control" type="url" id="link" name="link" placeholder="Link">
                            </div>
                            <div class="mb-3">
                                <label for="sort_id">Sort Id:</label>
                                <input class="form-control" type="number" name="sort_id" placeholder="SortId" aria-label="SortId">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="page-content">
            <h6 class="mb-0 text-uppercase">TopBar List</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>TopBar Text</th>
                                        <th>Link Text</th>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topbars as $key=> $topbar)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $topbar->title }}</td>
                                        <td>{{ $topbar->link_text }}</td>
                                        <td>{{ $topbar->link }}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <a href="" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <!-- Delete button -->
                                            <form action="{{ route('topbar.delete', $topbar->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
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
        <!--end row-->
    </div>
</div>
@endsection
@section("script")
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    function displayImage(event) {
        var image = document.getElementById('previewImage');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    }
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });


</script>
@endsection
