@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('users.index') }}" class="w-10 h-10 flex items-center justify-center bg-slate-800 rounded-full hover:bg-slate-700 text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="text-3xl font-bold text-white font-oswald uppercase">Tambah Admin Baru</h2>
        </div>

        <div class="bg-slate-800 border border-white/5 p-8 rounded-2xl shadow-xl">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Nama Admin</label>
                    <input type="text" name="name" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="Misal: Kasir Pagi" required>
                </div>

                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Email Login</label>
                    <input type="email" name="email" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="user@gym.com" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-400 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="Minimal 6 karakter" required>
                </div>

                <div class="bg-blue-900/20 border border-blue-500/30 p-4 rounded-lg text-sm text-blue-300">
                    <p>⚠️ <strong>Info:</strong> Akun ini akan memiliki akses penuh ke Dashboard, Kasir, dan Laporan Keuangan.</p>
                </div>

                <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg shadow-red-900/30 transition transform hover:scale-[1.02]">
                    BUAT AKUN
                </button>
            </form>
        </div>
    </div>
@endsection