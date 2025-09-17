@extends('layouts.app') 
@section('content')

<div class="container mt-4">
    <h2>Edit Textile Product</h2>
    <form action="{{ route('food.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="product_textile_id" class="form-label">Select Category</label>
            <select name="product_textile_id" id="product_textile_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->product_textile_id == $category->id ? 'selected' : '' }}> {{ $category->catagory_name }} </option>
                @endforeach
            </select>
            @error('product_textile_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_thumbnail" class="form-label">Product Thumbnail</label>
            <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control" />
            <img src="{{ asset($product->product_thumbnail) }}" alt="Thumbnail" width="100" class="mt-2" />
            @error('product_thumbnail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}" required />
            @error('product_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control">{{ $product->product_description }}</textarea>
            @error('product_description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product_brouchure" class="form-label">Product Brochure (PDF)</label>
            <input type="file" name="product_brouchure" id="product_brouchure" class="form-control" accept="application/pdf" />
            @if($product->product_brouchure)
            <a href="{{ asset($product->product_brouchure) }}" target="_blank" class="mt-2 d-inline-block text-primary">View/Download Current Brochure</a>
            @else
            <p class="mt-2 text-muted">No brochure uploaded</p>
            @endif @error('product_brouchure')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple />
            <div class="mt-2">
                {{-- Product Images --}} @foreach (json_decode($product->images, true) ?? [] as $image)
                <img src="{{ asset($image) }}" alt="Image" width="100" class="me-2" />
                @endforeach
            </div>
            @error('images')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Points</label>
            <div id="points-container">
                {{-- Product Points --}} @foreach (json_decode($product->points, true) ?? [] as $point)
                <input type="text" name="points[]" class="form-control mb-2" value="{{ $point }}" placeholder="Enter point" />
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-success" id="add-point">Add More Points</button>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<script>
    let pointCount = {{ is_array($product->points) ? count($product->points) : 0 }};
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
