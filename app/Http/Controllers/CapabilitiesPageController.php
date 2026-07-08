<?php

namespace App\Http\Controllers;

use App\Models\CapabilitiesMenu;
use App\Models\CapabilitiesSubmenuPages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CapabilitiesPageController extends Controller
{
    /**
     * Show all pages (grouped by menu) + create/edit form
     */
    public function index(Request $request, $menu)
    {
        // All menus (for the dropdown when creating)
        $menus = CapabilitiesMenu::orderBy('sort_id')->get();

        // The 'menu' parameter is passed from the route /cap-submenu/{menu}/pages
        $preselectedMenuId = $menu;

        $editPage = null;
        if ($request->has('edit')) {
            $editPage = CapabilitiesSubmenuPages::findOrFail($request->edit);
            // Make sure the page belongs to the requested menu (security)
            if ($preselectedMenuId && $editPage->menu_id != $preselectedMenuId) {
                abort(403);
            }
        }

        // Show pages for the specific menu
        $pagesQuery = CapabilitiesSubmenuPages::with('menu');
        if ($preselectedMenuId) {
            $pagesQuery->where('menu_id', $preselectedMenuId);
        }
        $pages = $pagesQuery->get();

        return view('Backend.capabilities-pages.index', compact(
            'menus',
            'pages',
            'editPage',
            'preselectedMenuId'
        ));
    }

    /**
     * Store new page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:capabilities_menu,id|unique:capabilities_submenu_pages,menu_id',
            'template' => 'required|in:template_1,template_2,template_3',
            'slug' => 'required|string|max:255|unique:capabilities_submenu_pages,slug',
            'banner_title' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'intro_title' => 'nullable|string|max:255',
            'intro_description' => 'nullable|string',

            // Template 1
            'parallax_image' => 'nullable|image|max:2048',
            'services_subtitle' => 'nullable|string|max:255',
            'press_sections' => 'nullable|array',
            'main_features' => 'nullable|array',
            'bottom_section_items' => 'nullable|array',

            // Template 2
            'feature_list' => 'nullable|array',
            'feature_rows' => 'nullable|array',
            'process_title' => 'nullable|string|max:255',
            'process_steps' => 'nullable|array',
            'strength_materials_title' => 'nullable|string|max:255',
            'strength_materials_grid' => 'nullable|array',
        ]);

        // Handle file uploads (example - adjust storage path as needed)
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('pages/banner', 'public');
        }
        if ($request->hasFile('parallax_image')) {
            $validated['parallax_image'] = $request->file('parallax_image')->store('pages/parallax', 'public');
        }

        // Process images in repeater fields
        $this->processRepeaterImages($request, $validated);

        // Process repeater fields to convert "items" string to array
        $this->processArrayFields($validated);

        CapabilitiesSubmenuPages::create($validated);

        return redirect()->route('capsubmenu.pages.index', ['menu' => $validated['menu_id']])
            ->with('success', 'Page created successfully');
    }

    /**
     * Update existing page
     */
    public function update(Request $request, $menu, $id)
    {
        // $menu parameter is just part of the URI, but we primarily use $id to find the page
        $page = CapabilitiesSubmenuPages::findOrFail($id);

        $validated = $request->validate([
            'template' => 'required|in:template_1,template_2,template_3',
            'slug' => 'required|string|max:255|unique:capabilities_submenu_pages,slug,' . $id,
            'banner_title' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'intro_title' => 'nullable|string|max:255',
            'intro_description' => 'nullable|string',

            // Template 1 fields
            'parallax_image' => 'nullable|image|max:2048',
            'services_subtitle' => 'nullable|string|max:255',
            'press_sections' => 'nullable|array',
            'main_features' => 'nullable|array',
            'bottom_section_items' => 'nullable|array',

            // Template 2 fields
            'feature_list' => 'nullable|array',
            'feature_rows' => 'nullable|array',
            'process_title' => 'nullable|string|max:255',
            'process_steps' => 'nullable|array',
            'strength_materials_title' => 'nullable|string|max:255',
            'strength_materials_grid' => 'nullable|array',
        ]);

        // Handle file uploads + keep old if no new file
        if ($request->hasFile('banner_image')) {
            // Delete old if exists
            if ($page->banner_image)
                Storage::disk('public')->delete($page->banner_image);
            $validated['banner_image'] = $request->file('banner_image')->store('pages/banner', 'public');
        }

        if ($request->hasFile('parallax_image')) {
            if ($page->parallax_image)
                Storage::disk('public')->delete($page->parallax_image);
            $validated['parallax_image'] = $request->file('parallax_image')->store('pages/parallax', 'public');
        }

        // Process images in repeater fields
        $this->processRepeaterImages($request, $validated);

        // Process repeater fields to convert "items" string to array
        $this->processArrayFields($validated);

        $repeaterFields = [
    'press_sections',
    'main_features',
    'bottom_section_items',
    'feature_list',
    'feature_rows',
    'process_steps',
    'strength_materials_grid',
];

// Force missing repeaters to empty array
foreach ($repeaterFields as $field) {
    if (!$request->has($field)) {
        $validated[$field] = [];
    } else {
        // Reindex to avoid gaps like [0,2,5]
        $validated[$field] = array_values($validated[$field]);
    }
}



        $page->update($validated);

        return redirect()->route('capsubmenu.pages.index', ['menu' => $page->menu_id])
            ->with('success', 'Page updated successfully');
    }

    /**
     * Delete page
     */
    public function destroy($menu, $id)
    {
        $page = CapabilitiesSubmenuPages::findOrFail($id);

        // Delete associated images
        if ($page->banner_image)
            Storage::disk('public')->delete($page->banner_image);
        if ($page->parallax_image)
            Storage::disk('public')->delete($page->parallax_image);

        $page->delete();

        return redirect()->route('capsubmenu.pages.index', ['menu' => $page->menu_id])
            ->with('success', 'Page deleted successfully');
    }

    /**
     * Helper to process repeater arrays where 'items' is a newline-separated string.
     */
    private function processArrayFields(array &$data)
    {
        // Fields that have 'items' as a string (from textarea) that needs to be an array
        // Added main_features here as we are upgrading it to repeater with items
        $fieldsToProcess = ['press_sections', 'feature_list', 'feature_rows', 'process_steps', 'main_features'];

        foreach ($fieldsToProcess as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                foreach ($data[$field] as $key => $item) {
                    if (isset($item['items']) && is_string($item['items'])) {
                        // Split by newline and filter empty items
                        $arrayItems = array_filter(array_map('trim', explode("\n", $item['items'])));
                        // Re-index array
                        $data[$field][$key]['items'] = array_values($arrayItems);
                    }
                }
            }
        }
    }

    /**
     * Helper to process images inside repeater fields
     */
    private function processRepeaterImages(Request $request, array &$data)
    {
        $fieldsWithImages = ['feature_rows', 'feature_list', 'main_features', 'bottom_section_items'];

        foreach ($fieldsWithImages as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                foreach ($data[$field] as $index => &$item) {
                    // Check if a new file is uploaded for this item
                    if ($request->hasFile("{$field}.{$index}.image")) {
                        // Upload new image
                        $path = $request->file("{$field}.{$index}.image")->store('pages/features', 'public');
                        $item['image'] = $path;
                    } elseif (isset($item['existing_image'])) {
                        // Keep existing image if no new file
                        $item['image'] = $item['existing_image'];
                    }

                    // Clean up helper key
                    unset($item['existing_image']);
                }
            }
        }
    }

    /* -------------------------------------------------
       FRONTEND VIEW
    ------------------------------------------------- */
    public function show($slug)
    {
        $page = CapabilitiesSubmenuPages::where('slug', $slug)->firstOrFail();

        // Ensure array fields are actually arrays (in case DB has old JSON strings)
        // Similar logic to processArrayFields but for output
        $fieldsToCheck = ['press_sections', 'feature_list', 'feature_rows', 'process_steps', 'strength_materials_grid', 'main_features', 'bottom_section_items'];
        foreach ($fieldsToCheck as $field) {
            if (is_string($page->$field)) {
                $decoded = json_decode($page->$field, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $page->$field = $decoded;
                } else {
                    // Could be newline string (legacy issue we fixed in backend but maybe exists here)
                    // or empty. For now trust the backend fixes or json_decode.
                }
            }
        }

        if ($page->template === 'template_1') {
            return view('frontend.capabilities.capabilities', compact('page'));
        } elseif ($page->template === 'template_2') {
            return view('frontend.capabilities.tooling', compact('page'));
        } elseif ($page->template === 'template_3') {
            return view('frontend.capabilities.automation', compact('page'));
        }

        abort(404);
    }
}