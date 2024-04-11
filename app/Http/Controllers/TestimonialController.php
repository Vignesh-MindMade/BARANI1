<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonial.index',compact('testimonials'));
    }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'file' => 'required|file|mimes:webp,mp4|max:2048',
        'sort_id' => 'nullable|integer',
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);

        // Create a new testimonial instance
        $testimonial = new Testimonial;
        $testimonial->title = $validatedData['title'];
        $testimonial->content = $validatedData['content'];
        $testimonial->file = $fileName; // Assuming you store the file path
        $testimonial->sort_id = $validatedData['sort_id'];
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimonial created successfully.');
    }

    return redirect()->back()->with('error', 'File upload failed.');
}


}
