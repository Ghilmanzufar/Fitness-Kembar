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

    // LAPORAN MEMBER BARU
    public function members(Request $request)
    {
        // Default: Bulan & Tahun ini
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');

        // Ambil member yang JOIN pada bulan & tahun tersebut
        $members = \App\Models\Member::whereMonth('join_date', $month)
                                     ->whereYear('join_date', $year)
                                     ->latest('join_date')
                                     ->get();

        return view('admin.reports.members', compact('members', 'month', 'year'));
    }

    // CETAK PDF MEMBER
    public function printMembers(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $members = \App\Models\Member::whereMonth('join_date', $month)
                                     ->whereYear('join_date', $year)
                                     ->orderBy('join_date', 'asc')
                                     ->get();

        return view('admin.reports.print_members', compact('members', 'month', 'year'));
    }
}