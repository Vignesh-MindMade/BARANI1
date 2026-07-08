@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
@endsection

@section("wrapper")
<div class="page-wrapper">
        <div class="page-content"> 
    
    <div class="">
            <h2 class="mb-0 text-uppercase">Sub Menu List</h2>
            <div class="">
                <div class="page-box">
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Menu</th>
                                        <th>SubMenu</th>
                                        <th>Sort ID</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submenus as $key => $submenu)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $submenu->menu->name }}</td>
                                        <td>{{ $submenu->submenu }}</td>
                                        <td>{{ $submenu->sort_id ?? '--' }}</td>
                                        <td class="text-center">
                                            <form id="deleteForm" action="{{ route('submenu.destroy', $submenu->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="psg-p-btn btn-danger" onclick="confirmDelete1('{{ $submenu->id }}')">
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
        </div>
    

   
       
        
        
        
           <button id="toggleButton" class="psg-p-btn mt-3" onclick="toggleContent()">Add New Sub Menus</button>

                           <div class=" mt-5" id="videoContent" style="display: none;"> 
                           
                              <div class="row">
            <div class="col-md-12">
                <div class="page-box mt-0">
                    <div class="">

                        <form action="{{ route('menus.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="menu_id">Select Menu<span style="color:red;">*</span></label>
                                <select class="form-control" name="menu_id" required>
                                    <option value="">Select Menu</option>
                                     @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 w-50-p">
                                <label for="submenu">SubMenu<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="submenu" placeholder="Submenu" aria-label="submenu" required>
                            </div>
                            <div class="mb-3 w-50-p">
                                <label for="sort_id">Sort ID<span style="color:red;">*</span></label>
                                <input class="form-control" type="number" name="sort_id" placeholder="SortId" aria-label="SortId"required>
                            </div>
                            <button type="submit" class="psg-p-btn ml-0"><span class="bi--save-fill"></span>Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
                         </div>

        
     


<!-- Edit Submenu Modal -->

<div class="modal fade" id="editSubmenuModal" tabindex="-1" aria-labelledby="editSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form id="editSubmenuForm" action="" method="POST" enctype="multipart/form-data">
                @csrf @method('put')
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubmenuModalLabel">Edit SubMenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_menu_id">Select Menu<span style="color:red;">*</span></label>
                        <select class="form-control" id="edit_menu_id" name="menu_id" required>
                            <option value="">Select Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_submenu">SubMenu<span style="color:red;">*</span></label>
                        <input class="form-control" id="edit_submenu" type="text" name="submenu" placeholder="Submenu" aria-label="submenu" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sort_id">Sort ID<span style="color:red;">*</span></label>
                        <input class="form-control" id="edit_sort_id" type="number" name="sort_id" placeholder="SortId" aria-label="SortId" required>
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




        

        <!--end row-->
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
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
                button.textContent = "Add New Sub Menus";
            }
        }
        
        
// Delete Function:

    function confirmDelete1(submenuId) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form with the specific submenuId
                document.getElementById('deleteForm').action = "{{ route('submenu.destroy', ':id') }}".replace(':id', submenuId);
                document.getElementById('deleteForm').submit();
            }
        });
    }
    
</script>

<script>

    function openEditModal(id, menuId, submenu, sortId) {
        // Set form action URL
        document.getElementById('editSubmenuForm').action = '{{ url("/submenu") }}/' + id;

        // Set the current values in the modal inputs
        document.getElementById('edit_menu_id').value = menuId;
        document.getElementById('edit_submenu').value = submenu;
        document.getElementById('edit_sort_id').value = sortId;

        // Open the modal
        var myModal = new bootstrap.Modal(document.getElementById('editSubmenuModal'), {
            keyboard: false
        });
        myModal.show();
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
