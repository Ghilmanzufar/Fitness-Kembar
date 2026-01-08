<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Expense; // <--- JANGAN LUPA IMPORT INI
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default: Bulan & Tahun ini
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');

        // 1. Ambil Pemasukan (Transaksi)
        $transactions = Transaction::whereMonth('created_at', $month)
                                   ->whereYear('created_at', $year)
                                   ->latest()
                                   ->get();
        $totalPemasukan = $transactions->sum('amount');

        // 2. Ambil Pengeluaran (Expense)
        $expenses = Expense::whereMonth('date', $month)
                           ->whereYear('date', $year)
                           ->latest()
                           ->get();
        $totalPengeluaran = $expenses->sum('amount');

        // 3. Hitung Laba Bersih
        $profit = $totalPemasukan - $totalPengeluaran;

        return view('admin.reports.index', compact(
            'transactions', 
            'expenses', 
            'totalPemasukan', 
            'totalPengeluaran', 
            'profit',
            'month', 
            'year'
        ));
    }
}