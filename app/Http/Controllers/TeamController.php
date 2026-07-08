<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamTEST;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display team hierarchy
     */
    public function Index()
    {
        $teams = Team::whereNull('parent_id')->with('children')->get();
        return view('Backend.Team.index', compact('teams'));
    }

    /**
     * Store a new team member
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:teams,id',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $member = new Team();
        $member->name = $request->name;
        $member->designation = $request->designation;
        $member->parent_id = $request->parent_id;
        $member->role = $request->role;

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/team'), $filename);
            $member->image = $filename;
        }

        $member->save();

        return redirect()->back()->with('success', 'Team member added successfully!');
    }

    /**
     * Update team member details
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $member = Team::findOrFail($id);
        $member->name = $request->name;
        $member->designation = $request->designation;
        $member->role = $request->role;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($member->image && File::exists(public_path('images/team/' . $member->image))) {
                File::delete(public_path('images/team/' . $member->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/team'), $filename);
            $member->image = $filename;
        }

        $member->save();

        return redirect()->back()->with('success', 'Team member updated successfully!');
    }

    /**
     * Delete team member
     * Only allows deletion if member has no children
     */
    public function destroy($id)
    {
        $member = Team::findOrFail($id);

        // Check if member has children
        if ($member->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete member with subordinates. Please remove subordinates first.');
        }

        // Delete image if exists
        if ($member->image && File::exists(public_path('images/team/' . $member->image))) {
            File::delete(public_path('images/team/' . $member->image));
        }

        $member->delete();

        return redirect()->back()->with('success', 'Team member deleted successfully!');
    }

    /**
     * Get team member details (for AJAX requests)
     */
    public function show($id)
    {
        $member = Team::with('parent', 'children')->findOrFail($id);
        return response()->json($member);
    }

    /**
     * Get all team members in hierarchical structure
     */
    public function getHierarchy()
    {
        $teams = Team::whereNull('parent_id')
            ->with('children.children')
            ->get();

        return response()->json($teams);
    }
    
    
    
    // New For Test
    
public function TestIndex()
    {
        $teamtests = TeamTEST::first() ?? TeamTEST::create();
        return view('Backend.Team.TES.index', compact('teamtests'));
    }

    public function TESTupdate(Request $request)
    {
        $teamtests = TeamTEST::firstOrFail();

        $rules = [
            'manging_director_name'             => 'nullable|string|max:255',
            'manging_director_designation'      => 'nullable|string|max:255',
            'manging_director_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'works_director_name'               => 'nullable|string|max:255',
            'works_director_designation'        => 'nullable|string|max:255',
            'works_director_image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'technical_director_name'           => 'nullable|string|max:255',
            'technical_director_designation'    => 'nullable|string|max:255',
            'technical_director_image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'director_name'                     => 'nullable|string|max:255',
            'director_designation'              => 'nullable|string|max:255',
            'director_image'                    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'gm_operations_one_name'            => 'nullable|string|max:255',
            'gm_operations_one_designation'     => 'nullable|string|max:255',
            'gm_operations_one_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'gm_operations_two_name'            => 'nullable|string|max:255',
            'gm_operations_two_designation'     => 'nullable|string|max:255',
            'gm_operations_two_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'works_director_and_technical_director_name'        => 'nullable|string|max:255',
            'works_director_and_technical_director_designation' => 'nullable|string|max:255',
            'works_director_and_technical_director_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $validated = $request->validate($rules);

        // Handle images FIRST, store paths in array
        $imageFields = [
            'manging_director_image',
            'works_director_image',
            'technical_director_image',
            'director_image',
            'gm_operations_one_image',
            'gm_operations_two_image',
            'works_director_and_technical_director_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image
                if ($teamtests->$field && file_exists(public_path($teamtests->$field))) {
                    @unlink(public_path($teamtests->$field));
                }

                // Upload new image
                $file     = $request->file($field);
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path     = 'uploads/team';
                $file->move(public_path($path), $filename);

                // Add to validated array so fill() will pick it up
                $validated[$field] = $path . '/' . $filename;
            }
        }

        // Update all fields at once
        $teamtests->update($validated);

        return redirect()->back()->with('success', 'Team structure updated successfully!');
    }

    
    
}