<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infrastructure_front;
use App\Models\Infrastructure_Detatil;
use App\Models\Infrastrcture_subfolders;


class InfrastructureController extends Controller
{
 
    public function index()
    {
        $Infrastructure_fronts = Infrastructure_front::all(); 
        $Infrastructure_Details = Infrastructure_Detatil::all();
        return view('Infrastructure.index', compact('Infrastructure_fronts', 'Infrastructure_Details'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        Infrastructure_front::create($validatedData);
        return redirect()->back()->with('success', 'Data saved successfully!');
    }
    
    public function update(Request $request, $id){

        $Infrastructure_front = Infrastructure_front::findOrFail($id);
    
        $Infrastructure_front->title = $request->title;

        $Infrastructure_front->save();
    
        return redirect()->back()->with('success', 'Circular updated successfully!');
    }

    public function destroy($id){

        $Infrastructure_front = Infrastructure_front::findOrFail($id);
        $Infrastructure_front->delete();
        return redirect()->back()->with('success', 'Circular deleted successfully!');
    }


    public function detatilStore(Request $request)
    {
       
        $validatedData = $request->validate([
            'Infrastructure_id' => 'required|exists:infrastructure_front,id',
            'infrastructure_title' => 'nullable|string|max:255',
           
        ]);
    
        Infrastructure_Detatil::create([
            'Infrastructure_id' => $validatedData['Infrastructure_id'],
            'infrastructure_title' => $validatedData['infrastructure_title'] ?? null,
           
        ]);
        return redirect()->back()->with('success', 'Data saved successfully!');
    }
    
    public function Detatilupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Infrastructure_id' => 'required|exists:infrastructure_front,id',
           
        ]);
    
        $infrastructureDetail = Infrastructure_Detatil::findOrFail($id);
    
        if ($request->has('Infrastructure_id')) {
            $infrastructureDetail->Infrastructure_id = $request->input('Infrastructure_id');
        }
    
        if ($request->has('infrastructure_title')) {
            $infrastructureDetail->infrastructure_title = $request->input('infrastructure_title');
        }   
        $infrastructureDetail->save();
    
        return redirect()->route('infrastructure.index')->with('success', 'Data updated successfully!');
    }

    
    public function Detatildestroy($id){

    $infrastructureDetail = Infrastructure_Detatil::findOrFail($id);
    $infrastructureDetail->delete();

    return redirect()->route('infrastructure.index')->with('success', 'Record deleted successfully!');
    }



    public function SubfolderStore(Request $request)
    {

        $validatedData = $request->validate([
            'Infrastructure_detatil_id' => 'required|exists:infrastructure_detatil,id',
            'image' => 'nullable|image|mimes:jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['image'] = '' . $fileName;
        }

        Infrastrcture_subfolders::create([
            'Infrastructure_detatil_id' => $validatedData['Infrastructure_detatil_id'],
            'image' => $validatedData['image'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Subfolder saved successfully!');

    }

}



