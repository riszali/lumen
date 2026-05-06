@extends('layouts.admin')

@section('title', 'Manage Brands | Admin')
@section('header_title', 'Brand Showcase')

@section('content')
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <div class="absolute top-0 right-10 w-96 h-96 bg-blue-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-5 pointer-events-none transition-colors duration-500"></div>

    <div class="relative z-10 space-y-8">
        
        <div>
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">BRAND PAGES</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-montserrat font-bold tracking-[0.2em] uppercase mt-1 transition-colors duration-500">Create dedicated landing pages for brands</p>
        </div>

        <!-- Form Upload Brand Baru -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8 transition-colors duration-500">
            <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-white/10 pb-4 transition-colors duration-500">Tambah Brand Baru</h3>
            
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6 font-montserrat">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nama Brand -->
                    <div class="md:col-span-1">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Nama Brand *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Babolat" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                        @error('name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-1">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Deskripsi Brand (Opsional)</label>
                        <textarea name="description" rows="3" placeholder="Tuliskan cerita singkat atau tagline dari brand ini..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- UPLOAD LOGO BARU DI SINI -->
                    <div class="md:col-span-2 mt-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Gambar Logo Brand (Opsional)</label>
                        <input type="file" name="logo" accept="image/*" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-2.5 text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-widest file:bg-emerald-50 dark:file:bg-volt/20 file:text-emerald-600 dark:file:text-volt hover:file:bg-emerald-100 dark:hover:file:bg-volt/30 file:transition-colors cursor-pointer transition-colors duration-500">
                        <span class="text-[10px] text-gray-500 mt-1 block font-semibold">Disarankan: Format PNG/SVG transparan.</span>
                        @error('logo') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Drag & Drop Upload Zone (BANNER) -->
                    <div class="md:col-span-2 mt-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Gambar Banner Utama *</label>
                        
                        <div id="dropzone" class="relative border-2 border-dashed border-gray-300 dark:border-white/20 rounded-2xl p-8 sm:p-12 text-center hover:border-emerald-500 dark:hover:border-volt hover:bg-emerald-50/50 dark:hover:bg-volt/5 transition-all duration-300 group cursor-pointer">
                            <input type="file" name="banner" id="banner_upload" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <!-- Tampilan Default (Belum Ada Gambar) -->
                            <div id="dropzone-text" class="pointer-events-none flex flex-col items-center justify-center space-y-4 transition-opacity duration-300">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center group-hover:bg-emerald-100 dark:group-hover:bg-volt/20 transition-colors shadow-inner">
                                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500 group-hover:text-emerald-600 dark:group-hover:text-volt transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-bold text-emerald-600 dark:text-volt">Klik untuk upload</span> atau seret gambar banner ke sini
                                </div>
                                
                                <!-- Guidelines / Petunjuk Ukuran -->
                                <div class="mt-4 flex flex-col items-center gap-1.5">
                                    <span class="text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest bg-gray-100 dark:bg-white/5 px-4 py-2 rounded-lg border border-gray-200 dark:border-white/5">
                                        Disarankan: 1920x1080px &nbsp;|&nbsp; Rasio 16:9
                                    </span>
                                    <span class="text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest bg-gray-100 dark:bg-white/5 px-4 py-2 rounded-lg border border-gray-200 dark:border-white/5">
                                        Maksimal File: 10MB &nbsp;|&nbsp; Format: JPG, PNG, WEBP
                                    </span>
                                </div>
                            </div>

                            <!-- Preview Area (Muncul Setelah Ada Gambar) -->
                            <div id="dropzone-preview" class="hidden pointer-events-none flex flex-col items-center justify-center w-full">
                                <div class="relative w-full max-w-2xl rounded-xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 group-hover:border-emerald-500 dark:group-hover:border-volt transition-colors">
                                    <img id="preview-image" src="" alt="Preview" class="w-full h-auto object-cover aspect-video">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span class="text-white text-xs font-bold uppercase tracking-widest px-6 py-3 bg-black/60 rounded-full border border-white/20 backdrop-blur-md">Ganti Gambar</span>
                                    </div>
                                </div>
                                <p id="preview-filename" class="text-[11px] mt-4 font-bold text-emerald-600 dark:text-volt tracking-widest uppercase"></p>
                            </div>
                        </div>
                        @error('banner') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-8 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)] backdrop-blur-md">Simpan Brand</button>
                </div>
            </form>
        </div>

        <!-- Grid Existing Brands -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($brands as $brand)
                <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[1.5rem] overflow-hidden shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] transition-colors duration-500 group relative flex flex-col">
                    <div class="h-40 bg-black/40 relative shadow-inner overflow-hidden">
                        @if($brand->banner_path)
                            <img src="{{ Storage::url($brand->banner_path) }}" alt="{{ $brand->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent opacity-80"></div>
                        
                        <!-- PREVIEW LOGO DI SUDUT KANAN ATAS JIKA ADA -->
                        @if($brand->logo_path)
                            <img src="{{ Storage::url($brand->logo_path) }}" alt="{{ $brand->name }} Logo" class="absolute top-4 right-4 w-12 h-12 object-contain bg-white/10 backdrop-blur-md p-1.5 rounded-xl border border-white/20 z-20 shadow-md">
                        @endif

                        <h4 class="absolute bottom-4 left-4 text-3xl font-bebas text-white tracking-wide z-10 drop-shadow-md">{{ $brand->name }}</h4>
                    </div>
                    
                    <div class="p-5 flex justify-between items-center bg-gray-50/50 dark:bg-transparent flex-grow">
                        <div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase tracking-widest">Tautan Publik:</p>
                            <a href="{{ route('brand.show', $brand->slug) }}" target="_blank" class="text-[11px] text-emerald-600 dark:text-volt hover:underline font-bold tracking-widest uppercase mt-0.5 inline-block">/brand/{{ $brand->slug }}</a>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="bg-emerald-500/10 hover:bg-emerald-500 text-emerald-600 dark:text-volt hover:text-white dark:hover:text-black p-2.5 rounded-xl border border-emerald-500/20 transition shadow-sm" title="Edit Brand">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Hapus halaman brand ini? (Produk tidak akan terhapus)');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2.5 rounded-xl border border-red-500/20 transition shadow-sm" title="Hapus Brand">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400 font-light bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] transition-colors duration-500">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-xs uppercase tracking-widest font-bold block">Belum Ada Brand</span>
                    <span class="text-[10px] mt-1 block">Silakan buat brand untuk generate halaman landing page khusus.</span>
                </div>
            @endforelse
        </div>

    </div>
</div>

<!-- SCRIPT DRAG & DROP -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('banner_upload');
        const textArea = document.getElementById('dropzone-text');
        const previewArea = document.getElementById('dropzone-preview');
        const previewImg = document.getElementById('preview-image');
        const previewName = document.getElementById('preview-filename');

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImg.src = e.target.result;
                        previewName.textContent = file.name;
                        textArea.classList.add('hidden');
                        previewArea.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
        });

        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10');
            
            const files = e.dataTransfer.files;
            fileInput.files = files; 
            handleFiles(files);
        });
    });
</script>
@endsection