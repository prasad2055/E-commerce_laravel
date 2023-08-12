<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);

        return view('back.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        Brand::create($validated);

        flash('Brand Created.')->success();

        return redirect()->route('back.brands.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('back.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $brand->update($validated);

        flash('Brand Updated.')->success();

        return redirect()->route('back.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
       $brand->delete();

       flash('Brand Removed.')->success();

        return redirect()->route('back.brands.index');
    }
}
