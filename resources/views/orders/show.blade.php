@extends('layouts.app')

@section('title', 'Order Details | LUMEN')

@section('content')

<div class="relative w-full min-h-screen bg-[#252322] overflow-hidden pt-12 pb-24">
    
    <div class="absolute top-0 left-[-10%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/10 pb-6">
            <div>
                <a href="{{ route('orders.index') }}" class="text-xs uppercase tracking-widest text-brand-gray hover:text-brand-cream mb-4 inline-block transition duration-300">&larr; Back to Orders</a>
                <h1 class="font-serif text-3xl sm:text-4xl text-brand-cream drop-shadow-md">Order <span class="text-brand-sage">{{ $order->order_number }}</span></h1>
                <p class="text-sm text-brand-gray mt-2 font-light tracking-wide">Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>
            <div>
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
                <span class="px-4 py-2 border rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm {{ $styleClass }}">
                    Status: {{ $order->status }}
                </span>
            </div>
        </div>


        @if($order->status === 'pending' && $order->payment_method === 'bank_transfer')
        <div class="bg-yellow-500/10 backdrop-blur-xl border border-yellow-500/20 rounded-[1.5rem] p-6 mb-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)]">
            <div class="flex items-center gap-3 mb-4 border-b border-yellow-500/20 pb-3">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="font-semibold text-yellow-400 uppercase tracking-widest text-sm">Awaiting Payment</h3>
            </div>
            <p class="text-sm text-brand-cream mb-4 font-light leading-relaxed">Please transfer the exact amount of <strong class="text-yellow-400 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> to one of the following accounts:</p>
            <ul class="text-sm text-brand-cream space-y-3 mb-4 font-medium bg-black/30 p-4 rounded-xl border border-white/5">
                <li class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> BCA: 1234567890 a.n LUMEN JEWELRY</li>
                <li class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Mandiri: 0987654321 a.n LUMEN JEWELRY</li>
            </ul>
            <p class="text-xs text-brand-gray font-light">Once paid, our team will verify your payment and process your order.</p>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3">
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] rounded-[2rem] p-6 sm:p-8">
                    <h3 class="font-semibold text-brand-cream uppercase tracking-widest text-sm mb-6 border-b border-white/10 pb-4">Items Ordered</h3>
                    
                    <div class="space-y-6">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 group">

                            <div class="w-20 h-24 bg-black/40 rounded-xl flex-shrink-0 border border-white/10 overflow-hidden shadow-inner relative">
                                @if($item->product && $item->product->primaryImage)
                                    <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-white/30 uppercase">No Img</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <div class="flex-grow flex flex-col justify-center">
                                <h4 class="text-sm font-medium text-brand-cream tracking-wide">
                                    @if($item->product)
                                        <a href="{{ route('shop.show', $item->product->slug) }}" class="hover:text-brand-sage transition">{{ $item->product_name }}</a>
                                    @else
                                        {{ $item->product_name }}
                                    @endif
                                </h4>
                                @if($item->variant)
                                    <p class="text-xs text-brand-gray mt-1">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                @endif
                                <p class="text-xs text-brand-gray mt-1">Qty: {{ $item->quantity }} &times; Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- Item Total -->
                            <div class="text-sm font-semibold flex items-center text-brand-sage">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 space-y-8">
                
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
                    <h3 class="font-semibold text-brand-cream uppercase tracking-widest text-sm mb-6 border-b border-white/10 pb-4">Order Summary</h3>
                    <div class="space-y-4 text-sm font-light tracking-wide">
                        <div class="flex justify-between">
                            <span class="text-brand-gray">Subtotal</span>
                            <span class="text-brand-cream font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-brand-gray">Shipping</span>
                            <span class="text-brand-sage font-medium">Free</span>
                        </div>
                        <div class="border-t border-white/10 pt-4 flex justify-between items-center">
                            <span class="font-bold text-brand-cream uppercase tracking-wider text-xs">Total</span>
                            <span class="font-bold text-lg text-brand-sage">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
                    <h3 class="font-semibold text-brand-cream uppercase tracking-widest text-sm mb-4 border-b border-white/10 pb-4">Shipping Details</h3>
                    <div class="text-sm text-brand-gray space-y-3 font-light tracking-wide">
                        <p><strong class="text-brand-cream font-medium">Name:</strong> {{ $order->user->name }}</p>
                        <p><strong class="text-brand-cream font-medium">Email:</strong> {{ $order->user->email }}</p>
                        <p><strong class="text-brand-cream font-medium">Phone:</strong> {{ $order->user->phone ?? '-' }}</p>
                        <div class="mt-4 pt-4 border-t border-white/10">
                            <strong class="text-brand-cream font-medium block mb-2">Address:</strong>
                            <p class="leading-relaxed">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection