<?php

namespace App\Http\Controllers;
use App\Models\NewsandEvents;
use Illuminate\Http\Request;

class NewsandeventsController extends Controller
{
    public function index()
    {
        $newsandevents = NewsandEvents::all();
        return view('newsevents.index',compact('newsandevents'));
    }



    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,webp|max:2048',
        'sort_id' => 'nullable|string|max:255',
    ]);

    $events = new NewsandEvents;
    $events->title = $validatedData['title'];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $events->image = $imageName;
    }

    if (isset($validatedData['sort_id'])) {
        $events->sort_id = $validatedData['sort_id'];
    }

    $events->save();

    return redirect()->back()->with('success', 'Menu created successfully.');
}





}
