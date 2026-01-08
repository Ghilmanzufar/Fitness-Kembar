@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-white font-oswald uppercase mb-6">Manajemen Galeri</h2>

    <div class="bg-slate-800 p-6 rounded-2xl border border-white/5 mb-8">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-4 items-end">
            @csrf
            <div class="flex-1">
                <label class="block text-gray-400 text-sm mb-2">Judul Foto / Nama Alat</label>
                <input type="text" name="title" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2" required>
            </div>
            <div class="flex-1">
                <label class="block text-gray-400 text-sm mb-2">Pilih Foto</label>
                <input type="file" name="image" class="w-full text-gray-400 border border-gray-700 rounded cursor-pointer bg-slate-900" required>
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded font-bold h-fit">
                Upload
            </button>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($galleries as $item)
        <div class="relative group rounded-xl overflow-hidden border border-white/10">
            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                <p class="text-white font-bold">{{ $item->title }}</p>
                <form action="{{ route('galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:text-white border border-red-500 hover:bg-red-600 px-3 py-1 rounded text-xs">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection