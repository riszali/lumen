@extends('layouts.app')

@section('title', $product->name . ' | WILLSPORTS')

@section('content')

<!-- Font & Styles -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Swiper JS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    :root {
        --volt: #ccff00;      
        --dark: #050505;      
    }
    .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.02em; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    .swiper-button-next, .swiper-button-prev { color: var(--volt) !important; }
    .swiper-pagination-bullet-active { background-color: var(--volt) !important; }
    
    /* Tab Styling */
    .tab-btn {
        color: #9ca3af;
        border-bottom: 2px solid transparent;
        padding-bottom: 0.5rem;
        transition: all 0.3s;
    }
    .tab-btn.active {
        color: var(--volt);
        border-bottom: 2px solid var(--volt);
    }

    /* OPTIMASI EKSTRIM: Ganti Filter Blur Berat dengan Radial Gradient Murni */
    .bg-glow-cyan { background: radial-gradient(circle, rgba(0, 229, 255, 0.05) 0%, transparent 65%); }
    .bg-glow-volt { background: radial-gradient(circle, rgba(204, 255, 0, 0.08) 0%, transparent 65%); }
</style>

<!-- Main Wrapper with Dark Background -->
<!-- Ditambahkan transform translate-z-0 untuk Hardware Acceleration (GPU) -->
<div class="relative w-full min-h-screen bg-[#050505] overflow-hidden pt-navbar pb-24 transform translate-z-0">
    
    <!-- Ambient Light Effects (Teroptimasi - Sangat Ringan di HP) -->
    <div class="absolute top-[-10%] left-[-30%] w-[120vw] h-[120vw] md:w-[60vw] md:h-[60vw] bg-glow-cyan pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-20%] w-[100vw] h-[100vw] md:w-[50vw] md:h-[50vw] bg-glow-volt pointer-events-none z-0"></div>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <!-- Breadcrumb -->
        <nav class="text-[10px] sm:text-xs text-gray-500 mb-10 uppercase tracking-widest flex items-center font-montserrat font-bold">
            <a href="{{ route('home') }}" class="hover:text-white transition duration-300">Home</a> 
            <span class="mx-3 opacity-50">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-white transition duration-300">Shop</a> 
            <span class="mx-3 opacity-50">/</span>
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-white transition duration-300">{{ $product->category->name }}</a> 
            <span class="mx-3 opacity-50">/</span>
            <span class="text-[#ccff00] drop-shadow-md">{{ $product->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row gap-12 lg:gap-16">
            <!-- Product Images (Left) - Menggunakan Swiper Slider -->
            <div class="w-full md:w-1/2">
                <!-- OPTIMASI: backdrop-blur-2xl di HP jadi md -->
                <div class="bg-white/[0.03] backdrop-blur-md md:backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-4 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] mb-6">
                    
                    <!-- Swiper Image Container -->
                    <div class="swiper mainProductSwiper aspect-square bg-black/40 border border-white/5 rounded-[2rem] overflow-hidden relative shadow-inner">
                        <div class="swiper-wrapper">
                            @forelse($product->images as $image)
                                <!-- Gambar diklik memanggil Lightbox -->
                                <div class="swiper-slide cursor-zoom-in" onclick="openLightbox('{{ Storage::url($image->image_path) }}')">
                                    <!-- OPTIMASI: loading lazy dan decoding async -->
                                    <img src="{{ Storage::url($image->image_path) }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center">
                                </div>
                            @empty
                                <div class="swiper-slide flex items-center justify-center text-white/30 uppercase tracking-widest text-xs font-montserrat">No Image</div>
                            @endforelse
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Thumbnail Gallery (Click to change Swiper Slide) -->
                @if($product->images->count() > 1)
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-3 px-2">
                    @foreach($product->images as $index => $image)
                    <button onclick="mainSwiper.slideTo({{ $index }})" class="aspect-square bg-black/20 border border-white/10 rounded-2xl overflow-hidden hover:border-[#ccff00] focus:outline-none focus:border-[#ccff00] transition duration-300 shadow-inner opacity-60 hover:opacity-100">
                        <img src="{{ Storage::url($image->image_path) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Details (Right) -->
            <div class="w-full md:w-1/2 flex flex-col pt-4">
                
                <h1 class="font-bebas text-5xl lg:text-7xl text-white mb-2 tracking-wide drop-shadow-md leading-none">{{ $product->name }}</h1>
                <p class="text-sm text-gray-400 font-montserrat font-bold tracking-widest uppercase mb-6">{{ $product->brand ?? $product->category->name }}</p>
                <p class="text-3xl text-[#ccff00] font-bebas tracking-wide mb-8">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <!-- TABS: Description & Specification -->
                <div class="font-montserrat">
                    <div class="flex gap-8 border-b border-white/10 mb-6 text-xs uppercase tracking-widest font-bold">
                        <button id="btn-desc" class="tab-btn active" onclick="switchTab('desc')">Deskripsi</button>
                        <button id="btn-spec" class="tab-btn" onclick="switchTab('spec')">Spesifikasi</button>
                    </div>

                    <!-- Content Tab -->
                    <div class="min-h-[150px] mb-10">
                        <!-- Tab Deskripsi -->
                        <div id="content-desc" class="text-gray-400 font-light text-sm leading-relaxed text-justify">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        <!-- Tab Spesifikasi -->
                        <div id="content-spec" class="hidden text-gray-400 font-light text-sm leading-relaxed">
                            @if($product->specification)
                                {!! nl2br(e($product->specification)) !!}
                            @else
                                <p class="italic text-gray-600">Spesifikasi tidak tersedia untuk produk ini.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <!-- OPTIMASI: backdrop-blur diturunkan -->
                <div class="bg-white/5 backdrop-blur-md md:backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-lg mt-auto">
                    <form action="{{ route('cart.add') }}" method="POST" class="font-montserrat">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if($product->variants->count() > 0)
                        <div class="mb-6 relative">
                            <label for="variant_id" class="block text-[10px] uppercase tracking-widest text-gray-400 mb-3 font-bold">Pilih Varian *</label>
                            <select name="variant_id" id="variant_id" class="w-full bg-black/40 border border-white/10 rounded-xl py-4 px-5 focus:ring-[#ccff00] focus:border-[#ccff00] text-sm text-white appearance-none shadow-inner transition outline-none cursor-pointer [&>option]:bg-[#050505]" required>
                                <option value="">-- Tentukan Pilihan --</option>
                                @foreach($product->variants as $variant)
                                    <option value="{{ $variant->id }}">
                                        {{ $variant->material }} - {{ $variant->size }} (Sisa: {{ $variant->stock }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 bottom-0 top-[32px] flex items-center px-5 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-end gap-4 mb-2">
                            <div class="w-28 flex-shrink-0">
                                <label for="quantity" class="block text-[10px] uppercase tracking-widest text-gray-400 mb-3 font-bold">Kuantitas</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full bg-black/40 border border-white/10 rounded-xl py-4 px-4 focus:ring-[#ccff00] focus:border-[#ccff00] text-center text-sm text-white shadow-inner transition outline-none" required>
                            </div>
                            <button type="submit" class="flex-grow bg-[#ccff00] text-black border border-[#ccff00] rounded-xl py-4 uppercase tracking-widest text-xs font-bold hover:bg-white hover:text-black hover:border-white transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)] hover:shadow-[0_0_25px_rgba(255,255,255,0.4)] flex justify-center items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Add to Cart
                            </button>
                        </div>
                        
                        @if($product->stock <= 5 && $product->stock > 0)
                            <p class="text-red-400 text-xs mt-4 italic tracking-wide">Tersisa {{ $product->stock }} produk dalam stok!</p>
                        @elseif($product->stock == 0 && $product->variants->count() == 0)
                            <p class="text-red-400 text-xs mt-4 italic tracking-wide">Produk sedang kehabisan stok.</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-32 border-t border-white/5 pt-16 relative">
            <h2 class="font-bebas text-4xl text-center text-white mb-12 tracking-wide drop-shadow-md">PRODUK TERKAIT</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach($relatedProducts as $related)
                <!-- OPTIMASI: backdrop-blur diturunkan -->
                <div class="group cursor-pointer bg-white/[0.03] backdrop-blur-md md:backdrop-blur-xl border border-white/10 rounded-[2rem] p-3 shadow-[0_8px_32px_rgba(0,0,0,0.3)] hover:bg-white/[0.08] hover:border-[#ccff00]/30 transition-all duration-500 flex flex-col">
                    
                    <a href="{{ route('shop.show', $related->slug) }}" class="block relative overflow-hidden mb-4 aspect-square rounded-[1.5rem] shadow-inner bg-black/50">
                        @if($related->primaryImage)
                            <img src="{{ Storage::url($related->primaryImage->image_path) }}" alt="{{ $related->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/30 text-[10px] uppercase font-bold tracking-widest font-montserrat">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c]/80 via-transparent to-transparent opacity-90 pointer-events-none"></div>
                    </a>
                    
                    <div class="text-center px-2 pb-3 flex-grow flex flex-col justify-end font-montserrat">
                        <h4 class="text-white font-bebas text-2xl tracking-wide mb-1 transition group-hover:text-[#ccff00] line-clamp-1">
                            <a href="{{ route('shop.show', $related->slug) }}">{{ $related->name }}</a>
                        </h4>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">{{ $related->brand ?? $related->category->name }}</p>
                        <p class="text-[#ccff00] text-sm font-bold tracking-wider">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Lightbox Custom untuk Zoom Image -->
<div id="image-lightbox" class="fixed inset-0 z-[200] bg-black/95 hidden flex justify-center items-center backdrop-blur-md opacity-0 transition-opacity duration-300">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white hover:text-[#ccff00] transition bg-white/10 p-3 rounded-full">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <img id="lightbox-img" src="" class="max-w-[90vw] max-h-[90vh] object-contain rounded-2xl shadow-2xl scale-95 transition-transform duration-300">
</div>

<!-- Swiper JS Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Inisialisasi Swiper Slider
    var mainSwiper = new Swiper(".mainProductSwiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // Logika Tab Deskripsi vs Spesifikasi
    function switchTab(tab) {
        document.getElementById('btn-desc').classList.remove('active');
        document.getElementById('btn-spec').classList.remove('active');
        document.getElementById('content-desc').classList.add('hidden');
        document.getElementById('content-spec').classList.add('hidden');

        document.getElementById('btn-' + tab).classList.add('active');
        document.getElementById('content-' + tab).classList.remove('hidden');
    }

    // Logika Lightbox Zoom
    const lightbox = document.getElementById('image-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    function openLightbox(imgSrc) {
        lightboxImg.src = imgSrc;
        lightbox.classList.remove('hidden');
        // Trigger reflow untuk animasi
        void lightbox.offsetWidth;
        lightbox.classList.remove('opacity-0');
        lightboxImg.classList.remove('scale-95');
        lightboxImg.classList.add('scale-100');
    }

    function closeLightbox() {
        lightbox.classList.add('opacity-0');
        lightboxImg.classList.remove('scale-100');
        lightboxImg.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
        }, 300); // Sinkron dengan durasi transisi
    }

    // Klik di area kosong mematikan lightbox
    lightbox.addEventListener('click', function(e) {
        if(e.target === this) {
            closeLightbox();
        }
    });
</script>
@endsection