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

    /* Desain Card Baru: Glassmorphism & Rounded (Dioptimasi) */
    .premium-card {
        background-color: rgba(255, 255, 255, 0.03);
        /* OPTIMASI: Blur dikurangi agar ringan di GPU HP */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid var(--border);
        border-radius: 2rem; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        transition: all 0.4s ease;
        will-change: transform, box-shadow; /* Hardware Acceleration */
    }
    .premium-card:hover {
        border-color: rgba(204, 255, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.06);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6), 0 0 25px rgba(204, 255, 0, 0.1);
        transform: translateY(-5px);
    }

    /* Custom Scrollbar untuk Dropdown Custom */
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: var(--volt); }
</style>

<!-- =========================================
     1. HERO BANNERS (SPORTY)
     ========================================= -->
<section class="relative w-full pt-32 pb-20 flex items-center justify-center overflow-hidden bg-[var(--dark)] border-b border-white/5">
    <!-- Latar Belakang & Glowing Orbs -->
    <div class="absolute inset-0 z-0">
        <!-- OPTIMASI: Tambahkan loading lazy/preload jika memungkinkan -->
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" class="w-full h-full object-cover opacity-20 filter grayscale" loading="eager" decoding="async">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/60 to-[#050505]/80"></div>
    </div>

    <!-- Cahaya Pendar Halus -->
    <!-- OPTIMASI: Sembunyikan blur besar ini di mobile (hidden md:block) dan kurangi blurnya -->
    <div class="hidden md:block absolute top-[20%] right-[10%] w-[30%] h-[40%] bg-volt rounded-full filter blur-[100px] opacity-10 pointer-events-none z-0 transform translate-z-0"></div>

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
<!-- OPTIMASI: Hapus kelas .bg-noise yang sangat memberatkan performa -->
<section class="relative w-full bg-[var(--dark)] py-12 lg:py-20 z-20 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Toolbar (Filter & Sort) - CUSTOM DROPDOWN -->
        <div class="mb-12 relative z-50 bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-4 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <form id="filter_form" action="{{ route('shop.index') }}" method="GET" class="w-full flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-6">
                
                <!-- CUSTOM Category Filter -->
                <div class="relative w-full" id="custom-category-dropdown">
                    <!-- Hidden input to store actual value -->
                    <input type="hidden" name="category" id="category_input" value="{{ request('category') }}">
                    
                    <button type="button" onclick="toggleCategoryFilter()" class="bg-black/20 backdrop-blur-md border border-white/10 text-white font-montserrat font-bold text-[10px] sm:text-xs rounded-full flex items-center justify-between w-full py-3.5 sm:py-4 px-4 sm:px-5 transition shadow-inner hover:border-volt focus:outline-none">
                        <div class="flex items-center">
                            <span class="text-gray-500 mr-3">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            </span>
                            <span id="category_text" class="uppercase">
                                @php
                                    $catName = 'SEMUA KATEGORI';
                                    foreach($categories as $c) {
                                        if(request('category') == $c->slug) $catName = strtoupper($c->name);
                                    }
                                    echo $catName;
                                @endphp
                            </span>
                        </div>
                        <span class="text-volt">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>

                    <!-- Dropdown Options Box -->
                    <ul id="category_options" class="hidden absolute top-full left-0 w-full mt-2 bg-[#0c0c0c]/95 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.8)] py-2 z-[60] custom-scroll max-h-60 overflow-y-auto">
                        <li class="px-5 py-3 text-[10px] sm:text-xs font-bold font-montserrat tracking-widest text-gray-400 hover:text-black hover:bg-volt cursor-pointer transition uppercase" onclick="selectCategoryFilter('', 'SEMUA KATEGORI')">
                            SEMUA KATEGORI
                        </li>
                        @foreach($categories as $category)
                            <li class="px-5 py-3 text-[10px] sm:text-xs font-bold font-montserrat tracking-widest text-gray-400 hover:text-black hover:bg-volt cursor-pointer transition uppercase border-t border-white/5" onclick="selectCategoryFilter('{{ $category->slug }}', '{{ strtoupper($category->name) }}')">
                                {{ strtoupper($category->name) }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- CUSTOM Sort Combo -->
                <div class="relative w-full" id="custom-sort-dropdown">
                    <input type="hidden" name="sort" id="sort_input" value="{{ request('sort', 'newest') }}">
                    
                    <button type="button" onclick="toggleSortFilter()" class="bg-black/20 backdrop-blur-md border border-white/10 text-white font-montserrat font-bold text-[10px] sm:text-xs rounded-full flex items-center justify-between w-full py-3.5 sm:py-4 px-4 sm:px-5 transition shadow-inner hover:border-volt focus:outline-none">
                        <div class="flex items-center">
                            <span class="text-gray-500 mr-3">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                            </span>
                            <span id="sort_text" class="uppercase">
                                @if(request('sort') == 'price_asc') TERMURAH
                                @elseif(request('sort') == 'price_desc') TERMAHAL
                                @else TERBARU
                                @endif
                            </span>
                        </div>
                        <span class="text-volt">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>

                    <!-- Dropdown Options Box -->
                    <ul id="sort_options" class="hidden absolute top-full left-0 w-full mt-2 bg-[#0c0c0c]/95 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.8)] py-2 z-[60]">
                        <li class="px-5 py-3 text-[10px] sm:text-xs font-bold font-montserrat tracking-widest text-gray-400 hover:text-black hover:bg-volt cursor-pointer transition uppercase" onclick="selectSortFilter('newest', 'TERBARU')">TERBARU</li>
                        <li class="px-5 py-3 text-[10px] sm:text-xs font-bold font-montserrat tracking-widest text-gray-400 hover:text-black hover:bg-volt cursor-pointer transition uppercase border-t border-white/5" onclick="selectSortFilter('price_asc', 'TERMURAH')">TERMURAH</li>
                        <li class="px-5 py-3 text-[10px] sm:text-xs font-bold font-montserrat tracking-widest text-gray-400 hover:text-black hover:bg-volt cursor-pointer transition uppercase border-t border-white/5" onclick="selectSortFilter('price_desc', 'TERMAHAL')">TERMAHAL</li>
                    </ul>
                </div>

            </form>
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
                <div class="mb-8 border-b-2 border-volt pb-2 inline-block relative z-10">
                    <h2 class="font-bebas text-4xl text-white tracking-wide uppercase">PERFORMANCE <span class="text-volt">GEAR</span></h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative z-10">
                    @foreach($gearProducts as $product)
                    <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                        
                        <!-- Header Image Card -->
                        <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-black/50 m-2 rounded-[1.5rem]">
                            @if($product->primaryImage)
                                <!-- OPTIMASI: Tambahkan loading="lazy" decoding="async" -->
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
                        
                        <!-- Detail Info -->
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
            @endif

            <!-- BAGIAN 2: SUPPLEMENT PRODUCTS & BANNER -->
            @if($supplementProducts->count() > 0)
                
                <!-- Banner Pemisah Suplemen -->
                <div class="{{ $gearProducts->count() > 0 ? 'mt-24' : '' }} mb-10 relative overflow-hidden bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] group z-10">
                    <div class="absolute inset-0 z-0">
                        <!-- OPTIMASI: Lazy load banner suplemen -->
                        <img src="https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=2000" loading="lazy" decoding="async" class="w-full h-full object-cover opacity-20 filter grayscale transition duration-700 group-hover:opacity-30 group-hover:scale-105">
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
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative z-10">
                    @foreach($supplementProducts as $product)
                    <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                        
                        <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-black/50 m-2 rounded-[1.5rem]">
                            @if($product->primaryImage)
                                <!-- OPTIMASI: Tambahkan loading="lazy" decoding="async" -->
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
            @endif

            <!-- Pagination Keseluruhan -->
            @if($products->hasPages())
            <div class="mt-20 flex justify-center glass-pagination relative z-10">
                {{ $products->links() }}
            </div>
            @endif

        @else
            <!-- State jika tidak ada produk -->
            <div class="text-center py-24 bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] max-w-2xl mx-auto relative z-10">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <h3 class="font-bebas text-4xl text-white tracking-wide mb-2 uppercase">Gear Tidak Ditemukan</h3>
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-light mb-8 max-w-sm mx-auto">Coba sesuaikan filter pencarianmu atau kembali lagi nanti untuk koleksi terbaru kami.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-white text-black px-10 py-4 rounded-full uppercase tracking-widest text-[11px] font-bold hover:bg-volt hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(204,255,0,0.4)] transition duration-300 border border-transparent hover:border-volt">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Script Custom Dropdown -->
<script>
    function toggleCategoryFilter() {
        document.getElementById('category_options').classList.toggle('hidden');
        document.getElementById('sort_options').classList.add('hidden');
    }

    function selectCategoryFilter(value, text) {
        document.getElementById('category_input').value = value;
        document.getElementById('category_text').innerText = text;
        document.getElementById('category_options').classList.add('hidden');
        document.getElementById('filter_form').submit(); // Otomatis submit setelah pilih
    }

    function toggleSortFilter() {
        document.getElementById('sort_options').classList.toggle('hidden');
        document.getElementById('category_options').classList.add('hidden');
    }

    function selectSortFilter(value, text) {
        document.getElementById('sort_input').value = value;
        document.getElementById('sort_text').innerText = text;
        document.getElementById('sort_options').classList.add('hidden');
        document.getElementById('filter_form').submit(); // Otomatis submit setelah pilih
    }

    // Menutup dropdown jika user klik di luar area combobox
    document.addEventListener('click', function(event) {
        const catDropdown = document.getElementById('custom-category-dropdown');
        if (catDropdown && !catDropdown.contains(event.target)) {
            document.getElementById('category_options').classList.add('hidden');
        }

        const sortDropdown = document.getElementById('custom-sort-dropdown');
        if (sortDropdown && !sortDropdown.contains(event.target)) {
            document.getElementById('sort_options').classList.add('hidden');
        }
    });
</script>

<!-- Menyesuaikan Styling Paginasi Default Laravel untuk Tema Gelap, Tajam & Neon -->
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