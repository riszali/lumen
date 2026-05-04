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

    <!-- Script Light/Dark Mode Logic -->
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

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        /* Custom scrollbar for admin panel */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(150, 150, 150, 0.3); border-radius: 9999px; }
        .dark ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #ccff00; }

        /* Animasi Notifikasi Floating */
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes fadeOutUp {
            0% { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(-20px) scale(0.95); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-fade-out-up { animation: fadeOutUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-dark font-montserrat antialiased text-gray-900 dark:text-white overflow-hidden flex h-screen relative transition-colors duration-500">

    <!-- Ambient Glow Glassmorphism (Emerald untuk Light Mode, Volt untuk Dark Mode) -->
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[50%] bg-emerald-400 dark:bg-volt rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[150px] opacity-20 dark:opacity-[0.08] pointer-events-none z-0 transition-colors duration-500"></div>
    <div class="fixed bottom-[-10%] right-[-5%] w-[40%] h-[40%] bg-teal-400 dark:bg-[#00E5FF] rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[150px] opacity-20 dark:opacity-[0.05] pointer-events-none z-0 transition-colors duration-500"></div>

    <!-- Sidebar (Glassmorphism Light/Dark) -->
    <aside id="sidebar" class="w-72 bg-white/70 dark:bg-white/[0.02] backdrop-blur-2xl border-r border-gray-200 dark:border-white/10 flex flex-col z-20 h-full relative shadow-[8px_0_32px_0_rgba(0,0,0,0.05)] dark:shadow-[8px_0_32px_0_rgba(0,0,0,0.3)] transition-all duration-300">
        <!-- Logo Container: Dibuat tanpa overflow-hidden dan ukurannya dimaksimalkan -->
        <div class="h-24 flex items-center justify-center border-b border-gray-200 dark:border-white/10 transition-colors duration-500 px-4 relative">
            <a href="{{ route('admin.dashboard') }}" class="block transform hover:scale-110 transition duration-500 w-full flex justify-center">
                <img id="logo-full" src="{{ asset('assets/logo/will-sport-fix-transparant-logo-white-LFQ3FxNE1UZhtkMe.webp') }}" alt="WILLSPORTS Logo" class="h-20 w-auto object-contain scale-150 invert dark:invert-0 drop-shadow-[0_0_15px_rgba(0,0,0,0.1)] dark:drop-shadow-[0_0_15px_rgba(255,255,255,0.15)] transition-all duration-500">
                <h1 id="logo-mini" class="hidden font-bebas text-6xl text-emerald-600 dark:text-volt tracking-widest drop-shadow-sm transition-colors duration-500 mt-2">W</h1>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto overflow-x-hidden py-8 px-4 space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 rounded-full transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)]' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white border border-transparent hover:shadow-inner' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3.5 rounded-full transition-all duration-300 group {{ request()->routeIs('admin.products.*') ? 'bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)]' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white border border-transparent hover:shadow-inner' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Products</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3.5 rounded-full transition-all duration-300 group {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)]' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white border border-transparent hover:shadow-inner' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Orders</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3.5 rounded-full transition-all duration-300 group {{ request()->routeIs('admin.users.*') ? 'bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)]' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white border border-transparent hover:shadow-inner' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Customers</span>
            </a>
        </nav>

        <!-- Bottom Links -->
        <div class="p-4 border-t border-gray-200 dark:border-white/10 space-y-3 transition-colors duration-500 overflow-hidden">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3.5 rounded-full transition-all duration-300 group {{ request()->routeIs('admin.profile.*') ? 'bg-emerald-50 dark:bg-volt/20 text-emerald-600 dark:text-volt border border-emerald-200 dark:border-volt/30 shadow-sm dark:shadow-[0_0_15px_rgba(204,255,0,0.15)]' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white border border-transparent hover:shadow-inner' }}" title="Account Settings">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Settings</span>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-3.5 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-emerald-600 dark:hover:text-white transition-all duration-300 border border-transparent hover:shadow-inner" title="Storefront">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">View Store</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3.5 rounded-full text-red-500 dark:text-red-400/90 hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 border border-transparent hover:border-red-200 dark:hover:border-red-500/20 shadow-inner">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="sidebar-text ml-4 text-[11px] font-bold uppercase tracking-widest whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative z-10 transition-all duration-300">
        
        <!-- Header (Glassmorphism Light/Dark) -->
        <header class="h-24 bg-white/70 dark:bg-white/[0.02] backdrop-blur-xl border-b border-gray-200 dark:border-white/10 flex items-center justify-between px-6 sm:px-10 z-20 shadow-[0_8px_32px_0_rgba(0,0,0,0.05)] dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.1)] transition-colors duration-500">
            <div class="flex items-center">
                <!-- Tombol Minimize Menu -->
                <button onclick="toggleSidebar()" class="mr-4 sm:mr-6 p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-emerald-600 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-volt transition-all duration-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                <h2 class="font-bebas text-3xl sm:text-4xl tracking-wide text-gray-900 dark:text-white drop-shadow-sm dark:drop-shadow-md transition-colors duration-500 hidden sm:block">@yield('header_title', 'DASHBOARD')</h2>
            </div>
            
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-900 dark:text-white tracking-wide transition-colors duration-500">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-emerald-600 dark:text-volt uppercase tracking-widest mt-1 transition-colors duration-500">Administrator</p>
                </div>
                
                <!-- Light/Dark Mode Toggle Button -->
                <button onclick="toggleTheme()" class="w-10 h-10 bg-white dark:bg-white/5 backdrop-blur-md rounded-full border border-gray-200 dark:border-white/20 flex items-center justify-center text-gray-500 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-volt hover:border-emerald-300 dark:hover:border-white/40 transition-all duration-300 shadow-sm" title="Toggle Theme">
                    <!-- Sun Icon (Tampil pas Dark Mode) -->
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <!-- Moon Icon (Tampil pas Light Mode) -->
                    <svg class="w-4 h-4 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>

                <!-- Avatar Rounded-Full -->
                <a href="{{ route('admin.profile.edit') }}" class="w-10 h-10 sm:w-12 sm:h-12 bg-white dark:bg-white/5 backdrop-blur-md rounded-full border border-gray-200 dark:border-white/20 flex items-center justify-center text-emerald-600 dark:text-volt font-bold text-lg hover:border-emerald-500 dark:hover:border-volt hover:bg-emerald-500 dark:hover:bg-volt hover:text-white dark:hover:text-black transition-all duration-300 shadow-sm dark:shadow-[0_0_15px_rgba(255,255,255,0.05)] dark:hover:shadow-[0_0_20px_rgba(204,255,0,0.3)]">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </a>
            </div>
        </header>

        <!-- Flash Messages (Glassmorphism Toast) -->
        <div class="fixed top-28 right-10 z-[110] flex flex-col items-end pointer-events-none">
            @if(session('success'))
                <div class="toast-message bg-white/90 dark:bg-white/[0.05] backdrop-blur-2xl border border-gray-200 dark:border-white/10 border-l-4 border-l-emerald-500 dark:border-l-volt text-gray-900 dark:text-white px-6 py-4 rounded-r-2xl shadow-lg dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down flex items-center gap-4 transition-colors duration-500">
                    <div class="bg-emerald-100 dark:bg-volt/20 p-1.5 rounded-full">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-volt" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest mt-0.5">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="toast-message bg-white/90 dark:bg-white/[0.05] backdrop-blur-2xl border border-gray-200 dark:border-white/10 border-l-4 border-l-red-500 text-gray-900 dark:text-white px-6 py-4 rounded-r-2xl shadow-lg dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down flex items-center gap-4 transition-colors duration-500">
                    <div class="bg-red-100 dark:bg-red-500/20 p-1.5 rounded-full">
                        <svg class="w-5 h-5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest mt-0.5">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Scrollable Content Layer -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative z-10">
            @yield('content')
        </main>
    </div>

    <script>
        // Script untuk toggle Sidebar/Minimize Menu
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const logoFull = document.getElementById('logo-full');
            const logoMini = document.getElementById('logo-mini');

            // Toggle Class Lebar Sidebar (dari 72 ke 20/icon only)
            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-20');

            // Hide/Show Teks Menu
            texts.forEach(text => {
                text.classList.toggle('hidden');
            });

            // Ganti Logo Full jadi Huruf 'W' doang pas di-minimize
            if(sidebar.classList.contains('w-20')) {
                logoFull.classList.add('hidden');
                logoMini.classList.remove('hidden');
            } else {
                logoFull.classList.remove('hidden');
                logoMini.classList.add('hidden');
            }
        }

        // Auto-hide Toast Script
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