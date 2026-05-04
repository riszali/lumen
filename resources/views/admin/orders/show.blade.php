@extends('layouts.app')

@section('title', 'Order Details | WILLSPORTS')

@section('content')
<!-- Font Khusus Sports Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --volt: #ccff00;      
        --dark: #050505;      
    }
    .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.02em; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    .bg-noise {
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
    }
</style>

<!-- Main Wrapper with Dark Background & Noise -->
<div class="relative w-full min-h-screen bg-[var(--dark)] bg-noise overflow-hidden pt-navbar pb-24 font-montserrat text-white">
    
    <!-- Ambient Light Effects (Glassmorphism Background) -->
    <div class="absolute top-0 left-[-10%] w-[40%] h-[50%] bg-[#00E5FF] rounded-full mix-blend-screen filter blur-[150px] opacity-5 animate-pulse pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[40%] bg-volt rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none z-0"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <!-- Page Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-white/10 pb-8">
            <div>
                <a href="{{ route('orders.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-500 hover:text-volt mb-4 inline-flex items-center transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Pesanan
                </a>
                <h1 class="font-bebas text-5xl sm:text-6xl text-white drop-shadow-md tracking-wide mt-2">ORDER <span class="text-volt">#{{ $order->order_number }}</span></h1>
                <p class="text-sm text-gray-400 mt-2 font-light tracking-wide">Dipesan pada {{ $order->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="mb-2">
                @php
                    $statusStyles = [
                        'pending'    => 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/30',
                        'paid'       => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                        'processing' => 'bg-purple-500/10 text-purple-400 border border-purple-500/30',
                        'shipped'    => 'bg-volt/10 text-volt border border-volt/30',
                        'completed'  => 'bg-volt/10 text-volt border border-volt/30',
                        'cancelled'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                    ];
                    $styleClass = $statusStyles[$order->status] ?? 'bg-white/10 text-gray-400 border border-white/20';
                @endphp
                <span class="px-6 py-2.5 rounded-full text-[11px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-inner {{ $styleClass }}">
                    Status: {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Awaiting Payment Warning (Khusus Pending & Transfer Bank) -->
        @if($order->status === 'pending' && $order->payment_method === 'bank_transfer')
        <div class="bg-yellow-500/5 backdrop-blur-xl border border-yellow-500/20 rounded-[2rem] p-8 mb-10 shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="flex items-center gap-4 mb-6 border-b border-yellow-500/20 pb-4">
                <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center border border-yellow-500/30">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bebas text-3xl text-yellow-500 tracking-wide pt-1">MENUNGGU PEMBAYARAN</h3>
            </div>
            <p class="text-sm text-white mb-6 font-light leading-relaxed">Silakan lakukan transfer sebesar <strong class="text-yellow-500 font-bold text-base">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> ke salah satu rekening resmi kami di bawah ini:</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-black/40 p-6 rounded-2xl border border-white/10 shadow-inner flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center font-bebas text-xl text-white">BCA</div>
                    <div>
                        <p class="text-lg font-bold text-volt tracking-widest">1234 5678 90</p>
                        <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">A.N WILLSPORTS APPAREL</p>
                    </div>
                </div>
                <div class="bg-black/40 p-6 rounded-2xl border border-white/10 shadow-inner flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center font-bebas text-xl text-white">MDR</div>
                    <div>
                        <p class="text-lg font-bold text-volt tracking-widest">0987 6543 21</p>
                        <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">A.N WILLSPORTS APPAREL</p>
                    </div>
                </div>
            </div>
            
            <p class="text-xs text-gray-400 font-light">Setelah pembayaran selesai, tim kami akan segera memverifikasi dan memproses pesanan Anda.</p>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column: Ordered Items -->
            <div class="w-full lg:w-3/5">
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] rounded-[2.5rem] p-6 sm:p-10">
                    <h3 class="font-bebas text-3xl text-white tracking-wide mb-8 border-b border-white/10 pb-4">PRODUK YANG DIPESAN</h3>
                    
                    <div class="space-y-6">
                        @foreach($order->items as $item)
                        <div class="flex flex-col sm:flex-row gap-6 p-4 bg-black/20 rounded-2xl border border-white/5 shadow-inner group">
                            <!-- Item Image (Glass Frame) -->
                            <div class="w-full sm:w-24 h-32 bg-black/40 rounded-xl flex-shrink-0 border border-white/10 overflow-hidden relative">
                                @if($item->product && $item->product->primaryImage)
                                    <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-white/30 uppercase font-bold tracking-widest">No Img</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <!-- Item Info -->
                            <div class="flex-grow flex flex-col justify-center">
                                <h4 class="text-lg font-bebas text-white tracking-wide mb-1">
                                    @if($item->product)
                                        <a href="{{ route('shop.show', $item->product->slug) }}" class="hover:text-volt transition">{{ $item->product_name }}</a>
                                    @else
                                        {{ $item->product_name }}
                                    @endif
                                </h4>
                                @if($item->variant)
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-3">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                @endif
                                
                                <div class="mt-auto flex justify-between items-center border-t border-white/10 pt-3">
                                    <p class="text-xs text-gray-400">Qty: <span class="text-white font-bold">{{ $item->quantity }}</span> &times; Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <p class="text-sm font-bold text-volt">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Summary & Shipping -->
            <div class="w-full lg:w-2/5 space-y-8">
                
                <!-- Order Summary -->
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.5)]">
                    <h3 class="font-bebas text-3xl text-white tracking-wide mb-6 border-b border-white/10 pb-4">RINGKASAN BIAYA</h3>
                    <div class="space-y-4 text-sm font-light tracking-wide">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Subtotal Produk</span>
                            <span class="text-white font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Biaya Pengiriman</span>
                            <span class="text-volt font-bold uppercase text-[10px] tracking-widest px-3 py-1 bg-volt/10 rounded-full border border-volt/20">Gratis</span>
                        </div>
                        <div class="border-t border-white/10 pt-6 mt-4 flex justify-between items-end">
                            <div>
                                <span class="font-bold text-gray-500 uppercase tracking-widest text-[10px] block mb-1">Total Keseluruhan</span>
                            </div>
                            <span class="font-bebas text-4xl text-volt tracking-wider drop-shadow-md">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] relative overflow-hidden">
                    <!-- Accent background map -->
                    <svg class="absolute -bottom-10 -right-10 w-40 h-40 text-white/5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>

                    <h3 class="font-bebas text-3xl text-white tracking-wide mb-6 border-b border-white/10 pb-4 relative z-10">DETAIL PENGIRIMAN</h3>
                    <div class="text-sm text-gray-400 space-y-4 font-light tracking-wide relative z-10">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-bold text-gray-500 block mb-1">Penerima</span>
                            <p class="text-white font-medium text-base">{{ $order->user->name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest font-bold text-gray-500 block mb-1">Email</span>
                                <p class="text-white truncate" title="{{ $order->user->email }}">{{ $order->user->email }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-widest font-bold text-gray-500 block mb-1">Telepon</span>
                                <p class="text-white">{{ $order->user->phone ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-white/10">
                            <span class="text-[10px] uppercase tracking-widest font-bold text-gray-500 block mb-2">Alamat Lengkap</span>
                            <p class="leading-relaxed bg-black/30 p-4 rounded-xl border border-white/5">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection