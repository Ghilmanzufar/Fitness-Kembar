<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyPart extends Model
{
    use HasFactory;

    // Satu Bagian Tubuh punya BANYAK Latihan
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}