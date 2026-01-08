<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyPart extends Model
{
    use HasFactory;
    
    protected $guarded = ['id']; // <--- Tambahkan ini

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}