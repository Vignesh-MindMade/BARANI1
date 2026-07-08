<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Capabilities;
use App\Models\Capabilities_Faq;

class CapabilitiesController extends Controller
{
    /* -------------------------------------------------
       FRONTEND VIEW
    ------------------------------------------------- */
    public function FrontView()
    {
        $capabilities = Capabilities::first(); // Single record expected
        $faqs = Capabilities_Faq::where('faq_question', '!=', '')
          ->orderBy('id', 'ASC')
          ->get();

// return view('frontend.capabilities.fndex', compact('faqs'));

        return view('frontend.capabilities.fndex', compact('capabilities','faqs'));
    }

    /* -------------------------------------------------
       BACKEND VIEW
    ------------------------------------------------- */
    public function BackendIndex()
    {
        $capabilities = Capabilities::first(); // Single record editable
        return view('Backend.capabilities.index', compact('capabilities'));
    }

    /* -------------------------------------------------
       STORE
    ------------------------------------------------- */
    public function Store(Request $request)
    {
        $validated = $request->validate([
            'capabilities_title' => 'required|string|max:255',
            'capabilities_desc'  => 'nullable|string',
            
            'capabilities_workflow_section1_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_workflow_section2_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_workflow_section3_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_parallax_image'          => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_quality_environmental_systems_left_image'  => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_quality_environmental_systems_right_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
        ]);

        try {
            $data = $request->except('_token');
            $dest = public_path('frontend/imgs/capabilities');

            if (!file_exists($dest)) mkdir($dest, 0755, true);

            // Handle image uploads
            foreach ($request->allFiles() as $key => $file) {
                $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                $file->move($dest, $filename);
                $data[$key] = $filename;
            }

            Capabilities::create($data);

            return redirect()->back()->with('success', 'Capabilities section created successfully!');
        } catch (\Exception $e) {
            Log::error('CapabilitiesStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       UPDATE
    ------------------------------------------------- */
    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'capabilities_title' => 'required|string|max:255',
            'capabilities_desc'  => 'nullable|string',
            
            'capabilities_workflow_section1_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_workflow_section2_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_workflow_section3_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_parallax_image'          => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_quality_environmental_systems_left_image'  => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'capabilities_quality_environmental_systems_right_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
        ]);

        try {
            $capability = Capabilities::findOrFail($id);
            $updateData = $request->except('_token', '_method');
            $dest = public_path('frontend/imgs/capabilities');

            if (!file_exists($dest)) mkdir($dest, 0755, true);

            foreach ($request->allFiles() as $key => $file) {
                if ($capability->$key && file_exists($dest . '/' . $capability->$key)) {
                    @unlink($dest . '/' . $capability->$key);
                }
                $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                $file->move($dest, $filename);
                $updateData[$key] = $filename;
            }

            $capability->update($updateData);

            return redirect()->back()->with('success', 'Capabilities updated successfully!');
        } catch (\Exception $e) {
            Log::error('CapabilitiesUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       DELETE
    ------------------------------------------------- */
    public function Destroy($id)
    {
        try {
            $capability = Capabilities::findOrFail($id);
            $dest = public_path('frontend/imgs/capabilities');

            foreach ($capability->getAttributes() as $key => $value) {
                if (str_contains($key, 'image') && $value && file_exists($dest . '/' . $value)) {
                    @unlink($dest . '/' . $value);
                }
            }

            $capability->delete();
            return redirect()->back()->with('success', 'Capabilities record deleted successfully!');
        } catch (\Exception $e) {
            Log::error('CapabilitiesDestroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete: ' . $e->getMessage());
        }
    }
// FAQ"S section

    public function BackendFaqIndex()
{
    $faqs = Capabilities_Faq::latest()->get();
    return view('Backend.capabilities.capabilities_faq', compact('faqs'));
}

/* --------------------------------------
   STORE FAQ
--------------------------------------- */
public function FaqStore(Request $request)
{
    $validated = $request->validate([
        'faq_title'     => 'nullable|string|max:255',
        'faq_question'  => 'required|string',
        'faq_answers'   => 'required|string',
    ]);

    try {
        Capabilities_Faq::create($validated);
        return redirect()->back()->with('success', 'FAQ created successfully!');
    } catch (\Exception $e) {
        Log::error('CapabilitiesFaqStore Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to create FAQ.');
    }
}

/* --------------------------------------
   UPDATE FAQ
--------------------------------------- */
public function FaqUpdate(Request $request, $id)
{
    $validated = $request->validate([
        
        'faq_question'  => 'required|string',
        'faq_answers'   => 'required|string',
    ]);

    try {
        $faq = Capabilities_Faq::findOrFail($id);
        $faq->update($validated);

        return redirect()->back()->with('success', 'FAQ updated successfully!');
    } catch (\Exception $e) {
        Log::error('CapabilitiesFaqUpdate Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update FAQ.');
    }
}

public function FaqTitleUpdate(Request $request)
{
    $request->validate([
        'faq_title' => 'required|string|max:255',
    ]);

    // Single title stored in capabilities_faq table (id = 1)
    $faqTitle = Capabilities_Faq::first();

    if (!$faqTitle) {
        Capabilities_Faq::create([
            'faq_title' => $request->faq_title,
            'faq_question' => '',
            'faq_answers' => '',
        ]);
    } else {
        $faqTitle->update([
            'faq_title' => $request->faq_title
        ]);
    }

    return back()->with('success', 'FAQ Title updated!');
}

/* --------------------------------------
   DELETE FAQ
--------------------------------------- */
public function FaqDestroy($id)
{
    try {
        $faq = Capabilities_Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    } catch (\Exception $e) {
        Log::error('CapabilitiesFaqDelete Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to delete FAQ.');
    }
}
}
