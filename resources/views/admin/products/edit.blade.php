@extends('layouts.admin')

@section('title', 'Edit Product | Admin')
@section('header_title', 'Edit Product')

@section('content')
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-teal-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>

    <div class="relative z-10 max-w-4xl mx-auto space-y-8">
        
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-emerald-600 dark:text-volt hover:text-emerald-800 dark:hover:text-white font-bold text-[10px] uppercase tracking-widest mb-4 inline-block transition-colors duration-300">&larr; Back to Products</a>
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">EDIT: <span class="text-emerald-600 dark:text-volt">{{ $product->name }}</span></h2>
        </div>

        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8 transition-colors duration-500">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-montserrat">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white transition-all outline-none">
                        @error('name') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="relative z-50">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 font-bold transition-colors duration-500">Category *</label>
                            <button type="button" onclick="toggleNewCategoryMode()" id="toggle_cat_btn" class="text-[10px] text-emerald-600 dark:text-volt font-bold hover:underline transition-colors focus:outline-none">+ New Category</button>
                        </div>
                        
                        <div id="existing_category_wrapper" class="relative">
                            @php
                                $oldCatId = old('category_id', $product->category_id);
                                $oldCatName = '-- Select Category --';
                                if($oldCatId) {
                                    $cat = \App\Models\Category::find($oldCatId);
                                    if($cat) $oldCatName = $cat->name;
                                }
                            @endphp
                            <input type="hidden" name="category_id" id="category_id" value="{{ $oldCatId }}">
                            <button type="button" onclick="toggleCategoryDropdown()" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 flex justify-between items-center transition-all hover:bg-gray-50 dark:hover:bg-black/30 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:focus:ring-volt">
                                <span id="selected_category_text" class="text-sm font-medium {{ $oldCatId ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500' }}">{{ $oldCatName }}</span>
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <ul id="category_options" class="hidden absolute top-full left-0 w-full mt-2 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-2xl shadow-lg max-h-60 overflow-y-auto py-2 transition-colors duration-500 z-50">
                                <li class="px-5 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 dark:hover:bg-white/10 cursor-pointer" onclick="selectCategory('', '-- Select Category --')">-- Select Category --</li>
                                @foreach(\App\Models\Category::all() as $category)
                                    <li class="px-5 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer border-t border-gray-100 dark:border-white/5" onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')">{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div id="new_category_wrapper" class="hidden relative">
                            <input type="text" name="new_category_name" id="new_category_name" placeholder="Type new category name..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 outline-none">
                        </div>
                    </div>

                    <!-- Brand / Subcategory Field -->
                    <div class="relative z-40">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 font-bold">Brand / Merk *</label>
                            <button type="button" onclick="toggleNewBrandMode()" id="toggle_brand_btn" class="text-[10px] text-emerald-600 dark:text-volt font-bold hover:underline focus:outline-none">+ New Brand</button>
                        </div>
                        
                        <div id="existing_brand_wrapper" class="relative">
                            <input type="hidden" name="brand" id="brand" value="{{ old('brand', $product->brand) }}">
                            <button type="button" onclick="toggleBrandDropdown()" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-black/30 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:focus:ring-volt">
                                <span id="selected_brand_text" class="text-sm font-medium {{ old('brand', $product->brand) ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500' }}">{{ old('brand', $product->brand) ?: '-- Select Brand --' }}</span>
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <ul id="brand_options" class="hidden absolute top-full left-0 w-full mt-2 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-2xl shadow-lg max-h-72 overflow-y-auto py-2 z-50">
                                <li class="px-5 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 dark:hover:bg-white/10 cursor-pointer" onclick="selectBrand('', '-- Select Brand --')">-- Select Brand --</li>
                                @foreach(['Babolat', 'Bullpadel', 'HEAD', 'Oxdog', 'Siux', 'Nike', 'Adidas', 'SiS GO', 'Optimum Nutrition'] as $b)
                                    <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer pl-8" onclick="selectBrand('{{ $b }}', '{{ $b }}')">{{ $b }}</li>
                                @endforeach
                                <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer pl-8 border-t border-white/5 mt-2" onclick="selectBrand('Other', 'Other Brand')">Other Brand</li>
                            </ul>
                        </div>

                        <div id="new_brand_wrapper" class="hidden relative">
                            <input type="text" name="new_brand_name" id="new_brand_name" placeholder="Type new brand name..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Price, Discount, Stock (Grid 3 Kolom) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Normal Price -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Harga Normal (Rp) *</label>
                        <input type="hidden" name="price" id="price_raw" value="{{ old('price', (int)$product->price) }}">
                        <input type="text" id="price_formatted" value="{{ old('price') ? number_format(old('price'), 0, ',', '.') : number_format((int)$product->price, 0, ',', '.') }}" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white outline-none" oninput="formatRupiah(this, 'price_raw'); calculateDiscount();">
                        @error('price') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Discount Price -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[10px] uppercase tracking-widest text-emerald-600 dark:text-volt font-bold">Harga Diskon (Opsional)</label>
                            <span id="discount_percentage" class="hidden text-emerald-600 dark:text-volt font-bebas text-sm tracking-widest bg-emerald-100 dark:bg-volt/20 px-2 rounded"></span>
                        </div>
                        <input type="hidden" name="discount_price" id="discount_raw" value="{{ old('discount_price', (int)$product->discount_price) }}">
                        <input type="text" id="discount_formatted" value="{{ old('discount_price') ? number_format(old('discount_price'), 0, ',', '.') : ($product->discount_price ? number_format((int)$product->discount_price, 0, ',', '.') : '') }}" class="w-full bg-emerald-50/30 dark:bg-volt/5 border border-emerald-200 dark:border-volt/30 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white placeholder-emerald-300 dark:placeholder-volt/40 outline-none" placeholder="Kosongkan jika tidak diskon" oninput="formatRupiah(this, 'discount_raw'); calculateDiscount();">
                        @error('discount_price') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Base Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white outline-none">
                        @error('stock') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Description -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Description *</label>
                        <textarea name="description" rows="6" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white outline-none">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Specification -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Specification (Optional)</label>
                        <textarea name="specification" rows="6" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm p-3.5 focus:ring-emerald-500 dark:focus:ring-volt text-sm text-gray-900 dark:text-white outline-none">{{ old('specification', $product->specification) }}</textarea>
                    </div>
                </div>

                <!-- DRAG & DROP MULTI-IMAGE GALLERY (EDIT MODE) -->
                <div class="bg-gray-50/50 dark:bg-black/10 rounded-2xl border border-gray-200 dark:border-white/5 p-6 transition-colors duration-500">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-4 font-bold">Product Images Gallery</label>
                    
                    <!-- Form Kirim Data Primary (Untuk Backend) -->
                    <!-- Jika isi id berarti pilih gambar lama. Jika index berarti pilih upload baru -->
                    <input type="hidden" name="primary_image_id" id="primary_image_id" value="{{ $product->primaryImage->id ?? '' }}">
                    <input type="hidden" name="primary_image_index" id="primary_image_index" value="">

                    <!-- Menampilkan Gambar Existing -->
                    @if($product->images->count() > 0)
                        <p class="text-[10px] font-medium text-gray-400 dark:text-gray-500 mb-3">Foto Saat Ini ({{ $product->images->count() }}): <strong class="text-emerald-600 dark:text-volt">Klik foto untuk jadikan Utama (Primary).</strong></p>
                        <div id="existing_images_container" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-4 mb-6">
                            @foreach($product->images as $image)
                                <div class="img-item relative aspect-square bg-gray-100 dark:bg-black/40 rounded-xl overflow-hidden cursor-pointer transition-all duration-300 {{ $image->is_primary ? 'border-2 border-emerald-500 dark:border-volt scale-105 shadow-lg' : 'border border-gray-200 dark:border-white/10 hover:border-gray-400 dark:hover:border-white/30' }}"
                                     onclick="setExistingPrimary(this, {{ $image->id }})">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover pointer-events-none">
                                    <div class="primary-badge absolute top-2 right-2 bg-emerald-500 dark:bg-volt text-white dark:text-black text-[8px] font-bold px-2 py-1 rounded-full uppercase tracking-widest shadow-md {{ $image->is_primary ? '' : 'hidden' }}">Primary</div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Upload Gambar Baru dengan Drag & Drop -->
                    <div class="border-t border-gray-200 dark:border-white/10 pt-6">
                        <p class="text-[10px] font-medium text-yellow-600 dark:text-yellow-500 mb-3 uppercase tracking-widest leading-relaxed">
                            <span class="font-bold">Peringatan Edit:</span> Mengunggah (Upload/Drop) gambar baru akan <strong class="text-red-500">MENGHAPUS & MENIMPA (Replace)</strong> semua foto lama di atas. Biarkan area bawah ini kosong jika Anda hanya ingin mengubah mana foto yang jadi Primary.
                        </p>
                        
                        <input type="file" name="images[]" id="images_input" multiple accept="image/*" class="hidden">

                        <div id="multi_dropzone" onclick="document.getElementById('images_input').click()" class="relative border-2 border-dashed border-gray-300 dark:border-white/20 rounded-2xl p-8 text-center hover:border-emerald-500 dark:hover:border-volt hover:bg-emerald-50/30 dark:hover:bg-volt/5 transition-all duration-300 cursor-pointer mb-4">
                            <div class="pointer-events-none flex flex-col items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">Klik di sini atau Seret Gambar Baru</span>
                            </div>
                        </div>

                        @error('images') <span class="text-red-500 dark:text-red-400 text-xs font-semibold block">{{ $message }}</span> @enderror
                        @error('images.*') <span class="text-red-500 dark:text-red-400 text-xs font-semibold block">{{ $message }}</span> @enderror
                        
                        <div id="image_preview_container" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-4"></div>
                    </div>
                </div>

                <!-- Options -->
                <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 p-5 bg-gray-50/50 dark:bg-black/10 rounded-2xl border border-gray-200 dark:border-white/5 transition-colors duration-500">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 dark:border-white/20 bg-white dark:bg-black/40 text-emerald-500 dark:text-volt shadow-sm focus:ring-emerald-500 dark:focus:ring-volt transition cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition">Active (Visible in shop)</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 dark:border-white/20 bg-white dark:bg-black/40 text-emerald-500 dark:text-volt shadow-sm focus:ring-emerald-500 dark:focus:ring-volt transition cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition">Featured (Show on homepage)</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-white/10 flex flex-col-reverse sm:flex-row justify-end gap-4 mt-8 transition-colors duration-500">
                    <a href="{{ route('admin.products.index') }}" class="px-8 py-3.5 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-900 dark:hover:text-white text-[10px] uppercase tracking-widest font-bold transition text-center shadow-sm">Cancel</a>
                    <button type="submit" class="px-8 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all shadow-sm backdrop-blur-md">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Format Rupiah
    function formatRupiah(input, hiddenId) {
        let numericValue = input.value.replace(/[^0-9]/g, '');
        document.getElementById(hiddenId).value = numericValue;
        if (numericValue) { 
            input.value = new Intl.NumberFormat('id-ID').format(numericValue); 
        } else { 
            input.value = ''; 
        }
    }

    // Kalkulator Persentase Diskon Real-time
    function calculateDiscount() {
        let price = parseInt(document.getElementById('price_raw').value) || 0;
        let discount = parseInt(document.getElementById('discount_raw').value) || 0;
        let percentageEl = document.getElementById('discount_percentage');

        if (price > 0 && discount > 0 && discount < price) {
            let perc = Math.round(((price - discount) / price) * 100);
            percentageEl.innerText = `-${perc}% OFF`;
            percentageEl.classList.remove('hidden');
        } else {
            percentageEl.classList.add('hidden');
            percentageEl.innerText = '';
        }
    }
    
    // Panggil kalkulator saat pertama kali load (jika ada data diskon sebelumnya)
    document.addEventListener("DOMContentLoaded", () => {
        calculateDiscount();
    });

    // Klik Foto Existing untuk Jadikan Primary
    function setExistingPrimary(element, id) {
        document.getElementById('primary_image_id').value = id;
        document.getElementById('primary_image_index').value = ''; // Matikan index baru
        
        // Reset old badges
        document.querySelectorAll('#existing_images_container .img-item').forEach(item => {
            item.classList.remove('border-2', 'border-emerald-500', 'dark:border-volt', 'scale-105', 'shadow-lg');
            item.classList.add('border', 'border-gray-200', 'dark:border-white/10');
            const badge = item.querySelector('.primary-badge');
            if (badge) badge.classList.add('hidden');
        });
        
        // Apply active
        element.classList.remove('border', 'border-gray-200', 'dark:border-white/10');
        element.classList.add('border-2', 'border-emerald-500', 'dark:border-volt', 'scale-105', 'shadow-lg');
        const badge = element.querySelector('.primary-badge');
        if (badge) badge.classList.remove('hidden');
    }

    // Drag & Drop Multi-Image Logic
    const fileInput = document.getElementById('images_input');
    const dropzone = document.getElementById('multi_dropzone');
    const previewContainer = document.getElementById('image_preview_container');

    function handleMultiFiles(files) {
        previewContainer.innerHTML = ''; 
        document.getElementById('primary_image_index').value = 0; 
        document.getElementById('primary_image_id').value = ''; 
        
        // Bikin gambar lama jadi redup biar admin tau ini bakal ketimpa
        document.querySelectorAll('#existing_images_container .img-item').forEach(item => {
            item.classList.remove('border-2', 'border-emerald-500', 'dark:border-volt', 'scale-105', 'shadow-lg');
            item.classList.add('border', 'border-gray-200', 'dark:border-white/10', 'opacity-50'); 
            const badge = item.querySelector('.primary-badge');
            if (badge) badge.classList.add('hidden');
        });

        if (files && files.length > 0) {
            Array.from(files).forEach((file, index) => {
                if (!/\.(jpe?g|png|gif|webp)$/i.test(file.name)) return; 
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    const isPrimary = index === 0;
                    
                    div.className = `img-item relative aspect-square bg-gray-100 dark:bg-black/40 rounded-xl overflow-hidden shadow-sm cursor-pointer transition-all duration-300 ${isPrimary ? 'border-2 border-emerald-500 dark:border-volt scale-105 shadow-lg' : 'border border-gray-200 dark:border-white/10 hover:border-gray-400 dark:hover:border-white/30'}`;
                    
                    div.onclick = function() { 
                        setNewPrimary(this, index); 
                    };
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover pointer-events-none';
                    div.appendChild(img);

                    const badge = document.createElement('div');
                    badge.className = `primary-badge absolute top-2 right-2 bg-emerald-500 dark:bg-volt text-white dark:text-black text-[8px] font-bold px-2 py-1 rounded-full uppercase tracking-widest shadow-md ${isPrimary ? '' : 'hidden'}`;
                    badge.innerText = 'Primary';
                    div.appendChild(badge);
                    
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    fileInput.addEventListener('change', function() { 
        handleMultiFiles(this.files); 
    });

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault(); 
        e.stopPropagation();
        dropzone.classList.add('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
    });

    dropzone.addEventListener('dragleave', (e) => {
        e.preventDefault(); 
        e.stopPropagation();
        dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault(); 
        e.stopPropagation();
        dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
        
        const files = e.dataTransfer.files;
        if(files.length > 0) {
            fileInput.files = files; 
            handleMultiFiles(files);
        }
    });

    function setNewPrimary(element, index) {
        document.getElementById('primary_image_index').value = index;
        document.getElementById('primary_image_id').value = ''; 
        
        document.querySelectorAll('#image_preview_container .img-item').forEach(item => {
            item.classList.remove('border-2', 'border-emerald-500', 'dark:border-volt', 'scale-105', 'shadow-lg');
            item.classList.add('border', 'border-gray-200', 'dark:border-white/10');
            const badge = item.querySelector('.primary-badge');
            if (badge) badge.classList.add('hidden');
        });
        
        element.classList.remove('border', 'border-gray-200', 'dark:border-white/10');
        element.classList.add('border-2', 'border-emerald-500', 'dark:border-volt', 'scale-105', 'shadow-lg');
        const badge = element.querySelector('.primary-badge');
        if (badge) badge.classList.remove('hidden');
    }

    // Toggle logic Category
    let isNewCategoryMode = false;
    function toggleNewCategoryMode() {
        isNewCategoryMode = !isNewCategoryMode; 
        const exWrap = document.getElementById('existing_category_wrapper');
        const newWrap = document.getElementById('new_category_wrapper');
        const btn = document.getElementById('toggle_cat_btn');
        
        if(isNewCategoryMode) { 
            exWrap.classList.add('hidden'); 
            newWrap.classList.remove('hidden'); 
            btn.innerText = 'Cancel'; 
            btn.classList.replace('text-emerald-600', 'text-red-500'); 
            btn.classList.replace('dark:text-volt', 'dark:text-red-400'); 
            document.getElementById('category_id').value = ''; 
            document.getElementById('new_category_name').focus();
        } else { 
            exWrap.classList.remove('hidden'); 
            newWrap.classList.add('hidden'); 
            btn.innerText = '+ New Category'; 
            btn.classList.replace('text-red-500', 'text-emerald-600'); 
            btn.classList.replace('dark:text-red-400', 'dark:text-volt'); 
        }
    }

    // Toggle logic Brand
    let isNewBrandMode = false;
    function toggleNewBrandMode() {
        isNewBrandMode = !isNewBrandMode; 
        const exWrap = document.getElementById('existing_brand_wrapper');
        const newWrap = document.getElementById('new_brand_wrapper');
        const btn = document.getElementById('toggle_brand_btn');
        
        if(isNewBrandMode) { 
            exWrap.classList.add('hidden'); 
            newWrap.classList.remove('hidden'); 
            btn.innerText = 'Cancel'; 
            btn.classList.replace('text-emerald-600', 'text-red-500'); 
            btn.classList.replace('dark:text-volt', 'dark:text-red-400'); 
            document.getElementById('brand').value = ''; 
            document.getElementById('new_brand_name').focus();
        } else { 
            exWrap.classList.remove('hidden'); 
            newWrap.classList.add('hidden'); 
            btn.innerText = '+ New Brand'; 
            btn.classList.replace('text-red-500', 'text-emerald-600'); 
            btn.classList.replace('dark:text-red-400', 'dark:text-volt'); 
        }
    }

    function toggleCategoryDropdown() { 
        document.getElementById('category_options').classList.toggle('hidden'); 
        document.getElementById('brand_options').classList.add('hidden'); 
    }

    function selectCategory(id, name) { 
        document.getElementById('category_id').value = id; 
        document.getElementById('selected_category_text').innerText = name; 
        document.getElementById('category_options').classList.add('hidden'); 
    }

    function toggleBrandDropdown() { 
        document.getElementById('brand_options').classList.toggle('hidden'); 
        document.getElementById('category_options').classList.add('hidden'); 
    }

    function selectBrand(val, text) { 
        document.getElementById('brand').value = val; 
        document.getElementById('selected_brand_text').innerText = text; 
        document.getElementById('brand_options').classList.add('hidden'); 
    }

    // Menutup dropdown ketika klik di area lain
    document.addEventListener('click', function(event) {
        const catWrapper = document.getElementById('existing_category_wrapper');
        const catBtn = document.getElementById('toggle_cat_btn');
        const brandWrapper = document.getElementById('existing_brand_wrapper');
        const brandBtn = document.getElementById('toggle_brand_btn');

        if (!catWrapper.contains(event.target) && event.target !== catBtn) {
            document.getElementById('category_options').classList.add('hidden');
        }
        
        if (!brandWrapper.contains(event.target) && event.target !== brandBtn) {
            document.getElementById('brand_options').classList.add('hidden');
        }
    });
</script>
@endsection