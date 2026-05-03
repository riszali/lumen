@extends('layouts.app')

@section('title', 'WILLSPORTS | Defy Your Limits')

@section('content')

<!-- Tambahan Font Khusus Olahraga (Teko) untuk Headline -->
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500;600;700&display=swap" rel="stylesheet">

<style>
    /* Tema Sporty WILLSPORTS */
    .font-sport { font-family: 'Teko', sans-serif; text-transform: uppercase; letter-spacing: 1px; }
    .text-neon { color: #ccff00; }
    .bg-neon { background-color: #ccff00; }
    .border-neon { border-color: #ccff00; }
    
    /* Marquee Animation untuk Teks Berjalan */
    .marquee-wrapper { overflow: hidden; white-space: nowrap; width: 100%; display: flex; background: #ccff00; color: #111; padding: 10px 0; }
    .marquee-content { display: flex; animation: marquee 15s linear infinite; }
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    
    /* Slanted Edges (Potongan Miring khas desain sport) */
    .clip-slant { clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%); }
    .clip-slant-reverse { clip-path: polygon(0 10%, 100% 0, 100% 100%, 0 100%); }
    .button-slant { clip-path: polygon(10px 0, 100% 0, calc(100% - 10px) 100%, 0 100%); }

    body { background-color: #111111; }
</style>

<!-- HERO SECTION (FULL SCREEN) -->
<section class="relative w-full h-screen flex items-center justify-center overflow-hidden clip-slant pb-20">
    <!-- Hero Background Video/Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2000" alt="Athlete Workout" class="w-full h-full object-cover object-center filter grayscale opacity-40 scale-105" id="hero-bg">
        <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-[#111111]/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#111111] via-transparent to-transparent"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 w-[95%] max-w-[1600px] mx-auto px-4 sm:px-8 mt-20 flex flex-col items-start justify-center">
        <div class="gsap-hero-up overflow-hidden">
            <span class="text-neon text-sm sm:text-base font-bold tracking-[0.3em] uppercase mb-4 block">Unleash Your Potential</span>
        </div>
        <div class="gsap-hero-up overflow-hidden mb-6">
            <h1 class="font-sport text-7xl sm:text-8xl md:text-9xl text-white leading-[0.85] drop-shadow-2xl">
                DEFY <br>
                <span class="text-transparent" style="-webkit-text-stroke: 2px #fff;">THE LIMITS</span>
            </h1>
        </div>
        <div class="gsap-hero-up overflow-hidden max-w-xl mb-10">
            <p class="text-gray-300 text-sm sm:text-lg font-light leading-relaxed">
                Premium performance gear engineered for champions. Built with advanced materials to withstand the toughest elements and the hardest grinds.
            </p>
        </div>
        <div class="gsap-hero-up flex gap-4">
            <a href="{{ route('shop.index') }}" class="button-slant bg-neon text-black px-10 py-4 font-bold uppercase tracking-widest text-sm hover:bg-white transition-colors duration-300">
                Shop Men's
            </a>
            <a href="{{ route('shop.index') }}" class="button-slant border-2 border-white/30 text-white px-10 py-4 font-bold uppercase tracking-widest text-sm hover:border-white transition-colors duration-300 backdrop-blur-sm">
                Shop Women's
            </a>
        </div>
    </div>
</section>

<!-- INFINITE MARQUEE (Teks Berjalan) -->
<div class="marquee-wrapper border-y border-[#ccff00]/50 shadow-[0_0_30px_rgba(204,255,0,0.2)] relative z-20 -mt-10 mb-20 transform -rotate-1 origin-left">
    <div class="marquee-content font-sport text-3xl sm:text-4xl tracking-widest flex items-center">
        <span class="mx-8">&bull; POWER</span>
        <span class="mx-8">&bull; ENDURANCE</span>
        <span class="mx-8">&bull; AGILITY</span>
        <span class="mx-8">&bull; PRECISION</span>
        <span class="mx-8">&bull; VELOCITY</span>
        <!-- Duplikat untuk seamless loop -->
        <span class="mx-8">&bull; POWER</span>
        <span class="mx-8">&bull; ENDURANCE</span>
        <span class="mx-8">&bull; AGILITY</span>
        <span class="mx-8">&bull; PRECISION</span>
        <span class="mx-8">&bull; VELOCITY</span>
        <!-- Duplikat ke-2 -->
        <span class="mx-8">&bull; POWER</span>
        <span class="mx-8">&bull; ENDURANCE</span>
        <span class="mx-8">&bull; AGILITY</span>
        <span class="mx-8">&bull; PRECISION</span>
        <span class="mx-8">&bull; VELOCITY</span>
    </div>
</div>

<!-- SHOP BY DISCIPLINE (Menggantikan Archetype) -->
<section class="py-16 w-[95%] max-w-[1600px] mx-auto px-4 sm:px-8 relative z-20">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gsap-fade-up">
        <div>
            <span class="text-neon text-xs font-bold tracking-[0.2em] uppercase mb-2 block">Our Categories</span>
            <h2 class="font-sport text-5xl sm:text-6xl text-white">SHOP BY DISCIPLINE</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="text-white hover:text-neon uppercase tracking-widest text-xs font-bold transition flex items-center gap-2 mt-4 md:mt-0 pb-2 border-b border-white/20 hover:border-neon">
            View All Gear <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>

    <!-- Grid Kartu Olahraga -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[70vh] md:h-[60vh] lg:h-[70vh]">
        <!-- Card 1: Power -->
        <a href="{{ route('shop.index') }}" class="group relative block w-full h-full rounded-2xl overflow-hidden gsap-fade-up">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1000" alt="Powerlifting" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="font-sport text-4xl text-white mb-1">POWER CORE</h3>
                <p class="text-gray-400 text-sm font-light uppercase tracking-wider">Heavy lifting & Strength</p>
                <div class="h-[2px] w-0 bg-neon mt-4 transition-all duration-500 group-hover:w-1/3"></div>
            </div>
        </a>

        <!-- Card 2: Speed -->
        <a href="{{ route('shop.index') }}" class="group relative block w-full h-full rounded-2xl overflow-hidden gsap-fade-up" style="transition-delay: 100ms;">
            <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?q=80&w=1000" alt="Running" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="font-sport text-4xl text-white mb-1">AERO SPRINT</h3>
                <p class="text-gray-400 text-sm font-light uppercase tracking-wider">Running & Track</p>
                <div class="h-[2px] w-0 bg-neon mt-4 transition-all duration-500 group-hover:w-1/3"></div>
            </div>
        </a>

        <!-- Card 3: Agility -->
        <a href="{{ route('shop.index') }}" class="group relative block w-full h-full rounded-2xl overflow-hidden gsap-fade-up" style="transition-delay: 200ms;">
            <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=1000" alt="Agility Training" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="font-sport text-4xl text-white mb-1">FLEX DYNAMICS</h3>
                <p class="text-gray-400 text-sm font-light uppercase tracking-wider">Mobility & Yoga</p>
                <div class="h-[2px] w-0 bg-neon mt-4 transition-all duration-500 group-hover:w-1/3"></div>
            </div>
        </a>
    </div>
</section>

<!-- TECHNOLOGY / PHILOSOPHY SECTION -->
<section class="py-24 relative overflow-hidden bg-[#0a0a0a] mt-20 border-y border-white/5">
    <div class="absolute top-1/2 left-0 transform -translate-y-1/2 w-96 h-96 bg-neon rounded-full mix-blend-screen filter blur-[200px] opacity-10 pointer-events-none"></div>

    <div class="w-[95%] max-w-[1600px] mx-auto px-4 sm:px-8 flex flex-col lg:flex-row items-center gap-16 relative z-10">
        
        <!-- Tech Image -->
        <div class="w-full lg:w-1/2 relative gsap-fade-up">
            <div class="absolute inset-0 border-2 border-neon/30 rounded-3xl translate-x-4 translate-y-4"></div>
            <div class="relative rounded-3xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1606335543042-57c525922933?q=80&w=1000" alt="Activewear Fabric Tech" class="w-full aspect-[4/5] sm:aspect-square lg:aspect-[4/5] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                <div class="absolute bottom-6 right-6 bg-black/80 backdrop-blur-md px-6 py-4 rounded-xl border border-white/10">
                    <span class="block text-white font-bold tracking-widest uppercase text-sm mb-1">AeroKnit™</span>
                    <span class="text-gray-400 text-xs uppercase">Engineered Fabric</span>
                </div>
            </div>
        </div>

        <!-- Tech Text -->
        <div class="w-full lg:w-1/2 gsap-fade-up" style="transition-delay: 150ms;">
            <span class="text-neon text-xs font-bold tracking-[0.2em] uppercase mb-4 block">The Philosophy</span>
            <h2 class="font-sport text-5xl sm:text-6xl text-white mb-6">BUILT FOR THE RELENTLESS</h2>
            <div class="space-y-6 text-gray-300 font-light leading-relaxed text-base sm:text-lg">
                <p>
                    At <span class="font-bold text-white tracking-widest uppercase">Willsports</span>, we believe that progress is measured in sweat, discipline, and the refusal to quit. Our gear is not just apparel; it's your armor.
                </p>
                <p>
                    Engineered with proprietary moisture-wicking technology, four-way stretch dynamics, and extreme durability, every fiber is designed to adapt to your body's highest physical output. 
                </p>
            </div>
            
            <div class="grid grid-cols-2 gap-6 mt-10 border-t border-white/10 pt-10">
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest text-sm mb-2">Ultra-Light</h4>
                    <p class="text-gray-400 text-xs">Maximum mobility without the drag.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest text-sm mb-2">Thermo-Regulated</h4>
                    <p class="text-gray-400 text-xs">Stay cool when the heat turns up.</p>
                </div>
            </div>
            
            <a href="{{ route('shop.index') }}" class="button-slant inline-block bg-white text-black px-10 py-4 font-bold uppercase tracking-widest text-sm hover:bg-neon transition-colors duration-300 mt-12">
                Discover Technology
            </a>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-32 w-full text-center relative overflow-hidden flex flex-col items-center justify-center">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" alt="Athletes" class="w-full h-full object-cover object-top opacity-20 grayscale">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    </div>
    
    <div class="relative z-10 w-full px-4 gsap-fade-up">
        <h2 class="font-sport text-6xl sm:text-7xl md:text-8xl text-white mb-6">READY TO PERFORM?</h2>
        <p class="text-gray-300 max-w-lg mx-auto font-light mb-12">Gear up with the choice of elite athletes. Join the Willsports community today.</p>
        <a href="{{ route('shop.index') }}" class="button-slant inline-block bg-neon text-black px-12 py-5 font-bold uppercase tracking-[0.2em] text-sm hover:bg-white hover:scale-105 transition-all duration-300">
            Enter The Store
        </a>
    </div>
</section>

<!-- Script Animasi Sederhana GSAP (Sangat Ringan, Bebas Error) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.registerPlugin(ScrollTrigger);

        // Animasi Teks Hero saat pertama kali load
        gsap.from(".gsap-hero-up", {
            y: 100,
            opacity: 0,
            duration: 1.2,
            stagger: 0.15,
            ease: "power4.out",
            delay: 0.2
        });

        // Animasi perlahan background hero (Parallax ringan)
        gsap.to("#hero-bg", {
            yPercent: 20,
            ease: "none",
            scrollTrigger: {
                trigger: "body",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });

        // Animasi fade up otomatis saat di-scroll
        gsap.utils.toArray('.gsap-fade-up').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: "top 85%", // Mulai animasi saat elemen 85% terlihat dari atas
                    toggleActions: "play none none reverse"
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });
    });
</script>
@endsection