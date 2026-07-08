@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    
    
    <!-- Include Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

@endsection

<style>


    /* Apply Poppins font globally to the editor */
    .note-editor .note-editable {
        font-family: 'Poppins', sans-serif !important;
    }
</style>

<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }

    .note-toolbar {
        border: 2px solid #007bff; /* Blue border color */
        border-radius: 5px; /* Rounded corners */
        background-color: #f8f9fa; /* Light gray background */
    }

    /* Optional: Style toolbar buttons for better visibility */
    .note-btn {
        border-radius: 3px;
        transition: background-color 0.3s;
    }

    .note-btn:hover {
        background-color: #e2e6ea; /* Light hover effect */
    }
</style>
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">{{ 'Admission' }}</h6>
        <hr />

        <div class="card">
            <div class="card-body">

                {{-- <form action="{{ route('admission.content') }}" method="POST">
                    @csrf @foreach($AdmissionContent as $program)
                    <div class="mb-3">
                        <label for="admission" class="form-label">Admission</label>
                        <textarea class="form-control" id="admission" name="admission" aria-label="Admission" style="width: 100%; height: 150px;">{{ old('program', $program->admission ?? '') }}</textarea>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> --}}

                <h5 class="card-title">Admission</h5>

                <hr />
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Add Sections
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('admission.section') }}" method="POST">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" />
                                            </div>
                                        </div>
                                    </div>
                                    <br />
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
                                        @foreach($admissionsection ?? '' as $key => $section)
                                        <tr id="row-{{ $section->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td id="name-{{ $section->id }}">{{ $section->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sympModal-{{ $section->id }}">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="sympModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Section</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admissiontitlte.update', $section->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}" />
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
                                                <form id="sectiondelete" action="{{ route('admissiontitle.delete', $section->id) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-xl btn-danger" onclick="SectionDelete('{{ $section->id }}')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <script>
                                    function SectionDelete(sectionId) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Delete",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById("sectiondelete").action = "{{ route('admissiontitle.delete', ':id') }}".replace(":id", sectionId);
                                                document.getElementById("sectiondelete").submit();
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
                                Admission
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="section_id">Select Section</label>
                                                <select class="form-control" name="section_id" required>
                                                    <option value="">Select Menu</option>
                                                    @foreach($admissionsection as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content">Content</label>
                                                <textarea class="form-control" id="content" name="content"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" id="description" name="description" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="pdf">PDF</label>
                                                <input type="file" class="form-control" id="pdf" name="pdf" accept="pdf" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="description">Description 2</label>
                                                <input type="text" class="form-control" id="description1" name="description1" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="pdf">PDF 2</label>
                                                <input type="file" class="form-control" id="pdf1" name="pdf1" accept="pdf" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="description">Description 3</label>
                                                <input type="text" class="form-control" id="description2" name="description2" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="pdf">PDF 3</label>
                                                <input type="file" class="form-control" id="pdf2" name="pdf2" accept="pdf" />
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Section</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admissions as $key => $admission)
                                            <tr id="row-{{ $admission->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $admission->section->name }}</td>
                                           
                        
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="openEditModal({{ $admission->id }})">Edit</button>

                                                    <form action="{{ route('admission.delete', $admission->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Admission</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" id="edit-id">

                                                    <div class="mb-3">
                                                        <label for="edit-section">Select Section</label>
                                                        <select class="form-control" id="edit-section" name="section_id" required>
                                                            @foreach($admissionsection as $section)
                                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-content">Content</label>
                                                        <textarea class="form-control" id="edit-content" name="content"></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-description">Description</label>
                                                        <input type="text" class="form-control" id="edit-description" name="description">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-pdf">PDF</label>
                                                        <input type="file" class="form-control" id="edit-pdf" name="pdf" accept="application/pdf">
                                                        @if($admission->pdf)
                                                            <a href="{{ asset('public/pdfs/' . $admission->pdf) }}" target="_blank">View PDF</a>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-description2">Description 2</label>
                                                        <input type="text" class="form-control" id="edit-description2" name="description1">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-pdf2">PDF 2</label>
                                                        <input type="file" class="form-control" id="edit-pdf2" name="pdf1" accept="application/pdf">
                                                                    @if($admission->pdf)
                                                            <a href="{{ asset('public/pdfs/' . $admission->pdf1) }}" target="_blank">View PDF</a>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-description3">Description 3</label>
                                                        <input type="text" class="form-control" id="edit-description3" name="description2">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit-pdf3">PDF 3</label>
                                                        <input type="file" class="form-control" id="edit-pdf3" name="pdf2" accept="application/pdf">
                                                                    @if($admission->pdf)
                                                            <a href="{{ asset('public/pdfs/' . $admission->pdf2) }}" target="_blank">View PDF</a>
                                                        @endif
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                                                    </div>
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
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        // Common Summernote settings
        function initSummernote(selector, placeholderText) {
            $(selector).summernote({
                placeholder: placeholderText,
                tabsize: 2,
                height: 250, // Adjust height as needed
                width: '100%', // Ensures it fits within col-lg-8
                fontNames: ['Poppins', 'Arial', 'Courier New', 'Times New Roman'],
                fontNamesIgnoreCheck: ['Poppins'],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                // Add font size of 13px in toolbar options
                fontSizes: ['8', '9', '10', '11', '12', '13', '14','15', '18', '20', '22', '24', '36']
            });
        }

        // Initialize Summernote for content textarea
        initSummernote("#content", "Enter content...");

        // Initialize Summernote for edit modal content textarea
        initSummernote("#edit-content", "Edit content...");
        
        // Ensure that the container is within the col-lg-8
        $(".summernote").closest(".col-lg-8").css("width", "100%");
    });
</script>




<script>

   function openEditModal(id) {
    $.ajax({
        url: '{{ route("admission.edit") }}',
        method: "GET",
        data: { id: id },
        success: function(response) {
            // Set the admission ID in the hidden field
            $('#editForm input[name="id"]').val(response.id);
            $('#edit-section').val(response.section_id);
            $('#edit-content').summernote('code', response.content);
            $('#edit-description').val(response.description);
            $('#edit-description2').val(response.description1);
            $('#edit-description3').val(response.description2);

            // Show the modal
            $('#editModal').modal('show');
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to fetch data for editing.'
            });
        }
    });
}

$("#saveChanges").on("click", function(e) {
    e.preventDefault();

    // Get the form data
    let formData = new FormData($("#editForm")[0]);

    // Add Summernote content
    formData.append('content', $('#edit-content').summernote('code'));

    // Add CSRF token
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: '{{ route("admission.update") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Changes saved successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to save changes'
                });
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to save changes. Please try again.'
            });
        }
    });
});

    $(document).ready(function () {
        $("#content").summernote({
            placeholder: "Enter content...",
            tabsize: 2,
            height: 200,
        });

        // Initialize Summernote for edit modal content textarea
        $("#edit-content").summernote({
            placeholder: "Edit content...",
            tabsize: 2,
            height: 200,
        });
    });



    $(".delete-btn").on("click", function (e) {
    e.preventDefault(); // Prevent default form submission
    var form = $(this).closest("form"); // Get the form to submit
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); // Submit the form if confirmed
        }
    });
});

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>



<!-- jQuery (Required for Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
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
