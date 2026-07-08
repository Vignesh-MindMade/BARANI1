<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editoriol;
use App\Models\EditoriolSections;

class EditMenuController extends Controller
{
    public function index()
    {
        $EdtMenu = Editoriol::all();
        $EdtMenuTitles = EditoriolSections::all();
        return view('Editoriol.editoriol-menu', compact('EdtMenu','EdtMenuTitles'));
    }

    public function TitleStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

        ]);
    
        $data = $request->only(['title']);
    
        EditoriolSections::create($data);
    
        return redirect()->route('menu-editoriol.index')->with('success', 'Data saved successfully!');
    }

    public function Titleupdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

        ]);

        $EdtMenuTitle = EditoriolSections::findOrFail($request->id);

        $EdtMenuTitle->title = $request->title;

        $EdtMenuTitle->save();

        return redirect()->route('menu-editoriol.index')->with('success', 'Menu updated successfully!');
    }

    public function Titledestroy($id)
    {

        $EdtMenuTitle = EditoriolSections::find($id);
        if ($EdtMenuTitle) {
            $EdtMenuTitle->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    

   }
    
public function store(Request $request)
{
    $request->validate([
        'editoriol_id' => 'required|exists:editoriol_sections,id',
        'posted_by' => 'required|string|max:255',
        'posted_on' => 'required|date',
        'pdf' => 'nullable|file|mimes:pdf|max:15000',
        'image' => 'nullable|file|mimes:webp|max:5000',
    ]);

    $data = $request->only(['editoriol_id', 'posted_by', 'posted_on']);

   // Handle Image upload using `move()`
    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('pdfs'), $fileName); // Move to 'public/images'
        $data['pdf'] = '' . $fileName; // Save the relative path
    }

    // Handle Image upload using `move()`
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName); // Move to 'public/images'
        $data['image'] = '' . $fileName; // Save the relative path
    }

    Editoriol::create($data);

    return redirect()->route('menu-editoriol.index')->with('success', 'Data saved successfully!');
}

   
   
   public function update(Request $request, $id)
{
    $request->validate([
        'editoriol_id' => 'required|exists:editoriol_sections,id',
        'posted_by' => 'required|string|max:255',
        'posted_on' => 'required|date',
        'pdf' => 'nullable|file|mimes:pdf|max:15000',
        'image' => 'nullable|file|mimes:webp|max:5000',
    ]);

    $editoriol = Editoriol::findOrFail($id);

    $editoriol->editoriol_id = $request->editoriol_id;
    $editoriol->posted_by = $request->posted_by;
    $editoriol->posted_on = $request->posted_on;


    if ($request->hasFile('pdf')) {
        if ($editoriol->pdf && file_exists(public_path('pdfs/' . $editoriol->pdf))) {
            unlink(public_path('pdfs/' . $editoriol->pdf));
        }
        $file = $request->file('pdf');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('pdfs'), $fileName);
        $editoriol->pdf = $fileName;
    }

    if ($request->hasFile('image')) {
  
        if ($editoriol->image && file_exists(public_path('images/' . $editoriol->image))) {
            unlink(public_path('images/' . $editoriol->image));
        }
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $editoriol->image = $fileName;
    }
    $editoriol->save();

    return redirect()->back();
}


         
    public function destroy($id)
    {
    $editoriol = Editoriol::find($id);
    if ($editoriol) {
        $editoriol->delete();
        return redirect()->back()->with('success' , 'Section deleted successfully');
    } else {
        return response()->json(['error' => 'Section not found'], 404);
    }
    
   }
    
    
    
    
}
