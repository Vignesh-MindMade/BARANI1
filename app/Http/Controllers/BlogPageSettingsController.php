<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogPageSettings;

class BlogPageSettingsController extends Controller
{
    //
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
        $settings = BlogPageSettings::first();
        return view('Backend.blog.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            'banner_title' => 'required|string|max:255',
            'section_subtitle' => 'nullable|string|max:255',
            'section_title' => 'required|string|max:255',
            'section_description' => 'nullable|string',
        ]);

        $settings = BlogPageSettings::firstOrNew();

        if ($request->hasFile('banner_image')) {
            $imagePath = $request->file('banner_image')->store('blog_banner_images', 'public');
            $settings->banner_image = $imagePath;
        }

        $settings->banner_title = $request->input('banner_title');
        $settings->section_subtitle = $request->input('section_subtitle');
        $settings->section_title = $request->input('section_title');
        $settings->section_description = $request->input('section_description');

        $settings->save();

        return redirect()->back()->with('success', 'Blog page settings updated successfully.');
    }

    public function destroyBannerImage()
    {
        $settings = BlogPageSettings::first();
        if ($settings && $settings->banner_image) {
            // Delete the image file from storage
            \Storage::disk('public')->delete($settings->banner_image);
            // Remove the image path from the database
            $settings->banner_image = null;
            $settings->save();
        }

        return redirect()->back()->with('success', 'Banner image deleted successfully.');
    }

    

}
