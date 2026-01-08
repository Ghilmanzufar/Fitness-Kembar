<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <--- Wajib Import buat enkripsi password

class UserController extends Controller
{
    // 1. Tampilkan Daftar Admin
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Simpan Admin Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email gak boleh kembar
            'password' => 'required|min:6', // Minimal 6 karakter
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // <--- Password DIENKRIPSI disini
        ]);

        return redirect()->route('users.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    // 4. Hapus Admin
    public function destroy(User $user)
    {
        // Mencegah admin menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun admin dihapus.');
    }
}