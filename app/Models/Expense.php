<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    // Casting agar kolom date dibaca sebagai Carbon (Tanggal)
    protected $casts = [
        'date' => 'date',
    ];
}