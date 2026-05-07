<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. FEATURED GEAR (Semua produk featured KECUALI kategori supplements)
        $featuredProducts = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->whereHas('category', function ($query) {
                                $query->where('slug', '!=', 'supplements');
                            })
                            ->paginate(5);

        // 2. FEATURED SUPPLEMENTS (HANYA produk featured dari kategori supplements)
        $featuredSupplements = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->whereHas('category', function ($query) {
                                $query->where('slug', 'supplements');
                            })
                            ->take(5)
                            ->get();

        // 3. NEW ARRIVALS
        $newArrivals = Product::with('primaryImage')
                        ->where('is_active', true)
                        ->latest()
                        ->take(4)
                        ->get();

        // 4. BANNERS
        $banners = Banner::where('is_active', true)->latest()->get();

        return view('home', compact('featuredProducts', 'featuredSupplements', 'newArrivals', 'banners'));
    }
}