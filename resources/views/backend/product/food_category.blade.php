@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>
    <form action="{{ route('categories_food.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="catagory_name">Category Name</label>
            <input type="text" name="catagory_name" id="catagory_name" class="form-control" value="{{ $category->catagory_name }}" required>
            @error('catagory_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection