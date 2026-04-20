@extends('layouts.admin')

@section('title', 'Edit Product | Admin')
@section('header_title', 'Edit Product')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">

    <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-brand-warm rounded-full mix-blend-screen filter blur-[120px] opacity-10"></div>

    <div class="relative z-10 max-w-4xl mx-auto space-y-8">
        
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-brand-olive hover:text-brand-sage text-xs uppercase tracking-widest mb-4 inline-block transition">&larr; Back to Products</a>
            <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">Edit: <span class="text-brand-sage">{{ $product->name }}</span></h2>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream transition">
                        @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Category *</label>
                        <div class="relative">
                            <select name="category_id" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 appearance-none focus:ring-brand-sage focus:border-brand-sage text-brand-cream [&>option]:bg-brand-dark [&>option]:text-brand-cream transition pr-10">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-brand-gray">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('category_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>


                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Price (Rp) *</label>
                        <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream transition">
                        @error('price') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>


                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Base Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream transition">
                        @error('stock') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div>
                    <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Description *</label>
                    <textarea name="description" rows="5" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream transition">{{ old('description', $product->description) }}</textarea>
                    @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>


                <div>
                    <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Update Primary Image</label>
                    <p class="text-xs text-brand-olive mb-3">Leave file input blank if you don't want to change the image.</p>
                    
                    <div class="flex items-center gap-6">
                        @if($product->primaryImage)
                            <div class="w-20 h-24 bg-black/40 border border-white/10 rounded-xl overflow-hidden flex-shrink-0 shadow-inner">
                                <img src="{{ Storage::url($product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <input type="file" name="image" accept="image/*" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-2.5 text-sm text-brand-gray file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:uppercase file:tracking-widest file:bg-brand-sage/20 file:text-brand-sage hover:file:bg-brand-sage/30 file:transition cursor-pointer">
                        </div>
                    </div>
                    @error('image') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-8 p-4 bg-black/10 rounded-xl border border-white/5">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="w-5 h-5 rounded border-white/20 bg-black/40 text-brand-sage shadow-sm focus:ring-brand-sage focus:ring-offset-0 focus:ring-offset-transparent transition">
                        <span class="ml-3 text-sm text-brand-warm group-hover:text-brand-cream transition">Active (Visible in shop)</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-white/20 bg-black/40 text-brand-sage shadow-sm focus:ring-brand-sage focus:ring-offset-0 focus:ring-offset-transparent transition">
                        <span class="ml-3 text-sm text-brand-warm group-hover:text-brand-cream transition">Featured (Show on homepage)</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-white/10 flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-white/10 text-brand-gray rounded-full hover:bg-white/5 hover:text-brand-cream text-xs uppercase tracking-widest font-bold transition">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-brand-sage/30 transition shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection