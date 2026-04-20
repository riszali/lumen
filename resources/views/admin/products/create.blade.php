@extends('layouts.admin')

@section('title', 'Add Product | Admin')
@section('header_title', 'Create Product')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-brand-olive rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>

    <div class="relative z-10 max-w-4xl mx-auto space-y-8">
        
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-brand-olive hover:text-brand-sage text-xs uppercase tracking-widest mb-4 inline-block transition">&larr; Back to Products</a>
            <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">Add New Product</h2>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream placeholder-white/20 transition">
                        @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div id="category_dropdown_wrapper" class="relative">
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Category *</label>
                        
                        @php
                            $oldCatId = old('category_id');
                            $oldCatName = '-- Select Category --';
                            if($oldCatId) {
                                $cat = $categories->firstWhere('id', $oldCatId);
                                if($cat) $oldCatName = $cat->name;
                            }
                        @endphp

                        <input type="hidden" name="category_id" id="category_id" value="{{ $oldCatId }}">
                        
                        <button type="button" onclick="toggleCategoryDropdown()" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 flex justify-between items-center text-brand-cream transition hover:bg-black/30 focus:outline-none focus:ring-1 focus:ring-brand-sage">
                            <span id="selected_category_text" class="{{ $oldCatId ? 'text-brand-cream' : 'text-brand-gray' }}">{{ $oldCatName }}</span>
                            <svg class="h-4 w-4 text-brand-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <ul id="category_options" class="hidden absolute z-50 w-full mt-2 bg-[#252322]/95 backdrop-blur-xl border border-white/10 rounded-xl shadow-[0_8px_32px_rgba(0,0,0,0.6)] max-h-60 overflow-y-auto py-2">
                            <li class="px-4 py-3 text-sm text-brand-gray hover:bg-white/10 cursor-pointer transition" onclick="selectCategory('', '-- Select Category --')">-- Select Category --</li>
                            @foreach($categories as $category)
                                <li class="px-4 py-3 text-sm text-brand-cream hover:bg-brand-sage/20 hover:text-brand-sage cursor-pointer transition border-t border-white/5" onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')">{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        @error('category_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Price (Rp) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream placeholder-white/20 transition">
                        @error('price') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Base Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream placeholder-white/20 transition">
                        @error('stock') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Description *</label>
                    <textarea name="description" rows="5" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3 focus:ring-brand-sage focus:border-brand-sage text-brand-cream placeholder-white/20 transition">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-brand-gray mb-2 font-semibold">Primary Image *</label>
                    <div class="relative">
                        <input type="file" name="image" accept="image/*" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-2.5 text-sm text-brand-gray file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:uppercase file:tracking-widest file:bg-brand-sage/20 file:text-brand-sage hover:file:bg-brand-sage/30 file:transition cursor-pointer">
                    </div>
                    @error('image') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-8 p-4 bg-black/10 rounded-xl border border-white/5">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded border-white/20 bg-black/40 text-brand-sage shadow-sm focus:ring-brand-sage focus:ring-offset-0 focus:ring-offset-transparent transition">
                        <span class="ml-3 text-sm text-brand-warm group-hover:text-brand-cream transition">Active (Visible in shop)</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" class="w-5 h-5 rounded border-white/20 bg-black/40 text-brand-sage shadow-sm focus:ring-brand-sage focus:ring-offset-0 focus:ring-offset-transparent transition">
                        <span class="ml-3 text-sm text-brand-warm group-hover:text-brand-cream transition">Featured (Show on homepage)</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-white/10 flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-white/10 text-brand-gray rounded-full hover:bg-white/5 hover:text-brand-cream text-xs uppercase tracking-widest font-bold transition">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-brand-sage/30 transition shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleCategoryDropdown() {
        document.getElementById('category_options').classList.toggle('hidden');
    }

    function selectCategory(id, name) {

        document.getElementById('category_id').value = id;
        
        const textElement = document.getElementById('selected_category_text');
        textElement.innerText = name;
        
        if (id !== '') {
            textElement.classList.remove('text-brand-gray');
            textElement.classList.add('text-brand-cream');
        } else {
            textElement.classList.remove('text-brand-cream');
            textElement.classList.add('text-brand-gray');
        }

        document.getElementById('category_options').classList.add('hidden');
    }

    document.addEventListener('click', function(event) {
        const wrapper = document.getElementById('category_dropdown_wrapper');
        const options = document.getElementById('category_options');
        
        if (wrapper && !wrapper.contains(event.target)) {
            options.classList.add('hidden');
        }
    });
</script>
@endsection