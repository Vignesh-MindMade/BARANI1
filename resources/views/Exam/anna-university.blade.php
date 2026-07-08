@extends("layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }
</style>
@endsection

@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h5 style="font-size: 22px;font-family: math;font-weight: bold; color: red;">Anna University Circulars</h5>
                <hr>

                <!-- Add Circular Form -->
                <form action="{{ route('annauniversity-circulars-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required />
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year  <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="year" name="year" required />
                    </div>
                    <div class="mb-3">
                        <label for="circular_1" class="form-label">Circular 1</label>
                        <input type="text" class="form-control" id="circular_1" name="circular_1" />
                    </div>
                    <div class="mb-3">
                        <label for="circular_1_pdf" class="form-label">Circular 1 PDF</label>
                        <input type="file" class="form-control" id="circular_1_pdf" name="circular_1_pdf" />
                    </div>
                    <div class="mb-3">
                        <label for="circular_2" class="form-label">Circular 2</label>
                        <input type="text" class="form-control" id="circular_2" name="circular_2" />
                    </div>
                    <div class="mb-3">
                        <label for="circular_2_pdf" class="form-label">Circular 2 PDF</label>
                        <input type="file" class="form-control" id="circular_4_pdf" name="circular_2_pdf" />
                    </div>
                    <div class="mb-3">
                        <label for="circular_3" class="form-label">Circular 3</label>
                        <input type="text" class="form-control" id="circular_3" name="circular_3" />
                    </div>
                    <div class="mb-3">
                        <label for="circular_3_pdf" class="form-label">Circular 3 PDF</label>
                        <input type="file" class="form-control" id="circular_3_pdf" name="circular_3_pdf" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr>

                <!-- Circulars Table -->
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year</th>
                             
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($annaUniversity as $circular)
                            <tr>
                                <td>{{ $circular->title }}</td>
                                <td>{{ $circular->year }}</td>
                    
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $circular->id }}">
                                        Edit
                                    </button>
                                    
                             <form id="deleteFormAnna-{{ $circular->id }}" action="{{ route('annauniversity-circulars.delete', $circular->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>



                                    </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $circular->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $circular->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $circular->id }}">Edit Circular</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('annauniversity-circulars.update', $circular->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{ $circular->title }}" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="year" class="form-label">Year</label>
                                                    <input type="text" class="form-control" id="year" name="year" value="{{ $circular->year }}" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_1" class="form-label">Circular 1</label>
                                                    <input type="text" class="form-control" id="circular_1" name="circular_1" value="{{ $circular->circular_1 }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_1_pdf" class="form-label">Circular 1 PDF</label>
                                                    <input type="file" class="form-control" id="circular_1_pdf" name="circular_1_pdf" />
                                                
                                                          @if(!empty($circular->circular_1_pdf) && file_exists(public_path('pdfs/' . $circular->circular_1_pdf)))
                                                  <a href="{{ asset('pdfs/' . $circular->circular_1_pdf) }}" target="_blank">View PDF</a>

                                                @else
                                                    <p>No PDF available.</p>
                                                @endif
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_2" class="form-label">Circular 2</label>
                                                    <input type="text" class="form-control" id="circular_2" name="circular_2" value="{{ $circular->circular_2 }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_2_pdf" class="form-label">Circular 2 PDF</label>
                                                    <input type="file" class="form-control" id="circular_4_pdf" name="circular_4_pdf" />
                                                    
                                                                                                        
                                                 @if(!empty($circular->circular_4_pdf) && file_exists(public_path('pdfs/' . $circular->circular_4_pdf)))
                                                  <a href="{{ asset('pdfs/' . $circular->circular_4_pdf) }}" target="_blank">View PDF</a>

                                                @else
                                                    <p>No PDF available.</p>
                                                @endif
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_3" class="form-label">Circular 3</label>
                                                    <input type="text" class="form-control" id="circular_3" name="circular_3" value="{{ $circular->circular_3 }}" />
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="circular_3_pdf" class="form-label">Circular 3 PDF</label>
                                                    <input type="file" class="form-control" id="circular_3_pdf" name="circular_3_pdf" />
                                                    
                                                             @if(!empty($circular->circular_3_pdf) && file_exists(public_path('pdfs/' . $circular->circular_3_pdf)))
                                                  <a href="{{ asset('pdfs/' . $circular->circular_3_pdf) }}" target="_blank">View PDF</a>

                                                @else
                                                    <p>No PDF available.</p>
                                                @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
@endsection

@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.js"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });


function deleteFormAnna(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("deleteFormAnna-" + id).submit();
        }
    });
}



</script>
@endsection