@extends('layouts.app')

@section('title', 'Kamus Latihan')

@section('content')
    <section class="relative pt-32 pb-20 bg-slate-950 text-center px-4">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-slate-950 to-black opacity-80"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto" data-aos="zoom-in">
            <span class="text-red-500 font-bold tracking-widest uppercase text-sm mb-2 block">Knowledge Base</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white font-oswald uppercase mb-6">
                KAMUS <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-600">LATIHAN</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-8">
                Jangan asal angkat. Pelajari teknik yang benar agar otot tumbuh maksimal dan bebas cedera.
            </p>
        </div>
    </section>

    <section x-data="{ activeTab: 'all', searchQuery: '' }" class="min-h-screen bg-slate-950 px-4 pb-20 border-t border-white/5">
        
        <div class="max-w-screen-xl mx-auto -mt-8 relative z-20">
            
            <div class="bg-slate-900 border border-white/10 rounded-2xl p-4 md:p-6 shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between" data-aos="fade-up">
                
                <div class="flex flex-wrap justify-center gap-2">
                    <button @click="activeTab = 'all'" 
                            :class="activeTab === 'all' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'bg-slate-800 text-gray-400 hover:bg-slate-700'"
                            class="px-5 py-2 rounded-full text-sm font-bold uppercase transition-all duration-300">
                        Semua
                    </button>

                    @foreach($bodyParts as $part)
                        <button @click="activeTab = {{ $part->id }}" 
                                :class="activeTab === {{ $part->id }} ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'bg-slate-800 text-gray-400 hover:bg-slate-700'"
                                class="px-5 py-2 rounded-full text-sm font-bold uppercase transition-all duration-300">
                            {{ $part->name }}
                        </button>
                    @endforeach
                </div>

                <div class="relative w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari gerakan (misal: Bench Press)..." 
                           class="block w-full md:w-64 p-2.5 pl-10 text-sm text-white bg-slate-800 border border-gray-700 rounded-lg focus:ring-red-500 focus:border-red-500 placeholder-gray-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                
                @foreach($bodyParts as $part)
                    @foreach($part->exercises as $exercise)
                        
                        <div x-show="(activeTab === 'all' || activeTab === {{ $part->id }}) && '{{ strtolower($exercise->name) }}'.includes(searchQuery.toLowerCase())"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="bg-slate-900 border border-white/5 rounded-xl overflow-hidden hover:border-red-600/50 hover:shadow-lg hover:shadow-red-900/10 transition group">
                            
                            <div class="h-48 bg-slate-800 relative group cursor-pointer overflow-hidden">
                                <img src="https://source.unsplash.com/random/800x600/?gym,{{ str_replace(' ', '', $part->name) }}" 
                                     class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition duration-500" 
                                     alt="Latihan">
                                
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center pl-1 shadow-xl group-hover:scale-110 transition">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                
                                <div class="absolute top-3 left-3 bg-black/50 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded border border-white/10">
                                    {{ $part->name }}
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white font-oswald mb-2 group-hover:text-red-500 transition">{{ $exercise->name }}</h3>
                                <p class="text-gray-400 text-sm line-clamp-2 mb-4">
                                    {{ $exercise->description }}
                                </p>
                                
                                <button class="w-full py-2 border border-white/20 rounded-lg text-white text-sm hover:bg-white hover:text-black transition font-semibold uppercase tracking-wide">
                                    Lihat Detail & Video
                                </button>
                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>
            
            <div x-show="document.querySelectorAll('[x-show=\'true\']').length === 0" 
                 class="text-center py-20 hidden" 
                 :class="{ 'block': searchQuery.length > 0 }">
                 <p class="text-gray-500 text-lg">Gerakan "<span x-text="searchQuery" class="text-white font-bold"></span>" tidak ditemukan bro.</p>
            </div>

        </div>
    </section>

    <section class="py-16 bg-slate-900 text-center border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-white font-oswald mb-8 uppercase">Tips Pemula</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 font-bold text-xl">1</div>
                    <h3 class="text-white font-bold mb-2">Form Over Ego</h3>
                    <p class="text-gray-400 text-sm">Jangan malu angkat beban ringan. Teknik yang benar lebih penting daripada beban berat tapi punggung encok.</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 font-bold text-xl">2</div>
                    <h3 class="text-white font-bold mb-2">Mind Muscle Connection</h3>
                    <p class="text-gray-400 text-sm">Rasakan otot yang bekerja, jangan cuma asal gerak naik turun.</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 font-bold text-xl">3</div>
                    <h3 class="text-white font-bold mb-2">Rest is Key</h3>
                    <p class="text-gray-400 text-sm">Otot tumbuh saat istirahat, bukan saat latihan. Tidur cukup itu wajib.</p>
                </div>
            </div>
        </div>
    </section>
@endsection