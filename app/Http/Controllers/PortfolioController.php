<?php

namespace App\Http\Controllers;

use App\Models\StudentPortfolio;
use App\Models\PortfolioBanner;
use App\Models\StudentPortfolioHeading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{

    public function portfoliobanner()
    {
        $portfoliobanners = PortfolioBanner::all();
        return view('portfolio.banner', compact('portfoliobanners'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            $bgbanner = new PortfolioBanner;
            $bgbanner->image = $fileName;
            $bgbanner->save();
            return redirect()->back()->with('success', 'Banner created successfully.');
        }
        return redirect()->back()->with('error', 'File upload failed.');
    }

    public function portfoliobannerupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:webp|max:5000',
        ]);

        $bgbanner = PortfolioBanner::findOrFail($id);

        if ($request->hasFile('image')) {

            if (file_exists(public_path('images/' . $bgbanner->image))) {
                unlink(public_path('images/' . $bgbanner->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $bgbanner->image = $fileName;
        }

        $bgbanner->save();

        return redirect()->back()->with('success', 'Banner updated successfully.');
    }

    public function portfoliobannerdelete($id)
    {
        $bgbanner = PortfolioBanner::findOrFail($id);

        if (file_exists(public_path('images/' . $bgbanner->image))) {
            unlink(public_path('images/' . $bgbanner->image));
        }

        $bgbanner->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }

    #this new Portfolio function:
    public function index()
    {
        $portfolios = StudentPortfolio::all();
        $NewsEvents = StudentPortfolioHeading::all();

        view()->share('portfolios', $portfolios);
        view()->share('NewsEvents', $NewsEvents);
        return view('portfolio.currentportfolio', compact('portfolios', 'NewsEvents'));
    }

    public function headingstore(Request $request)
    {
        $validatedData = $request->validate([

            'heading' => 'required|string',
        ]);
        $NewsEvent = new StudentPortfolioHeading;
        $NewsEvent->heading = $validatedData['heading'];
        $NewsEvent->save();
        return redirect()->back()->with('success', 'Event created successfully.');
    }

    public function headingupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string|max:255',
        ]);
        $heading = StudentPortfolioHeading::findOrFail($id);

        $heading->heading = $validatedData['heading'];

        $heading->save();

        return redirect()->route('portfolio.index')->with('success', 'Heading updated successfully.');
    }

    public function destroyHeading($id)
    {
        $heading = StudentPortfolioHeading::findOrFail($id);
        $heading->delete();
        return redirect()->back()->with('success', 'Heading deleted successfully.');
    }

    public function store(Request $request)
    {
        Log::info('PortfolioController@store: Starting store method', [
            'request_ip' => $request->ip(),
            'form_data_keys' => array_keys($request->all()),
        ]);

        $uploadedFiles = [];
        $dbTransactionSuccess = false;

        try {
            DB::beginTransaction();

            // Validate static fields
            $validatedData = $request->validate([
                'student_name' => 'nullable|string|max:255',
                'project_name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'thumbnail' => 'nullable|image|mimes:webp|max:5000',
                'thumbnail2' => 'nullable|image|mimes:webp|max:5000',
                'filter_id' => 'nullable|integer|exists:filters,id',
            ]);

            $images = [];
            $contents = [];

            // Process up to 100 dynamic image/content pairs
            for ($index = 1; $index <= 100; $index++) {
                $imageField = "image$index";
                $contentField = "content$index";

                // Validate dynamic fields
                if ($request->hasFile($imageField)) {
                    $request->validate([$imageField => 'image|mimes:webp|max:5000']);
                }
                
                if ($request->filled($contentField)) {
                    $request->validate([$contentField => 'string']);
                }

                // Handle image upload
                if ($request->hasFile($imageField) && $request->file($imageField)->isValid()) {
                    $file = $request->file($imageField);
                    $imageName = time() . "_image_$index.webp"; // Force .webp extension
                    $file->move(public_path('images'), $imageName);
                    $images[$index] = $imageName;
                    $uploadedFiles[] = $imageName;
                }

                // Store content (maintain null for empty fields to preserve indexes)
                $contents[$index] = $request->input($contentField, null);
            }

            // Handle thumbnails
            foreach (['thumbnail', 'thumbnail2'] as $thumbField) {
                if ($request->hasFile($thumbField) && $request->file($thumbField)->isValid()) {
                    $file = $request->file($thumbField);
                    $name = time() . '_' . $thumbField . '.webp';
                    $file->move(public_path('images'), $name);
                    $validatedData[$thumbField] = $name;
                    $uploadedFiles[] = $name;
                }
            }

            // Prepare JSON data
            $validatedData['images'] = json_encode($images, JSON_FORCE_OBJECT);
            $validatedData['contents'] = json_encode($contents, JSON_FORCE_OBJECT);

            // Create portfolio entry
            $portfolio = StudentPortfolio::create($validatedData);
            
            if (!$portfolio) {
                throw new \Exception('Failed to create portfolio entry');
            }

            DB::commit();
            $dbTransactionSuccess = true;

            Log::info('Portfolio stored successfully', [
                'portfolio_id' => $portfolio->id,
                'images_count' => count(array_filter($images)),
                'contents_count' => count(array_filter($contents))
            ]);

            return redirect()->back()->with('success', 'Portfolio created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except(['thumbnail', 'thumbnail2', ...array_map(fn($i) => "image$i", range(1, 100))])
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Validation failed: ' . implode(', ', array_merge(...array_values($e->errors()))));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving portfolio', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'code' => $e->getCode()
            ]);

            // Cleanup only if DB transaction failed
            if (!$dbTransactionSuccess) {
                foreach ($uploadedFiles as $file) {
                    $filePath = public_path('images/' . $file);
                    if (file_exists($filePath)) {
                        try {
                            unlink($filePath);
                            Log::info("Cleaned up file: $file");
                        } catch (\Exception $cleanupEx) {
                            Log::error("Failed to cleanup file: $file", [
                                'message' => $cleanupEx->getMessage()
                            ]);
                        }
                    }
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error saving portfolio: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $portfolio = StudentPortfolio::findOrFail($id);

        $validatedData = $request->validate([
            'student_name' => 'nullable|string|max:255',
            'project_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'image|mimes:webp|max:5000',
            'thumbnail2' => 'image|mimes:webp|max:5000',
        ]);


        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail) {

                $oldThumbnailPath = public_path('images') . '/' . $portfolio->thumbnail;
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_thumbnail.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $thumbnailName);
            $validatedData['thumbnail'] = $thumbnailName;
        } else {

            $validatedData['thumbnail'] = $portfolio->thumbnail;
        }

        if ($request->hasFile('thumbnail2')) {
            if ($portfolio->thumbnail2) {

                $oldThumbnailPath = public_path('images') . '/' . $portfolio->thumbnail2;
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            $file = $request->file('thumbnail2');
            $thumbnailName = time() . '_thumbnail.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $thumbnailName);
            $validatedData['thumbnail2'] = $thumbnailName;
        } else {

            $validatedData['thumbnail2'] = $portfolio->thumbnail;
        }

        for ($i = 1; $i <= 8; $i++) {
            if ($request->hasFile("image$i") && $request->file("image$i")->isValid()) {

                if ($portfolio->{"image$i"}) {
                    $oldImagePath = public_path('images') . '/' . $portfolio->{"image$i"};
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file = $request->file("image$i");
                $imageName = time() . "_$i." . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $imageName);
                $validatedData["image$i"] = $imageName;
            } else {

                $validatedData["image$i"] = $portfolio->{"image$i"} ?? null;
            }

            $validatedData["content$i"] = $request->input("content$i");
        }

        try {
            $portfolio->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->route('portfolio.index')->with('error', 'Error updating portfolio: ' . $e->getMessage());
        }

        return redirect()->route('portfolio.index')->with('success', 'Portfolio updated successfully.');
    }

    public function destroy($id)
    {
        $studentPortfolio = StudentPortfolio::findOrFail($id);

        if ($studentPortfolio->thumbnail && file_exists(public_path('images/' . $studentPortfolio->thumbnail))) {
            try {
                unlink(public_path('images/' . $studentPortfolio->thumbnail));
            } catch (\Exception $e) {
                return redirect()->route('portfolio.index')->with('error', 'Error deleting thumbnail: ' . $e->getMessage());
            }
        }

        for ($i = 1; $i <= 8; $i++) {
            $imageField = 'image' . $i;
            if ($studentPortfolio->$imageField && file_exists(public_path('images/' . $studentPortfolio->$imageField))) {
                try {
                    unlink(public_path('images/' . $studentPortfolio->$imageField));
                } catch (\Exception $e) {
                    return redirect()->route('portfolio.index')->with('error', "Error deleting image $i: " . $e->getMessage());
                }
            }
        }

        try {
            $studentPortfolio->delete();
        } catch (\Exception $e) {
            return redirect()->route('portfolio.index')->with('error', 'Error deleting portfolio: ' . $e->getMessage());
        }

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item deleted successfully.');
    }

    public function GalleryFrontView(){
        return view('frontend.gallery.view');
    }
    public function GalleryEventFrontView(){
        return view('frontend.gallery.events');
    }

}
