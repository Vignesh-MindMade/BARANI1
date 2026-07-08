@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<link href="{{ asset('assets/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



@endsection

<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }
</style>
    <style>
           .search-input {
            margin-bottom: 10px;
            padding: 9px;
            width: 17%;
            float: right;
            border-radius: 11px;
        }
    </style>

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h2 class="mb-30 text-uppercase">{{ $menu->name }}</h2>

@if($submenus->isEmpty())
            <p>No submenus available.</p>
@else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($submenus as $index => $submenu)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" 
               id="tab-{{ $index }}" 
               data-bs-toggle="tab" 
               href="#submenu-{{ $index }}" 
               role="tab" 
               aria-controls="submenu-{{ $index }}" 
               aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                {{ $submenu->submenu }}
            </a>
        </li>
    @endforeach
</ul>

            <br>
        @endif
        <div class="tab-content" id="myTabContent">
    @foreach($submenus as $index => $submenu)
        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" 
             id="submenu-{{ $index }}" 
             role="tabpanel" 
             aria-labelledby="tab-{{ $index }}" >
            
                   @if($submenu->submenu == 'PSGIAP')
                    <div class="">               
        <div class="page-box">

            <!-- About-US Content Form -->
            <form id="psg-iaq-form" class="mb-30" action="{{ route('pages.PsgIaq') }}" method="POST">
                @csrf
                @forelse($psgiaq as $iaq)
                    <div class="mb-3">
                        <label for="content" class="form-label">About-US Content</label>
                        <textarea class="form-control" id="content" name="content" aria-label="Description" style="width: 100%; height: 150px;">{{ old('content', $iaq->content ?? '') }}</textarea>
                    </div>
                @empty
                    <div class="mb-3">
                        <label for="content" class="form-label">About-US Content</label>
                        <textarea class="form-control" id="content" name="content" aria-label="Description" style="width: 100%; height: 150px;"></textarea>
                    </div>
                @endforelse
                <button type="submit" id="psg-iaq" class="psg-p-btn ml-0">Submit</button>
            </form>
        </div>


    
        
              <button id="PSGIAPButton" class="psg-p-btn mt-3" onclick="PSGIAP()">Add New Sections</button>

              <div class="page-box mt-5" id="PSGIAPContent" style="display: none;"> 
                           <div class="page-box mt-0">
        <form action="{{ route('sections.store') }}" method="POST">
            @csrf
 
                    <div class="mb-3">
                        <label for="name mb-20">Name</label>
                        <div class="mb-30 d-c-c">
                        <input type="text" class="form-control mb-0 mt-0" id="name" name="name">
                        <button type="submit" class="psg-p-btn"><span class="bi--save-fill"></span>Submit</button></div>
                    </div>
               
          
        </form>
        </div>
              </div>
        
             <script>
             
                 // Toggle add new section For PSGIAP: 

                    function PSGIAP() {
                        let content = document.getElementById("PSGIAPContent");
                        let button = document.getElementById("PSGIAPButton");
            
                        if (content.style.display === "none" || content.style.display === "") {
                            content.style.display = "block";
                            button.textContent = "Close Sections";
                        } else {
                            content.style.display = "none";
                            button.textContent = "Add New Sections ";
                        }
                    }
                    
             </script>
           
        <h4 class="mb-30 mt-5">Update/Delete</h4>

      <div class="page-box mt-0">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Section</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections ?? '' as $key => $section)
                    <tr id="row-{{ $section->id }}">
                        <td>{{ $key+1 }}</td>
                        <td id="name-{{ $section->id }}">{{ $section->name }}</td>
                        <td class="text-center">
                            <button type="button" class="psg-p-btn ml-0" data-bs-toggle="modal" data-bs-target="#sympModal-{{ $section->id }}">Edit</button>
                            <!-- Edit Modal -->
                            
                        </td>
                        <td class="text-center">
                            <form id="sectiondelete" action="{{ route('sections.delete', $section->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="psg-p-btn btn-danger ml-0" onclick="SectionDelete('{{ $section->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="sympModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title">Update Section</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}">
                                                </div>
                                                <div class="d-c-c justify-content-center">
                                                    <button type="submit" class="psg-p-btn">Update</button>
                                                    <button type="button" class="psg-p-btn btn-danger btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </tbody>
        </table>
        
  <button type="button" class="psg-p-btn ml-0 mb-30 mt-5" id="edit-section-btn" data-bs-toggle="modal" data-bs-target="#editSectionModal">
            Edit or Add Contents
        </button>
    </div>





       

        <!-- Delete Section Script -->
        <script>
            function SectionDelete(sectionId) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('sectiondelete').action = "{{ route('sections.delete', ':id') }}".replace(':id', sectionId);
                        document.getElementById('sectiondelete').submit();
                    }
                });
            }
        </script>


       

        <h4 class="mb-30 mt-5">Add Content</h4>
        <div class="page-box mt-0">
        <form action="{{ route('iaqcontent.store') }}" method="POST">
            @csrf
        
                    <div class="mb-3">
                        <label for="section_id">Select Section</label>
                        <select class="form-control" name="section_id">
                            <option value="">Select Menu</option>
                            @foreach($sections ?? '' as $key => $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="description">Descriptions</label>
                         <button type="button" class="psg-p-btn ml-0 mt-20 mb-20" id="add-description">Add Description</button>
                        <div id="description-repeater">
                            <div class="mb-30 mt-10 d-c-c">
                                <input type="text" name="text[]" class="form-control mt-0 mb-0" placeholder="Enter description">
                                <button type="button" class="psg-p-btn btn-danger remove-description">Remove</button>
                            </div>
                        </div>
                       
                    </div>
               
            <button type="submit" class="psg-p-btn green-bg ml-0"><span class="bi--save-fill"></span>Submit</button>
        </form>
        </div>
        <!-- Description Add/Remove Scripts -->
        <script>
            document.getElementById('add-description').addEventListener('click', function () {
                var repeater = document.getElementById('description-repeater');
                var newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group mb-2';
                newInputGroup.innerHTML = `
                    <div class="mb-30 d-c-c w-100">
                                <input type="text" name="text[]" class="form-control mt-0 mb-0" placeholder="Enter description">
                                <button type="button" class="psg-p-btn btn-danger remove-description">Remove</button>
                            </div>
                `;
                repeater.appendChild(newInputGroup);
            });
        
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-description')) {
                    e.target.closest('.input-group').remove();
                }
            });
        </script>

      

        <!-- Edit Section Modal -->
        <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('iaqcontent.update', ['id' => 0]) }}" method="POST" id="editSectionForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section_id" id="edit_section_id">
                            <div class="mb-3">
                                <label for="edit_section_select">Select Section</label>
                                <select class="form-control" name="section_id" id="edit_section_select">
                                    <option value="">Select Section</option>
                                    @foreach($sections ?? '' as $key => $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <span style="color:red;"><p>Note: Select a Section To Edit Content</p></span>
                            </div>
        
                            <div class="mb-3">
                                <label for="edit_description">Descriptions</label>
                                <div id="edit_description_repeater"></div>
                                <button type="button" class="btn btn-success" id="add-edit-description">Add Description</button>
                            </div>
        
                            <div class="modal-footer">
                                <button type="submit" class="psg-p-btn">Save Changes</button>
                                <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- JavaScript to Update Section in Modal -->
        <script>
            document.getElementById('edit_section_select').addEventListener('change', function () {
                const sectionId = this.value;
                const descriptionRepeater = document.getElementById('edit_description_repeater');
                descriptionRepeater.innerHTML = ''; // Clear previous descriptions
        
                if (sectionId) {
                    fetch('{{ route('psgiaq.getdescriptions') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ section_id: sectionId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(desc => {
                            let inputGroup = document.createElement('div');
                            inputGroup.className = 'input-group mb-2';
                            inputGroup.innerHTML = `
                                <input type="text" name="text[]" class="form-control" value="${desc}" placeholder="Enter description">
                                <button type="button" class="btn btn-danger remove-description">Remove</button>
                            `;
                            descriptionRepeater.appendChild(inputGroup);
                        });
                        // Update the form action URL to the correct ID
                        document.getElementById('editSectionForm').action = '{{ route("iaqcontent.update", ":id") }}'.replace(':id', sectionId);
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        
            document.getElementById('add-edit-description').addEventListener('click', function () {
                var repeater = document.getElementById('edit_description_repeater');
                var newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group mb-2';
                newInputGroup.innerHTML = `
                    <input type="text" name="text[]" class="form-control" placeholder="Enter description">
                    <button type="button" class="btn btn-danger remove-description">Remove</button>
                `;
                repeater.appendChild(newInputGroup);
            });
        
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-description')) {
                    e.target.closest('.input-group').remove();
                }
            });
        </script>

    </div>




                        
                    @elseif($submenu->submenu == 'PSG & Sons’ Charities')
                    
                     <div class="page-box">
                   <div class=" "> 
                        <form action="{{ route('pages.sons') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach($sons as $son)
                            <div class="mb-3">
                                <label for="link">Add Link</label>
                                <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $son->link) }}" required><button type="submit" class="psg-p-btn"><span class="bi--save-fill"></span>Submit</button>
                            </div>
                            
                            @endforeach
                        </form>
                    </div>
                </div>
                    
                    @elseif($submenu->submenu == 'Administration')
                    
                    <div class="page-box">
                        <div class=" ">
                            <h5 class="card-title">Administration</h5>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Governing Council
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                <form action="{{ route('pages.councilmembers') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="input-fw-100 d-flex">
                                     
                                        <div class="col">
                                          <label for="member_name">Name</label>
                                          <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                          <label for="designation">Designation</label>
                                          <input type="text" class="form-control" id="designation" name="designation" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                          <label for="Committee">Committee</label>
                                          <input type="text" class="form-control" id="Committee" name="Committee" placeholder="Add Committee">
                                        </div>
                                        <div class="col">
                                          <label for="SortId">Order Id</label>
                                          <input type="text" class="form-control" id="SortId" name="SortId" placeholder="Add OrderId">
                                        </div>
                                      
                                    </div>
                                    <br>
                                    <div class="d-c-c justify-content-center"><button type="submit" class="psg-p-btn ml-0 pl-15"><span class="bi--save-fill"></span>Submit</button></div>
                                
                               </form>
                          
                           <h4>Update/Delete</h4>
                           
                           <table id="Administrationhome"  class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Member Name</th>
                                            <th>Designation</th>
                                            <th>Committee</th>
                                            <th class="text-center">Update</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($councilmembers ?? '' as $key => $council)
                                        <tr id="row-{{ $council->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td id="name-{{ $council->id }}">{{ $council->member_name }}</td>
                                            <td id="designation-{{ $council->id }}">{{ $council->designation }}</td>
                                            <td id="committee-{{ $council->id }}">{{ $council->Committee }}</td>
                                            <td>
                                            <button type="button" class="psg-p-btn  ml-0" data-bs-toggle="modal" data-bs-target="#editcouncilModal-{{ $council->id }}">Edit</button>
                                            <div class="modal fade" id="editcouncilModal-{{ $council->id }}" tabindex="-1" aria-labelledby="editcouncilModalLabel-{{ $council->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editcouncilModalLabel-{{ $council->id }}">Edit Governing Council</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body input-fw-100">
                                                            <form id="editOrganizationForm-{{ $council->id }}" method="POST" action="{{ route('councilmembers.update', $council->id) }}">
                                                                @csrf
                                                                <input type="hidden" id="organization_id-{{ $council->id }}" name="organization_id" value="{{ $council->id }}">
                                                                <div class="mb-3">
                                                                    <label for="member_name-{{ $council->id }}" class="form-label">Member</label>
                                                                    <input type="text" class="form-control" id="member_name-{{ $council->id }}" name="member_name" value="{{ $council->member_name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="designation-{{ $council->id }}" class="form-label">Designation</label>
                                                                    <input type="text" class="form-control" id="designation-{{ $council->id }}" name="designation" value="{{ $council->designation }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="Committee-{{ $council->id }}" class="form-label">Committee</label>
                                                                    <input type="text" class="form-control" id="Committee-{{ $council->id }}" name="Committee" value="{{ $council->Committee }}" required>
                                                                </div>
                                                                 <div class="mb-3">
                                                                      <label for="SortId-{{ $council->id }}">Order Id</label>
                                                                      <input type="text" class="form-control" id="SortId-{{ $council->id }}" name="SortId" value="{{ $council->SortId }}"  placeholder="Add OrderId">
                                                                    </div>
                                                                <button type="submit" class="psg-p-btn ml-0 green-bg"><span class="bi--save-fill"></span>Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </td>

     <!-- Delete Form -->

                                            
                                            <td>
                                                 <form id="deleteFormCouncilMembers" action="{{ route('councilmembers.destroy', $council->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="psg-p-btn btn-danger ml-0" onclick="CouncilMembersDelete('{{ $council->id }}')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                           
								<script>
                                        function CouncilMembersDelete(councilId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deleteFormCouncilMembers').action = "{{ route('councilmembers.destroy', ':id') }}".replace(':id', councilId);
                                                    document.getElementById('deleteFormCouncilMembers').submit();
                                                }
                                            });
                                        }
                                    </script>
                           
                                                                        </div>
                                       </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Secretary Info
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <!--Button Modal-->
                                            <div class="mb-3">
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#secretaryInfoModal">Secretary Info</button>
                                            </div>
                                            <!--Contnet-->
                                            <div class="modal fade bd-example-modal-lg" id="secretaryInfoModal" tabindex="-1" aria-labelledby="secretaryInfoModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="secretaryInfoModalLabel">Secretary Info</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('pages.governingcouncil') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @foreach($councils as  $council)
                                                            <div class="mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $council->name) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="position">Position</label>
                                                                <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $council->position) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="mobile">Contact Info</label>
                                                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $council->mobile) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $council->email) }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message">Message</label>
                                                                <textarea class="form-control" id="message" name="message" aria-label="Message" style="width: 100%; height: 150px;">{{ old('message', $council->message) }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                            <label for="image">Image</label>
                                                            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage1(event)">
                                                            @if ($council->image)
                                                                <img id="imagePreview1" src="{{ asset('images/' . $council->image) }}" alt="Trustee Image"  class="people-image-be">
                                                            @else
                                                                <img id="imagePreview1" src="#" alt="Trustee Image"  class="people-image-be">
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                        <button type="submit" class="psg-p-btn">Submit</button>
                                                    </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                         <script>
                                                                function previewImage1(event) {
                                                                    const reader = new FileReader();
                                                                    const imageField = document.getElementById('imagePreview1');
                                                            
                                                                    reader.onload = function() {
                                                                        if (reader.readyState === 2) {
                                                                            imageField.src = reader.result;
                                                                            imageField.style.display = 'block';
                                                                        }
                                                                    };
                                                            
                                                                    reader.readAsDataURL(event.target.files[0]);
                                                                }
                                                            </script>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Organization Schedule
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                         <form action="{{ route('pages.organization') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="input-fw-100 d-flex">
                                    
                                        <div class="col">
                                          <label for="org_member">Name</label>
                                          <input type="text" class="form-control" id="org_member" name="org_member" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                          <label for="member_designation">Designation</label>
                                          <input type="text" class="form-control" id="member_designation" name="member_designation" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                          <label for="member_committee">Committee</label>
                                          <input type="text" class="form-control" id="member_committee" name="member_committee" placeholder="Add Committee">
                                        </div>
                                   
                                    </div>
                                  <div class="d-c-c justify-content-center"><button type="submit" class="psg-p-btn ml-0 pl-15"><span class="bi--save-fill"></span>Submit</button></div>
                            </form>

                           <h4>Update/Delete</h4>
                           
                          <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Member Name</th>
                                        <th>Designation</th>
                                        <th>Committee</th>
                                        <th class="text-center">Update</th>
                                        <th  class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations ?? '' as $key => $organization)
                                    <tr id="row-{{ $organization->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="org_member-{{ $organization->id }}">{{ $organization->org_member }}</td>
                                        <td id="member_designation-{{ $organization->id }}">{{ $organization->member_designation }}</td>
                                        <td id="member_committee-{{ $organization->id }}">{{ $organization->member_committee }}</td>
                                        <td  class="text-center">
                                            <button type="button" class="psg-p-btn ml-0 " data-bs-toggle="modal" data-bs-target="#editOrganizationModal-{{ $organization->id }}">Edit</button>
                                        
                                            
                                        </td>

                                        <td>
                                            <form id="deleteForm3" action="{{ route('organizationschedue.destroy', $organization->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger ml-0" onclick="confirmDelete3('{{ $organization->id }}')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editOrganizationModal-{{ $organization->id }}" tabindex="-1" aria-labelledby="editOrganizationModalLabel-{{ $organization->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editOrganizationModalLabel-{{ $organization->id }}">Edit Organization</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body input-fw-100">
                                                            <form id="editOrganizationForm-{{ $organization->id }}" method="POST" action="{{ route('organizationscheduleupdate.update', $organization->id) }}">
                                                                @csrf
                                                                <input type="hidden" id="organization_id-{{ $organization->id }}" name="organization_id" value="{{ $organization->id }}">
                                                                <div class="mb-3">
                                                                    <label for="org_member-{{ $organization->id }}" class="form-label">Member</label>
                                                                    <input type="text" class="form-control" id="org_member-{{ $organization->id }}" name="org_member" value="{{ $organization->org_member }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="member_designation-{{ $organization->id }}" class="form-label">Designation</label>
                                                                    <input type="text" class="form-control" id="member_designation-{{ $organization->id }}" name="member_designation" value="{{ $organization->member_designation }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="member_committee-{{ $organization->id }}" class="form-label">Committee</label>
                                                                    <input type="text" class="form-control" id="member_committee-{{ $organization->id }}" name="member_committee" value="{{ $organization->member_committee }}" required>
                                                                </div>
                                                                <button type="submit" class="psg-p-btn green-bg ml-0"><span class="bi--save-fill"></span>Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                               </tbody>
                            </table>
                            

                            <script>
                                        function confirmDelete3(organizationId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deleteForm3').action = "{{ route('organizationschedue.destroy', ':id') }}".replace(':id', organizationId);
                                                    document.getElementById('deleteForm3').submit();
                                                }
                                            });
                                        }
                                    </script>

                                          </div>
                                    </div>
                                </div>
                                
                                
                              <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTrust">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTrust" aria-expanded="false" aria-controls="flush-collapseTrust">
            The Trust
        </button>
    </h2>
    <div id="flush-collapseTrust" class="accordion-collapse collapse" aria-labelledby="flush-headingTrust" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <div class="page-box">
                <div class=" ">
                    <form action="{{ route('pages.trust') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach($trustee as $trust)
                            <div class="mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $trust->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="position">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $trust->position) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile">Contact Info <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $trust->mobile) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $trust->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="message">Trustee Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" aria-label="Message" style="width: 100%; height: 150px;" required>{{ old('message', $trust->message) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image">Trustee Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file d-block" id="image" name="image" onchange="previewImage(event)" required>
                                @if ($trust->image)
                                    <img id="imagePreview" src="{{ asset('images/' . $trust->image) }}" alt="Trustee Image"  class="people-image-be">
                                @else
                                    <img id="imagePreview" src="#" alt="Trustee Image"  class="people-image-be">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="quote">Quote</label>
                                <input type="text" class="form-control" id="quote" name="quote" value="{{ old('quote', $trust->quote) }}">
                            </div>
                            <div class="mb-3">
                                <label for="author">Author Name</label>
                                <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $trust->author) }}">
                            </div>
                        @endforeach
                        <button type="submit" class="psg-p-btn ml-0">Submit</button>
                    </form>
                    <script>
                        function previewImage(event) {
                            const reader = new FileReader();
                            const imageField = document.getElementById('imagePreview');

                            reader.onload = function() {
                                if (reader.readyState === 2) {
                                    imageField.src = reader.result;
                                    imageField.style.display = 'block';
                                }
                            };

                            reader.readAsDataURL(event.target.files[0]);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

                                
                                
                                
                            </div>
                        </div>
                    </div>
                    
                    <script>
                    
                        $(document).ready(function () {
                            $("#Administrationhome").DataTable({
                                paging: true,
                                lengthMenu: [5, 10, 25, 50],
                                ordering: true,
                                info: true,
                                autoWidth: false,
                                searching: true,
                            });
                        });
                    </script>


                    
            @elseif($submenu->submenu == 'Statutory Committee')
                    
<div class="card">
    <div class="card-body">
       
        <h5>Add New Committee</h5>
        <form action="{{ route('pages.committeename') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="committee_name" class="form-label">Committee Name</label>
                <input type="text" class="form-control" id="committee_name" name="committee_name" required />
            </div>
            
             <div class="mb-3">
                <label for="pdf" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="image/jpeg,image/png,image/webp" required />
            </div>
            
            <div id="preview-container" style="display: none;">
                <p>Image Preview:</p>
                <img id="preview" src="" alt="Image Preview" style="max-width: 200px; max-height: 200px; margin-top: 10px;">
            </div>
        
        
            <div id="members-container">
                <div class="member-item mb-3">
                    <label for="member_name" class="form-label">Member Name</label>
                    <input type="text" class="form-control" name="member_name[]" required />
            
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" name="designation[]" required />
            
                    <label for="committee" class="form-label">Committee</label>
                    <input type="text" class="form-control" name="committee[]" required />
                    
                    <label for="committee" class="form-label">Email</label>
                    <input type="mail" class="form-control" name="email[]"  />

                    <label for="committee" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone[]"  />
                </div>
            </div>
            
            <button type="button" class="btn btn-success mb-3" id="add-member">Add More Members</button>
            
            <br />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <hr />
        <h5>Update/Delete Committees</h5>
        <table  id="Statutoryhome" class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Committee Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($committeenames as $key => $committee)
                <tr id="row-{{ $committee->id }}">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $committee->committee_name }}</td>
                    <td>
                        @if($committee->pdf)
                        <img src="{{ asset('images/' . $committee->pdf) }}" alt="Committee Image" class="img-thumbnail" style="max-width: 100px;" />
                        @else No Image Available @endif
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCommitteeModal-{{ $committee->id }}">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('committeename.destroy', $committee->id) }}" method="POST" class="d-inline" id="delete-form-{{ $committee->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $committee->id }})">
                                Delete
                            </button>
                        </form>

                        <!-- Edit Modal -->
                      <!-- Edit Modal -->
<div class="modal fade" id="editCommitteeModal-{{ $committee->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    <form method="POST" action="{{ route('committeename.update', $committee->id) }}" enctype="multipart/form-data" id="editCommitteeForm">
    @csrf @method('PUT')

    <!-- Modal Header -->
    <div class="modal-header">
        <h5 class="modal-title">Edit Committee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <!-- Modal Body -->
    <div class="modal-body">
        <!-- Committee Name -->
        <div class="mb-3">
            <label for="committee_name" class="form-label">Committee Name</label>
            <input type="text" class="form-control" name="committee_name" value="{{ $committee->committee_name }}" required />
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="pdf" class="form-label">Image</label>
            <input type="file" class="form-control" name="pdf" accept="image/*" />
            @if($committee->pdf)
                <img src="{{ asset('images/' . $committee->pdf) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 100px;" />
            @endif
        </div>

        <!-- Members Container -->
        <div id="edit-members-container-{{ $committee->id }}">
            @if($committee->members && $committee->members->count() > 0)
                @foreach($committee->members as $index => $member)
                    <div class="mb-3 member-item" id="member-item-{{ $member->id }}">
                        <input type="hidden" name="member_ids[]" value="{{ $member->id }}" />
                        <label for="member_name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" name="member_name[]" value="{{ $member->member_name }}" required />

                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation[]" value="{{ $member->designation }}" required />

                        <label for="committee" class="form-label">Committee</label>
                        <input type="text" class="form-control" name="committee[]" value="{{ $member->committee }}" required />

                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email[]" value="{{ $member->email }}" />

                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone[]" value="{{ $member->phone }}" />

                        <button type="button" class="btn btn-danger mt-2" onclick="removeMemberItem({{ $member->id }})">Remove</button>
                    </div>
                @endforeach
            @else
                <p>No members found for this committee.</p>
            @endif
        </div>

        <!-- Add More Button -->
        <button type="button" class="btn btn-success" onclick="addEditMember({{ $committee->id }})">Add More</button>
    </div>

    <!-- Modal Footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
        </div>
    </div>
</div>

<script>
function removeMemberItem(memberId) {
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
            // Remove the member item from the DOM
            const memberElement = document.getElementById(`member-item-${memberId}`);
            if (memberElement) {
                memberElement.remove();
            }

            // Add the member ID to a hidden input for deletion
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleted_members[]';
            input.value = memberId;
            document.getElementById('editCommitteeForm').appendChild(input);

            Swal.fire(
                'Deleted!',
                'The member has been marked for deletion.',
                'success'
            );
        }
    });
}
</script>


                        <script>
                            document.getElementById('add-member').addEventListener('click', function () {
                            
                                const membersContainer = document.getElementById('members-container');
                    
                                const newMemberItem = document.createElement('div');
                                newMemberItem.classList.add('member-item', 'mb-3');
                    
                                newMemberItem.innerHTML = `
                                    <label for="member_name" class="form-label">Member Name</label>
                                    <input type="text" class="form-control" name="member_name[]"  />
                        
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" name="designation[]"  />
                        
                                    <label for="committee" class="form-label">Committee</label>
                                    <input type="text" class="form-control" name="committee[]"  />
                        
                                    <label for="committee" class="form-label">Email</label>
                                    <input type="mail" class="form-control" name="email[]"  />
                        
                                    <label for="committee" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone[]"  />
                        

                                    <button type="button" class="btn btn-danger mt-2 remove-member">Remove</button>
                                `;
                        
                                membersContainer.appendChild(newMemberItem);

                                newMemberItem.querySelector('.remove-member').addEventListener('click', function () {
                                    newMemberItem.remove();
                                });
                            });
                        </script>
                        
                        
                        <script>
                       

                        
                            function addEditMember(committeeId) {
                                const container = document.getElementById('edit-members-container-' + committeeId);
                                const newMemberId = Date.now(); // Unique identifier for new member fields
                                const newMemberItem = document.createElement('div');
                                newMemberItem.classList.add('mb-3', 'member-item');
                                newMemberItem.setAttribute('id', 'member-item-new-' + newMemberId);
                        
                                newMemberItem.innerHTML = `
                                    <label for="member_name_${newMemberId}" class="form-label">Member Name</label>
                                    <input type="text" class="form-control" name="member_name[]" id="member_name_${newMemberId}" required>
                        
                                    <label for="designation_${newMemberId}" class="form-label">Designation</label>
                                    <input type="text" class="form-control" name="designation[]" id="designation_${newMemberId}" required>
                        
                                    <label for="committee_${newMemberId}" class="form-label">Committee</label>
                                    <input type="text" class="form-control" name="committee[]" id="committee_${newMemberId}" required>
                        
                                    <label for="email_${newMemberId}" class="form-label">Email</label>
                                    <input type="mail" class="form-control" name="email[]" id="email_${newMemberId}" >
                        
                                    <label for="committee_${newMemberId}" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone[]" id="phone_${newMemberId}" >
                        

                                    <button type="button" class="btn btn-danger mt-2" onclick="removeNewMember('member-item-new-${newMemberId}')">Remove</button>
                                `;
                        
                                container.appendChild(newMemberItem);
                            }
                        
                            // Remove a newly added member item
                            function removeNewMember(memberItemId) {
                                const memberItem = document.getElementById(memberItemId);
                                if (memberItem) {
                                    memberItem.remove();
                                }
                            }
                        </script>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>

    $(document).ready(function () {
        $("#Statutoryhome").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
        });
    });
</script>

<!-- JavaScript -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            // text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(`form[action*="${id}"]`).submit();
            }
        });
    }
</script>

                    @elseif($submenu->submenu == 'Facts & Figures')
                     
                      <div class="page-box">
        <div class=" ">
            <form action="{{ route('pages.factsandfigures') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($factsandfigures as $index => $facts)
                <div class="form-group">
                    <label for="image_{{ $index }}">Image</label>
                    <input type="file" class="form-control-file" id="image_{{ $index }}" name="image" onchange="previewImage(event, {{ $index }})">
                    @if ($facts->image)
                        <img id="imagePreview_{{ $index }}" src="{{ asset('images/' . $facts->image) }}" alt="Image"  class="people-image-be">
                    @else
                        <img id="imagePreview_{{ $index }}" src="#" alt="Image"  class="people-image-be">
                    @endif
                </div>
            @endforeach
            <button type="submit" class="psg-p-btn">Submit</button>
        </form>
        
        <script>
            function previewImage(event, index) {
                const reader = new FileReader();
                const imageField = document.getElementById('imagePreview_' + index);

                reader.onload = function() {
                    if (reader.readyState === 2) {
                        imageField.src = reader.result;
                        imageField.style.display = 'block';
                    }
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </div>
</div>
                    @elseif($submenu->submenu == 'The Trust')
                     <li style="display: none;"></li>

                    @elseif($submenu->submenu == 'Principal')
                    
                  <div class="page-box">
    <div class=" ">
        <form action="{{ route('pages.princiaplmessage') }}" method="POST" enctype="multipart/form-data">
            @csrf @foreach($messages as $message)
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $message->name) }}" />
            </div>
            <div class="mb-3">
                <label for="number">Contact Info</label>
                <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $message->number) }}" />
            </div>
            <div class="mb-3">
                <label for="mail">Email</label>
                <input type="text" class="form-control" id="mail" name="mail" value="{{ old('mail', $message->mail) }}" />
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" style="width: 100%; height: 150px;">{{ old('description', $message->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file">Principal Image</label>
                <input type="file" class="form-control-file" id="file" name="file" onchange="previewfile(event)" />
                @if ($message->file)
                <img id="filePreview" src="{{ asset('images/' . $message->file) }}" alt="Trustee Image"  class="people-image-be" />
                @else
                <img id="filePreview" src="#" alt=""  class="people-image-be" />
                @endif
            </div>

            <div class="mb-3">
                <label for="quotes">Quote</label>
                <input type="text" class="form-control" id="quotes" name="quotes" value="{{ old('quotes', $message->quotes) }}" />
            </div>
            <div class="mb-3">
                <label for="author">Author Name</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $message->author) }}" />
            </div>
           

            <!-- Accordion -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                            style="    font-size: 21px;
    font-weight: bolder;
    font-family: fangsong;
}"
                        >
                           Edit Home Page Team Section
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="team_iap_title">Team IAP Title</label>
                                <input type="text" class="form-control" id="team_iap_title" name="team_iap_title" value="{{ old('team_iap_title', $message->team_iap_title) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="team_iap_name">Team IAP Name</label>
                                <input type="text" class="form-control" id="team_iap_name" name="team_iap_name" value="{{ old('team_iap_name', $message->team_iap_name) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="team_iap_description">Team IAP Description</label>
                                <input type="text" class="form-control" id="team_iap_description" name="team_iap_description" value="{{ old('team_iap_description', $message->team_iap_description) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="team_iap_file">Team IAP Image</label>
                                <input type="file" class="form-control-file" id="team_iap_file" name="team_iap_file" onchange="previewfile2(event)" />
                                @if ($message->team_iap_file)
                                <img id="filePreviewIAP" src="{{ asset('images/' . $message->team_iap_file) }}" alt="Team IAP Image"  class="people-image-be" />
                                @else
                                <img id="filePreviewIAP" src="#" alt=""  class="people-image-be" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
           
            <button type="submit" class="psg-p-btn ml-0">Submit</button>
        </form>

        <script>
            function previewfile(event) {
                const filereader = new FileReader();
                const fileField = document.getElementById("filePreview");
                filereader.onload = function () {
                    if (filereader.readyState === 2) {
                        fileField.src = filereader.result;
                        fileField.style.display = "block";
                    }
                };
                filereader.readAsDataURL(event.target.files[0]);
            }

            function previewfile2(event) {
                const filereader = new FileReader();
                const fileField = document.getElementById("filePreviewIAP");
                filereader.onload = function () {
                    if (filereader.readyState === 2) {
                        fileField.src = filereader.result;
                        fileField.style.display = "block";
                    }
                };
                filereader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </div>
</div>


                    @elseif($submenu->submenu == 'Core Faculty')
                    
                    
                    <h4 class="mt-5 mb-20">Update/Delete</h4>
                    <div class="page-box mt-0"> <div class="search-container">
    <input type="text" id="searchInput" onkeyup="searchTable()" class="search-input w-100" placeholder="Search">
    <span class="search-icon si--search-line"></span>
</div>


                           <table class="table mb-0" id="facultyTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faculties ?? '' as $key => $faculty)
                                    <tr id="row-{{ $faculty->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="staff_name-{{ $faculty->id }}">{{ $faculty->staff_name }}</td>
                                        <td id="designation-{{ $faculty->id }}">{{ $faculty->designation }}</td>
                                        <td id="staff_image-{{ $faculty->id }}">
                                            <img src="{{ asset('faculty/' . $faculty->staff_image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="psg-p-btn ml-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $faculty->id }}">Edit</button>
                                            <!-- Modal -->
                                           
                                        </td>
                                        <td  class="text-center">
                                         <form id="faculty" action="{{ route('corefaculty.delete', $faculty->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger ml-0" onclick="facultyDelete('{{ $faculty->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                     <div class="modal fade" id="editModal-{{ $faculty->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Core Faculty</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('corefaculty.update', $faculty->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="staff_name">Staff Name</label>
                                                                    <input type="text" class="form-control" id="staff_name" name="staff_name" value="{{ $faculty->staff_name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="designation">Designation</label>
                                                                    <input type="text" class="form-control" id="designation" name="designation" value="{{ $faculty->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="staff_image">Staff Image</label>
                                                                    <input type="file" class="form-control" id="staff_image" name="staff_image">
                                                                    @if($faculty->staff_image)
                                                                        <img src="{{ asset('faculty/' . $faculty->staff_image) }}" alt="{{ $faculty->staff_name }}" width="100">
                                                                    @endif
                                                                </div>
                                                                 <div class="form-group">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="description" name="description" aria-label="Description" style="width: 100%; height: 150px;">{{ $faculty->description }}</textarea>
                                                            </div>
                                    
                                                                
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                    
                      <h4 class="mt-5 mb-20">Add a Faculty</h4>
                      <div class="page-box mt-0">
                        <div class=" ">
                            <form action="{{ route('pages.corefaculty') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-3">
                                        <label for="staff_name">Name</label>
                                        <input type="text" class="form-control" id="staff_name" name="staff_name" placeholder="Enter Name">
                                    </div>
                                     <div class="mb-3">
                                    <label for="staff_image" class="form-label">Staff Image</label>
                                    <input class="form-control" type="file" id="staff_image" name="staff_image" placeholder="Image" aria-label="Image" onchange="displayImage(event)" required>
                                    <img id="previewImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                </div>
                                    <div class="mb-3">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation"  placeholder="Enter Designation">
                                    </div>
                                     <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" aria-label="Description" style="width: 100%; height: 150px;"></textarea>
                                </div>
                                    
                                <button type="submit" class="psg-p-btn ml-0">Submit</button>
                            </form>
                            
                           
                           
                           
                           

                            
                            
                            
                            <script>
                                function displayImage(event) {
                                    var image = document.getElementById('previewImage');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                    image.style.display = 'block';
                                }
                            </script>
                            <script>
                            function searchTable() {
                                // Get the value of the search input
                                var input = document.getElementById('searchInput');
                                var filter = input.value.toLowerCase();
                                
                                // Get the table and rows
                                var table = document.getElementById('facultyTable');
                                var rows = table.getElementsByTagName('tr');
                    
                                // Loop through the rows and hide those that don't match the search query
                                for (var i = 1; i < rows.length; i++) {
                                    var cells = rows[i].getElementsByTagName('td');
                                    var match = false;
                                    for (var j = 0; j < cells.length; j++) {
                                        if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                                            match = true;
                                            break;
                                        }
                                    }
                                    rows[i].style.display = match ? '' : 'none';
                                }
                            }
                        </script>
                        	<script>
                                        function facultyDelete(facultyId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('faculty').action = "{{ route('corefaculty.delete', ':id') }}".replace(':id', facultyId);
                                                    document.getElementById('faculty').submit();
                                                }
                                            });
                                        }
                                    </script>
                          
                    </div>
                </div>
                
                    @elseif($submenu->submenu == 'Visiting Faculty')
                    
                         
                        
                          <h4 class="mt-5 mb-20">Update / Delete</h4>

                       
                           
                           <div class="page-box mt-0"> <div class="search-container">
    <input type="text" id="searchfacultyInput" onkeyup="searchfacultyTable()" class="search-input w-100" placeholder="Search">
    <span class="search-icon si--search-line"></span>
</div>
                           
                           
                          

                           <table class="table mb-0" id="visitingfacultyTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($visitors ?? '' as $key => $visit)
                                    <tr id="row-{{ $visit->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="staff_name_1-{{ $visit->id }}">{{ $visit->name }}</td>
                                        <td id="designation_1-{{ $visit->id }}">{{ $visit->designation }}</td>
                                        <td id="staff_image_1-{{ $visit->id }}">
                                            <img src="{{ asset('faculty/' . $visit->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="psg-p-btn ml-0" data-bs-toggle="modal" data-bs-target="#editfacultyModal-{{ $visit->id }}">Edit</button>
                                            <!-- Modal -->

                                        </td>
                                        <td class="text-center">
                                         <form id="visitingfaculty" action="{{ route('visitingfaculty.delete', $visit->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger ml-0" onclick="visitingfacultyDelete('{{ $visit->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    
                                                                                <div class="modal fade" id="editfacultyModal-{{ $visit->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Core Faculty</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('visitingfaculty.update', $visit->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="staff_name">Staff Name</label>
                                                                    <input type="text" class="form-control" id="staff_name" name="staff_name_1" value="{{ $visit->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="designation">Designation</label>
                                                                    <input type="text" class="form-control" id="designation" name="designation_1" value="{{ $visit->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="staff_image">Staff Image</label>
                                                                    <input type="file" class="form-control" id="staff_image" name="staff_image_1">
                                                                    @if($visit->image)
                                                                        <img src="{{ asset('faculty/' . $visit->image) }}" alt="{{ $visit->name }}" width="100" class="d-block">
                                                                    @endif
                                                                </div>
                                                                <div class="d-c-c justify-content-start">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>

                            <script>
                                function visitingImage(event) {
                                    var image = document.getElementById('visiting_facultyImage');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                    image.style.display = 'block';
                                }
                            </script>
                            <script>
                            function searchfacultyTable() {
                                // Get the value of the search input
                                var input = document.getElementById('searchfacultyInput');
                                var filter = input.value.toLowerCase();
                                
                                // Get the table and rows
                                var table = document.getElementById('visitingfacultyTable');
                                var rows = table.getElementsByTagName('tr');
                    
                                // Loop through the rows and hide those that don't match the search query
                                for (var i = 1; i < rows.length; i++) {
                                    var cells = rows[i].getElementsByTagName('td');
                                    var match = false;
                                    for (var j = 0; j < cells.length; j++) {
                                        if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                                            match = true;
                                            break;
                                        }
                                    }
                                    rows[i].style.display = match ? '' : 'none';
                                }
                            }
                        </script>
                        	<script>
                                        function visitingfacultyDelete(visitingfacultyId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('visitingfaculty').action = "{{ route('visitingfaculty.delete', ':id') }}".replace(':id', visitingfacultyId);
                                                    document.getElementById('visitingfaculty').submit();
                                                }
                                            });
                                        }
                                    </script>
                          
                    </div>


                        
                         <h4 class="mt-5 mb-20">Add a Faculty</h4>
                          <div class="page-box mt-0">
                                     <form action="{{ route('pages.visitingfaculty') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="staff_name_1">Name</label>
                                            <input type="text" class="form-control" id="staff_name_1" name="staff_name_1" placeholder="Enter Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="staff_image_1" class="form-label">Staff Image</label>
                                            <input class="form-control" type="file" id="staff_image_1" name="staff_image_1" aria-label="Image" onchange="visitingImage(event)" required>
                                            <img id="visiting_facultyImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="designation_1">Designation</label>
                                            <input type="text" class="form-control" id="designation_1" name="designation_1" placeholder="Enter Designation" required>
                                        </div>
                                        <button type="submit" class="psg-p-btn ml-0">Submit</button>
                                    </form>
        
        
                                        
                               </div>
 
                
                    @elseif($submenu->submenu == 'Design Chair')
                    
                      <div class="page-box">
                        <div class=" ">
                        <form action="{{ route('pages.designchair') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach($Designchair as $chair)
                                    <div class="mb-3">
                                        <label for="chair_name">Name</label>
                                        <input type="text" class="form-control" id="chair_name" name="chair_name" value="{{ old('name', $chair->chair_name) }}" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact_info">Contact Info</label>
                                        <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info', $chair->contact_info) }}" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="chair_email">Email</label>
                                        <input type="text" class="form-control" id="chair_email" name="chair_email"  value="{{ old('chair_email', $chair->chair_email) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="chair_content">Description</label>
                                        <textarea class="form-control" id="chair_content" name="chair_content" style="width: 100%; height: 150px;">{{ old('chair_content', $chair->chair_content) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="chair_image">Design Chair Image</label>
                                        <input type="file" class="form-control-file" id="chair_image" name="chair_image" onchange="chairimg(event)">
                                        @if ($chair->chair_image)
                                            <img id="chairimageprev" class="d-block people-image-be" src="{{ asset('images/' . $chair->chair_image ) }}" alt="Trustee Image" >
                                        @else
                                            <img id="chairimageprev" src="#" class="d-block people-image-be" alt=""  class="people-image-be">
                                        @endif
                                    </div>
                                
                                <div class="mb-3">
                                    <label for="chair_quote">Quote</label>
                                    <input type="text" class="form-control" id="chair_quote" name="chair_quote" value="{{ old('chair_quote', $chair->chair_quote) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="chair_quote_author">Author Name</label>
                                    <input type="text" class="form-control" id="chair_quote_author" name="chair_quote_author" value="{{ old('chair_quote_author', $chair->chair_quote_author) }}" >
                                </div>
                                @endforeach
                                <button type="submit" class="psg-p-btn ml-0">Submit</button>
                            </form>
                            <script>
                                function chairimg(event) {
                                    const filereader = new FileReader();
                                    const fileField = document.getElementById('chairimageprev');
                    
                                    filereader.onload = function() {
                                        if (filereader.readyState === 2) {
                                            fileField.src = filereader.result;
                                            fileField.style.display = 'block';
                                        }
                                    };
                    
                                    filereader.readAsDataURL(event.target.files[0]);
                                }
                            </script>
                          
                    </div>
                </div>
                    
                    @elseif($submenu->submenu == 'Allied Faculty')
                    
                      <h4 class="mt-5 mb-20">Upadate/Delete</h4>
                      <div class="page-box mt-0">
                        <div class=" ">
                            
                           <div class="search-container">
    <input type="text" id="searchalliedfaculty" onkeyup="alliedfacultyTable()" class="search-input w-100" placeholder="Search">
    <span class="search-icon si--search-line"></span>
</div>
                           
                           

                           <table class="table mb-0" id="alliedfacultyTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allied ?? '' as $key => $all)
                                    <tr id="row-{{ $all->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="allfac_name-{{ $all->id }}">{{ $all->name }}</td>
                                        <td id="allfac_designation-{{ $all->id }}">{{ $all->designation }}</td>
                                        <td id="allfac_image-{{ $all->id }}">
                                            <img src="{{ asset('faculty/' . $all->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="ml-0 psg-p-btn" data-bs-toggle="modal" data-bs-target="#editalliedfacultyModal-{{ $all->id }}">Edit</button>
                                            <!-- Modal -->
                                            
                                        </td>
                                        <td class="text-center">
                                         <form id="alliedfaculty" action="{{ route('alliedfaculty.delete', $all->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="ml-0 psg-p-btn btn-danger" onclick="alliedfacultyDelete('{{ $all->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    <div class="modal fade" id="editalliedfacultyModal-{{ $all->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Core Faculty</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('alliedfaculty.update', $all->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="allfac_name">Staff Name</label>
                                                                    <input type="text" class="form-control" id="allfac_name" name="allfac_name" value="{{ $all->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="allfac_designation">Designation</label>
                                                                    <input type="text" class="form-control" id="allfac_designation" name="allfac_designation" value="{{ $all->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="allfac_image">Staff Image</label>
                                                                    <input type="file" class="form-control" id="allfac_image" name="allfac_image">
                                                                    @if($all->image)
                                                                        <img src="{{ asset('faculty/' . $all->image) }}" alt="{{ $all->name }}" width="100" class="d-block">
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="allfac_description" class="form-label">Description</label>
                                                                    <textarea class="form-control" id="allfac_description" name="allfac_description" aria-label="Description" style="width: 100%; height: 150px;">{{ $all->description }}</textarea>
                                                                </div>
                                                                <div class="d-c-c">
                                                                     <button type="submit" class="green-bg psg-p-btn ml-0"><span class="bi--save-fill"></span>Update</button>
                                                            <button type="button" class="psg-p-btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <script>
                                function alliedfacultyImage(event) {
                                    var image = document.getElementById('allied_facultyImage');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                    image.style.display = 'block';
                                }
                            </script>
                            <script>
                            function alliedfacultyTable() {
                                // Get the value of the search input
                                var input = document.getElementById('searchalliedfaculty');
                                var filter = input.value.toLowerCase();
                                
                                // Get the table and rows
                                var table = document.getElementById('alliedfacultyTable');
                                var rows = table.getElementsByTagName('tr');
                    
                                // Loop through the rows and hide those that don't match the search query
                                for (var i = 1; i < rows.length; i++) {
                                    var cells = rows[i].getElementsByTagName('td');
                                    var match = false;
                                    for (var j = 0; j < cells.length; j++) {
                                        if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                                            match = true;
                                            break;
                                        }
                                    }
                                    rows[i].style.display = match ? '' : 'none';
                                }
                            }
                        </script>
                        	<script>
                                        function alliedfacultyDelete(alliedfacultyId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('alliedfaculty').action = "{{ route('alliedfaculty.delete', ':id') }}".replace(':id', alliedfacultyId);
                                                    document.getElementById('alliedfaculty').submit();
                                                }
                                            });
                                        }
                                    </script>
                          
                    </div>
                </div>
                
                <h4 class="mt-5 mb-20">Add a Faculty</h4>
                <div class="page-box mt-0">
                    
                    <form action="{{ route('pages.alliedfaculty') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="allfac_name">Name</label>
                                    <input type="text" class="form-control" id="allfac_name" name="allfac_name" placeholder="Enter Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="allfac_image" class="form-label">Staff Image</label>
                                    <input class="form-control" type="file" id="allfac_image" name="allfac_image" aria-label="Image" onchange="alliedfacultyImage(event)" required>
                                    <img id="allied_facultyImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                </div>
                                <div class="mb-3">
                                    <label for="allfac_designation">Designation</label>
                                    <input type="text" class="form-control" id="allfac_designation" name="allfac_designation" placeholder="Enter Designation" required>
                                </div>
                                <div class="mb-3">
                                <label for="allfac_description" class="form-label">Description</label>
                                <textarea class="form-control" id="allfac_description" name="allfac_description" aria-label="Description" style="width: 100%; height: 150px;"></textarea>
                            </div>
                                <button type="submit" class="psg-p-btn ml-0">Submit</button>
                            </form>
                            
                           
                            
                </div>
                
                
                
                    @elseif($submenu->submenu == 'Expert Panel Members')
                    
                    <div class="page-box">
                        <div class=" ">
                            <h4 >Expert Panel Members</h4>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingsix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsesix" aria-expanded="false" aria-controls="flush-collapsesix">
                                        Chief Advisor and Member of Governing Council
                                    </button>
                                </h2>
                    <div id="flush-collapsesix" class="accordion-collapse collapse" aria-labelledby="flush-headingsix" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            

                           <div class="page-box">
                              <h4 class="mt-5 mb-20">Update/Delete</h4>
                             <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Member Name</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th class="text-center">Edit</th>
                                            <th  class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($chiefadvisor ?? '' as $key => $advisor)
                                    <tr id="row-{{ $advisor->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="advisor_name-{{ $advisor->id }}">{{ $advisor->name }}</td>
                                        <td id="advisor_designation-{{ $advisor->id }}">{{ $advisor->designation }}</td>
                                        <td id="advisor_image-{{ $advisor->id }}">
                                            <img src="{{ asset('faculty/' . $advisor->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="psg-p-btn ml-0" data-bs-toggle="modal" data-bs-target="#editadvisorModal-{{ $advisor->id }}">Edit</button>
                                            <!-- Modal -->
                                           
                                        </td>
                                        <td class="text-center">
                                         <form id="chiefadvisor" action="{{ route('chiefadvisor.delete', $advisor->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="chiefadvisorDelete('{{ $advisor->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                     <div class="modal fade" id="editadvisorModal-{{ $advisor->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Chief Advisor and Member of Governing Council</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('chiefadvisor.update', $advisor->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="advisor_name">Name</label>
                                                                    <input type="text" class="form-control" id="advisor_name" name="advisor_name" value="{{ $advisor->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="advisor_designation">Designation</label>
                                                                    <input type="text" class="form-control" id="advisor_designation" name="advisor_designation" value="{{ $advisor->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="advisor_image">Image</label>
                                                                    <input type="file" class="form-control" id="advisor_image" name="advisor_image">
                                                                    @if($advisor->image)
                                                                        <img src="{{ asset('faculty/' . $advisor->image) }}" alt="{{ $advisor->name }}" width="100">
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="advisor_description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="advisor_description" name="advisor_description" aria-label="Description" style="width: 100%; height: 150px;">{{ $advisor->description }}</textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn green-bg"><span class="bi--save-fill"></span>Update</button>
                                                            <button type="button" class="psg-p-btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                                </table>
                
                

                    
                                <script>
                                    function chiefadvisorImage(event) {
                                        var image = document.getElementById('chief_advisorImage');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                        image.style.display = 'block';
                                    }
                                 </script>
                                <script>
                                        function chiefadvisorDelete(advisorId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('chiefadvisor').action = "{{ route('chiefadvisor.delete', ':id') }}".replace(':id', advisorId);
                                                    document.getElementById('chiefadvisor').submit();
                                                }
                                            });
                                        }
                                    </script>
                                    
                            </div>
                                    
                                <h4 class="mt-5 mb-20">Add a Member</h4>
                            <form action="{{ route('pages.chiefadvisor') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                        <div class="col w-50-p">
                                            <label for="advisor_name">Name</label>
                                            <input type="text" class="form-control" id="advisor_name" name="advisor_name" placeholder="Add Name">
                                        </div>
                                        <div class="col w-50-p">
                                            <label for="advisor_designation">Designation</label>
                                            <input type="text" class="form-control" id="advisor_designation" name="advisor_designation" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                            <label for="advisor_image" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="advisor_image" name="advisor_image" aria-label="Image" onchange="chiefadvisorImage(event)" required>
                                            <img id="chief_advisorImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                         <div class="mb-3">
                                    <label for="advisor_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="advisor_description" name="advisor_description" aria-label="Description" style="width: 100%; height: 150px;"></textarea>
                                    </div>
                                    
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>

                        <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingseven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseseven" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Mentors Cum Expert Panel
                                        </button>
                                    </h2>
                                    <div id="flush-collapseseven" class="accordion-collapse collapse" aria-labelledby="flush-headingseven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                         <form action="{{ route('pages.expertmember') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="container">
                                      <div class="row">
                                        <div class="col">
                                          <label>Name</label>
                                          <input type="text" class="form-control" id="expert_member_name" name="expert_member_name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                          <label>Designation</label>
                                          <input type="text" class="form-control" id="expert_member_designation" name="expert_member_designation" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                          <label>Committee</label>
                                          <input type="text" class="form-control" id="expert_member_Committee" name="expert_member_Committee" placeholder="Add Committee">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Image <span style="font-size: smaller;color: red;font-family: cursive;"> ( Optional )</span></label>
                                            <input class="form-control" type="file" id="expert_member_image" name="expert_member_image" aria-label="Image" onchange="expertmemberImage(event)" >
                                            <img id="expert_memberImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                        <br>
                                        <div class="mb-5 mt-3">
                                    <label for="expert_member_description" class="form-label">Description <span style="font-size: smaller;color: red;font-family: cursive;"> ( Optional )</span></label>
                                    <textarea class="form-control" id="expert_member_description" name="expert_member_description" aria-label="Description" style="width: 100%; height: 150px;"></textarea>
                                    </div>
                                      </div>
                                    </div>
                                    <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <script>
                            function expertmemberImage(event) {
                                var image = document.getElementById('expert_memberImage');
                                image.src = URL.createObjectURL(event.target.files[0]);
                                image.style.display = 'block';
                            }
                                 </script>
                            <hr>
                           <span><strong>Update/Delete</strong></span>
                                   <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Member Name</th>
                                            <th>Committee</th>
                                            <th>Designation</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($expertmembers ?? '' as $key => $expertmember)
                                    <tr id="row-{{ $expertmember->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="expert_member_name-{{ $expertmember->id }}">{{ $expertmember->name }}</td>
                                        <td id="expert_member_Committee-{{ $expertmember->id }}">{{ $expertmember->committee }}</td>
                                        <td id="expert_member_designation-{{ $expertmember->id }}">{{ $expertmember->designation }}</td>
                                        {{-- <td id="expert_member_image-{{ $expertmember->id }}">
                                            <img src="{{ asset('faculty/' . $expertmember->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td> --}}
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#editexpertmemberModal-{{ $expertmember->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editexpertmemberModal-{{ $expertmember->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Mentors Cum Expert Panel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('expertmember.update', $expertmember->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="expert_member_name" name="expert_member_name" value="{{ $expertmember->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Committee</label>
                                                                    <input type="text" class="form-control" id="expert_member_Committee" name="expert_member_Committee" value="{{ $expertmember->committee }}"  placeholder="Add Committee">
                                                                  </div>
                                                                <div class="form-group">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control" id="expert_member_designation" name="expert_member_designation" value="{{ $expertmember->designation }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="expert_member_image" name="expert_member_image">
                                                                    @if($expertmember->image)
                                                                        <img src="{{ asset('faculty/' . $expertmember->image) }}" alt="{{ $expertmember->name }}" width="100">
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="expert_member_description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="expert_member_description" name="expert_member_description" aria-label="Description" style="width: 100%; height: 150px;">{{ $expertmember->description }}</textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                         <form id="expertmember" action="{{ route('expertmember.delete', $expertmember->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="expertmemberDelete('{{ $expertmember->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <script>
                                        function expertmemberDelete(expertmemberId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('expertmember').action = "{{ route('expertmember.delete', ':id') }}".replace(':id', expertmemberId);
                                                    document.getElementById('expertmember').submit();
                                                }
                                            });
                                        }
                                    </script>

                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($submenu->submenu == 'Administrative Staffs')
                    
                     <div class="page-box">
                        <div class=" ">
                            <h5 class="card-title">Administrative Staffs</h5>
                            <hr/>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingeight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseeight" aria-expanded="false" aria-controls="flush-collapsesix">
                                        Chief Advisor and Member of Governing Council
                                    </button>
                            </h2>
                    <div id="flush-collapseeight" class="accordion-collapse collapse" aria-labelledby="flush-headingeight" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="{{ route('pages.admin_chiefadvisor') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="advisor_name_1" name="advisor_name_1" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                            <label>Designation</label>
                                            <input type="text" class="form-control" id="advisor_designation_1" name="advisor_designation_1" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file" id="advisor_image_1" name="advisor_image_1" aria-label="Image" onchange="chiefadvisorImage1(event)" required>
                                            <img id="chief_advisorImage_1" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                         
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            <span><strong>Update/Delete</strong></span>
                            
                            <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Member Name</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($adminchiefadvisors ?? '' as $key => $admin)
                                    <tr id="row-{{ $admin->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="advisor_name_1-{{ $admin->id }}">{{ $admin->name }}</td>
                                        <td id="advisor_designation_1-{{ $admin->id }}">{{ $admin->designation }}</td>
                                        <td id="advisor_image_1-{{ $admin->id }}">
                                            <img src="{{ asset('faculty/' . $admin->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#editadminadvisorModal-{{ $admin->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editadminadvisorModal-{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Chief Advisor and Member of Governing Council</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin_chiefadvisor.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="advisor_name_1" name="advisor_name_1" value="{{ $admin->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control" id="advisor_designation_1" name="advisor_designation_1" value="{{ $admin->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="advisor_image_1" name="advisor_image_1">
                                                                    @if($admin->image)
                                                                        <img src="{{ asset('faculty/' . $admin->image) }}" alt="{{ $admin->name }}" width="100">
                                                                    @endif
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                         <form id="adminchiefadvisor" action="{{ route('admin_chiefadvisor.delete', $admin->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="AdminchiefadvisorDelete('{{ $admin->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                
                

                    
                                <script>
                                    function chiefadvisorImage1(event) {
                                        var image = document.getElementById('chief_advisorImage_1');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                        image.style.display = 'block';
                                    }
                                 </script>
                                <script>
                                        function AdminchiefadvisorDelete(adminadvisorId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('adminchiefadvisor').action = "{{ route('admin_chiefadvisor.delete', ':id') }}".replace(':id', adminadvisorId);
                                                    document.getElementById('adminchiefadvisor').submit();
                                                }
                                            });
                                        }
                                    </script>
                            </div>
                        </div>
                    </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingsnine">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsesnine" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Mentors Cum Expert Panel
                                        </button>
                                    </h2>
                                    <div id="flush-collapsesnine" class="accordion-collapse collapse" aria-labelledby="flush-headingsnine" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                         <form action="{{ route('pages.admin_expertmember') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="container">
                                      <div class="row">
                                        <div class="col">
                                          <label>Name</label>
                                          <input type="text" class="form-control" id="admin_expert_member_name" name="admin_expert_member_name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                          <label>Designation</label>
                                          <input type="text" class="form-control" id="admin_expert_member_designation" name="admin_expert_member_designation" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file" id="admin_expert_member_image" name="admin_expert_member_image" aria-label="Image" onchange="adminexpertmemberImage(event)" required>
                                            <img id="admin_expert_memberImage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                       
                                      </div>
                                    </div>
                                    <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <script>
                            function adminexpertmemberImage(event) {
                                var image = document.getElementById('admin_expert_memberImage');
                                image.src = URL.createObjectURL(event.target.files[0]);
                                image.style.display = 'block';
                            }
                                 </script>
                            <hr>
                           <span><strong>Update/Delete</strong></span>
                                   <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Member Name</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($adminexpmembers ?? '' as $key => $adminexp)
                                    <tr id="row-{{ $adminexp->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="admin_expert_member_name-{{ $adminexp->id }}">{{ $adminexp->name }}</td>
                                        <td id="admin_expert_member_designation-{{ $adminexp->id }}">{{ $adminexp->designation }}</td>
                                        <td id="admin_expert_member_image-{{ $adminexp->id }}">
                                            <img src="{{ asset('faculty/' . $adminexp->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#admineditexpertmemberModal-{{ $adminexp->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="admineditexpertmemberModal-{{ $adminexp->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Mentors Cum Expert Panel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin_expertmember.update', $adminexp->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="admin_expert_member_name" name="admin_expert_member_name" value="{{ $adminexp->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control" id="admin_expert_member_designation" name="admin_expert_member_designation" value="{{ $adminexp->designation }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="admin_expert_member_image" name="admin_expert_member_image">
                                                                    @if($adminexp->image)
                                                                        <img src="{{ asset('faculty/' . $adminexp->image) }}" alt="{{ $adminexp->name }}" width="100">
                                                                    @endif
                                                                </div>
                                                               
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form id="delete-form-{{ $adminexp->id }}" 
                                                  action="{{ route('admin_expertmember.delete', $adminexp->id) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger" 
                                                        onclick="confirmDelete('{{ $adminexp->id }}', '{{ $adminexp->name }}')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <script>
                                    function confirmDelete(id, name) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            html: `Do you want to delete the expert member <strong>${name}</strong>?`,
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'Cancel'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Submit the form
                                                document.getElementById('delete-form-' + id).submit();
                                            }
                                        });
                                    }

                                    </script>
                                  
                                    

                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($submenu->submenu == 'Programs')
                    
                           <div class="page-box">
                        <div class=" ">
                            <form  action="{{ route('pages.ourprograms') }}" method="POST">
                                @csrf
                                @foreach($programs as $program)
                                    <div class="mb-3">
                                        <label for="program" class="form-label">Our Programs</label>
                                        <textarea class="form-control" id="program" name="program" aria-label="Program" style="width: 100%; height: 150px;">{{ old('program', $program->program ?? '') }}</textarea>
                                    </div>
                                @endforeach
                                <button type="submit"  class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            
                            <form action="{{ route('pages.pedagogy') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="prog_name" name="prog_name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                            <label>Content</label>
                                            <textarea class="form-control" id="prog_content" name="prog_content" placeholder="Add Designation"></textarea>
                                        </div>
                                        
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file" id="prog_image" name="prog_image" aria-label="Image" onchange="programimage(event)" required>
                                            <img id="prog_iamge" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                         
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <script>
                                    function programimage(event) {
                                        var image = document.getElementById('prog_iamge');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                        image.style.display = 'block';
                                    }
                                 </script>
                              <span><strong>Update/Delete</strong></span>
                                   <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Name</th>
                                            <!--<th>Content</th>-->
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($Pedagogys ?? '' as $key => $Pedagogy)
                                    <tr id="row-{{ $Pedagogy->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="prog_name-{{ $Pedagogy->id }}">{{ $Pedagogy->prog_name }}</td>
                                        <!--<td id="prog_content-{{ $Pedagogy->id }}">{{ $Pedagogy->prog_content }}</td>-->
                                        <td id="prog_image-{{ $Pedagogy->id }}">
                                            <img src="{{ asset('images/' . $Pedagogy->prog_image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#pedagogyModal-{{ $Pedagogy->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="pedagogyModal-{{ $Pedagogy->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Mentors Cum Expert Panel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('pedagogy.update', $Pedagogy->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="prog_name" name="prog_name" value="{{ $Pedagogy->prog_name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Content</label>
                                                                    <textarea class="form-control" id="prog_content" name="prog_content" required>{{ $Pedagogy->prog_content }}</textarea>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="prog_image" name="prog_image">
                                                                    @if($Pedagogy->prog_image)
                                                                        <img src="{{ asset('images/' . $Pedagogy->prog_image) }}" alt="{{ $Pedagogy->prog_name }}" width="100">
                                                                    @endif
                                                                </div>
                                                               
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                         <form id="pedagogy_delete" action="{{ route('pedagogy.delete', $Pedagogy->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="pedagogyDelete('{{ $Pedagogy->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <script>
                                        function pedagogyDelete(pedagogyId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('pedagogy_delete').action = "{{ route('pedagogy.delete', ':id') }}".replace(':id', pedagogyId);
                                                    document.getElementById('pedagogy_delete').submit();
                                                }
                                            });
                                        }
                                    </script>    
                        </div>
                    </div>
                    
                    @elseif($submenu->submenu == 'Academic Timetable')
                    
                      <div class="page-box">
                        <div class=" ">
                            <form action="{{ route('pages.timetable') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Year From</label>
                                            <select class="form-control" id="year_from" name="year_from">
                                                @for($year = 2000; $year <= 2050; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Year To</label>
                                            <select class="form-control" id="year_to" name="year_to">
                                                @for($year = 2000; $year <= 2050; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    <br>
                    
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="row">
                                            <div class="col">
                                                <label>Year {{ $i }} - Odd Sem PDF</label>
                                                <input type="file" class="form-control" id="year_{{ $i }}_odd_pdf" name="year_{{ $i }}_odd_pdf">
                                            </div>
                                            <div class="col">
                                                <label>Year {{ $i }} - Even Sem PDF</label>
                                                <input type="file" class="form-control" id="year_{{ $i }}_even_pdf" name="year_{{ $i }}_even_pdf">
                                            </div>
                                        </div>
                                        <br>
                                    @endfor
                                </div>
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            <span><strong>Update/Delete</strong></span>
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Academic Year</th>
                                        <th>1st year</th>
                                        <th>2nd year</th>
                                        <th>3rd year</th>
                                        <th>4th year</th>
                                        <th>Final year</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timetable ?? [] as $key => $table)
                                    <tr id="row-{{ $table->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="year_from-{{ $table->id }}">{{ $table->year_from }} - {{ $table->year_to }}</td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <td id="year_{{ $i }}_pdf-{{ $table->id }}">
                                                @if($table->{'year_' . $i . '_odd_pdf'})
                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_odd_pdf'}) }}" target="_blank">Odd</a>
                                                @endif
                                                @if($table->{'year_' . $i . '_even_pdf'})
                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_even_pdf'}) }}" target="_blank">Even</a>
                                                @else
                                                    No PDF available
                                                @endif
                                            </td>
                                        @endfor
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#edittimetableModal-{{ $table->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edittimetableModal-{{ $table->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Academic Timetable</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                <form action="{{ route('timetable.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label>Year From</label>
                                                            <select class="form-control" id="year_from" name="year_from">
                                                                @for($year = 2000; $year <= 2050; $year++)
                                                                    <option value="{{ $year }}" @if($table->year_from == $year) selected @endif>{{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <label>Year To</label>
                                                            <select class="form-control" id="year_to" name="year_to">
                                                                @for($year = 2000; $year <= 2050; $year++)
                                                                    <option value="{{ $year }}" @if($table->year_to == $year) selected @endif>{{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                            
                                                    <br>
                                            
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Year {{ $i }} - Odd Sem PDF</label>
                                                                <input type="file" class="form-control" id="year_{{ $i }}_odd_pdf" name="year_{{ $i }}_odd_pdf">
                                                                @if($table->{'year_' . $i . '_odd_pdf'})
                                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_odd_pdf'}) }}" target="_blank">Preview Odd Sem PDF</a>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <label>Year {{ $i }} - Even Sem PDF</label>
                                                                <input type="file" class="form-control" id="year_{{ $i }}_even_pdf" name="year_{{ $i }}_even_pdf">
                                                                @if($table->{'year_' . $i . '_even_pdf'})
                                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_even_pdf'}) }}" target="_blank">Preview Even Sem PDF</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <br>
                                                    @endfor
                                            
                                                    <div class="modal-footer">
                                                        <button type="submit" class="psg-p-btn">Update</button>
                                                        <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                     <form id="deletetimetableForm" action="{{ route('timetable.delete', $table->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="psg-p-btn btn-danger" onclick="confirmtimetableDelete('{{ $table->id }}')">Delete</button>
                                    </form>
                                </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           <script>
                                        function confirmtimetableDelete(ttid) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletetimetableForm').action = "{{ route('timetable.delete', ':id') }}".replace(':id', ttid);
                                                    document.getElementById('deletetimetableForm').submit();
                                                }
                                            });
                                        }
                                    </script>
                        </div>
                    </div>

                    @elseif($submenu->submenu == 'Academic Calendar')
                    
                     <div class="page-box">
                    <div class=" ">
                       
                            <form action="{{ route('pages.academicevent') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Event Title</label>
                                    <input type="text" class="form-control" id="event" name="event" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Event Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                               
                                    <button type="submit" class="psg-p-btn">Submit</button>
                                   
                                
                            </form>
                            
                         <hr>
                            <table  id="AcademicCalendar" class="table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.no</th>
                                    <th>Date</th>
                                    <th>Event</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calendars ?? '' as $key => $calendar)
                                <tr id="row-{{ $calendar->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td id="date-{{ $calendar->id }}">{{ $calendar->date }}</td>
                                    <td id="event-{{ $calendar->id }}">{{ $calendar->event }}</td>
                                     <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#eventModal-{{ $calendar->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="eventModal-{{ $calendar->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Section</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('academicevent.update', $calendar->id) }}" method="POST" >
                                                                @csrf
                                                               <div class="mb-3">
                                                                    <label class="form-label">Event Title</label>
                                                                    <input type="text" class="form-control" id="event" name="event" value="{{ $calendar->event }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Event Date</label>
                                                                  <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($calendar->date)->format('Y-m-d') }}">

                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                         <td>
                                     <form id="deletecalendarForm" action="{{ route('academicevent.delete', $calendar->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="psg-p-btn btn-danger" onclick="calendarDelete('{{ $calendar->id }}')">Delete</button>
                                    </form>
                                </td>
                                
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                <script>
                                        function calendarDelete(calendarid) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletecalendarForm').action = "{{ route('academicevent.delete', ':id') }}".replace(':id', calendarid);
                                                    document.getElementById('deletecalendarForm').submit();
                                                }
                                            });
                                        }
                                    </script>
                                    
                                       <script>
                    
                                            $(document).ready(function () {
                                                $("#AcademicCalendar").DataTable({
                                                    paging: true,
                                                    lengthMenu: [5, 10, 25, 50],
                                                    ordering: true,
                                                    info: true,
                                                    autoWidth: false,
                                                    searching: true,
                                                });
                                            });
                                        </script>
                    

                    </div>
                </div>
                    
                    @elseif($submenu->submenu == 'Programs')
                    
                      <div class="page-box">
                        <div class=" ">
                            <form  action="{{ route('pages.ourprograms') }}" method="POST">
                                @csrf
                                @foreach($programs as $program)
                                    <div class="mb-3">
                                        <label for="program" class="form-label">Our Programs</label>
                                        <textarea class="form-control" id="program" name="program" aria-label="Program" style="width: 100%; height: 150px;">{{ old('program', $program->program ?? '') }}</textarea>
                                    </div>
                                @endforeach
                                <button type="submit"  class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            
                            <form action="{{ route('pages.pedagogy') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="prog_name" name="prog_name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                            <label>Content</label>
                                            <input type="text" class="form-control" id="prog_content" name="prog_content" placeholder="Add Designation">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file" id="prog_image" name="prog_image" aria-label="Image" onchange="programimage(event)" required>
                                            <img id="prog_iamge" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                         
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <script>
                                    function programimage(event) {
                                        var image = document.getElementById('prog_iamge');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                        image.style.display = 'block';
                                    }
                                 </script>
                              <span><strong>Update/Delete</strong></span>
                                   <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Name</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                   @foreach($Pedagogys ?? '' as $key => $Pedagogy)
                                    <tr id="row-{{ $Pedagogy->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="prog_name-{{ $Pedagogy->id }}">{{ $Pedagogy->prog_name }}</td>
                                        <td id="prog_content-{{ $Pedagogy->id }}">{{ $Pedagogy->prog_content }}</td>
                                        <td id="prog_image-{{ $Pedagogy->id }}">
                                            <img src="{{ asset('images/' . $Pedagogy->prog_image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#pedagogyModal-{{ $Pedagogy->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="pedagogyModal-{{ $Pedagogy->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Mentors Cum Expert Panel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('pedagogy.update', $Pedagogy->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="prog_name" name="prog_name" value="{{ $Pedagogy->prog_name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Content</label>
                                                                    <input type="text" class="form-control" id="prog_content" name="prog_content" value="{{ $Pedagogy->prog_content }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="prog_image" name="prog_image">
                                                                    @if($Pedagogy->prog_image)
                                                                        <img src="{{ asset('images/' . $Pedagogy->prog_image) }}" alt="{{ $Pedagogy->prog_name }}" width="100">
                                                                    @endif
                                                                </div>
                                                               
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                         <form id="pedagogy_delete" action="{{ route('pedagogy.delete', $Pedagogy->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="pedagogyDelete('{{ $Pedagogy->id }}')">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <script>
                                        function pedagogyDelete(pedagogyId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('pedagogy_delete').action = "{{ route('pedagogy.delete', ':id') }}".replace(':id', pedagogyId);
                                                    document.getElementById('pedagogy_delete').submit();
                                                }
                                            });
                                        }
                                    </script>    
                        </div>
                    </div>
                    
                    @elseif($submenu->submenu == 'Academic Timetable')
                    
                      <div class="page-box">
                        <div class=" ">
                            <form action="{{ route('pages.timetable') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Year From</label>
                                            <select class="form-control" id="year_from" name="year_from">
                                                @for($year = 2000; $year <= 2050; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Year To</label>
                                            <select class="form-control" id="year_to" name="year_to">
                                                @for($year = 2000; $year <= 2050; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    <br>
                    
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="row">
                                            <div class="col">
                                                <label>Year {{ $i }} - Odd Sem PDF</label>
                                                <input type="file" class="form-control" id="year_{{ $i }}_odd_pdf" name="year_{{ $i }}_odd_pdf">
                                            </div>
                                            <div class="col">
                                                <label>Year {{ $i }} - Even Sem PDF</label>
                                                <input type="file" class="form-control" id="year_{{ $i }}_even_pdf" name="year_{{ $i }}_even_pdf">
                                            </div>
                                        </div>
                                        <br>
                                    @endfor
                                </div>
                                <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            <span><strong>Update/Delete</strong></span>
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Academic Year</th>
                                        <th>1st year</th>
                                        <th>2nd year</th>
                                        <th>3rd year</th>
                                        <th>4th year</th>
                                        <th>Final year</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timetable ?? [] as $key => $table)
                                    <tr id="row-{{ $table->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="year_from-{{ $table->id }}">{{ $table->year_from }} - {{ $table->year_to }}</td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <td id="year_{{ $i }}_pdf-{{ $table->id }}">
                                                @if($table->{'year_' . $i . '_odd_pdf'})
                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_odd_pdf'}) }}" target="_blank">Odd</a>
                                                @endif
                                                @if($table->{'year_' . $i . '_even_pdf'})
                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_even_pdf'}) }}" target="_blank">Even</a>
                                                @else
                                                    No PDF available
                                                @endif
                                            </td>
                                        @endfor
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#edittimetableModal-{{ $table->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edittimetableModal-{{ $table->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Academic Timetable</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                <form action="{{ route('timetable.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label>Year From</label>
                                                            <select class="form-control" id="year_from" name="year_from">
                                                                @for($year = 2000; $year <= 2050; $year++)
                                                                    <option value="{{ $year }}" @if($table->year_from == $year) selected @endif>{{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <label>Year To</label>
                                                            <select class="form-control" id="year_to" name="year_to">
                                                                @for($year = 2000; $year <= 2050; $year++)
                                                                    <option value="{{ $year }}" @if($table->year_to == $year) selected @endif>{{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                            
                                                    <br>
                                            
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Year {{ $i }} - Odd Sem PDF</label>
                                                                <input type="file" class="form-control" id="year_{{ $i }}_odd_pdf" name="year_{{ $i }}_odd_pdf">
                                                                @if($table->{'year_' . $i . '_odd_pdf'})
                                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_odd_pdf'}) }}" target="_blank">Preview Odd Sem PDF</a>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <label>Year {{ $i }} - Even Sem PDF</label>
                                                                <input type="file" class="form-control" id="year_{{ $i }}_even_pdf" name="year_{{ $i }}_even_pdf">
                                                                @if($table->{'year_' . $i . '_even_pdf'})
                                                                    <a href="{{ asset('timetables/' . $table->{'year_' . $i . '_even_pdf'}) }}" target="_blank">Preview Even Sem PDF</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <br>
                                                    @endfor
                                            
                                                    <div class="modal-footer">
                                                        <button type="submit" class="psg-p-btn">Update</button>
                                                        <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                     <form id="deletetimetableForm" action="{{ route('timetable.delete', $table->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="psg-p-btn btn-danger" onclick="confirmtimetableDelete('{{ $table->id }}')">Delete</button>
                                    </form>
                                </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           <script>
                                        function confirmtimetableDelete(ttid) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletetimetableForm').action = "{{ route('timetable.delete', ':id') }}".replace(':id', ttid);
                                                    document.getElementById('deletetimetableForm').submit();
                                                }
                                            });
                                        }
                                    </script>
                        </div>
                    </div>

                    @elseif($submenu->submenu == 'Academic Calendar')
                    
                     <div class="page-box">
                    <div class=" ">
                       
                            <form action="{{ route('pages.academicevent') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Event Title</label>
                                    <input type="text" class="form-control" id="event" name="event" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Event Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                               
                                    <button type="submit" class="psg-p-btn">Submit</button>
                                   
                                
                            </form>
                            
                            <span><strong>Update/Delete</strong></span>
                            
                            <table id="Academsssichome"  class="table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.no</th>
                                    <th>Date</th>
                                    <th>Event</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calendars ?? '' as $key => $calendar)
                                <tr id="row-{{ $calendar->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td id="date-{{ $calendar->id }}">{{ $calendar->date }}</td>
                                    <td id="event-{{ $calendar->id }}">{{ $calendar->event }}</td>
                                     <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#eventModal-{{ $calendar->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="eventModal-{{ $calendar->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Section</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('academicevent.update', $calendar->id) }}" method="POST" >
                                                                @csrf
                                                               <div class="mb-3">
                                                                    <label class="form-label">Event Title</label>
                                                                    <input type="text" class="form-control" id="event" name="event" value="{{ $calendar->event }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Event Date</label>
                                                                    <input type="date" class="form-control" id="date" name="date" value="{{ $calendar->date }}">
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="psg-p-btn">Update</button>
                                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                         <td>
                                     <form id="deletecalendarForm" action="{{ route('academicevent.delete', $calendar->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="psg-p-btn btn-danger" onclick="calendarDelete('{{ $calendar->id }}')">Delete</button>
                                    </form>
                                </td>
                                
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                <script>
                                        function calendarDelete(calendarid) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletecalendarForm').action = "{{ route('academicevent.delete', ':id') }}".replace(':id', calendarid);
                                                    document.getElementById('deletecalendarForm').submit();
                                                }
                                            });
                                        }
                                    </script>
                                    
                                    
                                       <script>
                    
                        $(document).ready(function () {
                            $("#Academsssichome").DataTable({
                                paging: true,
                                lengthMenu: [5, 10, 25, 50],
                                ordering: true,
                                info: true,
                                autoWidth: false,
                                searching: true,
                            });
                        });
                    </script>
                    

                    </div>
                </div>

                    
                 
                    @elseif($submenu->submenu == 'Syllabus')
                    
                      <div class="page-box">
                        <div class=" ">
                        <form action="{{ route('pages.syllabus') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="container">
                                      <div class="row">
                                        <div class="col">
                                          <label for="syllabus">Syllabus</label>
                                          <input type="text" class="form-control" id="syllabus" name="syllabus" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                          <label for="pdf">Syllabus Pdf</label>
                                          <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
                                        </div>
                                      </div>
                                    </div>
                                    <br>
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                            <hr>
                            <span><strong>Update/Delete</strong></span>
                           <table class="table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.no</th>
                                    <th>Syllabus</th>
                                    <th>PDF</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($syllabus ?? '' as $key => $syllabu)
                                <tr id="row-{{ $syllabu->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td id="syllabus-{{ $syllabu->id }}">{{ $syllabu->syllabus }}</td>
                                    <td id="pdf-{{ $syllabu->id }}">
                                        @if($syllabu->pdf)
                                            <a href="{{ asset('pdfs/' . $syllabu->pdf) }}" target="_blank">Preview PDF</a>
                                        @else
                                            No PDF available
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="psg-p-btn  " onclick="editdsyllabusRow('{{ $syllabu->id }}')">Edit</button>
                                        <button type="button" class="psg-p-btn btn-success" style="display:none;" id="savedownload-{{ $syllabu->id }}" onclick="savedownloadRow('{{ $syllabu->id }}')">Save</button>
                                    </td>
                                     <td>
                                     <form id="deletedownloadForm" action="{{ route('syllabus.delete', $syllabu->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="psg-p-btn btn-danger" onclick="confirmdownloadDelete('{{ $syllabu->id }}')">Delete</button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <script>
                        
                                function editdsyllabusRow(downloadid) {
                                    var pdfNameCell = document.getElementById('syllabus-' + downloadid);
                                    var pdfCell = document.getElementById('pdf-' + downloadid);
                            
                                    pdfNameCell.innerHTML = '<input type="text" id="input-syllabus-' + downloadid + '" value="' + pdfNameCell.innerText + '">';
                                    pdfCell.innerHTML = '<input type="file" id="input-pdf-' + downloadid + '">';
                            
                                    document.querySelector('[onclick="editdsyllabusRow(\'' + downloadid + '\')"]').style.display = 'none';
                                    document.getElementById('savedownload-' + downloadid).style.display = 'inline';
                                }
                            
                                function savedownloadRow(downloadid) {
                                    var pdfName = document.getElementById('input-syllabus-' + downloadid).value;
                                    var pdfFile = document.getElementById('input-pdf-' + downloadid).files[0];
                            
                                    var formData = new FormData();
                                    formData.append('syllabus', pdfName);
                                    formData.append('pdf', pdfFile);
                                    formData.append('_token', '{{ csrf_token() }}');
                            
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "{{ route('syllabus.update', '') }}/" + downloadid, true);
                            
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            alert('Download updated successfully.');
                            
                                            document.getElementById('syllabus-' + downloadid).innerText = pdfName;
                            
                                            if (pdfFile) {
                                                var newPdfUrl = JSON.parse(xhr.responseText).pdf_url;
                                                document.getElementById('pdf-' + downloadid).innerHTML = '<a href="' + newPdfUrl + '" target="_blank">Preview PDF</a>';
                                            } else {
                                                document.getElementById('pdf-' + downloadid).innerText = 'No PDF available';
                                            }
                            
                                            document.querySelector('[onclick="editdsyllabusRow(\'' + downloadid + '\')"]').style.display = 'inline';
                                            document.getElementById('savedownload-' + downloadid).style.display = 'none';

                                            location.reload();
                                        } else if (xhr.readyState === 4) {
                                            alert('Error updating download.');
                                        }
                                    };
                            
                                    xhr.send(formData);
                                }
                            </script>

                        
                        <script>
                                        function confirmdownloadDelete(pdfid) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletedownloadForm').action = "{{ route('syllabus.delete', ':id') }}".replace(':id', pdfid);
                                                    document.getElementById('deletedownloadForm').submit();
                                                }
                                            });
                                        }
                                    </script>
                           


                                            </div>  
                    </div>
                    
                    @elseif($submenu->submenu == 'Monthly lecture series')
                    
                   <div class="page-box">
                    <div class=" ">
                        <form action="{{ route('pages.monthlylectureseries') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                
                            <!-- Thumbnail -->
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/webp" aria-label="Thumbnail" required />
                                <img id="thumbnail-preview" src="#" alt="Thumbnail Preview" style="max-width: 100px; display: none; margin-top: 10px;" />
                            </div>

                
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                            </div>
                
                            <!-- Container for dynamic image fields -->
                            <div id="dynamic-image-fields">
                                <!-- Existing image fields can be shown here if any, initially -->
                            </div>
                
                            <button type="button" class="psg-p-btn mb-3" onclick="addImageFieldMonthlylecture()">Add More Images</button><br />
                            <br />
                
                            <!-- Submit Button -->
                            <button type="submit" class="psg-p-btn">Submit</button>
                        </form>
                
                        <span><strong>Update/Delete</strong></span>
                        <table id="Monthlylectureserires" class="table mb-0">
                            <thead  class="table-dark">
                                <tr>
                                    <th>S.no</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lectureseries ?? '' as $key => $series)
                                <tr id="row-{{ $series->id }}">
                                    <td>{{ $key+1 }}</td>
                
                                    <td id="series_image-{{ $series->id }}">
                                        <img src="{{ asset('images/' . $series->thumbnail) }}" alt="Staff Image" style="max-width: 100px;" />
                                    </td>
                                    <td id="series_description-{{ $series->id }}">{{ $series->description }}</td>
                                    <td>
                                        <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#seriesModal-{{ $series->id }}">Edit</button>
                
                                        <!-- Modal -->
                                        <div class="modal fade" id="seriesModal-{{ $series->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Monthly Lecture Series</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('monthlylectureseries.update', $series->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PUT')
                
                                                            <!-- Description Field -->
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" name="description" id="description">{{ $series->description }}</textarea>
                                                            </div>
                
                                                            <!-- Thumbnail Field -->
                                                            <div class="form-group">
                                                                <label for="thumbnail">Thumbnail</label>
                                                                <input type="file" class="form-control" name="thumbnail" id="thumbnail" />
                                                                @if ($series->thumbnail)
                                                                <div>
                                                                    <img src="{{ asset('images/' . $series->thumbnail) }}" alt="Thumbnail" width="100" />
                                                                    <input type="checkbox" name="remove_thumbnail" value="1" /> Remove Thumbnail
                                                                </div>
                                                                @endif
                                                            </div>
                
                                                            <!-- Existing Images -->
                                                            <div id="dynamic-image-fields">
                                                                @for ($i = 1; $i <= 30; $i++) @php $imageField = 'image' . $i; @endphp @if ($series->$imageField)
                                                                <!-- Only show the image field if the image exists -->
                                                                <div class="form-group" id="imageField{{$i}}">
                                                                    <label for="image{{ $i }}">Image {{ $i }}</label>
                                                                    <input type="file" class="form-control" name="image{{ $i }}" id="image{{ $i }}" />
                                                                    <div>
                                                                        <img src="{{ asset('images/' . $series->$imageField) }}" alt="Image {{ $i }}" width="100" />
                                                                        <input type="checkbox" name="remove_image{{ $i }}" value="1" /> Remove Image {{ $i }}
                                                                    </div>
                                                                </div>
                                                                @endif @endfor
                                                            </div>
                
                                                            <!-- Add More Images Button -->
                                                            <div class="form-group">
                                                                <button type="button" class="psg-p-btn mb-3" onclick="addModalImageField('seriesModal-{{ $series->id }}')">Add More Images</button>
                                                            </div>
                
                                                            <div class="modal-footer">
                                                                <button type="submit" class="psg-p-btn">Update</button>
                                                                <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form id="series_delete" action="{{ route('monthlylectureseries.delete', $series->id) }}" method="POST" style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="seriesDelete('{{ $series->id }}')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            function seriesDelete(seriesId) {
                                Swal.fire({
                                    title: "Are you sure?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Delete",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById("series_delete").action = "{{ route('monthlylectureseries.delete', ':id') }}".replace(":id", seriesId);
                                        document.getElementById("series_delete").submit();
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
                
                <script>
                
                document.getElementById('thumbnail').addEventListener('change', function(event) {
                    let input = event.target;
                    let preview = document.getElementById('thumbnail-preview');
                
                    if (input.files && input.files[0]) {
                        let reader = new FileReader();
                        
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.style.display = 'none';
                    }
                });
                
                </script>
                
                <script>

                    $(document).ready(function () {
                        $("#Monthlylectureserires").DataTable({
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
                    // Track the number of image fields
                    let imageFieldCount = 0;
                
                    // Function to add image field
                    function addImageFieldMonthlylecture() {
                        if (imageFieldCount >= 30) {
                            Swal.fire({
                                title: "Maximum Limit Reached",
                                text: "You can only add up to 30 images.",
                                icon: "warning",
                            });
                            return;
                        }
                
                        imageFieldCount++;
                        const container = document.getElementById("dynamic-image-fields");
                
                        const newField = `
                                                <div class="mb-3" id="image-field-${imageFieldCount}">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-grow-1">
                                                            <label for="image${imageFieldCount}" class="form-label">Image ${imageFieldCount}</label>
                                                            <input class="form-control" type="file" id="image${imageFieldCount}" 
                                                                name="image${imageFieldCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                                        </div>
                                                        <button type="button" class="btn btn-danger mt-4" onclick="removeImageFieldMonthlylecture(${imageFieldCount})">Remove</button>
                                                    </div>
                                                    <div id="preview-${imageFieldCount}" class="mt-2"></div>
                                                </div>
                                            `;
                        container.insertAdjacentHTML("beforeend", newField);
                
                        // Add preview functionality
                        document.getElementById(`image${imageFieldCount}`).addEventListener("change", function (e) {
                            previewImage(e, imageFieldCount);
                        });
                    }
                
                    // Function to remove image field
                    function removeImageFieldMonthlylecture(id) {
                        const field = document.getElementById(`image-field-${id}`);
                        if (field) {
                            field.remove();
                            reorganizeFields();
                        }
                    }
                
                    // Function to reorganize fields after removal
                    function reorganizeFields() {
                        const container = document.getElementById("dynamic-image-fields");
                        const fields = container.getElementsByClassName("mb-3");
                
                        Array.from(fields).forEach((field, index) => {
                            const newIndex = index + 1;
                            field.id = `image-field-${newIndex}`;
                            const input = field.querySelector('input[type="file"]');
                            input.id = `image${newIndex}`;
                            input.name = `image${newIndex}`;
                            const label = field.querySelector("label");
                            label.htmlFor = `image${newIndex}`;
                            label.textContent = `Image ${newIndex}`;
                        });
                
                        imageFieldCount = fields.length;
                    }
                
                    // Function to preview image
                    function previewImage(event, id) {
                        const preview = document.getElementById(`preview-${id}`);
                        const file = event.target.files[0];
                
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.innerHTML = `
                                                        <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                                                        <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                                                    `;
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                
                    // Initialize when document loads
                    document.addEventListener("DOMContentLoaded", function () {
                        const container = document.getElementById("dynamic-image-fields");
                        if (container) {
                            imageFieldCount = container.querySelectorAll(".mb-3").length;
                        }
                
                        // Add form submission handler
                        const form = document.querySelector("form");
                        if (form) {
                            form.addEventListener("submit", function (e) {
                                const loadingOverlay = document.createElement("div");
                                loadingOverlay.style.cssText = "position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;";
                                loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                                document.body.appendChild(loadingOverlay);
                            });
                        }
                    });
                </script>
                <script>
                    // Track the number of image fields for different forms
                    const imageFieldCounts = {
                        main: 0,
                        modal: {},
                    };
                
                    // Function to add image field to main form
                    function addImageField() {
                        if (imageFieldCounts.main >= 30) {
                            Swal.fire({
                                title: "Maximum Limit Reached",
                                text: "You can only add up to 30 images.",
                                icon: "warning",
                            });
                            return;
                        }
                
                        imageFieldCounts.main++;
                        const container = document.getElementById("dynamic-image-fields");
                
                        const newField = `
                        <div class="mb-3" id="main-image-field-${imageFieldCounts.main}">
                            <div class="d-flex align-items-center gap-2">
                                <div class="flex-grow-1">
                                    <label for="main-image${imageFieldCounts.main}" class="form-label">Image ${imageFieldCounts.main}</label>
                                    <input class="form-control" type="file" id="main-image${imageFieldCounts.main}" 
                                        name="image${imageFieldCounts.main}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                </div>
                                <button type="button" class="btn btn-danger mt-4" onclick="removeImageField('main', ${imageFieldCounts.main})">Remove</button>
                            </div>
                            <div id="main-preview-${imageFieldCounts.main}" class="mt-2"></div>
                        </div>
                    `;
                        container.insertAdjacentHTML("beforeend", newField);
                
                        // Add preview functionality
                        document.getElementById(`main-image${imageFieldCounts.main}`).addEventListener("change", function (e) {
                            previewImage(e, "main", imageFieldCounts.main);
                        });
                    }
                
                    // Function to add image field to modal
                    function addModalImageField(modalId, seriesId) {
                        if (!imageFieldCounts.modal[modalId]) {
                            imageFieldCounts.modal[modalId] = 0;
                        }
                
                        if (imageFieldCounts.modal[modalId] >= 30) {
                            Swal.fire({
                                title: "Maximum Limit Reached",
                                text: "You can only add up to 30 images.",
                                icon: "warning",
                            });
                            return;
                        }
                
                        imageFieldCounts.modal[modalId]++;
                        const container = document.querySelector(`#${modalId} #dynamic-image-fields`);
                
                        const newField = `
                        <div class="mb-3" id="${modalId}-image-field-${imageFieldCounts.modal[modalId]}">
                            <div class="d-flex align-items-center gap-2">
                                <div class="flex-grow-1">
                                    <label for="${modalId}-image${imageFieldCounts.modal[modalId]}" class="form-label">Image ${imageFieldCounts.modal[modalId]}</label>
                                    <input class="form-control" type="file" id="${modalId}-image${imageFieldCounts.modal[modalId]}" 
                                        name="image${imageFieldCounts.modal[modalId]}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                </div>
                                <button type="button" class="btn btn-danger mt-4" onclick="removeModalImageField('${modalId}', ${imageFieldCounts.modal[modalId]})">Remove</button>
                            </div>
                            <div id="${modalId}-preview-${imageFieldCounts.modal[modalId]}" class="mt-2"></div>
                        </div>
                    `;
                        container.insertAdjacentHTML("beforeend", newField);
                
                        // Add preview functionality
                        document.getElementById(`${modalId}-image${imageFieldCounts.modal[modalId]}`).addEventListener("change", function (e) {
                            previewImage(e, modalId, imageFieldCounts.modal[modalId]);
                        });
                    }
                
                    // Function to remove image field from main form
                    function removeImageField(formType, id) {
                        const field = document.getElementById(`${formType}-image-field-${id}`);
                        if (field) {
                            field.remove();
                            reorganizeFields(formType);
                        }
                    }
                
                    // Function to remove image field from modal
                    function removeModalImageField(modalId, id) {
                        const field = document.getElementById(`${modalId}-image-field-${id}`);
                        if (field) {
                            field.remove();
                            reorganizeModalFields(modalId);
                        }
                    }
                
                    // Function to reorganize fields after removal in main form
                    function reorganizeFields(formType) {
                        const container = document.getElementById("dynamic-image-fields");
                        const fields = container.getElementsByClassName("mb-3");
                
                        Array.from(fields).forEach((field, index) => {
                            const newIndex = index + 1;
                            field.id = `${formType}-image-field-${newIndex}`;
                            const input = field.querySelector('input[type="file"]');
                            input.id = `${formType}-image${newIndex}`;
                            input.name = `image${newIndex}`;
                            const label = field.querySelector("label");
                            label.htmlFor = `${formType}-image${newIndex}`;
                            label.textContent = `Image ${newIndex}`;
                        });
                
                        imageFieldCounts[formType] = fields.length;
                    }
                
                    // Function to reorganize fields after removal in modal
                    function reorganizeModalFields(modalId) {
                        const container = document.querySelector(`#${modalId} #dynamic-image-fields`);
                        const fields = container.getElementsByClassName("mb-3");
                
                        Array.from(fields).forEach((field, index) => {
                            const newIndex = index + 1;
                            field.id = `${modalId}-image-field-${newIndex}`;
                            const input = field.querySelector('input[type="file"]');
                            input.id = `${modalId}-image${newIndex}`;
                            input.name = `image${newIndex}`;
                            const label = field.querySelector("label");
                            label.htmlFor = `${modalId}-image${newIndex}`;
                            label.textContent = `Image ${newIndex}`;
                        });
                
                        imageFieldCounts.modal[modalId] = fields.length;
                    }
                
                    // Function to preview image
                    function previewImage(event, formType, id) {
                        const preview = document.getElementById(`${formType}-preview-${id}`);
                        const file = event.target.files[0];
                
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.innerHTML = `
                                <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                                <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                            `;
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                
                    // Initialize when document loads
                    document.addEventListener("DOMContentLoaded", function () {
                        // Initialize main form counter
                        const mainContainer = document.getElementById("dynamic-image-fields");
                        if (mainContainer) {
                            imageFieldCounts.main = mainContainer.querySelectorAll(".mb-3").length;
                        }
                
                        // Initialize modal counters
                        const modals = document.querySelectorAll('[id^="seriesModal-"]');
                        modals.forEach((modal) => {
                            const modalId = modal.id;
                            const modalContainer = modal.querySelector("#dynamic-image-fields");
                            if (modalContainer) {
                                imageFieldCounts.modal[modalId] = modalContainer.querySelectorAll(".mb-3").length;
                            }
                        });
                
                        // Add form submission handler
                        const forms = document.querySelectorAll("form");
                        forms.forEach((form) => {
                            form.addEventListener("submit", function (e) {
                                const loadingOverlay = document.createElement("div");
                                loadingOverlay.style.cssText = "position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;";
                                loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                                document.body.appendChild(loadingOverlay);
                            });
                        });
                    });
                </script>

                             
    
                @elseif($submenu->submenu == 'Study Tour')
                    
                    <div class="page-box">
                        <div class=" ">
                            <form action="{{ route('pages.studytour') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                    
                                <!-- Thumbnail -->
                                <div class="mb-3">
                                    <label for="study_thumbnail" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" id="study_thumbnail" name="thumbnail" aria-label="Thumbnail" required>
                                    <img id="study-thumbnail-preview" src="#" alt="Thumbnail Preview" style="max-width: 100px; display: none; margin-top: 10px;">
                                </div>
                    
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="study_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="study_description" name="description" rows="5" required></textarea>
                                </div>
                    
                                <!-- Container for dynamic image fields -->
                                <div id="study-dynamic-image-fields">
                                    <!-- Existing image fields will be shown here if any -->
                                </div>
                    
                                <button type="button" class="psg-p-btn mb-3" onclick="addStudyImageField()">Add More Images</button><br><br>
                    
                                <!-- Submit Button -->
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                    
                            <span><strong>Update/Delete</strong></span>
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studytour ?? '' as $key => $study)
                                    <tr id="study-row-{{ $study->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="study_image-{{ $study->id }}">
                                            <img src="{{ asset('images/' . $study->thumbnail) }}" alt="Study Tour Image" style="max-width: 100px;" />
                                        </td>
                                        <td id="study_description-{{ $study->id }}">{{ $study->description }}</td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#studyModal-{{ $study->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="studyModal-{{ $study->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Study Tour</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('studytour.update', $study->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                    
                                                                <!-- Description Field -->
                                                                <div class="form-group">
                                                                    <label for="study_description">Description</label>
                                                                    <textarea class="form-control" name="description" id="study_description">{{ $study->description }}</textarea>
                                                                </div>
                    
                                                                <!-- Thumbnail Field -->
                                                                <div class="form-group">
                                                                    <label for="study_thumbnail">Thumbnail</label>
                                                                    <input type="file" class="form-control" name="thumbnail" id="study_thumbnail">
                                                                    @if ($study->thumbnail)
                                                                        <div>
                                                                            <img src="{{ asset('images/' . $study->thumbnail) }}" alt="Thumbnail" width="100">
                                                                            <input type="checkbox" name="remove_thumbnail" value="1"> Remove Thumbnail
                                                                        </div>
                                                                    @endif
                                                                </div>
                    
                                                                <!-- Existing Images -->
                                                                <div id="study-dynamic-image-fields-modal">
                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                        @php
                                                                            $imageField = 'image' . $i;
                                                                        @endphp
                                                                        @if ($study->$imageField)
                                                                            <div class="form-group" id="studyImageField{{$i}}">
                                                                                <label for="study_image{{ $i }}">Image {{ $i }}</label>
                                                                                <input type="file" class="form-control" name="image{{ $i }}" id="study_image{{ $i }}">
                                                                                <div>
                                                                                    <img src="{{ asset('images/' . $study->$imageField) }}" alt="Image {{ $i }}" width="100">
                                                                                    <input type="checkbox" name="remove_image{{ $i }}" value="1"> Remove Image {{ $i }}
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                    
                                                        <!-- Container for dynamic image fields -->
                                                            <div id="study-dynamic-image-fields-model">
                                                                <!-- Existing image fields will be shown here if any -->
                                                            </div>
                                                                <!-- Add More Images Button -->
                                                                <div class="form-group">
                                                                    <button type="button" class="psg-p-btn mb-3" onclick="addStudyModalImageField('studyModal-{{ $study->id }}')">Add More Images</button>
                                                                </div>
                    
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="psg-p-btn">Update</button>
                                                                    <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form id="study_delete-{{ $study->id }}" action="{{ route('studytour.delete', $study->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger" onclick="studyDelete('{{ $study->id }}')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <script>
                    // Track the number of image fields for study tour
                    let studyImageFieldCount = 0;
                    
                    // Function to add image field for study tour
                    function addStudyImageField() {
                        if (studyImageFieldCount >= 30) {
                            Swal.fire({
                                title: 'Maximum Limit Reached',
                                text: 'You can only add up to 30 images.',
                                icon: 'warning'
                            });
                            return;
                        }
                    
                        studyImageFieldCount++;
                        const container = document.getElementById('study-dynamic-image-fields');
                        
                        const newField = `
                            <div class="mb-3" id="study-image-field-${studyImageFieldCount}">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1">
                                        <label for="study_image${studyImageFieldCount}" class="form-label">Image ${studyImageFieldCount}</label>
                                        <input class="form-control" type="file" id="study_image${studyImageFieldCount}" 
                                            name="image${studyImageFieldCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                    </div>
                                    <button type="button" class="btn btn-danger mt-4" onclick="removeStudyImageField(${studyImageFieldCount})">Remove</button>
                                </div>
                                <div id="study-preview-${studyImageFieldCount}" class="mt-2"></div>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', newField);
                    
                        // Add preview functionality
                        document.getElementById(`study_image${studyImageFieldCount}`).addEventListener('change', function(e) {
                            previewStudyImage(e, studyImageFieldCount);
                        });
                    }
                    
                    // Function to remove image field for study tour
                    function removeStudyImageField(id) {
                        const field = document.getElementById(`study-image-field-${id}`);
                        if (field) {
                            field.remove();
                            reorganizeStudyFields();
                        }
                    }
                    
                    // Function to reorganize fields after removal for study tour
                    function reorganizeStudyFields() {
                        const container = document.getElementById('study-dynamic-image-fields');
                        const fields = container.getElementsByClassName('mb-3');
                        
                        Array.from(fields).forEach((field, index) => {
                            const newIndex = index + 1;
                            field.id = `study-image-field-${newIndex}`;
                            const input = field.querySelector('input[type="file"]');
                            input.id = `study_image${newIndex}`;
                            input.name = `image${newIndex}`;
                            const label = field.querySelector('label');
                            label.htmlFor = `study_image${newIndex}`;
                            label.textContent = `Image ${newIndex}`;
                        });
                    
                        studyImageFieldCount = fields.length;
                    }
                    
                    // Function to preview image for study tour
                    function previewStudyImage(event, id) {
                        const preview = document.getElementById(`study-preview-${id}`);
                        const file = event.target.files[0];
                        
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                                    <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                                `;
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                    
                    
                    
                    // Function to add image field in modal for study tour
                    function addStudyModalImageField(modalId) {
                        const container = document.getElementById('study-dynamic-image-fields-modal');
                        const currentFields = container.getElementsByClassName('form-group').length;
                        
                        if (currentFields >= 30) {
                            Swal.fire({
                                title: 'Maximum Limit Reached',
                                text: 'You can only add up to 30 images.',
                                icon: 'warning'
                            });
                            return;
                        }
                    
                        const newIndex = currentFields + 1;
                        const newField = `
                            <div class="form-group" id="studyImageField${newIndex}">
                                <label for="study_image${newIndex}">Image ${newIndex}</label>
                                <input type="file" class="form-control" name="image${newIndex}" id="study_image${newIndex}">
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', newField);
                    }
                    
                    // Function to handle deletion for study tour
                    function studyDelete(studyId) {
                        Swal.fire({
                            title: "Are you sure?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Delete"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById(`study_delete-${studyId}`).submit();
                            }
                        });
                    }
                    
                    // Initialize when document loads
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.getElementById('study-dynamic-image-fields');
                        if (container) {
                            studyImageFieldCount = container.querySelectorAll('.mb-3').length;
                        }
                    
                        // Add form submission handler
                        const form = document.querySelector('form');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const loadingOverlay = document.createElement('div');
                                loadingOverlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;';
                                loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                                document.body.appendChild(loadingOverlay);
                            });
                        }
                    
                        // Add thumbnail preview functionality
                        const thumbnailInput = document.getElementById('study_thumbnail');
                        if (thumbnailInput) {
                            thumbnailInput.addEventListener('change', function(e) {
                                const preview = document.getElementById('study-thumbnail-preview');
                                const file = e.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                    }
                                    reader.readAsDataURL(file);
                                }
                            });
                        }
                    });
                    </script>
                    
                    
                    
                    @elseif($submenu->submenu == 'Site Visits & Field Visits')
                    
                             <div class="page-box">
                  <div class=" ">
                <form action="{{ route('pages.sitefieldvisit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
        
                    <!-- Thumbnail -->
                    <div class="mb-3">
                        <label for="site_thumbnail" class="form-label">Thumbnail</label>
                        <input class="form-control" type="file" id="site_thumbnail" name="thumbnail" aria-label="Thumbnail" required>
                        <img id="site-thumbnail-preview" src="#" alt="Thumbnail Preview" style="max-width: 100px; display: none; margin-top: 10px;">
                    </div>
        
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Description</label>
                        <textarea class="form-control" id="site_description" name="description" rows="5" required></textarea>
                    </div>
        
                    <!-- Container for dynamic image fields -->
                    <div id="site-dynamic-image-fields">
                        <!-- Existing image fields will be shown here if any -->
                    </div>
        
                    <button type="button" class="psg-p-btn mb-3" onclick="addSiteImageField()">Add More Images</button><br><br>
        
                    <!-- Submit Button -->
                    <button type="submit" class="psg-p-btn">Submit</button>
                </form>
        
                <span><strong>Update/Delete</strong></span>
                <table class="table mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sitefieldvisit ?? '' as $key => $site)
                        <tr id="site-row-{{ $site->id }}">
                            <td>{{ $key+1 }}</td>
                            <td id="site_image-{{ $site->id }}">
                                <img src="{{ asset('images/' . $site->thumbnail) }}" alt="Site Visit Image" style="max-width: 100px;" />
                            </td>
                            <td id="site_description-{{ $site->id }}">{{ $site->description }}</td>
                            <td>
                                <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#siteModal-{{ $site->id }}">Edit</button>
                                <!-- Modal -->
                                <div class="modal fade" id="siteModal-{{ $site->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Site Field Visit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('sitefieldvisit.update', $site->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
        
                                                    <!-- Description Field -->
                                                    <div class="form-group">
                                                        <label for="site_description">Description</label>
                                                        <textarea class="form-control" name="description" id="site_description">{{ $site->description }}</textarea>
                                                    </div>
        
                                                    <!-- Thumbnail Field -->
                                                    <div class="form-group">
                                                        <label for="site_thumbnail">Thumbnail</label>
                                                        <input type="file" class="form-control" name="thumbnail" id="site_thumbnail">
                                                        @if ($site->thumbnail)
                                                            <div>
                                                                <img src="{{ asset('images/' . $site->thumbnail) }}" alt="Thumbnail" width="100">
                                                                <input type="checkbox" name="remove_thumbnail" value="1"> Remove Thumbnail
                                                            </div>
                                                        @endif
                                                    </div>
        
                                                    <!-- Existing Images -->
                                                    <div id="site-dynamic-image-fields-modal">
                                                        @for ($i = 1; $i <= 30; $i++)
                                                            @php
                                                                $imageField = 'image' . $i;
                                                            @endphp
                                                            @if ($site->$imageField)
                                                                <div class="form-group" id="siteImageField{{$i}}">
                                                                    <label for="site_image{{ $i }}">Image {{ $i }}</label>
                                                                    <input type="file" class="form-control" name="image{{ $i }}" id="site_image{{ $i }}">
                                                                    <div>
                                                                        <img src="{{ asset('images/' . $site->$imageField) }}" alt="Image {{ $i }}" width="100">
                                                                        <input type="checkbox" name="remove_image{{ $i }}" value="1"> Remove Image {{ $i }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endfor
                                                    </div>
        
                                                    <!-- Add More Images Button -->
                                                    <div class="form-group">
                                                        <button type="button" class="psg-p-btn mb-3" onclick="addSiteModalImageField('siteModal-{{ $site->id }}')">Add More Images</button>
                                                    </div>
        
                                                    <div class="modal-footer">
                                                        <button type="submit" class="psg-p-btn">Update</button>
                                                        <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form id="site_delete-{{ $site->id }}" action="{{ route('sitefieldvisit.delete', $site->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="psg-p-btn btn-danger" onclick="siteDelete('{{ $site->id }}')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <script>
        // Track the number of image fields for site visits
        let siteImageFieldCount = 0;
        
        // Function to add image field for site visits
        function addSiteImageField() {
            if (siteImageFieldCount >= 30) {
                Swal.fire({
                    title: 'Maximum Limit Reached',
                    text: 'You can only add up to 30 images.',
                    icon: 'warning'
                });
                return;
            }
        
            siteImageFieldCount++;
            const container = document.getElementById('site-dynamic-image-fields');
            
            const newField = `
                <div class="mb-3" id="site-image-field-${siteImageFieldCount}">
                    <div class="d-flex align-items-center gap-2">
                        <div class="flex-grow-1">
                            <label for="site_image${siteImageFieldCount}" class="form-label">Image ${siteImageFieldCount}</label>
                            <input class="form-control" type="file" id="site_image${siteImageFieldCount}" 
                                name="image${siteImageFieldCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                        </div>
                        <button type="button" class="btn btn-danger mt-4" onclick="removeSiteImageField(${siteImageFieldCount})">Remove</button>
                    </div>
                    <div id="site-preview-${siteImageFieldCount}" class="mt-2"></div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newField);
        
            // Add preview functionality
            document.getElementById(`site_image${siteImageFieldCount}`).addEventListener('change', function(e) {
                previewSiteImage(e, siteImageFieldCount);
            });
        }
        
        // Function to remove image field for site visits
        function removeSiteImageField(id) {
            const field = document.getElementById(`site-image-field-${id}`);
            if (field) {
                field.remove();
                reorganizeSiteFields();
            }
        }
        
        // Function to reorganize fields after removal for site visits
        function reorganizeSiteFields() {
            const container = document.getElementById('site-dynamic-image-fields');
            const fields = container.getElementsByClassName('mb-3');
            
            Array.from(fields).forEach((field, index) => {
                const newIndex = index + 1;
                field.id = `site-image-field-${newIndex}`;
                const input = field.querySelector('input[type="file"]');
                input.id = `site_image${newIndex}`;
                input.name = `image${newIndex}`;
                const label = field.querySelector('label');
                label.htmlFor = `site_image${newIndex}`;
                label.textContent = `Image ${newIndex}`;
            });
        
            siteImageFieldCount = fields.length;
        }
        
        // Function to preview image for site visits
        function previewSiteImage(event, id) {
            const preview = document.getElementById(`site-preview-${id}`);
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                        <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                    `;
                }
                reader.readAsDataURL(file);
            }
        }
        
        // Function to add image field in modal for site visits
        function addSiteModalImageField(modalId) {
            const container = document.getElementById('site-dynamic-image-fields-modal');
            const currentFields = container.getElementsByClassName('form-group').length;
            
            if (currentFields >= 30) {
                Swal.fire({
                    title: 'Maximum Limit Reached',
                    text: 'You can only add up to 30 images.',
                    icon: 'warning'
                });
                return;
            }
        
            const newIndex = currentFields + 1;
            const newField = `
                <div class="form-group" id="siteImageField${newIndex}">
                    <label for="site_image${newIndex}">Image ${newIndex}</label>
                    <input type="file" class="form-control" name="image${newIndex}" id="site_image${newIndex}">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newField);
        }
        
        // Function to handle deletion for site visits
        function siteDelete(siteId) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`site_delete-${siteId}`).submit();
                }
            });
        }
        
        // Initialize when document loads
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('site-dynamic-image-fields');
            if (container) {
                siteImageFieldCount = container.querySelectorAll('.mb-3').length;
            }
        
            // Add form submission handler
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const loadingOverlay = document.createElement('div');
                    loadingOverlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;';
                    loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                    document.body.appendChild(loadingOverlay);
                });
            }
        
            // Add thumbnail preview functionality
            const thumbnailInput = document.getElementById('site_thumbnail');
            if (thumbnailInput) {
                thumbnailInput.addEventListener('change', function(e) {
                    const preview = document.getElementById('site-thumbnail-preview');
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
        </script>
                    
                    @elseif($submenu->submenu == 'NASA')
                    
                                 <!-- Discovery Gallery Form -->
                <div class="page-box">
                    <div class=" ">
                        <form action="{{ route('pages.nasa') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Thumbnail -->
                            <div class="mb-3">
                                <label for="discovery_thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="discovery_thumbnail" name="thumbnail" aria-label="Thumbnail" required>
                                <img id="discovery-thumbnail-preview" src="#" alt="Thumbnail Preview" style="max-width: 100px; display: none; margin-top: 10px;">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="discovery_description" class="form-label">Description</label>
                                <textarea class="form-control" id="discovery_description" name="description" rows="5" required></textarea>
                            </div>

                            <!-- Container for dynamic image fields -->
                            <div id="discovery-dynamic-image-fields">
                                <!-- Existing image fields will be shown here if any -->
                            </div>

                            <button type="button" class="psg-p-btn mb-3" onclick="addDiscoveryImageField()">Add More Images</button><br><br>

                            <!-- Submit Button -->
                            <button type="submit" class="psg-p-btn">Submit</button>
                        </form>

                        <span><strong>Update/Delete</strong></span>
                        <table class="table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.no</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nasas ?? '' as $key => $disc)
                                <tr id="discovery-row-{{ $disc->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td id="discovery_image-{{ $disc->id }}">
                                        <img src="{{ asset('images/' . $disc->thumbnail) }}" alt="Discovery Gallery Image" style="max-width: 100px;" />
                                    </td>
                                    <td id="discovery_description-{{ $disc->id }}">{{ $disc->description }}</td>
                                    <td>
                                        <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#discoveryModal-{{ $disc->id }}">Edit</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="discoveryModal-{{ $disc->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Discovery Gallery</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('nasa.update', $disc->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Description Field -->
                                                            <div class="form-group">
                                                                <label for="discovery_description">Description</label>
                                                                <textarea class="form-control" name="description" id="discovery_description">{{ $disc->description }}</textarea>
                                                            </div>

                                                            <!-- Thumbnail Field -->
                                                            <div class="form-group">
                                                                <label for="discovery_thumbnail">Thumbnail</label>
                                                                <input type="file" class="form-control" name="thumbnail" id="discovery_thumbnail">
                                                                @if ($disc->thumbnail)
                                                                    <div>
                                                                        <img src="{{ asset('images/' . $disc->thumbnail) }}" alt="Thumbnail" width="100">
                                                                        <input type="checkbox" name="remove_thumbnail" value="1"> Remove Thumbnail
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- Existing Images -->
                                                            <div id="discovery-dynamic-image-fields-modal">
                                                                @for ($i = 1; $i <= 30; $i++)
                                                                    @php
                                                                        $imageField = 'image' . $i;
                                                                    @endphp
                                                                    @if ($disc->$imageField)
                                                                        <div class="form-group" id="discoveryImageField{{$i}}">
                                                                            <label for="discovery_image{{ $i }}">Image {{ $i }}</label>
                                                                            <input type="file" class="form-control" name="image{{ $i }}" id="discovery_image{{ $i }}">
                                                                            <div>
                                                                                <img src="{{ asset('images/' . $disc->$imageField) }}" alt="Image {{ $i }}" width="100">
                                                                                <input type="checkbox" name="remove_image{{ $i }}" value="1"> Remove Image {{ $i }}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endfor
                                                            </div>

                                                            <!-- Add More Images Button -->
                                                            <div class="form-group">
                                                                <button type="button" class="psg-p-btn mb-3" onclick="addDiscoveryModalImageField('discoveryModal-{{ $disc->id }}')">Add More Images</button>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="psg-p-btn">Update</button>
                                                                <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form id="discovery_delete-{{ $disc->id }}" action="{{ route('nasa.delete', $disc->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="discoveryDelete('{{ $disc->id }}')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

<script>
// Track the number of image fields for discovery gallery
let discoveryImageFieldCount = 0;

// Function to add image field for discovery gallery
function addDiscoveryImageField() {
    if (discoveryImageFieldCount >= 30) {
        Swal.fire({
            title: 'Maximum Limit Reached',
            text: 'You can only add up to 30 images.',
            icon: 'warning'
        });
        return;
    }

    discoveryImageFieldCount++;
    const container = document.getElementById('discovery-dynamic-image-fields');
    
    const newField = `
        <div class="mb-3" id="discovery-image-field-${discoveryImageFieldCount}">
            <div class="d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <label for="discovery_image${discoveryImageFieldCount}" class="form-label">Image ${discoveryImageFieldCount}</label>
                    <input class="form-control" type="file" id="discovery_image${discoveryImageFieldCount}" 
                        name="image${discoveryImageFieldCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                </div>
                <button type="button" class="btn btn-danger mt-4" onclick="removeDiscoveryImageField(${discoveryImageFieldCount})">Remove</button>
            </div>
            <div id="discovery-preview-${discoveryImageFieldCount}" class="mt-2"></div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newField);

    // Add preview functionality
    document.getElementById(`discovery_image${discoveryImageFieldCount}`).addEventListener('change', function(e) {
        previewDiscoveryImage(e, discoveryImageFieldCount);
    });
}

// Function to remove image field for discovery gallery
function removeDiscoveryImageField(id) {
    const field = document.getElementById(`discovery-image-field-${id}`);
    if (field) {
        field.remove();
        reorganizeDiscoveryFields();
    }
}

// Function to reorganize fields after removal
function reorganizeDiscoveryFields() {
    const container = document.getElementById('discovery-dynamic-image-fields');
    const fields = container.getElementsByClassName('mb-3');
    
    Array.from(fields).forEach((field, index) => {
        const newIndex = index + 1;
        field.id = `discovery-image-field-${newIndex}`;
        const input = field.querySelector('input[type="file"]');
        input.id = `discovery_image${newIndex}`;
        input.name = `image${newIndex}`;
        const label = field.querySelector('label');
        label.htmlFor = `discovery_image${newIndex}`;
        label.textContent = `Image ${newIndex}`;
    });

    discoveryImageFieldCount = fields.length;
}

// Function to preview image
function previewDiscoveryImage(event, id) {
    const preview = document.getElementById(`discovery-preview-${id}`);
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
            `;
        }
        reader.readAsDataURL(file);
    }
}

// Function to add image field in modal
function addDiscoveryModalImageField(modalId) {
    const container = document.getElementById('discovery-dynamic-image-fields-modal');
    const currentFields = container.getElementsByClassName('form-group').length;
    
    if (currentFields >= 30) {
        Swal.fire({
            title: 'Maximum Limit Reached',
            text: 'You can only add up to 30 images.',
            icon: 'warning'
        });
        return;
    }

    const newIndex = currentFields + 1;
    const newField = `
        <div class="form-group" id="discoveryImageField${newIndex}">
            <label for="discovery_image${newIndex}">Image ${newIndex}</label>
            <input type="file" class="form-control" name="image${newIndex}" id="discovery_image${newIndex}">
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newField);
}

// Function to handle deletion
function discoveryDelete(discoveryId) {
    Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`discovery_delete-${discoveryId}`).submit();
        }
    });
}

// Initialize when document loads
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('discovery-dynamic-image-fields');
    if (container) {
        discoveryImageFieldCount = container.querySelectorAll('.mb-3').length;
    }

    // Add form submission handler
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const loadingOverlay = document.createElement('div');
            loadingOverlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;';
            loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
            document.body.appendChild(loadingOverlay);
        });
    }

    // Add thumbnail preview functionality
    const thumbnailInput = document.getElementById('discovery_thumbnail');
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            const preview = document.getElementById('discovery-thumbnail-preview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
                    
                    @elseif($submenu->submenu == 'Symposium')
                    
                                   
                    <div class="page-box">
                        <div class=" ">
                            <form action="{{ route('pages.Symposium') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                    
                                <!-- Thumbnail -->
                                <div class="mb-3">
                                    <label for="space_exhibit_thumbnail" class="form-label"> Thumbnail</label>
                                    <input class="form-control" type="file" id="space_exhibit_thumbnail" name="thumbnail" aria-label="Thumbnail" required>
                                    <img id="space-exhibit-thumbnail-preview" src="#" alt="Exhibit Preview" style="max-width: 100px; display: none; margin-top: 10px;">
                                </div>
                    
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="space_exhibit_description" class="form-label"> Description</label>
                                    <textarea class="form-control" id="space_exhibit_description" name="description" rows="5" required></textarea>
                                </div>
                    
                         
                                <div id="space-exhibit-dynamic-image-fields">
                               
                                </div>
                    
                                <button type="button" class="psg-p-btn mb-3" onclick="addSpaceExhibitImage()">Add More  Images</button><br><br>
                    
                                <!-- Submit Button -->
                                <button type="submit" class="psg-p-btn">Submit </button>
                            </form>
                    
                            <span><strong>Manage </strong></span>
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th> Image</th>
                                        <th> Details</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Symposium ?? '' as $key => $exhibit)
                                    <tr id="space-exhibit-row-{{ $exhibit->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="space_exhibit_image-{{ $exhibit->id }}">
                                            <img src="{{ asset('images/' . $exhibit->thumbnail) }}" alt="Space Exhibit Image" style="max-width: 100px;" />
                                        </td>
                                        <td id="space_exhibit_description-{{ $exhibit->id }}">{{ $exhibit->description }}</td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#spaceExhibitModal-{{ $exhibit->id }}">
                                                Edit
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="spaceExhibitModal-{{ $exhibit->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Update </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('Symposium.update', $exhibit->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                    
                                                                <!-- Description Field -->
                                                                <div class="form-group mb-4">
                                                                    <label for="space_exhibit_description"> Description</label>
                                                                    <textarea class="form-control" name="description" id="space_exhibit_description">{{ $exhibit->description }}</textarea>
                                                                </div>
                    
                                                                <!-- Thumbnail Field -->
                                                                <div class="form-group mb-4">
                                                                    <label for="space_exhibit_thumbnail"> Thumbnail</label>
                                                                    <input type="file" class="form-control" name="thumbnail" id="space_exhibit_thumbnail">
                                                                    @if ($exhibit->thumbnail)
                                                                        <div class="mt-2">
                                                                            <img src="{{ asset('images/' . $exhibit->thumbnail) }}" alt="Current Thumbnail" width="100">
                                                                            <div class="form-check mt-2">
                                                                                <input type="checkbox" class="form-check-input" name="remove_thumbnail" value="1" id="remove_thumbnail_{{ $exhibit->id }}">
                                                                                <label class="form-check-label" for="remove_thumbnail_{{ $exhibit->id }}">Remove Current Thumbnail</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                    
                                                                <!-- Additional Images -->
                                                                <div id="space-exhibit-image-fields-modal">
                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                        @php
                                                                            $imageField = 'image' . $i;
                                                                        @endphp
                                                                        @if ($exhibit->$imageField)
                                                                            <div class="form-group mb-3" id="spaceExhibitImage{{$i}}">
                                                                                <label for="space_exhibit_image{{ $i }}"> Image {{ $i }}</label>
                                                                                <input type="file" class="form-control" name="image{{ $i }}" id="space_exhibit_image{{ $i }}">
                                                                                <div class="mt-2">
                                                                                    <img src="{{ asset('images/' . $exhibit->$imageField) }}" alt="Image {{ $i }}" width="100">
                                                                                    <div class="form-check mt-2">
                                                                                        <input type="checkbox" class="form-check-input" name="remove_image{{ $i }}" value="1" id="remove_image{{ $i }}_{{ $exhibit->id }}">
                                                                                        <label class="form-check-label" for="remove_image{{ $i }}_{{ $exhibit->id }}">Remove This Image</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                    
                                                                <!-- Add More Images Button -->
                                                                <div class="form-group mb-4">
                                                                    <button type="button" class="psg-p-btn" onclick="addSpaceExhibitModalImage('spaceExhibitModal-{{ $exhibit->id }}')">
                                                                        Add More Images
                                                                    </button>
                                                                </div>
                    
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="psg-p-btn">Update</button>
                                                                    <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form id="space_exhibit_delete-{{ $exhibit->id }}" action="{{ route('Symposium.delete', $exhibit->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" onclick="deleteSpaceExhibit('{{ $exhibit->id }}')">
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
                    
                    <script>
                    let spaceExhibitImageCount = 0;
                    
                    function addSpaceExhibitImage() {
                        if (spaceExhibitImageCount >= 30) {
                            Swal.fire({
                                title: 'Maximum Limit Reached',
                                text: 'You can only add up to 30 images per exhibit.',
                                icon: 'warning'
                            });
                            return;
                        }
                    
                        spaceExhibitImageCount++;
                        const container = document.getElementById('space-exhibit-dynamic-image-fields');
                        
                        const newField = `
                            <div class="mb-3" id="space-exhibit-image-field-${spaceExhibitImageCount}">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1">
                                        <label for="space_exhibit_image${spaceExhibitImageCount}" class="form-label">Exhibit Image ${spaceExhibitImageCount}</label>
                                        <input class="form-control" type="file" id="space_exhibit_image${spaceExhibitImageCount}" 
                                            name="image${spaceExhibitImageCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                    </div>
                                    <button type="button" class="btn btn-danger mt-4" onclick="removeSpaceExhibitImage(${spaceExhibitImageCount})">Remove</button>
                                </div>
                                <div id="space-exhibit-preview-${spaceExhibitImageCount}" class="mt-2"></div>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', newField);
                    
                        document.getElementById(`space_exhibit_image${spaceExhibitImageCount}`).addEventListener('change', function(e) {
                            previewSpaceExhibitImage(e, spaceExhibitImageCount);
                        });
                    }
                    
                    function removeSpaceExhibitImage(id) {
                        const field = document.getElementById(`space-exhibit-image-field-${id}`);
                        if (field) {
                            field.remove();
                            reorganizeSpaceExhibitFields();
                        }
                    }
                    
                    function reorganizeSpaceExhibitFields() {
                        const container = document.getElementById('space-exhibit-dynamic-image-fields');
                        const fields = container.getElementsByClassName('mb-3');
                        
                        Array.from(fields).forEach((field, index) => {
                            const newIndex = index + 1;
                            field.id = `space-exhibit-image-field-${newIndex}`;
                            const input = field.querySelector('input[type="file"]');
                            input.id = `space_exhibit_image${newIndex}`;
                            input.name = `image${newIndex}`;
                            const label = field.querySelector('label');
                            label.htmlFor = `space_exhibit_image${newIndex}`;
                            label.textContent = `Exhibit Image ${newIndex}`;
                        });
                    
                        spaceExhibitImageCount = fields.length;
                    }
                    
                    function previewSpaceExhibitImage(event, id) {
                        const preview = document.getElementById(`space-exhibit-preview-${id}`);
                        const file = event.target.files[0];
                        
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                                    <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                                `;
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                    
                    function addSpaceExhibitModalImage(modalId) {
                        const container = document.getElementById('space-exhibit-image-fields-modal');
                        const currentFields = container.getElementsByClassName('form-group').length;
                        
                        if (currentFields >= 30) {
                            Swal.fire({
                                title: 'Maximum Limit Reached',
                                text: 'You can only add up to 30 images per exhibit.',
                                icon: 'warning'
                            });
                            return;
                        }
                    
                        const newIndex = currentFields + 1;
                        const newField = `
                            <div class="form-group mb-3" id="spaceExhibitImage${newIndex}">
                                <label for="space_exhibit_image${newIndex}">Exhibit Image ${newIndex}</label>
                                <input type="file" class="form-control" name="image${newIndex}" id="space_exhibit_image${newIndex}">
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', newField);
                    }
                    
                    function deleteSpaceExhibit(exhibitId) {
                        Swal.fire({
                            title: "Delete ?",
                        
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#6c757d",
                            confirmButtonText: "Yes, remove it",
                            cancelButtonText: "Cancel"
                        }).then((result) => {     
                            if (result.isConfirmed) {
                                document.getElementById(`space_exhibit_delete-${exhibitId}`).submit();
                            }
                        });
                    }
                    
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.getElementById('space-exhibit-dynamic-image-fields');
                        if (container) {
                            spaceExhibitImageCount = container.querySelectorAll('.mb-3').length;
                        }
                    
                        const form = document.querySelector('form');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const loadingOverlay = document.createElement('div');
                                loadingOverlay.style.cssText = `
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: rgba(0,0,0,0.5);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    z-index: 9999;
                                `;
                                loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                                document.body.appendChild(loadingOverlay);
                            });
                        }
                    
                        const thumbnailInput = document.getElementById('space_exhibit_thumbnail');
                        if (thumbnailInput) {
                            thumbnailInput.addEventListener('change', function(e) {
                                const preview = document.getElementById('space-exhibit-thumbnail-preview');
                                const file = e.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                    }
                                    reader.readAsDataURL(file);
                                }
                            });
                        }
                    });
                    </script>

                    
                    
                    @elseif($submenu->submenu == 'Editorial')
                    <button style="background-color: #4CAF50; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                        <a href="{{ route('menu-editoriol.index') }}" style="color: white; text-decoration: none; font-weight: bold;">Editorial</a>
                    </button>

                    
                    
                    
                @elseif($submenu->submenu == 'Clubs')

    
                    <div class="page-box">
                        <div class=" ">

                            <form action="{{ route('pages.clubs-heading') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" id="title" name="title" rows="5" required>
                                </div>
                    
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>


                            <hr />
                            <div class="container mt-4">
                                <h5 class="text-primary">List</h5>
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
                                        @forelse ($ClubsHedings as $index => $item)

                                        <tr id="menu-item-{{ $item->id }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-center">
                                                <button class="psg-p-btn btn-warning edit-button" data-id="{{ $item->id }}" data-title="{{ $item->title }}"><i class="bi bi-pencil-square"></i> Edit</button>
                                            </td>
                                            <td>
                                                <form id="Menu-{{ $item->id }}" action="{{ route('clubs-heading.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="psg-p-btn btn-danger" onclick="SectionDeleteClubs('{{ $item->id }}')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No menu items found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Menu Title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="editForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editTitle" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="editTitle" name="title" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="psg-p-btn">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <hr />

                            <hr>



                        <form action="{{ route('pages.clubs') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="clubs_id">Select Title</label>
                                    <select class="form-control" id="clubs_id" name="clubs_id" required>
                                        <option value="">Choose a title</option>
                                        @foreach($ClubsHedings as $title)
                                        <option value="{{ $title->id }}">{{ $title->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="event_thumbnail" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" id="event_thumbnail" name="thumbnail" aria-label="Thumbnail" required />
                                    <img id="event-thumbnail-preview" src="#" alt="Thumbnail Preview" style="max-width: 100px; display: none; margin-top: 10px;" />
                                </div>
                    
                
                                <div class="mb-3">
                                    <label for="event_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="event_description" name="description" rows="5" required></textarea>
                                </div>
                    

                                <div id="event-dynamic-image-fields">
     
                                </div>
                    
                                <button type="button" class="psg-p-btn mb-3" onclick="addEventImageField()">Add More Images</button><br />
                                <br />
                    
                                <!-- Submit Button -->
                                <button type="submit" class="psg-p-btn">Submit</button>
                            </form>
                    
                            <span><strong>Update/Delete</strong></span>
                            
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th>Thumbnail</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Clubs ?? [] as $key => $event)
                                    <tr id="event-row-{{ $event->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $ClubsHedings->firstWhere('id', $event->clubs_id)->title ?? 'N/A' }}</td>
                                        <td>
                                            @if ($event->thumbnail)
                                            <img src="{{ asset('images/' . $event->thumbnail) }}" alt="Event Thumbnail" style="max-width: 100px;" />
                                            @else
                                            <span>No Thumbnail</span>
                                            @endif
                                        </td>
                                        <td>{{ $event->description }}</td>
                                        <td>
                                            <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#editModal-{{ $event->id }}">
                                                Edit
                                            </button>
                            
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal-{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Event</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('clubs.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <!-- Title Field -->
                                                                <div class="form-group mb-3">
                                                                    <label for="title-{{ $event->id }}">Title</label>
                                                                    <select class="form-select" name="clubs_id" id="title-{{ $event->id }}">
                                                                        @foreach($ClubsHedings as $title)
                                                                        <option value="{{ $title->id }}" {{ $event->clubs_id == $title->id ? 'selected' : '' }}>
                                                                            {{ $title->title }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                            
                                                                <!-- Description Field -->
                                                                <div class="form-group mb-3">
                                                                    <label for="description-{{ $event->id }}">Description</label>
                                                                    <textarea class="form-control" name="description" id="description-{{ $event->id }}" rows="3">{{ $event->description }}</textarea>
                                                                </div>
                            
                                                                <!-- Thumbnail Field -->
                                                                <div class="form-group mb-3">
                                                                    <label for="thumbnail-{{ $event->id }}">Thumbnail</label>
                                                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail-{{ $event->id }}">
                                                                    @if ($event->thumbnail)
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset('images/' . $event->thumbnail) }}" alt="Thumbnail" width="100">
                                                                        <input type="checkbox" name="remove_thumbnail" value="1"> Remove Thumbnail
                                                                    </div>
                                                                    @endif
                                                                </div>
                            
                                                                <!-- Dynamic Images -->
                                                                <div id="dynamic-images-{{ $event->id }}">
                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                    @php $imageField = 'image' . $i; @endphp
                                                                    @if ($event->$imageField)
                                                                    <div class="form-group mb-3" id="image-field-{{ $event->id }}-{{ $i }}">
                                                                        <label for="image{{ $i }}-{{ $event->id }}">Image {{ $i }}</label>
                                                                        <input type="file" class="form-control" name="image{{ $i }}" id="image{{ $i }}-{{ $event->id }}">
                                                                        <div class="mt-2">
                                                                            <img src="{{ asset('images/' . $event->$imageField) }}" alt="Image {{ $i }}" width="100">
                                                                            <input type="checkbox" name="remove_image-clubs{{ $i }}" value="1"> Remove Image {{ $i }}
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @endfor
                                                                </div>
                            
                                                                <!-- Add More Images -->
                                                                <div class="form-group">
                                                                    <button type="button" class="psg-p-btn" onclick="addImageField('dynamic-images-{{ $event->id }}')">Add More Images</button>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                                                <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form id="delete-form-{{ $event->id }}" action="{{ route('clubs.delete', $event->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" onclick="SectionDeleteClubsMain('{{ $event->id }}')">Delete</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            
                        </div>
                    </div>


                    <script>

                        function addImageField(containerId) {
                            const container = document.getElementById(containerId);
                            const fieldCount = container.querySelectorAll('.form-group').length + 1;

                            if (fieldCount <= 30) {
                                const div = document.createElement('div');
                                div.classList.add('form-group', 'mb-3');
                                div.id = `new-image-field-${fieldCount}`;
                                div.innerHTML = `
                                    <label for="new_image${fieldCount}">Image ${fieldCount}</label>
                                    <input type="file" class="form-control" name="new_image${fieldCount}" id="new_image${fieldCount}">
                                    <button type="button" class="btn btn-danger mt-2" onclick="removeImageField('new-image-field-${fieldCount}')">Remove</button>
                                `;
                                container.appendChild(div);
                            } else {
                                alert('You can add up to 30 images only.');
                            }
                        }

                        function removeImageField(fieldId) {
                            document.getElementById(fieldId).remove();
                        }

                    </script>


                         <script>
                           function SectionDeleteClubs(itemId) {
                                Swal.fire({
                                    title: "Are you sure?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Delete",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById(`Menu-${itemId}`).submit();
                                    }
                                });
                            }
                           </script>


                         <script>

                        function SectionDeleteClubsMain(eventId) {
                            Swal.fire({
                                title: "Are you sure?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Delete",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById(`delete-form-${eventId}`).submit();
                                }
                            });
                        }

                           </script>

                       <script>

                    document.addEventListener('DOMContentLoaded', function () {
                        const editButtons = document.querySelectorAll('.edit-button');
                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        const editForm = document.getElementById('editForm');
                        const editTitleInput = document.getElementById('editTitle');

                        editButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const id = this.getAttribute('data-id');
                                const title = this.getAttribute('data-title');

                                // Set the form action dynamically
                                editForm.action = `/clubs-heading/${id}`;
                                editTitleInput.value = title;

                                // Open the modal
                                editModal.show();
                            });
                        });
                    });

                </script>
                    
                    <script>
                 
                        let eventImageFieldCount = 0;
                
                        function addEventImageField() {
                            if (eventImageFieldCount >= 30) {
                                Swal.fire({
                                    title: "Maximum Limit Reached",
                                    text: "You can only add up to 30 images.",
                                    icon: "warning",
                                });
                                return;
                            }
                    
                            eventImageFieldCount++;
                            const container = document.getElementById("event-dynamic-image-fields");
                    
                            const newField = `
                                                <div class="mb-3" id="event-image-field-${eventImageFieldCount}">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-grow-1">
                                                            <label for="event_image${eventImageFieldCount}" class="form-label">Image ${eventImageFieldCount}</label>
                                                            <input class="form-control" type="file" id="event_image${eventImageFieldCount}" 
                                                                name="image${eventImageFieldCount}" accept="image/jpeg,image/webp,image/jpg,image/gif">
                                                        </div>
                                                        <button type="button" class="btn btn-danger mt-4" onclick="removeEventImageField(${eventImageFieldCount})">Remove</button>
                                                    </div>
                                                    <div id="event-preview-${eventImageFieldCount}" class="mt-2"></div>
                                                </div>
                                            `;
                            container.insertAdjacentHTML("beforeend", newField);

                            document.getElementById(`event_image${eventImageFieldCount}`).addEventListener("change", function (e) {
                                previewEventImage(e, eventImageFieldCount);
                            });
                        }
                    
                        function removeEventImageField(id) {
                            const field = document.getElementById(`event-image-field-${id}`);
                            if (field) {
                                field.remove();
                                reorganizeEventFields();
                            }
                        }
                    

                        function reorganizeEventFields() {
                            const container = document.getElementById("event-dynamic-image-fields");
                            const fields = container.getElementsByClassName("mb-3");
                    
                            Array.from(fields).forEach((field, index) => {
                                const newIndex = index + 1;
                                field.id = `event-image-field-${newIndex}`;
                                const input = field.querySelector('input[type="file"]');
                                input.id = `event_image${newIndex}`;
                                input.name = `image${newIndex}`;
                                const label = field.querySelector("label");
                                label.htmlFor = `event_image${newIndex}`;
                                label.textContent = `Image ${newIndex}`;
                            });
                    
                            eventImageFieldCount = fields.length;
                        }
                    
                        function previewEventImage(event, id) {
                            const preview = document.getElementById(`event-preview-${id}`);
                            const file = event.target.files[0];
                    
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    preview.innerHTML = `
                                                        <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-top: 10px;">
                                                        <div class="mt-1 text-muted small">Size: ${(file.size / 1024).toFixed(2)} KB</div>
                                                    `;
                                };
                                reader.readAsDataURL(file);
                            }
                        }

                        function addEventModalImageField(modalId) {
                            const container = document.getElementById("event-dynamic-image-fields-modal");
                            const currentFields = container.getElementsByClassName("form-group").length;
                    
                            if (currentFields >= 30) {
                                Swal.fire({
                                    title: "Maximum Limit Reached",
                                    text: "You can only add up to 30 images.",
                                    icon: "warning",
                                });
                                return;
                            }
                    
                            const newIndex = currentFields + 1;
                            const newField = `
                                                <div class="form-group" id="eventImageField${newIndex}">
                                                    <label for="event_image${newIndex}">Image ${newIndex}</label>
                                                    <input type="file" class="form-control" name="image${newIndex}" id="event_image${newIndex}">
                                                </div>
                                            `;
                            container.insertAdjacentHTML("beforeend", newField);
                        }
                    
 

                        document.addEventListener("DOMContentLoaded", function () {
                            const container = document.getElementById("event-dynamic-image-fields");
                            if (container) {
                                eventImageFieldCount = container.querySelectorAll(".mb-3").length;
                            }
                    
                            const form = document.querySelector("form");
                            if (form) {
                                form.addEventListener("submit", function (e) {
                                    const loadingOverlay = document.createElement("div");
                                    loadingOverlay.style.cssText = "position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;";
                                    loadingOverlay.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                                    document.body.appendChild(loadingOverlay);
                                });
                            }
                    
                            const thumbnailInput = document.getElementById("event_thumbnail");
                            if (thumbnailInput) {
                                thumbnailInput.addEventListener("change", function (e) {
                                    const preview = document.getElementById("event-thumbnail-preview");
                                    const file = e.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            preview.src = e.target.result;
                                            preview.style.display = "block";
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });
                            }
                        });
                    </script>
                                       

      
                    
                    @elseif($submenu->submenu == 'Exam Cell')
                    
                    <div class="page-box">
                    <div class=" ">
                    <!-- Add Section Form -->
                 
                   <button class="psg-p-btn"><a href="{{ route('examcell-about')}}" style="color: white;text-decoration: auto;">About</a></button>
                   <button class="psg-p-btn"><a href="{{ route('examcell-people')}}" style="color: white;text-decoration: auto;">People</a></button>
                   <button class="psg-p-btn"><a href="{{ route('examcell-university')}}" style="color: white;text-decoration: auto;">University</a></button>
                   <button class="psg-p-btn"><a href="{{ route('examcell-usefulllinks')}}" style="color: white;text-decoration: auto;">UseFull Links</a></button>
                   <button class="psg-p-btn"><a href="{{ route('internal-circulars')}}" style="color: white;text-decoration: auto;">Internal Circulars</a></button>
                   <button class="psg-p-btn"><a href="{{ route('annauniversity-circulars')}}" style="color: white;text-decoration: auto;">Anna University Circulars</a></button>
              
            
                   
        
                </div>
            </div>
                    @elseif($submenu->submenu == 'Library')
                    
                  
  <div class="page-box">
            <div class=" ">
                <h5 class="card-title">Library</h5>
                <hr />
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Add Sections
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('library.section') }}" method="POST">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" />
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <button type="submit" class="psg-p-btn">Submit</button>
                                </form>

                                <span><strong>Update/Delete</strong></span>
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($library ?? '' as $key => $section)
                                        <tr id="row-{{ $section->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td id="name-{{ $section->id }}">{{ $section->name }}</td>

                                            <td>
                                                <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#sympModal-{{ $section->id }}">Edit</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="sympModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Section</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('library.update', $section->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}" />
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="psg-p-btn">Update</button>
                                                                        <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form id="sectiondeletelibrary" action="{{ route('library.delete', $section->id) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="psg-p-btn btn-danger" onclick="SectionDelete1('{{ $section->id }}')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <script>
                                    function SectionDelete1(sectionId) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Delete",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById("sectiondeletelibrary").action = "{{ route('library.delete', ':id') }}".replace(":id", sectionId);
                                                document.getElementById("sectiondeletelibrary").submit();
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Library
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('library.store') }}" method="POST">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="section_id">Select Section</label>
                                                <select class="form-control" name="section_id">
                                                    <option value="">Select Menu</option>
                                                    @foreach($library as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description">Descriptions</label>
                                                <div id="description-repeater-library">
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="description[]" class="form-control" placeholder="Enter description" />
                                                        <button type="button" class="btn btn-danger lib-remove-description">Remove</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-success" id="add-description-library">Add Description</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <button type="submit" class="psg-p-btn">Submit</button>
                                </form>

                                <script>
                                    document.getElementById("add-description-library").addEventListener("click", function () {
                                        var repeater = document.getElementById("description-repeater-library");
                                        var newInputGroup = document.createElement("div");
                                        newInputGroup.className = "input-group mb-2";
                                        newInputGroup.innerHTML = `
                                                <input type="text" name="description[]" class="form-control" placeholder="Enter description">
                                                <button type="button" class="btn btn-danger lib-remove-description">Remove</button>
                                            `;
                                        repeater.appendChild(newInputGroup);
                                    });

                                    document.addEventListener("click", function (e) {
                                        if (e.target && e.target.classList.contains("lib-remove-description")) {
                                            e.target.closest(".input-group").remove();
                                        }
                                    });
                                </script>

                                <!-- Button to Trigger Modal for Editing -->
                                <span><strong>Update/Delete</strong></span>
                                <button type="button" class="psg-p-btn float-end" id="edit-section-btn-library" data-bs-toggle="modal" data-bs-target="#editSecModal">
                                    Edit and Add Contents
                                </button>

                                <!-- Table Displaying IQAC Sections -->
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Section</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($library as $key => $content)
                                        <tr id="row-{{ $content->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td id="name-{{ $content->id }}">{{ $content->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Edit Section Modal -->

                            <div class="modal fade" id="editSecModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            
                                           <div class="modal-body">
                                               
                                      <div class="modal-body">
                                            <form action="{{ route('librarycontent.update', ['id' => 0]) }}" method="POST" id="editSectionForm-lib">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="section_id" id="edit_section_id" />
                                                <div class="mb-3">
                                                    <label for="edit_sec_select">Select Section</label>
                                                    <select class="form-control" name="section_id" id="edit_sec_select">
                                                        <option value="">Select Section</option>
                                                        @foreach($library as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span style="color: red;">
                                                        <p>Note: Select a Section To Edit Content</p>
                                                    </span>
                                                </div>
                                        
                                                <div class="mb-3">
                                                    <label for="edit_description">Descriptions</label>
                                                    <div id="edit_desc_repeater"></div>
                                                    <button type="button" class="btn btn-success" id="adddescription">Add Description</button>
                                                </div>
                                                <button type="submit" class="psg-p-btn">Update</button>
                                            </form>
                                        </div>
                                            
                                        </div>
                                        </div>
                                    </div>
                            </div>



                            <!-- JavaScript -->

                      <script>
                   
                         // Function to add a new description input
                            function addDescriptionInput(value = '') {
                                const repeater = document.getElementById('edit_desc_repeater');
                                const uniqueId = 'desc_' + Date.now(); // Generate a unique ID for each input group
                                const inputGroup = document.createElement('div');
                                inputGroup.className = 'input-group mb-2 description-group';
                                inputGroup.id = uniqueId;
                                inputGroup.innerHTML = `
                                    <input type="text" name="description[]" class="form-control" value="${value}" placeholder="Enter description">
                                    <button type="button" class="btn btn-danger lib-remove-description" data-id="${uniqueId}">Remove</button>
                                `;
                                repeater.appendChild(inputGroup);
                            }
                        
                            // Load descriptions when a section is selected
                            document.getElementById('edit_sec_select').addEventListener('change', function () {
                                const libraryId = this.value;
                                const descriptionRepeater = document.getElementById('edit_desc_repeater');
                                descriptionRepeater.innerHTML = ''; // Clear previous descriptions
                        
                                if (libraryId) {
                                    fetch('{{ route('library.get-descriptions') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ section_id: libraryId })
                                    })
                                    .then(response => response.ok ? response.json() : Promise.reject('Failed to load'))
                                    .then(data => {
                                        data.forEach(desc => addDescriptionInput(desc));
                                    })
                                    .catch(error => console.error('Error:', error));
                                }
                            });
                        
                            // Add a blank description input when the "Add Description" button is clicked
                            document.getElementById('adddescription').addEventListener('click', function () {
                                addDescriptionInput(); // Add a blank description input
                            });
                        
                            // Event listener for removing specific description inputs
                            document.addEventListener('click', function (e) {
                                if (e.target && e.target.classList.contains('lib-remove-description')) {
                                    const id = e.target.getAttribute('data-id');
                                    document.getElementById(id).remove(); // Remove specific description input group by ID
                                }
                            });
                        
                            // Form submit handler
                            document.getElementById('editSectionForm-lib').addEventListener('submit', function (e) {
                                e.preventDefault();
                                const libraryId = document.getElementById('edit_sec_select').value;
                        
                                if (libraryId) {
                                    this.action = "{{ url('/librarycontent/update') }}/" + libraryId;
                                    this.submit(); // Submit form programmatically
                                } else {
                                    alert("Please select a section to update."); // Validation feedback
                                }
                            });
                            
                          </script>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

                    
                    @elseif($submenu->submenu == 'Labs')
                    
                    <div class="page-box">
                    <div class=" ">
                    <!-- Add Section Form -->
                    <span><strong>Add Sections</strong></span>
                    <form action="{{ route('labs.store') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="lab_name" name="lab_name">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="psg-p-btn">Submit</button>
                    </form>
            
                    <span><strong>Update/Delete</strong></span>
            
                    <!-- Sections Table -->
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>S.no</th>
                                <th>Section</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($labs ?? '' as $key => $lab)
                                <tr id="row-{{ $lab->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td id="lab_name-{{ $lab->id }}">{{ $lab->lab_name }}</td>
                                    <td>
                                        <button type="button" class="psg-p-btn" data-bs-toggle="modal" data-bs-target="#labModal-{{ $lab->id }}">Edit</button>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="labModal-{{ $lab->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Section</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('labs.update', $lab->id) }}" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="lab_name" name="lab_name" value="{{ $lab->lab_name }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="psg-p-btn">Update</button>
                                                                <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form id="labdeleteid" action="{{ route('labs.delete', $lab->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="psg-p-btn btn-danger" onclick="LabDelete('{{ $lab->id }}')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                    <!-- Delete Section Script -->
                    <script>
                        function LabDelete(labId) {
                            Swal.fire({
                                title: "Are you sure?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Delete"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('labdeleteid').action = "{{ route('labs.delete', ':id') }}".replace(':id', labId);
                                    document.getElementById('labdeleteid').submit();
                                }
                            });
                        }
                    </script>
            
                    <hr>
            
                    <!-- Add Content Form -->
                   
            <!-- Add Content Form -->
            <span><strong>Add Content</strong></span>
            <form action="{{ route('labcontent.store') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exam_id">Select Section</label>
                            <select class="form-control" name="lab_id">
                                <option value="">Select Menu</option>
                                @foreach($labs ?? '' as $key => $lab)
                                    <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="mb-3">
                            <label for="description">Descriptions</label>
                            <div id="lab-description-repeater">
                                <div class="input-group mb-2">
                                    <input type="text" name="description[]" class="form-control" placeholder="Enter description">
                                    <button type="button" class="btn btn-danger remove-description">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" id="add-lab-description">Add Description</button>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="psg-p-btn">Submit</button>
            </form>
            
            <!-- Description Add/Remove Scripts -->
            <script>
                document.getElementById('add-lab-description').addEventListener('click', function () {
                    var repeater = document.getElementById('lab-description-repeater');
                    var newInputGroup = document.createElement('div');
                    newInputGroup.className = 'input-group mb-2';
                    newInputGroup.innerHTML = `
                        <input type="text" name="description[]" class="form-control" placeholder="Enter description">
                        <button type="button" class="btn btn-danger remove-description">Remove</button>
                    `;
                    repeater.appendChild(newInputGroup);
                });
            
                document.addEventListener('click', function (e) {
                    if (e.target && e.target.classList.contains('remove-description')) {
                        e.target.closest('.input-group').remove();
                    }
                });
            </script>
            
             <!-- Edit Section Button -->
<button type="button" class="psg-p-btn" id="edit-section-btn" data-bs-toggle="modal" data-bs-target="#editlabModal">
    Edit and Add Contents
</button>

<!-- Edit Section Modal -->
<div class="modal fade" id="editlabModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('labcontent.update', ['id' => 0]) }}" method="POST" id="editlabForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="lab_id" id="edit_lab_id">
                    
                    <div class="mb-3">
                        <label for="edit_lab_select">Select Section</label>
                        <select class="form-control" name="lab_id" id="edit_lab_select">
                            <option value="">Select Section</option>
                            @foreach($labs ?? '' as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                            @endforeach
                        </select>
                        <span style="color:red;"><p>Note: Select a Section To Edit Content</p></span>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description">Descriptions</label>
                        <div id="edit_lab-description_repeater"></div>
                        <button type="button" class="btn btn-success" id="add-labedit-description">Add Description</button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="psg-p-btn">Save Changes</button>
                        <button type="button" class="psg-p-btn" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Update Section in Modal -->
<script>
    document.getElementById('edit_lab_select').addEventListener('change', function () {
        const labId = this.value;
        const descriptionRepeater = document.getElementById('edit_lab-description_repeater');
        descriptionRepeater.innerHTML = ''; // Clear previous descriptions

        if (labId) {
            fetch('{{ route('labcontent.getdescription') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ lab_id: labId })
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(desc => {
                    let inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group mb-2';
                    inputGroup.innerHTML = `
                        <input type="text" name="description[]" class="form-control" value="${desc}" placeholder="Enter description">
                        <button type="button" class="btn btn-danger remove-description">Remove</button>
                    `;
                    descriptionRepeater.appendChild(inputGroup);
                });

                // Update the form action URL to the correct ID
                document.getElementById('editlabForm').action = '{{ route("labcontent.update", ":id") }}'.replace(':id', labId);
            })
            .catch(error => console.error('Error:', error));
        }
    });

    document.getElementById('add-labedit-description').addEventListener('click', function () {
        const descriptionRepeater = document.getElementById('edit_lab-description_repeater');
        const newInputGroup = document.createElement('div');
        newInputGroup.className = 'input-group mb-2';
        newInputGroup.innerHTML = `
            <input type="text" name="description[]" class="form-control" placeholder="Enter description">
            <button type="button" class="btn btn-danger remove-description">Remove</button>
        `;
        descriptionRepeater.appendChild(newInputGroup);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-description')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>

                </div>
            </div>
                    
                    @else
                        <p>No form available for this submenu.</p>
                    @endif
                </div>
            @endforeach
        </div>
        

    </div>
</div>
@endsection

@section("script")
<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<!--<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>



<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

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
