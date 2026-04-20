@extends('layouts.app')

@section('title', 'Pesanan Saya | LUMEN')

@section('content')
<!-- Wrapper Utama Latar Belakang Gelap -->
<!-- MENGGUNAKAN pt-navbar AGAR TIDAK NABRAK NAVBAR -->
<div class="relative w-full min-h-[90vh] bg-[#252322] overflow-hidden pt-navbar pb-24">
    
    <!-- Efek Cahaya Ambient (Glassmorphism Background) -->
    <div class="absolute top-1/4 right-[10%] w-[30%] h-[40%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[30%] bg-brand-sage rounded-full mix-blend-screen filter blur-[120px] opacity-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <div class="text-center mb-12">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md mb-3">Pesanan Saya</h1>
            <p class="text-brand-gray text-sm font-light tracking-[0.2em] uppercase">Riwayat Pembelian Anda</p>
        </div>

        @if($orders->count() === 0)
            <!-- Tampilan Kosong (Glass Card) -->
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] max-w-2xl mx-auto">
                <svg class="w-16 h-16 mx-auto mb-6 text-brand-gray opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <p class="text-brand-cream font-medium tracking-wide mb-2 uppercase text-sm">Belum Ada Pesanan</p>
                <p class="text-brand-gray text-xs font-light mb-8">Anda belum melakukan pembelian apapun.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-brand-sage/20 text-brand-sage border border-brand-sage/30 px-8 py-3 rounded-full uppercase tracking-widest text-[10px] font-bold hover:bg-brand-sage/30 hover:scale-105 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)]">
                    Mulai Berbelanja
                </a>
            </div>
        @else
            <!-- Tabel Pesanan (Glass Container) -->
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-brand-warm">
                        <thead class="bg-white/5 border-b border-white/10 text-xs uppercase font-semibold text-brand-gray tracking-wider">
                            <tr>
                                <th class="px-8 py-5">No. Pesanan</th>
                                <th class="px-8 py-5">Tanggal</th>
                                <th class="px-8 py-5">Total Pembayaran</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($orders as $order)
                            <tr class="hover:bg-white/10 transition duration-300 group">
                                <td class="px-8 py-5 font-medium text-brand-cream tracking-wider">{{ $order->order_number }}</td>
                                <td class="px-8 py-5 text-brand-gray font-light">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-8 py-5 text-brand-sage font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-8 py-5">
                                    @php
                                        $statusStyles = [
                                            'pending'    => 'bg-brand-warm/20 text-brand-warm border-brand-warm/30 shadow-[0_0_10px_rgba(218,213,204,0.15)]',
                                            'paid'       => 'bg-brand-cream/20 text-brand-cream border-brand-cream/30 shadow-[0_0_10px_rgba(237,231,212,0.15)]',
                                            'processing' => 'bg-brand-olive/20 text-brand-olive border-brand-olive/30 shadow-[0_0_10px_rgba(154,149,135,0.15)]',
                                            'shipped'    => 'bg-brand-light/20 text-brand-light border-brand-light/30 shadow-[0_0_10px_rgba(229,230,217,0.15)]',
                                            'completed'  => 'bg-brand-sage/20 text-brand-sage border-brand-sage/30 shadow-[0_0_10px_rgba(170,171,154,0.15)]',
                                            'cancelled'  => 'bg-red-500/10 text-red-400 border-red-500/20 shadow-[0_0_10px_rgba(239,68,68,0.1)]',
                                        ];
                                        $styleClass = $statusStyles[$order->status] ?? 'bg-white/10 text-brand-gray border-white/20';
                                    @endphp
                                    <span class="px-3 py-1.5 border rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm {{ $styleClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-[10px] font-bold uppercase tracking-widest text-brand-gray hover:text-brand-cream px-4 py-2 border border-white/10 rounded-full hover:bg-white/10 transition duration-300">Lihat Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($orders->hasPages())
                <!-- Paginasi Glassmorphism -->
                <div class="px-8 py-5 border-t border-white/10 bg-black/20 glass-pagination">
                    {{ $orders->links() }}
                </div>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    /* Penyesuaian Styling Paginasi Bawaan Laravel untuk Tema Gelap */
    .glass-pagination nav p { color: #AAAB9A; display: none;}
    .glass-pagination nav > div:first-child { display: none; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #EDE7D4;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .glass-pagination nav a:hover { background-color: rgba(255, 255, 255, 0.15); border-radius: 9999px; }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(170, 171, 154, 0.3) !important;
        border-color: rgba(170, 171, 154, 0.5) !important;
        color: #EDE7D4 !important;
        border-radius: 9999px;
    }
</style>
@endsection