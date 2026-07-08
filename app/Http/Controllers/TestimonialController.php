<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'imageFile' => 'required_if:file_type,image|file|mimes:webp|max:5000',
            'videoFile' => 'required_if:file_type,video|file|mimes:mp4,mov,avi,3gp,wmv|max:30000',
            'sort_id' => 'nullable|integer',
            'point1' => 'nullable|string',
            'point2' => 'nullable|string',
            'point3' => 'nullable|string',
            'point4' => 'nullable|string',
            'point5' => 'nullable|string',
            'point6' => 'nullable|string',
            'point7' => 'nullable|string',
            'point8' => 'nullable|string',
            'point9' => 'nullable|string',
            'point10' => 'nullable|string',
        ]);

        // Determine which file was uploaded based on the file type selected
        if ($request->hasFile('imageFile')) {
            // Handle image file upload
            $file = $request->file('imageFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
        } elseif ($request->hasFile('videoFile')) {
            // Handle video file upload
            $file = $request->file('videoFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('videos'), $fileName);
        } else {
            return redirect()->back()->with('error', 'File upload failed.');
        }

        // Save the testimonial data to the database
        $testimonial = new Testimonial;
        $testimonial->title = $validatedData['title'];
        $testimonial->content = $validatedData['content'];
        $testimonial->file = $fileName;
        $testimonial->sort_id = $validatedData['sort_id'];

        // Loop through point1 to point10 and assign if present
        for ($i = 1; $i <= 10; $i++) {
            $pointField = "point$i";
            if ($request->filled($pointField)) {
                $testimonial->$pointField = $validatedData[$pointField];
            }
        }

        $testimonial->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Testimonial created successfully.');
    }


    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Validate the request, including points as optional fields
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,webp,mp4,mov,avi,3gp,wmv|max:30000',
            'sort_id' => 'nullable|integer',
            'point1' => 'nullable|string',
            'point2' => 'nullable|string',
            'point3' => 'nullable|string',
            'point4' => 'nullable|string',
            'point5' => 'nullable|string',
            'point6' => 'nullable|string',
            'point7' => 'nullable|string',
            'point8' => 'nullable|string',
            'point9' => 'nullable|string',
            'point10' => 'nullable|string',
        ]);

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $testimonial->file = $fileName;
        }

        // Update testimonial fields
        $testimonial->title = $validatedData['title'];
        $testimonial->content = $validatedData['content'];
        $testimonial->sort_id = $validatedData['sort_id'];

        // Update points if they have values
        for ($i = 1; $i <= 10; $i++) {
            $pointField = 'point' . $i;
            if (!empty($validatedData[$pointField])) {
                $testimonial->$pointField = $validatedData[$pointField];
            } else {
                $testimonial->$pointField = null; // Set to null if no value
            }
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }
}