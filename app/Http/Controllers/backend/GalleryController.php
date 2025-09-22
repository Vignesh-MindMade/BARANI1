<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Gallery;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
 
     public function index()
    {
        $galleries = Gallery::all();
        return view('backend.gallery.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descriptions.*'  => 'nullable|string|max:1000',
        ]);

        $bannerImagePath = null;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = time() . '_banner_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $fileName);
            $bannerImagePath = 'uploads/gallery/' . $fileName;
        }

        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $fileName);
                $imagesArray[] = 'uploads/gallery/' . $fileName;
            }
        }
        
        $descriptionsArray = $request->descriptions ?? [];
        Gallery::create([
            'banner_image' => $bannerImagePath,
            'image'        => json_encode($imagesArray),
            'description'  => json_encode($descriptionsArray),
        ]);

        return redirect()->back()->with('success', 'Gallery created successfully!');
    }

     public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'descriptions.*' => 'nullable|string|max:1000',
        ]);

        $gallery = Gallery::findOrFail($id);

        $data = [];

        if ($request->hasFile('banner_image')) {
            if ($gallery->banner_image && file_exists(public_path($gallery->banner_image))) {
                unlink(public_path($gallery->banner_image));
            }
            $file = $request->file('banner_image');
            $fileName = time() . '_banner_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $fileName);
            $data['banner_image'] = 'uploads/gallery/' . $fileName;
        }

        $existingImages = json_decode($gallery->image, true) ?? [];
        $existingDescriptions = json_decode($gallery->description, true) ?? [];

        // Remove marked images
        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $removeIndex) {
                if (isset($existingImages[$removeIndex]) && file_exists(public_path($existingImages[$removeIndex]))) {
                    unlink(public_path($existingImages[$removeIndex]));
                }
                unset($existingImages[$removeIndex]);
                unset($existingDescriptions[$removeIndex]);
            }
        }

        // Update descriptions for remaining images
        foreach ($existingDescriptions as $key => $desc) {
            if (isset($request->descriptions_existing[$key])) {
                $existingDescriptions[$key] = $request->descriptions_existing[$key];
            }
        }

        // Add new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $fileName);
                $existingImages[] = 'uploads/gallery/' . $fileName;
                $existingDescriptions[] = $request->descriptions[$index] ?? '';
            }
        }

        $data['image'] = json_encode(array_values($existingImages));
        $data['description'] = json_encode(array_values($existingDescriptions));

        $gallery->update($data);

        return redirect()->route('gallery')->with('success', 'Gallery updated successfully!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->banner_image && file_exists(public_path($gallery->banner_image))) {
            unlink(public_path($gallery->banner_image));
        }

        $images = json_decode($gallery->image, true) ?? [];
        foreach ($images as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }
        $gallery->delete();
        return redirect()->route('gallery')->with('success', 'Gallery deleted successfully!');
    }

}
