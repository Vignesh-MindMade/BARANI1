<?php

namespace App\Http\Controllers;

use App\Models\BaraniGroupSubmenu;
use Illuminate\Http\Request;

class BaraniGroupSubmenuController extends Controller
{
    // Frontend
    public function frontendShow($submenuId)
{
    $submenu = BaraniGroupSubmenu::with('pages')->findOrFail($submenuId);

    // If submenu has only 1 page (common case)
    $page = $submenu->pages->first();

    if (!$page) {
        abort(404, 'No page found for this submenu');
    }

    return view('frontend.groupsubmenu.index', compact('submenu', 'page'));
}




    // Show all submenus sorted
public function index(Request $request)
{
    $submenus = BaraniGroupSubmenu::with('pages')->orderBy('sort_id')->get();

    if ($request->has('edit')) {
        $edit = BaraniGroupSubmenu::findOrFail($request->edit);
        return view('Backend.submenu.index', compact('submenus', 'edit'));
    }

    return view('Backend.submenu.index', compact('submenus'));
}


    // Show create form
    public function create()
    {
        return view('Backend.submenu.create');
    }

    // Store submenu
    public function store(Request $request)
    {
        $request->validate([
            'submenu_name' => 'required|string|max:255',
            'sort_id'      => 'nullable|integer',
        ]);

        BaraniGroupSubmenu::create([
            'submenu_name' => $request->submenu_name,
            'sort_id'      => $request->sort_id ?? 0,
        ]);

        return redirect()->route('groupsubmenu.index')->with('success', 'Submenu created successfully');
    }

    // Edit submenu
    public function edit($id)
    {
        $submenu = BaraniGroupSubmenu::findOrFail($id);
        return view('Backend.submenu.edit', compact('submenu'));
    }

    // Update submenu
    public function update(Request $request, $id)
    {
        $request->validate([
            'submenu_name' => 'required|string|max:255',
            'sort_id'      => 'nullable|integer',
        ]);

        $submenu = BaraniGroupSubmenu::findOrFail($id);

        $submenu->update([
            'submenu_name' => $request->submenu_name,
            'sort_id'      => $request->sort_id ?? 0,
        ]);

        return redirect()->route('groupsubmenu.index')->with('success', 'Submenu updated successfully');
    }

    // Delete submenu
    public function destroy($id)
    {
        $submenu = BaraniGroupSubmenu::findOrFail($id);
        $submenu->delete();

        return redirect()->route('groupsubmenu.index')->with('success', 'Submenu deleted');
    }

    // AJAX sorting (drag & drop)
    public function sort(Request $request)
    {
        foreach ($request->order as $key => $id) {
            BaraniGroupSubmenu::where('id', $id)->update(['sort_id' => $key + 1]);
        }

        return response()->json(['success' => true]);
    }
}
