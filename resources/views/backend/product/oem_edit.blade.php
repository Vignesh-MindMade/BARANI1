@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('productsoem.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="catagory_name">Category Name</label>
            <input type="text" name="catagory_name" id="catagory_name" class="form-control" value="{{ $category->catagory_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('productsoem') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection