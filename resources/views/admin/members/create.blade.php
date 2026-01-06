@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('members.index') }}" class="w-10 h-10 flex items-center justify-center bg-slate-800 rounded-full hover:bg-slate-700 text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="text-3xl font-bold text-white font-oswald uppercase">Daftar Member Baru</h2>
        </div>

        <div class="bg-slate-800 border border-white/5 p-8 rounded-2xl shadow-xl">
            <form action="{{ route('members.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="Contoh: Ade Rai" required>
                </div>

                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Nomor WhatsApp</label>
                    <input type="number" name="phone" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="08123xxxxx" required>
                </div>

                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Pilih Paket Langganan</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="1" class="peer sr-only" checked>
                            <div class="p-4 rounded-lg bg-slate-900 border border-gray-700 peer-checked:border-red-500 peer-checked:bg-red-600/10 transition text-center hover:bg-slate-700">
                                <div class="font-bold text-white">1 Bulan</div>
                                <div class="text-xs text-gray-400">Rp 135.000</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="3" class="peer sr-only">
                            <div class="p-4 rounded-lg bg-slate-900 border border-gray-700 peer-checked:border-red-500 peer-checked:bg-red-600/10 transition text-center hover:bg-slate-700">
                                <div class="font-bold text-white">3 Bulan</div>
                                <div class="text-xs text-gray-400">Hemat 5%</div>
                            </div>
                        </label>
                        </div>
                </div>

                <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg shadow-red-900/30 transition transform hover:scale-[1.02]">
                    SIMPAN & AKTIFKAN MEMBER
                </button>
            </form>
        </div>
    </div>
@endsection