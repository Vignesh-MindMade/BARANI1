@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Principal Message</h6>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('message.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Menu" aria-label="Menu" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description" aria-label="Description" style="min-height: 100px;" ></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File:</label>
                                <input class="form-control" type="file" id="file" name="file" placeholder="File" aria-label="File" required onchange="displayImage(event)">
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Principal Message</h6>
            <hr/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Description</th> <!-- Setting width for Description column -->
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $key=> $message)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->description }}</td> <!-- Setting width for Description column -->
                                        <td>
                                            @if (Str::endsWith($message->file, ['.mp4', '.avi', '.mov', '.wmv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('images/' . $message->file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            @else
                                            <img src="{{ asset('images/' . $message->file) }}" alt="{{ $message->file }}" style="max-width: 100px;">
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
