<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BlogPageSettings;

class BlogsController extends Controller
{

public function frontendIndex()
{
    $blogSettings = BlogPageSettings::first();
    $blogs = Blogs::where('status', 1)
                  ->orderBy('sort_order')
                  ->orderByDesc('published_at')
                  ->with('images')
                  ->get();

    return view('frontend.blog.index', compact('blogSettings', 'blogs'));
}
public function index()
    {
        $blogs = Blogs::orderBy('sort_order')
            ->orderByDesc('published_at')
            ->get();

        return view('Backend.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('Backend.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:blogs,slug',
            'description'   => 'nullable|string',

            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'type'          => 'required|in:pdf,video,gallery',

            'pdf_file'      => 'nullable|mimes:pdf|max:10240',

            'video_source'  => 'nullable|in:youtube,vimeo,local',

            'video_file'    => 'nullable|mimes:mp4,mov,avi,mkv|max:51200',

            'video_url'     => 'nullable|url',

            'published_at'  => 'nullable|date',

            'status'        => 'required|boolean',

            'sort_order'    => 'nullable|integer',

            'gallery_images.*' => 'nullable|image|max:4096',
        ]);

        $blog = new Blogs();

        $blog->title         = $request->title;
        $blog->slug          = $request->slug;
        $blog->description   = $request->description;
        $blog->type          = $request->type;
        $blog->video_source  = $request->video_source;
        $blog->video_url     = $request->video_url;
        $blog->published_at  = $request->published_at;
        $blog->status        = $request->status;
        $blog->sort_order    = $request->sort_order ?? 0;

        if ($request->hasFile('thumbnail')) {
            $blog->thumbnail = $request->file('thumbnail')
                ->store('blogs/thumbnails', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $blog->pdf_file = $request->file('pdf_file')
                ->store('blogs/pdf', 'public');
        }

        if ($request->hasFile('video_file')) {
            $blog->video_file = $request->file('video_file')
                ->store('blogs/videos', 'public');
        }

        $blog->save();

        // Gallery Images
        if ($request->hasFile('gallery_images')) {

            foreach ($request->file('gallery_images') as $index => $image) {

                BlogsImages::create([
                    'blog_id'    => $blog->id,
                    'image'      => $image->store('blogs/gallery', 'public'),
                    'caption'    => null,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blogs::with('images')->findOrFail($id);

        return view('Backend.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blogs::with('images')->findOrFail($id);

        $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:blogs,slug,' . $blog->id,

            'description'   => 'nullable|string',

            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'type'          => 'required|in:pdf,video,gallery',

            'pdf_file'      => 'nullable|mimes:pdf|max:10240',

            'video_source'  => 'nullable|in:youtube,vimeo,local',

            'video_file'    => 'nullable|mimes:mp4,mov,avi,mkv|max:51200',

            'video_url'     => 'nullable|url',

            'published_at'  => 'nullable|date',

            'status'        => 'required|boolean',

            'sort_order'    => 'nullable|integer',

            'gallery_images.*' => 'nullable|image|max:4096',
        ]);

        $blog->title         = $request->title;
        $blog->slug          = $request->slug;
        $blog->description   = $request->description;
        $blog->type          = $request->type;
        $blog->video_source  = $request->video_source;
        $blog->video_url     = $request->video_url;
        $blog->published_at  = $request->published_at;
        $blog->status        = $request->status;
        $blog->sort_order    = $request->sort_order ?? 0;

        if ($request->hasFile('thumbnail')) {

            if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $blog->thumbnail = $request->file('thumbnail')
                ->store('blogs/thumbnails', 'public');
        }

        if ($request->hasFile('pdf_file')) {

            if ($blog->pdf_file && Storage::disk('public')->exists($blog->pdf_file)) {
                Storage::disk('public')->delete($blog->pdf_file);
            }

            $blog->pdf_file = $request->file('pdf_file')
                ->store('blogs/pdf', 'public');
        }

        if ($request->hasFile('video_file')) {

            if ($blog->video_file && Storage::disk('public')->exists($blog->video_file)) {
                Storage::disk('public')->delete($blog->video_file);
            }

            $blog->video_file = $request->file('video_file')
                ->store('blogs/videos', 'public');
        }

        $blog->save();

        // Add New Gallery Images
        if ($request->hasFile('gallery_images')) {

            $lastOrder = BlogsImages::where('blog_id', $blog->id)->max('sort_order') ?? 0;

            foreach ($request->file('gallery_images') as $image) {

                $lastOrder++;

                BlogsImages::create([
                    'blog_id'    => $blog->id,
                    'image'      => $image->store('blogs/gallery', 'public'),
                    'caption'    => null,
                    'sort_order' => $lastOrder,
                ]);
            }
        }

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blogs::with('images')->findOrFail($id);

        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        if ($blog->pdf_file && Storage::disk('public')->exists($blog->pdf_file)) {
            Storage::disk('public')->delete($blog->pdf_file);
        }

        if ($blog->video_file && Storage::disk('public')->exists($blog->video_file)) {
            Storage::disk('public')->delete($blog->video_file);
        }

        foreach ($blog->images as $image) {

            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            $image->delete();
        }

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}