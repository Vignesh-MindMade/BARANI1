<?php

namespace App\Http\Controllers;

use App\Models\Topbar;
use Illuminate\Http\Request;

class TopbarController extends Controller
{
    public function index()
    {
        $topbars = Topbar::all();
        return view('topbar.index', compact('topbars'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link_text' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $topbar = new Topbar;
        $topbar->title = $validatedData['title'];
        $topbar->link_text = $validatedData['link_text'];
        $topbar->link = $validatedData['link'];

        if (isset($validatedData['sort_id'])) {
            $topbar->sort_id = $validatedData['sort_id'];
        }

        $topbar->save();

        return redirect()->back()->with('success', 'TopBar created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link_text' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'sort_id' => 'nullable|string|max:255',
        ]);

        $topbar = Topbar::findOrFail($id);
        $topbar->title = $validatedData['title'];
        $topbar->link_text = $validatedData['link_text'];
        $topbar->link = $validatedData['link'];

        if (isset($validatedData['sort_id'])) {
            $topbar->sort_id = $validatedData['sort_id'];
        }

        $topbar->save();

        return redirect()->back()->with('success', 'TopBar updated successfully.');
    }

    public function delete($id)
    {
        $topbar = Topbar::findOrFail($id);
        $topbar->delete();

        return redirect()->back()->with('success', 'TopBar deleted successfully.');
    }
}
