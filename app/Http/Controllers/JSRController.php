<?php

namespace App\Http\Controllers;
use App\Models\JSR;
use Illuminate\Http\Request;

class JSRController extends Controller
{
    /**
     * Display frontend JSR page
     */
    public function frontendIndex()
    {
        $jsrfront = JSR::all();
        return view('frontend.jsr.jsr', compact('jsrfront'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jsr = JSR::all();
        return view('Backend.jsr.index', compact('jsr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'menu_name' => 'nullable|string',
            'banner_text' => 'nullable|string',
            'about_college_description' => 'nullable|string',
            'about_college_link' => 'nullable|url',
            'count' => 'nullable|integer',
            'jsrec_description' => 'nullable|string',
            'our_specialize_title' => 'nullable|string',
            'our_specialize_subtitle' => 'nullable|string',
            'testimoniol_bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'our_highlights' => 'nullable|string',
            'our_highlights_subtitle' => 'nullable|string',
        ]);

        /* ---------------- BANNER ---------------- */
        $banners = [];
        if ($request->banner) {
            foreach ($request->banner as $banner) {
                $path = null;

                if (isset($banner['file'])) {
                    $file = $banner['file'];
                    $path = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/jsr'), $path);
                }

                $banners[] = [
                    'type' => $banner['type'] ?? 'image',
                    'path' => $path
                ];
            }
        }

        /* ---------------- HIGHLIGHTS ---------------- */
        $highlights = [];
        if ($request->our_highlights_items) {
            foreach ($request->our_highlights_items as $item) {
                $img = null;

                if (isset($item['image'])) {
                    $file = $item['image'];
                    $img = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/jsr'), $img);
                }

                $highlights[] = [
                    'image' => $img,
                    'title' => $item['title'] ?? '',
                    'description' => $item['description'] ?? ''
                ];
            }
        }

        /* ---------------- ARRAY FIELDS (Direct from form) ---------------- */
        $darkText = $request->dark_text ?? [];
        $lightText = $request->light_text ?? [];

        /* ---------------- TESTIMONIALS (name, description, stars) ---------------- */
     $testimonials = [];

if (is_array($request->testimoniol)) {
    foreach ($request->testimoniol as $testimonial) {
        $testimonials[] = [
            'name'        => trim($testimonial['name'] ?? ''),
            'description' => trim($testimonial['description'] ?? ''),
            'stars'       => (int)($testimonial['stars'] ?? 5),
        ];
    }
}
/* ---------------- TESTIMONIAL BG IMAGE ---------------- */
$testimonialBgImage = null;

if ($request->hasFile('testimoniol_bg_image')) {
    $file = $request->file('testimoniol_bg_image');
    $testimonialBgImage = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/jsr'), $testimonialBgImage);
}
        /* ---------------- PROGRAM CATEGORIES ---------------- */
        $programCategories = [];
        if ($request->program_categories) {
            foreach ($request->program_categories as $category) {
                $programs = [];
                
                if (isset($category['programs'])) {
                    foreach ($category['programs'] as $program) {
                        $iconPath = null;
                        
                        if (isset($program['icon'])) {
                            $file = $program['icon'];
                            $iconPath = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads/jsr/program_icons'), $iconPath);
                        }
                        
                        $programs[] = [
                            'title' => $program['title'] ?? '',
                            'icon' => $iconPath
                        ];
                    }
                }
                
                $programCategories[] = [
                    'category_name' => $category['category_name'] ?? '',
                    'programs' => $programs
                ];
            }
        }

        /* ---------------- CREATE NEW JSR RECORD ---------------- */
        JSR::create([
            'menu_name' => $request->menu_name,
            'banner' => $banners,
            'banner_text' => $request->banner_text,

            'about_college_description' => $request->about_college_description,
            'about_college_link' => $request->about_college_link,
            'count' => $request->count,
            'jsrec_description' => $request->jsrec_description,

            /* ARRAY FIELDS */
            'dark_text' => $darkText,
            'light_text' => $lightText,

            'our_specialize_title' => $request->our_specialize_title,
            'our_specialize_subtitle' => $request->our_specialize_subtitle,

            'testimoniol' => $testimonials,
            'testimoniol_bg_image' => $testimonialBgImage,

            'our_highlights' => $request->our_highlights,
            'our_highlights_subtitle' => $request->our_highlights_subtitle,
            'our_highlights_items' => $highlights,
            
            'program_categories' => $programCategories
        ]);

        return redirect()->route('jsr.index')->with('success', 'JSR created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jsr = JSR::findOrFail($id);

        // Validate the request
        $request->validate([
            'menu_name' => 'nullable|string',
            'banner_text' => 'nullable|string',
            'about_college_description' => 'nullable|string',
            'about_college_link' => 'nullable|url',
            'count' => 'nullable|integer',
            'jsrec_description' => 'nullable|string',
            'our_specialize_title' => 'nullable|string',
            'our_specialize_subtitle' => 'nullable|string',
            'testimoniol_bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'our_highlights' => 'nullable|string',
            'our_highlights_subtitle' => 'nullable|string',
        ]);

        /* ---------------- BANNER ---------------- */
        $banners = [];
        if ($request->banner) {
            foreach ($request->banner as $banner) {

                $path = $banner['path'] ?? null;

                if (isset($banner['file'])) {
                    // Delete old file if exists
                    if ($path && file_exists(public_path('uploads/jsr/' . $path))) {
                        unlink(public_path('uploads/jsr/' . $path));
                    }

                    $file = $banner['file'];
                    $path = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/jsr'), $path);
                }

                $banners[] = [
                    'type' => $banner['type'] ?? 'image',
                    'path' => $path
                ];
            }
        }

        /* ---------------- HIGHLIGHTS ---------------- */
        $highlights = [];
        if ($request->our_highlights_items) {
            foreach ($request->our_highlights_items as $item) {

                $img = $item['old_image'] ?? null;

                if (isset($item['image'])) {
                    // Delete old image if exists
                    if ($img && file_exists(public_path('uploads/jsr/' . $img))) {
                        unlink(public_path('uploads/jsr/' . $img));
                    }

                    $file = $item['image'];
                    $img = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/jsr'), $img);
                }

                $highlights[] = [
                    'image' => $img,
                    'title' => $item['title'] ?? '',
                    'description' => $item['description'] ?? ''
                ];
            }
        }

        /* ---------------- ARRAY FIELDS (Direct from form) ---------------- */
        $darkText = $request->dark_text ?? [];
        $lightText = $request->light_text ?? [];

        /* ---------------- TESTIMONIALS (name, description, stars) ---------------- */
$testimonials = [];

if (is_array($request->testimoniol)) {
    foreach ($request->testimoniol as $testimonial) {
        $testimonials[] = [
            'name'        => trim($testimonial['name'] ?? ''),
            'description' => trim($testimonial['description'] ?? ''),
            'stars'       => (int)($testimonial['stars'] ?? 5),
        ];
    }
}
        
        /* ---------------- TESTIMONIAL BG IMAGE ---------------- */
$testimonialBgImage = $jsr->testimoniol_bg_image;

if ($request->hasFile('testimoniol_bg_image')) {
    // Delete old image if exists
    if ($testimonialBgImage && file_exists(public_path('uploads/jsr/' . $testimonialBgImage))) {
        unlink(public_path('uploads/jsr/' . $testimonialBgImage));
    }

    $file = $request->file('testimoniol_bg_image');
    $testimonialBgImage = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/jsr'), $testimonialBgImage);
}

        /* ---------------- PROGRAM CATEGORIES ---------------- */
        $programCategories = [];
        if ($request->program_categories) {
            foreach ($request->program_categories as $catIndex => $category) {
                $programs = [];
                
                if (isset($category['programs'])) {
                    foreach ($category['programs'] as $progIndex => $program) {
                        $iconPath = $program['old_icon'] ?? null;
                        
                        if (isset($program['icon'])) {
                            // Delete old icon if exists
                            if ($iconPath && file_exists(public_path('uploads/jsr/program_icons/' . $iconPath))) {
                                unlink(public_path('uploads/jsr/program_icons/' . $iconPath));
                            }
                            
                            $file = $program['icon'];
                            $iconPath = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads/jsr/program_icons'), $iconPath);
                        }
                        
                        $programs[] = [
                            'title' => $program['title'] ?? '',
                            'icon' => $iconPath
                        ];
                    }
                }
                
                $programCategories[] = [
                    'category_name' => $category['category_name'] ?? '',
                    'programs' => $programs
                ];
            }
        }

        /* ---------------- UPDATE MAIN DATA ---------------- */
        $jsr->update([
            'menu_name' => $request->menu_name,
            'banner' => $banners,
            'banner_text' => $request->banner_text,

            'about_college_description' => $request->about_college_description,
            'about_college_link' => $request->about_college_link,
            'count' => $request->count,
            'jsrec_description' => $request->jsrec_description,

            /* ARRAY FIELDS */
            'dark_text' => $darkText,
            'light_text' => $lightText,

            'our_specialize_title' => $request->our_specialize_title,
            'our_specialize_subtitle' => $request->our_specialize_subtitle,

            'testimoniol' => $testimonials,
            'testimoniol_bg_image' => $testimonialBgImage,

            'our_highlights' => $request->our_highlights,
            'our_highlights_subtitle' => $request->our_highlights_subtitle,
            'our_highlights_items' => $highlights,
            
            'program_categories' => $programCategories
        ]);

        return redirect()->back()->with('success', 'JSR updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jsr = JSR::findOrFail($id);

        // Delete banner files
        if ($jsr->banner && is_array($jsr->banner)) {
            foreach ($jsr->banner as $banner) {
                if (isset($banner['path']) && file_exists(public_path('uploads/jsr/' . $banner['path']))) {
                    unlink(public_path('uploads/jsr/' . $banner['path']));
                }
            }
        }

        // Delete highlight images
        if ($jsr->our_highlights_items && is_array($jsr->our_highlights_items)) {
            foreach ($jsr->our_highlights_items as $item) {
                if (isset($item['image']) && file_exists(public_path('uploads/jsr/' . $item['image']))) {
                    unlink(public_path('uploads/jsr/' . $item['image']));
                }
            }
        }
        
        // Delete testimonial background image
if ($jsr->testimoniol_bg_image && file_exists(public_path('uploads/jsr/' . $jsr->testimoniol_bg_image))) {
    unlink(public_path('uploads/jsr/' . $jsr->testimoniol_bg_image));
}

        // Delete program category icons
        if ($jsr->program_categories && is_array($jsr->program_categories)) {
            foreach ($jsr->program_categories as $category) {
                if (isset($category['programs']) && is_array($category['programs'])) {
                    foreach ($category['programs'] as $program) {
                        if (isset($program['icon']) && file_exists(public_path('uploads/jsr/program_icons/' . $program['icon']))) {
                            unlink(public_path('uploads/jsr/program_icons/' . $program['icon']));
                        }
                    }
                }
            }
        }

        $jsr->delete();

        return redirect()->route('jsr.index')->with('success', 'JSR deleted successfully');
    }
}