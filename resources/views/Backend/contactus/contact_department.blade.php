@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        .box-style {
            @apply border border-gray-200 rounded-2xl p-6 bg-white shadow-lg hover:shadow-xl transition-shadow;
        }
        .table-container {
            @apply overflow-x-auto rounded-lg border border-gray-200;
        }
        .table {
            @apply w-full border-collapse bg-white text-sm;
        }
        .table th {
            @apply bg-gray-100 font-semibold text-gray-900 uppercase tracking-wide px-4 py-3 text-left;
        }
        .table td {
            @apply px-4 py-3 border-t border-gray-200;
        }
        .table tr:hover {
            @apply bg-gray-50;
        }
        .form-label {
            @apply block text-sm font-semibold text-gray-700 mb-1;
        }
        .form-control, select {
            @apply block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50;
        }
        .btn {
            @apply px-4 py-2 rounded-lg font-medium text-xs transition-colors;
        }
        .btn-primary { @apply bg-indigo-600 text-white hover:bg-indigo-700; }
        .btn-warning { @apply bg-yellow-500 text-white hover:bg-yellow-600; }
        .btn-danger { @apply bg-red-600 text-white hover:bg-red-700; }
        .btn-sm { @apply px-3 py-1 text-xs; }
        .modal-content { @apply rounded-xl shadow-2xl; }
        .modal-header { @apply border-b border-gray-100 bg-gray-50 px-5 py-3; }
        .modal-footer { @apply border-t border-gray-100 bg-gray-50 px-5 py-3; }

        /* Keep in viewport */
        html, body { height: 100%; overflow: visible; }
        .page-wrapper { @apply flex flex-col h-screen; }
        .page-content { @apply flex-1 overflow-y-auto p-4 lg:p-8; }
    </style>
@endsection

@section('wrapper')
<div class="page-wrapper bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="page-content max-w-7xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Contact Us Department</h1>
            <hr class="border-gray-300 mt-4 w-24 mx-auto" />
        </div>

        <!-- Create Department + List -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            <!-- Create Form -->
            <div class="lg:col-span-4">
                <div class="box-style">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Create Department Title</h2>
                    <form action="{{ route('contactus_department.main.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label">Title <span class="text-red-500">*</span></label>
                            <input class="form-control" id="title" name="title" placeholder="e.g., HR Department" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Create</button>
                    </form>
                </div>
            </div>

            <!-- Department List -->
            <div class="lg:col-span-8">
                <div class="box-style">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Existing Departments</h2>
                    <div class="table-container">
                        <table id="departmentsTable" class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Contactus_department_titles as $dept)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dept->title }}</td>
                                    <td class="space-x-1">
                                        <button class="btn btn-warning btn-sm"  style="margin-right: 20px;"data-bs-toggle="modal" data-bs-target="#editDept{{ $dept->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('contactus_department.main.destroy', $dept->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this department?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editDept{{ $dept->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('contactus_department.main.update', $dept->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-bold">Edit Department</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <label class="form-label">Title</label>
                                                    <input class="form-control" name="title" value="{{ $dept->title }}" required />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
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

        <hr class="my-6 border-gray-300" />

        <!-- Add Contact Form -->
        <div class="box-style mb-8">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Add Contact Person</h2>
            <form action="{{ route('contactus_department_detail.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="form-label">Department <span class="text-red-500">*</span></label>
                        <select class="form-control" name="contactus_department_title_id" required>
                            <option value="">Select</option>
                            @foreach ($Contactus_department_titles as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Subtitle</label>
                        <input class="form-control" name="contactus_department_subtitle" placeholder="e.g., Head of HR" />
                    </div>
                    <div>
                        <label class="form-label">Name <span class="text-red-500">*</span></label>
                        <input class="form-control" name="name" required />
                    </div>
                    <div>
                        <label class="form-label">Designation <span class="text-red-500">*</span></label>
                        <input class="form-control" name="desgination"  />
                    </div>
                    <div>
                        <label class="form-label">Phone <span class="text-red-500">*</span></label>
                        <input class="form-control" name="phone" required />
                    </div>
                    <div>
                        <label class="form-label">Email <span class="text-red-500">*</span></label>
                        <input class="form-control" type="email" name="mail" required />
                    </div>
                   
                </div>
                <button type="submit" class="mt-4 btn btn-primary">Save Contact</button>
            </form>
        </div>

        <hr class="my-6 border-gray-300" />

        <!-- Department Management Table -->
        <div class="box-style">
            <h2 class="text-lg font-bold text-gray-800 mb-4">All Contacts</h2>
            <div class="table-container">
                <table id="contactsTable" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subtitle</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Sort Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Contactus_departments as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->contactus_department_subtitle }}</td>
                            <td>
                                {{ $Contactus_department_titles->firstWhere('id', $contact->contactus_department_title_id)?->title ?? '—' }}
                            </td>
                            <td>{{ $contact->desgination }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->mail }}</td>
                            <td>{{ $contact->sort_order }}</td>
                            <td class="space-x-1">
                                <button class="btn btn-warning btn-sm" style="margin-right: 20px;"data-bs-toggle="modal" data-bs-target="#editContact{{ $contact->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('contactus_department_detail.destroy', $contact->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this contact?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Contact Modal -->
                        <div class="modal fade" id="editContact{{ $contact->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('contactus_department_detail.update', $contact->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title font-bold">Edit Contact</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="form-label">Department</label>
                                                    <select class="form-control" name="contactus_department_title_id" required>
                                                        @foreach ($Contactus_department_titles as $dept)
                                                            <option value="{{ $dept->id }}" {{ $contact->contactus_department_title_id == $dept->id ? 'selected' : '' }}>
                                                                {{ $dept->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="form-label">Subtitle</label>
                                                    <input class="form-control" name="contactus_department_subtitle" value="{{ $contact->contactus_department_subtitle }}" />
                                                </div>
                                                <div>
                                                    <label class="form-label">Name *</label>
                                                    <input class="form-control" name="name" value="{{ $contact->name }}" required />
                                                </div>
                                                <div>
                                                    <label class="form-label">Designation *</label>
                                                    <input class="form-control" name="desgination" value="{{ $contact->desgination }}"  />
                                                </div>
                                                <div>
                                                    <label class="form-label">Phone *</label>
                                                    <input class="form-control" name="phone" value="{{ $contact->phone }}" required />
                                                </div>
                                                <div>
                                                    <label class="form-label">Email *</label>
                                                    <input class="form-control" name="mail" value="{{ $contact->mail }}" required />
                                                </div>
                                                <div>
                                                    <label class="form-label">Sort_order *</label>
                                                    <input class="form-control" name="sort_order" value="{{ $contact->sort_order }}"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
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
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#departmentsTable, #contactsTable').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        language: { search: "", searchPlaceholder: "Search..." }
    });
});

@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Success', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
@endif
</script>
@endsection