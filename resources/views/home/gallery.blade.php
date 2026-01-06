@extends('layouts.app')

@section('title', 'Gudang Senjata')

@section('content')
    <section class="relative pt-32 pb-16 bg-slate-950 text-center px-4 overflow-hidden">
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full h-full bg-gradient-to-b from-red-900/20 to-slate-950 pointer-events-none"></div>
        
        <div class="relative z-10" data-aos="fade-down">
            <h1 class="text-4xl md:text-6xl font-bold text-white font-oswald uppercase mb-4 tracking-wide">
                GUDANG <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-600">SENJATA</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                Intip kelengkapan alat tempur kami. Tidak perlu mewah, yang penting efektif merusak serat otot untuk tumbuh lebih kuat.
            </p>
        </div>
    </section>

    <section x-data="{ 
                imgModal: false, 
                imgSrc: '', 
                imgTitle: '', 
                imgDesc: '' 
             }" 
             class="py-10 bg-slate-950 px-4 min-h-screen">
        
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1637666062717-1c6bcfa4a4df?q=80&w=1470&auto=format&fit=crop'; 
                         imgTitle = 'Rak Dumbbell (2kg - 50kg)'; 
                         imgDesc = 'Koleksi lengkap untuk dropset maupun heavy lifting. Besi murni, bukan karet.'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1637666062717-1c6bcfa4a4df?q=80&w=1470&auto=format&fit=crop" 
                         alt="Dumbbell" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Free Weight
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">RAK DUMBBELL</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Tersedia dari beban ringan 2kg untuk pemanasan hingga 50kg untuk Anda yang ingin memecahkan rekor personal.
                    </p>
                </div>
            </div>

            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="100"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop'; 
                         imgTitle = 'Flat Bench Press'; 
                         imgDesc = 'Raja dari segala latihan dada. Standar kompetisi powerlifting.'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Compound
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">BENCH PRESS</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Bangku datar standar internasional. Wajib bagi pemburu dada bidang. Pastikan ada spotter jika main berat!
                    </p>
                </div>
            </div>

            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="200"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1599058945522-28d584b6f0ff?q=80&w=1469&auto=format&fit=crop'; 
                         imgTitle = 'Lat Pulldown Machine'; 
                         imgDesc = 'Mesin kabel untuk melatih otot sayap (Latissimus Dorsi).'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1599058945522-28d584b6f0ff?q=80&w=1469&auto=format&fit=crop" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Machine
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">LAT PULLDOWN</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Ingin punggung lebar berbentuk V? Mesin ini kuncinya. Kabel sling baja yang mulus dan beban tumpuk yang mudah diatur.
                    </p>
                </div>
            </div>

            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1574680096145-d05b474e2155?q=80&w=1469&auto=format&fit=crop'; 
                         imgTitle = 'Leg Press 45 Degree'; 
                         imgDesc = 'Jangan skip leg day. Mesin ini sanggup menampung beban hingga 500kg.'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1574680096145-d05b474e2155?q=80&w=1469&auto=format&fit=crop" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Legs
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">LEG PRESS</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Solusi latihan kaki yang aman bagi punggung bawah. Plat beban murni untuk sensasi dorongan yang nyata.
                    </p>
                </div>
            </div>

            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="100"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?q=80&w=1470&auto=format&fit=crop'; 
                         imgTitle = 'Loker Penyimpanan'; 
                         imgDesc = 'Simpan barang bawaan Anda dengan aman. Bawa kunci gembok sendiri untuk keamanan ekstra.'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?q=80&w=1470&auto=format&fit=crop" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Fasilitas
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">LOKER MEMBER</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Area penyimpanan barang yang luas dan bersih. Jangan tinggalkan barang berharga, fokuslah latihan.
                    </p>
                </div>
            </div>

            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="200"
                 @click="imgModal = true; 
                         imgSrc = 'https://images.unsplash.com/photo-1517963879466-e9b5ce382569?q=80&w=1471&auto=format&fit=crop'; 
                         imgTitle = 'Sepeda Statis'; 
                         imgDesc = 'Pemanasan atau pembakaran lemak. Kayuh sekuat tenaga untuk stamina juara.'">
                
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1517963879466-e9b5ce382569?q=80&w=1471&auto=format&fit=crop" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Cardio
                    </div>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">CARDIO ZONE</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Mesin sepeda statis klasik. Efektif untuk warming up sebelum angkat beban atau sesi fat burning di akhir latihan.
                    </p>
                </div>
            </div>

        </div>

        <div x-show="imgModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="imgModal = false"
             class="fixed inset-0 z-[60] flex items-center justify-center bg-black/95 backdrop-blur-sm p-4"
             style="display: none;">
            
            <button @click="imgModal = false" class="absolute top-6 right-6 text-white hover:text-red-500 transition z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="max-w-5xl w-full flex flex-col md:flex-row gap-8 bg-slate-900 rounded-2xl overflow-hidden border border-white/10 shadow-2xl" @click.away="imgModal = false">
                <div class="w-full md:w-2/3 h-[400px] md:h-[500px]">
                    <img :src="imgSrc" class="w-full h-full object-cover">
                </div>
                <div class="w-full md:w-1/3 p-8 flex flex-col justify-center">
                    <h3 x-text="imgTitle" class="text-3xl font-bold text-white font-oswald mb-4 uppercase"></h3>
                    <div class="w-16 h-1 bg-red-600 mb-6"></div>
                    <p x-text="imgDesc" class="text-gray-300 text-lg leading-relaxed"></p>
                    <button @click="imgModal = false" class="mt-8 px-6 py-2 border border-white text-white hover:bg-white hover:text-black transition self-start rounded-lg uppercase text-sm font-bold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </section>
@endsection