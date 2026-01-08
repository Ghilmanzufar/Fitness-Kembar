<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check In - Majapahit Gym</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen px-4">

    <div class="w-full max-w-md text-center">
        <div class="mb-8" data-aos="fade-down">
            <h1 class="text-4xl font-bold text-white font-oswald uppercase tracking-widest">
                MAJAPAHIT <span class="text-red-600">GYM</span>
            </h1>
            <p class="text-gray-500 text-sm mt-2">Scan. Check-in. Lift.</p>
        </div>

        <div class="bg-slate-900 border border-white/10 p-8 rounded-2xl shadow-2xl">
            
            @if(session('success'))
                <div class="bg-green-600/20 border border-green-500 text-green-400 p-4 rounded-lg mb-6 animate-pulse">
                    <h2 class="text-xl font-bold mb-1">SUKSES! ✅</h2>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-600/20 border border-red-500 text-red-400 p-4 rounded-lg mb-6">
                    <h2 class="text-xl font-bold mb-1">GAGAL ❌</h2>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if(session('warning'))
                <div class="bg-blue-600/20 border border-blue-500 text-blue-400 p-4 rounded-lg mb-6">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            <form action="{{ route('public.checkin.process') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-left text-gray-400 text-sm mb-2 ml-1">Masukkan Nomor WhatsApp</label>
                    <input type="number" name="phone" placeholder="0812xxxx" 
                           class="w-full bg-slate-950 border border-gray-700 text-white text-center text-2xl font-bold rounded-xl px-4 py-4 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none transition placeholder-gray-700">
                </div>

                <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-900/40 transition transform hover:scale-[1.02]">
                    CHECK IN SEKARANG
                </button>
            </form>
        </div>

        <div class="mt-8">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm flex items-center justify-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>

        <p class="text-gray-600 text-xs mt-8">
            &copy; {{ date('Y') }} Majapahit Gym System
        </p>
    </div>

</body>
</html>