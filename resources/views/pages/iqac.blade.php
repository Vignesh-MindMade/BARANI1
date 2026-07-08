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
        <h6 class="mb-0 text-uppercase">{{ 'IQAC' }}</h6>
        <hr/>
        
       <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">IQAC</h5>
                            <hr/>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Add Sections
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                           <form action="{{ route('iqac.section') }}" method="POST" >
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
                                   @foreach($iqacsections ?? '' as $key => $section)
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
                                                            <form action="{{ route('iqac.update', $section->id) }}" method="POST" >
                                                                @csrf
                                                              <div class="mb-3">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}">
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
                                       <form id="sectiondelete" action="{{ route('iqac.delete', $section->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
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
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('sectiondelete').action = "{{ route('iqac.delete', ':id') }}".replace(':id', sectionId);
                                                    document.getElementById('sectiondelete').submit();
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
            IQAC
        </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <form action="{{ route('iqac.store') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="mb-3">
                            <label for="section_id">Select Section</label>
                            <select class="form-control" name="section_id">
                                <option value="">Select Menu</option>
                                @foreach($iqacsections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description">Descriptions</label>
                            <div id="description-repeater">
                                <div class="input-group mb-2">
                                    <input type="text" name="description[]" class="form-control" placeholder="Enter description">
                                    <button type="button" class="btn btn-danger remove-description">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" id="add-description">Add Description</button>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <script>
                document.getElementById('add-description').addEventListener('click', function () {
                    var repeater = document.getElementById('description-repeater');
                    var newInputGroup = document.createElement('div');
                    newInputGroup.className = 'input-group mb-2';
                    newInputGroup.innerHTML = `
                        <input type="text" name="description[]" class="form-control" placeholder="Enter description">
                        <button type="button" class="btn btn-danger remove-description">Remove</button>
                    `;
                    repeater.appendChild(newInputGroup);
                });

                document.addEventListener('click', function (e) {
                    if (e.target && e.target.classList.contains('remove-description')) {
                        e.target.closest('.input-group').remove();
                    }
                });
            </script>

            <!-- Button to Trigger Modal for Editing -->
<span><strong>Update/Delete</strong></span>
<button type="button" class="btn btn-primary float-end" id="edit-section-btn" data-bs-toggle="modal" data-bs-target="#editSectionModal">
    Edit and Add Contents
</button>

<!-- Table Displaying IQAC Sections -->
<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th>S.no</th>
            <th>Section</th>
        </tr>
    </thead>
    <tbody>
        @foreach($iqacsections as $key => $content)
        <tr id="row-{{ $content->id }}">
            <td>{{ $key+1 }}</td>
            <td id="name-{{ $content->id }}">{{ $content->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Edit Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('iqaccontent.update', 0) }}" method="POST" id="editSectionForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section_id" id="edit_section_id">
                    <div class="mb-3">
                        <label for="edit_section_select">Select Section</label>
                        <select class="form-control" name="section_id" id="edit_section_select">
                            <option value="">Select Section</option>
                            @foreach($iqacsections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        <span style="color:red;"><p>Note: Select a Section To Edit Content</p></span>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description">Descriptions</label>
                        <div id="edit_description_repeater"></div>
                        <button type="button" class="btn btn-success" id="add-edit-description">Add Description</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.getElementById('edit_section_select').addEventListener('change', function () {
        const sectionId = this.value;
        const descriptionRepeater = document.getElementById('edit_description_repeater');
        descriptionRepeater.innerHTML = ''; // Clear previous descriptions

        if (sectionId) {
            fetch('{{ route('iqac.get-descriptions') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ section_id: sectionId })
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(desc => {
                    let inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group mb-2';
                    inputGroup.innerHTML = `
                        <input type="text" name="description[]" class="form-control" value="${desc}" placeholder="Enter description">
                        <button type="button" class="btn btn-danger remove-description">Remove</button>
                    `;
                    descriptionRepeater.appendChild(inputGroup);
                });
            })
            .catch(error => console.error('Error:', error));
        }
    });

    document.getElementById('add-edit-description').addEventListener('click', function () {
        var repeater = document.getElementById('edit_description_repeater');
        var newInputGroup = document.createElement('div');
        newInputGroup.className = 'input-group mb-2';
        newInputGroup.innerHTML = `
            <input type="text" name="description[]" class="form-control" placeholder="Enter description">
            <button type="button" class="btn btn-danger remove-description">Remove</button>
        `;
        repeater.appendChild(newInputGroup);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-description')) {
            e.target.closest('.input-group').remove();
        }
    });

    // Ensure the form action URL is dynamically set based on selected section
    document.getElementById('editSectionForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const sectionId = document.getElementById('edit_section_select').value;
        const form = e.target;
        
        // Update the form's action URL with the selected section ID
        form.action = "{{ url('/iqaccontent/update') }}/" + sectionId;
        form.submit(); // Submit the form programmatically
    });
</script>


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
