@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
@endsection


@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
       



 
    <button id="Mainmenubutton" class="psg-p-btn mt-3" onclick="MainmenutoggleContent()">Add New Menus</button>

    <button id="Submenus" class="psg-p-btn mt-3" ><a href="{{ route('menus.submenu') }}" style="text-decoration: none; color:white;">Add New Submenus </a></button>

        <div class="page-box mt-5" id="MainMenuContetnt" style="display: none;"> 
                
   

        <h2 class="mt-5 mb-20">Update/Delete</h2>
        <div class="page-box mt-0">
        <table class="table mb-0" id="example">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                 
                    <th>Sort ID</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus ?? [] as $key => $menu)
                    <tr id="row-{{ $menu->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menu->name }}</td>
                    
                        <td>{{ $menu->sort_id ?? '--' }}</td>
                        <td class="text-center">
                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#menuModal-{{ $menu->id }}">Edit</button>
                            <!-- Modal -->
                        </td>
                        <td class="text-center">
                            <form id="delete-form-{{ $menu->id }}" action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="psg-p-btn btn-danger" onclick="confirmDelete('{{ $menu->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    
                     <div class="modal fade" id="menuModal-{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Menu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" value="{{ $menu->name }}">
                                            </div>
                                                <div class="form-group">
                                                    <label for="modal_image">Image</label>
                                                    <input type="file" class="form-control" id="modal_image" name="image">
                                                    @if($menu->image)
                                                        <img src="{{ asset('images/' . $menu->image) }}" alt="Menu Image" width="100">
                                                    @endif
                                                </div>
                                                 <div class="form-group">
                                                <label for="name">Sort ID</label>
                                                <input type="text" class="form-control" id="sort_id" name="sort_id" placeholder="Add Name" value="{{ $menu->sort_id }}">
                                            </div>
                                                <div class="d-c-c justify-content-center">
                                                    <button type="submit" class="psg-p-btn"><span class="bi--save-fill"></span>Update</button>
                                                    <button type="button" class="psg-p-btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </tbody>
        </table>

       
       
    </div>

       <button id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()">Add New Menus</button>

        <div class="page-box mt-5" id="videoContent" style="display: none;"> 
                
                        
<div class=" mt-0">
        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" required>
                    </div>
                    {{-- <div class="mb-3 w-50-p">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" aria-label="Image" onchange="previewImage(event)" required>
                        <img id="image_preview" src="#" alt="Uploaded Image" style="max-width: 100px; display: none; margin-top: 10px;">
                    </div> --}}
                    <div class="mb-3 w-50-p">
                        <label for="sort_id">Sort ID</label>
                        <input type="text" class="form-control" id="sort_id" name="sort_id" placeholder="Add Sort ID" required>
                    </div>

            <button type="submit" class="psg-p-btn ml-0"><span class="bi--save-fill"></span> Submit</button>
        </form>
</div>
                 </div>
                 </div>






        <script>
            function previewImage(event) {
                var image = document.getElementById('image_preview');
                image.src = URL.createObjectURL(event.target.files[0]);
                image.style.display = 'block';
            }
        </script>
     

        <!--end row-->
    </div>
</div>






<!-- Edit Modal -->


@endsection

@section("script")
<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>


// Toggle add new section: 

        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.textContent = "Close";
            } else {
                content.style.display = "none";
                button.textContent = "Add New Menus";
            }
        }

// Toggle add new section: 

        function MainmenutoggleContent() {
            let content = document.getElementById("MainMenuContetnt");
            let button = document.getElementById("Mainmenubutton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.textContent = "Close";
            } else {
                content.style.display = "none";
                button.textContent = "Add New Menus";
            }
        }


        
        
// Data Table: 

    $(document).ready(function () {
        $("#example").DataTable();
    });
    
</script>


 <script>
            function confirmDelete(menuId) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + menuId).submit();
                    }
                });
            }
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
