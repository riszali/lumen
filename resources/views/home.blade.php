@extends('layouts.app')

@section('title', 'WILLSPORTS | Elevate Your Game')

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
        background-color: var(--dark);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
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

    /* Desain Card Baru: Solid, Gelap, Premium */
    .premium-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.8);
    }

    /* Custom Scrollbar */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* =========================================
       CSS KHUSUS CAROUSEL (GSAP 3D LOOP)
       ========================================= */
    .cards {
        position: relative;
        width: 18rem;
        height: 24rem;
        margin: 0 auto;
        padding: 0;
        perspective: 1200px;
    }
    
    .cards li {
        position: absolute;
        top: 0;
        left: 0;
        width: 18rem;
        height: 24rem;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        background: #000;
        box-shadow: 0 15px 30px rgba(0,0,0,0.6);
        will-change: transform, opacity;
        transform: translateZ(0); 
        backface-visibility: hidden;
    }

    .cards li img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1 !important; 
    }

    /* Skala Responsif untuk HP */
    @media (max-width: 768px) {
        .cards { width: 14rem; height: 18rem; }
        .cards li { width: 14rem; height: 18rem; }
    }

    /* CSS Marquee */
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 20s linear infinite;
        will-change: transform;
        transform: translateZ(0);
    }
</style>

<!-- =========================================
     1. HERO SECTION (PREMIUM & CLEAN)
     ========================================= -->
<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-[var(--dark)]">
    
    <!-- Latar Belakang Video (Dikembalikan ke semua device) -->
    <div class="absolute inset-0 z-0">
        <!-- OPTIMASI: preload="metadata" agar tidak memblokir render HTML -->
        <video autoplay loop muted playsinline disablePictureInPicture disableRemotePlayback preload="metadata" class="w-full h-full object-cover opacity-50">
            <source src="{{ asset('assets/videos/viper.mp4') }}" type="video/mp4">
        </video>
        
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/10 via-[#050505]/40 to-[#050505]"></div>
    </div>

    <!-- Cahaya Pendar (Disembunyikan di HP untuk hemat GPU) -->
    <div class="hidden md:block absolute top-[10%] left-[10%] w-[30%] h-[40%] bg-volt rounded-full filter blur-[100px] opacity-10 pointer-events-none z-0"></div>

    <!-- Konten Hero -->
    <div class="relative z-10 w-[95%] max-w-[1200px] mx-auto px-4 flex flex-col items-center text-center pt-24">

        <div class="gsap-hero mb-8 w-full">
            <h1 class="font-bebas text-[80px] sm:text-[110px] md:text-[150px] text-white tracking-wide drop-shadow-2xl">
                ELEVATE YOUR <span class="text-volt">GAME</span>
            </h1>
            <p class="text-gray-400 font-montserrat text-sm sm:text-base font-light max-w-2xl mx-auto leading-relaxed mt-2 drop-shadow-md">
                Perlengkapan padel spesifikasi turnamen untuk atlet yang menuntut kesempurnaan. Rasakan kendali mutlak dan dominasi setiap jengkal lapangan.
            </p>
        </div>

        <div class="gsap-hero flex flex-col sm:flex-row justify-center gap-4 mt-6 w-full">
            <a href="{{ route('shop.index') }}" class="bg-volt text-black px-10 py-4 rounded-full font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white hover:-translate-y-1 transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0.3)]">
                Lihat Koleksi
            </a>
            <a href="#showcase-pin" class="bg-black/50 backdrop-blur-md border border-white/30 text-white px-10 py-4 rounded-full font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white/10 hover:-translate-y-1 transition-all duration-300">
                Jelajahi Produk
            </a>
        </div>
    </div>
</section>

<!-- =========================================
     2. MARQUEE BANNER (CLEAN & SHARP)
     ========================================= -->
<div class="w-full bg-[#0a0a0a] border-y border-white/5 py-3 overflow-hidden relative z-20">
    <div class="animate-marquee font-bebas text-2xl text-gray-500 tracking-widest uppercase flex items-center opacity-80">
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
    </div>
</div>

<!-- =========================================
     3. FULL-WIDTH BANNER CAROUSEL (DARI ADMIN)
     ========================================= -->
<section class="relative w-full h-[50vh] md:h-[85vh] bg-[#050505] overflow-hidden z-20 group border-b border-white/5">
    @if(isset($banners) && $banners->count() > 0)
        <!-- Track Slider -->
        <div id="full-banner-track" class="w-full h-full flex transition-transform duration-700 ease-in-out">
            @foreach($banners as $banner)
            <div class="w-full h-full flex-shrink-0 relative">
                <!-- OPTIMASI: loading="lazy" decoding="async" -->
                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                
                @if($banner->title)
                <div class="absolute bottom-10 left-6 md:bottom-20 md:left-20 max-w-4xl px-4 md:px-0">
                    <div class="border-l-4 border-volt pl-4 md:pl-6">
                        <h2 class="font-bebas text-5xl md:text-8xl text-white tracking-wide drop-shadow-2xl leading-none uppercase">{{ $banner->title }}</h2>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
            <!-- Navigasi Kiri / Kanan -->
            <button onclick="prevBanner()" class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2 w-10 h-10 md:w-16 md:h-16 bg-black/30 backdrop-blur-md border border-white/10 hover:border-volt hover:bg-volt hover:text-black text-white rounded-full flex items-center justify-center transition-all duration-300 opacity-100 md:opacity-0 md:group-hover:opacity-100 z-30">
                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextBanner()" class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2 w-10 h-10 md:w-16 md:h-16 bg-black/30 backdrop-blur-md border border-white/10 hover:border-volt hover:bg-volt hover:text-black text-white rounded-full flex items-center justify-center transition-all duration-300 opacity-100 md:opacity-0 md:group-hover:opacity-100 z-30">
                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Indikator Garis -->
            <div class="absolute bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 flex gap-2 sm:gap-3 z-30">
                @foreach($banners as $index => $banner)
                <button onclick="goToBanner({{ $index }})" class="banner-indicator w-8 sm:w-16 h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-volt' : 'bg-white/30' }}"></button>
                @endforeach
            </div>
        @endif

    @else
        <!-- FALLBACK -->
        <div class="w-full h-full relative flex items-center justify-center bg-[#0c0c0c]">
            <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000')] bg-cover bg-center grayscale"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-[#050505]"></div>
            
            <div class="text-center relative z-10 px-4">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-white/5 border border-white/10 rounded-full flex items-center justify-center mx-auto mb-6 md:backdrop-blur-sm">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bebas text-4xl md:text-7xl text-gray-500 tracking-wide uppercase drop-shadow-md">BELUM ADA BANNER</h3>
                <p class="text-[10px] md:text-xs uppercase tracking-widest text-gray-600 mt-3 font-bold font-montserrat">Silakan upload gambar dari menu Admin Panel</p>
            </div>
        </div>
    @endif
</section>

<!-- =========================================
     4. THE SHOWCASE (SCROLL TRIGGER AKTIF)
     ========================================= -->
<section id="showcase-pin" class="w-full h-screen flex flex-col md:flex-row bg-[var(--dark)] overflow-hidden relative border-b border-white/5">
    
    <!-- Sisi Kiri: Slider Gambar CodePen -->
    <div class="w-full md:w-1/2 h-[50vh] md:h-screen flex items-center justify-center relative z-10 bg-[#050505]">
        <!-- OPTIMASI: Sembunyikan ambient glow di HP karena mix-blend sangat memberatkan render -->
        <div class="hidden md:block absolute w-[300px] h-[300px] bg-white rounded-full mix-blend-screen filter blur-[150px] opacity-5"></div>
        
        <!-- UL Cards GSAP -->
        <ul class="cards z-20">
            <!-- OPTIMASI: loading="lazy" decoding="async" pada semua gambar -->
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" loading="lazy" decoding="async"></li>
            
            <!-- Duplikasi agar efek Infinity Seamless jalan -->
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" loading="lazy" decoding="async"></li>
        </ul>
    </div>

    <!-- Sisi Kanan: Teks Info yang Di-Scroll -->
    <div id="text-container" class="w-full md:w-1/2 h-[50vh] md:h-screen relative overflow-hidden z-10 bg-[#080808]">
        <div id="scroll-text-wrap" class="absolute top-0 left-0 w-full">
            
            <!-- Blok Teks 1 -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-6 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">01 // KENDALI MUTLAK</span>
                    <h2 class="text-4xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">PRESISI & KEKUATAN</h2>
                    <p class="text-gray-400 font-montserrat text-xs md:text-base leading-relaxed font-light">Raket padel premium yang direkayasa dengan serat karbon tingkat aerospace. Memberikan transfer energi maksimal tanpa mengorbankan akurasi pukulan Anda pada saat-saat krusial.</p>
                </div>
            </div>

            <!-- Blok Teks 2 -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-6 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">02 // AGILITAS TINGGI</span>
                    <h2 class="text-4xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">BERGERAK TANPA RAGU</h2>
                    <p class="text-gray-400 font-montserrat text-xs md:text-base leading-relaxed font-light">Sepatu performa tinggi dengan grip sol inovatif dan bantalan super responsif. Memastikan setiap pijakan, lompatan, dan manuver di lapangan terasa ringan, solid, dan stabil.</p>
                </div>
            </div>

            <!-- Blok Teks 3 -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-6 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">03 // DAYA TAHAN</span>
                    <h2 class="text-4xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">ENERGI TANPA HENTI</h2>
                    <p class="text-gray-400 font-montserrat text-xs md:text-base leading-relaxed font-light">Bertahan lebih lama dari lawanmu. Formulasi nutrisi canggih yang dirancang khusus untuk hidrasi instan, menjaga fokus tetap tajam, dan mempercepat proses pemulihan otot pasca tanding.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================
     5. BENTO GRID & BRAND PARTNERS (WHITE BACKGROUND)
     ========================================= -->
<section class="pt-16 bg-white relative overflow-hidden">
    
    <div class="max-w-[1400px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 pb-16 sm:pb-24">
        <div class="mb-8 sm:mb-14 gsap-fade-up">
            <h2 class="font-bebas text-4xl md:text-6xl text-gray-900 uppercase tracking-wide mb-2">JELAJAHI KOLEKSI KAMI</h2>
            <p class="text-gray-600 font-montserrat text-[10px] sm:text-sm font-medium tracking-widest uppercase">Peralatan untuk Setiap Lini Permainan</p>
        </div>
        
        <!-- OPTIMASI HP: Grid 2 Kolom per baris di HP, Bento Grid di Desktop -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 auto-rows-[180px] sm:auto-rows-[220px] md:auto-rows-[300px]">
            
            <!-- Card Padel -->
            <a href="{{ route('shop.index', ['category' => 'padel-rackets']) }}" class="col-span-1 md:col-span-2 md:row-span-2 group relative overflow-hidden bg-[#0c0c0c] rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.25)] hover:-translate-y-1">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/padel-rack-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=800'" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 md:bottom-8 md:left-8 z-10">
                        <span class="text-volt font-montserrat font-bold text-[8px] md:text-[10px] uppercase tracking-widest mb-1 md:mb-2 block">Koleksi Raket</span>
                        <h3 class="font-bebas text-xl sm:text-3xl md:text-5xl text-white drop-shadow-md">RAKET PADEL</h3>
                    </div>
                </div>
            </a>

            <!-- Card Shoes -->
            <a href="{{ route('shop.index', ['category' => 'sports-shoes']) }}" class="col-span-1 md:col-span-2 group relative overflow-hidden bg-[#0c0c0c] rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.25)] hover:-translate-y-1">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/shoes-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800'" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[8px] md:text-[10px] uppercase tracking-widest mb-1 block">Alas Kaki Profesional</span>
                        <h3 class="font-bebas text-xl sm:text-3xl md:text-4xl text-white drop-shadow-md">SEPATU OLAHRAGA</h3>
                    </div>
                </div>
            </a>

            <!-- Card Supplements -->
            <a href="{{ route('shop.index', ['category' => 'supplements']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c] rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.25)] hover:-translate-y-1">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/supp-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[8px] md:text-[10px] uppercase tracking-widest mb-1 block">Nutrisi Olahraga</span>
                        <h3 class="font-bebas text-xl sm:text-2xl md:text-3xl text-white drop-shadow-md">SUPLEMEN</h3>
                    </div>
                </div>
            </a>

            <!-- Card Activewear -->
            <a href="{{ route('shop.index', ['category' => 'activewear']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c] rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.25)] hover:-translate-y-1">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/wear-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[8px] md:text-[10px] uppercase tracking-widest mb-1 block">Pakaian Performa</span>
                        <h3 class="font-bebas text-xl sm:text-2xl md:text-3xl text-white drop-shadow-md">ACTIVEWEAR</h3>
                    </div>
                </div>
            </a>
            
        </div>
    </div>

    <!-- BRAND LOGOS (MARQUEE) Diletakkan di bawah Bento Grid -->
    <div class="w-full overflow-hidden py-5 sm:py-8 bg-[#080808] relative gsap-fade-up">
        <!-- Fade Edges -->
        <div class="absolute inset-y-0 left-0 w-12 sm:w-24 bg-gradient-to-r from-[#080808] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-12 sm:w-24 bg-gradient-to-l from-[#080808] to-transparent z-10 pointer-events-none"></div>
        
        <div class="animate-marquee flex items-center whitespace-nowrap opacity-40">
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BABOLAT</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BULLPADEL</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">HEAD</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">OXDOG</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">SIUX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NOX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">ADIDAS</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NIKE</span>
            <!-- Duplikasi agar efek Infinity Seamless jalan mulus tanpa putus -->
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BABOLAT</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BULLPADEL</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">HEAD</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">OXDOG</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">SIUX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NOX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">ADIDAS</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NIKE</span>
        </div>
    </div>
</section>

<!-- =========================================
     6. FINAL CTA BANNER (PREMIUM REDESIGN)
     ========================================= -->
<section class="py-24 md:py-32 w-full relative overflow-hidden flex flex-col items-center justify-center bg-[var(--dark)] border-t border-white/5">
    
    <!-- Abstract / Tech Background -->
    <div class="absolute inset-0 z-0">
        <!-- Pola Grid Tipis -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_60%_60%_at_50%_50%,#000_10%,transparent_100%)]"></div>
        
        <!-- OPTIMASI: loading="lazy" decoding="async" -->
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" alt="Athletes" loading="lazy" decoding="async" class="w-full h-full object-cover object-top opacity-10 filter grayscale mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-t from-[var(--dark)] via-[var(--dark)]/80 to-[var(--dark)]"></div>
    </div>

    <!-- Glowing Background Accents -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] md:w-[50%] h-[50%] bg-volt rounded-full mix-blend-screen filter blur-[200px] opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10 w-[95%] max-w-[1000px] mx-auto px-4 sm:px-0">
        <!-- Glassmorphism Floating Card -->
        <div class="bg-[#0c0c0c]/80 backdrop-blur-2xl border border-white/10 rounded-[2rem] md:rounded-[3rem] p-8 sm:p-12 md:p-16 text-center shadow-[0_30px_60px_rgba(0,0,0,0.8)] relative overflow-hidden group">
            
            <!-- Hover Inner Glow Effect -->
            <div class="absolute inset-0 bg-gradient-to-br from-volt/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
            
            <!-- Sudut Aksen Kiri Atas & Kanan Bawah -->
            <div class="absolute top-0 left-0 w-16 h-16 border-t-2 border-l-2 border-volt/50 rounded-tl-[2rem] md:rounded-tl-[3rem] opacity-50"></div>
            <div class="absolute bottom-0 right-0 w-16 h-16 border-b-2 border-r-2 border-volt/50 rounded-br-[2rem] md:rounded-br-[3rem] opacity-50"></div>

            <div class="gsap-fade-up relative z-10 flex flex-col items-center">
                
                <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.3em] uppercase mb-6 flex items-center justify-center gap-3">
                    <span class="w-6 sm:w-10 h-[1px] bg-volt"></span>
                    Tingkatkan Levelmu
                    <span class="w-6 sm:w-10 h-[1px] bg-volt"></span>
                </span>
                
                <h2 class="font-bebas text-5xl sm:text-7xl md:text-[90px] text-white leading-[0.9] mb-6 tracking-wide drop-shadow-lg">
                    MULAI DENGAN <br/> 
                    <span class="text-volt text-6xl sm:text-8xl md:text-[110px] drop-shadow-[0_0_25px_rgba(204,255,0,0.3)]">YANG TERBAIK</span>
                </h2>
                
                <p class="text-gray-400 max-w-lg mx-auto font-montserrat text-xs sm:text-sm md:text-base font-light mb-10 leading-relaxed">
                    Berhenti berkompromi. Lengkapi dirimu dengan gear pilihan atlet profesional dan rasakan perbedaan kualitas di setiap permainanmu.
                </p>
                
                <!-- Double Buttons -->
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full sm:w-auto">
                    <a href="{{ route('shop.index') }}" class="w-full sm:w-auto bg-volt text-black px-10 py-4 rounded-full font-montserrat font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white hover:-translate-y-1 transition-all duration-300 shadow-[0_0_20px_rgba(204,255,0,0.2)] hover:shadow-[0_0_30px_rgba(204,255,0,0.4)]">
                        Masuk ke Toko
                    </a>
                    <a href="#showcase-pin" class="w-full sm:w-auto bg-transparent text-white border border-white/30 px-10 py-4 rounded-full font-montserrat font-bold uppercase tracking-widest text-xs sm:text-sm hover:border-volt hover:text-volt hover:-translate-y-1 transition-all duration-300">
                        Eksplor Produk
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- =========================================
     SCRIPT GSAP & CAROUSEL (OPTIMIZED & DEFERRED)
     ========================================= -->
<!-- OPTIMASI: Tambah "defer" agar HTML diload duluan tanpa terhalang script besar ini -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

<script>
    // Karena script di-defer, inisialisasi harus nunggu DOMContentLoaded
    document.addEventListener("DOMContentLoaded", () => {
        
        // ===========================================
        // LOGIC CAROUSEL FULL WIDTH (SECTION 3)
        // ===========================================
        const track = document.getElementById('full-banner-track');
        const indicators = document.querySelectorAll('.banner-indicator');
        let currentBanner = 0;
        const bannerCount = indicators.length;
        let slideInterval;

        window.goToBanner = function(index) {
            if (!track) return;
            currentBanner = index;
            track.style.transform = `translateX(-${currentBanner * 100}%)`;
            
            indicators.forEach((ind, i) => {
                if (i === currentBanner) {
                    ind.classList.remove('bg-white/30');
                    ind.classList.add('bg-volt');
                } else {
                    ind.classList.remove('bg-volt');
                    ind.classList.add('bg-white/30');
                }
            });
            resetInterval();
        };

        window.nextBanner = function() {
            if (bannerCount > 1) {
                goToBanner((currentBanner + 1) % bannerCount);
            }
        };

        window.prevBanner = function() {
            if (bannerCount > 1) {
                goToBanner((currentBanner - 1 + bannerCount) % bannerCount);
            }
        };

        function resetInterval() {
            clearInterval(slideInterval);
            if (bannerCount > 1) {
                slideInterval = setInterval(nextBanner, 6000); 
            }
        }

        if (bannerCount > 1) { resetInterval(); }

        // ===========================================
        // GSAP & SCROLL TRIGGER (OPTIMASI SUPER HP)
        // ===========================================
        // Pastikan GSAP terload karena kita pakai defer di headernya
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Animasi
            gsap.from(".gsap-hero", {
                y: 40, opacity: 0, duration: 1, stagger: 0.15, ease: "power3.out", delay: 0.1
            });

            // Fade Up Biasa
            gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
                gsap.from(elem, {
                    scrollTrigger: { trigger: elem, start: "top 85%" },
                    y: 40, opacity: 0, duration: 1, ease: "power3.out"
                });
            });

            // ==============================================================
            // LOGIC SHOWCASE INFINITY SCROLL (ScrollTrigger Aktif di Semua)
            // ==============================================================
            const showcase = document.getElementById('showcase-pin');
            const textContainer = document.getElementById('text-container');
            const textWrap = document.getElementById('scroll-text-wrap');
            const cards = gsap.utils.toArray('.cards li');
            
            if(showcase && textWrap && cards.length > 0) {
                // Buat Timeline Seamless Loop
                const seamlessLoop = buildSeamlessLoop(cards, 0.1);

                let scrollDist = textWrap.scrollHeight - textContainer.clientHeight;

                const tlPin = gsap.timeline({
                    scrollTrigger: {
                        trigger: showcase,
                        start: "top top",
                        end: "+=" + scrollDist,
                        pin: true,
                        // OPTIMASI: Scrub dikecilkan jadi 0.5 supaya animasinya tidak berat ngikutin scroll di HP
                        scrub: 0.5, 
                        anticipatePin: 1
                    }
                });

                tlPin.to(textWrap, { y: -scrollDist, ease: "none" }, 0);
                tlPin.fromTo(seamlessLoop, 
                    { totalTime: seamlessLoop.duration() }, 
                    { totalTime: seamlessLoop.duration() * 2.5, ease: "none" }, 0
                );
            }
        }
    });

    // FUNGSI INTI UNTUK SEAMLESS LOOP
    function buildSeamlessLoop(items, spacing) {
        let overlap = Math.ceil(1 / spacing),
            startTime = items.length * spacing + 0.5,
            loopTime = (items.length + overlap) * spacing + 1,
            rawSequence = gsap.timeline({paused: true}),
            seamlessLoop = gsap.timeline({
                paused: true,
                repeat: -1,
                onRepeat() {
                    this._time === this._dur && (this._tTime += this._dur - 0.01);
                }
            }),
            l = items.length + overlap * 2,
            time = 0,
            i, index, item;

        // OPTIMASI EXTREME: Tambahkan rotationZ: 0.01 dan force3D untuk maksa HP lu ngerender ini pakai GPU
        gsap.set(items, {xPercent: 400, opacity: 0, scale: 0, force3D: true, rotationZ: 0.01});

        for (i = 0; i < l; i++) {
            index = i % items.length;
            item = items[index];
            time = i * spacing;
            rawSequence.fromTo(item, {scale: 0, opacity: 0}, {scale: 1, opacity: 1, zIndex: 100, duration: 0.5, yoyo: true, repeat: 1, ease: "power1.in", immediateRender: false}, time)
                       .fromTo(item, {xPercent: 400}, {xPercent: -400, duration: 1, ease: "none", immediateRender: false}, time);
            i <= items.length && seamlessLoop.add("label" + i, time);
        }

        rawSequence.time(startTime);
        seamlessLoop.to(rawSequence, {
            time: loopTime,
            duration: loopTime - startTime,
            ease: "none"
        }).fromTo(rawSequence, {time: overlap * spacing + 1}, {
            time: startTime,
            duration: startTime - (overlap * spacing + 1),
            immediateRender: false,
            ease: "none"
        });
        return seamlessLoop;
    }
</script>
@endsection