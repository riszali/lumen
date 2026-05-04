@extends('layouts.admin')

@section('title', 'Admin Dashboard | WILLSPORTS')
@section('header_title', 'OVERVIEW')

@section('content')
<!-- Ambient Light Background (Khusus Dashboard) -->
<div class="absolute top-[10%] right-[10%] w-[30%] h-[40%] bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[150px] opacity-20 dark:opacity-[0.08] pointer-events-none z-0 transition-colors duration-500"></div>

<div class="relative w-full space-y-8 z-10">

    <!-- Header Banner (Glassmorphism & Rounded) -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between p-8 bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] transition-colors duration-500">
        <div>
            <h1 class="font-bebas text-4xl sm:text-6xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">SELAMAT DATANG, {{ auth()->user()->name ?? 'ADMIN' }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-montserrat font-light mt-2 tracking-wide transition-colors duration-500">Pantau performa penjualan dan manajemen produk WILLSPORTS.</p>
        </div>
        <div class="mt-4 sm:mt-0 text-right">
            <span class="text-xs text-gray-600 dark:text-gray-400 uppercase tracking-widest font-montserrat font-bold bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 px-4 py-2 rounded-xl shadow-inner transition-colors duration-500">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white/80 dark:bg-white/[0.02] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[1.5rem] p-6 hover:bg-white dark:hover:bg-white/[0.08] hover:border-emerald-300 dark:hover:border-volt/50 shadow-sm hover:shadow-md dark:shadow-lg dark:hover:shadow-[0_10px_30px_rgba(204,255,0,0.1)] transition-all duration-300 group">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-gray-500 dark:text-gray-400 text-xs font-montserrat font-bold uppercase tracking-widest group-hover:text-emerald-700 dark:group-hover:text-white transition">Total Pendapatan</h3>
                <div class="p-2.5 bg-gray-100 dark:bg-black/40 rounded-xl border border-gray-200 dark:border-white/10 text-emerald-600 dark:text-volt group-hover:bg-emerald-100 dark:group-hover:bg-volt group-hover:text-emerald-700 dark:group-hover:text-black transition shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-4xl sm:text-5xl font-bebas text-gray-900 dark:text-white tracking-wider transition-colors duration-500">Rp {{ number_format($revenue ?? 0, 0, ',', '.') }}</p>
        </div>
        
        <!-- Orders Card -->
        <div class="bg-white/80 dark:bg-white/[0.02] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[1.5rem] p-6 hover:bg-white dark:hover:bg-white/[0.08] hover:border-emerald-300 dark:hover:border-volt/50 shadow-sm hover:shadow-md dark:shadow-lg dark:hover:shadow-[0_10px_30px_rgba(204,255,0,0.1)] transition-all duration-300 group">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-gray-500 dark:text-gray-400 text-xs font-montserrat font-bold uppercase tracking-widest group-hover:text-emerald-700 dark:group-hover:text-white transition">Total Pesanan</h3>
                <div class="p-2.5 bg-gray-100 dark:bg-black/40 rounded-xl border border-gray-200 dark:border-white/10 text-emerald-600 dark:text-volt group-hover:bg-emerald-100 dark:group-hover:bg-volt group-hover:text-emerald-700 dark:group-hover:text-black transition shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <p class="text-4xl sm:text-5xl font-bebas text-gray-900 dark:text-white tracking-wider transition-colors duration-500">{{ number_format($totalOrders ?? 0) }}</p>
        </div>
        
        <!-- Products Card -->
        <div class="bg-white/80 dark:bg-white/[0.02] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[1.5rem] p-6 hover:bg-white dark:hover:bg-white/[0.08] hover:border-emerald-300 dark:hover:border-volt/50 shadow-sm hover:shadow-md dark:shadow-lg dark:hover:shadow-[0_10px_30px_rgba(204,255,0,0.1)] transition-all duration-300 group">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-gray-500 dark:text-gray-400 text-xs font-montserrat font-bold uppercase tracking-widest group-hover:text-emerald-700 dark:group-hover:text-white transition">Total Produk</h3>
                <div class="p-2.5 bg-gray-100 dark:bg-black/40 rounded-xl border border-gray-200 dark:border-white/10 text-emerald-600 dark:text-volt group-hover:bg-emerald-100 dark:group-hover:bg-volt group-hover:text-emerald-700 dark:group-hover:text-black transition shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
            </div>
            <p class="text-4xl sm:text-5xl font-bebas text-gray-900 dark:text-white tracking-wider transition-colors duration-500">{{ number_format($totalProducts ?? 0) }}</p>
        </div>
    </div>

    <!-- Recent Orders Table (Glassmorphism & Rounded) -->
    <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] transition-colors duration-500">
        <div class="px-8 py-6 border-b border-gray-200 dark:border-white/10 flex justify-between items-center bg-gray-50/50 dark:bg-white/5 transition-colors duration-500">
            <h3 class="font-bebas text-3xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md">PESANAN TERBARU</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-montserrat font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 hover:text-white dark:hover:text-black hover:bg-emerald-500 dark:hover:bg-volt transition border border-gray-200 dark:border-white/20 px-4 py-2 rounded-xl bg-white dark:bg-black/40 shadow-inner">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat transition-colors duration-500">
                <thead class="bg-gray-100 dark:bg-black/20 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest transition-colors duration-500">
                    <tr>
                        <th class="px-8 py-5">No. Pesanan</th>
                        <th class="px-8 py-5">Pelanggan</th>
                        <th class="px-8 py-5">Total</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($recentOrders ?? [] as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300 group">
                        <td class="px-8 py-5 font-bold text-gray-900 dark:text-white tracking-wider">{{ $order->order_number }}</td>
                        <td class="px-8 py-5">
                            <span class="block text-gray-900 dark:text-white">{{ $order->user->name }}</span>
                            <span class="block text-[10px] text-gray-500 mt-1">{{ $order->user->email }}</span>
                        </td>
                        <td class="px-8 py-5 font-bold text-emerald-600 dark:text-volt">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-8 py-5">
                            @if($order->status == 'completed')
                                <span class="px-3 py-1.5 bg-emerald-100 dark:bg-volt/10 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Selesai</span>
                            @elseif($order->status == 'pending')
                                <span class="px-3 py-1.5 bg-yellow-100 dark:bg-yellow-500/10 text-yellow-700 dark:text-yellow-500 border border-yellow-200 dark:border-yellow-500/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Menunggu</span>
                            @elseif($order->status == 'cancelled')
                                <span class="px-3 py-1.5 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-500/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Batal</span>
                            @else
                                <span class="px-3 py-1.5 bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right text-gray-500 text-xs tracking-wider">{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-gray-400 dark:text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <span class="text-xs uppercase tracking-widest">Belum ada pesanan terbaru.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection