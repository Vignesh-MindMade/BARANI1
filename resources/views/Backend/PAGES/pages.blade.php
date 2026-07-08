@extends("layouts.app")

@section("style")
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

<!-- Custom Styles for Attractive UI -->
<style>
    .page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }
    .page-content {
        padding: 20px;
    }
    .breadcrumb {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .breadcrumb-item a:hover {
        color: #764ba2;
    }
    h2 {
        color: #2c3e50;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .page-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
    }
    .page-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    .card-body {
        padding: 25px;
    }
    .table-dark {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .table th {
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        transition: background-color 0.3s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }
    .psg-p-btn {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .btn-danger {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    }
    .btn-danger:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    #toggleButton {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
        border-radius: 25px;
        padding: 12px 30px;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    #toggleButton:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(67, 233, 123, 0.4);
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .d-flex.gap-2 > * {
        margin-right: 0.5rem;
    }
    .w-50-p {
        width: 48%;
        margin-right: 4%;
    }
    .w-50-p:last-child {
        margin-right: 0;
    }
    .d-c-c {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-scroll mr-1"></i> Topbar Scroll Text</li>
            </ol>
        </nav>

        <h2 class="mb-4 text-uppercase font-weight-bold"><i class="fas fa-scroll mr-2"></i> Topbar Scroll Text</h2>
        
        <div class="mt-20 animate-fade-in">
            <div class="col-md-12 p-0">
                <div class="page-box">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" id="example">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>TopBar Text</th>
                                        <th>Order ID</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topbars as $key => $topbar)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $topbar->title }}</td>
                                        <td>{{ $topbar->sort_id ?? '--' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <!-- Edit Button -->
                                            <button
                                                type="button"
                                                class="psg-p-btn edit-btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $topbar->id }}"
                                                data-title="{{ $topbar->title }}"
                                                data-link="{{ $topbar->link }}"
                                                data-sort-id="{{ $topbar->sort_id }}"
                                                data-action="{{ route('topbar.update', ['id' => $topbar->id]) }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>

                                            <!-- Delete Form -->
                                            <form id="deleteForm-{{ $topbar->id }}" 
                                                action="{{ route('topbar.delete', $topbar->id) }}" 
                                                method="POST" 
                                                class="m-0">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger" style="margin: -1px 11px;" onclick="confirmDeleteTopBar('{{ $topbar->id }}')">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
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

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animate-fade-in">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit mr-2"></i> Edit TopBar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Form -->
                        <form method="POST" id="editForm" class="row g-3 needs-validation" novalidate>
                            @csrf @method('PUT')

                            <!-- Hidden Input to Store ID -->
                            <input type="hidden" name="id" id="topbar_id" />

                            <div class="mb-3 w-100">
                                <label for="title" class="form-label">Top Bar:</label>
                                <input type="text" class="form-control" name="title" id="title" required />
                            </div>
                            <div class="mb-3 w-100">
                                <label for="link" class="form-label">Link:</label>
                                <input class="form-control" type="url" id="link" name="link" placeholder="Link" required />
                            </div>
                            <div class="mb-3 w-100">
                                <label for="sort_id" class="form-label">Order ID:</label>
                                <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Order ID" />
                            </div>
                            <div class="w-100 d-c-c">
                                <button type="submit" class="psg-p-btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toggle Button -->
        <button id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()"><i class="fas fa-plus mr-1"></i> Add New Topbar</button> 

        <!-- Add New Topbar Section -->
        <div class="page-box mt-5 animate-fade-in" id="videoContent" style="display: none;">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="{{ route('topbar.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 w-50-p">
                            <label for="validationCustom01" class="form-label">Top Bar Text Scroll<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="title" id="validationCustom01" required />
                        </div>
                        <div class="mb-3 w-50-p">
                            <label for="sort_id" class="form-label">Order ID:</label>
                            <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Order ID" />
                        </div>
                        <div class="mb-3 w-50-p">
                            <label for="link" class="form-label">Link<span style="color: red;">*</span></label>
                            <input class="form-control" type="url" id="link" name="link" placeholder="Link" required />
                        </div>
                        <button type="submit" class="psg-p-btn btn-success" id="button_style"><i class="fas fa-save mr-1"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Initialize DataTable for Enhanced Table -->
<script>
$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[0, 'asc']],
        language: {
            search: '<i class="fas fa-search me-1"></i> Search:',
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                last: '<i class="fas fa-angle-double-right"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left"></i>'
            }
        }
    });
});
</script>

<script>
    function displayImage(event) {
        var image = document.getElementById("previewImage");
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = "block";
    }
</script>

<script>
    function toggleContent() {
        let content = document.getElementById("videoContent");
        let button = document.getElementById("toggleButton");

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
            content.classList.add('animate-fade-in');
            button.innerHTML = '<i class="fas fa-times mr-1"></i> Close';
        } else {
            content.style.display = "none";
            button.innerHTML = '<i class="fas fa-plus mr-1"></i> Add New Topbar';
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const title = this.getAttribute("data-title");
                const link = this.getAttribute("data-link");
                const sortId = this.getAttribute("data-sort-id");
                const actionUrl = this.getAttribute("data-action");

                // Populate the modal form fields
                document.getElementById("topbar_id").value = id;
                document.getElementById("title").value = title;
                document.getElementById("link").value = link;
                document.getElementById("sort_id").value = sortId;

                // Set the form action dynamically
                document.getElementById("editForm").action = actionUrl;
            });
        });
    });
</script>

<script>
    function confirmDeleteTopBar(topbarId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
            customClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteForm-${topbarId}`).submit();
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
            timer: 2000,
            customClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    });
</script>
@endif
@endsection