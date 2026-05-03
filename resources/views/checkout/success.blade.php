@extends('layouts.app')

@section('title', 'Order Success | WILLSPORTS')

@section('content')
<!-- Main Wrapper with Dark Background & Glassmorphism -->
<div class="relative w-full min-h-[90vh] bg-[#252322] overflow-hidden py-16 flex items-center justify-center">
    
    <!-- Ambient Light Effects -->
    <div class="absolute top-1/4 left-1/4 w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-[30%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-3xl w-full mx-auto px-4 relative z-20 text-center">
        
        <!-- Success Icon -->
        <div class="mb-8 inline-flex items-center justify-center w-24 h-24 bg-brand-sage/20 border border-brand-sage/30 rounded-full shadow-[0_0_20px_rgba(170,171,154,0.2)] backdrop-blur-md">
            <svg class="w-12 h-12 text-brand-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h1 class="font-serif text-4xl sm:text-5xl text-brand-cream mb-4 drop-shadow-md">Thank You for Your Order</h1>
        <p class="text-lg text-brand-gray font-light mb-12 tracking-wide">Your order has been successfully placed and is now being processed.</p>
        
        <!-- Order Details (Glass Card) -->
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2rem] p-6 sm:p-8 mb-8 text-left shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
            <h3 class="font-semibold text-brand-cream uppercase tracking-widest text-sm mb-6 border-b border-white/10 pb-4">Order Details</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 text-sm font-light tracking-wide">
                <div class="text-brand-gray">Order Number</div>
                <div class="font-medium text-brand-cream tracking-widest">{{ $order->order_number }}</div>
                
                <div class="text-brand-gray">Date</div>
                <div class="font-medium text-brand-cream">{{ $order->created_at->format('d F Y, H:i') }}</div>
                
                <div class="text-brand-gray">Total Amount</div>
                <div class="font-bold text-lg text-brand-sage">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                
                <div class="text-brand-gray">Payment Method</div>
                <div class="font-medium text-brand-cream uppercase tracking-wider">{{ str_replace('_', ' ', $order->payment_method) }}</div>
            </div>
        </div>

        <!-- Payment Instructions -->
        @if($order->payment_method === 'bank_transfer')
        <div class="bg-yellow-500/10 backdrop-blur-xl border border-yellow-500/20 rounded-[2rem] p-6 sm:p-8 mb-10 text-left shadow-[0_8px_32px_0_rgba(0,0,0,0.2)]">
            <div class="flex items-center gap-3 mb-4 border-b border-yellow-500/20 pb-4">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                <h3 class="font-semibold text-yellow-400 uppercase tracking-widest text-sm">Payment Instructions</h3>
            </div>
            <p class="text-sm text-brand-cream mb-4 font-light leading-relaxed">Please transfer the exact amount to one of the following bank accounts:</p>
            <ul class="text-sm text-brand-cream space-y-3 mb-6 font-medium bg-black/30 p-5 rounded-xl border border-white/5">
                <li class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> BCA: 1234567890 a.n WILLSPORTS APPAREL</li>
                <li class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Mandiri: 0987654321 a.n WILLSPORTS APPAREL</li>
            </ul>
            <p class="text-xs text-brand-gray font-light">After completing the payment, our team will verify it and process your order shortly.</p>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-12">
            <a href="{{ route('orders.show', $order->id) }}" class="border border-white/20 text-brand-cream px-8 py-3.5 rounded-full uppercase tracking-widest text-xs font-bold hover:bg-white/10 transition duration-300 backdrop-blur-md">
                View Order Status
            </a>
            <a href="{{ route('shop.index') }}" class="bg-brand-sage/20 text-brand-sage border border-brand-sage/30 px-8 py-3.5 rounded-full uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection