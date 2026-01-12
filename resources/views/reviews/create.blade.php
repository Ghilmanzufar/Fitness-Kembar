<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - Majapahit Gym</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-slate-900 border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-red-600 to-orange-600 p-6 text-center">
            <h1 class="text-2xl font-bold text-white font-oswald uppercase tracking-wide">Suara Member</h1>
            <p class="text-white/80 text-sm mt-1">Bantu kami menjadi lebih baik untuk Anda.</p>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-600/20 border border-green-500 text-green-400 p-4 rounded-lg mb-6 text-center animate-pulse">
                    <h3 class="font-bold text-lg">Terima Kasih! 🙏</h3>
                    <p>{{ session('success') }}</p>
                </div>
            @else
                
                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6" x-data="{ rating: 0 }">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Nama Anda (Boleh Samaran)</label>
                        <input type="text" name="name" required class="w-full bg-slate-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:ring-red-500 focus:border-red-500 transition placeholder-gray-600" placeholder="Contoh: Member Setia">
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Rating Gym</label>
                        <input type="hidden" name="rating" :value="rating"> <div class="flex gap-2 cursor-pointer">
                            <template x-for="i in 5">
                                <svg @click="rating = i" 
                                     @mouseover="hover = i" 
                                     @mouseleave="hover = 0"
                                     :class="{ 'text-yellow-400 fill-current': i <= rating, 'text-gray-600': i > rating }"
                                     class="w-10 h-10 transition transform hover:scale-110" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </template>
                        </div>
                        <p class="text-xs text-red-500 mt-2" x-show="rating == 0">Silakan klik bintang untuk memberi nilai.</p>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Kritik, Saran, atau Pujian</label>
                        <textarea name="message" rows="4" required class="w-full bg-slate-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:ring-red-500 focus:border-red-500 transition placeholder-gray-600" placeholder="Tulis masukan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" :disabled="rating == 0" :class="{ 'opacity-50 cursor-not-allowed': rating == 0 }" class="w-full bg-white text-slate-900 font-bold py-4 rounded-lg hover:bg-gray-200 transition shadow-lg">
                        KIRIM ULASAN 🚀
                    </button>
                </form>

            @endif
        </div>
        
        <div class="bg-slate-950 p-4 text-center">
             <a href="{{ route('home') }}" class="text-gray-500 text-xs hover:text-white transition">Kembali ke Website Utama</a>
        </div>
    </div>

</body>
</html>