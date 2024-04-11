@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Testimonials</h6>
        <hr/>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data" id="testimonialForm">
                            @csrf
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title" name="title" placeholder="Enter Title" >
                                <div class="invalid-feedback">
                                    Please enter a valid title.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="content">Content</label>
                                <input class="form-control" type="text" id="content" name="content" placeholder="Enter Content" >
                                <div class="invalid-feedback">
                                    Please enter a valid content.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file">File</label>
                                <input class="form-control" type="file" id="file" name="file" aria-label="file" onchange="displayImage(event)" >
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                <div class="invalid-feedback">
                                    Please select a file.
                                </div>
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
                                        <th>Content</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonials as $key=> $testimonial)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $testimonial->title }}</td>
                                        <td>{{ $testimonial->content }}</td>
                                        <td>
                                            @if (Str::endsWith($testimonial->file, ['.mp4', '.avi', '.mov', '.wmv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('images/' . $testimonial->file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            @else
                                            <img src="{{ asset('images/' . $testimonial->file) }}" alt="{{ $testimonial->file }}" style="max-width: 100px;">
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

<script>
    // Client-side validation using regular expressions
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('testimonialForm').addEventListener('submit', function(event) {
            var title = document.getElementById('title').value;
            var content = document.getElementById('content').value;
            var file = document.getElementById('file').value;

            // Title validation: only allow alphabets, numbers, and spaces
            var titleRegex = /^[a-zA-Z0-9\s]+$/;
            if (!titleRegex.test(title)) {
                document.getElementById('title').classList.add('is-invalid');
                event.preventDefault();
            } else {
                document.getElementById('title').classList.remove('is-invalid');
            }

            // Content validation: only allow alphabets, numbers, and spaces
            var contentRegex = /^[a-zA-Z0-9\s]+$/;
            if (!contentRegex.test(content)) {
                document.getElementById('content').classList.add('is-invalid');
                event.preventDefault();
            } else {
                document.getElementById('content').classList.remove('is-invalid');
            }

            // File validation: check if file is selected
            if (file.trim() === '') {
                document.getElementById('file').classList.add('is-invalid');
                event.preventDefault();
            } else {
                document.getElementById('file').classList.remove('is-invalid');
            }
        });
    });

    // Function to display preview image
    function displayImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.getElementById('previewImage');
            img.src = event.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
