<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LUMEN | Elegance in Every Detail')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #EDE7D4; }
        ::-webkit-scrollbar-thumb { background: #AAAB9A; }
        ::-webkit-scrollbar-thumb:hover { background: #9A9587; }
    </style>
</head>
<body class="font-sans antialiased flex flex-col min-h-screen bg-brand-cream text-brand-dark selection:bg-brand-sage selection:text-brand-dark">

    @include('partials.navbar')

    @if (session('success'))
        <div class="bg-brand-sage/20 border-b border-brand-sage/30 text-brand-dark px-4 py-3 text-center text-sm font-medium tracking-wide">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-b border-red-200 text-red-800 px-4 py-3 text-center text-sm font-medium tracking-wide">
            {{ session('error') }}
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>