<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bodyPart()
    {
        return $this->belongsTo(BodyPart::class);
    }

    // FITUR BARU: Konversi Link YouTube Otomatis
    public function getEmbedUrlAttribute()
    {
        $url = $this->video_url;
        
        // Cek jika linknya pendek (youtu.be)
        if (str_contains($url, 'youtu.be/')) {
            $videoId = explode('youtu.be/', $url)[1];
            return 'https://www.youtube.com/embed/' . $videoId;
        }
        
        // Cek jika linknya panjang (youtube.com/watch?v=)
        if (str_contains($url, 'watch?v=')) {
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            return 'https://www.youtube.com/embed/' . $query['v'];
        }

        return $url; // Kembalikan apa adanya jika bukan link YouTube
    }
}