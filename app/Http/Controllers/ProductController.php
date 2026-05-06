<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand; // <-- TAMBAHAN INI
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
        
        // --- TAMBAHAN INI: Ambil semua brand yang aktif ---
        $brands = \App\Models\Brand::where('is_active', true)->get();

        return view('shop.index', compact('products', 'categories', 'brands'));
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

    // --- TAMBAHAN FUNGSI BARU INI DI PALING BAWAH ---
    public function brand(Request $request, $slug)
    {
        // Cari brand berdasarkan slug di URL
        $brand = Brand::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Cari semua produk yang merknya sama dengan nama brand ini
        $query = Product::with('primaryImage')->where('is_active', true)->where('brand', $brand->name);

        // Filter Urutkan (Sorting)
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') $query->orderBy('price', 'asc');
            else if ($request->sort == 'price_desc') $query->orderBy('price', 'desc');
            else if ($request->sort == 'newest') $query->latest();
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->query());

        return view('shop.brand', compact('brand', 'products'));
    }
}