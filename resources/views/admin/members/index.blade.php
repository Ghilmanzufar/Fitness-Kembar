@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-white font-oswald uppercase">Data Member</h2>
        <a href="{{ route('members.create') }}" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold shadow-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Member
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600/20 border border-green-500 text-green-400 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-400">
                <thead class="bg-slate-900 text-xs uppercase text-gray-500 font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">No. WhatsApp</th>
                        <th class="px-6 py-4">Masa Aktif</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($members as $member)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 font-medium text-white">
                            {{ $member->name }}
                            <div class="text-xs text-gray-500">Gabung: {{ $member->join_date->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $member->phone }}</td>
                        <td class="px-6 py-4">
                            {{ $member->expiry_date->format('d M Y') }}
                            <div class="text-xs text-gray-500">
                                Sisa {{ \Carbon\Carbon::now()->diffInDays($member->expiry_date, false) > 0 ? \Carbon\Carbon::now()->diffInDays($member->expiry_date) . ' hari' : 'Habis' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($member->expiry_date >= \Carbon\Carbon::now())
                                <span class="px-3 py-1 bg-green-600/20 text-green-400 text-xs rounded-full font-bold">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-600/20 text-red-400 text-xs rounded-full font-bold animate-pulse">Expired</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus member ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection