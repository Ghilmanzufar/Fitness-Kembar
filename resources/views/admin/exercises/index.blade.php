@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-white font-oswald uppercase mb-6">Manajemen Panduan</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="space-y-6">
            <div class="bg-slate-800 p-6 rounded-2xl border border-white/5">
                <h3 class="font-bold text-white mb-4">1. Tambah Kategori Otot</h3>
                <form action="{{ route('exercises.category.store') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="name" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2" placeholder="Misal: Bahu (Shoulder)" required>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">+</button>
                </form>
            </div>

            <div class="bg-slate-800 p-6 rounded-2xl border border-white/5">
                <h3 class="font-bold text-white mb-4">List Kategori</h3>
                <ul class="space-y-2">
                    @foreach($bodyParts as $part)
                    <li class="flex justify-between items-center text-gray-400 bg-slate-900 p-2 rounded">
                        <span>{{ $part->name }}</span>
                        <form action="{{ route('exercises.category.destroy', $part->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini beserta isinya?');">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-white">&times;</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-slate-800 p-6 rounded-2xl border border-white/5 mb-8">
    <h3 class="font-bold text-white mb-4">2. Tambah Gerakan Latihan</h3>
    
    <form action="{{ route('exercises.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Pilih Bagian Otot</label>
                <select name="body_part_id" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2">
                    @foreach($bodyParts as $part)
                        <option value="{{ $part->id }}">{{ $part->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-400">Nama Gerakan</label>
                <input type="text" name="name" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2" placeholder="Misal: Incline Press" required>
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-400">Foto Thumbnail (Opsional)</label>
            <input type="file" name="image" class="w-full text-gray-400 border border-gray-700 rounded cursor-pointer bg-slate-900 text-sm">
            <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, Max 2MB. Jika kosong akan pakai gambar default.</p>
        </div>

        <div>
            <label class="text-sm text-gray-400">Link Video (YouTube)</label>
            <input type="url" name="video_url" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2" placeholder="https://youtube.com/..." required>
        </div>
        
        <div>
            <label class="text-sm text-gray-400">Deskripsi Singkat</label>
            <textarea name="description" class="w-full bg-slate-900 border border-gray-700 text-white rounded px-4 py-2" rows="2" placeholder="Tips melakukan gerakan..."></textarea>
        </div>

        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded font-bold">SIMPAN PANDUAN</button>
    </form>
</div>

            <div class="bg-slate-800 rounded-2xl border border-white/5 overflow-hidden">
                <table class="w-full text-left text-gray-400">
                    <thead class="bg-slate-900 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Gerakan</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($bodyParts as $part)
                            @foreach($part->exercises as $ex)
                            <tr class="hover:bg-white/5">
                                <td class="px-6 py-3 text-xs text-blue-400">{{ $part->name }}</td>
                                <td class="px-6 py-3 text-white">
                                    {{ $ex->name }}
                                    <a href="{{ $ex->video_url }}" target="_blank" class="text-xs text-gray-500 ml-2 hover:text-red-500">Lihat Video ↗</a>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <form action="{{ route('exercises.destroy', $ex->id) }}" method="POST" onsubmit="return confirm('Hapus?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection