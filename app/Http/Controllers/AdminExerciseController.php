<?php

namespace App\Http\Controllers;

use App\Models\BodyPart;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminExerciseController extends Controller
{
    public function index()
    {
        // Ambil kategori beserta latihannya
        $bodyParts = BodyPart::with('exercises')->get();
        return view('admin.exercises.index', compact('bodyParts'));
    }

    // Simpan Kategori Baru (Dada, Punggung, dll)
    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required']);
        BodyPart::create(['name' => $request->name]);
        return back()->with('success', 'Kategori Otot ditambahkan.');
    }

    // Hapus Kategori
    public function destroyCategory(BodyPart $bodyPart)
    {
        $bodyPart->delete();
        return back()->with('success', 'Kategori dihapus.');
    }

    public function storeExercise(Request $request)
    {
        $request->validate([
            'body_part_id' => 'required',
            'name' => 'required',
            'video_url' => 'nullable|url',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048' // Validasi Gambar (Max 2MB)
        ]);

        $data = $request->all();

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Simpan ke folder 'exercise-images' di storage public
            $path = $request->file('image')->store('exercise-images', 'public');
            $data['image'] = $path;
        }

        Exercise::create($data);

        return back()->with('success', 'Panduan latihan berhasil ditambahkan.');
    }
    
    // Update juga fungsi Hapus supaya gambarnya ikut terhapus dari server
    public function destroyExercise(Exercise $exercise)
    {
        if ($exercise->image && Storage::disk('public')->exists($exercise->image)) {
            Storage::disk('public')->delete($exercise->image);
        }
        
        $exercise->delete();
        return back()->with('success', 'Latihan dihapus.');
    }
    
}