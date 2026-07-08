<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
public function index()
{
    $menus = Menu::all();

    view()->share('menuss',$menus);
    return view('menus.index', compact('menus'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
        'sort_id' => 'nullable|numeric',
    ]);

    $menu = new Menu;
    $menu->name = $validatedData['name'];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $menu->image = $imageName;
    }

    if (isset($validatedData['sort_id'])) {
        $menu->sort_id = $validatedData['sort_id'];
    }

    $menu->save();

    return redirect()->back()->with('success', 'Menu created successfully.');
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
        'sort_id' => 'nullable|numeric',
    ]);

    $menu = Menu::findOrFail($id);
    $menu->name = $validatedData['name'];

    if ($request->hasFile('image')) {
        // Optionally delete the old image file if needed
        if ($menu->image && file_exists(public_path('images/' . $menu->image))) {
            unlink(public_path('images/' . $menu->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $menu->image = $imageName;
    }

    if (isset($validatedData['sort_id'])) {
        $menu->sort_id = $validatedData['sort_id'];
    }

    $menu->save();

    return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
}

public function destroy($id)
{
    $menu = Menu::findOrFail($id);
    $menu->delete();
    return redirect()->route('menus.index');
}


public function submenu()
    {
        $submenus = Submenu::active()->ordered()->with('menu')->get();
        $menus = Menu::active()->ordered()->get();

        // Share with all views if needed
        view()->share('submenus', $submenus);
        
        return view('menus.submenu', compact('submenus', 'menus'));
    }


    
public function save(Request $request)
{
    $validatedData = $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'submenu' => 'required|string|max:255',
        'sort_id' => 'nullable|integer',
    ]);

    $submenu = new Submenu; 
    $submenu->menu_id = $validatedData['menu_id'];
    $submenu->submenu = $validatedData['submenu'];
    if (isset($validatedData['sort_id'])) {
        $submenu->sort_id = $validatedData['sort_id'];
    }


    $submenu->save();

    return redirect()->back()->with('success', 'Submenu created successfully.');
}


public function submenuupdate(Request $request, $id)
{
    $request->validate([
        'menu_id' => 'required',
        'submenu' => 'required',
        'sort_id' => 'required|integer',
    ]);

    $submenu = Submenu::findOrFail($id);
    $submenu->menu_id = $request->menu_id;
    $submenu->submenu = $request->submenu;
    $submenu->sort_id = $request->sort_id;
    $submenu->save();

    return redirect()->route('menus.submenu')->with('success', 'Submenu updated successfully.');
}

public function submenudestroy($id)
{
    $submenu = Submenu::findOrFail($id);
    $submenu->delete();
    return redirect()->route('menus.submenu')->with('success', 'Submenu updated successfully.');
}





}
