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

    /* Desain Card Baru: Solid, Gelap, Premium (Sesuai Referensi Gambar) */
    .premium-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.8);
    }

    /* Custom Scrollbar buat Slider Banners Tambahan Admin */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* =========================================
       CSS KHUSUS CODEPEN CAROUSEL INFINITY
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
        list-style: none;
        padding: 0;
        margin: 0;
        width: 18rem;
        height: 24rem;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        background: #000;
        box-shadow: 0 30px 60px rgba(0,0,0,0.9);
    }

    .cards li img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1 !important; 
        filter: grayscale(15%) contrast(1.1);
    }

    @media (max-width: 768px) {
        .cards { width: 15rem; height: 20rem; }
        .cards li { width: 15rem; height: 20rem; }
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
    }
</style>

<!-- =========================================
     1. HERO SECTION (PREMIUM & CLEAN)
     ========================================= -->
<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-[var(--dark)]">
    
    <!-- Latar Belakang & Glowing Orbs -->
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-20">
            <source src="{{ asset('assets/videos/viper.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/30 via-[#050505]/70 to-[#050505]"></div>
    </div>

    <!-- Cahaya Pendar Halus -->
    <div class="absolute top-[10%] left-[10%] w-[30%] h-[40%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <!-- Konten Hero -->
    <div class="relative z-10 w-[95%] max-w-[1200px] mx-auto px-4 flex flex-col items-center text-center pt-24">

        <div class="gsap-hero mb-8 w-full">
            <h1 class="font-bebas text-[80px] sm:text-[110px] md:text-[150px] text-white tracking-wide drop-shadow-2xl">
                ELEVATE YOUR <span class="text-volt">GAME</span>
            </h1>
            <p class="text-gray-400 font-montserrat text-sm sm:text-base font-light max-w-2xl mx-auto leading-relaxed mt-2">
                Perlengkapan padel spesifikasi turnamen untuk atlet yang menuntut kesempurnaan. Rasakan kendali mutlak dan dominasi setiap jengkal lapangan.
            </p>
        </div>

        <div class="gsap-hero flex flex-col sm:flex-row justify-center gap-4 mt-6 w-full">
            <a href="{{ route('shop.index') }}" class="bg-volt text-black px-10 py-4 rounded-full font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white hover:-translate-y-1 transition-all duration-300">
                Lihat Koleksi
            </a>
            <a href="#showcase-pin" class="bg-transparent border border-white/30 text-white px-10 py-4 rounded-full font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white/10 hover:-translate-y-1 transition-all duration-300">
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
     3. DYNAMIC BANNERS (TAMBAHAN BARU DARI ADMIN)
     ========================================= -->
<section class="relative w-full py-16 bg-[#0a0a0a] border-b border-white/5 overflow-hidden z-20">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mb-8 flex justify-between items-end">
        <div>
            <h2 class="font-bebas text-4xl text-white tracking-wide uppercase">LATEST <span class="text-volt">HIGHLIGHTS</span></h2>
            <p class="text-gray-500 font-montserrat text-xs mt-1 uppercase tracking-widest font-bold">Exclusive Drops & Promos</p>
        </div>
        <!-- Tombol Geser Slider -->
        <div class="hidden sm:flex gap-2">
            <button onclick="document.getElementById('banner-slider-admin').scrollBy({left: -400, behavior: 'smooth'})" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center text-white hover:border-volt hover:text-volt transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="document.getElementById('banner-slider-admin').scrollBy({left: 400, behavior: 'smooth'})" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center text-white hover:border-volt hover:text-volt transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>

    <!-- Slider Horizontal -->
    <div id="banner-slider-admin" class="flex overflow-x-auto snap-x snap-mandatory gap-6 px-4 sm:px-6 lg:px-8 pb-8 hide-scrollbar scroll-smooth">
        @if(isset($banners) && $banners->count() > 0)
            @foreach($banners as $banner)
            <div class="snap-center shrink-0 w-[85vw] sm:w-[60vw] md:w-[45vw] lg:w-[35vw] aspect-[16/9] md:aspect-[21/9] bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] overflow-hidden relative group shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-[#050505]/90 via-[#050505]/20 to-transparent"></div>
                
                @if($banner->title)
                <div class="absolute bottom-6 left-6 right-6">
                    <h3 class="font-bebas text-3xl sm:text-4xl text-white tracking-wide drop-shadow-md">{{ $banner->title }}</h3>
                </div>
                @endif
            </div>
            @endforeach
        @else
            <!-- FALLBACK KETIKA ADMIN BELUM UPLOAD BANNER BIAR SECTIONNYA TETAP MUNCUL -->
            <div class="snap-center shrink-0 w-[85vw] sm:w-[60vw] md:w-[45vw] lg:w-[35vw] aspect-[16/9] md:aspect-[21/9] bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] overflow-hidden relative group shadow-[0_10px_30px_rgba(0,0,0,0.5)] flex flex-col items-center justify-center text-center p-6">
                <svg class="w-12 h-12 text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <h3 class="font-bebas text-3xl text-gray-500 tracking-wide">BELUM ADA BANNER</h3>
                <p class="text-[10px] uppercase tracking-widest text-gray-600 mt-2 font-bold">Silakan upload gambar dari menu Admin Panel</p>
            </div>
            
            <div class="snap-center shrink-0 w-[85vw] sm:w-[60vw] md:w-[45vw] lg:w-[35vw] aspect-[16/9] md:aspect-[21/9] bg-white/[0.01] backdrop-blur-2xl border border-white/5 rounded-[2rem] overflow-hidden relative group shadow-[0_10px_30px_rgba(0,0,0,0.2)]"></div>
        @endif
    </div>
</section>

<!-- =========================================
     4. THE SHOWCASE (CODEPEN INFINITY + TEXT SCROLL)
     ========================================= -->
<section id="showcase-pin" class="w-full h-screen flex flex-col md:flex-row bg-[var(--dark)] overflow-hidden relative border-b border-white/5">
    
    <!-- Sisi Kiri: Slider CodePen -->
    <div class="w-full md:w-1/2 h-[50vh] md:h-screen flex items-center justify-center relative z-10 bg-[#050505]">
        <!-- Ambient subtle glow di belakang slider -->
        <div class="absolute w-[300px] h-[300px] bg-white rounded-full mix-blend-screen filter blur-[150px] opacity-5"></div>
        
        <!-- UL Cards CodePen -->
        <ul class="cards z-20">
            <!-- 5 Aset Baru Lokal -->
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'"></li>
            <!-- Duplikasi agar efek Infinity Seamless jalan mulus tanpa putus -->
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'"></li>
        </ul>
    </div>

    <!-- Sisi Kanan: Teks yang di Scroll -->
    <div id="text-container" class="w-full md:w-1/2 h-[50vh] md:h-screen relative overflow-hidden z-10 bg-[#080808]">
        <div id="scroll-text-wrap" class="absolute top-0 left-0 w-full">
            
            <!-- Blok Teks 1: Raket Padel -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-8 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">01 // KENDALI MUTLAK</span>
                    <h2 class="text-5xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">PRESISI & KEKUATAN</h2>
                    <p class="text-gray-400 font-montserrat text-sm md:text-base leading-relaxed font-light">Raket padel premium yang direkayasa dengan serat karbon tingkat aerospace. Memberikan transfer energi maksimal tanpa mengorbankan akurasi pukulan Anda pada saat-saat krusial.</p>
                </div>
            </div>

            <!-- Blok Teks 2: Sepatu -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-8 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">02 // AGILITAS TINGGI</span>
                    <h2 class="text-5xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">BERGERAK TANPA RAGU</h2>
                    <p class="text-gray-400 font-montserrat text-sm md:text-base leading-relaxed font-light">Sepatu performa tinggi dengan grip sol inovatif dan bantalan super responsif. Memastikan setiap pijakan, lompatan, dan manuver di lapangan terasa ringan, solid, dan stabil.</p>
                </div>
            </div>

            <!-- Blok Teks 3: Nutrisi -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-8 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">03 // DAYA TAHAN</span>
                    <h2 class="text-5xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">ENERGI TANPA HENTI</h2>
                    <p class="text-gray-400 font-montserrat text-sm md:text-base leading-relaxed font-light">Bertahan lebih lama dari lawanmu. Formulasi nutrisi canggih yang dirancang khusus untuk hidrasi instan, menjaga fokus tetap tajam, dan mempercepat proses pemulihan otot pasca tanding.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================
     5. BENTO GRID (KATEGORI PRODUK)
     ========================================= -->
<section class="py-24 bg-[var(--dark)] px-4 sm:px-8 lg:px-12 relative overflow-hidden">
    
    <div class="max-w-[1400px] mx-auto relative z-10">
        <div class="mb-14 gsap-fade-up">
            <h2 class="font-bebas text-5xl md:text-6xl text-white uppercase tracking-wide mb-2">JELAJAHI KOLEKSI KAMI</h2>
            <p class="text-gray-500 font-montserrat text-xs sm:text-sm font-medium tracking-widest uppercase">Peralatan untuk Setiap Lini Permainan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 auto-rows-[250px] md:auto-rows-[300px]">
            
            <!-- Card Padel -->
            <a href="{{ route('shop.index', ['category' => 'padel-rackets']) }}" class="col-span-1 md:col-span-2 row-span-1 md:row-span-2 group relative overflow-hidden bg-[#0c0c0c] border border-white/5 rounded-3xl transition-all duration-500 hover:border-white/20">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/padel-rack-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=800'" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 z-10">
                        <span class="text-volt font-montserrat font-bold text-[10px] uppercase tracking-widest mb-2 block">Koleksi Raket</span>
                        <h3 class="font-bebas text-4xl md:text-5xl text-white">RAKET PADEL</h3>
                    </div>
                </div>
            </a>

            <!-- Card Shoes -->
            <a href="{{ route('shop.index', ['category' => 'sports-shoes']) }}" class="col-span-1 md:col-span-2 group relative overflow-hidden bg-[#0c0c0c] border border-white/5 rounded-3xl transition-all duration-500 hover:border-white/20">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/shoes-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800'" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[10px] uppercase tracking-widest mb-1 block">Alas Kaki Profesional</span>
                        <h3 class="font-bebas text-3xl md:text-4xl text-white">SEPATU OLAHRAGA</h3>
                    </div>
                </div>
            </a>

            <!-- Card Supplements -->
            <a href="{{ route('shop.index', ['category' => 'supplements']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c] border border-white/5 rounded-3xl transition-all duration-500 hover:border-white/20">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/supp-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[10px] uppercase tracking-widest mb-1 block">Nutrisi Olahraga</span>
                        <h3 class="font-bebas text-2xl md:text-3xl text-white">SUPLEMEN</h3>
                    </div>
                </div>
            </a>

            <!-- Card Activewear -->
            <a href="{{ route('shop.index', ['category' => 'activewear']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c] border border-white/5 rounded-3xl transition-all duration-500 hover:border-white/20">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/images/wear-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 z-10">
                        <span class="text-volt font-montserrat font-bold text-[10px] uppercase tracking-widest mb-1 block">Pakaian Performa</span>
                        <h3 class="font-bebas text-2xl md:text-3xl text-white">ACTIVEWEAR</h3>
                    </div>
                </div>
            </a>
            
        </div>
    </div>
</section>

<!-- =========================================
     6. FINAL CTA BANNER
     ========================================= -->
<section class="py-32 w-full text-center relative overflow-hidden flex flex-col items-center justify-center border-t border-white/5">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" alt="Athletes" class="w-full h-full object-cover object-top opacity-10 filter grayscale">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    
    <div class="relative z-10 w-full px-4 gsap-fade-up">
        <h2 class="font-bebas text-6xl sm:text-7xl md:text-[90px] text-white leading-none mb-6 tracking-wide drop-shadow-lg">MULAI DENGAN <span class="text-volt">YANG TERBAIK</span></h2>
        <p class="text-gray-400 max-w-lg mx-auto font-montserrat text-sm sm:text-base font-light mb-10 leading-relaxed">Berhenti berkompromi. Lengkapi dirimu dengan gear pilihan atlet profesional dan rasakan perbedaan kualitas di setiap permainanmu.</p>
        <a href="{{ route('shop.index') }}" class="bg-white text-black px-12 py-4 rounded-full font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-volt transition-all duration-300 shadow-lg">
            Masuk ke Toko
        </a>
    </div>
</section>

<!-- =========================================
     SCRIPT GSAP & CAROUSEL (ROBUST & BUG-FREE)
     ========================================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
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
                    ind.classList.remove('bg-white/30', 'hover:bg-white/60');
                    ind.classList.add('bg-volt');
                } else {
                    ind.classList.remove('bg-volt');
                    ind.classList.add('bg-white/30', 'hover:bg-white/60');
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
                slideInterval = setInterval(nextBanner, 6000); // Geser otomatis tiap 6 detik
            }
        }

        // Mulai auto-slide jika banner > 1
        if (bannerCount > 1) {
            resetInterval();
        }

        // ===========================================
        // GSAP & SCROLL TRIGGER
        // ===========================================
        gsap.registerPlugin(ScrollTrigger);

        // 1. Animasi Masuk (Hero)
        gsap.from(".gsap-hero", {
            y: 40,
            opacity: 0,
            duration: 1,
            stagger: 0.15,
            ease: "power3.out",
            delay: 0.1
        });

        // 2. Animasi Fade Up Standard
        gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
            gsap.from(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                },
                y: 40,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });

        // 3. LOGIC SHOWCASE (CODEPEN INFINITY + TEXT SCROLL)
        const showcase = document.getElementById('showcase-pin');
        const textContainer = document.getElementById('text-container');
        const textWrap = document.getElementById('scroll-text-wrap');
        const cards = gsap.utils.toArray('.cards li');
        
        // Buat Timeline Seamless Loop CodePen Murni
        const seamlessLoop = buildSeamlessLoop(cards, 0.1);

        // Hitung jarak scroll berdasarkan tinggi Teks Wrap dikurangi tinggi layar containernya
        // Ini memastikan teks berhenti tepat saat blok teks terakhir berada di tengah layar
        let scrollDist = textWrap.scrollHeight - textContainer.clientHeight;

        // Buat Timeline Induk yang Menahan Layar (Pin)
        const tlPin = gsap.timeline({
            scrollTrigger: {
                trigger: showcase,
                start: "top top",
                end: "+=" + scrollDist, // Jarak scroll sama dengan tinggi teks
                pin: true,
                scrub: 1.5, // Bikin scroll empuk (smooth)
                anticipatePin: 1
            }
        });

        // A. Animasi Teks Bergerak ke Atas
        tlPin.to(textWrap, {
            y: -scrollDist,
            ease: "none"
        }, 0);

        // B. Sinkronisasi Loop CodePen dengan Scroll
        // Kita mulai dari tengah loop (duration) biar nggak ada gambar kosong di awal
        tlPin.fromTo(seamlessLoop, 
            { totalTime: seamlessLoop.duration() }, 
            { totalTime: seamlessLoop.duration() * 2.5, ease: "none" }, // Muter 2.5 kali selama scroll
            0
        );
    });

    // FUNGSI INTI UNTUK SEAMLESS LOOP (MURNI DARI SCRIPT.JS CODEPEN LU)
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

        gsap.set(items, {xPercent: 400, opacity: 0, scale: 0});

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