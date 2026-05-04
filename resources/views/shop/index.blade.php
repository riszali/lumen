@extends('layouts.app')

@section('title', 'Koleksi Gear | WILLSPORTS')

@section('content')

<!-- Font Khusus Sports Premium: Bebas Neue (Headline) & Montserrat (Body) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* RESET & TEMA PREMIUM SPORTS MINIMALIST */
    :root {
        --volt: #ccff00;      /* Neon Green Khas Sports */
        --dark: #050505;      /* Sangat Hitam / Deep Black */
        --card-bg: #0c0c0c;   /* Dark Grey untuk Card */
        --border: rgba(255, 255, 255, 0.08);
    }

    body {
        background-color: var(--dark) !important;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
    }

    .font-bebas {
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 0.02em;
        line-height: 0.95;
    }

    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }

    .text-volt { color: var(--volt); }
    .bg-volt { background-color: var(--volt); }
    .border-volt { border-color: var(--volt); }

    /* Desain Card Baru: Solid, Gelap, Premium (Tanpa Sudut Terlalu Melengkung) */
    .premium-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 4px; /* Sudut lebih tajam */
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        transition: all 0.4s ease;
    }
    .premium-card:hover {
        border-color: rgba(204, 255, 0, 0.3);
        box-shadow: 0 20px 50px rgba(0,0,0,0.9), 0 0 20px rgba(204, 255, 0, 0.05);
        transform: translateY(-5px);
    }

    /* Efek Noise Kasar di Background */
    .bg-noise {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
    }

    /* Custom Input Select */
    select option {
        background-color: #0c0c0c;
        color: #fff;
    }
</style>

<!-- =========================================
     1. HERO BANNERS (SPORTY)
     ========================================= -->
<section class="relative w-full pt-32 pb-20 flex items-center justify-center overflow-hidden bg-[var(--dark)] border-b border-white/5">
    <!-- Latar Belakang & Glowing Orbs -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" class="w-full h-full object-cover opacity-20 filter grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/60 to-[#050505]/80"></div>
    </div>

    <!-- Cahaya Pendar Halus -->
    <div class="absolute top-[20%] right-[10%] w-[30%] h-[40%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-20 w-full max-w-[1400px] mx-auto px-4 flex flex-col items-center text-center">
        
        <!-- KICKER CLEAN TANPA KAPSUL / TITIK AI -->
        <div class="border-b-2 border-volt pb-2 px-2 inline-block mb-6">
            <span class="text-white font-montserrat font-bold tracking-[0.3em] uppercase text-xs sm:text-sm">
                WILLSPORTS <span class="text-volt mx-2">//</span> OFFICIAL STORE
            </span>
        </div>
        
        <h1 class="font-bebas text-6xl md:text-8xl text-white tracking-wide drop-shadow-2xl">
            ELITE <span class="text-volt">COLLECTION</span>
        </h1>
        <p class="text-gray-400 font-montserrat text-sm md:text-base font-light max-w-xl mx-auto leading-relaxed mt-4">
            Temukan perlengkapan padel dan performa olahraga kelas atas. Persenjatai dirimu untuk mendominasi setiap pertandingan.
        </p>
    </div>
</section>

<!-- =========================================
     2. SHOP CONTENT (GRID & FILTERS)
     ========================================= -->
<section class="relative w-full bg-[var(--dark)] py-12 lg:py-20 z-20 min-h-screen bg-noise">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Toolbar (Filter & Sort) -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12 bg-[#0c0c0c] border border-white/10 rounded-sm p-4 sm:p-6 shadow-lg">
            
            <!-- Categories -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 w-full md:w-auto">
                <a href="{{ route('shop.index') }}" class="px-5 py-2.5 rounded-none font-montserrat text-[10px] sm:text-xs font-bold uppercase tracking-widest transition {{ !request('category') ? 'bg-volt text-black shadow-[3px_3px_0px_rgba(255,255,255,0.1)]' : 'text-gray-400 hover:text-white bg-black/50 border border-white/10 hover:border-volt hover:shadow-[3px_3px_0px_rgba(204,255,0,0.3)]' }}">
                    Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="px-5 py-2.5 rounded-none font-montserrat text-[10px] sm:text-xs font-bold uppercase tracking-widest transition {{ request('category') == $category->slug ? 'bg-volt text-black shadow-[3px_3px_0px_rgba(255,255,255,0.1)]' : 'text-gray-400 hover:text-white bg-black/50 border border-white/10 hover:border-volt hover:shadow-[3px_3px_0px_rgba(204,255,0,0.3)]' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Sort -->
            <div class="w-full md:w-auto flex justify-center md:justify-end">
                <form action="{{ route('shop.index') }}" method="GET" class="flex items-center gap-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <label for="sort" class="text-xs text-gray-500 font-montserrat uppercase tracking-widest hidden sm:block font-bold">Urutkan:</label>
                    <div class="relative">
                        <select name="sort" id="sort" onchange="this.form.submit()" class="bg-[#050505] border border-white/10 text-white font-montserrat font-semibold text-[10px] sm:text-xs rounded-none focus:ring-volt focus:border-volt block w-full py-3 pl-5 pr-12 appearance-none cursor-pointer outline-none transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-volt">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @php
            // Memisahkan Produk Gear dan Suplemen
            $gearProducts = $products->filter(function($product) {
                return optional($product->category)->slug !== 'supplements';
            });
            $supplementProducts = $products->filter(function($product) {
                return optional($product->category)->slug === 'supplements';
            });
        @endphp

        @if($products->count() > 0)
            
            <!-- BAGIAN 1: GEAR PRODUCTS -->
            @if($gearProducts->count() > 0)
                <div class="mb-8 border-b-2 border-volt pb-2 inline-block">
                    <h2 class="font-bebas text-4xl text-white tracking-wide uppercase">PERFORMANCE <span class="text-volt">GEAR</span></h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                    @foreach($gearProducts as $product)
                    <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                        
                        <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-[4/5] bg-black">
                            @if($product->primaryImage)
                                <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-110 group-hover:opacity-80 transition-all duration-700">
                            @else
                                <div class="w-full h-full bg-[#111] flex items-center justify-center text-white/20 font-montserrat text-[10px] uppercase tracking-widest font-bold">No Image</div>
                            @endif
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c] via-transparent to-transparent opacity-90"></div>
                            
                            @if($product->is_featured)
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10">
                                    <span class="bg-volt text-black font-montserrat text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-none shadow-md border border-[#000]">Populer</span>
                                </div>
                            @endif
                        </a>
                        
                        <div class="px-4 sm:px-6 pb-6 pt-2 flex-grow flex flex-col justify-end relative z-10 bg-[#0c0c0c]">
                            <h4 class="text-white font-bebas text-2xl sm:text-3xl tracking-wide mb-1 sm:mb-2 transition group-hover:text-volt line-clamp-2 leading-none">
                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                            </h4>
                            <p class="text-gray-500 font-montserrat text-[9px] sm:text-[10px] font-bold uppercase tracking-widest mb-3">
                                {{ $product->category->name ?? 'Gear' }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/10">
                                <p class="text-volt font-montserrat text-xs sm:text-sm font-bold tracking-wider">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="w-8 h-8 rounded-sm border border-white/10 bg-white/5 flex items-center justify-center group-hover:bg-volt group-hover:border-volt group-hover:text-black text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- BAGIAN 2: SUPPLEMENT PRODUCTS & BANNER -->
            @if($supplementProducts->count() > 0)
                
                <!-- Banner Pemisah Suplemen -->
                <div class="{{ $gearProducts->count() > 0 ? 'mt-24' : '' }} mb-10 relative overflow-hidden bg-[#0c0c0c] border border-white/10 rounded-sm shadow-2xl group">
                    <div class="absolute inset-0 z-0">
                        <!-- Background khusus banner suplemen -->
                        <img src="https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=2000" class="w-full h-full object-cover opacity-20 filter grayscale transition duration-700 group-hover:opacity-30 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#050505] via-[#050505]/80 to-transparent"></div>
                    </div>
                    
                    <div class="relative z-10 p-8 md:p-14 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <div class="border-b-2 border-volt pb-1 inline-block mb-3">
                                <span class="text-volt font-montserrat font-bold tracking-[0.2em] uppercase text-[10px]">
                                    // RECHARGE & RECOVER
                                </span>
                            </div>
                            <h2 class="font-bebas text-5xl md:text-7xl text-white tracking-wide uppercase drop-shadow-md">
                                PURE <span class="text-volt">FUEL</span>
                            </h2>
                            <p class="text-gray-400 font-montserrat text-xs md:text-sm font-light max-w-md mt-2 leading-relaxed">
                                Nutrisi esensial untuk menjaga intensitas pukulan dan kecepatan kaki Anda dari set pertama hingga akhir.
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-20 h-20 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Grid Suplemen -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                    @foreach($supplementProducts as $product)
                    <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                        
                        <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-[4/5] bg-black">
                            @if($product->primaryImage)
                                <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-110 group-hover:opacity-80 transition-all duration-700">
                            @else
                                <div class="w-full h-full bg-[#111] flex items-center justify-center text-white/20 font-montserrat text-[10px] uppercase tracking-widest font-bold">No Image</div>
                            @endif
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c] via-transparent to-transparent opacity-90"></div>
                            
                            @if($product->is_featured)
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10">
                                    <span class="bg-volt text-black font-montserrat text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-none shadow-md border border-[#000]">Populer</span>
                                </div>
                            @endif
                        </a>
                        
                        <div class="px-4 sm:px-6 pb-6 pt-2 flex-grow flex flex-col justify-end relative z-10 bg-[#0c0c0c]">
                            <h4 class="text-white font-bebas text-2xl sm:text-3xl tracking-wide mb-1 sm:mb-2 transition group-hover:text-volt line-clamp-2 leading-none">
                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                            </h4>
                            <p class="text-gray-500 font-montserrat text-[9px] sm:text-[10px] font-bold uppercase tracking-widest mb-3">
                                {{ $product->category->name ?? 'Gear' }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/10">
                                <p class="text-volt font-montserrat text-xs sm:text-sm font-bold tracking-wider">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="w-8 h-8 rounded-sm border border-white/10 bg-white/5 flex items-center justify-center group-hover:bg-volt group-hover:border-volt group-hover:text-black text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination Keseluruhan -->
            @if($products->hasPages())
            <div class="mt-20 flex justify-center glass-pagination">
                {{ $products->links() }}
            </div>
            @endif

        @else
            <!-- State jika tidak ada produk -->
            <div class="text-center py-24 bg-[#0c0c0c] border border-white/10 rounded-sm shadow-[0_8px_32px_0_rgba(0,0,0,0.6)] max-w-2xl mx-auto">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <h3 class="font-bebas text-4xl text-white tracking-wide mb-2 uppercase">Gear Tidak Ditemukan</h3>
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-light mb-8 max-w-sm mx-auto">Coba sesuaikan filter pencarianmu atau kembali lagi nanti untuk koleksi terbaru kami.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-white text-black px-10 py-3.5 rounded-none uppercase tracking-widest text-[11px] font-bold hover:bg-volt hover:-translate-y-1 hover:shadow-[4px_4px_0px_rgba(204,255,0,0.3)] transition duration-300 border border-transparent hover:border-volt">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Menyesuaikan Styling Paginasi Default Laravel untuk Tema Gelap, Tajam & Neon -->
<style>
    .glass-pagination nav p { color: #888888; display: none; }
    .glass-pagination nav > div:first-child { display: none; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: #0c0c0c;
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border-radius: 0px !important; /* Buang rounded di paginasi */
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