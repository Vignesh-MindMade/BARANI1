<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductOEM;
use App\Models\Backend\OEM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OEMController extends Controller
{
    // Category CRUD Operations
public function OEMindex()
{
    $categories = ProductOEM::all();
    $products = OEM::with('productOEM')->get();
    return view('backend.product.oem', compact('categories', 'products'));
}

    public function OEMProductStore(Request $request)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|string|max:255',
        ]);

        ProductOEM::create([
            'catagory_name' => $validated['catagory_name'],
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function OEMProductEdit($id)
    {
        $category = ProductOEM::findOrFail($id);
        return view('backend.product.oem_edit', compact('category'));
    }

    public function OEMProductUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|string|max:255',
        ]);

        $category = ProductOEM::findOrFail($id);
        $category->update([
            'catagory_name' => $validated['catagory_name'],
        ]);

        return redirect()->route('productsoem')->with('success', 'Category updated successfully!');
    }

    public function OEMProductDestroy($id)
    {
        $category = ProductOEM::findOrFail($id);
      
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function OEMstore(Request $request)
    {
        $validated = $request->validate([
            'product_oem_id' => 'required|exists:product_oem,id',
            'product_thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',

            'product_brouchure' => 'nullable|mimes:pdf|max:5000', // ✅ brochure
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points' => 'nullable|array',
        ]);

        $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' .
            $request->file('product_thumbnail')->getClientOriginalExtension();
        $request->file('product_thumbnail')->move(public_path('uploads/thumbnail'), $thumbnailName);
        $thumbnailPath = 'uploads/thumbnail/' . $thumbnailName;

        $brochurePath = null;
        if ($request->hasFile('product_brouchure')) {
            $brochureName = time() . '_brochure_' . uniqid() . '.' . $request->file('product_brouchure')->getClientOriginalExtension();
            $request->file('product_brouchure')->move(public_path('uploads/brochures'), $brochureName);
            $brochurePath = 'uploads/brochures/' . $brochureName;
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
        }

        OEM::create([
            'product_oem_id' => $validated['product_oem_id'],
            'product_thumbnail' => $thumbnailPath,
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'] ?? null,
            'product_brouchure' => $brochurePath, 
            'images' => json_encode($imagePaths),
            'points' => json_encode($validated['points'] ?? []), 
        ]);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function OEMedit($id)
    {
        $product = OEM::findOrFail($id);
        $categories = ProductOEM::all();
        return view('backend.product.oem_product_edit', compact('product', 'categories'));
    }

    public function OEMupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'product_oem_id' => 'required|exists:product_oem,id',
            'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points' => 'nullable|array',
        ]);

        $product = OEM::findOrFail($id);

        $data = [
            'product_oem_id' => $validated['product_oem_id'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'points' => $validated['points'],
        ];

        if ($request->hasFile('product_thumbnail')) {
            // Delete old thumbnail
            if (file_exists(public_path($product->product_thumbnail))) {
                unlink(public_path($product->product_thumbnail));
            }
            $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' . 
                $request->file('product_thumbnail')->getClientOriginalExtension();
            $request->file('product_thumbnail')->move(public_path('uploads/thumbnail'), $thumbnailName);
            $data['product_thumbnail'] = 'uploads/thumbnail/' . $thumbnailName;
        }

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($product->images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
            $data['images'] = $imagePaths;
        }

        $product->update($data);

        return redirect()->route('productsoem')->with('success', 'Product updated successfully!');
    }

    public function OEMdestroy($id)
    {
        $product = OEM::findOrFail($id);
        
        // Delete associated files
        if (file_exists(public_path($product->product_thumbnail))) {
            unlink(public_path($product->product_thumbnail));
        }
        foreach ($product->images as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}