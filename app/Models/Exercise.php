<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    
    // Satu Latihan milik SATU Bagian Tubuh
    public function bodyPart()
    {
        return $this->belongsTo(BodyPart::class);
    }
}