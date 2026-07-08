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
            'imageFile' => 'required_if:file_type,image|file|mimes:webp|max:5000',
            'videoFile' => 'required_if:file_type,video|file|mimes:mp4,mov,avi,3gp,wmv|max:100000',
            'sort_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile');
        } elseif ($request->hasFile('videoFile')) {
            $file = $request->file('videoFile');
        } else {
            return redirect()->back()->with('error', 'File upload failed.');
        }

        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $banner = new Banner;
        $banner->file = $fileName;
        $banner->sort_id = $request->sort_id;
        $banner->save();
        return redirect()->back()->with('success', 'Banner created successfully.');
    }

     public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:jpeg,webp,mp4,mov,avi,3gp,wmv|max:100000',
            'sort_id' => 'nullable|integer',
        ]);
    
        $banner = Banner::findOrFail($id);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
    
            // Delete old file if exists
            if ($banner->file && file_exists(public_path('images') . '/' . $banner->file)) {
                unlink(public_path('images') . '/' . $banner->file);
            }
    
            $banner->file = $fileName;
        }
    
        $banner->sort_id = $request->sort_id;
        $banner->save();
    
        return redirect()->back();
    }
    
    public function bannerdestroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->file && file_exists(public_path('images') . '/' . $banner->file)) {
            unlink(public_path('images') . '/' . $banner->file);
        }
        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }


    public function checkVideo(Request $request)
    {
        $videoCount = Banner::where('file', 'like', '%.mp4')->count();
        return response()->json(['exists' => $videoCount > 0]);
    }

    public function CheckBannerImageCount(Request $request)
    {
        $bannercount = Bgbanner::whereNotNull('image')->count();
        return response()->json(['exists' => $bannercount > 0]);
    }

    public function banner()
    {
        $bgbanners = Bgbanner::all();
        return view('banner.bgbanner', compact('bgbanners'));
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

    public function bannerupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:webp|max:5000',
            'sort_id' => 'nullable|integer',
        ]);

        $bgbanner = Bgbanner::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $bgbanner->image = $fileName;
        }

        $bgbanner->sort_id = $request->sort_id;
        $bgbanner->save();
        return redirect()->back()->with('success', 'Banner updated successfully.');
    }

    public function bannerdelete($id)
    {
        $bgbanners = Bgbanner::findOrFail($id);

        // Delete the image file from public/images directory
        if (file_exists(public_path('images/' . $bgbanners->image))) {
            unlink(public_path('images/' . $bgbanners->image));
        }

        $bgbanners->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }

}
