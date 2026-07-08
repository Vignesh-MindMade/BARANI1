<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pressed_Component;
use Illuminate\Support\Facades\Storage;

class PressedComponentController extends Controller
{
    public function Index()
    {
        $pressedComponent = Pressed_Component::first();

        if (!$pressedComponent) {
            $pressedComponent = Pressed_Component::create([
                'capabilities_cards' => [
                    [
                        'title' => 'Fabrication Parts',
                        'description' => 'High-accuracy cutting, stamping, forming, and finishing for complex geometries with tight tolerances'
                    ]
                ],
                'industries_icons' => [],
                'industries_name' => [], //new
                'infrastructure_equipments' => [],
                'technology_range_cards' => [],
                'point_section_title' => null, //new
                'point_title' => null,
                'points' => [],
            ]);
        }

        return view(
            'Backend.pressed_component.template2.index',
            compact('pressedComponent')
        );
    }


    public function Update(Request $request, $id)
    
    
    
    {
        
                dd($validated);
        $pressedComponent = Pressed_Component::findOrFail($id);

        


        // Validate request
        $validated = $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'capabilities_title' => 'nullable|string|max:255',
            'capabilities_subtitle' => 'nullable|string|max:255',
            'capabilities_cards' => 'nullable|array',
            'industries_title' => 'nullable|string|max:255',
            'industries_subtitle' => 'nullable|string|max:255',
            'industries_icons.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'industries_name' => 'nullable|array', // NEW FIELD ADDED
            'manufacturing_capability_title' => 'nullable|string|max:255',
            'manufacturing_capability_subtitle' => 'nullable|string|max:255',
            'manufacturing_capability_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'manufacturing_capability_description' => 'nullable|string',
            'infrastructure_equipments' => 'nullable|array',
            'core_processes_title' => 'nullable|string|max:255',
            'core_processes_subtitle' => 'nullable|string|max:255',
            'core_processes_table' => 'nullable|string',
            'quality_inspection_title' => 'nullable|string|max:255',
            'quality_inspection_subtitle' => 'nullable|string|max:255',
            'quality_inspection_table' => 'nullable|string',
            'technology_range_title' => 'nullable|string|max:255',
            'technology_range_subtitle' => 'nullable|string|max:255',
            'technology_range_cards' => 'nullable|array',
            'technology_range_cards_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5000000',
            'point_section_title' => 'nullable|string|max:255', // NEW FIELD ADDED
            'point_title' => 'nullable|array', // NEW FIELD ADDED
            'points' => 'nullable|array',// NEW FIELD ADDED
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($pressedComponent->banner_image && file_exists(public_path('images/' . $pressedComponent->banner_image))) {
                unlink(public_path('images/' . $pressedComponent->banner_image));
            }
            
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('images'), $bannerImageName);
            $validated['banner_image'] = $bannerImageName;
        }

        // Handle manufacturing capability image upload
        if ($request->hasFile('manufacturing_capability_image')) {
            // Delete old image
            if ($pressedComponent->manufacturing_capability_image && file_exists(public_path('images/' . $pressedComponent->manufacturing_capability_image))) {
                unlink(public_path('images/' . $pressedComponent->manufacturing_capability_image));
            }
            
            $manufacturingImage = $request->file('manufacturing_capability_image');
            $manufacturingImageName = time() . '_manufacturing.' . $manufacturingImage->getClientOriginalExtension();
            $manufacturingImage->move(public_path('images'), $manufacturingImageName);
            $validated['manufacturing_capability_image'] = $manufacturingImageName;
        }

        // Handle industries icons upload
        if ($request->hasFile('industries_icons')) {
            $industriesIcons = [];
            foreach ($request->file('industries_icons') as $icon) {
                $iconName = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('images'), $iconName);
                $industriesIcons[] = $iconName;
            }
            
            // Merge with existing icons if any
            if ($request->has('existing_industries_icons')) {
                $industriesIcons = array_merge($request->existing_industries_icons, $industriesIcons);
            }
            
            $validated['industries_icons'] = $industriesIcons;
        } else {
            // Keep existing icons
            if ($request->has('existing_industries_icons')) {
                $validated['industries_icons'] = $request->existing_industries_icons;
            }
        }

        // Handle industries names - convert array to JSON string
        if ($request->has('industries_name') && is_array($request->industries_name)) {
            $validated['industries_name'] = json_encode($request->industries_name);
        }

        // Handle technology range cards images (FIXED)
        if ($request->has('technology_range_cards')) {

            $technologyCards = $request->technology_range_cards;
            $uploadedImages = $request->file('pc_technology_range_cards_images', []);

            foreach ($technologyCards as $index => $card) {

                // If new image uploaded for this index
                if (isset($uploadedImages[$index])) {

                    // Delete old image if exists
                    if (!empty($card['existing_image']) &&
                        file_exists(public_path('images/' . $card['existing_image']))) {
                        unlink(public_path('images/' . $card['existing_image']));
                    }

                    $image = $uploadedImages[$index];
                    $imageName = time() . '_tech_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);

                    $technologyCards[$index]['image'] = $imageName;

                } else {
                    // Keep old image if no new upload
                    $technologyCards[$index]['image'] = $card['existing_image'] ?? null;
                }
            }

            $validated['technology_range_cards'] = array_values($technologyCards);
        }

        // Handle points section - combine point_title and points into JSON string
        if ($request->has('point_title') && is_array($request->point_title)) {
            $pointsArray = [];
            foreach ($request->point_title as $index => $title) {
                $pointsArray[] = [
                    'title' => $title,
                    'description' => $request->points[$index] ?? ''
                ];
            }
            // store as JSON string (keep previous behavior)
            $validated['point_title'] = json_encode($pointsArray);
            // Do not keep raw points array in validated
            if (isset($validated['points'])) {
                unset($validated['points']);
            }
        } else {
            // If no point_title in request, clear the stored points (user removed all)
            $validated['point_title'] = json_encode([]);
            if (isset($validated['points'])) {
                unset($validated['points']);
            }
        }

        // Update the record
        $pressedComponent->update($validated);

        return redirect()->route('pressed_components_backend.index')
            ->with('success', 'Pressed Components content updated successfully!');
    }

    /**
     * Load pressed component form sections via AJAX for template2
     */
    public function loadTemplate2Form(Request $request)
    {
        $pageId = $request->query('page_id', 0);
        
        // Get pressed component for this page if editing
        $pressedComponent = null;
        if ($pageId > 0) {
            $page = \App\Models\BaraniGroupSubmenuPage::find($pageId);
            // Use property access, not method call - this is safe with relationships
            if ($page) {
                $pressedComponent = $page->pressedComponent;
            }
        }
        
        // Create default if not found
        if (!$pressedComponent) {
            $pressedComponent = new Pressed_Component([
                'capabilities_cards' => [['title' => '', 'description' => '']],
                'industries_icons' => [],
                'industries_name' => [],
                'infrastructure_equipments' => [['title' => '', 'total_area' => '', 'production_floor' => '']],
                'technology_range_cards' => [['title' => '', 'description' => '', 'image' => '']],
                'point_section_title' => '',
                'point_title' => '[]',
                'points' => '[]',
            ]);
        } else {
            // CRITICAL: Decode JSON strings and ensure all fields are properly formatted
            
            // Decode and normalize point_title
            if (is_string($pressedComponent->point_title)) {
                $decoded = json_decode($pressedComponent->point_title, true);
                $pressedComponent->point_title = is_array($decoded) ? $decoded : [];
            } elseif (is_null($pressedComponent->point_title)) {
                $pressedComponent->point_title = [];
            }
            
            // Decode and normalize points
            if (is_string($pressedComponent->points)) {
                $decoded = json_decode($pressedComponent->points, true);
                $pressedComponent->points = is_array($decoded) ? $decoded : [];
            } elseif (is_null($pressedComponent->points)) {
                $pressedComponent->points = [];
            }
            
            // Decode and normalize industries_name
            if (is_string($pressedComponent->industries_name)) {
                $decoded = json_decode($pressedComponent->industries_name, true);
                $pressedComponent->industries_name = is_array($decoded) ? $decoded : [];
            } elseif (is_null($pressedComponent->industries_name)) {
                $pressedComponent->industries_name = [];
            }
            
            // Ensure all array fields are arrays (handle null cases)
            if (!is_array($pressedComponent->capabilities_cards)) {
                $pressedComponent->capabilities_cards = [['title' => '', 'description' => '']];
            }
            if (!is_array($pressedComponent->industries_icons)) {
                $pressedComponent->industries_icons = [];
            }
            if (!is_array($pressedComponent->infrastructure_equipments)) {
                $pressedComponent->infrastructure_equipments = [['title' => '', 'total_area' => '', 'production_floor' => '']];
            }
            if (!is_array($pressedComponent->technology_range_cards)) {
                $pressedComponent->technology_range_cards = [['title' => '', 'description' => '', 'image' => '']];
            }
        }

        return view('Backend.pressed_component.template2.form-sections', compact('pressedComponent'));
    }

}
