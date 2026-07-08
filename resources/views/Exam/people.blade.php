@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

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
                   
                   <h5 style="font-size: 22px;
    font-family: math;
    font-weight: bold;
    color: red;">People</h5>
<hr>
            <form action="{{route('examcell-people-store-title')}}" method="POST" enctype="multipart/form-data">
                       @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required />
                </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <hr>

                <form action="{{route('examcell-people-store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <select class="form-control" id="title" name="title" required>
                            <option value="" disabled selected>Select a Title</option>
                            @foreach($titles as $title)
                                <option value="{{ $title->id }}">{{ $title->title }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" required />
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                

               </div>
           </div>
           
    <div class="">
      
            <hr />
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peoples as $key => $people)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                            
                                            <!-- Get the title based on title_id -->
                                            <td>
                                                @php
                                                    $title = $titles->firstWhere('id', $people->title); 
                                                @endphp
                                                {{ $title ? $title->title : 'No Title' }}
                                            </td>
                            
                                            <td>{{ $people->name }}</td>
                                            <td>{{ $people->designation }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                    data-bs-toggle="modal" data-bs-target="#testimonialEditModal"
                                                    data-id="{{ $people->id }}" 
                                                    data-title="{{ $people->title_id }}"
                                                    data-name="{{ $people->name }}"
                                                    data-designation="{{ $people->designation }}">
                                                    Edit
                                                </button>
                            
                                                <form action="{{ route('examcell-people-destroy', $people->id) }}"
                                                    method="POST" class="delete-form-testimonial"
                                                    style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        onclick="confirmDeleteTopBar({{ $people->id }})">Delete</button>
                                                </form>
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
           
 
        <div class="modal fade bd-example-modal-lg" id="testimonialEditModal" tabindex="-1" aria-labelledby="testimonialEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="testimonialEditModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('examcell-people-update', ['id' => ':id']) }}" method="POST" id="testimonialEditForm">
                            @csrf
                            @method('PATCH')
                        
                            <!-- Title Dropdown -->
                            <div class="mb-3">
                                <label for="edit-title" class="form-label">Title</label>
                                <select class="form-control" id="edit-title" name="title" required>
                                    <option value="" disabled>Select a Title</option>
                                    @foreach($titles as $title)
                                        <option value="{{ $title->id }}">{{ $title->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit-name" name="name" required />
                            </div>
                        
                            <!-- Designation Field -->
                            <div class="mb-3">
                                <label for="edit-designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="edit-designation" name="designation" required />
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
</div>
</div>

 
         
     </div>
 </div>

 @endsection @section('script')
 <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

 {{-- Sweet Alert Cdn Script --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



 <script>
     $(document).ready(function() {
         $("#example").DataTable();
     });
 </script>

 <script>
     $(document).ready(function() {
         var table = $("#example2").DataTable({
             lengthChange: false,
             buttons: ["copy", "excel", "pdf", "print"],
         });

         table.buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
     });
 </script>



 <script>

document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");
    const form = document.getElementById("testimonialEditForm");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const title = this.getAttribute("data-title");
            const name = this.getAttribute("data-name");
            const designation = this.getAttribute("data-designation");

            // Update the form's action URL dynamically
            form.action = form.action.replace(":id", id);

            // Populate the title dropdown
            const titleSelect = form.querySelector('select[name="title"]');
            Array.from(titleSelect.options).forEach(option => {
                option.selected = option.value === title;
            });

            // Populate name and designation fields
            form.querySelector('input[name="name"]').value = name;
            form.querySelector('input[name="designation"]').value = designation;
        });
    });
});

 </script>



 <script>

     function confirmDeleteTopBar(testimonialId) {
         Swal.fire({
             title: "Are you sure?",
             icon: "warning",
             showCancelButton: true,
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Delete",
         }).then((result) => {
             if (result.isConfirmed) {
                 // Select the form dynamically
                 const deleteForm = document.querySelector(".delete-form-testimonial");
                 deleteForm.action = "{{ route('examcell-people-destroy', ':id') }}".replace(":id", testimonialId);
                 deleteForm.submit();
             }
         });
     }
 </script>

 
@endsection
