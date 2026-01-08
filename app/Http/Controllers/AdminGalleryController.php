<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Upload Gambar
        $imagePath = $request->file('image')->store('gallery-images', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan!');
    }

    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik
        if(Storage::disk('public')->exists($gallery->image)){
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return back()->with('success', 'Foto dihapus.');
    }
}