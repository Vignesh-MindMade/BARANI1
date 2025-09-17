<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductFood;
use App\Models\Backend\Food;
use Illuminate\Http\Request;
use App\Models\Backend\ContactUsForm;

class FoodController extends Controller
{
    public function CategoryStorefood(Request $request)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|string|max:255',
        ]);
        ProductFood::create([
            'catagory_name' => $validated['catagory_name'],
        ]);
        return redirect()->back()->with('success_category', 'Category stored successfully!');
    }

    public function categoryEdit($id)
    {
        $category = ProductFood::findOrFail($id);
        return view('backend.product.food_category', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = ProductFood::findOrFail($id);
        $category->update([
            'category_name' => $validated['category_name'],
        ]);
        return redirect()->route('productsfood')->with('success_category', 'Category updated successfully!');
    }
    public function categoryDestroy($id)
    {
        $category = ProductFood::findOrFail($id);
        $category->delete();
        return redirect()->route('productsfood')->with('success_category', 'Category deleted successfully!');
    }
    public function Foodindex()
    {
        $products = Food::with('ProductFood')->get();
        $categories = ProductFood::all();
        return view('backend.product.food', compact('products', 'categories'));
    }
    public function Foodstore(Request $request)
    {
        $validated = $request->validate([
            'product_food_id' => 'required|exists:product_food,id',
            'product_thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_brouchure' => 'required|mimes:pdf|max:5000',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points.*' => 'nullable|string',
        ]);
        // Save thumbnail
        $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' . $validated['product_thumbnail']->getClientOriginalExtension();
        $validated['product_thumbnail']->move(public_path('uploads/thumbnail'), $thumbnailName);
        $thumbnailPath = 'uploads/thumbnail/' . $thumbnailName;

        // Save brochure
        $brochureName = time() . '_brochure_' . uniqid() . '.' . $validated['product_brouchure']->getClientOriginalExtension();
        $validated['product_brouchure']->move(public_path('uploads/brochures'), $brochureName);
        $brochurePath = 'uploads/brochures/' . $brochureName;

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
        }
        Food::create([
            'product_food_id' => $validated['product_food_id'],
            'product_thumbnail' => $thumbnailPath,
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'product_brouchure' => $brochurePath,
            'images' => json_encode($imagePaths),
            'points' => json_encode($validated['points'] ?? []),
        ]);
        return redirect()->back()->with('success_product', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Food::findOrFail($id);
        $categories = ProductFood::all();
        return view('backend.product.productfoodedit', compact('product', 'categories'));
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_food_id' => 'required|exists:product_food,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_brouchure' => 'nullable|mimes:pdf|max:5000',
            'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'points.*' => 'nullable|string',
        ]);

        $product = Food::findOrFail($id);

        $data = [
            'product_food_id' => $validated['product_food_id'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'] ?? null,
            'points' => json_encode(array_filter($validated['points'] ?? [])),
        ];

        if ($request->hasFile('product_thumbnail')) {
            if ($product->product_thumbnail && file_exists(public_path($product->product_thumbnail))) {
                @unlink(public_path($product->product_thumbnail));
            }
            $thumbnailName = time() . '_thumbnail_' . uniqid() . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();
            $request->file('product_thumbnail')->move(public_path('uploads/thumbnail'), $thumbnailName);
            $data['product_thumbnail'] = 'uploads/thumbnail/' . $thumbnailName;
        }

        if ($request->hasFile('product_brouchure')) {
            if ($product->product_brouchure && file_exists(public_path($product->product_brouchure))) {
                @unlink(public_path($product->product_brouchure));
            }
            $brochureName = time() . '_brochure_' . uniqid() . '.' . $request->file('product_brouchure')->getClientOriginalExtension();
            $request->file('product_brouchure')->move(public_path('uploads/brochures'), $brochureName);
            $data['product_brouchure'] = 'uploads/brochures/' . $brochureName;
        }

        $imagePaths = json_decode($product->images ?? '[]', true) ?: [];
        if ($request->hasFile('images')) {
            foreach ($imagePaths as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_image_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePaths[] = 'uploads/images/' . $imageName;
            }
        }
        $data['images'] = json_encode($imagePaths);

        $product->update($data);

        return redirect()->route('productsfood')->with('success_product', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Food::findOrFail($id);

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
        return redirect()->route('productsfood')->with('success_product', 'Product deleted successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'mobile_number' => 'required|digits:10',
            'email'         => 'required|email|max:255',
            'subject'       => 'required|string|max:255',
            'message'       => 'required|string',
        ]);

        // Store in DB
        ContactUsForm::create($validated);

        // Send to Google Sheet
        $googleScriptUrl = "https://script.google.com/macros/s/AKfycbytFSTMssLcZJcd0sVDXx8GZFsdTcw2vhXZmeWRWm4tXtOsyDaKL7nFXdEhEF3IE_wF/exec"; // paste the Web App URL from Step 1

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post($googleScriptUrl, [
                'json' => $validated
            ]);
        } catch (\Exception $e) {
            \Log::error("Google Sheet error: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }



}