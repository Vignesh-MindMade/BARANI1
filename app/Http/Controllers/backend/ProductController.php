<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductTextile;
use App\Models\Backend\Textile;

class ProductController extends Controller
{

    public function categoryStore(Request $request)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|string|max:255',
        ]);

        ProductTextile::create([
            'catagory_name' => $validated['catagory_name'],
        ]);

        return redirect()->route('productstextile')->with('success', 'Category created successfully!');
    }

    public function categoryEdit($id)
    {
        $category = ProductTextile::findOrFail($id);
        return view('backend.product.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|string|max:255',
        ]);

        $category = ProductTextile::findOrFail($id);
        $category->update([
            'catagory_name' => $validated['catagory_name'],
        ]);

        return redirect()->route('productstextile')->with('success', 'Category updated successfully!');
    }

    public function categoryDestroy($id)
    {
        $category = ProductTextile::findOrFail($id);
        if ($category->textiles()->count() > 0) {
            return redirect()->route('productstextile')->with('error', 'Cannot delete category with associated products!');
        }
        $category->delete();
        return redirect()->route('productstextile')->with('success', 'Category deleted successfully!');
    }

    public function index()
    {
        $products = Textile::with('productTextile')->get();
        $categories = ProductTextile::all();
        return view('backend.product.textile', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_textile_id' => 'required|exists:product_textiles,id',
            'product_thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'product_brouchure' => 'required|mimes:pdf|max:5000', 
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points' => 'nullable|array',
        ]);

        $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();
        $request->file('product_thumbnail')->move(public_path('uploads/thumbnail'), $thumbnailName);
        $thumbnailPath = 'uploads/thumbnail/' . $thumbnailName;

        $brochureName = time() . '_brochure_' . uniqid() . '.' . $request->file('product_brouchure')->getClientOriginalExtension();
        $request->file('product_brouchure')->move(public_path('uploads/brochures'), $brochureName);
        $brochurePath = 'uploads/brochures/' . $brochureName;

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
        }

        Textile::create([
            'product_textile_id' => $request->product_textile_id,
            'product_thumbnail' => $thumbnailPath,
            'product_brouchure' => $brochurePath, 
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'images' => json_encode($imagePaths),
            'points' => json_encode($request->points),
        ]);

        return redirect()->route('productstextile')->with('success', 'Product created successfully!');
    }


    public function edit($id)
    {
        $product = Textile::findOrFail($id);
        $categories = ProductTextile::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_textile_id' => 'required|exists:product_textiles,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'product_brouchure' => 'nullable|mimes:pdf|max:5000', 
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points' => 'nullable|array',
        ]);

        $product = Textile::findOrFail($id);

        $data = [
            'product_textile_id' => $request->product_textile_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'points' => json_encode($request->points),
        ];

        if ($request->hasFile('product_thumbnail')) {
            if ($product->product_thumbnail && file_exists(public_path($product->product_thumbnail))) {
                unlink(public_path($product->product_thumbnail));
            }
            $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();
            $request->file('product_thumbnail')->move(public_path('uploads/thumbnail'), $thumbnailName);
            $data['product_thumbnail'] = 'uploads/thumbnail/' . $thumbnailName;
        }

        if ($request->hasFile('product_brouchure')) {
            if ($product->product_brouchure && file_exists(public_path($product->product_brouchure))) {
                unlink(public_path($product->product_brouchure));
            }
            $brochureName = time() . '_brochure_' . uniqid() . '.' . $request->file('product_brouchure')->getClientOriginalExtension();
            $request->file('product_brouchure')->move(public_path('uploads/brochures'), $brochureName);
            $data['product_brouchure'] = 'uploads/brochures/' . $brochureName;
        }

        $imagePaths = $product->images ? json_decode($product->images, true) : [];
        if ($request->hasFile('images')) {
            foreach ($imagePaths as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
            $data['images'] = json_encode($imagePaths);
        }

        $product->update($data);

        return redirect()->route('productstextile')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Textile::findOrFail($id);

        if (file_exists(public_path($product->product_thumbnail))) {
            unlink(public_path($product->product_thumbnail));
        }

        
        $images = $product->images ? json_decode($product->images, true) : [];
        foreach ($images as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }

        $product->delete();
        return redirect()->route('productstextile')->with('success', 'Product deleted successfully!');
    }
}