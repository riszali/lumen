@extends('layouts.app')

@section('title', 'WILLSPORTS | Lampaui Batasmu')

@section('content')

<!-- Font Khusus Sports: Teko untuk Headline yang Agresif, Inter untuk Body -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500;600;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    /* RESET & TEMA SPORTY ELEGANT (GLASSMORPHISM) */
    :root {
        --volt: #ccff00;      /* Neon Green Khas Sports */
        --dark: #09090b;      /* Deep Black */
        --border: rgba(255, 255, 255, 0.1);
        --glass-bg: rgba(255, 255, 255, 0.02);
    }

    body {
        background-color: var(--dark);
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
    }

    .font-teko {
        font-family: 'Teko', sans-serif;
        text-transform: uppercase;
        line-height: 0.9;
    }

    .text-volt { color: var(--volt); }
    .bg-volt { background-color: var(--volt); }

    /* Efek Kaca (Glassmorphism) */
    .glass-panel {
        background: var(--glass-bg);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid var(--border);
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
    }

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
        border-radius: 2rem; /* ROUNDED CORNERS */
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.6);
    }

    .cards li img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1 !important; 
        filter: grayscale(10%) contrast(1.1);
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
     1. HERO SECTION (SPORTY & GLASSMORPHISM)
     ========================================= -->
<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-[var(--dark)]">
    
    <!-- Latar Belakang & Glowing Orbs -->
    <div class="absolute inset-0 z-0">
        <!-- Video Background dengan opacity tipis -->
        <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-20">
            <source src="{{ asset('assets/videos/viper.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-[#09090b]/40 via-[#09090b]/80 to-[#09090b]"></div>
    </div>

    <!-- Cahaya Pendar (Glow) -->
    <div class="absolute top-[20%] left-[20%] w-[30%] h-[40%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-15 pointer-events-none z-0"></div>
    <div class="absolute bottom-[10%] right-[10%] w-[40%] h-[50%] bg-[#00E5FF] rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <!-- Konten Hero -->
    <div class="relative z-10 w-[95%] max-w-[1200px] mx-auto px-4 flex flex-col items-center text-center pt-24">
        
        <!-- Kicker tanpa desain kapsul dan titik AI yang kaku -->
        <div class="gsap-hero mb-6">
            <div class="border-b-2 border-volt pb-2 px-2 inline-block">
                <span class="text-white font-inter font-bold tracking-[0.3em] uppercase text-xs sm:text-sm">
                    WILLSPORTS <span class="text-volt mx-2">//</span> PERLENGKAPAN PADEL
                </span>
            </div>
        </div>

        <div class="gsap-hero mb-8 w-full">
            <h1 class="font-teko text-[70px] sm:text-[100px] md:text-[140px] text-white tracking-wide drop-shadow-2xl uppercase leading-[0.9]">
                LAMPAUI <br class="md:hidden"><span class="text-transparent" style="-webkit-text-stroke: 2px var(--volt);">BATASMU</span>
            </h1>
            <p class="text-gray-400 font-inter text-base sm:text-lg font-light max-w-2xl mx-auto leading-relaxed mt-4">
                Didesain untuk performa maksimal. Lengkapi dirimu dengan senjata pilihan atlet profesional dan dominasi setiap pertandingan.
            </p>
        </div>

        <div class="gsap-hero flex flex-col sm:flex-row justify-center gap-5 mt-4 w-full">
            <a href="{{ route('shop.index') }}" class="bg-volt text-black px-10 py-4 rounded-full font-bold uppercase tracking-widest text-sm hover:bg-white hover:-translate-y-1 transition-all duration-300 shadow-[0_0_20px_rgba(204,255,0,0.2)] hover:shadow-[0_0_30px_rgba(204,255,0,0.4)]">
                Belanja Koleksi
            </a>
            <a href="#showcase-pin" class="glass-panel text-white px-10 py-4 rounded-full font-bold uppercase tracking-widest text-sm hover:bg-white/10 hover:border-white/30 hover:-translate-y-1 transition-all duration-300">
                Jelajahi Produk
            </a>
        </div>
    </div>
</section>

<!-- =========================================
     2. MARQUEE BANNER (ROUNDED & ELEGANT)
     ========================================= -->
<div class="w-full bg-white/[0.02] border-y border-white/5 py-4 overflow-hidden relative z-20 backdrop-blur-md">
    <div class="animate-marquee font-teko text-2xl text-gray-400 tracking-widest uppercase flex items-center">
        <!-- Mengganti bulatan/titik menjadi slash sporty -->
        <span class="px-8 flex items-center">KUASAI LAPANGAN <span class="text-volt mx-6">//</span> LEPASKAN KEKUATANMU <span class="text-volt mx-6">//</span> PERLENGKAPAN PADEL ELIT <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KUASAI LAPANGAN <span class="text-volt mx-6">//</span> LEPASKAN KEKUATANMU <span class="text-volt mx-6">//</span> PERLENGKAPAN PADEL ELIT <span class="text-volt mx-6">//</span></span>
        <span class="px-8 flex items-center">KUASAI LAPANGAN <span class="text-volt mx-6">//</span> LEPASKAN KEKUATANMU <span class="text-volt mx-6">//</span> PERLENGKAPAN PADEL ELIT <span class="text-volt mx-6">//</span></span>
    </div>
</div>

<!-- =========================================
     3. THE SHOWCASE (CODEPEN INFINITY + TEXT SCROLL)
     ========================================= -->
<section id="showcase-pin" class="w-full h-screen flex flex-col md:flex-row bg-[var(--dark)] overflow-hidden relative border-b border-white/5">
    
    <!-- Ambient Light Background Showcase -->
    <div class="absolute inset-0 flex justify-center items-center pointer-events-none z-0">
        <div class="w-[500px] h-[500px] bg-volt rounded-full mix-blend-screen filter blur-[200px] opacity-10"></div>
    </div>

    <!-- Sisi Kiri: Slider CodePen (Latar Transparan) -->
    <div class="w-full md:w-1/2 h-[50vh] md:h-screen flex items-center justify-center relative z-10">
        <!-- UL Cards bawaan struktur CodePen -->
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

    <!-- Sisi Kanan: Teks yang di Scroll (Terbungkus Glass Card agar tidak bertabrakan) -->
    <div id="text-container" class="w-full md:w-1/2 h-[50vh] md:h-screen relative overflow-hidden z-10">
        <div id="scroll-text-wrap" class="absolute top-0 left-0 w-full">
            
            <!-- Blok Teks 1: Raket Padel -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="glass-panel p-8 md:p-12 rounded-[2.5rem]">
                    <span class="text-volt font-inter font-bold text-xs tracking-[0.2em] uppercase mb-4 block">01 // Senjata Utama</span>
                    <h2 class="text-5xl md:text-6xl font-teko text-white uppercase tracking-wide">Raket Padel<br>Profesional</h2>
                    <p class="text-gray-400 mt-4 font-inter text-sm md:text-base leading-relaxed font-light">Didesain untuk smash eksplosif dan kontrol mutlak. Hadir dengan sweet spot optimal dan teknologi karbon dari Babolat, Bullpadel, HEAD, Oxdog, dan Siux. Senjata pilihan atlet Premier Padel.</p>
                </div>
            </div>

            <!-- Blok Teks 2: Sepatu -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="glass-panel p-8 md:p-12 rounded-[2.5rem]">
                    <span class="text-volt font-inter font-bold text-xs tracking-[0.2em] uppercase mb-4 block">02 // Mobilitas</span>
                    <h2 class="text-5xl md:text-6xl font-teko text-white uppercase tracking-wide">Dominasi<br>Lapangan</h2>
                    <p class="text-gray-400 mt-4 font-inter text-sm md:text-base leading-relaxed font-light">Kuasai lapangan dengan kelincahan tanpa batas. Material super ringan berpadu dengan traksi maksimal pada sol khusus. Jaga pijakan tetap stabil saat menahan vibora lawan.</p>
                </div>
            </div>

            <!-- Blok Teks 3: Nutrisi -->
            <div class="h-[50vh] md:h-screen flex flex-col justify-center px-4 md:px-12 py-10">
                <div class="glass-panel p-8 md:p-12 rounded-[2.5rem]">
                    <span class="text-volt font-inter font-bold text-xs tracking-[0.2em] uppercase mb-4 block">03 // Performa</span>
                    <h2 class="text-5xl md:text-6xl font-teko text-white uppercase tracking-wide">Energi Tanpa<br>Henti</h2>
                    <p class="text-gray-400 mt-4 font-inter text-sm md:text-base leading-relaxed font-light">Bertahan lebih lama di reli yang alot. Dari pre-workout untuk ledakan fokus, isotonic gel, hingga formula pemulihan otot pasca tanding. Nutrisi esensial untuk performa puncak.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================
     4. BENTO GRID (KATEGORI PRODUK)
     ========================================= -->
<section class="py-24 bg-[var(--dark)] px-4 sm:px-8 lg:px-12 relative overflow-hidden">
    
    <!-- Ambient Blur -->
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-volt rounded-full mix-blend-screen filter blur-[200px] opacity-10"></div>

    <div class="max-w-[1400px] mx-auto relative z-10">
        <div class="text-center mb-16 gsap-fade-up">
            <h2 class="font-teko text-5xl md:text-7xl text-white uppercase tracking-wide">Jelajahi Kategori</h2>
            <p class="text-gray-400 font-inter text-sm font-light mt-2 tracking-widest uppercase">Peralatan untuk Setiap Lini Permainan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[250px] md:auto-rows-[300px]">
            
            <!-- Card Padel -->
            <a href="{{ route('shop.index', ['category' => 'padel-rackets']) }}" class="col-span-1 md:col-span-2 row-span-1 md:row-span-2 group relative overflow-hidden bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-2 hover:bg-white/[0.05] transition-all duration-500">
                <div class="relative w-full h-full rounded-[2rem] overflow-hidden">
                    <img src="{{ asset('assets/images/padel-rack-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=800'" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 z-10">
                        <span class="glass-panel text-white font-inter font-bold text-[10px] uppercase tracking-widest mb-3 px-3 py-1.5 rounded-full inline-block">Senjata Utama</span>
                        <h3 class="font-teko text-5xl md:text-6xl text-white">RAKET PADEL</h3>
                    </div>
                </div>
            </a>

            <!-- Card Shoes -->
            <a href="{{ route('shop.index', ['category' => 'sports-shoes']) }}" class="col-span-1 md:col-span-2 group relative overflow-hidden bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-2 hover:bg-white/[0.05] transition-all duration-500">
                <div class="relative w-full h-full rounded-[2rem] overflow-hidden">
                    <img src="{{ asset('assets/images/shoes-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800'" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 z-10">
                        <span class="glass-panel text-white font-inter font-bold text-[10px] uppercase tracking-widest mb-3 px-3 py-1.5 rounded-full inline-block">Kelincahan</span>
                        <h3 class="font-teko text-4xl text-white">SEPATU PADEL</h3>
                    </div>
                </div>
            </a>

            <!-- Card Supplements -->
            <a href="{{ route('shop.index', ['category' => 'supplements']) }}" class="col-span-1 group relative overflow-hidden bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-2 hover:bg-white/[0.05] transition-all duration-500">
                <div class="relative w-full h-full rounded-[2rem] overflow-hidden">
                    <img src="{{ asset('assets/images/supp-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 z-10">
                        <span class="glass-panel text-white font-inter font-bold text-[10px] uppercase tracking-widest mb-2 px-3 py-1.5 rounded-full inline-block">Energi</span>
                        <h3 class="font-teko text-3xl text-white">SUPLEMEN</h3>
                    </div>
                </div>
            </a>

            <!-- Card Activewear -->
            <a href="{{ route('shop.index', ['category' => 'activewear']) }}" class="col-span-1 group relative overflow-hidden bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-2 hover:bg-white/[0.05] transition-all duration-500">
                <div class="relative w-full h-full rounded-[2rem] overflow-hidden">
                    <img src="{{ asset('assets/images/wear-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600'" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 z-10">
                        <span class="glass-panel text-white font-inter font-bold text-[10px] uppercase tracking-widest mb-2 px-3 py-1.5 rounded-full inline-block">Kenyamanan</span>
                        <h3 class="font-teko text-3xl text-white">PAKAIAN OLAHRAGA</h3>
                    </div>
                </div>
            </a>
            
        </div>
    </div>
</section>

<!-- =========================================
     5. FINAL CTA BANNER
     ========================================= -->
<section class="py-32 w-full text-center relative overflow-hidden flex flex-col items-center justify-center">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" alt="Athletes" class="w-full h-full object-cover object-top opacity-20 filter grayscale">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    
    <div class="relative z-10 w-full px-4 gsap-fade-up">
        <h2 class="font-teko text-6xl sm:text-7xl md:text-[100px] text-white leading-none mb-6 tracking-tight drop-shadow-lg">BERGABUNG BERSAMA <span class="text-volt">PARA ELIT</span></h2>
        <p class="text-gray-300 max-w-lg mx-auto font-inter text-sm sm:text-base font-light mb-10">Lengkapi dirimu dengan perlengkapan pilihan atlet profesional. Rasakan kualitas tanpa kompromi dan kuasai setiap pertandingan padelmu.</p>
        <a href="{{ route('shop.index') }}" class="glass-panel bg-white/10 text-white px-12 py-5 rounded-full font-bold uppercase tracking-[0.2em] text-sm hover:bg-volt hover:text-black hover:border-volt transition-all duration-300">
            Mulai Berbelanja
        </a>
    </div>
</section>

<!-- =========================================
     SCRIPT GSAP (ROBUST & BUG-FREE)
     ========================================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        gsap.registerPlugin(ScrollTrigger);

        // 1. Animasi Masuk (Hero)
        gsap.from(".gsap-hero", {
            y: 50,
            opacity: 0,
            duration: 1.2,
            stagger: 0.15,
            ease: "power3.out",
            delay: 0.2
        });

        // 2. Animasi Fade Up Standard
        gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
            gsap.from(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                },
                y: 50,
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