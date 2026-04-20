@extends('layouts.app')

@section('title', 'Shipping & Returns | LUMEN')

@section('content')
<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-16 pb-24">
    <div class="absolute bottom-1/4 right-[-5%] w-[40%] h-[50%] bg-brand-warm rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-20">
        <div class="text-center mb-16">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md">Shipping & Returns</h1>
            <p class="text-brand-gray text-sm mt-3 tracking-[0.2em] uppercase font-light">Our delivery and return policies</p>
        </div>
        
        <div class="space-y-8">
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-8 sm:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
                <h3 class="text-brand-sage font-serif text-2xl mb-6 border-b border-white/10 pb-4">Complimentary Shipping</h3>
                <div class="text-brand-warm/90 font-light leading-loose space-y-4">
                    <p>LUMEN offers complimentary fully-insured shipping on all orders within Indonesia. Your order will be securely packaged in our signature unbranded outer box to ensure privacy and safety during transit.</p>
                    <p><strong class="text-brand-cream font-medium">Delivery Times:</strong> In-stock items are typically delivered within 2-4 business days. Bespoke or made-to-order pieces require 3-4 weeks for craftsmanship before shipping.</p>
                    <p class="text-sm text-brand-gray italic">An adult signature is required upon delivery for all LUMEN packages.</p>
                </div>
            </div>

            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-8 sm:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
                <h3 class="text-brand-sage font-serif text-2xl mb-6 border-b border-white/10 pb-4">Returns & Exchanges</h3>
                <div class="text-brand-warm/90 font-light leading-loose space-y-4">
                    <p>We want you to be completely enamored with your purchase. If for any reason you are not, LUMEN accepts returns and exchanges within 14 days of delivery.</p>
                    <p>Articles must be returned in their original, unworn condition, accompanied by all original packaging, certificates, and the original sales receipt.</p>
                    <p class="text-sm text-brand-olive">Please note that personalized, engraved, or bespoke items cannot be returned or exchanged.</p>
                    
                    <div class="mt-8 pt-6">
                        <a href="{{ route('pages.customer-service') }}" class="inline-flex items-center text-brand-cream uppercase tracking-widest text-xs font-bold hover:text-brand-sage transition group">
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection