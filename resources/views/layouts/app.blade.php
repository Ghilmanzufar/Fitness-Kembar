<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Majapahit - @yield('title', 'Beranda')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; }
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* SOLUSI ANTI MELEBAR: Memaksa body tidak boleh scroll ke samping */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
    </style>
</head>
<body class="bg-slate-950 text-white antialiased selection:bg-red-600 selection:text-white">

    <nav x-data="{ scrolled: false, mobileOpen: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         class="fixed w-full z-50 top-0 left-0 transition-all duration-300 p-3 md:p-4">
        
        <div :class="scrolled || mobileOpen ? 'bg-slate-900/95 shadow-lg border-white/10' : 'bg-slate-900/80 md:bg-slate-900/50 border-white/5 md:border-transparent'"
             class="w-[98%] md:max-w-screen-xl mx-auto transition-all duration-300 relative backdrop-blur-md 
                    rounded-2xl md:rounded-full border">
            
            <div class="flex flex-nowrap items-center justify-between px-4 py-3 md:px-6">
                
                <a href="{{ route('home') }}" class="flex items-center space-x-2 rtl:space-x-reverse group shrink-0">
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white transform group-hover:rotate-12 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <span class="self-center text-lg md:text-xl font-bold whitespace-nowrap text-white uppercase tracking-wider font-oswald">
                        MAJAPAHIT<span class="text-red-600">GYM</span>
                    </span>
                </a>
                
                <button @click="mobileOpen = !mobileOpen" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-600 shrink-0">
                    <svg x-show="!mobileOpen" class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="hidden w-full md:block md:w-auto">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 items-center">
                        <li><a href="{{ route('home') }}" class="block py-2 px-3 transition text-sm tracking-wide uppercase font-semibold {{ request()->routeIs('home') ? 'text-red-500' : 'text-white hover:text-red-500' }}">Beranda</a></li>
                        <li><a href="{{ route('guide') }}" class="block py-2 px-3 transition text-sm tracking-wide uppercase font-semibold {{ request()->routeIs('guide') ? 'text-red-500' : 'text-white hover:text-red-500' }}">Panduan</a></li>
                        <li><a href="{{ route('gallery') }}" class="block py-2 px-3 transition text-sm tracking-wide uppercase font-semibold {{ request()->routeIs('gallery') ? 'text-red-500' : 'text-white hover:text-red-500' }}">Galery</a></li>
                        <li><a href="{{ route('public.checkin') }}" class="block py-2 px-3 transition text-sm tracking-wide uppercase font-semibold {{ request()->routeIs('public.checkin') ? 'text-red-500' : 'text-white hover:text-red-500' }}">Check-In</a></li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full text-sm font-bold transition transform hover:scale-105 shadow-lg shadow-red-900/50">
                                LOGIN ADMIN
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div x-show="mobileOpen" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden border-t border-white/10 bg-slate-900/95 shadow-xl overflow-hidden rounded-b-2xl">
                
                <ul class="flex flex-col p-4 space-y-2 text-center">
                    <li><a href="{{ route('home') }}" class="block py-3 px-4 rounded-lg font-semibold {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-white hover:bg-white/5' }}">Beranda</a></li>
                    <li><a href="{{ route('guide') }}" class="block py-3 px-4 rounded-lg font-semibold {{ request()->routeIs('guide') ? 'bg-red-600 text-white' : 'text-white hover:bg-white/5' }}">Panduan</a></li>
                    <li><a href="{{ route('gallery') }}" class="block py-3 px-4 rounded-lg font-semibold {{ request()->routeIs('gallery') ? 'bg-red-600 text-white' : 'text-white hover:bg-white/5' }}">Galery</a></li>
                    <li><div class="border-t border-white/10 my-2"></div></li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block w-full py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold">
                            LOGIN ADMIN
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-black py-10 border-t border-white/10">
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold font-oswald text-white mb-4 uppercase">Majapahit<span class="text-red-600">Gym</span></h2>
            <p class="text-gray-500 text-sm mb-6">Membangun otot dan mental baja sejak 2024.</p>
            <div class="text-gray-600 text-xs">
                &copy; {{ date('Y') }} Fitness Kembar Project. All rights reserved.
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
            offset: 50,
        });
    </script>
</body>
</html>