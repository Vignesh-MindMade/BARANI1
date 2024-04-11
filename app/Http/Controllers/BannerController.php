<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Bgbanner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index', compact('banners'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:webp,mp4|max:2048',
            'sort_id' => 'nullable|integer',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $banner = new Banner;
            $banner->file = $fileName;
            $banner->sort_id = $request->sort_id;
            $banner->save();
            return redirect()->back()->with('success', 'Banner created successfully.');
        }
        return redirect()->back()->with('error', 'File upload failed.');
    }



    public function banner()
    {
        $bgbanners = Bgbanner::all();
        return view('banner.bgbanner',compact('bgbanners'));
    }


    public function save(Request $request)
{
    $validatedData = $request->validate([
        'image' => 'required|image|mimes:webp|max:2048',
        'sort_id' => 'nullable|integer',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $bgbanner = new Bgbanner;
        $bgbanner->image = $fileName;
        $bgbanner->sort_id = $request->sort_id;
        $bgbanner->save();
        return redirect()->back()->with('success', 'Banner created successfully.');
    }
    return redirect()->back()->with('error', 'File upload failed.');
}
















}
