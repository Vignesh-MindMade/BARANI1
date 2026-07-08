@extends('layouts.app')

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <h2>Create Product Archive</h2>

            <form action="{{ route('productarchives.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Select a Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->catagory }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('productarchives.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
