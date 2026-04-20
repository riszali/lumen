@extends('layouts.app')

@section('title', 'LUMEN | Fine Jewelry Collection')

@section('content')

<style>
    .pinstack-container {
        --bg: #252322;
        --text: #EDE7D4;
        --muted: rgba(237, 231, 212, 0.72);
        --border: rgba(237, 231, 212, 0.1);
        --shadow: 0 18px 60px rgba(0, 0, 0, 0.45);
        --accent: #AAAB9A;
        --accent2: #9A9587;
        background-color: var(--bg);
        color: var(--text);
        position: relative;
        overflow-x: hidden;
    }

    .pinstack-container .panel {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 24px;
        overflow: hidden;
    }

    .pinstack-container .panel-bg {
        position: absolute;
        inset: -40px;
        pointer-events: none;
    }

    .pinstack-container .grid-bg {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(237, 231, 212, 0.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(237, 231, 212, 0.04) 1px, transparent 1px);
        background-size: 60px 60px;
        opacity: 0.5;
    }

    .pinstack-container .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.15;
        transform: translate3d(0, 0, 0);
    }
    
    .pinstack-container .b1 { left: -10%; top: -10%; background: #9A9587; }
    .pinstack-container .b2 { right: -10%; bottom: -10%; background: #AAAB9A; }

    .pinstack-container .kicker {
        display: inline-block;
        font-size: 12px;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 16px;
    }

    .pinstack-container .title {
        font-size: clamp(32px, 4vw, 56px);
        line-height: 1.1;
        margin: 0 0 20px;
        color: var(--text);
    }

    .pinstack-container .desc {
        margin: 0 0 16px;
        color: var(--muted);
        font-size: clamp(15px, 1.1vw, 18px);
        line-height: 1.8;
        font-weight: 300;
    }

    .pinstack-container .frame {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.02);
        width: 100%;
        aspect-ratio: 1 / 1 !important; 
    }

    .pinstack-container .frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .glass-text-card {
        background: rgba(37, 35, 34, 0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }

    .panel--gallery {
        height: 100vh;
        padding: 0 !important;
        display: flex;
        align-items: center;
        justify-content: flex-start !important; 
        overflow: hidden;
    }
    
    .gallery-track {
        display: flex;
        align-items: center;
        height: 100%;
        width: max-content;
        padding-left: calc(50vw - 240px); 
        padding-right: 50vw; 
        gap: 6rem;
    }

    .gallery-item {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 40px 80px rgba(0,0,0,0.7);
        border: 1px solid rgba(255,255,255,0.1);
        flex-shrink: 0;
        aspect-ratio: 1 / 1 !important; 
        width: 70vw;
        max-width: 480px;
        transform: translateZ(0);
        opacity: 0;
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.2);
        transition: filter 0.4s ease;
    }

    .gallery-item:hover .gallery-img {
        filter: brightness(1.2);
    }

    @media (max-width: 980px) {
        .gallery-track { 
            padding-left: 12vw; 
            gap: 2rem; 
        }
        .gallery-item { 
            width: 76vw; 
            aspect-ratio: 3 / 4 !important;
        }
    }
</style>

<div class="pinstack-container" id="wrap">
    
    <!-- SECTION 1: DISCOVER YOUR ARCHETYPE (Halaman Pertama) -->
    <section id="discover-section" class="panel panel--discover relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-black" style="padding: 0;">
        <canvas id="glcanvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>
        <div class="absolute inset-0 bg-gradient-to-b from-[#252322] via-transparent to-[#252322] z-10 pointer-events-none"></div>

        <div class="absolute bottom-[30%] left-1/2 -translate-x-1/2 w-[80%] max-w-4xl h-24 bg-brand-sage/30 mix-blend-screen filter blur-[70px] rounded-full pointer-events-none z-10"></div>

        <!-- pt-36 ditambahkan agar tidak nabrak navbar di awal -->
        <div class="relative z-20 w-[95%] max-w-[1600px] mx-auto px-4 flex flex-col items-center pt-36 pb-16">

            <div class="flex flex-nowrap justify-center items-center -space-x-3 sm:space-x-0 sm:gap-6 lg:gap-8 w-full mb-6 lg:mb-12 px-2 sm:px-0">
                <div class="relative z-0 transform hover:-translate-y-2 transition-transform duration-500 w-[18%] sm:w-28 lg:w-40 final-img">
                    <div class="w-full aspect-square rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        <img src="{{ asset('assets/images/vs-1.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="relative z-10 transform hover:-translate-y-2 transition-transform duration-500 w-[26%] sm:w-36 lg:w-52 final-img">
                    <div class="w-full aspect-[4/5] rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        <img src="{{ asset('assets/images/an-1.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="relative z-20 transform hover:-translate-y-2 transition-transform duration-500 w-[38%] sm:w-48 lg:w-64 final-img">
                    <div class="w-full aspect-[3/4] rounded-lg sm:rounded-2xl overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.8)] border border-brand-sage/40">
                        <img src="{{ asset('assets/images/fc-1.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="relative z-10 transform hover:-translate-y-2 transition-transform duration-500 w-[26%] sm:w-36 lg:w-52 final-img">
                    <div class="w-full aspect-[4/5] rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        <img src="{{ asset('assets/images/Pic-33.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="relative z-0 transform hover:-translate-y-2 transition-transform duration-500 w-[18%] sm:w-28 lg:w-40 final-img">
                    <div class="w-full aspect-square rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        <img src="{{ asset('assets/images/lv-1.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-0 z-20 relative discover-text">
                <h2 class="title font-serif !text-5xl sm:!text-6xl text-[#EDE7D4] mb-8 drop-shadow-2xl">Discover Your Archetype</h2>
                <a href="{{ route('shop.index') }}" class="inline-block border border-brand-sage text-brand-sage px-10 py-4 uppercase tracking-[0.2em] text-xs font-bold hover:bg-brand-sage hover:text-brand-dark transition duration-300 backdrop-blur-sm">
                    Explore Collection
                </a>
            </div>
            
        </div>

        <div class="absolute bottom-6 inset-x-0 flex justify-center z-20 pointer-events-none">
            <div class="copyBits flex flex-col items-center">
                <span class="text-brand-sage uppercase tracking-[0.4em] text-[10px] font-bold animate-pulse block pl-[0.4em] text-center">Scroll to Explore</span>
                <div class="w-[1px] h-12 bg-gradient-to-b from-brand-sage to-transparent mt-3"></div>
            </div>
        </div>
    </section>

    <!-- SECTION ABOUT LU.MEN -->
    <section id="about-section" class="panel panel--about relative w-full min-h-screen flex flex-col items-center justify-center overflow-hidden bg-[#252322]" style="padding: 0;">
        <canvas id="three-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        <div class="absolute inset-0 bg-gradient-to-b from-[#252322]/40 via-[#252322]/80 to-[#252322] z-10 pointer-events-none"></div>

        <div class="relative z-20 w-[90%] max-w-[1200px] mx-auto px-6 sm:px-8 lg:px-12 text-center">
            <div class="about-kicker mb-12 opacity-0">
                <span class="text-brand-olive uppercase tracking-[0.4em] text-[10px] font-bold">The Philosophy</span>
                <div class="w-[1px] h-16 bg-gradient-to-b from-brand-olive to-transparent mx-auto mt-4"></div>
            </div>
            
            <h2 class="about-text font-serif text-3xl sm:text-4xl md:text-5xl text-brand-cream drop-shadow-md leading-tight mb-12 opacity-0">
                Lu.men comes from the Latin word <i class="text-brand-sage">lumen</i>, meaning light—a symbol of clarity, wisdom, and inner awareness.
            </h2>
            
            <p class="about-text text-brand-gray text-base sm:text-lg md:text-xl font-light tracking-wide leading-relaxed mx-auto max-w-4xl mb-16 opacity-0">
                This brand exists to translate the philosophy of the modern man into crafted metal forms—strength in silence, wisdom engraved in form, and elegance expressed through restraint.
            </p>
            
            <div class="about-text border-t border-white/10 pt-12 mt-12 opacity-0">
                <p class="text-brand-warm text-lg sm:text-xl md:text-2xl font-serif leading-relaxed mx-auto max-w-4xl">
                    Lu.men is not just jewelry. It is a manifestation of inner values and character—the presence of a man who is mature, grounded, and self-composed.
                </p>
            </div>
        </div>
    </section>
    
    <div style="height: 200vh; pointer-events: none;"></div>

    <!-- CHAPTER 1: FORTEM CORPUS INTRO -->
    <section class="panel">
        <div class="panel-bg">
            <span class="blob b1"></span>
            <span class="blob b2"></span>
            <span class="grid-bg"></span>
        </div>
        
        <div class="relative w-[95%] max-w-[1600px] mx-auto flex flex-col lg:block z-10">
            <div class="media w-[85%] sm:w-[75%] lg:w-[40%] mx-auto lg:mx-0 relative z-20">
                <div class="frame">
                    <img src="{{ asset('assets/images/fortem-corpus.jpg') }}" alt="Fortem Corpus" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1617038220319-276d3cfab638?q=80&w=800';" />
                </div>
            </div>
            
            <div class="glass-text-card w-full lg:w-[65%] lg:absolute lg:top-0 lg:right-0 lg:h-full relative z-10 -mt-16 lg:mt-0 flex flex-col justify-center p-8 sm:p-12 lg:p-16 lg:pl-40 xl:pl-56 pt-24 lg:pt-16">
                <div class="kicker">Strength Embodied</div>
                <h2 class="title font-serif">Fortem Corpus</h2>
                <p class="desc">A symbol of resilience and discipline. Fortem Corpus reflects the man who stands firm through silence, grounded, unwavering, and whole. His strength is not loud, but felt in presence.</p>
                <p class="desc mb-0">This Archetype is made for those who seeks leadership and born to wield authority. There is no mountain that couldn’t be move. But a leader is someone who is resilient yet caring for his people.</p>
            </div>
        </div>
    </section>

    <!-- GALERI FORTEM CORPUS DENGAN TEKS SCROLL -->
    <section class="panel panel--gallery">
        <div class="panel-bg"><span class="grid-bg"></span></div>
        
        <!-- FIX: top-16 diganti jadi top-28 agar tidak nabrak navbar -->
        <div class="absolute top-28 md:top-32 w-full text-center z-20 pointer-events-none px-4 gallery-title-wrap">
            <h2 class="font-serif text-4xl sm:text-5xl md:text-6xl text-brand-cream drop-shadow-2xl">Fortem Corpus</h2>
        </div>

        <div class="gallery-track relative z-10">
            <div class="gallery-item">
                <img src="{{ asset('assets/images/fc-1.jpg') }}" class="gallery-img" alt="Fortem Corpus Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/fc-2.jpg') }}" class="gallery-img" alt="Fortem Corpus Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/fc-3.jpg') }}" class="gallery-img" alt="Fortem Corpus Detail">
            </div>
        </div>

        <div class="absolute bottom-10 md:bottom-16 w-full text-center z-20 pointer-events-none px-6 md:px-24 lg:px-48 gallery-desc-wrap">
            <p class="scroll-typewriter font-serif text-brand-cream text-sm md:text-base lg:text-lg leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)] mx-auto max-w-5xl">
                Fortem Corpus is not merely about physical strength; it is the embodiment of control, purpose, and quiet confidence. He leads not by force, but by example—lifting others, protecting those who depend on him, and making decisions that serve a greater vision. In his silence, there is clarity. In his stillness, there is power.
            </p>
        </div>
    </section>

    <!-- CHAPTER 2: ARDENT NEXUM INTRO -->
    <section class="panel">
        <div class="panel-bg">
            <span class="blob b2" style="left: -10%; top: 20%;"></span>
            <span class="blob b1" style="right: -10%; bottom: 0%;"></span>
            <span class="grid-bg"></span>
        </div>
        
        <div class="relative w-[95%] max-w-[1600px] mx-auto flex flex-col lg:block z-10">
            <div class="media w-[85%] sm:w-[75%] lg:w-[40%] mx-auto lg:ml-auto lg:mr-0 relative z-20 order-1">
                <div class="frame">
                    <img src="{{ asset('assets/images/an-2.jpg') }}" alt="Ardent Nexum" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1598560917505-59a3ad559071?w=800';" />
                </div>
            </div>
            
            <div class="glass-text-card w-full lg:w-[65%] lg:absolute lg:top-0 lg:left-0 lg:h-full relative z-10 -mt-16 lg:mt-0 flex flex-col justify-center p-8 sm:p-12 lg:p-16 lg:pr-40 xl:pr-56 pt-24 lg:pt-16 order-2">
                <div class="kicker">Purpose Connected</div>
                <h2 class="title font-serif">Ardent Nexum</h2>
                <p class="desc">Born from clarity and intent, Ardent Nexum represents passion guided by direction. It reminds men that connection gives meaning to ambition, fire with reason, drive with soul.</p>
                <p class="desc mb-0">This Archetype is someone who seeks purpose in life, logical reason of all, and an ambition to achieve the dream of gold. Your coast is clear, the path is forged to your goal.</p>
            </div>
        </div>
    </section>

    <!-- GALERI ARDENT NEXUM DENGAN TEKS SCROLL -->
    <section class="panel panel--gallery">
        <div class="panel-bg"><span class="grid-bg"></span><span class="blob b2" style="right: 20%; top: 10%;"></span></div>
        
        <!-- FIX: top-16 diganti jadi top-28 -->
        <div class="absolute top-28 md:top-32 w-full text-center z-20 pointer-events-none px-4 gallery-title-wrap">
            <h2 class="font-serif text-4xl sm:text-5xl md:text-6xl text-brand-cream drop-shadow-2xl">Ardent Nexum</h2>
        </div>

        <div class="gallery-track relative z-10">
            <div class="gallery-item">
                <img src="{{ asset('assets/images/an-1.jpg') }}" class="gallery-img" alt="Ardent Nexum Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/an-3.jpg') }}" class="gallery-img" alt="Ardent Nexum Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/an-4.jpg') }}" class="gallery-img" alt="Ardent Nexum Detail">
            </div>
        </div>

        <div class="absolute bottom-10 md:bottom-16 w-full text-center z-20 pointer-events-none px-6 md:px-24 lg:px-48 gallery-desc-wrap">
            <p class="scroll-typewriter font-serif text-brand-cream text-sm md:text-base lg:text-lg leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)] mx-auto max-w-5xl">
                Ardent Nexum is the bridge between desire and fulfillment. He builds connections that strengthen his journey between people, ideas, and the vision he holds within. In moments of doubt, he returns to his core, to the reason he began, and from there, his resolve is renewed. For him, success is not merely reaching the summit, but becoming someone worthy of standing there.
            </p>
        </div>
    </section>

    <!-- CHAPTER 3: AURUM ANIMA INTRO -->
    <section class="panel">
        <div class="panel-bg">
            <span class="blob b1"></span>
            <span class="blob b2"></span>
            <span class="grid-bg"></span>
        </div>
        
        <div class="relative w-[95%] max-w-[1600px] mx-auto flex flex-col lg:block z-10">
            <div class="media w-[85%] sm:w-[75%] lg:w-[40%] mx-auto lg:mx-0 relative z-20">
                <div class="frame">
                    <img src="{{ asset('assets/images/aurumanima.jpg') }}" alt="Aurum Anima" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1531995035304-bf9db167a799?q=80&w=1000';" />
                </div>
            </div>
            
            <div class="glass-text-card w-full lg:w-[65%] lg:absolute lg:top-0 lg:right-0 lg:h-full relative z-10 -mt-16 lg:mt-0 flex flex-col justify-center p-8 sm:p-12 lg:p-16 lg:pl-40 xl:pl-56 pt-24 lg:pt-16">
                <div class="kicker">The Golden Soul</div>
                <h2 class="title font-serif">Aurum Anima</h2>
                <p class="desc">Light within movement, grace within creation. Aurum Anima embodies the man whose emotions turn into craftsmanship, whose inner brilliance defines his outer elegance.</p>
                <p class="desc mb-0">This Archetype embodies the artistic soul of man. He who act based on instinct and passion, when his heart speaks louder for the decisions he makes. He who create in infinite, where there is no limit for his creative mind and passionate soul.</p>
            </div>
        </div>
    </section>

    <!-- GALERI AURUM ANIMA DENGAN TEKS SCROLL -->
    <section class="panel panel--gallery">
        <div class="panel-bg"><span class="grid-bg"></span><span class="blob b1" style="left: 30%; bottom: 10%;"></span></div>
        
        <!-- FIX: top-16 diganti jadi top-28 -->
        <div class="absolute top-28 md:top-32 w-full text-center z-20 pointer-events-none px-4 gallery-title-wrap">
            <h2 class="font-serif text-4xl sm:text-5xl md:text-6xl text-brand-cream drop-shadow-2xl">Aurum Anima</h2>
        </div>

        <div class="gallery-track relative z-10">
            <div class="gallery-item">
                <img src="{{ asset('assets/images/aa-1.jpg') }}" class="gallery-img" alt="Aurum Anima Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/aa-2.jpg') }}" class="gallery-img" alt="Aurum Anima Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/aa-3.jpg') }}" class="gallery-img" alt="Aurum Anima Detail">
            </div>
        </div>

        <div class="absolute bottom-10 md:bottom-16 w-full text-center z-20 pointer-events-none px-6 md:px-24 lg:px-48 gallery-desc-wrap">
            <p class="scroll-typewriter font-serif text-brand-cream text-sm md:text-base lg:text-lg leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)] mx-auto max-w-5xl">
                Aurum Anima is the harmony between sensitivity and mastery. He does not suppress emotion. he refines it, turning vulnerability into strength and imagination into legacy. In every creation, there is a piece of his soul, carefully crafted yet effortlessly expressed. His presence inspires not through force, but through beauty, depth, and the quiet confidence of a man who knows that true power can also be gentle.
            </p>
        </div>
    </section>

    <!-- CHAPTER 4: LUCEM VITRUM INTRO -->
    <section class="panel">
        <div class="panel-bg">
            <span class="blob b2" style="left: -10%; top: 20%;"></span>
            <span class="blob b1" style="right: -10%; bottom: 0%;"></span>
            <span class="grid-bg"></span>
        </div>
        
        <div class="relative w-[95%] max-w-[1600px] mx-auto flex flex-col lg:block z-10">
            <div class="media w-[85%] sm:w-[75%] lg:w-[40%] mx-auto lg:ml-auto lg:mr-0 relative z-20 order-1">
                <div class="frame">
                    <img src="{{ asset('assets/images/lv3.jpg') }}" alt="Lucem Vitrum" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1598560917505-59a3ad559071?w=800';" />
                </div>
            </div>
            
            <div class="glass-text-card w-full lg:w-[65%] lg:absolute lg:top-0 lg:left-0 lg:h-full relative z-10 -mt-16 lg:mt-0 flex flex-col justify-center p-8 sm:p-12 lg:p-16 lg:pr-40 xl:pr-56 pt-24 lg:pt-16 order-2">
                <div class="kicker">Authority in Clarity</div>
                <h2 class="title font-serif">Lucem Vitrum</h2>
                <p class="desc">Clear as glass, yet unbreakable. Lucem Vitrum captures composure — the mastery of stillness that commands respect. True authority needs no noise; it shines in quiet clarity.</p>
                <p class="desc mb-0">This Archetype embodies he who seeks order and balance. There are no ripples that can’t be calmed. A wise man who seeks harmony and peace, a friend, not an enemy. For he is the guide and the wisest of all.</p>
            </div>
        </div>
    </section>

    <!-- GALERI LUCEM VITRUM DENGAN TEKS SCROLL -->
    <section class="panel panel--gallery">
        <div class="panel-bg"><span class="grid-bg"></span><span class="blob b2" style="right: 20%; top: 10%;"></span></div>
        
        <!-- FIX: top-16 diganti jadi top-28 -->
        <div class="absolute top-28 md:top-32 w-full text-center z-20 pointer-events-none px-4 gallery-title-wrap">
            <h2 class="font-serif text-4xl sm:text-5xl md:text-6xl text-brand-cream drop-shadow-2xl">Lucem Vitrum</h2>
        </div>

        <div class="gallery-track relative z-10">
            <div class="gallery-item">
                <img src="{{ asset('assets/images/lv-1.jpg') }}" class="gallery-img" alt="Lucem Vitrum Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/lv2.jpg') }}" class="gallery-img" alt="Lucem Vitrum Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/lv4.jpg') }}" class="gallery-img" alt="Lucem Vitrum Detail">
            </div>
        </div>

        <div class="absolute bottom-10 md:bottom-16 w-full text-center z-20 pointer-events-none px-6 md:px-24 lg:px-48 gallery-desc-wrap">
            <p class="scroll-typewriter font-serif text-brand-cream text-sm md:text-base lg:text-lg leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)] mx-auto max-w-5xl">
                Lucem Vitrum is the embodiment of calm authority, measured, deliberate, and unwavering. He does not impose control; he creates balance. His presence alone brings order, his words carry weight because they are chosen with care. In a world of constant motion, he becomes the still point, guiding, resolving, and illuminating the path forward with quiet certainty.
            </p>
        </div>
    </section>

    <!-- CHAPTER 5: VAGUS SPIRITUS INTRO -->
    <section class="panel">
        <div class="panel-bg">
            <span class="blob b1"></span>
            <span class="blob b2"></span>
            <span class="grid-bg"></span>
        </div>
        
        <div class="relative w-[95%] max-w-[1600px] mx-auto flex flex-col lg:block z-10">
            <div class="media w-[85%] sm:w-[75%] lg:w-[40%] mx-auto lg:mx-0 relative z-20">
                <div class="frame">
                    <img src="{{ asset('assets/images/vs-4.jpg') }}" alt="Vagus Spiritus" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1531995035304-bf9db167a799?q=80&w=1000';" />
                </div>
            </div>
            
            <div class="glass-text-card w-full lg:w-[65%] lg:absolute lg:top-0 lg:right-0 lg:h-full relative z-10 -mt-16 lg:mt-0 flex flex-col justify-center p-8 sm:p-12 lg:p-16 lg:pl-40 xl:pl-56 pt-24 lg:pt-16">
                <div class="kicker">The Free-Spirited Soul</div>
                <h2 class="title font-serif">Vagus Spiritus</h2>
                <p class="desc">A reflection of adaptability and courage. Vagus Spiritus belongs to men who walk unknown paths with calm determination, ever-changing, yet always whole.</p>
                <p class="desc mb-0">This Archetype is for he who dared to confront the norm of the ordinary. When there is no limitation on where and who to become. A true free-spirited soul with his desire as his own anchor.</p>
            </div>
        </div>
    </section>

    <!-- GALERI VAGUS SPIRITUS DENGAN TEKS SCROLL -->
    <section class="panel panel--gallery">
        <div class="panel-bg"><span class="grid-bg"></span><span class="blob b1" style="left: 30%; bottom: 10%;"></span></div>
        
        <!-- FIX: top-16 diganti jadi top-28 -->
        <div class="absolute top-28 md:top-32 w-full text-center z-20 pointer-events-none px-4 gallery-title-wrap">
            <h2 class="font-serif text-4xl sm:text-5xl md:text-6xl text-brand-cream drop-shadow-2xl">Vagus Spiritus</h2>
        </div>

        <div class="gallery-track relative z-10">
            <div class="gallery-item">
                <img src="{{ asset('assets/images/v2-3.jpg') }}" class="gallery-img" alt="Vagus Spiritus Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/vs-1.jpg') }}" class="gallery-img" alt="Vagus Spiritus Detail">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('assets/images/vs-2.jpg') }}" class="gallery-img" alt="Vagus Spiritus Detail">
            </div>
        </div>

        <div class="absolute bottom-10 md:bottom-16 w-full text-center z-20 pointer-events-none px-6 md:px-24 lg:px-48 gallery-desc-wrap">
            <p class="scroll-typewriter font-serif text-brand-cream text-sm md:text-base lg:text-lg leading-relaxed drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)] mx-auto max-w-5xl">
                Vagus Spiritus is the embodiment of fluid strength, adaptable, aware, and unapologetically authentic. He does not seek permission to evolve; he claims it. Grounded not by place, but by purpose within, he carries a quiet certainty wherever he goes. For him, the journey is not about escape, but about expansion, becoming.
            </p>
        </div>
    </section>

    <!-- SECTION AKHIR: VIDEO INTRO & CTA -->
    <section class="panel panel--intro flex-col justify-center py-16" style="padding-top: 80px; padding-bottom: 80px;">
        
        <!-- Video Clean -->
        <div class="relative w-[95%] max-w-[1600px] aspect-[9/16] md:aspect-video mx-auto rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.6)] border border-white/10 bg-black/20 mb-12">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-90 md:hidden">
                <source src="{{ asset('assets/videos/discover-mobile.mp4') }}" type="video/mp4">
            </video>
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-90 hidden md:block">
                <source src="{{ asset('assets/videos/diskocer.mp4') }}" type="video/mp4">
            </video>
        </div>

        <!-- CTA Button & Marketplaces -->
        <div class="text-center z-20 relative flex flex-col items-center w-full">
            <a href="{{ route('shop.index') }}" class="inline-block bg-brand-sage/10 border border-brand-sage text-brand-sage px-12 py-4 uppercase tracking-[0.2em] text-xs font-bold hover:bg-brand-sage hover:text-brand-dark transition duration-300 backdrop-blur-sm shadow-[0_0_20px_rgba(170,171,154,0.1)] mb-10">
                Discover The Collection
            </a>
            
            <div class="flex flex-col items-center gap-5">
                <span class="text-[10px] text-brand-gray uppercase tracking-[0.2em] font-semibold">Also Available On</span>
                
                <div class="flex items-center gap-8 text-brand-cream/60">
                    <!-- Tokopedia Logo -->
                    <a href="https://www.tokopedia.com/lumen-7" target="_blank" class="hover:text-brand-sage hover:-translate-y-1 transform transition duration-300" aria-label="Tokopedia">
                        <svg class="w-7 h-7 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.141 11.141c.42.42.659.981.659 1.564 0 .584-.239 1.145-.659 1.565-.42.42-.981.659-1.565.659-.583 0-1.144-.239-1.564-.659-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.564-.659.584 0 1.145.239 1.565.659zm-12.723 0c.42.42.659.981.659 1.564s-.239 1.145-.659 1.565c-.42.42-.981.659-1.564.659s-1.145-.239-1.565-.659c-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.565-.659.583 0 1.144.239 1.564.659zM12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm7.141 14.282c-1.928 1.928-5.213 1.928-7.141 0-1.928-1.928-1.928-5.213 0-7.141s5.213-1.928 7.141 0 1.928 5.213 0 7.141z"/></svg>
                    </a>
                    
                    <!-- Shopee Logo -->
                    <a href="https://shopee.co.id/lu.men" target="_blank" class="hover:text-brand-sage hover:-translate-y-1 transform transition duration-300" aria-label="Shopee">
                        <svg class="w-7 h-7 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.467 6.84a.433.433 0 0 0-.342-.236h-3.411a4.289 4.289 0 0 0-7.428 0H4.875a.434.434 0 0 0-.342.236l-1.928 11.9a.433.433 0 0 0 .093.364.434.434 0 0 0 .34.16h17.924c.143 0 .27-.067.341-.16a.433.433 0 0 0 .092-.364l-1.928-11.9ZM12 3.86a3.42 3.42 0 0 1 2.97 1.714H9.03A3.42 3.42 0 0 1 12 3.86Zm-2.887 9.873c0-.622.504-1.127 1.127-1.127h2.253a.282.282 0 1 1 0 .563h-2.253a.564.564 0 1 0 0 1.127h2.253c.622 0 1.127.505 1.127 1.127s-.505 1.127-1.127 1.127h-2.253a.282.282 0 1 1 0-.563h2.253a.564.564 0 1 0 0-1.127h-2.253a1.127 1.127 0 0 1-1.127-1.127Z"/></svg>
                    </a>
                    
                    <!-- TikTok Logo -->
                    <a href="https://www.tiktok.com/@lu.men___" target="_blank" class="hover:text-brand-sage hover:-translate-y-1 transform transition duration-300" aria-label="TikTok Shop">
                        <svg class="w-7 h-7 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.28-2.26.74-4.63 2.58-5.91 1.18-.87 2.63-1.31 4.1-1.27.33.01.67.03.99.08v4.16c-.57-.17-1.19-.21-1.76-.11-1.06.2-1.95.89-2.4 1.86-.45.97-.39 2.13.15 3.04.54.91 1.52 1.5 2.57 1.55 1.05.04 2.06-.41 2.71-1.23.51-.64.71-1.47.69-2.28-.02-2.92-.01-5.83-.02-8.75-.01-4.32-.01-8.64 0-12.97z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    // OPTIMASI: Variabel global untuk mendeteksi apakah area efek sedang terlihat di layar
    let isDiscoverVisible = true;
    let isAboutVisible = false;

    // GLSL Background Script (Sudah Dioptimasi untuk Mobile)
    function initGLSLBackground() {
        const canvas = document.getElementById("glcanvas");
        if (!canvas) return;
        const gl = canvas.getContext("webgl");
        if (!gl) return;

        // Intersection Observer agar animasi WebGL berhenti saat tidak terlihat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                isDiscoverVisible = entry.isIntersecting;
            });
        }, { threshold: 0.01 });
        observer.observe(document.getElementById("discover-section"));

        function resize() {
            // OPTIMASI: Membatasi pixel ratio maksimal 1.25 untuk HP agar GPU tidak kepanasan
            const d = Math.min(window.devicePixelRatio || 1, 1.25);
            const parent = canvas.parentElement;
            canvas.width = parent.clientWidth * d;
            canvas.height = parent.clientHeight * d;
            gl.viewport(0, 0, canvas.width, canvas.height);
        }
        resize();
        window.addEventListener("resize", resize);

        const vert = `attribute vec2 pos; void main() { gl_Position = vec4(pos, 0.0, 1.0); }`;
        // OPTIMASI: Mengurangi jumlah iterasi shader dari 42 ke 22 dan menggunakan mediump
        const frag = `
            precision mediump float; uniform vec2 u_res; uniform float u_time; uniform float u_speed;
            void main() {
                vec2 FC = gl_FragCoord.xy; float t = u_time * u_speed; vec2 r = u_res;
                vec2 p = (FC * 2.0 - r) / r.y; vec3 c = vec3(0.0);
                for (float i = 0.0; i < 22.0; i++) {
                    float a = i / 1.5 + t * 0.5; vec2 q = p;
                    q.x = q.x + sin(q.y * 19.0 + t * 2.0 + i) * 29.0 * smoothstep(0.0, -2.0, q.y);
                    float d = length(q - vec2(cos(a), sin(a)) * (0.4 * smoothstep(0.0, 0.5, -q.y)));
                    c = c + vec3(0.34, 0.30, 0.24) * (0.015 / d);
                }
                vec3 col = c * c + 0.05; float vignette = smoothstep(2.5, 0.2, length(p));
                gl_FragColor = vec4(col * vignette, 1.0);
            }
        `;
        function compile(src, type) {
            const s = gl.createShader(type); gl.shaderSource(s, src); gl.compileShader(s); return s;
        }
        const program = gl.createProgram();
        gl.attachShader(program, compile(vert, gl.VERTEX_SHADER)); gl.attachShader(program, compile(frag, gl.FRAGMENT_SHADER));
        gl.bindAttribLocation(program, 0, "pos"); gl.linkProgram(program); gl.useProgram(program);
        const buf = gl.createBuffer(); gl.bindBuffer(gl.ARRAY_BUFFER, buf);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 3,-1, -1,3]), gl.STATIC_DRAW);
        gl.enableVertexAttribArray(0); gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);

        const u_res = gl.getUniformLocation(program, "u_res"); const u_time = gl.getUniformLocation(program, "u_time");
        let start = performance.now();
        function draw() {
            requestAnimationFrame(draw);
            // OPTIMASI: Jika section terlewat, jangan hitung grafis
            if (!isDiscoverVisible) return;

            gl.uniform2f(u_res, canvas.width, canvas.height); gl.uniform1f(u_time, (performance.now() - start) * 0.001);
            gl.drawArrays(gl.TRIANGLES, 0, 3); 
        }
        draw();
    }

    // Three.js Initializer (Sudah Dioptimasi untuk Mobile)
    function initThreeJSAbout() {
        const canvas = document.getElementById("three-canvas");
        if (!canvas) return;

        // Intersection Observer agar 3D bola mati saat tidak terlihat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                isAboutVisible = entry.isIntersecting;
            });
        }, { threshold: 0.01 });
        observer.observe(document.getElementById("about-section"));

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: false }); // Antialias dimatikan untuk ringankan GPU
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        // OPTIMASI: Batasi pixel ratio
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.25));

        var textureLoader = new THREE.TextureLoader();
        var textureURL = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/17271/lroc_color_poles_1k.jpg";
        var displacementURL = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/17271/ldem_3_8bit.jpg";
        var worldURL = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/17271/hipp8_s.jpg";

        var texture = textureLoader.load( textureURL );
        var displacementMap = textureLoader.load( displacementURL );
        
        var worldTexture = textureLoader.load( worldURL );
        worldTexture.anisotropy = renderer.capabilities.getMaxAnisotropy();
        worldTexture.minFilter = THREE.LinearFilter;

        // OPTIMASI: Poligon dikurangi drastis (dari 60 ke 32)
        var innerGeo = new THREE.SphereGeometry( 1.2, 32, 32 );
        var innerMat = new THREE.MeshPhongMaterial({
            color: 0xffffff,
            map: texture,
            displacementMap: displacementMap,
            displacementScale: 0.036, 
            bumpMap: displacementMap,
            bumpScale: 0.024,         
            reflectivity: 0,
            shininess: 0
        });

        var innerSphere = new THREE.Mesh(innerGeo, innerMat);
        innerSphere.rotation.x = 3.1415 * 0.02;
        innerSphere.rotation.y = 3.1415 * 1.54;
        scene.add(innerSphere);

        const outerGeo = new THREE.IcosahedronGeometry(2.0, 1);
        const outerMat = new THREE.MeshStandardMaterial({
            color: 0xAAAB9A,
            wireframe: true,
            transparent: true,
            opacity: 0.5
        });
        const outerSphere = new THREE.Mesh(outerGeo, outerMat);
        scene.add(outerSphere);

        const light = new THREE.DirectionalLight(0xFFFFFF, 1.2);
        light.position.set(-100, 10, 50);
        scene.add(light);

        const hemiLight = new THREE.HemisphereLight(0xffffff, 0xffffff, 0.1);
        hemiLight.color.setHSL(0.6, 1, 0.6);
        hemiLight.groundColor.setHSL(0.095, 1, 0.75);
        hemiLight.position.set(0, 0, 0);
        scene.add(hemiLight);

        // OPTIMASI: Mengurangi poligon bintang/luar
        var worldGeometry = new THREE.SphereGeometry( 500, 32, 32 );
        var worldMaterial = new THREE.MeshBasicMaterial({
            color: 0xffffff,
            map: worldTexture,
            side: THREE.BackSide,
            transparent: true,
            opacity: 0.9, 
            blending: THREE.AdditiveBlending 
        });
        var world = new THREE.Mesh(worldGeometry, worldMaterial);
        scene.add(world);

        camera.position.z = 6; 

        function animate() {
            requestAnimationFrame(animate);
            // OPTIMASI: Matikan proses rotasi dan rendering jika section About terlewat
            if (!isAboutVisible) return;

            innerSphere.rotation.y += 0.002;
            innerSphere.rotation.x += 0.0001;
            world.rotation.y += 0.0001;
            world.rotation.x += 0.0005;
            outerSphere.rotation.x += 0.001;
            outerSphere.rotation.y += 0.0015;
            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener("resize", () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        window.threeOuter = outerSphere;
        window.threeInner = innerSphere;
    }

    // Fungsi untuk memecah teks paragraf menjadi span-span (kata per kata) untuk efek typewriter saat scroll
    function setupScrollTypewriter() {
        const elements = document.querySelectorAll('.scroll-typewriter');
        elements.forEach(el => {
            const text = el.innerText;
            const words = text.split(' ');
            el.innerHTML = '';
            words.forEach(word => {
                const span = document.createElement('span');
                span.innerText = word + ' ';
                span.style.opacity = '0.2'; // Opacity awal (redup)
                span.style.transition = 'opacity 0.1s ease';
                el.appendChild(span);
            });
        });
    }

    function loadScript(src) {
        return new Promise((resolve, reject) => {
            const s = document.createElement("script");
            s.src = src; s.async = true; s.onload = resolve; s.onerror = reject; document.head.appendChild(s);
        });
    }

    async function bootPinStack() {
        try {
            await loadScript("https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js");
            initThreeJSAbout(); 

            await loadScript("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js");
            await loadScript("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js");

            gsap.registerPlugin(ScrollTrigger);

            // Set up typewriter spans BEFORE initializing GSAP
            setupScrollTypewriter();

            const panels = gsap.utils.toArray(".panel");
            if (!panels.length) return;

            panels.forEach((panel, i) => {
                const isGallery = panel.classList.contains('panel--gallery');
                const isDiscover = panel.classList.contains('panel--discover');
                const isIntro = panel.classList.contains('panel--intro');
                const isAbout = panel.classList.contains('panel--about'); 
                
                const blobs = panel.querySelectorAll(".blob");
                if (blobs.length) {
                    gsap.to(blobs, { yPercent: () => gsap.utils.random(-15, 15), xPercent: () => gsap.utils.random(-15, 15), ease: "none", scrollTrigger: { trigger: panel, start: "top bottom", end: "bottom top", scrub: true }});
                }

                if (isDiscover) {
                    const finalImages = panel.querySelectorAll(".final-img");
                    gsap.fromTo(panel.querySelector('.discover-text'), { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 1.5, ease: "power3.out", scrollTrigger: { trigger: panel, start: "top 70%" }});
                    if (finalImages.length) {
                        gsap.fromTo(finalImages, { y: 100, opacity: 0, scale: 0.9 }, { y: 0, opacity: 1, scale: 1, duration: 1.5, stagger: 0.15, ease: "power3.out", scrollTrigger: { trigger: panel, start: "top 60%" }});
                    }
                    return; 
                } 
                else if (isAbout) {
                    gsap.set(panel, { transformOrigin: "center center" });
                    
                    const texts = panel.querySelectorAll('.about-text');
                    const kicker = panel.querySelector('.about-kicker');

                    const tlAbout = gsap.timeline({
                        scrollTrigger: {
                            trigger: panel,
                            start: "top top",
                            end: "+=300%", 
                            pin: true,
                            pinSpacing: false, 
                            scrub: 1,
                        }
                    });

                    tlAbout.to(kicker, { opacity: 1, y: 0, duration: 1 }, 0);

                    if (window.threeOuter) {
                        tlAbout.to(window.threeOuter.rotation, { y: Math.PI * 2, x: Math.PI, ease: "none", duration: 6 }, 0);
                        tlAbout.to(window.threeInner.rotation, { y: Math.PI * 1.5, ease: "none", duration: 6 }, 0);
                        tlAbout.to(window.threeOuter.scale, { x: 1.6, y: 1.6, z: 1.6, ease: "none", duration: 6 }, 0);
                        tlAbout.to(window.threeInner.scale, { x: 1.2, y: 1.2, z: 1.2, ease: "none", duration: 6 }, 0);
                    }

                    if(texts.length > 0) tlAbout.to(texts[0], { opacity: 1, y: -20, duration: 1.5 }, 1);
                    if(texts.length > 1) tlAbout.to(texts[1], { opacity: 1, y: -20, duration: 1.5 }, 2.5);
                    if(texts.length > 2) tlAbout.to(texts[2], { opacity: 1, y: -20, duration: 1.5 }, 4);

                    tlAbout.to(panel, { scale: 0.92, opacity: 0.8, duration: 1.5, ease: "none" }, 6);
                    tlAbout.to(panel, { scale: 0.85, opacity: 0.2, duration: 1.5, ease: "none" }, 7.5);
                    
                    return;
                }
                else if (isIntro) {
                    return;
                }
                else if (isGallery) {
                    const track = panel.querySelector('.gallery-track');
                    const items = panel.querySelectorAll('.gallery-item');
                    const images = panel.querySelectorAll('.gallery-img');
                    
                    const titleWrap = panel.querySelector('.gallery-title-wrap');
                    const descWrap = panel.querySelector('.gallery-desc-wrap');
                    const typeWriterSpans = panel.querySelectorAll('.scroll-typewriter span');
                    
                    let scrollWidth = track.scrollWidth - window.innerWidth;

                    const tlGallery = gsap.timeline({
                        scrollTrigger: { trigger: panel, start: "top top", end: () => "+=" + (scrollWidth + window.innerHeight), pin: true, pinSpacing: true, scrub: 1, invalidateOnRefresh: true }
                    });

                    if (titleWrap) tlGallery.fromTo(titleWrap, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.5, ease: "power3.out" }, 0);
                    if (descWrap) tlGallery.fromTo(descWrap, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.5, ease: "power3.out" }, 0);

                    tlGallery.fromTo(items, { opacity: 0, scale: 0.8, y: 100 }, { opacity: 1, scale: 1, y: 0, duration: 1, stagger: 0.2, ease: "power2.out" }, 0);
                    tlGallery.to(track, { x: () => -scrollWidth, ease: "none", duration: 3 }, "+=0.2");
                    
                    // Efek Typewriter Menyala sinkron dengan durasi scroll horizontal (3 detik)
                    if (typeWriterSpans.length > 0) {
                        tlGallery.to(typeWriterSpans, {
                            opacity: 1,
                            stagger: { amount: 3 }, // Durasi stagger disebar merata selama 3 detik
                            ease: "none",
                            duration: 0.1
                        }, "<"); // "<" artinya dimulai bersamaan dengan animasi slide track sebelumnya
                    }

                    if (images.length) {
                        tlGallery.fromTo(images, { xPercent: -10 }, { xPercent: 10, ease: "none", duration: 3 }, "<");
                    }
                } 
                else {
                    const textCards = panel.querySelectorAll(".glass-text-card");
                    const copyBits = panel.querySelectorAll(".kicker, .title, .desc");
                    const media = panel.querySelectorAll(".media");

                    if (media.length) gsap.fromTo(media, { y: 50, opacity: 0, scale: 0.95 }, { y: 0, opacity: 1, scale: 1, duration: 1, ease: "power3.out", scrollTrigger: { trigger: panel, start: "top 80%" }});
                    if (textCards.length) gsap.fromTo(textCards, { opacity: 0 }, { opacity: 1, duration: 1.5, ease: "power2.out", delay: 0.3, scrollTrigger: { trigger: panel, start: "top 80%" }});
                    if (copyBits.length) gsap.fromTo(copyBits, { y: 20, opacity: 0 }, { y: 0, opacity: 1, stagger: 0.1, duration: 1, ease: "power3.out", delay: 0.5, scrollTrigger: { trigger: panel, start: "top 80%" }});

                    const tlStack = gsap.timeline({
                        scrollTrigger: { trigger: panel, start: "bottom bottom", pin: true, pinSpacing: false, scrub: true, onRefresh: () => gsap.set(panel, { transformOrigin: "center " + (panel.offsetHeight - window.innerHeight / 2) + "px" }) }
                    });
                    tlStack.to(panel, { scale: 0.92, opacity: 0.8, duration: 0.6, ease: "none" }, 0).to(panel, { scale: 0.85, opacity: 0.2, duration: 0.6, ease: "none" }, 0.6).to(panel, { opacity: 0, duration: 0.12, ease: "none" }, 1.2);
                }
            });

            setTimeout(() => ScrollTrigger.refresh(), 500); 
            
        } catch (err) {
            console.error(err);
        }
    }

    window.addEventListener("load", () => {
        initGLSLBackground();
        bootPinStack();
    });
</script>
@endsection