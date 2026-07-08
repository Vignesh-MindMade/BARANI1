<?php

namespace App\Http\Controllers;

use App\Models\CapabilitiesMenu;
use Illuminate\Http\Request;

class CapabilitiesMenuController extends Controller
{
    // Frontend (not affected by this issue)
    public function frontendShow($menuId)
    {
        $menu = CapabilitiesMenu::with('submenus')->findOrFail($menuId);
        $firstSubmenu = $menu->submenus->sortBy('sort_id')->first();
        return view('frontend.capabilities.menu', compact('menu', 'firstSubmenu'));
    }

    public function index(Request $request)
    {
        $menus = CapabilitiesMenu::orderBy('sort_id')->get();

        if ($request->has('edit')) {
            $edit = CapabilitiesMenu::findOrFail($request->edit);
            return view('Backend.capabilities-menu.index', compact('menus', 'edit'));
        }

        return view('Backend.capabilities-menu.index', compact('menus'));
    }

    public function create()
    {
        return view('Backend.capabilities-menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'sort_id'   => 'nullable|integer',
        ]);

        CapabilitiesMenu::create([
            'menu_name' => $request->menu_name,
            'sort_id'   => $request->sort_id ?? 0,
        ]);

        // ──── Fixed here ────
        return redirect()->route('capsubmenu.index')
            ->with('success', 'Menu created successfully');
    }

    public function edit($id)
    {
        $menu = CapabilitiesMenu::findOrFail($id);
        return view('Backend.capabilities-menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'sort_id'   => 'nullable|integer',
        ]);

        $menu = CapabilitiesMenu::findOrFail($id);
        $menu->update([
            'menu_name' => $request->menu_name,
            'sort_id'   => $request->sort_id ?? 0,
        ]);

        // ──── Fixed here ────
        return redirect()->route('capsubmenu.index')
            ->with('success', 'Menu updated successfully');
    }

    public function destroy($id)
    {
        $menu = CapabilitiesMenu::findOrFail($id);
        $menu->delete();

        // ──── Fixed here ────
        return redirect()->route('capsubmenu.index')
            ->with('success', 'Menu deleted');
    }

    public function sort(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:capabilities_menu,id',   // ← note: primary key is 'id' here
        ]);

        foreach ($request->order as $key => $id) {
            CapabilitiesMenu::where('id', $id)->update(['sort_id' => $key + 1]);
        }

        return response()->json(['success' => true]);
    }
}