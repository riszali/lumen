@extends('layouts.admin')

@section('title', 'Manage Products | Admin')
@section('header_title', 'Products Management')

@section('content')
<!-- Ambient Background Wrapper for Glassmorphism -->
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <!-- Animated Glow/Blobs behind the glass -->
    <div class="absolute top-0 right-10 w-96 h-96 bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-teal-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>

    <!-- Main Content Layer -->
    <div class="relative z-10 space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-2">
            <div>
                <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">ALL PRODUCTS</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-montserrat font-bold tracking-[0.2em] uppercase mt-1 transition-colors duration-500">Manage your catalog</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)] backdrop-blur-md">
                + Add New Product
            </a>
        </div>

        <!-- Glass Table Container -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden transition-colors duration-500">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat transition-colors duration-500">
                    <thead class="bg-gray-100 dark:bg-white/5 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest transition-colors duration-500">
                        <tr>
                            <th class="px-8 py-5">Product</th>
                            <th class="px-8 py-5">Category</th>
                            <th class="px-8 py-5">Price</th>
                            <th class="px-8 py-5">Stock</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5 flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-200 dark:bg-black/40 border border-gray-300 dark:border-white/10 overflow-hidden rounded-xl shadow-sm dark:shadow-inner flex-shrink-0 transition-colors duration-500">
                                    @if($product->primaryImage)
                                        <img src="{{ Storage::url($product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-400 dark:text-white/30 uppercase text-center font-bold">No Img</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 dark:text-white tracking-wide group-hover:text-emerald-600 dark:group-hover:text-volt transition-colors duration-300">{{ $product->name }}</span>
                                    @if($product->is_featured)
                                        <span class="block text-[10px] text-emerald-600 dark:text-volt font-bold uppercase tracking-widest mt-1">Featured</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5 font-medium">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="px-8 py-5 text-emerald-600 dark:text-volt font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-8 py-5 font-medium">{{ $product->stock }}</td>
                            <td class="px-8 py-5">
                                @if($product->is_active)
                                    <span class="px-3 py-1.5 bg-emerald-100 dark:bg-volt/20 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm transition-colors duration-500">Active</span>
                                @else
                                    <span class="px-3 py-1.5 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-500/20 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm transition-colors duration-500">Draft</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right space-x-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-white text-[10px] font-bold uppercase tracking-widest transition-colors duration-300">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 dark:text-red-400/80 hover:text-red-700 dark:hover:text-red-400 text-[10px] font-bold uppercase tracking-widest transition-colors duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center text-gray-500 dark:text-gray-400 font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    <span class="text-xs uppercase tracking-widest font-bold">No products found in the catalog.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="px-8 py-5 border-t border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-black/20 glass-pagination transition-colors duration-500">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Styling adjustment for Laravel Default Pagination in Light/Dark Mode */
    .glass-pagination nav p { display: none; }
    .glass-pagination nav > div:first-child { display: none; }
    
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.5);
        border-color: rgba(0, 0, 0, 0.1);
        color: #374151;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 0.875rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
    }
    .dark .glass-pagination nav span, .dark .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #e5e7eb;
    }

    .glass-pagination nav a:hover { 
        background-color: rgba(16, 185, 129, 0.1); 
        color: #059669;
        border-color: rgba(16, 185, 129, 0.3);
    }
    .dark .glass-pagination nav a:hover { 
        background-color: rgba(204, 255, 0, 0.15); 
        color: #ccff00;
        border-color: rgba(204, 255, 0, 0.3);
    }

    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(16, 185, 129, 0.2) !important;
        border-color: rgba(16, 185, 129, 0.4) !important;
        color: #047857 !important;
    }
    .dark .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(204, 255, 0, 0.2) !important;
        border-color: rgba(204, 255, 0, 0.4) !important;
        color: #ccff00 !important;
    }
</style>
@endsection