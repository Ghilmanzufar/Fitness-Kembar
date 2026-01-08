@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        
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
                    Cetak Laporan
                </button>
            </div>
        </div>

        <div id="printable-area" class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden p-8 print:bg-white print:text-black print:border-none print:shadow-none print:p-0">
            
            <div class="text-center mb-8 border-b border-gray-600 pb-6 print:border-black">
                <h1 class="text-4xl font-bold font-oswald uppercase text-white print:text-black">Majapahit Gym</h1>
                <p class="text-gray-400 print:text-black mt-2">Laporan Laba Rugi Periode {{ $month }}/{{ $year }}</p>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="p-4 bg-green-900/20 border border-green-500/30 rounded-lg text-center print:bg-gray-100 print:border-gray-300">
                    <p class="text-gray-400 text-xs uppercase mb-1 print:text-black font-bold">Total Pemasukan</p>
                    <h3 class="text-2xl font-bold text-green-500 print:text-black">
                        + Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-4 bg-red-900/20 border border-red-500/30 rounded-lg text-center print:bg-gray-100 print:border-gray-300">
                    <p class="text-gray-400 text-xs uppercase mb-1 print:text-black font-bold">Total Pengeluaran</p>
                    <h3 class="text-2xl font-bold text-red-500 print:text-black">
                        - Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="p-4 bg-blue-900/20 border border-blue-500/30 rounded-lg text-center print:bg-gray-100 print:border-gray-300">
                    <p class="text-gray-400 text-xs uppercase mb-1 print:text-black font-bold">Laba Bersih</p>
                    <h3 class="text-3xl font-bold {{ $profit >= 0 ? 'text-blue-500' : 'text-red-500' }} print:text-black">
                        Rp {{ number_format($profit, 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-bold text-green-500 mb-4 border-b border-gray-700 pb-2 print:text-black print:border-black">Rincian Pemasukan</h3>
                    <table class="w-full text-left text-gray-400 print:text-black text-sm">
                        <thead class="uppercase text-xs font-bold border-b border-gray-700 print:border-black">
                            <tr>
                                <th class="py-2">Tanggal</th>
                                <th class="py-2">Sumber</th>
                                <th class="py-2 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 print:divide-gray-300">
                            @forelse($transactions as $trx)
                            <tr>
                                <td class="py-2">{{ $trx->created_at->format('d/m') }}</td>
                                <td class="py-2">
                                    {{ $trx->type == 'registration' ? 'Member Baru' : ($trx->type == 'daily_visit' ? 'Harian' : 'Lainnya') }}
                                    <span class="text-xs text-gray-500 block print:text-gray-600">{{ Str::limit($trx->notes, 20) }}</span>
                                </td>
                                <td class="py-2 text-right text-white print:text-black">
                                    {{ number_format($trx->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="py-2 text-center italic">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-red-500 mb-4 border-b border-gray-700 pb-2 print:text-black print:border-black">Rincian Pengeluaran</h3>
                    <table class="w-full text-left text-gray-400 print:text-black text-sm">
                        <thead class="uppercase text-xs font-bold border-b border-gray-700 print:border-black">
                            <tr>
                                <th class="py-2">Tanggal</th>
                                <th class="py-2">Keterangan</th>
                                <th class="py-2 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 print:divide-gray-300">
                            @forelse($expenses as $exp)
                            <tr>
                                <td class="py-2">{{ $exp->date->format('d/m') }}</td>
                                <td class="py-2">{{ $exp->description }}</td>
                                <td class="py-2 text-right text-white print:text-black">
                                    {{ number_format($exp->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="py-2 text-center italic">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-16 flex justify-end print:text-black page-break-avoid">
                <div class="text-center w-48">
                    <p class="mb-16">Bekasi, {{ date('d M Y') }}</p>
                    <p class="font-bold border-t border-gray-600 pt-2 print:border-black">Owner / Admin</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            /* 1. Sembunyikan SEMUA elemen body */
            body * {
                visibility: hidden;
            }
            
            /* 2. Tampilkan HANYA container #printable-area beserta isinya */
            #printable-area, #printable-area * {
                visibility: visible;
            }

            /* 3. Posisikan area print di pojok kiri atas kertas */
            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: white !important;
                color: black !important;
                box-shadow: none !important;
                border: none !important;
            }

            /* 4. Pastikan Sidebar & Navbar layout admin benar-benar hilang */
            nav, aside, header {
                display: none !important;
            }

            /* 5. Reset warna teks agar hemat tinta & terbaca */
            .text-white, .text-gray-400, .text-gray-500 {
                color: black !important;
            }
            
            /* Trik agar tabel tidak terpotong jelek */
            tr { page-break-inside: avoid; }
        }
    </style>
@endsection