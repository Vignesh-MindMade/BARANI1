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
                   <h5 style="font-size: 21px;
    font-family: math;
    font-weight: bolder;
    color: red;">University</h5>
                   <hr>
                   <form action="{{ route('examcell-university-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title*</label>
                        <input type="text" class="form-control" id="title" name="title" required />
                    </div>
                
                    <div class="mb-3">
                        <label for="date" class="form-label">Date*</label>
                        <input type="text" class="form-control" id="date" name="date" />
                    </div>     
                
                    <button type="button" id="toggleDate" class="btn btn-secondary mb-3">Add Date</button>
                
                    <div class="mb-3" id="extraDate" style="display: none;">
                        <label for="date2" class="form-label">Another Date</label>
                        <input type="text" class="form-control" id="date2" name="date2" />
                    </div>
                
                    <div class="mb-3">
                        <label for="pdf" class="form-label">PDF*</label>
                        <input type="file" class="form-control" id="pdf" name="pdf" />
                    </div>
                
                    <button type="button" id="togglePDF" class="btn btn-secondary mb-3">Add PDF</button>
                
                    <div class="mb-3" id="extraPDF" style="display: none;">
                        <label for="pdf2" class="form-label">Another PDF</label>
                        <input type="file" class="form-control" id="pdf2" name="pdf2" />
                    </div>
                <BR>
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
                                        <th>Date</th>
                                        <th>Date 2</th>
                                        <th>PDF</th>
                                        <th>PDF 2</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($universitys as $key => $university)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $university->title }}</td>
                                            <td>{{ $university->date }}</td>
                                            <td>{{ $university->date2 }}</td>
                                             <td>
                                                @if ($university->pdf)
                                                    <a href="{{ asset('pdfs/' . basename($university->pdf)) }}" target="_blank" class="btn btn-secondary btn-sm">
                                                        View PDF
                                                    </a>
                                                @else
                                                    No PDF
                                                @endif
                                             </td>

                                           <td>
                                                @if ($university->pdf)
                                                    <a href="{{ asset('pdfs/' . basename($university->pdf2)) }}" target="_blank" class="btn btn-secondary btn-sm">
                                                        View PDF
                                                    </a>
                                                @else
                                                    No PDF
                                                @endif
                                             </td>
                                            
                                            <td>
                                             <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#testimonialEditModal"
                                                data-id="{{ $university->id }}" 
                                                data-title="{{ $university->title }}"
                                                data-date="{{ $university->date }}"
                                                data-date2="{{ $university->date2 }}"
                                                data-pdf="{{ $university->pdf }}"
                                                data-pdf2="{{ $university->pdf2 }}">
                                                Edit
                                            </button>
                                            
                                                <form action="{{ route('examcell-university-destroy', $university->id) }}"
                                                    method="POST" class="delete-form-testimonial"
                                                    style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        onclick="confirmDeleteTopBar({{ $university->id }})">Delete</button>
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
<div class="modal fade bd-example-modal-lg" id="testimonialEditModal" tabindex="-1" aria-labelledby="testimonialEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testimonialEditModalLabel">Edit University Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('examcell-university-update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data" id="testimonialEditForm">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required />
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" class="form-control" id="date" name="date" required />
                    </div>

                    <div class="mb-3">
                        <label for="date2" class="form-label">Date 2</label>
                        <input type="text" class="form-control" id="date2" name="date2" required />
                    </div>

                    <div class="mb-3">
                        <label for="pdf" class="form-label">Upload New PDF</label>
                        <input type="file" class="form-control" id="pdf" name="pdf" />
                    </div>

                    <div class="mb-3">
                        <label for="currentPdf" class="form-label">Current PDF</label>
                        <div id="currentPdf">
                            <!-- Current PDF link will be dynamically injected here -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pdf2" class="form-label">Upload New PDF 2</label>
                        <input type="file" class="form-control" id="pdf2" name="pdf2" />
                    </div>

                    <div class="mb-3">
                        <label for="currentPdf2" class="form-label">Current PDF 2</label>
                        <div id="currentPdf2">
                            <!-- Current PDF 2 link will be dynamically injected here -->
                        </div>
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
    $(document).ready(function () {
        $('#toggleDate').click(function () {
            $('#extraDate').toggle();
        });

        $('#togglePDF').click(function () {
            $('#extraPDF').toggle();
        });
    });
</script>


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
            const date = this.getAttribute("data-date");
            const date2 = this.getAttribute("data-date2");
            const pdf = this.getAttribute("data-pdf");
            const pdf2 = this.getAttribute("data-pdf2");

            // Dynamically set the form action to include the university ID
            form.action = form.action.replace(":id", id);

            // Populate the form fields with the existing data
            form.querySelector('input[name="title"]').value = title;
            form.querySelector('input[name="date"]').value = date;
            form.querySelector('input[name="date2"]').value = date2;

            // Dynamically inject current PDF links
            const currentPdf = document.getElementById("currentPdf");
            if (pdf) {
              currentPdf.innerHTML = `<a href="{{ asset('pdfs') }}/${pdf}" target="_blank" class="btn btn-secondary">View PDF 2</a>`;

            } else {
                currentPdf.innerHTML = "No PDF uploaded";
            }

            // Dynamically inject current PDF2 links
            const currentPdf2 = document.getElementById("currentPdf2");
            if (pdf2) {
              currentPdf2.innerHTML = `<a href="{{ asset('pdfs') }}/${pdf2}" target="_blank" class="btn btn-secondary">View PDF 2</a>`;
            } else {
                currentPdf2.innerHTML = "No PDF 2 uploaded";
            }
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
                 deleteForm.action = "{{ route('examcell-university-destroy', ':id') }}".replace(":id", testimonialId);
                 deleteForm.submit();
             }
         });
     }
 </script>

 
@endsection
