<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blogs;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
        $blogs = Blogs::active()->ordered()->get();

        // Get the first blog's banner data for the page header
        // Or create a separate settings table if banner is global
        $pageBanner = $blogs->first();

        return view('blogs.index', compact('blogs', 'pageBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function show(Blogs $blog)
    {
        if (!$blog->is_active) {
            abort(404);
        }

        $blog->load('images');

        // Return JSON for AJAX popup requests
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'blog' => [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'description' => $blog->description,
                    'type' => $blog->type,
                    'thumbnail_url' => $blog->thumbnail_url,
                    'pdf_url' => $blog->pdf_url,
                    'video_source' => $blog->video_source,
                    'video_file' => $blog->video_file ? asset('storage/' . $blog->video_file) : null,
                    'video_url' => $blog->video_url,
                    'embed_url' => $blog->embed_url,
                    'video_thumbnail_url' => $blog->video_thumbnail_url,
                ],
                'images' => $blog->images->map(function ($img) {
                    return [
                        'id' => $img->id,
                        'url' => $img->image_url,
                        'caption' => $img->caption,
                    ];
                }),
            ]);
        }

        // For PDF, redirect to viewer
        if ($blog->type === 'pdf') {
            return redirect()->route('blogs.pdf.view', $blog);
        }

        return view('blogs.show', compact('blog'));
    }

    public function viewPdf(Blogs $blog)
    {
        if ($blog->type !== 'pdf' || !$blog->pdf_file) {
            abort(404);
        }

        $path = storage_path('app/public/' . $blog->pdf_file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }

    public function downloadPdf(Blogs $blog)
    {
        if ($blog->type !== 'pdf' || !$blog->pdf_file) {
            abort(404);
        }

        return Storage::disk('public')->download($blog->pdf_file, Str::slug($blog->title) . '.pdf');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
