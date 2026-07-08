@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection @section("wrapper")

<style>
    #currentFile img,
    #currentFile video {
        max-width: 100%;
        height: auto;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">

        <h2 class="mb-0 text-uppercase">Add Banner</h2>
        <div class="">
            
            <div class="">
                <div class="page-box">
                    <div class="card-body">
                        <div class="table-responsive">
                             <table class="table mb-0">
                                   <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Banner</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $key => $banner)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if (Str::endsWith($banner->file, ['.mp4']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('images/' . $banner->file) }}" type="video/mp4" />
                                                Your browser does not support the video tag.
                                            </video>
                                            @else
                                            <img src="{{ asset('images/' . $banner->file) }}" alt="{{ $banner->file }}" style="max-width: 100px;" />
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button
                                                type="button"
                                                class="psg-p-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBannerModal"
                                                data-id="{{ $banner->id }}"
                                                data-file="{{ $banner->file }}"
                                                data-sortid="{{ $banner->sort_id }}"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" class="delete-form" style="display: inline;">
                                                @csrf @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger delete-button">Delete</button>
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
        
              <button id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()">Add New Banner</button>

                           <div class="page-box mt-5" id="videoContent" style="display: none;"> 
       <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div class="card-body">
                        <form id="bannerForm" action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="fileTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Choose File Type
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="fileTypeDropdown">
                                        <li><a class="dropdown-item" href="#" onclick="selectFileType('image')">Image</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="selectFileType('video')">Video</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3" id="fileInputContainer" style="display: none;">
                                <input class="form-control" type="file" name="imageFile" id="imageFile" accept="image/*" placeholder="Image" aria-label="Image" onchange="displayImage(event)" />
                           <!-- File Input -->
                         <input class="form-control" type="file" name="videoFile" id="videoFile" accept="video/*" placeholder="Video" aria-label="Video" style="display: none;" />
                                <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />
                            </div>

                            <div class="mb-3">
                                <label for="sort_id">Order Id:</label>
                                <input class="form-control" type="number" name="sort_id" placeholder="Order Id" aria-label="SortId" />
                            </div>
                            <button type="submit" class="psg-p-btn ml-0"><span class="bi--save-fill"></span> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                           </div>

        
 
        

        <!--end row-->
    </div>
</div>

<!-- Edit Banner Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @foreach ($banners as $banner )

            <form id="editBannerForm" action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editBannerModalLabel">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="bannerId" name="banner_id" value="{{ $banner->id }}" required />
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file" />
                        <div id="currentFile">
                            <!-- Current file (image or video) will be displayed here -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sort_id" class="form-label">Order ID</label>
                        <input type="text" class="form-control" id="sort_id" name="sort_id" value="{{ $banner->sort_id }}" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

@endsection @section("script")
<script>
    document.getElementById("file").addEventListener("change", function (event) {
        const file = event.target.files[0];
        const fileDisplayArea = document.getElementById("currentFile");

        // Clear any existing content
        fileDisplayArea.innerHTML = "";

        if (file) {
            const fileURL = URL.createObjectURL(file);

            // Check if the file is an image
            if (file.type.startsWith("image/")) {
                const img = document.createElement("img");
                img.src = fileURL;
                img.onload = function () {
                    console.log("Image loaded successfully.");
                };
                img.onerror = function () {
                    console.error("Error loading image.");
                    fileDisplayArea.innerText = "Error loading image.";
                };
                fileDisplayArea.appendChild(img);
            }
            // Check if the file is a video
            else if (file.type.startsWith("video/")) {
                const video = document.createElement("video");
                video.src = fileURL;
                video.controls = true;
                video.onloadstart = function () {
                    console.log("Video loaded successfully.");
                };
                video.onerror = function () {
                    console.error("Error loading video.");
                    fileDisplayArea.innerText = "Error loading video.";
                };
                fileDisplayArea.appendChild(video);
            }
            // Unsupported file type
            else {
                fileDisplayArea.innerText = "Unsupported file type";
            }
        } else {
            fileDisplayArea.innerText = "No file selected";
        }
    });
</script>

<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script>
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



// Toggle add new section: 

        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.textContent = "Close";
            } else {
                content.style.display = "none";
                button.textContent = "Add New Banner";
            }
        }
    
    
    
    
    function selectFileType(fileType) {
        if (fileType === "image") {
            document.getElementById("imageFile").style.display = "block";
            document.getElementById("videoFile").style.display = "none";
        } else if (fileType === "video") {
            document.getElementById("imageFile").style.display = "none";
            document.getElementById("videoFile").style.display = "block";
        }
        document.getElementById("fileInputContainer").style.display = "block";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#bannerForm").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('check.video') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.exists) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Only one video file is allowed.",
                        });
                    } else {
                        $("#bannerForm")[0].submit();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        const deleteButtons = document.querySelectorAll(".delete-button");

        deleteButtons.forEach((button) => {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                const form = this.closest(".delete-form");

                Swal.fire({
                    title: "Are you sure?",
                    // text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "delete",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        const editBannerModal = document.getElementById("editBannerModal");
        editBannerModal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget; // Button that triggered the modal
            const id = button.getAttribute("data-id");
            const file = button.getAttribute("data-file");
            const sortId = button.getAttribute("data-sortid");
            const modal = editBannerModal.querySelector(".modal-content");

            // Set the form action
            const form = modal.querySelector("form");

            // Populate the form fields
            modal.querySelector("#bannerId").value = id;
            modal.querySelector("#sort_id").value = sortId;

            const currentFileContainer = modal.querySelector("#currentFile");
            const fileInput = modal.querySelector("#file");
            currentFileContainer.innerHTML = ""; // Clear previous content

            const fileUrl = `public/images/${file}`;
            console.log("File URL:", fileUrl); // Debug file URL

            // Set the accept attribute based on the current file type
            if (file.endsWith(".mp4")) {
                fileInput.setAttribute("accept", "video/mp4");
                const videoElement = document.createElement("video");
                videoElement.width = 320;
                videoElement.height = 240;
                videoElement.controls = true;

                const sourceElement = document.createElement("source");
                sourceElement.src = fileUrl;
                sourceElement.type = "video/mp4";

                videoElement.appendChild(sourceElement);
                currentFileContainer.appendChild(videoElement);
            } else if (file.endsWith(".jpeg") || file.endsWith(".jpg") || file.endsWith(".webp") || file.endsWith(".png")) {
                fileInput.setAttribute("accept", "image/jpeg,image/webp,image/png");
                const imgElement = document.createElement("img");
                imgElement.src = fileUrl;
                imgElement.alt = file;
                imgElement.style.maxWidth = "100px";

                imgElement.onload = () => console.log('Image loaded successfully.');
                imgElement.onerror = () => console.error('Error loading image.');

                currentFileContainer.appendChild(imgElement);
            } else {
                fileInput.removeAttribute("accept"); // Reset if the file type is unexpected
            }
        });
    });
</script>

<script>
    document.getElementById("videoFile").addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const video = document.createElement("video");
            const fileURL = URL.createObjectURL(file);

            video.src = fileURL;

            // Check the duration once the metadata is loaded
            video.onloadedmetadata = function () {
                URL.revokeObjectURL(fileURL); // Clean up the object URL

                if (video.duration > 30) {
                    // Show SweetAlert message
                    Swal.fire({
                        icon: "error",
                        title: "Video Length Exceeded",
                        text: "Please upload a video of 30 seconds or less.",
                        confirmButtonText: "OK",
                    });

                    // Clear the input value
                    event.target.value = "";
                }
            };
        }
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
