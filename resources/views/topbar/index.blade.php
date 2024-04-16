@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
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
        <h6 class="mb-0 text-uppercase"> TopBar</h6>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('topbar.store') }}" method="POST" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Top Bar :</label>
                                <input type="text" class="form-control" name="title" id="validationCustom01" required />
                                <div class="invalid-feedback">
                                    Please Enter Topbar Text
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Link Text:</label>
                                <input class="form-control" type="text" id="link_text validationCustom01" name="link_text" placeholder="Link Text" required />
                                <div class="invalid-feedback">
                                    Please Enter Link Text
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="validationCustom01">Link :</label>
                                <input class="form-control" type="url" id="link validationCustom01" name="link" placeholder="Link " required />
                                <div class="invalid-feedback">
                                    Please Enter Valid url
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="validationCustom01">Sort id :</label>
                                <input class="form-control" type="number" id="sort_id validationCustom01" name="sort_id" placeholder="Sort id" />
                            </div>
                            <button type="submit" class="btn btn-primary" id="button_style">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">TopBar List</h6>
            <hr />
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>TopBar Text</th>
                                        <th>Link Text</th>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topbars as $key => $topbar)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $topbar->title }}</td>
                                        <td>{{ $topbar->link_text }}</td>
                                        <td>{{ $topbar->link }}</td>
                                        <td>

                                            <button
                                                type="button"
                                                class="btn btn-primary edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $topbar->id }}"
                                                data-title="{{ $topbar->title }}"
                                                data-link-text="{{ $topbar->link_text }}"
                                                data-link="{{ $topbar->link }}"
                                                data-sort-id="{{ $topbar->sort_id }}">Edit

                                             </button>


                                            <form id="deleteForm" action="{{ route('topbar.delete', $topbar->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i> Delete</button>
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

    </div>
</div>

{{-- Edit Model --}}

<div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" style="margin-left: 25%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Topbar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('topbar.update', $topbar->id) }}" method="POST" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Top Bar :</label>
                        <input type="text" class="form-control" name="title" id="validationCustom01" value="{{ $topbar->title }}" required />
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Link Text :</label>
                        <input type="text" class="form-control" name="link_text" id="validationCustom01" value="{{ $topbar->link_text }}" required />
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01">Link :</label>
                        <input class="form-control" type="url" id="link validationCustom01" value="{{ $topbar->link }}" name="link" placeholder="Link " required />
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01">Sort id :</label>
                        <input class="form-control" type="number" id="sort_id validationCustom01" value="{{ $topbar->sort_id }}" name="sort_id" placeholder="Sort id" />
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 25%; margin: 0px 258px;">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection @section("script")
<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>



<script>

//  1. Form Validation Code:

    (function () {
        "use strict";

        var forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener(
                "submit",
                function (event) {
                    if (!form.checkValidity() || !isValidUrl(form.querySelector("#link").value)) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add("was-validated");
                },
                false
            );
        });

        // Function to validate URL
        function isValidUrl(url) {
            // Regular expression for URL validation
            var urlRegex = /^(?:http|https):\/\/[\w\-]+(?:\.[\w\-]+)+[\w\-.,@?^=%&:/~\+#]*[\w\-@?^=%&/~\+#]$/;
            return urlRegex.test(url);
        }
    })();


// 2 . Preview Image:

    function displayImage(event) {
        var image = document.getElementById("previewImage");
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = "block";
    }

</script>

<script>
    $(document).ready(function () {
        $("#example").DataTable();
    });
</script>

<script>

    $(document).ready(function () {
        var table = $("#example2").DataTable({
            lengthChange: false,
            buttons: ["copy", "excel", "pdf", "print"],
        });

        table.buttons().container().appendTo("#example2_wrapper .col-md-6:eq(0)");
    });
</script>

<script>

// 3. Edit Script :

document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const title = this.getAttribute("data-title");
                const linkText = this.getAttribute("data-link-text");
                const link = this.getAttribute("data-link");
                const sortId = this.getAttribute("data-sort-id");

                const modalForm = document.querySelector("#editModal form");

                modalForm.action = `/topbars/${id}/update`;
                modalForm.querySelector('[name="title"]').value = title;
                modalForm.querySelector('[name="link_text"]').value = linkText;
                modalForm.querySelector('[name="link"]').value = link;
                modalForm.querySelector('[name="sort_id"]').value = sortId;
            });
        });
    });

</script>

<script>

// 4 . Delete Model

    document.getElementById('deleteForm').addEventListener('submit', function(event) {
        event.preventDefault();

        $('#confirmDelete').modal('show');
    });

    document.getElementById('confirm').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });

</script>


@endsection
