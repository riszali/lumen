@extends('layouts.app')

@section('title', 'Pesanan Berhasil | WILLSPORTS')

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
</style>

<!-- Main Wrapper with Dark Background -->
<div class="relative w-full min-h-[90vh] bg-[#050505] overflow-hidden py-16 flex items-center justify-center font-montserrat transform translate-z-0 pt-navbar">
    
    <!-- Ambient Light Effects -->
    <div class="absolute top-1/4 left-[-10%] w-[80vw] h-[80vw] md:w-[40vw] md:h-[40vw] bg-glow-cyan pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[80vw] h-[80vw] md:w-[40vw] md:h-[40vw] bg-glow-volt pointer-events-none z-0"></div>

    <div class="max-w-3xl w-full mx-auto px-4 relative z-20 text-center">
        
        <!-- Success Icon -->
        <div class="mb-8 inline-flex items-center justify-center w-24 h-24 bg-white/[0.03] border border-[#ccff00]/30 rounded-full shadow-[0_0_20px_rgba(204,255,0,0.2)] backdrop-blur-md">
            <svg class="w-12 h-12 text-volt-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h1 class="font-bebas text-5xl sm:text-6xl text-white mb-4 drop-shadow-md tracking-wide">TERIMA KASIH ATAS <span class="text-volt-custom">PESANAN ANDA</span></h1>
        <p class="text-sm text-gray-400 font-light mb-12 tracking-wide max-w-lg mx-auto">Pesanan Anda telah berhasil dibuat dan saat ini sedang menunggu pembayaran. Mohon segera selesaikan pembayaran agar kami dapat memproses pesanan Anda.</p>
        
        <!-- Order Details (Glass Card) -->
        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 mb-8 text-left shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
            <h3 class="font-bold text-white uppercase tracking-widest text-[11px] mb-6 border-b border-white/10 pb-4">Rincian Pesanan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 text-sm font-light tracking-wide">
                <div class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Nomor Pesanan</div>
                <div class="font-bold text-white tracking-widest">{{ $order->order_number }}</div>
                
                <div class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Tanggal Pemesanan</div>
                <div class="font-bold text-white">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
                
                <div class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Total Pembayaran</div>
                <div class="font-bebas text-2xl text-volt-custom tracking-wider">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                
                <div class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Metode Pembayaran</div>
                <div class="font-bold text-white uppercase tracking-wider">{{ str_replace('_', ' ', $order->payment_method) }}</div>
            </div>
        </div>

        <!-- Payment Instructions -->
        @if($order->payment_method === 'bank_transfer')
        <div class="bg-yellow-500/5 backdrop-blur-xl border border-yellow-500/20 rounded-[2rem] p-6 sm:p-8 mb-10 text-left shadow-[0_8px_32px_0_rgba(0,0,0,0.2)]">
            <div class="flex items-center gap-3 mb-6 border-b border-yellow-500/20 pb-4">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                <h3 class="font-bebas text-2xl text-yellow-500 tracking-wide pt-1">INSTRUKSI PEMBAYARAN</h3>
            </div>
            <p class="text-sm text-white mb-6 font-light leading-relaxed">Silakan lakukan transfer sebesar <strong class="text-yellow-500 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> ke salah satu rekening resmi kami di bawah ini:</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-black/40 p-5 rounded-2xl border border-white/5 shadow-inner flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center font-bebas text-xl text-white">BCA</div>
                    <div>
                        <p class="text-lg font-bold text-volt-custom tracking-widest">1234 5678 90</p>
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-1">A.N WILLSPORTS APPAREL</p>
                    </div>
                </div>
                <div class="bg-black/40 p-5 rounded-2xl border border-white/5 shadow-inner flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center font-bebas text-xl text-white">MDR</div>
                    <div>
                        <p class="text-lg font-bold text-volt-custom tracking-widest">0987 6543 21</p>
                        <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-1">A.N WILLSPORTS APPAREL</p>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400 font-light">Setelah pembayaran selesai, tim kami akan segera memverifikasi dan memproses pesanan Anda.</p>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="{{ route('orders.show', $order->id) }}" class="border border-white/20 text-white px-8 py-3.5 rounded-full uppercase tracking-widest text-[11px] font-bold hover:bg-white/10 hover:border-white transition duration-300 backdrop-blur-md">
                Cek Status Pesanan
            </a>
            <a href="{{ route('shop.index') }}" class="btn-volt-custom px-8 py-3.5 rounded-full uppercase tracking-widest text-[11px] font-bold transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.15)]">
                Lanjut Belanja
            </a>
        </div>
    </div>
</div>
@endsection