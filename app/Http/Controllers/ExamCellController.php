<?php

namespace App\Http\Controllers;

use App\Models\ExamCellAbout;
use App\Models\ExamCellPeople;
use App\Models\ExamCellUniversity;
use App\Models\ExamCellUsefullLinks;
use App\Models\ExamCellContactUs;
use App\Models\ExamCellCirculars;
use App\Models\ExamCellPeopleTitle;
use App\Models\InternalCirculars;
use App\Models\AnnaUniversity;

use Illuminate\Http\Request;

class ExamCellController extends Controller
{
 public function index()
    {
        $points = ExamCellAbout::all();
        return view('Exam.about', compact('points'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
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

        $points = new ExamCellAbout;
        $points->title = $validatedData['title'];

        for ($i = 1; $i <= 10; $i++) {
            $pointField = "point$i";
            if ($request->filled($pointField)) {
                $points->$pointField = $validatedData[$pointField];
            }
        }
        $points->save();

        return redirect()->back()->with('success', 'Exam Cell About Created Successfully.');
    }

    public function update(Request $request, $id)
    {
        $points = ExamCellAbout::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
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

        $points->title = $validatedData['title'];

        for ($i = 1; $i <= 10; $i++) {
            $pointField = 'point' . $i;
            $points->$pointField = $validatedData[$pointField] ?? null;
        }

        $points->save();

        return redirect()->back()->with('success', 'Exam Cell About Updated Successfully.');
    }

    public function destroy($id)
    {
        $points = ExamCellAbout::findOrFail($id);
        $points->delete();

        return redirect()->back()->with('success', 'Exam Cell About Delete Successfully.');
    }

    
public function PeopleIndex()
    {
        $peoples = ExamCellPeople::all();
        $titles = ExamCellPeopleTitle::all(); 
    
        return view('Exam.people', compact('peoples', 'titles'));
    }


    public function Peoplestore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|exists:examcell_people_titles,id',
            'name' => 'nullable|string',
            'designation' => 'nullable|string',
        ]);

        $peoples = new ExamCellPeople;
        $peoples->exampeople_id = $validatedData['title']; // Store the ID of the selected title
        $peoples->name = $validatedData['name'];
        $peoples->designation = $validatedData['designation'];
        $peoples->save();

        return redirect()->back()->with('success', 'Exam Cell People Created Successfully.');
    }

    public function PeopleTiltlestore(Request $request)
    {
    
        $validatedData = $request->validate([
            'title' => 'required|string',
    
        ]);
        $peoples = new ExamCellPeopleTitle;
        $peoples->title = $validatedData['title'];
        $peoples->save();

        return redirect()->back()->with('success', 'Exam Cell People Created Successfully.');
    }

    

    public function Peopleupdate(Request $request, $id)
    {
        $peoples = ExamCellPeople::findOrFail($id);
    
        $validatedData = $request->validate([
            'title' => 'required|string',
            'name' => 'nullable|string',
            'designation' => 'nullable|string',
        ]);
    
        $peoples->title = $validatedData['title'];
        $peoples->name = $validatedData['name'];
        $peoples->designation = $validatedData['designation'];
   
        $peoples->save();
    
        return redirect()->back()->with('success', 'Exam Cell People Updated Successfully.');
    } 

    public function Peopledestroy($id)
    {
        $peoples = ExamCellPeople::findOrFail($id);
        $peoples->delete();

        return redirect()->back()->with('success', 'Exam Cell People Delete Successfully.');
    }


    public function UniversityIndex(){


        $universitys = ExamCellUniversity::all();
        return view('Exam.university-results',compact('universitys'));
    }


    public function UniversityStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'date' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'date2' => 'nullable|string',
            'pdf2' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        $universitys = new ExamCellUniversity;
    
        $universitys->title = $validatedData['title'];
        $universitys->date = $validatedData['date'];
        $universitys->date2 = $validatedData['date2'];
    
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $universitys->pdf = '' . $fileName; 
        }
    
        if ($request->hasFile('pdf2')) {
            $file = $request->file('pdf2');
            $fileName = time() . '_2_' . $file->getClientOriginalName(); // Add a suffix to differentiate files
            $file->move(public_path('pdfs'), $fileName);
            $universitys->pdf2 = '' . $fileName; 
        }
    
        $universitys->save();
    
        return redirect()->back()->with('success', 'University record created successfully.');
    }
    
    

    public function UniversityUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'date' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'date2' => 'nullable|string',
            'pdf2' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        $university = ExamCellUniversity::findOrFail($id);
    
        $university->title = $validatedData['title'];
        $university->date = $validatedData['date'];
        $university->date2 = $validatedData['date2'];
    
        if ($request->hasFile('pdf')) {
    
            if ($university->pdf && file_exists(public_path('pdfs/' . $university->pdf))) {
                unlink(public_path('pdfs/' . $university->pdf));
            }
    
            $file = $request->file('pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $university->pdf = $fileName;
        }

        if ($request->hasFile('pdf2')) {
           
            if ($university->pdf2 && file_exists(public_path('pdfs/' . $university->pdf2))) {
                unlink(public_path('pdfs/' . $university->pdf2));
            }
    
            $file = $request->file('pdf2');
            $fileName = time() . '_2_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $university->pdf2 = $fileName;
        }
    
        $university->save();
    
        return redirect()->back()->with('success', 'University record updated successfully.');
    }
    

        public function Universitydestroy($id)
    {
        $universitys = ExamCellUniversity::findOrFail($id);
        $universitys->delete();

        return redirect()->back()->with('success', 'University Record Deleted Successfully.');
    }


 public function Usefulllinksindex()
    {
        $Usefulllinks = ExamCellUsefullLinks::all();
        return view('Exam.usefull-links', compact('Usefulllinks'));
    }

    public function Usefulllinksdestroy($id)
    {
        $Usefulllinks = ExamCellUsefullLinks::findOrFail($id);
    
        for ($i = 1; $i <= 10; $i++) {
            $pdfKey = "pdf_$i";
    
            if (!empty($Usefulllinks->{$pdfKey})) {
                $filePath = public_path('pdfs/' . $Usefulllinks->{$pdfKey});
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file
                }
            }
        }
    
        $Usefulllinks->delete();
    
        return redirect()->back()->with('success', 'Useful Link deleted successfully.');
    }
    
    
    
    public function Usefulllinksstore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'point1' => 'nullable|string|max:500',
            'point2' => 'nullable|string|max:500',
            'point3' => 'nullable|string|max:500',
            'point4' => 'nullable|string|max:500',
            'point5' => 'nullable|string|max:500',
            'point6' => 'nullable|string|max:500',
            'point7' => 'nullable|string|max:500',
            'point8' => 'nullable|string|max:500',
            'point9' => 'nullable|string|max:500',
            'point10' => 'nullable|string|max:500',
            'url_1' => 'nullable|url',
            'url_2' => 'nullable|url',
            'url_3' => 'nullable|url',
            'url_4' => 'nullable|url',
            'url_5' => 'nullable|url',
            'url_6' => 'nullable|url',
            'url_7' => 'nullable|url',
            'url_8' => 'nullable|url',
            'url_9' => 'nullable|url',
            'url_10' => 'nullable|url',
            'pdf_1' => 'nullable|mimes:pdf|max:10240',
            'pdf_2' => 'nullable|mimes:pdf|max:10240',
            'pdf_3' => 'nullable|mimes:pdf|max:10240',
            'pdf_4' => 'nullable|mimes:pdf|max:10240',
            'pdf_5' => 'nullable|mimes:pdf|max:10240',
            'pdf_6' => 'nullable|mimes:pdf|max:10240',
            'pdf_7' => 'nullable|mimes:pdf|max:10240',
            'pdf_8' => 'nullable|mimes:pdf|max:10240',
            'pdf_9' => 'nullable|mimes:pdf|max:10240',
            'pdf_10' => 'nullable|mimes:pdf|max:10240',
        ]);
    
        $Usefulllinks = new ExamCellUsefullLinks;
        $Usefulllinks->title = $validatedData['title'];
    
        for ($i = 1; $i <= 10; $i++) {
            $pointKey = "point$i";
            $urlKey = "url_$i";
            $pdfKey = "pdf_$i";
    
            // Assign point and URL fields
            $Usefulllinks->{$pointKey} = $validatedData[$pointKey] ?? null;
            $Usefulllinks->{$urlKey} = $validatedData[$urlKey] ?? null;
    
            // Handle file uploads
            if ($request->hasFile($pdfKey)) {
                $pdf = $request->file($pdfKey);
                $pdfName = $pdf->getClientOriginalName();
                $pdf->move(public_path('pdfs'), $pdfName); 
                $Usefulllinks->{$pdfKey} = $pdfName;
            }
        }
    
        $Usefulllinks->save();
        return redirect()->back()->with('success', 'Useful Link created successfully.');
    }
    
    
    public function Usefulllinksupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'point1' => 'nullable|string|max:500',
            'point2' => 'nullable|string|max:500',
            'point3' => 'nullable|string|max:500',
            'point4' => 'nullable|string|max:500',
            'point5' => 'nullable|string|max:500',
            'point6' => 'nullable|string|max:500',
            'point7' => 'nullable|string|max:500',
            'point8' => 'nullable|string|max:500',
            'point9' => 'nullable|string|max:500',
            'point10' => 'nullable|string|max:500',
            'url_1' => 'nullable|url',
            'url_2' => 'nullable|url',
            'url_3' => 'nullable|url',
            'url_4' => 'nullable|url',
            'url_5' => 'nullable|url',
            'url_6' => 'nullable|url',
            'url_7' => 'nullable|url',
            'url_8' => 'nullable|url',
            'url_9' => 'nullable|url',
            'url_10' => 'nullable|url',
            'pdf_1' => 'nullable|mimes:pdf|max:10240',
            'pdf_2' => 'nullable|mimes:pdf|max:10240',
            'pdf_3' => 'nullable|mimes:pdf|max:10240',
            'pdf_4' => 'nullable|mimes:pdf|max:10240',
            'pdf_5' => 'nullable|mimes:pdf|max:10240',
            'pdf_6' => 'nullable|mimes:pdf|max:10240',
            'pdf_7' => 'nullable|mimes:pdf|max:10240',
            'pdf_8' => 'nullable|mimes:pdf|max:10240',
            'pdf_9' => 'nullable|mimes:pdf|max:10240',
            'pdf_10' => 'nullable|mimes:pdf|max:10240',
        ]);
    
        $Usefulllinks = ExamCellUsefullLinks::findOrFail($id);
        $Usefulllinks->title = $validatedData['title'];
    
        for ($i = 1; $i <= 10; $i++) {
            $pointKey = "point$i";
            $urlKey = "url_$i";
            $pdfKey = "pdf_$i";
    
            $Usefulllinks->{$pointKey} = $validatedData[$pointKey] ?? null;
            $Usefulllinks->{$urlKey} = $validatedData[$urlKey] ?? null;
    
            if ($request->hasFile($pdfKey)) {
                $pdf = $request->file($pdfKey);
    
                // Delete the old file if it exists
                if ($Usefulllinks->{$pdfKey}) {
                    $oldFilePath = public_path('pdfs/' . $Usefulllinks->{$pdfKey});
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // Delete the old file
                    }
                }
    
                $pdfName = $pdf->getClientOriginalName();
                $pdf->move(public_path('pdfs'), $pdfName); // Save the new file
                $Usefulllinks->{$pdfKey} = $pdfName; // Update the database with the new file name
            }
        }
    
        $Usefulllinks->save();
        return redirect()->back()->with('success', 'Useful Link updated successfully.');
    }
    



    public function ContactUsIndex(){

        $contactus = ExamCellContactUs::all();
        
        return view('Exam.contact_us', compact('contactus'));
    }

    public function ContactUsstore(Request $request)
    {
    
        $validatedData = $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'landmark' => 'required|string',
            'city' => 'required|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
            'email' => 'nullable|string',
            'phonenumber' => 'nullable',
    
        ]);

        $contact = new ExamCellContactUs;
        $contact->title = $validatedData['title'];
        $contact->sub_title = $validatedData['sub_title'];
        $contact->landmark = $validatedData['landmark'];
        $contact->city = $validatedData['city'];
        $contact->district = $validatedData['district'];
        $contact->state = $validatedData['state'];
        $contact->email = $validatedData['email'];
        $contact->phonenumber = $validatedData['phonenumber'];
        $contact->save();

        return redirect()->back()->with('success', 'Testimonial created successfully.');
    }

    public function ContactUsupdate(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'landmark' => 'required|string',
            'city' => 'required|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
             'email' => 'nullable|string',
            'phonenumber' => 'nullable',
        ]);
    
        // Find the existing record by ID
        $contact = ExamCellContactUs::findOrFail($id);
    
        // Update the record with validated data
        $contact->title = $validatedData['title'];
        $contact->sub_title = $validatedData['sub_title'];
        $contact->landmark = $validatedData['landmark'];
        $contact->city = $validatedData['city'];
        $contact->district = $validatedData['district'];
        $contact->state = $validatedData['state'];
         $contact->email = $validatedData['email'];
        $contact->phonenumber = $validatedData['phonenumber'];
        $contact->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contact Us details updated successfully.');
    }
    
    public function ContactUsdestroy($id)
    {
        // Find the record by ID
        $contact = ExamCellContactUs::findOrFail($id);
    
        // Delete the record
        $contact->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contact Us record deleted successfully.');
    }


    public function CircularIndex(){

        $Circulars = ExamCellCirculars::all();
        return view('Exam.circulars', compact('Circulars'));

    }
    public function Circularsstore(Request $request)
    {
        $validatedData = $request->validate([
            'main_title' => 'required|string|max:255',
            'sub_title1' => 'nullable|string|max:255',
            'sub_title2' => 'nullable|string|max:255',
            'sub_title3' => 'nullable|string|max:255',
            'sub_title4' => 'nullable|string|max:255',
    
            'point_header1' => 'nullable|string|max:255',
            'point_header2' => 'nullable|string|max:255',
            'point_header3' => 'nullable|string|max:255',
            'point_header4' => 'nullable|string|max:255',
    
            'point_text1' => 'nullable|string',
            'point_text2' => 'nullable|string',
            'point_text3' => 'nullable|string',
            'point_text4' => 'nullable|string',
    
            'point_pdf1' => 'nullable|file|mimes:pdf|max:2048',
            'point_pdf2' => 'nullable|file|mimes:pdf|max:2048',
            'point_pdf3' => 'nullable|file|mimes:pdf|max:2048',
            'point_pdf4' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        $Circulars = new ExamCellCirculars;
        $Circulars->main_title = $validatedData['main_title'];
        $Circulars->sub_title1 = $validatedData['sub_title1'] ?? null;
        $Circulars->sub_title2 = $validatedData['sub_title2'] ?? null;
        $Circulars->sub_title3 = $validatedData['sub_title3'] ?? null;
        $Circulars->sub_title4 = $validatedData['sub_title4'] ?? null;
    
        $Circulars->point_header1 = $validatedData['point_header1'] ?? null;
        $Circulars->point_header2 = $validatedData['point_header2'] ?? null;
        $Circulars->point_header3 = $validatedData['point_header3'] ?? null;
        $Circulars->point_header4 = $validatedData['point_header4'] ?? null;
    
        $Circulars->point_text1 = $validatedData['point_text1'] ?? null;
        $Circulars->point_text2 = $validatedData['point_text2'] ?? null;
        $Circulars->point_text3 = $validatedData['point_text3'] ?? null;
        $Circulars->point_text4 = $validatedData['point_text4'] ?? null;
    
        // Handle file uploads
        if ($request->hasFile('point_pdf1')) {
            $filename = $request->file('point_pdf1')->getClientOriginalName();
            $request->file('point_pdf1')->move(public_path('pdfs'), $filename);
            $Circulars->point_pdf1 = $filename; // Store only the file name in the database
        }
        if ($request->hasFile('point_pdf2')) {
            $filename = $request->file('point_pdf2')->getClientOriginalName();
            $request->file('point_pdf2')->move(public_path('pdfs'), $filename);
            $Circulars->point_pdf2 = $filename;
        }
        if ($request->hasFile('point_pdf3')) {
            $filename = $request->file('point_pdf3')->getClientOriginalName();
            $request->file('point_pdf3')->move(public_path('pdfs'), $filename);
            $Circulars->point_pdf3 = $filename;
        }
        if ($request->hasFile('point_pdf4')) {
            $filename = $request->file('point_pdf4')->getClientOriginalName();
            $request->file('point_pdf4')->move(public_path('pdfs'), $filename);
            $Circulars->point_pdf4 = $filename;
        }
    
        $Circulars->save();
    
        return redirect()->back()->with('success', 'Circular created successfully.');
    }
    
     public function InternalIndex()
    {
        $circulars = InternalCirculars::all();
        
        return view('Exam.circulars', compact('circulars'));

    }

    public function InternalStore(Request $request)
    {

        $validatedData = $request->validate([
            'Year' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'semester_1' => 'nullable|string|max:255',
            'sem1_internal_1' => 'nullable|string|max:255',
            'sem1_internal_pdf_1' => 'nullable|file|mimes:pdf|max:15000',
            'sem1_internal_2' => 'nullable|string|max:255',
            'sem1_internal_pdf_2' => 'nullable|file|mimes:pdf|max:15000',
            'sem1_internal_3' => 'nullable|string|max:255',
            'sem1_internal_pdf_3' => 'nullable|file|mimes:pdf|max:15000',
        ]);

        $data = [
            'Year' => $request->input('Year'),
            'title' => $request->input('title'),
            'semester_1' => $request->input('semester_1'),
            'sem1_internal_1' => $request->input('sem1_internal_1'),
            'sem1_internal_2' => $request->input('sem1_internal_2'),
            'sem1_internal_3' => $request->input('sem1_internal_3'),
        ];
    
        if ($request->hasFile('sem1_internal_pdf_1')) {
            $file = $request->file('sem1_internal_pdf_1');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['sem1_internal_pdf_1'] = $fileName; 
        }
        if ($request->hasFile('sem1_internal_pdf_2')) {
            $file = $request->file('sem1_internal_pdf_2');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['sem1_internal_pdf_2'] = $fileName; 
        }
        if ($request->hasFile('sem1_internal_pdf_3')) {
            $file = $request->file('sem1_internal_pdf_3');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['sem1_internal_pdf_3'] = $fileName; 
        }
    
    
        $record = InternalCirculars::create($data);
    
        for ($i = 2; $i <= 10; $i++) {
            $semesterKey = "semester_{$i}";
            $internal1Key = "sem{$i}_internal_1";
            $internal1PdfKey = "sem{$i}_internal_pdf_1";
            $internal2Key = "sem{$i}_internal_2";
            $internal2PdfKey = "sem{$i}_internal_pdf_2";
            $internal3Key = "sem{$i}_internal_3";
            $internal3PdfKey = "sem{$i}_internal_pdf_3";

            if ($request->filled($semesterKey) || $request->filled($internal1Key) || $request->filled($internal2Key) || $request->filled($internal3Key)) {
                $semesterData = [
                    $semesterKey => $request->input($semesterKey),
                    $internal1Key => $request->input($internal1Key),
                    $internal2Key => $request->input($internal2Key),
                    $internal3Key => $request->input($internal3Key),
                ];
    
                if ($request->hasFile($internal1PdfKey)) {
                    $file = $request->file($internal1PdfKey);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('pdfs'), $fileName);
                    $semesterData[$internal1PdfKey] = $fileName; 
                }
                if ($request->hasFile($internal2PdfKey)) {
                    $file = $request->file($internal2PdfKey);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('pdfs'), $fileName);
                    $semesterData[$internal2PdfKey] = $fileName;
                }
                if ($request->hasFile($internal3PdfKey)) {
                    $file = $request->file($internal3PdfKey);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('pdfs'), $fileName);
                    $semesterData[$internal3PdfKey] = $fileName;
                }
    

                $record->update($semesterData);
            }
        }
    
        return redirect()->back();
    }
   

    // public function InternalEdit($id)
    // {
    //     $circular = InternalCirculars::findOrFail($id);
    //     return response()->json($circular);
    // }
    
    // public function InternalUpdate(Request $request, $id)
    // {
    //     $circular = InternalCirculars::findOrFail($id);
        
    //     // Validate the request
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'Year' => 'required|string|max:255',
    //         'semester_1' => 'nullable|string|max:255',
    //         'sem1_internal_1' => 'nullable|string|max:255',
    //         'sem1_internal_2' => 'nullable|string|max:255',
    //         'sem1_internal_3' => 'nullable|string|max:255',
    //         'sem1_internal_pdf_1' => 'nullable|file|mimes:pdf|max:15000',
    //         'sem1_internal_pdf_2' => 'nullable|file|mimes:pdf|max:15000',
    //         'sem1_internal_pdf_3' => 'nullable|file|mimes:pdf|max:15000',
    //     ]);
    
    //     // Update basic fields
    //     $circular->title = $request->title;
    //     $circular->Year = $request->Year;
    //     $circular->semester_1 = $request->semester_1;
    //     $circular->sem1_internal_1 = $request->sem1_internal_1;
    //     $circular->sem1_internal_2 = $request->sem1_internal_2;
    //     $circular->sem1_internal_3 = $request->sem1_internal_3;
    
    //     // Handle PDF uploads
    //     $pdfFields = [
    //         'sem1_internal_pdf_1',
    //         'sem1_internal_pdf_2',
    //         'sem1_internal_pdf_3'
    //     ];
    
    //     foreach ($pdfFields as $field) {
    //         if ($request->hasFile($field)) {
    //             // Delete old file if it exists
    //             if ($circular->$field) {
    //                 $oldPath = public_path('pdfs/' . $circular->$field);
    //                 if (file_exists($oldPath)) {
    //                     unlink($oldPath);
    //                 }
    //             }
    
    //             // Upload new file
    //             $file = $request->file($field);
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path('pdfs'), $fileName);
    //             $circular->$field = $fileName;
    //         }
    //     }
    
    //     $circular->save();
    
    //     return redirect()->back()->with('success', 'Internal circular updated successfully');
    // }

    
    public function InternalDestroy($id)
    {
        $circular = InternalCirculars::findOrFail($id);
        
        // Delete associated PDF files
        for ($i = 1; $i <= 10; $i++) {
            $pdfFields = [
                "sem{$i}_internal_pdf_1",
                "sem{$i}_internal_pdf_2",
                "sem{$i}_internal_pdf_3"
            ];
            
            foreach ($pdfFields as $field) {
                if ($circular->$field) {
                    $pdfPath = public_path('pdfs/' . $circular->$field);
                    if (file_exists($pdfPath)) {
                        unlink($pdfPath);
                    }
                }
            }
        }
        
        $circular->delete();
        
        return redirect()->back()->with('success', 'Internal circular deleted successfully');
    }
    
    public function AnnaUnivIndex()
    {
        $annaUniversity = AnnaUniversity::all();
        return view('Exam.anna-university', compact('annaUniversity'));
    }

    public function AnnaUnivStore(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'circular_1' => 'nullable|string|max:255',
            'circular_1_pdf' => 'nullable|file|mimes:pdf|max:10048',
            'circular_2' => 'nullable|string|max:255',
            'circular_4_pdf' => 'nullable|file|mimes:pdf|max:10048',
            'circular_3' => 'nullable|string|max:255',
            'circular_3_pdf' => 'nullable|file|mimes:pdf|max:10048',
        ]);

        $data = [
            'year' => $request->input('year'),
            'title' => $request->input('title'),
            'circular_1' => $request->input('circular_1'),
            'circular_2' => $request->input('circular_2'),
            'circular_3' => $request->input('circular_3'),
        ];

        if ($request->hasFile('circular_1_pdf')) {
            $file = $request->file('circular_1_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['circular_1_pdf'] = $fileName;
        }

        if ($request->hasFile('circular_4_pdf')) {
            $file = $request->file('circular_4_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['circular_4_pdf'] = $fileName;
        }

        if ($request->hasFile('circular_3_pdf')) {
            $file = $request->file('circular_3_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $fileName);
            $data['circular_3_pdf'] = $fileName;
        }

        AnnaUniversity::create($data);

        return redirect()->back()->with('success', 'Circular added successfully!');
    }

        public function AnnaUnivUpdate(Request $request, $id)
        {
            $validatedData = $request->validate([
                'year' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'circular_1' => 'nullable|string|max:255',
                'circular_1_pdf' => 'nullable|file|mimes:pdf|max:10048',
                'circular_2' => 'nullable|string|max:255',
                'circular_4_pdf' => 'nullable|file|mimes:pdf|max:10048',
                'circular_3' => 'nullable|string|max:255',
                'circular_3_pdf' => 'nullable|file|mimes:pdf|max:10048',
            ]);
    
            $data = [
                'year' => $request->input('year'),
                'title' => $request->input('title'),
                'circular_1' => $request->input('circular_1'),
                'circular_2' => $request->input('circular_2'),
                'circular_3' => $request->input('circular_3'),
            ];
    
            if ($request->hasFile('circular_1_pdf')) {
                $file = $request->file('circular_1_pdf');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('pdfs'), $fileName);
                $data['circular_1_pdf'] = $fileName;
            }
    
            if ($request->hasFile('circular_4_pdf')) {
                $file = $request->file('circular_4_pdf');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('pdfs'), $fileName);
                $data['circular_4_pdf'] = $fileName;
            }
    
            if ($request->hasFile('circular_3_pdf')) {
                $file = $request->file('circular_3_pdf');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('pdfs'), $fileName);
                $data['circular_3_pdf'] = $fileName;
            }
    
            AnnaUniversity::where('id', $id)->update($data);
    
            return redirect()->back()->with('success', 'Circular updated successfully!');
        }


    public function AnnaUnivDelete($id)
{
    $circular = AnnaUniversity::find($id);

    if (!$circular) {
        return back()->with('error', 'Circular not found.');
    }

    // Delete associated files if needed
    if (!empty($circular->circular_1_pdf)) {
        $file_path = public_path('pdfs/' . $circular->circular_1_pdf);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $circular->delete();

    return back()->with('success', 'Circular deleted successfully.');
}


}
