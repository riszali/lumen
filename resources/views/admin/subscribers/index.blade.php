@extends('layouts.admin')

@section('title', 'Newsletter Subscribers | Admin')
@section('header_title', 'Newsletter Subscribers')

@section('content')
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 transition-colors duration-500 pointer-events-none"></div>

    <div class="relative z-10 space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <div>
                <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">EMAIL SUBSCRIBERS</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-montserrat font-bold tracking-[0.2em] uppercase mt-1 transition-colors duration-500">Daftar pelanggan newsletter</p>
            </div>
            <div class="px-6 py-3 bg-white/80 dark:bg-white/5 rounded-full border border-gray-200 dark:border-white/10 backdrop-blur-md shadow-sm">
                <span class="text-sm text-gray-600 dark:text-gray-400 font-montserrat font-medium tracking-wider">Total: <span class="text-emerald-600 dark:text-volt font-bold">{{ $subscribers->total() }}</span> Emails</span>
            </div>
        </div>

        <!-- Glass Table Container -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden transition-colors duration-500">
            <div class="overflow-x-auto min-h-[400px]">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat transition-colors duration-500">
                    <thead class="bg-gray-100 dark:bg-white/5 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest transition-colors duration-500">
                        <tr>
                            <th class="px-8 py-5">Email Address</th>
                            <th class="px-8 py-5">Subscribe Date</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5 font-bold text-gray-900 dark:text-white tracking-wider group-hover:text-emerald-600 dark:group-hover:text-volt transition-colors">{{ $subscriber->email }}</td>
                            <td class="px-8 py-5 text-gray-500 dark:text-gray-400 font-medium">{{ $subscriber->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-5 text-right">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('Hapus email ini dari daftar langganan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 dark:text-red-400/80 hover:text-red-700 dark:hover:text-red-400 text-[10px] font-bold uppercase tracking-widest transition-colors duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-16 text-center text-gray-500 dark:text-gray-400 font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs uppercase tracking-widest font-bold">Belum ada pelanggan newsletter.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($subscribers->hasPages())
            <div class="px-8 py-5 border-t border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-black/20 glass-pagination transition-colors duration-500">
                {{ $subscribers->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Styling adjustment for Laravel Default Pagination */
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