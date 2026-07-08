@extends('layouts.app')

@section('style')
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    .upload-area.dragover {
        border: 2px dashed #0d6efd !important;
        background-color: #e9f5ff;
    }

    .dynamic-field {
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .dynamic-field:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 6px;
    }

    .remove-btn-container {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        height: 100%;
    }

    .btn-danger {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-danger:hover {
        transform: scale(1.05);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .text-muted {
        font-size: 0.8rem;
    }

    #add-field-btn {
        margin-top: 0.5rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 767.98px) {
        .remove-btn-container {
            margin-top: 1rem;
            justify-content: flex-start;
        }
    }
</style>


@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <h2 class="mb-0 text-uppercase">Our Gallery</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div class="card-body">
                        <!-- Table Section -->
                        <div class="mt-20">
                            <div class="col-md-12 p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>S.no</th>
                                                <th>Heading</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($NewsEvents as $key => $NewsEvent)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $NewsEvent->heading }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="psg-p-btn edit-btn"
                                                        data-id="{{ $NewsEvent->id }}"
                                                        data-heading="{{ $NewsEvent->heading }}"
                                                        data-action="{{ route('StudentPortfolioheadings.update', $NewsEvent->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModalHeading"><i class="fas fa-edit me-2"></i>
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModalHeading" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit TopBar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="editForm" class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit_heading" class="form-label">Heading<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" id="edit_heading" name="heading" placeholder="heading" aria-label="heading" required>
                                            </div>
                                            <button type="submit" class="btn btn-success" style="width: 25%; margin: 0px 258px;">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button class="psg-p-btn mt-3 "><a href="{{ route('viewgallery.index')}}" class="text-white"><i class="fas fa-image me-2"></i>Add Images</a></button>



                  
                    </div>
                </div>
            </div>
        </div>

        <script>

        // Start index from 1 instead of 0 to match backend expectations
        let index = 1;

        document.getElementById('add-more').addEventListener('click', function () {
            const template = document.getElementById('field-template').innerHTML;
            const newField = template.replace(/__INDEX__/g, index);
            const div = document.createElement('div');
            div.innerHTML = newField;
            document.getElementById('dynamic-fields').appendChild(div);
            index++;
        });

            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-field')) {
                    e.target.closest('.dynamic-field').remove();
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.upload-area').forEach(area => {
                    area.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        area.classList.add('dragover');
                    });

                    area.addEventListener('dragleave', () => {
                        area.classList.remove('dragover');
                    });

                    area.addEventListener('drop', (e) => {
                        e.preventDefault();
                        area.classList.remove('dragover');
                        const input = area.querySelector('input[type="file"]');
                        input.files = e.dataTransfer.files;
                        previewImage(input);
                    });
                });
            });

            function previewImage(input) {
                const uploadArea = input.closest('.upload-area');
                const preview = uploadArea.querySelector('.image-preview');
                preview.innerHTML = '';

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = "Preview";
                        img.style.maxWidth = "100%";
                        img.style.maxHeight = "150px";
                        img.classList.add("mt-2", "img-fluid", "rounded");
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $("#studentPortfolio").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
        });
    });
</script>
<script>
    function confirmDelete1(studentId) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`portfolio-form-delete-${studentId}`).submit();
                Swal.fire("Deleted!", "The portfolio has been deleted.", "success");
            }
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");
        editButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const heading = this.getAttribute("data-heading");
                const actionUrl = this.getAttribute("data-action");
                document.getElementById("editForm").setAttribute("action", actionUrl);
                document.getElementById("edit_heading").value = heading;
            });
        });
    });
</script>
@endsection

@if (session('success'))
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