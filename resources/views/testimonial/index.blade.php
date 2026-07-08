@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    
    
    <!-- Include Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Apply Poppins font globally to the editor */
        .note-editor .note-editable {
            font-family: 'Poppins', sans-serif !important;
        }
        .note-editor {
    width: 100% !important;
    min-height: 250px;
    font-family: 'Poppins', sans-serif !important;
}
    </style>
    <style>
        .file-label { display: none; }
    </style>
    
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Add Testimonial Section -->
            <div class="mb-4">
                <h2 class="mb-0 text-uppercase">Home Page About Us</h2>
                 <div class="page-box">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table  table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $key => $testimonial)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $testimonial->title }}</td>
                                            <td class="d-flex justify-content-center">
                                                @if (Str::endsWith($testimonial->file, ['.mp4', '.avi', '.mov', '.wmv']))
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ asset('images/' . $testimonial->file) }}" type="video/mp4" />
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <img src="{{ asset('images/' . $testimonial->file) }}" 
                                                         alt="{{ $testimonial->file }}" 
                                                         style="max-width: 100px;" />
                                                @endif
                                            </td>
                                            <td class="text-center">

                                            <button type="button" 
                                                    class="psg-p-btn ml-0 edit-btn"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#testimonialEditModal"
                                                    data-id="{{ $testimonial->id }}"
                                                    data-title="{{ $testimonial->title }}"
                                                    data-content="{{ htmlentities($testimonial->content, ENT_QUOTES, 'UTF-8') }}"
                                                    data-file="{{ $testimonial->file }}"
                                                    data-sort-id="{{ $testimonial->sort_id }}"
                                                    @for ($i = 1; $i <= 10; $i++) 
                                                        data-point{{ $i }}="{{ $testimonial->{'point' . $i} }}"
                                                    @endfor>
                                                Edit
                                            </button>

                                            <form action="{{ route('testimonial.delete', $testimonial->id) }}"
                                                      method="POST" 
                                                      class="delete-form-testimonial"
                                                      style="display: inline;">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class=" btn-danger psg-p-btn delete-button"
                                                            onclick="confirmDeleteTopBar({{ $testimonial->id }})">
                                                        Delete
                                                    </button>
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

 

   <!-- Testimonials List Section -->
       
                           </div>

            <!-- Edit Modal -->
            <div class="modal fade bd-example-modal-lg " id="testimonialEditModal" tabindex="-1" aria-labelledby="testimonialEditModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content page-box">
                        <div class="modal-header">
                            <h5 class="modal-title" id="testimonialEditModalLabel">Edit Testimonial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('testimonial.update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data" id="testimonialEditForm">
                                @csrf 
                                @method('PATCH')

                                <!-- Title Field -->
                                <div class="mb-3">
                                    <label for="editTitle" class="form-label">Title <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="editTitle" name="title" required />
                                </div>

                                <!-- Content Field -->
                                <div class="mb-3">
                                    <label for="contentEdit" class="form-label">Content <span style="color:red;">*</span></label>
                                    <textarea class="form-control summernote" id="contentEdit" name="content" placeholder="Enter Content"></textarea>
                                </div>

                                <!-- Sort ID Field -->
                                <div class="mb-3">
                                    <label for="editSortId" class="form-label">Order ID</label>
                                    <input type="number" class="form-control" id="editSortId" name="sort_id" />
                                </div>

                                <!-- File Upload -->
                                <div class="mb-3">
                                    <label for="editFile" class="form-label">Upload New File (optional)</label>
                                    <input type="file" class="form-control" id="editFile" name="file" accept="image/*,video/*" />
                                </div>

                                <!-- File Preview -->
                                <div class="mb-3">
                                    <label class="form-label">Current File</label>
                                    <div id="filePreview" class="border rounded p-2">
                                        <!-- Preview content will be inserted here by JavaScript -->
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="button" class="psg-p-btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="psg-p-btn btn-primary">Update</button>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
    
    
    
<script>
    function previewImage() {
        const fileInput = document.getElementById('imageFile');
        const preview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const errorDiv = document.getElementById('imageError');

        errorDiv.textContent = ''; // Clear previous errors
        previewContainer.style.display = 'none'; // Hide preview initially

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // Check file type
            if (!file.type.includes('webp')) {
                errorDiv.textContent = 'Only WebP images are allowed.';
                fileInput.value = ''; // Clear the input
                return;
            }

            // Check file size (5MB = 5 * 1024 * 1024 bytes)
            if (file.size > 5 * 1024 * 1024) {
                errorDiv.textContent = 'File size must be 5MB or less.';
                fileInput.value = ''; // Clear the input
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
    <script>
    
    function selectFileType(type) {
        document.getElementById('imageInput').style.display = type === 'image' ? 'block' : 'none';
        document.getElementById('videoInput').style.display = type === 'video' ? 'block' : 'none';
        
        // Clear previously selected file
        document.getElementById('imageFile').value = '';
        document.getElementById('videoFile').value = '';
    }

    function validateFileSelection() {
        let imageFile = document.getElementById('imageFile').value;
        let videoFile = document.getElementById('videoFile').value;

        if (!imageFile && !videoFile) {
            alert('Please select and upload either an image or a video file.');
            return false;
        }
        return true;
    }
</script>
 <script>
 
$(document).ready(function() {
    // Initialize DataTable
    $("#example").DataTable();

    // Initialize Summernote for both add and edit forms
    initializeSummernote('#content');
    initializeSummernote('#contentEdit');

    // Setup edit button handlers
    setupEditButtonHandlers();
});




// Toggle add new section: 

        function toggleContent() {
            let content = document.getElementById("videoContent");
            let button = document.getElementById("toggleButton");

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                button.textContent = "Close";
            } else {
                content.style.display = "none";
                button.textContent = "Add New Testimonials";
            }
        }
    
function initializeSummernote(selector) {
    $(selector).summernote({
        placeholder: 'Enter Content',
        tabsize: 2,
        height: 250, // Adjust height as needed
        width: '100%', // Ensures it fits within col-lg-6
        fontNames: ['Poppins', 'Arial', 'Courier New', 'Times New Roman'],
        fontNamesIgnoreCheck: ['Poppins'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
}



      function setupEditButtonHandlers() {
          
     $('.edit-btn').on('click', function() {
        // Get the modal and form
        const modal = $('#testimonialEditModal');
        const form = $('#testimonialEditForm');
        
        // Get data from button attributes
        const id = $(this).data('id');
        const title = $(this).data('title');
        const content = $(this).data('content'); // Get encoded content
        const sortId = $(this).data('sort-id');
        const file = $(this).data('file');

        // Update form action URL
        form.attr('action', '{{ route("testimonial.update", ":id") }}'.replace(':id', id));

        // Set field values
        form.find('[name="title"]').val(title);
        form.find('[name="sort_id"]').val(sortId);

        // Decode HTML entities before setting content in Summernote
        const decodedContent = $('<textarea/>').html(content).text();
        $('#contentEdit').summernote('code', decodedContent);

        // Handle points dynamically
        const pointsContainer = form.find('#pointsContainer');
        pointsContainer.empty(); // Clear previous points

        for (let i = 1; i <= 10; i++) {
            const pointValue = $(this).data('point' + i);
            if (pointValue) {
                const pointDiv = $('<div>').addClass('mb-2 point-input-container');
                const label = $('<label>').addClass('form-label').text('Point ' + i);
                const input = $('<input>')
                    .addClass('form-control')
                    .attr({
                        'type': 'text',
                        'name': 'point' + i,
                        'value': pointValue
                    });
                pointDiv.append(label, input);
                pointsContainer.append(pointDiv);
            }
        }

        // Handle file preview
        updateFilePreview(file);
    });
}

        
        

        function updateFilePreview(file) {
            const preview = $('#filePreview');
            preview.empty();

            if (file) {
                const fileUrl = '{{ asset("images") }}/' + file;
                const isVideo = /\.(mp4|avi|mov|wmv)$/i.test(file);

                if (isVideo) {
                    preview.html(`
                        <video width="320" height="240" controls>
                            <source src="${fileUrl}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    `);
                } else {
                    preview.html(`
                        <img src="${fileUrl}" alt="Current file" style="max-width: 200px;">
                    `);
                }
            }
        }

        // Add More Points functionality for both forms
        function setupPointsButton(buttonId, containerId, maxPoints = 10) {
            $(`#${buttonId}`).on('click', function() {
                const container = $(`#${containerId}`);
                const currentPoints = container.find('.point-input-container').length;

                if (currentPoints < maxPoints) {
                    const newPointNumber = currentPoints + 1;
                    const pointDiv = $('<div>').addClass('mb-2 point-input-container');
                    const label = $('<label>').addClass('form-label').text('Point ' + newPointNumber);
                    const input = $('<input>')
                        .addClass('form-control')
                        .attr({
                            'type': 'text',
                            'name': 'point' + newPointNumber,
                            'placeholder': 'Enter Point ' + newPointNumber
                        });
                    pointDiv.append(label, input);
                    container.append(pointDiv);
                } else {
                    alert('Maximum of ' + maxPoints + ' points allowed.');
                }
            });
        }

        // Initialize Add More Points buttons
        $(document).ready(function() {
            setupPointsButton('addMorePointsBtn', 'pointsContainer');
            setupPointsButton('addMorePointsBtnModel', 'pointsContainerModel');
        });

        // File type selection for add form
        function selectFileType(type) {
            $('#imageInput').toggle(type === 'image');
            $('#videoInput').toggle(type === 'video');
        }

        // Delete confirmation
        function confirmDeleteTopBar(testimonialId) {
            Swal.fire({
                title: 'Are you sure?',
                // text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('.delete-form-testimonial');
                    form.attr('action', '{{ route("testimonial.delete", ":id") }}'.replace(':id', testimonialId));
                    form.submit();
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