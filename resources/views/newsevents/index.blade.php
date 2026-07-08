@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />   

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

<style>
.box-style {
    border: 1px solid #ced4da;

    color: #777474;
    padding: 20px;
    position: relative;
    margin-bottom: 1%;
}

.overlay-icons {
    position: absolute;
    top: 10px;
    right: 10px;
    display: none;
    gap: 5px;
}

.box-style:hover .overlay-icons {
    display: flex;
}

.gallery-image:hover {
    border: 2px solid blue;
}

.selected-image {
    border: 2px solid red;
}

.toggleimg {
    cursor: pointer;
}

.row {
    display: none;
    /* Hide rows by default */
}
</style>

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
         <h2 class="mb-0 text-uppercase">CHRONICLES</h2>
        <div class="">
            <div class="page-box">
                <div class="card-body">
                    <div class="table-responsive">
                        
                      <table id="CHRONICLEShome" class="table table-bordered table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.no</th>

                                    <th class="text-center">Thumbnail</th>
                                    <th class="text-center">Event Date</th>
                                    <!--<th>Images</th>-->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newsandevents as $key => $event)
                                <tr>
                                    <td>{{ $key+1 }}</td>

                                    <td class="d-flex justify-content-center"><img src="{{ asset('images/' . $event->image) }}" alt="{{ $event->name }}"
                                            style="width: 150px; height: auto;"></td>
                                    <td class="text-center">{{ $event->event_date }}</td>
                                    <!--<td>-->
                                    <!--        @php $foundImage = false; @endphp-->
                                    <!--        @for ($i = 1; $i <= 8; $i++)-->
                                    <!--            @if (!empty($event->{'image'.$i}))-->
                                    <!--                @php $foundImage = true; @endphp-->
                                    <!--            @endif-->
                                    <!--        @endfor-->

                                    <!--        @if ($foundImage)-->
                                    <!--            <div id="carouselExample{{ $event->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">-->
                                    <!--                <div class="carousel-inner text-center">-->
                                    <!--                    @php $activeSet = false; @endphp-->
                                    <!--                    @for ($i = 1; $i <= 8; $i++)-->
                                    <!--                        @if (!empty($event->{'image'.$i}))-->
                                    <!--                            <div class="carousel-item {{ !$activeSet ? 'active' : '' }}">-->
                                    <!--                                <img src="{{ asset('images/' . $event->{'image'.$i}) }}" alt="Image {{ $i }}" style="width: 100px; height: 100px;">-->
                                    <!--                                <p style="color:black;"><strong>{{ $event->{'content'.$i} }}</strong></p>-->
                                    <!--                            </div>-->
                                    <!--                            @php $activeSet = true; @endphp-->
                                    <!--                        @endif-->
                                    <!--                    @endfor-->
                                    <!--                </div>-->


                                    <!--            </div>-->
                                    <!--        @else-->
                                    <!--            <p>No images found</p>-->
                                    <!--        @endif-->
                                    <!--    </td>-->

                                    <td class="text-center">
                                        <button type="button" class="psg-p-btn ml-0 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $event->id }}">
                                            Edit
                                        </button>
                                        <form id="deleteForm{{ $event->id }}"
                                            action="{{ route('newsevents.destroy', $event->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger"
                                                onclick="confirmDelete({{ $event->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $event->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $event->id }}">Edit Event
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bar-flex-wrap">
                                                <form action="{{ route('newsevents.update', $event->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3 w-100">
                                                        <label for="image" class="form-label">Thumbnail<span
                                                                style="color:red;">*</span></label>
                                                        <input class="form-control" type="file" id="image"  accept="image/webp"  name="image"
                                                            aria-label="Image"
                                                            onchange="displayImage(event, 'editPreviewImage{{ $event->id }}')">
                                                        <img id="editPreviewImage{{ $event->id }}"
                                                            src="{{ asset('images/' . $event->image) }}"
                                                            alt="Uploaded Image"
                                                            style="max-width: 100px; display: block;">
                                                            
                                                    </div>

                                                    <div class="mb-3 w-100">
                                                        <label for="title" class="form-label">Title<span
                                                                style="color:red;">*</span></label>
                                                        <input class="form-control" type="text" id="title" name="title"
                                                            value="{{ $event->title }}" placeholder="Title"
                                                            aria-label="Title" required>
                                                    </div>

                                                    <div class="mb-3 w-100">
                                                        <label for="description" class="form-label">Description<span
                                                                style="color:red;">*</span></label>
                                                        <textarea class="form-control" id="description"
                                                            name="description" placeholder="Description"
                                                            aria-label="Description" style="width: 100%; height: 150px;"
                                                            required>{{ $event->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3 d-flex flex-row w-100">
                                                       <div class="mb-3 w-50-p"> <label for="event_date" class="form-label">Date <span
                                                                style="color:red;">*</span></label>
                                                                
        

                                                        <input type="date" class="form-control" id="event_date"
                                                            name="event_date" value="{{ old('event_date', $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '') }}"> </div>
                                                            
                                                            
                                                             <div class="mb-3 w-50-p">
                                                <label for="sort_id" class="form-label">Order ID</label>
                                                <input class="form-control" type="number" id="sort_id" name="sort_id"
                                                    value="{{ $event->sort_id }}" placeholder="Order ID"
                                                    aria-label="Sort ID">
                                            </div>
                                                    </div>


                                                    <div class="w-100 accordion accordion-flush" id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingOne">
                                                                <button class="accordion-button w-100p collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseOne"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseOne">
                                                                   Add Images
                                                            </h2>
                                                            <div id="flush-collapseOne"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-headingOne"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="d-flex flex-row flex-wrap">
                                                                        @for ($i = 1; $i <= 8; $i++) <div
                                                                            class="w-50-p box-style">
                                                                            <div class="mb-3 w-100">
                                                                                <label for="image{{ $i }}"
                                                                                    class="form-label">Image{{ $i }}</label>
                                                                                <input class="form-control"   accept="image/webp" type="file"
                                                                                    id="image{{ $i }}"
                                                                                    name="image{{ $i }}"
                                                                                    aria-label="Image"
                                                                                    onchange="displayImage(event, 'editPreviewImage{{ $i }}{{ $event->id }}')">

                                                                                <img id="editPreviewImage{{ $i }}{{ $event->id }}"
                                                                                    src="{{ $event->{'image'.$i} ? asset('images/' . $event->{'image'.$i}) : '' }}"
                                                                                    alt="Uploaded Image"
                                                                                    style="max-width: 100px; display: {{ $event->{'image'.$i} ? 'block' : 'none' }};">
                                                                            </div>
                                                                            <div class="mb-3 w-100">
                                                                                <input class="form-control" type="text"
                                                                                    id="content{{ $i }}"
                                                                                    name="content{{ $i }}"
                                                                                    placeholder="Description"
                                                                                    aria-label="Description"
                                                                                    value="{{ $event->{'content'.$i} }}">
                                                                            </div>
                                                                    </div>
                                                                    @endfor
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>


                                           

                                            <button type="submit mt-5" class="psg-p-btn"><span class="bi--save-fill"></span> Save</button>
                                            </form>
                                        </div>
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
    
    
       
    
    
  <div class="row">
            <div class="col-md-12">
              
                <button id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()">Add New Chronicles</button>

                           <div class="page-box mt-5" id="videoContent" style="display: none;"> 
      <div class="page-box mt-0">
                    <div class="card-body">

                        <!-- Form Section -->
                        <!--<form action="{{ route('newseventsheading.store') }}" method="POST"-->
                        <!--    enctype="multipart/form-data">-->
                        <!--    @csrf-->
                        <!--    <div class="mb-3 w-100">-->
                        <!--        <label for="heading_input" class="form-label">Heading<span-->
                        <!--                style="color:red;">*</span></label>-->
                        <!--        <input class="form-control" type="text" id="heading_input" name="heading"-->
                        <!--            placeholder="Title" aria-label="heading">-->
                        <!--             <button type="submit" class="psg-p-btn" ><span class="bi--save-fill"></span>Save</button>-->
                        <!--    </div>-->
                           
                        <!--</form>-->

                        <div class="mt-20">
                            <h4 class="mb-0 text-uppercase">Heading List</h4>
                          
                            <div class="col-md-12 p-0">
                                <div class="">
                                    <div class="mb-30">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Heading</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($NewsEvents as $key => $NewsEvent)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $NewsEvent->heading }}</td>
                                                        <td class="text-center">
                                                            <button type="button"
                                                                class="psg-p-btn ml-0 edit-btn"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-id="{{ $NewsEvent->id }}"
                                                                data-heading="{{ $NewsEvent->heading }}"
                                                                data-action="{{ route('newseventsheading.update', ['id' => $NewsEvent->id]) }}">
                                                                Edit
                                                            </button>

                                                            <!--<form id="deleteFormHeading{{ $NewsEvent->id }}"-->
                                                            <!--    action="{{ route('newseventsheading.destroy', $NewsEvent->id) }}"-->
                                                            <!--    method="POST" style="display: inline;">-->
                                                            <!--    @csrf-->
                                                            <!--    @method('DELETE')-->
                                                            <!--    <button type="button" class="psg-p-btn btn-danger"-->
                                                            <!--        onclick="confirmDeleteHeading('{{ $NewsEvent->id }}')">-->
                                                            <!--        Delete-->
                                                            <!--    </button>-->
                                                            <!--</form>-->

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
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit TopBar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="editForm" class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit_heading" class="form-label">Heading<span
                                                        style="color:red;">*</span></label>
                                                <input class="form-control" type="text" id="edit_heading" name="heading"
                                                    placeholder="heading" aria-label="heading" required>
                                            </div>
                                            
                                            <div class="d-c-c justify-content-center">
                                                <button type="submit" class="psg-p-btn w-auto text-center"
                                                >Update</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <form action="{{ route('newsevents.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Thumbnail -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Thumbnail<span style="color:red;">*</span></label>
                                <input class="form-control" type="file" id="image" name="image" aria-label="Image"
                                    onchange="displayImage(event, 'previewImage')" required>
                                <img id="previewImage" src="#" alt="Uploaded Image"
                                    style="max-width: 100px; display: none;">
                                    <small class="text-muted">Only allow WebP images (Max: 5MB)</small>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" id="title" name="title" placeholder="Title"
                                    aria-label="Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description<span
                                        style="color:red;">*</span></label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Description" aria-label="Description"
                                    style="width: 100%; height: 150px;" required></textarea>
                            </div>



                             <div class="mb-3 d-flex flex-row w-100">
                                                      <div class="mb-3 w-50-p">
                                <label class="form-label">Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" id="event_date" name="event_date" required>
                            </div>
                                                            
                                                            
                                                            
                    <div class="mb-3 w-50-p">
                        <label for="sort_id" class="form-label">Order ID</label>
                        <input class="form-control" type="number" id="sort_id" name="sort_id" placeholder="Order ID"
                            aria-label="Sort ID">
                    </div>
                                                    </div>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Add Images
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="d-flex flex-row flex-wrap">
                                                @for ($i = 1; $i <= 8; $i++) <div class="w-50-p box-style">
                                                    <div class="mb-3 w-100">
                                                        <label for="image{{ $i }}" class="form-label">Image{{ $i }} </label>
                                                    <input class="form-control"  accept="image/webp"   type="file" id="image{{ $i }}"
                                                        name="image{{ $i }}" aria-label="Image"
                                                        onchange="displayImage(event, 'previewImage{{ $i }}')">
                                                    <img id="previewImage{{ $i }}" src="#" alt="Uploaded Image"
                                                        style="max-width: 100px; display: none;">
                                                    <input class="form-control mt-4" type="text" id="content{{ $i }}"
                                                        name="content{{ $i }}" placeholder="Description"
                                                        aria-label="Description">
                                                    </div>
                                                    
                                                    
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                     <div class="d-c-c justify-content-center mt-5">  <button type="submit" class="psg-p-btn" ><span class="bi--save-fill"></span>Save</button></div>
                  
                    </form>
                </div>
            </div>
                           </div> 
              
          
        </div>
    </div>

       
</div>
</div>
</div>

@endsection

@section("script")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>


<script>

    $(document).ready(function () {
        $("#CHRONICLEShome").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
        });
    });
</script>


<script>

function displayImage(event, previewId) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById(previewId);
        if (preview) {
            preview.src = reader.result;
            preview.style.display = 'block';
        }
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<script>

function confirmDeleteHeading(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteFormHeading' + id).submit();
        }
    });
}
</script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + id).submit();
        }
    });
}
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
                button.textContent = "Add New Chronicles";
            }
        }
    
    
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach((button) => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const heading = this.getAttribute("data-heading");
            const actionUrl = this.getAttribute("data-action");

            // Update the form input and action
            document.getElementById("edit_heading").value = heading;
            document.getElementById("editForm").action = actionUrl;
        });
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