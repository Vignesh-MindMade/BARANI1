<?php

namespace App\Http\Controllers;

use App\Models\Results_detail;
use App\Models\Results_front;
use Illuminate\Http\Request;


class ResultController extends Controller
{

    public function index()
    {
       $Infrastructure_fronts = Results_front::orderBy('sort_id', 'ASC')->get();
    $Infrastructure_Details = Results_detail::with('infrastructure')->orderBy('Infrastructure_id')->orderBy('sort_id', 'ASC')->get();
        return view('Backend.results.index', compact('Infrastructure_fronts', 'Infrastructure_Details'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sort_id'=> 'nullable|integer',
        ]);
        Results_front::create($validatedData);
        return redirect()->back()->with('success', 'Title saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $Infrastructure_front = Results_front::findOrFail($id);
        $Infrastructure_front->title = $request->title;
        $Infrastructure_front->sort_id=$request->sort_id;
        $Infrastructure_front->save();

        return redirect()->back()->with('success', 'Title updated successfully!');
    }

    public function destroy($id)
    {

        $Infrastructure_front = Results_front::findOrFail($id);
        $Infrastructure_front->delete();
        return redirect()->back()->with('success', 'Title deleted successfully!');
    }

    public function detatilStore(Request $request)
    {
        $validatedData = $request->validate([
            'Infrastructure_id' => 'required|exists:front_results,id',
            'infrastructure_title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'pdf' => 'nullable|file|mimes:png,jpg,webp|max:5120',
            'sort_id'=> 'nullable|integer',
            'url'=>'nullable|string|max:10000',
        ]);

        $pdfPath = null;

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdfs'), $pdfName);
            $pdfPath = $pdfName;
        }

        Results_detail::create([
            'Infrastructure_id' => $validatedData['Infrastructure_id'],
            'infrastructure_title' => $validatedData['infrastructure_title'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'pdf' => $pdfPath,
            'sort_id'=> $validatedData['sort_id']?? null,
            'url'=> $validatedData['url'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Product saved successfully!');
    }

    public function Detatilupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Infrastructure_id' => 'required|exists:front_results,id',
            'infrastructure_title' => 'nullable|string|max:255',
             'description' => 'nullable|string|max:2550',
            'pdf' => 'nullable|file|mimes:png,jpg,webp|max:5120',
             'sort_id'=> 'nullable|integer',
             'url'=>'nullable|string|max:10000',
        ]);

        $infrastructureDetail = Results_detail::findOrFail($id);
        $infrastructureDetail->Infrastructure_id = $validatedData['Infrastructure_id'];
        $infrastructureDetail->infrastructure_title = $validatedData['infrastructure_title'] ?? null;
        $infrastructureDetail->description = $validatedData['description'] ?? null;
        $infrastructureDetail->sort_id =$validatedData['sort_id']?? null;
          $infrastructureDetail->url = $validatedData['url'] ?? null;

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdfs'), $pdfName);
            $infrastructureDetail->pdf = $pdfName;
          
        }

        $infrastructureDetail->save();

        return redirect()->route('results.index')->with('success', 'Product updated successfully!');
    }


    public function Detatildestroy($id)
    {
        $infrastructureDetail = Results_detail::findOrFail($id);
        $infrastructureDetail->delete();

        return redirect()->route('results.index')->with('success', 'Product deleted successfully!');
    }
}
