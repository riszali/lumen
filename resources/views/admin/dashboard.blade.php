@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Overview')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <div class="absolute top-0 left-0 w-96 h-96 bg-brand-olive rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-sage rounded-full mix-blend-screen filter blur-[100px] opacity-15"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-brand-warm rounded-full mix-blend-screen filter blur-[100px] opacity-10"></div>

    <div class="relative z-10 space-y-8">

        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 sm:p-8 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="w-20 h-20 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 backdrop-blur-md p-3 shadow-inner flex-shrink-0">
                <img src="{{ asset('assets/logo/logo-lumen-white.png') }}" alt="LUMEN Logo" class="w-full h-full object-contain drop-shadow-[0_0_12px_rgba(237,231,212,0.3)]">
            </div>
            <div class="text-center sm:text-left pt-1">
                <h1 class="font-serif text-3xl sm:text-4xl text-brand-cream tracking-wide drop-shadow-md">Dashboard</h1>
                <p class="text-xs text-brand-gray font-light tracking-[0.25em] uppercase mt-2">Lumen Control Panel</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[1.5rem] p-6 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] hover:bg-white/10 hover:-translate-y-1 transition duration-300 group">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-brand-gray text-xs font-semibold uppercase tracking-widest group-hover:text-brand-sage transition">Total Revenue</h3>
                    <div class="p-2 bg-brand-sage/20 rounded-lg text-brand-sage border border-brand-sage/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-3xl font-serif font-bold text-brand-cream tracking-wider">Rp {{ number_format($revenue, 0, ',', '.') }}</p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[1.5rem] p-6 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] hover:bg-white/10 hover:-translate-y-1 transition duration-300 group">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-brand-gray text-xs font-semibold uppercase tracking-widest group-hover:text-brand-warm transition">Total Orders</h3>
                    <div class="p-2 bg-brand-warm/20 rounded-lg text-brand-warm border border-brand-warm/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <p class="text-3xl font-serif font-bold text-brand-cream tracking-wider">{{ number_format($totalOrders) }}</p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[1.5rem] p-6 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] hover:bg-white/10 hover:-translate-y-1 transition duration-300 group">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-brand-gray text-xs font-semibold uppercase tracking-widest group-hover:text-brand-light transition">Total Products</h3>
                    <div class="p-2 bg-brand-light/20 rounded-lg text-brand-light border border-brand-light/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </div>
                </div>
                <p class="text-3xl font-serif font-bold text-brand-cream tracking-wider">{{ number_format($totalProducts) }}</p>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
            <div class="px-8 py-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                <h3 class="font-serif text-xl text-brand-cream tracking-wide">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-xs uppercase tracking-widest text-brand-sage hover:text-brand-cream transition px-4 py-2 bg-white/5 hover:bg-white/10 rounded-full border border-white/10">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-brand-warm">
                    <thead class="bg-white/5 border-b border-white/10 text-xs uppercase font-semibold text-brand-gray tracking-wider">
                        <tr>
                            <th class="px-8 py-5">Order No.</th>
                            <th class="px-8 py-5">Customer</th>
                            <th class="px-8 py-5">Amount</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-white/10 transition duration-300">
                            <td class="px-8 py-5 font-medium text-brand-cream tracking-wider">{{ $order->order_number }}</td>
                            <td class="px-8 py-5 text-brand-cream">{{ $order->user->name }}</td>
                            <td class="px-8 py-5 font-medium text-brand-sage">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-8 py-5">
                                @if($order->status == 'completed')
                                    <span class="px-3 py-1.5 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(170,171,154,0.2)]">Completed</span>
                                @elseif($order->status == 'pending')
                                    <span class="px-3 py-1.5 bg-brand-warm/20 text-brand-warm border border-brand-warm/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(218,213,204,0.2)]">Pending</span>
                                @else
                                    <span class="px-3 py-1.5 bg-brand-olive/20 text-brand-olive border border-brand-olive/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(154,149,135,0.2)]">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right text-brand-gray font-light">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-brand-gray font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    No recent orders.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection