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
    color: red;">Usefull Links</h5>
<hr>
                <form action="{{route('examcell-usefulllinks-store')}}" method="POST" enctype="multipart/form-data">
                       @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required />
                </div>
                       <div class="mb-3">
                            <button type="button" class="btn btn-secondary" id="addMorePointsBtn">Add More
                                Points</button>
                        </div>
                        <div id="pointsContainer" class="mb-3">
                        
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Usefulllinks as $key => $Usefulllink)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $Usefulllink->title }}</td>
                                            <td>
                                                
                                                <button 
                                                type="button" 
                                                class="btn btn-primary btn-sm edit-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#testimonialEditModal"
                                                data-id="{{ $Usefulllink->id }}" 
                                                data-title="{{ $Usefulllink->title }}"
                                                @for ($i = 1; $i <= 10; $i++) 
                                                    data-point{{ $i }}="{{ $Usefulllink->{'point' . $i} }}" 
                                                    data-url_{{ $i }}="{{ $Usefulllink->{'url_' . $i} }}"
                                                    data-pdf_{{ $i }}="{{ $Usefulllink->{'pdf_' . $i} }}"
                                                @endfor
                                            >
                                                Edit
                                            </button>
                                            
                                            
                                                <form action="{{ route('examcell-usefulllinks-destroy', $Usefulllink->id) }}"
                                                    method="POST" class="delete-form-testimonial"
                                                    style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        onclick="confirmDeleteTopBar({{ $Usefulllink->id }})">Delete</button>
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
            <h5 class="modal-title" id="testimonialEditModalLabel">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('examcell-usefulllinks-update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data" id="testimonialEditForm">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required />
                </div>

                <div id="pointsContainerModel">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="point-group mb-3">
                            <input type="text" class="form-control mb-2" id="point{{ $i }}" name="point{{ $i }}" placeholder="Enter Point {{ $i }}" />
                            <input type="text" class="form-control mb-2" id="url_{{ $i }}" name="url_{{ $i }}" placeholder="Enter URL {{ $i }}" />
                            
                            <!-- PDF File Input and Preview -->
                            <div class="pdf-container mb-2">
                                <label class="form-label">PDF for Point {{ $i }}</label>
                                <input type="file" class="form-control" id="pdf_{{ $i }}" name="pdf_{{ $i }}" accept="application/pdf" />
                                <div class="existing-pdf mt-2" id="existing_pdf_{{ $i }}"></div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" id="addMorePointsBtnModel">Add More Points</button>
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

            // Replace form action with the correct ID
            form.action = form.action.replace(":id", id);

            // Populate form fields with existing data
            form.querySelector('input[name="title"]').value = title;

            // Populate the point, URL, and PDF fields dynamically
            for (let i = 1; i <= 10; i++) {
                const pointInput = form.querySelector(`input[name="point${i}"]`);
                const urlInput = form.querySelector(`input[name="url_${i}"]`);
                const pdfContainer = form.querySelector(`#existing_pdf_${i}`);
                const pointGroup = pointInput.closest('.point-group');

                const pointValue = this.getAttribute(`data-point${i}`);
                const urlValue = this.getAttribute(`data-url_${i}`);
                const pdfValue = this.getAttribute(`data-pdf_${i}`);

                // Handle point input
                if (pointValue) {
                    pointInput.value = pointValue;
                    pointGroup.style.display = "block";
                } else {
                    pointInput.value = "";
                    pointGroup.style.display = "none";
                }

                // Handle URL input
                if (urlValue) {
                    urlInput.value = urlValue;
                } else {
                    urlInput.value = "";
                }

                // Handle PDF display and link
                if (pdfValue) {
                    pdfContainer.innerHTML = `
                        <div class="d-flex align-items-center">
                            <a href="public/pdfs/${pdfValue}" target="_blank" class="text-primary me-2">
                                <i class="bi bi-file-pdf"></i> View Current PDF
                            </a>
                            <small class="text-muted">(Upload new PDF to replace)</small>
                        </div>
                    `;
                } else {
                    pdfContainer.innerHTML = '';
                }
            }
        });
    });

    // Add More Points button functionality for modal
    const addMorePointsBtnModel = document.getElementById('addMorePointsBtnModel');
    if (addMorePointsBtnModel) {
        addMorePointsBtnModel.addEventListener('click', function() {
            const pointsContainer = document.getElementById('pointsContainerModel');
            const visiblePoints = Array.from(pointsContainer.children)
                .filter(child => child.style.display !== 'none').length;

            if (visiblePoints < 10) {
                // Find the next hidden point-group and show it
                const hiddenGroups = Array.from(pointsContainer.children)
                    .filter(child => child.style.display === 'none');
                if (hiddenGroups.length > 0) {
                    hiddenGroups[0].style.display = 'block';
                }
            } else {
                alert('Are You Add?.');
            }
        });
    }
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
                 deleteForm.action = "{{ route('examcell-usefulllinks-destroy', ':id') }}".replace(":id", testimonialId);
                 deleteForm.submit();
             }
         });
     }
 </script>
{{-- Add this in the points container section of your blade template --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addPointButton = document.getElementById('addMorePointsBtn');
        const addPointButtonModel = document.getElementById('addMorePointsBtnModel');
    
        addPointButton.addEventListener('click', function() {
            addPoint('pointsContainer');
        });
    
        addPointButtonModel.addEventListener('click', function() {
            addPoint('pointsContainerModel');
        });
    
        function addPoint(containerId) {
            const pointsContainer = document.getElementById(containerId);
            const currentInputs = pointsContainer.querySelectorAll('.point-group').length;
    
            if (currentInputs < 10) {
                const pointGroup = document.createElement('div');
                pointGroup.className = 'point-group mb-3';
    
                // Point input
                const pointInput = document.createElement('input');
                pointInput.type = 'text';
                pointInput.name = `point${currentInputs + 1}`;
                pointInput.placeholder = `Enter Point ${currentInputs + 1}`;
                pointInput.className = 'form-control mb-2';
    
                // URL input
                const urlInput = document.createElement('input');
                urlInput.type = 'text';
                urlInput.name = `url_${currentInputs + 1}`;
                urlInput.placeholder = `Enter URL for Point ${currentInputs + 1}`;
                urlInput.className = 'form-control mb-2';

                // PDF input
                const pdfInput = document.createElement('input');
                pdfInput.type = 'file';
                pdfInput.name = `pdf_${currentInputs + 1}`;
                pdfInput.accept = 'application/pdf';
                pdfInput.className = 'form-control mb-2';
                pdfInput.setAttribute('id', `pdf_${currentInputs + 1}`);
    
                // Create label for PDF
                const pdfLabel = document.createElement('label');
                pdfLabel.className = 'form-label';
                pdfLabel.textContent = `PDF for Point ${currentInputs + 1}`;
    
                // Append inputs to group
                pointGroup.appendChild(pointInput);
                pointGroup.appendChild(urlInput);
                pointGroup.appendChild(pdfLabel);
                pointGroup.appendChild(pdfInput);
    
                // Append group to container
                pointsContainer.appendChild(pointGroup);
            } else {
                alert('Are You Add More?');
            }
        }
    });
</script>

    
 
@endsection
 