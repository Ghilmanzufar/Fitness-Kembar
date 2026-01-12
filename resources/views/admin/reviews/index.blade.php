@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white font-oswald uppercase">Evaluasi & Ulasan</h2>
            <p class="text-gray-400 text-sm">Apa kata member tentang Gym kita?</p>
        </div>
        
        <div class="bg-slate-800 px-6 py-3 rounded-xl border border-white/5 flex items-center gap-4 mt-4 md:mt-0">
            <div class="text-right">
                <div class="text-xs text-gray-400 uppercase">Rata-rata Rating</div>
                <div class="text-3xl font-bold text-yellow-400">{{ number_format($average, 1) }} <span class="text-sm text-gray-500">/ 5.0</span></div>
            </div>
            <div class="text-yellow-400">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($reviews as $review)
        <div class="bg-slate-800 border border-white/5 p-6 rounded-2xl shadow-lg hover:border-white/20 transition relative group">
            
            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?');" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                @csrf @method('DELETE')
                <button class="text-gray-600 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>

            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-white">{{ $review->name }}</h3>
                <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
            </div>

            <div class="flex text-yellow-400 mb-4">
                @for($i=1; $i<=5; $i++)
                    @if($i <= $review->rating)
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @else
                        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endif
                @endfor
            </div>

            <div class="bg-black/20 p-4 rounded-lg">
                <p class="text-gray-300 text-sm italic">"{{ $review->message }}"</p>
            </div>

        </div>
        @empty
        <div class="col-span-full text-center py-20 text-gray-500">
            Belum ada ulasan yang masuk.
        </div>
        @endforelse
    </div>

</div>
@endsection