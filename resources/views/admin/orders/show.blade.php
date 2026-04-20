@extends('layouts.app')

@section('title', 'Order Details | LUMEN')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 min-h-[70vh]">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-200 pb-6">
        <div>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-gold-500 mb-2 inline-block">&larr; Back to Orders</a>
            <h1 class="font-serif text-3xl text-black">Order {{ $order->order_number }}</h1>
            <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>
        <div>
            @php
                $colors = [
                    'pending' => 'bg-yellow-100 text-yellow-700',
                    'paid' => 'bg-blue-100 text-blue-700',
                    'processing' => 'bg-indigo-100 text-indigo-700',
                    'shipped' => 'bg-purple-100 text-purple-700',
                    'completed' => 'bg-green-100 text-green-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                ];
                $colorClass = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <span class="px-4 py-2 {{ $colorClass }} rounded-full text-xs font-semibold uppercase tracking-wider">Status: {{ $order->status }}</span>
        </div>
    </div>

    @if($order->status === 'pending' && $order->payment_method === 'bank_transfer')
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8 shadow-sm">
        <h3 class="font-semibold text-yellow-800 uppercase tracking-widest text-sm mb-2">Awaiting Payment</h3>
        <p class="text-sm text-yellow-700 mb-4">Please transfer the exact amount of <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> to one of the following accounts:</p>
        <ul class="text-sm text-yellow-800 space-y-1 mb-4 font-medium">
            <li>BCA: 1234567890 a.n LUMEN JEWELRY</li>
            <li>Mandiri: 0987654321 a.n LUMEN JEWELRY</li>
        </ul>
        <p class="text-xs text-yellow-700">Once paid, our team will verify your payment and process your order.</p>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">

        <div class="w-full lg:w-2/3">
            <div class="bg-white border border-gray-100 shadow-sm p-6">
                <h3 class="font-semibold uppercase tracking-widest text-sm mb-6 border-b border-gray-100 pb-4">Items Ordered</h3>
                
                <div class="space-y-6">
                    @foreach($order->items as $item)
                    <div class="flex gap-4">
                        <div class="w-20 h-24 bg-gray-50 flex-shrink-0 border border-gray-100">
                            @if($item->product && $item->product->primaryImage)
                                <img src="{{ Storage::url($item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 uppercase">No Img</div>
                            @endif
                        </div>
                        <div class="flex-grow flex flex-col justify-center">
                            <h4 class="text-sm font-medium text-black">
                                @if($item->product)
                                    <a href="{{ route('shop.show', $item->product->slug) }}" class="hover:text-gold-500">{{ $item->product_name }}</a>
                                @else
                                    {{ $item->product_name }}
                                @endif
                            </h4>
                            @if($item->variant)
                                <p class="text-xs text-gray-500 mt-1">{{ $item->variant->material }} - {{ $item->variant->size }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Qty: {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-sm font-semibold flex items-center">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/3 space-y-8">
            <div class="bg-gray-50 border border-gray-100 p-6 shadow-sm">
                <h3 class="font-semibold uppercase tracking-widest text-sm mb-6 border-b border-gray-200 pb-4">Order Summary</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                        <span class="font-bold text-black uppercase tracking-wider">Total</span>
                        <span class="font-bold text-lg text-gold-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 p-6 shadow-sm">
                <h3 class="font-semibold uppercase tracking-widest text-sm mb-4 border-b border-gray-100 pb-4">Shipping Details</h3>
                <div class="text-sm text-gray-600 space-y-2">
                    <p><strong class="text-gray-800">Name:</strong> {{ $order->user->name }}</p>
                    <p><strong class="text-gray-800">Email:</strong> {{ $order->user->email }}</p>
                    <p><strong class="text-gray-800">Phone:</strong> {{ $order->user->phone ?? '-' }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <strong class="text-gray-800 block mb-1">Address:</strong>
                        <p class="leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection