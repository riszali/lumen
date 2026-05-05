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

        // Filter Pencarian (Search by name or brand)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter Kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter Urutkan (Sorting)
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') $query->orderBy('price', 'asc');
            else if ($request->sort == 'price_desc') $query->orderBy('price', 'desc');
            else if ($request->sort == 'newest') $query->latest();
        } else {
            $query->latest();
        }

        // Simpan semua parameter filter saat ganti halaman (pagination)
        $products = $query->paginate(12)->appends($request->query());
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