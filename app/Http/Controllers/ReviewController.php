<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // === AREA PUBLIK (Form Member) ===

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        Review::create($request->all());

        return back()->with('success', 'Terima kasih! Masukan Anda sangat berarti bagi kemajuan Gym kami.');
    }

    // === AREA ADMIN (Lihat Data) ===

    public function index()
    {
        // Ambil semua review urut dari yang terbaru
        $reviews = Review::latest()->get();

        // Hitung rata-rata rating
        $average = $reviews->avg('rating');

        return view('admin.reviews.index', compact('reviews', 'average'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Ulasan dihapus.');
    }
}