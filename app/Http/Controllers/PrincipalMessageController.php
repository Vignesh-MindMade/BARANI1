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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:webp,mp4|max:2048',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $banner = new PrincipalMessage;
            $banner->name = $request->name;
            $banner->description = $request->description;
            $banner->file = $fileName;
            $banner->save();
            return redirect()->back()->with('success', 'Banner created successfully.');
        }
        return redirect()->back()->with('error', 'File upload failed.');
    }

}
