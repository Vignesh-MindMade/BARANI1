@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Product</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('OEM.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_oem_id" class="form-label">Select Category</label>
            <select name="product_oem_id" id="product_oem_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->product_oem_id == $category->id ? 'selected' : '' }}>
                        {{ $category->catagory_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_thumbnail" class="form-label">Product Thumbnail</label>
            <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control">
            <img src="{{ asset($product->product_thumbnail) }}" width="100" class="mt-2" alt="Current Thumbnail">
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}" required>
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control">{{ $product->product_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
             <div class="mt-2">
                @php
                    $images = is_array($product->images) ? $product->images : (json_decode($product->images, true) ?? []);
                @endphp
                @if(!empty($images))
                    @foreach ($images as $image)
                        <img src="{{ asset($image) }}" alt="Image" width="100" class="me-2">
                    @endforeach
                @else
                    <p class="text-muted">No images uploaded</p>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Points</label>
            <div id="points-container">
                @php
                    $points = is_array($product->points) ? $product->points : (json_decode($product->points, true) ?? []);
                @endphp
                @foreach ($points as $point)
                    <input type="text" name="points[]" class="form-control mb-2" value="{{ $point }}" placeholder="Enter point">
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-success" id="add-point">Add More Points</button>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('productsoem') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    @php
        // If it's JSON in DB
        $points = is_string($product->points) ? json_decode($product->points, true) : $product->points;

        // If json_decode failed and it's comma-separated
        if (!is_array($points)) {
            $points = explode(',', $product->points ?? '');
        }

        $points = array_filter($points); // remove empty values
    @endphp

    let pointCount = {{ max(count($points), 1) }};
    document.getElementById('add-point').addEventListener('click', function () {
        let container = document.getElementById('points-container');
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'points[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Enter point';
        container.appendChild(input);
        pointCount++;
    });
</script>

@endsection