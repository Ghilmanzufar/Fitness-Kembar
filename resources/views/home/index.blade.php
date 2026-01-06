@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop" 
                 alt="Background Gym" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/40 to-slate-950"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
            <div data-aos="fade-down">
                <span class="px-4 py-1 border border-red-600/50 rounded-full text-red-500 text-sm tracking-widest uppercase font-semibold bg-red-900/10 backdrop-blur-sm">
                    Est. 2024
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 uppercase leading-tight mt-6 font-oswald" data-aos="zoom-in" data-aos-delay="200">
                Bukan Tempat <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-600">Selfie</span>,<br>
                Ini Tempat <span class="text-white">Latihan.</span>
            </h1>
            <p class="text-gray-300 text-lg md:text-xl mb-10 max-w-3xl mx-auto font-light" data-aos="fade-up" data-aos-delay="400">
                Alat besi tua yang mantap, suasana kekeluargaan, dan harga yang masuk akal. 
                Tanpa kontrak ribet, cukup bayar dan angkat beban.
            </p>
            
            <div class="flex flex-col md:flex-row justify-center gap-5" data-aos="fade-up" data-aos-delay="600">
                <a href="#harga-member" 
                   class="px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full transition-all transform hover:scale-105 hover:shadow-[0_0_20px_rgba(220,38,38,0.5)] tracking-wide">
                    LIHAT HARGA
                </a>
                <a href="{{ route('gallery') }}" 
                   class="px-8 py-4 bg-transparent border border-white/30 hover:bg-white hover:text-slate-900 text-white font-bold rounded-full transition-all backdrop-blur-sm">
                    LIHAT ALAT
                </a>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-gray-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <section id="harga-member" class="py-24 bg-slate-950 relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-600/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-screen-xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white font-oswald uppercase">Pilihan Member</h2>
                <div class="w-24 h-1 bg-red-600 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 items-start">
                
                <div class="bg-slate-900/50 border border-white/10 p-8 rounded-2xl hover:border-red-500/50 transition duration-300 backdrop-blur-sm group" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="text-2xl font-bold text-gray-400 mb-2 font-oswald uppercase group-hover:text-white transition">Harian</h3>
                    <div class="flex items-baseline mb-6">
                        <span class="text-2xl text-red-500 font-bold">Rp</span>
                        <span class="text-5xl font-bold text-white">15rb</span>
                    </div>
                    <div class="border-b border-white/10 mb-6"></div>
                    <ul class="space-y-3 text-gray-300 mb-8 text-sm">
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Loker Penyimpanan</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Alat Gym Sepuasnya</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Toilet & Kamar Mandi</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Panduan Dasar Pemula</li>
                    </ul>
                </div>

                <div class="relative bg-gradient-to-b from-slate-800 to-slate-900 border border-red-600 p-8 rounded-2xl transform md:-translate-y-4 shadow-2xl shadow-red-900/20" data-aos="fade-up">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white px-4 py-1 rounded-full text-xs font-bold tracking-wider uppercase">
                        Terlaris
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2 font-oswald uppercase">Member Baru</h3>
                    <div class="flex items-baseline mb-6">
                        <span class="text-2xl text-red-500 font-bold">Rp</span>
                        <span class="text-6xl font-bold text-white">135rb</span>
                    </div>
                    <p class="text-gray-400 text-xs mb-6 italic">*Bulan pertama (Termasuk Admin)</p>
                    <div class="border-b border-white/10 mb-6"></div>
                    <ul class="space-y-3 text-white mb-8 text-sm font-medium">
                        <li class="flex items-center gap-3"><div class="p-1 bg-red-600 rounded-full"><svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div> Gratis Biaya Admin</li>
                        <li class="flex items-center gap-3"><div class="p-1 bg-red-600 rounded-full"><svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div> Akses Unlimited 30 Hari</li>
                        <li class="flex items-center gap-3"><div class="p-1 bg-red-600 rounded-full"><svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div> Full Fasilitas Gym</li>
                        <li class="flex items-center gap-3"><div class="p-1 bg-red-600 rounded-full"><svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div> Bimbingan Awal Owner</li>
                    </ul>
                </div>

                <div class="bg-slate-900/50 border border-white/10 p-8 rounded-2xl hover:border-red-500/50 transition duration-300 backdrop-blur-sm group" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="text-2xl font-bold text-gray-400 mb-2 font-oswald uppercase group-hover:text-white transition">Perpanjang</h3>
                    <div class="flex items-baseline mb-6">
                        <span class="text-2xl text-red-500 font-bold">Rp</span>
                        <span class="text-5xl font-bold text-white">100rb</span>
                    </div>
                    <div class="border-b border-white/10 mb-6"></div>
                    <ul class="space-y-3 text-gray-300 mb-8 text-sm">
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Tanpa Biaya Admin</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Akses 30 Hari Full</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Prioritas Loker</li>
                        <li class="flex items-center gap-3"><span class="text-red-500">✓</span> Bebas Konsultasi</li>
                    </ul>
                </div>
            </div>

            <div class="text-center mt-16" data-aos="fade-up">
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition shadow-lg hover:shadow-green-600/30">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    Chat WhatsApp Admin
                </a>
            </div>
        </div>
    </section>

    <section class="py-0">
        <div class="grid md:grid-cols-2 h-auto md:h-[500px]">
            
            <div class="bg-slate-900 flex flex-col justify-center items-center p-12 text-center border-r border-white/5" data-aos="fade-right">
                <div class="mb-8 p-4 bg-white/5 rounded-full">
                    <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold font-oswald uppercase text-white mb-8 tracking-wide">Jam Latihan</h2>
                
                <div class="space-y-6 w-full max-w-sm">
                    <div class="flex justify-between items-center border-b border-white/10 pb-4">
                        <span class="text-gray-400 font-medium">Senin - Minggu</span>
                        <span class="text-2xl font-bold text-white font-oswald">08:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 pb-4">
                        <span class="text-gray-400 font-medium">Jumat</span>
                        <span class="text-2xl font-bold text-red-500 font-oswald">13:00 - 22:00</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 relative group overflow-hidden flex items-center justify-center" data-aos="fade-left">
                <div class="absolute inset-0 bg-[url('https://maps.googleapis.com/maps/api/staticmap?center=-6.200000,106.816666&zoom=15&size=800x600&maptype=roadmap&style=feature:all|element:all|saturation:-100|lightness:-50')] bg-cover bg-center opacity-40 group-hover:opacity-60 transition duration-500"></div>
                
                <div class="relative z-10 text-center p-8">
                    <div class="mb-4 inline-block p-3 bg-red-600 rounded-full animate-bounce">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">LOKASI MARKAS</h3>
                    <p class="text-gray-300 mb-6">Jln. Majapahit No. 45, Gym City</p>
                    <a href="https://maps.google.com" target="_blank" class="px-6 py-2 border border-white text-white hover:bg-white hover:text-black transition uppercase font-bold text-sm tracking-widest">
                        Buka Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-950 relative overflow-hidden text-center px-4">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-red-600/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto" data-aos="zoom-in">
            <h2 class="text-3xl md:text-5xl font-bold font-oswald text-white mb-6 uppercase">
                "Masih Bingung Cara Pakai Alat?"
            </h2>
            <p class="text-xl text-gray-400 mb-10 leading-relaxed font-light">
                Tenang, tidak perlu malu bertanya. Kami sediakan panduan digital lengkap untuk setiap alat. 
                Scan barcode di alat atau buka menu panduan.
            </p>
            <a href="#" class="inline-block px-10 py-4 bg-white text-slate-900 font-bold rounded-full hover:bg-gray-200 transition transform hover:-translate-y-1 shadow-xl">
                BUKA PANDUAN LATIHAN
            </a>
        </div>
    </section>
@endsection