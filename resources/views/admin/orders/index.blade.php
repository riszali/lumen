@extends('layouts.admin')

@section('title', 'Manage Orders | Admin')
@section('header_title', 'Customer Orders')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-brand-olive rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-brand-sage rounded-full mix-blend-screen filter blur-[100px] opacity-15"></div>

    <div class="relative z-10 space-y-8">
        
        <div class="mb-4">
            <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">All Orders</h2>
            <p class="text-xs text-brand-gray font-light tracking-[0.2em] uppercase mt-1">Track and manage customer purchases</p>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-brand-warm">
                    <thead class="bg-white/5 border-b border-white/10 text-xs uppercase font-semibold text-brand-gray tracking-wider">
                        <tr>
                            <th class="px-8 py-5">Order No.</th>
                            <th class="px-8 py-5">Date</th>
                            <th class="px-8 py-5">Customer</th>
                            <th class="px-8 py-5">Items</th>
                            <th class="px-8 py-5">Total</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($orders as $order)
                        <tr class="hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5 font-medium text-brand-cream tracking-wider">{{ $order->order_number }}</td>
                            <td class="px-8 py-5 text-brand-gray font-light">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-5">
                                <div class="text-brand-cream">{{ $order->user->name }}</div>
                                <div class="text-xs text-brand-olive mt-0.5">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-8 py-5">
                                @if($order->items->count() > 0)
                                    <div class="flex items-center gap-4">
                                        @php
                                            $firstItem = $order->items->first();
                                            $hasImage = $firstItem->product && $firstItem->product->primaryImage;
                                        @endphp
                                        
                                        <div class="w-10 h-10 bg-black/40 border border-white/10 rounded-lg overflow-hidden shadow-inner flex-shrink-0 flex items-center justify-center">
                                            @if($hasImage)
                                                <img src="{{ Storage::url($firstItem->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-white/30 text-[8px] uppercase">No Img</span>
                                            @endif
                                        </div>
                                        
                                        <div class="text-xs">
                                            <p class="font-medium text-brand-cream w-32 truncate group-hover:text-brand-sage transition" title="{{ $firstItem->product_name }}">{{ $firstItem->product_name }}</p>
                                            @if($order->items->count() > 1)
                                                <p class="text-brand-olive mt-0.5">+ {{ $order->items->count() - 1 }} item(s) lain</p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-brand-gray">Tidak ada item</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 font-medium text-brand-sage">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
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
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center justify-end gap-2">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="relative">
                                        <select name="status" class="bg-black/20 border border-white/10 rounded-lg text-xs p-2.5 pr-8 appearance-none text-brand-cream focus:ring-brand-sage focus:border-brand-sage transition [&>option]:bg-brand-dark [&>option]:text-brand-cream" required>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <!-- Custom Caret -->
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-brand-gray">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>

                                    <button type="submit" class="bg-white/5 border border-white/10 hover:bg-white/10 text-brand-cream px-3 py-2.5 rounded-lg text-xs uppercase tracking-widest font-bold transition">Update</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center text-brand-gray font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    No orders found in the system.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
            <div class="px-8 py-5 border-t border-white/10 bg-black/20 glass-pagination">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>

    .glass-pagination nav p { color: #AAAB9A; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #EDE7D4;
    }
    .glass-pagination nav a:hover { background-color: rgba(255, 255, 255, 0.15); }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(170, 171, 154, 0.3) !important;
        border-color: rgba(170, 171, 154, 0.5) !important;
        color: #EDE7D4 !important;
    }
</style>
@endsection