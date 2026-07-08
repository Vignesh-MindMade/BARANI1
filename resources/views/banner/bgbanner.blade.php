@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section("wrapper")
<style>
        .modal-dialog {
        max-width: min(800px, 90%) !important;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        

        <!--<div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--        <div class="page-box">-->
        <!--            <div class="">-->

        <!--                <form  id="BannerForm" action="{{ route('banner.save') }}" method="POST" enctype="multipart/form-data">-->
        <!--                    @csrf-->
        <!--                    <div class="mb-3">-->
        <!--                        <label for="image" class="form-label">Backgroung Image</label>-->
        <!--                        <input class="form-control" type="file" id="image" name="image" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>-->
        <!--                        <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">-->
        <!--                    </div>-->
        <!--                    <div class="mb-3">-->
        <!--                        <label for="sort_id" class="form-label">Sort ID</label>-->
        <!--                        <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Sort ID" aria-label="Sort ID">-->
        <!--                    </div>-->
        <!--                    <button type="submit" class="btn btn-primary">Save</button>-->
        <!--                </form>-->

        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="">
           <h2 class="mb-0 text-uppercase">Background Image</h2>
            <div class="">
                <div class="page-box">
                    <div class="">
                        <div class="table-responsive">
                             <table class="table mb-0">
                                 <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bgbanners as $key => $banner)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('images/' . $banner->image) }}" style="max-width: 100px;"></td>
                                        <td class="text-center">

                                        <button
                                            type="button"
                                            class="psg-p-btn edit-btn ml-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $banner->id }}"
                                            data-image="{{ $banner->image }}"
                                            onclick="populateFormFieldsone(this)">
                                            Edit
                                        </button>

                                            <!--<form action="{{ route('bgbanner.delete', $banner->id) }}" method="POST" class="delete-form" style="display:inline;">-->
                                            <!--    @csrf-->
                                            <!--    @method('DELETE')-->
                                            <!--    <button type="button" class="psg-p-btn btn-danger delete-button"><i class="fa fa-trash"></i> Delete</button>-->
                                            <!--</form>-->
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog banner-modal ">
        <div class="modal-content page-box">

@foreach ($bgbanners as $banner)


            <form id="editFormOne" action="{{ route('bgbanner.update', $banner->id) }}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Background Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editBannerId" name="banner_id">

                    <div class=" w-100">
                        <label for="editImage" class="form-label">Background Image</label>
                        <input class="form-control" type="file" id="editImage" name="image" placeholder="Image" aria-label="Image" onchange="displayEditImage(event)" required>
                        
                    </div>
                    <img id="editPreviewImage" class="mb-3" src="{{ $banner->image ? asset('images/' . $banner->image) : '#' }}" alt="Uploaded Image" style="max-width: 100px; display: {{ $banner->image ? 'block' : 'none' }};">

                    <div class="mb-3 w-100">
                        <label for="editSortId" class="form-label">Order ID</label>
                        <input class="form-control" type="number"  value="{{ $banner->sort_id }}" id="editSortId" name="sort_id" placeholder="Order ID" aria-label="Sort ID">
                    </div>
                </div>

               <div class="d-c-c justify-content-center">
                    <button type="button" class="psg-p-btn btn-danger btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="psg-p-btn btn-primary">Save changes</button>
                </div>

            </form>
    @endforeach

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
    function populateFormFieldsone(button) {
        var id = button.getAttribute('data-id');
        var image = button.getAttribute('data-image');

        document.getElementById('imagePreview').src = image;
        document.getElementById('sort_id').value = sortId;

        // Update form action with the correct ID
        var form = document.getElementById('editFormOne');
        form.action = form.action.replace(/(\d+)/, id);
    }
</script>

<script>

    document.getElementById("image").addEventListener("change", function (event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function () {
            var oldImage = document.getElementById("oldImage");
            oldImage.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    });

</script>

<script>


function displayEditImage(event) {
    const [file] = event.target.files;
    const previewImage = document.getElementById('editPreviewImage');
    if (file) {
        previewImage.src = URL.createObjectURL(file);
        previewImage.style.display = 'block';
    } else {
        previewImage.src = '#';
        previewImage.style.display = 'none';
    }
}


    window.onload = function() {
        const preview = document.getElementById("editPreviewImage");
        if (preview.src) {
            preview.style.display = "block";
        }
    };

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


<script>
    $(document).ready(function () {
        $('#BannerForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('check.image') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.exists) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Only one image file is allowed.',
                        });
                    } else {
                        $('#BannerForm')[0].submit();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
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
