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
                   <h5 style="font-size: 22px;font-family: math;font-weight: bold; color: red;">Contact Us</h5>
                   <hr>

               <form action="{{route('examcell-contact-store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required />
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title" required />
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Landmark</label>
                    <input type="text" class="form-control" id="landmark" name="landmark" required />
                </div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required />
                </div>
                       
                <div class="mb-3">
                    <label for="title" class="form-label">District</label>
                    <input type="text" class="form-control" id="district" name="district" required />
                </div>
                       
                <div class="mb-3">
                    <label for="title" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" required />
                </div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required />
                </div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" required />
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
                                        <th>Sub Title</th>
                                        <th>Landmark</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>State</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactus as $key => $contact)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $contact->title }}</td>     
                                            <td>{{ $contact->sub_title }}</td>
                                            <td>{{ $contact->landmark }}</td>
                                            <td>{{ $contact->city }}</td>
                                            <td>{{ $contact->district }}</td>
                                            <td>{{ $contact->state }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phonenumber }}</td>
                                            <td>
                                             <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#testimonialEditModal"
                                                data-id="{{ $contact->id }}" 
                                                data-title="{{ $contact->title }}"
                                                data-sub_title="{{ $contact->sub_title }}"
                                                data-landmark="{{ $contact->landmark }}"
                                                data-city="{{ $contact->city }}"
                                                data-district="{{ $contact->district }}"
                                                data-state="{{ $contact->state }}"
                                                data-email="{{ $contact->email }}"
                                                data-phonenumber="{{ $contact->phonenumber }}"
                                                >
                                                Edit

                                            </button>
                                            
                                             <form action="{{ route('examcell-contact-destroy', $contact->id) }}"
                                                  method="POST" class="delete-form-testimonial"
                                                  style="display: inline;">
                                                  @csrf @method('DELETE')
                                                  <button type="button" class="btn btn-danger btn-sm delete-button"
                                                  onclick="confirmDeleteTopBar({{ $contact->id }})">Delete</button>
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
           
 
   <!-- Modal -->

<div class="modal fade bd-example-modal-lg" id="testimonialEditModal" tabindex="-1"
aria-labelledby="testimonialEditModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="testimonialEditModalLabel">Edit </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('examcell-contact-update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data" id="testimonialEditForm">
            @csrf
            @method('PATCH')

            <div class="mb-3">
               <label for="title" class="form-label">Title</label>
               <input type="text" class="form-control" id="title" name="title" required />
           </div>
           <div class="mb-3">
               <label for="title" class="form-label">Sub Title</label>
               <input type="text" class="form-control" id="sub_title" name="sub_title" required />
           </div>
           <div class="mb-3">
               <label for="title" class="form-label">landmark</label>
               <input type="text" class="form-control" id="landmark" name="landmark" required />
           </div>
           
           <div class="mb-3">
               <label for="title" class="form-label">city</label>
               <input type="text" class="form-control" id="city" name="city" required />
           </div>
                  
           <div class="mb-3">
               <label for="title" class="form-label">district</label>
               <input type="text" class="form-control" id="district" name="district" required />
           </div>
                  
           <div class="mb-3">
               <label for="title" class="form-label">state</label>
               <input type="text" class="form-control" id="state" name="state" required />
           </div>
                       
            <div class="mb-3">
                    <label for="title" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required />
            </div>
                
             <div class="mb-3">
                    <label for="title" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" required />
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

document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-btn");
    const form = document.getElementById("testimonialEditForm");

    editButtons.forEach((button) => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const title = this.getAttribute("data-title");
            const sub_title = this.getAttribute("data-sub_title");
            const landmark = this.getAttribute("data-landmark");
            const city = this.getAttribute("data-city");
            const district = this.getAttribute("data-district");
            const state = this.getAttribute("data-state");
            const email = this.getAttribute("data-email");
            const phonenumber = this.getAttribute("data-phonenumber");

            form.action = form.action.replace(":id", id);

            form.querySelector('input[name="title"]').value = title;
            form.querySelector('input[name="sub_title"]').value = sub_title;
            form.querySelector('input[name="landmark"]').value = landmark;
            form.querySelector('input[name="city"]').value = city;
            form.querySelector('input[name="district"]').value = district;  
            form.querySelector('input[name="state"]').value = state;           
            form.querySelector('input[name="email"]').value = email;           
            form.querySelector('input[name="phonenumber"]').value = phonenumber;           
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
