<?php

namespace App\Http\Controllers;

use App\Models\LifeatcampusCategory;
use App\Models\LifeatCampus;
use App\Models\IqacSections;
use App\Models\Iqac;
use App\Models\AdmissionSections;
use App\Models\Admission;
use App\Models\AdmissionContent;
use App\Models\WorkwithusContent;
use App\Models\WorkWithUs;
use Illuminate\Http\Request;

class SubpageController extends Controller
{
    public function index()
    {
      $categories = LifeatcampusCategory::all();
      $campus = LifeatCampus::with('category')->get();
      return view('pages.subpages',compact('categories','campus'));
    }
    
    public function iqacindex()
    {
     $iqacsections = IqacSections::all();
     $contents = Iqac::with('section')->get();
      return view('pages.iqac',compact('iqacsections','contents'));
    }
    
    public function getSectionDescriptions(Request $request)
{
    $sectionId = $request->input('section_id');
    $descriptions = Iqac::where('section_id', $sectionId)->pluck('description');
    return response()->json($descriptions);
}

    public function getSectionadmissionDescriptions(Request $request)
{
    $sectionId = $request->input('section_id');
    $descriptions = Admission::where('section_id', $sectionId)->pluck('description');

    return response()->json($descriptions);
}
    
    
    public function admissionindex()
    {
      $AdmissionContent = AdmissionContent::all();
      $admissionsection = AdmissionSections::all();
      $admissions = Admission::with('section')->get();
      return view('pages.admission',compact('admissionsection','admissions','AdmissionContent'));
    }
    
    
    public function workwithus()
    {
      $works = WorkwithusContent::all();
      $workwithus = WorkWithUs::all();
      return view('pages.Workwithus',compact('works','workwithus'));
    }
    
    
     public function categorystore(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = new LifeatcampusCategory;
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        
        public function updatecategory(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = LifeatcampusCategory::findOrFail($id);
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function deletecategory($id)
        {
        $core = LifeatcampusCategory::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
       
       
       public function LifeatCampus(Request $request)
        {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:lifeatcampus_category,id',
                'image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
                'description' => 'required|string',
            ]);
        
            $core = new LifeatCampus;
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->image = $imageName;
            }
            $core->category_id = $validatedData['category_id'];
            $core->description = $validatedData['description'];
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
     public function updateLifeatCampus(Request $request, $id)
        {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:lifeatcampus_category,id',
                'image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
                'description' => 'required|string',
            ]);
        
        
            $core = LifeatCampus::findOrFail($id);
            $core->description = $validatedData['description'];
            $core->category_id = $validatedData['category_id'];
             if ($request->hasFile('image')) {
                if ($core->image && file_exists(public_path('images/' . $core->image))) {
                    unlink(public_path('images/' . $core->image));
                }
                
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function destroyLifeatCampus($id)
        {
        $section = LifeatCampus::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
    
    public function iqacstore(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = new IqacSections;
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
    
    
    public function updateiqac(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = IqacSections::findOrFail($id);
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function deleteiqac($id)
        {
        $core = IqacSections::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
       
 

public function iqaccontent(Request $request)
{
    $validatedData = $request->validate([
        'section_id' => 'required|exists:iqac_sections,id',
        'description' => 'required|array',
        'description.*' => 'required|string',
    ]);

    foreach ($validatedData['description'] as $description) {
        $core = new Iqac;
        $core->section_id = $validatedData['section_id'];
        $core->description = $description;
        $core->save();
    }

    return redirect()->back()->with('success', 'Descriptions saved successfully.');
}

public function updateiqaccontent(Request $request, $id)
{
    $validatedData = $request->validate([
        'section_id' => 'required|exists:iqac_sections,id',
        'description' => 'required|array',
        'description.*' => 'required|string',
    ]);

    // Delete old descriptions for the section
    Iqac::where('section_id', $id)->delete();

    // Save the updated descriptions
    foreach ($validatedData['description'] as $description) {
        $core = new Iqac;
        $core->section_id = $validatedData['section_id'];
        $core->description = $description;
        $core->save();
    }

    return redirect()->back()->with('success', 'Section updated successfully.');
}
    public function ouradmission(Request $request)
        {
           
            $validatedData = $request->validate([
                'admission' => 'required|string',
            ]);
        
         
            $committee = AdmissionContent::first(); 
        
            if ($committee) {
                $committee->admission = $validatedData['admission'];
                $committee->save();
            } else {
                AdmissionContent::create($validatedData);
            }
            return redirect()->back()->with('success', 'Content saved successfully.');
        }
        
    
    
     public function admissionstore(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = new AdmissionSections;
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        
    public function updateadmission(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        
            $core = AdmissionSections::findOrFail($id);
            $core->name = $validatedData['name'];
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function deleteadmission($id)
        {
        $core = AdmissionSections::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
       
                               
       public function admission(Request $request)
       {
           $validatedData = $request->validate([
               'section_id' => 'required|exists:admission_sections,id',
               'content' => 'nullable|string|max:100000',
               'description' => 'nullable|string|max:500',
               'pdf' => 'nullable|file|mimes:pdf|max:2048',
               'description1' => 'nullable|string|max:500',
               'pdf1' => 'nullable|file|mimes:pdf|max:2048',
               'description2' => 'nullable|string|max:500',
               'pdf2' => 'nullable|file|mimes:pdf|max:2048',
           ]);
       
           $pdfName = $request->hasFile('pdf') ? $request->file('pdf')->getClientOriginalName() : null;
           $pdfName1 = $request->hasFile('pdf1') ? $request->file('pdf1')->getClientOriginalName() : null;
           $pdfName2 = $request->hasFile('pdf2') ? $request->file('pdf2')->getClientOriginalName() : null;
       
           if ($request->hasFile('pdf')) {
               $request->file('pdf')->storeAs('', $pdfName, 'public');
           }
           if ($request->hasFile('pdf1')) {
               $request->file('pdf1')->storeAs('', $pdfName1, 'public');
           }
           if ($request->hasFile('pdf2')) {
               $request->file('pdf2')->storeAs('', $pdfName2, 'public');
           }
       
           Admission::create([
               'section_id' => $validatedData['section_id'],
               'content' => $validatedData['content'] ?? null,
               'description' => $validatedData['description'] ?? null,
               'pdf' => $pdfName,
               'description1' => $validatedData['description1'] ?? null,
               'pdf1' => $pdfName1,
               'description2' => $validatedData['description2'] ?? null,
               'pdf2' => $pdfName2,
           ]);
       
           return redirect()->back()->with('success', 'Admission record created successfully.');
       }
        

       public function edit(Request $request)
       {
           $admission = Admission::find($request->id);
       
           if (!$admission) {
               return response()->json(['error' => 'Record not found'], 404);
           }
           return response()->json($admission);
       }
       
       public function updateadmissioncontent(Request $request)
       {
           try {
               $admission = Admission::findOrFail($request->id);

               $validatedData = $request->validate([
                   'section_id' => 'required|exists:admission_sections,id',
                   'content' => 'nullable|string|max:100000',
                   'description' => 'nullable|string|max:500',
                   'pdf' => 'nullable|file|mimes:pdf|max:10240',
                   'description1' => 'nullable|string|max:500',
                   'pdf1' => 'nullable|file|mimes:pdf|max:10240',
                   'description2' => 'nullable|string|max:500',
                   'pdf2' => 'nullable|file|mimes:pdf|max:10240',
               ]);

               // Handle PDF uploads
               $updateData = [
                   'section_id' => $validatedData['section_id'],
                   'content' => $validatedData['content'],
                   'description' => $validatedData['description'],
                   'description1' => $validatedData['description1'],
                   'description2' => $validatedData['description2'],
               ];

               // Handle PDF files
               foreach(['pdf', 'pdf1', 'pdf2'] as $pdfField) {
                   if ($request->hasFile($pdfField)) {
                       // Delete old file if exists
                       if ($admission->$pdfField && file_exists(public_path('pdfs/' . $admission->$pdfField))) {
                           unlink(public_path('pdfs/' . $admission->$pdfField));
                       }

                       // Store new file
                       $file = $request->file($pdfField);
                       $fileName = time() . '-' . $file->getClientOriginalName();
                       $file->move(public_path('pdfs'), $fileName);
                       $updateData[$pdfField] = $fileName;
                   }
               }

               $admission->update($updateData);

               return response()->json([
                   'success' => true,
                   'message' => 'Admission updated successfully'
               ]);

           } catch (\Exception $e) {
               \Log::error('Admission update error: ' . $e->getMessage());
               return response()->json([
                   'success' => false,
                   'message' => 'Failed to update admission: ' . $e->getMessage()
               ], 500);
           }
       }



       public function delete($id)
        {
       
            $admission = Admission::findOrFail($id);

            if ($admission->pdf && file_exists(public_path('pdfs/' . $admission->pdf))) {
                unlink(public_path('pdfs/' . $admission->pdf));
            }
            $admission->delete();

            return redirect()->back()->with('success', 'Admission record deleted successfully.');
        }

    
    
    
     public function ourwork(Request $request)
        {
           
            $validatedData = $request->validate([
                'work' => 'required|string',
            ]);
        
         
            $committee = WorkwithusContent::first(); 
        
            if ($committee) {
                $committee->work = $validatedData['work'];
                $committee->save();
            } else {
                WorkwithusContent::create($validatedData);
            }
            return redirect()->back()->with('success', 'Content saved successfully.');
        }
        
        
    public function work(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'content' => 'required|string',
                'image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new WorkWithUs;
            $core->name = $validatedData['name'];
            $core->content = $validatedData['content'];
        
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
       public function updatework(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'content' => 'required|string',
                'image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
        
            $core = WorkWithUs::findOrFail($id);
            $core->name = $validatedData['name'];
            $core->content = $validatedData['content'];
        
            if ($request->hasFile('image')) {
                if ($core->image && file_exists(public_path('images/' . $core->image))) {
                    unlink(public_path('images/' . $core->image));
                }
                
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function destroywork($id)
        {
        $section = WorkWithUs::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
        

       
     

            

       
    
}
    