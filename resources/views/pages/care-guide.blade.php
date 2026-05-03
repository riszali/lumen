@extends('layouts.app')

@section('title', 'Gear Care Guide | WILLSPORTS')

@section('content')
<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-16 pb-24">
    <!-- Ambient Lights -->
    <div class="absolute top-0 right-[-5%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-20">
        <div class="text-center mb-16">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md">Gear Care Guide</h1>
            <p class="text-brand-gray text-sm mt-3 tracking-[0.2em] uppercase font-light">Preserving your performance</p>
        </div>
        
        <!-- Main Glass Container -->
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 sm:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            
            <div class="space-y-12 text-brand-warm/90 font-light leading-relaxed">
                
                <!-- Section 1 -->
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Daily Wear & Care</h3>
                    </div>
                    <p class="pl-12">Your WILLSPORTS gear is crafted to withstand extreme conditions, but proper care will ensure it maintains its flawless performance. We highly recommend airing out your footwear and apparel immediately after engaging in heavy physical exercising to prevent moisture build-up and odor retention.</p>
                </div>
                
                <!-- Section 2 -->
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Cleaning Your Gear</h3>
                    </div>
                    <p class="pl-12">For most performance fabrics and footwear, a soft, damp cloth is ideal for gently wiping away mud and dirt. For a deeper clean, wash apparel in cold water with mild detergent on a gentle cycle. Avoid using fabric softeners or bleach, and never tumble dry high-performance athletic wear. Let them air dry naturally.</p>
                </div>

                <!-- Section 3 -->
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Proper Storage</h3>
                    </div>
                    <p class="pl-12">Store your shoes and apparel properly to maintain their shape and elasticity. When not wearing your gear, always store it in a cool, dry place away from direct sunlight. Use the provided WILLSPORTS breathable bags for your premium footwear to ensure maximum airflow during storage.</p>
                </div>

            </div>

            <div class="mt-16 pt-8 border-t border-white/10 text-center">
                <p class="text-sm text-brand-gray mb-4">Need further advice on gear maintenance?</p>
                <a href="{{ route('pages.customer-service') }}" class="inline-block border border-white/20 text-brand-cream px-8 py-3 rounded-full uppercase tracking-widest text-xs font-bold hover:bg-white/10 transition duration-300">Contact Support</a>
            </div>
            
        </div>
    </div>
</div>
@endsection