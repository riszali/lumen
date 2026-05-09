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
        --card-bg: #0a0a0a;
        --input-bg: #141414;
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
</style>

<!-- Main Wrapper - Latar belakang hanya warna solid murni (Tanpa gradient sama sekali) -->
<div class="w-full min-h-screen bg-[var(--dark)] flex items-center justify-center pt-28 pb-16 px-4">
    
    <div class="max-w-2xl w-full">
        
        <!-- Form Container - Menggunakan Flat Design -->
        <!-- Menghapus SEMUA shadow yang memberatkan GPU. Mengganti aksen dengan border-t-2 solid -->
        <div class="bg-[var(--card-bg)] border border-white/5 border-t-2 border-t-[var(--volt)] rounded-2xl p-8 sm:p-10 lg:p-12">
            
            <div class="text-center mb-10 border-b border-white/5 pb-6">
                <!-- Menghapus drop-shadow pada teks -->
                <h2 class="font-bebas text-5xl text-white tracking-wide mb-1">DAFTAR <span class="text-[var(--volt)]">AKUN</span></h2>
                <p class="text-sm text-gray-500 font-montserrat font-light tracking-wide">Bergabunglah dengan komunitas elit WILLSPORTS</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Nama Lengkap *</label>
                        <!-- Input solid murni -->
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus 
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none placeholder-gray-600" 
                            placeholder="John Doe">
                        @error('name') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Nomor Telepon *</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required 
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none placeholder-gray-600" 
                            placeholder="081234567890">
                        @error('phone') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Email *</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                        class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none placeholder-gray-600" 
                        placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="dob" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Tanggal Lahir *</label>
                        <input id="dob" name="dob" type="date" value="{{ old('dob') }}" required 
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none [color-scheme:dark]">
                        @error('dob') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <label for="gender" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Jenis Kelamin *</label>
                        <select id="gender" name="gender" required 
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none appearance-none cursor-pointer">
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
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none placeholder-gray-600" 
                            placeholder="Min. 8 karakter">
                        @error('password') <p class="text-red-500 text-xs mt-2 font-montserrat font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] sm:text-xs font-montserrat text-gray-400 mb-2 font-medium uppercase tracking-widest">Konfirmasi Kata Sandi *</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="w-full bg-[var(--input-bg)] border border-white/5 rounded-lg p-3.5 focus:border-[var(--volt)] text-sm text-white font-montserrat outline-none placeholder-gray-600" 
                            placeholder="Ketik ulang kata sandi">
                    </div>
                </div>

                <!-- Preferences -->
                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="newsletter" name="newsletter" type="checkbox" value="1" {{ old('newsletter') ? 'checked' : '' }} 
                            class="w-4 h-4 bg-[var(--input-bg)] border border-white/10 rounded focus:ring-[var(--volt)] focus:ring-offset-0 text-[var(--volt)] cursor-pointer">
                    </div>
                    <label for="newsletter" class="ml-3 block text-xs text-gray-500 font-montserrat font-light tracking-wide cursor-pointer leading-relaxed">
                        Berlangganan newsletter WILLSPORTS untuk update eksklusif dan akses awal rilis terbaru.
                    </label>
                </div>

                <div class="pt-6">
                    <!-- Tombol solid murni, tanpa shadow bercahaya -->
                    <button type="submit" 
                        class="w-full bg-[var(--volt)] text-black rounded-lg px-8 py-4 font-montserrat font-bold text-sm tracking-widest hover:bg-[#aacc00] transition-colors duration-200">
                        DAFTAR SEKARANG
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center text-xs text-gray-500 font-montserrat font-light tracking-wide">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="text-[var(--volt)] font-bold uppercase tracking-widest hover:text-white transition-colors ml-1">Masuk</a>
            </div>
        </div>
    </div>
</div>
@endsection