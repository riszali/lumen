@extends('layouts.app')

@section('title', 'Daftar Akun | WILLSPORTS')

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
<div class="relative w-full min-h-screen bg-[var(--dark)] bg-noise flex items-center justify-center pt-28 pb-16 overflow-hidden">
    
    <!-- Background Image Tipis -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2000" class="w-full h-full object-cover opacity-5 filter grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/80 to-[#050505]/80"></div>
    </div>

    <!-- Cahaya Pendar Halus (Glassmorphism Ambient) -->
    <div class="absolute top-[10%] left-[20%] w-[30%] h-[40%] bg-[#00E5FF] rounded-full mix-blend-screen filter blur-[150px] opacity-5 pointer-events-none z-0"></div>
    <div class="absolute bottom-[10%] right-[10%] w-[40%] h-[50%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <div class="max-w-2xl w-full px-4 relative z-20">
        
        <!-- Glassmorphism Form Container (Rounded & Blur) -->
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 sm:p-10 lg:p-12 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            
            <div class="text-center mb-10 border-b border-white/10 pb-6">
                <h2 class="font-bebas text-5xl text-white tracking-wide mb-1 drop-shadow-md">DAFTAR <span class="text-volt">AKUN</span></h2>
                <p class="text-sm text-gray-400 font-montserrat font-light tracking-wide">Bergabunglah dengan komunitas elit WILLSPORTS</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Nama Lengkap *</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                            placeholder="John Doe">
                        @error('name') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Nomor Telepon *</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                            placeholder="081234567890">
                        @error('phone') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Email *</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                        class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                        placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="dob" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Tanggal Lahir *</label>
                        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" required 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none shadow-inner [color-scheme:dark]">
                        @error('dob') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <label for="gender" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Jenis Kelamin *</label>
                        <select id="gender" name="gender" required 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none appearance-none shadow-inner [&>option]:bg-[#050505] [&>option]:text-white cursor-pointer">
                            <option value="">Pilih Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 bottom-0 top-[28px] flex items-center px-4 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        @error('gender') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Security -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Kata Sandi *</label>
                        <input id="password" name="password" type="password" required 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                            placeholder="Min. 8 karakter">
                        @error('password') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] sm:text-xs font-montserrat text-gray-300 mb-2 font-medium uppercase tracking-widest">Konfirmasi Kata Sandi *</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="w-full bg-black/20 border border-white/10 rounded-xl p-3.5 focus:border-volt focus:ring-1 focus:ring-volt text-sm text-white font-montserrat transition-all outline-none placeholder-gray-600 shadow-inner" 
                            placeholder="Ketik ulang kata sandi">
                    </div>
                </div>

                <!-- Preferences -->
                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="newsletter" name="newsletter" type="checkbox" value="1" {{ old('newsletter') ? 'checked' : '' }} 
                            class="w-4 h-4 bg-black/40 border border-white/20 rounded focus:ring-volt focus:ring-offset-0 text-volt cursor-pointer transition">
                    </div>
                    <label for="newsletter" class="ml-3 block text-xs text-gray-400 font-montserrat font-light tracking-wide cursor-pointer leading-relaxed">
                        Berlangganan newsletter WILLSPORTS untuk update eksklusif dan akses awal rilis terbaru.
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                        class="w-full bg-black border border-[#ccff00] text-[#ccff00] rounded-full px-8 py-4 font-montserrat font-bold text-sm tracking-widest hover:bg-[#ccff00] hover:text-black hover:-translate-y-1 transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)] hover:shadow-[0_0_25px_rgba(204,255,0,0.4)]">
                        DAFTAR SEKARANG
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/10 text-center text-xs text-gray-400 font-montserrat font-light tracking-wide">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="text-white font-bold uppercase tracking-widest hover:text-volt transition-colors ml-1">Masuk</a>
            </div>
        </div>
    </div>
</div>
@endsection