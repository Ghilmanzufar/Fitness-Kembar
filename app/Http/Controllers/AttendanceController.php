<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // FILTER TANGGAL: Jika ada request tanggal, pakai itu. Jika tidak, pakai hari ini.
        $selectedDate = $request->date ?? Carbon::today()->format('Y-m-d');

        $attendances = Attendance::whereDate('created_at', $selectedDate)
                                 ->with('member')
                                 ->latest()
                                 ->get();
                                 
        return view('admin.attendances.index', compact('attendances', 'selectedDate'));
    }

    public function store(Request $request)
    {
        $request->validate(['identifier' => 'required']);
        $input = $request->identifier;

        // FITUR BARU: Cari berdasarkan HP atau NAMA (Pake LIKE %...%)
        $members = Member::where('phone', $input)
                         ->orWhere('name', 'LIKE', "%{$input}%")
                         ->get();

        // VALIDASI PENCARIAN
        if ($members->count() == 0) {
            return back()->with('error', 'Data tidak ditemukan (Cek Nama/HP).');
        }
        
        if ($members->count() > 1) {
            return back()->with('warning', 'Ada ' . $members->count() . ' orang dengan nama mirip! Harap gunakan Nomor HP biar spesifik.');
        }

        $member = $members->first(); // Ambil satu-satunya member yang cocok

        // CEK MASA AKTIF
        if (Carbon::now()->gt($member->expiry_date)) {
            $days = Carbon::now()->diffInDays($member->expiry_date);
            return back()->with('error', "GAGAL! {$member->name} sudah expired {$days} hari yang lalu.");
        }

        // CEK DOUBLE ABSEN (Sesuai tanggal hari ini)
        $alreadyCheckIn = Attendance::where('member_id', $member->id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->exists();

        if ($alreadyCheckIn) {
            return back()->with('warning', "{$member->name} sudah absen hari ini.");
        }

        // SIMPAN
        Attendance::create([
            'member_id' => $member->id,
            'check_in_time' => Carbon::now(),
        ]);

        return back()->with('success', "Check-in Manual Sukses: {$member->name}");
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return back()->with('success', 'Data dihapus.');
    }

    // ... fungsi destroy di atas ...

    // FITUR CETAK LAPORAN
    public function printRecap(Request $request)
    {
        $type = $request->type; // 'monthly' atau 'yearly'
        $year = $request->year;
        $month = $request->month ?? 1;

        $query = Attendance::with('member')->latest();

        if ($type == 'monthly') {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month);
            $title = "Laporan Kehadiran Bulan $month / $year";
        } else {
            $query->whereYear('created_at', $year);
            $title = "Laporan Kehadiran Tahun $year";
        }

        $attendances = $query->get();
        
        // Grouping Data berdasarkan Tanggal supaya rapi
        // Hasilnya: ['2026-01-01' => [Data Absen, Data Absen], '2026-01-02' => ...]
        $groupedData = $attendances->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        return view('admin.attendances.print', compact('groupedData', 'title', 'attendances'));
    }
}
