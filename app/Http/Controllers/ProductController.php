<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('primaryImage')->where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') $query->orderBy('price', 'asc');
            if ($request->sort == 'price_desc') $query->orderBy('price', 'desc');
            if ($request->sort == 'newest') $query->latest();
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['images', 'variants', 'category'])
                    ->where('slug', $slug)
                    ->where('is_active', true)
                    ->firstOrFail();

        $relatedProducts = Product::with('primaryImage')
                            ->where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->where('is_active', true)
                            ->take(4)
                            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
