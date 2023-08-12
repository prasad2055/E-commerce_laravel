<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('back.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'summary' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No',
            'pics' => 'required',
            'pics.*' => 'required|image'
        ]);

        foreach($validated['pics'] as $pic) {
            $img = Image::make($pic);
            $filename = "IMG".date('YmdHis').rand(1000,9999).".jpg";

            $img->resize(1280, 720, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path("images/{$filename}"));

            $validated['images'][] = $filename;
        }

        Product::create($validated);

        flash('Product Added.')->success();

        return redirect()->route('back.products.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('back.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'summary' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No',
            'pics' => 'sometimes',
        ]);

        $validated['image'] = $product->images;

        if($request->hasFile('pics')) {
            foreach($validated['pics'] as $pic) {
                $img = Image::make($pic);
                $filename = "IMG".date('YmdHis').rand(1000,9999).".jpg";

                $img->resize(1280, 720, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path("images/{$filename}"));

                $validated['images'][] = $filename;
            }
        }

        $product->update($validated);

        flash('Product Updated.')->success();

        return redirect()->route('back.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach($product->images as $image) {
            @unlink(public_path("images/{$image}"));
        }

        $product->delete();

        flash('Product Removed.')->success();

        return redirect()->route('back.products.index');
    }

    public function image(Product $product, string $filename) {
        $images = $product->images;

        if(count($images) > 1) {
            @unlink(public_path("images/{$filename}"));

            $new = [];

            foreach($images as $image) {
                if($image != $filename) {
                    $new[] = $image;
                }
            }

            $product->update(['images' => $new]);

            flash('Image removed.')->success();
        } else {
            flash('At least one image is neccessary.')->error();
        }

        return redirect()->route('back.products.edit', [$product->id]);
    }
}
