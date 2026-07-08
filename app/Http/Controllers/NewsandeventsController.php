<?php

namespace App\Http\Controllers;
use App\Models\NewsandEvents;
use App\Models\NewsEventsHeadings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsandeventsController extends Controller
{
    public function index()
    {
        $newsandevents = NewsandEvents::all();
        $NewsEvents = NewsEventsHeadings::all();

        return view('newsevents.index',compact('newsandevents','NewsEvents'));
    }

    public function headingstore(Request $request){

        $validatedData = $request->validate([
           
            'heading' => 'required|string',
        ]);
        $NewsEvent = new NewsEventsHeadings;
        $NewsEvent->heading = $validatedData['heading'];
        $NewsEvent->save();
        return redirect()->back()->with('success', 'Event created successfully.');

    }

    public function headingupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
        ]);
    
        // Find the heading by its ID
        $heading = NewsEventsHeadings::findOrFail($id);
        
        // Update the heading field
        $heading->heading = $validatedData['heading'];
        
        // Save the updated heading
        $heading->save();
    
        return redirect()->route('newsevents.index')->with('success', 'Heading updated successfully.');
    }
    

     public function destroyHeading($id)
        {
            $heading = NewsEventsHeadings::findOrFail($id);
            $heading->delete();
            return redirect()->back()->with('success', 'Heading deleted successfully.');
        }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_date' => 'required|date',
            'description' => 'required|string',
            'title' => 'required|string',
            'image' => 'image|mimes:jpeg,webp|max:5000',
            'image1' => 'image|mimes:jpeg,webp|max:5000',
            'content1' => 'nullable|string',
            'image2' => 'image|mimes:jpeg,webp|max:5000',
            'content2' => 'nullable|string',
            'image3' => 'image|mimes:jpeg,webp|max:5000',
            'content3' => 'nullable|string',
            'image4' => 'image|mimes:jpeg,webp|max:5000',
            'content4' => 'nullable|string',
            'image5' => 'image|mimes:jpeg,webp|max:5000',
            'content5' => 'nullable|string',
            'image6' => 'image|mimes:jpeg,webp|max:5000',
            'content6' => 'nullable|string',
            'image7' => 'image|mimes:jpeg,webp|max:5000',
            'content7' => 'nullable|string',
            'image8' => 'image|mimes:jpeg,webp|max:5000',
            'content8' => 'nullable|string',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $events = new NewsandEvents;

        // Assign validated data to the model
        $events->event_date = $validatedData['event_date'];
        $events->title = $validatedData['title'];
   
        $events->description = $validatedData['description'];
        $events->content1 = $validatedData['content1'];
        $events->content2 = $validatedData['content2'];
        $events->content3 = $validatedData['content3'];
        $events->content4 = $validatedData['content4'];
        $events->content5 = $validatedData['content5'];
        $events->content6 = $validatedData['content6'];
        $events->content7 = $validatedData['content7'];
        $events->content8 = $validatedData['content8'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $events->image = $imageName;
        }

        // Handle second image upload
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $imageName1 = time() . '_1.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images'), $imageName1);
            $events->image1 = $imageName1;
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $imageName2 = time() . '_2.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $imageName2);
            $events->image2 = $imageName2;
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $imageName3 = time() . '_3.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $imageName3);
            $events->image3 = $imageName3;
        }

        if ($request->hasFile('image4')) {
            $image4 = $request->file('image4');
            $imageName4 = time() . '_4.' . $image4->getClientOriginalExtension();
            $image4->move(public_path('images'), $imageName4);
            $events->image4 = $imageName4;
        }
        if ($request->hasFile('image5')) {
            $image5 = $request->file('image5');
            $imageName5 = time() . '_5.' . $image5->getClientOriginalExtension();
            $image5->move(public_path('images'), $imageName5);
            $events->image5 = $imageName5;
        }
        if ($request->hasFile('image6')) {
            $image6 = $request->file('image6');
            $imageName6 = time() . '_6.' . $image6->getClientOriginalExtension();
            $image6->move(public_path('images'), $imageName6);
            $events->image6 = $imageName6;
        }
        if ($request->hasFile('image7')) {
            $image7 = $request->file('image7');
            $imageName7 = time() . '_7.' . $image7->getClientOriginalExtension();
            $image7->move(public_path('images'), $imageName7);
            $events->image7 = $imageName7;
        }
        if ($request->hasFile('image8')) {
            $image8 = $request->file('image8');
            $imageName8 = time() . '_8.' . $image8->getClientOriginalExtension();
            $image8->move(public_path('images'), $imageName8);
            $events->image8 = $imageName8;
        }

        if ($request->has('sort_id')) {
            $events->sort_id = $validatedData['sort_id'];
        }
        $events->save();

        return redirect()->back()->with('success', 'Event created successfully.');
    }



  




    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_date' => 'nullable|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:webp|max:5000',
            'image1' => 'nullable|image|mimes:webp|max:5000',
            'content1' => 'nullable|string',
            'image2' => 'nullable|image|mimes:,webp|max:5000',
            'content2' => 'nullable|string',
            'image3' => 'nullable|image|mimes:webp|max:5000',
            'content3' => 'nullable|string',
            'image4' => 'nullable|image|mimes:webp|max:5000',
            'content4' => 'nullable|string',
            'image5' => 'nullable|image|mimes:webp|max:5000',
            'content5' => 'nullable|string',
            'image6' => 'nullable|image|mimes:webp|max:5000',
            'content6' => 'nullable|string',
            'image7' => 'nullable|image|mimes:webp|max:5000',
            'content7' => 'nullable|string',
            'image8' => 'nullable|image|mimes:webp|max:5000',
            'content8' => 'nullable|string',
            'sort_id' => 'nullable|string|max:255',
        ]);
    
        $event = NewsandEvents::findOrFail($id);
    
        $event->event_date = $validatedData['event_date'];
        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->content1 = $validatedData['content1'];
        $event->content2 = $validatedData['content2'];
        $event->content3 = $validatedData['content3'];
        $event->content4 = $validatedData['content4'];
        $event->content5 = $validatedData['content5'];
        $event->content6 = $validatedData['content6'];
        $event->content7 = $validatedData['content7'];
        $event->content8 = $validatedData['content8'];
        $event->sort_id = $request->input('sort_id', $event->sort_id);
    
        // Update main image
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path('images/' . $event->image))) {
                unlink(public_path('images/' . $event->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }
    
        // Update images 1 to 8
        for ($i = 1; $i <= 8; $i++) {
            $imageKey = 'image' . $i;
            if ($request->hasFile($imageKey)) {
                $existingImage = 'image' . $i;
                if ($event->$existingImage && file_exists(public_path('images/' . $event->$existingImage))) {
                    unlink(public_path('images/' . $event->$existingImage));
                }
                $image = $request->file($imageKey);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $event->$existingImage = $imageName;
            }
        }
    
        $event->save();
    
        return redirect()->back()->with('success', 'Event updated successfully.');
    }

   public function destroy($id)
{
    $event = NewsandEvents::findOrFail($id);
    $event->delete();
    return redirect()->back()->with('success', 'Event Deleted successfully.');
}


}
