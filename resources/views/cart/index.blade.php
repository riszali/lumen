@extends('layouts.app')

@section('title', 'Shopping Cart | LUMEN')

@section('content')
<!-- Main Wrapper with Dark Background & Glassmorphism -->
<div class="relative w-full min-h-[90vh] bg-[#252322] overflow-hidden pt-navbar pb-24">
    
    <!-- Ambient Light Effects -->
    <div class="absolute top-0 left-[-10%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream mb-10 text-center drop-shadow-md">Your Cart</h1>

        @if(!$cart || $cart->items->count() === 0)
            <!-- Empty Cart State (Glass Card) -->
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] max-w-2xl mx-auto">
                <svg class="w-16 h-16 mx-auto mb-6 text-brand-gray opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <p class="text-brand-cream font-medium tracking-wide mb-2 uppercase text-sm">Your shopping cart is empty.</p>
                <p class="text-brand-gray text-xs font-light mb-8">Discover your archetype in our latest collection.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-brand-sage/20 text-brand-sage border border-brand-sage/30 px-8 py-3.5 rounded-full uppercase tracking-widest text-[10px] font-bold hover:bg-brand-sage/30 hover:scale-105 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Cart Items (Glass Container) -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] overflow-hidden">
                        
                        <!-- Table Header -->
                        <div class="hidden sm:grid sm:grid-cols-6 border-b border-white/10 bg-white/5 p-6 text-xs uppercase tracking-widest text-brand-gray font-semibold">
                            <div class="col-span-3 pl-2">Product</div>
                            <div class="col-span-1 text-center">Price</div>
                            <div class="col-span-1 text-center">Quantity</div>
                            <div class="col-span-1 text-right pr-2">Total</div>
                        </div>

                        <!-- Item List -->
                        <div class="divide-y divide-white/5">
                            @foreach($cart->items as $item)
                            <div class="grid grid-cols-1 sm:grid-cols-6 items-center p-6 gap-6 sm:gap-0 hover:bg-white/10 transition duration-300 group">
                                <div class="col-span-3 flex items-center gap-4">
                                    <!-- Image (Glass Frame) -->
                                    <div class="w-20 h-24 bg-black/40 border border-white/10 rounded-xl overflow-hidden flex-shrink-0 shadow-inner relative">
                                        @if($item->product->primaryImage)
                                            <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-white/30 uppercase text-center">No Img</div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <!-- Details -->
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('shop.show', $item->product->slug) }}" class="text-sm font-medium text-brand-cream hover:text-brand-sage transition tracking-wide">{{ $item->product->name }}</a>
                                        @if($item->variant)
                                            <p class="text-xs text-brand-gray mt-1">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                        @endif
                                        <!-- Remove Action -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[10px] text-red-400/80 hover:text-red-400 uppercase tracking-widest font-semibold transition border border-red-400/30 rounded-full px-3 py-1.5 hover:bg-red-500/10">Remove</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-span-1 text-center text-sm text-brand-gray hidden sm:block font-light">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </div>

                                <div class="col-span-1 flex justify-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 bg-black/20 border border-white/10 rounded-lg text-center py-2 text-sm text-brand-cream focus:ring-brand-sage focus:border-brand-sage transition shadow-inner" onchange="this.form.submit()">
                                    </form>
                                </div>

                                <div class="col-span-1 text-right text-sm font-semibold text-brand-sage sm:pr-2">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary (Glass Card) -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] sticky top-28">
                        <h3 class="font-serif text-2xl text-brand-cream mb-6 border-b border-white/10 pb-4 tracking-wide">Order Summary</h3>
                        
                        <div class="space-y-4 mb-8 text-sm font-light tracking-wide">
                            <div class="flex justify-between">
                                <span class="text-brand-gray">Subtotal</span>
                                <span class="text-brand-cream font-medium">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-brand-gray">Shipping</span>
                                <span class="text-brand-sage font-medium">Free</span>
                            </div>
                            <div class="border-t border-white/10 pt-5 flex justify-between items-center mt-2">
                                <span class="font-bold text-brand-cream uppercase tracking-wider text-xs">Estimated Total</span>
                                <span class="font-bold text-xl text-brand-sage">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-brand-sage/20 text-brand-sage border border-brand-sage/30 text-center rounded-xl px-8 py-4 uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection