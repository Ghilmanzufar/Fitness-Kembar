@extends('layouts.admin')

@section('content')
    <div x-data="{ renewModal: false, memberId: null, memberName: '' }">

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
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                
                                <button @click="renewModal = true; memberId = {{ $member->id }}; memberName = '{{ $member->name }}'" 
                                        class="text-blue-500 hover:text-blue-400 transition" title="Perpanjang">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </button>

                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus member ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 transition" title="Hapus">
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

        <div x-show="renewModal" 
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-cloak>
            
            <div class="bg-slate-800 border border-white/10 p-8 rounded-2xl shadow-2xl max-w-md w-full" @click.away="renewModal = false">
                <h3 class="text-2xl font-bold text-white font-oswald mb-2">Perpanjang Member</h3>
                <p class="text-gray-400 text-sm mb-6">Perbarui masa aktif untuk <span x-text="memberName" class="text-white font-bold"></span>.</p>

                <form :action="'/admin/members/' + memberId + '/renew'" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-400 text-sm font-bold mb-2">Pilih Durasi</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="duration" value="1" class="peer sr-only" checked>
                                <div class="p-3 rounded border border-gray-600 peer-checked:bg-blue-600 peer-checked:border-blue-500 text-center hover:bg-slate-700 transition">
                                    <div class="font-bold text-white">1 Bulan</div>
                                    <div class="text-xs text-gray-400">Rp 100.000</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="duration" value="3" class="peer sr-only">
                                <div class="p-3 rounded border border-gray-600 peer-checked:bg-blue-600 peer-checked:border-blue-500 text-center hover:bg-slate-700 transition">
                                    <div class="font-bold text-white">3 Bulan</div>
                                    <div class="text-xs text-gray-400">Rp 300.000</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="renewModal = false" class="w-1/2 py-3 border border-gray-600 text-gray-300 rounded-lg hover:bg-white/5 transition">
                            Batal
                        </button>
                        <button type="submit" class="w-1/2 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection