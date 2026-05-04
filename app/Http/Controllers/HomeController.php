<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->take(4)
                            ->get();

        $newArrivals = Product::with('primaryImage')
                        ->where('is_active', true)
                        ->latest()
                        ->take(4)
                        ->get();

        // Ambil gambar banner dinamis dari database
        $banners = Banner::where('is_active', true)->latest()->get();

        return view('home', compact('featuredProducts', 'newArrivals', 'banners'));
    }
}
