@extends('layouts.app')

@section('title', $product->name . ' | LUMEN')

@section('content')
<div class="relative w-full min-h-[85vh] bg-[#252322] overflow-hidden pt-36 pb-28 -mb-12 flex items-center justify-center">
    
    <div class="absolute top-0 left-[-10%] w-[40%] h-[50%] bg-brand-olive rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[40%] h-[40%] bg-brand-sage rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <nav class="text-xs text-brand-gray mb-10 uppercase tracking-widest flex items-center font-medium">
            <a href="{{ route('home') }}" class="hover:text-brand-cream transition duration-300">Home</a> 
            <span class="mx-3 opacity-50">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-brand-cream transition duration-300">Shop</a> 
            <span class="mx-3 opacity-50">/</span>
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-brand-cream transition duration-300">{{ $product->category->name }}</a> 
            <span class="mx-3 opacity-50">/</span>
            <span class="text-brand-sage font-bold drop-shadow-md">{{ $product->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row gap-12 lg:gap-20">
            <div class="w-full md:w-1/2 lg:w-5/12">
                <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-4 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] mb-6">
                    <div class="aspect-[4/5] bg-black/40 border border-white/5 rounded-[2rem] overflow-hidden relative shadow-inner">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center transition duration-700 hover:scale-110 cursor-crosshair">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/30 uppercase tracking-widest text-xs">No Image Available</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#252322]/80 via-transparent to-transparent opacity-30 pointer-events-none"></div>
                    </div>
                </div>

                @if($product->images->count() > 1)
                <div class="grid grid-cols-4 gap-4 px-2">
                    @foreach($product->images as $image)
                    <button class="aspect-square bg-black/20 border border-white/10 rounded-2xl overflow-hidden hover:border-brand-sage focus:outline-none focus:border-brand-sage transition duration-300 shadow-inner opacity-70 hover:opacity-100">
                        <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="w-full md:w-1/2 lg:w-7/12 flex flex-col justify-center">
                
                <h1 class="font-serif text-4xl lg:text-5xl text-brand-cream mb-4 drop-shadow-md">{{ $product->name }}</h1>
                <p class="text-2xl text-brand-sage font-bold tracking-wide mb-8">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <div class="prose prose-sm text-brand-warm/90 mb-10 leading-relaxed font-light text-base text-justify">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] p-8 shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if($product->variants->count() > 0)
                        <div class="mb-6 relative">
                            <label for="variant_id" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-3 font-semibold">Select Variant</label>
                            <select name="variant_id" id="variant_id" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream appearance-none shadow-inner transition [&>option]:bg-brand-dark [&>option]:text-brand-cream" required>
                                <option value="">-- Choose Option --</option>
                                @foreach($product->variants as $variant)
                                    <option value="{{ $variant->id }}">
                                        {{ $variant->material }} - {{ $variant->size }} (Stock: {{ $variant->stock }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 bottom-0 top-[28px] flex items-center px-4 text-brand-gray">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-end gap-4 mb-2">
                            <div class="w-24">
                                <label for="quantity" class="block text-[10px] uppercase tracking-widest text-brand-gray mb-3 font-semibold">Quantity</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 px-4 focus:ring-brand-sage focus:border-brand-sage text-center text-sm text-brand-cream shadow-inner transition" required>
                            </div>
                            <button type="submit" class="flex-grow bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-xl py-3.5 uppercase tracking-widest text-xs font-bold hover:bg-brand-sage/30 transition shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md flex justify-center items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Add to Cart
                            </button>
                        </div>
                        
                        @if($product->stock <= 5 && $product->stock > 0)
                            <p class="text-red-400 text-xs mt-3 italic tracking-wide">Only {{ $product->stock }} left in stock!</p>
                        @elseif($product->stock == 0 && $product->variants->count() == 0)
                            <p class="text-red-400 text-xs mt-3 italic tracking-wide">Out of stock.</p>
                        @endif
                    </form>
                </div>

                <div class="mt-10 border-t border-white/10 pt-8 space-y-5 px-2">
                    <div class="flex items-center text-sm text-brand-warm font-light tracking-wide">
                        <div class="w-8 h-8 rounded-full bg-brand-olive/20 flex items-center justify-center border border-brand-olive/30 mr-4">
                            <svg class="w-4 h-4 text-brand-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        Complimentary Shipping & Returns
                    </div>
                    <div class="flex items-center text-sm text-brand-warm font-light tracking-wide">
                        <div class="w-8 h-8 rounded-full bg-brand-olive/20 flex items-center justify-center border border-brand-olive/30 mr-4">
                            <svg class="w-4 h-4 text-brand-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        Lifetime Authenticity Guarantee
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <div class="mt-32 border-t border-white/5 pt-16 relative">
            <h2 class="font-serif text-3xl text-center text-brand-cream mb-12 tracking-wide drop-shadow-md">You May Also Like</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($relatedProducts as $related)
                <div class="group cursor-pointer bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[2rem] p-4 shadow-[0_8px_32px_rgba(0,0,0,0.3)] hover:bg-white/[0.08] hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    
                    <a href="{{ route('shop.show', $related->slug) }}" class="block relative overflow-hidden mb-6 aspect-[4/5] rounded-[1.5rem] shadow-inner border border-white/5">
                        @if($related->primaryImage)
                            <img src="{{ Storage::url($related->primaryImage->image_path) }}" alt="{{ $related->name }}" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full bg-black/40 flex items-center justify-center text-white/30 text-[10px] uppercase tracking-widest">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>
                    
                    <div class="text-center px-2 pb-2 flex-grow flex flex-col justify-end">
                        <h4 class="text-brand-cream font-serif text-lg tracking-wide mb-2 transition group-hover:text-brand-sage">
                            <a href="{{ route('shop.show', $related->slug) }}">{{ $related->name }}</a>
                        </h4>
                        <p class="text-brand-sage text-sm font-semibold tracking-wider">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection