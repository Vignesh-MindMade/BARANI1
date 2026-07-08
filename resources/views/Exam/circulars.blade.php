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
                   <h5 style="font-size: 22px;font-family: math;font-weight: bold; color: red;">Internal Circulars</h5>
                   <hr>

                   <form action="{{ route('internal-circulars-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" / required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="Year" class="form-label">Year <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="Year" name="Year" / required>
                    </div>
                
                    <!-- Semester 1 Fields (Default Visible) -->
                    <div id="semester-fields-container">
                        <div class="semester-section mb-4" id="semester_1">
                            <h5>Semester 1</h5>
                            <div class="mb-3">
                                <label for="semester_1" class="form-label">Semester 1 Title</label>
                                <input type="text" class="form-control" id="semester_1" name="semester_1" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_1" class="form-label">Semester 1 - Internal 1</label>
                                <input type="text" class="form-control" id="sem1_internal_1" name="sem1_internal_1" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_pdf_1" class="form-label">Semester 1 - Internal 1 (PDF)</label>
                                <input type="file" class="form-control" id="sem1_internal_pdf_1" name="sem1_internal_pdf_1" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_2" class="form-label">Semester 1 - Internal 2</label>
                                <input type="text" class="form-control" id="sem1_internal_2" name="sem1_internal_2" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_pdf_2" class="form-label">Semester 1 - Internal 2 (PDF)</label>
                                <input type="file" class="form-control" id="sem1_internal_pdf_2" name="sem1_internal_pdf_2" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_3" class="form-label">Semester 1 - Internal 3</label>
                                <input type="text" class="form-control" id="sem1_internal_3" name="sem1_internal_3" />
                            </div>
                            <div class="mb-3">
                                <label for="sem1_internal_pdf_3" class="form-label">Semester 1 - Internal 3 (PDF)</label>
                                <input type="file" class="form-control" id="sem1_internal_pdf_3" name="sem1_internal_pdf_3" />
                            </div>
                            <hr />
                        </div>
                    </div>
                
                    <button type="button" class="btn btn-secondary mb-3" id="add-semester-btn">Add Semester</button><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
      
                
<hr>

<!-- Internal Circulars Table -->
<div class="container mt-5">
    <h2 class="text-center" style="font-size: 22px;font-family: math;font-weight: bold; color: blue;">Internal Circulars</h2>
    <hr>
    @if($circulars->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="circularsTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Semester Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($circulars as $record)
                        <tr>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->Year }}</td>
                            <td>
                                <!-- Semester Details Accordion -->
                                <div class="accordion" id="accordion{{ $record->id }}">
                                    @for($i = 1; $i <= 10; $i++)
                                        @php
                                            $semesterField = "semester_" . $i;
                                            $internal1 = "sem{$i}_internal_1";
                                            $internal1Pdf = "sem{$i}_internal_pdf_1";
                                            $internal2 = "sem{$i}_internal_2";
                                            $internal2Pdf = "sem{$i}_internal_pdf_2";
                                            $internal3 = "sem{$i}_internal_3";
                                            $internal3Pdf = "sem{$i}_internal_pdf_3";
                                        @endphp

                                        @if($record->$semesterField)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $record->id }}{{ $i }}">
                                                        Semester {{ $i }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $record->id }}{{ $i }}" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <p><strong>Title:</strong> {{ $record->$semesterField }}</p>
                                                        
                                                        @if($record->$internal1)
                                                            <p>
                                                                <strong>Internal 1:</strong> {{ $record->$internal1 }}
                                                                @if($record->$internal1Pdf)
                                                                    <a href="{{ asset('pdfs/' . $record->$internal1Pdf) }}" class="btn btn-sm btn-primary ms-2" target="_blank">
                                                                        <i class="bi bi-file-pdf"></i> View PDF
                                                                    </a>
                                                                @endif
                                                            </p>
                                                        @endif

                                                        @if($record->$internal2)
                                                            <p>
                                                                <strong>Internal 2:</strong> {{ $record->$internal2 }}
                                                                @if($record->$internal2Pdf)
                                                                    <a href="{{ asset('pdfs/' . $record->$internal2Pdf) }}" class="btn btn-sm btn-primary ms-2" target="_blank">
                                                                        <i class="bi bi-file-pdf"></i> View PDF
                                                                    </a>
                                                                @endif
                                                            </p>
                                                        @endif

                                                        @if($record->$internal3)
                                                            <p>
                                                                <strong>Internal 3:</strong> {{ $record->$internal3 }}
                                                                @if($record->$internal3Pdf)
                                                                    <a href="{{ asset('pdfs/' . $record->$internal3Pdf) }}" class="btn btn-sm btn-primary ms-2" target="_blank">
                                                                        <i class="bi bi-file-pdf"></i> View PDF
                                                                    </a>
                                                                @endif
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!--<button type="button" class="btn btn-warning btn-sm edit-circular" data-id="{{ $record->id }}" data-bs-toggle="modal" data-bs-target="#editModal">-->
                                    <!--    <i class="bi bi-pencil-square"></i>-->
                                    <!--</button>-->
                                    <form action="{{ route('internal-circulars-destroy', $record->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-circular">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No records found.</div>
    @endif
</div>




<!-- Delete Confirmation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#circularsTable').DataTable();

        // Delete confirmation
        $('.delete-circular').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

 
               </div>
           </div>
           

 
         
     </div>
 </div>

 <script>
    let semesterCount = 1; // Start from 1 since Semester 1 is already displayed

    document.getElementById('add-semester-btn').addEventListener('click', function () {
        semesterCount++;

        const semesterFields = `
            <div class="semester-section mb-4" id="semester_${semesterCount}">
                <h5>Semester ${semesterCount}</h5>
                <div class="mb-3">
                    <label for="semester_${semesterCount}" class="form-label">Semester ${semesterCount} Title</label>
                    <input type="text" class="form-control" id="semester_${semesterCount}" name="semester_${semesterCount}" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_1" class="form-label">Semester ${semesterCount} - Internal 1</label>
                    <input type="text" class="form-control" id="sem${semesterCount}_internal_1" name="sem${semesterCount}_internal_1" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_pdf_1" class="form-label">Semester ${semesterCount} - Internal 1 (PDF)</label>
                    <input type="file" class="form-control" id="sem${semesterCount}_internal_pdf_1" name="sem${semesterCount}_internal_pdf_1" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_2" class="form-label">Semester ${semesterCount} - Internal 2</label>
                    <input type="text" class="form-control" id="sem${semesterCount}_internal_2" name="sem${semesterCount}_internal_2" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_pdf_2" class="form-label">Semester ${semesterCount} - Internal 2 (PDF)</label>
                    <input type="file" class="form-control" id="sem${semesterCount}_internal_pdf_2" name="sem${semesterCount}_internal_pdf_2" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_3" class="form-label">Semester ${semesterCount} - Internal 3</label>
                    <input type="text" class="form-control" id="sem${semesterCount}_internal_3" name="sem${semesterCount}_internal_3" />
                </div>
                <div class="mb-3">
                    <label for="sem${semesterCount}_internal_pdf_3" class="form-label">Semester ${semesterCount} - Internal 3 (PDF)</label>
                    <input type="file" class="form-control" id="sem${semesterCount}_internal_pdf_3" name="sem${semesterCount}_internal_pdf_3" />
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeSemester(${semesterCount})">Remove Semester</button>
                <hr />
            </div>
        `;

        document.getElementById('semester-fields-container').insertAdjacentHTML('beforeend', semesterFields);
    });

    function removeSemester(semesterId) {
        const semesterSection = document.getElementById(`semester_${semesterId}`);
        semesterSection.remove();
    }
</script>

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
