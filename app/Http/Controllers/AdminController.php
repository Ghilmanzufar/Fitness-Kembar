<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Hitung Total Member Aktif
        $totalMembers = DB::table('members')
            ->where('expiry_date', '>', Carbon::now())
            ->count();

        // 2. Hitung Member yang Expired (Merah)
        $expiredMembers = DB::table('members')
            ->where('expiry_date', '<', Carbon::now())
            ->count();

        // 3. Hitung Pendapatan Hari Ini
        $incomeToday = DB::table('transactions')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        // 4. Ambil 5 Transaksi Terakhir
        $latestTransactions = DB::table('transactions')
            ->join('members', 'transactions.member_id', '=', 'members.id', 'left') // Left join karena ada transaksi harian (non-member)
            ->select('transactions.*', 'members.name as member_name')
            ->orderBy('transactions.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('totalMembers', 'expiredMembers', 'incomeToday', 'latestTransactions'));
    }
}