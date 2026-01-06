<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA MEMBER (ANGGOTA)
        // Member 1: Masih Aktif (Budi Santoso)
        $member1 = DB::table('members')->insertGetId([
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'join_date' => Carbon::now()->subMonths(2), // Gabung 2 bulan lalu
            'expiry_date' => Carbon::now()->addDays(15), // Habis 15 hari lagi (Aman)
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Member 2: Sudah Expired / Merah (Siti Aminah)
        $member2 = DB::table('members')->insertGetId([
            'name' => 'Siti Aminah',
            'phone' => '089876543210',
            'join_date' => Carbon::now()->subMonths(5),
            'expiry_date' => Carbon::now()->subDays(3), // Sudah lewat 3 hari (Harus Merah)
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Member 3: Expired Minggu Depan / Kuning (Joko Kuat)
        DB::table('members')->insert([
            'name' => 'Joko Kuat',
            'phone' => '081122334455',
            'join_date' => Carbon::now()->subMonths(1),
            'expiry_date' => Carbon::now()->addDays(5), // Habis 5 hari lagi (Warning Kuning)
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2. DATA TRANSAKSI (KEUANGAN)
        // Transaksi Pendaftaran Budi
        DB::table('transactions')->insert([
            'member_id' => $member1,
            'type' => 'registration',
            'amount' => 135000,
            'notes' => 'Daftar Baru',
            'created_at' => Carbon::now()->subMonths(2),
        ]);

        // Transaksi Perpanjangan Budi
        DB::table('transactions')->insert([
            'member_id' => $member1,
            'type' => 'renewal',
            'amount' => 100000,
            'notes' => 'Perpanjang Bulan ke-2',
            'created_at' => Carbon::now()->subMonth(),
        ]);

        // Transaksi Harian (Orang lewat / Insidental)
        DB::table('transactions')->insert([
            'member_id' => null, // Tidak ada ID Member
            'type' => 'daily_visit',
            'amount' => 15000,
            'notes' => 'Mas-mas kaos merah',
            'created_at' => Carbon::now()->subHours(2), // 2 jam lalu
        ]);

        // Transaksi Jual Minum
        DB::table('transactions')->insert([
            'member_id' => null,
            'type' => 'retail',
            'amount' => 5000,
            'notes' => 'Susu Kedelai 1 pcs',
            'created_at' => Carbon::now()->subHours(1),
        ]);

        // 3. DATA PANDUAN LATIHAN (BODY PARTS)
        $chestId = DB::table('body_parts')->insertGetId(['name' => 'Dada (Chest)', 'image' => 'chest.jpg']);
        $backId = DB::table('body_parts')->insertGetId(['name' => 'Punggung (Back)', 'image' => 'back.jpg']);
        $legId = DB::table('body_parts')->insertGetId(['name' => 'Kaki (Legs)', 'image' => 'legs.jpg']);

        // 4. DATA GERAKAN LATIHAN
        DB::table('exercises')->insert([
            ['body_part_id' => $chestId, 'name' => 'Bench Press', 'description' => 'Latihan dasar untuk dada tengah. Gunakan barbel.', 'video_url' => 'https://youtube.com/...'],
            ['body_part_id' => $chestId, 'name' => 'Push Up', 'description' => 'Latihan beban tubuh untuk dada dan tricep.', 'video_url' => null],
            ['body_part_id' => $backId, 'name' => 'Lat Pulldown', 'description' => 'Tarik stang ke arah dada atas.', 'video_url' => null],
            ['body_part_id' => $legId, 'name' => 'Squat', 'description' => 'Jongkok berdiri dengan beban di pundak.', 'video_url' => null],
        ]);
    }
}