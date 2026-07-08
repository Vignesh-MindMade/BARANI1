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
    .text-primary {
        color: #0461e9 !important;
        font-family: initial;
    }
    .text-primaryBold {
        color: #0461e9 !important;
        font-family: initial;
        font-size: 18px;
        font-weight: bolder;
    }
</style>

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">{{ 'Editorial Menu' }}</h6>
        <hr />

        <form action="{{ route('menu-editoriol-title.store') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" />
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <hr />
        <div class="container mt-4">
            <h5 class="text-primary">Title List</h5>
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($EdtMenuTitles as $index => $item)
                    <tr id="menu-item-{{ $item->id }}">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-button" data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-bs-toggle="modal" data-bs-target="#editModalForTitle-{{ $item->id }}"><i class="bi bi-pencil-square"></i> Edit</button>
                        </td>
                        <td>
                            <form id="Menu-{{ $item->id }}" action="{{ route('menu-editoriol-title.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-xl btn-danger" onclick="SectionDelete('{{ $item->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal for Title -->
                    <div class="modal fade" id="editModalForTitle-{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Menu Title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <form id="editFormTitleNew-{{ $item->id }}" method="POST" action="{{ route('menu-editoriol-title.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editTitle-{{ $item->id }}" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="editTitle-{{ $item->id }}" name="title" value="{{ $item->title }}" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No menu items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button text-primaryBold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Add Menu
                    </button>
                </h2>

                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form action="{{ route('menu-editoriol.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="editoriol_id">Select Title</label>
                                        <select class="form-control" id="editoriol_id" name="editoriol_id" required>
                                            <option value="">Choose a title</option>
                                            @foreach($EdtMenuTitles as $title)
                                            <option value="{{ $title->id }}">{{ $title->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="posted_by">Posted By</label>
                                        <input type="text" class="form-control" id="posted_by" name="posted_by" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="posted_on">Posted On</label>
                                        <input type="date" class="form-control" id="posted_on" name="posted_on" required />
                                    </div>

                                 <div class="mb-3">
                                    <label for="pdf">Upload PDF</label>
                                    <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" onchange="previewPDF(event)" />
                                    <div id="pdf-preview" style="margin-top: 10px;"></div>
                                </div>
                            
                                <div class="mb-3">
                                    <label for="image">Upload Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept=".webp" onchange="previewImage(event)" />
                                    <img id="image-preview" src="" style="display: none; max-width: 200px; margin-top: 10px;">
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <hr />

                <div class="container mt-4">
                    <h5 class="text-primary">Stored Menu Items</h5>
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Posted By</th>
                                <th>Posted On</th>
                                <th>View PDF</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($EdtMenu as $index => $item)
                            <tr id="menu-item-{{ $item->id }}">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    @php $title = $EdtMenuTitles->firstWhere('id', $item->editoriol_id); @endphp {{ $title->title ?? 'N/A' }}
                                </td>
                                <td>{{ $item->posted_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->posted_on)->format('d-m-Y') }}</td>
                                <td><a href="{{ asset('public/pdfs/' . $item->pdf) }}" target="_blank">View PDF</a></td>
                                <td><img src="{{ asset('public/images/' . $item->image) }}" alt="Image" style="width: 50px; height: auto;" /></td>
                                <td class="text-center">
                                    <button
                                        class="btn btn-sm btn-warning edit-button-menu"
                                        data-id="{{ $item->id }}"
                                        data-title="{{ $title->title ?? '' }}"
                                        data-posted_by="{{ $item->posted_by }}"
                                        data-posted_on="{{ $item->posted_on }}"
                                        data-pdf="{{ $item->pdf }}"
                                        data-image="{{ $item->image }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editMenuModal-{{ $item->id }}"
                                    >
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                </td>
                                <td>
                                    <form id="Menu-{{ $item->id }}" action="{{ route('menu-editoriol.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-xl btn-danger" onclick="SectionDelete('{{ $item->id }}')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal for Menu Item -->
                            <div class="modal fade" id="editMenuModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMenuModalLabel">Edit Menu Item</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="editMenuForm-{{ $item->id }}" method="POST" action="{{ route('menu-editoriol.update', $item->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editTitle-{{ $item->id }}">Select Title</label>
                                                    <select class="form-control" id="editTitle-{{ $item->id }}" name="editoriol_id" required>
                                                        <option value="">Choose a title</option>
                                                        @foreach($EdtMenuTitles as $title)
                                                        <option value="{{ $title->id }}" {{ $title->id == $item->editoriol_id ? 'selected' : '' }}>{{ $title->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editPostedBy-{{ $item->id }}">Posted By</label>
                                                    <input type="text" class="form-control" id="editPostedBy-{{ $item->id }}" name="posted_by" value="{{ $item->posted_by }}" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editPostedOn-{{ $item->id }}">Posted On</label>
                                                    <input type="date" class="form-control" id="editPostedOn-{{ $item->id }}" name="posted_on" value="{{ $item->posted_on }}" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editPdf-{{ $item->id }}">Upload PDF</label>
                                                    <input type="file" class="form-control" id="editPdf-{{ $item->id }}" name="pdf" accept=".pdf" />
                                                    <a id="currentPdf-{{ $item->id }}" href="{{ asset('public/pdfs/' . $item->pdf) }}" target="_blank">View Current PDF</a>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editImage-{{ $item->id }}">Upload Image</label>
                                                    <input type="file" class="form-control" id="editImage-{{ $item->id }}" name="image" accept=".webp" />
                                                    <img id="currentImage-{{ $item->id }}" src="{{ asset('public/images/' . $item->image) }}" alt="Image" style="width: 50px; height: auto;" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No menu items found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                        var form = document.getElementById("Menu-" + sectionId);
                        form.submit();
                    }
                });
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @endsection

        @section("script")
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @endsection
        
        
          <script>
        function previewPDF(event) {
            let file = event.target.files[0];
            let pdfPreview = document.getElementById('pdf-preview');
            
            if (file) {
                let objectURL = URL.createObjectURL(file);
                pdfPreview.innerHTML = `<embed src="${objectURL}" type="application/pdf" width="300" height="200">`;
            }
        }

        function previewImage(event) {
            let file = event.target.files[0];
            let imagePreview = document.getElementById('image-preview');

            if (file) {
                let objectURL = URL.createObjectURL(file);
                imagePreview.src = objectURL;
                imagePreview.style.display = "block";
            }
        }
    </script>
    
    </div>
</div>