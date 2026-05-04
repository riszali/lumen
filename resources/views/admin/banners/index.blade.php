@extends('layouts.admin')

@section('title', 'Manage Home Banners | Admin')
@section('header_title', 'Showcase Banners')

@section('content')
<!-- Ambient Background Wrapper for Glassmorphism -->
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <!-- Animated Glow/Blobs behind the glass -->
    <div class="absolute top-0 right-10 w-96 h-96 bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 pointer-events-none transition-colors duration-500"></div>

    <!-- Main Content Layer -->
    <div class="relative z-10 space-y-8">
        
        <div>
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">HOME SHOWCASE IMAGES</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-montserrat font-bold tracking-[0.2em] uppercase mt-1 transition-colors duration-500">Manage infinity slider images on homepage</p>
        </div>

        <!-- Form Upload Banner Baru -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8 transition-colors duration-500">
            <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-white/10 pb-4 transition-colors duration-500">Upload New Image</h3>
            
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-6 items-end">
                @csrf
                <div class="w-full sm:w-1/3">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Title (Optional)</label>
                    <input type="text" name="title" placeholder="e.g. New Padel Racket" class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-3.5 focus:ring-emerald-500 dark:focus:ring-volt focus:border-emerald-500 dark:focus:border-volt text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white/20 transition-all duration-300 outline-none">
                </div>
                <div class="w-full sm:w-1/2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold transition-colors duration-500">Image File *</label>
                    <input type="file" name="image" accept="image/*" required class="w-full bg-white dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-2xl shadow-sm dark:shadow-inner p-2.5 text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-widest file:bg-emerald-50 dark:file:bg-volt/20 file:text-emerald-600 dark:file:text-volt hover:file:bg-emerald-100 dark:hover:file:bg-volt/30 file:transition-colors cursor-pointer transition-colors duration-500">
                    @error('image') <span class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold block">{{ $message }}</span> @enderror
                </div>
                <div class="w-full sm:w-auto">
                    <button type="submit" class="w-full px-8 py-3.5 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 dark:hover:bg-volt/30 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)] backdrop-blur-md">Upload</button>
                </div>
            </form>
        </div>

        <!-- Grid Existing Banners -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($banners as $banner)
                <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[1.5rem] p-3 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] transition-colors duration-500 group relative">
                    <div class="aspect-[4/5] bg-black/40 rounded-xl overflow-hidden relative shadow-inner">
                        <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-50"></div>
                        
                        <!-- Delete Button (Muncul pas di-hover) -->
                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0" onsubmit="return confirm('Hapus gambar ini dari Home Showcase?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500/80 hover:bg-red-500 text-white p-2.5 rounded-full backdrop-blur-md shadow-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    <div class="pt-3 px-1">
                        <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider truncate transition-colors duration-500">{{ $banner->title ?? 'Untitled Banner' }}</h4>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">Uploaded {{ $banner->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400 font-light bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] transition-colors duration-500">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs uppercase tracking-widest font-bold block">No Images Uploaded Yet</span>
                    <span class="text-[10px] mt-1 block">Default fallback images are currently being shown on the homepage.</span>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection