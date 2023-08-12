<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('back.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.categories.create');
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

        Category::create($validated);

        flash('Category Created.')->success();

        return redirect()->route('back.categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('back.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $category->update($validated);

        flash('Category Updated.')->success();

        return redirect()->route('back.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        flash('Category Removed.')->success();

        return redirect()->route('back.categories.index');
    }
}
