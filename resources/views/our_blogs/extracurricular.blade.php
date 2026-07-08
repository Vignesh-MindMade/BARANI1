@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    
    .nav-names{
        
        font-size: 19px;
        font-family: 'boxicons';
        color: #000000;
        font-weight: bolder;
        
    }
    .nav-names-active{
        
        font-size: 19px;
        font-family: 'boxicons';
        color: red;
        font-weight: bolder;
        
    }
    
</style>

@endsection

@section("wrapper")


<div class="page-wrapper">
    <div class="page-content">
        
         <div class="row">
           
            <div class="col-md-3">
                      <div class="card-header nav-names"><a href="{{route('extraCurricular.index')}}" class="nav-names-active">Extra Curricular</a></div>
            </div>
            
            <div class="col-md-3">
                      <div class="card-header nav-names-active" ><a href="{{route('Cocurriculart.index')}}" >Co Curricular</a></div>
            </div>
            <div class="col-md-3">
                      <div class="card-header nav-names"><a href="{{route('testCurricular.index')}}">Curricular</a></div>
            </div>
   
              <div class="col-md-3">
                      <div class="card-header nav-names"><a href="{{route('collabrations.index')}}">Collabrations</a></div>
            </div>
        </div>
        <hr/>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- First Form -->
                        <form action="{{route('extraCurricular.main.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span style="color:red;">*</span></label>
                                <input class="form-control" id="title" name="title" placeholder="Title" required>
                            </div>

                            <div class="mb-3">
                                <label for="catagory_name" class="form-label">Category Name <span style="color:red;">*</span></label>
                                <input class="form-control" id="catagory_name" name="catagory_name" placeholder="Category Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="catagory_image" class="form-label">Category Image <span style="color:red;">*</span></label>
                                <input class="form-control" type="file" id="catagory_image" name="catagory_image" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                        <hr>

                        <!-- Table for Display -->
                        <table id="extracurricularTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Category Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ExtraCurricularFronts as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->catagory_name }}</td>
                                    <td><img src="{{ asset('images/'.  $item->catagory_image) }}" alt="Image" width="100"></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                        <form action="{{ route('extraCurricular.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('extraCurricular.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input class="form-control" id="title" name="title" value="{{ $item->title }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="catagory_name" class="form-label">Category Name</label>
                                                        <input class="form-control" id="catagory_name" name="catagory_name" value="{{ $item->catagory_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="catagory_image" class="form-label">Category Image</label>
                                                        <input class="form-control" type="file" id="catagory_image" name="catagory_image">
                                                        <img src="{{ asset('images/'.  $item->catagory_image) }}" alt="Current Image" width="100" class="mt-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <!-- Detail Form -->
                        <form action="{{route('extraCurricular.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="extra_curricullar_id" class="form-label">Select Extra Curricular <span style="color:red;">*</span></label>
                                <select class="form-control" id="extra_curricullar_id" name="extra_curricullar_id" required>
                                    <option value="">Select Extra Curricular</option>
                                    @foreach($ExtraCurricularFronts as $ExtraCurricularFront)
                                        <option value="{{ $ExtraCurricularFront->id }}">{{ $ExtraCurricularFront->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image <span style="color:red;">*</span></label>
                                <input class="form-control" type="file" id="image" name="image" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span style="color:red;">*</span></label>
                                <input class="form-control" id="description" name="description" placeholder="Description" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                        <hr>

                        <!-- Details Table -->
                        <table id="extracurricularDetailTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>S.No</th>
                                    <th>Extra Curricular Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ExtraCurricularDetails as $key => $detail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ExtraCurricularFronts->find($detail->extra_curricullar_id)->title }}</td>
                                    <td><img src="{{  asset('images/'.  $detail->image) }}" alt="Image" width="100"></td>
                                    <td>{{ $detail->description }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $detail->id }}">Edit</button>
                                        <form action="{{ route('extraCurricular.detail.delete', $detail->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Detail Modal -->
                                <div class="modal fade" id="editDetailModal{{ $detail->id }}" tabindex="-1" aria-labelledby="editDetailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('extraCurricular.detail.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDetailModalLabel">Edit Detail Record</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="extra_curricullar_id" class="form-label">Extra Curricular Title</label>
                                                        <select class="form-control" id="extra_curricullar_id" name="extra_curricullar_id" required>
                                                            @foreach($ExtraCurricularFronts as $ExtraCurricularFront)
                                                                <option value="{{ $ExtraCurricularFront->id }}" {{ $detail->extra_curricullar_id == $ExtraCurricularFront->id ? 'selected' : '' }}>
                                                                    {{ $ExtraCurricularFront->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input class="form-control" type="file" id="image" name="image">
                                                        <img src="{{  asset('images/'.  $detail->image) }}" alt="Current Image" width="100" class="mt-2">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <input class="form-control" id="description" name="description" value="{{ $detail->description }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    </div>
</div>
@endsection

@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#extracurricularTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50],
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "searching": true
        });

        $('#extracurricularDetailTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50],
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "searching": true
        });
    });

    function displayImage(event, previewId) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById(previewId);
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection