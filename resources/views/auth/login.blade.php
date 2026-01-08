<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Majapahit Gym</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-950 flex items-center justify-center h-screen">

    <div class="w-full max-w-md p-8 space-y-8 bg-slate-900 border border-white/10 rounded-2xl shadow-2xl">

        <div class="text-center">
            <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white font-[Oswald] uppercase tracking-wide">
                Admin <span class="text-red-600">Area</span>
            </h2>
            <p class="text-gray-400 text-sm mt-2">Masukan kredensial untuk masuk ke dashboard.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-600/20 border border-red-500 text-red-400 px-4 py-3 rounded text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required
                        class="w-full px-4 py-3 bg-slate-950 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                        placeholder="Email Address" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 bg-slate-950 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                        placeholder="Password">
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition transform hover:scale-[1.02] shadow-lg shadow-red-900/50">
                MASUK SEKARANG
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-white transition">← Kembali ke
                Beranda</a>
        </div>
    </div>

</body>

</html>