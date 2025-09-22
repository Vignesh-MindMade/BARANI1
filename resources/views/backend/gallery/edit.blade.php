@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Gallery</h2>

    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Banner Image -->
        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Image</label>
            <input type="file" name="banner_image" id="banner_image" class="form-control @error('banner_image') is-invalid @enderror" accept="image/*">
            @if($gallery->banner_image)
                <img src="{{ asset($gallery->banner_image) }}" alt="Banner" style="max-width: 200px; margin-top: 10px;">
            @endif
            @error('banner_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Multiple Images + Descriptions -->
        <div id="gallery-items" class="mb-3">
@foreach(json_decode($gallery->image, true) ?? [] as $index => $image)
    <div class="gallery-item mb-2">
        <label class="form-label">Image:</label>
        <input type="file" name="images_existing[{{ $index }}]" class="form-control" accept="image/*">
        <img src="{{ asset($image) }}" alt="Gallery Image" style="max-width: 200px; margin-top: 10px;">

        <input type="hidden" name="existing_images[{{ $index }}]" value="{{ $image }}">
        
        <label class="form-label mt-2">Description:</label>
        <textarea name="descriptions_existing[{{ $index }}]" rows="2" class="form-control" placeholder="Enter description">{{ old('descriptions_existing.'.$index, json_decode($gallery->description, true)[$index] ?? '') }}</textarea>

        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="markForRemoval(this, '{{ $index }}')">Remove</button>
    </div>
@endforeach

        </div>

        <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addItem()">+ Add More</button>

        <button type="submit" class="btn btn-primary">Update Gallery</button>
    </form>
</div>

<script>
function addItem() {
    let div = document.createElement('div');
    div.classList.add('gallery-item', 'mb-2');
    div.innerHTML = `
        <label class="form-label">Image:</label>
        <input type="file" name="images[]" class="form-control" accept="image/*">

        <label class="form-label mt-2">Description:</label>
        <textarea name="descriptions[]" rows="2" class="form-control" placeholder="Enter description"></textarea>

        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeItem(this)">Remove</button>
    `;
    document.getElementById('gallery-items').appendChild(div);
}
function markForRemoval(button, index) {
    // Add hidden field to tell backend this image should be deleted
    let hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'remove_images[]';
    hidden.value = index;
    document.querySelector('form').appendChild(hidden);

    // Remove the item from the UI
    button.closest('.gallery-item').remove();
}


</script>
@endsection