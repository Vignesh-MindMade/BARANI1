@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Video Url</h6>
        <hr/>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('latestvideos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title" name="title" placeholder="Enter Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="link">Embedded Link</label>
                                <input class="form-control" type="url" id="link" name="link" placeholder="Add Embedded Link" aria-label="Embedded Link" required>
                                <small id="urlNote" class="form-text text-muted">Note: "https://www.youtube.com/embed/l6Z7qqF_XdQ?si=kGNUnKbMoRmhA8p_"</small>
                            </div>
                            <div class="mb-3">
                                <label for="sort_id">Sort ID</label>
                                <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Enter Sort ID" aria-label="Sort ID">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Our Latest Videos</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Url View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $key=> $video)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->link }}</td>
                                        <td><iframe width="300" height="200" src="{{ $video->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
