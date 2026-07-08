<?php

namespace App\Http\Controllers;

use App\Models\Circular;
use App\Models\ExtraCurricular;
use App\Models\Collaboration;
use App\Models\CurricularMain;
use App\Models\Curricular;
use App\Models\CocurricularFront;
use App\Models\CocurricularDetail;
use App\Models\ExtraCurricularFront;
use App\Models\ExtraCurricularDetail;
use App\Models\CollabrationDetail;
use App\Models\CollabrationFront;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CircularController extends Controller
{

    public function Homeindex()
    {
        $circularsTest = CurricularMain::all();
        $Curricular = Curricular::all();

        view()->share('circularsTest', $circularsTest);
        return view('Backend.Home.index', compact('circularsTest', 'Curricular'));
    }

    public function Homestore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:1000',
            'span_title' => 'nullable|string|max:255',
            'catagory_image' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,webp,mp4,webm',
                function ($attribute, $value, $fail) {
                   $ext = $value->getClientOriginalExtension();

        if (in_array($ext, ['mp4','webm']) && $value->getSize() > 40050 * 1024) {
                    }
                    if (in_array($value->getClientOriginalExtension(), ['jpeg','jpg','png','webp']) && $value->getSize() > 5120 * 1024) {
                        $fail('Image size must not exceed 5MB.');
                    }
                }
            ],
            'sort_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('catagory_image')) {
            $file = $request->file('catagory_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $validatedData['catagory_image'] = $fileName;
        }

        CurricularMain::create($validatedData);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function Homeupdate(Request $request, $id)
    {
        $curricular = CurricularMain::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:1000',
            'span_title' => 'nullable|string|max:255',
            'catagory_image' => [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,webp,mp4,webm',
                function ($attribute, $value, $fail) {
                           $extension = $value->getClientOriginalExtension();
                    if (in_array($extension, ['mp4', 'webm'])) {
                        if ($value->getSize() > 40050 * 1024) { // 40MB for videos
                            $fail('Video size must not exceed 40MB.');
                        }
                    } elseif (in_array($extension, ['jpeg', 'jpg', 'png', 'webp'])) {
                        if ($value->getSize() > 5120 * 1024) { // 5MB for images
                            $fail('Image size must not exceed 5MB.');
                        }
                    }
                }
            ],
            'sort_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('catagory_image')) {
        
            if (!empty($curricular->catagory_image) && file_exists(public_path('images/' . $curricular->catagory_image))) {
                unlink(public_path('images/' . $curricular->catagory_image));
            }

            $file = $request->file('catagory_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $validatedData['catagory_image'] = $fileName;
        }

        $validatedData['title'] = $request->filled('title') ? $request->title : $curricular->title;
        $validatedData['span_title'] = $request->filled('span_title') ? $request->span_title : $curricular->span_title;
        $validatedData['sort_id'] = $request->filled('sort_id') ? $request->sort_id : $curricular->sort_id;

        $curricular->update($validatedData);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function Homedestroy($id)
    {
        $circular = CurricularMain::findOrFail($id);

        if ($circular->catagory_image && file_exists(public_path('images/' . $circular->catagory_image))) {
            unlink(public_path('images/' . $circular->catagory_image));
        }

        $circular->delete();

        return redirect()->back()->with('success', 'Circular deleted successfully!');
    }


    public function Detatilstore(Request $request)
    {
        $validatedData = $request->validate([
            'circular_id' => 'required|exists:circulars_main,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20048',
            'description' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);


            $validatedData['image'] =  $fileName;
        }

        Curricular::create([
            'curricular_id' => $validatedData['circular_id'],
            'image' => $validatedData['image'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }


    public function Detatilupdate(Request $request, $id)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'circular_id' => 'required|exists:circulars_main,id', // Ensure circular_id exists
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20048', // Image is optional
            'description' => 'required|string|max:255', // Description is required
        ]);

        $curricular = Curricular::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($curricular->image) {
                $oldImagePath = public_path('images/' . basename($curricular->image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            // Update the image path in the validated data
            $validatedData['image'] = asset('images/' . $fileName);
        } else {
            // Keep the existing image if no new image is uploaded
            $validatedData['image'] = $curricular->image;
        }

        // Update the Curricular record with new data
        $curricular->update([
            'curricular_id' => $validatedData['circular_id'], // Update circular_id
            'image' => $validatedData['image'], // Update image
            'description' => $validatedData['description'], // Update description
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Curricular updated successfully!');
    }

    public function Detatildestroy($id)
    {
        $curricular = Curricular::findOrFail($id);
        $curricular->delete();

        return redirect()->back()->with('success', 'Curricular deleted successfully!');
    }

    public function OurBlogsIndex()
    {
        $CocurricularFront = CocurricularFront::all();
        $CocurricularDetail = CocurricularDetail::all();

        return view('our_blogs.ourblogs', compact('CocurricularFront', 'CocurricularDetail'));
    }

    public function OurBlogsStore(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'title' => 'required|string|max:500',
            'heading' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:webp|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);
            $validatedData['image'] = $fileName;
        }

        CocurricularFront::create($validatedData);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }


 public function OurBlogsUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'title' => 'required|string|max:500',
            'heading' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $cocurricular = CocurricularFront::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($cocurricular->image && file_exists(public_path('images/' . $cocurricular->image))) {
                unlink(public_path('images/' . $cocurricular->image));
            }
            // Store new image
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $cocurricular->update($validatedData);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function OurBlogsDelete($id)
    {
        $record = CocurricularFront::findOrFail($id);

        // Delete associated image if exists
        if ($record->image && file_exists(public_path('images/' . $record->image))) {
            unlink(public_path('images/' . $record->image));
        }

        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function CoCuricularDetailstore(Request $request)
    {

        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $fileName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdfs'), $fileName);

            $validatedData['pdf'] = $fileName;
        }

        CocurricularDetail::create([
            'description' => $validatedData['description'],
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function CoCuricularDetailUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $cocurricularDetail = CocurricularDetail::findOrFail($id);

        $cocurricularDetail->update([
            'description' => $validatedData['description'],
        ]);
        return redirect()->back()->with('success', 'Data updated successfully!');
    }


    public function CoCurricularDetailDelete($id)
    {
        $detail = CocurricularDetail::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }


    public function ExtraCurricularIndex()
    {
        $ExtraCurricularFronts = ExtraCurricularFront::all();
        $ExtraCurricularDetails = ExtraCurricularDetail::all();

        return view('Life At Campus.extracurricular', compact('ExtraCurricularFronts', 'ExtraCurricularDetails'));
    }


    public function ExtraCurricularstore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'catagory_name' => 'required|string|max:255',
            'catagory_image' => 'required|image|mimes:webp|max:5000',
        ]);

        if ($request->hasFile('catagory_image')) {
            $image = $request->file('catagory_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['catagory_image'] =  $fileName;
        }

        ExtraCurricularFront::create($validatedData);
        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function ExtraCurricularupdate(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'catagory_name' => 'required|string|max:255',
            'catagory_image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $extraCurricular = ExtraCurricularFront::findOrFail($id);

        if ($request->hasFile('catagory_image')) {
            // Delete old image if exists
            if ($extraCurricular->catagory_image && file_exists(public_path('images/' . $extraCurricular->catagory_image))) {
                unlink(public_path('images/' . $extraCurricular->catagory_image));
            }

            // Upload new image
            $image = $request->file('catagory_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['catagory_image'] = $fileName;
        }

        $extraCurricular->update($validatedData);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function ExtraCurricularDelete($id)
    {
        $record = ExtraCurricularFront::findOrFail($id);
        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function ExtraCuricularDetailstore(Request $request)
    {

        $validatedData = $request->validate([
            'extra_curricullar_id' => 'required|exists:extra_curricullar_front,id',
            'image' => 'required|image|mimes:webp|max:5000',
            'description' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['image'] = $fileName;
        }

        ExtraCurricularDetail::create([
            'extra_curricullar_id' => $validatedData['extra_curricullar_id'],
            'image' => $validatedData['image'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function ExtraCurricularDetailUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'extra_curricullar_id' => 'required|exists:extra_curricullar_front,id',
            'image' => 'nullable|image|mimes:webp|max:5000',
            'description' => 'required|string|max:255',
        ]);

        $detail = ExtraCurricularDetail::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['image'] =  $fileName;
        } else {
            $validatedData['image'] = $detail->image;
        }

        $detail->update($validatedData);
        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    public function ExtraCurricularDetailDelete($id)
    {
        $detail = ExtraCurricularDetail::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function CollabrationIndex()
    {
        $CollabrationFronts = CollabrationFront::all();
        $CollabrationDetails = CollabrationDetail::all();
        return view('Life At Campus.Collaboration', compact('CollabrationFronts', 'CollabrationDetails'));
    }

    public function Collabrationstore(Request $request)
    {


        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'catagory_name' => 'required|string|max:255',
            'catagory_image' => 'required|image|mimes:webp|max:5000',
        ]);

        if ($request->hasFile('catagory_image')) {
            $image = $request->file('catagory_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['catagory_image'] = $fileName;
        }

        CollabrationFront::create($validatedData);
        return redirect()->back()->with('success', 'Data saved successfully!');
    }


    public function CollabrationUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'catagory_name' => 'required|string|max:255',
            'catagory_image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $collaboration = CollabrationFront::findOrFail($id);

        if ($request->hasFile('catagory_image')) {
            // Delete old image if it exists
            if ($collaboration->catagory_image && file_exists(public_path('images/' . $collaboration->catagory_image))) {
                unlink(public_path('images/' . $collaboration->catagory_image));
            }

            $image = $request->file('catagory_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['catagory_image'] = $fileName;
        }

        $collaboration->update($validatedData);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }



    // In your CircularController.php

    public function CollabrationDelete($id)
    {
        $record = CollabrationFront::findOrFail($id);
        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }


    public function CollabrationDetailDelete($id)
    {
        $detail = CollabrationDetail::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }


    public function CollabrationDetailStore(Request $request)
    {
        $validatedData = $request->validate([
            'collaboration_id' => 'required|exists:collaboration_front,id',
            'image' => 'nullable|image|mimes:webp|max:5000',
            'description' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['image'] = $fileName;
        }

        CollabrationDetail::create($validatedData);

        return redirect()->back()->with('success', 'Record added successfully!');
    }



    public function CollabrationDetailUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'collaboration_id' => 'required|exists:collaboration_front,id',
            'image' => 'nullable|image|mimes:webp|max:5000',
            'description' => 'required|string|max:255',
        ]);

        $detail = CollabrationDetail::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);

            $validatedData['image'] = $fileName;
        } else {
            $validatedData['image'] = $detail->image;
        }

        $detail->update($validatedData);
        return redirect()->back()->with('success', 'Record updated successfully!');
    }
}
