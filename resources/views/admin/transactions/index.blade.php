@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-white font-oswald uppercase mb-6">Kasir Harian</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-slate-800 border border-white/5 p-8 rounded-2xl shadow-xl h-fit" 
                 x-data="{ 
                    tipe: 'daily_visit', 
                    harga: 15000,
                    updateHarga() {
                        if(this.tipe == 'daily_visit') this.harga = 15000;
                        if(this.tipe == 'retail') this.harga = 5000; // Harga default air minum
                        if(this.tipe == 'lainnya') this.harga = 0;   // Reset kalau manual
                    }
                 }">
                
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-400 text-sm font-bold mb-2">Jenis Transaksi</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="daily_visit" x-model="tipe" @change="updateHarga()" class="peer sr-only">
                                <div class="p-3 rounded-lg border border-gray-600 peer-checked:bg-yellow-600 peer-checked:border-yellow-500 peer-checked:text-white text-gray-400 text-center transition hover:bg-slate-700">
                                    <div class="font-bold text-sm">Member Harian</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="retail" x-model="tipe" @change="updateHarga()" class="peer sr-only">
                                <div class="p-3 rounded-lg border border-gray-600 peer-checked:bg-blue-600 peer-checked:border-blue-500 peer-checked:text-white text-gray-400 text-center transition hover:bg-slate-700">
                                    <div class="font-bold text-sm">Jualan</div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="lainnya" x-model="tipe" @change="updateHarga()" class="peer sr-only">
                                <div class="p-3 rounded-lg border border-gray-600 peer-checked:bg-gray-600 peer-checked:border-gray-500 peer-checked:text-white text-gray-400 text-center transition hover:bg-slate-700">
                                    <div class="font-bold text-sm">Lainnya</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm font-bold mb-2">Nominal (Rp)</label>
                        <input type="number" name="amount" x-model="harga" class="w-full bg-slate-900 border border-gray-700 text-white text-2xl font-bold rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm font-bold mb-2">Catatan (Opsional)</label>
                        <input type="text" name="notes" class="w-full bg-slate-900 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 transition" placeholder="Contoh: Air Mineral 2, Sewa Handuk...">
                    </div>

                    <button type="submit" class="w-full py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg shadow-green-900/30 transition transform hover:scale-[1.02]">
                        TERIMA UANG 💰
                    </button>
                </form>

                @if(session('success'))
                    <div class="mt-4 bg-green-600/20 text-green-400 p-3 rounded text-center text-sm font-bold border border-green-500/50">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-400 mb-4">Riwayat Terakhir</h3>
                <div class="space-y-3">
                    @foreach($recentTransactions as $trx)
                        <div class="bg-slate-800 p-4 rounded-xl border border-white/5 flex justify-between items-center">
                            <div>
                                <div class="text-white font-bold">
                                    @if($trx->type == 'daily_visit') Harian (Visit)
                                    @elseif($trx->type == 'retail') Jualan/Retail
                                    @elseif($trx->type == 'registration') Daftar Member
                                    @else Lainnya
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500">{{ $trx->notes ?? '-' }}</div>
                                <div class="text-xs text-gray-600 mt-1">{{ $trx->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="text-green-500 font-bold font-oswald text-lg">
                                +{{ number_format($trx->amount / 1000, 0) }}k
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection