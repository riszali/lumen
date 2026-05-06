@extends('layouts.app')

@section('title', 'Keranjang Belanja | WILLSPORTS')

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

    /* OPTIMASI EKSTRIM: Radial Gradient Murni */
    .bg-glow-cyan { background: radial-gradient(circle, rgba(0, 229, 255, 0.05) 0%, transparent 65%); }
    .bg-glow-volt { background: radial-gradient(circle, rgba(204, 255, 0, 0.08) 0%, transparent 65%); }

    /* BYPASS TAILWIND COMPILER: Fix Tombol Hitam */
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
</style>

<!-- Main Wrapper with Dark Background -->
<div class="relative w-full min-h-[90vh] bg-[#050505] overflow-hidden pt-navbar pb-24 transform translate-z-0 font-montserrat text-white">
    
    <!-- Ambient Light Effects (Teroptimasi) -->
    <div class="absolute top-[-10%] left-[-30%] w-[120vw] h-[120vw] md:w-[60vw] md:h-[60vw] bg-glow-cyan pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-20%] w-[100vw] h-[100vw] md:w-[50vw] md:h-[50vw] bg-glow-volt pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="text-center mb-10 border-b border-white/10 pb-6">
            <h1 class="font-bebas text-5xl sm:text-6xl text-white drop-shadow-md tracking-wide">KERANJANG <span class="text-volt-custom">BELANJA</span></h1>
        </div>

        @if(!$cart || $cart->items->count() === 0)
            <!-- Empty Cart State -->
            <div class="text-center py-20 bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] max-w-2xl mx-auto">
                <svg class="w-20 h-20 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <h3 class="font-bebas text-3xl text-white tracking-wide mb-2 uppercase">Keranjang Kosong</h3>
                <p class="text-gray-400 text-sm font-light mb-8 max-w-sm mx-auto">Temukan gear terbaik untuk mendominasi lapangan.</p>
                <a href="{{ route('shop.index') }}" class="inline-block btn-volt-custom px-8 py-3.5 rounded-full uppercase tracking-widest text-[11px] font-bold transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)]">
                    Mulai Belanja
                </a>
            </div>
        @else
            @php
                // FAIL-SAFE: Kalkulasi total langsung di Blade agar kebal dari error Model
                $cartTotal = $cart->items->sum(function($item) {
                    $hargaItem = ($item->product->discount_price && $item->product->discount_price > 0) ? $item->product->discount_price : $item->product->price;
                    return $hargaItem * $item->quantity;
                });
            @endphp
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Cart Items (Glass Container) -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
                        
                        <!-- Table Header -->
                        <div class="hidden sm:grid sm:grid-cols-6 border-b border-white/10 bg-black/20 p-6 text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                            <div class="col-span-3 pl-2">Produk</div>
                            <div class="col-span-1 text-center">Harga</div>
                            <div class="col-span-1 text-center">Kuantitas</div>
                            <div class="col-span-1 text-right pr-2">Total</div>
                        </div>

                        <!-- Item List -->
                        <div class="divide-y divide-white/5">
                            @foreach($cart->items as $item)
                            @php
                                // Tentukan harga final per item
                                $hargaFix = ($item->product->discount_price && $item->product->discount_price > 0) ? $item->product->discount_price : $item->product->price;
                            @endphp
                            <div class="grid grid-cols-1 sm:grid-cols-6 items-center p-6 gap-6 sm:gap-0 hover:bg-white/5 transition duration-300 group">
                                <div class="col-span-3 flex items-center gap-4">
                                    <!-- Image (Glass Frame) -->
                                    <div class="w-20 h-24 bg-black/40 border border-white/10 rounded-xl overflow-hidden flex-shrink-0 shadow-inner relative">
                                        @if($item->product->primaryImage)
                                            <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-white/30 uppercase text-center font-bold">No Img</div>
                                        @endif
                                    </div>
                                    <!-- Details -->
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('shop.show', $item->product->slug) }}" class="text-sm font-bold font-bebas tracking-wide text-white hover:text-[#ccff00] transition text-xl">{{ $item->product->name }}</a>
                                        @if($item->variant)
                                            <p class="text-[10px] text-gray-400 font-bold tracking-widest uppercase mt-1">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                        @endif
                                        <!-- Remove Action -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[10px] text-red-500 hover:text-red-400 uppercase tracking-widest font-bold transition border border-red-500/30 rounded-full px-3 py-1.5 hover:bg-red-500/10">Hapus</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-span-1 text-center text-sm text-gray-400 hidden sm:block font-bold">
                                    @if($item->product->discount_price && $item->product->discount_price > 0)
                                        <div class="flex flex-col items-center">
                                            <span class="line-through text-[10px] text-gray-600 mb-0.5">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                            <span class="text-volt-custom">Rp {{ number_format($hargaFix, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        Rp {{ number_format($hargaFix, 0, ',', '.') }}
                                    @endif
                                </div>

                                <div class="col-span-1 flex justify-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 bg-black/40 border border-white/10 rounded-lg text-center py-2 text-sm text-white focus:ring-[#ccff00] focus:border-[#ccff00] transition shadow-inner outline-none" onchange="this.form.submit()">
                                    </form>
                                </div>

                                <!-- PERBAIKAN: Menggunakan Harga Fix yang Kebal Error -->
                                <div class="col-span-1 text-right text-sm font-bold text-volt-custom sm:pr-2">
                                    Rp {{ number_format($hargaFix * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary (Glass Card) -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] sticky top-28">
                        <h3 class="font-bebas text-3xl text-white mb-6 border-b border-white/10 pb-4 tracking-wide">RINGKASAN</h3>
                        
                        <div class="space-y-4 mb-8 text-sm font-light tracking-wide text-gray-400">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="text-white font-bold">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Pengiriman</span>
                                <span class="text-volt-custom font-bold uppercase text-[10px] tracking-widest mt-1">Dihitung di Checkout</span>
                            </div>
                            <div class="border-t border-white/10 pt-5 flex justify-between items-center mt-2">
                                <span class="font-bold text-white uppercase tracking-wider text-[10px]">Estimasi Total</span>
                                <span class="font-bold text-2xl text-volt-custom font-bebas">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full btn-volt-custom text-center rounded-xl px-8 py-4 uppercase tracking-widest text-[11px] font-bold transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.15)]">
                            Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection