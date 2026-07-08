<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EditoriolSections;
use App\Models\Organization;
use App\Models\OrganizationDetatil;
use App\Models\FAQ;
use App\Models\FAQdetail;
use App\Models\OurService;

class EditoriolController extends Controller
{
    public function Editoriolindex()
    {
        $editoriolsections = EditoriolSections::all();
        return view('Backend.Home.aboutus', compact('editoriolsections'));
    } 

    public function Editoriolupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ]);

        $editoriolsections = EditoriolSections::findOrFail($id);
        $editoriolsections->title = $validatedData['title'];
        $editoriolsections->description = $validatedData['description'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $editoriolsections->image = $imageName;
        }

        $editoriolsections->save();

        return redirect()->back()->with('success', 'Testimonial updated successfully.');
    }

    public function OrganizationIndex()
    {
        $Organizations = Organization::all();
        return view('Backend.Home.organization', compact('Organizations'));
    }


    public function OrganizationUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $organization = Organization::findOrFail($id);
        $organization->title = $validatedData['title'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $organization->image = $imageName;
        }

        $organization->save();

        return redirect()->back()->with('success', 'Organization updated successfully.');
    }

    public function OrganizationDetail()
    {
        $OrganizationDetatil = OrganizationDetatil::all();
        return view('Backend.Home.organization_detail', compact('OrganizationDetatil'));
    }
 
    public function OrganizationStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $organizationDetail = new OrganizationDetatil();
        $organizationDetail->title = $validatedData['title'];
        $organizationDetail->description = $validatedData['description'];

        $organizationDetail->save();

        return redirect()->back()->with('success', 'Organization detail created successfully.');
    }


    public function OrganizationDetailUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $organizationDetail = OrganizationDetatil::findOrFail($id);
        $organizationDetail->title = $validatedData['title'];
        $organizationDetail->description = $validatedData['description'];

        $organizationDetail->save();

        return redirect()->back()->with('success', 'Organization detail updated successfully.');
    }

    public function OrganizationDetailDelete($id)
    {
        $organizationDetail = OrganizationDetatil::findOrFail($id);
        $organizationDetail->delete();

        return redirect()->back()->with('success', 'Organization detail deleted successfully.');
    }


    // FAQ!

    public function FAQIndex()
        {
            $faq = FAQ::first(); // Get the first FAQ or null if none exists
            return view('Backend.Home.faq', compact('faq'));
        }
    public function FAQStore(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        $faq = new FAQ();
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];

        $faq->save();

        return redirect()->back()->with('success', 'FAQ created successfully.');
    }

        public function FaqUpdate(Request $request, $id = null)
            {
                $validated = $request->validate([
                    'established' => 'required|string|max:255',
                    'manufacturing_units' => 'required|string|max:255',
                    'employees' => 'required|string|max:255',
                    'global_reach' => 'nullable|string|max:255',
                ]);

                if ($id) {
                    // Update existing FAQ
                    $faq = FAQ::findOrFail($id);
                    $faq->update($validated);
                    $message = 'FAQ updated successfully!';
                } else {
                    // Create new FAQ
                    FAQ::create($validated);
                    $message = 'FAQ created successfully!';
                }

                return redirect()->route('faq.index')->with('success', $message);
    }

    public function FAQDelete($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }

    public function FAQTitleIndex()
    {
        $FAQTitles = FAQdetail::all();
        return view('Backend.Home.faq_detatils', compact('FAQTitles'));
    }

    public function FAQTitleUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $FAQTitles = FAQdetail::findOrFail($id);
        $FAQTitles->title = $validatedData['title'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $FAQTitles->image = $imageName;
        }

        $FAQTitles->save();

        return redirect()->back()->with('success', 'FAQ title updated successfully.');
    }
   


        public function SERVICEIndex()
        {
            $OurService = OurService::first();
            return view('Backend.Home.ourservice', compact('OurService'));
        }
    
        public function OURSERVICEUpdate(Request $request, $id = null)
        {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'description' => 'nullable|string',
                'points_title' => 'nullable|string|max:255',
                'point_1' => 'nullable|string|max:255',
                'point_2' => 'nullable|string|max:255',
                'point_3' => 'nullable|string|max:255',
                'point_4' => 'nullable|string|max:255',
                'point_5' => 'nullable|string|max:255',
                'point_6' => 'nullable|string|max:255',
                'readmore_link' => 'nullable|string|max:255',
            ]);

            if ($id) {
        $OurService = OurService::findOrFail($id);

        if ($request->hasFile('image')) {

            // delete old image
            if ($OurService->image && file_exists(public_path($OurService->image))) {
                unlink(public_path($OurService->image));
            }

            // upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ourservice'), $imageName);

            $validated['image'] = 'uploads/ourservice/' . $imageName;
        }

        $OurService->update($validated);
        $message = 'OurService updated successfully!';
    } 
    else {

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ourservice'), $imageName);
            $validated['image'] = 'uploads/ourservice/' . $imageName;
        }

        OurService::create($validated);
        $message = 'OurService created successfully!';
         }

    return redirect()->route('ourservice.index')->with('success', $message);
 }
}