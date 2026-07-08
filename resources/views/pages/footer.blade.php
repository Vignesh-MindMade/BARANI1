@extends("layouts.app")

@section("style")
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<!-- Custom Styles -->
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-wrapper {
        padding: 20px;
    }

    .page-content {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: transform 0.3s ease;
    }

    .page-content:hover {
        transform: translateY(-5px);
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 20px;
    }

    .accordion-button {
        font-weight: 500;
        background-color: #f8f9fa;
        border-radius: 8px !important;
        padding: 15px 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background-color: #007bff;
        color: white;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    .accordion-button:hover {
        background-color: #e9ecef;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    }

    .btn-primary, .btn-success, .btn-danger, .btn-info {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: transform 0.2s ease, background-color 0.3s ease;
    }

    .btn-primary:hover, .btn-success:hover, .btn-danger:hover, .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
        background: #ffffff;
    }

    .table-dark th {
        background-color: #343a40;
        color: white;
        font-weight: 500;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f1f3f5;
    }

    .breadcrumb {
        background-color: #e9ecef;
        border-radius: 8px;
        padding: 12px 20px;
        margin-bottom: 20px;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #0056b3;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-radius: 8px 0 0 8px;
        border: 1px solid #ced4da;
    }

    .form-label {
        font-weight: 500;
        color: #1a202c;
    }

    hr {
        border-top: 1px solid #e2e8f0;
        margin: 20px 0;
    }

    .container {
        padding: 0;
    }

    .row {
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .col {
            margin-bottom: 15px;
        }

        .btn-primary, .btn-success, .btn-danger, .btn-info {
            width: 100%;
        }
    }
</style>
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-folder mr-2"></i>Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit mr-2"></i>Footer Management</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Footer Management</h5>
                        <hr />

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <!-- Contact Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        <i class="fas fa-address-book mr-2"></i> Contact
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('footercontact.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="address" class="form-label">Contact Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" placeholder="Add Address" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="mail" class="form-label">Mail</label>
                                                        <input type="text" class="form-control" id="mail" name="mail" placeholder="Add Email" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="contact_no_1" class="form-label">Contact Number 1</label>
                                                        <input type="text" class="form-control" id="contact_no_1" name="contact_no_1" placeholder="Add Contact Number" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="contact_no_2" class="form-label">Contact Number 2</label>
                                                        <input type="text" class="form-control" id="contact_no_2" name="contact_no_2" placeholder="Add Contact Number" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        <hr />

                                        <table class="table mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Address</th>
                                                    <th>Mail</th>
                                                    <th>Contact Number 1</th>
                                                    <th>Contact Number 2</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contacts ?? '' as $key => $contact)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td id="address-{{ $contact->id }}">{{ $contact->address }}</td>
                                                    <td id="mail-{{ $contact->id }}">{{ $contact->mail }}</td>
                                                    <td id="contact_no_1-{{ $contact->id }}">{{ $contact->contact_no_1 }}</td>
                                                    <td id="contact_no_2-{{ $contact->id }}">{{ $contact->contact_no_2 }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="editContactRow('{{ $contact->id }}')"><i class="fas fa-edit mr-1"></i> Edit</button>
                                                        <button type="button" class="btn btn-sm btn-success" style="display: none;" id="saveContact-{{ $contact->id }}" onclick="saveContactRow('{{ $contact->id }}')"><i class="fas fa-save mr-1"></i> Save</button>
                                                    </td>
                                                    <td>
                                                        <form id="deleteForm" action="{{ route('footercontact.destroy', $contact->id) }}" method="POST" style="display: inline;">
                                                            @csrf @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmcontactDelete('{{ $contact->id }}')"><i class="fas fa-trash mr-1"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Text Section -->
                            <hr>
                            <form id="psg-iaq-form" action="{{ route('footertext.store') }}" method="POST">
                                @csrf
                                @foreach($texts as $text)
                                <div class="mb-3">
                                    <label for="text" class="form-label">Footer Text</label>
                                    <textarea class="form-control" id="text" name="text" aria-label="Description" style="width: 100%; height: 150px;">{{ old('text', $text->text ?? '') }}</textarea>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            <!-- Quick Access Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <i class="fas fa-link mr-2"></i> Quick Access
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('footer.links') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="pagename" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="pagename" name="pagename" placeholder="Add Name" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="link" class="form-label">Link</label>
                                                        <input type="url" class="form-control" id="link" name="link" placeholder="Add Link" />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <label for="pdf" class="form-label">Upload PDF</label>
                                                        <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        <hr />

                                        <table class="table mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Name</th>
                                                    <th>Link</th>
                                                    <th>PDF</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($links ?? '' as $key => $link)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td id="pagename-{{ $link->id }}">{{ $link->pagename }}</td>
                                                    <td id="link-{{ $link->id }}">{{ $link->link }}</td>
                                                    <td id="pdf-{{ $link->id }}">
                                                        @if($link->pdf)
                                                        <a href="{{ asset('public/pdfs/' . $link->pdf) }}" target="_blank">View PDF</a>
                                                        @else No PDF @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="editRow('{{ $link->id }}')"><i class="fas fa-edit mr-1"></i> Edit</button>
                                                        <button type="button" class="btn btn-sm btn-success" style="display: none;" id="save-{{ $link->id }}" onclick="saveRow('{{ $link->id }}')"><i class="fas fa-save mr-1"></i> Save</button>
                                                    </td>
                                                    <td>
                                                        <form id="deleteForm-{{ $link->id }}" action="{{ route('links.destroy', $link->id) }}" method="POST" style="display: inline;">
                                                            @csrf @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $link->id }}')"><i class="fas fa-trash mr-1"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Downloads Section (Hidden as per original code) -->
                            <div class="accordion-item d-none">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <i class="fas fa-download mr-2"></i> Downloads
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('footerdownload.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="pdf_name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="pdf_name" name="pdf_name" placeholder="Add Name" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="link_name" class="form-label">Link</label>
                                                        <input type="url" class="form-control" id="link_name" name="link_name" placeholder="Add Link" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="pdf" class="form-label">Upload</label>
                                                        <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        <hr />
                                        <table class="table mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Name</th>
                                                    <th>Link</th>
                                                    <th>PDF</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($downloads ?? '' as $key => $download)
                                                <tr id="row-{{ $download->id }}">
                                                    <td>{{ $key+1 }}</td>
                                                    <td id="pdf_name-{{ $download->id }}">{{ $download->pdf_name }}</td>
                                                    <td id="link_name-{{ $download->id }}">{{ $download->link_name }}</td>
                                                    <td id="pdf-{{ $download->id }}">
                                                        @if($download->pdf)
                                                        <a href="{{ asset('pdfs/' . $download->pdf) }}" target="_blank">View PDF</a>
                                                        @else No PDF available @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="editdownloadRow('{{ $download->id }}')"><i class="fas fa-edit mr-1"></i> Edit</button>
                                                        <button type="button" class="btn btn-sm btn-success" style="display: none;" id="savedownload-{{ $download->id }}" onclick="savedownloadRow('{{ $download->id }}')"><i class="fas fa-save mr-1"></i> Save</button>
                                                    </td>
                                                    <td>
                                                        <form id="deletedownloadForm" action="{{ route('footerdownload.destroy', $download->id) }}" method="POST" style="display: inline;">
                                                            @csrf @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmdownloadDelete('{{ $download->id }}')"><i class="fas fa-trash mr-1"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingfour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                                        <i class="fas fa-share-alt mr-2"></i> Social Links
                                    </button>
                                </h2>
                                <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('socials.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @foreach($socials as $social)
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Add Facebook URL" value="{{ old('facebook', $social->facebook ?? '') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Add LinkedIn URL" value="{{ old('linkedin', $social->linkedin ?? '') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Add Instagram URL" value="{{ old('instagram', $social->instagram ?? '') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Add Twitter URL" value="{{ old('twitter', $social->twitter ?? '') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Add YouTube URL" value="{{ old('youtube', $social->youtube ?? '') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <br />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!---->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>

<!-- Contact Section Scripts -->
<script>
    function editContactRow(id) {
        document.getElementById("address-" + id).innerHTML = '<input type="text" class="form-control" id="input-address-' + id + '" value="' + document.getElementById("address-" + id).innerText + '">';
        document.getElementById("mail-" + id).innerHTML = '<input type="text" class="form-control" id="input-mail-' + id + '" value="' + document.getElementById("mail-" + id).innerText + '">';
        document.getElementById("contact_no_1-" + id).innerHTML = '<input type="text" class="form-control" id="input-contact_no_1-' + id + '" value="' + document.getElementById("contact_no_1-" + id).innerText + '">';
        document.getElementById("contact_no_2-" + id).innerHTML = '<input type="text" class="form-control" id="input-contact_no_2-' + id + '" value="' + document.getElementById("contact_no_2-" + id).innerText + '">';
        document.querySelector("[onclick=\"editContactRow('" + id + "')\"]").style.display = "none";
        document.getElementById("saveContact-" + id).style.display = "inline";
    }

    function saveContactRow(id) {
        var address = document.getElementById("input-address-" + id).value;
        var mail = document.getElementById("input-mail-" + id).value;
        var contact_no_1 = document.getElementById("input-contact_no_1-" + id).value;
        var contact_no_2 = document.getElementById("input-contact_no_2-" + id).value;

        var csrfToken = "{{ csrf_token() }}";

        // Update the table cells to reflect the new values
        document.getElementById("address-" + id).innerText = address;
        document.getElementById("mail-" + id).innerText = mail;
        document.getElementById("contact_no_1-" + id).innerText = contact_no_1;
        document.getElementById("contact_no_2-" + id).innerText = contact_no_2;

        // Show the edit button and hide the save button
        document.querySelector("[onclick=\"editContactRow('" + id + "')\"]").style.display = "inline";
        document.getElementById("saveContact-" + id).style.display = "none";

        // Send an AJAX request to update the contact
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('footercontact.update', '') }}/" + id, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Contact updated successfully.",
                    showConfirmButton: false,
                    timer: 2000,
                });
            } else if (xhr.readyState === 4) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Error updating contact.",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        };

        var data = JSON.stringify({
            address: address,
            mail: mail,
            contact_no_1: contact_no_1,
            contact_no_2: contact_no_2,
        });

        xhr.send(data);
    }

    function confirmcontactDelete(contactID) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm").action = "{{ route('footercontact.destroy', ':id') }}".replace(":id", contactID);
                document.getElementById("deleteForm").submit();
            }
        });
    }
</script>

<!-- Quick Access Section Scripts -->
<script>
    function editRow(id) {
        document.getElementById("pagename-" + id).innerHTML = '<input type="text" class="form-control" id="input-pagename-' + id + '" value="' + document.getElementById("pagename-" + id).innerText + '">';
        document.getElementById("link-" + id).innerHTML = '<input type="text" class="form-control" id="input-link-' + id + '" value="' + document.getElementById("link-" + id).innerText + '">';
        document.getElementById("pdf-" + id).innerHTML = '<input type="file" class="form-control" id="input-pdf-' + id + '">';
        document.querySelector("[onclick=\"editRow('" + id + "')\"]").style.display = "none";
        document.getElementById("save-" + id).style.display = "inline";
    }

    function saveRow(id) {
        var pagename = document.getElementById("input-pagename-" + id).value;
        var link = document.getElementById("input-link-" + id).value;
        var pdfInput = document.getElementById("input-pdf-" + id);
        var pdfFile = pdfInput.files[0];
        var formData = new FormData();

        formData.append("pagename", pagename);
        formData.append("link", link);
        if (pdfFile) {
            formData.append("pdf", pdfFile);
        }
        formData.append("_token", "{{ csrf_token() }}");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('links.update', '') }}/" + id, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Link updated successfully.",
                    showConfirmButton: false,
                    timer: 2000,
                });
                location.reload();
            } else if (xhr.readyState === 4) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Error updating link.",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        };

        xhr.send(formData);
    }

    function confirmDelete(linkId) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm-" + linkId).submit();
            }
        });
    }
</script>

<!-- Downloads Section Scripts -->
<script>
    function editdownloadRow(downloadid) {
        var pdfNameCell = document.getElementById("pdf_name-" + downloadid);
        var pdfLinkCell = document.getElementById("link_name-" + downloadid);
        var pdfCell = document.getElementById("pdf-" + downloadid);

        pdfNameCell.innerHTML = '<input type="text" class="form-control" id="input-pdf_name-' + downloadid + '" value="' + pdfNameCell.innerText + '">';
        pdfLinkCell.innerHTML = '<input type="text" class="form-control" id="input-link_name-' + downloadid + '" value="' + pdfLinkCell.innerText + '">';
        pdfCell.innerHTML = '<input type="file" class="form-control" id="input-pdf-' + downloadid + '">';

        document.querySelector("[onclick=\"editdownloadRow('" + downloadid + "')\"]").style.display = "none";
        document.getElementById("savedownload-" + downloadid).style.display = "inline";
    }

    function savedownloadRow(downloadid) {
        var pdfName = document.getElementById("input-pdf_name-" + downloadid).value;
        var pdfLinkCell = document.getElementById("input-link_name-" + downloadid).value;
        var pdfFile = document.getElementById("input-pdf-" + downloadid).files[0];

        var formData = new FormData();
        formData.append("pdf_name", pdfName);
        formData.append("link_name", pdfLinkCell);
        formData.append("pdf", pdfFile);
        formData.append("_token", "{{ csrf_token() }}");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('footerdownload.update', '') }}/" + downloadid, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Download updated successfully.",
                    showConfirmButton: false,
                    timer: 2000,
                });

                document.getElementById("pdf_name-" + downloadid).innerText = pdfName;
                document.getElementById("link_name-" + downloadid).innerText = pdfLinkCell;

                if (pdfFile) {
                    var newPdfUrl = JSON.parse(xhr.responseText).pdf_url;
                    document.getElementById("pdf-" + downloadid).innerHTML = '<a href="' + newPdfUrl + '" target="_blank">View PDF</a>';
                } else {
                    document.getElementById("pdf-" + downloadid).innerText = "No PDF available";
                }

                document.querySelector("[onclick=\"editdownloadRow('" + downloadid + "')\"]").style.display = "inline";
                document.getElementById("savedownload-" + downloadid).style.display = "none";
            } else if (xhr.readyState === 4) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Error updating download.",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        };

        xhr.send(formData);
    }

    function confirmdownloadDelete(pdfid) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deletedownloadForm").action = "{{ route('footerdownload.destroy', ':id') }}".replace(":id", pdfid);
                document.getElementById("deletedownloadForm").submit();
            }
        });
    }
</script>

<!-- Success Notification -->
@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
        });
    });
</script>
@endif
@endsection