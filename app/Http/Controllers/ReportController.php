<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default: Ambil bulan ini
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');

        // Ambil data transaksi sesuai bulan & tahun yang dipilih
        $transactions = Transaction::whereMonth('created_at', $month)
                                   ->whereYear('created_at', $year)
                                   ->latest()
                                   ->get();

        // Hitung Total Pemasukan
        $totalPemasukan = $transactions->sum('amount');

        return view('admin.reports.index', compact('transactions', 'totalPemasukan', 'month', 'year'));
    }
}