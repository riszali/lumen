@extends('layouts.admin')

@section('title', 'Manage Orders | Admin')
@section('header_title', 'Customer Orders')

@section('content')
<!-- Ambient Background Wrapper for Glassmorphism -->
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/40 dark:bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-sm dark:shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-gray-200 dark:border-white/10 backdrop-blur-2xl transition-colors duration-500">
    
    <!-- Animated Glow/Blobs behind the glass -->
    <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-20 dark:opacity-10 transition-colors duration-500 pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-teal-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] opacity-20 dark:opacity-10 transition-colors duration-500 pointer-events-none"></div>

    <!-- Main Content Layer -->
    <div class="relative z-10 space-y-8">
        
        <div class="mb-4">
            <h2 class="font-bebas text-4xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">ALL ORDERS</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-montserrat font-bold tracking-[0.2em] uppercase mt-1 transition-colors duration-500">Track and manage customer purchases</p>
        </div>

        <!-- Glass Table Container -->
        <div class="bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl border border-gray-200 dark:border-white/10 rounded-[2rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden transition-colors duration-500">
            <div class="overflow-x-auto min-h-[400px]"> <!-- Min-height agar dropdown tidak terpotong saat data sedikit -->
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat transition-colors duration-500">
                    <thead class="bg-gray-100 dark:bg-white/5 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest transition-colors duration-500">
                        <tr>
                            <th class="px-8 py-5">Order No.</th>
                            <th class="px-8 py-5">Date</th>
                            <th class="px-8 py-5">Customer</th>
                            <th class="px-8 py-5">Items</th>
                            <th class="px-8 py-5">Total</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5 font-bold text-gray-900 dark:text-white tracking-wider group-hover:text-emerald-600 dark:group-hover:text-volt transition-colors">{{ $order->order_number }}</td>
                            <td class="px-8 py-5 text-gray-500 dark:text-gray-400 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-900 dark:text-white transition-colors">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-8 py-5">
                                @if($order->items->count() > 0)
                                    <div class="flex items-center gap-4">
                                        @php
                                            $firstItem = $order->items->first();
                                            $hasImage = $firstItem->product && $firstItem->product->primaryImage;
                                        @endphp
                                        
                                        <div class="w-10 h-10 bg-gray-200 dark:bg-black/40 border border-gray-300 dark:border-white/10 rounded-lg overflow-hidden shadow-sm dark:shadow-inner flex-shrink-0 flex items-center justify-center transition-colors">
                                            @if($hasImage)
                                                <img src="{{ Storage::url($firstItem->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-gray-400 dark:text-white/30 text-[8px] uppercase font-bold">No Img</span>
                                            @endif
                                        </div>
                                        
                                        <div class="text-xs">
                                            <p class="font-bold text-gray-900 dark:text-white w-32 truncate transition-colors" title="{{ $firstItem->product_name }}">{{ $firstItem->product_name }}</p>
                                            @if($order->items->count() > 1)
                                                <p class="text-emerald-600 dark:text-volt mt-0.5 font-medium">+ {{ $order->items->count() - 1 }} item(s) lain</p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500">Tidak ada item</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 font-bold text-emerald-600 dark:text-volt">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-8 py-5">
                                @php
                                    $statusStyles = [
                                        'pending'    => 'bg-yellow-100 dark:bg-yellow-500/10 text-yellow-700 dark:text-yellow-500 border border-yellow-200 dark:border-yellow-500/20',
                                        'paid'       => 'bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20',
                                        'processing' => 'bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 border border-purple-200 dark:border-purple-500/20',
                                        'shipped'    => 'bg-emerald-100 dark:bg-volt/10 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/20',
                                        'completed'  => 'bg-emerald-100 dark:bg-volt/10 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/20',
                                        'cancelled'  => 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-500/20',
                                    ];
                                    $styleClass = $statusStyles[$order->status] ?? 'bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-white/20';
                                @endphp
                                <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm transition-colors {{ $styleClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right relative">
                                <!-- Form Update Status dengan Custom Dropdown Murni -->
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center justify-end gap-2 relative">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="relative text-left z-20" id="dropdown_wrapper_{{ $order->id }}">
                                        <!-- Input Hidden yang akan di-submit -->
                                        <input type="hidden" name="status" id="status_input_{{ $order->id }}" value="{{ $order->status }}">
                                        
                                        <!-- Tombol Custom Dropdown -->
                                        <button type="button" onclick="toggleDropdown({{ $order->id }})" id="dropdown_btn_{{ $order->id }}" class="w-32 bg-white dark:bg-black/30 border border-gray-200 dark:border-white/10 rounded-xl shadow-sm dark:shadow-inner px-3 py-2 flex justify-between items-center transition-all duration-300 hover:bg-gray-50 dark:hover:bg-black/50 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:focus:ring-volt">
                                            <span id="status_text_{{ $order->id }}" class="text-xs font-semibold text-gray-900 dark:text-white capitalize">{{ $order->status }}</span>
                                            <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>

                                        <!-- Menu List Status Kaca -->
                                        <ul id="dropdown_list_{{ $order->id }}" class="hidden absolute right-0 top-full mt-1 w-32 bg-white/95 dark:bg-[#111111]/95 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-xl shadow-lg dark:shadow-[0_8px_32px_rgba(0,0,0,0.6)] py-1 transition-colors duration-500 z-50">
                                            @foreach(['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'] as $statusOption)
                                                <li class="px-4 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-volt/20 hover:text-emerald-600 dark:hover:text-volt cursor-pointer transition capitalize" onclick="selectStatus({{ $order->id }}, '{{ $statusOption }}')">
                                                    {{ $statusOption }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Tombol Update/Save -->
                                    <button type="submit" class="px-4 py-2 bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 rounded-xl text-[10px] uppercase tracking-widest font-bold hover:bg-emerald-100 dark:hover:bg-volt/30 transition shadow-sm dark:shadow-none backdrop-blur-md">Update</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center text-gray-500 dark:text-gray-400 font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    <span class="text-xs uppercase tracking-widest font-bold">No orders found in the system.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
            <div class="px-8 py-5 border-t border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-black/20 glass-pagination transition-colors duration-500">
                {{ $orders->links() }}
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

<script>
    let openDropdownId = null;

    function toggleDropdown(orderId) {
        const list = document.getElementById('dropdown_list_' + orderId);
        
        // Tutup dropdown yang sedang terbuka (jika ada)
        if (openDropdownId && openDropdownId !== orderId) {
            document.getElementById('dropdown_list_' + openDropdownId).classList.add('hidden');
        }
        
        list.classList.toggle('hidden');
        
        // Update state
        if (!list.classList.contains('hidden')) {
            openDropdownId = orderId;
        } else {
            openDropdownId = null;
        }
    }

    function selectStatus(orderId, statusValue) {
        // Set nilai ke input hidden
        document.getElementById('status_input_' + orderId).value = statusValue;
        
        // Update teks tombol
        document.getElementById('status_text_' + orderId).innerText = statusValue;
        
        // Sembunyikan dropdown
        document.getElementById('dropdown_list_' + orderId).classList.add('hidden');
        openDropdownId = null;
    }

    // Menutup dropdown jika klik di area kosong layar
    document.addEventListener('click', function(event) {
        if (openDropdownId) {
            const wrapper = document.getElementById('dropdown_wrapper_' + openDropdownId);
            if (wrapper && !wrapper.contains(event.target)) {
                document.getElementById('dropdown_list_' + openDropdownId).classList.add('hidden');
                openDropdownId = null;
            }
        }
    });
</script>
@endsection