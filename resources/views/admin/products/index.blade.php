@extends('layouts.admin')

@section('title', 'Manage Products | Admin')
@section('header_title', 'Products Management')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <div class="absolute top-0 right-10 w-96 h-96 bg-brand-olive rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-brand-sage rounded-full mix-blend-screen filter blur-[100px] opacity-15"></div>

    <div class="relative z-10 space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-2">
            <div>
                <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">All Products</h2>
                <p class="text-xs text-brand-gray font-light tracking-[0.2em] uppercase mt-1">Manage your catalog</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-3 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-brand-sage/30 hover:scale-105 transition duration-300 shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">
                + Add New Product
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-brand-warm">
                    <thead class="bg-white/5 border-b border-white/10 text-xs uppercase font-semibold text-brand-gray tracking-wider">
                        <tr>
                            <th class="px-8 py-5">Product</th>
                            <th class="px-8 py-5">Category</th>
                            <th class="px-8 py-5">Price</th>
                            <th class="px-8 py-5">Stock</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($products as $product)
                        <tr class="hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5 flex items-center gap-4">
                                <div class="w-12 h-12 bg-black/40 border border-white/10 overflow-hidden rounded-xl shadow-inner flex-shrink-0">
                                    @if($product->primaryImage)
                                        <img src="{{ Storage::url($product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[8px] text-white/30 uppercase text-center">No Img</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-medium text-brand-cream tracking-wide group-hover:text-brand-sage transition">{{ $product->name }}</span>
                                    @if($product->is_featured)
                                        <span class="block text-[10px] text-brand-olive uppercase tracking-widest mt-0.5">Featured</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="px-8 py-5 text-brand-sage font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-8 py-5">{{ $product->stock }}</td>
                            <td class="px-8 py-5">
                                @if($product->is_active)
                                    <span class="px-3 py-1.5 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(170,171,154,0.2)]">Active</span>
                                @else
                                    <span class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(239,68,68,0.1)]">Draft</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right space-x-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-brand-warm hover:text-brand-cream text-xs uppercase tracking-widest transition">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400/80 hover:text-red-400 text-xs uppercase tracking-widest transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center text-brand-gray font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    No products found in the catalog.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="px-8 py-5 border-t border-white/10 bg-black/20 glass-pagination">
                {{ $products->links() }}
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