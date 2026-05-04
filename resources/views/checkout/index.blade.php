@extends('layouts.app')

@section('title', 'Checkout | WILLSPORTS')

@section('content')
<!-- Font & Styles Khusus Sports Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --volt: #ccff00;      
        --dark: #050505;      
    }
    .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.02em; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    .bg-glow-cyan { background: radial-gradient(circle, rgba(0, 229, 255, 0.05) 0%, transparent 65%); }
    .bg-glow-volt { background: radial-gradient(circle, rgba(204, 255, 0, 0.08) 0%, transparent 65%); }

    .text-volt-custom { color: var(--volt) !important; }
    .btn-volt-custom {
        background-color: var(--volt) !important;
        color: #000000 !important;
        border: 1px solid var(--volt) !important;
    }
    .btn-volt-custom:hover {
        background-color: #ffffff !important;
        color: #000000 !important;
        border-color: #ffffff !important;
        box-shadow: 0 0 25px rgba(255,255,255,0.4) !important;
    }

    /* Custom Scrollbar for Order Review Box */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: var(--volt); }
</style>

<!-- Main Wrapper with Dark Background -->
<div class="relative w-full min-h-screen bg-[#050505] overflow-hidden pt-navbar pb-24 transform translate-z-0 font-montserrat text-white">
    
    <!-- Ambient Light Effects (Teroptimasi) -->
    <div class="absolute top-[-10%] left-[-30%] w-[120vw] h-[120vw] md:w-[60vw] md:h-[60vw] bg-glow-cyan pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-20%] w-[100vw] h-[100vw] md:w-[50vw] md:h-[50vw] bg-glow-volt pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="text-center mb-10 border-b border-white/10 pb-6">
            <h1 class="font-bebas text-5xl sm:text-6xl text-white drop-shadow-md tracking-wide">SECURE <span class="text-volt-custom">CHECKOUT</span></h1>
            <p class="text-gray-400 text-sm mt-2 tracking-[0.2em] uppercase font-bold text-[10px]">Selesaikan Pembelian Anda</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            @csrf

            <!-- Shipping & Payment Details -->
            <div class="w-full lg:w-2/3 space-y-8">
                
                <!-- Customer Information (Glass Card) -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
                    <h2 class="text-xl font-bebas tracking-wider text-white mb-6 border-b border-white/10 pb-4">1. INFORMASI PENGIRIMAN</h2>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2 font-bold">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-black/40 border border-white/5 rounded-xl py-3.5 px-4 text-sm text-gray-500 opacity-70 cursor-not-allowed shadow-inner" disabled>
                        </div>
                        
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2 font-bold">Alamat Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-black/40 border border-white/5 rounded-xl py-3.5 px-4 text-sm text-gray-500 opacity-70 cursor-not-allowed shadow-inner" disabled>
                        </div>

                        <div>
                            <label for="phone" class="block text-[10px] uppercase tracking-widest text-white mb-2 font-bold">Nomor Telepon *</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-[#ccff00] focus:border-[#ccff00] text-sm text-white placeholder-white/20 shadow-inner transition outline-none" required placeholder="Contoh: 08123456789">
                            @error('phone') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-[10px] uppercase tracking-widest text-white mb-2 font-bold">Alamat Pengiriman Lengkap *</label>
                            <textarea name="address" id="address" rows="4" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-[#ccff00] focus:border-[#ccff00] text-sm text-white placeholder-white/20 shadow-inner transition outline-none" required placeholder="Nama Jalan, Gedung, No. Rumah, RT/RW, Kecamatan, Kota, Provinsi, Kode Pos">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method (Glass Card) -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
                    <h2 class="text-xl font-bebas tracking-wider text-white mb-6 border-b border-white/10 pb-4">2. METODE PEMBAYARAN</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center p-5 bg-black/20 border border-white/10 rounded-xl cursor-pointer hover:bg-white/5 transition group">
                            <!-- OPTIMASI: Focus ring disesuaikan tanpa tailwind custom class yang rumit -->
                            <input type="radio" name="payment_method" value="bank_transfer" class="text-[#ccff00] focus:ring-[#ccff00] w-5 h-5 bg-black/40 border-white/20" checked>
                            <span class="ml-4 flex flex-col">
                                <span class="font-bold text-white tracking-wide group-hover:text-[#ccff00] transition">Transfer Bank Manual</span>
                                <span class="text-[10px] text-gray-400 mt-1 font-bold uppercase tracking-widest">Transfer langsung ke rekening BCA / Mandiri.</span>
                            </span>
                        </label>

                        <label class="flex items-center p-5 bg-black/20 border border-white/10 rounded-xl cursor-pointer hover:bg-white/5 transition group opacity-50" title="Coming Soon">
                            <input type="radio" name="payment_method" value="credit_card" class="text-[#ccff00] focus:ring-[#ccff00] w-5 h-5 bg-black/40 border-white/20" disabled>
                            <span class="ml-4 flex flex-col">
                                <span class="font-bold text-white tracking-wide">Credit Card / E-Wallet (Segera Hadir)</span>
                                <span class="text-[10px] text-gray-400 mt-1 font-bold uppercase tracking-widest">Pembayaran otomatis via Midtrans.</span>
                            </span>
                        </label>
                        @error('payment_method') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <!-- Order Review -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] sticky top-28">
                    <h2 class="text-xl font-bebas tracking-wider text-white mb-6 border-b border-white/10 pb-4">RINGKASAN PESANAN</h2>
                    
                    <div class="space-y-6 mb-6 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart->items as $item)
                        <div class="flex gap-4">
                            <!-- Image Glass Frame -->
                            <div class="w-16 h-20 bg-black/40 border border-white/10 rounded-lg flex-shrink-0 overflow-hidden shadow-inner relative">
                                @if($item->product->primaryImage)
                                    <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[8px] text-white/30 uppercase text-center font-bold">No Img</div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col justify-center">
                                <h4 class="text-xs font-bold text-white uppercase tracking-wider line-clamp-2">{{ $item->product->name }}</h4>
                                @if($item->variant)
                                    <p class="text-[10px] text-gray-400 mt-1 font-bold">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                @endif
                                <p class="text-[10px] text-gray-400 mt-1 font-bold">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-xs font-bold text-volt-custom flex items-center whitespace-nowrap">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-white/10 pt-5 space-y-4 mb-8">
                        <div class="flex justify-between text-sm font-bold tracking-wide">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold tracking-wide">
                            <span class="text-gray-400">Pengiriman</span>
                            <span class="text-volt-custom uppercase text-[10px] tracking-widest mt-1">Gratis (Promo)</span>
                        </div>
                        <div class="border-t border-white/10 pt-5 flex justify-between items-center">
                            <span class="font-bold text-white uppercase tracking-wider text-[11px]">Total Bayar</span>
                            <span class="font-bebas text-2xl text-volt-custom drop-shadow-md">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-volt-custom rounded-xl px-8 py-4 uppercase tracking-widest text-[11px] font-bold transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.15)]">
                        BUAT PESANAN SEKARANG
                    </button>
                    <p class="text-center text-[9px] uppercase tracking-widest text-gray-500 mt-6 font-bold">Dengan membuat pesanan, Anda menyetujui Syarat & Ketentuan kami.</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection