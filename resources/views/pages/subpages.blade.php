@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


@endsection

<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }
</style>
 

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        
       <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Life at Campus</h2>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Add Category
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <form action="{{ route('lifeatcampus.category') }}" method="POST" >
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        
                                        <span><strong>Update/Delete</strong></span>
                                           <table class="table mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Category</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                          <tbody>
                                           @foreach($categories ?? '' as $key => $category)
                                            <tr id="row-{{ $category->id }}">
                                                <td>{{ $key+1 }}</td>
                                                <td id="name-{{ $category->id }}">{{ $category->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sympModal-{{ $category->id }}">Edit</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="sympModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Category</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('category.update', $category->id) }}" method="POST" >
                                                                        @csrf
                                                                      <div class="mb-3">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" class="form-control w-100" id="name" name="name" value="{{ $category->name }}">
                                                                        </div>
                                                                        
                                                                        <div class="modal-footer">
                                                                             <button type="submit" class="btn btn-primary">Update</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                                       
                                                                    </form>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                               <form id="categorydelete" action="{{ route('category.delete', $category->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-xl btn-danger" onclick="CategoryDelete('{{ $category->id }}')">Delete</button>
                                                </form>
                                                </td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                </table>
                                        <script>
                                                function CategoryDelete(categoryId) {
                                                    Swal.fire({
                                                        title: "Are you sure?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        cancelButtonColor: "#d33",
                                                        confirmButtonText: "Delete"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('categorydelete').action = "{{ route('category.delete', ':id') }}".replace(':id', categoryId);
                                                            document.getElementById('categorydelete').submit();
                                                        }
                                                    });
                                                }
                                    </script>
                        
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Life At Campus
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <form action="{{ route('lifeatcampus.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="image" name="image" aria-label="Image" onchange="previewImage(event)" required>
                                            <img id="image_preview" src="#" alt="Uploaded Image" style="max-width: 100px; display: none; margin-top: 10px;">
                                        </div>
                                         <div class="mb-3">
                                            <label for="category_id">Select Category</label>
                                            <select class="form-control" name="category_id">
                                                <option value="">Select Menu</option>
                                                 @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" aria-label="Program" style="width: 100%; height: 150px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <script>
                                function previewImage(event) {
                                    var image = document.getElementById('image_preview');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                    image.style.display = 'block';
                                }
                            </script>
                            
                            <span><strong>Update/Delete</strong></span>
                                   <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>S.no</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campus as $key => $camp)
                                            <tr id="row-{{ $camp->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td id="image-{{ $camp->id }}">
                                                    <img src="{{ asset('images/' . $camp->image) }}" alt="Image" style="max-width: 100px;" />
                                                </td>
                                                <td id="category_id-{{ $camp->id }}">{{ $camp->category->name }}</td>
                                                <td id="description-{{ $camp->id }}">{{ $camp->description }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#campusModal-{{ $camp->id }}">Edit</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="campusModal-{{ $camp->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Life At Campus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('lifeatcampus.update', $camp->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                             <label>Image</label>
                                                                            <input type="file" class="form-control" id="image" name="image">
                                                                            @if($camp->image)
                                                                                <img src="{{ asset('images/' . $camp->image) }}" alt="Image" width="100">
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="category_id-{{ $camp->id }}">Select Category</label>
                                                                                <option value="">Select Category</option>
                                                                                @foreach($categories as $category)
                                                                                <option value="{{ $category->id }}" {{ $camp->category_id == $category->id ? 'selected' : '' }}>
                                                                                    {{ $category->name }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="description-{{ $camp->id }}" class="form-label">Description</label>
                                                                            <textarea class="form-control" id="description-{{ $camp->id }}" name="description" style="width: 100%; height: 150px;">{{ $camp->description }}</textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form id="delete-form-{{ $camp->id }}" action="{{ route('lifeatcampus.delete', $camp->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-xl btn-danger" onclick="Delete('{{ $camp->id }}')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    <script>
                                        function Delete(campId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-form-' + campId).submit();
                                                }
                                            });
                                        }
                                    </script>
  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


    </div>
</div>
@endsection

@section("script")
<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
