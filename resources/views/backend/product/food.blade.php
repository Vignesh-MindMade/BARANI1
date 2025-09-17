@extends('layouts.app')

@section('content')
<style>
    .card { transition: transform 0.3s, box-shadow 0.3s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus, .form-select:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .btn-success { background-color: #28a745; border-color: #28a745; }
    .btn-success:hover { background-color: #218838; border-color: #218838; }
    .btn-danger { background-color: #dc3545; border-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; border-color: #c82333; }
    .btn-warning { background-color: #ffc107; border-color: #ffc107; }
    .btn-warning:hover { background-color: #e0a800; border-color: #e0a800; }
    .btn-secondary { background-color: #6c757d; border-color: #6c757d; }
    .btn-secondary:hover { background-color: #5a6268; border-color: #5a6268; }
    .img-preview { object-fit: cover; border-radius: 5px; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
    .point-item { border: 1px solid #e9ecef; padding: 10px; border-radius: 5px; margin-bottom: 10px; }
    .table img { object-fit: cover; }
</style>

<div class="container py-5">
    <!-- Category Creation -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Add Category</h3>
        </div>
        <div class="card-body">
            @if (session('success_category'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_category') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error_category'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_category') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('categories_food.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="catagory_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="catagory_name" id="catagory_name" class="form-control @error('catagory_name') is-invalid @enderror" value="{{ old('category_name') }}" required>
                    @error('catagory_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                    <a href="{{ route('productsfood') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            
        </div>
    </div>

    <!-- Category Management -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Manage Categories</h3>
        </div>
        <div class="card-body">
            @if (session('success_category'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_category') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error_category'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_category') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->catagory_name }}</td>
                                <td>
                                    <a href="{{ route('categories_food.edit', $category->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <form action="{{ route('categories_food.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No categories found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          
        </div>
    </div>

    <!-- Textile Product Creation -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Add Textile Product</h3>
        </div>
        <div class="card-body">
            @if (session('success_product'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_product') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error_product'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_product') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('productsfood.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="section-header">Product Details</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="product_food_id" class="form-label">Select Category <span class="text-danger">*</span></label>
                        <select name="product_food_id" id="product_food_id" class="form-select @error('product_food_id') is-invalid @enderror" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->catagory_name }}</option>
                            @endforeach
                        </select>
                        @error('product_food_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="product_thumbnail" class="form-label">Product Thumbnail <span class="text-danger">*</span></label>
                        <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control @error('product_thumbnail') is-invalid @enderror" accept="image/*" required>
                        @error('product_thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" required>
                        @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea name="product_description" id="product_description" class="form-control @error('product_description') is-invalid @enderror" rows="4">{{ old('product_description') }}</textarea>
                        @error('product_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                       <div class="col-md-6 mb-4">
                        <label for="product_brouchure" class="form-label">Product Broucher </label>
                        <input type="file" name="product_brouchure" id="product_brouchure" class="form-control @error('product_brouchure') is-invalid @enderror" accept="image/*" >
                        @error('product_brouchure')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="images" class="form-label">Product Images</label>
                        <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" accept="image/*" multiple>
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Points Section -->
                <h5 class="section-header">Product Points</h5>
                <div id="points-container" class="mb-4">
                    <div class="point-item">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" name="points[]" class="form-control @error('points.*') is-invalid @enderror" placeholder="Enter point">
                                @error('points.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removePoint(this)">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-success mb-4" id="add-point">Add More Points</button>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="{{ route('productsfood') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Textile Product Management -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">Manage Textile Products</h3>
        </div>
        <div class="card-body">
            @if (session('success_product'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_product') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error_product'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_product') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Images</th>
                        
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->ProductFood->catagory_name }}</td>
                                <td><img src="{{ asset($product->product_thumbnail) }}" alt="Thumbnail" class="img-preview" width="50" height="50"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ Str::limit($product->product_description, 100) }}</td>
                                <td>
                                                            
                                  @foreach (json_decode($product->images, true) ?? [] as $image)
                                    <img src="{{ asset($image) }}" alt="Image" class="img-preview" width="50" height="50">
                                    @endforeach

                                 
                                </td>
                                

                                <td>
                                    <a href="{{ route('productsfood.edit', $product->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <form action="{{ route('food.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">No products found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('add-point').addEventListener('click', function () {
    let container = document.getElementById('points-container');
    let div = document.createElement('div');
    div.classList.add('point-item');
    div.innerHTML = `
        <div class="row">
            <div class="col-md-10">
                <input type="text" name="points[]" class="form-control" placeholder="Enter point">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removePoint(this)">Remove</button>
            </div>
        </div>
    `;
    container.appendChild(div);
});

function removePoint(button) {
    let items = document.querySelectorAll('.point-item');
    if (items.length > 1) {
        button.closest('.point-item').remove();
    } else {
        alert('At least one point is required.');
    }
}
</script>
@endsection