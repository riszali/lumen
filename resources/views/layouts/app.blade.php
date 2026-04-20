<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LUMEN | Elegance in Every Detail')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (Using Vite in Laravel 12) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- CDN Fallback -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    // GLOBAL SAFE AREA: Tambahan khusus untuk menghindari elemen nabrak navbar
                    spacing: {
                        'navbar': '120px', 
                    },
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
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #EDE7D4; }
        ::-webkit-scrollbar-thumb { background: #AAAB9A; }
        ::-webkit-scrollbar-thumb:hover { background: #9A9587; }
        
        /* Animasi Notifikasi Floating */
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="font-sans antialiased flex flex-col min-h-screen bg-brand-cream text-brand-dark selection:bg-brand-sage selection:text-brand-dark">

    <!-- Navbar / Header -->
    @include('partials.navbar')

    <!-- Flash Messages (Floating Toast) -->
    <div class="fixed top-32 left-0 w-full z-[110] flex flex-col items-center pointer-events-none px-4">
        @if (session('success'))
            <div class="bg-brand-sage/90 backdrop-blur-xl border border-white/20 text-brand-dark px-6 py-3.5 rounded-full text-center text-xs sm:text-sm font-bold tracking-widest uppercase shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500/90 backdrop-blur-xl border border-white/20 text-white px-6 py-3.5 rounded-full text-center text-xs sm:text-sm font-bold tracking-widest uppercase shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <!-- Tidak menggunakan pt-navbar di main agar background halaman utama tetap full-screen -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

</body>
</html>