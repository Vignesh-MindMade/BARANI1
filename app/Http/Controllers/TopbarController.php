<?php

namespace App\Http\Controllers;

use App\Models\Topbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TopbarController extends Controller
{
    
public function Front()
{
    $topbars = Topbar::orderBy('sort_id', 'asc')->get();
    return view('frontend.download.index', compact('topbars'));
}

    public function index()
    {
        $topbars = Topbar::orderBy('sort_id', 'asc')->get();
    
        View::share('topbars', $topbars);
    
        return view('topbar.index', compact('topbars'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'updated_on' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'catagory' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
            'minimum_age_rules_points' => 'required|string|max:2000',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $topbar = new Topbar;
        $topbar->updated_on = $validatedData['updated_on'];
        $topbar->title = $validatedData['title'];
        $topbar->catagory = $validatedData['catagory'];
        $topbar->description = $validatedData['description'];
        $topbar->minimum_age_rules_points = $validatedData['minimum_age_rules_points'];
        $topbar->sort_id = $validatedData['sort_id'];

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('download_pdf'), $filename);
            $topbar->pdf = $filename; 
        }

        $topbar->save();

        return redirect()->back()->with('success', 'TopBar created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'updated_on' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'catagory' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'minimum_age_rules_points' => 'required|string|max:2000',
            'sort_id' => 'nullable|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5120', 
        ]);

        $topbar = Topbar::findOrFail($id);

        $topbar->updated_on = $validatedData['updated_on'];
        $topbar->title = $validatedData['title'];
        $topbar->catagory = $validatedData['catagory'];
        $topbar->description = $validatedData['description'];
        $topbar->minimum_age_rules_points = $validatedData['minimum_age_rules_points'];
        $topbar->sort_id = $validatedData['sort_id'] ?? $topbar->sort_id;

        if ($request->hasFile('pdf')) {

            if ($topbar->pdf && file_exists(public_path('download_pdf/' . $topbar->pdf))) {
                unlink(public_path('download_pdf/' . $topbar->pdf));
            }

            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('download_pdf'), $filename);
            $topbar->pdf = $filename;
        }

        $topbar->save();

        return redirect()->route('topbar.index')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $topbar = Topbar::findOrFail($id);
        $topbar->delete();

        return redirect()->back()->with('success', 'TopBar deleted successfully.');
    }        
}
