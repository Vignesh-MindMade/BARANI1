<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\AboutusCard;
use App\Models\Management;
use App\Models\Curriculam;
use App\Models\FacilitiesatourCampus;
use App\Models\Contactus;
use App\Models\FacultyDepartment;
use App\Models\Faculty;
use App\Models\ViewCertficate;
use App\Models\ViewCertficateTitle;
use App\Models\TeamTEST;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function Home() {
        return view('frontend.home.index');
    }
    
   public function AboutUsIndex()
    {
         $teamtests = TeamTEST::first() ?? TeamTEST::create();
        return view('frontend.aboutus.aboutus', compact('teamtests'));
    }

    public function BackendIndex()
    {
        $aboutUsItems = AboutUs::all();
        $cards = AboutusCard::all();
        return view('Backend.aboutus.index', compact('aboutUsItems', 'cards'));
    }

    public function WhyChinmayaStore(Request $request)
    {
        $validatedData = $request->validate([
            'banner' => 'required|image|mimes:webp|max:5120',
            'chinmaya_history_paragraph' => 'required|string',
            'chinmaya_history_paragraph1' => 'required|string',
            'chinmaya_vision_paragraph' => 'required|string',
            'chinmaya_vision_image' => 'required|image|mimes:webp|max:5120',
            'chinmaya_ourvalues_paragraph' => 'required|string',
            'chinmaya_ourvalues_image' => 'required|image|mimes:webp|max:5120',
            'chinmaya_stakeholders_image' => 'required|image|mimes:webp|max:5120',
            'chinmaya_stakeholders_paragraph' => 'required|string',
        ]);

        try {
            // Define destination path
            $destination = public_path('images');

            // Handle each image upload and assign filename
            $banner = $request->file('banner');
            $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move($destination, $bannerName);

            $visionImage = $request->file('chinmaya_vision_image');
            $visionImageName = time() . '_vision.' . $visionImage->getClientOriginalExtension();
            $visionImage->move($destination, $visionImageName);

            $ourValuesImage = $request->file('chinmaya_ourvalues_image');
            $ourValuesImageName = time() . '_values.' . $ourValuesImage->getClientOriginalExtension();
            $ourValuesImage->move($destination, $ourValuesImageName);

            $stakeholdersImage = $request->file('chinmaya_stakeholders_image');
            $stakeholdersImageName = time() . '_stakeholders.' . $stakeholdersImage->getClientOriginalExtension();
            $stakeholdersImage->move($destination, $stakeholdersImageName);

            // Save to DB
            Aboutus::create([
                'banner' => $bannerName,
                'chinmaya_history_paragraph' => $validatedData['chinmaya_history_paragraph'],
                'chinmaya_history_paragraph1' => $validatedData['chinmaya_history_paragraph1'],
                'chinmaya_vision_paragraph' => $validatedData['chinmaya_vision_paragraph'],
                'chinmaya_vision_image' => $visionImageName,
                'chinmaya_ourvalues_paragraph' => $validatedData['chinmaya_ourvalues_paragraph'],
                'chinmaya_ourvalues_image' => $ourValuesImageName,
                'chinmaya_stakeholders_image' => $stakeholdersImageName,
                'chinmaya_stakeholders_paragraph' => $validatedData['chinmaya_stakeholders_paragraph'],
            ]);

            return redirect()->back()->with('success', 'Why Chinmaya content created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function WhyChinmayaUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner' => 'nullable|image|mimes:webp|max:5120',
            'chinmaya_history_paragraph' => 'required|string',
            'chinmaya_history_paragraph1' => 'required|string',
            'chinmaya_vision_paragraph' => 'required|string',
            'chinmaya_vision_image' => 'nullable|image|mimes:webp|max:5120',
            'chinmaya_ourvalues_paragraph' => 'required|string',
            'chinmaya_ourvalues_image' => 'nullable|image|mimes:webp|max:5120',
            'chinmaya_stakeholders_image' => 'nullable|image|mimes:webp|max:5120',
            'chinmaya_stakeholders_paragraph' => 'required|string',
        ]);

        try {
            $aboutus = Aboutus::findOrFail($id);
            $destination = public_path('images');

            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
                $banner->move($destination, $bannerName);
                $aboutus->banner = $bannerName;
            }

            if ($request->hasFile('chinmaya_vision_image')) {
                $visionImage = $request->file('chinmaya_vision_image');
                $visionImageName = time() . '_vision.' . $visionImage->getClientOriginalExtension();
                $visionImage->move($destination, $visionImageName);
                $aboutus->chinmaya_vision_image = $visionImageName;
            }

            if ($request->hasFile('chinmaya_ourvalues_image')) {
                $ourValuesImage = $request->file('chinmaya_ourvalues_image');
                $ourValuesImageName = time() . '_values.' . $ourValuesImage->getClientOriginalExtension();
                $ourValuesImage->move($destination, $ourValuesImageName);
                $aboutus->chinmaya_ourvalues_image = $ourValuesImageName;
            }

            if ($request->hasFile('chinmaya_stakeholders_image')) {
                $stakeholdersImage = $request->file('chinmaya_stakeholders_image');
                $stakeholdersImageName = time() . '_stakeholders.' . $stakeholdersImage->getClientOriginalExtension();
                $stakeholdersImage->move($destination, $stakeholdersImageName);
                $aboutus->chinmaya_stakeholders_image = $stakeholdersImageName;
            }

            // Update text fields
            $aboutus->chinmaya_history_paragraph = $validatedData['chinmaya_history_paragraph'];
            $aboutus->chinmaya_history_paragraph1 = $validatedData['chinmaya_history_paragraph1'];
            $aboutus->chinmaya_vision_paragraph = $validatedData['chinmaya_vision_paragraph'];
            $aboutus->chinmaya_ourvalues_paragraph = $validatedData['chinmaya_ourvalues_paragraph'];
            $aboutus->chinmaya_stakeholders_paragraph = $validatedData['chinmaya_stakeholders_paragraph'];

            $aboutus->save();

            return redirect()->back()->with('success', 'Why Chinmaya content updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function CardsStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:webp|max:5120',
            'description' => 'required|string|max:1000',
        ]);

        try {
            $destination = public_path('images');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $Image = $request->file('image');
            $ImageName = time() . '_cards.' . $Image->getClientOriginalExtension();
            $Image->move($destination, $ImageName);

            AboutusCard::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $ImageName,
            ]);

            return redirect()->back()->with('success', 'Card created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function CardsUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp|max:5120',
            'description' => 'required|string|max:1000',
        ]);

        try {
            $aboutusCard = AboutusCard::findOrFail($id);
            $destination = public_path('images');

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($aboutusCard->image && file_exists($destination . '/' . $aboutusCard->image)) {
                    unlink($destination . '/' . $aboutusCard->image);
                }

                $Image = $request->file('image');
                $ImageName = time() . '_cards.' . $Image->getClientOriginalExtension();
                $Image->move($destination, $ImageName);
                $aboutusCard->image = $ImageName;
            }

            $aboutusCard->title = $validatedData['title'];
            $aboutusCard->description = $validatedData['description'];
            $aboutusCard->save();

            return redirect()->back()->with('success', 'Card updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function CardsDelete($id)
    {
        try {
            $aboutusCard = AboutusCard::findOrFail($id);
            $destination = public_path('images');

            // Delete image file if exists
            if ($aboutusCard->image && file_exists($destination . '/' . $aboutusCard->image)) {
                unlink($destination . '/' . $aboutusCard->image);
            }

            $aboutusCard->delete();
            return redirect()->back()->with('success', 'Card deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function ManagementShow()
    {

        return view('frontend.aboutus.mangement');
    }

    public function ManagementIndex()
    {
        $management = Management::all();
        return view('Backend.aboutus.mangement', compact('management'));
    }

    public function ManagementStore(Request $request)
    {
        $validatedData = $request->validate([
            'banner' => 'required|image|mimes:webp|max:5120',
            'gurudev_message' => 'required|string|max:1000',
            'gurudev_image' => 'required|image|mimes:webp|max:5120',
            'principal_message' => 'required|string|max:1000',
            'principal_image' => 'required|image|mimes:webp|max:5120',
            'principal_quote' => 'required|string|max:500',
            'principal_name' => 'required|string|max:100',
        ]);

        try {
            $destination = public_path('images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $bannerName = time() . '_banner.' . $request->banner->getClientOriginalExtension();
            $request->banner->move($destination, $bannerName);

            $gurudevImageName = time() . '_gurudev.' . $request->gurudev_image->getClientOriginalExtension();
            $request->gurudev_image->move($destination, $gurudevImageName);

            $principalImageName = time() . '_principal.' . $request->principal_image->getClientOriginalExtension();
            $request->principal_image->move($destination, $principalImageName);

            Management::create([
                'banner' => $bannerName,
                'gurudev_message' => $validatedData['gurudev_message'],
                'gurudev_image' => $gurudevImageName,
                'principal_message' => $validatedData['principal_message'],
                'principal_image' => $principalImageName,
                'principal_quote' => $validatedData['principal_quote'],
                'principal_name' => $validatedData['principal_name'],
            ]);

            return redirect()->back()->with('success', 'Management content created successfully!');
        } catch (\Exception $e) {
            Log::error('ManagementStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store content: ' . $e->getMessage());
        }
    }

    public function ManagementUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner' => 'nullable|image|mimes:webp|max:5120',
            'gurudev_message' => 'required|string|max:1000',
            'gurudev_image' => 'nullable|image|mimes:webp|max:5120',
            'principal_message' => 'required|string|max:1000',
            'principal_image' => 'nullable|image|mimes:webp|max:5120',
            'principal_quote' => 'required|string|max:500',
            'principal_name' => 'required|string|max:100',
        ]);

        try {
            $management = Management::findOrFail($id);
            $destination = public_path('images');
            $updateData = [];

            // Handle Banner Update
            if ($request->hasFile('banner')) {
                // Delete old banner if exists
                if ($management->banner && file_exists($destination . '/' . $management->banner)) {
                    @unlink($destination . '/' . $management->banner);
                }
                // Upload new banner
                $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
                $request->file('banner')->move($destination, $bannerName);
                $updateData['banner'] = $bannerName;
            }

            // Handle Gurudev Image Update
            if ($request->hasFile('gurudev_image')) {
                // Delete old image if exists
                if ($management->gurudev_image && file_exists($destination . '/' . $management->gurudev_image)) {
                    @unlink($destination . '/' . $management->gurudev_image);
                }
                // Upload new image
                $gurudevImageName = time() . '_gurudev.' . $request->file('gurudev_image')->getClientOriginalExtension();
                $request->file('gurudev_image')->move($destination, $gurudevImageName);
                $updateData['gurudev_image'] = $gurudevImageName;
            }

            // Handle Principal Image Update
            if ($request->hasFile('principal_image')) {
                // Delete old image if exists
                if ($management->principal_image && file_exists($destination . '/' . $management->principal_image)) {
                    @unlink($destination . '/' . $management->principal_image);
                }
                // Upload new image
                $principalImageName = time() . '_principal.' . $request->file('principal_image')->getClientOriginalExtension();
                $request->file('principal_image')->move($destination, $principalImageName);
                $updateData['principal_image'] = $principalImageName;
            }

            // Update text fields
            $updateData = array_merge($updateData, [
                'gurudev_message' => $validatedData['gurudev_message'],
                'principal_message' => $validatedData['principal_message'],
                'principal_quote' => $validatedData['principal_quote'],
                'principal_name' => $validatedData['principal_name'],
            ]);

            $management->update($updateData);

            return redirect()->back()->with('success', 'Management content updated successfully!');
        } catch (\Exception $e) {
            Log::error('ManagementUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update content: ' . $e->getMessage());
        }
    }
    public function CurriculumShow()
    {

        return view('frontend.curriculam.index');
    }

    public function index()
    {
        $curriculams = Curriculam::all();
        return view('Backend.cbse.index', compact('curriculams'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner' => 'required|image|mimes:webp|max:5120',
            'cbse_curriculum_standards' => 'required|string|max:1000',
            'minimum_age_rules_paragraph' => 'required|string|max:1000',
            'minimum_age_rules_points' => 'required|string|max:5000',
        ]);

        try {
            $destination = public_path('images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $bannerName = time() . '_banner.' . $request->banner->getClientOriginalExtension();
            $request->banner->move($destination, $bannerName);

            Curriculam::create([
                'banner' => $bannerName,
                'cbse_curriculum_standards' => $validatedData['cbse_curriculum_standards'],
                'minimum_age_rules_paragraph' => $validatedData['minimum_age_rules_paragraph'],
                'minimum_age_rules_points' => $validatedData['minimum_age_rules_points'],
            ]);

            return redirect()->back()->with('success', 'Curriculum content created successfully!');
        } catch (\Exception $e) {
            Log::error('CurriculamStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store content: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner' => 'nullable|image|mimes:webp|max:5120',
            'cbse_curriculum_standards' => 'required|string|max:1000',
            'minimum_age_rules_paragraph' => 'required|string|max:1000',
            'minimum_age_rules_points' => 'required|string|max:5000',
        ]);

        try {
            $curriculam = Curriculam::findOrFail($id);
            $destination = public_path('images');
            $updateData = [];

            // Handle Banner Update
            if ($request->hasFile('banner')) {
                if ($curriculam->banner && file_exists($destination . '/' . $curriculam->banner)) {
                    @unlink($destination . '/' . $curriculam->banner);
                }
                $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
                $request->file('banner')->move($destination, $bannerName);
                $updateData['banner'] = $bannerName;
            }

            // Update text fields
            $updateData = array_merge($updateData, [
                'cbse_curriculum_standards' => $validatedData['cbse_curriculum_standards'],
                'minimum_age_rules_paragraph' => $validatedData['minimum_age_rules_paragraph'],
                'minimum_age_rules_points' => $validatedData['minimum_age_rules_points'],
            ]);

            $curriculam->update($updateData);

            return redirect()->back()->with('success', 'Curriculum content updated successfully!');
        } catch (\Exception $e) {
            Log::error('CurriculamUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update content: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $curriculam = Curriculam::findOrFail($id);
            $destination = public_path('images');

            if ($curriculam->banner && file_exists($destination . '/' . $curriculam->banner)) {
                @unlink($destination . '/' . $curriculam->banner);
            }

            $curriculam->delete();

            return redirect()->back()->with('success', 'Curriculum content deleted successfully!');
        } catch (\Exception $e) {
            Log::error('CurriculamDelete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }

    # Facilities at our Campus:
    public function Frontendfacilitiesindex()
    {

        return view('frontend.facilties.index');
    }

    public function facilitiesindex()
    {
        $facilities = FacilitiesatourCampus::all();
        return view('Backend.facilities.index', compact('facilities'));
    }

    public function facilitiesstore(Request $request)
    {
        $validated = $request->validate([
            'banner' => 'required|image|mimes:webp|max:5120',
            'facilities_at_our_campus_paragraph' => 'required|string',
            'events1_title' => 'required|string|max:255',
            'events1_text' => 'required|string',
            'events1_image' => 'required|image|mimes:webp|max:5120',
            'events2_title' => 'required|string|max:255',
            'events2_text' => 'required|string',
            'events2_image' => 'required|image|mimes:webp|max:5120',
            'events3_title' => 'required|string|max:255',
            'events3_text' => 'required|string',
            'events3_image' => 'required|image|mimes:webp|max:5120',
            'events4_title' => 'required|string|max:255',
            'events4_text' => 'required|string',
            'events4_image' => 'required|image|mimes:webp|max:5120',
            'events5_title' => 'required|string|max:255',
            'events5_text' => 'required|string',
            'events5_image' => 'required|image|mimes:webp|max:5120',
            'events6_title' => 'required|string|max:255',
            'events6_text' => 'required|string',
            'events6_image' => 'required|image|mimes:webp|max:5120',
        ]);

        $destination = public_path('images');
        $data = $request->only([
            'facilities_at_our_campus_paragraph',
            'events1_title',
            'events1_text',
            'events2_title',
            'events2_text',
            'events3_title',
            'events3_text',
            'events4_title',
            'events4_text',
            'events5_title',
            'events5_text',
            'events6_title',
            'events6_text'
        ]);

        // Handle Banner
        if ($request->hasFile('banner')) {
            $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move($destination, $bannerName);
            $data['banner'] = $bannerName;
        }

        // Handle Event 1 Image
        if ($request->hasFile('events1_image')) {
            $event1ImageName = time() . '_event1.' . $request->file('events1_image')->getClientOriginalExtension();
            $request->file('events1_image')->move($destination, $event1ImageName);
            $data['events1_image'] = $event1ImageName;
        }

        // Handle Event 2 Image
        if ($request->hasFile('events2_image')) {
            $event2ImageName = time() . '_event2.' . $request->file('events2_image')->getClientOriginalExtension();
            $request->file('events2_image')->move($destination, $event2ImageName);
            $data['events2_image'] = $event2ImageName;
        }

        // Handle Event 3 Image
        if ($request->hasFile('events3_image')) {
            $event3ImageName = time() . '_event3.' . $request->file('events3_image')->getClientOriginalExtension();
            $request->file('events3_image')->move($destination, $event3ImageName);
            $data['events3_image'] = $event3ImageName;
        }

        // Handle Event 4 Image
        if ($request->hasFile('events4_image')) {
            $event4ImageName = time() . '_event4.' . $request->file('events4_image')->getClientOriginalExtension();
            $request->file('events4_image')->move($destination, $event4ImageName);
            $data['events4_image'] = $event4ImageName;
        }

        // Handle Event 5 Image
        if ($request->hasFile('events5_image')) {
            $event5ImageName = time() . '_event5.' . $request->file('events5_image')->getClientOriginalExtension();
            $request->file('events5_image')->move($destination, $event5ImageName);
            $data['events5_image'] = $event5ImageName;
        }

        // Handle Event 6 Image
        if ($request->hasFile('events6_image')) {
            $event6ImageName = time() . '_event6.' . $request->file('events6_image')->getClientOriginalExtension();
            $request->file('events6_image')->move($destination, $event6ImageName);
            $data['events6_image'] = $event6ImageName;
        }

        FacilitiesatourCampus::create($data);

        return redirect()->route('facilities.index')->with('success', 'Facility content created successfully.');
    }

    public function facilitiesupdate(Request $request, $id)
    {
        $facility = FacilitiesatourCampus::findOrFail($id);

        $validated = $request->validate([
            'banner' => 'nullable|image|mimes:webp|max:5120',
            'facilities_at_our_campus_paragraph' => 'required|string',
            'events1_title' => 'required|string|max:255',
            'events1_text' => 'required|string',
            'events1_image' => 'nullable|image|mimes:webp|max:5120',
            'events2_title' => 'required|string|max:255',
            'events2_text' => 'required|string',
            'events2_image' => 'nullable|image|mimes:webp|max:5120',
            'events3_title' => 'required|string|max:255',
            'events3_text' => 'required|string',
            'events3_image' => 'nullable|image|mimes:webp|max:5120',
            'events4_title' => 'required|string|max:255',
            'events4_text' => 'required|string',
            'events4_image' => 'nullable|image|mimes:webp|max:5120',
            'events5_title' => 'required|string|max:255',
            'events5_text' => 'required|string',
            'events5_image' => 'nullable|image|mimes:webp|max:5120',
            'events6_title' => 'required|string|max:255',
            'events6_text' => 'required|string',
            'events6_image' => 'nullable|image|mimes:webp|max:5120',
        ]);

        $destination = public_path('images');
        $data = $request->only([
            'facilities_at_our_campus_paragraph',
            'events1_title',
            'events1_text',
            'events2_title',
            'events2_text',
            'events3_title',
            'events3_text',
            'events4_title',
            'events4_text',
            'events5_title',
            'events5_text',
            'events6_title',
            'events6_text'
        ]);

        if ($request->hasFile('banner')) {
            if ($facility->banner && file_exists($destination . '/' . $facility->banner)) {
                @unlink($destination . '/' . $facility->banner);
            }
            $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move($destination, $bannerName);
            $data['banner'] = $bannerName;
        }

        // Handle Event 1 Image Update
        if ($request->hasFile('events1_image')) {
            if ($facility->events1_image && file_exists($destination . '/' . $facility->events1_image)) {
                @unlink($destination . '/' . $facility->events1_image);
            }
            $event1ImageName = time() . '_event1.' . $request->file('events1_image')->getClientOriginalExtension();
            $request->file('events1_image')->move($destination, $event1ImageName);
            $data['events1_image'] = $event1ImageName;
        }

        // Handle Event 2 Image Update
        if ($request->hasFile('events2_image')) {
            if ($facility->events2_image && file_exists($destination . '/' . $facility->events2_image)) {
                @unlink($destination . '/' . $facility->events2_image);
            }
            $event2ImageName = time() . '_event2.' . $request->file('events2_image')->getClientOriginalExtension();
            $request->file('events2_image')->move($destination, $event2ImageName);
            $data['events2_image'] = $event2ImageName;
        }

        // Handle Event 3 Image Update
        if ($request->hasFile('events3_image')) {
            if ($facility->events3_image && file_exists($destination . '/' . $facility->events3_image)) {
                @unlink($destination . '/' . $facility->events3_image);
            }
            $event3ImageName = time() . '_event3.' . $request->file('events3_image')->getClientOriginalExtension();
            $request->file('events3_image')->move($destination, $event3ImageName);
            $data['events3_image'] = $event3ImageName;
        }

        // Handle Event 4 Image Update
        if ($request->hasFile('events4_image')) {
            if ($facility->events4_image && file_exists($destination . '/' . $facility->events4_image)) {
                @unlink($destination . '/' . $facility->events4_image);
            }
            $event4ImageName = time() . '_event4.' . $request->file('events4_image')->getClientOriginalExtension();
            $request->file('events4_image')->move($destination, $event4ImageName);
            $data['events4_image'] = $event4ImageName;
        }

        // Handle Event 5 Image Update
        if ($request->hasFile('events5_image')) {
            if ($facility->events5_image && file_exists($destination . '/' . $facility->events5_image)) {
                @unlink($destination . '/' . $facility->events5_image);
            }
            $event5ImageName = time() . '_event5.' . $request->file('events5_image')->getClientOriginalExtension();
            $request->file('events5_image')->move($destination, $event5ImageName);
            $data['events5_image'] = $event5ImageName;
        }

        // Handle Event 6 Image Update
        if ($request->hasFile('events6_image')) {
            if ($facility->events6_image && file_exists($destination . '/' . $facility->events6_image)) {
                @unlink($destination . '/' . $facility->events6_image);
            }
            $event6ImageName = time() . '_event6.' . $request->file('events6_image')->getClientOriginalExtension();
            $request->file('events6_image')->move($destination, $event6ImageName);
            $data['events6_image'] = $event6ImageName;
        }

        $facility->update($data);

        return redirect()->route('facilities.index')->with('success', 'Facility content updated successfully.');
    }

    public function facilitiesdestroy($id)
    {
        $facility = FacilitiesatourCampus::findOrFail($id);
        $destination = public_path('images');

        $images = [
            $facility->banner,
            $facility->events1_image,
            $facility->events2_image,
            $facility->events3_image,
            $facility->events4_image,
            $facility->events5_image,
            $facility->events6_image,
        ];

        foreach ($images as $image) {
            if ($image && file_exists($destination . '/' . $image)) {
                @unlink($destination . '/' . $image);
            }
        }

        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility content deleted successfully.');
    }

    public function Frontendcontactusindex()
    {
        return view('frontend.contactus.index');
    }

    public function contactusindex()
    {
        $contactus = Contactus::all();
        return view('Backend.contactus.index', compact('contactus'));
    }

    public function contactusstore(Request $request)
    {
        $validated = $request->validate([
            'banner' => 'required|image|mimes:webp|max:5120',
            'pre_kg_timing' => 'required|string|max:1000',
        ]);

        $destination = public_path('images');
        $data = $request->only([
            'pre_kg_timing',
        ]);

        if ($request->hasFile('banner')) {
            $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move($destination, $bannerName);
            $data['banner'] = $bannerName;
        }

        Contactus::create($data);

        return redirect()->route('contactus.index')->with('success', 'Contact Us content created successfully.');
    }

    public function contactusupdate(Request $request, $id)
    {
        $contactus = Contactus::findOrFail($id);

        $validated = $request->validate([
       'banner' => 'nullable|image|mimes:webp|max:5120',
        'pre_kg_timing' => 'required|string|max:1000',
        ]);

        $destination = public_path('images');
        $data = $request->only([
            'pre_kg_timing',
        ]);

        if ($request->hasFile('banner')) {
            if ($contactus->banner && file_exists($destination . '/' . $contactus->banner)) {
                @unlink($destination . '/' . $contactus->banner);
            }
            $bannerName = time() . '_banner.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move($destination, $bannerName);
            $data['banner'] = $bannerName;
        }

        $contactus->update($data);

        return redirect()->route('contactussss.index')->with('success', 'Contact Us content updated successfully.');
    }

    public function contactusdestroy($id)
    {
        $contactus = Contactus::findOrFail($id);
        $destination = public_path('images');

        if ($contactus->banner && file_exists($destination . '/' . $contactus->banner)) {
            @unlink($destination . '/' . $contactus->banner);
        }

        $contactus->delete();

        return redirect()->route('contactus.index')->with('success', 'Contact Us content deleted successfully.');
    }

    public function facultyFrontEndView()
    {

        return view('frontend.faculty.index');
    }




    // About us Controller
 public function VIEWindex()
    {
        $titles = ViewCertficateTitle::orderBy('sort_id', 'desc')->get();
        $certificates = ViewCertficate::with('title')->get();
        return view('Backend.aboutus.view_certficate', compact('titles', 'certificates'));
    }
    public function VIEWindexTITLE()
    {
        $titles = ViewCertficateTitle::orderBy('sort_id', 'desc')->get();
        return view('Backend.aboutus.view_certficate', compact('titles'));
    }

    public function VIEWstoreTITLE(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sort_id' => 'nullable|integer',
        ]);

        ViewCertficateTitle::create([
            'title' => $request->title,
            'sort_id' => $request->sort_id,
        ]);

        return redirect()
            ->route('view_certficate_title.index')
            ->with('success', 'Certificate title added successfully!');
    }

    public function VIEWupdateTITLE(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sort_id' => 'nullable|integer',
        ]);

        $title = ViewCertficateTitle::findOrFail($id);
        $title->update([
            'title' => $request->title,
            'sort_id' => $request->sort_id,
        ]);

        return redirect()
            ->route('view_certficate_title.index')
            ->with('success', 'Certificate title updated successfully!');
    }

    public function VIEWdeleteTITLE($id)
    {
        $title = ViewCertficateTitle::findOrFail($id);
        $title->delete();

        return redirect()
            ->route('view_certficate_title.index')
            ->with('success', 'Certificate title deleted successfully!');
    }



    public function VIEWstore(Request $request)
        {
            $request->validate([
                'view_certficate_title' => 'required|exists:view_certficate_title,id',
                'banner' => 'required|image|mimes:webp|max:5120',
            ]);

            $filename = null;
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
            }

            ViewCertficate::create([
                'view_certficate_title' => $request->view_certficate_title,
                'image' => $filename,
            ]);

            return redirect()->route('view_certficate.index')->with('success', 'Certificate added successfully!');
        }

public function VIEWupdate(Request $request, $id)
{
    $request->validate([
        'view_certficate_title' => 'required|exists:view_certficate_title,id',
        'image' => 'nullable|image|mimes:webp|max:5120',
    ]);

    $certificate = ViewCertficate::findOrFail($id);
    
    // Handle image upload if new image is provided
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($certificate->image && file_exists(public_path('images/' . $certificate->image))) {
            unlink(public_path('images/' . $certificate->image));
        }
        
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        
        $certificate->image = $filename;
    }
    
    $certificate->view_certficate_title = $request->view_certficate_title;
    $certificate->save();

    return redirect()->route('view_certficate.index')->with('success', 'Certificate updated successfully!');
}

// Delete Certificate
public function VIEWdelete($id)
{
    $certificate = ViewCertficate::findOrFail($id);
    
    // Delete image file if exists
    if ($certificate->image && file_exists(public_path('images/' . $certificate->image))) {
        unlink(public_path('images/' . $certificate->image));
    }
    
    $certificate->delete();

    return redirect()->route('view_certficate.index')->with('success', 'Certificate deleted successfully!');
}


}
