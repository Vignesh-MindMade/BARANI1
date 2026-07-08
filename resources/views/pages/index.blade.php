@extends("layouts.app") 
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }
</style>

@section("wrapper")

<div class="page-wrapper">
    <div class="page-content">
           
            <div class="col-md-12">
                 <h2 class="mb-30 text-uppercase text-center">Page List</h2>
                <div class="page-box mt-0">
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table  table-bordered" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Menu</th>
                                        <th class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($menus ?? '' as $key => $menu)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $menu->name }}</td>

                                        <td class="text-center subpagesmenu-btns-box">
                                            
                                            @if($menu->name === 'Why Chinmaya')
                                                <a href="{{ route('testCurricular.index') }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            
                                            @elseif($menu->name == 'IQAC')
                                            
                                            <a href="{{ route('pages.iqac') }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            
                                            @elseif($menu->name == 'Admissions')
                                            
                                            <a href="{{ route('pages.admission') }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            
                                            @elseif($menu->name == 'Infrastructure')
                                            
                                            <a href="{{ route('infrastructure.index') }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            
                                            @elseif($menu->name == 'Facilities')
                                            
                                            <a href="{{ route('pages.Workwithus') }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            
                                            @else
                                                <a href="{{ route('pages.submenus', $menu->id) }}" class="psg-p-btn">Edit <i class="bi bi-arrow-right"></i> </a>
                                            @endif
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
</div>

@endsection


@section("script")
<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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



@endsection
