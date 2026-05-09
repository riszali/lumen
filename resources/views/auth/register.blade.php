@extends('layouts.app')

@section('title', 'Daftar Akun | WILLSPORTS')

@section('content')

<!-- Font Khusus Sports Premium: Bebas Neue (Headline) & Montserrat (Body) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* * PERBAIKAN 1: PENGGUNAAN KELAS CSS NATIVE
     * Menghindari penggunaan Tailwind arbitrary values [...] terlalu banyak di form
     * agar tidak membebani browser saat proses rendering.
     */
    .bg-main-dark { background-color: #050505 !important; }
    .text-volt { color: #ccff00; }
    .volt-input:focus {
        border-color: #ccff00 !important;
        box-shadow: 0 0 0 1px #ccff00 !important;
        outline: none;
    }
    .volt-btn {
        background-color: #050505;
        border: 1px solid #ccff00;
        color: #ccff00;
        transition: all 0.3s ease;
    }
    .volt-btn:hover {
        background-color: #ccff00;
        color: #050505;
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(204, 255, 0, 0.3);
    }
    .volt-checkbox:checked {
        background-color: #ccff00;
        border-color: #ccff00;
    }

    body {
        background-color: #050505 !important;
        color: #ffffff !important;
        font-family: 'Montserrat', sans-serif;
    }

    .font-bebas {
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 0.02em;
    }

    /* * PERBAIKAN 2: EFEK CAHAYA (NEON GLOW) ZERO-COST
     * Mengganti div + blur-[150px] dengan Radial Gradient CSS.
     * Hasil visual persis sama, tapi tidak membebani GPU sama sekali (0 lag).
     */
    .neon-glow-cyan {
        background: radial-gradient(circle at center, rgba(0, 229, 255, 0.08) 0%, rgba(0,0,0,0) 60%);
    }
    .neon-glow-volt {
        background: radial-gradient(circle at center, rgba(204, 255, 0, 0.08) 0%, rgba(0,0,0,0) 60%);
    }

    /* * PERBAIKAN 3: HARDWARE-ACCELERATED GLASSMORPHISM
     * Memaksa HP menggunakan GPU secara efisien untuk efek kaca (transform: translateZ(0)).
     */
    .glass-panel {
        background-color: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        /* Kunci agar HP tidak panas saat ngetik: */
        transform: translateZ(0); 
        will-change: transform;
    }

    /* * PERBAIKAN 4: GANTI FRACTIONAL NOISE SVG DENGAN PATTERN DOT
     * Noise SVG adalah penyebab utama HP Overheat. Kita ganti dengan pattern CSS ringan.
     */
    .bg-pattern {
        background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 24px 24px;
    }
</style>

<!-- Main Wrapper -->
<div class="relative w-full min-h-screen bg-main-dark flex items-center justify-center pt-28 pb-16 overflow-hidden">
    
    <!-- Background Pattern Ringan -->
    <div class="absolute inset-0 z-0 bg-pattern pointer-events-none"></div>

    <!-- Cahaya Pendar (Gradient Radial yang mulus dan ringan) -->
    <div class="absolute top-[-10%] left-[-10%] w-[80vw] h-[80vw] max-w-[800px] max-h-[800px] neon-glow-cyan pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[80vw] h-[80vw] max-w-[800px] max-h-[800px] neon-glow-volt pointer-events-none z-0"></div>

    <div class="max-w-2xl w-full px-4 relative z-20">
        
        <!-- Glassmorphism Form Container -->
        <div class="glass-panel rounded-[2.5rem] p-8 sm:p-10 lg:p-12">
            
            <div class="text-center mb-10 border-b border-gray-800 pb-6">
                <h2 class="font-bebas text-5xl text-white tracking-wide mb-1">DAFTAR <span class="text-volt">AKUN</span></h2>
                <p class="text-sm text-gray-400 font-montserrat font-light tracking-wide">Bergabunglah dengan komunitas elit WILLSPORTS</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Nama Lengkap *</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors placeholder-gray-600 shadow-inner" 
                            placeholder="John Doe">
                        @error('name') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Nomor Telepon *</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors placeholder-gray-600 shadow-inner" 
                            placeholder="081234567890">
                        @error('phone') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Email *</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                        class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors placeholder-gray-600 shadow-inner" 
                        placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="dob" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Tanggal Lahir *</label>
                        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" required 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors shadow-inner [color-scheme:dark]">
                        @error('dob') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <label for="gender" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Jenis Kelamin *</label>
                        <select id="gender" name="gender" required 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors appearance-none shadow-inner [&>option]:bg-black [&>option]:text-white cursor-pointer">
                            <option value="">Pilih Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 bottom-0 top-[28px] flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        @error('gender') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Security -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Kata Sandi *</label>
                        <input id="password" name="password" type="password" required 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors placeholder-gray-600 shadow-inner" 
                            placeholder="Min. 8 karakter">
                        @error('password') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Konfirmasi Kata Sandi *</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="w-full bg-black/40 border border-gray-800 rounded-xl p-3.5 volt-input text-sm text-white font-montserrat transition-colors placeholder-gray-600 shadow-inner" 
                            placeholder="Ketik ulang kata sandi">
                    </div>
                </div>

                <!-- Preferences -->
                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="newsletter" name="newsletter" type="checkbox" value="1" {{ old('newsletter') ? 'checked' : '' }} 
                            class="w-4 h-4 bg-black/40 border border-gray-700 rounded volt-checkbox focus:ring-0 cursor-pointer transition-colors">
                    </div>
                    <label for="newsletter" class="ml-3 block text-xs text-gray-400 font-montserrat font-light tracking-wide cursor-pointer leading-relaxed">
                        Berlangganan newsletter WILLSPORTS untuk update eksklusif dan akses awal rilis terbaru.
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full rounded-full px-8 py-4 font-montserrat font-bold text-sm tracking-widest volt-btn">
                        DAFTAR SEKARANG
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-800 text-center text-xs text-gray-400 font-montserrat font-light tracking-wide">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="text-white font-bold uppercase tracking-widest hover:text-volt transition-colors ml-1">Masuk</a>
            </div>
        </div>
    </div>
</div>
@endsection