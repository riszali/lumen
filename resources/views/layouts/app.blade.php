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
    <!-- Ini adalah cara yang BENAR, ringan, dan tidak membebani HP -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- PENYEBAB HP PANAS (TAILWIND CDN & SCRIPT CONFIG) TELAH DIHAPUS DARI SINI -->

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

    <!-- Floating WhatsApp Button (Tanpa efek Ping) -->
    <a href="https://wa.me/6285101170849" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-[100] flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-[#25D366] text-white rounded-full shadow-[0_10px_30px_rgba(37,211,102,0.4)] hover:scale-110 hover:-translate-y-2 transition-all duration-300">
        <!-- Logo SVG WhatsApp -->
        <svg class="w-7 h-7 md:w-9 md:h-9 relative z-10" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

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