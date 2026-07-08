<!--@extends("layouts.app") @section("style")-->
<!--<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />-->
<!--<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />-->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />-->

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />-->

<!--@endsection-->

<!--<style>-->
<!--    #button_style {-->
<!--        width: 100px;-->
<!--        margin-left: 43%;-->
<!--    }-->
<!--</style>-->

<!--@section("wrapper")-->
<!--<div class="page-wrapper">-->
<!--    <div class="page-content">-->
<!--        <h6 class="mb-0 text-uppercase">{{ 'Editoriol' }}</h6>-->
<!--        <hr />-->

<!--        <div class="card">-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title">Editoriol</h5>-->
<!--                <hr />-->
<!--                <div class="accordion accordion-flush" id="accordionFlushExample">-->
<!--                    <div class="accordion-item">-->
<!--                        <h2 class="accordion-header" id="flush-headingOne">-->
<!--                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">-->
<!--                                Add Content-->
<!--                            </button>-->
<!--                        </h2>-->
<!--                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">-->
<!--                            <div class="accordion-body">-->
<!--                                <form action="{{ route('editoriol.store') }}" method="POST">-->
<!--                                    @csrf-->
<!--                                    <div class="container">-->
<!--                                        <div class="row">-->
<!--                                            <div class="mb-3">-->
<!--                                                <label for="name">Content</label>-->
<!--                                                <input type="text" class="form-control" id="name" name="name" />-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <br />-->
<!--                                    <button type="submit" class="btn btn-primary">Submit</button>-->
<!--                                </form>-->

<!--                                <span><strong>Update/Delete</strong></span>-->
<!--                                <table class="table mb-0">-->
<!--                                    <thead class="table-dark">-->
<!--                                        <tr>-->
<!--                                            <th>S.no</th>-->
<!--                                            <th>Category</th>-->
<!--                                            <th>Edit</th>-->
<!--                                            <th>Delete</th>-->
<!--                                        </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                        @foreach($editoriolsections ?? '' as $key => $section)-->
<!--                                        <tr id="row-{{ $section->id }}">-->
<!--                                            <td>{{ $key+1 }}</td>-->
<!--                                            <td id="name-{{ $section->id }}">{{ $section->name }}</td>-->
<!--                                            <td>-->
<!--                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sympModal-{{ $section->id }}">Edit</button>-->
                                                <!-- Modal -->
<!--                                                <div class="modal fade" id="sympModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">-->
<!--                                                    <div class="modal-dialog modal-dialog-centered">-->
<!--                                                        <div class="modal-content">-->
<!--                                                            <div class="modal-header">-->
<!--                                                                <h5 class="modal-title">Update Section</h5>-->
<!--                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                                                            </div>-->
<!--                                                            <div class="modal-body">-->
<!--                                                                <form action="{{ route('editoriol.update', $section->id) }}" method="POST">-->
<!--                                                                    @csrf-->
<!--                                                                    <div class="mb-3">-->
<!--                                                                        <label for="name">Name</label>-->
<!--                                                                        <textarea class="form-control" id="name" name="name" rows="3">{{ $section->name }}</textarea>-->
<!--                                                                    </div>-->

<!--                                                                    <div class="modal-footer">-->
<!--                                                                        <button type="submit" class="btn btn-primary">Update</button>-->
<!--                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
<!--                                                                    </div>-->
<!--                                                                </form>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                <form id="sectiondelete" action="{{ route('editoriol.delete', $section->id) }}" method="POST" style="display: inline;">-->
<!--                                                    @csrf @method('DELETE')-->
<!--                                                    <button type="button" class="btn btn-xl btn-danger" onclick="SectionDelete('{{ $section->id }}')">Delete</button>-->
<!--                                                </form>-->
<!--                                            </td>-->
<!--                                        </tr>-->

<!--                                        @endforeach-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                                <script>-->
<!--                                    function SectionDelete(sectionId) {-->
<!--                                        Swal.fire({-->
<!--                                            title: "Are you sure?",-->
<!--                                            icon: "warning",-->
<!--                                            showCancelButton: true,-->
<!--                                            confirmButtonColor: "#3085d6",-->
<!--                                            cancelButtonColor: "#d33",-->
<!--                                            confirmButtonText: "Delete",-->
<!--                                        }).then((result) => {-->
<!--                                            if (result.isConfirmed) {-->
<!--                                                document.getElementById("sectiondelete").action = "{{ route('editoriol.delete', ':id') }}".replace(":id", sectionId);-->
<!--                                                document.getElementById("sectiondelete").submit();-->
<!--                                            }-->
<!--                                        });-->
<!--                                    }-->
<!--                                </script>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="card">-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title">Editoriol Menu</h5>-->
<!--                <hr />-->
<!--                <div class="accordion accordion-flush" id="accordionFlushExample">-->
<!--                    <div class="accordion-item">-->
<!--                        <h2 class="accordion-header" id="flush-headingOne">-->
<!--                            <a href="{{route('menu-editoriol.index')}}" style="font-size: 21px; font-family: math; color: blue;">Add Menu Content</a>-->
<!--                        </h2>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--@endsection @section("script")-->
<!-- Bootstrap Bundle with Popper -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

<!--@endsection-->
