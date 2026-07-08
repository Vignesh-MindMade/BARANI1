<?php

namespace App\Http\Controllers;
use App\Models\Cocirculars;
use Illuminate\Http\Request;


class CocircularController extends Controller
{
   
    public function index()
    {
        $Cocirculars = Cocirculars::all(); 
        return view('Life At Campus.co_circular', compact('Cocirculars'));
 
    }

    public function edit($id)
    {
        $Cocirculars = Cocirculars::findOrFail($id);
        return response()->json($Cocirculars); 
    }
    
    
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:500',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        'description' => 'required|string|max:500',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('images');
        
        $image->move($destinationPath, $fileName);

        $filePath = '' . $fileName; // Save relative path to the database
    } else {
        return redirect()->back()->with('error', 'File upload failed.');
    }

    $cocircular = new Cocirculars();
    $cocircular->title = $validatedData['title'];
    $cocircular->description = $validatedData['description'];
    $cocircular->image = $filePath;
    $cocircular->save();

    return redirect()->back()->with('success', 'Circular created successfully.');
}


public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:500',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        'description' => 'required|string|max:500',
    ]);

    // Fetch the circular by ID
    $cocircular = Cocirculars::findOrFail($id);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('images');

        // Move the uploaded file
        $image->move($destinationPath, $fileName);

        // Delete the old image if exists
        if ($cocircular->image && file_exists(public_path('images/' . $cocircular->image))) {
            unlink(public_path('images/' . $cocircular->image));
        }

        $cocircular->image = $fileName; // Update with the new image path
    }

    // Update other fields
    $cocircular->title = $validatedData['title'];
    $cocircular->description = $validatedData['description'];
    $cocircular->save();

    return redirect()->back()->with('success', 'Circular updated successfully.');
}


public function destroy($id)
{
    $cocircular = Cocirculars::findOrFail($id);

    // Check if the image file exists and delete it
    if (!empty($cocircular->image) && file_exists(public_path('images/' . $cocircular->image))) {
        unlink(public_path('images/' . $cocircular->image));
    }

    // Delete the circular record
    $cocircular->delete();

    return redirect()->route('cocircular.index')->with('success', 'Circular deleted successfully!');
}



}
