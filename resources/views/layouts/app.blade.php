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
                            dark: '#252322',
                            olive: '#9A9587',
                            sage: '#AAAB9A',
                            gray: '#BDBBB9',
                            warm: '#DAD5CC',
                            light: '#E5E6D9',
                            cream: '#EDE7D4'
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
        @keyframes fadeOutUp {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out forwards;
        }
        .animate-fade-out-up {
            animation: fadeOutUp 0.5s ease-in forwards;
        }
    </style>
</head>
<body class="font-sans antialiased flex flex-col min-h-screen bg-brand-cream text-brand-dark selection:bg-brand-sage selection:text-brand-dark">

    <!-- Navbar / Header -->
    @include('partials.navbar')

    <!-- Flash Messages (Floating Toast) -->
    <div class="fixed top-32 left-0 w-full z-[110] flex flex-col items-center pointer-events-none px-4" id="toast-container">
        @if (session('success'))
            <div class="toast-message bg-brand-sage/90 backdrop-blur-xl border border-white/20 text-brand-dark px-6 py-3.5 rounded-full text-center text-xs sm:text-sm font-bold tracking-widest uppercase shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="toast-message bg-red-500/90 backdrop-blur-xl border border-white/20 text-white px-6 py-3.5 rounded-full text-center text-xs sm:text-sm font-bold tracking-widest uppercase shadow-[0_10px_40px_rgba(0,0,0,0.5)] pointer-events-auto mb-3 animate-fade-in-down">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Auto-hide Toast Script (Eksekusi Langsung) -->
    <script>
        // Script ini langsung berjalan saat file HTML sampai di baris ini
        setTimeout(() => {
            const toasts = document.querySelectorAll('.toast-message');
            toasts.forEach(toast => {
                // Ganti animasi dari turun ke naik
                toast.classList.remove('animate-fade-in-down');
                toast.classList.add('animate-fade-out-up'); 
                
                // Tunggu 500ms sampai animasi naik selesai, lalu hapus dari HTML
                setTimeout(() => {
                    toast.remove();
                }, 500);
            });
        }, 3000); // Angka 3000 = Waktu tunggu 3 detik sebelum animasi naik dimulai
    </script>
</body>
</html>