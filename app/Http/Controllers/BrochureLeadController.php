<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrochureLead;
use Illuminate\Support\Facades\Storage;

class BrochureLeadController extends Controller
{
    //
public function storeLead(Request $request)
{
    $request->validate([
        'name' => 'required',
        'company' => 'required',
        'country' => 'required',
        'phone' => 'required',
        'email' => 'required|email'
    ]);

    BrochureLead::create([
        'name' => $request->name,
        'company_name' => $request->company,
        'country' => $request->country,
        'phone_no' => $request->phone,
        'email' => $request->email,
    ]);

    // Get the brochure filename from form (stored in database for each page)
    $requestedFile = $request->input('brochure_file');
    
    // If no brochure file specified, return error
    if (!$requestedFile) {
        return response()->json([
            'success' => false,
            'message' => 'No brochure file specified for this page',
            'status' => 404
        ], 404);
    }
    
    // Brochures are stored in frontend/imgs/submenu/ directory (with timestamp prefix)
    $brochuresDir = public_path('frontend/imgs/submenu/');
    $filePath = $brochuresDir . $requestedFile;
    
    // Check if the file exists
    if (!file_exists($filePath)) {
        return response()->json([
            'success' => false,
            'message' => 'Brochure file not found: ' . $requestedFile,
            'status' => 404
        ], 404);
    }

    // Get the original filename without timestamp for download
    $downloadName = preg_replace('/^\d+_brochure_/', '', $requestedFile);

    // Directly return the download
    return response()->download($filePath, $downloadName, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $downloadName . '"'
    ]);
}

public function download($file)
{
    // Files are stored in frontend/imgs/submenu/ directory with timestamp prefix
    $path = public_path('frontend/imgs/submenu/' . $file);

    if (!file_exists($path)) {
        return redirect()->back()->with('error', 'Brochure file not found');
    }

    // Get the original filename without timestamp for download
    $downloadName = preg_replace('/^\d+_brochure_/', '', $file);

    return response()->download($path, $downloadName, [
        'Content-Type' => 'application/pdf',
    ]);
}


}


