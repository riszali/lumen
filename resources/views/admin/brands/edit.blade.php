@extends('layouts.admin')

@section('title', 'Edit Brand | Admin')
@section('header_title', 'Brand Showcase')

@section('content')
<!-- Ambient Background Glow - Memberikan efek pendar di latar belakang -->
<div class="absolute top-1/4 right-1/4 w-96 h-96 bg-teal-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <!-- Konten Utama -->
    <div class="relative z-10 max-w-4xl mx-auto space-y-8 font-montserrat">
        
        <!-- Header & Breadcrumb -->
        <div>
            <a href="{{ route('admin.brands.index') }}" class="text-emerald-600 dark:text-volt hover:text-emerald-800 dark:hover:text-white font-bold text-[10px] uppercase tracking-widest mb-4 inline-flex items-center gap-2 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Brand
            </a>
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500 uppercase">
                EDIT KONTEN: <span class="text-emerald-600 dark:text-volt">{{ $brand->name }}</span>
            </h2>
        </div>

        <!-- Form Edit Brand -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8 transition-colors duration-500">
            
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- 1. Kolom Nama Brand -->
                    <div class="md:col-span-1">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Nama Brand *</label>
                        <!-- Menggunakan old() agar data tidak hilang saat error validasi -->
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required placeholder="Contoh: Babolat" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white transition-all duration-300 outline-none">
                        @error('name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- 2. Kolom Status Active -->
                    <div class="md:col-span-1">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Status Halaman Publik</label>
                        <div class="flex items-center h-[52px]">
                            <label class="relative inline-flex items-center cursor-pointer group">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-white/10 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500 dark:peer-checked:bg-volt"></div>
                                <span class="ml-3 text-xs font-bold uppercase tracking-widest text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-volt transition-colors">Aktif & Ditampilkan</span>
                            </label>
                        </div>
                    </div>

                    <!-- 3. Kolom Deskripsi Brand -->
                    <div class="md:col-span-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Deskripsi Singkat / Cerita Brand</label>
                        <textarea name="description" rows="3" placeholder="Ceritakan sedikit tentang brand ini untuk memikat pembeli..." class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white transition-all duration-300 outline-none">{{ old('description', $brand->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- 4. Bagian Upload Logo -->
                    <div class="md:col-span-2 mt-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Logo Brand (Rasio 1:1 / PNG Transparan)</label>
                        
                        <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center p-5 bg-gray-50/50 dark:bg-black/20 rounded-2xl border border-gray-200 dark:border-white/5">
                            <!-- Pratinjau Logo Saat Ini -->
                            @if($brand->logo_path)
                                <div class="flex-shrink-0 text-center">
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-2">Logo Sekarang:</p>
                                    <div class="w-20 h-20 bg-black/40 p-2 rounded-xl border border-white/10 shadow-inner flex items-center justify-center">
                                        <img src="{{ Storage::url($brand->logo_path) }}" alt="Current Logo" class="max-w-full max-h-full object-contain">
                                    </div>
                                </div>
                            @endif

                            <!-- Input File Logo -->
                            <div class="flex-grow w-full">
                                <p class="text-[10px] font-medium text-yellow-600 dark:text-yellow-500 mb-3 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    Kosongkan jika tidak ingin mengganti logo.
                                </p>
                                <input type="file" name="logo" id="logo_input" accept="image/*" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-2.5 text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-widest file:bg-emerald-50 dark:file:bg-volt/20 file:text-emerald-600 dark:file:text-volt hover:file:bg-emerald-100 dark:hover:file:bg-volt/30 file:transition-colors cursor-pointer">
                            </div>
                        </div>
                        @error('logo') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- 5. Bagian Upload Banner (Drag & Drop Zone) -->
                    <div class="md:col-span-2 mt-4">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Banner Utama (Hero Landing Page)</label>
                        
                        <div class="mb-4 flex flex-wrap gap-4 text-[10px] font-bold uppercase tracking-widest">
                            <span class="bg-gray-100 dark:bg-white/5 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-white/5 text-gray-500">Rasio: 16:9</span>
                            <span class="bg-gray-100 dark:bg-white/5 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-white/5 text-gray-500">Saran: 1920x1080px</span>
                            <span class="bg-gray-100 dark:bg-white/5 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-white/5 text-gray-500">Max: 10MB</span>
                        </div>
                        
                        <div id="dropzone" class="relative border-2 border-dashed border-gray-300 dark:border-white/20 rounded-[2.5rem] p-6 sm:p-10 text-center hover:border-emerald-500 dark:hover:border-volt hover:bg-emerald-50/30 dark:hover:bg-volt/5 transition-all duration-500 group cursor-pointer overflow-hidden">
                            <input type="file" name="banner" id="banner_upload" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                            
                            <!-- Area Tampilan Banner Sekarang -->
                            <div id="dropzone-text" class="pointer-events-none flex flex-col items-center justify-center transition-all duration-500 z-10">
                                @if($brand->banner_path)
                                    <div class="relative w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-white/10 group-hover:scale-[0.99] transition-transform duration-500">
                                        <img src="{{ Storage::url($brand->banner_path) }}" alt="Banner Saat Ini" class="w-full h-auto object-cover aspect-video">
                                        <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center mb-3 backdrop-blur-md border border-white/20">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            </div>
                                            <span class="text-white text-[11px] font-bold uppercase tracking-[0.3em] px-8 py-2.5 bg-white/10 rounded-full border border-white/20 backdrop-blur-md">Ganti Banner Utama</span>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-xs text-gray-500 font-medium italic">Seret file baru ke sini untuk mengganti banner di atas.</p>
                                @else
                                    <div class="py-12">
                                        <div class="w-20 h-20 bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p class="text-sm text-gray-500 uppercase tracking-widest font-bold">Klik atau seret file banner ke sini</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Area Pratinjau File Baru (Muncul saat file dipilih) -->
                            <div id="dropzone-preview" class="hidden pointer-events-none flex flex-col items-center justify-center w-full animate-fadeIn z-10">
                                <div class="relative w-full max-w-2xl rounded-2xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] border-2 border-emerald-500 dark:border-volt">
                                    <img id="preview-image" src="" alt="Preview" class="w-full h-auto object-cover aspect-video">
                                    <div class="absolute top-4 left-4 bg-emerald-500 dark:bg-volt text-white dark:text-black text-[10px] font-bold uppercase tracking-widest px-5 py-2 rounded-full shadow-lg border border-white/20">Banner Baru Siap!</div>
                                </div>
                                <p id="preview-filename" class="text-[11px] mt-6 font-bold text-emerald-600 dark:text-volt tracking-widest uppercase truncate max-w-xs"></p>
                                <p class="text-[9px] text-gray-500 mt-1 uppercase font-bold tracking-widest">Klik area ini jika ingin membatalkan & memilih file lain</p>
                            </div>
                        </div>
                        @error('banner') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="flex justify-end pt-8 mt-6 border-t border-gray-200 dark:border-white/10 gap-4">
                    <a href="{{ route('admin.brands.index') }}" class="px-8 py-3.5 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-400 rounded-full text-[10px] font-bold uppercase tracking-widest hover:text-gray-900 dark:hover:text-white transition-all shadow-sm">Batal</a>
                    <button type="submit" class="px-10 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-[0_0_20px_rgba(204,255,0,0.3)] backdrop-blur-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- SCRIPT LOGIKA FORM & DRAG-N-DROP -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('banner_upload');
        const textArea = document.getElementById('dropzone-text');
        const previewArea = document.getElementById('dropzone-preview');
        const previewImg = document.getElementById('preview-image');
        const previewName = document.getElementById('preview-filename');

        /**
         * Fungsi untuk memproses file gambar dan menampilkan pratinjau.
         */
        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                
                // Validasi tipe file sederhana
                if (!file.type.startsWith('image/')) {
                    alert('Harap unggah file gambar (JPG, PNG, atau WEBP).');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    previewName.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                    
                    // Sembunyikan instruksi lama, tampilkan pratinjau baru
                    if(textArea) textArea.classList.add('hidden');
                    previewArea.classList.remove('hidden');
                    
                    // Tambahkan efek animasi halus
                    previewArea.style.opacity = '0';
                    setTimeout(() => { previewArea.style.opacity = '1'; previewArea.style.transition = 'opacity 0.5s ease'; }, 10);
                };
                reader.readAsDataURL(file);
            }
        }

        // Event listener saat file dipilih secara manual (klik)
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        // Event listener saat file diseret di atas area (Drag Over)
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10', 'scale-[1.01]');
        });

        // Event listener saat file keluar dari area seret (Drag Leave)
        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10', 'scale-[1.01]');
        });

        // Event listener saat file dijatuhkan (Drop)
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-emerald-500', 'dark:border-volt', 'bg-emerald-50/50', 'dark:bg-volt/10', 'scale-[1.01]');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                // Masukkan file hasil drag ke dalam input file agar terkirim saat submit
                fileInput.files = files; 
                handleFiles(files);
            }
        });
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
@endsection