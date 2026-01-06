<?php

namespace App\Http\Controllers;

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
        return view('home.gallery'); // Kita akan buat file ini nanti
    }

    public function guide()
    {
        // Ambil semua Bagian Tubuh beserta Latihannya
        $bodyParts = BodyPart::with('exercises')->get();
        
        return view('home.guide', compact('bodyParts'));
    }
}