@extends('layouts.app')

@section('title', 'Checkout | LUMEN')

@section('content')

<div class="relative w-full min-h-screen bg-[#252322] overflow-hidden pt-12 pb-24">
    
    <div class="absolute top-0 left-[-10%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="text-center mb-10">
            <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream drop-shadow-md">Secure Checkout</h1>
            <p class="text-brand-gray text-sm mt-3 tracking-widest uppercase font-light">Complete Your Purchase</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            @csrf

            <div class="w-full lg:w-2/3 space-y-8">
                
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-brand-cream mb-6 border-b border-white/10 pb-4">1. Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Full Name</label>
                            <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-black/10 border border-white/5 rounded-xl py-3.5 px-4 text-sm text-brand-gray opacity-70 cursor-not-allowed shadow-inner" disabled>
                        </div>
                        
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Email Address</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-black/10 border border-white/5 rounded-xl py-3.5 px-4 text-sm text-brand-gray opacity-70 cursor-not-allowed shadow-inner" disabled>
                        </div>

                        <div>
                            <label for="phone" class="block text-[10px] uppercase tracking-widest text-brand-cream mb-2 font-semibold">Phone Number *</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream placeholder-white/20 shadow-inner transition" required placeholder="e.g. 08123456789">
                            @error('phone') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-[10px] uppercase tracking-widest text-brand-cream mb-2 font-semibold">Complete Shipping Address *</label>
                            <textarea name="address" id="address" rows="4" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream placeholder-white/20 shadow-inner transition" required placeholder="Street name, Building, House Number, City, Province, Zip Code">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-brand-cream mb-6 border-b border-white/10 pb-4">2. Payment Method</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center p-5 bg-white/5 border border-white/10 rounded-xl cursor-pointer hover:bg-white/10 transition group">
                            <input type="radio" name="payment_method" value="bank_transfer" class="text-brand-sage focus:ring-brand-sage w-5 h-5 bg-black/40 border-white/20" checked>
                            <span class="ml-4 flex flex-col">
                                <span class="font-semibold text-brand-cream tracking-wide group-hover:text-brand-sage transition">Bank Transfer</span>
                                <span class="text-xs text-brand-gray mt-1 font-light">Direct transfer to our BCA/Mandiri accounts.</span>
                            </span>
                        </label>

                        <label class="flex items-center p-5 bg-white/5 border border-white/10 rounded-xl cursor-pointer hover:bg-white/10 transition group">
                            <input type="radio" name="payment_method" value="credit_card" class="text-brand-sage focus:ring-brand-sage w-5 h-5 bg-black/40 border-white/20">
                            <span class="ml-4 flex flex-col">
                                <span class="font-semibold text-brand-cream tracking-wide group-hover:text-brand-sage transition">Credit Card (Midtrans)</span>
                                <span class="text-xs text-brand-gray mt-1 font-light">Pay securely with Visa or Mastercard.</span>
                            </span>
                        </label>
                        @error('payment_method') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] sticky top-28">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-brand-cream mb-6 border-b border-white/10 pb-4">Order Review</h2>
                    
                    <div class="space-y-6 mb-6 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart->items as $item)
                        <div class="flex gap-4">
                            <div class="w-16 h-20 bg-black/40 border border-white/10 rounded-lg flex-shrink-0 overflow-hidden shadow-inner relative">
                                @if($item->product->primaryImage)
                                    <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[8px] text-white/30 uppercase text-center">No Img</div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col justify-center">
                                <h4 class="text-sm font-medium text-brand-cream">{{ $item->product->name }}</h4>
                                @if($item->variant)
                                    <p class="text-xs text-brand-gray mt-1">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                                @endif
                                <p class="text-xs text-brand-gray mt-1">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-sm font-semibold text-brand-sage flex items-center">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-white/10 pt-5 space-y-4 mb-8">
                        <div class="flex justify-between text-sm font-light tracking-wide">
                            <span class="text-brand-gray">Subtotal</span>
                            <span class="text-brand-cream font-medium">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm font-light tracking-wide">
                            <span class="text-brand-gray">Shipping</span>
                            <span class="text-brand-sage font-medium">Free</span>
                        </div>
                        <div class="border-t border-white/10 pt-5 flex justify-between items-center">
                            <span class="font-bold text-brand-cream uppercase tracking-wider text-xs">Total</span>
                            <span class="font-serif text-2xl text-brand-sage">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-xl px-8 py-4 uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                        Place Order
                    </button>
                    <p class="text-center text-[10px] uppercase tracking-widest text-brand-gray mt-6 opacity-70">By placing your order, you agree to our Terms & Conditions.</p>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
</style>
@endsection