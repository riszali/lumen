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
        --volt: #ccff00;      
        --dark: #050505;      
        --card-bg: #0c0c0c;   
        --border: rgba(255, 255, 255, 0.08);
    }

    body {
        background-color: var(--dark);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
    }

    .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.02em; line-height: 0.95; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    .text-volt { color: var(--volt); }
    .bg-volt { background-color: var(--volt); }

    .premium-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.8);
    }

    /* CSS KHUSUS CAROUSEL (GSAP 3D LOOP) */
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
    .cards li img { width: 100%; height: 100%; object-fit: cover; opacity: 1 !important; }

    /* UKURAN HP DISESUAIKAN AGAR TIDAK NABRAK HEADER */
    @media (max-width: 768px) {
        .cards { width: 12rem; height: 16rem; }
        .cards li { width: 12rem; height: 16rem; }
    }

    /* CSS Marquee */
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: flex;
        width: max-content;
        /* Kecepatan disesuaikan menjadi 30s agar mulus setelah item diduplikasi */
        animation: marquee 30s linear infinite; 
        will-change: transform;
        transform: translateZ(0);
    }
</style>

<!-- 1. HERO SECTION -->
<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-[var(--dark)]">
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline disablePictureInPicture disableRemotePlayback preload="metadata" class="w-full h-full object-cover opacity-50">
            <!-- Menambahkan #t=3 agar video mulai dari detik ke-3 -->
            <source src="{{ asset('assets/videos/viper.mp4') }}#t=3" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/10 via-[#050505]/40 to-[#050505]"></div>
    </div>
    <div class="hidden md:block absolute top-[10%] left-[10%] w-[30%] h-[40%] bg-volt rounded-full filter blur-[100px] opacity-10 pointer-events-none z-0"></div>

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

<!-- 2. FULL-WIDTH BANNER CAROUSEL (DARI ADMIN) -->
<!-- Menerapkan aspect-video (16:9) untuk mobile, dan tinggi 85vh untuk desktop -->
<section class="relative w-full aspect-video md:aspect-auto md:h-[85vh] bg-[#050505] overflow-hidden z-20 group border-b border-white/5">
    @if(isset($banners) && $banners->count() > 0)
        <div id="full-banner-track" class="w-full h-full flex transition-transform duration-700 ease-in-out">
            @foreach($banners as $banner)
            <div class="w-full h-full flex-shrink-0 relative">
                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                @if($banner->title)
                <!-- Penyesuaian posisi teks (bottom) agar tidak terpotong di mode 16:9 HP -->
                <div class="absolute bottom-5 left-4 md:bottom-20 md:left-20 max-w-4xl px-4 md:px-0">
                    <div class="border-l-2 md:border-l-4 border-volt pl-3 md:pl-6">
                        <!-- Ukuran teks diperkecil sedikit di HP agar proporsional pada rasio 16:9 -->
                        <h2 class="font-bebas text-3xl sm:text-5xl md:text-8xl text-white tracking-wide drop-shadow-2xl leading-none uppercase">{{ $banner->title }}</h2>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
            <button onclick="prevBanner()" class="absolute left-2 md:left-10 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 md:w-16 md:h-16 bg-black/30 backdrop-blur-md border border-white/10 hover:border-volt hover:bg-volt hover:text-black text-white rounded-full flex items-center justify-center transition-all duration-300 opacity-100 md:opacity-0 md:group-hover:opacity-100 z-30">
                <svg class="w-4 h-4 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextBanner()" class="absolute right-2 md:right-10 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 md:w-16 md:h-16 bg-black/30 backdrop-blur-md border border-white/10 hover:border-volt hover:bg-volt hover:text-black text-white rounded-full flex items-center justify-center transition-all duration-300 opacity-100 md:opacity-0 md:group-hover:opacity-100 z-30">
                <svg class="w-4 h-4 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
            </button>
            
            <!-- INDIKATOR CAROUSEL DI TENGAH -->
            <!-- Penyesuaian jarak (bottom-2) untuk HP agar pas -->
            <div class="absolute bottom-2 md:bottom-10 left-0 w-full flex justify-center gap-1.5 sm:gap-3 z-30">
                @foreach($banners as $index => $banner)
                <button onclick="goToBanner({{ $index }})" class="banner-indicator w-6 sm:w-16 h-1 sm:h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-volt' : 'bg-white/30' }}"></button>
                @endforeach
            </div>
        @endif
    @else
        <div class="w-full h-full relative flex items-center justify-center bg-[#0c0c0c]">
            <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000')] bg-cover bg-center grayscale"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-[#050505]"></div>
        </div>
    @endif
</section>

<!-- 3. MARQUEE BANNER (Dipindah ke bawah Banner Carousel) -->
<div class="w-full bg-[#0a0a0a] border-y border-white/5 py-3 overflow-hidden relative z-20">
    <div class="animate-marquee font-bebas text-2xl text-gray-500 tracking-widest uppercase flex items-center opacity-80">
        <!-- SET 1 -->
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <!-- SET 2 (Diduplikasi untuk mencegah jeda terputus) -->
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KENDALI MUTLAK <span class="text-volt mx-6">//</span> AGILITAS TINGGI <span class="text-volt mx-6">//</span> PERFORMA PUNCAK <span class="text-volt mx-6">//</span></span>
    </div>
</div>

<!-- 4. THE SHOWCASE (SCROLL TRIGGER AKTIF) -->
<section id="showcase-pin" class="w-full h-screen flex flex-col md:flex-row bg-[var(--dark)] overflow-hidden relative border-b border-white/5">
    <!-- PADDING DITAMBAHKAN DI SINI (pt-16 sm:pt-20 md:pt-0) AGAR CAROUSEL HP TIDAK NABRAK HEADER -->
    <div class="w-full md:w-1/2 h-[50vh] md:h-screen flex items-center justify-center relative z-10 bg-[#050505] pt-16 sm:pt-20 md:pt-0">
        <div class="hidden md:block absolute w-[300px] h-[300px] bg-white rounded-full mix-blend-screen filter blur-[150px] opacity-5"></div>
        <ul class="cards z-20">
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" loading="lazy" decoding="async"></li>
            
            <li><img src="{{ asset('assets/images/erjola-qerimi-cosoQpE-4iM-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/gabriel-martin-iLBogzzUhrU-unsplash.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1621252179027-94459d278660?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/Martita-Ortega.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/nox.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" loading="lazy" decoding="async"></li>
            <li><img src="{{ asset('assets/images/siux.webp') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" loading="lazy" decoding="async"></li>
        </ul>
    </div>
    <div id="text-container" class="w-full md:w-1/2 h-[50vh] md:h-screen relative overflow-hidden z-10 bg-[#080808]">
        <div id="scroll-text-wrap" class="absolute top-0 left-0 w-full">
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-6 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">01 // KENDALI MUTLAK</span>
                    <h2 class="text-4xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">PRESISI & KEKUATAN</h2>
                    <p class="text-gray-400 font-montserrat text-xs md:text-base leading-relaxed font-light">Raket padel premium yang direkayasa dengan serat karbon tingkat aerospace. Memberikan transfer energi maksimal tanpa mengorbankan akurasi pukulan Anda pada saat-saat krusial.</p>
                </div>
            </div>
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="premium-card p-6 md:p-14">
                    <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.2em] uppercase mb-4 block">02 // AGILITAS TINGGI</span>
                    <h2 class="text-4xl md:text-7xl font-bebas text-white uppercase tracking-wide mb-4">BERGERAK TANPA RAGU</h2>
                    <p class="text-gray-400 font-montserrat text-xs md:text-base leading-relaxed font-light">Sepatu performa tinggi dengan grip sol inovatif dan bantalan super responsif. Memastikan setiap pijakan, lompatan, dan manuver di lapangan terasa ringan, solid, dan stabil.</p>
                </div>
            </div>
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

<!-- 4.3 SUPPLEMENTS INTRO -->
<section class="py-20 md:py-28 bg-white relative z-20 border-b border-gray-200">
    <div class="max-w-[900px] mx-auto px-4 text-center gsap-fade-up">
        <span class="text-volt font-montserrat font-bold text-[10px] sm:text-xs tracking-[0.3em] uppercase mb-4 flex items-center justify-center gap-3">
            <span class="w-6 sm:w-10 h-[1px] bg-volt"></span>
            Bahan Bakar Sang Juara
            <span class="w-6 sm:w-10 h-[1px] bg-volt"></span>
        </span>
        <h2 class="font-bebas text-5xl md:text-7xl text-gray-900 uppercase tracking-wide mb-6">
            MAXIMIZE YOUR <span class="text-volt">PERFORMANCE</span>
        </h2>
        <p class="text-gray-600 font-montserrat text-sm md:text-base font-medium leading-relaxed max-w-2xl mx-auto">
            Nutrisi adalah kunci dari setiap kemenangan yang konsisten. Rangkaian suplemen premium kami diformulasikan secara khusus untuk memberikan energi instan, menjaga fokus mental Anda tetap tajam, dan memastikan otot pulih lebih cepat setelah pertandingan sengit di lapangan.
        </p>
    </div>
</section>

<!-- 4.4 GYM BACKGROUND BANNER -->
<section class="w-full aspect-video md:aspect-auto md:h-[40vh] relative overflow-hidden z-20 bg-cover bg-center bg-no-repeat border-b border-white/5" style="background-image: url('{{ asset('assets/images/gym.jpg') }}');">
</section>

<!-- 4.4.5 FEATURED SUPPLEMENTS -->
@if(isset($featuredSupplements) && $featuredSupplements->count() > 0)
<section id="featured-supplements" class="py-24 bg-[#050505] relative overflow-hidden z-20 border-b border-white/5 transition-opacity duration-300">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 relative z-10">
        
        <!-- Header Rata Tengah -->
        <div class="mb-14 gsap-fade-up flex flex-col items-center text-center gap-5">
            <div>
                <h2 class="font-bebas text-5xl md:text-6xl text-white uppercase tracking-wide mb-2">TOP <span class="text-volt">SUPPLEMENTS</span></h2>
                <p class="text-gray-400 font-montserrat text-xs sm:text-sm font-bold tracking-widest uppercase flex items-center justify-center gap-3">
                    <span class="w-6 sm:w-10 h-[1px] bg-white/20 hidden sm:block"></span>
                    Kekuatan untuk Juara
                    <span class="w-6 sm:w-10 h-[1px] bg-white/20 hidden sm:block"></span>
                </p>
            </div>
            <a href="{{ route('shop.index', ['category' => 'supplements']) }}" class="text-[10px] text-white font-montserrat font-bold uppercase tracking-widest border border-white/20 hover:border-volt hover:text-volt px-8 py-3 rounded-full transition-all mt-2">Lihat Semua Suplemen</a>
        </div>
        
        <!-- Grid Mobile = 2 kolom, Tablet = 4 kolom, Desktop = 5 kolom -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
            @foreach($featuredSupplements as $product)
            <!-- Card menggunakan Glassmorphism Gelap agar senada dengan background hitam -->
            <div class="{{ $loop->iteration == 5 ? 'hidden lg:flex' : 'flex' }} flex-col bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-3 shadow-lg hover:bg-white/[0.08] hover:border-volt/30 transition-all duration-500 group relative">
                <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden mb-4 aspect-square rounded-[1.5rem] shadow-inner bg-black/50">
                    @if($product->primaryImage)
                        <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white/30 text-[10px] uppercase font-bold tracking-widest font-montserrat">No Image</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0c0c0c]/80 via-transparent to-transparent opacity-90 pointer-events-none"></div>
                    
                    @if($product->discount_price)
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 z-10 pointer-events-none">
                            <span class="bg-red-600 text-white font-montserrat text-[8px] sm:text-[9px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full shadow-lg border border-red-800">
                                -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                            </span>
                        </div>
                    @endif

                    <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10 bg-volt text-black rounded-full p-1.5 shadow-md border border-[#000]">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                </a>
                <div class="text-center px-2 pb-3 flex-grow flex flex-col justify-end font-montserrat">
                    <h4 class="text-white font-bebas text-2xl tracking-wide mb-1 transition group-hover:text-volt line-clamp-1">
                        <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                    </h4>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">{{ $product->brand ?? $product->category->name }}</p>
                    
                    <div class="flex flex-col items-center">
                        @if($product->discount_price)
                            <span class="text-gray-500 line-through text-[9px] font-bold mb-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-volt text-sm font-bold tracking-wider leading-none">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-volt text-sm font-bold tracking-wider leading-none mt-3">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 4.6 FEATURED GEAR -->
<!-- Bagian Featured Gear (selain suplemen) ini dibiarkan tetap putih sesuai konfigurasi sebelumnya -->
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section id="featured-gear" class="py-24 bg-white relative overflow-hidden z-20 border-b border-gray-200 transition-opacity duration-300">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 relative z-10">
        
        <!-- Header Rata Tengah -->
        <div class="mb-14 gsap-fade-up flex flex-col items-center text-center gap-5">
            <div>
                <h2 class="font-bebas text-5xl md:text-6xl text-gray-900 uppercase tracking-wide mb-2">FEATURED <span class="text-volt">GEAR</span></h2>
                <p class="text-gray-500 font-montserrat text-xs sm:text-sm font-bold tracking-widest uppercase flex items-center justify-center gap-3">
                    <span class="w-6 sm:w-10 h-[1px] bg-gray-300 hidden sm:block"></span>
                    Pilihan Utama Sang Juara
                    <span class="w-6 sm:w-10 h-[1px] bg-gray-300 hidden sm:block"></span>
                </p>
            </div>
            <a href="{{ route('shop.index') }}" class="text-[10px] text-gray-900 font-montserrat font-bold uppercase tracking-widest border border-gray-300 hover:border-black hover:bg-black hover:text-white px-8 py-3 rounded-full transition-all mt-2">Lihat Semua</a>
        </div>
        
        <!-- Grid Mobile = 2 kolom, Tablet = 4 kolom, Desktop = 5 kolom -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
            @foreach($featuredProducts as $product)
            <!-- Card Smokey -->
            <div class="{{ $loop->iteration == 5 ? 'hidden lg:flex' : 'flex' }} flex-col bg-[#F5F5F5] border border-gray-200/60 rounded-[2rem] p-3 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1 hover:border-gray-300 transition-all duration-500 group relative">
                <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden mb-4 aspect-square rounded-[1.5rem] bg-white shadow-sm">
                    @if($product->primaryImage)
                        <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-[10px] uppercase font-bold tracking-widest font-montserrat">No Image</div>
                    @endif
                    
                    @if($product->discount_price)
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 z-10 pointer-events-none">
                            <span class="bg-red-600 text-white font-montserrat text-[8px] sm:text-[9px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full shadow-lg border border-red-800">
                                -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                            </span>
                        </div>
                    @endif

                    <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-10 bg-volt text-black rounded-full p-1.5 shadow-md border border-[#000]">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                </a>
                <div class="text-center px-2 pb-3 flex-grow flex flex-col justify-end font-montserrat">
                    <h4 class="text-gray-900 font-bebas text-2xl tracking-wide mb-1 transition group-hover:opacity-70 line-clamp-1">
                        <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                    </h4>
                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-2">{{ $product->brand ?? $product->category->name }}</p>
                    
                    <div class="flex flex-col items-center">
                        @if($product->discount_price)
                            <span class="text-gray-500 line-through text-[9px] font-bold mb-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-black text-sm font-extrabold tracking-wider leading-none">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-black text-sm font-extrabold tracking-wider leading-none mt-3">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- MANUAL PAGINATION: Penyesuaian tema terang -->
        @if(method_exists($featuredProducts, 'hasPages') && $featuredProducts->hasPages())
        <div class="mt-16 relative z-10 w-full flex justify-center">
            <ul class="flex items-center gap-4">
                {{-- Previous Page Link --}}
                @if ($featuredProducts->onFirstPage())
                    <li>
                        <span class="w-12 h-12 rounded-full flex items-center justify-center bg-gray-50 border border-gray-200 text-gray-300 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $featuredProducts->previousPageUrl() }}#featured-gear" class="pagination-ajax-link w-12 h-12 rounded-full flex items-center justify-center bg-white border border-gray-300 text-gray-700 hover:bg-black hover:text-white hover:border-black transition-all duration-300 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </a>
                    </li>
                @endif

                {{-- Halaman Angka Looping --}}
                @for ($page = 1; $page <= $featuredProducts->lastPage(); $page++)
                    @if ($page == $featuredProducts->currentPage())
                        <li>
                            <span class="w-12 h-12 rounded-full flex items-center justify-center bg-[#ccff00] text-black border border-[#ccff00] font-montserrat font-bold text-base shadow-[0_0_15px_rgba(204,255,0,0.4)] cursor-default">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $featuredProducts->url($page) }}#featured-gear" class="pagination-ajax-link w-12 h-12 rounded-full flex items-center justify-center bg-white border border-gray-300 text-gray-700 font-montserrat font-bold text-base hover:bg-black hover:text-white hover:border-black transition-all duration-300">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($featuredProducts->hasMorePages())
                    <li>
                        <a href="{{ $featuredProducts->nextPageUrl() }}#featured-gear" class="pagination-ajax-link w-12 h-12 rounded-full flex items-center justify-center bg-white border border-gray-300 text-gray-700 hover:bg-black hover:text-white hover:border-black transition-all duration-300 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </li>
                @else
                    <li>
                        <span class="w-12 h-12 rounded-full flex items-center justify-center bg-gray-50 border border-gray-200 text-gray-300 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
        @endif
        
    </div>
</section>
@endif

<!-- 5. BENTO GRID KATEGORI -->
<section class="pt-16 relative overflow-hidden z-20 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/BG21.jpg') }}');">
    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-[#050505]/80 z-0"></div>

    <div class="max-w-[1400px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 pb-16 sm:pb-24">
        <!-- Header Kategori -->
        <div class="mb-8 sm:mb-14 gsap-fade-up flex flex-col items-center text-center">
            <h2 class="font-bebas text-5xl md:text-6xl text-white uppercase tracking-wide mb-2">JELAJAHI <span class="text-volt">KOLEKSI KAMI</span></h2>
            <p class="text-gray-400 font-montserrat text-[10px] sm:text-sm font-medium tracking-widest uppercase">Peralatan untuk Setiap Lini Permainan</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 auto-rows-[180px] sm:auto-rows-[220px] md:auto-rows-[300px]">
            <!-- Card Padel -->
            <a href="{{ route('shop.index', ['category' => 'padel-rackets']) }}" class="col-span-1 md:col-span-2 md:row-span-2 group relative overflow-hidden bg-[#0c0c0c]/80 backdrop-blur-sm border border-white/10 rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_20px_40px_rgba(204,255,0,0.15)] hover:-translate-y-1">
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
            <a href="{{ route('shop.index', ['category' => 'sports-shoes']) }}" class="col-span-1 md:col-span-2 group relative overflow-hidden bg-[#0c0c0c]/80 backdrop-blur-sm border border-white/10 rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_20px_40px_rgba(204,255,0,0.15)] hover:-translate-y-1">
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
            <a href="{{ route('shop.index', ['category' => 'supplements']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c]/80 backdrop-blur-sm border border-white/10 rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_20px_40px_rgba(204,255,0,0.15)] hover:-translate-y-1">
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
            <a href="{{ route('shop.index', ['category' => 'activewear']) }}" class="col-span-1 group relative overflow-hidden bg-[#0c0c0c]/80 backdrop-blur-sm border border-white/10 rounded-2xl md:rounded-3xl transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_20px_40px_rgba(204,255,0,0.15)] hover:-translate-y-1">
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

    <!-- BRAND LOGOS (MARQUEE) -->
    <div class="w-full overflow-hidden py-5 sm:py-8 relative gsap-fade-up border-t border-white/5 bg-[#080808]/50 backdrop-blur-sm">
        <div class="absolute inset-y-0 left-0 w-12 sm:w-24 bg-gradient-to-r from-[#050505] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-12 sm:w-24 bg-gradient-to-l from-[#050505] to-transparent z-10 pointer-events-none"></div>
        
        <div class="animate-marquee flex items-center whitespace-nowrap opacity-40">
            <!-- SET 1 -->
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BABOLAT</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">BULLPADEL</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">HEAD</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">OXDOG</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">SIUX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NOX</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">ADIDAS</span>
            <span class="mx-6 sm:mx-12 font-bebas text-3xl sm:text-5xl tracking-widest text-white hover:text-volt transition-colors cursor-default">NIKE</span>
            <!-- SET 2 (Diduplikasi agar rotasi mulus dan tidak terputus di tengah jalan) -->
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

<!-- 6. MARKETPLACE CTA -->
<section class="py-20 bg-[#050505] relative overflow-hidden z-20 border-t border-white/5">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a0a0a] pointer-events-none z-0"></div>
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 relative z-10">
        <div class="text-center mb-12 gsap-fade-up">
            <h2 class="font-bebas text-4xl md:text-5xl text-white uppercase tracking-wide mb-2">OFFICIAL <span class="text-volt">MARKETPLACE</span></h2>
            <p class="text-gray-500 font-montserrat text-xs sm:text-sm font-bold tracking-widest uppercase flex items-center justify-center gap-3">
                <span class="w-6 sm:w-10 h-[1px] bg-volt hidden sm:block"></span>
                Temukan kami di platform favorit Anda
                <span class="w-6 sm:w-10 h-[1px] bg-volt hidden sm:block"></span>
            </p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-10 gsap-fade-up">
            <!-- Tokopedia -->
            <a href="https://www.tokopedia.com/willsportsid" target="_blank" class="group flex flex-col items-center">
                <!-- FRAME FULL COVER -->
                <div class="relative w-48 h-16 sm:w-56 sm:h-20 bg-white/[0.02] backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center hover:border-[#42B549]/80 transition-all duration-300 overflow-hidden shadow-[0_5px_15px_rgba(0,0,0,0.2)] group-hover:-translate-y-1 mb-3">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#42B549]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none"></div>
                    <img src="{{ asset('assets/logo/images (1).png') }}" alt="Tokopedia" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition duration-300 relative z-0">
                </div>
                <span class="font-montserrat font-bold text-gray-400 tracking-widest text-[10px] sm:text-xs uppercase group-hover:text-[#42B549] transition-colors duration-300">Belanja di Tokopedia</span>
            </a>

            <!-- Shopee -->
            <a href="https://shopee.co.id/willsports.id" target="_blank" class="group flex flex-col items-center">
                <!-- FRAME FULL COVER -->
                <div class="relative w-48 h-16 sm:w-56 sm:h-20 bg-white/[0.02] backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center hover:border-[#EE4D2D]/80 transition-all duration-300 overflow-hidden shadow-[0_5px_15px_rgba(0,0,0,0.2)] group-hover:-translate-y-1 mb-3">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#EE4D2D]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none"></div>
                    <img src="{{ asset('assets/logo/26c9324913c021677768.png') }}" alt="Shopee" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition duration-300 relative z-0">
                </div>
                <span class="font-montserrat font-bold text-gray-400 tracking-widest text-[10px] sm:text-xs uppercase group-hover:text-[#EE4D2D] transition-colors duration-300">Belanja di Shopee</span>
            </a>
        </div>
    </div>
</section>

<!-- 7. FINAL CTA BANNER -->
<section class="py-24 md:py-32 w-full relative overflow-hidden flex flex-col items-center justify-center bg-[var(--dark)] border-t border-white/5 z-20">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_60%_60%_at_50%_50%,#000_10%,transparent_100%)]"></div>
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" alt="Athletes" loading="lazy" decoding="async" class="w-full h-full object-cover object-top opacity-10 filter grayscale mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-t from-[var(--dark)] via-[var(--dark)]/80 to-[var(--dark)]"></div>
    </div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] md:w-[50%] h-[50%] bg-volt rounded-full mix-blend-screen filter blur-[200px] opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10 w-[95%] max-w-[1000px] mx-auto px-4 sm:px-0">
        <div class="bg-[#0c0c0c]/80 backdrop-blur-2xl border border-white/10 rounded-[2rem] md:rounded-[3rem] p-8 sm:p-12 md:p-16 text-center shadow-[0_30px_60px_rgba(0,0,0,0.8)] relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-volt/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
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
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full sm:w-auto">
                    <a href="{{ route('shop.index') }}" class="w-full sm:w-auto bg-volt text-black px-10 py-4 rounded-full font-montserrat font-bold uppercase tracking-widest text-xs sm:text-sm hover:bg-white hover:-translate-y-1 transition-all duration-300 shadow-[0_0_20px_rgba(204,255,0,0.2)] hover:shadow-[0_0_30px_rgba(204,255,0,0.4)]">
                        Masuk ke Toko
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT GSAP & REBUILD AJAX PAGINATION -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // --- CAROUSEL BANNER LOGIC ---
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

        window.nextBanner = function() { if (bannerCount > 1) { goToBanner((currentBanner + 1) % bannerCount); } };
        window.prevBanner = function() { if (bannerCount > 1) { goToBanner((currentBanner - 1 + bannerCount) % bannerCount); } };

        function resetInterval() {
            clearInterval(slideInterval);
            if (bannerCount > 1) { slideInterval = setInterval(nextBanner, 6000); }
        }

        if (bannerCount > 1) { resetInterval(); }

        // --- GSAP SCROLL ANIMATION & SHOWCASE 3D CAROUSEL ---
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            gsap.from(".gsap-hero", { y: 40, opacity: 0, duration: 1, stagger: 0.15, ease: "power3.out", delay: 0.1 });
            
            gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
                gsap.from(elem, { scrollTrigger: { trigger: elem, start: "top 85%" }, y: 40, opacity: 0, duration: 1, ease: "power3.out" });
            });

            const showcase = document.getElementById('showcase-pin');
            const textContainer = document.getElementById('text-container');
            const textWrap = document.getElementById('scroll-text-wrap');
            const cards = gsap.utils.toArray('.cards li');
            
            if(showcase && textWrap && cards.length > 0) {
                const seamlessLoop = buildSeamlessLoop(cards, 0.1);
                let scrollDist = textWrap.scrollHeight - textContainer.clientHeight;

                const tlPin = gsap.timeline({
                    scrollTrigger: {
                        trigger: showcase,
                        start: "top top",
                        end: "+=" + scrollDist,
                        pin: true,
                        scrub: 0.5, 
                        anticipatePin: 1
                    }
                });

                tlPin.to(textWrap, { y: -scrollDist, ease: "none" }, 0);
                tlPin.fromTo(seamlessLoop, { totalTime: seamlessLoop.duration() }, { totalTime: seamlessLoop.duration() * 2.5, ease: "none" }, 0);
            }
        }

        // --- AJAX PAGINATION LISTENER ---
        document.addEventListener('click', function(e) {
            let paginationLink = e.target.closest('a.pagination-ajax-link');
            
            if (paginationLink) {
                e.preventDefault(); 
                let url = paginationLink.getAttribute('href');
                let gearSection = document.getElementById('featured-gear');
                
                gearSection.style.opacity = '0.4';
                gearSection.style.pointerEvents = 'none';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(html, 'text/html');
                        let newContent = doc.getElementById('featured-gear').innerHTML;
                        
                        gearSection.innerHTML = newContent;
                        
                        gearSection.style.opacity = '1';
                        gearSection.style.pointerEvents = 'auto';
                        window.history.pushState({path: url}, '', url);
                    })
                    .catch(error => {
                        console.error('AJAX Fetch Error:', error);
                        window.location.href = url;
                    });
            }
        });
    });

    // --- FUNGSI PEMBANTU GSAP 3D LOOP ---
    function buildSeamlessLoop(items, spacing) {
        let overlap = Math.ceil(1 / spacing),
            startTime = items.length * spacing + 0.5,
            loopTime = (items.length + overlap) * spacing + 1,
            rawSequence = gsap.timeline({paused: true}),
            seamlessLoop = gsap.timeline({
                paused: true,
                repeat: -1,
                onRepeat() { this._time === this._dur && (this._tTime += this._dur - 0.01); }
            }),
            l = items.length + overlap * 2,
            time = 0, i, index, item;

        gsap.set(items, {xPercent: 400, opacity: 0, scale: 0, force3D: true, rotationZ: 0.01});

        for (i = 0; i < l; i++) {
            index = i % items.length; item = items[index]; time = i * spacing;
            rawSequence.fromTo(item, {scale: 0, opacity: 0}, {scale: 1, opacity: 1, zIndex: 100, duration: 0.5, yoyo: true, repeat: 1, ease: "power1.in", immediateRender: false}, time)
                       .fromTo(item, {xPercent: 400}, {xPercent: -400, duration: 1, ease: "none", immediateRender: false}, time);
            i <= items.length && seamlessLoop.add("label" + i, time);
        }

        rawSequence.time(startTime);
        seamlessLoop.to(rawSequence, { time: loopTime, duration: loopTime - startTime, ease: "none" })
                    .fromTo(rawSequence, {time: overlap * spacing + 1}, { time: startTime, duration: startTime - (overlap * spacing + 1), immediateRender: false, ease: "none" });
        return seamlessLoop;
    }
</script>
@endsection