@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 print:hidden">
            <h2 class="text-3xl font-bold text-white font-oswald uppercase">Laporan Keuangan</h2>
            
            <div class="flex gap-2">
                <form action="{{ route('reports.index') }}" method="GET" class="flex gap-2">
                    <select name="month" class="bg-slate-800 text-white border border-gray-600 rounded-lg px-3 py-2">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                Bulan {{ $i }}
                            </option>
                        @endfor
                    </select>
                    <select name="year" class="bg-slate-800 text-white border border-gray-600 rounded-lg px-3 py-2">
                        <option value="2024" {{ $year == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $year == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ $year == '2026' ? 'selected' : '' }}>2026</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
                        Filter
                    </button>
                </form>

                <button onclick="window.print()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak
                </button>
            </div>
        </div>

        <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden p-8 print:bg-white print:text-black print:border-none print:shadow-none">
            
            <div class="text-center mb-8 border-b border-gray-600 pb-6 print:border-black">
                <h1 class="text-3xl font-bold font-oswald uppercase text-white print:text-black">Majapahit Gym</h1>
                <p class="text-gray-400 print:text-black">Laporan Pendapatan Periode {{ $month }}/{{ $year }}</p>
            </div>

            <div class="mb-8 p-4 bg-green-900/20 border border-green-500/30 rounded-lg text-center print:bg-gray-100 print:border-black">
                <p class="text-gray-400 text-sm uppercase mb-1 print:text-black">Total Pemasukan</p>
                <h3 class="text-4xl font-bold text-green-500 print:text-black">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </h3>
            </div>

            <table class="w-full text-left text-gray-400 print:text-black">
                <thead class="bg-slate-900 text-xs uppercase text-gray-500 font-bold border-b border-gray-700 print:bg-gray-200 print:text-black print:border-black">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3 text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 print:divide-gray-300">
                    @foreach($transactions as $trx)
                    <tr>
                        <td class="px-4 py-3">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            {{ $trx->notes }}
                            @if($trx->member_id) 
                                <span class="text-xs text-blue-400 block print:text-black">(Member #{{ $trx->member_id }})</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $trx->type) }}</td>
                        <td class="px-4 py-3 text-right font-bold text-white print:text-black">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-16 flex justify-end print:text-black">
                <div class="text-center w-48">
                    <p class="mb-16">Jakarta, {{ date('d M Y') }}</p>
                    <p class="font-bold border-t border-gray-600 pt-2 print:border-black">Admin Pengelola</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            #sidebar, nav { display: none; } /* Sembunyikan Sidebar */
            main { margin: 0; padding: 0; background: white; }
            .print\:hidden { display: none !important; }
            .print\:visible, .print\:visible * { visibility: visible; }
            .bg-slate-800 { background-color: white !important; color: black !important; }
            .text-white { color: black !important; }
            /* Trik menampilkan hanya bagian konten */
            .max-w-5xl { visibility: visible; position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>
@endsection