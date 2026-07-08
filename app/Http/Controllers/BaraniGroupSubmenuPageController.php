<?php

namespace App\Http\Controllers;

use App\Models\BaraniGroupSubmenu;
use App\Models\BaraniGroupSubmenuPage;
use App\Models\BaraniGroupSubmenuPageSection;
use App\Models\BaraniGroupSubmenuPageManufacturingFacility;
use App\Models\BaraniGroupSubmenuPagePressStandards;
use App\Models\BaraniGroupSubmenuPageDesignStrength;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaraniGroupSubmenuPageController extends Controller
{
    public function view($pageId)
{
    $page = BaraniGroupSubmenuPage::with([
        'sections.items',
        'manufacturingFacility',
        'pressStandards',
        'designStrength'   // <-- Required
    ])->findOrFail($pageId);

    $designStrength = $page->designStrength; // <-- give to blade

    // Decide which frontend template to render based on per-page selection.
    $template = $page->template ?? 'index';
    $viewName = 'frontend.groupsubmenu.' . $template;

    if (!view()->exists($viewName)) {
        $viewName = 'frontend.groupsubmenu.index';
    }

    return view($viewName, compact('page', 'designStrength'));
}

    public function downloadBrochure($filename)
    {
        $path = public_path('frontend/imgs/submenu/' . $filename);
        
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }
        
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    // -------------------------------------------------------
    // LIST PAGES
    // -------------------------------------------------------
    public function index($submenuId, Request $request)
    {
        $selectedSubmenu = BaraniGroupSubmenu::findOrFail($submenuId);
        $pages = BaraniGroupSubmenuPage::where('submenu_id', $submenuId)->get();
        $allSubmenus = BaraniGroupSubmenu::orderBy('sort_id')->get();

        $editPage = $request->edit
            ? BaraniGroupSubmenuPage::with([
                'sections.items',
                'manufacturingFacility',
                'pressStandards',
                'designStrength',
                'pressedComponent'
            ])->findOrFail($request->edit)
            : null;

        return view('Backend.submenu.pages.index', compact(
            'selectedSubmenu',
            'pages',
            'allSubmenus',
            'editPage'
        ));
    }



    // -------------------------------------------------------
    // STORE PAGE
    // -------------------------------------------------------
    public function store(Request $request, $submenuId)
    {
        BaraniGroupSubmenu::findOrFail($submenuId);

        $validated = $this->validatePage($request);

        // Banner upload
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $this->storeBanner($request->file('banner_image'));
        }

        // Brochure upload
        if ($request->hasFile('brochure')) {
            $validated['brochure'] = $this->storeBrochure($request->file('brochure'));
        }
        
        
            // Chooseus video file upload (mp4/webm) overrides URL field when provided
        if ($request->hasFile('chooseus_video_file')) {
            $videoFile = $request->file('chooseus_video_file');
            $videoName = time() . '_chooseus_video_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('frontend/imgs/submenu'), $videoName);
            $validated['chooseus_video'] = asset('frontend/imgs/submenu/' . $videoName);
        }

        $validated['submenu_id'] = $submenuId;

        // process cards
        $this->storeProcessCardIcons($request, $validated);
        $this->storeProcessCardText($request, $validated);

        // Create PAGE
        $page = BaraniGroupSubmenuPage::create($validated);

        // -------------------------------------------------------
        // PRESS CONSTRUCTION SECTION
        // -------------------------------------------------------
        $section = BaraniGroupSubmenuPageSection::create([
            'page_id' => $page->id,
            'press_construction_title' => $request->press_construction_title,
            'press_construction_points' => $request->press_construction_points,
        ]);

        $this->storeSectionItems($request, $section);

         $facilityBgVideo = $request->facility_bg_video;
        if ($request->hasFile('facility_bg_video_file')) {
            $videoFile = $request->file('facility_bg_video_file');
            $videoName = time() . '_facility_bg_video_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('frontend/imgs/submenu'), $videoName);
            $facilityBgVideo = asset('frontend/imgs/submenu/' . $videoName);
        }

        $page->manufacturingFacility()->create([
            'facility_title'       => $request->facility_title,
            'facility_bg_video'    => $facilityBgVideo,
            'facility_testimonial' => $request->facility_testimonial,

            'card1_title'  => $request->card1_title,
            'card1_points' => $request->card1_points,

            'card2_title'  => $request->card2_title,
            'card2_points' => $request->card2_points,

            'card3_title'  => $request->card3_title,
            'card3_points' => $request->card3_points,

            'card4_title'  => $request->card4_title,
            'card4_points' => $request->card4_points,
        ]);

        // -------------------------------------------------------
        // PRESS STANDARDS (REPEATABLE)
        // -------------------------------------------------------
        if ($request->press_detail_title) {

            foreach ($request->press_detail_title as $index => $title) {

                $logoName = null;

                if (isset($request->press_detail_logo[$index])) {
                    $file = $request->press_detail_logo[$index];
                    $logoName = time() . "_ps_logo_" . $file->getClientOriginalName();
                    $file->move(public_path("frontend/imgs/submenu"), $logoName);
                }

                $page->pressStandards()->create([
                    'press_main_title' => $index == 0 ? $request->press_main_title : null,
                    'press_detail_logo' => $logoName,
                    'press_detail_title' => $title,
                    'press_detail_desc' => $request->press_detail_desc[$index],
                ]);
            }
        }

 // -------------------------------------------------------
// DESIGN STRENGTH (REPEATABLE)
// -------------------------------------------------------
if ($request->design_softwares_logo) {

    foreach ($request->design_softwares_logo as $index => $file) {

        // Upload new file
        $logoName = null;
        if ($file) {
            $logoName = time() . "_ds_logo_" . $file->getClientOriginalName();
            $file->move(public_path("frontend/imgs/submenu"), $logoName);
        }

        // Insert row
        $page->designStrength()->create([
            'design_title'   => $request->design_title, // SAME TITLE FOR ALL ROWS
            'design_text'    => $request->design_text,  // SAME TEXT FOR ALL ROWS
            'design_softwares_logo' => $logoName,
        ]);
    }
}

        // -------------------------------------------------------
        // TEMPLATE2 - PRESSED COMPONENTS
        // -------------------------------------------------------
        if ($request->template === 'template2') {
            $this->storeTemplate2Data($request, $page);
        }

        return redirect()
            ->route('groupsubmenu.pages.index', $submenuId)
            ->with('success', 'Page created successfully.');
    }



    // -------------------------------------------------------
    // UPDATE PAGE
    // -------------------------------------------------------
    public function update(Request $request, $submenuId, $id)
    {
        $page = BaraniGroupSubmenuPage::findOrFail($id);
        $validated = $this->validatePage($request, updating: true);

        // Banner update
if ($request->hasFile('banner_image')) {

    // Delete old banner if exists
    if ($page->banner_image &&
        file_exists(public_path('frontend/imgs/submenu/' . $page->banner_image))) {
        unlink(public_path('frontend/imgs/submenu/' . $page->banner_image));
    }

    // Save new banner
    $validated['banner_image'] = $this->storeBanner($request->file('banner_image'));
}

 
        // Brochure update and delete
        if ($request->hasFile('brochure')) {
            // Delete old brochure if exists
            if ($page->brochure && file_exists(public_path('frontend/imgs/submenu/' . $page->brochure))) {
                unlink(public_path('frontend/imgs/submenu/' . $page->brochure));
            }

            // Save new brochure
            $validated['brochure'] = $this->storeBrochure($request->file('brochure'));

        } elseif ($request->has('remove_brochure') && $request->input('remove_brochure')) {
            // Remove existing brochure
            if ($page->brochure && file_exists(public_path('frontend/imgs/submenu/' . $page->brochure))) {
                unlink(public_path('frontend/imgs/submenu/' . $page->brochure));
            }
            $validated['brochure'] = null;

        } else {
            $validated['brochure'] = $page->brochure;
        }

        $validated['submenu_id'] = $request->submenu_id;

        // process icons
        $this->updateProcessCardIcons($request, $page, $validated);
        $this->storeProcessCardText($request, $validated);

        $page->update($validated);

        // -------------------------------------------------------
        // PRESS CONSTRUCTION
        // -------------------------------------------------------
// PRESS CONSTRUCTION UPDATE
$section = BaraniGroupSubmenuPageSection::firstOrCreate(
    ['page_id' => $page->id],
    [
        'press_construction_title' => $request->press_construction_title,
        'press_construction_points' => $request->press_construction_points,
    ]
);

$section->update([
    'press_construction_title' => $request->press_construction_title,
    'press_construction_points' => $request->press_construction_points,
]);

$existingItems = $section->items->keyBy('id');

$ids = $request->pc_item_id ?? [];
$oldImgs = $request->pc_old_image ?? [];
$titles = $request->image_title ?? [];
$newFiles = $request->press_construction_image ?? [];

foreach ($titles as $i => $title) {

    $itemId  = $ids[$i] ?? null;
    $oldImg  = $oldImgs[$i] ?? null;
    $newFile = $newFiles[$i] ?? null;

    // IMPORTANT: Skip empty new rows
    if (!$itemId && !$newFile && !$title) {
        continue;
    }

    $filename = $oldImg;

    if ($newFile) {
        $filename = time() . '_pc_' . $newFile->getClientOriginalName();
        $newFile->move(public_path('frontend/imgs/submenu'), $filename);
    }

    if ($itemId) {

        $section->items()->where('id', $itemId)->update([
            'image_title' => $title,
            'image'       => $filename,
        ]);

        $existingItems->forget($itemId);

    } else {

        $section->items()->create([
            'image_title' => $title,
            'image'       => $filename,
        ]);
    }
}

// Delete removed items
foreach ($existingItems as $leftover) {
    if ($leftover->image && file_exists(public_path('frontend/imgs/submenu/'.$leftover->image))) {
        unlink(public_path('frontend/imgs/submenu/'.$leftover->image));
    }
    $leftover->delete();
}


        // -------------------------------------------------------
        // MANUFACTURING FACILITY
        // -------------------------------------------------------
      $mf = $page->manufacturingFacility;

        $facilityBgVideo = $request->facility_bg_video;
        if ($request->hasFile('facility_bg_video_file')) {
            // delete old uploaded file if local
            if ($mf && $mf->facility_bg_video && str_starts_with($mf->facility_bg_video, asset('frontend/imgs/submenu')) ) {
                $existingPath = public_path('frontend/imgs/submenu/' . basename($mf->facility_bg_video));
                if (file_exists($existingPath)) {
                    unlink($existingPath);
                }
            }

            $videoFile = $request->file('facility_bg_video_file');
            $videoName = time() . '_facility_bg_video_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('frontend/imgs/submenu'), $videoName);
            $facilityBgVideo = asset('frontend/imgs/submenu/' . $videoName);
        }

        if ($mf) {
            $mf->update([
                'facility_title'       => $request->facility_title,
                'facility_bg_video'    => $facilityBgVideo,
                'facility_testimonial' => $request->facility_testimonial,

                'card1_title'  => $request->card1_title,
                'card1_points' => $request->card1_points,

                'card2_title'  => $request->card2_title,
                'card2_points' => $request->card2_points,

                'card3_title'  => $request->card3_title,
                'card3_points' => $request->card3_points,

                'card4_title'  => $request->card4_title,
                'card4_points' => $request->card4_points,
            ]);
        }
        // -------------------------------------------------------
        // PRESS STANDARDS update
        // -------------------------------------------------------
        $existing = $page->pressStandards()->get();
        $oldLogos = [];
        foreach ($existing as $idx => $old) {
            $oldLogos[$idx] = $old->press_detail_logo;
        }

        $page->pressStandards()->delete();

        if ($request->press_detail_title) {
            foreach ($request->press_detail_title as $index => $title) {

                $logoName = null;

                if (isset($request->press_detail_logo[$index])) {
                    $file = $request->press_detail_logo[$index];
                    $logoName = time() . "_ps_logo_" . $file->getClientOriginalName();
                    $file->move(public_path("frontend/imgs/submenu"), $logoName);
                } else {
                    $logoName = $oldLogos[$index] ?? null;
                }

                $page->pressStandards()->create([
                    'press_main_title' => $index == 0 ? $request->press_main_title : null,
                    'press_detail_logo' => $logoName,
                    'press_detail_title' => $title,
                    'press_detail_desc' => $request->press_detail_desc[$index],
                ]);
            }
        }


      // -------------------------------------------------------
// DESIGN STRENGTH SMART UPDATE
// -------------------------------------------------------

$existing = $page->designStrength->keyBy('id');

$ids      = $request->design_strength_id ?? [];
$oldLogos = $request->design_old_logo ?? [];
$newFiles = $request->design_softwares_logo ?? [];

$sectionTitle = $request->design_title;
$sectionText  = $request->design_text;

foreach ($ids as $i => $id) {

    $old = $oldLogos[$i] ?? null;
    $new = $newFiles[$i] ?? null;

    // Keep old file if no new file selected
    $filename = $old;

    if ($new) {
        $filename = time() . "_ds_logo_" . $new->getClientOriginalName();
        $new->move(public_path("frontend/imgs/submenu"), $filename);
    }

    if ($id) {
        // Update existing row
        $page->designStrength()->where('id', $id)->update([
            'design_title'   => $sectionTitle,
            'design_text'    => $sectionText,
            'design_softwares_logo' => $filename,
        ]);

        $existing->forget($id);

    } else {
        // Insert new row only if new file selected
        if ($new) {
            $page->designStrength()->create([
                'design_title'   => $sectionTitle,
                'design_text'    => $sectionText,
                'design_softwares_logo' => $filename,
            ]);
        }
    }
}

// Delete removed rows
foreach ($existing as $left) {

    if ($left->design_softwares_logo &&
        file_exists(public_path("frontend/imgs/submenu/".$left->design_softwares_logo))) {
        unlink(public_path("frontend/imgs/submenu/".$left->design_softwares_logo));
    }

    $left->delete();
}

        // -------------------------------------------------------
        // TEMPLATE2 - PRESSED COMPONENTS
        // -------------------------------------------------------
        if ($request->template === 'template2') {
            $this->storeTemplate2Data($request, $page);
        }

        return redirect()
            ->route('groupsubmenu.pages.index', $submenuId)
            ->with('success', 'Page updated successfully.');
    }




    // -------------------------------------------------------
    // DELETE PAGE
    // -------------------------------------------------------
    public function destroy($submenuId, $pageId)
    {
        $page = BaraniGroupSubmenuPage::findOrFail($pageId);

        // delete banner
        if ($page->banner_image &&
            file_exists(public_path('frontend/imgs/submenu/' . $page->banner_image))) {
            unlink(public_path('frontend/imgs/submenu/' . $page->banner_image));
        }

        // delete brochure
        if ($page->brochure &&
            file_exists(public_path('frontend/imgs/submenu/' . $page->brochure))) {
            unlink(public_path('frontend/imgs/submenu/' . $page->brochure));
        }

        // delete icons
        for ($i = 1; $i <= 4; $i++) {
            $field = "view_process_card{$i}_icon";
            if ($page->$field && file_exists(public_path("frontend/imgs/submenu/{$page->$field}"))) {
                unlink(public_path("frontend/imgs/submenu/{$page->$field}"));
            }
        }

        // Press construction
        foreach ($page->sections as $section) {
            $section->items()->delete();
            $section->delete();
        }

        // Press standards
        foreach ($page->pressStandards as $ps) {
            if ($ps->press_detail_logo &&
                file_exists(public_path("frontend/imgs/submenu/" . $ps->press_detail_logo))) {
                unlink(public_path("frontend/imgs/submenu/" . $ps->press_detail_logo));
            }
        }

        // Design Strength
        foreach ($page->designStrength as $ds) {
            if ($ds->design_softwares_logo &&
                file_exists(public_path("frontend/imgs/submenu/" . $ds->design_softwares_logo))) {
                unlink(public_path("frontend/imgs/submenu/" . $ds->design_softwares_logo));
            }
        }

        $page->delete();

        return redirect()
            ->route('groupsubmenu.pages.index', $submenuId)
            ->with('success', 'Page deleted.');
    }



    // -------------------------------------------------------
    // VALIDATION
    // -------------------------------------------------------
    private function validatePage(Request $request, $updating = false)
    {
        return $request->validate([
            'submenu_id' => $updating ? 'required|integer' : 'nullable',
            'brochure' => 'nullable|file|mimes:pdf|max:10240',
            'banner_title' => 'nullable|string|max:255',
            'division_title' => 'nullable|string|max:255',
            'division_desc' => 'nullable|string',
            'chooseus_points' => 'nullable|string',
            'chooseus_video'  => 'nullable|string|max:255',
              'chooseus_video_file' => 'nullable|file|mimes:mp4,webm|max:512000',

            'banner_image' => 'nullable|image',

            'view_process_title' => 'nullable|string|max:255',

            'view_process_card1_icon' => 'nullable|image',
            'view_process_card2_icon' => 'nullable|image',
            'view_process_card3_icon' => 'nullable|image',
            'view_process_card4_icon' => 'nullable|image',

            'view_process_card1_title' => 'nullable|string|max:255',
            'view_process_card2_title' => 'nullable|string|max:255',
            'view_process_card3_title' => 'nullable|string|max:255',
            'view_process_card4_title' => 'nullable|string|max:255',

            'view_process_card1_desc' => 'nullable|string',
            'view_process_card2_desc' => 'nullable|string',
            'view_process_card3_desc' => 'nullable|string',
            'view_process_card4_desc' => 'nullable|string',

            // Press construction
            'press_construction_title' => 'nullable|string|max:255',
            'press_construction_points' => 'nullable|string',
            'image_title.*' => 'nullable|string|max:255',
            'press_construction_image.*' => 'nullable|image|max:5120',

            // Facility
            'facility_title' => 'nullable|string|max:255',
            'facility_bg_video' => 'nullable|string|max:255',
             'facility_bg_video_file' => 'nullable|file|mimes:mp4,webm|max:512000',
            'facility_testimonial' => 'nullable|string',

            'card1_title' => 'nullable|string|max:255',
            'card1_points' => 'nullable|string',
            'card2_title' => 'nullable|string|max:255',
            'card2_points' => 'nullable|string',
            'card3_title' => 'nullable|string|max:255',
            'card3_points' => 'nullable|string',
            'card4_title' => 'nullable|string|max:255',
            'card4_points' => 'nullable|string',

            // Press standards
            'press_main_title' => 'nullable|string|max:255',
            'press_detail_logo.*' => 'nullable|image|max:5120',
            'press_detail_title.*' => 'nullable|string|max:255',
            'press_detail_desc.*' => 'nullable|string',

            // Design Strength
            'design_title' => 'nullable|string|max:255',
            'design_text' => 'nullable|string',
            'design_softwares_logo.*' => 'nullable|image|max:5120',
            // Manufacturing capability images (allow multiple uploads and optional keep list on update)
            'pc_manufacturing_capability_image' => 'nullable|array',
            'pc_manufacturing_capability_image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'pc_manufacturing_capability_existing' => 'nullable|array',
            'pc_manufacturing_capability_existing.*' => 'nullable|string',
            // Template selection
            'template' => 'nullable|string|max:100',

        ]);
    }



    // -------------------------------------------------------
    // UTILITIES
    // -------------------------------------------------------
    private function storeSectionItems(Request $request, $section)
    {
        if (!$request->image_title) return;

        foreach ($request->image_title as $index => $title) {

            $filename = null;

            if (isset($request->press_construction_image[$index])) {
                $file = $request->press_construction_image[$index];
                $filename = time() . '_pc_' . $file->getClientOriginalName();
                $file->move(public_path('frontend/imgs/submenu'), $filename);
            }

            $section->items()->create([
                'image_title' => $title,
                'image'       => $filename,
            ]);
        }
    }
    
    private function storeBanner($file)
    {
        $filename = time() . "_" . $file->getClientOriginalName();
    
        // Move banner into the frontend assets folder
        $file->move(public_path('frontend/imgs/submenu'), $filename);
    
        return $filename;
    }

    private function storeBrochure($file)
    {
        $filename = time() . "_brochure_" . $file->getClientOriginalName();
    
        // Move brochure into the frontend assets folder
        $file->move(public_path('frontend/imgs/submenu'), $filename);
    
        return $filename;
    }


    private function storeProcessCardIcons(Request $request, &$validated)
    {
        for ($i = 1; $i <= 4; $i++) {
            $field = "view_process_card{$i}_icon";

            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . "_card{$i}_" . $file->getClientOriginalName();
                $file->move(public_path('frontend/imgs/submenu'), $filename);
                $validated[$field] = $filename;
            }
        }
    }

    private function updateProcessCardIcons(Request $request, $page, &$validated)
    {
        for ($i = 1; $i <= 4; $i++) {

            $field = "view_process_card{$i}_icon";

            if ($request->hasFile($field)) {

                if ($page->$field &&
                    file_exists(public_path("frontend/imgs/submenu/{$page->$field}"))) {
                    unlink(public_path("frontend/imgs/submenu/{$page->$field}"));
                }

                $file = $request->file($field);
                $filename = time() . "_card{$i}_" . $file->getClientOriginalName();
                $file->move(public_path('frontend/imgs/submenu'), $filename);

                $validated[$field] = $filename;

            } else {
                $validated[$field] = $page->$field;
            }
        }
    }

    private function storeProcessCardText(Request $request, &$validated)
    {
        $validated['view_process_title'] = $request->input('view_process_title');

        for ($i = 1; $i <= 4; $i++) {
            $validated["view_process_card{$i}_title"] = $request->input("view_process_card{$i}_title");
            $validated["view_process_card{$i}_desc"]  = $request->input("view_process_card{$i}_desc");
        }
    }

    // -------------------------------------------------------
    // TEMPLATE2 - PRESSED COMPONENTS DATA STORAGE
    // -------------------------------------------------------
    private function storeTemplate2Data(Request $request, $page)
    {
        // Get or create pressed component for this page
        $pc = $page->pressedComponent()->first() ?? $page->pressedComponent()->create([]);

        // Banner
        if ($request->hasFile('pc_banner_image')) {
            $filename = time() . '_pc_banner_' . $request->file('pc_banner_image')->getClientOriginalName();
            $request->file('pc_banner_image')->move(public_path('frontend/imgs/submenu'), $filename);
            $pc->banner_image = $filename;
        }

        $pc->banner_title = $request->pc_banner_title;
        $pc->description = $request->pc_description;

        // Capabilities
        $pc->capabilities_title = $request->pc_capabilities_title;
        $pc->capabilities_subtitle = $request->pc_capabilities_subtitle;
        $pc->capabilities_cards = $request->pc_capabilities_cards ?? [];

        // Industries
        $pc->industries_title = $request->pc_industries_title;
        $pc->industries_subtitle = $request->pc_industries_subtitle;
        $pc->industries_name = $request->pc_industries_name ?? [];

        // Process industries icons uploads
      $industriesIcons = $pc->industries_icons ?? [];

if ($request->hasFile('pc_industries_icons')) {
    foreach ($request->file('pc_industries_icons') as $index => $file) {
        if ($file) {
                    $filename = time() . '_pc_industry_' . $index . '_' . $file->getClientOriginalName();
                    $file->move(public_path('frontend/imgs/submenu'), $filename);
                  $industriesIcons[$index] = $filename;
                } else {
                    // Keep existing image if no new file
                    $existing = $pc->industries_icons[$index] ?? null;
                    $industriesIcons[] = $existing;
                }
            }
        }
$pc->industries_icons = array_values($industriesIcons);

        // Manufacturing Capability
        $pc->manufacturing_capability_title = $request->pc_manufacturing_capability_title ?? '';
        $pc->manufacturing_capability_subtitle = $request->pc_manufacturing_capability_subtitle ?? '';
        $pc->manufacturing_capability_description = $request->pc_manufacturing_capability_description ?? '';

        // Manufacturing capability images - support multiple images in single field (array)
        $existingImages = $pc->manufacturing_capability_image ?? [];
        // Normalize existing values to array if stored as JSON/string
        if (!is_array($existingImages)) {
            $existingImages = $existingImages ? (json_decode($existingImages, true) ?: []) : [];
        }

        $keepImages = $request->input('pc_manufacturing_capability_existing', []);

        // Delete images that were removed in the request
        foreach ($existingImages as $img) {
            if (!in_array($img, $keepImages)) {
                if ($img && file_exists(public_path('frontend/imgs/submenu/'.$img))) {
                    unlink(public_path('frontend/imgs/submenu/'.$img));
                }
            }
        }

        // Start with kept images
        $capabilityImages = array_values(array_filter($keepImages));

        // Append newly uploaded files (support multiple)
        if ($request->hasFile('pc_manufacturing_capability_image')) {
            foreach ($request->file('pc_manufacturing_capability_image') as $file) {
                if ($file) {
                    $filename = time() . '_manufacturing_capability_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('frontend/imgs/submenu'), $filename);
                    $capabilityImages[] = $filename;
                }
            }
        }

        $pc->manufacturing_capability_image = array_values($capabilityImages);


        // Infrastructure
        $pc->infrastructure_equipments = $request->pc_infrastructure_equipments ?? [];

        // Core Processes
        $pc->core_processes_title = $request->pc_core_processes_title ?? '';
        $pc->core_processes_subtitle = $request->pc_core_processes_subtitle ?? '';
        $pc->core_processes_table = $request->pc_core_processes_table ?? '';

        // Quality Inspection
        $pc->quality_inspection_title = $request->pc_quality_inspection_title ?? '';
        $pc->quality_inspection_subtitle = $request->pc_quality_inspection_subtitle ?? '';
        $pc->quality_inspection_table = $request->pc_quality_inspection_table ?? '';

        // Technology Range
        $pc->technology_range_title = $request->pc_technology_range_title ?? '';
        $pc->technology_range_subtitle = $request->pc_technology_range_subtitle ?? '';
        // $pc->technology_range_cards = $request->pc_technology_range_cards ?? [];
$cards = $request->pc_technology_range_cards ?? [];
$images = $request->file('pc_technology_range_cards_images', []);

foreach ($cards as $i => &$card) {
    if (isset($images[$i])) {
        $file = $images[$i];
        $filename = time().'_pc_tech_'.$i.'_'.$file->getClientOriginalName();
        $file->move(public_path('frontend/imgs/submenu'), $filename);
        $card['image'] = $filename;
    }
}
$pc->technology_range_cards = $cards;

        // Technology Range - cards already have image field inside them

        // Points - Extract title and description separately from the combined array
        $pc->point_section_title = $request->pc_point_section_title;
        
        if ($request->has('pc_points') && is_array($request->pc_points)) {
            $pointTitles = [];
            $pointDescriptions = [];
            
            foreach ($request->pc_points as $point) {
                if (is_array($point)) {
                    $pointTitles[] = $point['title'] ?? '';
                    $pointDescriptions[] = $point['description'] ?? '';
                }
            }
            
            $pc->point_title = $pointTitles;
            $pc->points = $pointDescriptions;
        } else {
            $pc->point_title = [];
            $pc->points = [];
        }

        $pc->save();
    }
}
