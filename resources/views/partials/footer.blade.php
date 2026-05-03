<footer class="bg-brand-dark text-brand-cream py-12 lg:py-16 relative">
    
    <!-- Pembatas Tipis Runcing (Gradient Divider) -->
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-brand-sage/40 to-transparent"></div>

    <div class="w-[95%] max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Ubah dari grid-cols-1 menjadi grid-cols-2 di mobile agar bisa bersebelahan -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-10 lg:gap-12 mb-10 lg:mb-12 text-left">
            
            <!-- 1. Logo & Description (Full width di HP, 1 kolom di Desktop) -->
            <div class="col-span-2 lg:col-span-1 text-center lg:text-left">
                <a href="{{ route('home') }}" class="inline-block mb-4 lg:mb-6">
                    <img src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-7 lg:h-8 object-contain mx-auto lg:mx-0 opacity-90 hover:opacity-100 transition">
                </a>
                <p class="text-brand-gray text-xs lg:text-sm font-light leading-relaxed max-w-xs mx-auto lg:mx-0">
                    Performance in every detail. Engineered for champions with advanced materials and cutting-edge design.
                </p>
            </div>
            
            <!-- 2. Explore (Kiri di HP) -->
            <div class="col-span-1 flex flex-col space-y-3 text-sm text-brand-gray font-light px-2 sm:px-4 lg:px-0">
                <h4 class="text-brand-cream font-semibold uppercase tracking-widest mb-2 text-[10px] sm:text-xs">Explore</h4>
                <a href="{{ route('shop.index') }}" class="hover:text-brand-sage transition inline-block">All Gear</a>
                <a href="#" class="hover:text-brand-sage transition inline-block">New Arrivals</a>
                <a href="#" class="hover:text-brand-sage transition inline-block">Performance Series</a>
            </div>

            <!-- 3. Assistance (Kanan di HP) -->
            <div class="col-span-1 flex flex-col space-y-3 text-sm text-brand-gray font-light px-2 sm:px-4 lg:px-0">
                <h4 class="text-brand-cream font-semibold uppercase tracking-widest mb-2 text-[10px] sm:text-xs">Assistance</h4>
                <a href="{{ route('pages.customer-service') }}" class="hover:text-brand-sage transition inline-block">Customer Service</a>
                <a href="{{ route('pages.shipping-returns') }}" class="hover:text-brand-sage transition inline-block">Shipping & Returns</a>
                <a href="{{ route('pages.care-guide') }}" class="hover:text-brand-sage transition inline-block">Care Guide</a>
            </div>

            <!-- 4. Connect (Ikon sosial media sebaris) -->
            <div class="col-span-2 lg:col-span-1 flex flex-col items-center lg:items-start pt-2 lg:pt-0">
                <h4 class="text-brand-cream font-semibold uppercase tracking-widest mb-4 text-[10px] sm:text-xs">Connect</h4>
                
                <div class="flex flex-row justify-center lg:justify-start gap-6 w-full text-brand-gray mt-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/willsports___/" target="_blank" class="hover:text-brand-sage transition hover:-translate-y-1 transform" aria-label="Instagram">
                        <svg class="w-5 h-5 fill-current transition-colors" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@willsports___" target="_blank" class="hover:text-brand-sage transition hover:-translate-y-1 transform" aria-label="TikTok">
                        <svg class="w-5 h-5 fill-current transition-colors" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.28-2.26.74-4.63 2.58-5.91 1.18-.87 2.63-1.31 4.1-1.27.33.01.67.03.99.08v4.16c-.57-.17-1.19-.21-1.76-.11-1.06.2-1.95.89-2.4 1.86-.45.97-.39 2.13.15 3.04.54.91 1.52 1.5 2.57 1.55 1.05.04 2.06-.41 2.71-1.23.51-.64.71-1.47.69-2.28-.02-2.92-.01-5.83-.02-8.75-.01-4.32-.01-8.64 0-12.97z"/></svg>
                    </a>
                    <!-- Tokopedia -->
                    <a href="https://www.tokopedia.com/willsports" target="_blank" class="hover:text-brand-sage transition hover:-translate-y-1 transform" aria-label="Tokopedia">
                        <svg class="w-5 h-5 fill-current transition-colors" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.141 11.141c.42.42.659.981.659 1.564 0 .584-.239 1.145-.659 1.565-.42.42-.981.659-1.565.659-.583 0-1.144-.239-1.564-.659-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.564-.659.584 0 1.145.239 1.565.659zm-12.723 0c.42.42.659.981.659 1.564s-.239 1.145-.659 1.565c-.42.42-.981.659-1.564.659s-1.145-.239-1.565-.659c-.42-.42-.659-.981-.659-1.565s.239-1.144.659-1.564c.42-.42.981-.659 1.565-.659.583 0 1.144.239 1.564.659zM12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm7.141 14.282c-1.928 1.928-5.213 1.928-7.141 0-1.928-1.928-1.928-5.213 0-7.141s5.213-1.928 7.141 0 1.928 5.213 0 7.141z"/></svg>
                    </a>
                    <!-- Shopee -->
                    <a href="https://shopee.co.id/willsports" target="_blank" class="hover:text-brand-sage transition hover:-translate-y-1 transform" aria-label="Shopee">
                        <svg class="w-5 h-5 fill-current transition-colors" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.467 6.84a.433.433 0 0 0-.342-.236h-3.411a4.289 4.289 0 0 0-7.428 0H4.875a.434.434 0 0 0-.342.236l-1.928 11.9a.433.433 0 0 0 .093.364.434.434 0 0 0 .34.16h17.924c.143 0 .27-.067.341-.16a.433.433 0 0 0 .092-.364l-1.928-11.9ZM12 3.86a3.42 3.42 0 0 1 2.97 1.714H9.03A3.42 3.42 0 0 1 12 3.86Zm-2.887 9.873c0-.622.504-1.127 1.127-1.127h2.253a.282.282 0 1 1 0 .563h-2.253a.564.564 0 1 0 0 1.127h2.253c.622 0 1.127.505 1.127 1.127s-.505 1.127-1.127 1.127h-2.253a.282.282 0 1 1 0-.563h2.253a.564.564 0 1 0 0-1.127h-2.253a1.127 1.127 0 0 1-1.127-1.127Z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row justify-between items-center text-[10px] sm:text-xs text-brand-olive font-light tracking-wider">
            <div class="flex flex-col items-center md:items-start gap-2">
                <p>&copy; {{ date('Y') }} WILLSPORTS Apparel. All rights reserved.</p>
                
                <!-- Powered By Section -->
                <div class="flex items-center gap-2 opacity-60 hover:opacity-100 transition duration-300 mt-1">
                    <span class="text-[9px] uppercase tracking-[0.15em]">Powered by</span>
                    <img src="{{ asset('assets/logo/logo lundor 3.png') }}" alt="Lundor Logo" class="h-4 sm:h-5 object-contain brightness-125">
                </div>
            </div>
            <div class="flex space-x-4 mt-6 md:mt-0">
                <a href="#" class="hover:text-brand-cream transition">Privacy Policy</a>
                <a href="#" class="hover:text-brand-cream transition">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>