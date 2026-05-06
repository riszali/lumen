<header class="fixed top-0 left-0 w-full z-[100] transition-all duration-300 px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 pointer-events-none">
    <div class="w-[95%] max-w-[1600px] mx-auto pointer-events-auto relative">
        <!-- Floating Glass Container -->
        <div id="navbar-container" class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] px-4 sm:px-10 h-16 sm:h-20 flex justify-between items-center relative overflow-hidden group transition-all duration-300">
            
            <div class="hidden md:block absolute inset-0 bg-gradient-to-r from-[#ccff00]/5 via-transparent to-[#00E5FF]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>

            <!-- Left Navigation (Desktop) & Hamburger (Mobile) -->
            <div class="flex items-center min-w-[50px] md:min-w-[200px] relative z-30">
                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-full border border-white/10 text-gray-400 hover:bg-white/10 hover:text-white transition-colors focus:outline-none" aria-label="Toggle Menu">
                    <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <nav class="hidden md:flex items-center space-x-10 font-montserrat">
                    <a href="{{ route('home') }}" class="relative text-gray-400 hover:text-white transition-colors uppercase tracking-[0.25em] text-[10px] font-bold group/link">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-[#ccff00] transition-all duration-300 group-hover/link:w-full"></span>
                    </a>
                    <a href="{{ route('shop.index') }}" class="relative text-gray-400 hover:text-white transition-colors uppercase tracking-[0.25em] text-[10px] font-bold group/link">
                        Shop
                        <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-[#ccff00] transition-all duration-300 group-hover/link:w-full"></span>
                    </a>
                </nav>
            </div>

            <!-- Center Logo -->
            <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                <a href="{{ route('home') }}" class="block transform hover:scale-105 transition duration-500 pointer-events-auto">
                    <img src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-10 sm:h-14 md:h-20 w-auto object-contain scale-125 sm:scale-150 drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]">
                </a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center justify-end min-w-[50px] md:min-w-[200px] space-x-4 sm:space-x-8 relative z-30 font-montserrat">
                @auth
                    <div class="flex items-center space-x-4 sm:space-x-6">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:block text-[#ccff00] hover:text-white text-[10px] uppercase tracking-widest font-bold transition">Admin Dashboard</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="hidden sm:block text-gray-400 hover:text-white text-[10px] uppercase tracking-widest font-bold transition">Account</a>
                            <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white flex items-center group/cart relative transition-colors">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <span class="hidden sm:inline-block ml-2 text-[10px] uppercase tracking-widest font-bold">Cart</span>
                                @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                    <span class="absolute -top-2 -right-2 sm:-right-3 bg-[#ccff00] text-black text-[9px] rounded-full w-4 h-4 flex items-center justify-center font-bold shadow-md font-montserrat">
                                        {{ auth()->user()->cart->items->count() }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline">
                            @csrf
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full border border-white/10 text-gray-400 hover:bg-white/10 hover:text-red-400 transition" title="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-white/5 hover:bg-[#ccff00] border border-white/10 hover:border-[#ccff00] text-white hover:text-black px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-[10px] uppercase tracking-widest font-bold transition duration-300 md:backdrop-blur-md">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Drawer Menu (Glassmorphism) -->
        <div id="mobile-drawer" class="absolute top-20 left-0 w-full opacity-0 pointer-events-none -translate-y-4 transition-all duration-300 z-50 md:hidden will-change-transform">
            <div class="bg-[#050505]/90 backdrop-blur-2xl border border-white/10 rounded-[1.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.6)] p-6 flex flex-col space-y-6">
                <nav class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">HOME</a>
                    <a href="{{ route('shop.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">SHOP</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-[#ccff00] text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">ADMIN PANEL</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">MY ACCOUNT</a>
                            <a href="{{ route('cart.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3 flex justify-between items-center">
                                KERANJANG
                                @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                    <span class="bg-[#ccff00] text-black text-xs px-2.5 py-0.5 rounded-full font-montserrat font-bold">{{ auth()->user()->cart->items->count() }}</span>
                                @endif
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="pt-2">
                            @csrf
                            <button type="submit" class="text-red-400 text-lg font-bebas tracking-wide text-left w-full hover:text-red-300 transition">SIGN OUT</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#ccff00] text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">SIGN IN</a>
                    @endauth
                </nav>

                <!-- BAGIAN SOCIAL MEDIA DIUBAH MENJADI ICON SVG -->
                <div class="pt-2 flex justify-between items-center text-[10px] text-gray-500 font-montserrat tracking-widest uppercase font-bold border-t border-white/5 mt-2">
                    <span>WILLSPORTS Gear</span>
                    <div class="flex space-x-5">
                        <a href="https://www.instagram.com/willsports___/" target="_blank" aria-label="Instagram" class="text-gray-500 hover:text-[#ccff00] transition-colors">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@willsports___" target="_blank" aria-label="TikTok" class="text-gray-500 hover:text-[#ccff00] transition-colors">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.28-2.26.74-4.63 2.58-5.91 1.18-.87 2.63-1.31 4.1-1.27.33.01.67.03.99.08v4.16c-.57-.17-1.19-.21-1.76-.11-1.06.2-1.95.89-2.4 1.86-.45.97-.39 2.13.15 3.04.54.91 1.52 1.5 2.57 1.55 1.05.04 2.06-.41 2.71-1.23.51-.64.71-1.47.69-2.28-.02-2.92-.01-5.83-.02-8.75-.01-4.32-.01-8.64 0-12.97z"/></svg>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</header>

<script>
    const header = document.querySelector('header');
    const navContainer = document.getElementById('navbar-container');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const drawer = document.getElementById('mobile-drawer');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    let isMenuOpen = false;

    // Scroll Logic: Navigasi tetap glassmorphism tapi lebih gelap saat di-scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.remove('pt-4', 'sm:pt-6');
            header.classList.add('pt-2');
            
            navContainer.classList.remove('bg-white/[0.03]', 'sm:h-20');
            navContainer.classList.add('bg-black/60', 'h-16');
        } else {
            header.classList.add('pt-4', 'sm:pt-6');
            header.classList.remove('pt-2');
            
            navContainer.classList.remove('bg-black/60', 'h-16');
            navContainer.classList.add('bg-white/[0.03]', 'sm:h-20');
        }
    });

    mobileBtn.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            drawer.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-4');
            drawer.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>';
        } else {
            drawer.classList.add('opacity-0', 'pointer-events-none', '-translate-y-4');
            drawer.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>';
        }
    });

    document.addEventListener('click', function(event) {
        if (isMenuOpen && !header.contains(event.target)) {
            mobileBtn.click();
        }
    });
</script>