@extends('layouts.admin')

@section('title', 'Promos & Vouchers | WILLSPORTS')
@section('header_title', 'DISCOUNT MANAGEMENT')

@section('content')
<style>
    /* FIX DROPDOWN DARK MODE: Memaksa warna option agar tidak putih-biru standar browser */
    select option {
        background-color: #111 !important;
        color: #fff !important;
        padding: 10px;
    }
    /* Style tambahan untuk memastikan input date/datetime tampil bersih di dark mode */
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>

<div class="relative w-full space-y-5 sm:space-y-8 z-10 font-montserrat">

    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row items-center justify-between p-6 sm:p-8 bg-white/80 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] sm:rounded-[2.5rem] shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] transition-colors duration-500 text-center sm:text-left">
        <div class="flex items-center gap-6">
            <div class="hidden sm:flex w-16 h-16 bg-emerald-100 dark:bg-volt/10 rounded-2xl items-center justify-center border border-emerald-200 dark:border-volt/20">
                <svg class="w-8 h-8 text-emerald-600 dark:text-volt" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            </div>
            <div>
                <h1 class="font-bebas text-4xl sm:text-5xl md:text-6xl text-gray-900 dark:text-white tracking-wide drop-shadow-sm dark:drop-shadow-md transition-colors duration-500">PROMOS & <span class="text-emerald-600 dark:text-volt">VOUCHERS</span></h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-light mt-1 sm:mt-2 tracking-wide transition-colors duration-500">Kelola Flash Sale, event promo, dan kode kupon diskon untuk pelanggan Anda.</p>
            </div>
        </div>
    </div>

    <!-- Tab Navigation (Flash Sale vs Voucher) -->
    <div class="flex gap-2 sm:gap-4 border-b border-gray-200 dark:border-white/10 pb-4">
        <button id="tab-flashsale" onclick="switchTab('flashsale')" class="px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-emerald-600 dark:bg-volt text-white dark:text-black shadow-md">Flash Sale / Event</button>
        <button id="tab-voucher" onclick="switchTab('voucher')" class="px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-white dark:bg-white/5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 border border-gray-200 dark:border-white/10">Voucher & Kupon</button>
    </div>

    <!-- TAB 1: FLASH SALE CONTENT -->
    <div id="content-flashsale" class="space-y-6 animate-fade-in-down block">
        
        <!-- Form Add Flash Sale -->
        <div class="bg-white/80 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <h3 class="text-lg font-bebas tracking-wider text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-white/10 pb-4">TAMBAH PRODUK KE FLASH SALE</h3>
            
            <form action="{{ route('admin.flashsales.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 items-end">
                @csrf
                <div class="lg:col-span-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Pilih Produk</label>
                    <select name="product_id" required class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none cursor-pointer">
                        <option value="" class="bg-white dark:bg-[#222]">-- Pilih Produk --</option>
                        @foreach($products ?? [] as $prod)
                            <option value="{{ $prod->id }}" class="bg-white dark:bg-[#222]">
                                {{ $prod->name }} (Rp {{ number_format($prod->price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Harga Promo</label>
                    <input type="number" name="flash_sale_price" required min="0" class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none placeholder-gray-400 dark:placeholder-gray-600" placeholder="Cth: 150000">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Waktu Mulai</label>
                    <input type="datetime-local" name="flash_sale_start_date" class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none cursor-pointer">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Waktu Berakhir</label>
                    <input type="datetime-local" name="flash_sale_end_date" class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none cursor-pointer">
                </div>
                <div class="lg:col-span-5 flex justify-end mt-4">
                    <button type="submit" class="px-8 py-3.5 bg-emerald-600 dark:bg-volt text-white dark:text-black font-bold text-xs uppercase tracking-widest rounded-xl hover:opacity-80 transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)]">
                        Aktifkan Flash Sale
                    </button>
                </div>
            </form>
        </div>

        <!-- Flash Sale Table -->
        <div class="bg-white/80 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat whitespace-nowrap">
                    <thead class="bg-gray-100 dark:bg-black/20 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest">
                        <tr>
                            <th class="px-4 py-4 sm:px-8">Produk</th>
                            <th class="px-4 py-4 sm:px-8">Harga Normal</th>
                            <th class="px-4 py-4 sm:px-8">Harga Flash Sale</th>
                            <th class="px-4 py-4 sm:px-8">Periode</th>
                            <th class="px-4 py-4 sm:px-8 text-center">Status</th>
                            <th class="px-4 py-4 sm:px-8 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($flashSaleProducts ?? [] as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300">
                            <td class="px-4 py-5 sm:px-8">
                                <span class="font-bold text-gray-900 dark:text-white block">{{ $product->name }}</span>
                                <span class="text-[10px] text-gray-500">{{ $product->category->name ?? 'Gear' }}</span>
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-gray-500 line-through text-xs">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-5 sm:px-8 font-bold text-emerald-600 dark:text-volt">
                                Rp {{ number_format($product->flash_sale_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-xs text-gray-500">
                                @if($product->flash_sale_start_date && $product->flash_sale_end_date)
                                    {{ $product->flash_sale_start_date->format('d M, H:i') }} - <br> {{ $product->flash_sale_end_date->format('d M Y, H:i') }}
                                @else
                                    Tanpa Batas
                                @endif
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-center">
                                @if($product->is_flash_sale_active)
                                    <span class="px-3 py-1.5 bg-emerald-100 dark:bg-volt/10 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Berlangsung</span>
                                @else
                                    <span class="px-3 py-1.5 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-500/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Off / Pending</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-right">
                                <form action="{{ route('admin.flashsales.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari Flash Sale?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-lg text-gray-500 dark:text-gray-400 hover:text-red-500 transition" title="Hentikan Flash Sale">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada produk dalam program Flash Sale.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: VOUCHER CONTENT -->
    <div id="content-voucher" class="space-y-6 animate-fade-in-down hidden">
        
        <!-- Form Add Voucher -->
        <div class="bg-white/80 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-6 sm:p-8 shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <h3 class="text-lg font-bebas tracking-wider text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-white/10 pb-4">BUAT KODE VOUCHER BARU</h3>
            
            <form action="{{ route('admin.vouchers.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @csrf
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Kode Voucher</label>
                    <input type="text" name="code" required class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none uppercase placeholder-gray-400" placeholder="Cth: DISKON50K">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Tipe Potongan</label>
                    <select name="type" required class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none cursor-pointer">
                        <option value="fixed" class="bg-white dark:bg-[#222]">Nominal Tetap (Rp)</option>
                        <option value="percentage" class="bg-white dark:bg-[#222]">Persentase (%)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Nilai Potongan</label>
                    <input type="number" name="value" required min="0" class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none placeholder-gray-400" placeholder="Cth: 50000">
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 font-bold">Min. Pembelian</label>
                    <input type="number" name="min_purchase" value="0" min="0" class="w-full bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 rounded-xl py-3.5 px-4 text-sm text-gray-900 dark:text-white focus:ring-emerald-500 dark:focus:ring-volt outline-none placeholder-gray-400">
                </div>
                <div class="lg:col-span-4 flex justify-end">
                    <button type="submit" class="px-8 py-3.5 bg-emerald-600 dark:bg-volt text-white dark:text-black font-bold text-xs uppercase tracking-widest rounded-xl hover:opacity-80 transition duration-300 shadow-[0_0_15px_rgba(204,255,0,0.2)]">
                        Simpan Voucher
                    </button>
                </div>
            </form>
        </div>

        <!-- Vouchers Table -->
        <div class="bg-white/80 dark:bg-white/[0.03] backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-sm dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.4)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 font-montserrat whitespace-nowrap">
                    <thead class="bg-gray-100 dark:bg-black/20 border-b border-gray-200 dark:border-white/10 text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400 tracking-widest">
                        <tr>
                            <th class="px-4 py-4 sm:px-8">Kode Voucher</th>
                            <th class="px-4 py-4 sm:px-8">Tipe Diskon</th>
                            <th class="px-4 py-4 sm:px-8">Nilai / Potongan</th>
                            <th class="px-4 py-4 sm:px-8 text-center">Status</th>
                            <th class="px-4 py-4 sm:px-8 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($vouchers ?? [] as $voucher)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/10 transition duration-300">
                            <td class="px-4 py-5 sm:px-8 font-bold text-emerald-600 dark:text-volt tracking-widest text-lg">{{ $voucher->code }}</td>
                            <td class="px-4 py-5 sm:px-8">
                                @if($voucher->type === 'percentage')
                                    <span class="px-3 py-1.5 bg-gray-200 dark:bg-white/10 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-white/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Persentase (%)</span>
                                @else
                                    <span class="px-3 py-1.5 bg-gray-200 dark:bg-white/10 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-white/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Nominal (Rp)</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 sm:px-8 font-bold text-gray-900 dark:text-white">
                                {{ $voucher->type == 'percentage' ? $voucher->value.'%' : 'Rp '.number_format($voucher->value, 0, ',', '.') }}
                                @if($voucher->min_purchase > 0)
                                    <span class="text-[10px] font-normal text-gray-500 block">Min. Belanja: Rp {{ number_format($voucher->min_purchase, 0, ',', '.') }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-center">
                                @if($voucher->is_active && $voucher->isValid())
                                    <span class="px-3 py-1.5 bg-emerald-100 dark:bg-volt/10 text-emerald-700 dark:text-volt border border-emerald-200 dark:border-volt/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Aktif</span>
                                @else
                                    <span class="px-3 py-1.5 bg-gray-200 dark:bg-white/10 text-gray-500 border border-gray-300 dark:border-white/20 rounded-lg text-[10px] font-bold uppercase tracking-widest">Expired / Off</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 sm:px-8 text-right">
                                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-lg text-gray-500 dark:text-gray-400 hover:text-red-500 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada kode voucher yang dibuat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Script Simple untuk Ganti Tab -->
<script>
    function switchTab(tab) {
        const btnFlash = document.getElementById('tab-flashsale');
        const btnVoucher = document.getElementById('tab-voucher');
        const contentFlash = document.getElementById('content-flashsale');
        const contentVoucher = document.getElementById('content-voucher');

        if(tab === 'flashsale') {
            // Aktifkan Flash Sale
            btnFlash.className = "px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-emerald-600 dark:bg-volt text-white dark:text-black shadow-md";
            btnVoucher.className = "px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-white dark:bg-white/5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 border border-gray-200 dark:border-white/10";
            
            contentFlash.classList.remove('hidden');
            contentFlash.classList.add('block');
            contentVoucher.classList.remove('block');
            contentVoucher.classList.add('hidden');
        } else {
            // Aktifkan Voucher
            btnVoucher.className = "px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-emerald-600 dark:bg-volt text-white dark:text-black shadow-md";
            btnFlash.className = "px-6 py-3 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300 bg-white dark:bg-white/5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 border border-gray-200 dark:border-white/10";
            
            contentVoucher.classList.remove('hidden');
            contentVoucher.classList.add('block');
            contentFlash.classList.remove('block');
            contentFlash.classList.add('hidden');
        }
    }
</script>
@endsection