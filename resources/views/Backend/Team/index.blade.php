@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <style>
        /* Card and Box Styling */
        .page-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .page-box:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 0.8rem;
            margin-bottom: 1.2rem;
        }

        .section-header i {
            color: #0d6efd;
            margin-right: 10px;
        }

        .section-header h2,
        .section-header h4 {
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Custom Buttons */
        .smart-btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            border: none;
        }

        .smart-btn i {
            margin-right: 6px;
        }

        .smart-btn:hover {
            transform: translateY(-2px);
        }

        .smart-btn-primary {
            background: #0d6efd;
            color: #fff;
        }

        .smart-btn-primary:hover {
            background: #0a58ca;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.25);
        }

        .smart-btn-danger {
            background: #ff3a5e;
            color: #fff;
        }

        .smart-btn-danger:hover {
            background: #e52d50;
            box-shadow: 0 4px 8px rgba(255, 58, 94, 0.25);
        }

        .smart-btn-dark {
            background: #212529;
            color: #fff;
        }

        .smart-btn-dark:hover {
            background: #343a40;
            box-shadow: 0 4px 8px rgba(33, 37, 41, 0.25);
        }

        .smart-btn-success {
            background: #10b981;
            color: white;
            border: none;
        }

        .smart-btn-success:hover {
            background: #0ea271;
            transform: translateY(-2px);
        }

        .smart-btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }

        .smart-btn-add:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .smart-btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }

        .smart-btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* Role Badge Styling */
        .role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 5px 0;
        }

        .badge-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
        }

        .badge-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
        }

        .badge-success {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
            color: white;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #858796 0%, #60616f 100%);
            color: white;
        }

        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modal Customization */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Tree Structure */
        .tree {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .tree ul {
            position: relative;
            padding-top: 30px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tree li {
            list-style-type: none;
            position: relative;
            padding: 30px 15px 0;
        }

        .tree li::before,
        .tree li::after {
            content: "";
            position: absolute;
            top: 0;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 25px;
        }

        .tree li::before {
            right: 50%;
            border-right: 2px solid #ccc;
        }

        .tree li::after {
            left: 50%;
            border-left: 2px solid #ccc;
        }

        .tree>ul>li::before,
        .tree>ul>li::after {
            border: none;
        }

        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        .tree ul ul::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 25px;
        }

        /* Member Card */
        .member-card {
            display: inline-block;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 10px;
            width: 200px;
            transition: all 0.3s ease;
            position: relative;
        }

        .member-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .member-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #3a86ff;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .member-card:hover img {
            transform: scale(1.05);
        }

        .member-card h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 5px 0 2px;
            color: #333;
        }

        .member-card p {
            font-size: 13px;
            color: #666;
            margin: 5px 0 0 0;
        }

        .card-actions {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .card-actions button {
            flex: 0 1 auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .tree ul {
                flex-direction: column;
                align-items: center;
            }

            .tree li::before,
            .tree li::after,
            .tree ul ul::before {
                display: none;
            }

            .member-card {
                width: 180px;
            }

            .action-btns {
                flex-direction: column;
                gap: 0.5rem;
            }

            .smart-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">

            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-1">
                    <div class="col-md-6">
                        <div class="section-header">
                            <i class="bi bi-building-fill-gear"></i>
                            <h2 class="mb-0 text-uppercase">Our Team</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-md-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('testCurricular.index') }}" class="text-decoration-none">
                                        <i class="fas fa-home me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Our Team</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="page-box section-padding text-center">
                <div class="container">
                    <h6 class="text-uppercase text-secondary fw-semibold mb-2">Meet Our Team</h6>

                    <div class="tree">
                        <ul>
                            @foreach ($teams as $member)
                                <li>
                                    <div class="member-card">
                                        @if ($member->image)
                                            <img src="{{ asset('images/team/' . $member->image) }}"
                                                alt="{{ $member->name }}">
                                        @else
                                            <img src="{{ asset('no-image.png') }}" alt="{{ $member->name }}">
                                        @endif
                                        <h4>{{ $member->name }}</h4>
                                        @if ($member->role)
                                            <span
                                                class="role-badge badge-{{ $member->role_badge_color ?? 'secondary' }}">{{ $member->role }}</span>
                                        @endif
                                        <p>{{ $member->designation }}</p>

                                        <div class="card-actions">
                                            <button class="edit-btn smart-btn smart-btn-primary"
                                                data-id="{{ $member->id }}" data-name="{{ $member->name }}"
                                                data-designation="{{ $member->designation }}"
                                                data-role="{{ $member->role }}" data-image="{{ $member->image }}"
                                                data-bs-toggle="modal" data-bs-target="#editTeamModal">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <button class="add-member-btn smart-btn smart-btn-add"
                                                data-parent-id="{{ $member->id }}"
                                                data-parent-name="{{ $member->name }}" data-bs-toggle="modal"
                                                data-bs-target="#addMemberModal">
                                                <i class="bi bi-plus-circle"></i> Add
                                            </button>

                                            @if ($member->children->count() == 0)
                                                <form action="{{ route('team.destroy', $member->id) }}" method="POST"
                                                    id="delete-form-{{ $member->id }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="smart-btn smart-btn-delete"
                                                        onclick="confirmDelete({{ $member->id }})">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($member->children->count())
                                        <ul>
                                            @foreach ($member->children as $child)
                                                <li>
                                                    <div class="member-card">
                                                        @if ($child->image)
                                                            <img src="{{ asset('images/team/' . $child->image) }}"
                                                                alt="{{ $child->name }}">
                                                        @else
                                                            <img src="{{ asset('no-image.png') }}"
                                                                alt="{{ $child->name }}">
                                                        @endif
                                                        <h4>{{ $child->name }}</h4>
                                                        @if ($child->role)
                                                            <span
                                                                class="role-badge badge-{{ $child->role_badge_color ?? 'secondary' }}">{{ $child->role }}</span>
                                                        @endif
                                                        <p>{{ $child->designation }}</p>

                                                        <div class="card-actions">
                                                            <button class="edit-btn smart-btn smart-btn-primary"
                                                                data-id="{{ $child->id }}"
                                                                data-name="{{ $child->name }}"
                                                                data-designation="{{ $child->designation }}"
                                                                data-role="{{ $child->role }}"
                                                                data-image="{{ $child->image }}" data-bs-toggle="modal"
                                                                data-bs-target="#editTeamModal">
                                                                <i class="bi bi-pencil-square"></i> Edit
                                                            </button>

                                                            <button class="add-member-btn smart-btn smart-btn-add"
                                                                data-parent-id="{{ $child->id }}"
                                                                data-parent-name="{{ $child->name }}"
                                                                data-bs-toggle="modal" data-bs-target="#addMemberModal">
                                                                <i class="bi bi-plus-circle"></i> Add
                                                            </button>

                                                            @if ($child->children->count() == 0)
                                                                <form action="{{ route('team.destroy', $child->id) }}"
                                                                    method="POST" id="delete-form-{{ $child->id }}"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="smart-btn smart-btn-delete"
                                                                        onclick="confirmDelete({{ $child->id }})">
                                                                        <i class="bi bi-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @if ($child->children->count())
                                                        <ul>
                                                            @foreach ($child->children as $sub)
                                                                <li>
                                                                    <div class="member-card">
                                                                        @if ($sub->image)
                                                                            <img src="{{ asset('images/team/' . $sub->image) }}"
                                                                                alt="{{ $sub->name }}">
                                                                        @else
                                                                            <img src="{{ asset('no-image.png') }}"
                                                                                alt="{{ $sub->name }}">
                                                                        @endif
                                                                        <h4>{{ $sub->name }}</h4>
                                                                        @if ($sub->role)
                                                                            <span
                                                                                class="role-badge badge-{{ $sub->role_badge_color ?? 'secondary' }}">{{ $sub->role }}</span>
                                                                        @endif
                                                                        <p>{{ $sub->designation }}</p>

                                                                        <div class="card-actions">
                                                                            <button
                                                                                class="edit-btn smart-btn smart-btn-primary"
                                                                                data-id="{{ $sub->id }}"
                                                                                data-name="{{ $sub->name }}"
                                                                                data-designation="{{ $sub->designation }}"
                                                                                data-role="{{ $sub->role }}"
                                                                                data-image="{{ $sub->image }}"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#editTeamModal">
                                                                                <i class="bi bi-pencil-square"></i> Edit
                                                                            </button>

                                                                            <form
                                                                                action="{{ route('team.destroy', $sub->id) }}"
                                                                                method="POST"
                                                                                id="delete-form-{{ $sub->id }}"
                                                                                style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="button"
                                                                                    class="smart-btn smart-btn-delete"
                                                                                    onclick="confirmDelete({{ $sub->id }})">
                                                                                    <i class="bi bi-trash"></i> Delete
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Edit Modal -->
            <div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title fw-semibold" id="editTeamModalLabel">
                                <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Team Member
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="editTeamForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3 text-center">
                                    <img id="previewImage" src="" alt="Profile" class="rounded-circle border"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Name</label>
                                    <input type="text" name="name" id="editName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Designation</label>
                                    <input type="text" name="designation" id="editDesignation" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Role/Position</label>
                                    <input type="text" name="role" id="editRole" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Profile Image</label>
                                    <input type="file" name="image" id="editImage" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="smart-btn smart-btn-dark" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </button>
                                <button type="submit" class="smart-btn smart-btn-success">
                                    <i class="bi bi-check2-circle"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add Member Modal -->
            <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title fw-semibold" id="addMemberModalLabel">
                                <i class="bi bi-person-plus-fill me-2 text-success"></i>Add Team Member
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="addMemberForm" action="{{ route('team.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="parent_id" id="parentId">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Parent Member</label>
                                    <input type="text" id="parentName" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Designation <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="designation" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Role/Position</label>
                                    <input type="text" name="role" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Profile Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <small class="text-muted">Optional - Leave blank for default avatar</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="smart-btn smart-btn-dark" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </button>
                                <button type="submit" class="smart-btn smart-btn-success">
                                    <i class="bi bi-check2-circle"></i> Add Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Team Member
            const editButtons = document.querySelectorAll('.edit-btn');
            const form = document.getElementById('editTeamForm');
            const nameInput = document.getElementById('editName');
            const designationInput = document.getElementById('editDesignation');

            const roleInput = document.getElementById('editRole');
            const previewImage = document.getElementById('previewImage');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const designation = this.dataset.designation;
                    const role = this.dataset.role;
                    const image = this.dataset.image;

                    nameInput.value = name;
                    designationInput.value = designation;
                    roleInput.value = role || '';
                    previewImage.src = image ?
                        "{{ asset('images/team') }}/" + image :
                        "{{ asset('no-image.png') }}";
                    form.action = "{{ route('team.update', ['id' => ':id']) }}".replace(':id', id);
                });
            });

            // Add Team Member
            const addButtons = document.querySelectorAll('.add-member-btn');
            const parentIdInput = document.getElementById('parentId');
            const parentNameInput = document.getElementById('parentName');

            addButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const parentId = this.dataset.parentId;
                    const parentName = this.dataset.parentName;

                    parentIdInput.value = parentId;
                    parentNameInput.value = "Under: " + parentName;
                });
            });
        });

        // Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This team member will be permanently deleted. This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3a5e",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "<i class='bi bi-trash'></i> Yes, delete it!",
                cancelButtonText: "<i class='bi bi-x-circle'></i> Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + id).submit();
                    Swal.fire({
                        title: 'Deleting...',
                        html: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        }

        // Success/Error Messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        @endif
    </script>
@endsection
