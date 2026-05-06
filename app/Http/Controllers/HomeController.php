<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Menggunakan paginate(5) agar tampil 5 item sebaris dan mengaktifkan fitur paginasi
        $featuredProducts = Product::with('primaryImage')
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->paginate(5);

        $newArrivals = Product::with('primaryImage')
                        ->where('is_active', true)
                        ->latest()
                        ->take(5)
                        ->get();

        // Ambil gambar banner dinamis dari database
        $banners = Banner::where('is_active', true)->latest()->get();

        return view('home', compact('featuredProducts', 'newArrivals', 'banners'));
    }
}