@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contact Page Settings</h2>

    <form action="{{ route('contact.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Image</label>
            <input type="file" name="banner_image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_title" class="form-label">Contact Title</label>
            <input type="text" name="contact_title" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_description" class="form-label">Contact Description</label>
            <textarea name="contact_description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
