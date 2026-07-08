@extends("layouts.app")
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add Banner</h6>
        <hr/>

       <div class="row">
    <div class="col-md-12">
         <div class="card">
        <div class="card-body">
            <form action="{{ route('portfolio.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @foreach($portfoliobanners as $index => $facts)
    <div class="mb-3">
        <label for="image_{{ $index }}">Image</label>
        <input type="file" class="form-control-file" id="image_{{ $index }}" name="image" onchange="previewImage(event, {{ $index }})">
        <img id="imagePreview_{{ $index }}" 
             src="{{ $facts->image ? asset('images/' . $facts->image) : '#' }}" 
             alt="Image" 
             style="max-width: 200px; margin-top: 10px; {{ $facts->image ? '' : 'display: none;' }}">
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    function previewImage(event, index) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview_' + index);
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

    </div>
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

    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

</script>



@endsection
