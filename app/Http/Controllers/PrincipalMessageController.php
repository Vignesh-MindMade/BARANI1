<?php

namespace App\Http\Controllers;
use App\Models\PrincipalMessage;
use Illuminate\Http\Request;

class PrincipalMessageController extends Controller
{
    public function index()
    {
        $messages = PrincipalMessage::all();
        return view('message.index',compact('messages'));
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'file' => 'required|file|mimes:webp,mp4|max:2048',
    //         'name' => 'required|string',
    //         'description' => 'nullable|string',
    //     ]);

    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('images'), $fileName);
    //         $banner = new PrincipalMessage;
    //         $banner->name = $request->name;
    //         $banner->description = $request->description;
    //         $banner->file = $fileName;
    //         $banner->save();
    //         return redirect()->back()->with('success', 'Banner created successfully.');
    //     }
    //     return redirect()->back()->with('error', 'File upload failed.');
    // }


    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'file' => 'nullable|file|mimes:webp,mp4|max:2048',
    //         'name' => 'required|string',
    //         'description' => 'nullable|string',
    //     ]);

    //     $banner = PrincipalMessage::findOrFail($id);
    //     $banner->name = $request->name;
    //     $banner->description = $request->description;

    //     if ($request->hasFile('file')) {
    //         // Delete old file
    //         if ($banner->file && file_exists(public_path('images/' . $banner->file))) {
    //             unlink(public_path('images/' . $banner->file));
    //         }

    //         $file = $request->file('file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('images'), $fileName);
    //         $banner->file = $fileName;
    //     }

    //     $banner->save();
    //     return redirect()->back()->with('success', 'Banner updated successfully.');
    // }
    
    
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'file' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                'description' => 'required|string',
            ]);
        
            $trust = PrincipalMessage::first();
        
            // Handle image upload
            $validatedData['file'] = $this->handleImageUpload($request, 'file', $trust ? $trust->file : null);
            
        
            if ($trust) {
                $trust->update($validatedData);
            } else {
                PrincipalMessage::create($validatedData);
            }
        
            return redirect()->back()->with('success', 'Content saved successfully.');
        }
        
        
        private function handleImageUpload(Request $request, $fieldName, $default = null)
        {
                if ($request->hasFile($fieldName)) {
                    $image = $request->file($fieldName);
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    return $imageName;
                } else {
                    return $default;
                }
            }

    public function destroy($id)
    {
        $banner = PrincipalMessage::findOrFail($id);

        // Delete file
        if ($banner->file && file_exists(public_path('images/' . $banner->file))) {
            unlink(public_path('images/' . $banner->file));
        }

        $banner->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }

}
