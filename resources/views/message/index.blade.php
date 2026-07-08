@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h2 class="mb-0 text-uppercase">Add Principal Message</h2>
        <div class="row">
            <div class="col-md-12">
                 <div class="page-box">
                        <div class="">
                            <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach($messages as $message)
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $message->name) }}">
                                    </div>
                                    <!--<div class="mb-3">-->
                                    <!--    <label for="number">Contact Info</label>-->
                                    <!--    <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $message->number) }}">-->
                                    <!--</div>-->
                                    <!--<div class="mb-3">-->
                                    <!--    <label for="mail">Email</label>-->
                                    <!--    <input type="text" class="form-control" id="mail" name="mail" value="{{ old('mail', $message->mail) }}">-->
                                    <!--</div>-->
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" style="width: 100%; height: 150px;">{{ old('description', $message->description) }}</textarea>
                                    </div>
                                    <div class="mb-3 d-flex flex-column ">
                                        <label for="file">Principal Image</label>
                                        <input type="file" class="form-control-file" id="file" name="file" onchange="previewfile(event)">
                                        @if ($message->file)
                                            <img id="filePreview" src="{{ asset('images/' . $message->file) }}" alt="Trustee Image" style="max-width: 200px; margin-top: 10px;">
                                        @else
                                            <img id="filePreview" src="#" alt="" style="max-width: 200px; margin-top: 10px; display: none;">
                                        @endif
                                    </div>
                                
                                <!--<div class="mb-3">-->
                                <!--    <label for="quotes">Quote</label>-->
                                <!--    <input type="text" class="form-control" id="quotes" name="quotes" value="{{ old('quotes', $message->quotes) }}">-->
                                <!--</div>-->
                                <!--<div class="mb-3">-->
                                <!--    <label for="author">Author Name</label>-->
                                <!--    <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $message->author) }}">-->
                                <!--</div>-->
                                @endforeach
                                
                                 <div class="d-c-c justify-content-center "><button type="submit" class="psg-p-btn"><span class="bi--save-fill"></span> Save</button>  </div>
                                
                            </form>
                            <script>
                                function previewfile(event) {
                                    const filereader = new FileReader();
                                    const fileField = document.getElementById('filePreview');
                    
                                    filereader.onload = function() {
                                        if (filereader.readyState === 2) {
                                            fileField.src = filereader.result;
                                            fileField.style.display = 'block';
                                        }
                                    };
                    
                                    filereader.readAsDataURL(event.target.files[0]);
                                }
                            </script>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade modal-lg" id="editModal12" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" style="margin-left: 25%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Menus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFormPrincipleMessage" action="{{ route('message.update', 0) }}" method="POST" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editMessageName" class="form-label">Name:</label>
                        <input class="form-control" type="text" id="editMessageName" name="name" placeholder="Menu" aria-label="Menu" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMessageDescription" class="form-label">Description:</label>
                        <textarea class="form-control" id="editMessageDescription" name="description" placeholder="Description" aria-label="Description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editMessageFile" class="form-label">File:</label>
                        <input class="form-control" type="file" id="editMessageFile" name="file" placeholder="File" aria-label="File" onchange="displayImageform(event)">
                        <img id="previewImage1" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 25%; margin: 0px 258px;">Update</button>
                </form>
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
    function populateFormFields(button) {
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var description = button.getAttribute('data-description');
        var file = button.getAttribute('data-file');

        document.getElementById('editMessageName').value = name;
        document.getElementById('editMessageDescription').value = description;

        var form = document.getElementById('editFormPrincipleMessage');
        form.action = form.action.replace(/\d+$/, id);

        // Display the old image if there is a file
        var previewImage = document.getElementById('previewImage1');
        if (file) {
            previewImage.src = file;
            previewImage.style.display = 'block';
        } else {
            previewImage.style.display = 'none';
        }
    }

    function displayImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('previewImage');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }


    function displayImageform(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('previewImage1');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.addEventListener('DOMContentLoaded', (event) => {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',

                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>


@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif
@endsection
