<?php

namespace App\Http\Controllers;

use App\Models\Latestvideo;
use App\Models\LatestVideosHeading;
use App\Models\Facilties;
use App\Models\FaciltiesHeading;
use App\Models\HomepageTestimoniols;
use App\Models\History;

use Illuminate\Http\Request;

class LatestvideoController extends Controller
{

    public function index()
    {
        $videos = Latestvideo::all();
        $NewsEvents = LatestVideosHeading::all();

        view()->share('videos', $videos);
        return view('latestvideos.index', compact('videos', 'NewsEvents'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_id' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image2' => 'nullable|image|mimes:webp,|max:5000',
        ]);

        $latestVideo = new Latestvideo;
        $latestVideo->title = $validatedData['title'];
        $latestVideo->description = $validatedData['description'];
        $latestVideo->link = $validatedData['link'];
        if (isset($validatedData['sort_id'])) {
            $latestVideo->sort_id = $validatedData['sort_id'];
        }


        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Name = 'image2_' . time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $image2Name);
            $latestVideo->image2 = '' . $image2Name;
        }

        $latestVideo->save();
        return redirect()->back()->with('success', 'Latestvideo Created Successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_id' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image2' => 'nullable|image|mimes:webp,|max:5000',
        ]);

        $video = Latestvideo::findOrFail($id);
        $video->update([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'description' => $request->input('description'),
            'sort_id' => $request->input('sort_id'),
            'link2' => $request->input('link2'),
        ]);

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Name = 'image2_' . time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $image2Name);
            $video->image2 = $image2Name;
        }
        $video->save();
        return redirect()->route("latestvideos.index")->with('success', 'Latestvideo Updated Successfully.');
    }

    public function destroy($id)
    {
        $latestVideo = Latestvideo::findOrFail($id);
        $latestVideo->delete();
        return redirect()->back()->with('success', 'Latestvideo Delete Successfully.');
    }

    public function headingstore(Request $request)
    {

        $validatedData = $request->validate([

            'heading' => 'required|string',
        ]);
        $NewsEvent = new LatestVideosHeading;
        $NewsEvent->heading = $validatedData['heading'];
        $NewsEvent->save();
        return redirect()->back()->with('success', 'Latestvideo Heading Created Successfully.');

    }

    public function headingupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
        ]);
        $heading = LatestVideosHeading::findOrFail($id);

        $heading->heading = $validatedData['heading'];

        $heading->save();

        return redirect()->back()->with('success', 'Latestvideo Heading Updated Successfully.');
    }

    public function destroyHeading($id)
    {
        $heading = LatestVideosHeading::findOrFail($id);
        $heading->delete();
        return redirect()->back()->with('success', 'Latestvideo Heading Deleted Successfully.');
    }

    public function Faciltiesheadingstore(Request $request)
    {
        $validated = $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'aboutus_description' => 'required|string|max:30000',
            'aboutus_image_1' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'aboutus_image_2' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'mission_description' => 'required|string|max:30000',
            'vission_description' => 'required|string|max:30000',
            'history_description' => 'nullable|string|max:3000000',
        ]);

        $data = $this->uploadFiles($request);
        FaciltiesHeading::create($data);

        return redirect()->back()->with('success', 'About Us section added successfully.');
    }

    public function Faciltiesheadingupdate(Request $request, $id)
    {
        $heading = FaciltiesHeading::findOrFail($id);

        $validated = $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'aboutus_description' => 'required|string|max:30000',
            'aboutus_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'aboutus_image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'mission_description' => 'required|string|max:30000',
            'vission_description' => 'required|string|max:30000',
            'history_description' => 'nullable|string|max:3000000',
        ]);

        $data = [
            'aboutus_description' => $request->aboutus_description,
            'mission_description' => $request->mission_description,
            'vission_description' => $request->vission_description,
            'history_description' => $request->history_description,
        ];

        foreach (['banner_image', 'aboutus_image_1', 'aboutus_image_2'] as $field) {
            if ($request->hasFile($field)) {

                if ($heading->$field && file_exists(public_path('images/' . $heading->$field))) {
                    unlink(public_path('images/' . $heading->$field));
                }

                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $data[$field] = $filename;
            }
        }

        $heading->update($data);

        return redirect()->back()->with('success', 'About Us section updated successfully.');
    }


    public function FaciltiesdestroyHeading($id)
    {
        $heading = FaciltiesHeading::findOrFail($id);
        $heading->delete();
        return redirect()->back()->with('success', 'Facilites Heading Deleted Successfully.');
    }

    public function Faciltiesindex()
    {
        $Facilties = Facilties::all();
        $heading = FaciltiesHeading::all();
        view()->share('FaciltiesHeading', $heading);
        view()->share('Facilties', $Facilties);

        return view('Backend.Home.facilties', compact('Facilties', 'heading'));
    }


    public function Faciltiesstore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_id' => 'nullable|string|max:255',
            'image2' => 'nullable|image|mimes:webp,jpg,jpeg|max:5000',
        ]);

        $latestVideo = new Facilties;
        $latestVideo->title = $validatedData['title'];
        $latestVideo->description = $validatedData['description'];
        if (isset($validatedData['sort_id'])) {
            $latestVideo->sort_id = $validatedData['sort_id'];
        }


        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Name = 'image2_' . time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $image2Name);
            $latestVideo->image2 = '' . $image2Name;
        }

        $latestVideo->save();
        return redirect()->back()->with('success', 'Facilties Created Successfully.');
    }


    public function Faciltiesupdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_id' => 'nullable|integer',
            'image2' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $video = Facilties::findOrFail($id);
        $video->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'sort_id' => $request->input('sort_id'),
        ]);

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Name = 'image2_' . time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $image2Name);
            $video->image2 = $image2Name;
        }
        $video->save();
        return redirect()->route("facilties.index")->with('success', 'Facilties Updated Successfully.');
    }


    public function Faciltiesdestroy($id)
    {
        $latestVideo = Facilties::findOrFail($id);
        $latestVideo->delete();
        return redirect()->back()->with('success', 'Facilties Delete Successfully.');
    }

    public function Historyindex()
    {
        $Histories = History::orderBy('sort_id')->get();
        return view('Backend.aboutus.view_awards', compact('Histories'));
    }

    public function Historystore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'view_awards_description' => 'nullable|string',
            'sort_id' => 'nullable|integer',
            'award_image' => 'required|image|mimes:webp,jpg,jpeg,png|max:5000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:webp,jpg,jpeg,png|max:5000',

        ]);

        $history = new History;
        $history->title = $validatedData['title'];
        $history->view_awards_description = $validatedData['view_awards_description'];
        if (isset($validatedData['sort_id'])) {
            $history->sort_id = $validatedData['sort_id'];
        }

        if ($request->hasFile('award_image')) {
            $award_image = $request->file('award_image');
            $imageName = 'award_' . time() . '.' . $award_image->getClientOriginalExtension();
            $award_image->move(public_path('images'), $imageName);
            $history->award_image = $imageName;
        }

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = 'history_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $imagePaths[] = $name;
            }
        }

        $history->images = $imagePaths;
        $history->save();
        return redirect()->back()->with('success', 'Award Created Successfully.');
    }

    public function Historyupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'view_awards_description' => 'nullable|string',
            'sort_id' => 'nullable|integer',
            'award_image' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:5000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:webp,jpg,jpeg,png|max:5000',
        ]);

        $history = History::findOrFail($id);
        $history->title = $validatedData['title'];
        $history->view_awards_description = $validatedData['view_awards_description'];
        $history->sort_id = $validatedData['sort_id'] ?? $history->sort_id;

        if ($request->hasFile('award_image')) {
            // Optional: Delete old image if exists
            if ($history->award_image && file_exists(public_path('images/' . $history->award_image))) {
                unlink(public_path('images/' . $history->award_image));
            }

            $award_image = $request->file('award_image');
            $imageName = 'award_' . time() . '.' . $award_image->getClientOriginalExtension();
            $award_image->move(public_path('images'), $imageName);
            $history->award_image = $imageName;
        }

        // Handle existing images from form (those that weren't removed)
        $keptImages = $request->input('existing_images', []);

        // Ensure it's an array
        if (!is_array($keptImages)) {
            $keptImages = [];
        }

        // Handle new uploaded images
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = 'history_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $newImages[] = $name;
            }
        }

        // Merge kept images with new images
        $allImages = array_merge($keptImages, $newImages);
        $history->images = $allImages;

        $history->save();
        return redirect()->back()->with('success', 'Award Updated Successfully.');
    }

    public function Historydestroy($id)
    {
        $history = History::findOrFail($id);
        if ($history->award_image && file_exists(public_path('images/' . $history->award_image))) {
            unlink(public_path('images/' . $history->award_image));
        }
        if ($history->images) {
            foreach ($history->images as $image) {
                if (file_exists(public_path('images/' . $image))) {
                    unlink(public_path('images/' . $image));
                }
            }
        }
        $history->delete();
        return redirect()->back()->with('success', 'Award Deleted Successfully.');
    }

    public function testimonialindex()
    {
        $HomepageTestimoniols = HomepageTestimoniols::all();

        view()->share('HomepageTestimoniols', $HomepageTestimoniols);
        return view('Backend.Home.testimoniols', compact('HomepageTestimoniols'));
    }


    public function testimonialstore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'relationship' => 'nullable|string',
            'feedback' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:webp,|max:5000',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $HomepageTestimoniols = new HomepageTestimoniols;
        $HomepageTestimoniols->name = $validatedData['name'];
        $HomepageTestimoniols->relationship = $validatedData['relationship'];
        $HomepageTestimoniols->feedback = $validatedData['feedback'];
        if (isset($validatedData['sort_id'])) {
            $HomepageTestimoniols->sort_id = $validatedData['sort_id'];
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $HomepageTestimoniols->image = '' . $imageName;
        }

        $HomepageTestimoniols->save();
        return redirect()->back()->with('success', 'Testimoniols Created Successfully.');
    }


    public function testimonialupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:webp,|max:5000',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $video = HomepageTestimoniols::findOrFail($id);
        $video->update([
            'name' => $request->input('name'),
            'relationship' => $request->input('relationship'),
            'feedback' => $request->input('feedback'),
            'sort_id' => $request->input('sort_id'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image2Name = 'image' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image2Name);
            $video->image = $image2Name;
        }
        $video->save();
        return redirect()->back()->with('success', 'Testimoniols Updated Successfully.');
    }

    public function testimonialdestroy($id)
    {
        $latestVideo = HomepageTestimoniols::findOrFail($id);
        $latestVideo->delete();
        return redirect()->back()->with('success', 'Latestvideo Delete Successfully.');
    }

}

