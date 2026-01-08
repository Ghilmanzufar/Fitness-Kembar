<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    protected $guarded = ['id']; // Buka kunci mass assignment

    // Relasi ke Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}