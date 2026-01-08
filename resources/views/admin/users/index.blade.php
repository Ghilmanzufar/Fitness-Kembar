@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-white font-oswald uppercase">Manajemen Admin</h2>
        <a href="{{ route('users.create') }}"
            class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold shadow-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600/20 border border-green-500 text-green-400 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-600/20 border border-red-500 text-red-400 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
        <table class="w-full text-left text-gray-400">
            <thead class="bg-slate-900 text-xs uppercase text-gray-500 font-bold">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email Login</th>
                    <th class="px-6 py-4">Dibuat Tanggal</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $user)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 font-bold text-white flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-purple-500 flex items-center justify-center text-xs">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            {{ $user->name }}
                            @if(auth()->id() == $user->id)
                                <span class="text-xs bg-gray-700 px-2 py-0.5 rounded text-gray-300 ml-2">Anda</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if(auth()->id() != $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus admin ini? Dia tidak bisa login lagi nanti.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 transition" title="Hapus Akses">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-600 italic">Sedang Login</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection