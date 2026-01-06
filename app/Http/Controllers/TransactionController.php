<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Tampilkan Halaman Kasir
    public function index()
    {
        // Ambil 10 transaksi terakhir untuk history di bawah form
        $recentTransactions = Transaction::latest()->limit(10)->get();
        return view('admin.transactions.index', compact('recentTransactions'));
    }

    // 2. Simpan Transaksi
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        Transaction::create([
            'member_id' => null, // Karena ini transaksi harian/umum
            'type' => $request->type,
            'amount' => $request->amount,
            'notes' => $request->notes ?? 'Transaksi Kasir',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Uang berhasil masuk laci!');
    }
}