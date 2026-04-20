<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LUMEN Admin')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 
                            dark: '#252322',    /* Dark charcoal */
                            olive: '#9A9587',   /* Muted olive */
                            sage: '#AAAB9A',    /* Light sage */
                            gray: '#BDBBB9',    /* Light silver-gray */
                            warm: '#DAD5CC',    /* Light warm gray */
                            light: '#E5E6D9',   /* Very light green-white */
                            cream: '#EDE7D4'    /* Cream/ivory */
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Lato', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Lato', sans-serif; }

        #sidebar { transition: width 0.3s ease-in-out; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(237, 231, 212, 0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(154, 149, 135, 0.5); }
    </style>
</head>
<body class="font-sans antialiased text-brand-light bg-brand-dark flex h-screen overflow-hidden selection:bg-brand-sage selection:text-brand-dark">

    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-brand-olive/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[30%] bg-brand-sage/15 rounded-full blur-[120px]"></div>
    </div>

    <aside id="sidebar" class="bg-white/[0.02] backdrop-blur-2xl border-r border-white/10 text-white w-64 flex flex-col relative z-20 shadow-[4px_0_24px_rgba(0,0,0,0.5)]">
        <div class="h-20 flex items-center justify-between px-4 border-b border-white/10">
            <a href="{{ route('admin.dashboard') }}" id="sidebar-logo" class="flex items-center whitespace-nowrap overflow-hidden transition-all duration-300 w-32">
                <img src="{{ asset('assets/logo/logo-lumen-white.png') }}" alt="LUMEN Logo" class="h-8 object-contain drop-shadow-[0_0_8px_rgba(255,255,255,0.3)]">
            </a>
            <button id="toggle-btn" class="p-2 text-brand-gray hover:text-brand-cream hover:bg-white/10 rounded-lg transition focus:outline-none backdrop-blur-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-brand-olive/20 text-brand-cream border border-brand-olive/30 shadow-[0_0_15px_rgba(154,149,135,0.15)]' : 'text-brand-gray hover:bg-white/10 hover:text-brand-cream border border-transparent' }}" title="Dashboard">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 5a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM16 17a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1v-2z"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap opacity-100 transition-opacity duration-300">Dashboard</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-brand-olive/20 text-brand-cream border border-brand-olive/30 shadow-[0_0_15px_rgba(154,149,135,0.15)]' : 'text-brand-gray hover:bg-white/10 hover:text-brand-cream border border-transparent' }}" title="Products">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap opacity-100 transition-opacity duration-300">Products</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.orders.*') ? 'bg-brand-olive/20 text-brand-cream border border-brand-olive/30 shadow-[0_0_15px_rgba(154,149,135,0.15)]' : 'text-brand-gray hover:bg-white/10 hover:text-brand-cream border border-transparent' }}" title="Orders">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap opacity-100 transition-opacity duration-300">Orders</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-brand-olive/20 text-brand-cream border border-brand-olive/30 shadow-[0_0_15px_rgba(154,149,135,0.15)]' : 'text-brand-gray hover:bg-white/10 hover:text-brand-cream border border-transparent' }}" title="Registered Users">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap opacity-100 transition-opacity duration-300">Registered Users</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 space-y-2">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-3 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.profile.*') ? 'bg-white/10 text-brand-cream border border-white/20' : 'text-brand-gray hover:bg-white/10 hover:text-brand-cream border border-transparent' }}" title="Account Settings">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap">Settings</span>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center px-3 py-3 rounded-xl text-brand-gray hover:bg-white/10 hover:text-brand-cream transition-all duration-200 border border-transparent" title="Storefront">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap">View Storefront</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-3 rounded-xl text-red-400/80 hover:bg-red-500/20 hover:text-red-300 transition-all duration-200 border border-transparent hover:border-red-500/30 shadow-[0_0_0_rgba(239,68,68,0)] hover:shadow-[0_0_15px_rgba(239,68,68,0.2)]" title="Logout">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="sidebar-text ml-4 text-sm font-medium tracking-wide whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-transparent relative z-10">

        <header class="h-20 bg-white/[0.02] backdrop-blur-xl border-b border-white/10 flex items-center justify-between px-8 shadow-sm relative z-10">
            <h1 class="text-2xl font-serif text-brand-cream tracking-wide drop-shadow-md">@yield('header_title')</h1>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-brand-cream tracking-wide">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-brand-olive uppercase tracking-widest mt-0.5">Administrator</p>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="w-10 h-10 bg-brand-olive/20 rounded-xl flex items-center justify-center text-brand-cream font-bold border border-brand-olive/30 shadow-[0_0_10px_rgba(154,149,135,0.2)] backdrop-blur-md hover:bg-brand-olive/40 hover:scale-105 transition-all duration-300">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 md:p-8 z-10 relative">

            @if (session('success'))
                <div class="mb-6 bg-brand-sage/20 backdrop-blur-md border border-brand-sage/30 p-4 rounded-2xl shadow-[0_4px_15px_rgba(170,171,154,0.1)] flex items-center">
                    <svg class="w-5 h-5 text-brand-cream mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-brand-cream font-medium tracking-wide">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-500/10 backdrop-blur-md border border-red-500/20 p-4 rounded-2xl shadow-[0_4px_15px_rgba(239,68,68,0.1)] flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-red-300 font-medium tracking-wide">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const sidebarLogo = document.getElementById('sidebar-logo');
        
        // Cek status sidebar tersimpan di LocalStorage
        const isCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';

        function applySidebarState(collapsed) {
            if (collapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');

                sidebarLogo.classList.add('opacity-0', 'w-0');
                sidebarLogo.classList.remove('w-32');
                sidebarTexts.forEach(text => text.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');

                sidebarLogo.classList.remove('opacity-0', 'w-0');
                sidebarLogo.classList.add('w-32');
                sidebarTexts.forEach(text => text.classList.remove('hidden'));
            }
        }

        applySidebarState(isCollapsed);

        toggleBtn.addEventListener('click', () => {
            const currentlyCollapsed = sidebar.classList.contains('w-20');
            const newState = !currentlyCollapsed;
            
            applySidebarState(newState);
            
            localStorage.setItem('sidebar_collapsed', newState);
        });
    </script>

</body>
</html>