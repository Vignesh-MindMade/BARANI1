@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        <h6 class="mb-0 text-uppercase">{{ 'Work With Us' }}</h6>
        <hr/>
        
        <div class="card">
                        <div class="card-body">
                            <form  action="{{ route('pages.work') }}" method="POST">
                                @csrf
                                @foreach($works as $work)
                                    <div class="mb-3">
                                        <label for="program" class="form-label">Our Programs</label>
                                        <textarea class="form-control" id="work" name="work" aria-label="Work" style="width: 100%; height: 150px;">{{ old('work', $work->work ?? '') }}</textarea>
                                    </div>
                                @endforeach
                                <button type="submit"  class="btn btn-primary">Submit</button>
                            </form>
                            <hr>
                            <form action="{{ route('workwithus.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Add Name">
                                        </div>
                                        <div class="col">
                                            <label>Content</label>
                                            <input type="text" class="form-control" id="content" name="content">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file" id="image" name="image" aria-label="Image" onchange="programimage(event)" required>
                                            <img id="previewimage" src="#" alt="Uploaded Image" style="max-width: 100px; display: none;">
                                        </div>
                                         
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <script>
                                    function programimage(event) {
                                        var image = document.getElementById('previewimage');
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
                                   @foreach($workwithus ?? '' as $key => $workwith)
                                    <tr id="row-{{ $workwith->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td id="name-{{ $workwith->id }}">{{ $workwith->name }}</td>
                                        <td id="content-{{ $workwith->id }}">{{ $workwith->content }}</td>
                                        <td id="image-{{ $workwith->id }}">
                                            <img src="{{ asset('images/' . $workwith->image) }}" alt="Staff Image" style="max-width: 100px;" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pedagogyModal-{{ $workwith->id }}">Edit</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="pedagogyModal-{{ $workwith->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Work With Us</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('workwithus.update', $workwith->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $workwith->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Content</label>
                                                                    <input type="text" class="form-control" id="content" name="content" value="{{ $workwith->content }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Image</label>
                                                                    <input type="file" class="form-control" id="image" name="image">
                                                                    @if($workwith->image)
                                                                        <img src="{{ asset('images/' . $workwith->image) }}" alt="{{ $workwith->name }}" width="100">
                                                                    @endif
                                                                </div>
                                                               
                                                                <div class="modal-footer">
                                                                     <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                               
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                         <form id="delete" action="{{ route('workwithus.delete', $workwith->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-xl btn-danger" onclick="Deleteteabl('{{ $workwith->id }}')">Delete</button>
                                        </form>
                                            </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                 <script>
                                        function Deleteteabl(workId) {
                                            Swal.fire({
                                                title: "Are you sure?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Delete"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete').action = "{{ route('workwithus.delete', ':id') }}".replace(':id', workId);
                                                    document.getElementById('delete').submit();
                                                }
                                            });
                                        }
                                    </script>    
                          
                        </div>
                    </div>

    </div>
</div>
@endsection

@section("script")
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
