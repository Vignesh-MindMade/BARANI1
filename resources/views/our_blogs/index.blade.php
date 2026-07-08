@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
@endsection

<style>
    .box-style {
        border: 2px solid;
        margin: 1rem 0;
        color: #777474;
        padding: 5px;
        border-radius: 5px;
        position: relative;
    }

    .overlay-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: none;
        gap: 5px;
    }

    .box-style:hover .overlay-icons {
        display: flex;
    }

    .gallery-image:hover {
        border: 2px solid blue;
    }

    .selected-image {
        border: 2px solid red;
    }

    .toggleimg {
        cursor: pointer;
    }

    .nav-names {
        font-size: 19px;
        font-family: 'boxicons';
        color: #000000;
        font-weight: bolder;
    }

    .nav-names-active {
        font-size: 19px;
        font-family: 'boxicons';
        color: red;
        font-weight: bolder;
    }

    .psg-p-btn {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .psg-p-btn:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>

@section("wrapper")
<div class="page-wrapper">
    <div class="page-box page-content">
        <div class="row">
            <div class="col-md-3">



                <div class="card-header nav-names">
                    <a href="{{route('testCurricular.index')}}" class="nav-names-active">HOME PAGE</a>
                </div>
            </div>
        </div>

        <hr />

        <button type="button" id="toggleButtonHomeFirst" class="psg-p-btn mt-3" onclick="toggleContentHomeFirst()">Add Slide Banner</button>

        <div class="page-box mt-5" id="videoContentHomeFirst" style="display: none;">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- First Form -->
                        <form action="{{route('circulars.main.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" name="title" placeholder="Enter heading" required />
                            </div>

                            <div class="mb-3">
                                <label for="category_title" class="form-label">Paragraph <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="catagory_name" id="catagory_name" placeholder="Enter paragraph" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category_image" class="form-label">Background Image <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="catagory_image" name="catagory_image" required />
                            </div>

                            <div class="mb-3">
                                <label for="Linktxt1" class="form-label">Link Text 1</label>
                                <input class="form-control" id="Linktxt1" name="Linktxt1" placeholder="Link Text 1" />
                            </div>

                            <div class="mb-3">
                                <label for="Link1" class="form-label">Link 1</label>
                                <input class="form-control" id="Link1" name="Link1" placeholder="Link 1" />
                            </div>

                            <button type="button" id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()"> Add Link 2</button>

                            <div class="page-box mt-5" id="videoContent" style="display: none;">
                                <div class="mb-3">
                                    <label for="Linktxt2" class="form-label">Link Text 2</label>
                                    <input class="form-control" id="Linktxt2" name="Linktxt2" placeholder="Link Text 2" />
                                </div>
                                <div class="mb-3">
                                    <label for="Link2" class="form-label">Link 2</label>
                                    <input class="form-control" id="Link2" name="Link2" placeholder="Link 2" />
                                </div>

                                <button type="button" id="toggleButton3" class="psg-p-btn mt-3" onclick="toggleContent3()">Add Link 3</button>
                            </div>

                            <div class="page-box mt-5" id="videoContent3" style="display: none;">
                                <div class="mb-3">
                                    <label for="Linktxt3" class="form-label">Link Text 3</label>
                                    <input class="form-control" id="Linktxt3" name="Linktxt3" placeholder="Link Text 3" />
                                </div>

                                <div class="mb-3">
                                    <label for="Link3" class="form-label">Link 3</label>
                                    <input class="form-control" id="Link3" name="Link3" placeholder="Link 3" />
                                </div>
                            </div>

                            <button type="submit" class="psg-p-btn btn btn-primary">Save</button>
                        </form>

                        <div class="card-header mt-5" style="font-size: 19px; font-family: 'boxicons'; color: #514d4d; font-weight: bolder;">Home Page</div>
                        <div class="container mt-5">
                            <table id="cirrcularsHomePage" class="table table-striped table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Heading</th>
                                        <th>Background Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($circularsTest as $circular)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $circular->title }}</td>
                                        <td>
                                          
                                            <img src="{{ asset('images/' . $circular->catagory_image) }}" alt="Category Image" class="img-thumbnail" style="width: 100px;" />
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $circular->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('circulars.main.destroy', $circular->id) }}" method="POST" style="display: inline-block;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $circular->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $circular->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('circulars.main.update', $circular->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $circular->id }}">Edit Circular</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" class="form-control" name="title" value="{{ $circular->title }}" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="catagory_name" class="form-label">Paragraph</label>
                                                            <input type="text" class="form-control" name="catagory_name" value="{{ $circular->catagory_name }}" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="catagory_image" class="form-label">Category Image</label>
                                                            <input type="file" class="form-control" name="catagory_image" id="catagory_image" onchange="previewImage(event)" />
                                                            <div class="mt-2">
                                                                <img id="imagePreview{{ $circular->id }}" src="{{ asset('images/' . $circular->catagory_image) }}" alt="Category Image" class="img-thumbnail" style="width: 100px; height: auto; display: {{ $circular->catagory_image ? 'block' : 'none' }};" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Linktxt1" class="form-label">Link Text 1</label>
                                                            <input class="form-control" id="Linktxt1" value="{{ $circular->Linktxt1 }}" name="Linktxt1" placeholder="Link Text 1" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Link1" class="form-label">Link 1</label>
                                                            <input class="form-control" id="Link1" value="{{ $circular->Link1 }}" name="Link1" placeholder="Link 1" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Linktxt2" class="form-label">Link Text 2</label>
                                                            <input class="form-control" id="Linktxt2" value="{{ $circular->Linktxt2 }}" name="Linktxt2" placeholder="Link Text 2" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Link2" class="form-label">Link 2</label>
                                                            <input class="form-control" id="Link2" value="{{ $circular->Link2 }}" name="Link2" placeholder="Link 2" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Linktxt3" class="form-label">Link Text 3</label>
                                                            <input class="form-control" id="Linktxt3" value="{{ $circular->Linktxt3 }}" name="Linktxt3" placeholder="Link Text 3" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Link3" class="form-label">Link 3</label>
                                                            <input class="form-control" id="Link3" value="{{ $circular->Link3 }}" name="Link3" placeholder="Link 3" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <br>
        <br>
        <br>

       <button class="psg-p-btn btn btn-primary"><a style="color: white;" href="{{route('Cocurriculart.index')}}">Home Page Board Result</a></button>
       <br>
       <br>

       <button class="psg-p-btn btn btn-primary"><a style="color: white;" href="{{route('testimonial.index')}}">Home Page About Us</a></button>
   
    </div>
</div>
@endsection

@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script>
    
    // Toggle First Home Page: 
    function toggleContentHomeFirst() {
        let content = document.getElementById("videoContentHomeFirst");
        let button = document.getElementById("toggleButtonHomeFirst");

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
            button.textContent = "Close";
        } else {
            content.style.display = "none";
            button.textContent = "Add Slide Banner";
        }
    }
    // Toggle add new section: 
    function toggleContent() {
        let content = document.getElementById("videoContent");
        let button = document.getElementById("toggleButton");

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
            button.textContent = "Close";
        } else {
            content.style.display = "none";
            button.textContent = "Add Link 2";
        }
    }

    // Toggle add new section: 
    function toggleContent3() {
        let content = document.getElementById("videoContent3");
        let button = document.getElementById("toggleButton3");

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
            button.textContent = "Close";
        } else {
            content.style.display = "none";
            button.textContent = "Add Link 3";
        }
    }

    $(document).ready(function () {
        $("#cirrcularsHomePage").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm" + id).submit();
            }
        });
    }
</script>
@endsection