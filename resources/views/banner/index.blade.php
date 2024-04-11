@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Banner</h6>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" type="file" name="file" placeholder="File" aria-label="file" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
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
            <h6 class="mb-0 text-uppercase">Banner List</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Banner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $key => $banner)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if (Str::endsWith($banner->file, ['.mp4', '.avi', '.mov', '.wmv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('images/' . $banner->file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            @else
                                            <img src="{{ asset('images/' . $banner->file) }}" alt="{{ $banner->file }}" style="max-width: 100px;">
                                            @endif
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
