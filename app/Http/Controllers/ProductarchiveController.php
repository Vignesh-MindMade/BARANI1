<?php

namespace App\Http\Controllers;

use App\Models\productarchive;
use App\Models\ProductCatagory;
use Illuminate\Http\Request;

class ProductarchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productarchives = productarchive::all();
        return view('Backend.productarchives.index', compact('productarchives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCatagory::orderBy('catagory')->get();
        return view('Backend.productarchives.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'nullable|exists:product_catagory,id',
        ]);
        productarchive::create($request->all());
        return redirect()->route('productarchives.index')->with('success', 'Product Archive created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productarchive  $productarchive
     * @return \Illuminate\Http\Response
     */
    public function show(productarchive $productarchive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productarchive  $productarchive
     * @return \Illuminate\Http\Response
     */
    public function edit(productarchive $productarchive)
    {
        $categories = ProductCatagory::orderBy('catagory')->get();
        return view('Backend.productarchives.edit', compact('productarchive', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productarchive  $productarchive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productarchive $productarchive)
    {
        //
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'nullable|exists:product_catagory,id',
            ]);
            $productarchive->update($request->all());
            return redirect()->route('productarchives.index')->with('success', 'Product Archive updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productarchive  $productarchive
     * @return \Illuminate\Http\Response
     */
    public function destroy(productarchive $productarchive)
    {
        //
        $productarchive->delete();
        return redirect()->route('productarchives.index')->with('success', 'Product Archive deleted successfully.');
    }
}
