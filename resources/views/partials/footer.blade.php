<footer class="bg-[#050505] relative overflow-hidden font-montserrat mt-auto border-t border-white/5">
    
    <!-- Watermark Background Raksasa (Premium Vibe) -->
    <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none z-0 overflow-hidden">
        <h1 class="font-bebas text-[25vw] leading-none text-white whitespace-nowrap select-none">WILLSPORTS</h1>
    </div>

    <!-- Accent Glow -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-32 bg-[#ccff00] rounded-t-full filter blur-[150px] opacity-[0.03] pointer-events-none"></div>

    <div class="w-[95%] max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 relative z-10">
        
        <!-- Top Section: Newsletter -->
        <div class="flex flex-col lg:flex-row justify-between items-center border-b border-white/10 pb-12 mb-12 gap-8 text-center lg:text-left">
            <div class="max-w-xl">
                <h2 class="font-bebas text-4xl md:text-5xl tracking-wide uppercase text-white mb-2">STAY IN THE <span class="text-[#ccff00]">LOOP</span></h2>
                <p class="text-gray-400 text-sm font-light leading-relaxed">Berlangganan untuk mendapatkan akses eksklusif ke rilisan terbaru, promo spesial, dan berita seputar dunia padel.</p>
            </div>
            <div class="w-full lg:w-auto">
                <form action="{{ route('subscribe') }}" method="POST" class="flex w-full max-w-md mx-auto lg:mx-0 shadow-lg">
                    @csrf
                    <input type="email" name="email" placeholder="Masukkan email Anda" required
                        class="flex-grow bg-white/5 border border-white/10 border-r-0 px-6 py-3.5 rounded-l-full text-sm text-white focus:border-[#ccff00] focus:ring-0 outline-none placeholder-gray-500 transition-colors backdrop-blur-sm">
                    <button type="submit" 
                        class="bg-[#ccff00] text-black px-6 sm:px-8 py-3.5 rounded-r-full font-bold uppercase tracking-widest text-[10px] sm:text-xs hover:bg-white transition-colors duration-300 border border-[#ccff00]">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Middle Section: Main Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-16 text-center sm:text-left">
            
            <!-- Logo & About -->
            <div class="lg:col-span-4 flex flex-col items-center sm:items-start text-center sm:text-left">
                <a href="{{ route('home') }}" class="inline-block mb-6 group">
                    <img src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-16 md:h-20 w-auto object-contain scale-125 sm:scale-150 origin-center sm:origin-left opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                </a>
                <p class="text-gray-400 text-sm font-light leading-relaxed max-w-sm mt-4 lg:mt-2">
                    Mendefinisikan ulang standar performa olahraga. WILLSPORTS merancang peralatan kelas turnamen untuk atlet yang menuntut kemenangan dan kendali mutlak.
                </p>
            </div>
            
            <!-- Wrapper 2 Kolom untuk Shop & Support di versi Mobile -->
            <div class="lg:col-span-4 grid grid-cols-2 gap-4 sm:gap-8 text-left">
                <!-- Shop -->
                <div class="flex flex-col items-start">
                    <h4 class="font-bebas text-xl sm:text-2xl text-white tracking-wide uppercase mb-6 relative inline-block w-fit">
                        Shop Gear
                        <span class="absolute -bottom-2 left-0 w-1/2 h-[2px] bg-[#ccff00]"></span>
                    </h4>
                    <div class="flex flex-col space-y-4 text-xs sm:text-sm text-gray-400 font-light">
                        <a href="{{ route('shop.index') }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">All Products</a>
                        <a href="{{ route('shop.index', ['sort' => 'newest']) }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">New Arrivals</a>
                        <a href="{{ route('shop.index', ['category' => 'padel-rackets']) }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Padel Rackets</a>
                        <a href="{{ route('shop.index', ['category' => 'sports-shoes']) }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Sports Shoes</a>
                    </div>
                </div>

                <!-- Support -->
                <div class="flex flex-col items-start pl-2 sm:pl-0">
                    <h4 class="font-bebas text-xl sm:text-2xl text-white tracking-wide uppercase mb-6 relative inline-block w-fit">
                        Support
                        <span class="absolute -bottom-2 left-0 w-1/2 h-[2px] bg-[#ccff00]"></span>
                    </h4>
                    <div class="flex flex-col space-y-4 text-xs sm:text-sm text-gray-400 font-light">
                        <a href="{{ route('pages.customer-service') }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Contact Us</a>
                        <a href="{{ route('pages.shipping-returns') }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Shipping & Returns</a>
                        <a href="{{ route('pages.care-guide') }}" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Gear Care Guide</a>
                        <a href="#" class="hover:text-[#ccff00] hover:translate-x-1 transition-all w-fit">Size Guide</a>
                    </div>
                </div>
            </div>

            <!-- Contact & Socials -->
            <div class="md:col-span-2 lg:col-span-4 flex flex-col items-center sm:items-start pt-4 sm:pt-0 text-center sm:text-left">
                <h4 class="font-bebas text-2xl text-white tracking-wide uppercase mb-6 relative inline-block w-fit">
                    Connect With Us
                    <span class="absolute -bottom-2 left-0 w-1/2 h-[2px] bg-[#ccff00]"></span>
                </h4>
                
                <p class="text-gray-400 text-sm font-light mb-6">
                    Punya pertanyaan atau butuh konsultasi gear?<br>
                    <a href="mailto:hello@willsports.com" class="text-white hover:text-[#ccff00] font-medium transition-colors">hello@willsports.com</a>
                </p>

                <!-- Social Icons in Circles -->
                <div class="flex flex-row justify-center sm:justify-start gap-4">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/willsports___/" target="_blank" aria-label="Instagram"
                       class="w-10 h-10 rounded-full border border-white/20 bg-white/5 flex items-center justify-center text-gray-400 hover:text-black hover:bg-[#ccff00] hover:border-[#ccff00] hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@willsports___" target="_blank" aria-label="TikTok"
                       class="w-10 h-10 rounded-full border border-white/20 bg-white/5 flex items-center justify-center text-gray-400 hover:text-black hover:bg-[#ccff00] hover:border-[#ccff00] hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.28-2.26.74-4.63 2.58-5.91 1.18-.87 2.63-1.31 4.1-1.27.33.01.67.03.99.08v4.16c-.57-.17-1.19-.21-1.76-.11-1.06.2-1.95.89-2.4 1.86-.45.97-.39 2.13.15 3.04.54.91 1.52 1.5 2.57 1.55 1.05.04 2.06-.41 2.71-1.23.51-.64.71-1.47.69-2.28-.02-2.92-.01-5.83-.02-8.75-.01-4.32-.01-8.64 0-12.97z"/></svg>
                    </a>
                    <!-- Tokopedia -->
                    <a href="https://www.tokopedia.com/willsports" target="_blank" aria-label="Tokopedia"
                       class="w-10 h-10 rounded-full border border-white/20 bg-white/5 flex items-center justify-center text-gray-400 hover:text-black hover:bg-[#ccff00] hover:border-[#ccff00] hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19.141 11.141c.42.42.659.981.659 1.564 0 .584-.239 1.145-.659 1.565-.42.42-.981.659-1.565.659-.583 0-1.144-.239-1.564-.659-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.564-.659.584 0 1.145.239 1.565.659zm-12.723 0c.42.42.659.981.659 1.564s-.239 1.145-.659 1.565c-.42.42-.981.659-1.564.659s-1.145-.239-1.565-.659c-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.565-.659.583 0 1.144.239 1.564.659zM12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm7.141 14.282c-1.928 1.928-5.213 1.928-7.141 0-1.928-1.928-1.928-5.213 0-7.141s5.213-1.928 7.141 0 1.928 5.213 0 7.141z"/></svg>
                    </a>
                    <!-- Shopee -->
                    <a href="https://shopee.co.id/willsports" target="_blank" aria-label="Shopee"
                       class="w-10 h-10 rounded-full border border-white/20 bg-white/5 flex items-center justify-center text-gray-400 hover:text-black hover:bg-[#ccff00] hover:border-[#ccff00] hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19.467 6.84a.433.433 0 0 0-.342-.236h-3.411a4.289 4.289 0 0 0-7.428 0H4.875a.434.434 0 0 0-.342.236l-1.928 11.9a.433.433 0 0 0 .093.364.434.434 0 0 0 .34.16h17.924c.143 0 .27-.067.341-.16a.433.433 0 0 0 .092-.364l-1.928-11.9ZM12 3.86a3.42 3.42 0 0 1 2.97 1.714H9.03A3.42 3.42 0 0 1 12 3.86Zm-2.887 9.873c0-.622.504-1.127 1.127-1.127h2.253a.282.282 0 1 1 0 .563h-2.253a.564.564 0 1 0 0 1.127h2.253c.622 0 1.127.505 1.127 1.127s-.505 1.127-1.127 1.127h-2.253a.282.282 0 1 1 0-.563h2.253a.564.564 0 1 0 0-1.127h-2.253a1.127 1.127 0 0 1-1.127-1.127Z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar: Copyright & Terms -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 font-light gap-6 md:gap-0">
            
            <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-6 text-center sm:text-left">
                <p>&copy; {{ date('Y') }} WILLSPORTS. All rights reserved.</p>
                
                <!-- Powered By Section -->
                <div class="flex items-center gap-2 opacity-50 hover:opacity-100 transition duration-300">
                    <span class="text-[9px] uppercase tracking-widest text-gray-500">Powered by</span>
                    <img src="{{ asset('assets/logo/logo lundor 3.png') }}" alt="Lundor Logo" class="h-4 object-contain brightness-200">
                </div>
            </div>

            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition-colors relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[1px] after:bg-white after:transition-all hover:after:w-full">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[1px] after:bg-white after:transition-all hover:after:w-full">Terms of Service</a>
            </div>

        </div>
    </div>
</footer>