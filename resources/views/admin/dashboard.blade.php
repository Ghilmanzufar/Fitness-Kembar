@extends('layouts.admin')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-bold font-oswald text-white mb-1">Dashboard Owner</h1>
            <p class="text-gray-400 text-sm">Selamat datang kembali, pantau performa gym hari ini.</p>
        </div>
        <button class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold shadow-lg shadow-red-900/30 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Transaksi Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-blue-600/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-blue-600/20"></div>
            <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Member Aktif</p>
            <h3 class="text-4xl font-bold text-white font-oswald">{{ $totalMembers }}</h3>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Siap Latihan
            </p>
        </div>

        <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-green-600/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-green-600/20"></div>
            <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Omset Hari Ini</p>
            <h3 class="text-4xl font-bold text-white font-oswald">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h3>
            <p class="text-gray-500 text-xs mt-2">Update Realtime</p>
        </div>

        <div class="bg-slate-800 border border-red-500/30 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-red-600/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-red-600/20"></div>
            <p class="text-red-400 text-sm uppercase tracking-wider font-semibold mb-2">Member Expired</p>
            <h3 class="text-4xl font-bold text-white font-oswald">{{ $expiredMembers }}</h3>
            <p class="text-red-500 text-xs mt-2 font-bold animate-pulse">
                Segera Tagih!
            </p>
        </div>

        <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-purple-600/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-purple-600/20"></div>
            <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Total Kunjungan</p>
            <h3 class="text-4xl font-bold text-white font-oswald">24</h3>
            <p class="text-purple-400 text-xs mt-2">Orang Hari Ini</p>
        </div>
    </div>

    <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white font-oswald">Transaksi Terakhir</h3>
            <a href="#" class="text-sm text-red-500 hover:text-red-400">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-400">
                <thead class="bg-slate-900/50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-4">Nama / Info</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($latestTransactions as $trx)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 font-medium text-white">
                            {{ $trx->member_name ?? 'Non-Member (Umum)' }}
                            <div class="text-xs text-gray-500">{{ $trx->notes }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($trx->type == 'registration')
                                <span class="px-2 py-1 bg-blue-600/20 text-blue-400 text-xs rounded-full">Daftar Baru</span>
                            @elseif($trx->type == 'daily_visit')
                                <span class="px-2 py-1 bg-yellow-600/20 text-yellow-400 text-xs rounded-full">Harian</span>
                            @elseif($trx->type == 'renewal')
                                <span class="px-2 py-1 bg-green-600/20 text-green-400 text-xs rounded-full">Perpanjang</span>
                            @else
                                <span class="px-2 py-1 bg-gray-600/20 text-gray-400 text-xs rounded-full">Ritel</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-white font-bold">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            {{ \Carbon\Carbon::parse($trx->created_at)->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-green-500 flex items-center gap-1 text-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Lunas
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection