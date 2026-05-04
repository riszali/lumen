@extends('layouts.app')

@section('title', 'Pesanan Saya | WILLSPORTS')

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

    /* BYPASS TAILWIND COMPILER: Fix Warna Neon Hitam */
    .text-volt-custom { color: var(--volt) !important; }
    .bg-volt-custom { background-color: var(--volt) !important; color: #000000 !important; }
    .border-volt-custom { border-color: var(--volt) !important; }
    
    .hover\:text-volt-custom:hover { color: var(--volt) !important; }
    .hover\:bg-volt-custom:hover { 
        background-color: var(--volt) !important; 
        color: #000000 !important; 
        border-color: var(--volt) !important; 
    }
    .group:hover .group-hover\:text-volt-custom { color: var(--volt) !important; }

    /* Khusus untuk status badge dengan opacity */
    .badge-volt-custom {
        background-color: rgba(204, 255, 0, 0.1) !important;
        color: var(--volt) !important;
        border: 1px solid rgba(204, 255, 0, 0.3) !important;
    }
</style>

<!-- Wrapper Utama Latar Belakang Gelap -->
<div class="relative w-full min-h-[90vh] bg-[var(--dark)] bg-noise overflow-hidden pt-navbar pb-24 font-montserrat text-white">
    
    <!-- Efek Cahaya Ambient (Glassmorphism Background) -->
    <div class="absolute top-1/4 right-[10%] w-[30%] h-[40%] bg-[#ccff00] rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none z-0"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[30%] bg-[#00E5FF] rounded-full mix-blend-screen filter blur-[150px] opacity-5 pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <div class="text-center mb-12 border-b border-white/10 pb-8">
            <h1 class="font-bebas text-5xl sm:text-6xl text-white drop-shadow-md mb-2">PESANAN <span class="text-volt-custom">SAYA</span></h1>
            <p class="text-gray-400 text-sm font-light tracking-[0.2em] uppercase">Riwayat Pembelian Elite Anda</p>
        </div>

        @if($orders->count() === 0)
            <!-- Tampilan Kosong (Glass Card) -->
            <div class="text-center py-20 bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-black/40 border border-white/10 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h3 class="font-bebas text-3xl text-white tracking-wide mb-2 uppercase">Belum Ada Pesanan</h3>
                <p class="text-gray-400 text-sm font-light mb-8 max-w-sm mx-auto">Anda belum melakukan pembelian perlengkapan apapun. Siapkan gear Anda sekarang.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-volt-custom px-8 py-3.5 rounded-full uppercase tracking-widest text-[11px] font-bold hover:bg-white hover:text-black transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)]">
                    Mulai Berbelanja
                </a>
            </div>
        @else
            <!-- Tabel Pesanan (Glass Container) -->
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-300">
                        <thead class="bg-black/20 border-b border-white/10 text-[10px] uppercase font-bold text-gray-500 tracking-widest">
                            <tr>
                                <th class="px-8 py-6">No. Pesanan</th>
                                <th class="px-8 py-6">Tanggal</th>
                                <th class="px-8 py-6">Total Pembayaran</th>
                                <th class="px-8 py-6">Status</th>
                                <th class="px-8 py-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($orders as $order)
                            <tr class="hover:bg-white/5 transition duration-300 group">
                                <td class="px-8 py-6 font-bold text-white tracking-wider group-hover:text-volt-custom transition-colors">{{ $order->order_number }}</td>
                                <td class="px-8 py-6 text-gray-400 font-light">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-8 py-6 text-volt-custom font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusStyles = [
                                            'pending'    => 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/30',
                                            'paid'       => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                                            'processing' => 'bg-purple-500/10 text-purple-400 border border-purple-500/30',
                                            'shipped'    => 'badge-volt-custom',
                                            'completed'  => 'badge-volt-custom',
                                            'cancelled'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                                        ];
                                        $styleClass = $statusStyles[$order->status] ?? 'bg-white/10 text-gray-400 border border-white/20';
                                    @endphp
                                    <span class="px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-inner {{ $styleClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-block text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-black hover:bg-volt-custom hover:border-volt-custom px-6 py-2.5 border border-white/20 rounded-full transition-all duration-300 shadow-sm backdrop-blur-md">Lihat Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($orders->hasPages())
                <!-- Paginasi Glassmorphism -->
                <div class="px-8 py-6 border-t border-white/10 bg-black/20 glass-pagination">
                    {{ $orders->links() }}
                </div>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    /* Penyesuaian Styling Paginasi Bawaan Laravel untuk Tema Gelap Willsports */
    .glass-pagination nav p { display: none;}
    .glass-pagination nav > div:first-child { display: none; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    .glass-pagination nav a:hover { 
        background-color: rgba(204, 255, 0, 0.15); 
        color: var(--volt);
        border-color: rgba(204, 255, 0, 0.3);
        border-radius: 9999px; 
    }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(204, 255, 0, 0.2) !important;
        border-color: rgba(204, 255, 0, 0.5) !important;
        color: var(--volt) !important;
        border-radius: 9999px;
    }
</style>
@endsection