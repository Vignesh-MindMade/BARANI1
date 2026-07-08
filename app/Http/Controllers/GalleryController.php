<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('Backend.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|max:150',
            'images.*' => 'image|mimes:webp,jpeg,png,jpg|max:5000',
        ]);

        foreach ($request->file('images') as $image) {
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);

            Gallery::create([
                'image_path' => $filename,
            ]);
        }

        return redirect()->route('viewgallery.index')->with('success', 'Images uploaded successfully.');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('images/' . $gallery->image_path);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $filename = Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image_path'] = $filename;
        }

        $gallery->update($data);

        return redirect()->route('viewgallery.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $imagePath = public_path('images/' . $gallery->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        $gallery->delete();

        return redirect()->route('viewgallery.index')->with('success', 'Image deleted successfully.');
    }
    
}