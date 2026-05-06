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

    /* Scrollbar untuk dropdown custom */
    .custom-dropdown-list::-webkit-scrollbar { width: 4px; }
    .custom-dropdown-list::-webkit-scrollbar-track { background: transparent; }
    .custom-dropdown-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
</style>

<!-- 1. BRAND HERO BANNER (CLEAN Tanpa Teks Overlay) -->
<section class="relative w-full h-[40vh] md:h-[60vh] flex items-center justify-center overflow-hidden bg-[#0a0a0a] border-b border-white/5 pt-navbar">
    <div class="absolute inset-0 z-0 pt-navbar">
        @if($brand->banner_path)
            <img src="{{ Storage::url($brand->banner_path) }}" alt="{{ $brand->name }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-[#111] flex items-center justify-center">
                <span class="font-bebas text-6xl text-white/20">{{ $brand->name }}</span>
            </div>
        @endif
        
        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-[var(--dark)] to-transparent pointer-events-none"></div>
    </div>
</section>

<!-- BRAND LOGO TRAY (Logos Below Centered Title) -->
@php $allBrands = \App\Models\Brand::where('is_active', true)->get(); @endphp
@if($allBrands->count() > 0)
<div class="w-full bg-[#080808] border-b border-white/5 py-12 overflow-hidden relative z-20 shadow-inner text-center">
    <div class="max-w-[1400px] mx-auto px-4">
        <h3 class="text-gray-500 font-montserrat text-[10px] uppercase font-bold tracking-[0.4em] mb-10">
            SHOP BY BRAND
        </h3>
        
        <div class="flex flex-wrap justify-center items-center gap-x-10 gap-y-8 sm:gap-x-16 sm:gap-y-12">
            @foreach($allBrands as $b)
                <a href="{{ route('brand.show', $b->slug) }}" class="group relative block transition duration-300 hover:-translate-y-1 {{ $b->id == $brand->id ? 'pointer-events-none' : '' }}" title="{{ $b->name }}">
                    @if($b->logo_path)
                        <img src="{{ Storage::url($b->logo_path) }}" alt="{{ $b->name }}" class="h-6 sm:h-8 w-auto max-w-[120px] object-contain transition-all duration-300 {{ $b->id == $brand->id ? 'opacity-100 filter-none' : 'opacity-40 grayscale group-hover:opacity-100 group-hover:grayscale-0' }} drop-shadow-sm">
                    @else
                        <span class="font-bebas text-2xl tracking-wide {{ $b->id == $brand->id ? 'text-volt' : 'text-gray-500 group-hover:text-white' }} transition-colors">{{ $b->name }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- 2. PRODUCT GRID & BRAND INFO -->
<section class="relative w-full bg-[var(--dark)] py-12 lg:py-16 z-20 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- BRAND DESCRIPTION -->
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

        <!-- CLIENT CUSTOM FILTER & SEARCH BAR (FIXED UI) -->
        <div class="mb-12 pb-8 border-b border-white/10">
            <form id="filter_form" action="{{ route('brand.show', $brand->slug) }}" method="GET" class="w-full flex flex-col md:flex-row gap-3 md:gap-4">
                
                <!-- Search Input -->
                <div class="relative flex-grow w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari gear andalanmu..." class="w-full pl-12 pr-4 h-[56px] bg-white text-gray-900 font-montserrat font-bold text-[13px] rounded-2xl focus:outline-none focus:ring-2 focus:ring-volt placeholder-gray-500 transition-shadow">
                </div>

                <!-- Wrapper Category & Sort (Bersebelahan di HP) -->
                <div class="flex flex-row gap-3 md:gap-4 w-full md:w-auto">
                    
                    <!-- CUSTOM Category Dropdown -->
                    <div class="relative flex-grow md:w-[280px]" id="cat_dropdown_wrapper">
                        <input type="hidden" name="category" id="cat_input" value="{{ request('category') }}">
                        <button type="button" onclick="toggleCatMenu()" class="w-full h-[56px] pl-12 pr-10 bg-white text-gray-900 font-montserrat font-bold text-[13px] uppercase tracking-wider rounded-2xl flex items-center justify-between shadow-sm focus:outline-none focus:ring-2 focus:ring-volt transition-all">
                            <div class="absolute left-4">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            </div>
                            <span id="cat_label" class="truncate">
                                {{ request('category') ? (\App\Models\Category::where('slug', request('category'))->first()->name ?? 'SEMUA KATEGORI') : 'SEMUA KATEGORI' }}
                            </span>
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Options Menu (Floating) -->
                        <div id="cat_menu" class="hidden absolute top-full left-0 w-full mt-2 bg-[#0c0c0c]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl z-[60] overflow-hidden">
                            <ul class="max-h-60 overflow-y-auto custom-dropdown-list py-2">
                                <li onclick="selectCat('', 'SEMUA KATEGORI')" class="px-5 py-3 text-[11px] font-bold text-gray-400 hover:text-white hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Semua Kategori</li>
                                @foreach(\App\Models\Category::all() as $cat)
                                    <li onclick="selectCat('{{ $cat->slug }}', '{{ $cat->name }}')" class="px-5 py-3 text-[11px] font-bold {{ request('category') == $cat->slug ? 'text-volt' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">{{ $cat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- CUSTOM Sort Dropdown -->
                    <div class="relative flex-shrink-0" id="sort_dropdown_wrapper">
                        <input type="hidden" name="sort" id="sort_input" value="{{ request('sort', 'newest') }}">
                        <button type="button" onclick="toggleSortMenu()" class="w-[56px] h-[56px] bg-white rounded-2xl flex items-center justify-center text-gray-900 hover:bg-gray-100 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-volt">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h9M4 12h7M4 18h5m6-4l3-3m0 0l3 3m-3-3v10"></path>
                            </svg>
                        </button>

                        <!-- Options Menu (Floating) -->
                        <div id="sort_menu" class="hidden absolute top-full right-0 w-48 mt-2 bg-[#0c0c0c]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl z-[60] overflow-hidden">
                            <ul class="py-2">
                                <li onclick="selectSort('newest')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'newest' || !request('sort') ? 'text-volt' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Terbaru</li>
                                <li onclick="selectSort('price_asc')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'price_asc' ? 'text-volt' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Harga Terendah</li>
                                <li onclick="selectSort('price_desc')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'price_desc' ? 'text-volt' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Harga Tertinggi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Hidden Submit -->
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

<!-- SCRIPT CUSTOM DROPDOWN -->
<script>
    function toggleCatMenu() {
        document.getElementById('cat_menu').classList.toggle('hidden');
        document.getElementById('sort_menu').classList.add('hidden');
    }
    function toggleSortMenu() {
        document.getElementById('sort_menu').classList.toggle('hidden');
        document.getElementById('cat_menu').classList.add('hidden');
    }
    function selectCat(slug, name) {
        document.getElementById('cat_input').value = slug;
        document.getElementById('filter_form').submit();
    }
    function selectSort(val) {
        document.getElementById('sort_input').value = val;
        document.getElementById('filter_form').submit();
    }
    // Tutup dropdown kalau klik di luar
    window.onclick = function(event) {
        if (!event.target.closest('#cat_dropdown_wrapper') && !event.target.closest('#sort_dropdown_wrapper')) {
            const catMenu = document.getElementById('cat_menu');
            const sortMenu = document.getElementById('sort_menu');
            if (catMenu) catMenu.classList.add('hidden');
            if (sortMenu) sortMenu.classList.add('hidden');
        }
    }
</script>

@endsection