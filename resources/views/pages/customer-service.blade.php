@extends('layouts.app')

@section('title', 'Customer Service | LUMEN')

@section('content')
<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-16 pb-24 flex items-center">
    <div class="absolute top-1/4 left-1/4 w-[40%] h-[50%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full">
        <div class="text-center mb-16">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md">Customer Service</h1>
            <p class="text-brand-gray text-sm mt-3 tracking-[0.2em] uppercase font-light">We are here to assist you</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-8 sm:p-10 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
                <h3 class="text-brand-cream font-serif text-2xl mb-8 border-b border-white/10 pb-4">Contact Details</h3>
                <div class="space-y-6 text-brand-warm/90 font-light">
                    <div>
                        <strong class="text-brand-sage uppercase tracking-widest text-xs block mb-1">Email</strong>
                        <a href="mailto:hello@lumen.com" class="hover:text-brand-cream transition text-lg">hello@lumen.com</a>
                    </div>
                    <div>
                        <strong class="text-brand-sage uppercase tracking-widest text-xs block mb-1">Phone / WhatsApp</strong>
                        <p class="text-lg">+62 812 3456 7890</p>
                    </div>
                    <div>
                        <strong class="text-brand-sage uppercase tracking-widest text-xs block mb-1">Business Hours</strong>
                        <p class="text-md">Monday - Friday<br>09:00 AM - 06:00 PM (WIB)</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-brand-olive/10 backdrop-blur-2xl border border-brand-olive/20 rounded-[2rem] p-8 sm:p-10 shadow-inner flex flex-col justify-center text-center">
                <div class="w-16 h-16 bg-brand-sage/20 border border-brand-sage/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-brand-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="text-brand-cream font-serif text-2xl mb-3">Live Consultation</h3>
                <p class="text-brand-gray text-sm font-light mb-8 leading-relaxed px-4">Looking for bespoke jewelry or need advice on a specific piece? Speak directly with our jewelry advisors.</p>
                <a href="#" class="inline-block bg-brand-sage/20 text-brand-sage border border-brand-sage/30 px-8 py-3.5 rounded-full uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 hover:scale-105 transition-all duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] mx-auto">Start Chat</a>
            </div>
        </div>
    </div>
</div>
@endsection