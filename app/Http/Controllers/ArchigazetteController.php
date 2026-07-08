<?php

namespace App\Http\Controllers;
use App\Models\Archigazette;
use App\Models\ArchigazteHeading;
use Illuminate\Http\Request;


class ArchigazetteController extends Controller
{
    public function index(){ 

         $archigazettees = Archigazette::all();
         $NewsEvents = ArchigazteHeading::all();
        return view('archigazette.index',compact('archigazettees','NewsEvents'));
    }
        
    public function headingstore(Request $request){
        $validatedData = $request->validate([
           
            'heading' => 'required|string',
        ]);
        $NewsEvent = new ArchigazteHeading;
        $NewsEvent->heading = $validatedData['heading'];
        $NewsEvent->save();
        return redirect()->back()->with('success', 'Event created successfully.');

    }

    public function headingupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
        ]);
        $heading = ArchigazteHeading::findOrFail($id);
        $heading->heading = $validatedData['heading'];
        $heading->save();
    
        return redirect()->route('archigazette.index')->with('success', 'Heading updated successfully.');
    }

     public function destroyHeading($id)
        {
            $heading = ArchigazteHeading::findOrFail($id);
            $heading->delete();
            return redirect()->back()->with('success', 'Heading deleted successfully.');
        }
    

    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'posted_by' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'image' => 'required|file|mimes:webp|max:5000',
                'posted_on' => 'required|string|max:255',
                'pdf' => 'file|mimes:pdf|max:15000',
            ]);
        
            $committee = new Archigazette();
            $committee->posted_by = $validatedData['posted_by']; // Store posted_by
            $committee->title = $validatedData['title']; // Store title
            $committee->posted_on = $validatedData['posted_on']; // Store posted_on
        
            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName); // Move the image to the 'images' directory
                $committee->image = $imageName; // Store the image file name
            }
        
            // Handle the PDF upload
            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
                $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path('pdfs'), $pdfName); // Move the PDF to the 'pdfs' directory
                $committee->pdf = $pdfName; // Store the PDF file name
            }
        
            $committee->save();
        
            return redirect()->back()->with('success', 'Section created successfully.');
        }
        
        
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'posted_by' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'image' => 'nullable|file|mimes:webp|max:5000', // Image is optional
        'posted_on' => 'required|string|max:255',
        'pdf' => 'nullable|file|mimes:pdf|max:15000', // PDF is also optional
    ]);

    $committee = Archigazette::findOrFail($id);
    $committee->posted_by = $validatedData['posted_by'];
    $committee->title = $validatedData['title'];
    $committee->posted_on = $validatedData['posted_on'];

    // Handle image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Optionally remove the old image file if necessary
        if ($committee->image) {
            unlink(public_path('images/' . $committee->image)); // Remove old image file
        }
        
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $committee->image = $imageName;
    }

    // Handle PDF upload if a new PDF is provided
    if ($request->hasFile('pdf')) {
        // Optionally remove the old PDF file if necessary
        if ($committee->pdf) {
            unlink(public_path('pdfs/' . $committee->pdf)); // Remove old PDF file
        }

        $pdf = $request->file('pdf');
        $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
        $pdf->move(public_path('pdfs'), $pdfName);
        $committee->pdf = $pdfName;
    }

    $committee->save();

    return redirect()->back()->with('success', 'Section updated successfully.');
}


   public function destroy($id)
{
    $committee = Archigazette::findOrFail($id);

    // Remove the image file if it exists
    if ($committee->image) {
        unlink(public_path('images/' . $committee->image)); // Remove old image file
    }

    // Remove the PDF file if it exists
    if ($committee->pdf) {
        unlink(public_path('pdfs/' . $committee->pdf)); // Remove old PDF file
    }

    $committee->delete();

    return redirect()->back()->with('success', 'Section deleted successfully.');
}



    
}