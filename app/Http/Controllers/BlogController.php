<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogsImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blogs::with('images')->orderBy('sort_order')->paginate(20);
        return view('Backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateBlog($request);
        $blog = new Blogs();
        $blog->fill($validated);

        $this->handleFileUploads($request, $blog);
        $this->handleTypeSpecificContent($request, $blog);

        $blog->save();

        // Handle image gallery
        if ($request->type === 'image') {
            $this->handleGalleryUpload($request, $blog);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogs $blog)
    {
        $blog->load('images');
        return view('Backend.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blog)
    {
        $validated = $this->validateBlog($request, $blog->id);

        $blog->fill($validated);

        // Handle file uploads (with replacement)
        $this->handleFileUploads($request, $blog, true);

        // Handle type-specific content
        $this->handleTypeSpecificContent($request, $blog, true);

        $blog->save();

        // Handle image gallery updates
        if ($request->type === 'image') {
            $this->handleGalleryUpdate($request, $blog);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blog)
    {
        $blog->delete(); // Files cleaned up in model boot()
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // ==================== VALIDATION ====================

    private function validateBlog(Request $request, $id = null)
    {
        $rules = [
            'banner_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner_title'     => 'nullable|string|max:255',
            'section1_subtitle' => 'nullable|string|max:255',
            'section1_title'   => 'nullable|string|max:255',
            'section1_description' => 'nullable|string',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'card_thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'type'             => 'required|in:pdf,video,image',
            'published_date'   => 'nullable|date',
            'is_active'        => 'boolean',
            'sort_order'       => 'integer|min:0',
        ];

        // Type-specific rules
        if ($request->type === 'pdf') {
            $rules['pdf_file'] = ($id ? 'nullable' : 'required') . '|file|mimes:pdf|max:10240';
        }

        if ($request->type === 'video') {
            $rules['video_source'] = 'required|in:upload,link';
            $rules['video_file'] = $request->video_source === 'upload' && !$id
                ? 'required|file|mimes:mp4,webm,ogg,mov|max:102400'
                : 'nullable|file|mimes:mp4,webm,ogg,mov|max:102400';
            $rules['video_url'] = $request->video_source === 'link' ? 'required|url' : 'nullable|url';
            $rules['video_thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        if ($request->type === 'image') {
            $rules['gallery_images'] = 'nullable|array';
            $rules['gallery_images.*'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
            $rules['gallery_captions'] = 'nullable|array';
        }

        return $request->validate($rules);
    }

    // ==================== FILE UPLOAD HANDLERS ====================

    private function handleFileUploads(Request $request, Blogs $blog, $isUpdate = false)
    {
        // Banner Image
        if ($request->hasFile('banner_image')) {
            if ($isUpdate && $blog->banner_image) {
                Storage::disk('public')->delete($blog->banner_image);
            }
            $blog->banner_image = $request->file('banner_image')->store('blogs/banners', 'public');
        }

        // Card Thumbnail
        if ($request->hasFile('card_thumbnail')) {
            if ($isUpdate && $blog->card_thumbnail) {
                Storage::disk('public')->delete($blog->card_thumbnail);
            }
            $blog->card_thumbnail = $request->file('card_thumbnail')->store('blogs/thumbnails', 'public');
        }
    }

    // ==================== TYPE-SPECIFIC HANDLERS ====================

    private function handleTypeSpecificContent(Request $request, Blogs $blog, $isUpdate = false)
    {
        // PDF
        if ($request->type === 'pdf') {
            if ($request->hasFile('pdf_file')) {
                if ($isUpdate && $blog->pdf_file) {
                    Storage::disk('public')->delete($blog->pdf_file);
                }
                $blog->pdf_file = $request->file('pdf_file')->store('blogs/pdfs', 'public');
            }
            // Clear video fields
            $blog->video_source = null;
            $blog->video_file = null;
            $blog->video_url = null;
            $blog->video_thumbnail = null;
        }

        // Video
        if ($request->type === 'video') {
            $blog->video_source = $request->video_source;

            if ($request->video_source === 'upload') {
                if ($request->hasFile('video_file')) {
                    if ($isUpdate && $blog->video_file) {
                        Storage::disk('public')->delete($blog->video_file);
                    }
                    $blog->video_file = $request->file('video_file')->store('blogs/videos', 'public');
                    $blog->video_url = null;
                }
            } else {
                // Link source
                if ($isUpdate && $blog->video_file) {
                    Storage::disk('public')->delete($blog->video_file);
                }
                $blog->video_file = null;
                $blog->video_url = $request->video_url;
            }

            if ($request->hasFile('video_thumbnail')) {
                if ($isUpdate && $blog->video_thumbnail) {
                    Storage::disk('public')->delete($blog->video_thumbnail);
                }
                $blog->video_thumbnail = $request->file('video_thumbnail')->store('blogs/video-thumbnails', 'public');
            }

            // Clear PDF
            if ($isUpdate && $blog->pdf_file) {
                Storage::disk('public')->delete($blog->pdf_file);
                $blog->pdf_file = null;
            }
        }

        // Image
        if ($request->type === 'image') {
            // Clear PDF and video fields
            if ($isUpdate) {
                if ($blog->pdf_file) {
                    Storage::disk('public')->delete($blog->pdf_file);
                    $blog->pdf_file = null;
                }
                if ($blog->video_file) {
                    Storage::disk('public')->delete($blog->video_file);
                    $blog->video_file = null;
                }
                if ($blog->video_thumbnail) {
                    Storage::disk('public')->delete($blog->video_thumbnail);
                    $blog->video_thumbnail = null;
                }
            }
            $blog->video_source = null;
            $blog->video_url = null;
        }
    }

    // ==================== GALLERY HANDLERS ====================

    private function handleGalleryUpload(Request $request, Blogs $blog)
    {
        if (!$request->hasFile('gallery_images')) return;

        foreach ($request->file('gallery_images') as $index => $image) {
            $path = $image->store('blogs/galleries', 'public');

            BlogsImages::create([
                'blog_id' => $blog->id,
                'image_path' => $path,
                'caption' => $request->input("gallery_captions.{$index}"),
                'sort_order' => $index,
            ]);
        }
    }

    private function handleGalleryUpdate(Request $request, Blogs $blog)
    {
        // Delete removed images
        if ($request->has('deleted_image_ids')) {
            $deletedIds = array_filter(explode(',', $request->deleted_image_ids));
            $imagesToDelete = BlogsImages::where('blog_id', $blog->id)->whereIn('id', $deletedIds)->get();

            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Add new images
        if ($request->hasFile('gallery_images')) {
            $lastOrder = $blog->images()->max('sort_order') ?? -1;

            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('blogs/galleries', 'public');

                BlogsImages::create([
                    'blog_id' => $blog->id,
                    'image_path' => $path,
                    'caption' => $request->input("gallery_captions.{$index}"),
                    'sort_order' => $lastOrder + $index + 1,
                ]);
            }
        }
    }

    // ==================== AJAX: REORDER IMAGES ====================

    public function reorderImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:blogs_images,id',
            'images.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->images as $item) {
            BlogsImages::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}