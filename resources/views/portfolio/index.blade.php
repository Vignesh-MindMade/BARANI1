@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<style>
 .box-style {
  border: 2px solid;
  margin: 1rem 0;
  color: #777474;
  padding: 5px;
  border-radius: 5px;
 }

 .box-style1 {
  border: 1px solid #121212;
  margin: 43px 47px;
  color: #777474;
  padding: 12px 3px;
  border-radius: 5px;
 }

 #input-fileds {
  width: 84%;
  height: 34px;
  margin: -2px 9px;
  text-align: center;
 }

 #addMoreBtn {
  transition: all 0.3s ease-in-out;
 }

 #addMoreBtn:hover {
  background-color: #218838;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
 }

 #addImageForm {
  transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
  transform: translateY(-10px);
  opacity: 0;
 }

 #addImageForm.show {
  transform: translateY(0);
  opacity: 1;
 }

 #addImageForm .form-label {
  font-size: 16px;
 }

 #addImageForm .form-control {
  box-shadow: none;
  transition: border-color 0.3s ease-in-out;
 }

 #addImageForm .form-control:focus {
  border-color: #80bdff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
 }

 #addImageForm button {
  transition: background-color 0.3s ease-in-out;
 }

 #addImageForm button:hover {
  background-color: #0056b3;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
 }
 span {
  color: red;
 }

 .box-style {
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 15px;
  background-color: #f9f9f9;
 }

 .form-label {
  font-weight: bold;
  margin-bottom: 5px;
  display: inline-block;
 }

 .preview-image {
  max-width: 100px;
  display: none;
  margin-top: 10px;
 }

 .mt-4 {
  margin-top: 20px;
 }

 h1 {
  font-family: "Arial", sans-serif;
  color: #333;
  background: linear-gradient(45deg, #ff6b6b, #f3a683);
  padding: 10px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  font-size: 30px;
  width: 290px;
  margin: 0px 337px;
 }

 h1:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
 }
</style>

@section("wrapper")
<div class="page-wrapper">
 <div class="page-content">
  <h6 class="mb-0 text-uppercase">Add Student Projects</h6>
  <hr />

  <div class="row">
   <div class="col-md-12">
    <div class="card">
     <div class="card-body">
      <form action="{{ route('portfolio.store')}}" method="POST" enctype="multipart/form-data">
       @csrf
       <!-- Thumbnail -->
       <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail <span>*</span></label>
        <input class="form-control" type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail" aria-label="Image" onchange="displayImage(event, 'previewImage')" />
        <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />
       </div>
       <!-- Description -->
       <div class="mb-3">
        <label for="student_name" class="form-label">Student Name<span>*</span></label>
        <input class="form-control" type="text" id="student_name" name="student_name" placeholder="Student Name" aria-label="Description" />
       </div>
       <!-- Date -->
       <div class="mb-3">
        <label for="project_name" class="form-label">Project Name<span>*</span></label>
        <input class="form-control" type="text" id="project_name" name="project_name" placeholder="Project Name" aria-label="Project" />
       </div>

       <div class="mb-3">
        <label for="description" class="form-label">Project Description<span>*</span></label>
        <textarea class="form-control" id="description" name="description" placeholder="Project Description" aria-label="Project Description" style="width: 100%; height: 150px;"></textarea>
       </div>

       <div class="mb-3">
        <label for="filter_id" class="form-label">Category<span>*</span></label>
        <select class="form-select" id="filter_id" name="filter_id" aria-label="Filter">
         <option value="">--</option>
         @foreach($filters as $filter)
         <option value="{{ $filter->id }}">{{ $filter->name }}</option>
         @endforeach
        </select>
       </div>

       <h2 onclick="toggleContent()" style="font-size: 18px;font-family: initial;color: red;font-weight: bolder;">Add Images</h2>

       <div id="imageContent" style="display: none;">
        <hr />
        <!-- Image and Content 1 -->
        <div class="row">
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image1" class="form-label">Image1 </label>
          <input class="form-control" type="file" id="image1" name="image1" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage1')" />
          <img id="previewImage1" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content1" name="content1" placeholder="Description" aria-label="Description" />
         </div>
         <!-- Image and Content 2 -->
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image2" class="form-label">Image2 </label>
          <input class="form-control" type="file" id="image2" name="image2" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage2')" />
          <img id="previewImage2" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content2" name="content2" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>

         <!-- Image and Content 3 -->
         <div class="col-lg-6 box-style box-style">
          <br />
          <br />
          <label for="image3" class="form-label">Image3 </label>
          <input class="form-control" type="file" id="image3" name="image3" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage3')" />
          <img id="previewImage3" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />
          <input class="form-control mt-4" type="text" id="content3" name="content3" placeholder="Description" aria-label="Description" />

          <br />
          <br />
         </div>

         <!-- Image and Content 4 -->
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image4" class="form-label">Image4 </label>
          <input class="form-control" type="file" id="image4" name="image4" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage4')" />
          <img id="previewImage4" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content4" name="content4" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>

         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image5" class="form-label">Image5</label>
          <input class="form-control" type="file" id="image5" name="image5" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage5')" />
          <img id="previewImage5" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content5" name="content5" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image6" class="form-label">Image6</label>
          <input class="form-control" type="file" id="image6" name="image6" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage6')" />
          <img id="previewImage6" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content6" name="content6" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image7" class="form-label">Image7</label>
          <input class="form-control" type="file" id="image7" name="image7" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage7')" />
          <img id="previewImage7" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content7" name="content7" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>
         <div class="col-lg-6 box-style">
          <br />
          <br />
          <label for="image8" class="form-label">Image8</label>
          <input class="form-control" type="file" id="image8" name="image8" placeholder="Image" aria-label="Image" onchange="displayImage(event, 'previewImage8')" />
          <img id="previewImage8" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;" />

          <input class="form-control mt-4" type="text" id="content8" name="content8" placeholder="Description" aria-label="Description" />
          <br />
          <br />
         </div>
        </div>

        <div class="mb-3">
         <label for="sort_id" class="form-label">Sort ID</label>
         <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Sort ID" aria-label="Sort ID" />
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
       </div>

       <div class="page-content">
        <h6 class="mb-0 text-uppercase">Student's Portfolio</h6>
        <hr />
        <div class="col-md-12">
         <div class="card">
          <div class="card-body">
           <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width: 100%;">
             <thead>
              <tr>
               <th>S.no</th>
               <th>Thumbnail</th>
               <th>Student Name</th>
               <th>Project Name</th>
               <th>Category</th>
               <th>Action</th>
              </tr>
             </thead>
             <tbody>
              @foreach($students as $key => $student)
              <tr>
               <td>{{ $key+1 }}</td>
               <td><img src="{{ asset('images/' . $student->thumbnail) }}" alt="{{ $student->name }}" style="max-width: 100px;" /></td>
               <td>{{ $student->student_name }}</td>
               <td>{{ $student->project_name }}</td>
               <td>{{ $student->filter->name }}</td>
               <td>
                <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $student->id }}">
                 View
                </button>

                <form id="portfolio-form-delete-{{ $student->id }}" action="{{ route('portfolio.destroy', ['id' => $student->id]) }}" method="POST">
                 @csrf @method('DELETE')
                 <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete1({{ $student->id }})">Delete</button>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="editModal{{ $student->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $student->id }}" aria-hidden="true">
                 <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $student->id }}">News and Events</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                    <div class="row">
                     <div class="col-lg-12">
                      <form action="{{ route('portfolio.update', ['id' => $student->id]) }}" method="POST" enctype="multipart/form-data">
                       @csrf @method('PUT')

                       <div class="mb-3">
                        <label for="student_name" class="form-label">Student Name:</label>
                        <input type="text" name="student_name" class="form-control" value="{{ $student->student_name }}" required />
                       </div>

                       <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name:</label>
                        <input type="text" name="project_name" class="form-control" value="{{ $student->project_name }}" required />
                       </div>

                       <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail:</label><br />
                        <img src="{{ asset('images/' . $student->thumbnail) }}" alt="{{ $student->student_name }}" style="max-width: 100px;" class="mb-2" />
                        <input type="file" name="thumbnail" class="form-control" accept="image/*" />
                        <small class="text-muted">Leave this field empty if you do not want to update the thumbnail.</small>
                       </div>

                       <hr />

                       <h5 class="modal-title text-center mb-3 fw-bold" id="editModalLabel{{ $student->id }}" style="font-size: 40px;">Gallery</h5>
                       @php $foundImage = false; @endphp
                       
                       <div class="row">
                           @for ($i = 1; $i <= 10; $i++)
                               @if (!empty($student->{'image'.$i}))
                               @php $foundImage = true; @endphp
                       
                               <div class="col-lg-4 box-style1" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                   <!-- Image Thumbnail -->
                                   <a data-bs-toggle="modal" data-bs-target="#imageModal{{ $i }}">
                                       <img src="{{ asset('images/' . $student->{'image'.$i}) }}" alt="Image {{ $i }}" style="width: 265px; height: 209.5px;" class="img-fluid mb-2" />
                                   </a>
                    
                                   <!-- Description Input -->
                                   <input type="text" name="content{{ $i }}" class="form-control text-center mb-2" value="{{ $student->{'content'.$i} }}" placeholder="Edit Description {{ $i }}" />
                       
                                   <!-- File Input (Existing) -->
                                   <input type="file" name="image{{ $i }}" accept="image/*" class="form-control-file mb-2" style="margin-bottom: 10px; width: 65%; text-align: center;" />
                               </div>
                       
                               <!-- Image Modal -->
                               <div class="modal fade" id="imageModal{{ $i }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $i }}" aria-hidden="true">
                                   <div class="modal-dialog modal-xl">
                                       <div class="modal-content">
                                           <div class="modal-body">
                                               <img src="{{ asset('images/' . $student->{'image'.$i}) }}" alt="Image {{ $i }}" style="width: 100%; height: 100%;" class="img-fluid" />
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               @endif
                           @endfor
                       </div>
                       
                       @if (!$foundImage)
                       <div class="col-lg-12">
                           <p>No images found</p>
                       </div>
                       @endif
                       

                       <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-success px-5 py-2 addMoreBtn" data-student-id="{{ $student->id }}" style="background-color: #28a745; border: none; border-radius: 50px; font-size: 18px;">
                         <i class="fas fa-plus-circle"></i> Add More
                        </button>

                        <!-- Add Image Form (initially hidden) -->
                        <div
                         class="p-4 rounded shadow-sm bg-white mt-4 addImageForm"
                         id="addImageForm-{{ $student->id }}"
                         style="display: none; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border: 1px solid #dee2e6;"
                        >
                         <h4 class="mb-4 text-primary font-weight-bold"><i class="fas fa-image"></i> Add New Image</h4>

                         <div class="mb-4">
                          <label for="newImage" class="form-label font-weight-bold text-dark"><i class="fas fa-image"></i> Choose Image:</label>
                          <input type="file" name="newImage" class="form-control border-primary" accept="image/*" style="border-radius: 8px;" />
                         </div>

                         <div class="mb-4">
                          <label for="newContent" class="form-label font-weight-bold text-dark"><i class="fas fa-pencil-alt"></i> Description:</label>
                          <textarea name="newContent" class="form-control border-primary" rows="3" placeholder="Enter a description..." style="border-radius: 8px;"></textarea>
                         </div>
                        </div>
                       </div>

                       <!-- Save Changes Button -->
                       <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary">Save All Changes</button>
                       </div>
                      </form>
                     </div>
                    </div>
                   </div>
                  </div>
                 </div>
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

       @endsection @section("script")
       <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
       <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
       <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

       <script>
        function displayImage(event, previewId) {
         var image = document.getElementById(previewId);
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
        $(document).ready(function () {
         $(".edit-btn").click(function () {
          var images = JSON.parse($(this).data("images"));
          var contents = JSON.parse($(this).data("contents"));
          var modalBody = $("#modalBody");
          modalBody.empty(); // Clear previous content
          images.forEach(function (imageSrc, index) {
           modalBody.append('<h1><img src="' + imageSrc + '" alt="Image ' + (index + 1) + '" style="max-width: 100px;"></h1>');
           modalBody.append("<p>" + contents[index] + "</p>");
          });
         });
        });
       </script>

       <script>
        function confirmDelete(studentId, imageIndex) {
         Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
         }).then((result) => {
          if (result.isConfirmed) {
           document.getElementById("deleteForm-" + studentId + "-" + imageIndex).submit();
          }
         });
        }
       </script>

       <script>
        $("form").on("submit", function (e) {
         e.preventDefault();

         var formData = new FormData(this);

         $.ajax({
          url: $(this).attr("action"),
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
           // Optionally, append the new image to the gallery without reloading the page
           location.reload(); // or update the gallery section dynamically
          },
          error: function (response) {
           alert("There was an error adding the image. Please try again.");
          },
         });
        });
       </script>

       <script>
        document.addEventListener("DOMContentLoaded", function () {
         const deleteButtons = document.querySelectorAll(".delete-image");

         deleteButtons.forEach((button) => {
          button.addEventListener("click", function () {
           const action = this.getAttribute("data-action");

           if (confirm("Are you sure you want to delete this image?")) {
            const form = document.createElement("form");
            form.action = action;
            form.method = "POST";
            form.style.display = "none";

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            const csrfField = document.createElement("input");
            csrfField.type = "hidden";
            csrfField.name = "_token";
            csrfField.value = csrfToken;

            const methodField = document.createElement("input");
            methodField.type = "hidden";
            methodField.name = "_method";
            methodField.value = "DELETE";

            form.appendChild(csrfField);
            form.appendChild(methodField);
            document.body.appendChild(form);

            form.submit();
           }
          });
         });
        });
       </script>

       <script>
        document.addEventListener("DOMContentLoaded", function () {
         document.querySelectorAll(".addMoreBtn").forEach(function (button) {
          button.addEventListener("click", function () {
           const studentId = button.getAttribute("data-student-id");
           const form = document.getElementById(`addImageForm-${studentId}`);
           if (form.style.display === "none") {
            form.style.display = "block";
           } else {
            form.style.display = "none";
           }
          });
         });
        });
       </script>

       <script>
        function confirmDelete1(studentId) {
         Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
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
        function toggleContent() {
         const content = document.getElementById("imageContent");
         content.style.display = content.style.display === "none" ? "block" : "none";
        }

        function displayImage(event, previewId) {
         const image = document.getElementById(previewId);
         image.src = URL.createObjectURL(event.target.files[0]);
         image.style.display = "block";
        }
       </script>
       @endsection
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
