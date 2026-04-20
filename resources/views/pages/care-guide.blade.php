@extends('layouts.app')

@section('title', 'Care Guide | LUMEN')

@section('content')
<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-16 pb-24">
    <div class="absolute top-0 right-[-5%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-20">
        <div class="text-center mb-16">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md">Jewelry Care Guide</h1>
            <p class="text-brand-gray text-sm mt-3 tracking-[0.2em] uppercase font-light">Preserving your legacy</p>
        </div>
        
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 sm:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            
            <div class="space-y-12 text-brand-warm/90 font-light leading-relaxed">
                
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Daily Wear & Care</h3>
                    </div>
                    <p class="pl-12">Your LUMEN jewelry is crafted to last for generations, but proper care will ensure it maintains its flawless brilliance. We highly recommend removing your jewelry before engaging in activities such as swimming in chlorinated pools, bathing, or heavy physical exercising to prevent accidental damage or chemical exposure.</p>
                </div>
                
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Cleaning Your Pieces</h3>
                    </div>
                    <p class="pl-12">For most solid gold and platinum pieces, a soft, lint-free cloth is ideal for gently wiping away fingerprints and smudges. For a deeper clean at home, soak the piece briefly in warm water with a single drop of mild dish soap, then gently brush behind the stone settings with a very soft-bristled baby toothbrush. Rinse with clean water and pat dry.</p>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-8 h-[1px] bg-brand-sage"></span>
                        <h3 class="text-brand-cream font-serif text-2xl">Proper Storage</h3>
                    </div>
                    <p class="pl-12">Diamonds can scratch other diamonds, gold, and softer gemstones. When not wearing your jewelry, always store it in its original LUMEN suede-lined box or an individual soft pouch to prevent scratches. Keep pieces separated so they do not rub against one another in your jewelry box.</p>
                </div>

            </div>

            <div class="mt-16 pt-8 border-t border-white/10 text-center">
                <p class="text-sm text-brand-gray mb-4">Need professional cleaning or inspection?</p>
                <a href="{{ route('pages.customer-service') }}" class="inline-block border border-white/20 text-brand-cream px-8 py-3 rounded-full uppercase tracking-widest text-xs font-bold hover:bg-white/10 transition duration-300">Book an Appointment</a>
            </div>
            
        </div>
    </div>
</div>
@endsection