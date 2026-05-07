<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. FEATURED GEAR (Menampilkan produk unggulan KECUALI yang berkategori suplemen)
        $featuredProducts = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->whereHas('category', function ($query) {
                                $query->where('slug', '!=', 'supplements');
                            })
                            ->paginate(5);

        // 2. TOP SUPPLEMENTS (Menampilkan KHUSUS produk unggulan dari kategori suplemen)
        $featuredSupplements = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->whereHas('category', function ($query) {
                                $query->where('slug', 'supplements');
                            })
                            ->take(5) // Maksimal 5 agar pas dengan grid yang kita buat
                            ->get();

        // 3. NEW ARRIVALS
        $newArrivals = Product::with('primaryImage')
                        ->where('is_active', true)
                        ->latest()
                        ->take(4)
                        ->get();

        // 4. BANNERS
        $banners = Banner::where('is_active', true)->latest()->get();

        // Mengirimkan semua data (termasuk $featuredSupplements) ke view home.blade.php
        return view('home', compact('featuredProducts', 'featuredSupplements', 'newArrivals', 'banners'));
    }
}