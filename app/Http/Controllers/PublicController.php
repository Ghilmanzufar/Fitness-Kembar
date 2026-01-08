<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicController extends Controller
{
    // 1. Tampilkan Halaman Absen (Form Input No HP)
    public function showCheckIn()
    {
        return view('checkin');
    }

    // 2. Proses Absen Member
    public function processCheckIn(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
        ]);

        // Cari member berdasarkan No HP
        $member = Member::where('phone', $request->phone)->first();

        if (!$member) {
            return back()->with('error', 'Nomor HP tidak terdaftar. Hubungi Admin.');
        }

        // Cek Expired
        if (Carbon::now()->gt($member->expiry_date)) {
            return back()->with('error', 'Yah, member kamu sudah expired. Harap perpanjang di kasir ya!');
        }

        // Cek Double Absen
        $alreadyCheckIn = Attendance::where('member_id', $member->id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->exists();

        if ($alreadyCheckIn) {
            return back()->with('warning', 'Halo ' . $member->name . ', kamu sudah absen hari ini. Selamat latihan!');
        }

        // Simpan Absen
        Attendance::create([
            'member_id' => $member->id,
            'check_in_time' => Carbon::now(),
        ]);

        return back()->with('success', 'Selamat Datang, ' . $member->name . '! Semangat latihannya 💪');
    }
}