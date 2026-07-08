<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCatagory;
use App\Models\Products;
use App\Models\productarchive;

class ProductController extends Controller
{
    public function index(){
        $catagorys = ProductCatagory::orderBy('sort_id', 'asc')->get();
        return view('Backend.Product.index', compact('catagorys'));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;

        $products = Products::where('product_title', 'LIKE', "%{$keyword}%")->get();

        if ($products->count() === 1) {
            return redirect()->route('product.detail', $products->first()->slug);
        }

        if ($products->count() > 1) {
            return view('products.search_results', compact('products', 'keyword'));
        }

        return view('products.search_results', [
            'products' => [],
            'keyword' => $keyword,
            'message' => 'No product found'
        ]);
    }

    public function suggestions(Request $request)
    {
        $search = $request->get('query');

        $suggestions = Products::where('product_title', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get(['product_title', 'slug']);

        return response()->json($suggestions);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catagory' => 'required|string|max:255',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $catagorys = new ProductCatagory;
        $catagorys->catagory = $validatedData['catagory'];
        $catagorys->sort_id = $validatedData['sort_id'];
        $catagorys->save();

        return redirect()->back()->with('success', 'catagory created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'catagory' => 'required|string|max:255',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $catagorys = ProductCatagory::findOrFail($id);
        $catagorys->catagory = $validatedData['catagory'];
        $catagorys->sort_id = $validatedData['sort_id'];
        $catagorys->save();

        return redirect()->route('product_catagory.index')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $catagorys = ProductCatagory::findOrFail($id);
        $catagorys->delete();

        return redirect()->back()->with('success', 'catagory deleted successfully.');
    }

    public function viewindex()
    {
        $products = Products::all();
        $categories = ProductCatagory::orderBy('sort_id', 'asc')->get();

        return view('Backend.Product.view', compact('products', 'categories'));
    }
public function viewupdate(Request $request, $id)
{
    $validatedData = $request->validate([
        'catagory_id' => 'required|exists:product_catagory,id',
        'product_title' => 'required|string|max:255',
        'product_description' => 'required|string',

        'Section_2_title' => 'nullable|string|max:255',
        'Point_1_title' => 'nullable|string|max:255',
        'Point_2_title' => 'nullable|string|max:255',
        'Point_3_title' => 'nullable|string|max:255',
        'Section_3_title' => 'nullable|string|max:255',
        'Section_4_title' => 'nullable|string|max:255',

        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        
        'product_broucher' => 'nullable|mimes:pdf,doc,docx|max:5120',
        
        'product_image' => 'nullable|array|max:10',  // Limit count; mimes on items below
        'product_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        'product_video_url' => 'nullable|url|max:500',
        'product_video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:102400',

        'industries_used_in_description' => 'nullable|string',
        'industries_used_in_automotive_points' => 'nullable|string',
        'industries_used_in_consumer_goods_points' => 'nullable|string',
        'industries_used_in_industrial_machinery_points' => 'nullable|string',

        'features_points' => 'nullable|json',
        'specifications_points' => 'nullable|json',

        'optional_title' => 'nullable|string|max:255',

        'attachment_1_image' => 'nullable|mimes:webp,jpeg,jpg|max:5000',
        'attachment_1_catagory_points' => 'nullable|string',
        'attachment_1_title' => 'nullable|string|max:255',
        'attachment_1_description' => 'nullable|string',

        'attachment_2_image' => 'nullable|mimes:webp,jpeg,jpg|max:5000',
        'attachment_2_catagory_points' => 'nullable|string',
        'attachment_2_title' => 'nullable|string|max:255',
        'attachment_2_description' => 'nullable|string',

        'attachments_collection' => 'nullable|json',
        'existing_product_images' => 'nullable|json',  // For JS-sent removals
    ]);

    $product = Products::findOrFail($id);

    // Update text fields ONLY (exclude files to avoid serialization errors)
    $textFields = $request->except([
        'banner', 'product_image', 'product_broucher', 'product_video_url', 'product_video_file',
        'attachment_1_image', 'attachment_2_image', 'attachments_collection', 'existing_product_images',
    ]);
    $product->update($textFields);

    // Handle video logic (mirror viewstore)
    $removeVideo = $request->boolean('product_video_remove', false);
    $videoValue = $product->product_video;  // Preserve existing

    if ($removeVideo) {
        if ($videoValue && !str_starts_with($videoValue, 'http')) {
            $oldPath = public_path('uploads/products/' . $videoValue);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $videoValue = null;
    }

    if ($request->filled('product_video_url')) {
        $videoValue = $request->input('product_video_url');
    } elseif ($request->hasFile('product_video_file')) {
        // Delete old if local file
        if ($videoValue && !str_starts_with($videoValue, 'http')) {
            $oldPath = public_path('uploads/products/' . $videoValue);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $video = time() . '_video.' . $request->product_video_file->extension();
        $request->product_video_file->move(public_path('uploads/products'), $video);
        $videoValue = $video;
    }
    $product->product_video = $videoValue;

    // Banner
    if ($request->hasFile('banner')) {
        // Delete old
        if ($product->banner) {
            $oldPath = public_path('uploads/products/' . $product->banner);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $banner = time() . '_banner.' . $request->banner->extension();
        $request->banner->move(public_path('uploads/products'), $banner);
        $product->banner = $banner;
    }

    // Product images (merged: removal + append)
   // ✅ TRUST FRONTEND STATE
$updatedImages = json_decode($request->input('existing_product_images', '[]'), true);
if (!is_array($updatedImages)) {
    $updatedImages = [];
}

// Old images from DB
$oldImages = $product->product_image;
if (!is_array($oldImages)) {
    $oldImages = $oldImages ? json_decode($oldImages, true) : [];
}
if (!is_array($oldImages)) {
    $oldImages = [];
}

// Determine removed images
$removedImages = array_diff($oldImages, $updatedImages);

// Delete removed files
foreach ($removedImages as $img) {
    $path = public_path('uploads/products/' . $img);
    if (file_exists($path)) unlink($path);
}

// Start with updated list
$productImages = $updatedImages;


    // Append new ones
    if ($request->hasFile('product_image')) {
        foreach ($request->file('product_image') as $index => $imageFile) {
            $filename = time() . '_product_image_' . ($index + 1) . '.' . $imageFile->extension();
            $imageFile->move(public_path('uploads/products'), $filename);
            $productImages[] = $filename;
        }
    }
    $product->product_image = !empty($productImages) ? json_encode($productImages) : null;

    // Brochure
    if ($request->hasFile('product_broucher')) {
        // Delete old
        if ($product->product_broucher) {
            $oldPath = public_path('uploads/products/' . $product->product_broucher);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $brochure = time() . '_brochure.' . $request->product_broucher->extension();
        $request->product_broucher->move(public_path('uploads/products'), $brochure);
        $product->product_broucher = $brochure;
    }

    // Legacy attachments
    if ($request->hasFile('attachment_1_image')) {
        // Delete old
        if ($product->attachment_1_image) {
            $oldPath = public_path('uploads/products/' . $product->attachment_1_image);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $image = time() . '_image.' . $request->attachment_1_image->extension();
        $request->attachment_1_image->move(public_path('uploads/products'), $image);
        $product->attachment_1_image = $image;
    }

    if ($request->hasFile('attachment_2_image')) {
        // Delete old
        if ($product->attachment_2_image) {
            $oldPath = public_path('uploads/products/' . $product->attachment_2_image);
            if (file_exists($oldPath)) unlink($oldPath);
        }
        $image = time() . '_image.' . $request->attachment_2_image->extension();
        $request->attachment_2_image->move(public_path('uploads/products'), $image);
        $product->attachment_2_image = $image;
    }

    // Attachments collection (unchanged, good)
    if ($request->filled('attachments_collection')) {
        $attachmentsJson = json_decode($request->input('attachments_collection'), true);
        if (is_array($attachmentsJson)) {
            $processedAttachments = [];
            foreach ($attachmentsJson as $index => $attachment) {
                $fileInputName = 'attachment_image_' . ($index + 1);
                if ($request->hasFile($fileInputName)) {
                    // Delete old
                    if (!empty($attachment['image'])) {
                        $oldPath = public_path('uploads/products/' . $attachment['image']);
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $file = $request->file($fileInputName);
                    $filename = time() . '_attachment_' . ($index + 1) . '.' . $file->extension();
                    $file->move(public_path('uploads/products'), $filename);
                    $attachment['image'] = $filename;
                }
                $processedAttachments[] = $attachment;
            }
            $product->attachments_collection = json_encode($processedAttachments);
        }
    }

    $product->save();

    return back()->with('success', 'Product updated successfully!');
}

    public function viewstore(Request $request)
    {
        $validatedData = $request->validate([
            'catagory_id' => 'required|exists:product_catagory,id',
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',

            'Section_2_title' => 'nullable|string|max:255',
            'Point_1_title' => 'nullable|string|max:255',
            'Point_2_title' => 'nullable|string|max:255',
            'Point_3_title' => 'nullable|string|max:255',
            'Section_3_title' => 'nullable|string|max:255',
            'Section_4_title' => 'nullable|string|max:255',

            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            
            'product_broucher' => 'nullable|mimes:pdf,doc,docx|max:5120',
            
            'product_image' => 'nullable|array|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'product_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'product_video_url' => 'nullable|url|max:500',
            'product_video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:102400',

            'industries_used_in_description' => 'nullable|string',
            'industries_used_in_automotive_points' => 'nullable|string',
            'industries_used_in_consumer_goods_points' => 'nullable|string',
            'industries_used_in_industrial_machinery_points' => 'nullable|string',

            'features_points' => 'nullable|json',
            'specifications_points' => 'nullable|json',

            'optional_title' => 'nullable|string|max:255',

            'attachment_1_image' => 'nullable|mimes:webp,jpeg,jpg|max:5000',
            'attachment_1_catagory_points' => 'nullable|string',
            'attachment_1_title' => 'nullable|string|max:255',
            'attachment_1_description' => 'nullable|string',

            'attachment_2_image' => 'nullable|mimes:webp,jpeg,jpg|max:5000',
            'attachment_2_catagory_points' => 'nullable|string',
            'attachment_2_title' => 'nullable|string|max:255',
            'attachment_2_description' => 'nullable|string',

            'attachments_collection' => 'nullable|json',
        ]);

        // Handle video logic
        $videoValue = null;
        if ($request->filled('product_video_url')) {
            $videoValue = $request->input('product_video_url');
        } elseif ($request->hasFile('product_video_file')) {
            $video = time() . '_video.' . $request->product_video_file->extension();
            $request->product_video_file->move(public_path('uploads/products'), $video);
            $videoValue = $video;
        }
        $validatedData['product_video'] = $videoValue;

        // Banner
        if ($request->hasFile('banner')) {
            $banner = time() . '_banner.' . $request->banner->extension();
            $request->banner->move(public_path('uploads/products'), $banner);
            $validatedData['banner'] = $banner;
        }

        // product image
     // product image (multiple)
$productImages = [];
if ($request->hasFile('product_image')) {
    foreach ($request->file('product_image') as $index => $imageFile) {
        $filename = time() . '_product_image_' . ($index + 1) . '.' . $imageFile->extension();
        $imageFile->move(public_path('uploads/products'), $filename);
        $productImages[] = $filename;  // Collect paths
    }
}
$validatedData['product_image'] = !empty($productImages) ? json_encode($productImages) : null;

        // Handle attachments_collection with image uploads
        if ($request->filled('attachments_collection')) {
            $attachmentsJson = json_decode($request->input('attachments_collection'), true);
            if (is_array($attachmentsJson)) {
                $processedAttachments = [];
                foreach ($attachmentsJson as $index => $attachment) {
                    $fileInputName = 'attachment_image_' . ($index + 1);
                    
                    // Check if a new file was uploaded for this attachment
                    if ($request->hasFile($fileInputName)) {
                        $file = $request->file($fileInputName);
                        $filename = time() . '_attachment_' . ($index + 1) . '.' . $file->extension();
                        $file->move(public_path('uploads/products'), $filename);
                        $attachment['image'] = $filename;
                    }
                    // If no new file, keep the existing image filename from JSON
                    
                    $processedAttachments[] = $attachment;
                }
                $validatedData['attachments_collection'] = json_encode($processedAttachments);
            }
        }

        // Legacy attachments (attachment_1 and attachment_2)
        if ($request->hasFile('attachment_1_image')) {
            $image = time() . '_image.' . $request->attachment_1_image->extension();
            $request->attachment_1_image->move(public_path('uploads/products'), $image);
            $validatedData['attachment_1_image'] = $image;
        }

        if ($request->hasFile('attachment_2_image')) {
            $image = time() . '_image.' . $request->attachment_2_image->extension();
            $request->attachment_2_image->move(public_path('uploads/products'), $image);
            $validatedData['attachment_2_image'] = $image;
        }

        // brochure
        if ($request->hasFile('product_broucher')) {
            $brochure = time() . '_brochure.' . $request->product_broucher->extension();
            $request->product_broucher->move(public_path('uploads/products'), $brochure);
            $validatedData['product_broucher'] = $brochure;
        }

        Products::create($validatedData);

        return redirect()->route('viewindex.index')->with('success', 'Product created successfully!');
    }

    public function viewdelete($id)
    {
        $product = Products::findOrFail($id);

        if ($product->banner) {
            $bannerPath = public_path('uploads/products/' . $product->banner);
            if (file_exists($bannerPath)) unlink($bannerPath);
        }

        if ($product->product_image) {
            $imagePaths = $product->product_image;
            if (!is_array($imagePaths)) {
                $imagePaths = $imagePaths ? json_decode($imagePaths, true) : [];
            }
            if (!is_array($imagePaths)) {
                $imagePaths = [$imagePaths];
            }
            foreach ($imagePaths as $imagePath) {
                if (is_string($imagePath)) {
                    $fullPath = public_path('uploads/products/' . $imagePath);
                    if (file_exists($fullPath)) unlink($fullPath);
                }
            }
        }
        if ($product->product_broucher) {
            $brochurePath = public_path('uploads/products/' . $product->product_broucher);
            if (file_exists($brochurePath)) unlink($brochurePath);
        }

        if ($product->product_video && !str_starts_with($product->product_video, 'http')) {
            $videoPath = public_path('uploads/products/' . $product->product_video);
            if (file_exists($videoPath)) unlink($videoPath);
        }

        $product->delete();

        return redirect()->route('viewindex.index')->with('success', 'Product deleted successfully!');
    }

    public function detail($slug)
    {
        $product = Products::where('slug', $slug)->firstOrFail();
        return view('frontend.product.detatil', compact('product'));
    }

    public function archive($slug)
    {
        $category = ProductCatagory::where('slug', $slug)->firstOrFail();
        $products = Products::where('catagory_id', $category->id)->get();
        $bannerProduct = Products::where('catagory_id', $category->id)->first();
        $categories = ProductCatagory::orderBy('sort_id', 'asc')->get();
        $archiveContent = productarchive::where('category_id', $category->id)->first();


        return view('frontend.product.arachive', compact(
            'products', 'categories', 'category', 'bannerProduct' ,'archiveContent'
        ));
    }
}
