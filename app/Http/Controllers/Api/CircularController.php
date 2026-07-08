<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Circular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CircularController extends Controller
{
    // Fetch all circulars
    public function index()
    {
        $circulars = Circular::all();
        return response()->json([
            'status' => 'success',
            'data' => $circulars,
        ], 200);
    }
    
   
    public function show($id)
    {
        $circular = Circular::find($id);

        if (!$circular) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $circular,
        ], 200);
    }

    // Create a new circular
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
        ]);

        try {
            $imagePath = $request->file('image')->store('circular_images', 'public');

            $circular = Circular::create([
                'title' => $validated['title'],
                'image' => $imagePath,
                'description' => $validated['description'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Circular created successfully!',
                'data' => $circular,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update an existing circular
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
        ]);

        $circular = Circular::find($id);

        if (!$circular) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found.',
            ], 404);
        }

        try {
            if ($request->hasFile('image')) {
                if (Storage::exists('public/' . $circular->image)) {
                    Storage::delete('public/' . $circular->image);
                }

                $imagePath = $request->file('image')->store('circular_images', 'public');
                $circular->image = $imagePath;
            }

            $circular->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Circular updated successfully!',
                'data' => $circular,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete a circular
    public function destroy($id)
    {
        $circular = Circular::find($id);

        if (!$circular) {
            return response()->json([
                'status' => 'error',
                'message' => 'Circular not found.',
            ], 404);
        }

        try {
            if (Storage::exists('public/' . $circular->image)) {
                Storage::delete('public/' . $circular->image);
            }

            $circular->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Circular deleted successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
