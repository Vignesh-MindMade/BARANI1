@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Category Management</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Category Create Form -->
    <form action="{{ route('productsoem.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="catagory_name">Category Name</label>
            <input type="text" name="catagory_name" id="catagory_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <!-- Categories List -->
    <h3 class="mt-4">Categories</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->catagory_name }}</td>
                    <td>
                        <a href="{{ route('productsoem.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('productsoem.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h2>Product Management</h2>

    <!-- Product Create Form -->
    <form action="{{ route('OEM.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="product_oem_id" class="form-label">Select Category</label>
            <select name="product_oem_id" id="product_oem_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->catagory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_thumbnail" class="form-label">Product Thumbnail</label>
            <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>
          <div class="col-md-6 mb-4">
                        <label for="product_brouchure" class="form-label">Product Broucher </label>
                        <input type="file" name="product_brouchure" id="product_brouchure" class="form-control @error('product_brouchure') is-invalid @enderror" accept="image/*" >
                        @error('product_brouchure')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

        <div class="mb-3">
            <label class="form-label">Points</label>
            <div id="points-container">
                <input type="text" name="points[]" class="form-control mb-2" placeholder="Enter point">
            </div>
            <button type="button" class="btn btn-sm btn-success" id="add-point">Add More Points</button>
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

    <!-- Products List -->
    <h3 class="mt-4">Products</h3>
    <!-- Products List -->
<h3 class="mt-4">Products</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td><img src="{{ asset($product->product_thumbnail) }}" width="50" alt="Thumbnail"></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->productOEM ? $product->productOEM->catagory_name : 'No Category' }}</td>
                <td>{{ Str::limit($product->product_description ?? '', 50) }}</td>
                <td>
                    <a href="{{ route('OEM.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('OEM.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
    let pointCount = 1;
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