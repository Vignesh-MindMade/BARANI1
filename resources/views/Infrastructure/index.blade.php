@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

<style>
    .box-style {
        @apply border border-gray-200 rounded-2xl p-8 bg-white shadow-lg hover:shadow-2xl transition-all duration-300;
    }

    .overlay-icons {
        @apply flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300;
    }

    .table-container {
        @apply overflow-x-auto rounded-lg border border-gray-200;
    }

    .table {
        @apply w-full border-collapse bg-white;
    }

    .table th, .table td {
        @apply px-6 py-4 text-sm text-gray-700;
    }

    .table th {
        @apply bg-gray-100 font-semibold text-gray-900 uppercase tracking-wide;
    }

    .table tr {
        @apply hover:bg-gray-50 transition-colors;
    }

    .form-label {
        @apply block text-sm font-semibold text-gray-800 mb-2;
    }

    .form-control, select {
        @apply block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-3 px-4 transition duration-200;
    }

    .btn {
        @apply px-6 py-2.5 rounded-lg font-semibold text-sm transition duration-200;
    }

    .btn-primary {
        @apply bg-indigo-600 text-white hover:bg-indigo-700;
    }

    .btn-secondary {
        @apply bg-gray-500 text-white hover:bg-gray-600;
    }

    .btn-danger {
        @apply bg-red-500 text-white hover:bg-red-600;
    }

    .modal-content {
        @apply rounded-2xl shadow-2xl;
    }

    .modal-header {
        @apply border-b border-gray-100 bg-gray-50 px-6 py-4;
    }

    .modal-footer {
        @apply border-t border-gray-100 bg-gray-50 px-6 py-4;
    }

    .subfolder-images {
        @apply max-h-96 overflow-y-auto p-6 border border-gray-100 rounded-lg bg-gray-50;
    }

    .action-container {
        @apply py-4 border-b border-gray-100 last:border-b-0;
    }

    .img-thumbnail {
        @apply m-2 rounded-lg shadow-md hover:shadow-lg transition-transform duration-300 hover:scale-105;
    }
</style>
@endsection

@section("wrapper")
<div class="page-wrapper bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen py-12">
    <div class="page-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">Department Management</h1>
            <p class="text-lg text-gray-600 mt-3 max-w-2xl mx-auto">Effortlessly manage departments and their details with a sleek and intuitive interface.</p>
            <hr class="border-gray-200 mt-6" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Create Department Form -->
            <div class="lg:col-span-4">
                <div class="box-style">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Department</h2>
                    <form action="{{ route('infrastructure.main.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="form-label">Department Name <span class="text-red-500">*</span></label>
                            <input class="form-control" id="title" name="title" placeholder="Enter department name" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Create Department</button>
                    </form>
                </div>
            </div>

            <!-- Existing Departments List -->
            <div class="lg:col-span-8">
                <div class="box-style relative group">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Existing Departments</h2>
                    <div class="table-container">
                        <table id="cirrcularsHomePage" class="table table-striped table-bordered">
                            <thead class="bg-dark text-white text-center">
                                <tr>
                                    <th class="w-16">S.No</th>
                                    <th>Department</th>
                                    <th class="w-48">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Infrastructure_fronts as $Infrastructure_front)
                                <tr class="relative group">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $Infrastructure_front->title }}</td>
                                    <td>
                                        <div class="overlay-icons">
                                            <button class="btn btn-warning" style="margin-right: 26px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $Infrastructure_front->id }}">Edit</button>
                                            <form action="{{ route('infrastructure.main.destroy', $Infrastructure_front->id) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $Infrastructure_front->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $Infrastructure_front->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('infrastructure.main.update', $Infrastructure_front->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-xl font-bold" id="editModalLabel{{ $Infrastructure_front->id }}">Edit Department</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-8">
                                                    <div class="mb-6">
                                                        <label for="title" class="form-label">Department Name</label>
                                                        <input type="text" class="form-control" name="title" value="{{ $Infrastructure_front->title }}" required />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-12 border-gray-200" />

        <!-- Add Images Form -->
        <div class="box-style">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Department Images</h2>
            <form action="{{ route('infrastructure.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="Infrastructure_id" class="form-label">Select Parent Folder <span class="text-red-500">*</span></label>
                        <select class="form-control" id="Infrastructure_id" name="Infrastructure_id" required>
                            <option value="">Select Parent Folder</option>
                            @foreach($Infrastructure_fronts as $Infrastructure_front)
                            <option value="{{ $Infrastructure_front->id }}">{{ $Infrastructure_front->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="infrastructure_title" class="form-label">Title <span class="text-red-500">*</span></label>
                        <input class="form-control" type="text" id="infrastructure_title" name="infrastructure_title" required />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <hr class="my-12 border-gray-200" />

        <!-- Faculty Management -->
        <div class="box-style">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Faculty Management</h2>
            <div class="table-container">
                <table class="table table-striped table-bordered" id="infrastrcture">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Infrastructure_fronts as $front)
                        <tr class="relative group">
                            <td>{{ $front->title }}</td>
                            <td>
                                @foreach($Infrastructure_Details->where('Infrastructure_id', $front->id) as $detail)
                                <div class="action-container">
                                    <strong class="text-gray-800">{{ $detail->infrastructure_title }}</strong>
                                    <div class="mt-3 overlay-icons">
                                        <button class="btn btn-warning"  style="margin-right: 31px;" data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $detail->id }}">Edit Detail</button>
                                        <form action="{{ route('infrastructure.destroy', $detail->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Detail Modals -->
        @foreach($Infrastructure_Details as $detail)
        <div class="modal fade" id="editDetailModal{{ $detail->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('infrastructure.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title text-xl font-bold">Edit Department Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="Infrastructure_id" class="form-label">Select Infrastructure</label>
                                    <select class="form-control" id="Infrastructure_id" name="Infrastructure_id" required>
                                        @foreach($Infrastructure_fronts as $front)
                                        <option value="{{ $front->id }}" {{ $detail->Infrastructure_id == $front->id ? 'selected' : '' }}>
                                            {{ $front->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="infrastructure_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="infrastructure_title" name="infrastructure_title" value="{{ $detail->infrastructure_title }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#cirrcularsHomePage").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
            pageLength: 10,
            language: {
                searchPlaceholder: "Search departments...",
                search: ""
            }
        });

        $("#infrastrcture").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
            pageLength: 10,
            language: {
                searchPlaceholder: "Search faculty...",
                search: ""
            }
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2563eb",
            cancelButtonColor: "#dc2626",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm" + id).submit();
            }
        });
    }

    document.getElementById("Infrastructure_id").addEventListener("change", function () {
        var infrastructureId = this.value;
        if (infrastructureId) {
            fetch(`https://psg.mindmadetech.in/admin/api/getAllSubfolders/${infrastructureId}`)
                .then((response) => response.json())
                .then((data) => {
                    var subfolderSelect = document.getElementById("Infrastructure_detatil_id");
                    subfolderSelect.innerHTML = '<option value="">Select Sub Folder</option>';
                    data.subfolders.forEach(function (subfolder) {
                        var option = document.createElement("option");
                        option.value = subfolder.id;
                        option.textContent = subfolder.name;
                        subfolderSelect.appendChild(option);
                    });
                })
                .catch((error) => {
                    console.error("Error fetching subfolders:", error);
                });
        }
    });

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'rounded-lg');
                img.style.maxWidth = '150px';
                preview.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showImageModal(imageSrc, title) {
        const modal = document.getElementById('imagePreviewModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = modal.querySelector('.modal-title');
        modalImage.src = imageSrc;
        modalTitle.textContent = title;
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.img-thumbnail');
        images.forEach(img => {
            img.style.cursor = 'pointer';
        });
    });
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