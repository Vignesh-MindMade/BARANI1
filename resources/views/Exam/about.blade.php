@extends("layouts.app")

@section("style")
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
                <h5 style="font-size: 22px; font-family: math; font-weight: bold; color: red;">About</h5>
                <hr>
                <form action="{{ route('examcell-about-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required />
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="addMorePointsBtn">Add More Points</button>
                    </div>
                    <div id="pointsContainer" class="mb-3"></div>
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
                                    @foreach ($points as $key => $point)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $point->title }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                    data-bs-toggle="modal" data-bs-target="#testimonialEditModal"
                                                    data-id="{{ $point->id }}" data-title="{{ $point->title }}"
                                                    @for ($i = 1; $i <= 10; $i++) data-point{{ $i }}="{{ $point->{'point' . $i} }}" @endfor>
                                                    Edit
                                                </button>
                                                <form action="{{ route('examcell-about-destroy', $point->id) }}"
                                                    method="POST" class="delete-form-testimonial"
                                                    style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        onclick="confirmDeleteTopBar({{ $point->id }})">Delete</button>
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
                        <form action="{{ route('examcell-about-update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data" id="testimonialEditForm">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required />
                            </div>
                            <div id="pointsContainerEdit">
                                <!-- Points will be dynamically added here -->
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" id="addMorePointsBtnEdit">Add More Points</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




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
        const currentInputs = pointsContainer.getElementsByTagName('input').length;

        if (currentInputs < 10) {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = `point${currentInputs + 1}`;
            input.placeholder = `Enter Point ${currentInputs + 1}`;
            input.className = 'form-control mb-2';
            pointsContainer.appendChild(input);
        } else {
            alert('You can only add up to 10 points.');
        }
    }
});

 </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");
        const form = document.getElementById("testimonialEditForm");
        const pointsContainerEdit = document.getElementById("pointsContainerEdit");

        // Function to add a new point input field
        function addPointInput(index, value = "") {
            const pointDiv = document.createElement("div");
            pointDiv.classList.add("mb-3");

            const label = document.createElement("label");
            label.setAttribute("for", `point${index}`);
            label.classList.add("form-label");
            label.textContent = `Point ${index}`;

            const input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("class", "form-control");
            input.setAttribute("id", `point${index}`);
            input.setAttribute("name", `point${index}`);
            input.value = value;

            pointDiv.appendChild(label);
            pointDiv.appendChild(input);
            pointsContainerEdit.appendChild(pointDiv);
        }

        // Add more points button in the edit modal
        document.getElementById("addMorePointsBtnEdit").addEventListener("click", function() {
            const currentPoints = pointsContainerEdit.querySelectorAll(".mb-3").length;
            addPointInput(currentPoints + 1);
        });

        editButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const title = this.getAttribute("data-title");

                // Reset form fields before populating new data
                form.reset();
                pointsContainerEdit.innerHTML = "";

                // Set the correct form action dynamically
                let formAction = "{{ route('examcell-about-update', ['id' => ':id']) }}";
                form.action = formAction.replace(":id", id);

                // Populate the title field
                form.querySelector('input[name="title"]').value = title;

                // Populate point fields dynamically
                for (let i = 1; i <= 10; i++) {
                    const pointValue = this.getAttribute(`data-point${i}`);
                    if (pointValue && pointValue.trim() !== "") {
                        addPointInput(i, pointValue);
                    }
                }
            });
        });

        // Ensure modal form resets on close to avoid mismatched values
        const modal = document.getElementById("testimonialEditModal");
        modal.addEventListener("hidden.bs.modal", function() {
            form.reset();
            pointsContainerEdit.innerHTML = "";
        });
    });

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
                deleteForm.action = "{{ route('examcell-about-destroy', ':id') }}".replace(":id", testimonialId);
                deleteForm.submit();
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