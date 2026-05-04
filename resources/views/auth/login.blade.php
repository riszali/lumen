@extends('layouts.app')

@section('title', 'Masuk | WILLSPORTS')

@section('content')

<!-- Font Khusus Sports Premium: Bebas Neue (Headline) & Montserrat (Body) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --volt: #ccff00;      
        --dark: #050505;      
    }

    body {
        background-color: var(--dark) !important;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
    }

    .font-bebas {
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 0.02em;
    }

    .bg-noise {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
    }
</style>

<!-- Main Wrapper -->
<div class="relative w-full min-h-screen bg-[var(--dark)] bg-noise flex items-center justify-center pt-24 pb-12 overflow-hidden">
    
    <!-- Background Image Tipis -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" class="w-full h-full object-cover opacity-5 filter grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/80 to-[#050505]/80"></div>
    </div>

    <!-- Cahaya Pendar Halus (Glassmorphism Ambient) -->
    <div class="absolute top-[10%] right-[20%] w-[30%] h-[40%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>
    <div class="absolute bottom-[10%] left-[10%] w-[40%] h-[50%] bg-[#00E5FF] rounded-full mix-blend-screen filter blur-[150px] opacity-5 pointer-events-none z-0"></div>

    <div class="max-w-md w-full px-4 relative z-20">
        
        <!-- Glassmorphism Form Container (Rounded & Blur) -->
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-8 sm:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            
            <div class="mb-8 border-b border-white/10 pb-6 text-center">
                <h2 class="font-bebas text-5xl text-white tracking-wide mb-1 drop-shadow-md">MASUK</h2>
                <p class="text-sm text-gray-400 font-montserrat font-light tracking-wide">Selamat datang kembali. Lanjutkan progres Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus 
                        class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                        placeholder="contoh@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-xs font-montserrat text-gray-300 font-medium uppercase tracking-widest">Kata Sandi</label>
                        <a href="#" class="text-[10px] text-gray-400 hover:text-white font-montserrat uppercase tracking-widest transition-colors">Lupa sandi?</a>
                    </div>
                    <input id="password" name="password" type="password" required 
                        class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                        placeholder="Masukkan kata sandi">
                </div>

                <div class="flex items-center pt-2">
                    <input id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 bg-black/40 border border-white/20 rounded focus:ring-volt focus:ring-offset-0 text-volt cursor-pointer transition">
                    <label for="remember" class="ml-2 block text-sm text-gray-400 font-montserrat cursor-pointer font-light">
                        Ingat saya
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                        class="w-full bg-black border border-[#ccff00] text-[#ccff00] rounded-full px-8 py-4 font-montserrat font-bold text-sm hover:bg-[#ccff00] hover:text-black hover:-translate-y-1 transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)] hover:shadow-[0_0_25px_rgba(204,255,0,0.4)]">
                        MASUK
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/10 text-center text-xs text-gray-400 font-montserrat font-light tracking-wide">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="text-white font-bold uppercase tracking-widest hover:text-volt transition-colors ml-1">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection