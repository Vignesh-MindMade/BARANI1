<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrer;
use App\Models\JobApplication;
use App\Models\CarrerWhatWeOffer;
use App\Mail\CareerApplication;
use Illuminate\Support\Facades\Mail;
use App\Rules\Recaptcha;

class CarrierController extends Controller
{

public function frontviewofcarrer()
{
    $banner = Carrer::whereNotNull('banner_image')
                    ->latest('updated_at')
                    ->first();

    // existing data
    
    $Carrers = Carrer::all();

    return view('frontend.carrer.index', compact( 'Carrers', 'banner'));
}
    public function storeBanner(Request $request)
    {
        $validatedData = $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $path = $request->file('banner_image')->store('career_banners', 'public');
        $bannerImagePath = 'storage/' . $path;

        $bannerCareer = Carrer::whereNotNull('banner_image')->latest('updated_at')->first();

        if ($bannerCareer) {
            $bannerCareer->update(['banner_image' => $bannerImagePath]);
        } else {
            Carrer::create([
                'job_title' => 'Banner-Specific Record',
                'categories' => 'Banner',
                'location' => 'N/A',
                'description' => 'Automatically created banner record',
                'posted_at' => now(),
                'minimum_age_rules_points' => 'Banner',
                'banner_image' => $bannerImagePath,
            ]);
        }

        return redirect()->route('career.index')->with('success', 'Banner uploaded successfully');
    }
    public function careerindex()
    {
        $careers = Carrer::all();
        $banner = Carrer::whereNotNull('banner_image')->latest('updated_at')->first();
        return view('Backend.carrier.index', compact('careers', 'banner'));
    }

    public function RedirectIndex($id)
    {
        $carrer = Carrer::findOrFail($id);
        return view('frontend.carrer.redirect', compact('carrer'));
    }

    public function GeneralRedirectIndex()
    {
        $generalcarrer = Carrer::all();
        return view('frontend.carrer.general', compact('generalcarrer'));
    }

    public function careerstore(Request $request)
    {

        $validatedData = $request->validate([
            'job_title' => 'required|string|max:255',
            'categories' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'posted_at' => 'required|date',
            'description' => 'required|string',
            'minimum_age_rules_points' => 'required|string|max:2000',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('career_banners', 'public');
            $validatedData['banner_image'] = 'storage/' . $path;
        }

        try {

            Carrer::create($validatedData);


            return redirect()->route('career.index')->with('success', 'Career added successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Failed to add career. Error: ' . $e->getMessage());
        }
    }

    public function careerupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'job_title' => 'required|string|max:255',
            'categories' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'posted_at' => 'required|date',
            'description' => 'required|string',
            'minimum_age_rules_points' => 'required|string|max:2000',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('career_banners', 'public');
            $validatedData['banner_image'] = 'storage/' . $path;
        }

        try {

            $career = Carrer::findOrFail($id);

            $career->update($validatedData);

            return redirect()->route('career.index')->with('success', 'Career updated successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to update career. Error: ' . $e->getMessage());
        }
    }

    public function careerdestroy($id)
    {
        $career = Carrer::findOrFail($id);
        $career->delete();

        return redirect()->route('career.index')->with('success', 'Career deleted successfully.');
    }

    public function storeApplication(Request $request)
    {
        $validatedData = $request->validate([
            'unit' => 'required|string|max:200',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'expected_salary' => 'nullable|numeric|min:0',
            'available_from' => 'required|date',
            'qualification' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'additional_docs' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'agreement' => 'required|accepted',
        ]);

        // Store files directly in public directory
        $resumeName = time() . '_' . $request->file('resume')->getClientOriginalName();
        $resumePath = $request->file('resume')->move(public_path('resumes'), $resumeName);

        $additionalDocsPath = $request->hasFile('additional_docs')
            ? $request->file('additional_docs')->move(public_path('additional_docs'), $request->file('additional_docs')->getClientOriginalName())
            : null;

        // Store in database
        $application = JobApplication::create([
            'unit' => $validatedData['unit'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'position' => $validatedData['position'],
            'experience_years' => $validatedData['experience_years'],
            'expected_salary' => $validatedData['expected_salary'],
            'available_from' => $validatedData['available_from'],
            'qualification' => $validatedData['qualification'],
            'specialization' => $validatedData['specialization'],
            'resume_path' => $resumePath,
            'additional_docs_path' => $additionalDocsPath,
        ]);

        $unitEmails = [
            'Unit1' => 'Selvarajm@bhipl.co.in',
            'Unit2' => 'Selvarajm@bhipl.co.in',
            'Unit3' => 'Selvarajm@bhipl.co.in',
        ];

        $to_email = $unitEmails[$validatedData['unit']] ?? 'vigneshnathan@mindmade.in';

        Mail::to($to_email)
            ->send(new CareerApplication($application, $resumePath));

        return redirect()->route('carrers.index')
            ->with('success', 'Application submitted successfully! We will contact you soon.');
    }



    public function generalApplication(Request $request)
    {
        $validatedData = $request->validate([
            'unit' => 'required|string|max:200',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'expected_salary' => 'nullable|numeric|min:0',
            'available_from' => 'required|date',
            'qualification' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'additional_docs' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'agreement' => 'required|accepted',
        ]);

        // Store files directly in public directory
        $resumeName = time() . '_' . $request->file('resume')->getClientOriginalName();
        $resumePath = $request->file('resume')->move(public_path('resumes'), $resumeName);

        $additionalDocsPath = $request->hasFile('additional_docs')
            ? $request->file('additional_docs')->move(public_path('additional_docs'), $request->file('additional_docs')->getClientOriginalName())
            : null;

        // Store in database
        $application = JobApplication::create([
            'unit' => $validatedData['unit'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'position' => $validatedData['position'],
            'experience_years' => $validatedData['experience_years'],
            'expected_salary' => $validatedData['expected_salary'],
            'available_from' => $validatedData['available_from'],
            'qualification' => $validatedData['qualification'],
            'specialization' => $validatedData['specialization'],
            'resume_path' => $resumePath,
            'additional_docs_path' => $additionalDocsPath,
        ]);

        $unitEmails = [
            'Unit1' => 'Selvarajm@bhipl.co.in',
            'Unit2' => 'Selvarajm@bhipl.co.in',
            'Unit3' => 'Selvarajm@bhipl.co.in',
        ];

        $to_email = $unitEmails[$validatedData['unit']] ?? 'manoj@mindmade.in';

        Mail::to($to_email)
            ->send(new CareerApplication($application, $resumePath));

        return redirect()->route('carrers.index')
            ->with('success', 'Application submitted successfully! We will contact you soon.');
    }


    // What We Offer

    public function WhatweOfferIndex()
    {

        return view('backend.carrier.whatweoffer');

    }


}