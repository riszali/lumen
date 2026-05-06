@extends('layouts.app')

@section('title', 'Shop | WILLSPORTS')

@section('content')

<!-- Font Khusus Sports Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
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
        transition: all 0.4s ease;
    }
    .premium-card:hover {
        border-color: rgba(204, 255, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.06);
        box-shadow: 0 15px 40px rgba(0,0,0,0.5), 0 0 20px rgba(204, 255, 0, 0.1);
    }
</style>

<!-- 1. SHOP HERO BANNER -->
<section class="relative w-full h-[50vh] flex items-center justify-center overflow-hidden bg-[var(--dark)] border-b border-white/5 pt-navbar">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" class="w-full h-full object-cover opacity-20 filter grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/60 to-[#050505]/80"></div>
    </div>

    <!-- Cahaya Pendar -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60%] h-[60%] bg-[#ccff00] rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-20 w-full max-w-[1400px] mx-auto px-4 flex flex-col items-center text-center mt-6">
        <div class="border-b border-[#ccff00] pb-2 px-4 inline-block mb-4">
            <span class="text-white font-montserrat font-bold tracking-[0.3em] uppercase text-[10px] sm:text-xs">
                OFFICIAL GEAR <span class="text-[#ccff00] mx-2">//</span> TOURNAMENT SPEC
            </span>
        </div>
        
        <h1 class="font-bebas text-6xl md:text-8xl text-white tracking-wide drop-shadow-2xl">
            ELITE <span class="text-[#ccff00]">COLLECTION</span>
        </h1>
        <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-light max-w-xl mx-auto leading-relaxed mt-4 drop-shadow-md">
            Temukan perlengkapan padel dan performa olahraga kelas atas. Persenjatai dirimu untuk mendominasi setiap pertandingan.
        </p>
    </div>
</section>

<!-- BRAND LOGO TRAY (Logos Below Centered Title) -->
@if(isset($brands) && $brands->count() > 0)
<div class="w-full bg-[#080808] border-b border-white/5 py-12 overflow-hidden relative z-20 shadow-inner text-center">
    <div class="max-w-[1400px] mx-auto px-4">
        <!-- Judul di Tengah -->
        <h3 class="text-gray-500 font-montserrat text-[10px] uppercase font-bold tracking-[0.4em] mb-10">
            SHOP BY BRAND
        </h3>
        
        <!-- Barisan Logo di Bawah Judul -->
        <div class="flex flex-wrap justify-center items-center gap-x-10 gap-y-8 sm:gap-x-16 sm:gap-y-12">
            @foreach($brands as $brand)
                <a href="{{ route('brand.show', $brand->slug) }}" class="group relative block transition duration-300 hover:-translate-y-1" title="{{ $brand->name }}">
                    @if($brand->logo_path)
                        <img src="{{ Storage::url($brand->logo_path) }}" alt="{{ $brand->name }}" class="h-6 sm:h-8 w-auto max-w-[120px] object-contain opacity-50 group-hover:opacity-100 transition-all duration-300 filter grayscale group-hover:grayscale-0 drop-shadow-sm">
                    @else
                        <span class="font-bebas text-2xl text-gray-500 group-hover:text-white transition-colors tracking-wide">{{ $brand->name }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- 2. SHOP CONTENT (GRID & FILTERS) -->
<section class="relative w-full bg-[var(--dark)] py-12 lg:py-20 z-20 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- CLIENT CUSTOM FILTER & SEARCH BAR (FIXED UI) -->
        <div class="mb-12 pb-8 border-b border-white/10">
            <form id="filter_form" action="{{ route('shop.index') }}" method="GET" class="w-full flex flex-col md:flex-row gap-3 md:gap-4">
                
                <!-- Search Input -->
                <div class="relative flex-grow w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari gear andalanmu..." class="w-full pl-12 pr-4 h-[56px] bg-white text-gray-900 font-montserrat font-bold text-[13px] rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#ccff00] placeholder-gray-500 transition-shadow">
                </div>

                <!-- Wrapper Category & Sort (Bersebelahan di HP) -->
                <div class="flex flex-row gap-3 md:gap-4 w-full md:w-auto">
                    
                    <!-- CUSTOM Category Dropdown -->
                    <div class="relative flex-grow md:w-[280px]" id="cat_dropdown_wrapper">
                        <input type="hidden" name="category" id="cat_input" value="{{ request('category') }}">
                        <button type="button" onclick="toggleCatMenu()" class="w-full h-[56px] pl-12 pr-10 bg-white text-gray-900 font-montserrat font-bold text-[13px] uppercase tracking-wider rounded-2xl flex items-center justify-between shadow-sm focus:outline-none focus:ring-2 focus:ring-[#ccff00] transition-all">
                            <div class="absolute left-4">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            </div>
                            <span id="cat_label" class="truncate">
                                {{ request('category') ? collect($categories)->firstWhere('slug', request('category'))->name ?? 'SEMUA KATEGORI' : 'SEMUA KATEGORI' }}
                            </span>
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Options Menu (Floating) -->
                        <div id="cat_menu" class="hidden absolute top-full left-0 w-full mt-2 bg-[#0c0c0c]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl z-[60] overflow-hidden">
                            <ul class="max-h-60 overflow-y-auto custom-dropdown-list py-2">
                                <li onclick="selectCat('', 'SEMUA KATEGORI')" class="px-5 py-3 text-[11px] font-bold text-gray-400 hover:text-white hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Semua Kategori</li>
                                @foreach($categories as $cat)
                                    <li onclick="selectCat('{{ $cat->slug }}', '{{ $cat->name }}')" class="px-5 py-3 text-[11px] font-bold {{ request('category') == $cat->slug ? 'text-[#ccff00]' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">{{ $cat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- CUSTOM Sort Dropdown -->
                    <div class="relative flex-shrink-0" id="sort_dropdown_wrapper">
                        <input type="hidden" name="sort" id="sort_input" value="{{ request('sort', 'newest') }}">
                        <button type="button" onclick="toggleSortMenu()" class="w-[56px] h-[56px] bg-white rounded-2xl flex items-center justify-center text-gray-900 hover:bg-gray-100 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-[#ccff00]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h9M4 12h7M4 18h5m6-4l3-3m0 0l3 3m-3-3v10"></path>
                            </svg>
                        </button>

                        <!-- Options Menu (Floating) -->
                        <div id="sort_menu" class="hidden absolute top-full right-0 w-48 mt-2 bg-[#0c0c0c]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl z-[60] overflow-hidden">
                            <ul class="py-2">
                                <li onclick="selectSort('newest')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'newest' || !request('sort') ? 'text-[#ccff00]' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Terbaru</li>
                                <li onclick="selectSort('price_asc')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'price_asc' ? 'text-[#ccff00]' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Harga Terendah</li>
                                <li onclick="selectSort('price_desc')" class="px-5 py-3 text-[11px] font-bold {{ request('sort') == 'price_desc' ? 'text-[#ccff00]' : 'text-gray-200' }} hover:bg-white/5 cursor-pointer uppercase tracking-widest transition">Harga Tertinggi</li>
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
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative z-10">
                @foreach($products as $product)
                <div class="premium-card group cursor-pointer flex flex-col overflow-hidden relative">
                    <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-black/50 m-2 sm:m-3 rounded-[1.5rem]">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center group-hover:scale-110 group-hover:opacity-80 transition-all duration-700">
                        @else
                            <div class="w-full h-full bg-[#111] flex items-center justify-center text-white/20 font-montserrat text-[10px] uppercase tracking-widest font-bold">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c]/90 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                        
                        <!-- BADGE LOGIC -->
                        @if($product->discount_price)
                            <div class="absolute top-3 left-3 sm:top-4 sm:left-4 z-10">
                                <span class="bg-red-600 text-white font-montserrat text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-lg border border-red-800">
                                    -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                </span>
                            </div>
                        @endif

                        @if($product->is_featured)
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10">
                                <span class="bg-[#ccff00] text-black font-montserrat text-[8px] sm:text-[9px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-md border border-black/20">Featured</span>
                            </div>
                        @endif
                    </a>
                    
                    <div class="px-4 sm:px-5 pb-5 pt-2 flex-grow flex flex-col justify-end relative z-10 bg-transparent">
                        <h4 class="text-white font-bebas text-xl sm:text-2xl tracking-wide mb-1 sm:mb-2 transition group-hover:text-[#ccff00] line-clamp-2 leading-tight">
                            <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                        </h4>
                        <p class="text-gray-400 font-montserrat text-[9px] sm:text-[10px] font-bold uppercase tracking-widest mb-3">
                            {{ $product->brand ?? $product->category->name }}
                        </p>
                        
                        <div class="flex items-end justify-between mt-auto pt-4 border-t border-white/10">
                            <!-- PRICE LOGIC -->
                            <div class="flex flex-col">
                                @if($product->discount_price)
                                    <span class="text-gray-500 line-through text-[10px] font-bold font-montserrat mb-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-[#ccff00] font-montserrat text-sm sm:text-base font-bold tracking-wider leading-none">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-[#ccff00] font-montserrat text-sm sm:text-base font-bold tracking-wider leading-none">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm flex items-center justify-center group-hover:bg-[#ccff00] group-hover:border-[#ccff00] group-hover:text-black text-white transition-colors duration-300 flex-shrink-0">
                                <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-20 flex justify-center glass-pagination relative z-10">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-24 bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] max-w-2xl mx-auto relative z-10">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <h3 class="font-bebas text-4xl text-white tracking-wide mb-2 uppercase">Belum Ada Produk</h3>
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-light mb-8 max-w-sm mx-auto">
                    Koleksi perlengkapan yang Anda cari belum tersedia saat ini.
                </p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-[#ccff00] text-black px-10 py-4 rounded-full uppercase tracking-widest text-[11px] font-bold hover:bg-white hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(204,255,0,0.4)] transition duration-300">
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