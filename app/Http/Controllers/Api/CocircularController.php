<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cocirculars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CocircularController extends Controller
{
    // Fetch all circulars
    public function index()
    {
        $Cocirculars = Cocirculars::all();
        return response()->json([
            'status' => 'success',
            'data' => $Cocirculars
        ], 200);
    }

    // Fetch a specific circular
    public function show($id)
    {
        $Cocirculars = Cocirculars::find($id);

        if (!$Cocirculars) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $Cocirculars
        ], 200);
    }

    // Store a new circular
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
        ]);

        try {
            $imagePath = $request->file('image')->store('circular_images', 'public');

            $Cocirculars = Cocirculars::create([
                'title' => $request->title,
                'image' => $imagePath,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $Cocirculars
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Update an existing circular
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
        ]);

        $Cocirculars = Cocirculars::find($id);

        if (!$Cocirculars) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found'
            ], 404);
        }

        try {
            if ($request->hasFile('image')) {
                if (file_exists(public_path('storage/' . $Cocirculars->image))) {
                    unlink(public_path('storage/' . $Cocirculars->image));
                }

                $imagePath = $request->file('image')->store('circular_images', 'public');
                $Cocirculars->image = $imagePath;
            }

            $Cocirculars->title = $request->input('title');
            $Cocirculars->description = $request->input('description');
            $Cocirculars->save();

            return response()->json([
                'status' => 'success',
                'data' => $Cocirculars
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Delete a circular
    public function destroy($id)
    {
        $Cocirculars = Cocirculars::find($id);

        if (!$Cocirculars) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found'
            ], 404);
        }

        try {
            if (file_exists(public_path('storage/' .     $Cocirculars->image))) {
                unlink(public_path('storage/' . $Cocirculars->image));
            }

            $Cocirculars->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Circular deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
