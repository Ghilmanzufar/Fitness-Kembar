<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\BodyPart;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        return view('home.gallery', compact('galleries'));
    }

    public function guide()
    {
        // Ambil semua Bagian Tubuh beserta Latihannya
        $bodyParts = BodyPart::with('exercises')->get();
        
        return view('home.guide', compact('bodyParts'));
    }
}