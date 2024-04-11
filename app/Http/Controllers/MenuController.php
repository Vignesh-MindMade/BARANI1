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
        return view('menus.index', compact('menus'));
    }



    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'sort_id' => 'nullable|string|max:255',
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



public function destroy($id)
{
    // Delete the user
    $user = Menu::findOrFail($id);
    $user->delete();

    return redirect()->route('menus.index');
}



public function submenu()
{
    $submenus = Submenu::with('menu')->get();
    return view('menus.submenu', compact('submenus'));
}



public function save(Request $request)
{
    $validatedData = $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'submenu' => 'required|string|max:255',
        'sort_id' => 'nullable|integer',
    ]);

    $submenu = new Submenu; // Assuming Submenu is your model name
    $submenu->menu_id = $validatedData['menu_id'];
    $submenu->submenu = $validatedData['submenu'];
    if (isset($validatedData['sort_id'])) {
        $submenu->sort_id = $validatedData['sort_id'];
    }


    $submenu->save();

    return redirect()->back()->with('success', 'Submenu created successfully.');
}





}
