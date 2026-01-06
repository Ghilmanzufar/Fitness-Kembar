<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi (mass assignment)
    protected $guarded = ['id'];

    // Casting tanggal supaya otomatis jadi objek Carbon (bisa dihitung)
    protected $casts = [
        'join_date' => 'date',
        'expiry_date' => 'date',
    ];
}