@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold text-white font-oswald uppercase mb-6">Catat Pengeluaran</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-bold text-white mb-4">Input Pengeluaran</h3>
                    
                    <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Keterangan</label>
                            <input type="text" name="description" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-red-500 outline-none" placeholder="Contoh: Bayar Listrik" required>
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Nominal (Rp)</label>
                            <input type="number" name="amount" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-red-500 outline-none" placeholder="0" required>
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Tanggal</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-red-500 outline-none" required>
                        </div>

                        <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded shadow-lg transition">
                            SIMPAN PENGELUARAN
                        </button>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 p-3 bg-green-600/20 text-green-400 text-sm rounded text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-slate-800 border border-white/5 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Riwayat Pengeluaran</h3>
                        <span class="text-sm text-gray-500">Semua Data</span>
                    </div>
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table class="w-full text-left text-gray-400">
                            <thead class="bg-slate-900 text-xs uppercase text-gray-500 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Keterangan</th>
                                    <th class="px-6 py-3">Jumlah</th>
                                    <th class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($expenses as $expense)
                                <tr class="hover:bg-white/5">
                                    <td class="px-6 py-3 text-sm">{{ $expense->date->format('d M Y') }}</td>
                                    <td class="px-6 py-3 text-white">{{ $expense->description }}</td>
                                    <td class="px-6 py-3 text-red-400 font-bold">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3 text-right">
                                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-500 hover:text-red-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-600">Belum ada data pengeluaran.</td>
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