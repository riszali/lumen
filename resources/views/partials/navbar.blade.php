<header class="fixed top-0 left-0 w-full z-[100] transition-all duration-500 px-4 sm:px-6 lg:px-8 pt-6 pointer-events-none">
    <div class="w-[95%] max-w-[1600px] mx-auto pointer-events-auto relative">
        <!-- Floating Glass Container -->
        <div id="navbar-container" class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] px-4 sm:px-10 h-20 flex justify-between items-center relative overflow-hidden group transition-all duration-500">
            
            <!-- Subtle Inner Glow Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-brand-sage/5 via-transparent to-brand-olive/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

            <!-- Left Navigation (Desktop) & Hamburger (Mobile) -->
            <div class="flex items-center min-w-[50px] md:min-w-[200px] relative z-30">
                <!-- Hamburger Button (Mobile Only) -->
                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-full border border-white/10 text-brand-gray hover:bg-white/10 hover:text-brand-cream transition group" aria-label="Toggle Menu">
                    <svg id="hamburger-icon" class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center space-x-10">
                    <a href="{{ route('home') }}" class="relative text-brand-gray hover:text-brand-cream transition-colors uppercase tracking-[0.25em] text-[10px] font-bold group/link">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-brand-sage transition-all duration-300 group-hover/link:w-full"></span>
                    </a>
                    <a href="{{ route('shop.index') }}" class="relative text-brand-gray hover:text-brand-cream transition-colors uppercase tracking-[0.25em] text-[10px] font-bold group/link">
                        Shop
                        <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-brand-sage transition-all duration-300 group-hover/link:w-full"></span>
                    </a>
                </nav>
            </div>

            <!-- Center Logo (Absolute Inset Centering) -->
            <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                <a href="{{ route('home') }}" class="block transform hover:scale-105 transition duration-500 pointer-events-auto">
                    <!-- GANTI LOGO LUMEN KE WILLSPORTS DENGAN UKURAN EKSTRA BESAR (SCALE) -->
                    <img src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-14 sm:h-20 w-auto object-contain scale-125 sm:scale-150 drop-shadow-[0_0_10px_rgba(237,231,212,0.3)]">
                </a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center justify-end min-w-[50px] md:min-w-[200px] space-x-4 sm:space-x-8 relative z-30">
                @auth
                    <div class="flex items-center space-x-4 sm:space-x-6">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:block text-brand-sage hover:text-brand-cream text-[10px] uppercase tracking-widest font-bold transition">Admin</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="hidden sm:block text-brand-gray hover:text-brand-cream text-[10px] uppercase tracking-widest font-bold transition">Account</a>
                        @endif
                        
                        <a href="{{ route('cart.index') }}" class="text-brand-gray hover:text-brand-cream flex items-center group/cart relative">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span class="hidden sm:inline-block ml-2 text-[10px] uppercase tracking-widest font-bold">Cart</span>
                            @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                <span class="absolute -top-2 -right-3 bg-brand-sage text-brand-dark text-[9px] rounded-full w-4 h-4 flex items-center justify-center font-bold animate-bounce shadow-[0_0_10px_rgba(170,171,154,0.4)]">
                                    {{ auth()->user()->cart->items->count() }}
                                </span>
                            @endif
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline">
                            @csrf
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full border border-white/10 text-brand-gray hover:bg-white/10 hover:text-red-400 transition group" title="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-white/5 hover:bg-white/10 border border-white/10 text-brand-cream px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-[10px] uppercase tracking-widest font-bold transition duration-300 backdrop-blur-md">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Drawer Menu (Hidden by default) -->
        <div id="mobile-drawer" class="absolute top-24 left-0 w-full h-0 opacity-0 overflow-hidden transition-all duration-500 z-50 md:hidden pointer-events-none">
            <div class="bg-brand-dark/95 backdrop-blur-3xl border border-white/10 rounded-[2rem] shadow-2xl p-8 flex flex-col space-y-8 pointer-events-auto">
                <nav class="flex flex-col space-y-6">
                    <a href="{{ route('home') }}" class="text-brand-cream text-lg font-serif tracking-wide border-b border-white/5 pb-2">Home</a>
                    <a href="{{ route('shop.index') }}" class="text-brand-cream text-lg font-serif tracking-wide border-b border-white/5 pb-2">Shop</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-brand-sage text-lg font-serif tracking-wide border-b border-white/5 pb-2">Admin Panel</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="text-brand-cream text-lg font-serif tracking-wide border-b border-white/5 pb-2">My Account</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-400 text-lg font-serif tracking-wide text-left w-full">Sign Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-brand-sage text-lg font-serif tracking-wide border-b border-white/5 pb-2">Sign In</a>
                    @endauth
                </nav>

                <div class="pt-4 flex justify-between items-center text-xs text-brand-gray tracking-widest uppercase font-bold opacity-50">
                    <span>WILLSPORTS Gear</span>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/willsports___/" target="_blank">IG</a>
                        <a href="https://www.tiktok.com/@willsports___" target="_blank">TT</a>
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

    // Menangani perubahan style saat scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.style.paddingTop = '0.75rem';
            navContainer.style.height = '4.5rem';
            navContainer.style.backgroundColor = 'rgba(37, 35, 34, 0.8)';
        } else {
            header.style.paddingTop = '1.5rem';
            navContainer.style.height = '5rem';
            navContainer.style.backgroundColor = 'rgba(255, 255, 255, 0.03)';
        }
    });

    // Menangani Mobile Menu Toggle
    mobileBtn.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            drawer.style.height = 'auto';
            drawer.style.opacity = '1';
            drawer.classList.remove('pointer-events-none');
            hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>';
        } else {
            drawer.style.height = '0';
            drawer.style.opacity = '0';
            drawer.classList.add('pointer-events-none');
            hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>';
        }
    });

    // Tutup menu saat klik di luar (optional)
    document.addEventListener('click', function(event) {
        if (isMenuOpen && !header.contains(event.target)) {
            mobileBtn.click();
        }
    });
</script>