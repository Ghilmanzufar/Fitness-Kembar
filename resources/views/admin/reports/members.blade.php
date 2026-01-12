@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white font-oswald uppercase">Laporan Pertumbuhan Member</h2>
                <p class="text-gray-400 text-sm mt-1">Data member baru yang bergabung pada periode ini.</p>
            </div>
            
            <div class="flex gap-2 mt-4 md:mt-0">
                <form action="{{ route('reports.members') }}" method="GET" class="flex gap-2">
                    <select name="month" class="bg-slate-800 text-white border border-gray-600 rounded-lg px-3 py-2">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Bulan {{ $i }}</option>
                        @endfor
                    </select>
                    <select name="year" class="bg-slate-800 text-white border border-gray-600 rounded-lg px-3 py-2">
                        <option value="2025" {{ $year == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ $year == '2026' ? 'selected' : '' }}>2026</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
                        Filter
                    </button>
                </form>

                <a href="{{ route('reports.members.print', ['month' => $month, 'year' => $year]) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    PDF
                </a>
            </div>
        </div>

        <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-xl mb-6 flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-600/20 text-blue-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-400 text-sm uppercase font-bold">Total Member Baru</p>
                <h3 class="text-3xl font-bold text-white">{{ $members->count() }} Orang</h3>
                <p class="text-xs text-gray-500">Bergabung pada Bulan {{ $month }}/{{ $year }}</p>
            </div>
        </div>

        <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-400">
                    <thead class="bg-slate-900 text-xs uppercase text-gray-500 font-bold">
                        <tr>
                            <th class="px-6 py-4">Tgl Join</th>
                            <th class="px-6 py-4">Nama Member</th>
                            <th class="px-6 py-4">No. HP</th>
                            <th class="px-6 py-4">Masa Aktif S/D</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($members as $m)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-mono text-blue-400">
                                {{ $m->join_date->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-white">
                                {{ $m->name }}
                            </td>
                            <td class="px-6 py-4">{{ $m->phone }}</td>
                            <td class="px-6 py-4">
                                {{ $m->expiry_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(\Carbon\Carbon::now()->gt($m->expiry_date))
                                    <span class="px-2 py-1 bg-red-900/30 text-red-500 text-xs rounded font-bold">Expired</span>
                                @else
                                    <span class="px-2 py-1 bg-green-900/30 text-green-500 text-xs rounded font-bold">Active</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                                Tidak ada member baru di bulan ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection