<?php

namespace App\Http\Controllers;

use App\Models\UsefulLinks;
use App\Models\FooterContact;
use App\Models\Downloads;
use App\Models\SocialLinks;
use App\Models\FooterText;
use App\Models\AnnualReportTitle;
use App\Models\AnnualReport;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function index()
    {
      $links = UsefulLinks::all();
      $contacts = FooterContact::all();
      $downloads = Downloads::all();
      $socials = SocialLinks::all();
      $texts = FooterText::all();

      View::share('contacts', $contacts);
      View::share('socials', $socials);
      return view('pages.footer', compact('links','contacts','downloads','socials','texts'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pagename' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5048',
        ]);
    
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdfs'), $pdfName); 
        } else {
            $pdfName = null; 
        }
    
        $usefulLinks = new UsefulLinks();
        $usefulLinks->pagename = $validatedData['pagename'];
        $usefulLinks->link = $validatedData['link'];
        $usefulLinks->pdf = $pdfName; 
        $usefulLinks->save();

        return redirect()->back()->with('success', 'Useful link created successfully.');
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pagename' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5048',
        ]);
    
        $usefulLinks = UsefulLinks::findOrFail($id);

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName(); 
            $pdf->move(public_path('pdfs'), $pdfName); 
            $usefulLinks->pdf = $pdfName;
        }
    
        $usefulLinks->pagename = $validatedData['pagename'];
        $usefulLinks->link = $validatedData['link'];
    
        $usefulLinks->save();
        return response()->json(['success' => true]);
    }
    
    
    public function destroy($id)
    {
        $usefullinks = UsefulLinks::findOrFail($id);
        $usefullinks->delete();

        return redirect()->back()->with('success', 'UseFull Link deleted successfully.');
    }
    
    
    public function contactstore(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'nullable|string|max:255',
            'mail' => 'nullable|string|max:255',
            'contact_no_1' => 'nullable|string|max:255',
            'contact_no_2' => 'required|string|max:255',
        ]);

        $contacts = new FooterContact;
        $contacts->address = $validatedData['address'];
        $contacts->mail = $validatedData['mail'];
        $contacts->contact_no_1 = $validatedData['contact_no_1'];
        $contacts->contact_no_2 = $validatedData['contact_no_2'];
        $contacts->save();
        
        return redirect()->back()->with('success', 'Contact Created Successfully.');
    }
    
    public function contactupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'address' => 'nullable|string|max:255',
            'mail' => 'required|nullable|max:255',
            'contact_no_1' => 'nullable|string|max:255',
            'contact_no_2' => 'nullable|string|max:255',
        ]);

        $contacts = FooterContact::findOrFail($id);
        $contacts->address = $validatedData['address'];
        $contacts->mail = $validatedData['mail'];
        $contacts->contact_no_1 = $validatedData['contact_no_1'];
        $contacts->contact_no_2 = $validatedData['contact_no_2'];
        $contacts->save();

        return redirect()->back()->with('success', 'Contact Updated successfully.');
    }


    public function contactdelete($id)
    {
        $contacts = FooterContact::findOrFail($id);
        $contacts->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
    
    public function downloadsstore(Request $request)
    
        {
    $validatedData = $request->validate([
        'pdf_name' => 'required|string|max:255',
        'link_name' => 'nullable|url|max:255',
        'pdf' => 'file|mimes:pdf|max:2048',
    ]);

    $downloads = new Downloads();
    $downloads->pdf_name = $request->input('pdf_name');
    $downloads->link_name = $request->input('link_name');

    if ($request->hasFile('pdf')) {
        $pdf = $request->file('pdf');
        $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
        $pdfPath = $pdfName;
        $pdf->move(public_path('pdfs'), $pdfName);
        $downloads->pdf = $pdfPath;
    }

    $downloads->save();

    return redirect()->back()->with('success', 'Download created successfully.');
    }

   public function downloadupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pdf_name' => 'required|string|max:255',
            'link_name' => 'nullable|url|max:255',
            'pdf' => 'file|mimes:pdf|max:2048',
        ]);
    
        $download = Downloads::findOrFail($id);
        $download->pdf_name = $request->input('pdf_name');
        $download->link_name = $request->input('link_name');
    
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdfPath = $pdfName;
            $pdf->move(public_path('pdfs'), $pdfName);
            $download->pdf = $pdfPath;
        }
    
        $download->save();
    
        return redirect()->back()->with('success', 'Download updated successfully.');
    }
    
    
    public function downloaddelete($id)
    {
        $download = Downloads::findOrFail($id);
        $download->delete();

        return redirect()->back()->with('success', 'Download deleted successfully.');
    }
    
    
    public function socials(Request $request)
{
    $validatedData = $request->validate([
        'facebook' => 'required|string|max:255',
        'linkedin' => 'required|string|max:255',
        'instagram' => 'required|string|max:255',
        'twitter' => 'required|string|max:255',
        'youtube' => 'required|string|max:255',
    ]);

    SocialLinks::updateOrCreate(
        [],
        [
            'facebook' => $validatedData['facebook'],
            'linkedin' => $validatedData['linkedin'],
            'instagram' => $validatedData['instagram'],
            'twitter' => $validatedData['twitter'],
            'youtube' => $validatedData['youtube'],
        ]
    );

    return redirect()->back()->with('success', 'Social links saved successfully.');
}


   public function textstore(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|string|max:555',
        ]);

        FooterText::updateOrCreate(
            [],
            [
                'text' => $validatedData['text'],
            ]
        );

        return redirect()->back()->with('success', 'Footer text saved successfully.');
    }



    public function AnnualIndex()
    {
        $annualReportTitles = AnnualReportTitle::all();
        $annualReports = AnnualReport::all();

        return view('Footer.index', compact('annualReportTitles', 'annualReports'));
    }

   public function AnnualTitleStore(Request $request)
   {
       $validatedData = $request->validate([
           'title' => 'required|string|max:255',
       ]);

       $annualReportTitle = new AnnualReportTitle();
       $annualReportTitle->title = $validatedData['title'];
       $annualReportTitle->save();

       return redirect()->back()->with('success', 'Title created successfully.');
   }

public function AnnualStore(Request $request)
{
    $validatedData = $request->validate([
        'annual_report_id' => 'required|exists:annual-report-title,id',
        'year' => 'nullable|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'text_1' => 'nullable|string|max:255',
        'pdf_1' => 'nullable|file|mimes:pdf|max:10000',
        'text_2' => 'nullable|string|max:255',
        'pdf_2' => 'nullable|file|mimes:pdf|max:10000',
        'text_3' => 'nullable|string|max:255',
        'pdf_3' => 'nullable|file|mimes:pdf|max:10000',
    ]);

    $annualReport = new AnnualReport();
    $annualReport->annual_report_id = $validatedData['annual_report_id'];
    $annualReport->year = $validatedData['year'];
    $annualReport->subtitle = $validatedData['subtitle'];
    $annualReport->text_1 = $validatedData['text_1'];
    $annualReport->text_2 = $validatedData['text_2'];
    $annualReport->text_3 = $validatedData['text_3'];

    // Handle PDF uploads
    if ($request->hasFile('pdf_1')) {
        $pdf1 = $request->file('pdf_1');
        $pdf1Name = time() . '_pdf1.' . $pdf1->getClientOriginalExtension();
        $pdf1->move(public_path('pdfs'), $pdf1Name);
        $annualReport->pdf_1 = $pdf1Name;
    }

    if ($request->hasFile('pdf_2')) {
        $pdf2 = $request->file('pdf_2');
        $pdf2Name = time() . '_pdf2.' . $pdf2->getClientOriginalExtension();
        $pdf2->move(public_path('pdfs'), $pdf2Name);
        $annualReport->pdf_2 = $pdf2Name;
    }

    if ($request->hasFile('pdf_3')) {
        $pdf3 = $request->file('pdf_3');
        $pdf3Name = time() . '_pdf3.' . $pdf3->getClientOriginalExtension();
        $pdf3->move(public_path('pdfs'), $pdf3Name);
        $annualReport->pdf_3 = $pdf3Name;
    }

    $annualReport->save();

    return redirect()->back()->with('success', 'Annual report saved successfully.');
}
public function AnnualUpdate(Request $request, $id)
{
    $validatedData = $request->validate([
        'annual_report_id' => 'required|exists:annual-report-title,id',
        'year' => 'nullable|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'text_1' => 'nullable|string|max:255',
        'pdf_1' => 'nullable|file|mimes:pdf|max:10000',
        'text_2' => 'nullable|string|max:255',
        'pdf_2' => 'nullable|file|mimes:pdf|max:10000',
        'text_3' => 'nullable|string|max:255',
        'pdf_3' => 'nullable|file|mimes:pdf|max:10000',
    ]);

    $annualReport = AnnualReport::findOrFail($id);
    $annualReport->annual_report_id = $validatedData['annual_report_id'];
    $annualReport->year = $validatedData['year'];
    $annualReport->subtitle = $validatedData['subtitle'];
    $annualReport->text_1 = $validatedData['text_1'];
    $annualReport->text_2 = $validatedData['text_2'];
    $annualReport->text_3 = $validatedData['text_3'];

    // Handle PDF uploads
    if ($request->hasFile('pdf_1')) {
        $pdf1 = $request->file('pdf_1');
        $pdf1Name = time() . '_pdf1.' . $pdf1->getClientOriginalExtension();
        $pdf1->move(public_path('pdfs'), $pdf1Name);
        $annualReport->pdf_1 = $pdf1Name;
    }

    if ($request->hasFile('pdf_2')) {
        $pdf2 = $request->file('pdf_2');
        $pdf2Name = time() . '_pdf2.' . $pdf2->getClientOriginalExtension();
        $pdf2->move(public_path('pdfs'), $pdf2Name);
        $annualReport->pdf_2 = $pdf2Name;
    }

    if ($request->hasFile('pdf_3')) {
        $pdf3 = $request->file('pdf_3');
        $pdf3Name = time() . '_pdf3.' . $pdf3->getClientOriginalExtension();
        $pdf3->move(public_path('pdfs'), $pdf3Name);
        $annualReport->pdf_3 = $pdf3Name;
    }

    $annualReport->save();

    return redirect()->back()->with('success', 'Annual report updated successfully.');
}

public function AnnualDelete($id)
{
    $annualReport = AnnualReport::findOrFail($id);
    $annualReport->delete();

    return redirect()->back()->with('success', 'Annual report deleted successfully.');
} 
    
}


