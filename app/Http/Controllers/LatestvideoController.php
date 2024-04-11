<?php

namespace App\Http\Controllers;

use App\Models\Latestvideo;
use Illuminate\Http\Request;

class LatestvideoController extends Controller
{
    public function index()
    {
        $videos = Latestvideo::all();
        return view('latestvideos.index',compact('videos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $latestVideo = new Latestvideo;
        $latestVideo->title = $validatedData['title'];
        $latestVideo->link = $validatedData['link'];
        if (isset($validatedData['sort_id'])) {
            $latestVideo->sort_id = $validatedData['sort_id'];
        }
        $latestVideo->save();
        return redirect()->back();
    }
}
