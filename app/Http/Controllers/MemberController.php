<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction; // Kita butuh ini untuk catat transaksi pendaftaran otomatis
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemberController extends Controller
{
    // 1. Tampilkan Daftar Member
    public function index()
    {
        // Ambil data member terbaru, urutkan dari yang paling baru daftar
        $members = Member::latest()->get();
        return view('admin.members.index', compact('members'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('admin.members.create');
    }

    // 3. Simpan Member Baru (Logic Paling Penting)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:members,phone', // No HP gak boleh sama
            'duration' => 'required|in:1,3,6,12', // Pilihan paket (bulan)
        ]);

        // Hitung Tanggal Expired
        $joinDate = Carbon::now();
        $expiryDate = Carbon::now()->addMonths($request->duration);
        
        // Hitung Biaya (Misal: 135rb bulan pertama)
        // Logikanya: 135rb + (100rb * sisa bulan)
        $totalBiaya = 135000 + (100000 * ($request->duration - 1));

        // A. Simpan ke Tabel Members
        $member = Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'join_date' => $joinDate,
            'expiry_date' => $expiryDate,
        ]);

        // B. Otomatis Catat di Tabel Transaksi (Supaya Dashboard Update)
        Transaction::create([
            'member_id' => $member->id,
            'type' => 'registration',
            'amount' => $totalBiaya,
            'notes' => 'Pendaftaran Baru ' . $request->duration . ' Bulan',
        ]);

        return redirect()->route('members.index')->with('success', 'Member berhasil didaftarkan! Siap latihan.');
    }

    // 4. Hapus Member
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Data member dihapus.');
    }
}