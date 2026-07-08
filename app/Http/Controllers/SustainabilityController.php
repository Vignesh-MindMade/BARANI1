<?php

namespace App\Http\Controllers;

use App\Models\Sustainability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SustainabilityGovernance;
use App\Models\SustainabilitySocial;
use App\Models\SustainabilityViewCertTitle;
use App\Models\SustainabilityCertificates;

class SustainabilityController extends Controller
{
    /* -------------------------------------------------
       FRONTEND
    ------------------------------------------------- */
    public function FrontView()
    {
$sustainabilities = Sustainability::orderBy('created_at', 'desc')->get();
        $governances      = SustainabilityGovernance::orderBy('id', 'asc')->get();
        $socials          = SustainabilitySocial::orderBy('sort_id', 'asc')->get();
        $certTitle        = SustainabilityViewCertTitle::first();
        $certificates     = SustainabilityCertificates::orderBy('sort_id', 'asc')->get();
        return view('frontend.sustainability.index', compact(
            'sustainabilities',
            'governances',
            'socials',
            'certTitle',
            'certificates'
        ));
    }

    /* -------------------------------------------------
       BACKEND – LIST
    ------------------------------------------------- */
  public function BackendIndex()
{
    $Sustainabilities = Sustainability::orderBy('created_at', 'desc')->get();
    // $governances      = SustainabilityGovernance::orderBy('created_at', 'desc')->get();

    return view('Backend.sustainability.index', compact('Sustainabilities'));
}

    /* -------------------------------------------------
       STORE
    ------------------------------------------------- */
    public function SustainStore(Request $request)
    {
        $validated = $request->validate([
            'banner'      => 'required|image|mimes:webp,jpg,jpeg|max:5120',
            'quote'       => 'nullable|string|max:1000',
            'title'       => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'points'      => 'nullable|string|max:2000',
            'image'       => 'required|image|mimes:webp,jpg,jpeg|max:5120',
        ]);

        try {
            $dest = public_path('frontend/imgs/sus');
            if (!file_exists($dest)) {
                mkdir($dest, 0755, true);
            }

            // Banner
            $bannerName = time() . '_banner.' . $request->banner->getClientOriginalExtension();
            $request->banner->move($dest, $bannerName);

            // Image
            $imageName = time() . '_image.' . $request->image->getClientOriginalExtension();
            $request->image->move($dest, $imageName);

            Sustainability::create([
                'banner'      => $bannerName,
                'quote'       => $validated['quote'],
                'title'       => $validated['title'],
                'description' => $validated['description'],
                'points'      => $validated['points'],
                'image'       => $imageName,
            ]);

            return redirect()->back()->with('success', 'Sustainability content created successfully!');
        } catch (\Exception $e) {
            Log::error('SustainStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       UPDATE
    ------------------------------------------------- */
    public function SustainUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'banner'      => 'nullable|image|mimes:webp,jpg,jpeg|max:5120',
            'quote'       => 'nullable|string|max:1000',
            'title'       => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'points'      => 'nullable|string|max:2000',
            'image'       => 'nullable|image|mimes:webp,jpg,jpeg|max:5120',
        ]);

        try {
            $sustainability = Sustainability::findOrFail($id);
            $dest = public_path('frontend/imgs/sus');
            $updateData = [];

            // ---- Banner ----
            if ($request->hasFile('banner')) {
                if ($sustainability->banner && file_exists($dest . '/' . $sustainability->banner)) {
                    @unlink($dest . '/' . $sustainability->banner);
                }
                $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
                $request->file('banner')->move($dest, $bannerName);
                $updateData['banner'] = $bannerName;
            }

            // ---- Image ----
            if ($request->hasFile('image')) {
                if ($sustainability->image && file_exists($dest . '/' . $sustainability->image)) {
                    @unlink($dest . '/' . $sustainability->image);
                }
                $imageName = time() . '_image.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($dest, $imageName);
                $updateData['image'] = $imageName;
            }

            // ---- Text fields ----
            $updateData = array_merge($updateData, [
                'quote'       => $validated['quote'],
                'title'       => $validated['title'],
                'description' => $validated['description'],
                'points'      => $validated['points'],
            ]);

            $sustainability->update($updateData);

            return redirect()->back()->with('success', 'Sustainability content updated successfully!');
        } catch (\Exception $e) {
            Log::error('SustainUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       DESTROY
    ------------------------------------------------- */
    public function SustainDestroy($id)
    {
        try {
            $sustainability = Sustainability::findOrFail($id);
            $dest = public_path('frontend/imgs/sus');

            // Delete banner
            if ($sustainability->banner && file_exists($dest . '/' . $sustainability->banner)) {
                @unlink($dest . '/' . $sustainability->banner);
            }

            // Delete image
            if ($sustainability->image && file_exists($dest . '/' . $sustainability->image)) {
                @unlink($dest . '/' . $sustainability->image);
            }

            $sustainability->delete();

            return redirect()->back()->with('success', 'Sustainability content deleted successfully!');
        } catch (\Exception $e) {
            Log::error('SustainDestroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }


   // SustainabilityGovernance

    public function SustainabilityGovernanceIndex(){
       $governances = SustainabilityGovernance::all();

        return view('Backend.sustainability.governance', compact('governances'));   
    }

    /* -------------------------------------------------
       GOVERNANCE STORE
    ------------------------------------------------- */
    public function governanceStore(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'points'      => 'nullable|string|max:2000',
        ]);

        try {
            SustainabilityGovernance::create($validated);

            return redirect()->back()->with('success', 'Governance content created successfully!');
        } catch (\Exception $e) {
            Log::error('governanceStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       GOVERNANCE UPDATE
    ------------------------------------------------- */
    public function governanceUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'points'      => 'nullable|string|max:2000',
        ]);

        try {
            $governance = SustainabilityGovernance::findOrFail($id);
            $governance->update($validated);
            

            return redirect()->back()->with('success', 'Governance content updated successfully!');
        } catch (\Exception $e) {
            Log::error('governanceUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       GOVERNANCE DESTROY
    ------------------------------------------------- */
    public function governanceDestroy($id)
    {
        try {
            $governance = SustainabilityGovernance::findOrFail($id);
            $governance->delete();

            return redirect()->back()->with('success', 'Governance content deleted successfully!');
        } catch (\Exception $e) {
            Log::error('governanceDestroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }
        /* -------------------------------------------------
       SUSTAINABILITY SOCIAL – INDEX
    ------------------------------------------------- */
    public function SustainabilitySocialIndex()
    {
        $socials = \App\Models\SustainabilitySocial::orderBy('sort_id', 'asc')->get();
        return view('Backend.sustainability.social', compact('socials'));
    }

    /* -------------------------------------------------
       SUSTAINABILITY SOCIAL – STORE
    ------------------------------------------------- */
    public function SustainabilitySocialStore(Request $request)
    {
        $validated = $request->validate([
            'sort_id'     => 'nullable|integer',
            'main_title'  => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image'       => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
        ]);

        try {
            $data = $validated;

            if ($request->hasFile('image')) {
                $dest = public_path('frontend/imgs/sus');
                if (!file_exists($dest)) mkdir($dest, 0755, true);

                $imageName = time() . '_social.' . $request->image->getClientOriginalExtension();
                $request->image->move($dest, $imageName);
                $data['image'] = $imageName;
            }

            \App\Models\SustainabilitySocial::create($data);

            return redirect()->back()->with('success', 'Social content created successfully!');
        } catch (\Exception $e) {
            Log::error('SustainabilitySocialStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store social content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       SUSTAINABILITY SOCIAL – UPDATE
    ------------------------------------------------- */
    public function SustainabilitySocialUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'sort_id'     => 'nullable|integer',
            'main_title'  => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image'       => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
        ]);

        try {
            $social = \App\Models\SustainabilitySocial::findOrFail($id);
            $dest = public_path('frontend/imgs/sus');
            $updateData = $validated;

            if ($request->hasFile('image')) {
                if ($social->image && file_exists($dest . '/' . $social->image)) {
                    @unlink($dest . '/' . $social->image);
                }

                $imageName = time() . '_social.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($dest, $imageName);
                $updateData['image'] = $imageName;
            }

            $social->update($updateData);

            return redirect()->back()->with('success', 'Social content updated successfully!');
        } catch (\Exception $e) {
            Log::error('SustainabilitySocialUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update social content: ' . $e->getMessage());
        }
    }

    /* -------------------------------------------------
       SUSTAINABILITY SOCIAL – DESTROY
    ------------------------------------------------- */
    public function SustainabilitySocialDestroy($id)
    {
        try {
            $social = \App\Models\SustainabilitySocial::findOrFail($id);
            $dest = public_path('frontend/imgs/sus');

            if ($social->image && file_exists($dest . '/' . $social->image)) {
                @unlink($dest . '/' . $social->image);
            }

            $social->delete();

            return redirect()->back()->with('success', 'Social content deleted successfully!');
        } catch (\Exception $e) {
            Log::error('SustainabilitySocialDestroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete social content: ' . $e->getMessage());
        }
    }

 public function SustainabilityCertificatesIndex()
    {
        $certTitle = SustainabilityViewCertTitle::first();
        $certificates = SustainabilityCertificates::orderBy('sort_id', 'asc')->get();
        return view('Backend.sustainability.certificates', compact('certTitle', 'certificates'));
    }

    public function SustainabilityCertificatesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'pdf'   => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $validated;
        $dest = public_path('frontend/imgs/sus');
        if (!file_exists($dest)) mkdir($dest, 0755, true);

        if ($request->hasFile('image')) {
            $img = time().'_cert.'.$request->image->getClientOriginalExtension();
            $request->image->move($dest, $img);
            $data['image'] = $img;
        }

        if ($request->hasFile('pdf')) {
            $pdfName = time().'_cert.pdf';
            $request->pdf->move($dest, $pdfName);
            $data['pdf'] = $pdfName;
        }

        SustainabilityCertificates::create($data);
        return redirect()->back()->with('success', 'Certificate added successfully!');
    }

    public function SustainabilityCertificatesUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5120',
            'pdf'   => 'nullable|mimes:pdf|max:10240',
        ]);

        $cert = SustainabilityCertificates::findOrFail($id);
        $dest = public_path('frontend/imgs/sus');
        $updateData = $validated;

        if ($request->hasFile('image')) {
            if ($cert->image && file_exists($dest.'/'.$cert->image)) @unlink($dest.'/'.$cert->image);
            $img = time().'_cert.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dest, $img);
            $updateData['image'] = $img;
        }

        if ($request->hasFile('pdf')) {
            if ($cert->pdf && file_exists($dest.'/'.$cert->pdf)) @unlink($dest.'/'.$cert->pdf);
            $pdfName = time().'_cert.pdf';
            $request->pdf->move($dest, $pdfName);
            $updateData['pdf'] = $pdfName;
        }

        $cert->update($updateData);
        return redirect()->back()->with('success', 'Certificate updated successfully!');
    }

    public function SustainabilityCertificatesDestroy($id)
    {
        $cert = SustainabilityCertificates::findOrFail($id);
        $dest = public_path('frontend/imgs/sus');
        if ($cert->image && file_exists($dest.'/'.$cert->image)) @unlink($dest.'/'.$cert->image);
        if ($cert->pdf && file_exists($dest.'/'.$cert->pdf)) @unlink($dest.'/'.$cert->pdf);
        $cert->delete();
        return redirect()->back()->with('success', 'Certificate deleted successfully!');
    }

    /* -------------------------------------------------
       CERTIFICATE TITLE SECTION
    ------------------------------------------------- */
    public function SustainabilityCertTitleStoreOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'main_title' => 'nullable|string|max:255',
            'sub_title'  => 'nullable|string|max:255',
        ]);

        $certTitle = SustainabilityViewCertTitle::first();
        if ($certTitle) {
            $certTitle->update($validated);
        } else {
            SustainabilityViewCertTitle::create($validated);
        }

        return redirect()->back()->with('success', 'Certificate title updated successfully!');
    }
}