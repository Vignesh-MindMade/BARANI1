@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add News And Events</h6>
        <hr/>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('newsevents.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="image" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="image" name="image" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>
                             <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" type="text" id="description" name="description" placeholder="Description" aria-label="Description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date:</label>
                                <input type="date" class="form-control" id="event_date" name="event_date">
                            </div>
                            <hr/>
                            <div class="mb-3">
                                <label for="image1" class="form-label">Image1 </label>
                                <input class="form-control" type="file" id="image1" name="image1" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>
                             <div class="mb-3">
                            <label for="content1" class="form-label">Content1</label>
                            <input class="form-control" type="text" id="content1" name="content1" placeholder="Description" aria-label="Description">
                            </div>
                            <hr/>
                            <div class="mb-3">
                                <label for="image1" class="form-label">Image2 </label>
                                <input class="form-control" type="file" id="image2" name="image2" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>
                             <div class="mb-3">
                            <label for="content1" class="form-label">Content1</label>
                            <input class="form-control" type="text" id="content1" name="content1" placeholder="Description" aria-label="Description">
                            </div>
                            <hr/>
                            <div class="mb-3">
                                <label for="image3" class="form-label">Image3 </label>
                                <input class="form-control" type="file" id="image3" name="image3" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>
                             <div class="mb-3">
                            <label for="content3" class="form-label">Content3</label>
                            <input class="form-control" type="text" id="content3" name="content3" placeholder="Description" aria-label="Description">
                            </div>
                            <hr/>
                            <div class="mb-3"> 
                                <label for="image4" class="form-label">Image4 </label>
                                <input class="form-control" type="file" id="image4" name="image4" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>
                             <div class="mb-3">
                            <label for="content3" class="form-label">Content4</label>
                            <input class="form-control" type="text" id="content4" name="content4" placeholder="Description" aria-label="Description">
                            </div>
                            <div class="mb-3">
                                <label for="sort_id" class="form-label">Sort ID</label>
                                <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Sort ID" aria-label="Sort ID">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        <div class="page-content">
            <h6 class="mb-0 text-uppercase">News & Events</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($newsandevents as $key=> $event)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->name }}" style="max-width: 100px;"></td>
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
