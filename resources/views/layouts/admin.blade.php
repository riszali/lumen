<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'WILLSPORTS Admin Dashboard')</title>

    <!-- Font Khusus Sports Premium: Bebas Neue & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Script Light/Dark Mode Logic (Murni JS, sangat ringan) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }
    </script>

    <!-- Tailwind CSS Vite (Utama) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- 
      CATATAN PERFORMA PENTING: 
      Script CDN Tailwind ini bikin browser meng-compile CSS setiap kali pindah halaman.
      Sebaiknya konfigurasi warna 'volt' dan 'dark' ini dipindahkan ke file tailwind.config.js 
      bawaan Laravel, lalu hapus script CDN ini agar web jadi secepat kilat (0 delay).
    -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    colors: {
                        volt: '#ccff00',
                        dark: '#050505',
                        border: 'rgba(255, 255, 255, 0.1)'
                    },
                    fontFamily: {
                        bebas: ['"Bebas Neue"', 'sans-serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(150, 150, 150, 0.3); border-radius: 9999px; }
        .dark ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #ccff00; }

        /* OPTIMASI EXTREME: Pengganti efek Blur-[100px] dengan Radial Gradient Biasa. 
           Ini 1000x lebih ringan untuk dirender CPU/GPU HP pada saat memuat halaman */
        .bg-glow-1 {
            background: radial-gradient(circle, rgba(52, 211, 153, 0.12) 0%, transparent 60%);
        }
        .dark .bg-glow-1 {
            background: radial-gradient(circle, rgba(204, 255, 0, 0.08) 0%, transparent 60%);
        }
        .bg-glow-2 {
            background: radial-gradient(circle, rgba(45, 212, 191, 0.12) 0%, transparent 60%);
        }
        .dark .bg-glow-2 {
            background: radial-gradient(circle, rgba(0, 229, 255, 0.08) 0%, transparent 60%);
        }

        /* Animasi Notifikasi */
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes fadeOutUp {
            0% { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(-20px) scale(0.95); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.3s ease-out forwards; }
        .animate-fade-out-up { animation: fadeOutUp 0.3s ease-in forwards; }
    </style>
</head>
<!-- OPTIMASI: Transisi body dihapus karena memicu reflow saat reload halaman -->
<body class="bg-gray-50 dark:bg-dark font-montserrat antialiased text-gray-900 dark:text-white overflow-hidden flex h-screen relative">

    <!-- OPTIMASI: Efek cahaya background (Glow) diubah dari blur filter ke CSS radial-gradient murni -->
    <div class="fixed top-[-20%] left-[-10%] w-[60vw] h-[60vw] bg-glow-1 pointer-events-none z-0"></div>
    <div class="fixed bottom-[-20%] right-[-10%] w-[60vw] h-[60vw] bg-glow-2 pointer-events-none z-0"></div>

    <!-- Sidebar -->
    <!-- OPTIMASI: backdrop-blur diturunkan ke 'md' agar tidak menyiksa RAM/GPU HP -->
    <aside id="sidebar" class="w-72 bg-white/90 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-r border-gray-200 dark:border-white/10 flex flex-col z-20 h-full relative shadow-md transition-[width] duration-200 ease-out">
        <!-- Logo -->
        <div class="h-24 flex items-center justify-center border-b border-gray-200 dark:border-white/10 px-4 relative">
            <a href="{{ route('admin.dashboard') }}" class="block transform hover:scale-105 transition-transform duration-200 w-full flex justify-center">
                <img id="logo-full" src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-20 w-auto object-contain scale-150 invert dark:invert-0">
                <h1 id="logo-mini" class="hidden font-bebas text-6xl text-emerald-600 dark:text-volt tracking-widest mt-2">W</h1>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto overflow-x-hidden py-8 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.products.*') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Products</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Orders</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.users.*') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Customers</span>
            </a>

            <a href="{{ route('admin.banners.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.banners.*') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Home Banners</span>
            </a>
        </nav>

        <!-- Bottom Links -->
        <div class="p-4 border-t border-gray-200 dark:border-white/10 space-y-2 overflow-hidden bg-gray-50 dark:bg-transparent">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3.5 rounded-2xl transition-colors duration-150 group {{ request()->routeIs('admin.profile.*') ? 'bg-emerald-50 dark:bg-volt/10 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/20' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border border-transparent' }}" title="Account Settings">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Settings</span>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-3.5 rounded-2xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white transition-colors duration-150 border border-transparent" title="Storefront">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">View Store</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="w-full mt-2 border-t border-gray-200 dark:border-white/5 pt-2">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3.5 rounded-2xl text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors duration-150 border border-transparent">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Script Restorasi Status Sidebar Secara Cepat -->
    <script>
        (function() {
            const savedState = localStorage.getItem('sidebar_state');
            const isMobile = window.innerWidth <= 768; // Deteksi layar HP/Tablet

            if (savedState === 'minimized' || (!savedState && isMobile)) {
                const sidebar = document.getElementById('sidebar');
                const texts = document.querySelectorAll('.sidebar-text');
                const logoFull = document.getElementById('logo-full');
                const logoMini = document.getElementById('logo-mini');

                // Hilangkan class transisi biar instan tanpa kedip pas load
                sidebar.classList.remove('transition-[width]', 'duration-200', 'ease-out');
                
                sidebar.classList.remove('w-72');
                sidebar.classList.add('w-20');

                texts.forEach(text => text.classList.add('hidden'));
                if(logoFull) logoFull.classList.add('hidden');
                if(logoMini) logoMini.classList.remove('hidden');

                setTimeout(() => {
                    sidebar.classList.add('transition-[width]', 'duration-200', 'ease-out');
                }, 10);
            }
        })();
    </script>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative z-10">
        
        <!-- Header -->
        <header class="h-24 bg-white/90 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-gray-200 dark:border-white/10 flex items-center justify-between px-6 sm:px-10 z-20 shadow-sm">
            <div class="flex items-center">
                <!-- Tombol Minimize Menu -->
                <button onclick="toggleSidebar()" class="mr-4 sm:mr-6 p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-emerald-600 dark:text-gray-400 dark:hover:bg-white/10 dark:hover:text-volt transition-colors duration-150 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                <h2 class="font-bebas text-3xl sm:text-4xl tracking-wide text-gray-900 dark:text-white hidden sm:block">@yield('header_title', 'DASHBOARD')</h2>
            </div>
            
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-900 dark:text-white tracking-wide">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-emerald-600 dark:text-volt uppercase tracking-widest mt-0.5">Administrator</p>
                </div>
                
                <!-- Light/Dark Mode Toggle Button -->
                <button onclick="toggleTheme()" class="w-10 h-10 bg-gray-100 dark:bg-white/10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center text-gray-500 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-volt transition-colors duration-150" title="Toggle Theme">
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg class="w-4 h-4 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>

                <!-- Avatar -->
                <a href="{{ route('admin.profile.edit') }}" class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-100 dark:bg-white/10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center text-emerald-600 dark:text-volt font-bold text-lg hover:border-emerald-500 dark:hover:border-volt hover:bg-emerald-500 dark:hover:bg-volt hover:text-white dark:hover:text-black transition-colors duration-150">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="fixed top-28 right-4 sm:right-10 z-[110] flex flex-col items-end pointer-events-none">
            @if(session('success'))
                <div class="toast-message bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 border-l-4 border-l-emerald-500 dark:border-l-volt text-gray-900 dark:text-white px-6 py-4 rounded-xl shadow-lg pointer-events-auto mb-3 animate-fade-in-down flex items-center gap-4">
                    <div class="bg-emerald-100 dark:bg-volt/20 p-1.5 rounded-full">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-volt" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest mt-0.5">{{ session('success') }}</span>
                </div>
            @endif
        </div>

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative z-10">
            @yield('content')
        </main>
    </div>

    <!-- Script Hamburger Menu Mulus -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const logoFull = document.getElementById('logo-full');
            const logoMini = document.getElementById('logo-mini');

            const isCollapsing = sidebar.classList.contains('w-72');

            if (isCollapsing) {
                localStorage.setItem('sidebar_state', 'minimized');

                texts.forEach(text => text.classList.add('hidden'));
                if(logoFull) logoFull.classList.add('hidden');
                if(logoMini) logoMini.classList.remove('hidden');
                
                sidebar.classList.remove('w-72');
                sidebar.classList.add('w-20');
            } else {
                localStorage.setItem('sidebar_state', 'expanded');

                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-72');
                
                setTimeout(() => {
                    texts.forEach(text => text.classList.remove('hidden'));
                    if(logoFull) logoFull.classList.remove('hidden');
                    if(logoMini) logoMini.classList.add('hidden');
                }, 200); // 200ms disamakan dengan duration transisi CSS
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toasts = document.querySelectorAll('.toast-message');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.classList.remove('animate-fade-in-down');
                    toast.classList.add('animate-fade-out-up');
                    setTimeout(() => toast.remove(), 400); 
                }, 4000); 
            });
        });
    </script>
</body>
</html>