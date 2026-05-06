<header class="fixed top-0 left-0 w-full z-[100] transition-all duration-300 px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 pointer-events-none">
    <div class="w-[95%] max-w-[1600px] mx-auto pointer-events-auto relative">
        <!-- Floating Glass Container -->
        <!-- OPTIMASI HP: Pakai bg solid di HP (bg-[#050505]/95), backdrop-blur hanya di Desktop (md:backdrop-blur-2xl) -->
        <div id="navbar-container" class="bg-[#050505]/95 md:bg-white/[0.03] md:backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-lg px-4 sm:px-10 h-16 sm:h-20 flex justify-between items-center relative overflow-hidden group transition-all duration-300">
            
            <!-- Subtle Inner Glow Effect (Sembunyikan di HP) -->
            <div class="hidden md:block absolute inset-0 bg-gradient-to-r from-[#ccff00]/5 via-transparent to-[#00E5FF]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

            <!-- Left Navigation (Desktop) & Hamburger (Mobile) -->
            <div class="flex items-center min-w-[50px] md:min-w-[200px] relative z-30">
                <!-- Hamburger Button (Mobile Only) -->
                <!-- OPTIMASI HP: Animasi transisi yang lebih ringan -->
                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-full border border-white/10 text-gray-400 hover:bg-white/10 hover:text-white transition-colors" aria-label="Toggle Menu">
                    <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Nav Links -->
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

            <!-- Center Logo (Absolute Inset Centering) -->
            <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                <a href="{{ route('home') }}" class="block transform hover:scale-105 transition duration-500 pointer-events-auto">
                    <img src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-10 sm:h-14 md:h-20 w-auto object-contain scale-125 sm:scale-150 drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]">
                </a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center justify-end min-w-[50px] md:min-w-[200px] space-x-4 sm:space-x-8 relative z-30 font-montserrat">
                @auth
                    <div class="flex items-center space-x-4 sm:space-x-6">
                        <!-- Pisahkan logika berdasarkan Role -->
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:block text-[#ccff00] hover:text-white text-[10px] uppercase tracking-widest font-bold transition">Admin Dashboard</a>
                            <!-- Ikon Cart dihilangkan untuk Admin -->
                        @else
                            <a href="{{ route('orders.index') }}" class="hidden sm:block text-gray-400 hover:text-white text-[10px] uppercase tracking-widest font-bold transition">Account</a>
                            
                            <!-- Ikon Cart hanya muncul untuk Customer -->
                            <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white flex items-center group/cart relative transition-colors">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <span class="hidden sm:inline-block ml-2 text-[10px] uppercase tracking-widest font-bold">Cart</span>
                                @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                    <span class="absolute -top-2 -right-2 sm:-right-3 bg-[#ccff00] text-black text-[9px] rounded-full w-4 h-4 flex items-center justify-center font-bold shadow-md">
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

        <!-- Mobile Drawer Menu -->
        <!-- OPTIMASI HP: Hilangkan backdrop-blur, pakai transform Y untuk animasi 60fps tanpa lag -->
        <div id="mobile-drawer" class="absolute top-20 left-0 w-full opacity-0 pointer-events-none -translate-y-4 transition-all duration-300 z-50 md:hidden will-change-transform">
            <div class="bg-[#0c0c0c] border border-white/10 rounded-[1.5rem] shadow-2xl p-6 flex flex-col space-y-6">
                <nav class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">HOME</a>
                    <a href="{{ route('shop.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">SHOP</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-[#ccff00] text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">ADMIN PANEL</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">MY ACCOUNT</a>
                            <!-- Tambahan menu keranjang khusus HP untuk customer -->
                            <a href="{{ route('cart.index') }}" class="text-white text-2xl font-bebas tracking-wide border-b border-white/5 pb-3 flex justify-between items-center">
                                KERANJANG
                                @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                    <span class="bg-[#ccff00] text-black text-xs px-2.5 py-0.5 rounded-full">{{ auth()->user()->cart->items->count() }}</span>
                                @endif
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="pt-2">
                            @csrf
                            <button type="submit" class="text-red-400 text-lg font-bebas tracking-wide text-left w-full">SIGN OUT</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#ccff00] text-2xl font-bebas tracking-wide border-b border-white/5 pb-3">SIGN IN</a>
                    @endauth
                </nav>

                <div class="pt-2 flex justify-between items-center text-[10px] text-gray-500 font-montserrat tracking-widest uppercase font-bold">
                    <span>WILLSPORTS Gear</span>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/willsports___/" target="_blank" class="hover:text-[#ccff00]">IG</a>
                        <a href="https://www.tiktok.com/@willsports___" target="_blank" class="hover:text-[#ccff00]">TT</a>
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

    // SCROLL HANDLER (Optimized)
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.remove('pt-4', 'sm:pt-6');
            header.classList.add('pt-2');
            navContainer.classList.add('bg-[#050505]/95', 'h-16');
            navContainer.classList.remove('md:bg-white/[0.03]', 'sm:h-20');
        } else {
            header.classList.add('pt-4', 'sm:pt-6');
            header.classList.remove('pt-2');
            navContainer.classList.add('md:bg-white/[0.03]', 'sm:h-20');
            navContainer.classList.remove('bg-[#050505]/95', 'h-16');
        }
    });

    // MOBILE MENU TOGGLE (Optimized - GPU Accelerated Animation)
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

    // Close when clicking outside
    document.addEventListener('click', function(event) {
        if (isMenuOpen && !header.contains(event.target)) {
            mobileBtn.click();
        }
    });
</script>
