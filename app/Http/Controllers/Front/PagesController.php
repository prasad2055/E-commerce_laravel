<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Summary of PagesController
 */
class PagesController extends Controller
{
    public function home() {
        $featured = Product::whereStatus('Active')
            ->whereFeatured('Yes')
            ->limit(4)
            ->get();

            $latest = Product::whereStatus('Active')
            ->latest()
            ->limit(4)
            ->get();

        return view('front.pages.home', compact('featured', 'latest'));
    }

    /**
     * Summary of category
     * @param Category $category
     * @return void
     */
    public  function category(Category $category) {
        $products = $category->products()->whereStatus('Active')->paginate(24);

        return view('front.pages.category', compact('category', 'products'));
    }

    /**
     * Summary of brand
     * @param Brand $brand
     * @return void
     */
    public  function brand(Brand $brand) {
        $products = $brand->products()->whereStatus('Active')->paginate(24);

        return view('front.pages.brand', compact('brand', 'products'));
    }

    public function search(Request $request) {
        $term = $request->term;

        $products = Product::whereStatus('Active')
            ->where(function($query) use ($term) {
                $query->where('name', 'like', '%'.$term.'%')
                    ->orWhereHas('category', function($query) use ($term) {
                        $query->where('name', 'like', '%'.$term.'%');
                })
                ->orWhereHas('brand', function($query) use ($term) {
                    $query->where('name', 'like', '%'.$term.'%');
                });
            })
            ->paginate(24);

        return view('front.pages.search', compact('term', 'products'));
    }

    public function product(Product $product) {
        if($product->status == 'Inactive') {
            abort(404);
        }

        $similars = Product::whereStatus('Active')
            ->whereCategoryId($product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('front.pages.product', compact('product', 'similars'));
    }
}
