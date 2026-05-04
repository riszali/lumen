@extends('layouts.admin')

@section('title', 'Add Product | Admin')
@section('header_title', 'Create Product')

@section('content')
<!-- Ambient Background Wrapper for Glassmorphism -->
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <!-- Animated Glow/Blobs behind the glass -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>

    <!-- Main Content Layer -->
    <div class="relative z-10 max-w-4xl mx-auto space-y-8">
        
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-emerald-600 dark:text-volt hover:text-emerald-800 dark:hover:text-white font-bold text-[10px] uppercase tracking-widest mb-4 inline-block transition-colors duration-300">&larr; Back to Products</a>
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">ADD NEW PRODUCT</h2>
        </div>

        <!-- Glass Form Container -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8 transition-colors duration-500">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-montserrat">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        @error('name') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="relative z-50">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 font-bold transition-colors duration-500">Category *</label>
                            <button type="button" onclick="toggleNewCategoryMode()" id="toggle_cat_btn" class="text-[10px] text-emerald-600 dark:text-volt font-bold hover:underline transition-colors focus:outline-none">+ New Category</button>
                        </div>
                        
                        <!-- Input Select / Dropdown Mode -->
                        <div id="existing_category_wrapper" class="relative">
                            @php
                                $oldCatId = old('category_id');
                                $oldCatName = '-- Select Category --';
                                if($oldCatId) {
                                    $cat = \App\Models\Category::find($oldCatId);
                                    if($cat) $oldCatName = $cat->name;
                                }
                            @endphp

                            <input type="hidden" name="category_id" id="category_id" value="{{ $oldCatId }}">
                            
                            <button type="button" onclick="toggleCategoryDropdown()" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 flex justify-between items-center transition-all duration-300 hover:bg-gray-50 dark:hover:bg-black/30 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:focus:ring-volt">
                                <span id="selected_category_text" class="text-sm font-medium {{ $oldCatId ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500' }}">{{ $oldCatName }}</span>
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Custom Glass Dropdown Kategori -->
                            <ul id="category_options" class="hidden absolute top-full left-0 w-full mt-2 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-2xl shadow-lg dark:shadow-[0_8px_32px_rgba(0,0,0,0.6)] max-h-60 overflow-y-auto py-2 transition-colors duration-500">
                                <li class="px-5 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 dark:hover:bg-white/10 cursor-pointer transition" onclick="selectCategory('', '-- Select Category --')">-- Select Category --</li>
                                @foreach(\App\Models\Category::all() as $category)
                                    <li class="px-5 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition border-t border-gray-100 dark:border-white/5" onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')">{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Input Text Mode (New Category) -->
                        <div id="new_category_wrapper" class="hidden relative">
                            <input type="text" name="new_category_name" id="new_category_name" placeholder="Type new category name..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        </div>

                        @error('category_id') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                        @error('new_category_name') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Brand / Subcategory Field -->
                    <div class="relative z-40">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 font-bold transition-colors duration-500">Brand / Merk *</label>
                            <button type="button" onclick="toggleNewBrandMode()" id="toggle_brand_btn" class="text-[10px] text-emerald-600 dark:text-volt font-bold hover:underline transition-colors focus:outline-none">+ New Brand</button>
                        </div>
                        
                        <!-- Input Select / Dropdown Mode -->
                        <div id="existing_brand_wrapper" class="relative">
                            <input type="hidden" name="brand" id="brand" value="{{ old('brand') }}">

                            <button type="button" onclick="toggleBrandDropdown()" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 flex justify-between items-center transition-all duration-300 hover:bg-gray-50 dark:hover:bg-black/30 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:focus:ring-volt">
                                <span id="selected_brand_text" class="text-sm font-medium {{ old('brand') ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500' }}">{{ old('brand') ?: '-- Select Brand --' }}</span>
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Custom Glass Dropdown Brand -->
                            <ul id="brand_options" class="hidden absolute top-full left-0 w-full mt-2 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-2xl shadow-lg dark:shadow-[0_8px_32px_rgba(0,0,0,0.6)] max-h-72 overflow-y-auto py-2 transition-colors duration-500">
                                <li class="px-5 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 dark:hover:bg-white/10 cursor-pointer transition" onclick="selectBrand('', '-- Select Brand --')">-- Select Brand --</li>
                                
                                <!-- Optgroup Imitation via DIV (No Select/Optgroup tag) -->
                                <div class="px-5 py-2 mt-2 text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-volt border-y border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-black/40">Padel Rackets</div>
                                @foreach(['Babolat', 'Bullpadel', 'HEAD', 'Oxdog', 'Siux', 'Nox', 'StarVie', 'Adidas Padel', 'Kuikma', 'Drop Shot', 'Dunlop', 'Coello Edition'] as $b)
                                    <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition pl-8" onclick="selectBrand('{{ $b }}', '{{ $b }}')">{{ $b }}</li>
                                @endforeach

                                <div class="px-5 py-2 mt-2 text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-volt border-y border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-black/40">Sports Shoes</div>
                                @foreach(['Nike', 'Adidas', 'Asics', 'Mizuno', 'Babolat', 'Bullpadel', 'K-Swiss', 'Joma'] as $b)
                                    <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition pl-8" onclick="selectBrand('{{ $b }}', '{{ $b }}')">{{ $b }}</li>
                                @endforeach

                                <div class="px-5 py-2 mt-2 text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-volt border-y border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-black/40">Supplements</div>
                                @foreach(['SiS GO', 'Xtend', 'Cellucor C4', 'MuscleTech', 'Covita', 'Optimum Nutrition', 'MyProtein', 'BSN'] as $b)
                                    <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition pl-8" onclick="selectBrand('{{ $b }}', '{{ $b }}')">{{ $b }}</li>
                                @endforeach

                                <div class="px-5 py-2 mt-2 text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-volt border-y border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-black/40">Apparel & Gear</div>
                                @foreach(['Under Armour', 'Puma', 'Lululemon', 'Gymshark', 'Castore', '2XU', 'Wilson', 'Yonex', 'Hesacore', 'Tourna'] as $b)
                                    <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition pl-8" onclick="selectBrand('{{ $b }}', '{{ $b }}')">{{ $b }}</li>
                                @endforeach

                                <div class="px-5 py-2 mt-2 text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-volt border-y border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-black/40">Others</div>
                                <li class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition pl-8" onclick="selectBrand('Other', 'Other Brand')">Other Brand</li>
                            </ul>
                        </div>

                        <!-- Input Text Mode (New Brand) -->
                        <div id="new_brand_wrapper" class="hidden relative">
                            <input type="text" name="new_brand_name" id="new_brand_name" placeholder="Type new brand name..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        </div>

                        @error('brand') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                        @error('new_brand_name') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Price (Rp) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        @error('price') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Base Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        @error('stock') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Description *</label>
                    <textarea name="description" rows="5" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Primary Image *</label>
                    <div class="relative">
                        <input type="file" name="image" accept="image/*" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-2.5 text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-widest file:bg-emerald-50 dark:file:bg-volt/20 file:text-emerald-600 dark:file:text-volt hover:file:bg-emerald-100 dark:hover:file:bg-volt/30 file:transition-colors cursor-pointer transition-colors duration-500">
                    </div>
                    @error('image') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                </div>

                <!-- Options -->
                <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 p-5 bg-gray-50/50 dark:bg-black/10 rounded-2xl border border-gray-200 dark:border-white/5 transition-colors duration-500">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded border-gray-300 dark:border-white/20 bg-white dark:bg-black/40 text-emerald-500 dark:text-volt shadow-sm focus:ring-emerald-500 dark:focus:ring-volt focus:ring-offset-0 focus:ring-offset-transparent transition cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">Active (Visible in shop)</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" class="w-5 h-5 rounded border-gray-300 dark:border-white/20 bg-white dark:bg-black/40 text-emerald-500 dark:text-volt shadow-sm focus:ring-emerald-500 dark:focus:ring-volt focus:ring-offset-0 focus:ring-offset-transparent transition cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">Featured (Show on homepage)</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-white/10 flex flex-col-reverse sm:flex-row justify-end gap-4 mt-8 transition-colors duration-500">
                    <a href="{{ route('admin.products.index') }}" class="px-8 py-3.5 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-900 dark:hover:text-white text-[10px] uppercase tracking-widest font-bold transition text-center shadow-sm">Cancel</a>
                    <button type="submit" class="px-8 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)] backdrop-blur-md">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk Custom Dropdown dan Toggle Input Baru -->
<script>
    // --- Logika Input Kategori Baru ---
    let isNewCategoryMode = false;
    function toggleNewCategoryMode() {
        isNewCategoryMode = !isNewCategoryMode;
        const existingWrapper = document.getElementById('existing_category_wrapper');
        const newWrapper = document.getElementById('new_category_wrapper');
        const toggleBtn = document.getElementById('toggle_cat_btn');
        const catIdInput = document.getElementById('category_id');
        const newCatInput = document.getElementById('new_category_name');
        const catOptions = document.getElementById('category_options');

        if(isNewCategoryMode) {
            existingWrapper.classList.add('hidden');
            catOptions.classList.add('hidden');
            newWrapper.classList.remove('hidden');
            
            toggleBtn.innerText = 'Cancel';
            toggleBtn.classList.remove('text-emerald-600', 'dark:text-volt');
            toggleBtn.classList.add('text-red-500', 'dark:text-red-400');
            
            catIdInput.value = ''; // Hapus seleksi
            document.getElementById('selected_category_text').innerText = '-- Select Category --';
            document.getElementById('selected_category_text').classList.replace('text-gray-900', 'text-gray-400');
            document.getElementById('selected_category_text').classList.replace('dark:text-white', 'dark:text-gray-500');
            
            newCatInput.focus();
        } else {
            existingWrapper.classList.remove('hidden');
            newWrapper.classList.add('hidden');
            
            toggleBtn.innerText = '+ New Category';
            toggleBtn.classList.remove('text-red-500', 'dark:text-red-400');
            toggleBtn.classList.add('text-emerald-600', 'dark:text-volt');
            
            newCatInput.value = ''; // Kosongkan input
        }
    }

    // --- Logika Input Brand Baru ---
    let isNewBrandMode = false;
    function toggleNewBrandMode() {
        isNewBrandMode = !isNewBrandMode;
        const existingWrapper = document.getElementById('existing_brand_wrapper');
        const newWrapper = document.getElementById('new_brand_wrapper');
        const toggleBtn = document.getElementById('toggle_brand_btn');
        const brandInput = document.getElementById('brand');
        const newBrandInput = document.getElementById('new_brand_name');
        const brandOptions = document.getElementById('brand_options');

        if(isNewBrandMode) {
            existingWrapper.classList.add('hidden');
            brandOptions.classList.add('hidden');
            newWrapper.classList.remove('hidden');
            
            toggleBtn.innerText = 'Cancel';
            toggleBtn.classList.remove('text-emerald-600', 'dark:text-volt');
            toggleBtn.classList.add('text-red-500', 'dark:text-red-400');
            
            brandInput.value = ''; // Hapus seleksi
            document.getElementById('selected_brand_text').innerText = '-- Select Brand --';
            document.getElementById('selected_brand_text').classList.replace('text-gray-900', 'text-gray-400');
            document.getElementById('selected_brand_text').classList.replace('dark:text-white', 'dark:text-gray-500');
            
            newBrandInput.focus();
        } else {
            existingWrapper.classList.remove('hidden');
            newWrapper.classList.add('hidden');
            
            toggleBtn.innerText = '+ New Brand';
            toggleBtn.classList.remove('text-red-500', 'dark:text-red-400');
            toggleBtn.classList.add('text-emerald-600', 'dark:text-volt');
            
            newBrandInput.value = ''; // Kosongkan input
        }
    }

    // --- Logika Custom Dropdown Murni (Tanpa Select/Optgroup bawaan) ---
    function toggleCategoryDropdown() {
        document.getElementById('category_options').classList.toggle('hidden');
        document.getElementById('brand_options').classList.add('hidden'); 
    }

    function selectCategory(id, name) {
        document.getElementById('category_id').value = id;
        const textElement = document.getElementById('selected_category_text');
        textElement.innerText = name;
        
        if (id !== '') {
            textElement.classList.remove('text-gray-400', 'dark:text-gray-500');
            textElement.classList.add('text-gray-900', 'dark:text-white');
        } else {
            textElement.classList.remove('text-gray-900', 'dark:text-white');
            textElement.classList.add('text-gray-400', 'dark:text-gray-500');
        }
        document.getElementById('category_options').classList.add('hidden');
    }

    function toggleBrandDropdown() {
        document.getElementById('brand_options').classList.toggle('hidden');
        document.getElementById('category_options').classList.add('hidden'); 
    }

    function selectBrand(val, text) {
        document.getElementById('brand').value = val;
        const textElement = document.getElementById('selected_brand_text');
        textElement.innerText = text;
        
        if (val !== '') {
            textElement.classList.remove('text-gray-400', 'dark:text-gray-500');
            textElement.classList.add('text-gray-900', 'dark:text-white');
        } else {
            textElement.classList.remove('text-gray-900', 'dark:text-white');
            textElement.classList.add('text-gray-400', 'dark:text-gray-500');
        }
        document.getElementById('brand_options').classList.add('hidden');
    }

    // Menutup dropdown jika klik di area luar
    document.addEventListener('click', function(event) {
        const catWrapper = document.getElementById('existing_category_wrapper');
        const catOptions = document.getElementById('category_options');
        if (catWrapper && !catWrapper.contains(event.target) && event.target.id !== 'toggle_cat_btn') {
            catOptions.classList.add('hidden');
        }

        const brandWrapper = document.getElementById('existing_brand_wrapper');
        const brandOptions = document.getElementById('brand_options');
        if (brandWrapper && !brandWrapper.contains(event.target) && event.target.id !== 'toggle_brand_btn') {
            brandOptions.classList.add('hidden');
        }
    });
</script>
@endsection