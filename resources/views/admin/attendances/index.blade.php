@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-white font-oswald uppercase mb-6">Absensi Member</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-slate-800 border border-white/5 p-8 rounded-2xl shadow-xl sticky top-4">
                    <h3 class="text-xl font-bold text-white mb-2">Check-In</h3>
                    <p class="text-gray-400 text-sm mb-6">Masukkan Nomor HP atau Nama Member.</p>

                    @if(session('success'))
                        <div class="bg-green-600/20 border border-green-500 text-green-400 p-4 rounded-lg mb-4 text-center">
                            <h4 class="font-bold text-lg">BERHASIL! ✅</h4>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-600/20 border border-red-500 text-red-400 p-4 rounded-lg mb-4 text-center animate-pulse">
                            <h4 class="font-bold text-lg">DITOLAK! ❌</h4>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    
                    @if(session('warning'))
                        <div class="bg-yellow-600/20 border border-yellow-500 text-yellow-400 p-4 rounded-lg mb-4 text-center">
                            <p>{{ session('warning') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="identifier" class="w-full bg-slate-900 border border-gray-600 text-white text-center text-xl font-bold rounded-lg px-4 py-4 focus:border-red-500 focus:ring-2 focus:ring-red-900 outline-none transition placeholder-gray-600" placeholder="0812 / Nama" autofocus required autocomplete="off">
                        </div>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg shadow-lg transition text-lg">
                            CHECK IN 🚀
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-white/10 text-center">
                        <p class="text-gray-500 text-xs">Total Hadir Hari Ini</p>
                        <p class="text-4xl font-bold text-white font-oswald">{{ $attendances->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
                    
                    <div class="p-6 border-b border-white/5 space-y-4">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <h3 class="text-xl font-bold text-white">
                                Data Kehadiran
                                <span class="text-sm font-normal text-gray-500 block md:inline md:ml-2">
                                    ({{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }})
                                </span>
                            </h3>
                            
                            <form action="{{ route('attendances.index') }}" method="GET" class="flex gap-2">
                                <input type="date" name="date" value="{{ $selectedDate }}" 
                                    class="bg-slate-900 border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:border-red-500">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition">
                                    Lihat Tgl Ini
                                </button>
                            </form>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-4 border-t border-white/5">
                            <span class="text-sm text-gray-500 py-2">Cetak Rekap:</span>
                            
                            <form action="{{ route('attendances.print') }}" method="GET" target="_blank" class="flex gap-2">
                                <input type="hidden" name="type" value="monthly">
                                <select name="month" class="bg-slate-900 border border-gray-600 text-white text-xs rounded px-2 py-1">
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>Bulan {{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="year" class="bg-slate-900 border border-gray-600 text-white text-xs rounded px-2 py-1">
                                    <option value="2025">2025</option>
                                    <option value="2026" selected>2026</option>
                                </select>
                                <button class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1 rounded flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    PDF Bulanan
                                </button>
                            </form>

                            <div class="border-r border-white/10 mx-2"></div>

                            <form action="{{ route('attendances.print') }}" method="GET" target="_blank" class="flex gap-2">
                                <input type="hidden" name="type" value="yearly">
                                <select name="year" class="bg-slate-900 border border-gray-600 text-white text-xs rounded px-2 py-1">
                                    <option value="2025">2025</option>
                                    <option value="2026" selected>2026</option>
                                </select>
                                <button class="bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold px-3 py-1 rounded flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    PDF Tahunan
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-400">
                            <thead class="bg-slate-900 text-xs uppercase text-gray-500 font-bold">
                                <tr>
                                    <th class="px-6 py-4">Jam</th>
                                    <th class="px-6 py-4">Nama Member</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($attendances as $absen)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4 font-mono text-blue-400">
                                        {{ $absen->created_at->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-white">
                                        {{ $absen->member->name }}
                                        <div class="text-xs text-gray-500 font-normal">{{ $absen->member->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-green-900/30 text-green-400 text-xs rounded border border-green-500/30">
                                            Hadir
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('attendances.destroy', $absen->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button class="text-gray-600 hover:text-red-500" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Tidak ada data absen pada tanggal ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection