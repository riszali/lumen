@extends('layouts.app')

@section('title', 'Create Account | LUMEN')

@section('content')

<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-36 pb-28 -mb-12 flex items-center justify-center">
    
    <div class="absolute top-1/4 right-1/4 w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-15 pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/4 w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-15 pointer-events-none"></div>

    <div class="max-w-2xl w-full px-4 relative z-20">
        
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 sm:p-10 lg:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="text-center mb-10 border-b border-white/10 pb-6">
                <img src="{{ asset('assets/logo/logo-lumen-white.png') }}" alt="LUMEN" class="h-6 object-contain mx-auto mb-6 opacity-90">
                <h2 class="font-serif text-3xl text-brand-cream drop-shadow-md">Create Account</h2>
                <p class="text-xs text-brand-gray mt-2 font-light tracking-[0.2em] uppercase">Join the LUMEN exclusive members</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Full Name *</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="John Doe">
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Phone Number *</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="081234567890">
                        @error('phone') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Email Address *</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="johndoe@example.com">
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="dob" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Date of Birth *</label>
                        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition [color-scheme:dark]">
                        @error('dob') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <label for="gender" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Gender *</label>
                        <select id="gender" name="gender" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition appearance-none [&>option]:bg-brand-dark [&>option]:text-brand-cream">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 bottom-0 top-[28px] flex items-center px-4 text-brand-gray">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        @error('gender') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Password *</label>
                        <input id="password" name="password" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="Min. 8 characters">
                        @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Confirm Password *</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition placeholder-white/20" placeholder="Retype your password">
                    </div>
                </div>

                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="newsletter" name="newsletter" type="checkbox" value="1" {{ old('newsletter') ? 'checked' : '' }} class="w-4 h-4 bg-black/40 border border-white/20 rounded focus:ring-brand-sage text-brand-sage transition cursor-pointer">
                    </div>
                    <label for="newsletter" class="ml-3 block text-xs text-brand-gray font-light tracking-wide cursor-pointer leading-relaxed">
                        Subscribe to LUMEN E-Newsletter for exclusive updates and early access to new collections.
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-xl px-8 py-4 uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                        Register Account
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/10 text-center text-xs text-brand-gray font-light tracking-wide">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-brand-sage font-bold uppercase tracking-widest ml-1 hover:text-brand-cream transition">Sign In</a>
            </div>
        </div>
    </div>
</div>
@endsection