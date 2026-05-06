@extends('layouts.app')

@section('title', $brand->name . ' Collection | WILLSPORTS')

@section('content')

<!-- Font Khusus Sports Premium: Bebas Neue (Headline) & Montserrat (Body) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* RESET & TEMA PREMIUM SPORTS MINIMALIST */
    :root {
        --volt: #ccff00;      
        --dark: #050505;      
    }
    body {
        background-color: var(--dark) !important;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
    }
    .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.02em; line-height: 0.95; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    .text-volt { color: var(--volt); }
    .bg-volt { background-color: var(--volt); }

    .premium-card {
        background-color: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 2rem; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        transition: all 0.4s ease;
    }
    .premium-card:hover {
        border-color: rgba(204, 255, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.06);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6), 0 0 25px rgba(204, 255, 0, 0.1);
        transform: translateY(-5px);
    }
</style>

<!-- 1. BRAND HERO BANNER (CLEAN Tanpa Teks Overlay) -->
<!-- Tinggi disesuaikan agar proporsional menampilkan banner -->
<section class="relative w-full h-[40vh] md:h-[60vh] flex items-center justify-center overflow-hidden bg-[#0a0a0a] border-b border-white/5 pt-navbar">
    <div class="absolute inset-0 z-0 pt-navbar">
        @if($brand->banner_path)
            <!-- Opacity 100% agar banner dari admin terlihat jelas & cerah -->
            <img src="{{ Storage::url($brand->banner_path) }}" alt="{{ $brand->name }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-[#111] flex items-center justify-center">
                <span class="font-bebas text-6xl text-white/20">{{ $brand->name }}</span>
            </div>
        @endif
        
        <!-- Gradient sangat tipis hanya di bagian bawah untuk transisi halus ke section selanjutnya -->
        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-[var(--dark)] to-transparent pointer-events-none"></div>
    </div>
</section>

<!-- 2. PRODUCT GRID & BRAND INFO -->
<section class="relative w-full bg-[var(--dark)] py-12 lg:py-16 z-20 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- BRAND DESCRIPTION (Teks Deskripsi ditaruh paling atas) -->
        <div class="mb-8 max-w-4xl">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-[2px] bg-volt"></span>
                <span class="text-volt font-montserrat font-bold tracking-[0.2em] uppercase text-[10px] sm:text-xs">
                    OFFICIAL BRAND PARTNER
                </span>
            </div>
            <h2 class="font-bebas text-4xl sm:text-6xl text-white tracking-wide uppercase mb-4">{{ $brand->name }}</h2>
            
            @if($brand->description)
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm leading-relaxed font-light">
                    {{ $brand->description }}
                </p>
            @endif
        </div>

        <!-- CLIENT CUSTOM FILTER & SEARCH BAR -->
        <div class="mb-12 pb-8 border-b border-white/10">
            <form id="filter_form" action="{{ route('brand.show', $brand->slug) }}" method="GET" class="w-full flex flex-col md:flex-row gap-3 bg-[#0a0a0a] p-3 rounded-3xl border border-white/10 shadow-inner">
                
                <!-- Search Input -->
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari gear andalanmu..." class="w-full pl-12 pr-4 py-4 bg-white text-gray-900 font-montserrat font-bold text-[13px] rounded-2xl focus:outline-none focus:ring-2 focus:ring-volt placeholder-gray-500 transition-shadow">
                </div>

                <!-- Category Dropdown -->
                <div class="relative w-full md:w-[300px] flex-shrink-0">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <select name="category" onchange="this.form.submit()" class="w-full pl-12 pr-10 py-4 bg-white text-gray-900 font-montserrat font-bold text-[13px] uppercase tracking-wider rounded-2xl appearance-none focus:outline-none focus:ring-2 focus:ring-volt cursor-pointer truncate transition-shadow">
                        <option value="">SEMUA KATEGORI</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <!-- Sort Button (Menyatu dengan opsi) -->
                <div class="relative flex-shrink-0">
                    <!-- Dropdown Sort tersembunyi sebagai pemicu (transparent di atas tombol) -->
                    <select name="sort" onchange="this.form.submit()" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" title="Urutkan Produk">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                    
                    <button type="button" class="w-full md:w-[56px] h-[56px] bg-white rounded-2xl flex items-center justify-center text-gray-900 hover:bg-gray-100 transition-colors focus:outline-none">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <!-- Icon Sort persis seperti di gambar -->
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h9M4 12h7M4 18h5m6-4l3-3m0 0l3 3m-3-3v10"></path>
                        </svg>
                        <span class="md:hidden ml-2 font-montserrat font-bold text-[13px]">URUTKAN</span>
                    </button>
                </div>

                <!-- Tombol Submit Tersembunyi (Biar bisa search pake Enter) -->
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative z-10">
                @foreach($products as $product)
                <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                    <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-black/50 m-2 rounded-[1.5rem]">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center group-hover:scale-110 group-hover:opacity-80 transition-all duration-700">
                        @else
                            <div class="w-full h-full bg-[#111] flex items-center justify-center text-white/20 font-montserrat text-[10px] uppercase tracking-widest font-bold">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c]/80 via-transparent to-transparent opacity-90 pointer-events-none"></div>
                        @if($product->is_featured)
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10">
                                <span class="bg-volt text-black font-montserrat text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest px-3.5 py-1.5 rounded-full shadow-md border border-[#000]">Populer</span>
                            </div>
                        @endif
                    </a>
                    <div class="px-4 sm:px-5 pb-5 pt-2 flex-grow flex flex-col justify-end relative z-10 bg-transparent">
                        <h4 class="text-white font-bebas text-2xl sm:text-3xl tracking-wide mb-1 sm:mb-2 transition group-hover:text-volt line-clamp-2 leading-none">
                            <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                        </h4>
                        <p class="text-gray-400 font-montserrat text-[9px] sm:text-[10px] font-bold uppercase tracking-widest mb-3">
                            {{ $product->category->name ?? 'Gear' }}
                        </p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/10">
                            <p class="text-volt font-montserrat text-xs sm:text-sm font-bold tracking-wider">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="w-8 h-8 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm flex items-center justify-center group-hover:bg-volt group-hover:border-volt group-hover:text-black text-white transition-colors duration-300">
                                <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($products->hasPages())
            <div class="mt-20 flex justify-center glass-pagination relative z-10">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-24 bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] max-w-2xl mx-auto relative z-10">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <h3 class="font-bebas text-4xl text-white tracking-wide mb-2 uppercase">Koleksi Belum Tersedia</h3>
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-light mb-8 max-w-sm mx-auto">
                    Produk untuk pencarian ini sedang tidak tersedia atau kehabisan stok.
                </p>
                <a href="{{ route('brand.show', $brand->slug) }}" class="inline-block bg-white text-black px-10 py-4 rounded-full uppercase tracking-widest text-[11px] font-bold hover:bg-volt hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(204,255,0,0.4)] transition duration-300 border border-transparent hover:border-volt">
                    Reset Pencarian
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Menyesuaikan Styling Paginasi Default Laravel -->
<style>
    .glass-pagination nav p { color: #888888; display: none; }
    .glass-pagination nav > div:first-child { display: none; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border-radius: 9999px !important; 
    }
    .glass-pagination nav a:hover { 
        background-color: rgba(204, 255, 0, 0.1); 
        border-color: var(--volt);
        color: var(--volt);
    }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: var(--volt) !important;
        border-color: var(--volt) !important;
        color: #000000 !important;
    }
</style>

@endsection