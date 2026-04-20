@extends('layouts.app')

@section('title', 'Sign In | LUMEN')

@section('content')

<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-36 pb-28 -mb-12 flex items-center justify-center">
    
    <div class="absolute top-1/4 left-1/4 w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-15 pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-15 pointer-events-none"></div>

    <div class="max-w-md w-full px-4 relative z-20">
        
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 sm:p-10 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="text-center mb-10 border-b border-white/10 pb-6">
                <img src="{{ asset('assets/logo/logo-lumen-white.png') }}" alt="LUMEN" class="h-6 object-contain mx-auto mb-6 opacity-90">
                <h2 class="font-serif text-3xl text-brand-cream drop-shadow-md">Welcome Back</h2>
                <p class="text-xs text-brand-gray mt-2 font-light tracking-[0.2em] uppercase">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="Enter your email">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-[10px] uppercase tracking-widest text-brand-gray font-semibold">Password</label>
                        <a href="#" class="text-[10px] text-brand-sage hover:text-brand-cream uppercase tracking-widest transition">Forgot?</a>
                    </div>
                    <input id="password" name="password" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="Enter your password">
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 bg-black/40 border border-white/20 rounded focus:ring-brand-sage text-brand-sage transition cursor-pointer">
                    <label for="remember" class="ml-2 block text-xs text-brand-gray font-light tracking-wide cursor-pointer">
                        Remember me
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-xl px-8 py-4 uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/10 text-center text-xs text-brand-gray font-light tracking-wide">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-brand-sage font-bold uppercase tracking-widest ml-1 hover:text-brand-cream transition">Create Account</a>
            </div>
        </div>
    </div>
</div>
@endsection