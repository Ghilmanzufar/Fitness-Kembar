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
            
            @forelse($galleries as $item)
                <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-red-900/20 hover:-translate-y-2 cursor-pointer"
                     data-aos="fade-up"
                     @click="imgModal = true; 
                             imgSrc = '{{ asset('storage/' . $item->image) }}'; 
                             imgTitle = '{{ $item->title }}'; 
                             imgDesc = 'Fasilitas Gym Majapahit'">
                    
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </div>
                    </div>
                    
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition uppercase">{{ $item->title }}</h3>
                        <p class="text-gray-500 text-xs">Klik untuk memperbesar</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 text-lg">Belum ada foto galeri yang diupload admin.</p>
                </div>
            @endforelse

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